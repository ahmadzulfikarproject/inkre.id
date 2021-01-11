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
		    <h1>clients</h1>
	        <div class="row">
	            <div class="col-xs-12 col-sm-4">
	                <div class="input-group">		          
	                    <input type="text" class="form-control" id="keywords" placeholder="Type keywords to filter data" onkeyup="searchFilter()"/>
	                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
	                </div>
	            </div>
	            <div class="col-xs-12 col-sm-8">
	            	<div class="input-group pull-left">
	            		<select id="kategori" class="form-control" onchange="searchFilter()">
	                      <option value=''>- Pilih Kategori -</option>
	                      <?php foreach ($categories->result_array() as $row): ?>	                          
	                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>	                          
	                      <?php endforeach; ?>
	                    </select>
	            	</div>
	                <div class="input-group pull-left">
	                    <select class="form-control" id="sortBy" onchange="searchFilter()">
			                <option value="">Sort By</option>
			                <option value="titleasc">Title Ascending</option>
			                <option value="titledesc">Title Descending</option>
			                <option value="dateasc">Date Ascending</option>
			                <option value="datedesc">Date Descending</option>
			            </select>  
	                </div>
	                <div class="input-group pull-left">
	                	<label class="">Show</label>
	                	<select id="numView" name="example1_length" aria-controls="example1" class="form-control" onchange="searchFilter()">
	                		<option value="4">4</option>
	                		<option value="10">10</option>
		                	<option value="25">25</option>
		                	<option value="50">50</option>
		                	<option value="100">100</option>
		                	<option value="500">500</option>
		                	<option value="2000">2000</option>
		                </select> entries
	                </div>
	                
	            </div>    
	        </div>
	        <hr>
	        <div class="row">
        		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        			<div class="input-group pull-left">
	                	<div class="btn-group is-admin">
	                		<a target="_blank" href="<?php echo base_url('clients/save'); ?>" class="btn-default btn btn-sm"><i class="fas fa-file-excel"></i> Export xls</a>
	                		<a target="_blank" href="<?php echo base_url('clients/savepdf'); ?>" class="btn-default btn btn-sm"><i class="fas fa-file-pdf"></i> Export pdf</a>
	                		<a href="<?php echo base_url('clients/import'); ?>" class="btn-default btn btn-sm"><i class="fas fa-upload"></i> Import</a>

	                	</div>
	                </div>
        			<div class="btn-group pull-right">
                  		<a class='btn btn-primary btn-sm' href='<?php echo base_url(); ?>clients/tambah_clients'><i class="fa fa-plus-circle"></i> Tambahkan Data</a>
		        		<a class='btn btn-info btn-sm' href='<?php echo base_url(); ?>clients/update_semua_clientsku'>update slug clients</a>
		        		<a href="#resetModal" class="btn btn-lg btn-primary btn-sm" data-toggle="modal">Reset clients DB</a>
		        	</div>
        		</div>
        	</div>
		    <div class="row"> 
		        <div class="post-list col-xs-12" id="enquiryList">
		        	<?php //echo $this->ajax_pagination->create_links(); ?>
		        	
		        	<input id="noview" type="text" name="noview" value="<?php echo $no; ?>" class="hidden">
		        	<table class="table table-striped table-hover">
		        		<thead>
		        			<tr>
		        				<th>No.</th>
		        				<th>Title <?php echo $this->lang->line('name') ?></th>
		        				<th>Kategori</th>
		        				<th>Read</th>
		        				<th>Date</th>
		        				<th>Action</th>
		        			</tr>
		        		</thead>
		        		<tbody>
	
		        			<?php $no = $start; if(!empty($posts)): foreach($posts as $post): ?>
		        				<?php 
			        				if ($post['id_categories']=='0'){
				                      $kategori = '<i style="color:red">Pending</i>';
				                    }else{
				                      $kategori = categories($post['id_categories']);//$post['nama_kategori'];
				                    }
		        				 ?>
				                <tr class="list-item">
				                	<td><?php echo $no+1; ?></td>
				                	<td>
				                		<a href="<?php echo base_url('clients/edit_clients/').$post['id_clients']; ?>"><?php echo $post['judul']; ?></a>
				                	</td>
				                	<td><?php echo $kategori; ?></td>
				                	<td><?php if ($post['clients_views'] > 0){echo $post['clients_views'].' Kali';}?></td>
				                	<td><?php echo tanggalindo($post['tgl_posting'],"d-m-Y H:i:s"); //echo tgl_indo($post['tanggal']) ?></td>
				                	<td><center>
			                                <a class='btn btn-success btn-xs' title='Edit Data' href='<?php echo base_url('clients/edit_clients/').$post['id_clients']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
			                                <a class='btn btn-danger btn-xs' title='Delete Data' href='<?php echo base_url('clients/delete_clients/').$post['id_clients']; ?>' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
			                            </center>
		                          	</td>
						        </tr>
				            <?php $no++; endforeach; else: ?>
				            <p>Post(s) not available.</p>
				            <?php endif; ?>
		        			
		        		</tbody>
		        	</table>
		            <?php if(!empty($posts)): foreach($posts as $post): ?>
		                <div class="list-itemz hidden"><a href="javascript:void(0);"><h2><?php echo $post['name']; ?></h2></a></div>
		            <?php endforeach; else: ?>
		            <p>Post(s) not available.</p>
		            <?php endif; ?>
		            <?php echo $this->ajax_pagination->create_links(); ?>
		        </div>

		        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo home_url().'asset/images/loading.gif'; ?>"/></div></div>
		    </div>
		</div>

		<!-- Modal HTML -->
	    <div id="resetModal" class="modal fade">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                    <h4 class="modal-title">Confirmation</h4>
	                </div>
	                <div class="modal-body">
	                    <p>Do you want to save changes you made to document before closing?</p>
	                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	                    <!--<a id="reset-db" href='<?php //echo base_url('clients/reset'); ?>' class='btn-default btn btn-sm'>Reset</a>-->
	                    <button id="reset-db" type="button" class="btn btn-primary" data-dismiss="modal">Reset</button>
	                </div>
	            </div>
	        </div>
	    </div>

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
		        url: '<?php echo base_url(); ?>clients/ajaxPaginationData/'+page_num,
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
	               url: 'clients/reset_clients',
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