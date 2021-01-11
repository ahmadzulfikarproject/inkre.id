<?php
  $services = $this->model_utama_services->semua_services_categories(0, 12,7,'DESC')->result_array();
  //print_r($services);
  $pages = array_chunk($services, 3 );
  $no = 1;
  $totalpage = count($pages);
  $jumlah = $this->model_utama_services->semua_services_categories(0, 12,7,'DESC')->num_rows();
  //foreach ($headline->result_array() as $row): ?>
<?php if ($jumlah > 1): ?>
<section id="Services" class="ftco-sectionz ftco-properties bg-dark text-white" style="padding: 60px 0px;">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 border-primary text-center ftco-animate">
        <h2 class="font-weight-light text-white">Type 2 Badroom</h2>
        <span class="subheading">Show Unit</span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="services-slider owl-carousel ftco-animate">
          <?php foreach( $services as $ads => $row ): ?>
          <?php
          $content = strip_tags($row['isi_services']);
          //$isi = substr($content,0,100);
          $isi = word_limiter($content, 4);
          //$isi = substr($content,0,strrpos($isi," "));
          if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
          ?>
          <div class="item" data-aos="fade-up" data-aos-delay="0">
            <div class="properties bg-light p-2">
              <a href="#" class="hidden img d-flex justify-content-center align-items-center" style="background-image: url(<?php echo base_url()."asset/foto_services/".$foto ;?>);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="responsive-container border border-0 mb-0 imgz d-flex justify-content-center align-items-center" >
                <div class="dummy80"></div>
                <a href="<?php echo base_url()."services/detail/".$row['slug']; ?>" class="img-container" style="background-image: url(<?php echo base_url()."asset/foto_services/".$foto ;?>);">
                  <div class="centerer"></div>
                  <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url()."asset/foto_services/".$foto ;?>' class='img-responsive'>
                  <a href="<?php echo base_url()."services/detail/".$row['slug']; ?>"></a>
                </a><!--img-container-->
                <a href="<?php echo base_url()."services/detail/".$row['slug']; ?>" class="icon d-flex justify-content-center align-items-center">
                  <span href="<?php echo base_url()."services/detail/".$row['slug']; ?>" class="icon-search2"></span>
                </a>
              </div>
              <div class="text p-3 bg-primary text-white border border-0">
                <!-- <span class="status sale">Sale</span> -->
                <div class="d-flex">
                  <div class="">
                    <h3><a class="text-light" href="<?php echo base_url()."services/detail/".$row['slug']; ?>"><?php echo $row['judul'] ?></a></h3>
                    <!-- <p><?php echo $isi; ?></p> -->
                  </div>
                </div>
              </div>
              <div class="box-shadow"></div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
