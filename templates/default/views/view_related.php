<?php if (!empty($posts)): ?>
<section id="<?php echo $post_type;?>" class="ftco-section ftco-properties">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 border-primary text-center ftco-animate">
        <h2 class="font-weight-light text-primary">Related <?php echo $post_type;?></h2>
        <span class="subheading"><?php echo $post_type;?></span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="related-slider owl-carousel ftco-animate">
          <?php foreach( $posts as $ads => $row ): ?>
          <?php
          $content = strip_tags($row['isi_'.$post_type]);
          //$isi = substr($content,0,100);
          $isi = word_limiter($content, 4);
          //$isi = substr($content,0,strrpos($isi," "));
          if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
          ?>
          <div class="item" data-aos="fade-up" data-aos-delay="0">
            <div class="properties">
              <a href="#" class="hidden img d-flex justify-content-center align-items-center" style="background-image: url(<?php echo base_url()."asset/foto_products/".$foto ;?>);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="responsive-container imgz d-flex justify-content-center align-items-center" >
                <div class="dummy50"></div>
                <div class="img-container" style="background-image: url(<?php echo base_url()."asset/foto_".$post_type."/".$foto ;?>);">
                  <div class="centerer"></div>
                  <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url()."asset/foto_".$post_type."/".$foto ;?>' class='img-responsive'>
                  <a href="<?php echo base_url()."".$post_type."/detail/".$row['slug']; ?>"></a>
                </div><!--img-container-->
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </div>
              <div class="text p-3">
                <div class="d-flex">
                  <div>
                    <h3><a href="<?php echo base_url()."".$post_type."/detail/".$row['slug']; ?>"><?php echo $row['judul'] ?></a></h3>
                    <p><?php echo $isi; ?></p>
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