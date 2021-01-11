// photobos js
        jQuery('.fikar_photo_gallery').photobox('.photobox_a',{thumbs:true});
        // or with a fancier selector and some settings, and a callback:
        jQuery('.fikar_photo_gallery').photobox('.photobox_a:first', { thumbs:false, time:0 }, imageLoaded);

        jQuery('.images_gallery').photobox('.photobox_a',{thumbs:true});
        // or with a fancier selector and some settings, and a callback:
        jQuery('.images_gallery').photobox('.photobox_a:first', { thumbs:true, time:0 }, imageLoaded);
            
        function imageLoaded(){
          console.log('image has been loaded...');
        }