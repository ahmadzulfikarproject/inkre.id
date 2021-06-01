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


                <h1 class="text-white bigtitle mb-0 text-uppercase font-weight-bold">CV. Rehils Putra Mandiri</h1>
                <h2 class="text-white mb-5 text-uppercase font-weight-light">Sewa Genset Berpengalaman Pelayanan 24 Jam Non Stop</h2>
                <p><a href="<?php echo base_url('contact/detail/' . Globals::idContact()->slug) ?>" class="btn btn-primary rounded shadow py-3 px-5 text-white">Hubungi Kami!</a></p>

            </div>
        </div>
    </div>
</div>
<?php //$this->template->includeview('../../templates/'.template().'/views/home-products-cf'); 
?>
<section class="pt-5 pb-5 hidden">
    <div class="container">

        <?php //$this->template->includeview('../../templates/'.template().'/views/home-pricing');?>
    </div>
    
</section>

<section class="hidden">
    <div class="container">
        <div class="row">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title">Gallery</h1>
            </div>

            <div align="center">
                <button class="btn btn-default filter-button" data-filter="all">All</button>
                <button class="btn btn-default filter-button" data-filter="hdpe">HDPE Pipes</button>
                <button class="btn btn-default filter-button" data-filter="sprinkle">Sprinkle Pipes</button>
                <button class="btn btn-default filter-button" data-filter="spray">Spray Nozzle</button>
                <button class="btn btn-default filter-button" data-filter="irrigation">Irrigation Pipes</button>
            </div>
            <br />



            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="http://fakeimg.pl/350x200/" class="img-responsive">
            </div>
        </div>
    </div>
</section>