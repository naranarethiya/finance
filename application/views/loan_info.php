<div class="panel panel-default">
  <div class="panel-heading"><h3>Loan Information</h3></div>
  <div class="panel-body">
	<div class="box">
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
					<tr>
					  	<th>Loan Id</th>
					  	<th>Loan Amount</th>
					  	<th>Rate</th>
					  	<th>Installment Duration(days)</th>
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
					  	<td><?php echo "L00".$row['loan_id']; ?></td>
					  	<td><?php echo $row['amount']; ?></td>
					  	<td><?php echo $row['rate']; ?></td>
					  	<td><?php echo $row['installment_duration']; ?></td>
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
					  	<th>Loan Id</th>
					  	<th>Borrower Id</th>
					  	<th>Loan Amount</th>
					  	<th>Rate</th>
					  	<th>Start Date</th>
					  	<th>Installment Duration(days)</th>
					  	<th>Note</th>
					  	<th>Status</th>		  			
					</tr>
				</thead>
				<tbody>
					<?php
						if(empty($borrowerloan)):
							echo "<tr><td colspan='8' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($borrowerloan as $bloan)
						{
					?>					
					<tr>
					  	<td><?php echo "L00".$bloan['loan_id'];?></td>
					  	<td><?php echo "B00".$bloan['borrower_id'];?></td>
					  	<td><?php echo $bloan['amount']; ?></td>
					  	<td><?php echo $bloan['rate']; ?></td>
					  	<td><?php echo $bloan['start_date']; ?></td>
					  	<td><?php echo $bloan['installment_duration']; ?></td>
					  	<td><?php echo $bloan['note']; ?></td>
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
				  	<th>Loan Id</th>
				  	<th>Borrorwer Id</th>
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
					?>					
					<tr>
						<td><?php echo "I00".$insta['insta_id'];?></td>
						<td><?php echo "L00".$insta['loan_id'];?></td>
						<td><?php echo "B00".$insta['borrower_id'];?></td>
						<td><?php echo $insta['pay_amount'];?></td>
						<td><?php echo $insta['paid_amount'];?></td>
						<td><?php echo $insta['paid_date'];?></td>
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
				  	<th>Loan Id</th>
				  	<th>Borrorwer Id</th>
				  	<th>Amount</th>
				  	<th>Final Amount</th>
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
					  	<td><?php echo "L00".$loanxn['loan_id'];?></td>
					  	<td><?php echo "B00".$loanxn['borrower_id'];?></td>
					  	<td><?php echo $loanxn['amount'];?></td>
					  	<td><?php echo $loanxn['final_amount'];?></td>
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