<section id="page" class="berita" data-aos="fade-up" data-aos-once="true">
    <div class="container">
        <div class="row">

<?php
           // echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; Berita : $title</p><hr>";
                $no = 1;
                foreach ($berita->result_array() as $row){
                    $isi_berita = strip_tags($row['isi_berita']); 
                    $isi = substr($isi_berita,0,100); 
                    $isi = substr($isi_berita,0,strrpos($isi," "));
                    $tanggal = tgl_indo($row['tanggal']);
                    $hari = namahari($row['tanggal']);
                    //if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; } 
                    if ($row['gambar'] == ''){
                            $foto = 'nophoto.jpg';
                        }
                    else{
                        $foto = getnameimage($row['gambar'],'_200_400');
                        
                        if (!file_exists("asset/foto_berita/".$foto)) {
                            if (file_exists("asset/foto_berita/".$row['gambar'])) {
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

                        
                        <div class="col-xs-12 col-sm-4 col-sm-heightz col-sm-heightz col-lg-heightz col-topz">
                            
                            <div class="responsive-container kotak-item schfx" >

                                <div class="dummy50"></div>
                                <div class="img-container" style="background-image: url(<?php echo base_url()."asset/foto_berita/".$foto ;?>);">
                                  <div class="centerer"></div>
                                  <img  alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url()."asset/foto_berita/".$foto ;?>' class='img-responsive'>                           
                                </div><!--img-container-->
                                <div class="kotak-item-caption">
                                    <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo $hari.', '.$tanggal ?></small>
                                    <h3 class="carousel-caption-headerz"><a href='<?php echo base_url()."berita/detail/".$row['slug']; ?>'><?php echo $row['judul'] ?></a></h3>
                                </div>      
                            </div>
                            
                        </div>

                        <?php if ($no % 3 == 0): ?>
                            <div style='clear:both'></div>
                        <?php endif; ?>
                    <?php 
                    $no++;
                }
            ?>
            <div style="clear:both"></div>
            <div class="col-xs-12">
                
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</section>
