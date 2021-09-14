<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
	Launch demo modal
</button> -->
<?php if ($this->uri->segment(1) != 'contact') : ?>
	<?php echo Modules::run('enquiry/enquiry/ajax_index', array()); ?>
<?php endif; ?>