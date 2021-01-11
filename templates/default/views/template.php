<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $this->template->title->append(' - ' . idwebsite('nama_website')); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php echo $this->template->meta; ?>
  <link rel="canonical" href="<?php echo base_url()?>">
  <link rel="shortcut icon" href="<?php echo base_url() . 'asset/' . idwebsite('favicon'); ?>">
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
</head>

<body>
  <div class="site-loader"></div>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar py-3" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-10 col-xl-2">
            <div class="site-navbar-logo">
              <div class="mb-0 text-center"><a href="<?php echo base_url(); ?>" class="text-white h2 mb-0"><img src="<?php echo base_url() . 'asset/' . logo(); ?>"></a></div>
            </div>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <?php $this->template->includeview('../../templates/' . template() . '/views/home-menu-jasny'); ?>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

        </div>

      </div>
  </div>

  </header>
  <?php if (is_home()) : ?>
    <?php $this->template->includeview('../../templates/' . template() . '/views/home-slideshow');  ?>


    <div class="container">
      <div class="row align-items-center no-gutters align-items-stretch overlap-section">
        <div class="col-md-4">
          <div class="feature-1 pricing h-100 text-center">
            <div class="icon">
              <span class="icon-dollar"></span>
            </div>
            <h2 class="my-4 heading">Harga Terbaik</h2>
            <p>Harga sewa genset termurah dan berkualitas pelayanan terbaik.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="free-quote bg-dark h-100">
            <div class="icon">
              <span class="icon-whatsapp"></span>
            </div>
            <h2 class="my-4 heading  text-center">Hubungi Kami</h2>
            <a target='_blank' href="https://api.whatsapp.com/send?phone=62<?= Globals::idContact()->wa ?>" class="btn btn-primary btn-lg btn-block">Order</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-3 pricing h-100 text-center">
            <div class="icon">
              <span class="icon-phone"></span>
            </div>
            <h2 class="my-4 heading">24/7 Support</h2>
            <p>Siap Melayani 24 Jam setiap hari untuk kebutuhan genset anda.</p>
          </div>
        </div>

      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php $this->template->includeview('../../templates/' . template() . '/views/home-pricing'); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php echo $this->template->content; ?>
  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-4" data-aos="fade-right" data-aos-delay="400">
              <?php $this->template->includeview('../../templates/' . template() . '/views/home-profile'); ?>
            </div>
            <div class="col-md-8" data-aos="fade-right" data-aos-delay="400">
              <!-- <h2 class="footer-heading mb-4">Features</h2> -->
              <?php
              ?>
              <?php $this->template->includeview('../../templates/' . template() . '/views/home-contact');  ?>
            </div>
            <!-- <div class="col-md-3" data-aos="fade-right" data-aos-delay="400">
              <h2 class="footer-headingz mb-4">Follow Us</h2>
              <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div> -->
          </div>
        </div>
        <div class="col-md-3" data-aos="fade-right" data-aos-delay="400">
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
      <div class="row pt-5 mt-5 text-center" data-aos="flip-up">
        <div class="col-md-12">
          <div class="border-top pt-5">
            <p class='text-footer'>Copyright &copy; <?php echo date('Y'); ?> - <?php echo idwebsite('nama_website'); ?> . All Rights Reserved.<br></p>
            <p>
              <?php
              ?>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              <!--Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>-->
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            <div class="sitemap text-center"><a target="_blank" href="<?php echo base_url($this->uri->segment(1) . '/feed'); ?>">Site Map <i class="fas fa-rss"></i></a></div>
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
  <div id="chat" class="animated shake">
    <div class="btn-group">
      <a target='_blank' href="https://api.whatsapp.com/send?phone=62<?= Globals::idContact()->wa ?>" class="btn btn-default"><i class="icon icon-whatsapp" style="margin:0 10px 0 0"></i> Chat us !</a>
      <button type="button" class="btn btn-default"><?= Globals::idContact()->wa ?></button>

    </div>
  </div>
  </div>

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
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56708623-28"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-56708623-28');
  </script>

</body>

</html>