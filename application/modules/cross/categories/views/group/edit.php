<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?> <small><?php echo $name; ?></small></h1>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <?php echo form_open('categories/edit_group/'.$id, array('class'=>'form-horizontal')); ?>
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