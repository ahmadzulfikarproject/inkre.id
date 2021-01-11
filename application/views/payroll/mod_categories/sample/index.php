<?php //$this->load->view('partials/header'); ?>
    <div class="page-header">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">Brand</a>
                </div>
                <!-- Collection of nav links, forms, and other content for toggling -->
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Profile</a></li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Messages <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Inbox</a></li>
                                <li><a href="#">Drafts</a></li>
                                <li><a href="#">Sent Items</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Trash</a></li>
                            </ul>
                        </li>
                        <?php echo build_bootstrapnav('menuutama',
                            array(
                                'sub_start_tag' => '<ul class="submenu dropdown-menu">', 'sub_end_tag' => '</ul>',
                                'start_tag' => '<li class="menuku">', 'end_tag' => '</li>',
                                'parent_tag' => '<li class="parentku dropdown">', 'parent_end_tag' => '</li>'

                            )

                            ); ?>
                    </ul>
                    <form class="navbar-form navbar-left">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
            </nav>

            <ul class="menufikar">
            <?php echo build_bootstrapnav('menuutama',
                array(
                    'sub_start_tag' => '<ul class="submenu">', 'sub_end_tag' => '</ul>',
                    'start_tag' => '<li class="menuku">', 'end_tag' => '</li>',

                )

                ); ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            
            <ul>
                <?php //echo build_tree('menuutama'); ?>
            </ul>
        </div>

        <div class="span8">
            
            <ol>
                <?php echo build_tree('menuutama',
                array(
                    'sub_start_tag' => '<ul class="submenu">', 'sub_end_tag' => '</ul>',
                    'start_tag' => '<li class="menuku">', 'end_tag' => '</li>',

                )

                ); ?>
                
            </ol>
        </div>
    </div>
        <div class="row">
        <div class="span4">
            
            <ul>
                <?php //echo build_tree_item('menuutama', 4); ?>
            </ul>
        </div>

        <div class="span8">
            
            <ol>
                <?php //echo build_tree_item('menuutama', 4, array('sub_start_tag' => '<ol>', 'sub_end_tag' => '</ol>')); ?>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            
            <ul class="breadcrumb">
                <?php //echo build_breadcrumb('menuutama', 4); ?>
            </ul>
        </div>
    </div>
<?php //$this->load->view('partials/footer'); ?>