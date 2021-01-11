<?php
$services = $this->model_utama_services->semua_services(0, 12)->result_array();
//print_r($services);
$pages = array_chunk($services, 3);
$no = 1;
$totalpage = count($pages);
$jumlah = $this->model_utama_services->semua_services(0, 12)->num_rows();

?>
<?php if ($jumlah > 1) : ?>
  <div class="site-section block-13">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 border-primary text-center ftco-animate">
          <h2 class="font-weight-light text-primary">Recent Services</h2>
          <span class="subheading">Services</span>
        </div>
      </div>
    </div>


    <div class="owl-carousel nonloop-block-13">
      <?php foreach ($services as $ads => $row) : ?>
        <?php
        $content = strip_tags($row['isi_services']);
        //$isi = substr($content,0,100);
        $isi = word_limiter($content, 4);
        //$isi = substr($content,0,strrpos($isi," "));
        if ($row['gambar'] == '') {
          $foto = 'nophoto.jpg';
        } else {
          $foto = $row['gambar'];
        }
        ?>
        <div>
          <a href="<?php echo base_url() . "services/detail/" . $row['slug']; ?>" class="unit-1 text-center">
            <div class="responsive-container imgz d-flex justify-content-center align-items-center">
              <div class="dummy"></div>
              <div class="img-container" style="background-image: url(<?php echo base_url() . "asset/foto_services/" . $foto; ?>);">
                <div class="centerer"></div>
              </div>
              <!--img-container-->
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="icon-search2"></span>
              </div>
            </div>
            <div class="unit-1-text">
              <h3 class="unit-1-heading"><?php echo $row['judul'] ?></h3>
              <p class="px-5"><?php echo $isi; ?></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
<?php endif; ?>