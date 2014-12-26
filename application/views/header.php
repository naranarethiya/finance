	<header class="header">
		<a href="<?php echo base_url(); ?>" class="logo">Finance Manager</a>
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			    <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->session->userdata("name"); ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="treeview">
                                    <a href="#" onclick="$(myModal).modal('show');">
                                        <i class="fa fa-user"></i>
                                        <span>Change Password</span>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="<?php echo base_url().'login/logout'; ?>">
                                        <i class="fa fa-sign-out"></i>
                                        <span>SignOut</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
		</nav>
	</header>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        <?php
            $this->load->helper('form');
            echo form_open('login/change_password', array('name' => 'passwordform'));    
        ?>
        <div class="form-group">
            <div class="col-md-8">
                <label>Old Password</label>
                <input type="password" class="form-control" id="opasssword" name="opasssword" placeholder="Enter Old Passsword "/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label>New Password</label>
                <input type="password" class="form-control" id="npasssword" name="npasssword" placeholder="Enter New Passsword "/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8">
                <label>New Confirm Password</label>
                <input type="password" class="form-control" id="ncpasssword" name="ncpasssword" placeholder="Enter New Confirm Passsword "/>
            </div>
        </div>
    
        <div class="modal-footer">
            <div class="col-md-8"><br/>
                <input type="submit" name="submit"  class="btn btn-primary" value="Submit">
            </div>
        </div>                      
        <?php
            echo form_close();
        ?>
      </div>
    </div>
  </div>
 </div>      