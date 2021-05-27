<nav class="site-navigation shadowz roundedz bg-primaryz position-relative text-right px-4" role="navigation">

  <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
    <?php echo build_bootstrapnavnew('menuutama',
      array(
        'sub_start_tag' => '<ul class="submenu dropdown">', 'sub_end_tag' => '</ul>',
        'start_tag' => '<li class="menuku %s scrollnav">', 'end_tag' => '</li>',
        'parent_tag' => '<li class="parentku has-children">', 'parent_end_tag' => '</li>'

      )

      ); ?>
      <?php if ($this->ion_auth->logged_in()): ?>


        <!-- <li><a href="<?php echo base_url(); ?>administrator/dashboard/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
        <li><a href="<?php echo base_url(); ?>administrator/dashboard"><span>Administrator</span></a></li> -->
      <?php endif; ?>
  </ul>
</nav>
