<table cellpadding="0" cellspacing="0" border="0" class="display groceryCrudTable table table-striped table-bordered" id="<?php echo uniqid(); ?>">
	<thead>
		<tr>
			<?php
			foreach ($columns as $column) { ?>
				<!-- MJD {--------------------------------------------------- -->
				<th <?php echo (isset($column->th_style_string) && $column->th_style_string != "") ? 'style="' . $column->th_style_string . '"' : ''; ?>><?php echo $column->display_as; ?></th>
				<!-- MJD ----------------------------------------------------} -->
			<?php } ?>
			<?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
				<th class='actions'><?php echo $this->l('list_actions'); ?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($list as $num_row => $row) { ?>
			<tr id='row-<?php echo $num_row ?>'>
				<?php foreach ($columns as $column) { ?>
					<!-- MJD {--------------------------------------------------- -->
					<td <?php echo (isset($column->td_style_string) && $column->td_style_string != "") ? 'style="' . $column->td_style_string . '"' : ''; ?>><?php echo $row->{$column->field_name} ?><?php //print_r($column);?></td>
					<!-- MJD ----------------------------------------------------} -->
				<?php } ?>
				<?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
					<td class='actions'>
						<?php
						if (!empty($row->action_urls)) {
							foreach ($row->action_urls as $action_unique_id => $action_url) {
								$action = $actions[$action_unique_id];
								?>
								<a href="<?php echo $action_url; ?>" class="edit_button btn btn-info btn-lg" role="button">
									<span class="ui-button-icon-primary ui-icon <?php echo $action->css_class; ?> <?php echo $action_unique_id; ?>"></span><span class="ui-button-text">&nbsp;<?php echo $action->label ?></span>
								</a>
								<!-- <input type="button" value="Simpan dan Kembali" class="btn btn-info btn-lg" id="save-and-go-back-button"> -->
							<?php }
					}
					?>
						<?php if (!$unset_read) { ?>
							<a href="<?php echo $row->read_url ?>" class="edit_button btn btn-info btn-xs" role="button">
								<span class="glyphicon glyphicon-info-sign"></span>
								<?php echo $this->l('list_view'); ?>
							</a>
						<?php } ?>

						<?php if (isset($unset_clone) && !$unset_clone) { ?>
							<a href="<?php echo $row->clone_url ?>" class="edit_button btn btn-info btn-xs" role="button">
								<span class="glyphicon glyphicon-duplicate"></span>
								<?php echo $this->l('list_clone'); ?>
							</a>
						<?php } ?>

						<?php if (!$unset_edit) { ?>
							<a href="<?php echo $row->edit_url ?>" class="edit_button btn btn-info btn-xs" role="button">
								<span class="glyphicon glyphicon-pencil"></span>
								<?php echo $this->l('list_edit'); ?>
							</a>
						<?php } ?>

						<?php if (!$unset_delete) { ?>
							<a onclick="javascript: return delete_row('<?php echo $row->delete_url ?>', '<?php echo $num_row ?>')" href="javascript:void(0)" class="delete_button btn btn-info btn-xs" role="button">
								<span class="glyphicon glyphicon-trash"></span>
								<?php echo $this->l('list_delete'); ?>
							</a>
						<?php } ?>
					</td>
				<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
	<tfoot class="">
		<tr>
			<?php foreach ($columns as $column) { ?>
				<th></th>
				<!-- <th><input type="text" name="<?php echo $column->field_name; ?>" placeholder="<?php echo $this->l('list_search') . ' ' . $column->display_as; ?>" class="form-control search_<?php echo $column->field_name; ?>" /></th> -->
			<?php } ?>
			<?php if (!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)) { ?>
				<th>
					<div class="btn-group hidden">
						<!-- <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only btn btn-info floatR refresh-data" role="button" data-url="<?php echo $ajax_list_url; ?>">
								<span class="ui-button-icon-primary ui-icon ui-icon-refresh"></span><span class="ui-button-text">&nbsp;</span>
							</button> -->
					</div>
					<a href="javascript:void(0)" role="button" class="clear-filtering btn btn-primary btn-block floatR">
						<!-- <span class="ui-button-icon-primary ui-icon ui-icon-arrowrefresh-1-e"></span>
										<span class="ui-button-text"><?php echo $this->l('list_clear_filtering'); ?></span> -->
						<span class="glyphicon glyphicon-refresh"></span>
						<?php echo $this->l('list_clear_filtering'); ?>
					</a>
				</th>
			<?php } ?>
		</tr>
	</tfoot>
</table>