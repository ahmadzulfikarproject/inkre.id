<!DOCTYPE html>
<html lang="id">

<head>
  <title><?php echo $this->template->title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php echo $this->template->meta; ?>
  <link rel="canonical" href="<?php echo base_url() ?>">
  <link rel="shortcut icon" href="<?php echo home_url() . 'asset/settings/' . setting('site_favicon'); ?>">
  <!-- <link rel="shortcut icon" href="../assets/ico/favicon.png"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/magnific-popup.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/owl.theme.default.min.css">

  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>fonts/flaticon/font/flaticon.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> -->
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>fonts/fontawesome-free-5.2.0-web/css/all.css" crossorigin="anonymous">

  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/aos.css">

  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/animate.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/custom.css">
  <link rel="stylesheet" href="<?php echo base_url('templates/' . template() . '/'); ?>css/share.css">
  <link href="<?php echo base_url('templates/' . template() . '/'); ?>vendor/photobox/photobox.css" rel="stylesheet">
  <!-- <link href="<?php echo base_url('templates/' . template() . '/'); ?>vendor/caroufredsel/caroufredsel.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body>
  <div class="site-loader"></div>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle text-light"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar py-2 bg-primary" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-10 col-xl-3">
            <div class="site-navbar-logo">
              <div class="mb-0 text-center"><a href="<?php echo base_url(); ?>" class="text-white h2 mb-0"><img src="<?php echo home_url() . 'asset/settings/' . setting('site_logo'); ?>"></a></div>
            </div>
          </div>
          <div class="col-12 col-md-9 d-none d-xl-block">
            <?php $this->template->includeview('../../templates/' . template() . '/views/home-menu-jasny'); ?>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

        </div>

      </div>
  </div>

  </header>

  <?php if (is_home()) : ?>
    <?php $this->template->includeview('../../templates/' . template() . '/views/home-slideshow');  ?>
    <div id="top-header" class="py-2 text-white text-center bg-primary text-white p-sm-5">
      <div class="container">
        <div class="row align-items-center justify-content-center bg-warning overlap-section shadow-lg p-md-4">
          <div class="col-md-2 d-none d-sm-block" data-aos="fade-up" data-aos-delay="400">
            <div class="site-navbar-logo p-0">
              <div class="mb-0 text-center"><a href="<?php echo base_url(); ?>" class="text-white h2 mb-0"><img src="<?php echo home_url() . 'asset/settings/' . setting('site_logo'); ?>"></a></div>
            </div>
            <!-- <img data-src="holder.js/200x70" alt="..." class="slide-caption-img d-none d-lg-block d-xl-block"> -->
          </div>
          <div class="col-md-3 text-lg-left d-nonez d-sm-blockz" data-aos="fade-up" data-aos-delay="400">
            <div class="media">
              <i class="icon icon-phone align-self-center mr-3 h1 d-none d-sm-block" style="margin:0 10px 0 0"></i>
              <div class="media-body">
                <!-- <h5>Telpon</h5> -->
                <p class="mb-0">Hubungi Kami.</p>
                <a target='_blank' href="tel:<?= Globals::idContact()->mobile ?>" class="font-weight-bold text-uppercase"><?= Globals::idContact()->mobile ?></a>
              </div>
            </div>
            <div class="media-body hidden">
              <i class="icon icon-map-marker align-self-center mr-3 h1 d-none d-sm-block" style="margin:0 10px 0 0"></i>
              <!-- <h5>Telpon</h5> -->
              <a target='_blank' href="tel:<?= Globals::idContact()->mobile ?>" class="btn btn-default"><?= Globals::idContact()->mobile ?></a>
            </div>
            <!-- <h3 class="mb-0 font-weight-light text-uppercase font-weight-bold"><?php echo setting('site_name') ?></h3> -->
            <!-- <p class="mb-0"><?php echo setting('site_description') ?></p> -->
          </div>
          <div class="col-md-4 text-lg-left d-none d-sm-block" data-aos="fade-up" data-aos-delay="400">
            <div class="media">
              <i class="icon icon-mail_outline align-self-center mr-3 h1 d-none d-sm-block" style="margin:0 10px 0 0"></i>
              <div class="media-body">
                <!-- <h5>Chat</h5> -->
                <p class="mb-0">Email</p>
                
                <?php if (!empty(Globals::idContact()->email)) : ?>

                  <!-- <h5 class="mt-0 mb-1">Hubungi Kami Sekarang !</h5> -->
                  <div class="font-weight-bold">

                    <?php listitem(Globals::idContact()->email, 'email'); ?>
                  </div>

                <?php endif; ?>
                <!-- <a target='_blank' href="mailto:<?= Globals::idContact()->email ?>?subject = Sewa Genset&body = Hai%20!%20Saya%20tertarik%20untuk%20sewa%20genset%20di%20sewagenset88.com" class="font-weight-bold"><?= Globals::idContact()->email ?></a> -->
              </div>
            </div>
            <!-- <h3 class="mb-0 font-weight-light text-uppercase font-weight-bold"><?php echo setting('site_name') ?></h3> -->
            <!-- <p class="mb-0"><?php echo setting('site_description') ?></p> -->
          </div>
          <div class="col-md-3 text-lg-left d-none d-sm-block" data-aos="fade-up" data-aos-delay="400">
            <div class="media">
              <i class="icon icon-map-marker align-self-center mr-3 h1 d-none d-sm-block" style="margin:0 10px 0 0"></i>
              <div class="media-body">
                <!-- <h5>Location</h5> -->
                <p class="mb-0"><?= Globals::idContact()->alamat; ?></p>
                <!-- <a target='_blank' href="https://api.whatsapp.com/send?phone=62<?= Globals::idContact()->wa ?>" class=""><?= Globals::idContact()->wa ?></a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php $this->template->includeview('../../templates/' . template() . '/views/home-profile-lg'); ?>
    <?php $this->template->includeview('../../templates/' . template() . '/views/home-services-cf'); ?>
  <?php endif; ?>
  <?php echo $this->template->content; ?>
  <?php if (is_home()) : ?>
    <?php //$this->template->includeview('../../templates/' . template() . '/views/home-promo'); 
    ?>
    <?php //$this->template->includeview('../../templates/' . template() . '/views/home-services-cf-cat2'); 
    ?>
    <?php //$this->template->includeview('../../templates/' . template() . '/views/home-services-cf-cat3'); 
    ?>
    <?php $this->template->includeview('../../templates/' . template() . '/views/home-projects-cf-full'); ?>
    <?php $this->template->includeview('../../templates/' . template() . '/views/home-berita-cf'); ?>
    <?php $this->template->includeview('../../templates/' . template() . '/views/home-clients-cf'); ?>
    <div class="site-blocks-cover overlay hidden" style="background-image: url(<?php echo base_url('templates/' . template() . '/images/'); ?>loader.jpg); height:50vw;" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <!-- <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
          
          
            <h1 class="text-white font-weight-light mb-5 text-uppercase font-weight-bold">PAKUWON RESIDENCES - BEKASI | AMOR TOWER</h1>
            <p><a href="<?php echo base_url('contact/detail/' . Globals::idContact()->slug) ?>" class="btn btn-primary py-3 px-5 text-white">Hubungi Kami!</a></p>

          </div> -->
        </div>
      </div>
    </div>
  <?php endif; ?>
  <footer class="site-footer site-blocks-coverz overlay call" style="background-image: url(<?php echo home_url() . 'asset/settings/' . setting('site_bg1'); ?>);" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <!-- <div class="col-md-4" data-aos="fade-right" data-aos-delay="400">
              <?php
              ?>
            </div> -->
            <div class="col-md-12" data-aos="fade-right" data-aos-delay="400">
              <!-- <h2 class="footer-heading mb-4">Features</h2> -->
              <?php
              ?>
              <?php $this->template->includeview('../../templates/' . template() . '/views/home-contact');  ?>
            </div>

          </div>
        </div>
        <div class="col-md-3 hidden" data-aos="fade-right" data-aos-delay="400">
          <h2 class="footer-headingz mb-4">Subscribe Newsletter</h2>
          <form action="#" method="post">
            <div class="input-group mb-3 subscribe-form">
              <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary text-white" type="button" id="button-addon2">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row mb-5 mt-5 text-left">
        <div class="col-md-6">
          <div class="border-top pt-5">
            <p class='text-footer'>Copyright &copy; <?php echo date('Y'); ?> - <?php echo setting('site_name'); ?> . All Rights Reserved.<br></p>
            <p>
              <?php
              ?>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              <!--Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>-->
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="border-top pt-5">
            <p>
              <?php
              ?>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              <!--Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>-->
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            <div class="sitemap text-right"><a target="_blank" href="<?php echo base_url($this->uri->segment(1) . '/feed'); ?>">Site Map <i class="fas fa-rss"></i></a></div>
          </div>
        </div>

      </div>
    </div>
  </footer>
  <?php
  $this->contacts = $this->db->query("SELECT * FROM contact where id_contact=1")->row_array();
  // $this->contactsrow = $this->db->query("SELECT * FROM contact where id_contact=1")->row();
  // Globals::setContact($this->contactsrow);
  //echo Globals::idContact()->wa;
  //print_r($contacts);
  ?>
  <div id="chat" class="animated shake hidden">
    <div class="btn-group">
      <a target='_blank' href="https://api.whatsapp.com/send?phone=62<?= Globals::idContact()->wa ?>" class="btn btn-default"><i class="icon icon-whatsapp" style="margin:0 10px 0 0"></i> Chat us !</a>
      <button type="button" class="btn btn-default"><?= Globals::idContact()->wa ?></button>

    </div>
  </div>
  </div>
  <a href="https://api.whatsapp.com/send?phone=62<?= Globals::idContact()->wa ?>&text=Hai%20!%20Saya%20tertarik%20untuk%20sewa%20genset%20di%20sewagenset88.com" class="float" target="_blank" data-aos="fade-up">
    <i class="fa fa-whatsapp my-float"></i>
  </a>

  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/jquery-ui.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/popper.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/jquery.stellar.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/jquery.countdown.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/aos.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/main.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>js/jquery.cookie.js" type="text/javascript"></script>
  <?php echo $this->template->js_ajax; ?>
  <script type="text/javascript" src="<?php echo base_url('templates/' . template() . '/'); ?>js/holder.js"></script>
  <script>
    Holder.addTheme("dark", {
      bg: "#495057",
      fg: "gray",
      size: 12
    });
  </script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>vendor/photobox/jquery.photobox.js"></script>
  <script src="<?php echo base_url('templates/' . template() . '/'); ?>vendor/photobox/demo.js"></script>
  <?php $this->template->includeview('../../templates/' . template() . '/views/customtag'); ?>


</body>

</html>