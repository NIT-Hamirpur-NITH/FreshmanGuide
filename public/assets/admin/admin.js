'use strict';

function notify(text, type) {
    if (!type)  {
        type = 'info';
    }
    toastr[type](text);
}

function handleAction(url, method, data, cb, fmessage) {
    var params = {
        url: url,
        method: method,
        data: data,
    };

    $.ajax(params)
    .done(function(data) {
        var type = data.success ? 'success' : 'error';
        var text = data.success ? data.message : data.error;
        notify(text, type);
        if (data.success) {
            cb();
        }
    })
    .fail(function(xhr) {
        notify(fmessage, 'error');
        console.log(xhr.reposneText);
    });

}

$(function() {


    // setup so that csrf token in passed on
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // set  up toastr
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    // set up vex
    vex.defaultOptions.className = 'vex-theme-top';


    $('#articles-table').on('draw.dt', function () {
        $('.delete').click(function(event) {
            event.preventDefault();
            var $element = $(this);
            console.log($element.attr('data-title'), $element.attr('data-id'));
            vex.dialog.confirm({
                message: 'Are you sure, you want to delete the article <strong>' + $element.attr('data-title') + '</strong> ?',
                callback: function(value) {
                    if (value) {
                        handleAction($element.attr('href'), 'GET', null, function() {
                            window.table.draw('page');
                        }, 'Unable to delte ' + $element.attr('title'));    
                    } else {
                        notify('Nothing will happen', 'info');
                    }
                }
            });
        });

        $('.publish').click(function(event) {
            event.preventDefault();
            var $element = $(this);
            handleAction($element.attr('href'), 'GET', null, function() {
                window.table.draw('page');
            }, 'Unable to publish ' + $element.attr('title'));    
        });

        $('.unpublish').click(function(event) {
            event.preventDefault();
            var $element = $(this);
            handleAction($element.attr('href'), 'GET', null, function() {
                window.table.draw('page');
            }, 'Unable to unpublish ' + $element.attr('title'));    
        });


        $('.change-section').click(function(event) {
            event.preventDefault();
            var cloned = $(this).clone(true);
            var url = $(this).attr('href');
            var $td = $(this).parent('td');
            var span = $td.find('span');
            var select = $('<select>');
            console.log(window.sections);
            window.sections.forEach(function(section) {
                select.append($('<option>').attr('value', section.id).text(section.name));
            });
            var save = $('<button>').addClass('btn btn-success btn-sm').html('<i class="fa fa-check"></i>');
            var cancel = $('<button>').addClass('btn btn-danger btn-sm').html('<i class="fa fa-close"></i>');
            save.click(function(event) {
                console.log(select.val());
                handleAction(url, 'POST', { section: select.val() }, function() {
                    window.table.draw('page');
                }, 'Unable to change section ' + $(this).attr('title'));
            });
            cancel.click(function() {
                $td.html(span).append(cloned);
            });
            $td.html(select);
            $td.append(save);
            $td.append(cancel);

        });

    });
    


});