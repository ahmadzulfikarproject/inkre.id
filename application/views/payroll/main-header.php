<style type="text/css">
  .sekolah{
    float: left;
    background-color: transparent;
    background-image: none;
    padding: 15px 15px;
    font-family: fontAwesome;
    color:#fff;
  }

  .sekolah:hover{
    color:#fff;
  }
</style>
        <!-- Logo -->
        <a href="<?php echo base_url('dashboard')?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img alt="logo <?php echo idwebsite('nama_website'); ?>" class="sr-header" width='100%' src='<?php echo home_url().'/asset/'.logo(); ?>'></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img alt="logo <?php echo idwebsite('nama_website'); ?>" class="sr-header" width='100%' src='<?php echo home_url().'asset/'.logo(); ?>'><b><?php //echo idwebsite('nama_website'); ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <?php /*echo build_bootstrapnav('menu-atas',
              array(
                'sub_start_tag' => '<ul class="submenu dropdown-menu">', 'sub_end_tag' => '</ul>',
                'start_tag' => '<li class="menuku %s scrollnav">', 'end_tag' => '</li>',
                'parent_tag' => '<li class="parentku dropdown scrollnav ">', 'parent_end_tag' => '</li>'

              )

              ); */?>
              <li class=""><a href='<?php echo base_url('absen')?>'>absen</a></li>
              <li class=""><a href='<?php echo base_url('staffs')?>'>staffs</a></li>
              <li class=""><a href='<?php echo base_url('absen/absen_status')?>'>absen_status</a></li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-open"></i> Report
                    
                  </a>
                  <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url('staffs/detail')?>">Report data setiap karyawan ( Profil )</a></li>
                      <li><a href="<?php echo base_url('staffs')?>">Report data semua karyawan</a></li>
                       <li class="divider"></li>
                      <li class="btn disabled"><a href="#">Report data absen setiap karyawan</a></li>
                      <li><a href="<?php echo base_url('absen')?>">Report data absen seluruh karyawan</a></li>
                       <li class="divider"></li>
                      <li><a href="<?php echo base_url('laporan/lembur_setiap_karyawan'); ?>">Report data lembur / uang makan setiap karyawan</a></li>
                      <li><a href="<?php echo base_url('laporan/lembur_semua_karyawan'); ?>">Report data lembur /uang makan seluruh karyawan</a></li>
                       <li class="divider"></li>
                      <li class="btn disabled"><a href="#">Report uang makan setiap karyawan</a></li>
                      <li><a href="<?php echo base_url('laporan/uang_makan_seluruh_karyawan'); ?>">Report uang makan seluruh karyawan</a></li>
                       <li class="divider"></li>
                      <li class="btn disabled"><a href="#">Report potongan gaji setiap karyawan</a></li>
                      <li class="btn disabled"><a href="#">Report potongan gaji seluruh karyawan</a></li>
                      <li class="divider"></li>
                      <li class="btn disabled"><a href="#">Report Penilaina Kerja</a></li>
                      <li class="divider"></li>
                      <li class="btn disabled"><a href="#">Histori Jabatan</a></li>
                      <li class="divider"></li>
                      <li class="btn disabled"><a href="#">Fungsi Hari raya / Tukar hari libur</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Trash</a></li>
                  </ul>
              </li>
              <li class=""><a href='<?php echo base_url('payroll_settings/index/edit/1')?>'><i class="fa fa-cogs"></i> Payroll_settings</a></li>
              <li><a href='<?php echo home_url(); ?>' target="_blank" ><i class="fa fa-window-restore"></i> Lihat website</a></li>
              <li><a href="<?php echo base_url() ?>data">Pesan Masuk <span class="label label-success"><?php echo totaldata('enquiry') ?></span></a></li>
              <li class="dropdown messages-menu hidden">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-open"></i> Pesan Masuk
                  <span class="label label-success"><?php echo totaldata('enquiry') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo totaldata('enquiry') ?> new messages</li>
                  <li>
                    <ul class="menu">
                      <?php 
                        $pesan = $this->model_hubungi->pesan_baru(10);
                        foreach ($pesan->result_array() as $row) {
                          $isi_pesan = substr($row['pesan'],0,30);
                          $waktukirim = tgl_indo($row['tanggal']);
                          echo "<li>
                                  <a href='".base_url()."administrator/detail_pesanmasuk/$row[id_hubungi]'>
                                    <div class='pull-left'>
                                      <img src='".base_url()."asset/admin/dist/img/users.gif' class='img-circle img-thumbnail' alt='User Image'>
                                    </div>
                                    <h4>$row[nama]<small><i class='fa fa-clock-o'></i> $waktukirim</small></h4>
                                    <p>$isi_pesan...</p>
                                  </a>
                                </li>";
                        }
                      ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo base_url() ?>data">See All Messages</a></li>
                </ul>
              </li>
              <li class="hidden">
                <a target='_BLANK' href="<?php echo home_url(); ?>"><i class="glyphicon glyphicon-new-window"></i></a>
              </li>
              <li><a href="<?php echo base_url(); ?>dashboard/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>

            </ul>
          </div>
        </nav>