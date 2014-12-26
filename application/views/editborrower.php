<div class="panel panel-default">
  <div class="panel-heading"><h3>Edit Borrower Information</h3></div>
  <div class="panel-body">
  	<!-- .form-->
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-body">
					<div class="row">
						<?php echo validation_errors(); ?>
					</div>
					<?php
						echo form_open('borrower/update', array('name' => 'editform'));    
						if(isset($edit_borrower)) {
							echo '<input type="hidden" id="borrower_id" name="borrower_id" value="'.$edit_borrower[0]['borrower_id'].'"/>';
						}						
					?>

					<div class="form-group">
						<div class="col-md-6">
						<label>Borrower First Name</label>
						<input type="text" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['firstname']; } ?>" class="form-control" id="firstname" name="firstname"/>
						</div>
						<div class="col-md-6">
						<label>Borrower Last Name</label>
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['lastname']; } ?>" id="lastname" name="lastname"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6" style="margin-top:20px;">
							<label>Gender</label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="gender" value="male" <?php if(isset($edit_borrower)) { if($edit_borrower[0]['gender'] == "male"){ echo "checked"; } } ?>>
                                Male                   
                            </label>
                         
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="gender" value="female" <?php if(isset($edit_borrower)) { if($edit_borrower[0]['gender'] == "female"){ echo "checked"; } } ?>>
                                Female                   
                            </label>
						</div>
						<div class="col-md-6">
						<label>Date of Birth</label>
						<!--<input type="text" class="form-control" value="" id="dob" name="dob"  placeholder="Enter Date of Birth" required/>-->
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['dob']; } ?>" name="dob" id="dp1" data-date-format="yyyy-mm-dd">	
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Mobile</label>
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['mobile']; } ?>" id="mobile" name="mobile"/>
						</div>
						<div class="col-md-6">
						<label>Phone</label>
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['phone']; } ?>" id="phone" name="phone"/>
						</div>						
                    </div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Driving Licence No.</label>
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['drivinglic']; } ?>" id="drivinglic" name="drivinglic"/>
						</div>
						<div class="col-md-6">
						<label>Adhar Card No.</label>
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['adharno']; } ?>" id="adharno" name="adharno"/>
						</div>						
                    </div>					
					<div class="form-group">
						<div class="col-md-6">
						<label>Email</label>
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['email']; } ?>" id="email" name="email"/>
						</div>
						<div class="col-md-6">
						<label>City</label>
						<input type="text" class="form-control" value="<?php if(isset($edit_borrower)) { echo $edit_borrower[0]['city']; } ?>" id="city" name="city"/>						
						</div>
					</div>			
					<div class="form-group" style="margin-left:15px;">
						<label>Borrower Address</label>
						<textarea class="form-control" id="address" name="address" style="width:445px;"><?php if(isset($edit_borrower)) { echo $edit_borrower[0]['address']; } ?></textarea>
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