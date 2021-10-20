<?php
$isi_berita = strip_tags($record['isi_products']);
$isi = substr($isi_berita, 0, 120);
$isi = substr($isi_berita, 0, strrpos($isi, " "));
//$tgl1 = tgl_indoo($record['tgl_mulai']);
//$tgl2 = tgl_indoo($record['tgl_selesai']);
//$created_time = tgl_indoo($record['tanggal']);

?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url() . "asset/foto_products/" . $record['gambar'] ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                <h1 class="text-white font-weight-light text-uppercase"><?php echo $record['judul'] ?></h1>
                <p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span><?php echo $record['judul'] ?></span></p>
            </div>
        </div>
    </div>
</div>
<section id="page" class="images_gallery pt-4">
    <?php if ($record['gambar'] != '') : ?>
        <div class="pageheader hidden" data-stellar-background-ratio="0.5" style="background-image: url(<?php echo base_url() . "asset/foto_products/" . $record['gambar'] ?>);" data-aos="fade" data-aos-easing="ease-in-sine" data-aos-duration="500">
            <a class="photobox_az" href="<?php echo base_url() . "asset/foto_products/" . $record['gambar'] ?>">
                <img alt="<?php echo $record['judul'] ?>" class='products-img thumbnail hidden' width='100%' src='<?php echo base_url() . "asset/foto_products/" . $record['gambar'] ?>'>
            </a>
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
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <?php
            //$tanggal = tgl_indo($record['created_time']);
            //echo "<div class='col-md-12'><p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> $record[judul]</p></div><hr>
            ?>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php $this->template->includeview('../../templates/' . template() . '/views/home-categories'); ?>
                <br>
            </div>
            <div class='col-xs-12 col-sm-9 col-md-9 col-lg-9'>
                <div class="kontenpage hero" itemscope>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hiddenz">
                            <?php if ($record['gambar'] != '') : ?>
                                <div class="images_galleryz mb-5">

                                    <a class="photobox_a" href="<?php echo base_url() . "asset/foto_products/" . $record['gambar'] ?>" data-toggle="tooltip" title="View image <?php echo $record['judul'] ?>">
                                        <img alt="<?php echo $record['judul'] ?>" class='products-img thumbnail hiddenz' width='100%' src='<?php echo base_url() . "asset/foto_products/" . $record['gambar'] ?>'>
                                    </a>
                                    <!-- <span><?php echo $record['judul'] ?></span> -->
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="no-padding">
                                <div class="row no-padding">


                                    <?php if (!empty($images)) {
                                        $i = 1;
                                        foreach ($images as $file) { ?>
                                            <?php
                                            if ($file['file_name'] == '') {
                                                $foto = 'nophoto.jpg';
                                            } else {
                                                $foto = getnameimage($file['file_name'], '_200_400');
                                                $fotosrc = $file['file_name'];
                                                if (!file_exists("asset/foto_products/products/" . $foto)) {
                                                    if (file_exists("asset/foto_products/products/" . $file['file_name'])) {
                                                        $foto = $file['file_name'];
                                                        //$fotosrc = $file['file_name'];
                                                    } else {
                                                        $foto = 'nophoto.jpg';
                                                    }

                                                    # code...
                                                }

                                                //$foto = $post['gambar'];
                                            }


                                            ?>
                                            <?php 
                                            ?>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <div class="responsive-container box-item schfx" itemscope>

                                                    <div class="dummy50"></div>
                                                    <a href="<?php echo base_url() . "asset/foto_products/products/" . $fotosrc; ?>" class="img-container photobox_a" style="background-image: url('<?php echo base_url() . "asset/foto_products/products/" . $foto; ?>');">
                                                        <div class="centerer"></div>
                                                        <img class='img-thumbnailz hidden' src='<?php echo base_url() . "asset/foto_products/products/" . $foto; ?>' class='img-responsive'>
                                                    </a>
                                                    <!--img-container-->
                                                </div>
                                                <!--responsive-container-->
                                            </div>


                                            <?php $i++;
                                        }
                                    } else { ?>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="caption visible-xsz visible-mdz">
                                <div class="text-left pb-1 border-primary mb-4">
                                    <h2 class="text-primary"><?php echo $record['judul'] ?></h2>
                                </div>
                            </div>
                            <ul id="attachment">
                                <?php if (!empty($files)) {
                                    $i = 1;
                                    foreach ($files as $file) { ?>

                                        <?php 
                                        ?>
                                        <li>
                                            <a target="_BLANK" href="<?php echo base_url('asset/foto_products/attachment/' . $file['file_name']); ?>"><?php echo $file['file_name'] ?></a>
                                        </li>

                                        <?php $i++;
                                    }
                                } else { ?>

                                <?php } ?>

                            </ul>
                            <?php echo $record['isi_products'] ?>
                            <?php 
                            ?>

                            <div id="p-info" class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">More Info</h3>
                                </div>
                                <div class="panel-body">
                                    <?php categorieslink($record['id_categories'], 'products'); ?>
                                    <?php tagslinkdetail($record['id_products'], 'products'); ?>
                                </div>
                            </div>

                        </div>

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
    Globals::setIdpage($record['id_products']);
    //echo $record['id_products'];
    $data = array();
    //$data['limit'] = '8';
    //$data['id_products'] = $record['id_products'];
    $this->load->module('products');
    $this->products->related(16);
    ?>
</div>