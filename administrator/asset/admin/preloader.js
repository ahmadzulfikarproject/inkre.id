var pj = jQuery.noConflict();
pj(document).ready(function($) {
  
    var Body = pj('body');
    //pj('body').removeClass('loaded');
    pj('#loader-wrapper').fadeIn('slow');

    //Body.addClass('preloader-site');
    //pj('body').fadeOut( "fast");
    // Catch all anchor clicks bubbled to the document...
    //jQuery(function($) {
      /*
    pj(document).on('click', ".navbar a", function(event) {
        event.preventDefault();
        linkLocation = this.href;
        pj('body').removeClass('loaded');
        //pj('#logoweb').fadeIn('fast');
        //pj('#loader').fadeIn('fast');
        pj("#loader-wrapper").fadeIn(200, function(){redirectPage(linkLocation)});
        //pj("body").fadeOut(100, function(){redirectPage(linkLocation)});
    });
    */
    //});

    function redirectPage(link) {
        document.location.href = link;
    }
});

/*
pj(window).bind('beforeunload', function() {
    // do something, preferably ajax request etc
    //return 'are you sure?';
    alert('okehh');
});
*/
pj(window).on('load', function() {
    //alert('zzz');

    pj('.preloader-wrapper').fadeOut(50,function() {
      //pj('body').removeClass('preloader-site');
      pj('body').addClass('loaded');
      pj('#logoweb').fadeOut('fast');
      //pj('#loader-wrapper').fadeOut('slow');
      
      
      //pj('body').fadeIn( "fast");
    });


});

/*
pj(window).on('load', function() { // makes sure the whole site is loaded 
  pj('#status').fadeOut(); // will first fade out the loading animation 
  pj('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  pj('body').delay(350).css({'overflow':'visible'});
})
*/