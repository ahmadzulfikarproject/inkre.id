<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?> <small>slide: <?php echo $slide['name']; ?></small></h1>
        </div>

        <div class="row">
            <div class="col-md-6">
            <?php echo form_open('slide/edit/'.$id, array('class'=>'form-horizontal')); ?>
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="name">Name</label>
                        <div class="controls col-xs-10">
                            <input type="text" class="input-xlarge form-control" id="name" name="name" value="<?php echo set_value('name', $name) ?>">
                        </div>
                    </div>
                    <!--<div class="form-group hidden">
                        <label class="control-label col-xs-2" for="slugz">slug</label>
                        <div class="controls col-xs-10">
                            <input type="text" class="input-xlarge form-control" id="slug" name="slugz" value="<?php echo set_value('slug', $slug); ?>">
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="icon">Icon</label>
                        <div class="controls col-xs-10">
                            <input type="text" class="input-xlarge form-control" id="icon" name="icon" value="<?php echo set_value('icon', $icon) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="parent_id">Parent</label>
                        <div class="controls col-xs-10">
                            <?php echo form_dropdown('parent_id', $dropdown, $parent_id); ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <a class="btn" href="<?php echo site_url('slide'); ?>">Cancel</a>
                        </div>
                    </div>
                </fieldset>
            <?php echo form_close(); ?>
            </div>
        </div>
<?php //$this->load->view('partials/footer'); ?>
