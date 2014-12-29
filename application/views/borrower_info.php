<div class="panel panel-default">
  <div class="panel-heading"><h3>Borrower List</h3></div>
  <div class="panel-heading">
  	<a href="#" class="fa fa-fw fa-refresh" onclick="window.location.reload( true );" data-toggle="tooltip" data-placement="bottom" title="Refresh"></a>
  	<a href="#" class="fa fa-fw fa-filter" onclick="$(searchModal).modal('show');" data-toggle="tooltip" data-placement="bottom" title="Filter Data"></a>
  	<a href="#" class="fa fa-fw fa-check" id="checkall" data-toggle="tooltip" data-placement="bottom" title="Select All"></a>  	
  	<a href="<?php echo base_url().'borrower/add'; ?>" class="fa fa-fw fa-plus" data-toggle="tooltip" data-placement="bottom" title="Add New Borrower"></a>
  	<a href="#" id="editborrower" class="fa fa-fw fa-edit" data-toggle="tooltip" data-placement="bottom" title="Edit Borrower"></a>
  	<a href="#"  id="deleteall" class="fa fa-fw fa-trash-o" data-toggle="tooltip" data-placement="bottom" title="Delete Borrower"></a>
	<a href="#" id="addloan" class="fa fa-fw fa-folder-open-o" data-toggle="tooltip" data-placement="bottom" title="Start Loan"></a>
	<a href="#" id="loaninsta" class="fa fa-fw fa-money" data-toggle="tooltip" data-placement="bottom" title="Pay Loan Installment"></a>
  </div>
  <div class="panel-body">
	<div class="box">
	    <div class="box-body table-responsive">
			<table id='tab1' class='table table-bordered table-striped'>
				<thead>
					<tr>
						<th>Select</th>
					  	<th>Borrower Name</th>
					  	<th>Mobile</th>
					  	<th>Email</th>
					  	<th>Date of birth</th>
					  	<th>City</th>
					  	<th>Address</th>
					  	<th>Status</th>		  			
					</tr>
				</thead>
				<tbody>
					<?php
						if(!isset($borrower)):
							echo "<tr><td colspan='8' align='center'>No Record Found!</td></tr>";
						else :
						foreach ($borrower as $row)
						{
					?>					
					<tr id="brtr<?php echo $row['borrower_id']; ?>">
						<td>
							<label>
								<input type="checkbox"  id="checkID[]" name="checkID[]" value="<?php echo $row['borrower_id']; ?>" class="selectAll">
							</label>				
						</td>
					  	<td><b><a href="<?php echo base_url().'borrower/index/'.$row['borrower_id'];?>"><?php echo $row['firstname']." ".$row['lastname']; ?></a></b></td>
					  	<td><?php echo $row['mobile']; ?></td>
					  	<td><?php echo $row['email']; ?></td>
					  	<td><?php $date = date_create($row['dob']); echo date_format($date,"d-m-Y");?></td>
					  	<td><?php echo $row['city']; ?></td>
					  	<td><?php echo $row['address']; ?></td>
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
			echo form_open('borrower/search', array('name' => 'searchform'));    
		?>

			<div class="form-group">
				<div class="col-md-6">
				<label>Borrower First Name</label>
				<input type="text" value="" class="form-control" id="firstname" name="firstname" placeholder="Enter Borrower First Name" />
				</div>
				<div class="col-md-6">
				<label>Borrower Last Name</label>
				<input type="text" class="form-control" value="" id="lastname" name="lastname" placeholder="Enter Borrower Last Name" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
				<label>Mobile</label>
				<input type="text" class="form-control" value="" id="mobile" name="mobile" placeholder="Enter Mobile" />
				</div>
				<div class="col-md-6">
				<label>City</label>
				<input type="text" class="form-control" value="" id="city" name="city" placeholder="Enter City" />
				</div>						
            </div>
			<div class="form-group">
				<div class="col-md-6">
				<label style="margin-top:20px;">Gender</label>
                <label class="radio-inline">
                    <input type="radio" name="gender" id="gender" value="male">
                    Male                   
                </label>
             
                <label class="radio-inline">
                    <input type="radio" name="gender" id="gender" value="female">
                    Female                   
                </label>

				<label class="radio-inline">
                    <input type="radio" name="gender" id="gender" checked value=""/> All  
                </label>                
            	</div>
            	<div class="col-md-6">
            		<label>Status</label>
					<select class="form-control" name="status">
						<option value="">All</option>
						<option value="1">Active</option>
						<option value="0">Disactive</option>
					</select>        		
            	</div>
			</div>
			<div class="box-footer">
				<input type="submit" name="submit"  class="btn btn-primary" value="Search">
			</div>		        		
		<?php
			echo form_close();
		?>
      </div>
    </div>
  </div>
</div>

<script>
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

$(document).ready(function(){
  $('#deleteall').click(function () {
	var slvals = []
	$('input:checkbox[name^=checkID]:checked').each(function() {
	slvals.push($(this).val())
	})
	id=slvals;
	if(id.length>1 || id.length<1) {
		alert ('Select 1 record at a time!');
	}
	else {
	 var x=confirm("Are you sure to delete record?")
	  if (x) {
		$.ajax({
	      url     : base_url+"borrower/delete/",
	      type    : 'POST',
	      data    : {'id':id},
	      success : function(data){
	      	data=$.parseJSON(data);
	      	if(data.status == '1') {
	      		alert(data.message);
	      		$('#brtr'+id).remove();
	      	}
	      	else {
	      		alert(data.message);
	      	}
	      }
	    });
	  } else {
	    alert ("Delete Cancelled");
	    window.location=base_url+"borrower";
	  }	
	}
  });
});


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
  $('#editborrower').click(function () {
	var slvals = []
	$('input:checkbox[name^=checkID]:checked').each(function() {
	slvals.push($(this).val())
	})
	id=slvals;
	if(id.length>1 || id.length<1) {
		alert ('Select 1 record at a time!');
	}
	else {
		window.location=base_url+"borrower/edit/"+id;	
	}
  });
});

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

</script>