<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?> <small><?php echo $name; ?></small></h1>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <?php echo form_open('administrator/navigation/edit_group/'.$id, array('class'=>'form-horizontal')); ?>
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label col-xs-2" for="name">Name</label>
                            <div class="col-xs-10">
                                <input type="text" class="form-control input-xlarge" id="name" name="name" value="<?php echo set_value('name', $name); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <a class="btn" href="<?php echo site_url('al'); ?>">Cancel</a>
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
<?php //$this->load->view('partials/footer'); ?>
