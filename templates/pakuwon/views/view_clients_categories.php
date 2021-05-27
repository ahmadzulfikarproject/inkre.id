<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url().'/asset/'.imgheader(); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
        <h1 class="text-white font-weight-light text-uppercase">Services</h1>
        <p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span>Services</span></p>
      </div>
    </div>
  </div>
</div>
<section id="page" class="clients_categories site-section">
    <div class="container" data-aos="fade-up" data-aos-once="true">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php $this->template->includeview('../../templates/'.template().'/views/home-categories'); ?>
                <br>

            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <h1><?php echo $title; ?></h1>
                <hr>
                <div class="row">

                    <?php
                    //echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; clients : $title</p><hr>";
                    $no = 1;
                    //print_r($categories->result_array());
                    foreach ($categories->result_array() as $row){
                        $isi_clients = strip_tags($row['isi_clients']);
                        $isi = substr($isi_clients,0,100);
                        $isi = substr($isi_clients,0,strrpos($isi," "));
                        $tanggal = tgl_indo($row['created_time']);
                        $hari = namahari($row['created_time']);
                        //if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
                        if ($row['gambar'] == ''){
                                $foto = 'nophoto.jpg';
                            }
                        else{
                            $foto = getnameimage($row['gambar'],'_200_400');

                            if (!file_exists("asset/foto_clients/".$foto)) {
                                if (file_exists("asset/foto_clients/".$row['gambar'])) {
                                    $foto = $row['gambar'];
                                }
                                else{
                                    $foto = 'nophoto.jpg';
                                }

                                # code...
                            }

                            //$foto = $row['gambar'];
                        }
                        ?>


                        <div class="col-sm-2 col-sm-heightz col-md-heightz col-lg-heightz col-topz">

                            <div class="responsive-container kotak-item schfx" itemscope>

                                <div class="dummy50"></div>
                                <a class="img-container" href='<?php echo base_url()."clients/detail/".$row['slug']; ?>' data-toggle="tooltip" data-placement="top" title="<?php echo $row['judul'] ?>">
                                      <div class="centerer"></div>
                                      <img alt="<?php echo $row['judul'] ?>" class='img-thumbnailz' src='<?php echo base_url()."asset/foto_clients/".$foto ;?>' class='img-responsive'>
                                </a><!--img-container-->
                              <div class="kotak-item-caption hidden">
                                <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo  $hari.', '.$tanggal ?></small>
                                <h3 class="carousel-caption-headerz"><a href='<?php echo base_url()."clients/detail/".$row['slug']; ?>'><?php echo $row['judul'] ?></a></h3>
                            </div>
                        </div>

                    </div>

                    <?php if ($no % 6 == 0): ?>
                        <div style='clear:both'></div>
                    <?php endif; ?>
                    <?php $no++; } ?>
                    <div style="clear:both"></div>
                    <div class="col-xs-12">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
