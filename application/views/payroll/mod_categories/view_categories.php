
<?php //$this->load->view('partials/header'); ?>
        <div class="page-header">
            <h1><?php echo $title; ?> <small>Manage categories</small></h1>
            <a id="btn-add" class="btn btn-success pull-right" href="<?php echo site_url('administrator/categories/add_group'); ?>"><i class="icon-plus icon-white"></i> Add categories group</a>
        </div>

        <?php if ($groups): ?>
      <?php foreach ($groups as $group): ?>

        <?php 
        //echo $group['slug'];
        //print_r($group);
        if ($this->session->level == 'admin'): ?>
            <div class="info_wrapper">
              <div class="info_header">
                <span class="info_title"><?php echo $group['name']; ?> (<?php echo $group['slug']; ?>)</span>
                <a style="float:right;margin-top:-5px;" class="btn btn-danger delete" data-type="group" data-href="<?php echo site_url('administrator/categories/delete_group/'.$group['id']); ?>" data-name="<?php echo $group['name']; ?>'" href="javascript:;"><i class="icon-trash icon-white"></i> Delete</a>
                <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-primary" href="<?php echo site_url('administrator/categories/edit_group/'.$group['id']); ?>"><i class="icon-edit icon-white"></i> Edit</a>
                <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-success" href="<?php echo site_url('administrator/categories/add/'.$group['id']); ?>"><i class="icon-plus icon-white"></i> Add item to group</a>
              </div>
              <div class="info_box categories">
                <ol class="sortable">
                  <?php echo build_categories_admin_tree($group['items']); ?>
                </ol>
              </div>
            </div>
        <?php elseif (($this->session->level == 'manager') && ($group['slug'] != 'admin')): ?>
            <div class="info_wrapper">
              <div class="info_header">
                <span class="info_title"><?php echo $group['name']; ?> (<?php echo $group['slug']; ?>)</span>
                <a style="float:right;margin-top:-5px;" class="btn btn-danger delete" data-type="group" data-href="<?php echo site_url('administrator/categories/delete_group/'.$group['id']); ?>" data-name="<?php echo $group['name']; ?>'" href="javascript:;"><i class="icon-trash icon-white"></i> Delete</a>
                <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-primary" href="<?php echo site_url('administrator/categories/edit_group/'.$group['id']); ?>"><i class="icon-edit icon-white"></i> Edit</a>
                <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-success" href="<?php echo site_url('administrator/categories/add/'.$group['id']); ?>"><i class="icon-plus icon-white"></i> Add item to group</a>
              </div>
              <div class="info_box categories">
                <ol class="sortable">
                  <?php echo build_categories_admin_tree($group['items']); ?>
                </ol>
              </div>
            </div>
        <?php endif;?>
      <?php endforeach; ?>
        <?php else: ?>
            <div class="hero-unit">
                <p>There is no categories groups.</p>
                <p>
                    <a class="btn btn-success" href="<?php echo site_url('administrator/categories/add_group'); ?>"><i class="icon-plus icon-white"></i> Add categories group</a>
                </p>
            </div>
        <?php endif; ?>
        

 

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
       
<?php //$this->load->view('partials/footer'); ?>
