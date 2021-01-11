<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <!--<button type="button" id="toggle-modal" class="btn btn-primary toggle-modal hidden"><i class="fas fa-paper-plane" style="margin:0 10px 0 0"></i> Kirim Permintaan</button>-->

    <div id="chat" class="hidden-xsz hidden-mdz">
        <div class="btn-group">
            <button type="button" id="toggle-modal" class="btn btn-danger toggle-modalz"><i class="fas fa-paper-plane" style="margin:0 10px 0 0"></i> Inquiry Letter</button>
            <a data-toggle="popover" data-container="body" data-placement="top" title="Hai! Klik salah satu perwakilan kami di bawah dan kami akan menghubungi Anda sesegera mungkin." type="button" data-html="true" href="#chat" id="wa" class="chatpopover btn btn-default"><i class="fab fa-whatsapp" style="margin:0 10px 0 0"></i> Chat with us on Whatsapp</a>
            
        </div>
        <div id="popover-content-wa" class="hide">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=6281399691694"><span><i class="fa fa-user-circle"></i> Customer Services</span></a>
                
            </div>
        
        <?php if ($this->uri->segment(1)=='' OR $this->uri->segment(1)=='home'): ?>
        <a data-toggle="popover" data-container="body" data-placement="top" title="Kirim permintaan kepada kami" type="button" data-html="true" href="#inquery" id="inquiry" class="chatpopover hidden"> <i class="fas fa-paper-plane" style="margin:0 10px 0 0"></i> Kirim Permintaan</a>
        <div id="popover-content-inquiry" class="hide">

        <div class="inqueryz">
          <?php //echo Modules::run('enquiry/enquiry/ajax_index', array()); ?>             
        </div><!--inquiry-->
        </div>
        <?php endif; ?>
    </div>

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><strong>SEND ENQUIRY front end</strong></h4>
          </div>
          <div class="modal-body">
                    <div class="container">

                        <!--<input type="text" name="tags" class="form-control" id="tokenfield" />-->
                        <!--<textarea name="description" class="form-control" placeholder="Description" style="width:500px;"></textarea>-->
                        <span id="success_message"></span>
                        <div class="inquery">
                          
                        
                            
                            <div id="results" class="alert alert-success"></div>
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
                                        <div id="reload-captcha" class="reload-captcha btn btn-default btn-xs" ><i class="fas fa-sync"></i> reload captcha</div>
                                    </div>
                                    
                                    <div style='background:#fff;' class='input-groupz col-lg-6'>
                                        <input name='security_code' id="security_code" maxlength='6' type='text' class='form-control kode' placeholder='Masukkkan kode..' required autocomplete="off">
                                    </div>
                                    <?php //echo strtolower($this->session->userdata('mycaptchacode')); ?>
                                </div>
                            </div>


                            <button class="btn btn-primary btn-lg scrollup" type="submit" name="submit" id="submitajax" value="Submit">
                                <i class="fas fa-paper-plane" aria-hidden="true"></i> <span>Submit</span>
                            </button>
                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                            
                          </form>
                        </div>
                        
                        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo home_url().'asset/images/loading.gif'; ?>"/></div></div>
                        <div id="result"></div>

                    </div>
          </div>
          <div class="modal-footer hidden">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</div>



    <script src="<?php echo base_url(); ?>templates/<?php echo template(); ?>/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script>var _tooltip = jQuery.fn.tooltip;</script>
    <script src="<?php echo base_url(); ?>templates/<?php echo template(); ?>/js/jquery-ui.js" type="text/javascript"></script>
    <script>var jQuery.fn.tooltip = _tooltip;</script>
    <script>
    /*** Handle jQuery plugin naming conflict between jQuery UI and Bootstrap ***/
    //$.widget.bridge('uibutton', $.ui.button);
    //$.widget.bridge('uitooltip', $.ui.tooltip);
    </script>
    <script src="<?php echo base_url(); ?>templates/<?php echo template(); ?>/js/bootstrap.js" type="text/javascript"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>-->
	<script type="text/javascript">
        //jQuery.noConflict();
        var jq = $.noConflict();
		jq(document).ready(function(){
            //ajax input
            
            jq('#toggle-modal').click(function(){
                jq('#myModal').modal('toggle');
            }); 
            
            jq(".input-group-addon").click(function(){
                alert('test');
            });
            //alert('test');
            jq(".reload-captcha").click(function(){
                //alert('test');
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
                            jq('#security_code').val('');
                            jq('#imagecode').fadeOut( "fast", function() {
                                // Animation complete.
                                jq("#imagecode").html(data.image);
                                jq('#imagecode').fadeIn('fast');
                            });
                            
                        }
                        

                    }
                });
                
            }); 
            jq('#enquiry_form').on('submit', function(event){
                event.preventDefault();
                if($.trim(jq('#name').val()).length == 0)
                {
                    alert("Please Enter Your name");
                    return false;
                }
               
                else
                {
                    var form_data = jq('#enquiry_form').serialize();
                    var d_name = jq("input#name").val();
                    //var d_tags = jq("input#tags").val();
                    jq( "#results" ).text( form_data );
                    jq('#submitajax').attr("disabled","disabled");
                    $.ajax({
                        url:"<?php echo site_url('enquiry/add_enquiry');?>",
                        //method:"POST",
                        type: "POST",
                        dataType: "JSON",
                        data:form_data,
                        //data: {name: d_name},
                        beforeSend:function(){
                            jq('#submitajax span').text('Submitting...');
                            jq('.loading').show();
                        },
                        success:function(data){
                            if(data.error == true ){
                                jq('#submitajax').attr("disabled", false);
                                jq('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    jq('#security_code').val('');
                                    jq("#imagecode").html(data.image);
                                    jq('#submitajax span').text('Submit');
                                    jq( "#results" ).text( 'Terjadi keslahan, silahkan coba lagi...' );
                                    //jq('#results').show();
                                    jq("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });

                            }
                            else
                            {
                                jq('#name').val('');
                                jq('#email').val('');
                                jq('#phone').val('');
                                jq('#subjek').val('');
                                jq('#message').val('');
                                jq('#security_code').val('');
                                //jq('#tags').tokenfield('setTokens',[]);
                                jq('#success_message').html(data);
                                /*
                                jq('#submitajax').attr("disabled", false);
                                //jq('.loading').fadeOut("slow");
                                

                                jq('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    jq('#submitajax span').text('Submit');
                                    jq( "#results" ).text( 'Data Berhasil Terkirim !!' );
                                    jq("#imagecode").html(data.image);
                                    //jq('#results').show();
                                    jq("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });
                                */
                                jq('#submitajax').attr("disabled", false);
                                jq('.loading').fadeOut( "slow", function() {
                                    // Animation complete.
                                    jq('#security_code').val('');
                                    jq("#imagecode").html(data.image);
                                    jq('#submitajax span').text('Submit');
                                    jq( "#results" ).text( 'Data Terkirim...' );
                                    //jq('#results').show();
                                    jq("#results").fadeIn('slow').delay(5000).fadeOut('slow');
                                });


                            }
                            

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            //alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');
                            /*
                            $('#result').html('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');
                            console.log('jqXHR:');
                            console.log(jqXHR);
                            console.log('textStatus:');
                            console.log(textStatus);
                            console.log('errorThrown:');
                            console.log(errorThrown);
                            */
                        }
                    });
                    setInterval(function(){
                        jq('#success_message').html('');
                    }, 5000);
                }
            }); 
            //reload captcha

            

		});
	</script>