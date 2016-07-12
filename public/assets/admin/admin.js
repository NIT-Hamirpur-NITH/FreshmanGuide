'use strict';

function notify(text, type, stick) {

    var timeout = stick ? false : 3000;
    noty({
        text: text, 
        type: type,
        timeout: timeout,
    });

}

function handleAction(url, method, data, cb, fmessage) {
    var params = {
        url: url,
        method: method,
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

    $('#articles-table').on( 'draw.dt', function () {
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
                        notify('Nothing will happen', 'default');
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

    });

    $.noty.defaults.theme = 'relax';
    $.noty.defaults.timeout = 2000;
    $.noty.defaults.layout = 'topRight';

    vex.defaultOptions.className = 'vex-theme-os';

    

});