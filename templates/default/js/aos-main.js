/*
//var ao = $.noConflict();
$(document).ready(function(){
  var delay = 0;
  $('[data-aos]').each(function() {
     if ($(this).visible(true, true)) {
         delay = delay + 50;
         $(this).attr('data-aos-delay', delay);
     }
  });
});
*/

//$(function() {
$(document).ready(function(){
  var delay = 0;
  $('[data-aos]').each(function() {
     if ($(this).visible(true, true)) {
         delay = delay + 50;
         $(this).attr('data-aos-delay', delay);
     }
  });

  AOS.init({
    duration: 200,
    offset: 120, // offset (in px) from the original trigger point
    //delay: 0, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: false, // whether animation should happen only once - while scrolling down
    mirror: true, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
  });


  $('.js-load-more').on('click', function() {
    var $content = $(this).next('.js-more-content');

    $content.animate({
      height: 750,
    }, 500);
  });

  onElementHeightChange(document.body, function(){
    AOS.refresh();
  });
});

function onElementHeightChange(elm, callback) {
    var lastHeight = elm.clientHeight
    var newHeight;

    (function run() {
        newHeight = elm.clientHeight;
        if (lastHeight !== newHeight) callback();
        lastHeight = newHeight;

        if (elm.onElementHeightChangeTimer) {
          clearTimeout(elm.onElementHeightChangeTimer);
        }

        elm.onElementHeightChangeTimer = setTimeout(run, 200);

        //var ao = $.noConflict();
        //ao(document).ready(function(){
          var delay = 0;
          $('[data-aos]').each(function() {
             if ($(this).visible(true, true)) {
                 delay = delay + 50;
                 $(this).attr('data-aos-delay', delay);
             }
          });
        //});

    })();
  }
