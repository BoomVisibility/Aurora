jQuery(function($) {
$(document).ready(function(){
  $('.bxslider').bxSlider({
	  controls: false,
    pager: false,
	  auto: false,
	  mode: 'fade',
	  pause: 7000,
	  adaptiveHeight: false
  });
  $('a[href$=".pdf"]').each(function() {
    $(this).prop('target', '_blank');
  });
  $('.entry-content a[href$=".pdf"]').each(function() {
    $(this).addClass('pdf');
  });
  $('#menu-primary-menu').slicknav({
		label: '',
		duration: 300,
		allowParentLinks: true,
		closedSymbol: '&#43;',
    openedSymbol: '&#8722;',
	  prependTo:'.mobile-menu'
	});


  	//ACCORDION
  	$(".accordion h3, .accordion h2").addClass("accordion-btn");
  		$(".accordion-btn").each(function(){
  		$(this).nextUntil('.accordion-btn').add().wrapAll('<div class="accordion-content" style="display: none">');
  	});
  	$(".accordion-btn").on("click", function(){
  		if($(this).hasClass("active")){
  			$(this).removeClass("active").next().slideUp();
  		}else{
  			$(".accordion-btn").removeClass("active").next().slideUp();
  			$(this).addClass("active").next().slideDown();
  		}
  	});

  window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
  $('.appointment a').on('click', function(){
  		gtag('event', 'Appointment', { 'event_category' : 'Appointment', 'event_action' : 'Appointment'});
  		return true;
  });
});

$(function() {
var altura = $(window).height();
var ventura = $(window).width();
if (ventura >= 1025) {
function alturaMaxima() {
  if (altura <= 768) {
    $("body .slideshow .bx-viewport").css('height', altura-200 + 'px');
    $("body .slideshow .slide").css('height', altura-200 + 'px');
    $("body .slideshow .slider-content").css('height', altura-200 + 'px');
      }
    }
  if (altura <= 768) {
    alturaMaxima();
  }
  $(window).on('resize', function() {
    alturaMaxima();
  });
}
});

$(function() {
    //caches a jQuery object containing the header element
    var header = $(".global");
    var offer = $(".offer-bar");
    var entryhead = $(".entry-header");
    var total = (header.height() + offer.height() + entryhead.height());
    var alturahead = header.height();
    var ventura = $(window).width();
    var reset = false;
    if (ventura >= 1025) {
      $(window).on('scroll', function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            header.removeClass('larger').addClass("smaller");
            $("#secondary").css('top', '56px');
            $("body.logged-in #secondary").css('top', '88px');
        } else {
            header.removeClass("smaller").addClass('larger');
            $("#secondary").css('top', total-46 + 'px');
            $("body.logged-in #secondary").css('top', total-14 + 'px');
        }
      });
    }
  });
});

jQuery(function($) {
$(function()
    {
            overlayOn = function()
            {
                $( '<div id="imagelightbox-overlay"></div>' ).appendTo( 'body' );
            },
            overlayOff = function()
            {
                $( '#imagelightbox-overlay' ).remove();
            },
            // ARROWS
            arrowsOn = function( instance, selector )
            {
            var $arrows = $( '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>' );

                $arrows.appendTo( 'body' );

                $arrows.on( 'click touchend', function( e )
                {
                    e.preventDefault();

                    var $this   = $( this ),
                        $target = $( selector + '[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"]' ),
                        index   = $target.index( selector );

                    if( $this.hasClass( 'imagelightbox-arrow-left' ) )
                    {
                        index = index - 1;
                        if( !$( selector ).eq( index ).length )
                            index = $( selector ).length;
                    }
                    else
                    {
                        index = index + 1;
                        if( !$( selector ).eq( index ).length )
                            index = 0;
                    }

                    instance.switchImageLightbox( index );
                    return false;
                });
            },
            arrowsOff = function()
            {
                $( '.imagelightbox-arrow' ).remove();
            },
            // CAPTION
            captionOn = function()
            {
                var description = $( 'a[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"] img' ).attr( 'alt' );
                if( description.length > 0 )
                    $( '<div id="imagelightbox-caption">' + description + '</div>' ).appendTo( 'body' );
            },
            captionOff = function()
            {
                $( '#imagelightbox-caption' ).remove();
            };
        });
var selector = 'a[data-imagelightbox="f"]';
var instance = $( selector ).imageLightbox(
{
    selector:       'id="imagelightbox"',   // string
    allowedTypes:   'png|jpg|jpeg|gif',     // string;
    animationSpeed: 250,                    // integer;
    preloadNext:    true,                   // bool;            silently preload the next image
    enableKeyboard: true,                   // bool;            enable keyboard shortcuts (arrows Left/Right and Esc)
    quitOnEnd:      false,                  // bool;            quit after viewing the last image
    quitOnImgClick: false,                  // bool;            quit when the viewed image is clicked
    quitOnDocClick: true,                   // bool;            quit when anything but the viewed image is clicked
    onStart:        function(){ arrowsOn( instance, selector ); overlayOn(); },
    onEnd:          function(){ arrowsOff(); overlayOff(); captionOff(); },
    onLoadStart:    function(){ captionOff();  },
    onLoadEnd:      function(){ captionOn();  $( '.imagelightbox-arrow' ).css( 'display', 'block' );  }
});
});
