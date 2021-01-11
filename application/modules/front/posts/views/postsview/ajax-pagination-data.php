<?php echo $this->ajax_pagination->create_links(); ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>judul</th>
			<th>Content</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($posts)): foreach($posts as $post): ?>
            <tr class="list-item">
            	<td>
            		<a href="javascript:void(0);"><?php echo $post['title']; ?></a>
            	</td>
            	<td><?php echo $post['content']; ?></td>
            </tr>
        <?php endforeach; else: ?>
        <p>Post(s) not available.</p>
        <?php endif; ?>
		
	</tbody>
</table>
<?php if(!empty($posts)): foreach($posts as $post): ?>
    <div class="list-itemz hidden"><a href="javascript:void(0);"><h2><?php echo $post['title']; ?></h2></a></div>
<?php endforeach; else: ?>
<p>Post(s) not available.</p>
<?php endif; ?>
<?php echo $this->ajax_pagination->create_links(); ?>