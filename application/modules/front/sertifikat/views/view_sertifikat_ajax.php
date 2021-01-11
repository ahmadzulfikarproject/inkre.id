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
		    <h1>sertifikat</h1>
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
	                		<option value="6">6</option>
	                		<option value="12">12</option>
		                	<option value="24">24</option>
		                	<option value="48">48</option>
		                	<option value="146">146</option>
		                	<option value="500">500</option>
		                	<option value="2000">2000</option>
		                </select> entries
	                </div>
	                
	            </div>    
	        </div>
	        <hr>
	        
		    <div class="row"> 
		        <div class="post-list col-xs-12 " id="enquiryList">
		        	<?php //echo $this->ajax_pagination->create_links(); ?>
		        	
		        	<input id="noview" type="text" name="noview" value="<?php echo $no; ?>" class="hidden">
		        	<div id="sertifikat-list" class="row">
			        	<?php if(!empty($posts)): $no = 1; foreach($posts as $post): ?>
			                <?php $isi_sertifikat = strip_tags($post['isi_sertifikat']); 
	                        $isi = substr($isi_sertifikat,0,100); 
	                        $isi = substr($isi_sertifikat,0,strrpos($isi," "));
	                        $hari = namahari($post['tgl_posting']);
	                        $tanggal = tgl_indo($post['tgl_posting']);
	                        //if ($post['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $post['gambar']; }
	                         if ($post['gambar'] == ''){
					                $foto = 'nophoto.jpg';
					            }
					        else{
					            $foto = getnameimage($post['gambar'],'_200_400');
					            
					            if (!file_exists("asset/foto_sertifikat/".$foto)) {
					                if (file_exists("asset/foto_sertifikat/".$post['gambar'])) {
					                    $foto = $post['gambar'];
					                }
					                else{
					                    $foto = 'nophoto.jpg';
					                }
					                
					                # code...
					            }
					            
					            //$foto = $post['gambar'];
					        }
	                        ?>
			                <div class="col-sm-2 col-sm-heightz col-md-heightz col-lg-heightz col-topz item-list">
	                            <div class="responsive-container box-item schfx" itemscope style="overflow: visible;">

	                                <div class="dummy50"></div>
	                                <a href="<?php echo base_url()."sertifikat/detail/".$post['slug']; ?>" class="img-container" data-toggle="tooltip" title="View image <?php echo $post['judul'] ?>">
	                                    <div class="centerer"></div>
	                                    <img alt="<?php echo $post['judul'] ?>" class='img-thumbnailz' src='<?php echo base_url()."asset/foto_sertifikat/".$foto ;?>' class='img-responsive'>  

	                                </a><!--img-container-->
	                                <div class="box-item-caption hidden">
	                                    <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo $hari.', '.$tanggal; //echo $post['hari'],','.$tanggal ?></small>
	                                    <h3 class="carousel-caption-headerz"><a href='<?php echo base_url()."sertifikat/detail/".$post['slug']; ?>'><?php echo $post['judul'] ?></a></h3>
	                                </div><!--kotak-item-caption-->

	                            </div><!--responsive-container-->
	                            <div class="kotak-item-title text-center hidden">
	                                <div class="box-title"><h3><a href='<?php echo base_url()."sertifikat/detail/".$post['slug']; ?>'><?php echo $post['judul'] ?></a></h3></div>
	                                <span class="box-price"><?php //harga($post['price']); ?></span>
	                            </div>
	                        </div><!--col-->
	                        <?php if ($no % 6 == 0): ?>
		                        <div style='clear:both'></div>
		                    <?php endif; ?>

			            <?php $no++; endforeach; else: ?>
			            <p>Post(s) not available.</p>
			            <?php endif; ?>
			            <div style='clear:both'></div>
		            </div>
		            <?php echo $this->ajax_pagination->create_links(); ?>
		        </div>

		        <div class="loading" style="display: none;"><div class="content"><img src="<?php echo home_url().'asset/images/loading.gif'; ?>"/></div></div>
		    </div>
		</div>

		
		<script src="<?php echo base_url(); ?>templates/<?php echo template(); ?>/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
 		<script type="text/javascript">
 			//alert('zzzzzzzzzzzz');
 		var $js = $.noConflict();
 		$js(document).ready(function(){
 			//alert('zzzzzzzzzzzz');
 			var noview = $js('#noview').val();
 			//alert(noview);
 			$js('#numView option[value='+noview+']').attr('selected','selected');
 			//alert('zzzzzzzzzzz');
 			var keywords = $js('#keywords').val();
		    var sortBy = $js('#sortBy').val();
		    var numView = $js('#numView').val();
		    var kategori = $js('#kategori').val();
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
		    var keywords = $js('#keywords').val();
		    var sortBy = $js('#sortBy').val();
		    var numView = $js('#numView').val();
		    var kategori = $js('#kategori').val();
		    //set cookie
		    $.cookie("keywords", keywords);
		    $.cookie("sortBy", sortBy);
		    $.cookie("numView", numView);
		    $.cookie("kategori", kategori);
		    //alert($.cookie("keywords", keywords));
		    //end cookie

		    $.ajax({
		        type: 'POST',
		        url: '<?php echo base_url(); ?>sertifikat/ajaxPaginationData/'+page_num,
		        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&numView='+numView+'&kategori='+kategori,
		        beforeSend: function () {
		        	//$js('#enquiryList').fadeOut("fast");
		        	//$js('#enquiryList').slideUp('slow');
		        	///$js('#enquiryList table tbody').fadeOut("fast");
		        	//$js('#sertifikat-list .item-list').fadeOut("fast");
		        	//$js('#enquiryList table tbody').css({'filter':'alpha(opacity=0)', 'zoom':'1', 'opacity':'0'});
		        	//$js('#loadoverlay').show();
		        	$js('#enquiryList').removeClass('fadeafter');
		        	$js('#enquiryList').addClass('fadebefore');
		            $js('.loading').show();
		        },
		        success: function (html) {
		        	
		            //$js('#enquiryList').html(html).fadeIn('fast');
		            
		            //$js('#enquiryList').html(html).slideDown('slow');
		            //$js('.loading').fadeOut("slow");
		            
		            $js('.loading').fadeOut( "fast", function() {
                        // Animation complete.
                        $js('#enquiryList').html(html);
                        //$js('#enquiryList').slideDown('slow');
                        
                        $js('#enquiryList').removeClass('fadebefore').addClass('fadeafter');
      					//$js('#enquiryList').addClass('fadebefore');
                        //$js('#enquiryList table tbody').hide().fadeIn();
                        //$js('#sertifikat-list .item-list').hide().fadeIn();
                        //$js('#loadoverlay').fadeOut("fast");
		            	//$js('#enquiryList table tbody').fadeIn('fast');
		            	//$js('#enquiryList table tbody').css({'filter':'alpha(opacity=100)', 'zoom':'1', 'opacity':'1'});
                    });
		            //alert('failure');
		            
		            

		        }
		    });
		}
		</script>