<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Menu</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content categories">
        <div class="page-header">
          <h1><?php echo $title; ?> <small>Manage categories VIEW</small></h1>
          <?php if ($this->ion_auth->is_admin()) : ?>
            <a id="btn-add" class="btn btn-success pull-right" href="<?php echo site_url('categories/add_group'); ?>"><i class="icon-plus icon-white"></i> Add categories group</a>
          <?php endif; ?>
        </div>

        <?php if ($groups) : ?>
          <?php foreach ($groups as $group) : ?>

            <?php
            //echo $group['slug'];
            //print_r($group);
            if ($this->ion_auth->is_admin()) : ?>
              <div class="info_wrapper">
                <div class="info_header">
                  <span class="info_title"><?php echo $group['name']; ?> (<?php echo $group['slug']; ?>)</span>
                  <a style="float:right;margin-top:-5px;" class="btn btn-danger delete" data-type="group" data-href="<?php echo site_url('categories/delete_group/' . $group['id']); ?>" data-name="<?php echo $group['name']; ?>'" href="javascript:;"><i class="icon-trash icon-white"></i> Delete</a>
                  <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-primary" href="<?php echo site_url('categories/edit_group/' . $group['id']); ?>"><i class="icon-edit icon-white"></i> Edit</a>
                  <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-success" href="<?php echo site_url('categories/add/' . $group['id']); ?>"><i class="icon-plus icon-white"></i> Add item to group</a>
                </div>
                <div class="info_box">
                  <ol class="sortable">
                    <?php echo build_admin_tree_cat($group['items']); ?>
                  </ol>
                </div>
              </div>
            <?php elseif (($this->session->level == 'manager') && ($group['slug'] != 'admin')) : ?>
              <div class="info_wrapper">
                <div class="info_header">
                  <span class="info_title"><?php echo $group['name']; ?> (<?php echo $group['slug']; ?>)</span>
                  <?php if ($this->ion_auth->is_admin()) : ?>
                    <a style="float:right;margin-top:-5px;" class="btn btn-danger delete" data-type="group" data-href="<?php echo site_url('categories/delete_group/' . $group['id']); ?>" data-name="<?php echo $group['name']; ?>'" href="javascript:;"><i class="icon-trash icon-white"></i> Delete</a>
                  <?php endif; ?>

                  <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-primary" href="<?php echo site_url('categories/edit_group/' . $group['id']); ?>"><i class="icon-edit icon-white"></i> Edit</a>
                  <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-success" href="<?php echo site_url('categories/add/' . $group['id']); ?>"><i class="icon-plus icon-white"></i> Add item to group</a>
                </div>
                <div class="info_box">
                  <ol class="sortable">
                    <?php echo build_admin_tree_cat($group['items']); ?>
                  </ol>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="hero-unit">
            <p>There is no categories groups.</p>
            <p>
              <a class="btn btn-success" href="<?php echo site_url('categories/add_group'); ?>"><i class="icon-plus icon-white"></i> Add categories group</a>
            </p>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>





<!-- Small modal -->

<div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Please confirm</h4>
      </div>
      <div class="modal-body">
        <p>Add the <code>.modal-sm</code> class on <code>.modal-dialog</code> to create this small modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">OK</button>
      </div>
    </div>
  </div>
</div>

<?php
?>
<?php
ob_start();
?>
<!-- nested menu -->
<!-- Le styles -->
<link rel="stylesheet" href="<?php echo base_url('asset/admin/plugins'); ?>/nestedSortable/css/style.css" />
<!-- jQuery 2.1.4 -->
<!-- <script src="<?php echo base_url(); ?>asset/admin/plugins/jquery/jquery-2.1.4.min.js"></script> -->
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