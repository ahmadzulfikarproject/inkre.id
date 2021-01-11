<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?></h1>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <?php echo form_open('administrator/navigation/add_group', array('class'=>'form-horizontal')); ?>      
                    <div class="form-group">
                        <label class="control-label  col-xs-2" for="name">Name</label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control input-xlarge" id="name" name="name" value="<?php echo set_value('name'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-primary">Add group</button>
                            <a class="btn" href="<?php echo site_url('al'); ?>">Cancel</a>
                        </div>
                    </div>
                <?php echo form_close(); ?>
                    
            </div>
             <div class="col-lg-6">
             </div>
        </div>
<?php //$this->load->view('partials/footer'); ?>
