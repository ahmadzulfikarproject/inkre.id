$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this

  $(document).ready( function() {
      //tagmanager
      //$(".tm-input").tagsManager();

    /*
      var fileinput = $('.fileinput').fileinput();
      fileinput.on('change.bs.fileinput', function(e, files){
          //console.log('change me!');
          //alert('okehhhh');
          $(".current-image").fadeOut(500);
          $(".fileinput-preview").fadeIn(500);
      });
      fileinput.on('clear.bs.fileinput', function(e, files){
          //console.log('change me!');
          //alert('okehhhh');
          $(".current-image").fadeIn(500);
          $(".fileinput-preview").fadeOut(500);
      });
      */
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });

      $('#price').inputmask("numeric", {
          radixPoint: ",",
          groupSeparator: ".",
          digits: 2,
          autoGroup: true,
          prefix: 'Rp ', //No Space, this will truncate the first character
          rightAlign: false,
          oncleared: function () { self.Value(''); }
      });
      //$("#price").inputmask("myCurrency");
      //$('#price').inputmask({ mask: "."})

  });
  
});
//$('#price').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

String.prototype.reverse = function () {
        return this.split("").reverse().join("");
    }

    function reformatText(input) {        
        var x = input.value;
        x = x.replace(/,/g, ""); // Strip out all commas
        x = x.reverse();
        x = x.replace(/.../g, function (e) {
            return e + ",";
        }); // Insert new commas
        x = x.reverse();
        x = x.replace(/^,/, ""); // Remove leading comma
        input.value = x;
    }