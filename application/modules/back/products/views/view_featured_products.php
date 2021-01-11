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
		
		<ul id="featured-products" class="sortable ui-sortable list-unstyled">
		    <?php $no = 1 ; if(!empty($posts)): foreach($posts as $post): ?>
	            <li id="item-<?= $post['id_products'];  ?>"><div><i class="icon-move glyphicon glyphicon-move ui-sortable-handle"></i>
	            	
	            		<a href="<?php echo base_url('products/edit_products/').$post['id_products']; ?>"><?php echo $post['judul']; ?></a>
	            	
	                        <a class='btn btn-success btn-xs pull-right' title='Edit Data' href='<?php echo base_url('products/edit_products/').$post['id_products']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
	                        <a class='btn btn-danger btn-xs hidden' title='Delete Data' href='<?php echo base_url('products/delete_products/').$post['id_products']; ?>' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
	                    
	              	
		        </li>
	        <?php $no++; endforeach; else: ?>
	        <p>Post(s) not available.</p>
	        <?php endif; ?>
		</ul>
		<span id="featured-products-sort"></span>
		<div id="result"></div>

		<div class="loading" style="display: none;"><div class="content"><img src="<?php echo home_url().'assets/images/loading.gif'; ?>"/></div></div>
		<!-- Modal HTML -->
	    

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
 		<script>
 		$(document).ready(function(){
 			var noview = $('#noview').val();
 			//alert(noview);
 			$('#numView option[value='+noview+']').attr('selected','selected');
 			//alert('zzzzzzzzzzz');
 			var keywords = $('#keywords').val();
		    var sortBy = $('#sortBy').val();
		    var numView = $('#numView').val();
		    var kategori = $('#kategori').val();
		    //set cookie
		    $.cookie("keywords", keywords);
		    $.cookie("sortBy", sortBy);
		    $.cookie("numView", numView);
		    $.cookie("kategori", kategori);
		    //alert($.cookie("keywords", keywords));
		    //end cookie
	        $('#featured-products').sortable({
		        axis: 'y',
		        stop: function (event, ui) {
			        var data = $(this).sortable('serialize');
		            //$('#featured-products-sort').text(data);
		            $.ajax({
	                    type: 'post',
	                    url: '<?php echo base_url(); ?>products/reorder_featured',
	                    data: {
	                        order : data,
	                        //csrf_test_name: $.cookie('csrf_cookie_name')
	                        },
	                    	beforeSend:function(){
	                            $('.loading').show();
	                        },
	                        success:function(data, textStatus, jqXHR){
	                            if(data.error == true ){
	                                $('.loading').fadeOut( "slow", function() {

	                                    $( "#results" ).text( 'Terjadi keslahan, silahkan coba lagi...' );
	                                    //$('#results').show();
	                                    $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
	                                });
	                            }
	                            else
	                            {
	                                $('.loading').fadeOut( "slow", function() {
	                                  
	                                    $( "#results" ).text( 'Data Terkirim...' );
	                                    $("#results").fadeIn('slow').delay(5000).fadeOut('slow');
	                                });


	                            }
	                            //$('#result').html(data);
				                //alert('Load was performed. Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information! ');
				                console.log('jqXHR:');
				                console.log(jqXHR);
				                console.log('textStatus:');
				                console.log(textStatus);
				                console.log('data:');
				                console.log(data);

	                            

	                        },
	                        error: function(jqXHR, textStatus, errorThrown) {
				                //alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');

				                $('#result').html('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');
				                console.log('jqXHR:');
				                console.log(jqXHR);
				                console.log('textStatus:');
				                console.log(textStatus);
				                console.log('errorThrown:');
				                console.log(errorThrown);
				            }
	                });
				}
				/*
				update : function () {
	                $.ajax({
	                    type: 'post',
	                    url: BASE_URL + 'categories/reorder',
	                    data: {
	                        order : $(this).nestedSortable('serialize'),
	                        csrf_test_name: $.cookie('csrf_cookie_name')
	                        }
	                });
	            }
	            */
		    });

 		});
		function searchFilter(page_num) {
		    page_num = page_num?page_num:0;
		    var keywords = $('#keywords').val();
		    var sortBy = $('#sortBy').val();
		    var numView = $('#numView').val();
		    var kategori = $('#kategori').val();
		    //set cookie
		    $.cookie("keywords", keywords);
		    $.cookie("sortBy", sortBy);
		    $.cookie("numView", numView);
		    $.cookie("kategori", kategori);
		    //alert($.cookie("keywords", keywords));
		    //end cookie
		    $.ajax({
		        type: 'POST',
		        url: '<?php echo base_url(); ?>products/ajaxPaginationData/'+page_num,
		        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&numView='+numView+'&kategori='+kategori,
		        beforeSend: function () {
		        	//$('#enquiryList').hide();
		        	//$('#enquiryList').slideUp('slow');
		        	//$('#enquiryList table tbody').fadeOut("fast");
		        	//$('#enquiryList table tbody').css({'filter':'alpha(opacity=0)', 'zoom':'1', 'opacity':'0'});
		        	//$('#loadoverlay').show();
		        	
		            $('.loading').show();
		        },
		        success: function (html) {

		            //$('#enquiryList').html(html).fadeIn('fast');
		            
		            //$('#enquiryList').html(html).slideDown('slow');
		            //$('.loading').fadeOut("slow");
		            
		            $('.loading').fadeOut( "fast", function() {
                        // Animation complete.
                        $('#enquiryList').html(html);
                        $('#enquiryList table tbody').hide().fadeIn();
                        //$('#loadoverlay').fadeOut("fast");
		            	//$('#enquiryList table tbody').fadeIn('fast');
		            	//$('#enquiryList table tbody').css({'filter':'alpha(opacity=100)', 'zoom':'1', 'opacity':'1'});
                    });
		            //alert('failure');
		        }
		    });
		}
		$("#reset-db").click(function(){
	        //var id = $(this).parents("tr").attr("id");


	        //if(confirm('Are you sure to remove this record ?'))
	        //{
	            $.ajax({
	               url: 'products/reset_products',
	               type: 'DELETE',
	               beforeSend: function () {
			        	//$('#enquiryList').hide();
			        	//$('#enquiryList').slideUp('slow');
			        	//$('#enquiryList table tbody').fadeOut("fast");
			        	//$('#enquiryList table tbody').css({'filter':'alpha(opacity=0)', 'zoom':'1', 'opacity':'0'});
			        	//$('#loadoverlay').show();
			        	//$('#enquiryList').html(html).hide().fadeOut();
			        	
			            $('.loading').show();
			        },
	               error: function() {
	                  alert('Something is wrong');
	               },
	               success: function(data) {
	                    //$("#"+id).remove();
	                    
	                    $('.loading').fadeOut( "fast", function() {
	                    	searchFilter();
	                        // Animation complete.
	                        //$('#enquiryList').html(html);
	                        //$('#enquiryList table tbody').hide().fadeIn();
	                        //$('#loadoverlay').fadeOut("fast");
			            	//$('#enquiryList table tbody').fadeIn('fast');
			            	//$('#enquiryList table tbody').css({'filter':'alpha(opacity=100)', 'zoom':'1', 'opacity':'1'});
	                    });
	                    //alert("Record removed successfully");  
	               }
	            });
	        //}
	    });
		</script>