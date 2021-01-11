            <a style='color:#000' href='<?php echo base_url(); ?>news'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Berita</span>
                  <?php //$jmla = $this->model_berita->list_berita()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('berita'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>pages'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">pages</span>
                  <?php //$jmlb = $this->model_pages->pages()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('pages'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>services'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class='fa fa-cogs'></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">services</span>
                  <?php //$jmlc = $this->model_services->list_services()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('services'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>
            <a style='color:#000' href='<?php echo base_url(); ?>products'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-dolly-flatbed"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">products</span>
                  <?php //$jmlc = $this->model_products->list_products()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('products'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>
            <a style='color:#000' href='<?php echo base_url(); ?>projects'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-project-diagram"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">projects</span>
                  <?php //$jmlc = $this->model_projects->list_projects()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('projects'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>
            <a style='color:#000' href='<?php echo base_url(); ?>client'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-address-card"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">client</span>
                  <?php //$jmlc = $this->model_client->client()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('client'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>
            <a style='color:#000' href='<?php echo base_url(); ?>slides'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-images"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">slide</span>
                  <?php //$jmlc = $this->model_slide->slide()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('slides_lists'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>agenda'>
            <div class="col-md-3 col-sm-6 col-xs-12 hidden">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Agenda</span>
                  <?php //$jmlc = $this->model_agenda->agenda()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('agenda'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>

            <a style='color:#000' href='<?php echo base_url(); ?>manajemenuser'>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Users</span>
                  <?php //$jmld = $this->model_users->users()->num_rows(); ?>
                  <span class="info-box-number"><?php echo totaldata('users'); ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </a>
            <?php //if (is_level('admin')): ?>
                       
                    
            <section class="col-lg-12 connectedSortable">
                <?php include "home_button_app.php"; ?>
            </section><!-- /.Left col -->
            <?php //endif; ?>

            

            <section class="col-lg-12 connectedSortable">
                <?php include "home_grafik.php"; ?>
            </section><!-- right col -->
            <?php //echo Modules::run('news/news'); ?>
            <?php 
            $data['no'] = 4;
            $this->load->module('news'); 
            $this->news->newsmodule($data);
            ?>