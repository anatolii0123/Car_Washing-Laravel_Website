var dateTop, resourceTop;
var $window= $(window);
isIOS = false;
var new_height = screen.height -$('footer>div').outerHeight() - 20;
binded = 0;
$(function(){
	if(navigator.userAgent.toLowerCase().match(/ipod/) ||
		navigator.userAgent.toLowerCase().match(/ipad/) ||
		navigator.userAgent.toLowerCase().match(/iphone/))
		isIOS = true;

	$('#dataFetcher + div').css('height',$('#dataFetcher').outerHeight(true));
	
	dateTop = $('#dataFetcher').offset().top;

	$('#services-collapse').on('shown.bs.collapse hidden.bs.collapse', resourceTopHeight );

	$('#slotChoose').on('append',resourceTopHeight);

	$window.scroll(fixer);
	$('.container').scroll(fixer);

	if(isIOS) {
		$(document).on('focus', 'textarea,input[type="text"],select', function() {
		 $('footer>div').css({
		 	'position': 'absolute',
		 	'top': ($('body').outerHeight() - $('footer>div').height()) + 'px',
			 'bottom': 'initial'
		 });
		 }).on('blur', 'textarea,input,select', function() {
			$('footer>div').css({
		 		'position': 'fixed',
		 		'top': 'initial',
		 		'bottom': 0
			});
		 });
	}

	/*if(isIOS) {
		new_height -= dataFetch.outerHeight();
		$('body>.container').css('height', new_height + 'px');
	}*/
});

function fixer(e){
	var scrollTop = $window.scrollTop() > 0 ? $window.scrollTop() : $('.container').scrollTop();
	var width = $window.width();

	var dataFetch = $('#dataFetcher');
	if(scrollTop>=dateTop) {
		dataFetch.addClass('fixed');
		if(isIOS && binded == 0 && window.location.hash == '#step1') {
			$('body').append(dataFetch);
			$('#dataFetcherHolder #dataFetcher').remove();
			binded = 1;
		}
	}else {
		dataFetch.removeClass('fixed');
		if(isIOS && binded == 1) {
			$('#dataFetcherHolder').prepend(dataFetch);
			$('body>#dataFetcher').remove();
			binded = 0;
		}
	}

	var slotChoose = $('#slotChoose');
	if( (scrollTop + 75) >=resourceTop) {
		slotChoose.addClass('fixed');
		/*if(isIOS || true) {
			$('body').append(slotChoose);
			$('#slotChoose .resourceHolder').remove();

			//content size fix
			if(binded == 0) {
				//removeIOSScrollable($('body>.container'));
				//addIOSScrollable($('.slotChoose .day, .dataHolder .time + div'));
				binded = 1;
			}
		}*/
	}else {
		slotChoose.removeClass('fixed');
		/*if(isIOS || true) {
			$('.slotChoose > .day').append(slotChoose);
			$('body>.resourceHolder').remove();

			//content size fix
			if(binded == 1) {
				addIOSScrollable($('body>.container'));
				removeIOSScrollable($('.dataHolder .time, .dataHolder .time + div'));
				binded = 0;
			}
		}*/
	}
}

function addIOSScrollable(_elem) {
	_elem.css({
		'height': new_height + 'px',
		'overflow': 'scroll',
		'-webkit-overflow-scrolling': 'touch'
	});
	_elem.scroll(fixer);
}
function removeIOSScrollable(_elem) {
	_elem.removeAttr('style');
	_elem.unbind('scroll');
}

function resourceTopHeight() {
		resourceTop = $('#slotChoose').offset().top;
		$('#slotChoose .resourceHolder + div').css('height',$('.resourceHolder').outerHeight());
}