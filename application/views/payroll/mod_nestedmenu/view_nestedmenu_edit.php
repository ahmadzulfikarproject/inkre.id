<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?> <small>Navigation: <?php echo $navigation['name']; ?></small></h1>
        </div>

        <div class="row">
            <div class="col-md-6">
            <?php echo form_open('administrator/navigation/edit/'.$id, array('class'=>'form-horizontal')); ?>
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="name">Name</label>
                        <div class="controls col-xs-10">
                            <input type="text" class="input-xlarge form-control" id="name" name="name" value="<?php echo set_value('name', $name) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="url">URL</label>
                        <div class="controls col-xs-10">
                            <input type="text" class="input-xlarge form-control" id="url" name="url" value="<?php echo set_value('url', $url); ?>">
                        </div>
                    </div>
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
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="level">level</label>
                        <div class="controls col-xs-10">
                            <input type="text" class="input-xlarge form-control" id="level" name="level" value="<?php echo set_value('level', $level) ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="code">code</label>
                        <div class="controls col-xs-10">
                            <input type="text" class="input-xlarge form-control" id="code" name="code" value="<?php echo set_value('code', $code) ?>">
                        </div>
                    </div>
                    <div class="form-actions">
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
