<?php //$this->template->includeview('../../templates/'.template().'/views/home-sertifikat'); 
?>
<?php //$this->template->includeview('../../templates/'.template().'/views/home-services-cf-full'); 
?>
<?php //$this->template->includeview('../../templates/'.template().'/views/home-services-cf'); 
?>
<div class="site-blocks-cover overlay call p-5" style="background-image: url(<?php echo home_url() . 'asset/settings/' . setting('site_background'); ?>);" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">


                <h3 class="text-white bigtitle mb-0 font-weight-light">PT Inter Nusa Kreasindo</h3>
                <h4 class="text-white mb-5 font-weight-light">General Contractor and Fabricator tiang lampu PJU dan lampu PJU solar panel dan battery</h4>
                <p class="text-white mb-5 font-weight-light">Kami Menyediakan jasa Konstruksi untuk Masalah yang Kompleks & menyediakan produk tiang lampu PJU dan lampu PJU solar panel dan battery. Hubungi kami hari ini untuk layanan terbaik.</p>
                <p><a href="<?php echo base_url('contact/detail/' . Globals::idContact()->slug) ?>" class="btn btn-primary rounded shadow py-3 px-5 text-white">Hubungi Kami!</a></p>

            </div>
        </div>
    </div>
</div>
<?php //$this->template->includeview('../../templates/'.template().'/views/home-products-cf'); 
?>
<section class="pt-5 pb-5 hidden">
    <div class="container">

        <?php // $this->template->includeview('../../templates/'.template().'/views/home-pricing');
        ?>
    </div>

</section>