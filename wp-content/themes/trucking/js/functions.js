jQuery( document).ready( function($){
    jQuery('[href=#down]').on('click', function(e) {
        e.preventDefault();
        jQuery('html, body').animate({ scrollTop: jQuery(jQuery(this).attr('href')).offset().top}, 500, 'linear');
    });

    //Offcanvas Menu
    $('[data-toggle="offcanvas"], .btn-offcanvas').on('click', function () {
        $('.row-offcanvas').toggleClass('active')           
    });
    $("#main-menu-offcanvas .caret").on('click', function(){
        $("#main-menu-offcanvas .dropdown").removeClass('open');
        $(this).parent().addClass('open');
        return false;
    } );

    //counter up
    if($('.counterUp').length > 0){
        $('.counterUp').counterUp({
            delay: 10,
            time: 800
        });
    }
    // slick
    function init_slick(self) {
        self.each( function(){
            var config = {
                infinite: false,
                arrows: $(this).data( 'nav' ),
                dots: $(this).data( 'pagination' ),
                slidesToShow: 4,
                slidesToScroll: 4
            };
        
            var slick = $(this);
            if( $(this).data('items') ){
                config.slidesToShow = $(this).data( 'items' );
                config.slidesToScroll = $(this).data( 'items' );
            }
            if( $(this).data('slidestoscroll') ){
                config.slidesToScroll = $(this).data( 'slidestoscroll' );
            }
            if( $(this).data('centermode') ){
                config.centerMode = true;
            }
            if( $(this).data('focusonselect') ){
                config.focusOnSelect = true;
            }

            if( $(this).data('infinite') ){
                config.infinite = true;
            }
            if( $(this).data('rows') ){
                config.rows = $(this).data( 'rows' );
            }
            if( $(this).data('asnavfor') ){
                config.asNavFor = $(this).data( 'asnavfor' );
            }
            if ($(this).data('large')) {
                var desktop = $(this).data('large');
            } else {
                var desktop = config.items;
            }
            if ($(this).data('medium')) {
                var medium = $(this).data('medium');
            } else {
                var medium = config.items;
            }
            if ($(this).data('smallmedium')) {
                var smallmedium = $(this).data('smallmedium');
            } else {
                var smallmedium = 2;
            }
            if ($(this).data('extrasmall')) {
                var extrasmall = $(this).data('extrasmall');
            } else {
                var extrasmall = 1;
            }
            config.responsive = [
                {
                    breakpoint: 321,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: extrasmall,
                        slidesToScroll: extrasmall,
                        dots: false
                    }
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: smallmedium,
                        slidesToScroll: smallmedium
                    }
                },
                {
                    breakpoint: 981,
                    settings: {
                        slidesToShow: medium,
                        slidesToScroll: medium
                    }
                },
                {
                    breakpoint: 1501,
                    settings: {
                        slidesToShow: desktop,
                        slidesToScroll: desktop
                    }
                }
            ];
            if ( $('html').attr('dir') == 'rtl' ) {
                config.rtl = true;
            }

            $(this).slick( config );

        } );
    }
    init_slick($("[data-carousel=slick]"));
    
    setTimeout(function(){
        initProductImageLoad();
    }, 500);
    function initProductImageLoad() {
        $(window).off('scroll.unveil resize.unveil lookup.unveil');
        var $images = $('.image-wrapper:not(.image-loaded) .unveil-image'); // Get un-loaded images only
        if ($images.length) {
            var scrollTolerance = 1;
            $images.unveil(scrollTolerance, function() {
                $(this).parents('.image-wrapper').first().addClass('image-loaded');
            });
        }

        var $images = $('.product-image:not(.image-loaded) .unveil-image'); // Get un-loaded images only
        if ($images.length) {
            var scrollTolerance = 1;
            $images.unveil(scrollTolerance, function() {
                $(this).parents('.product-image').first().addClass('image-loaded');
            });
        }
    }
    /*---------------------------------------------- 
     * Play Isotope masonry
     *----------------------------------------------*/  
    jQuery('.isotope-items,.blog-masonry').each(function(){  
        var $container = jQuery(this);
        
        $container.isotope({
            itemSelector : '.isotope-item',
            transformsEnabled: true         // Important for videos
        }); 
    });
    /*---------------------------------------------- 
     *    Apply Filter        
     *----------------------------------------------*/
    jQuery('.isotope-filter li a').on('click', function(){
       
        var parentul = jQuery(this).parents('ul.isotope-filter').data('related-grid');
        jQuery(this).parents('ul.isotope-filter').find('li a').removeClass('active');
        jQuery(this).addClass('active');
        var selector = jQuery(this).attr('data-filter'); 
        jQuery('#'+parentul).isotope({ filter: selector }, function(){ });
        
        return(false);
    });

    //Sticky Header
    setTimeout(function(){
        change_margin_top();
    }, 50);
    $(window).resize(function(){
        change_margin_top();
    });
    function change_margin_top() {
        if ($(window).width() > 991) {
            if ( $('.main-sticky-header').length > 0 ) {
                var header_height = $('.main-sticky-header').outerHeight();
                $('.main-sticky-header-wrapper').css({'height': header_height});
            }
        }
    }
    var main_sticky = $('.main-sticky-header');
    
    if ( main_sticky.length > 0 ){
        var _menu_action = main_sticky.offset().top;
        var Apus_Menu_Fixed = function(){
            "use strict";

            if( $(document).scrollTop() > _menu_action ){
              main_sticky.addClass('sticky-header');
            }else{
              main_sticky.removeClass('sticky-header');
            }
        }
        if ($(window).width() > 991) {
            $(window).scroll(function(event) {
                Apus_Menu_Fixed();
            });
            Apus_Menu_Fixed();
        }
    }

    // calculated
    $('.service .dfield label').on('click', function(e) {
        $('.service .dfield label').removeClass('active');
        $(this).addClass("active");
    });
    $('.service .dfield label input').each(function(){
        if($(this).is(':checked')) {
            $('.service .dfield label').removeClass('active');
            $(this).parent().addClass("active");
        }
    });
    //Tooltip
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $('.topbar-mobile .dropdown-menu').on('click', function(e) {
      	e.stopPropagation();
    });

    var back_to_top = function () {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 400) {
                jQuery('#back-to-top').addClass('active');
            } else {
                jQuery('#back-to-top').removeClass('active');
            }
        });
        jQuery('#back-to-top').on('click', function () {
            jQuery('html, body').animate({scrollTop: '0px'}, 800);
            return false;
        });
    };
    back_to_top();
    
    // popup
    $(document).ready(function() {
        $(".popup-image").magnificPopup({type:'image'});
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        $('.popup-gallery').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    });

    // mobile menu
    // mobile menu
    $('[data-toggle="offcanvas"], .btn-offcanvas').on('click', function (e) {
        e.stopPropagation();
        $('#wrapper-container').toggleClass('active');
        $('#apus-mobile-menu').toggleClass('active');           
    });
    
    $('body').click(function() {
        if ($('#wrapper-container').hasClass('active')) {
            $('#wrapper-container').toggleClass('active');
            $('#apus-mobile-menu').toggleClass('active');
        }
    });
    $('#apus-mobile-menu').click(function(e) {
        e.stopPropagation();
    });

    $("#main-mobile-menu .icon-toggle").on('click', function(){
        $(this).parent().find('.sub-menu').first().slideToggle();
        if ( $(this).find('i').hasClass('fa-angle-right') ) {
            $(this).find('i').removeClass('fa-angle-right').addClass('fa-angle-up');
        } else {
            $(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-right');
        }
        return false;
    } );

    // preload page
    var $body = $('body');
    if ( $body.hasClass('apus-body-loading') ) {

        setTimeout(function() {
            $body.removeClass('apus-body-loading');
            $('.apus-page-loading').fadeOut(250);
        }, 300);
    }

    // full width video
    // Find all YouTube videos
    iframe_full_width();

    function iframe_full_width(){
        var $fluidEl = $(".pro-fluid-inner");
        var $videoEls = $(".pro-fluid-inner iframe");
        $videoEls.each(function() {
            $(this).data('aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');
        });

        $(window).resize(function() {
            $fluidEl.each(function(){
                var newWidth = $(this).width();
                var $videoEl = $(this).find("iframe");
                $videoEl.each(function() {
                    var $el = $(this);
                    $el.width(newWidth).height(newWidth * $el.data('aspectRatio'));
                });
            });
        }).resize();
    }

    // perfect scroll
    $('.widget-categories-tabs .nav-tabs-selector').perfectScrollbar();
    $('.apus-categories-wrapper').perfectScrollbar();
    
    // popup
    if ($('.popuppromotion').length > 0) {
        setTimeout(function(){
            var hiddenmodal = getCookie('hidde_popup_promotion');
            if (hiddenmodal == "") {
                var popup_content = $('.popuppromotion').html();
                $.magnificPopup.open({
                    mainClass: 'apus-mfp-zoom-in popuppromotion-wrapper',
                    modal:true,
                    items    : {
                        src : popup_content,
                        type: 'inline'
                    },
                    callbacks: {
                        close: function() {
                            setCookie('hidde_popup_promotion', 1, 30);
                        }
                    }
                });
            }
        }, 3000);
    }
    if ($('.popupnewsletter').length > 0) {
        setTimeout(function(){
            var hiddenmodal = getCookie('hidde_popup_newsletter');
            if (hiddenmodal == "") {
                var popup_content = $('.popupnewsletter').html();
                $.magnificPopup.open({
                    mainClass: 'apus-mfp-zoom-in popupnewsletter-wrapper',
                    modal:true,
                    items    : {
                        src : popup_content,
                        type: 'inline'
                    },
                    callbacks: {
                        close: function() {
                            setCookie('hidde_popup_newsletter', 1, 30);
                        }
                    }
                });
            }
        }, 3000);
    }
    $('.apus-mfp-close').click(function(){
        magnificPopup.close();
    });
});
/**
* countdown
*/
(function($){
    $.fn.apusCountDown = function( options ) {
        return this.each(function() {
            new $.apusCountDown( this, options ); 
        });
    }
    $.apusCountDown = function( obj, options ) {
        this.options = $.extend({
            autoStart : true,
            LeadingZero:true,
            DisplayFormat:"<div>%%D%% Days</div><div>%%H%% Hours</div><div>%%M%% Minutes</div><div>%%S%% Seconds</div>",
            FinishMessage:"Expired",
            CountActive:true,
            TargetDate:null
        }, options || {} );
        if ( this.options.TargetDate == null || this.options.TargetDate == '' ){
            return ;
        }
        this.timer  = null;
        this.element = obj;
        this.CountStepper = -1;
        this.CountStepper = Math.ceil(this.CountStepper);
        this.SetTimeOutPeriod = (Math.abs(this.CountStepper)-1)*1000 + 990;
        var dthen = new Date(this.options.TargetDate);
        var dnow = new Date();
        if ( this.CountStepper > 0 ) {
            ddiff = new Date(dnow-dthen);
        } else {
            ddiff = new Date(dthen-dnow);
        }
        gsecs = Math.floor(ddiff.valueOf()/1000); 
        this.CountBack(gsecs, this);
    };
    $.apusCountDown.fn = $.apusCountDown.prototype;
    $.apusCountDown.fn.extend = $.apusCountDown.extend = $.extend;
    $.apusCountDown.fn.extend({
        calculateDate:function( secs, num1, num2 ){
            var s = ((Math.floor(secs/num1))%num2).toString();
            if ( this.options.LeadingZero && s.length < 2) {
                s = "0" + s;
            }
            return "<span>" + s + "</span>";
        },
        CountBack:function( secs, self ){
            if (secs < 0) {
                self.element.innerHTML = '<div class="lof-labelexpired"> '+self.options.FinishMessage+"</div>";
                return;
            }
            clearInterval(self.timer);
            DisplayStr = self.options.DisplayFormat.replace(/%%D%%/g, self.calculateDate( secs,86400,100000) );
            DisplayStr = DisplayStr.replace(/%%H%%/g, self.calculateDate(secs,3600,24));
            DisplayStr = DisplayStr.replace(/%%M%%/g, self.calculateDate(secs,60,60));
            DisplayStr = DisplayStr.replace(/%%S%%/g, self.calculateDate(secs,1,60));
            self.element.innerHTML = DisplayStr;
            if (self.options.CountActive) {
                self.timer = null;
                self.timer =  setTimeout( function(){
                    self.CountBack((secs+self.CountStepper),self);          
                },( self.SetTimeOutPeriod ) );
            }
        }
    });

    $(document).ready(function(){
        $('[data-time="timmer"]').each(function(index, el) {
            var $this = $(this);
            var $date = $this.data('date').split("-");
            $this.apusCountDown({
                TargetDate:$date[0]+"/"+$date[1]+"/"+$date[2]+" "+$date[3]+":"+$date[4]+":"+$date[5],
                DisplayFormat:"<div class=\"times\"><div class=\"day\">%%D%% Days </div><div class=\"hours\">%%H%% Hours </div><div class=\"minutes\">%%M%% Mins </div><div class=\"seconds\">%%S%% Sec </div></div>",
                FinishMessage: ""
            });
        });
    });

    // search form
    $('.close-search-form').click(function(){
        $('.full-top-search-form').removeClass('show');
        $('#searchverlay').removeClass('show');
    });
    // full top search
    $('.button-show-search').click(function(){
        $('.full-top-search-form').toggleClass('show');
        $('#searchverlay').toggleClass('show');
    });

    // scroll map
    $('.kc-google-maps').click(function () {
        $('.kc-google-maps iframe').css("pointer-events", "auto");
    });

    $('.main-menu li.dropdown a').click(function() {
        window.location = $(this).attr('href');
    });
})(jQuery)

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}