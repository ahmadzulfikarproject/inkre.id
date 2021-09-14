
<div class="container">
	<div class="row">
		<div id="left" class="span3z">
			<div id="categories" class="panel panel-default sidefix-1 affix-top">
				<div class="panel-heading">
					<!-- <h3 class="panel-title hidden">Kategori <strong><?php echo $this->router->fetch_module(); ?></strong></h3> -->
					<div class="text-left pb-1 border-primaryz mb-4">
						<h3 class="text-primary"><?php echo setting('site_name')?></h3>
						<strong><?php echo setting('site_description')?></strong>
					</div>
				</div>
				<div class="panel-body">
					<ul id="categories_list" class="list-group list-group-flush">
		            	<?php
		            		$modulename = $this->router->fetch_module();
		            		if (!empty($modulename)) {
		            			$modulename = $modulename;
		            		}else{
		            			$modulename = 'services';
		            		}
							echo build_categories_sidebar($modulename,
								array(
									'sub_start_tag' => '<ul class="unstyled collapse" id="sub-item-5">', 'sub_end_tag' => '</ul>',
									'start_tag' => '<li class="list-group-item item-1 deeper">', 'end_tag' => '</li>',
									'parent_tag' => '<li class="list-group-item parentku deeper parent">', 'parent_end_tag' => '</li>'

								)

							);

						?>

		            </ul>
				</div>
			</div>



		</div>
	</div>
</div>
