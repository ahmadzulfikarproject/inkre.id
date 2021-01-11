<section id="page" class="products_categories">
    <div class="container" data-aos="fade-up" data-aos-once="true">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1>Produk <?php echo $title; ?></h1>
                <div class="pull-right"><a href="<?php echo base_url('products/tags/feed'); ?>">Site Map <ion-icon name="logo-rss"></ion-icon></a><br></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php $this->template->includeview(template().'/home-categories');?>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="row">

                    <?php
                    //echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; products : $title</p><hr>";
                    $no = 1;
                    //print_r($categories->result_array());
                    foreach ($tags->result_array() as $row){
                        $isi_products = strip_tags($row['isi_products']); 
                        $isi = substr($isi_products,0,100); 
                        $isi = substr($isi_products,0,strrpos($isi," "));
                        $tanggal = tgl_indo($row['tgl_posting']);
                        $hari = namahari($row['tgl_posting']);
                        //if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
                        if ($row['gambar'] == ''){
                                    $foto = 'nophoto.jpg';
                                }
                            else{
                                $foto = getnameimage($row['gambar'],'_200_400');
                                
                                if (!file_exists("asset/foto_products/".$foto)) {
                                    if (file_exists("asset/foto_products/".$row['gambar'])) {
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


                        <div class="col-sm-3 col-sm-heightz col-md-heightz col-lg-heightz col-topz">

                            <div class="responsive-container kotak-item schfx" itemscope>

                                <div class="dummy"></div>
                                <div class="img-container" style="background-image: url('<?php echo base_url()."asset/foto_products/".$foto ;?>');">
                                  <div class="centerer"></div>
                                  <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url()."asset/foto_products/".$foto ;?>' class='img-responsive'>                           
                              </div><!--img-container-->
                              <div class="kotak-item-caption">
                                <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo  $hari.', '.$tanggal ?></small>
                                <h3 class="carousel-caption-headerz"><a href='<?php echo base_url()."products/detail/".$row['slug']; ?>'><?php echo $row['judul'] ?></a></h3>
                            </div>      
                        </div>

                    </div>

                    <?php if ($no % 4 == 0): ?>
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
