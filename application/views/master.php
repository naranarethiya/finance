<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('head'); ?>
</head>

<body class="skin-blue fixed">
	<?php $this->load->view('header'); ?>
	<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php $this->load->view('sidebar'); ?>
		<aside class="right-side">
			<div class="row">
				<?php echo validation_errors(); ?>
			</div>
			<?php
				$this->load->view("show_msg");
			?>
			<section class="content">
				<?php echo $contant; ?>
			</section>
		</aside>
	</div>
</body>
</html>