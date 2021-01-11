<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo home_url().'asset/settings/'.setting('site_header'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                <h1 class="text-white font-weight-light text-uppercase font-weight-bold"><?php echo $this->template->title; ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="breadcrumb rounded-0 p-0">
	<div class="container">
		<div class="col"><?= $breadcrumbs; ?></div>
	</div>
</div>
<section id="page" class="berita_categories site-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php $this->template->includeview('../../templates/' . template() . '/views/home-categories'); ?>
                <br>

            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="text-left pb-1 border-primary mb-4">
                    <h2 class="text-primary"><?php echo $this->template->title; ?></h2>
                </div>
                <hr>
                <div class="row">
                    <?php
                    //echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; berita : $title</p><hr>";
                    $no = 1;
                    //print_r($categories->result_array());
                    foreach ($categories->result_array() as $row) {
                        $isi_berita = strip_tags($row['isi_berita']);
                        $isi = substr($isi_berita, 0, 100);
                        $isi = substr($isi_berita, 0, strrpos($isi, " "));
                        $tanggal = tgl_indo($row['tanggal']);
                        $hari = namahari($row['tanggal']);
                        //if ($row['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $row['gambar']; }
                        if ($row['gambar'] == '') {
                            $foto = 'nophoto.jpg';
                        } else {
                            $foto = getnameimage($row['gambar'], '_200_400');

                            if (!file_exists("asset/foto_berita/" . $foto)) {
                                if (file_exists("asset/foto_berita/" . $row['gambar'])) {
                                    $foto = $row['gambar'];
                                } else {
                                    $foto = 'nophoto.jpg';
                                }

                                # code...
                            }

                            //$foto = $row['gambar'];
                        }
                        ?>


                        <div class="col-sm-4 col-sm-heightz col-md-heightz col-lg-heightz col-topz">

                            <div class="h-entry" data-aos="fade-up" data-aos-delay="0">
                                <div class="responsive-container box-item schfx" itemscope>

                                    <div class="dummy80"></div>
                                    <a href="<?php echo base_url() . "berita/detail/" . $row['slug']; ?>" class="img-container" data-toggle="tooltip" data-placement="top" title="<?php echo $row['judul'] ?>" style="background-image: url('<?php echo base_url() . "asset/foto_berita/" . $foto; ?>');">
                                        <div class="centerer"></div>
                                        <img alt="<?php echo $row['judul'] ?>" class='img-thumbnailz hidden' src='<?php echo base_url() . "asset/foto_berita/" . $foto; ?>' class='img-responsive'>
                                    </a>
                                    <!--img-container-->

                                </div>
                                <!--responsive-container-->
                                <h2 class="font-size-regular"><a href='<?php echo base_url() . "berita/detail/" . $row['slug']; ?>'><?php echo $row['judul'] ?></a></h2>
                                <div class="meta mb-4"><?php echo namahari($row['tanggal']) . ', ' . tanggalindo($row['tanggal'], 'd M Y H:i'); ?> <span class="mx-2">&bullet;</span> <?php echo $row['username'] ?></div>
                            </div>

                        </div>

                        <?php if ($no % 3 == 0) : ?>
                            <div class="clearfix"></div>
                        <?php endif; ?>
                        <?php $no++;
                    } ?>
                    <div class="clearfix"></div>
                    
                </div>
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>

    </div>
</section>