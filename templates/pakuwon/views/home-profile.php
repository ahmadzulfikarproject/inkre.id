<?php
$data = $this->model_utama->page_detailku(1)->row_array();
$tanggal = tgl_indo($data['tgl_posting']);
$string = word_limiter(strip_tags($data['isi_pages'], '<p><a>'), 6);
//$idwebsite = $this->db->query("SELECT * FROM identitas")->row_array();
$idwebsite = $this->model_identitas->identitas()->row_array();
//echo "$idwebsite[img_profil]";
//echo idwebsite('img_profil');
//print_r($idwebsite);
?>
<div id="profile-home" class="properties">
	<div class="">
		<h2 class="mb-4"><strong><?php echo setting('site_name'); ?></strong></h2>
		<div class="responsive-container imgz d-flex justify-content-center align-items-center">
			<div class="dummy50"></div>
			<div class="img-container" style="background-image: url(<?php echo base_url(image("asset/foto_statis/" . $data['gambar'], "large")); ?>);">
				<div class="centerer"></div>
				<img alt="<?php echo $data['judul'] ?>" class="thumbnail" src="<?php echo base_url(image("asset/foto_statis/" . $data['gambar'], "large")); ?>" />
			</div>
			<!--img-container-->
			<div class="icon d-flex justify-content-center align-items-center">
				<a href="<?php echo base_url() . 'page/detail/' . $data['slug']; ?>"><span class="icon-search2"></span></a>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<?= $string; ?>
		<?php //echo anchor(base_url() . 'page/detail/' . $data['slug'], 'Read More', 'class="btn-blockz readmore btn btn-default"'); ?>
	</div>
</div>