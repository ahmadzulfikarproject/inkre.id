<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url() . webconfig('asset') . "/foto_berita/" . $record['gambar'] ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                <h1 class="text-white font-weight-light text-uppercase"><?= $record['judul']; ?></h1>
                <!-- <p class="breadcrumb-custom"><a href="index.html">Home</a> <span class="mx-2">&gt;</span> <span><?php echo $record['judul'] ?></span></p> -->
            </div>
        </div>
    </div>
</div>
<div class="breadcrumb rounded-0 p-0">
	<div class="container">
		<div class="col"><?= $breadcrumbs; ?></div>
	</div>
</div>
<section id="page" class="site-section images_gallery">
    <div class="container" data-aos="fade" data-aos-easing="ease-in-sine" data-aos-duration="500">
        <div class="row">
            <div class='col-md-12'>
                <div class="kontenpage">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="ftco-properties">
                                <div class="row no-padding">
                                    <div class="slide-page-detail owl-carousel ftco-animate">
                                        <?php if ($record['gambar'] != '') : ?>
                                            <div class="item">
                                                <div class="responsive-container box-item schfx" itemscope>
                                                    <div class="dummy50"></div>
                                                    <a href="<?php echo base_url() . "asset/foto_berita/" . $record['gambar'] ?>" class="img-container photobox_a" style="background-image: url('<?php echo base_url() . "asset/foto_berita/" . $record['gambar'] ?>');">
                                                        <div class="centerer"></div>
                                                        <img class='img-thumbnailz hidden' src='<?php echo base_url() . "asset/foto_berita/" . $record['gambar'] ?>' class='img-responsive'>
                                                    </a>
                                                    <!--img-container-->
                                                </div>
                                                <!--responsive-container-->
                                                <!-- <span><?php echo $record['judul'] ?></span> -->
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($images)) {
                                            $i = 1;
                                            foreach ($images as $file) { ?>
                                                <?php
                                                if ($file['file_name'] == '') {
                                                    $foto = 'nophoto.jpg';
                                                } else {
                                                    $foto = getnameimage($file['file_name'], '_200_400');
                                                    $fotosrc = $file['file_name'];
                                                    if (!file_exists("asset/foto_berita/berita/" . $foto)) {
                                                        if (file_exists("asset/foto_berita/berita/" . $file['file_name'])) {
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
                                                <div class="item">
                                                    <div class="responsive-container box-item schfx" itemscope>

                                                        <div class="dummy50"></div>
                                                        <a href="<?php echo base_url() . "asset/foto_berita/berita/" . $fotosrc; ?>" class="img-container photobox_a" style="background-image: url('<?php echo base_url() . "asset/foto_berita/berita/" . $foto; ?>');">
                                                            <div class="centerer"></div>
                                                            <img class='img-thumbnailz hidden' src='<?php echo base_url() . "asset/foto_berita/berita/" . $foto; ?>' class='img-responsive'>
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
                        </div>
                        <!--col-->
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <div class="text-left pb-1 border-primary mb-4">
                                <h2 class="text-primary"><?php echo $record['judul'] ?></h2>
                            </div>
                            <ul class="post_details clearfix">
                                <li class="detail category">In <?php categorieslinkname($record['id_categories'], 'berita'); ?></li>
                                <li class="detail date"><span class='glyphicon glyphicon-time'></span> <?php echo namahari($record['tanggal']) . ', ' . tanggalindo($record['tanggal'], 'd M Y H:i') . ' WIB, '; ?></li>
                                <li class="detail author">By <a href="#" title="<?php echo $record['username']; ?>"><?php echo $record['username']; ?></a></li>
                                <li class="detail views"><?php echo $record['berita_views'] . ' View' ?></li>
                                <!-- <li class="detail comments"><a href="#comments_list" class="scroll_to_comments" title="6 Comments">6 Comments</a></li> -->
                            </ul>
                            <hr>
                            <?php echo $record['isi_berita'] ?>
                            <hr>
                            <?php share(base_url() . "berita/detail/" . $record['slug'], $record['judul']); ?>
                            <hr>
                            <div id="tags_list" class="row">
                                <div class="col-lg-3">
                                    <?php categorieslink($record['id_categories'], 'berita'); ?>
                                </div>
                                <div class="col-lg-9">
                                    <?php berita_tagslinkdetail($record['id_berita'], 'berita'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style='clear:both'></div>
        </div>
    </div>
</section>
<hr>
<div class="col">
    <?php
    Globals::setIdpage($record['id_berita']);
    //echo $record['id_berita'];
    $data = array();
    //$data['limit'] = '8';
    //$data['id_berita'] = $record['id_berita'];
    $this->load->module('berita');
    $this->berita->related(16);
    ?>
</div>