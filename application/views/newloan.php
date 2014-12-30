<div class="panel panel-default">
  <div class="panel-heading"><h3>Add New Loan</h3></div>
  <div class="panel-body">
 	<div class="box">
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
					<tr>
					  	<th>Borrower</th>
					  	<th>Date of birth</th>
					  	<th>Mobile</th>
					  	<th>Email</th>
					  	<th>Address</th>
					  	<th>City</th>
					  	<th>Gender</th>						  			
					</tr>
				</thead>
				<tbody>
					<?php
						if(!isset($borrower)):
							echo "<tr><td colspan='11' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($borrower as $row)
						{
					?>					
					<tr>
					  	<td><a href="<?php echo base_url().'borrower/index/'.$row['borrower_id'];?>"><?php echo $row['firstname'] ." " . $row['lastname']; ?></a></td>
					  	<td><?php $date = date_create($row['dob']); echo date_format($date,"d-m-Y"); ?></td>
					  	<td><?php echo $row['mobile']; ?></td>
					  	<td><?php echo $row['email']; ?></td>
					  	<td><?php echo $row['address']; ?></td>
					  	<td><?php echo $row['city']; ?></td>
					  	<td><?php echo $row['gender']; ?></td>				  	
					</tr>		
					<?php } endif; ?>
				</tbody>
			</table>
		</div>
	</div> 	
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
						<input type="text"class="form-control" id="amount" name="amount" placeholder="Enter Loan Amount" required/>
						</div>
						<div class="col-md-6">
						<label>Loan Rate (%)</label>
						<input type="text" class="form-control" id="rate" name="rate" placeholder="Enter Loan Rate" required/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Loan Duration(In month)</label>
						<input type="text" class="form-control"  id="duration_in_month" name="duration_in_month" value="1" required/>
						</div>
						<div class="col-md-6">
						<label>Intsallment Duration (In Days)</label>
						<input type="text" class="form-control"  id="installment_duration" name="installment_duration" value="30" required/>
						</div>
					</div>		
					<div class="form-group">
						<div class="col-md-6">
						<label>Loan Start Date</label>
						<input type="text" class="form-control" name="start_date" id="dp1" data-date-format="yyyy-mm-dd" placeholder="Click to select date">	
						</div>
						<div class="col-md-6">
						<label>Payoff Date</label>
						<input type="text" class="form-control" name="payoff_date" id="dp2" data-date-format="yyyy-mm-dd" readonly>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
						<label>Description / Note</label>
						<textarea class="form-control" id="note" name="note" placeholder="Enter Description / Note"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" name="submit"  class="btn btn-primary" value="Submit"  style="margin-top:50px;">
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
	$('#dp1').datepicker({
	        "setDate": new Date(),
	        "autoclose": true
	});

	jQuery( document ).ready(function($) {

		var d = new Date();
		var currDate = d.getDate();
		var currMonth = d.getMonth()+1;
		var currYear = d.getFullYear();

		var dateStr = currYear + "-" + currMonth + "-" + currDate;

		$('#dp1').val(dateStr);

		var dur_month=$('#duration_in_month').val();
		var nd = new Date();
		var nextDate = nd.getDate();
		var nextMonth = parseInt(nd.getMonth()+1)+parseInt(dur_month);
		var nextYear = nd.getFullYear();
		if (nextMonth > 12)
		   { 
		     nextMonth = 1;
		     nextYear = nextYear + 1;
		   }		
		if (getNumFebDays(nextYear) == 28 && nextMonth == 2 ) { 
			nextDate = 28; 
		} 
		if (getNumFebDays(nextYear) == 29 && nextMonth == 2) { 
			nextDate = 29; 
		} 

		function getNumFebDays(theYear) { 
			if ((theYear / 4 == 0 && theYear % 100 != 0) || theYear % 400 == 0) 
				return 29; 
			else 
				return 28;
		} 		   
		var payoff_dateStr = nextYear + "-" + nextMonth + "-" + nextDate;
		$('#dp2').val(payoff_dateStr);
	});

</script>