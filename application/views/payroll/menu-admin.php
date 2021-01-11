        <?php $users = $this->model_users->users_edit($this->session->username)->row_array();

        //print_r($users);
        ?>

        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo home_url('asset/'.$users['usergambar']); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $users['nama_lengkap']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <div><?php //echo totaldata('nama','hubungi') ?></div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">

            <?php //if ($this->session->level == 'admin'): ?>
            <?php echo build_adminlte('admin',
                        array(
                            'sub_start_tag' => '<ul class="treeview-menu">', 'sub_end_tag' => '</ul>',
                            'start_tag' => '<li class="menuku %s scrollnav">', 'end_tag' => '</li>',
                            'parent_tag' => '<li class="treeview">', 'parent_end_tag' => '</li>'

                        )

                        );?>
            <?php //endif;?>
            
            
            <li><a href="<?php echo base_url(); ?>administrator/edit_manajemenuser/<?php echo $this->session->username; ?>"><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>
          
            <li><a href="<?php echo base_url(); ?>dashboard/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
          </ul>
         
        </section>