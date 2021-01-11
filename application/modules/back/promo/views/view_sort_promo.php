		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Daftar Promo</h2>
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
					<div class="x_content promo">
						<div class="page-header">
							<!-- <h1><?php echo $title; ?> <small>Manage promo VIEW</small></h1> -->
							<?php if ($this->ion_auth->is_admin()) : ?>
								<a id="btn-add" class="btn btn-success pull-right" href="<?php echo site_url('promo/add_promo'); ?>"><i class="icon-plus icon-white"></i> Add promo</a>
							<?php endif; ?>
						</div>

						<div class="info_box">
							<ol class="sortable ui-sortable">
								<?php $no = 1;
								if (!empty($posts)) : foreach ($posts as $post) : ?>
										<?php
										if ($post['gambar'] != '') {
											$gambar = getnameimage($post['gambar'], '_200_400');
										}
										?>
										<li id="list_<?= $post['id_promo'];  ?>">
											<div>
												<i class="icon-move glyphicon glyphicon-move ui-sortable-handle"></i>
												<img src='<?php echo base_url() . "../asset/foto_promo/" . $gambar; ?>'>
												<?php echo $post['judul']; ?>
												<span class="pull-right">
													<a class="btn btn-primary btn-xs" href="<?php echo base_url('promo/edit_promo/') . $post['id_promo']; ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a> <a class="btn btn-danger btn-xs delete" data-toggle="modal" data-type="item" data-href="<?php echo base_url('promo/delete_promobaru/') . $post['id_promo']; ?>" data-name="<?php echo $post['judul']; ?>" href="javascript:;"><span class="glyphicon glyphicon-trash"></span> Delete</a></span>
											</div>
										</li>
									<?php $no++;
									endforeach;
								else : ?>
									<p>Post(s) not available.</p>
								<?php endif; ?>
							</ol>
						</div>

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
		<!-- <script>
			$(document).ready(function() {

				$('#featured-promo').sortable({
					axis: 'y',
					stop: function(event, ui) {
						var data = $(this).sortable('serialize');
						//$('#featured-promo-sort').text(data);
						$.ajax({
							type: 'post',
							url: '<?php echo base_url(); ?>promo/reorder_promo',
							data: {
								order: data,
								//csrf_test_name: $.cookie('csrf_cookie_name')
							},
							beforeSend: function() {
								$('.loading').show();
							},
							success: function(data, textStatus, jqXHR) {
								if (data.error == true) {
									$('.loading').fadeOut("slow", function() {

										$("#results").text('Terjadi keslahan, silahkan coba lagi...');
										//$('#results').show();
										$("#results").fadeIn('slow').delay(5000).fadeOut('slow');
									});
								} else {
									$('.loading').fadeOut("slow", function() {

										$("#results").text('Data Terkirim...');
										$("#results").fadeIn('slow').delay(5000).fadeOut('slow');
									});


								}
								//$('#result').html(data);
								//alert('Load was performed. Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information! ');
								console.log('jqXHR:');
								console.log(jqXHR);
								console.log('textStatus:');
								console.log(textStatus);
								console.log('data:');
								console.log(data);



							},
							error: function(jqXHR, textStatus, errorThrown) {
								//alert('An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!');

								$('#result').html('<p>status code: ' + jqXHR.status + '</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>' + jqXHR.responseText + '</div>');
								console.log('jqXHR:');
								console.log(jqXHR);
								console.log('textStatus:');
								console.log(textStatus);
								console.log('errorThrown:');
								console.log(errorThrown);
							}
						});
					}
					/*
				update : function () {
	                $.ajax({
	                    type: 'post',
	                    url: BASE_URL + 'promo/reorder',
	                    data: {
	                        order : $(this).nestedSortable('serialize'),
	                        csrf_test_name: $.cookie('csrf_cookie_name')
	                        }
	                });
	            }
	            */
				});
				/*
				$(".remove").click(function(){
				    var id = $(this).parents(".itempromo").attr("id");


				    if(confirm('Are you sure to remove this record ?'))
				    {
				        $.ajax({
				           url: '/item-list/'+id,
				           type: 'DELETE',
				           error: function() {
				              alert('Something is wrong');
				           },
				           success: function(data) {
				                $("#"+id).remove();
				                alert("Record removed successfully");  
				           }
				        });
				    }
				});
				*/

			});
		</script> -->

		<script>
			var BASE_URL = "<?php echo base_url(); ?>";
			var LIST_MAX_LEVELS = "<?php echo $this->config->item('max_levels', 'promo_list'); ?>";
		</script>
		<!--nested menu end-->
		<?php
		// ob_end_flush();
		$output = ob_get_clean();
		// ob_flush();
		// echo $output;
		?>
		<?php $this->template->js_ajax = $output; ?>