<?php
    $isi_berita = strip_tags($record['isi_services']);
    $isi = substr($isi_berita,0,120);
    $isi = substr($isi_berita,0,strrpos($isi," "));
    //$tgl1 = tgl_indoo($record['tgl_mulai']);
    //$tgl2 = tgl_indoo($record['tgl_selesai']);
    //$tgl_posting = tgl_indoo($record['tanggal']);

?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url()."asset/foto_services/".$record['gambar']?>);" data-aos="fade" data-stellar-background-ratio="0.5">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center">

			<div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
				<h1 class="text-white font-weight-light text-uppercase font-weight-bold"><?php echo $record['judul'] ?></h1>
			</div>
		</div>
	</div>
</div>
<div class="breadcrumb rounded-0 p-0">
	<div class="container">
		<div class="col"><?= $breadcrumbs; ?></div>
	</div>
</div>
<section id="page" class="images_gallery site-section">
    <div class="container" data-aos="fade" data-aos-easing="ease-in-sine" data-aos-duration="500">
        <div class="row">
        <?php
          //$tanggal = tgl_indo($record['tgl_posting']);
          //echo "<div class='col-md-12'><p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $record[judul]</p></div><hr>
            ?>
            <div class='col-md-12'>
                <div class="kontenpage hero" itemscope>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="ftco-properties">
                                <div class="row no-padding">

                                    <div class="slide-page-detail owl-carousel ftco-animate">
                                        <?php if ($record['gambar'] != ''):?>
                                        <div class="item">
                                            <div class="responsive-container box-item schfx" itemscope>    
                                                <div class="dummy50"></div>
                                                <a href="<?php echo base_url()."asset/foto_services/".$record['gambar']?>" class="img-container photobox_a" style="background-image: url('<?php echo base_url()."asset/foto_services/".$record['gambar']?>');">
                                                    <div class="centerer"></div>
                                                    <img class='img-thumbnailz hidden' src='<?php echo base_url()."asset/foto_services/".$record['gambar']?>' class='img-responsive'>
                                                </a><!--img-container-->
                                            </div><!--responsive-container-->
                                            <!-- <span><?php echo $record['judul'] ?></span> -->
                                        </div>
                                        <?php endif;?>
                                        <?php if(!empty($images)){ $i = 1; foreach($images as $file){ ?>
                                        <?php
                                        if ($file['file_name'] == ''){
                                                $foto = 'nophoto.jpg';
                                            }
                                        else{
                                            $foto = getnameimage($file['file_name'],'_200_400');
                                            $fotosrc = $file['file_name'];
                                            if (!file_exists("asset/foto_services/services/".$foto)) {
                                                if (file_exists("asset/foto_services/services/".$file['file_name'])) {
                                                    $foto = $file['file_name'];
                                                    //$fotosrc = $file['file_name'];
                                                }
                                                else{
                                                    $foto = 'nophoto.jpg';
                                                }

                                                # code...
                                            }

                                            //$foto = $post['gambar'];
                                        }
                                        ?>
                                        <?php //print_r($file);  ?>
                                        <div class="item">
                                            <div class="responsive-container box-item schfx" itemscope>

                                                <div class="dummy50"></div>
                                                <a href="<?php echo base_url()."asset/foto_services/services/".$fotosrc ;?>" class="img-container photobox_a" style="background-image: url('<?php echo base_url()."asset/foto_services/services/".$foto ;?>');">
                                                    <div class="centerer"></div>
                                                    <img class='img-thumbnailz hidden' src='<?php echo base_url()."asset/foto_services/services/".$foto ;?>' class='img-responsive'>
                                                </a><!--img-container-->
                                            </div><!--responsive-container-->
                                        </div>


                                        <?php $i++; } }else{ ?>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                          <div class="text-left pb-1 border-primary mb-4">
                            <h2 class="text-primary"><?php echo $record['judul'] ?></h2>
                          </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="no-padding">
                                        <div class="row no-padding">


                                          <?php if(!empty($images)){ $i = 1; foreach($images as $file){ ?>
                                              <?php
                                              if ($file['file_name'] == ''){
                                                      $foto = 'nophoto.jpg';
                                                  }
                                              else{
                                                  $foto = getnameimage($file['file_name'],'_200_400');
                                                  $fotosrc = $file['file_name'];
                                                  if (!file_exists("asset/foto_services/services/".$foto)) {
                                                      if (file_exists("asset/foto_services/services/".$file['file_name'])) {
                                                          $foto = $file['file_name'];
                                                          //$fotosrc = $file['file_name'];
                                                      }
                                                      else{
                                                          $foto = 'nophoto.jpg';
                                                      }

                                                      # code...
                                                  }

                                                  //$foto = $post['gambar'];
                                              }


                                              ?>
                                              <?php //print_r($file);  ?>
                                              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <div class="responsive-container box-item schfx" itemscope>

                                                    <div class="dummy50"></div>
                                                    <a href="<?php echo base_url()."asset/foto_services/services/".$fotosrc ;?>" class="img-container photobox_a" style="background-image: url('<?php echo base_url()."asset/foto_services/services/".$foto ;?>');">
                                                        <div class="centerer"></div>
                                                        <img class='img-thumbnailz hidden' src='<?php echo base_url()."asset/foto_services/services/".$foto ;?>' class='img-responsive'>
                                                    </a><!--img-container-->
                                                </div><!--responsive-container-->
                                              </div>


                                              <?php $i++; } }else{ ?>

                                          <?php } ?>

                                        </div>
                                    </div>
                                </div>
                             </div>
                            <?php echo $record['isi_services'] ?>
                            <?php //tagslink($record['id_tag'],'services'); ?>
                            <?php //tagslinkdetail($record['id_services'],'services'); ?>
                            <?php categorieslink($record['id_categories'],'services'); ?>
                            <?php tagslinkdetail($record['id_services'],'services'); ?>
                            
                        </div>
                        <?php //$this->template->includeview('../../templates/'.template().'/views/home-services-cf'); ?>
                        
                    </div>

                </div>
            </div>
            <div style='clear:both'><br></div>

        </div>
    </div>
</section>
<hr>
<div class="col">
    <?php 
    Globals::setIdpage($record['id_services']);
    //echo $record['id_services'];
    $data = array();
    //$data['limit'] = '8';
    //$data['id_services'] = $record['id_services'];
    $this->load->module('services'); 
    $this->services->related(16);
    ?>
    <?php //$this->template->includeview('../../templates/'.template().'/views/home-services-cf'); ?>
</div>