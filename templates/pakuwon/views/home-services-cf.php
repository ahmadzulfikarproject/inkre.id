<?php
  $services = $this->model_utama_services->semua_services(0, 12)->result_array();
  //print_r($services);
  $pages = array_chunk($services, 3 );
  $no = 1;
  $totalpage = count($pages);
  $jumlah = $this->model_utama_services->semua_services(0, 12)->num_rows();
  //foreach ($headline->result_array() as $row): ?>
<?php if ($jumlah > 1): ?>
<section id="Services" class="ftco-sectionz ftco-properties text-primary bg-white pb-5 pt-5" data-aos="fade-up">
  <div class="container overlap-sectionz">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 border-primary text-center ftco-animate">
        <h2 class="font-weight-light text-primary">Recent Services</h2>
        <span class="subheading ">jasa dan layanan kami</span>
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
          //if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
          
          $foto = ($row['gambar']) ? getnameimage($row['gambar'],'_200_400') : 'nophoto.jpg' ;
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
                <div class="icon d-flex justify-content-center align-items-center">
                  <a href="<?php echo base_url()."services/detail/".$row['slug']; ?>" class="icon-search2"></a>
                </div>
              </div>
              <div class="text p-3 bg-primary text-primary border border-0 hidden">
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
            <div class="text p-3 bg-primaryz text-primary border border-0">
                <!-- <span class="status sale">Sale</span> -->
                <div class="d-flex">
                  <div class="">
                    <h3><a class="text-lightz text-primary" href="<?php echo base_url()."services/detail/".$row['slug']; ?>"><?php echo $row['judul'] ?></a></h3>
                    <!-- <p><?php echo $isi; ?></p> -->
                  </div>
                </div>
              </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
