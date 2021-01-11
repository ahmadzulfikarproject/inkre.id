$(function(){
  'use strict';
  var options = {
    prefetch: true,
    cacheLength: 2,
    onStart: {
      duration: 250, // Duration of our animation
      render: function ($container) {
        // Add your CSS animation reversing class
        $container.addClass('is-exiting');
        //$('body').fadeOut('slow');
        
        //$('body').removeClass('loaded');
        //$('#loader-wrapper').fadeIn('fast');
        // Restart your animation
        smoothState.restartCSSAnimations();
      }
    },
    onReady: {
      duration: 0,
      render: function ($container, $newContent) {
        // Remove your CSS animation reversing class
        $container.removeClass('is-exiting');
        //$('body').fadeIn('slow');
        //$('body').addClass('loaded');
        //$('#logoweb').fadeOut('fast');
        
        // Inject the new content
        $container.html($newContent);
        

      }
    }
  },
  smoothState = $('#main').smoothState(options).data('smoothState');

});

