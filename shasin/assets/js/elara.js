'use strict';

var $ = window.jQuery;

//ON DOCUMENT READY
$(document).ready(function() {
	/* Home Slider */
	$('.slick-carousel').slick({
		speed: 1000,
		dots: false,
		arrows: true,
		slidesToShow: 1,
		autoplay: false,
		infinite: true,
		fade: true,
		accessibility: false,
		prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class="fa fa-caret-left"></i></button>',
		nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="fa fa-caret-right"></i></button>',
	});

	/* Stop playing video once Bootstrap's modal is closed */
	$( '.elara-modal-video' ).on( 'hidden.bs.modal', function () {
		$( '.elara-modal-video iframe' ).attr( 'src', $( '.elara-modal-video iframe' ).attr( 'src' ) );
	});

	$('.header-toggle').click(function(){
		$(this).toggleClass('open');
		$('.widget-area-header').slideToggle();
		return false;
	});

	/* Initialize Match Height plugin */
	$('.matcheight').matchHeight();

}); //end of document ready
