/**
 * ------------------------------------------------------------------------
 * JA VMProducts Module
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */
 //equalHeight
;(function ($) {
	$.fn.vmequalHeight = function (options){

		//only set min-height if we have more than 1 element
		if(this.length > 1 || (options && options.force)){
			
			var tallest = 0;
			this.each(function() {

				var height = $(this).css({height: '', 'min-height': ''}).height();

				if(height > tallest) {
					tallest = height;
				}
			});

			this.each(function() {
				$(this).css('min-height', tallest);
			});
		}

		return this;
	}
})(jQuery);

(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

(function($){
	// Get browser scrollbar width
	var scrollbarWidth = (function () { 
	    var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>'); 
	    // Append our div, do our calculation and then remove it 
	    $('body').append(div); 
	    var w1 = $('div', div).innerWidth(); 
	    div.css('overflow-y', 'scroll'); 
	    var w2 = $('div', div).innerWidth(); 
	    $(div).remove(); 
	    return (w1 - w2); 
	})();
	
	var detect_layout = function () {
	    var devices = {
	      wide: 1200,
	      normal:    980,
	      xtablet:  768,
	      tablet:  600,
	      mobile:  0
	    };
	    var width = $(window).width() + scrollbarWidth;
	    for (var device in devices) {
	      if (width >= devices[device]) return device;
	    }
    }
	
	javm_slide = function(modules_id,display_items,autoplay,circular,display_items_mobile,display_items_tablet,navigation){

		// first get the original window dimens (thanks alot IE)
		var windowWidth = $(window).width();
		var windowHeight = $(window).height();
		
		//Check table
		var layoutcheck = function(){
			switch(detect_layout()){
				case 'mobile':
					var items = display_items_mobile;
					break;
				case 'tablet':
				case 'xtablet':
					var items = display_items_tablet;
					break;	
				case 'wide':
				case 'normal':
				default:
					var items = display_items;
				  break;
			}
			return items;
		}

		var javmSlider = $("#javm_slide"+modules_id),
			javmSlide = javmSlider.find('.slide');

		javmSlide.css('min-height', '');
if (javmSlider.size()) {
		var loadSlider = javmSlider.bxSlider({
			slideWidth : javmSlider.css('width', '').width()/layoutcheck(),
			maxSlides  : layoutcheck(),
			slideSelector : javmSlide,
			pager : false,
			controls:navigation,
			onSliderLoad : function(){
				javmSlide.vmequalHeight();
			},
			hideControlOnEnd : true,
			infiniteLoop:circular,
			auto : autoplay,
			speed :1000,
			touchEnabled: false,
            useCSS:false
		});



		$(window).smartresize(function(){
			// get the new window dimens (again, thank you IE)
			var windowWidthNew = $(window).width();
			var windowHeightNew = $(window).height();
			
			if(windowWidth != windowWidthNew){
				windowWidth = windowWidthNew;
				windowHeight = windowHeightNew;
				
				javmSlider.closest('.bx-wrapper').css('max-width', '');
				javmSlide.css('min-height', '');

				loadSlider.reloadSlider({
					slideWidth : javmSlider.css('width', '').width()/layoutcheck(),
				    maxSlides  : layoutcheck(),
				    slideSelector : javmSlide,
				    startSlide : loadSlider.getCurrentSlide(),
				    pager : false,
				    controls:navigation,
				    onSliderLoad : function(){
						javmSlide.vmequalHeight();
					},				    
				    hideControlOnEnd : true,
				    infiniteLoop:circular,
				    auto : autoplay,
				    speed :1000,
				    touchEnabled: false,
                    useCSS:false
				});
				
				setTimeout(function(){
					loadSlider.redrawSlider();
					javmSlide.vmequalHeight();
				}, 501);	
			}
		});
	}
}	
})(jQuery);