<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo home_url().'asset/settings/'.setting('site_header'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center">

			<div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
				<h1 class="text-white font-weight-light text-uppercase"><?php echo $this->template->title; ?></h1>
				<p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span>products</span></p>
			</div>
		</div>
	</div>
</div>
<section class="site-section">
	<div class="container">
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
				<div id="products-list" class="row">
					<?php if (!empty($posts)) : $no = 1;
						foreach ($posts as $post) : ?>
							<?php $isi_products = strip_tags($post['isi_products']);
							$isi = substr($isi_products, 0, 100);
							$isi = substr($isi_products, 0, strrpos($isi, " "));
							$hari = namahari($post['created_time']);
							$tanggal = tgl_indo($post['created_time']);
							//if ($post['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $post['gambar']; }
							if ($post['gambar'] == '') {
								$foto = 'nophoto.jpg';
							} else {
								$foto = getnameimage($post['gambar'], '_200_400');

								if (!file_exists("asset/foto_products/" . $foto)) {
									if (file_exists("asset/foto_products/" . $post['gambar'])) {
										$foto = $post['gambar'];
									} else {
										$foto = 'nophoto.jpg';
									}

									# code...
								}

								//$foto = $post['gambar'];
							}
							?>
							<div class="col-sm-4 col-sm-heightz col-md-heightz col-lg-heightz col-topz item-list">
								<div class="h-entry" data-aos="fade-up" data-aos-delay="0">
									<div class="responsive-container box-item schfx" itemscope>

										<div class="dummy80"></div>
										<a href="<?php echo base_url() . "products/detail/" . $post['slug']; ?>" class="img-container" data-toggle="tooltip" data-placement="top" title="<?php echo $post['judul'] ?>" style="background-image: url('<?php echo base_url() . "asset/foto_products/" . $foto; ?>');">
											<div class="centerer"></div>
											<img alt="<?php echo $post['judul'] ?>" class='img-thumbnailz hidden' src='<?php echo base_url() . "asset/foto_products/" . $foto; ?>' class='img-responsive'>
										</a>
										<!--img-container-->

									</div>
									<!--responsive-container-->
									<h2 class="font-size-regular"><a href='<?php echo base_url() . "products/detail/" . $post['slug']; ?>'><?php echo $post['judul'] ?></a></h2>
									<div class="meta mb-4"><?php echo namahari($post['created_time']) . ', ' . tanggalindo($post['created_time'], 'd M Y H:i'); ?> <span class="mx-2">&bullet;</span> <?php echo $post['username'] ?></div>
								</div>
							</div>
							<!--col-->
							<?php if ($no % 3 == 0) : ?>
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
	</div>
</section>


<?php
ob_start();
?>
<script type="text/javascript" data-minify-level="0">
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
			url: '<?php echo base_url(); ?>products/ajaxPaginationData/' + page_num,
			data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&numView=' + numView + '&kategori=' + kategori,
			beforeSend: function() {
				//$('#enquiryList').fadeOut("fast");
				//$('#enquiryList').slideUp('slow');
				///$('#enquiryList table tbody').fadeOut("fast");
				//$('#products-list .item-list').fadeOut("fast");
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
					//$('#products-list .item-list').hide().fadeIn();
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