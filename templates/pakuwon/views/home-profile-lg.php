<?php
$data = $this->model_utama->page_detailku(1)->row_array();
$tanggal = tgl_indo($data['tgl_posting']);
$string = word_limiter(strip_tags($data['isi_pages'], '<p></p><a></a>'), 50);
//$idwebsite = $this->db->query("SELECT * FROM identitas")->row_array();
$idwebsite = $this->model_identitas->identitas()->row_array();
//echo "$idwebsite[img_profil]";
//echo idwebsite('img_profil');
//print_r($idwebsite);
?>
<div id="profile-home" class="propertiesz site-section bg-primary text-white">
    <div class="container" data-aos="fade-right" data-aos-delay="400">

        <div class="row align-items-top justify-content-center d-flex">
            <div class="col-md-4 order-md-1 pb-5 pb-sm-0">
                <img alt="<?php echo $data['judul'] ?>" class="thumbnail shadow bg-white rounded" src="<?php echo base_url(image("asset/foto_statis/" . $data['gambar'], "large")); ?>" />
                <div class="hidden responsive-container imgz d-flex justify-content-center align-items-center" style="border-width: 10px;">
                    <div class="dummy50"></div>
                    <div class="img-container" style="background-image: url(<?php echo base_url(image("asset/foto_statis/" . $data['gambar'], "large")); ?>);">
                        <div class="centerer"></div>
                        <!-- <img alt="<?php echo $data['judul'] ?>" class="thumbnail" src="<?php echo base_url(image("asset/foto_statis/" . $data['gambar'], "large")); ?>" /> -->
                    </div>
                    <!--img-container-->
                    <div class="icon d-flex justify-content-center align-items-center">
                        <a href="<?php echo base_url() . 'page/detail/' . $data['slug']; ?>"><span class="icon-search2"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 order-md-2">
                <h5 class="text-warning"><?php echo $data['judul']; ?></h5>
                <h2 class="mb-4"><?php echo setting('site_name'); ?></h2>
                <?= $string; ?>
                <? //= $data['isi_pages']; 
                ?>
                <div class="clearfix"></div>
                <a href="<?php echo base_url() . 'page/detail/' . $data['slug']; ?>" class="btn btn-warning mt-2"><span class="icon-search2"></span> Read More...</a>
            </div>
        </div>
    </div>
</div>