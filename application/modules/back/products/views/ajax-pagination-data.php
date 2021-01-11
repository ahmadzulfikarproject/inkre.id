<?php //echo $this->ajax_pagination->create_links(); ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>No.</th>
			<th>Title</th>
			<th>Kategori</th>
			<th>Read</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
        <?php $no = $start; if(!empty($posts)): foreach($posts as $post): ?>
            <?php 
                if ($post['id_categories']=='0'){
                  $kategori = '<i style="color:red">Pending</i>';
                }else{
                  $kategori = categories($post['id_categories']);//$post['nama_kategori'];
                }
             ?>
            <tr class="list-item">
                <td><?php echo $no+1; ?></td>
                <td>
                    <a href="<?php echo base_url('products/edit_products/').$post['id_products']; ?>"><?php echo $post['judul']; ?></a>
                </td>
                <td><?php echo $kategori; ?></td>
                <td><?php if ($post['products_views'] > 0){echo $post['products_views'].' Kali';}?></td>
                <td><?php echo tanggalindo($post['tgl_posting'],"d-m-Y H:i:s"); //echo tgl_indo($post['tanggal']) ?></td>
                <td><center>
                        <a class='btn btn-success btn-xs' title='Edit Data' href='<?php echo base_url('products/edit_products/').$post['id_products']; ?>'><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-xs' title='Delete Data' href='<?php echo base_url('products/delete_products/').$post['id_products']; ?>' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                    </center>
                </td>
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