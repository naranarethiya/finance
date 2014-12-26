<div class="panel panel-default">
  <div class="panel-heading"><h3>Add New Loan</h3></div>
  <div class="panel-body">
  	<!-- .form-->
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-body">
					<div class="row">
						<?php echo validation_errors(); ?>
					</div>
					<?php
						echo form_open('loan/save', array('name' => 'addform'));  
						/*$rurl=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
						$id=explode('/', $rurl);
*/					?>
					<input type="hidden" id="borrower_id" name="borrower_id" value="<?php echo $borrower_id?>"/>  
					<div class="form-group">
						<div class="col-md-6">
						<label>Loan Amount</label>
						<input type="text" value="" class="form-control" id="amount" name="amount" placeholder="Enter Loan Amount" required/>
						</div>
						<div class="col-md-6">
						<label>Loan Rate</label>
						<input type="text" class="form-control" value="" id="rate" name="rate" placeholder="Enter Loan Rate" required/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Loan Start Date</label>
						<!--<input type="text" class="form-control" value="" id="dob" name="dob"  placeholder="Enter Date of Birth" required/>-->
						<input type="text" class="form-control" value="" name="start_date" id="dp1" data-date-format="yyyy-mm-dd" placeholder="Click to select date">	
						</div>
						<div class="col-md-6">
						<label>Intsallment Duration (In Days)</label>
						<input type="text" class="form-control" value="" id="installment_duration" name="installment_duration" placeholder="Enter Installment Duration (In Days)" required/>
						</div>
					</div>		
					<div class="form-group" style="margin-left:15px;">
						<label>Description / Note</label>
						<textarea class="form-control" id="note" name="note" placeholder="Enter Description / Note" required  style="width:445px;"></textarea>
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