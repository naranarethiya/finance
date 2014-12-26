<div class="panel panel-default">
  <div class="panel-heading"><h3>All Loan List</h3></div>
  <div class="panel-heading">
  	<a href="#" class="fa fa-fw fa-refresh" onclick="window.location.reload( true );" data-toggle="tooltip" data-placement="bottom" title="Refresh"></a>
  	<a href="#" class="fa fa-fw fa-filter" onclick="$(searchModal).modal('show');" data-toggle="tooltip" data-placement="bottom" title="Filter Data"></a>
  	<a href="#" class="fa fa-fw fa-check" id="checkall" data-toggle="tooltip" data-placement="bottom" title="Select All"></a>  	
	<a href="#" id="addloan" class="fa fa-fw fa-folder-open-o" data-toggle="tooltip" data-placement="bottom" title="Start Loan"></a>
  </div>  
  <div class="panel-body">
	<div class="box">
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
					<tr>
						<th>Select</th>
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
						<td>
							<label>
								<input type="checkbox"  id="checkID[]" name="checkID[]" value="<?php echo $row['borrower_id']; ?>" class="selectAll">
							</label>				
						</td>
						<td><a href="<?php echo base_url().'loan/view/'.$row['loan_id'];?>"><?php echo "L00".$row['loan_id']; ?></a></td>
					  	<td><b><a href="<?php echo base_url().'borrower/index/'.$row['borrower_id'];?>"><?php echo $row['firstname'] ." " . $row['lastname']; ?></a></b></td>
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
				<label>Borrower first Name</label>
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Borrower FirstName" />
				</div>
				<div class="col-md-6">
				<label>Borrower last Name</label>
				<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Borrower LastName" />
				</div>				
			</div>
			<div class="form-group">
				<div class="col-md-6">
				<label>Loan Amount</label>
				<input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Loan Amount" />
				</div>
				<div class="col-md-6">
				<label>Loan Rate</label>
				<input type="text" class="form-control" id="rate" name="rate" placeholder="Enter Loan Rate" />
				</div>					
            </div>
			<div class="form-group">
				<div class="col-md-6">
				<label>Installment period</label>
				<input type="text" class="form-control" id="period" name="period" placeholder="Enter Loan Period" />
				</div>	
				<div class="col-md-6">
				<label>loan Start Date</label>
				<input type="text" class="form-control" name="start_date" id="dp1" data-date-format="yyyy-mm-dd" placeholder="Click to select date">	
				</div>		
			<div>
			<div class="form-group">	
            	<div class="col-md-6">
            		<label>Status</label>
					<select class="form-control" name="status">
						<option value="all">All</option>
						<option value="1">Active</option>
						<option value="0">Disactive</option>
					</select>        		
            	</div>
			</div>
			<div class="modal-footer">
				<input type="submit" name="submit"  class="btn btn-primary" value="Search" style="margin-top:60px;">
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
	
	$(document).ready(function(){
	  $('#addloan').click(function () {
		var slvals = []
		$('input:checkbox[name^=checkID]:checked').each(function() {
		slvals.push($(this).val())
		})
		id=slvals;
		if(id.length>1 || id.length<1) {
			alert ('Select 1 record at a time!');
		}
		else {
			window.location=base_url+"loan/index/"+id;	
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