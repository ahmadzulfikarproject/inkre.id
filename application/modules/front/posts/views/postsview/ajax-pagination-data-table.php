
<?php if(!empty($posts)): foreach($posts as $post): ?>
<tr class="list-item">
	<td>
		<a href="javascript:void(0);"><?php echo $post['title']; ?></a>
	</td>
	<td>
		<?php echo $post['content']; ?>
	</td>
</tr>
<?php endforeach; else: ?>
<p>Post(s) not available.</p>
<?php endif; ?>
<?php echo $this->ajax_pagination->create_links(); ?>
