
<div class="container">
	<div class="row">
		<div id="left" class="span3z">
			<div id="categories" class="panel panel-default sidefix-1 affix-top">
				<div class="panel-heading">
					<h3 class="panel-title hidden">Kategori <strong><?php echo $this->router->fetch_module(); ?></strong></h3>
					<div class="text-left pb-1 border-primary mb-4">
						<h2 class="text-primary">Kategori <strong><?php echo $this->router->fetch_module(); ?></strong></h2>
					</div>
				</div>
				<div class="panel-body">
					<ul id="categories_list" class="nav menu">
		            	<?php
		            		$modulename = $this->router->fetch_module();
		            		if (!empty($modulename)) {
		            			$modulename = $modulename;
		            		}else{
		            			$modulename = 'products';
		            		}
							echo build_categories_sidebar($modulename,
								array(
									'sub_start_tag' => '<ul class="unstyled collapse" id="sub-item-5">', 'sub_end_tag' => '</ul>',
									'start_tag' => '<li class="item-1 deeper">', 'end_tag' => '</li>',
									'parent_tag' => '<li class="parentku deeper parent">', 'parent_end_tag' => '</li>'

								)

							);

						?>

		            </ul>
				</div>
			</div>



		</div>
	</div>
</div>
