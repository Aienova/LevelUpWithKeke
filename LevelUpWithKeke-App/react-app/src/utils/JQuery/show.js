// utils/LoadScript.js

import $ from 'jquery';


export function showerScript() {

  
  function checkVisibility() {
    $('.shower').each(function() {
        var $shower = $(this);
        var windowHeight = $(window).height();
        var scrollTop = $(window).scrollTop();
        var elementOffset = $shower.offset().top;
        var elementHeight = $shower.outerHeight();

        if (scrollTop + windowHeight > elementOffset && scrollTop < elementOffset + elementHeight) {



                $shower.find('.hiding').removeClass('hiding').addClass('visible');
          


        }
    });
}

$(window).on('scroll', checkVisibility);

// Trigger the function on page load
checkVisibility();


}