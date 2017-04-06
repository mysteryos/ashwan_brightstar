
/*
* Layout
*/

(function(){
    //Get saved layout type from LocalStorage
    var layoutStatus = localStorage.getItem('ma-layout-status');
    if (layoutStatus == 1) {
        $('body').addClass('sw-toggled');
        $('#tw-switch').prop('checked', true);
    }

    $('body').on('change', '#toggle-width input:checkbox', function(){
        if ($(this).is(':checked')) {
            setTimeout(function(){
                $('body').addClass('toggled sw-toggled');
                localStorage.setItem('ma-layout-status', 1);
            }, 250);
        }
        else {
            setTimeout(function(){
                $('body').removeClass('toggled sw-toggled');
                localStorage.setItem('ma-layout-status', 0);
                $('.main-menu > li').removeClass('animated');
            }, 250);
        }
    });

})();


/*
 * Detact Mobile Browser
 */
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
   $('html').addClass('ismobile');
}

$(document).ready(function(){
    /*
     * Ajax CSRF Setup
     */

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*
     * Top Search
     */
    (function(){
        $('body').on('click', '#top-search > a', function(e){
            e.preventDefault();

            $('#header').addClass('search-toggled');
            $('#top-search-wrap input').focus();
        });

        $('body').on('click', '#top-search-close', function(e){
            e.preventDefault();

            $('#header').removeClass('search-toggled');
        });
    })();

    /*
     * Sidebar
     */
    (function(){
        //Toggle
        $('body').on('click', '#menu-trigger, #chat-trigger', function(e){
            e.preventDefault();
            var x = $(this).data('trigger');

            $(x).toggleClass('toggled');
            $(this).toggleClass('open');
            $('body').toggleClass('modal-open');

    	    //Close opened sub-menus
    	    $('.sub-menu.toggled').not('.active').each(function(){
        		$(this).removeClass('toggled');
        		$(this).find('ul').hide();
    	    });

	        $('.profile-menu .main-menu').hide();

            if (x == '#sidebar') {

                $elem = '#sidebar';
                $elem2 = '#menu-trigger';

                $('#chat-trigger').removeClass('open');

                if (!$('#chat').hasClass('toggled')) {
                    $('#header').toggleClass('sidebar-toggled');
                }
                else {
                    $('#chat').removeClass('toggled');
                }
            }

            if (x == '#chat') {
                $elem = '#chat';
                $elem2 = '#chat-trigger';

                $('#menu-trigger').removeClass('open');

                if (!$('#sidebar').hasClass('toggled')) {
                    $('#header').toggleClass('sidebar-toggled');
                }
                else {
                    $('#sidebar').removeClass('toggled');
                }
            }

            //When clicking outside
            if ($('#header').hasClass('sidebar-toggled')) {
                $(document).on('click', function (e) {
                    if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                        setTimeout(function(){
                            $('body').removeClass('modal-open');
                            $($elem).removeClass('toggled');
                            $('#header').removeClass('sidebar-toggled');
                            $($elem2).removeClass('open');
                        });
                    }
                });
            }
        });

        //Hammer js present, register touch events
        if(typeof Hammer !== 'undefined') {
            $('html').hammer().on('swiperight',function(e){
                var endPoint = e.gesture.pointers[0].pageX;
                var distance = e.gesture.distance;
                var origin = endPoint - distance;

                if (origin <= 15) {
                    // They swiped, starting from no more than 15px away from the edge.
                    e.preventDefault();
                    var x = $(this).data('trigger');

                    $('#sidebar').toggleClass('toggled');
                    $('#menu-trigger').toggleClass('open');
                    $('body').toggleClass('modal-open');

                    //Close opened sub-menus
                    $('.sub-menu.toggled').not('.active').each(function(){
                        $(this).removeClass('toggled');
                        $(this).find('ul').hide();
                    });

                    $('.profile-menu .main-menu').hide();

                    $elem = '#sidebar';
                    $elem2 = '#menu-trigger';

                    $('#chat-trigger').removeClass('open');

                    if (!$('#chat').hasClass('toggled')) {
                        $('#header').toggleClass('sidebar-toggled');
                    }
                    else {
                        $('#chat').removeClass('toggled');
                    }

                    //When clicking outside
                    if ($('#header').hasClass('sidebar-toggled')) {
                        $(document).on('click', function (e) {
                            if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                                setTimeout(function(){
                                    $('body').removeClass('modal-open');
                                    $($elem).removeClass('toggled');
                                    $('#header').removeClass('sidebar-toggled');
                                    $($elem2).removeClass('open');
                                });
                            }
                        });

                        $('html').hammer().on('swipeleft', function(e) {
                            if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                                setTimeout(function(){
                                    $('body').removeClass('modal-open');
                                    $($elem).removeClass('toggled');
                                    $('#header').removeClass('sidebar-toggled');
                                    $($elem2).removeClass('open');
                                });
                            }
                        });
                    }
                }
            });
        }

        //Submenu
        $('body').on('click', '.sub-menu > a', function(e){
            e.preventDefault();
            $(this).next().slideToggle(200);
            $(this).parent().toggleClass('toggled');
        });
    })();

    /*
     * Clear Notification
     */
    $('body').on('click', '[data-clear="notification"]', function(e){
      e.preventDefault();

      var x = $(this).closest('.listview');
      var y = x.find('.lv-item');
      var z = y.size();

      $(this).parent().fadeOut();

      x.find('.list-group').prepend('<i class="grid-loading hide-it"></i>');
      x.find('.grid-loading').fadeIn(1500);


      var w = 0;
      y.each(function(){
          var z = $(this);
          setTimeout(function(){
          z.addClass('animated fadeOutRightBig').delay(1000).queue(function(){
              z.remove();
          });
          }, w+=150);
      })

	//Popup empty message
	setTimeout(function(){
	    $('#notifications').addClass('empty');
	}, (z*150)+200);
    });

    /*
     * Dropdown Menu
     */
    if($('.dropdown')[0]) {
	//Propagate
	$('body').on('click', '.dropdown.open .dropdown-menu', function(e){
	    e.stopPropagation();
	});

	$('.dropdown').on('shown.bs.dropdown', function (e) {
	    if($(this).attr('data-animation')) {
		$animArray = [];
		$animation = $(this).data('animation');
		$animArray = $animation.split(',');
		$animationIn = 'animated '+$animArray[0];
		$animationOut = 'animated '+ $animArray[1];
		$animationDuration = ''
		if(!$animArray[2]) {
		    $animationDuration = 500; //if duration is not defined, default is set to 500ms
		}
		else {
		    $animationDuration = $animArray[2];
		}

		$(this).find('.dropdown-menu').removeClass($animationOut)
		$(this).find('.dropdown-menu').addClass($animationIn);
	    }
	});

	$('.dropdown').on('hide.bs.dropdown', function (e) {
	    if($(this).attr('data-animation')) {
    		e.preventDefault();
    		$this = $(this);
    		$dropdownMenu = $this.find('.dropdown-menu');

    		$dropdownMenu.addClass($animationOut);
    		setTimeout(function(){
    		    $this.removeClass('open')

    		}, $animationDuration);
    	    }
    	});
    }

    /*
     * Auto Hight Textarea
     */
    if ($('.auto-size')[0]) {
	   autosize($('.auto-size'));
    }


    /*
    * Profile Menu
    */
    $('body').on('click', '.profile-menu > a', function(e){
        e.preventDefault();
        $(this).parent().toggleClass('toggled');
	    $(this).next().slideToggle(200);
    });

    /*
     * Text Feild
     */

    //Add blue animated border and remove with condition when focus and blur
    if($('.fg-line')[0]) {
        $('body').on('focus', '.form-control', function(){
            $(this).closest('.fg-line').addClass('fg-toggled');
        })

        $('body').on('blur', '.form-control', function(){
            var p = $(this).closest('.form-group');
            var i = p.find('.form-control').val();

            if (p.hasClass('fg-float')) {
                if (i.length == 0) {
                    $(this).closest('.fg-line').removeClass('fg-toggled');
                }
            }
            else {
                $(this).closest('.fg-line').removeClass('fg-toggled');
            }
        });
    }

    //Add blue border for pre-valued fg-flot text feilds
    if($('.fg-float')[0]) {
        $('.fg-float .form-control').each(function(){
            var i = $(this).val();

            if (!i.length == 0) {
                $(this).closest('.fg-line').addClass('fg-toggled');
            }

        });
    }

    /*
     * Audio and Video
     */
    if($('audio, video')[0]) {
        $('video,audio').mediaelementplayer();
    }

    /*
     * Input Slider
     */
    //Basic
    if($('.input-slider')[0]) {
        $('.input-slider').each(function(){
            var isStart = $(this).data('is-start');

            $(this).noUiSlider({
                start: isStart,
                range: {
                    'min': 0,
                    'max': 100
                }
            });
        });
    }

    //Range slider
    if($('.input-slider-range')[0]) {
	$('.input-slider-range').noUiSlider({
	    start: [30, 60],
	    range: {
		    'min': 0,
		    'max': 100
	    },
	    connect: true
	});
    }

    //Range slider with value
    if($('.input-slider-values')[0]) {
	$('.input-slider-values').noUiSlider({
	    start: [ 45, 80 ],
	    connect: true,
	    direction: 'rtl',
	    behaviour: 'tap-drag',
	    range: {
		    'min': 0,
		    'max': 100
	    }
	});

	$('.input-slider-values').Link('lower').to($('#value-lower'));
        $('.input-slider-values').Link('upper').to($('#value-upper'), 'html');
    }

	//Save
	$('body').on('click', '.hec-save', function(){
	    $('.html-editor-click').code();
            $('.html-editor-click').destroy();
            $('.hec-save').hide();
            notify('Content Saved Successfully!', 'success');
    });

    //Air Mode
    if($('.html-editor-airmod')[0]) {
        $('.html-editor-airmod').summernote({
            airMode: true
        });
    }

    /*
     * Date Time Picker
     */

    //Date Time Picker
    if ($('.date-time-picker')[0]) {
	   $('.date-time-picker').datetimepicker();
    }

    //Time
    if ($('.time-picker')[0]) {
    	$('.time-picker').datetimepicker({
    	    format: 'LT'
    	});
    }

    //Date
    if ($('.date-picker')[0]) {
    	$('.date-picker').datetimepicker({
    	    format: 'YYYY/MM/DD'
    	});
    }

    /*
     * Bootstrap Growl - Notifications popups
     */
    function notify(message, type){
        $.growl({
            message: message
        },{
            type: type,
            allow_dismiss: false,
            label: 'Cancel',
            className: 'btn-xs btn-inverse',
            placement: {
                from: 'top',
                align: 'right'
            },
            delay: 2500,
            animate: {
                    enter: 'animated bounceIn',
                    exit: 'animated bounceOut'
            },
            offset: {
                x: 20,
                y: 85
            }
        });
    }

    /*
     * Waves Animation
     */
    (function(){
         Waves.attach('.btn:not(.btn-icon):not(.btn-float)');
         Waves.attach('.btn-icon, .btn-float', ['waves-circle', 'waves-float']);
        Waves.init();
    })();

    /*
     * Link prevent
     */
    $('body').on('click', '.a-prevent', function(e){
        e.preventDefault();
    });

    /*
     * Collaspe Fix
     */
    if ($('.collapse')[0]) {

        //Add active class for opened items
        $('.collapse').on('show.bs.collapse', function (e) {
            $(this).closest('.panel').find('.panel-heading').addClass('active');
        });

        $('.collapse').on('hide.bs.collapse', function (e) {
            $(this).closest('.panel').find('.panel-heading').removeClass('active');
        });

        //Add active class for pre opened items
        $('.collapse.in').each(function(){
            $(this).closest('.panel').find('.panel-heading').addClass('active');
        });
    }

    /*
     * Tooltips
     */
    if ($('[data-toggle="tooltip"]')[0]) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    /*
     * Popover
     */
    if ($('[data-toggle="popover"]')[0]) {
        $('[data-toggle="popover"]').popover();
    }

    /*
     * Message
     */

    //Actions
    if ($('.on-select')[0]) {
        var checkboxes = '.lv-avatar-content input:checkbox';
        var actions = $('.on-select').closest('.lv-actions');

        $('body').on('click', checkboxes, function() {
            if ($(checkboxes+':checked')[0]) {
                actions.addClass('toggled');
            }
            else {
                actions.removeClass('toggled');
            }
        });
    }

    if($('#ms-menu-trigger')[0]) {
        $('body').on('click', '#ms-menu-trigger', function(e){
            e.preventDefault();
            $(this).toggleClass('open');
            $('.ms-menu').toggleClass('toggled');
        });
    }

    /*
     * Fullscreen Browsing
     */
    if ($('[data-action="fullscreen"]')[0]) {
        var fs = $("[data-action='fullscreen']");
        fs.on('click', function(e) {
            e.preventDefault();

            //Launch
            function launchIntoFullscreen(element) {

            if(element.requestFullscreen) {
                element.requestFullscreen();
            } else if(element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if(element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if(element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
            }

            //Exit
            function exitFullscreen() {

            if(document.exitFullscreen) {
                document.exitFullscreen();
            } else if(document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if(document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
            }

            launchIntoFullscreen(document.documentElement);
            fs.closest('.dropdown').removeClass('open');
        });
    }

    /*
     * Clear Local Storage
     */
    if ($('[data-action="clear-localstorage"]')[0]) {
        var cls = $('[data-action="clear-localstorage"]');

        cls.on('click', function(e) {
            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "All your saved localStorage values will be removed",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function(){
                localStorage.clear();
                swal("Done!", "localStorage is cleared", "success");
            });
        });
    }

    /*
     * IE 9 Placeholder
     */
    if($('html').hasClass('ie9')) {
        $('input, textarea').placeholder({
            customClass: 'ie9-placeholder'
        });
    }


    /*
     * Listview Search
     */
    if ($('.lvh-search-trigger')[0]) {


        $('body').on('click', '.lvh-search-trigger', function(e){
            e.preventDefault();
            x = $(this).closest('.lv-header-alt').find('.lvh-search');

            x.fadeIn(300);
            x.find('.lvhs-input').focus();
        });

        //Close Search
        $('body').on('click', '.lvh-search-close', function(){
            x.fadeOut(300);
            setTimeout(function(){
                x.find('.lvhs-input').val('');
            }, 350);
        })
    }


    /*
     * Print
     */
    if ($('[data-action="print"]')[0]) {
        $('body').on('click', '[data-action="print"]', function(e){
            e.preventDefault();

            window.print();
        })
    }

    /*
    *  PMB Blocks
     */

    $('body').on('click', '[data-pmb-action]', function(e){
        e.preventDefault();
        var d = $(this).data('pmb-action');

        if (d === "edit") {
            $(this).closest('.pmb-block').toggleClass('toggled');
        }

        if (d === "reset") {
            $(this).closest('.pmb-block').removeClass('toggled');
        }
    });

    $('body').on('click','.pmb-action-delete',function(e){
        e.preventDefault();
        var $this = $(this);
        //Call Sweet alert
        swal({
            title: $this.attr('data-confirmation-message'),
            text: "This action is irreversible.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(){
            $.ajax({
                type:"DELETE",
                url: $this.attr('href'),
                success:function(msg){
                    swal("Done!", msg, "success");
                    $this.closest('.pmb-block').slideUp(400,function(){
                        $(this).remove();
                    });
                },
                error: function(xhr){
                    swal("Error!", xhr.responseText, "error")
                }
            });
        });
    })
});