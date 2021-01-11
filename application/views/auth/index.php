<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo lang('index_heading'); ?> <small><?php echo lang('index_subheading'); ?></small></h2>
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
			<div class="x_content">
				<h1><?php echo lang('edit_user_heading'); ?></h1>
				<p><?php echo lang('edit_user_subheading'); ?></p>
				<div id="infoMessage"><?php echo $message; ?></div>
				<table cellpadding=0 cellspacing=10 class="datalist table table-striped table-bordered dataTable">
					<tr>
						<th><?php echo lang('index_fname_th'); ?></th>
						<th><?php echo lang('index_lname_th'); ?></th>
						<th><?php echo lang('index_email_th'); ?></th>
						<th><?php echo lang('index_groups_th'); ?></th>
						<th><?php echo lang('index_status_th'); ?></th>
						<th><?php echo lang('index_action_th'); ?></th>
					</tr>
					<?php foreach ($users as $user) : ?>
						<tr>
							<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
							<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
							<td>
								<?php foreach ($user->groups as $group) : ?>
									<?php echo anchor("auth/edit_group/" . $group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?><br />
								<?php endforeach ?>
							</td>
							<td><?php echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); ?></td>
							<td><?php echo anchor("auth/edit_user/" . $user->id, 'Edit <span class="glyphicon glyphicon-edit"></span>', array('class' => 'btn btn-primary btn-sm')); ?></td>
						</tr>
					<?php endforeach; ?>
				</table>

				<p><?php echo anchor('auth/create_user', lang('index_create_user_link'), array('class' => 'btn btn-primary btn-sm')) ?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'), array('class' => 'btn btn-success btn-sm')) ?></p>
			</div>
		</div>
	</div>
</div>
<?php
ob_start();
?>

<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = label;

			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}

		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#img-upload').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#site_logo").change(function() {
			readURL(this);
		});
	});
</script>
<script type="text/javascript" src="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/js-seopreview/js/jquery-seopreview.js"></script>
<link href="<?php echo base_url('admin-templates/' . $this->config->item('admin-template-name') . '/'); ?>vendors/js-seopreview/css/jquery-seopreview.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	$(document).ready(function() {
		$.seoPreview({
			google_div: "#seopreview-google",
			facebook_div: "#seopreview-facebook",
			metadata: {
				title: $('#meta_title'),
				desc: $('#meta_description'),
				url: {
					full_url: $('#meta-url')
				}
			},
			google: {
				show: true,
				date: false
			},
			facebook: {
				show: true,
				featured_image: $('#meta-featured-image')
			}
		});
	});
</script>
<?php
// ob_end_flush();
$output = ob_get_clean();
// ob_flush();
// echo $output;
?>
<?php $this->template->js_ajax = $output; ?>