<?php if($this->session->flashdata('success') != '') { ?>
<div class="alert alert-success alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<?php echo $this->session->flashdata('success'); ?>
</div>
<?php } ?>
<?php if($this->session->flashdata('error') != '') { ?>
<div class="alert alert-danger alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<?php echo $this->session->flashdata('error'); ?>
</div>
<?php } ?>