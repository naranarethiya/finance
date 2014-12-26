<div class="panel panel-default">
  <div class="panel-heading"><h3>Add New Borrower</h3></div>
  <div class="panel-body">
  	<!-- .form-->
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-body">
					<div class="row">
						<?php echo validation_errors(); ?>
					</div>
					<?php
						echo form_open('borrower/save', array('name' => 'addform'));    
						if(isset($edit_news)) {
																
							echo '<input type="hidden" name="borrower_id" value="'.$id.'"/>';
						}						
					?>

					<div class="form-group">
						<div class="col-md-6">
						<label>Borrower First Name</label>
						<input type="text" value="" class="form-control" id="firstname" name="firstname" placeholder="Enter Borrower First Name" required/>
						</div>
						<div class="col-md-6">
						<label>Borrower Last Name</label>
						<input type="text" class="form-control" value="" id="lastname" name="lastname" placeholder="Enter Borrower Last Name" required/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6" style="margin-top:20px;">
							<label>Gender</label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="gender" value="male">
                                Male                   
                            </label>
                         
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="gender" value="female">
                                Female                   
                            </label>
						</div>
						<div class="col-md-6">
						<label>Date of Birth</label>
						<!--<input type="text" class="form-control" value="" id="dob" name="dob"  placeholder="Enter Date of Birth" required/>-->
						<input type="text" class="form-control" value="" name="dob" id="dp1" data-date-format="yyyy-mm-dd" placeholder="Click to select date">	
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Mobile</label>
						<input type="text" class="form-control" value="" id="mobile" name="mobile" placeholder="Enter Mobile" required onblur="return chkmobile();"/>
						</div>
						<div class="col-md-6">
						<label>Phone</label>
						<input type="text" class="form-control" value="" id="phone" name="phone" placeholder="Enter Phone" required/>
						</div>						
                    </div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Driving Licence No.</label>
						<input type="text" class="form-control" value="" id="drivinglic" name="drivinglic" placeholder="Enter Driving Licence No." required />
						</div>
						<div class="col-md-6">
						<label>Adhar Card No.</label>
						<input type="text" class="form-control" value="" id="adharno" name="adharno" placeholder="Enter Adhar Card No." required/>
						</div>						
                    </div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Email</label>
						<input type="text" class="form-control" value="" id="email" name="email" placeholder="Enter Email" required/>
						</div>
						<div class="col-md-6">
						<label>City</label>
						<input type="text" class="form-control" value="" id="city" name="city" placeholder="Enter City" required />
						</div>
					</div>			
					<div class="form-group" style="margin-left:15px;">
						<label>Borrower Address</label>
						<textarea class="form-control" id="address" name="address" placeholder="Enter Borrower Address" style="width:445px;" required></textarea>

					</div>
					<div class="box-footer">
						<input type="submit" name="submit"  class="btn btn-primary" value="Submit">
					</div>		
					<?php
					echo form_close();
					?>

				</div><!-- /.box-body -->
			</div>
		</div>
	<!-- /.form-->
  </div>
</div>
<script type="text/javascript">
	$('#dp1').datepicker();
</script>