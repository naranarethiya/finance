<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {

	  var data = google.visualization.arrayToDataTable([
	    ['Week', 'Amount'],
	   	<?php
	   		$i=1;
	   		foreach($totalloan as $row) {
   				echo "['".$i."',".$row['total']."],";
	   			$i++;
	   		}
	   	?>
	  ]);

	  var options = {
	    title: 'Total Loan',
	    hAxis: {title: 'Week', titleTextStyle: {color: 'red'}}
	  };

	  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

	  chart.draw(data, options);

	}
</script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {

	  var data = google.visualization.arrayToDataTable([
	    ['Week', 'Installment'],
	   	<?php
	   		$i=1;
	   		foreach($totalinsta as $row) {
   				echo "['".$i."',".$row['totalinsta']."],";
	   			$i++;
	   		}
	   	?>
	  ]);

	  var options = {
	    title: 'Total Installment',
	    hAxis: {title: 'Week', titleTextStyle: {color: 'red'}}
	  };

	  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));

	  chart.draw(data, options);

	}
</script>
<div class="box">
	<table width="100%"> 
		<tr>
			<td width="50%" style="border-right:1px solid;">
				<div id="chart_div" style="width:400px; height: 200px;"></div>
			</td>
			<td width="50%">
				<div id="chart_div1" style="width: 400px; height: 200px;"></div>	
			</td>
		</tr>
	</table>
		
		
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Last 10 Transactions</h3>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">  	
		<table id='tab1' class='table table-bordered table-striped'>
			<thead>
			  <tr>
			  	<th>Installment Id</th>
			  	<th>Loan Id</th>
			  	<th>Borrorwer</th>
			  	<th>Pay Amount</th>
			  	<th>Paid Amount</th>
			  	<th>Paid Date</th>
			  </tr>
			</thead>
			<tbody>
				<?php
					if(empty($installment)):
						echo "<tr><td colspan='7' align='center'>No Record Found!</td></tr>";
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
				<tr>
				  	<td><?php echo "I00".$insta['insta_id'];?></td>
				  	<td><a href="<?php echo base_url().'loan/view/'.$insta['loan_id'];?>"><?php echo "L00".$insta['loan_id'];?></a></td>
				  	<td><a href="<?php echo base_url().'borrower/index/'.$insta['borrower_id'];?>"><?php echo $insta['firstname'] ." ". $insta['lastname'];?></a></td>
				  	<td><?php echo $insta['pay_amount'];?></td>
				  	<td><?php echo $insta['paid_amount'];?></td>
				  	<td><?php $date = date_create($insta['paid_date']); echo date_format($date,"d-m-Y");?></td>
				</tr>
				<?php } endif; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Current Active Loan(s)</h3>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
		<table id='tab1' class='table table-bordered table-striped'>
			<thead>
				<tr>
				  	<th>Loan Id</th>
				  	<th>Borrower</th>
				  	<th>Loan Amount</th>
				  	<th>Rate</th>
				  	<th>Start Date</th>
				  	<th>Installment Duration(days)</th>
				  	<th>Payoff date</th>
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
				  	<td><a href="<?php echo base_url().'loan/view/'.$bloan['loan_id'];?>"><?php echo "L00".$bloan['loan_id'];?></a></td>
				  	<td><a href="<?php echo base_url().'borrower/index/'.$bloan['borrower_id'];?>"><?php echo $bloan['firstname'] ." ". $bloan['lastname'];?></a></td>
				  	<td><?php echo $bloan['amount']; ?></td>
				  	<td><?php echo $bloan['rate']; ?></td>
				  	<td><?php $date = date_create($bloan['start_date']); echo date_format($date,"d-m-Y");?></td>
				  	<td><?php echo $bloan['installment_duration']; ?></td>
				  	<td><?php $date = date_create($bloan['payoff_date']); echo date_format($date,"d-m-Y");?></td>
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
<div class="row">
    <div class="col-md-6">
		<div class="box">
		    <div class="box-header">
		        <h3 class="box-title">Next Installment(s) (This Week)</h3>
		    </div><!-- /.box-header -->
		    <div class="box-body table-responsive">
				<table id='tab1' class='table table-bordered table-striped'>
					<thead>
						<tr>
						  	<th>Loan</th>
						  	<th>Borrower</th>
						  	<th>Pay Amount</th>
						  	<th>Next Installment date</th>	  			
						</tr>
					</thead>
					<tbody>
						<?php
							if(empty($next_installment)):
								echo "<tr><td colspan='4' align='center'>No Record Found!</td></tr>";
							else :
							foreach ($next_installment as $ninsta)
							{
						?>					
						<tr>
						  	<td><a href="<?php echo base_url().'loan/view/'.$ninsta['loan_id'];?>"><?php echo $ninsta['loanname'];?></a></td>
						  	<td><a href="<?php echo base_url().'borrower/index/'.$ninsta['borrower_id'];?>"><?php echo $ninsta['firstname'] ." ". $ninsta['lastname'];?></a></td>
						  	<td><?php echo $ninsta['pay_amount']; ?></td>
						  	<td><?php $date = date_create($ninsta['nextdate']); echo date_format($date,"d-m-Y");?></td>
						</tr>	
						<?php } endif; ?>								
					</tbody>
				</table>
			</div>
		</div>    	
    </div>
</div>