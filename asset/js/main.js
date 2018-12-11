(function($){ 
	'use strict';
	if ($.fn.menumaker) {
        $("#cssmenu").menumaker({
            title: "Menu",
            breakpoint: 768,
            format: "multitoggle"
        });
    }
})(jQuery);