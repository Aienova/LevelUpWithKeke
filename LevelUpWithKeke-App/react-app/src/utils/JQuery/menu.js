// utils/LoadScript.js

import $ from 'jquery';


export function menuScript() {
  $('#burger-menu').on('click', () => {

    $(".bar").toggleClass('change');
    $(".menumobile").slideToggle();
  });



  $('.show-submenu').on('click', () => {

    if($(".bar").hasClass('change')){

    $(".submenu").removeClass('hiddenformobile');
    $(".mainmenu-button").removeClass('hidden');
    $(".mainmenu").addClass('hidden');
    $(".show-submenu").removeClass('hidden');
    $(".show-submenu-name").addClass('hidden');

    }
    
  });

  $('.mainmenu-button').on('click', () => {

    $(".submenu").addClass('hiddenformobile');
    $(".mainmenu-button").addClass('hidden');
    $(".mainmenu").removeClass('hidden');
    $(".show-submenu").removeClass('hidden');
    $(".show-submenu-name").removeClass('hidden');

  });

  // Cleanup function to remove the event listener
  return () => {
    $('#burger-menu').off('click');
    $('.show-submenu').off('click');
    $('.mainmenu-button').off('click');
  };


}
