<!DOCTYPE html>
<html class="bg-black">
    
<!-- Mirrored from almsaeedstudio.com/AdminLTE/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 26 Nov 2014 07:12:29 GMT -->
<head>
        <meta charset="UTF-8">
		<title>Sign me in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url().'public/css/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url().'public/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url().'public/css/AdminLTE.css'; ?>" rel="stylesheet" type="text/css" />

    </head>
    <body class="bg-black">
		<div class="form-box" id="login-box">
			<div class="header">Sign In</div>
			<?php
				echo form_open('login/check', array('name' => 'loginform'));    
			?>
				<div class="body bg-gray">
					<div class="row">
						<?php
							$this->load->view("show_msg");
						?>
					</div>				
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="User Name"/>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password"/>
					</div>          
					<!--<div class="form-group">
						<input type="checkbox" name="remember_me"/> Remember me
					</div>-->
				</div>
				<div class="footer">                                                               
					<button type="submit" name="submit" class="btn bg-olive btn-block">Sign me in</button>  
				</div>
			<?php
				echo form_close();
			?>
		</div>


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url().'public/js/jquery.min.js'; ?>"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url().'public/js/bootstrap.min.js'; ?>" type="text/javascript"></script>        

    </body>
</html>	