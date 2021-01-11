<?php
  $products = $this->model_utama->semua_products(0, 12)->result_array();
  //print_r($products);
  $pages = array_chunk($products, 3 );
  $no = 1;
  $totalpage = count($pages);
  $jumlah = $this->model_utama->semua_products(0, 12)->num_rows();
  //foreach ($headline->result_array() as $row): ?>
<?php if ($jumlah > 1): ?>
<section id="products" class="ftco-section ftco-properties">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 border-primary text-center ftco-animate">
        <h2 class="font-weight-light text-primary">Recent Products</h2>
        <span class="subheading">Products</span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="products-slider owl-carousel ftco-animate">
          <?php foreach( $products as $ads => $row ): ?>
          <?php
          $content = strip_tags($row['isi_products']);
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
                <div class="dummy"></div>
                <div class="img-container" style="background-image: url(<?php echo base_url()."asset/foto_products/".$foto ;?>);">
                  <div class="centerer"></div>
                  <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url()."asset/foto_products/".$foto ;?>' class='img-responsive'>
                  <a href="<?php echo base_url()."products/detail/".$row['slug']; ?>"></a>
                </div><!--img-container-->
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </div>
              <div class="text p-3">
                <span class="status sale">Sale</span>
                <div class="d-flex">
                  <div class="one">
                    <h3><a href="<?php echo base_url()."products/detail/".$row['slug']; ?>"><?php echo $row['judul'] ?></a></h3>
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
