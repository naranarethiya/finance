<div class="panel panel-default">
  <div class="panel-heading"><h3>Loan Information</h3></div>
  <div class="panel-heading">
	<a href="#" id="loaninsta" class="fa fa-fw fa-money" data-toggle="tooltip" data-placement="bottom" title="Pay Loan Installment"></a>
  </div>    
  <div class="panel-body">
	<div class="box">
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
					<tr>
						<th>Select</th>
					  	<th>Loan</th>
					  	<th>Loan Amount</th>
					  	<th>Rate</th>
					  	<th>Installment Duration(days)</th>
					  	<th>Payoff date</th>
					  	<th>Status</th>		  			
					</tr>
				</thead>
				<tbody>
					<?php
						if(empty($loan)):
							echo "<tr><td colspan='5' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($loan as $row)
						{
					?>					
					<tr>
						<td>
							<label>
								<input type="checkbox"  id="checkID[]" name="checkID[]" value="<?php echo $row['borrower_id']; ?>" class="selectAll">
							</label>				
						</td>
					  	<td><a href="<?php echo base_url().'loan/view/'.$row['loan_id'];?>"><?php echo $row['loanname']; ?></a></td>
					  	<td><?php echo $row['amount']; ?></td>
					  	<td><?php echo $row['rate']; ?></td>
					  	<td><?php echo $row['installment_duration']; ?></td>
					  	<td><?php echo $row['payoff_date']; ?></td>
						<td>
							<?php 
								if($row['status']=="1") {
									echo '<span class="label label-success">Active</span>';
								}
								else {
									echo '<span class="label label-danger">Deactive</span>';
								}
							?>
						</td>
					</tr>	
					<?php } endif; ?>								
				</tbody>
			</table>
		</div>
	</div>
	<!-- .loan list-->
	<div class="box">
	    <div class="box-header">
	        <h3 class="box-title">Borrower List</h3>
	    </div><!-- /.box-header -->
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
					<tr>
					  	<th>Loan</th>
					  	<th>Borrower</th>
					  	<th>Loan Amount</th>
					  	<th>Rate</th>
					  	<th>Start Date</th>
					  	<th>Installment Duration(days)</th>
					  	<th>Status</th>		  			
					</tr>
				</thead>
				<tbody>
					<?php
						if(empty($borrowerloan)):
							echo "<tr><td colspan='7' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($borrowerloan as $bloan)
						{
					?>					
					<tr>
					  	<td><a href="<?php echo base_url().'loan/view/'.$bloan['loan_id'];?>"><?php echo $bloan['loanname'];?></a></td>
					  	<td><b><a href="<?php echo base_url().'borrower/index/'.$bloan['borrower_id'];?>"><?php echo $bloan['firstname'] ." ". $bloan['lastname'];?></a></b></td>
					  	<td><?php echo $bloan['amount']; ?></td>
					  	<td><?php echo $bloan['rate']; ?></td>
					  	<td><?php $date = date_create($bloan['start_date']); echo date_format($date,"d-m-Y");?></td>
					  	<td><?php echo $bloan['installment_duration']; ?></td>
						<td>
							<?php 
								if($bloan['status']=="1") {
									echo '<span class="label label-success">Active</span>';
								}
								else {
									echo '<span class="label label-danger">Deactive</span>';
								}
							?>
						</td>
					</tr>	
					<?php } endif; ?>								
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.loan list-->	

	<!-- .installment list-->
	<div class="box">
	    <div class="box-header">
	        <h3 class="box-title">Installment List</h3>
	    </div><!-- /.box-header -->
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
				  <tr>
				  	<th>Installment Id</th>
				  	<th>Loan</th>
				  	<th>Borrorwer</th>
				  	<th>Pay Amount</th>
				  	<th>Paid Amount</th>
				  	<th>Paid Date</th>
				  </tr>
				</thead>
				<tbody>
					<?php
						if(empty($installment)):
							echo "<tr><td colspan='6' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($installment as $insta)
						{
							if($insta['pay_amount'] > $insta['paid_amount']) {
								echo "<tr class='danger'>";
							}
							else if($insta['pay_amount'] < $insta['paid_amount']) {
								echo "<tr class='success'>";
							}
							else {
								echo "<tr>";
							}							
					?>					
						<td><?php echo "I00".$insta['insta_id'];?></td>
						<td><a href="<?php echo base_url().'loan/view/'.$insta['loan_id'];?>"><?php echo $insta['loanname'];?></a></td>
						<td><b><a href="<?php echo base_url().'borrower/index/'.$insta['borrower_id'];?>"><?php echo $insta['firstname'] ." ". $insta['lastname'];?></a></b></td>
						<td><?php echo $insta['pay_amount'];?></td>
						<td><?php echo $insta['paid_amount'];?></td>
						<td><?php $date = date_create($insta['paid_date']); echo date_format($date,"d-m-Y");?></td>
					</tr>
				    <?php } endif; ?>	
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.installment list-->
	<!-- .loan transaction list-->
	<div class="box">
	    <div class="box-header">
	        <h3 class="box-title">Loan Transaction List</h3>
	    </div><!-- /.box-header -->
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
				  <tr>
				    <th>Transaction Id</th>
				  	<th>Installment Id</th>
				  	<th>Loan</th>
				  	<th>Borrorwer</th>
				  	<th>Amount</th>
				  	<th>Final Amount</th>
				  	<th>Loan Amount</th>
				  	<th>Reason</th>
				  </tr>
				</thead>
				<tbody>
					<?php
						if(empty($ltxn)):
							echo "<tr><td colspan='7' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($ltxn as $loanxn)
						{
					?>
					<tr>
					  	<td><?php echo "T00".$loanxn['lt_id'];?></td>
					  	<td><?php echo "I00".$loanxn['insta_id'];?></td>
					  	<td><a href="<?php echo base_url().'loan/view/'.$loanxn['loan_id'];?>"><?php echo $loanxn['loanname'];?></a></td>
					  	<td><b><a href="<?php echo base_url().'borrower/index/'.$loanxn['borrower_id'];?>"><?php echo $loanxn['firstname'] ." ". $loanxn['lastname'];?></a></b></td>
					  	<td><?php echo $loanxn['amount'];?></td>
					  	<td><?php echo $loanxn['final_amount'];?></td>
					  	<td><?php echo $loanxn['loan_amount'];?></td>
					  	<td><?php echo $loanxn['reason'];?></td>
					</tr>
					<?php } endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.loan transaction list-->	
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	  $('#loaninsta').click(function () {
		var slvals = []
		$('input:checkbox[name^=checkID]:checked').each(function() {
		slvals.push($(this).val())
		})
		id=slvals;
		if(id.length>1 || id.length<1) {
			alert ('Select 1 record at a time!');
		}
		else {
			window.location=base_url+"borrower/payinstallment/"+id;	
		}
	  });
	});

	$(document).ready(function(){
	$('#checkall').click(function(){
			$('.selectAll').each(function(event) {
				if(this.checked) {
					this.checked = false;
				}
				else {       
					this.checked = true;
				}
			});
		});
	});	
</script>