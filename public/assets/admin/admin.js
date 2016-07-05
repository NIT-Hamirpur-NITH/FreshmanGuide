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

    $.noty.defaults.theme = 'relax';
    $.noty.defaults.timeout = 2000;
    $.noty.defaults.layout = 'topRight';


    $('#articles').bootstrapTable({
        url: window.appURL + '/admin/articles',
        responseHandler: function _response_handler(res) {
            if (res.success) {
                console.log(res);
                return res.data;
            } else {
                console.log(res.error);
                return [];
            }
        },
        columns: [{
            field: 'id',
            title: 'ID',
        }, {
            field: 'title',
            title: 'Title',
        }, {
            field: 'status',
            title: 'Status',
            formatter: function _status_formatter(value) {
                return '<span class="label label-primary">' + value + '</span>';
            }
        }, {
            title: 'Actions',
            formatter: function _action_formatter(value, row) {
                return [
                    '<a class="edit ml10" href="' +  window.appURL + '/edit/' + row.searchid + '" title="Edit" target="_blank">',
                    '<i class="glyphicon glyphicon-edit"></i>',
                    '</a>',
                    '<a class="read ml10" href="' +  window.appURL + '/read/' + row.slug + '" title="Read" target="_blank">',
                    '<i class="glyphicon glyphicon-blackboard"></i>',
                    '</a>',
                    '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
                    '<i class="glyphicon glyphicon-remove"></i>',
                    '</a>'
                ].join('');
            },
            events: {
                'click .remove' : function _action_reomve_events(event, value, row) {
                    handleAction(window.appURL + '/admin/delete/' + row.searchid, 'GET', null, function() {
                        $('#articles').bootstrapTable('remove', {
                            field: 'searchid',
                            values: [row.searchid],
                        });
                    }, 'Unable to delete the article');
                },
            }
        }, {
            field: 'published',
            title: 'Published',
            formatter: function _published_formatter(value) {
                if (value) {
                    return [
                        '<a class="unpublish btn btn-warning btn-sm ml10" href="javascript:void(0)" title="Edit" target="_blank">',
                        'Unpublish',
                        '</a>'
                    ].join('');
                } else {
                    return [
                        '<a class="publish btn btn-success btn-sm ml10" href="javascript:void(0)" title="Edit" target="_blank">',
                        'Publish',
                        '</a>'
                    ].join('');
                }
            },
            events: {
                'click .unpublish' : function _action_unpublish(event, value, row, index) {
                    handleAction(window.appURL + '/admin/unpublish/' + row.searchid, 'GET', null, function() {
                        row.published = false;
                        $('#articles').bootstrapTable('updateRow', {
                            index: index,
                            row: row,
                        });
                    }, 'Unable to unpublish the article');
                },
                'click .publish' : function _action_publish(event, value, row, index) {
                    handleAction(window.appURL + '/admin/publish/' + row.searchid, 'GET', null, function() {
                        row.published = true;
                        $('#articles').bootstrapTable('updateRow', {
                            index: index,
                            row: row,
                        });
                    }, 'Unable to publish the article');
                }
            }
        }]
    });

});