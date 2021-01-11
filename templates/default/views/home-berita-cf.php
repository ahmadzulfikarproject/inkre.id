<?php
  $berita = $this->model_utama->semua_berita(0, 12)->result_array();
  //print_r($berita);
  $pages = array_chunk($berita, 3 );
  $no = 1;
  $totalpage = count($pages);
  $jumlah = $this->model_utama->semua_berita(0, 12)->num_rows();
  //foreach ($headline->result_array() as $row): ?>
<?php if ($jumlah > 1): ?>
<section id="berita" class="ftco-section ftco-properties">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 text-center border-primary">
        <h2 class="font-weight-light text-primary">Our Blog</h2>
        <p class="color-black-opacity-5">See Our Daily News &amp; Updates</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="blog-slider owl-carousel ftco-animate">
          <?php foreach( $berita as $ads => $row ): ?>
          <?php
          $content = strip_tags($row['isi_berita']);
          //$isi = substr($content,0,100);
          $isi = word_limiter($content, 4);
          //$isi = substr($content,0,strrpos($isi," "));
          if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
          ?>
          <div class="item" data-aos="fade-up" data-aos-delay="400">
            <div class="properties h-entry">
              <a href="#" class="hidden img d-flex justify-content-center align-items-center" style="background-image: url(<?php echo base_url()."asset/foto_berita/".$foto ;?>);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="responsive-container imgz d-flex justify-content-center align-items-center" >
                <div class="dummy80"></div>
                <div class="img-container" style="background-image: url(<?php echo base_url()."asset/foto_berita/".$foto ;?>);">
                  <div class="centerer"></div>
                  <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url()."asset/foto_berita/".$foto ;?>' class='img-responsive'>
                  <a href="<?php echo base_url()."berita/detail/".$row['slug']; ?>"></a>
                </div><!--img-container-->
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </div>
              <div class="text p-3">
                <h2 class="font-size-regular"><a href="<?php echo base_url()."berita/detail/".$row['slug']; ?>"><?php echo $row['judul'] ?></a></h2>
                <div class="meta mb-4"><?php echo namahari($row['tanggal']).', '.tanggalindo($row['tanggal'],'d M Y H:i'); ?> <span class="mx-2">&bullet;</span> <?php echo $row['username'] ?> <span class="mx-2">&bullet;</span> <?php //echo categories($row['id_categories'],'berita'); ?></div>
                <p><?php echo $isi; ?></p>
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
