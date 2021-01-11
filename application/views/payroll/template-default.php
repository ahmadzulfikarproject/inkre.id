<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Autocomplete</title>
  <link rel="stylesheet" href="<?php echo home_url().'assets/css/bootstrap.css'?>">
    <link rel="stylesheet" href="<?php echo home_url().'assets/css/default.css'?>">
  <link rel="stylesheet" href="<?php echo home_url().'assets/css/jquery-ui.css'?>">
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

        <section class="container">
            <?php echo $contents; ?>
        </section>
          <script src="<?php echo home_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
  <script src="<?php echo home_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script>
  <script src="<?php echo home_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>
  
        <script type="text/javascript">
        //jQuery.noConflict();
        var $ji = $.noConflict();
    $ji(document).ready(function(){
            //ajax input
            /*
            $ji('.toggle-modal').click(function(){
                $ji('#importModal').modal('toggle');
            }); 
            */
            $ji('#importform').on('submit', function(event){
                event.preventDefault();
                //alert('ssssssss');
                if($.trim($ji('#file').val()).length == 0)
                {
                    alert("Silahkan pilih file yang akan di import !");
                    return false;
                }
               
                else
                {
                    var form_data = $ji('#importform').serialize();
                    var d_name = $ji("input#file").val();
                    $ji("#hasildata").text($("form").serialize());
                    //var fileku = document.getElementById("#file").files[0].name;
                    //alert(d_name);
                    //var d_tags = $ji("input#tags").val();
                    $ji( "#results" ).text( form_data );
                    $ji('#importajax').attr("disabled","disabled");
                    $.ajax({
                        url:"<?php echo site_url('data/upload');?>",
                        //method:"POST",
                        type: "POST",
                        dataType: "JSON",
                        data:form_data,
                        //data: {name: d_name},
                        beforeSend:function(){
                          //$ji('#hasildata').html(form_data);
                            $ji('#importajax span').text('Submitting...');
                            $ji('.loading').show();
                        },
                        success:function(data){
                            if(data.error == true ){
                                $ji('#importajax').attr("disabled", false);
                                $ji('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    //$ji('#security_code').val('');
                                    //$ji("#imagecode").html(data.image);
                                    $ji('#importajax span').text('Submit');
                                    $ji( "#results" ).text( 'Terjadi keslahan, silahkan coba lagi...' );
                                    //$ji('#results').show();
                                    $ji("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });

                            }
                            else
                            {
                                $ji('#name').val('');
                                //$ji('#email').val('');
                                //$ji('#phone').val('');
                                //$ji('#subjek').val('');
                                //$ji('#message').val('');
                                //$ji('#security_code').val('');
                                //$ji('#tags').tokenfield('setTokens',[]);
                                //$ji('#success_message').html(data);

                                $ji('#importajax').attr("disabled", false);
                                $ji('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    //$ji('#security_code').val('');
                                    //$ji("#imagecode").html(data.image);
                                    $ji('#importajax span').text('Submit');
                                    $ji( "#results" ).text( 'Data Terkirim...' );
                                    //$ji('#results').show();
                                    $ji("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });


                            }
                            

                        }
                    });
                    /*
                    setInterval(function(){
                        $ji('#success_message').html('');
                    }, 5000);
                    */
                }
            }); 
            //reload captcha

            

    });
  </script>
</body>
</html>