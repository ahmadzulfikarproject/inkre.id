<?php
  $sertifikat = $this->model_utama->semua_sertifikat(0, 12)->result_array();
  //print_r($sertifikat);
  $pages = array_chunk($sertifikat, 3 );
  $no = 1;
  $totalpage = count($pages);
  $jumlah = $this->model_utama->semua_sertifikat(0, 12)->num_rows();
  //foreach ($headline->result_array() as $row): ?>
<?php if ($jumlah > 1): ?>
<section id="sertifikat" class="ftco-section ftco-properties">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
        <span class="subheading">Sertifikat</span>
        <h2 class="mb-4">Recent Sertifikat</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="logo-slider owl-carousel ftco-animate">
          <?php foreach( $sertifikat as $ads => $row ): ?>
          <?php
          $content = strip_tags($row['isi_sertifikat']);
          //$isi = substr($content,0,700);
          $isi = word_limiter($content, 4);
          //$isi = substr($content,0,strrpos($isi," "));
          if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
          ?>
          <div class="item" data-aos="fade-up" data-aos-delay="0">
            <div class="properties">
              <a href="#" class="img d-flex justify-content-center align-items-center" style="background-image: url(<?php echo base_url()."asset/foto_sertifikat/".$foto ;?>);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="text p-3">
                <span class="status sale">Sale</span>
                <div class="d-flex">
                  <div class="one">
                    <h3><a href="#"><?php echo $row['judul'] ?></a></h3>
                    <p><?php echo $isi; ?></p>
                  </div>
                  <div class="two">
                    <span class="price">$20,000</span>
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
