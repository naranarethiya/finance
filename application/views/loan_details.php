<div class="panel panel-default">
  <div class="panel-heading"><h3>All Loan List</h3></div>
  <div class="panel-heading">
  	<a href="#" class="fa fa-fw fa-refresh" onclick="window.location.reload( true );" data-toggle="tooltip" data-placement="bottom" title="Refresh"></a>
  	<a href="#" class="fa fa-fw fa-filter" onclick="$(searchModal).modal('show');" data-toggle="tooltip" data-placement="bottom" title="Filter Data"></a>
  </div>  
  <div class="panel-body">
	<div class="box">
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
					<tr>
					  	<th>Loan Id</th>
					  	<th>Borrower Name</th>
					  	<th>Loan Amount</th>
					  	<th>Rate</th>
					  	<th>Installment Duration</th>
					  	<th>Status</th>		  			
					</tr>
				</thead>
				<tbody>
					<?php
						if(!isset($loan)):
							echo "<tr><td colspan='5' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($loan as $row)
						{
					?>					
					<tr>
					  	<td><a href="<?php echo base_url().'loan/view/'.$row['loan_id'];?>"><?php echo "L00".$row['loan_id']; ?></a></td>
					  	<td><?php echo $row['firstname'] ." " . $row['lastname']; ?></td>
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
		<!--<nav>
		  <ul class="pagination">
		    <li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
		    <li><a href="#">1</a></li>
		    <li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
		  </ul>
		</nav>-->
	</div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Search</h4>
      </div>
      <div class="modal-body">
		<?php
			echo form_open('loan/search', array('name' => 'searchform'));    
		?>

			<div class="form-group">
				<div class="col-md-6">
				<label>Loan Id</label>
				<input type="text" class="form-control" id="loan_id" name="loan_id" placeholder="Enter Loan Id without L00" />
				</div>
				<div class="col-md-6">
				<label>Loan Amount</label>
				<input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Loan Amount" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
				<label>Loan Rate</label>
				<input type="text" class="form-control" id="rate" name="rate" placeholder="Enter Loan Rate" />
				</div>
				<div class="col-md-6">
				<label>Loan Period</label>
				<input type="text" class="form-control" id="period" name="period" placeholder="Enter Loan Period" />
				</div>						
            </div>
			<div class="form-group">
				<div class="col-md-6">
				<label>loan Start Date</label>
				<input type="text" class="form-control" name="start_date" id="dp1" data-date-format="yyyy-mm-dd" placeholder="Click to select date">	
				</div>				
            	<div class="col-md-6">
            		<label>Status</label>
					<select class="form-control" name="status">
						<option value="1">Active</option>
						<option value="0">Disactive</option>
					</select>        		
            	</div>
			</div>
			<div class="modal-footer"><br/>
				<input type="submit" name="submit"  class="btn btn-primary" value="Search">
			</div>		        		
		<?php
			echo form_close();
		?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('#dp1').datepicker();
</script>