'use strict';

window.addEventListener('load', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var editor;
    ContentTools.StylePalette.add([
        new ContentTools.Style('Author', 'author', ['p'])
    ]);
    ContentTools.IMAGE_UPLOADER = imageUploader;

    editor = ContentTools.EditorApp.get();
    editor.init('*[data-editable]', 'data-name');

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

        console.log(payload);

        $.post('/save/' + window.location.pathname.split('/')[2], payload)
            .done(function(data, status) {
                console.log(data, status);
                new ContentTools.FlashUI('data');
            })
            .fail(function(xhr, status, err) {
                console.log(status, err);
                new ContentTools.FlashUI('no');
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
                    new ContentTools.FlashUI('no');
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
            xhr.open('POST', '/image/upload', true);
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
                    new ContentTools.FlashUI('no');
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
            xhr.open('POST', '/image/rotate', true);
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
                    new ContentTools.FlashUI('no');
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
            xhr.open('POST', '/image/insert', true);
            xhr.send(formData);
        });


        function getImages() {
            // Return an object containing image URLs and widths for all regions
            var descendants, i, images;

            images = {};
            for (name in editor.regions) {
                // Search each region for images
                descendants = editor.regions[name].descendants();
                for (i = 0; i < descendants.length; i++) {
                    // Filter out elements that are not images
                    if (descendants[i].constructor.name !== 'Image') {
                        continue;
                    }
                    images[descendants[i].attr('src')] = descendants[i].size()[0];
                }
            }

            return images;
        }

        editor.addEventListener('save', function (ev) {
            var regions = ev.detail().regions;

            // Collect the contents of each region into a FormData instance
            var payload = new FormData();
            payload.append('page', window.location.pathname);
            payload.append('images', JSON.stringify(getImages()));
            payload.append('regions', JSON.stringify(regions));

            // Send the updated content to the server to be saved
            function onStateChange(ev) {
                // Check if the request is finished
                if (ev.target.readyState === 4) {
                    editor.busy(false);
                    if (status === '200') {
                        // Save was successful, notify the user with a flash
                        new ContentTools.FlashUI('ok');
                    } else {
                        // Save failed, notify the user with a flash
                        new ContentTools.FlashUI('no');
                    }
                }
            }

            xhr = new XMLHttpRequest();
            xhr.addEventListener('readystatechange', onStateChange);
            xhr.open('POST', '/image/onsave');
            xhr.send(payload);
        });

    }

});
