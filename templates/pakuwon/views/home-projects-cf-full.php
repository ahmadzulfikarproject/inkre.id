<?php
$projects = $this->model_utama_projects->semua_projects(0, 12)->result_array();
//print_r($projects);
$pages = array_chunk($projects, 3);
$no = 1;
$totalpage = count($pages);
$jumlah = $this->model_utama_projects->semua_projects(0, 12)->num_rows();

?>
<?php if ($jumlah > 1) : ?>
    <div class="site-section ftco-section ftco-properties bg-primary text-white-opacity-05">
        <div class="container hidden">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 border-primary text-center ftco-animate">
                    <h2 class="font-weight-light mb-0 text-white">OUR WORK</h2>
                    <span class="subheading">Proyek-proyek yang telah kami kerjakan</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-center d-flex">
                <div class="col-md-4 border-primary text-center ftco-animate">
                    <h1 class="font-weight-light mb-0 text-white site-section-heading">OUR WORK</h1>
                    <span class="subheading">Proyek-proyek yang telah kami kerjakan</span>
                </div>
                <div class="col-md-8">
                    <div class="owl-carousel projects-slider">
                        <?php foreach ($projects as $ads => $row) : ?>
                            <?php
                            $content = strip_tags($row['isi_projects']);
                            //$isi = substr($content,0,100);
                            $isi = word_limiter($content, 4);
                            //$isi = substr($content,0,strrpos($isi," "));
                            if ($row['gambar'] == '') {
                                $foto = 'nophoto.jpg';
                            } else {
                                $foto = $row['gambar'];
                            }
                            ?>
                            <div class="bg-light rounded p-2">
                                <a href="<?php echo base_url() . "projects/detail/" . $row['slug']; ?>" class="unit-1 text-center">
                                    <div class="responsive-container mb-0 imgz d-flex justify-content-center align-items-center">
                                        <div class="dummy"></div>
                                        <div class="img-container" style="background-image: url(<?php echo base_url() . "asset/foto_projects/" . $foto; ?>);">
                                            <div class="centerer"></div>
                                        </div>
                                        <!--img-container-->
                                        <div class="icon d-flex justify-content-center align-items-center">
                                            <span class="icon-search2"></span>
                                        </div>
                                    </div>
                                    <div class="unit-1-text p-2">
                                        <h6 class="unit-1-headingz"><?php echo $row['judul'] ?></h6>
                                        <p class="px-5"><?php echo $isi; ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>



    </div>
<?php endif; ?>