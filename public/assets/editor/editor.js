'use strict';

function notify(text, type) {
    if (!type)  {
        type = 'alert';
    }
    noty({
        text: text,
        type: type
    });
}

$(function() {

    // setup so that csrf token in passed on
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // set  up noty
    $.noty.defaults = {
        layout: 'top',
        theme: 'relax', // or 'relax'
        type: 'alert',
        dismissQueue: true, // If you want to use queue feature set this true
        template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
        animation: {
            open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
            close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
            easing: 'swing',
            speed: 500 // opening & closing animation speed
        },
        timeout: 2000, // delay for closing event. Set false for sticky notifications
        force: false, // adds notification to the beginning of queue when set to true
        modal: false,
        callback: {
            onShow: function() {},
            afterShow: function() {},
            onClose: function() {},
            afterClose: function() {},
            onCloseClick: function() {},
        },
        maxVisible: 5, // you can set max visible notification for dismissQueue true option,
        killer: false, // for close all notifications before show
        closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
        buttons: false // an array of buttons
    };

    var editor;
    editor = ContentTools.EditorApp.get();
    editor.init('*[data-editable]', 'data-name');
    ContentTools.IMAGE_UPLOADER = imageUploader;

    editor.addEventListener('saved', function (ev) {
        var name, payload, regions;

        // Check that something changed
        regions = ev.detail().regions;
        if (Object.keys(regions).length === 0) {
            return;
        }

        // Set the editor as busy while we save our changes
        this.busy(true);

        // Collect the contents of each region into a FormData instance
        payload = {};
        for (name in regions) {
            if (regions.hasOwnProperty(name)) {
                payload[name] = regions[name];
            }
        }

        // extract the title and add to the payload
        payload.title = $('#title').text().trim();
        console.log(payload);

        $.post(window.appURL + '/save/' + window.location.pathname.split('/')[2], payload)
            .done(function(data, status) {
                console.log(data, status);
                notify(data, 'success');
            })
            .fail(function(xhr, status, err) {
                console.log(status, err);
                notify('Article can not be saved', 'error');
            }).always(function() {
                editor.busy(false);
            });

        console.log('/save/' + window.location.pathname.split('/')[2]);
    });


    function imageUploader(dialog) {

        var image, xhr, xhrComplete, xhrProgress;
       
        dialog.addEventListener('imageuploader.cancelupload', function () {
            // Cancel the current upload

            // Stop the upload
            if (xhr) {
                xhr.upload.removeEventListener('progress', xhrProgress);
                xhr.removeEventListener('readystatechange', xhrComplete);
                xhr.abort();
            }

            // Set the dialog to empty
            dialog.state('empty');
        });

        dialog.addEventListener('imageuploader.clear', function () {
            // Clear the current image
            dialog.clear();
            image = null;
        });

        dialog.addEventListener('imageuploader.fileready', function (ev) {

            // Upload a file to the server
            var formData;
            var file = ev.detail().file;

            // Define functions to handle upload progress and completion
            xhrProgress = function (ev) {
                // Set the progress for the upload
                dialog.progress((ev.loaded / ev.total) * 100);
            };

            xhrComplete = function (ev) {
                var response;

                // Check the request is complete
                if (ev.target.readyState !== 4) {
                    return;
                }

                // Clear the request
                xhr = null;
                xhrProgress = null;
                xhrComplete = null;

                // Handle the result of the upload
                if (parseInt(ev.target.status) === 200) {
                    // Unpack the response (from JSON)
                    response = JSON.parse(ev.target.responseText);

                    // Store the image details
                    image = {
                        size: [Math.min(570, response.size[0]), Math.min(320, response.size[1])],
                        url: encodeURI(response.url + '?_ignore=' + Date.now()),
                        name: response.name,
                    };

                    // Populate the dialog
                    dialog.populate(image.url, image.size);

                } else {
                    // The request failed, notify the user
                    notify('Cannot upload', 'error');
                }
            };

            // Set the dialog state to uploading and reset the progress bar to 0
            dialog.state('uploading');
            dialog.progress(0);

            // Build the form data to post to the server
            formData = new FormData();
            formData.append('image', file);

            // Make the request
            xhr = new XMLHttpRequest();
            xhr.upload.addEventListener('progress', xhrProgress);
            xhr.addEventListener('readystatechange', xhrComplete);
            xhr.open('POST', window.appURL + '/image/upload', true);
            xhr.send(formData);
        });

        function rotateImage(direction) {
            // Request a rotated version of the image from the server
            var formData;

            // Define a function to handle the request completion
            xhrComplete = function (ev) {
                var response;

                // Check the request is complete
                if (ev.target.readyState !== 4) {
                    return;
                }

                // Clear the request
                xhr = null;
                xhrComplete = null;

                // Free the dialog from its busy state
                dialog.busy(false);

                // Handle the result of the rotation
                if (parseInt(ev.target.status) === 200) {
                    // Unpack the response (from JSON)
                    response = JSON.parse(ev.target.responseText);

                    // Store the image details (use fake param to force refresh)
                    image.size = response.size;
                    image.url = encodeURI(response.url + '?_ignore=' + Date.now());

                    // Populate the dialog
                    dialog.populate(image.url, image.size);

                } else {
                    // The request failed, notify the user
                    notify('Some error rotating', 'error');
                }
            };

            // Set the dialog to busy while the rotate is performed
            dialog.busy(true);

            // Build the form data to post to the server
            formData = new FormData();
            formData.append('name', image.name);
            formData.append('direction', direction);

            // Make the request
            xhr = new XMLHttpRequest();
            xhr.addEventListener('readystatechange', xhrComplete);
            xhr.open('POST', window.appURL + '/image/rotate', true);
            xhr.send(formData);
        }

        dialog.addEventListener('imageuploader.rotateccw', function () {
            rotateImage('CCW');
        });

        dialog.addEventListener('imageuploader.rotatecw', function () {
            rotateImage('CW');
        });


        dialog.addEventListener('imageuploader.save', function () {
            var crop, cropRegion, formData;

            // Define a function to handle the request completion
            xhrComplete = function (ev) {
                // Check the request is complete
                if (ev.target.readyState !== 4) {
                    return;
                }

                // Clear the request
                xhr = null;
                xhrComplete = null;

                // Free the dialog from its busy state
                dialog.busy(false);

                // Handle the result of the rotation
                if (parseInt(ev.target.status) === 200) {
                    // Unpack the response (from JSON)
                    var response = JSON.parse(ev.target.responseText);

                    // Trigger the save event against the dialog with details of the
                    // image to be inserted.
                    dialog.save(
                        encodeURI(response.url + '?_ignore=' + Date.now()),
                        response.size,
                        {
                            'alt': response.alt,
                            'data-ce-max-width': response.size[0]
                        });

                } else {
                    // The request failed, notify the user
                    notify('Error saving', 'error');
                }
            };

            // Set the dialog to busy while the rotate is performed
            dialog.busy(true);

            // Build the form data to post to the server
            formData = new FormData();
            formData.append('name', image.name);

            // Set the width of the image when it's inserted, this is a default
            // the user will be able to resize the image afterwards.
            formData.append('width', 600);

            // Check if a crop region has been defined by the user
            if (dialog.cropRegion()) {
                formData.append('crop', dialog.cropRegion());
            }

            // Make the request
            xhr = new XMLHttpRequest();
            xhr.addEventListener('readystatechange', xhrComplete);
            xhr.open('POST', window.appURL + '/image/insert', true);
            xhr.send(formData);
        });

    }

});
