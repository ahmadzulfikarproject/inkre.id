<?php echo $this->ajax_pagination->create_links(); ?>
<?php echo $this->input->cookie('numView',true); ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>name</th>
			<th>phone</th>
			<th>message</th>
			<th>date</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = $start; if(!empty($posts)): foreach($posts as $post): ?>
            <tr class="list-item">
            	<td><?php echo $no+1; ?></td>
            	<td>
            		<a href="javascript:void(0);"><?php echo $post['name']; ?></a>
            	</td>
            	<td><?php echo $post['phone']; ?></td>
            	<td><?php echo $post['message']; ?></td>
            	<td><?php echo tanggalindo($post['date'],"d-m-Y H:i:s"); //echo tgl_indo($post['tanggal']) ?></td>
            </tr>
        <?php $no++; endforeach; else: ?>
        <p>Post(s) not available.</p>
        <?php endif; ?>
		
	</tbody>
</table>
<?php if(!empty($posts)): foreach($posts as $post): ?>
    <div class="list-itemz hidden"><a href="javascript:void(0);"><h2><?php echo $post['name']; ?></h2></a></div>
<?php endforeach; else: ?>
<p>Post(s) not available.</p>
<?php endif; ?>
<?php echo $this->ajax_pagination->create_links(); ?>