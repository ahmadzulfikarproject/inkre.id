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
		    <h1>Enquiry Data</h1>
	        <div class="row">
	            <div class="col-xs-12 col-sm-4">
	                <div class="input-group">		          
	                    <input type="text" class="form-control" id="keywords" placeholder="Type keywords to filter data" onkeyup="searchFilter()"/>
	                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
	                </div>
	            </div>
	            <div class="col-xs-12 col-sm-8">
	                <div class="input-group pull-left">
	                    <select class="form-control" id="sortBy" onchange="searchFilter()">
			                <option value="">Sort By</option>
			                <option value="asc">Ascending</option>
			                <option value="desc">Descending</option>
			            </select>  
	                </div>
	                <div class="input-group pull-left">
	                	<label class="">Show</label>
	                	<select id="numView" name="example1_length" aria-controls="example1" class="form-control" onchange="searchFilter()">
	                		<option value="10">10</option>
		                	<option value="25">25</option>
		                	<option value="50">50</option>
		                	<option value="100">100</option>
		                	<option value="500">500</option>
		                	<option value="2000">2000</option>
		                </select> entries
	                </div>
	                <div class="input-group pull-left">
	                	<div class="btn-group is-admin">
	                		<a target="_blank" href="<?php echo base_url('data/save'); ?>" class="btn-primary btn"><i class="fas fa-file-excel"></i> Save to XLSX</a>
	                		<a target="_blank" href="<?php echo base_url('data/savepdf'); ?>" class="btn-primary btn"><i class="fas fa-file-pdf"></i> Save Pdf</a>
	                		<a href="<?php echo base_url('data/import'); ?>" class="btn-primary btn"><i class="fas fa-upload"></i> Import</a>

	                	</div>
	                </div>
	            </div>    
	        </div>
		    <div class="row"> 
		        <div class="post-list col-xs-12" id="enquiryList">
		        	<?php echo $this->ajax_pagination->create_links(); ?>
		        	<table class="table table-striped table-hover">
		        		<thead>
		        			<tr>
		        				<th>No.</th>
		        				<th>Nama</th>
		        				<th>Telp.</th>
		        				<th>Pesan</th>
		        				<th>date</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?php $no = $start; if(!empty($posts)): foreach($posts as $post): ?>
				                <tr class="list-item">
				                	<td><?php echo $no+1; ?></td>
				                	<td>
				                		<a href="javascript:void(0);"><?php echo $post['name']; ?></a>
				                	</td>
				                	<td><?php echo $post['phone']; ?></td>
				                	<td><?php echo $post['message']; ?></td>
				                	<td><?php echo tanggalindo($post['date'],"d-m-Y H:i:s"); //echo tgl_indo($post['tanggal']) ?></td>
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
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
 		<script>
 		$(document).ready(function(){
 			//alert('zzzzzzzzzzz');
 			var keywords = $('#keywords').val();
		    var sortBy = $('#sortBy').val();
		    var numView = $('#numView').val();
		    //set cookie
		    $.cookie("keywords", keywords);
		    $.cookie("sortBy", sortBy);
		    $.cookie("numView", numView);
		    //alert($.cookie("keywords", keywords));
		    //end cookie
 		});
		function searchFilter(page_num) {
		    page_num = page_num?page_num:0;
		    var keywords = $('#keywords').val();
		    var sortBy = $('#sortBy').val();
		    var numView = $('#numView').val();
		    //set cookie
		    $.cookie("keywords", keywords);
		    $.cookie("sortBy", sortBy);
		    $.cookie("numView", numView);
		    //alert($.cookie("keywords", keywords));
		    //end cookie
		    $.ajax({
		        type: 'POST',
		        url: '<?php echo base_url(); ?>data/ajaxPaginationData/'+page_num,
		        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&numView='+numView,
		        beforeSend: function () {
		        	//$('#enquiryList').hide();
		        	//$('#enquiryList').slideUp('slow');
		        	$('#enquiryList table tbody').fadeOut("fast");
		            $('.loading').show();
		        },
		        success: function (html) {

		            //$('#enquiryList').html(html).fadeIn('fast');
		            
		            //$('#enquiryList').html(html).slideDown('slow');
		            //$('.loading').fadeOut("slow");
		            $('.loading').fadeOut( "fast", function() {
                        // Animation complete.
                        $('#enquiryList').html(html);
		            	$('#enquiryList table tbody').fadeIn('fast');
                    });
		            //alert('failure');
		        }
		    });
		}
		$('#GetFile').on('click', function () {
		    $.ajax({
		        url: '<?php echo base_url('data/savepdf'); ?>',
		        method: 'GET',
		        xhrFields: {
		            responseType: 'blob'
		        },
		        success: function (data) {
		            var a = document.createElement('a');
		            var url = window.URL.createObjectURL(data);
		            a.href = url;
		            a.download = 'myfile.pdf';
		            a.click();
		            window.URL.revokeObjectURL(url);
		        }
		    });
		});
		</script>