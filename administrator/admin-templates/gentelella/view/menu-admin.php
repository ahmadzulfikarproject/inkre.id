
<ul class="nav side-menu">

  <?php //if ($this->session->level == 'admin'): ?>
  <?php
        /*
        echo build_gentelella('payroll',
              array(
                  'sub_start_tag' => '<ul class="nav child_menu">', 'sub_end_tag' => '</ul>',
                  'start_tag' => '<li class="menuku %s scrollnav">', 'end_tag' => '</li>',
                  'parent_tag' => '<li class="treeview">', 'parent_end_tag' => '</li>'

              )

              );
              */
        echo build_gentelella('admin',
              array(
                  'sub_start_tag' => '<ul class="nav child_menu">', 'sub_end_tag' => '</ul>',
                  'start_tag' => '<li class="menuku %s scrollnav">', 'end_tag' => '</li>',
                  'parent_tag' => '<li class="treeview">', 'parent_end_tag' => '</li>'

              )

              );
  ?>
  <?php //endif;?>


  <li><a href="<?php echo base_url('auth/edit_user/'.Globals::authenticatedMemeberId()->id); ?>"><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>
  <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
</ul>
