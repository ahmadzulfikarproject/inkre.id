<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?> <small>slide: <?php echo $slide['name']; ?></small></h1>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo form_open('slide/add/'.$slide['id'], array('class'=>'form-horizontal')); ?>
                    <fieldset>
                        <div class="form-group">
                        <label class="control-label col-xs-2" for="name">Name</label>
                            <div class="controls col-xs-10">
                                <input type="text" class="input-xlarge form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
                            </div>
                        </div>
                        <!--
                        <div class="form-group hidden">
                            <label class="control-label col-xs-2" for="slugz">slug</label>
                            <div class="controls col-xs-10">
                                <input type="text" class="input-xlarge form-control" id="slugz" name="slug" value="<?php echo set_value('slug'); ?>">
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="control-label col-xs-2" for="name">Icon</label>
                            <div class="controls col-xs-10">
                                <input type="text" class="input-xlarge form-control" id="icon" name="icon" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2" for="parent_id">Parent</label>
                            <div class="controls col-xs-10">
                                <?php echo form_dropdown('parent_id', $dropdown); ?>
                            </div>
                        </div>
                        <div class="form-actions">
                             <div class="col-xs-offset-2 col-xs-10">
                                <button type="submit" class="btn btn-primary">Add item</button>
                                <a class="btn" href="<?php echo site_url('slide'); ?>">Cancel</a>
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-6">
            </div>
        </div>
<?php //$this->load->view('partials/footer'); ?>
