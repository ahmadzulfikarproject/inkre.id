<div class='box'>
  <div class='box-header'>
    <h3 class='box-title'>Application Buttons</h3>
  </div>
  <div class='box-body'>
    
    <a href="<?php echo base_url(); ?>settings" class='btn btn-app'><i class='fa fa-sliders-h'></i> Identitas</a>
    <a href="<?php echo base_url(); ?>navigation/view/menuutama" class='btn btn-app'><i class='fa fa-th-large'></i> Menu</a>
    <a href="<?php echo base_url(); ?>administrator/submenu" class='btn btn-app hidden'><i class='fa fa-th'></i> Submenu</a>
    <a href="<?php echo base_url(); ?>pages" class='btn btn-app'><i class='fa fa-file-text'></i> Halaman</a>
    <a href="<?php echo base_url(); ?>news" class='btn btn-app'><i class='fa fa-television'></i> Berita</a>
    <a href="<?php echo base_url(); ?>administrator/kategoriberita" class='btn btn-app'><i class='fa fa-bars'></i> Kategori Berita</a>
    <a href="<?php echo base_url(); ?>administrator/tagberita" class='btn btn-app hidden'><i class='fa fa-tag'></i> Tag Berita</a>
    <?php if (is_level('admin')): ?>
    <a href="<?php echo base_url(); ?>administrator/komentar" class='btn btn-app hidden'><i class='fa fa-comments'></i> Komen. Berita</a>
    <a href="<?php echo base_url(); ?>administrator/sensorkata" class='btn btn-app hidden'><i class='fa fa-bell-slash'></i> Sensor</a>
    <?php endif; ?>
    <a href="<?php echo base_url(); ?>services" class='btn btn-app'><i class='fa fa-cogs'></i> Services</a>
    <a href="<?php echo base_url(); ?>projects" class='btn btn-app'><i class="fa fa-project-diagram"></i> Projects</a>
    <a href="<?php echo base_url(); ?>products" class='btn btn-app'><i class="fa fa-dolly-flatbed"></i> Products</a>
    <?php if (is_level('admin')): ?>
    <a href="<?php echo base_url(); ?>administrator/schedules" class='btn btn-app'><i class="fa fa-calendar-alt"></i> Schedules</a>
    <?php endif; ?>
    <a href="<?php echo base_url(); ?>clients" class='btn btn-app'><i class="fa fa-address-card"></i> Clients</a>
    <a href="<?php echo base_url(); ?>slide" class='btn btn-app'><i class="fa fa-images"></i> Foto Slide</a>
    <?php if (is_level('admin')): ?>
    <a href="<?php echo base_url(); ?>administrator/album" class='btn btn-app hidden'><i class='fa fa-camera-retro'></i> Album</a>
    <a href="<?php echo base_url(); ?>administrator/galeri" class='btn btn-app'><i class='fa fa-camera'></i> Gallery</a>
    <a href="<?php echo base_url(); ?>administrator/banner" class='btn btn-app hidden'><i class='fa fa-file-image-o'></i> Banner</a>

    <a href="<?php echo base_url(); ?>templates" class='btn btn-app'><i class='fa fa-file'></i> Template</a>
    
    <a href="<?php echo base_url(); ?>administrator/agenda" class='btn btn-app hidden'><i class='fa fa-calendar-minus-o'></i> Agenda</a>
    <a href="<?php echo base_url(); ?>administrator/agenda" class='btn btn-app hidden'><i class='fa fa-calendar-minus-o'></i> Sekilas Info</a>
    <a href="<?php echo base_url(); ?>administrator/jajakpendapat" class='btn btn-app hidden'><i class='fa fa-bar-chart-o'></i> Polling</a>
    <a href="<?php echo base_url(); ?>administrator/download" class='btn btn-app'><i class='fa fa-download'></i> Download</a>
    <?php endif; ?>
    <a href="<?php echo base_url(); ?>data" class='btn btn-app'><i class='fa fa-envelope'></i> Pesan</a>
    <a href="<?php echo base_url(); ?>administrator/manajemenuser" class='btn btn-app'><i class='fa fa-users'></i> Users</a>
    <?php if (is_level('admin')): ?>
    <a href="<?php echo base_url(); ?>administrator/manajemenmodul" class='btn btn-app'><i class='fa fa-folder'></i> Modul</a>
    <?php endif; ?>
  </div>
</div>
