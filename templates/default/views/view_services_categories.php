<section id="page" class="services_categories">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <?php $this->template->includeview(template() . '/home-categories'); ?>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <h1><?php echo $title; ?></h1>
                <hr>
                <div class="row">

                    <?php
                    //echo "<p class='sidebar-title'><span class='glyphicon glyphicon-list'></span> &nbsp; services : $title</p><hr>";
                    $no = 1;
                    //print_r($categories->result_array());
                    foreach ($categories->result_array() as $row) {
                        $isi_services = strip_tags($row['isi_services']);
                        $isi = substr($isi_services, 0, 100);
                        $isi = substr($isi_services, 0, strrpos($isi, " "));
                        $tanggal = tgl_indo($row['tgl_posting']);
                        $hari = namahari($row['tgl_posting']);
                        if ($row['gambar'] == '') {
                            $foto = 'nophoto.jpg';
                        } else {
                            $foto = $row['gambar'];
                        } ?>


                        <div class="col-sm-4 col-sm-heightz col-md-heightz col-lg-heightz col-topz">

                            <div class="responsive-container kotak-item schfx" itemscope>

                                <div class="dummy80"></div>
                                <div class="img-container" style="background-image: url(<?php echo base_url() . "asset/foto_services/" . $foto; ?>);">
                                    <div class="centerer"></div>
                                    <img alt="<?php echo $row['judul'] ?>" class='img-thumbnail hidden' src='<?php echo base_url() . "asset/foto_services/" . $foto; ?>' class='img-responsive'>
                                </div>
                                <!--img-container-->
                                <div class="kotak-item-caption">
                                    <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo  $hari . ', ' . $tanggal ?></small>
                                    <div class="carousel-caption-headerz"><a href='<?php echo base_url() . "services/detail/" . $row['slug']; ?>'><?php echo $row['judul'] ?></a></div>
                                </div>
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