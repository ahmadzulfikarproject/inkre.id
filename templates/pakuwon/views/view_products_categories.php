<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo home_url().'asset/settings/'.setting('site_header'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                <h1 class="text-white font-weight-light text-uppercase font-weight-bold"><?php echo $this->template->title; ?></h1>
                <p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span>Services</span></p>
            </div>
        </div>
    </div>
</div>
<section id="page" class="products_categories site-section">
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php $this->template->includeview('../../templates/' . template() . '/views/home-categories'); ?>
                <br>

            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text-left pb-1 border-primary mb-4">
                            <h2 class="text-primary"><?php echo $title ?></h2>
                        </div>
                    </div>
                    <?php
                    //echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; products : $title</p><hr>";
                    $no = 1;
                    //print_r($categories->result_array());
                    foreach ($categories->result_array() as $row) {
                        $isi_products = strip_tags($row['isi_products']);
                        $isi = substr($isi_products, 0, 100);
                        $isi = substr($isi_products, 0, strrpos($isi, " "));
                        $tanggal = tgl_indo($row['tgl_posting']);
                        $hari = namahari($row['tgl_posting']);
                        //if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
                        if ($row['gambar'] == '') {
                            $foto = 'nophoto.jpg';
                        } else {
                            $foto = getnameimage($row['gambar'], '_200_400');

                            if (!file_exists("asset/foto_products/" . $foto)) {
                                if (file_exists("asset/foto_products/" . $row['gambar'])) {
                                    $foto = $row['gambar'];
                                } else {
                                    $foto = 'nophoto.jpg';
                                }

                                # code...
                            }

                            //$foto = $row['gambar'];
                        }
                        ?>


                        <div class="col-sm-4 col-sm-heightz col-md-heightz col-lg-heightz col-topz" data-aos="zoom-in-up" data-aos-delay="400" data-aos-once="false">

                            <div class="responsive-container kotak-item schfx" itemscope>

                                <div class="dummy50"></div>
                                <a href="<?php echo base_url() . "products/detail/" . $row['slug']; ?>" class="img-container" style="background-image: url('<?php echo base_url() . "asset/foto_products/" . $foto; ?>');">
                                    <div class="centerer"></div>
                                    <img alt="<?php echo $row['judul'] ?>" class='img-thumbnailz hidden' src='<?php echo base_url() . "asset/foto_products/" . $foto; ?>' class='img-responsive'>
                                </a>
                                <!--img-container-->
                                <div class="kotak-item-caption hidden">
                                    <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo  $hari . ', ' . $tanggal ?></small>
                                    <div class="carousel-caption-headerz"><a href='<?php echo base_url() . "products/detail/" . $row['slug']; ?>'><?php echo $row['judul'] ?></a></div>
                                </div>



                            </div>
                            <div class="kotak-item-captionz">
                                <h3 class="carousel-caption-headerz"><a href='<?php echo base_url() . "products/detail/" . $row['slug']; ?>'><?php echo $row['judul'] ?></a></h3>
                            </div>

                        </div>

                        <?php if ($no % 3 == 0) : ?>
                            <div style='clear:both'></div>
                        <?php endif; ?>
                        <?php $no++;
                    } ?>
                    <div style="clear:both"></div>
                    <div class="col-xs-12">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>