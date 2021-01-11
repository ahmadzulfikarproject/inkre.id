<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Autocomplete</title>
	<link rel="stylesheet" href="<?php echo home_url().'asset/css/bootstrap.css'?>">
    <link rel="stylesheet" href="<?php echo home_url().'asset/css/default.css'?>">
	<link rel="stylesheet" href="<?php echo home_url().'asset/css/jquery-ui.css'?>">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <style type="text/css">
        html{
            position: relative;
            height: 100%;
            overflow-y: visible;

        }
        .loading{
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -30px;
            margin-left: -30px;
            z-index: 99;
        }
        .paginationz{
            line-height: 34px;
        }
        .pagination li{
            float: left;
        }
        .numpage{
            padding: 6px 12px;
            padding-right: 10px;
        }
        #results{
            display: none;
        }
        .input-group {
            margin-bottom: 10px;
        }
        
        .inquery{
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30%;
            top: 50%;
            /*margin-left: -25%;
            bottom: 10px !important;
            */
        }
        .inquery img{
            max-width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>

    <div class="container">

        <!--<input type="text" name="tags" class="form-control" id="tokenfield" />-->
        <!--<textarea name="description" class="form-control" placeholder="Description" style="width:500px;"></textarea>-->
        <span id="success_message"></span>
        <div class="inquery">
          
        
            <h4><strong>SEND ENQUIRY front end</strong></h4>
            <div id="results" class="alert alert-success"></div>
            <div id="hasildata"></div>
          <form method="post" id="enquiry_form" autocomplete="on">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input class="form-control" type="text" name="name"  id="name" value="" placeholder="Name" required>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input class="form-control" type="email"  name="email"  id="email" value="" placeholder="E-mail" required>
            </div>

            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
              <input class="form-control"  name="phone" id="phone" value="" placeholder="Phone" required type="tel">
            </div>
            
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-edit"></i></span>
              <input class="form-control" name="subjek" id="subjek" value="" placeholder="Subjek" required type="tel">
            </div>
            <div class="form-group">
              <textarea class="form-control required scrollup" name="message" id="message" rows="3" placeholder="Customer Enquiry" required></textarea>
            </div>
            <div class="form-group hidden">
                <label>Enter tags</label>
                <input type="text" name="tags" id="tags" class="form-control" />
            </div>
            <div class='form-group scrollup'>
                
                <div class='row'>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for='inputEmail3' style='margin-top:-5px; height: 60px; clear: both; display: block;' class='control-label' id='imagecode'><?= $image ?></label>
                        <div id="reload-captcha" class="btn btn-default btn-xs" ><i class="fas fa-sync"></i> reload captcha</div>
                    </div>
                    
                    <div style='background:#fff;' class='input-groupz col-lg-6'>
                        <input name='security_code' id="security_code" maxlength='6' type='text' class='form-control kode' placeholder='Masukkkan kode..' required autocomplete="off">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg scrollup" type="submit" name="submit" id="submit" value="Submit">
                <i class="fas fa-paper-plane" aria-hidden="true"></i> <span>Submit</span>
            </button>
            
          </form>
        </div>
        
        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo home_url().'asset/images/loading.gif'; ?>"/></div></div>


    </div>

	<script src="<?php echo home_url().'asset/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
	<script src="<?php echo home_url().'asset/js/bootstrap.js'?>" type="text/javascript"></script>
	<script src="<?php echo home_url().'asset/js/jquery-ui.js'?>" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
            //ajax input
            $('#enquiry_form').on('submit', function(event){
                event.preventDefault();
                if($.trim($('#name').val()).length == 0)
                {
                    alert("Please Enter Your name");
                    return false;
                }
               
                else
                {
                    var form_data = $('#enquiry_form').serialize();
                    var d_name = $("input#name").val();
                    //var d_tags = $("input#tags").val();
                    $( "#results" ).text( form_data );
                    $('#submit').attr("disabled","disabled");
                    $.ajax({
                        url:"<?php echo site_url('enquiry/add_enquiry');?>",
                        //method:"POST",
                        type: "POST",
                        dataType: "JSON",
                        data:form_data,
                        //data: {name: d_name},
                        beforeSend:function(){
                            $('#submit span').text('Submitting...');
                            $('.loading').show();
                        },
                        success:function(data){
                            if(data.error == false)
                            {
                                $('#name').val('');
                                $('#email').val('');
                                $('#phone').val('');
                                $('#subjek').val('');
                                $('#message').val('');
                                $('#security_code').val('');
                                $('#tags').tokenfield('setTokens',[]);
                                $('#success_message').html(data);
                                $('#submit').attr("disabled", false);
                                //$('.loading').fadeOut("slow");
                                

                                $('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    $('#submit span').text('Submit');
                                    $( "#results" ).text( 'Data Berhasil Terkirim !!' );
                                    $( "#hasildata" ).text(data.file);
                                    $("#imagecode").html(data.image);
                                    //$('#results').show();
                                    $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });


                            }
                            else if(data.error == true ){
                                $('#submit').attr("disabled", false);
                                $('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    $('#security_code').val('');
                                    $("#imagecode").html(data.image);
                                    $('#submit span').text('Submit');
                                    $( "#results" ).text( 'Terjadi keslahan, silahkan coba lagi...' );
                                    //$('#results').show();
                                    $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });

                            }

                        }
                    });
                    setInterval(function(){
                        $('#success_message').html('');
                    }, 5000);
                }
            }); 
            //reload captcha
            $("#reload-captcha").click(function(){
                /*
                $.get("<?php //echo site_url('enquiry/reload_captcha');?>", function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                });
                */
                $.ajax({
                    url:"<?php echo site_url('enquiry/reload_captcha');?>",
                    type: "GET",
                    dataType: "JSON",
                    success:function(data){
                        if(data != '')
                        {
                            $('#security_code').val('');
                            $('#imagecode').fadeOut( "fast", function() {
                                // Animation complete.
                                $("#imagecode").html(data.image);
                                $('#imagecode').fadeIn('fast');
                            });
                            
                        }
                        

                    }
                });
            }); 

            //fikar import ajax
            $('#importform').on('submit', function(event){
                event.preventDefault();
                //alert('ssssssss');
                if($.trim($('#file').val()).length == 0)
                {
                    alert("Silahkan pilih file yang akan di import !");
                    return false;
                }
               
                else
                {
                    var form_data = $('#importform').serialize();
                    var d_name = $("input#file").val();
                    $("#hasildata").text($("form").serialize());
                    //var fileku = document.getElementById("#file").files[0].name;
                    //alert(d_name);
                    //var d_tags = $("input#tags").val();
                    $( "#results" ).text( form_data );
                    $('#importajax').attr("disabled","disabled");
                    $.ajax({
                        url:"<?php echo site_url('data/upload');?>",
                        //method:"POST",
                        type: "POST",
                        dataType: "JSON",
                        data:form_data,
                        //data: {name: d_name},
                        beforeSend:function(){
                          //$('#hasildata').html(form_data);
                            $('#importajax span').text('Submitting...');
                            $('.loading').show();
                        },
                        success:function(data){
                            if(data.error == true ){
                                $('#importajax').attr("disabled", false);
                                $('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    //$('#security_code').val('');
                                    //$("#imagecode").html(data.image);
                                    $('#importajax span').text('Submit');
                                    $( "#results" ).text( 'Terjadi keslahan, silahkan coba lagi...' );
                                    //$('#results').show();
                                    $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });

                            }
                            else
                            {
                                //$('#name').val('');
                                //$('#email').val('');
                                //$('#phone').val('');
                                //$('#subjek').val('');
                                //$('#message').val('');
                                //$('#security_code').val('');
                                //$('#tags').tokenfield('setTokens',[]);
                                //$('#success_message').html(data);

                                $('#importajax').attr("disabled", false);
                                $('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    //$('#security_code').val('');
                                    //$("#imagecode").html(data.image);
                                    $('#importajax span').text('Submit');
                                    $( "#results" ).text( 'Data Terkirim...' );
                                    //$('#results').show();
                                    $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });


                            }
                            

                        }
                    });
                    /*
                    setInterval(function(){
                        $('#success_message').html('');
                    }, 5000);
                    */
                }
            }); 

            

		});
	</script>

</body>
</html>