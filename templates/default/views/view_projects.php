

<?php //print_r($projects->result_array())?>


<section id="page" class="projects-page">
    <?php //if ($row['gambar'] != ''):?>
    <div class="pageheader animatedz fadeInUpz" style="background-image: url(<?php echo base_url().'/asset/'.imgheader(); ?>);" data-aos="fade" data-aos-easing="ease-in-sine" data-aos-duration="500" data-aos-once="true">
        <div class="container">
            <div class="row row-same-height row-full-height">
                <div class="col-sm-6 col-sm-height col-full-height col-middle">
                    <div class="caption hidden-xs">
                        <h2>projects</h2>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-height col-full-height col-middle">
                </div>
            </div>   
        </div>
    </div>
    <?php //endif;?>
    <div style='clear:both'><br></div>
    <div class="container" data-aos="fade-up" data-aos-once="true">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">

                    <div class='col-md-12 hidden'>
                        <div class="kontenpage hero">
                            
                            
                        </div><!--kontentpage-->
                    </div><!--col-->

                    <?php
                    //echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; projects : $title</p><hr>";
                    $no = 1;
                    foreach ($projects->result_array() as $row){
                        $isi_projects = strip_tags($row['isi_projects']); 
                        $isi = substr($isi_projects,0,100); 
                        $isi = substr($isi_projects,0,strrpos($isi," "));
                        $hari = namahari($row['tgl_posting']);
                        $tanggal = tgl_indo($row['tgl_posting']);
                        if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; } ?>


                        <div class="col-sm-4 col-sm-heightz col-md-heightz col-lg-heightz col-topz item-list">

                            <div class="responsive-container box-item schfx" itemscope>

                                <div class="dummy50"></div>
                                <a href="<?php echo base_url()."projects/detail/".$row['slug']; ?>" class="img-container" style="background-image: url(<?php echo base_url()."asset/foto_projects/".$foto ;?>);">
                                    <div class="centerer"></div>
                                    <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url()."asset/foto_projects/".$foto ;?>' class='img-responsive'>                           
                                </a><!--img-container-->
                                <div class="box-item-caption hidden">
                                    <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo $hari.', '.$tanggal; //echo $row['hari'],','.$tanggal ?></small>
                                    <h3 class="carousel-caption-headerz"><a href='<?php echo base_url()."projects/detail/".$row['slug']; ?>'><?php echo $row['judul'] ?></a></h3>
                                </div><!--kotak-item-caption-->

                            </div><!--responsive-container-->
                            <div class="kotak-item-title text-center">
                                <span class="box-title"><h3><a href='<?php echo base_url()."projects/detail/".$row['slug']; ?>'><?php echo $row['judul'] ?></a></h3></span>
                                <span class="box-price"><?php echo $row['lokasi'] ?></span>
                            </div>
                            
                        </div><!--col-->

                    <?php if ($no % 3 == 0): ?>
                        <div style='clear:both'></div>
                    <?php endif; ?>
                    <?php $no++; } ?>

                    <div style='clear:both'><br></div>
                    <div class="col-xs-12">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                    
                </div><!--row-->
            </div>
        </div>
        
    </div>
</section>
