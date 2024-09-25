var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init && self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
  let window = _____WB$wombat$assign$function_____("window");
  let self = _____WB$wombat$assign$function_____("self");
  let document = _____WB$wombat$assign$function_____("document");
  let location = _____WB$wombat$assign$function_____("location");
  let top = _____WB$wombat$assign$function_____("top");
  let parent = _____WB$wombat$assign$function_____("parent");
  let frames = _____WB$wombat$assign$function_____("frames");
  let opener = _____WB$wombat$assign$function_____("opener");

/*

 * debouncedresize: special jQuery event that happens once after a window resize

 *

 * latest version and complete README available on Github:

 * https://github.com/louisremi/jquery-smartresize

 *

 * Copyright 2012 @louis_remi

 * Licensed under the MIT license.

 *

 * This saved you an hour of work? 

 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON

 */

(function($) {



var $event = $.event,

	$special,

	resizeTimeout;



$special = $event.special.debouncedresize = {

	setup: function() {

		$( this ).on( "resize", $special.handler );

	},

	teardown: function() {

		$( this ).off( "resize", $special.handler );

	},

	handler: function( event, execAsap ) {

		// Save the context

		var context = this,

			args = arguments,

			dispatch = function() {

				// set correct event type

				event.type = "debouncedresize";

				$event.dispatch.apply( context, args );

			};



		if ( resizeTimeout ) {

			clearTimeout( resizeTimeout );

		}



		execAsap ?

			dispatch() :

			resizeTimeout = setTimeout( dispatch, $special.threshold );

	},

	threshold: 150

};



})(jQuery);

}
/*
     FILE ARCHIVED ON 06:17:57 Mar 11, 2022 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 09:46:38 Jun 07, 2022.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 82.939
  exclusion.robots: 0.079
  exclusion.robots.policy: 0.073
  cdx.remote: 0.058
  esindex: 0.009
  LoadShardBlock: 50.322 (3)
  PetaboxLoader3.datanode: 61.914 (4)
  CDXLines.iter: 15.388 (3)
  load_resource: 60.85
  PetaboxLoader3.resolve: 41.228
*/