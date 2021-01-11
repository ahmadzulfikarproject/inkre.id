<?php
$clients = $this->model_utama_clients->semua_clients(0, 12)->result_array();
//print_r($clients);
$pages = array_chunk($clients, 3);
$no = 1;
$totalpage = count($pages);
$jumlah = $this->model_utama_clients->semua_clients(0, 12)->num_rows();
// print_r($clients);

?>
<?php if ($jumlah > 1) : ?>
    <div class="site-section bg-secondary ftco-section ftco-properties bg-primary text-white-opacity-05">
        <div class="container">
            <div class="row align-items-center justify-content-center d-flex">
                <div class="col-md-8">
                    <div class="owl-carousel logo-slider">
                        <?php foreach ($clients as $ads => $row) : ?>
                            <?php
                            $content = strip_tags($row['isi_clients']);
                            //$isi = substr($content,0,100);
                            $isi = word_limiter($content, 4);
                            //$isi = substr($content,0,strrpos($isi," "));
                            if ($row['gambar'] == '') {
                                $foto = 'nophoto.jpg';
                            } else {
                                $foto = $row['gambar'];
                            }
                            ?>
                            <div class="bg-lightz p-2z item">
                                <a href="<?php echo base_url() . "clients/detail/" . $row['slug']; ?>" class="unit-1z text-center">
                                    <img src="<?php echo base_url() . "asset/foto_clients/" . $foto; ?>" alt="<?php echo $row['judul'] ?>">
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="col-md-4 border-primary text-center ftco-animate">
                    <div class="bg-primaryz pd-3">

                        <h1 class="font-weight-light mb-0 text-white site-section-headingz">OUR CLIENTS</h1>
                        <span class="subheadingz">Kami terus bekerja untuk memberikan kepuasan kepada pelanggan</span>
                    </div>
                </div>
            </div>
        </div>



    </div>
<?php endif; ?>