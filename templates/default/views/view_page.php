<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url() . '/asset/' . imgheader(); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center">
			<div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
				<h1 class="text-white font-weight-light text-uppercase font-weight-bold"><?php echo $record['judul'] ?></h1>

				<!-- <p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span><?php echo $record['judul'] ?></span></p> -->
			</div>
		</div>
	</div>
</div>
<div class="breadcrumb rounded-0 p-0">
	<div class="container">
		<div class="col"><?= $breadcrumbs; ?></div>
	</div>
</div>
<section id="page" class="site-section images_gallery">
	<div class="container" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
		<div class="row">
			<?php
			$tanggal = tgl_indo($record['tgl_posting']);
			//echo "<div class='col-md-12'><p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $record[judul]</p></div><hr>
			?>
			<div class='col-md-12'>
				<div class="kontenpage hero row">
					<?php if ($record['gambar'] != '') : ?>
						<div class="col-md-3 ml-auto mb-5 order-md-2">
							<!-- <img alt="<?php echo $record['judul'] ?>" class="img-fluid rounded" width='100%' src='<?php echo base_url() . "asset/foto_statis/" . $record['gambar'] ?>'> -->

							<div class="responsive-container box-item schfx" itemscope>
								<div class="dummy50"></div>
								<a href="<?php echo base_url() . "asset/foto_statis/" . $record['gambar'] ?>" class="img-container photobox_a" style="background-image: url('<?php echo base_url() . "asset/foto_statis/" . $record['gambar'] ?>');">
									<div class="centerer"></div>
									<img class='img-thumbnailz hidden' src='<?php echo base_url() . "asset/foto_statis/" . $record['gambar'] ?>' class='img-responsive'>
								</a>
								<!--img-container-->
							</div>
						</div>
					<?php endif; ?>
					<div class="col-md-9 order-md-1">
						<div class="text-left pb-1 border-primary mb-4">
							<h2 class="text-primary"><?php echo $record['judul'] ?></h2>
						</div>
						<p><?php echo $record['isi_pages'] ?></p>
					</div>
				</div>
			</div>
			<div style='clear:both'><br></div>

		</div>
	</div>
</section>