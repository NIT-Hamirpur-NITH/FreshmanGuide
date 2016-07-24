
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;

$(document).ready(function(){

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

    // Init Material scripts for buttons ripples, inputs animations etc, more info on the next link https://github.com/FezVrasta/bootstrap-material-design#materialjs
    $.material.init();

    //  Activate the Tooltips
    $('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();

    // Activate Datepicker
    // if($('.datepicker').length != 0){
    //     $('.datepicker').datepicker({
    //          weekStart:1
    //     });
    // }

    // Check if we have the class "navbar-color-on-scroll" then add the function to remove the class "navbar-transparent" so it will transform to a plain color.
    if($('.navbar-color-on-scroll').length != 0){
        $(window).on('scroll', materialKit.checkScrollForTransparentNavbar)
    }

    // Activate Popovers
    $('[data-toggle="popover"]').popover();

    // Active Carousel
	// $('.carousel').carousel({
 //      interval: 400000
 //    });

    // Hide navbar on scroll
    $("nav.navbar-fixed-top").headroom({
        "offset": 50,
        "tolerance": 5,
        "classes": {
            "initial": "animated",
            "pinned": "slideInDown",
            "unpinned": "slideOutUp"
        }
    });

    // add article handler
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
                        message: [
                            '<strong> You article is created </strong> <br>',
                            '<a class="btn btn-success" href="' + url + '" target="_blank"> Edit in new tab </a>',
                            '<a class="btn btn-warning" href="' + url + '"> Edit now </a> <br>',
                            '<strong style="text-align:center"><em> Or </em></strong><br>',
                            '<strong>Saving the following link, to edit anytime</strong> <br>',
                            '<pre>' + url + '</pre>',
                        ].join(' ')
                    });
                }
                notify(text, type);
            })
            .fail(function() {
                notify('Unable to save new title, please forgive!', 'error'); 
            });
          }
        });
    });

    // show all articles handler
    $('#all-articles').animatedModal({
        modalTarget:'articlesModal',
        animatedIn:'zoomIn',
        animatedOut:'zoomOut',
        color: 'rgba(255, 255, 255, 1)',
        // Callbacks
        beforeOpen: function() {
            
        },           
        afterOpen: function() {
            if (!window.articles) {
                setupArticlesNav($('#articlesModal .modal-content'));
            }
        }, 
        beforeClose: function() {
            
        }, 
        afterClose: function() {
            if (!window.articles) {
                $('#articlesModal .modal-content').html('');
            }
        }
    });

    // $('#all-articles').click();

});

function setupArticlesNav() {
    var $tabs = $('ul.nav.nav-tabs');
    var $contents = $('.tab-content'); 
    $tabs.html('Loading...');
    $contents.html('<div class="spinner"> <div class="dot1"></div>  <div class="dot2"></div></div>');
    $.get(window.appURL + '/sections')
    .done(function(data) {
        // $target.html('');
        
        $tabs.html('');
        $contents.html('');
        data.forEach(function(section, index) {


            var $tab = $('<li>').addClass(index ? 0 : 'active');
            var $link = $('<a>').attr('href', '#section-' + section.id).attr('data-toggle', 'tab').text(section.name);
            $tab.append($link);
            $tabs.append($tab);

            var $content = $('<div>').addClass('tab-pane').addClass(index ? 0 : 'active').attr('id', 'section-' + section.id);
            var $list = $('<ul>');
            section.articles.forEach(function(article, index) {
                var $article = $('<li>');
                var color;
                if (index % 3 === 0) {
                    color = 'btn-primary';
                } else if (index % 2 === 0) {
                    color = 'btn-success';
                } else if (index % 1 === 0) {
                    color = 'btn-info';
                }
                var $artLink = $('<a>').attr('href', window.appURL + '/read/' + article.slug).html(article.title).addClass('btn btn-simple ' + color);
                $article.append($artLink);
                $list.append($article);
            });
            $content.append($list);
            $contents.append($content);
        });
        window.articles = true;

    })
    .fail(function() {
        notify('Unable to fetch the list of articles!', 'error'); 
    });
}

materialKit = {
    misc:{
        navbar_menu_visible: 0
    },

    checkScrollForTransparentNavbar: debounce(function() {
            if($(document).scrollTop() > 100 ) {
                if(transparent) {
                    transparent = false;
                    $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                }
            } else {
                if( !transparent ) {
                    transparent = true;
                    $('.navbar-color-on-scroll').addClass('navbar-transparent');
                }
            }
    }, 17),

    initSliders: function(){
        // Sliders for demo purpose
        $('#sliderRegular').noUiSlider({
            start: 40,
            connect: "lower",
            range: {
                min: 0,
                max: 100
            }
        });

        $('#sliderDouble').noUiSlider({
            start: [20, 60] ,
            connect: true,
            range: {
                min: 0,
                max: 100
            }
        });
    }
};


var big_image;

materialKitDemo = {
    checkScrollForParallax: debounce(function(){
        var current_scroll = $(this).scrollTop();

        oVal = ($(window).scrollTop() / 3);
        big_image.css({
            'transform':'translate3d(0,' + oVal +'px,0)',
            '-webkit-transform':'translate3d(0,' + oVal +'px,0)',
            '-ms-transform':'translate3d(0,' + oVal +'px,0)',
            '-o-transform':'translate3d(0,' + oVal +'px,0)'
        });

    }, 6)

};
// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
}


// simple wrapper for noty
function notify(text, type) {
    if (!type)  {
        type = 'info';
    }
    toastr[type](text);
}
