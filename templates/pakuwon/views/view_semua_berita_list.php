<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo home_url().'asset/settings/'.setting('site_header'); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                <h1 class="text-white font-weight-light text-uppercase font-weight-bold">News</h1>
            </div>
        </div>
    </div>
</div>
<div class="breadcrumb rounded-0 p-0">
	<div class="container">
		<div class="col"><?= $breadcrumbs; ?></div>
	</div>
</div>
<section id="page" class="berita site-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="text-left pb-1 border-primary mb-4">
                    <h2 class="text-primary"><?php echo $title ?></h2>
                </div>
            </div>


            <?php
            // echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; Berita : $title</p><hr>";
            $no = 1;
            foreach ($berita->result_array() as $row) {
                $isi_berita = strip_tags($row['isi_berita']);
                $isi = substr($isi_berita, 0, 300);
                $isi = substr($isi_berita, 0, strrpos($isi, " ")) . '...';
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


                <div class="col-xs-12 col-sm-12 col-sm-heightz col-sm-heightz col-lg-heightz col-topz" data-aos="fade-up" data-aos-delay="0">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="responsive-container">

                                <div class="dummy50"></div>
                                <div class="img-container" style="background-image: url(<?php echo base_url() . "asset/foto_berita/" . $foto; ?>);">
                                    <div class="centerer"></div>
                                    <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url() . "asset/foto_berita/" . $foto; ?>' class='img-responsive'>
                                </div>
                                <!--img-container-->
                                <div class="kotak-item-caption hidden">
                                    <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo $hari . ', ' . $tanggal ?></small>
                                    <h3 class="carousel-caption-headerz"><a href='<?php echo base_url() . "berita/detail/" . $row['slug']; ?>'><?php echo $row['judul'] ?></a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <small class='date pull-left'><span class='glyphicon glyphicon-time'></span> <?php echo $hari . ', ' . $tanggal ?></small>
                            <h3><a href='<?php echo base_url() . "berita/detail/" . $row['slug']; ?>'><?php echo $row['judul'] ?></a></h3>
                            <?php echo $isi; ?>
                        </div>
                    </div>


                </div>

                <?php if ($no % 3 == 0) : ?>
                    <div style='clear:both'></div>
                <?php endif; ?>
                <?php
                $no++;
            }
            ?>
        </div>
        <?php echo $this->pagination->create_links(); ?>
    </div>
</section>
<?php if (isset($search_keyword)) : ?>
    <div id="katakunci" class="hidden"><?php echo $search_keyword; ?></div>
<?php endif; ?>