<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo home_url().'asset/settings/'.setting('site_header'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center">

			<div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
				<h1 class="text-white font-weight-light text-uppercase font-weight-bold">Clients</h1>
				<p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span>Clients</span></p>
			</div>
		</div>
	</div>
</div>
<section class="site-section">
	<div class="container site-section">
		<div class="text-left pb-1 border-primary mb-4">
			<h2 class="text-primary"><?php echo $this->template->title; ?></h2>
		</div>
		<div class="row search-nav">
			<div class="col-lg-6">
				<div class="input-group">
					<input type="text" class="form-control" id="keywords" placeholder="Type keywords to filter data" onkeyup="searchFilter()" />
					<div class="input-group-append">
						<select id="kategori" class="form-control" onchange="searchFilter()">
							<option value=''>- Pilih Kategori -</option>
							<?php foreach ($categories->result_array() as $row) : ?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
							<?php endforeach; ?>
						</select>
						<button class="btn btn-secondary" type="button"><span class="icon icon-search2"></span></button>
					</div>
				</div>
			</div>
			<div class="col-auto">
				<select class="form-control" id="sortBy" onchange="searchFilter()">
					<option value="">Sort By</option>
					<option value="titleasc">Title Asc</option>
					<option value="titledesc">Title Desc</option>
					<option value="dateasc">Date Asc</option>
					<option value="datedesc">Date Desc</option>
				</select>
			</div>
			<div class="col-auto">
				<select id="numView" name="example1_length" aria-controls="example1" class="form-control" onchange="searchFilter()">
					<option value="3">3</option>
					<option value="6" selected="selected">6</option>
					<option value="12">12</option>
					<option value="24">24</option>
					<option value="48">48</option>
					<option value="146">146</option>
					<option value="500">500</option>
					<option value="2000">2000</option>
				</select>
			</div>
		</div>
		<hr>

		<div class="row">
			<div class="post-list col-lg-12 " id="enquiryList">
				<?php 
				?>

				<input id="noview" type="text" name="noview" value="<?php echo $no; ?>" class="hidden">
				<div id="clients-list" class="row">
					<?php if (!empty($posts)) : $no = 1;
						foreach ($posts as $post) : ?>
							<?php $isi_clients = strip_tags($post['isi_clients']);
							$isi = substr($isi_clients, 0, 100);
							$isi = substr($isi_clients, 0, strrpos($isi, " "));
							$hari = namahari($post['created_time']);
							$tanggal = tgl_indo($post['created_time']);
							//if ($post['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $post['gambar']; }
							if ($post['gambar'] == '') {
								$foto = 'nophoto.jpg';
							} else {
								$foto = getnameimage($post['gambar'], '_200_400');

								if (!file_exists("asset/foto_clients/" . $foto)) {
									if (file_exists("asset/foto_clients/" . $post['gambar'])) {
										$foto = $post['gambar'];
									} else {
										$foto = 'nophoto.jpg';
									}

									# code...
								}

								//$foto = $post['gambar'];
							}
							?>
							<div class="col-sm-2 col-sm-heightz col-md-heightz col-lg-heightz col-topz item-list">
								<div class="responsive-container shadow mb-5 bg-white rounded box-item schfx" itemscope style="overflow: visible;">

									<div class="dummy50"></div>
									<a href="<?php echo base_url() . "clients/detail/" . $post['slug']; ?>" class="img-container p-3 " data-toggle="tooltip" title="View image <?php echo $post['judul'] ?>">
										<div class="centerer"></div>
										<img alt="<?php echo $post['judul'] ?>" class='img-thumbnailz' src='<?php echo base_url() . "asset/foto_clients/" . $foto; ?>' class='img-responsive'>

									</a>
									<!--img-container-->
									<div class="box-item-caption hidden">
										<small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo $hari . ', ' . $tanggal; 
																														?></small>
										<h3 class="carousel-caption-headerz"><a href='<?php echo base_url() . "clients/detail/" . $post['slug']; ?>'><?php echo $post['judul'] ?></a></h3>
									</div>
									<!--kotak-item-caption-->

								</div>
								<!--responsive-container-->
								<div class="kotak-item-title text-center hidden">
									<div class="box-title">
										<h3><a href='<?php echo base_url() . "clients/detail/" . $post['slug']; ?>'><?php echo $post['judul'] ?></a></h3>
									</div>
									<span class="box-price"><?php 
															?></span>
								</div>
							</div>
							<!--col-->
							<?php if ($no % 6 == 0) : ?>
								<div style='clear:both'></div>
							<?php endif; ?>

							<?php $no++;
						endforeach;
					else : ?>
						<p>Post(s) not available.</p>
					<?php endif; ?>
					<div style='clear:both'></div>
				</div>
				<?php echo $this->ajax_pagination->create_links(); ?>
			</div>

			<div class="loading" style="display: none;">
				<div class="content"><img src="<?php echo home_url() . 'asset/images/loading.gif'; ?>" /></div>
			</div>
		</div>
	</div>
</section>


<?php
ob_start();
?>
<script type="text/javascript">
	//alert('zzzzzzzzzzzz');
	// var $js = $.noConflict();
	$(document).ready(function() {
		//alert('zzzzzzzzzzzz');
		var noview = $('#noview').val();
		//alert(noview);
		$('#numView option[value=' + noview + ']').attr('selected', 'selected');
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
		page_num = page_num ? page_num : 0;
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
			url: '<?php echo base_url(); ?>clients/ajaxPaginationData/' + page_num,
			data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&numView=' + numView + '&kategori=' + kategori,
			beforeSend: function() {
				//$('#enquiryList').fadeOut("fast");
				//$('#enquiryList').slideUp('slow');
				///$('#enquiryList table tbody').fadeOut("fast");
				//$('#clients-list .item-list').fadeOut("fast");
				//$('#enquiryList table tbody').css({'filter':'alpha(opacity=0)', 'zoom':'1', 'opacity':'0'});
				//$('#loadoverlay').show();
				$('#enquiryList').removeClass('fadeafter');
				$('#enquiryList').addClass('fadebefore');
				$('.loading').show();
			},
			success: function(html) {

				//$('#enquiryList').html(html).fadeIn('fast');

				//$('#enquiryList').html(html).slideDown('slow');
				//$('.loading').fadeOut("slow");

				$('.loading').fadeOut("fast", function() {
					// Animation complete.
					$('#enquiryList').html(html);
					//$('#enquiryList').slideDown('slow');

					$('#enquiryList').removeClass('fadebefore').addClass('fadeafter');
					//$('#enquiryList').addClass('fadebefore');
					//$('#enquiryList table tbody').hide().fadeIn();
					//$('#clients-list .item-list').hide().fadeIn();
					//$('#loadoverlay').fadeOut("fast");
					//$('#enquiryList table tbody').fadeIn('fast');
					//$('#enquiryList table tbody').css({'filter':'alpha(opacity=100)', 'zoom':'1', 'opacity':'1'});
				});
				//alert('failure');



			}
		});
	}
</script>

<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>