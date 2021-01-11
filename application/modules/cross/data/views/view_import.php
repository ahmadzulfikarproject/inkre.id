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
			#numView{
				width: auto;
				float: none !important;

			}
			.input-group label{
				margin: 0px 5px;

			}
		</style>
		<div class="container">
		    <h1>Import Data</h1>
		    <div class="row"> 
		        <div class="post-list col-xs-12" id="enquiryList">
		        	<div id="results" class="alert alert-success" style="display: none;"></div>
		        	<div id="hasildata"></div>
		        	<form method="post" id="importform" class="form-horizontal">
		        		
	                  	<div class="input-group">
	                      <label class="input-group-btn">
	                        <span class="btn btn-default">
	                          <i class="fas fa-folder-open"></i> Browse&hellip; <input name="file" id="file" type="file" style="display: none;" multiple required>
	                        </span>
	                      </label>
	                      <input type="text"  class="form-control fileku" readonly>
	                    </div>	                      <span>Pilih salah satu file</span>
	                <!--
	                    <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                          <input class="form-control"  name="file" id="file" value="" placeholder="file" required type="file">
                        </div>-->
                        <div class="input-group">
		                    <label class="btn-group">
				                <button class="btn btn-primary btn-lg scrollup" type="submit" name="submit" id="importajax" value="Submit">
		                            <i class="fas fa-file-import"></i> <span>Import Ajax</span>
		                        </button>
		                        <a href="<?php echo base_url('data'); ?>" class="btn btn-info btn-lg">Back</a>
		                    </label>
		                </div>
		            </form>
		        </div>

		        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo home_url().'asset/images/loading.gif'; ?>"/></div></div>
		    </div>
		</div>
		<!-- jQuery -->
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
            $ji('.toggle-modal').click(function(){
                $ji('.loading').show();
            }); 
            $ji('#importform').submit(function(e){
		    e.preventDefault(); 

		    	if($.trim($ji('#file').val()).length == 0)
                {
                    alert("Silahkan pilih file yang akan di import !");
                    return false;
                }
                else{
                	
			    	var form_data = $ji('#submit').serialize();
			    	$ji( "#results" ).text(form_data);
			         $.ajax({
			             url:'<?php echo base_url();?>data/do_upload',
			             type:"post",
			             data:new FormData(this),
			             processData:false,
			             contentType:false,
			             cache:false,
			             async:false,
			             /*
			              success: function(data){
			                  alert("Upload Image Berhasil.");
			           	}*/
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
	                                    
	                                    //$ji('.fileku').fileinput("clear");
	                                    //$(':file').val('');
	                                    //$("input[type=file]").fileinput("clear")
	                                    $ji('#importajax span').text('Submit');
	                                    $ji( "#results" ).text( 'Terjadi keslahan, silahkan coba lagi...' );
	                                    //$ji('#results').show();
	                                    $ji("#results").fadeIn('slow').delay(5000).fadeOut('slow');
	                                });

	                            }
	                            else
	                            {
	                                //$ji('#name').val('');
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
	                                    //$(".fileku").attr("readonly", false);
	            						$ji('input').val('');
	            						//$(".fileku").attr("readonly", true);
	                                    //input.trigger('fileselect', [numFiles, label]);
	                                    $ji('#importajax span').text('Submit');
	                                    $ji( "#results" ).text( 'Data Terkirim...' );
	                                    //$ji('#results').show();
	                                    $ji("#results").fadeIn('slow').delay(5000).fadeOut('slow');
	                                });


	                            }
	                            

	                        }
			         });
		        }
		    });
            /*
            $ji('#importform').on('submit', function(event){
                event.preventDefault();
                if($.trim($ji('#file').val()).length == 0)
                {
                    alert("Silahkan pilih file yang akan di import !");
                    return false;
                }
               
                else
                {
                    var form_data = $ji('#importform').serialize();
                    var d_name = $ji("input#file").val();
                    //var fileku = document.getElementById("#file").files[0].name;
                    //alert(d_name);
                    //var d_tags = $ji("input#tags").val();
                    $ji( "#hasildata" ).text(form_data);
                    $( "#results" ).text(form_data);
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
                                //$ji('#name').val('');
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

                }
            }); 
            //reload captcha
            */

            

		});
	</script>