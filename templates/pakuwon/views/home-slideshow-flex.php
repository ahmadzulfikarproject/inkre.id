<?php
$total = 6;
$headline = $this->model_utama->allslide(0, $total);
$jumlah = count($headline->result_array());
//echo $jumlah;

?>
<div class="slide-one-item home-slider owl-carousel">
  <?php

  //print_r($headline->result_array());
  $no = 1;

  foreach ($headline->result_array() as $key => $row) : ?>
    <?php
    $isi_slide = strip_tags($row['isi_slide']);
    $isi = substr($isi_slide, 0, 10000);
    // $isi = substr($isi_slide,0,strrpos($isi," "));
    //$tanggal = tgl_indo($row['tanggal']);
    if ($row['gambar'] == '') {
      $foto = 'small_no-image.jpg';
    } else {
      $foto = $row['gambar'];
    }
    if ($no == 1) {
      $aktif = 'active';
    } else {
      $aktif = '';
    }
    ?>
    <div class="site-blocks-cover overlay" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <!-- <div class="col">
          <img data-src="holder.js/600x400" alt="..." class="slide-caption-img d-none d-lg-block d-xl-block">
        </div> -->
          <div class="col-md-6 slide-caption">
            <h2 class="mb-2 bigtitle text-white font-weight-bold text-uppercasez"><?php echo $row['judul'] ?></h2>
            <div class="mb-5 text-white slide-caption-description d-nonez d-sm-blockz"><?php echo $row['isi_slide']; ?></div>
            <!-- <p class="slide-caption-btn text-white hidden-xs"><a href="<?php echo base_url(''); ?>" class="btn btn-whitez btn-primary btn-outline-white py-3 px-5 rounded-0 btn-2">See Details</a></p> -->
            <!-- <div class="row hidden">
            <div class="col-lg-3">
              
            </div>
            <div class="col">
              
            </div>
          </div> -->
          </div>
          <div class="col-md-6">
            <img alt="<?php echo $row['judul'] ?>" class="slide-caption-img" src="<?php echo base_url() . "asset/foto_slide/" . $foto; ?>">
          </div>
        </div>
      </div>
    </div>
    <?php $no++; ?>
  <?php endforeach; ?>

</div>