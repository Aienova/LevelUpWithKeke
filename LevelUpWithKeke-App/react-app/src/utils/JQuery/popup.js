// utils/LoadScript.js
import $ from 'jquery';

export function popupScript() {



        $('.viewpopup-test').on('mouseover', () => {

            $("#popup").removeClass("test-closed");



        setTimeout(() => {
            $(".popup").removeClass("leashed");
          }, 1);


        });


        $('#popup-closer').on('click', () => {

            $(".popup").addClass("leashed");
            $("#popup").addClass("closed");
            $("#footer-menu").removeClass("viewpopup");

        });


        $('#start-test').on('click', () => {

            $(".popup").addClass("leashed");
            $("#popup").addClass("closed");
            $("#footer-menu").removeClass("viewpopup");

        });

        

}
