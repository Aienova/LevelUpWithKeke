// utils/LoadScript.js

import $ from 'jquery';


export function submitPopup() {

  $('#bookingSubmitFormButton').on('click', () => {

    $("#loader").removeClass("transitioner");
    $("#loader").removeClass("vanished");

    $('#booking-form')[0].reset();

    setTimeout(function() {


      $("#loader").addClass("transitioner");
      $("#loader").addClass("vanished");
    $("#booking-form .popup").addClass("resizing");
    $("#booking-form .popup").addClass("showing");

  },2000);

    setTimeout(function() {



      $("#booking-form .popup").removeClass("resizing");
      $("#booking-form .popup").removeClass("showing");

      },8000);

      

  });

  return () => {
    $('#bookingSubmitFormButton').off('click');
  };

}
