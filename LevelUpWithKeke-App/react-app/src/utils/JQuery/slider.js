// utils/LoadScript.js
import $ from 'jquery';

export function sliderScript() {
  let i = 1;
  const totalSlides = 3;

  // Store interval ID so it can be cleared later
  const intervalId = setInterval(function() {
    const previous = i === 1 ? totalSlides : i - 1;

    $("#slide").removeClass("slide" + previous);
    $("#slide").addClass("slide" + i);

    // Increment i and reset to 1 if it exceeds totalSlides
    i = i < totalSlides ? i + 1 : 1;

  }, 6000);

  return intervalId;  // Return the interval ID so it can be cleared later
}
