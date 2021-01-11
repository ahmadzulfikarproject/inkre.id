<div id="products-list" class="row">
        <?php if(!empty($posts)): $no = 1; foreach($posts as $post): ?>
        <?php $isi_products = strip_tags($post['isi_products']);
        $isi = substr($isi_products,0,100);
        $isi = substr($isi_products,0,strrpos($isi," "));
        $hari = namahari($post['tgl_posting']);
        $tanggal = tgl_indo($post['tgl_posting']);
        //if ($post['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $post['gambar']; }
        if ($post['gambar'] == ''){
            $foto = 'nophoto.jpg';
        }
        else{
            $foto = getnameimage($post['gambar'],'_200_400');

            if (!file_exists("asset/foto_products/".$foto)) {
                if (file_exists("asset/foto_products/".$post['gambar'])) {
                    $foto = $post['gambar'];
                }
                else{
                    $foto = 'nophoto.jpg';
                }

                # code...
            }

            //$foto = $post['gambar'];
        }
        ?>
        <div class="col-sm-4 col-sm-heightz col-md-heightz col-lg-heightz col-topz item-list">
            <div class="h-entry" data-aos="fade-up" data-aos-delay="0">
                <div class="responsive-container box-item schfx" itemscope>

                    <div class="dummy80"></div>
                    <a href="<?php echo base_url()."products/detail/".$post['slug']; ?>" class="img-container" data-toggle="tooltip" data-placement="top" title="<?php echo $post['judul'] ?>" style="background-image: url('<?php echo base_url()."asset/foto_products/".$foto ;?>');">
                        <div class="centerer"></div>
                        <img alt="<?php echo $post['judul'] ?>" class='img-thumbnailz hidden' src='<?php echo base_url()."asset/foto_products/".$foto ;?>' class='img-responsive'>
                    </a><!--img-container-->

                </div><!--responsive-container-->
                <h2 class="font-size-regular"><a href='<?php echo base_url()."products/detail/".$post['slug']; ?>'><?php echo $post['judul'] ?></a></h2>
                <div class="meta mb-4"><?php echo namahari($post['tgl_posting']).', '.tanggalindo($post['tgl_posting'],'d M Y H:i'); ?> <span class="mx-2">&bullet;</span> <?php echo $post['username'] ?></div>
            </div>
        </div><!--col-->
        <?php if ($no % 3 == 0): ?>
            <div style='clear:both'></div>
        <?php endif; ?>

        <?php $no++; endforeach; else: ?>
            <p>Post(s) not available.</p>
        <?php endif; ?>
        <div style='clear:both'></div>
    </div>
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>