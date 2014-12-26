<div class="panel panel-default">
	<div class="panel-heading"><h3>Installment Report</h3></div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped b-t text-small dataTable">
			<thead>
			  <tr>
			  	<th>Installment Id</th>
			  	<th>Loan Id</th>
			  	<th>Borrorwer Name</th>
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
				?>
				<tr>
				  	<td><?php echo "I00".$insta['insta_id'];?></td>
				  	<td><a href="<?php echo base_url().'loan/view/'.$insta['loan_id'];?>"><?php echo "L00".$insta['loan_id'];?></a></td>
				  	<td><a href="<?php echo base_url().'borrower/index/'.$insta['borrower_id'];?>"><?php echo $insta['firstname']." ".$insta['lastname'];?></a></td>
				  	<td><?php echo $insta['pay_amount'];?></td>
				  	<td><?php echo $insta['paid_amount'];?></td>
				  	<td><?php $date = date_create($insta['paid_date']); echo date_format($date,"d-m-Y");?></td>
				</tr>
				<?php } endif; ?>
			</tbody>
			</table>
		</div>
	</div>
</div>
<script src="<?php echo base_url()."public/js/datatables/jquery.dataTables.min.js"; ?>"></script>
<script>
	$('.dataTable').dataTable();
</script>