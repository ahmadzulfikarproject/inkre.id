<?php
    $isi_berita = strip_tags($record['isi_clients']);
    $isi = substr($isi_berita,0,120);
    $isi = substr($isi_berita,0,strrpos($isi," "));
    //$tgl1 = tgl_indoo($record['tgl_mulai']);
    //$tgl2 = tgl_indoo($record['tgl_selesai']);
    //$created_time = tgl_indoo($record['tanggal']);

?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo home_url().'asset/settings/'.setting('site_header'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
        <h1 class="text-white font-weight-light text-uppercase"><?php echo $record['judul'] ?></h1>
        <p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span>S<?php echo $record['judul'] ?></span></p>
      </div>
    </div>
  </div>
</div>
<section id="page" class="site-section">
    <?php if ($record['gambar'] != ''):?>
    <div class="pageheader" style="background-image: url(<?php echo home_url().'asset/settings/'.setting('site_header'); ?>);" data-aos="fade" data-aos-easing="ease-in-sine" data-aos-duration="500">
        <div class="container">
            <div class="row row-same-height row-full-height">
                <div class="col-sm-6 col-sm-height col-full-height col-middle">
                    <div class="caption hidden-xs hidden-sm hidden">
                        <h2><?php echo $record['judul'] ?></h2>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-height col-full-height col-middle">
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="container" data-aos="fade-up" data-aos-once="true">
        <div class="row">
        <?php
          //$tanggal = tgl_indo($record['created_time']);
          //echo "<div class='col-md-12'><p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $record[judul]</p></div><hr>
            ?>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php $this->template->includeview('../../templates/'.template().'/views/home-categories'); ?>
                <br>

            </div>
            <div class='col-xs-12 col-sm-9 col-md-9 col-lg-9'>
                <div class="kontenpage hero" itemscope>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <?php if ($record['gambar'] != ''):?>
                              <div class="images_gallery">

                                <a class="photobox_a" href="<?php echo base_url()."asset/foto_clients/".$record['gambar']?>" data-toggle="tooltip" title="View image <?php echo $record['judul'] ?>">
                                <img alt="<?php echo $record['judul'] ?>" class='clients-img thumbnail' width='100%' src='<?php echo base_url()."asset/foto_clients/".$record['gambar']?>'></a>
                                <span><?php echo $record['judul'] ?></span>
                              </div>
                            <?php endif;?>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <div class="caption visible-xsz visible-mdz">
                                <h2><?php echo $record['judul'] ?></h2>
                                <span class="box-price"><?php //harga($record['price']); ?></span>
                            </div>
                            <?php echo $record['isi_clients'] ?>
                            <?php //tagslink($record['id_tag'],'clients'); ?>
                            <?php categorieslink($record['id_categories'],'clients'); ?>
                            <?php tagslinkdetail($record['id_clients'],'clients'); ?>
                        </div>
                    </div>

                </div>
            </div>
            <div style='clear:both'><br></div>

            <div style='clear:both'><br></div>
        </div>
    </div>
</section>
<hr>
<div class="col">
    <?php 
    Globals::setIdpage($record['id_clients']);
    //echo $record['id_clients'];
    $data = array();
    //$data['limit'] = '8';
    //$data['id_clients'] = $record['id_clients'];
    $this->load->module('clients'); 
    $this->clients->related(16);
    ?>
    <?php //$this->template->includeview('../../templates/'.template().'/views/home-clients-cf'); ?>
</div>