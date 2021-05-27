<?php
$ids = array();
$services = $this->model_utama_services->semua_services_categories_array(0, 12, $ids, 'DESC')->result_array();
//print_r($services);
$pages = array_chunk($services, 3);
$no = 1;
$totalpage = count($pages);
$jumlah = $this->model_utama_services->semua_services_categories_array(0, 12, $ids, 'DESC')->num_rows();
//foreach ($headline->result_array() as $row): 
?>
<?php if ($jumlah > 1) : ?>
  <section id="Services" class="ftco-sectionz ftco-properties bg-primary pb-5 pt-5">
    <div class="container overlap-sectionz">
      <div class="row">
        <div class="col-md-12">
          <div class="bg-primaryz rounded p-4 text-white-50 shadow-lg">
            <div class="row align-items-center justify-content-center d-flex">
              <div class="col-md-12 order-md-1 border-primaryz text-center ftco-animate">
                <div class="bg-primaryz text-white p-4" data-aos="fade-right" data-aos-delay="400">
                  <h2 class="mb-0"><strong>Our Services</strong></h2>
                  <p>Jasa dan pelayanan kami</p>
                </div>
              </div>
              <div class="col-md-12 order-md-2 ftco-animate" data-aos="fade-left" data-aos-delay="400">
                <div class="services-slider-2 owl-carousel ftco-animate">
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
                    <div class="item shadow bg-white rounded" data-aos="fade-up" data-aos-delay="0">
                      <div class="properties rounded bg-light p-2 m-0 unit-1">
                        <a href="#" class="hidden img d-flex justify-content-center align-items-center" style="background-image: url(<?php echo base_url() . "asset/foto_services/" . $foto; ?>);">
                          <div class="icon d-flex justify-content-center align-items-center">
                            <span class="icon-search2"></span>
                          </div>
                        </a>
                        <div class="responsive-container border border-0 mb-0 imgz d-flex justify-content-center align-items-center">
                          <div class="dummy80"></div>
                          <a href="<?php echo base_url() . "services/detail/" . $row['slug']; ?>" class="img-container" style="background-image: url(<?php echo base_url() . "asset/foto_services/" . $foto; ?>);">
                            <div class="centerer"></div>
                            <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url() . "asset/foto_services/" . $foto; ?>' class='img-responsive'>
                            <a href="<?php echo base_url() . "services/detail/" . $row['slug']; ?>"></a>
                          </a>
                          <!--img-container-->
                          <a href="<?php echo base_url() . "services/detail/" . $row['slug']; ?>" class="icon d-flex justify-content-center align-items-center">
                            <span class="icon-search2"></span>
                          </a>
                        </div>
                        <div class="unit-1-text p-2">
                          <h5 class="unit-1-heading mb-0 font-weight-bold"><?php echo $row['judul'] ?></h5>
                          <p class="px-5 hidden"><?php echo $isi; ?></p>
                        </div>
                        <div class="text p-3 bg-primary text-white border border-0 hidden">
                          <!-- <span class="status sale">Sale</span> -->
                          <div class="d-flex">
                            <div class="">
                              <h3><a class="text-light" href="<?php echo base_url() . "services/detail/" . $row['slug']; ?>"><?php echo $row['judul'] ?></a></h3>
                              <!-- <p><?php echo $isi; ?></p> -->
                            </div>
                          </div>
                        </div>
                        <!-- <div class="box-shadow"></div> -->
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>