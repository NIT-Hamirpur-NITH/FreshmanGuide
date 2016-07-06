/*
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

	// setup so that csrf token in passed on
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


	// set  up noty
	$.noty.defaults = {
	    layout: 'topRight',
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


	// set up vex
	vex.defaultOptions.className = 'vex-theme-os';


	skel
		.breakpoints({
			desktop: '(min-width: 737px)',
			tablet: '(min-width: 737px) and (max-width: 1200px)',
			mobile: '(max-width: 736px)'
		})
		.viewport({
			breakpoints: {
				tablet: {
					width: 1080
				}
			}
		});

	$(function() {

		var	$window = $(window),
			$body = $('body');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {
				$body.removeClass('is-loading');
			});

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on mobile.
			skel.on('+mobile -mobile', function() {
				$.prioritize(
					'.important\\28 mobile\\29',
					skel.breakpoint('mobile').active
				);
			});

		// CSS polyfills (IE<9).
			if (skel.vars.IEVersion < 9)
				$(':last-child').addClass('last-child');

		// Dropdowns.
			$('#nav > ul').dropotron({
				mode: 'fade',
				noOpenerFade: true,
				hoverDelay: 150,
				hideDelay: 350
			});

		// Off-Canvas Navigation.

			// Title Bar.
				$(
					'<div id="titleBar">' +
						'<a href="#navPanel" class="toggle"></a>' +
					'</div>'
				)
					.appendTo($body);

			// Navigation Panel.
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').navList() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body)
					.panel({
						delay: 500,
						hideOnClick: true,
						hideOnSwipe: true,
						resetScroll: true,
						resetForms: true,
						side: 'left',
						target: $body,
						visibleClass: 'navPanel-visible'
					});

			// Fix: Remove navPanel transitions on WP<10 (poor/buggy performance).
				if (skel.vars.os == 'wp' && skel.vars.osVersion < 10)
					$('#titleBar, #navPanel, #page-wrapper')
						.css('transition', 'none');

	});


	$('#add-article').click(function(event) {
		event.preventDefault();
		console.log('Clicked');

	    vex.dialog.prompt({
	      message: 'Enter new title',
	      placeholder: 'My new and awesome title',
	      callback: function(value) {
	        if (!value) {
	            return notify('No title given, nothing will happen', 'info');
	        }
	        $.post(window.appURL + '/add', {title: value})
	        .done(function(data) {
	            var type = data.success ? 'success' : 'error';
	            var text = data.success ? data.message : data.error;
	            if (data.success) {
	                var url = window.appURL + '/edit/' + data.searchId;
                	vex.dialog.confirm({
                		message: '<a href="' + url + '" target="_blank"> Your article is created, click on this message to open in new tab. Or just click Ok to open in this tab. </a>',
                		callback: function(value) {
                			if (value) {
                				window.location.href = url;
                			}
                		}
                	});
	            }
	            notify(text, type);
	        })
	        .fail(function(xhr) {
	            notify('Unable to save new title, please forgive!', 'error'); 
	        });
	      }
	    });

	    

	});


})(jQuery);

function notify(text, type) {
    if (!type)  {
        type = 'alert';
    }
    noty({
        text: text,
        type: type
    });
}

