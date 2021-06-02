<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo home_url() . 'asset/settings/' . setting('site_header'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
        <h1 class="text-white font-weight-light text-uppercase font-weight-bold"><?php echo $record['nama'] ?></h1>
      </div>
    </div>
  </div>
</div>
<div class="breadcrumb rounded-0 p-0">
  <div class="container">
    <div class="col"><?= $breadcrumbs; ?></div>
  </div>
</div>
<?php //echo set_realpath('./asset/entsans.ttf'); 
?>
<section id="contact" class="col-xs-12 site-section" data-aos="fade" data-aos-easing="ease-in-sine" data-aos-duration="500" data-aos-once="true">
  <div class="bgcontact" data-stellar-background-ratio="0.5" style="background-image: url(<?php echo base_url() . webconfig('asset') . "/foto_contact/" . $record['gambar'] ?>);"></div>
  <div class="container">
    <div class="no-paddingz contact-form hero">
      <div class="row row-same-height row-full-height">

        <div class="col-sm-8 col-sm-height col-full-height col-middle contact-kiri">
          <div class="row row-same-height row-full-height">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-sm-height col-full-height col-middle hidden">
              <img alt="<?php echo $record['nama'] ?>" src="<?php echo base_url() . webconfig('asset') . "/foto_contact/" . $record['gambar'] ?>">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-sm-height col-full-height col-middle">
              <div class="kontakku" itemscope>
                <?php
                $email = explode(',', $record['email']);
                $mobile = explode(',', $record['mobile']);
                $wa = explode(',', $record['wa']);
                //print_r($email);

                ?>
                <div class="text-left pb-1 border-primary mb-4">
                  <h2 class="text-primary">Contact us</h2>
                  <h3><?php echo $record['nama'] ?></h3>
                </div>
                <ul class="contact-list list-unstyled hidden">

                  <?php if (!empty($record['alamat'])) : ?>
                    <li><i class="fas fa-map-marker-alt"></i> <?php echo  $record['alamat'] ?>
                      <a href="#contactModal" role="button" class="btn btn-large btn-default" data-toggle="modal"><i class="fas fa-location-arrow"></i> Find Location</a>
                    </li>
                  <?php endif; ?>
                  <li>
                    <?php if (!empty($record['phone'])) : ?>
                      <i class="fas fa-phone"></i> <span><?php echo  $record['phone'] ?></span>
                    <?php endif; ?>
                  </li>
                  <li><i class="fas fa-mobile-alt"></i>
                    <?php if (!empty($record['mobile'])) : ?>

                      <ul class="list-unstyled nolist">
                        <?php foreach ($mobile as $key => $value) {
                          echo '<li>' . $value . '</li>';
                          # code...
                        } ?>
                      </ul>
                    <?php endif; ?>
                  </li>
                  <?php if (!empty($record['wa'])) : ?>
                    <li><i class="fab fa-whatsapp"></i>


                      <ul class="list-unstyled nolist">
                        <?php foreach ($wa as $key => $value) {
                          echo '<li>' . $value . '</li>';
                          # code...
                        } ?>
                      </ul>

                    </li>
                  <?php endif; ?>
                  <?php if (!empty($record['fb'])) : ?>
                    <li><i class="fab fa-facebook-square"></i>


                      <span><a href="<?php echo  $record['fb'] ?>" target="_blank"><?php echo  $record['fb'] ?></a></span>

                    </li>
                  <?php endif; ?>
                  <?php if (!empty($record['ig'])) : ?>
                    <li><i class="fab fa-instagram"></i>


                      <span><a href="<?php echo  $record['ig'] ?>" target="_blank"><?php echo  $record['ig'] ?></a></span>

                    </li>
                  <?php endif; ?>
                  <?php if (!empty($record['twitter'])) : ?>
                    <li><i class="fab fa-twitter"></i>
                      <span><a href="<?php echo  $record['twitter'] ?>" target="_blank"><?php echo  $record['twitter'] ?></a></span>
                    </li>
                  <?php endif; ?>
                  <li>
                    <?php if (!empty($record['fax'])) : ?>
                      <i class="icon fa fa-fax"></i><span><?php echo  $record['fax'] ?></span>
                    <?php endif; ?>
                  </li>
                  <li><i class="fas fa-at"></i>
                    <?php
                    ?>
                    <ul class="list-unstyled nolist">
                      <?php foreach ($email as $key => $value) {
                        echo '<li>' . $value . '</li>';
                        # code...
                      } ?>
                    </ul>


                  </li>
                  <li><i class="fas fa-link"></i> <span><a href="<?php echo  $record['link'] ?>"><?php echo  $record['link'] ?></a></span></li>
                  <li><?php
                      ?></li>
                  <li><?php echo  $record['info'] ?></li>
                </ul>
                <hr>
                <ul class="list-unstyled">
                  <li class="media">
                    <!-- <img data-src="holder.js/60x60?theme=dark&font=FontAwesome&text=&#xf067;&size=50" class="mr-3" src="..." alt="Generic placeholder image"> -->
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">Mudah menjanggau segala lokasi</h5>
                      <?php if (!empty($record['alamat'])) : ?>
                        <?php echo  $record['alamat'] ?>
                        <!-- <a href="#contactModal" role="button" class="btn btn-large btn-default" data-toggle="modal"><i class="fas fa-location-arrow"></i> Find Location</a> -->
                      <?php endif; ?>
                    </div>
                  </li>
                  <li class="media my-4">
                    <!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5>
                      <?php if (!empty($record['mobile'])) : ?>
                        <ul class="list-unstyled nolist">
                          <?php foreach ($mobile as $key => $value) {
                            echo '<li>' . $value . '</li>';
                            # code...
                          } ?>
                        </ul>
                      <?php endif; ?>
                    </div>
                  </li>
                  <li class="media my-4">
                    <!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">Email Kami</h5>
                      <ul class="list-unstyled nolist">
                        <?php foreach ($email as $key => $value) {
                          echo '<li>' . $value . '</li>';
                          # code...
                        } ?>
                      </ul>
                    </div>
                  </li>
                  <li class="media my-4">
                    <!-- <img data-src="holder.js/60x60?theme=dark" class="mr-3" src="..." alt="Generic placeholder image"> -->
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">Chat Dengan Kami dengan Whatsapp</h5>
                      <ul class="list-unstyled nolist">
                        <?php foreach ($wa as $key => $value) {
                          echo '<li>' . $value . '</li>';
                          # code...
                        } ?>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="foto_contact hidden" style="background-image: url(<?php echo base_url() . webconfig('asset') . "/foto_contact/" . $record['gambar'] ?>);">
            <!--<img width='100%' src='<?php echo base_url() . webconfig('asset') . "/foto_contact/" . $record['gambar'] ?>'>-->
          </div>
          <!--<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3736489.7218514383!2d90.21589792292741!3d23.857125486636733!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1506502314230" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>-->
        </div>
        <div class="col-sm-4 col-sm-height col-full-height col-middle contact-kanan">
          <div class="text-left pb-1 border-primary mb-4">
            <h2 class="text-primary"><strong>Get in Touch</strong></h2>
          </div>
          <?php echo Modules::run('enquiry/enquiry/ajax_index_form', array()); ?>
        </div>

      </div>
    </div>
  </div>
</section>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9435.63349384861!2d106.97290952891974!3d-6.104398003045216!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a2129b9fcbfd1%3A0x12439b1f325d58c!2sCV.%20Rehils%20Putra%20Mandiri!5e0!3m2!1sid!2sid!4v1622647403328!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
<div id="contactModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Map Location</h4>
      </div>
      <div class="modal-body">
        <?php

        $lat = '-6.35575';
        $lng = '106.98385';
        //echo esc_html( $mobile );
        ?>
        <div class="peta_contact panel panel-default" style="position: relative;">
          <i class="loading-animasi fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;z-index: 1; top: 50%;
          left: 50%; margin-left: -20px; margin-top: -20px;"></i>
          <span class="sr-only">Loading...</span>
          <div class="kotakpeta" style='overflow:hidden;height:400px;width:100%;'>
            <div id='gmap_canvas' style='height:400px;width:100%;'></div>
            <style>
              #gmap_canvas img {
                max-width: none !important;
                background: none !important
              }
            </style>
          </div>

          <script>
            function initializeMap() {
              var uluru = {
                lat: <?php echo $lat; ?>,
                lng: <?php echo $lng; ?>
              };
              var map = new google.maps.Map(document.getElementById('gmap_canvas'), {
                zoom: 15,
                center: uluru
              });
              var marker = new google.maps.Marker({
                position: uluru,
                map: map
              });

            }
          </script>
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlcEMKBh2C67R3eDB4Ic53Kp5HrWHUZQk&callback=initMap">
          </script>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>