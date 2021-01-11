<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?> <small>categories: <?php echo $categories['name']; ?></small></h1>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo form_open('categories/add/'.$categories['id'], array('class'=>'form-horizontal')); ?>
                    <fieldset>
                        <div class="form-group">
                        <label class="control-label col-xs-2" for="name">Name</label>
                            <div class="controls col-xs-10">
                                <input type="text" class="input-xlarge form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
                            </div>
                        </div>
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
                                <a class="btn" href="<?php echo site_url('categories'); ?>">Cancel</a>
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-6">
            </div>
        </div>
<?php //$this->load->view('partials/footer'); ?>
<?php
ob_start();
?>
<!-- nested menu -->
<!-- Le styles -->
<link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/css/style.css" />
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>asset/admin/plugins/jquery/jquery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>asset/admin/plugins/jqueryui/jquery-ui.min.js"></script>

<script src="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/js/jquery.cookie.js"></script>
<script src="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/js/jquery.mjs.nestedSortable.js"></script>
<script src="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/js/scripts.js"></script>

<script>
  var BASE_URL = "<?php echo base_url(); ?>";
  var LIST_MAX_LEVELS = "<?php echo $this->config->item('max_levels', 'adjacency_list'); ?>";
</script>
<!--nested menu end-->
<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>