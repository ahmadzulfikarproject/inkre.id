<?php //echo $this->ajax_pagination->create_links(); ?>
<div id="clients-list" class="row">
    <?php if(!empty($posts)): $no = 1; foreach($posts as $post): ?>
        <?php $isi_clients = strip_tags($post['isi_clients']); 
        $isi = substr($isi_clients,0,100); 
        $isi = substr($isi_clients,0,strrpos($isi," "));
        $hari = namahari($post['created_time']);
        $tanggal = tgl_indo($post['created_time']);
        //if ($post['gambar'] == ''){ $foto = 'nophoto.jpg'; }else{ $foto = $post['gambar']; }
        if ($post['gambar'] == ''){
                $foto = 'nophoto.jpg';
            }
        else{
            $foto = getnameimage($post['gambar'],'_200_400');
            
            if (!file_exists("asset/foto_clients/".$foto)) {
                if (file_exists("asset/foto_clients/".$post['gambar'])) {
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
        <div class="col-sm-2 col-sm-heightz col-md-heightz col-lg-heightz col-topz item-list">
            <div class="responsive-container box-item schfx" itemscope>

                <div class="dummy50"></div>
                <a href="<?php echo base_url()."clients/detail/".$post['slug']; ?>" class="img-container" data-toggle="tooltip" data-placement="top" title="<?php echo $post['judul'] ?>">
                    <div class="centerer"></div>
                    <img alt="<?php echo $post['judul'] ?>" class='img-thumbnailz' src='<?php echo base_url()."asset/foto_clients/".$foto ;?>' class='img-responsive'>                           
                </a><!--img-container-->
                <div class="box-item-caption hidden">
                    <small class='date pull-rightz'><span class='glyphicon glyphicon-time'></span> <?php echo $hari.', '.$tanggal; //echo $post['hari'],','.$tanggal ?></small>
                    <h3 class="carousel-caption-headerz"><a href='<?php echo base_url()."clients/detail/".$post['slug']; ?>'><?php echo $post['judul'] ?></a></h3>
                </div><!--kotak-item-caption-->

            </div><!--responsive-container-->
            <div class="kotak-item-title text-center hidden">
                <div class="box-title"><h3><a href='<?php echo base_url()."clients/detail/".$post['slug']; ?>'><?php echo $post['judul'] ?></a></h3></div>
                <span class="box-price"><?php //harga($post['price']); ?></span>
            </div>
        </div><!--col-->
        <?php if ($no % 6 == 0): ?>
            <div style='clear:both'></div>
        <?php endif; ?>

    <?php $no++; endforeach; else: ?>
    <p>Post(s) not available.</p>
    <?php endif; ?>
    <div style='clear:both'></div>
</div>
<?php echo $this->ajax_pagination->create_links(); ?>