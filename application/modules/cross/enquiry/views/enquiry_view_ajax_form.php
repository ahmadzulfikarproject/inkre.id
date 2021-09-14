<div class="contact-form">
  <span id="success_message"></span>
  <div class="inquery">



    <div id="results" class="alert alert-success"></div>
    <form method="post" id="enquiry_form" autocomplete="on">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
        </div>
        <input class="form-control" type="text" name="name" id="name" value="" placeholder="Name" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
        </div>
        <input class="form-control" type="email" name="email" id="email" value="" placeholder="E-mail" required>
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone-square"></i></span>

        </div>
        <input class="form-control" name="phone" id="phone" value="" placeholder="Phone" required type="tel">
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="fas fa-edit"></i></span>
        </div>
        <input class="form-control" name="subjek" id="subjek" value="" placeholder="Subjek" required type="tel">
      </div>
      <div class="form-group mb-3">
        <textarea class="form-control required scrollup" name="message" id="message" rows="3" placeholder="Customer Enquiry" required></textarea>
      </div>
      <div class="form-group hidden">
        <label>Enter tags</label>
        <input type="text" name="tags" id="tags" class="form-control" />
      </div>
      <div class='form-group scrollup mb-3'>

        <div class='row'>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <label for='inputEmail3' style='margin-top:-5px; height: 60px; clear: both; display: block;' class='control-label' id='imagecode'><?= $image ?></label>
            <div id="reload-captcha" class="reload-captcha btn btn-default btn-xs"><i class="fas fa-sync"></i> reload captcha</div>
          </div>

          <div class='input-groupz col-lg-6'>
            <input name='security_code' id="security_code" maxlength='6' type='text' class='form-control kode' placeholder='Masukkkan kode..' required autocomplete="off">
          </div>
          <?php
          ?>
        </div>
      </div>


      <button class="btn btn-primary btn-lg scrollup" type="submit" name="submit" id="submitajax" value="Submit">
        <i class="fas fa-paper-plane" aria-hidden="true"></i> <span>Submit</span>
      </button>
      <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>

    </form>
  </div>

  <div class="loading" style="display: none;">
    <div class="content"><img src="<?php echo home_url() . 'asset/images/loading.gif'; ?>" /></div>
  </div>
</div>
<?php
ob_start();
?>
<!-- form ajax -->
<script type="text/javascript" data-minify-level="1">
  //jQuery.noConflict();
  //alert('kirim emaillllllllllll !!!!!!!!!!1');
  // var jq = $.noConflict();
  function reload() {
    // alert("Page is loaded");
    $("#reload-captcha").trigger('click');
  }
  $(document).ready(function() {
    //ajax input
    /*i
    $('.toggle-modal').click(function(){
        $('#myModal').modal('toggle');
    });

    $(".input-group-addon").click(function(){
        alert('test');
    });
    //alert('test');
    */
    $(".reload-captcha").click(function() {
      // alert('test');
      /*
      $.get("<?php
              ?>", function(data, status){
          alert("Data: " + data + "\nStatus: " + status);
      });
      */

      $.ajax({
        url: "<?php echo site_url('enquiry/reload_captcha'); ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          if (data != '') {
            $('#security_code').val('');
            $('#imagecode').fadeOut("fast", function() {
              // Animation complete.
              $("#imagecode").html(data.image);
              $('#imagecode').fadeIn('fast');
            });

          }


        }
      });

    });
    $('#enquiry_form').on('submit', function(event) {
      event.preventDefault();
      if ($.trim($('#name').val()).length == 0) {
        alert("Please Enter Your name");
        return false;
      } else {
        var form_data = $('#enquiry_form').serialize();
        var d_name = $("input#name").val();
        //var d_tags = $("input#tags").val();
        $("#results").text(form_data);
        $('#submitajax').attr("disabled", "disabled");
        $.ajax({
          url: "<?php echo site_url('enquiry/add_enquiry'); ?>",
          //method:"POST",
          type: "POST",
          dataType: "JSON",
          data: form_data,
          //data: {name: d_name},
          beforeSend: function() {
            $('#submitajax span').text('Submitting...');
            $('.loading').show();
          },
          success: function(data) {
            if (data.error == true) {
              $('#submitajax').attr("disabled", false);
              $('.loading').fadeOut("slow", function() {
                // Animation complete.
                $('#security_code').val('');
                $("#imagecode").html(data.image);
                $('#submitajax span').text('Submit');
                $("#results").text('Terjadi keslahan, silahkan coba lagi...');
                //$('#results').show();
                $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
              });

            } else {
              $('#name').val('');
              $('#email').val('');
              $('#phone').val('');
              $('#subjek').val('');
              $('#message').val('');
              $('#security_code').val('');
              //$('#tags').tokenfield('setTokens',[]);
              $('#success_message').html(data);
              /*
              $('#submitajax').attr("disabled", false);
              //$('.loading').fadeOut("slow");


              $('.loading').fadeOut( "slow", function() {
                  // Animation complete.
                  $('#submitajax span').text('Submit');
                  $( "#results" ).text( 'Data Berhasil Terkirim !!' );
                  $("#imagecode").html(data.image);
                  //$('#results').show();
                  $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
              });
              */
              $('#submitajax').attr("disabled", false);
              $('.loading').fadeOut("slow", function() {
                // Animation complete.
                $('#security_code').val('');
                $("#imagecode").html(data.image);
                $('#submitajax span').text('Submit');
                $("#results").text('Data Terkirim...');
                //$('#results').show();
                $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
              });


            }


          },
          error: function(jqXHR, textStatus, errorThrown) {
            //alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');

            // $('#result').html('<p>status code: ' + jqXHR.status + '</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>' + jqXHR.responseText + '</div>');
            // console.log('jqXHR:');
            // console.log(jqXHR);
            // console.log('textStatus:');
            // console.log(textStatus);
            // console.log('errorThrown:');
            // console.log(errorThrown);
          }
        });
        setInterval(function() {
          $('#success_message').html('');
        }, 5000);
      }
    });
    //reload captcha



  });
</script>
<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>