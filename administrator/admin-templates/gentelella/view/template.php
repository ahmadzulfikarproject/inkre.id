<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo $this->template->description; ?>">
  <link rel="shortcut icon" href="<?php echo home_url() . 'asset/settings/' . setting('site_favicon'); ?>">

  <title><?php echo $this->template->title->default("Fikar Web Design"); ?></title>

  <!-- Bootstrap -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Switchery -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/switchery/dist/switchery.min.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/plugins/datepicker/datepicker3.css">
  <!-- Custom Theme Style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/bootstrap/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/plugins/ionicons/css/ionicons.min.css">

  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>build/css/custom.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url(''); ?>asset/admin/holder.js"></script>
  <!-- FullCalendar -->
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
  <link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
  <link href="<?php echo base_url('asset/admin/plugins'); ?>/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
  <?php echo $this->template->meta; ?>
  <?php echo $this->template->stylesheet; ?>
  <style media="screen">
    .loading {
      position: fixed;
      top: 50%;
      left: 50%;
      margin-top: -30px;
      margin-left: -30px;
      z-index: 99;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url('dashboard') ?>" class="site_title"><img alt="logo <?php echo setting('site_name'); ?>" class="sr-header" width='100%' src='<?php echo home_url() . 'asset/settings/' . setting('site_logo'); ?>'> <span class="hidden"><?php echo setting('site_name'); ?></span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img data-src="holder.js/60x60" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo Globals::authenticatedMemeberId()->first_name . ' ' . Globals::authenticatedMemeberId()->last_name; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <?php $this->template->includeview($this->config->item('admin-template') . '/view' . '/menu-admin'); ?>
            </div>

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a href="<?php echo base_url('settings'); ?>" data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a id="panel-fullscreen" data-toggle="tooltip" data-placement="top" title="FullScreen">
              <!--<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>-->
              <i class="glyphicon glyphicon-fullscreen"></i>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('auth/logout'); ?>">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img data-src="holder.js/30x30" alt="" class="img-circle profile_img"><?php echo Globals::authenticatedMemeberId()->first_name . ' ' . Globals::authenticatedMemeberId()->last_name; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="<?php echo base_url('auth/edit_user/' . Globals::authenticatedMemeberId()->id); ?>"> Profile</a></li>
                  <li>
                    <a href="<?php echo base_url('settings'); ?>">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                  </li>
                  <li><a href="javascript:;">Help</a></li>
                  <li><a href="<?php echo base_url(); ?>auth/logout"><i class="fa fa-power-off pull-right"></i> Log Out</a></li>
                </ul>
              </li>

              <li role="presentation" class="dropdown hidden">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a>
                      <span class="image"><img data-src="holder.js/60x60" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img data-src="holder.js/60x60" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img data-src="holder.js/60x60" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img data-src="holder.js/60x60" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
              <li><a href="#"><span class=""><?php echo setting('site_name'); ?></span></a></li>
              <li><a href='<?php echo home_url(); ?>' target="_blank"><i class="fa fa-window-restore"></i> Lihat website</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="page-title">
          <div class="title_left">
            <h3><?php echo ucwords($this->template->title); ?></h3>
          </div>

          <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>
        </div>
        <?php //echo $this->template->partial->view($this->config->item('admin-template') . '/view' . '/partials/flashdata'); ?>
        <?php
        // This is the main content partial
        echo $this->template->content;
        ?>

      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          <?php
          // Show the footer partial, and prepend copyright message
          echo $this->template->footer->prepend("&copy; Fikar Web Design 2019 - ");
          ?>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/Flot/jquery.flot.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/Flot/jquery.flot.pie.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/Flot/jquery.flot.time.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/Flot/jquery.flot.stack.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- FullCalendar -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/fullcalendar/dist/fullcalendar.min.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>build/js/custom.min.js"></script>
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/tinymce/tinymce.min.js"></script>
  <script src="<?php echo base_url('asset/admin/plugins'); ?>/jasny-bootstrap/js/jasny-bootstrap.js"></script>
  <!-- Switchery -->
  <script src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/switchery/dist/switchery.min.js"></script>
  <?php echo $this->template->javascript; ?>
  <script>
    $(document).ready(function() {
      //Toggle fullscreen
      $("#panel-fullscreen").click(function(e) {
        e.preventDefault();

        var $this = $(this);

        if ($this.children('i').hasClass('glyphicon-fullscreen')) {
          openFullscreen();
          $this.children('i').removeClass('glyphicon-fullscreen');
          $this.children('i').addClass('glyphicon-resize-small');
        } else if ($this.children('i').hasClass('glyphicon-resize-small')) {
          closeFullscreen()
          $this.children('i').removeClass('glyphicon-resize-small');
          $this.children('i').addClass('glyphicon-fullscreen');
        }
        $(this).closest('.panel').toggleClass('panel-fullscreen');
      });
    });

    /* Get the documentElement (<html>) to display the page in fullscreen */
    var elem = document.documentElement;

    /* View in fullscreen */
    function openFullscreen() {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.mozRequestFullScreen) {
        /* Firefox */
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) {
        /* Chrome, Safari and Opera */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        /* IE/Edge */
        elem.msRequestFullscreen();
      }
    }

    /* Close fullscreen */
    function closeFullscreen() {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) {
        /* Firefox */
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        /* Chrome, Safari and Opera */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        /* IE/Edge */
        document.msExitFullscreen();
      }
    }
  </script>
  <script>
    $(document).ready(function() {
      // $("#example1").DataTable();

      tinymce.init({
        selector: "#editor1",
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern responsivefilemanager code"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | print preview code pagebreak",
        image_advtab: true,
        relative_urls: false,
        remove_script_host: false,
        external_filemanager_path: "<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/vendors/filemanager/') ?>",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {
          "filemanager": "<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/vendors/filemanager/plugin.min.js') ?>"
        }
      });
    });
    // $('#example1').DataTable({
    //   dom: 'Bfrtip',
    //   buttons: [{
    //     text: 'Add Page',
    //     action: function(e, dt, node, config) {
    //       // alert('Button activated');
    //       window.location.href = '<?php echo base_url("pages/tambah_pages"); ?>';
    //     }
    //   }]
    // });
  </script>
  <script>
    $(document).ready(function() {

      // var elem = document.querySelector('.js-switch');
      // var init = new Switchery(elem);
      $('input.checkbox').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });
  </script>
  <?php echo $this->template->js_ajax; ?>

</body>

</html>