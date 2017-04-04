var positionElementInPage = 60;
var widthWindow = window.innerWidth;
$(window).scroll(
	function() {
		if (widthWindow < 768)
		{
			if ($(window).scrollTop() > positionElementInPage) {
				// fixed
				$('#menu-test').addClass("floatable");
				$('.navbar-brand').addClass('invisible');
			} else {
				// relative
				$('#menu-test').removeClass("floatable");
				$('.navbar-brand').removeClass('invisible');
			}
		}
	}
);
