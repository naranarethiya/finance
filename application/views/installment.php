<div class="panel panel-default">
  <div class="panel-heading"><h3>Pay Installment</h3></div>
  <div class="panel-body">
  	<!-- .form-->
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-body">
					<div class="row">
					</div>
					<?php
						echo form_open('borrower/save_installment', array('name' => 'addinstaform')); 
						//dsm($borrower[0]['firstname']); die;
					?>
					<input type="hidden" class="form-control" id="borrower_id" name="borrower_id" value="<?php echo $borrower[0]['borrower_id']; ?>"/>
					<div class="form-group">
						<div class="col-md-6">
							<label>Borrower First Name</label>
							<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $borrower[0]['firstname']; ?>"/>
						</div>
						<div class="col-md-6">
							<label>Borrower Last Name</label>
							<input type="text" class="form-control" value="<?php echo $borrower[0]['lastname']; ?>" id="lastname" name="lastname" placeholder="Enter Borrower Last Name" required/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<label>Loan Id</label>
							<?php 
								$select_array_loan=$sel_loan;
								$count=count($select_array_loan);
								if($count=="1") {
									$date = date_create($select_array_loan[0]['start_date']); 
									$key=$select_array_loan[0]['amount']." for ".$select_array_loan[0]['rate']."% on ". date_format($date,"M-Y");
									$select_array_loan[0]['key'] = $key;
									echo generate_combobox('loanid',$select_array_loan,'loan_id','key',$select_array_loan[0]['loan_id'],'class="form-control" id="loan_id"');
								}
								else {
									for($i=0;$i<$count;$i++) {
									$date = date_create($select_array_loan[$i]['start_date']); 
									$key=$select_array_loan[$i]['amount']." for ".$select_array_loan[$i]['rate']."% on ". date_format($date,"M-Y");
									$select_array_loan[$i]['key'] = $key;
									echo generate_combobox('loanid',$select_array_loan,'loan_id',$key,'','class="form-control" id="loan_id"');																		
									}
								}
							?>
						</div>
						<div class="col-md-6">
							<label>Paid Date</label>
							<input type="text" class="form-control" id="dp1" name="paid_date" data-date-format="yyyy-mm-dd"/>
						</div>						
					</div>	
					<div class="form-group">
						<div class="col-md-6"><br>
							<label>Payoff</label>&nbsp;&nbsp;&nbsp;
                            <label class="radio-inline">
                                <input type="radio" name="payoff" id="payoffno" value="0" checked>
                                No                   
                            </label>
                         
                            <label class="radio-inline">
                                <input type="radio" name="payoff" id="payoffyes" value="1">
                                Yes                   
                            </label>
						</div>
						<div class="col-md-6">
							<label>Pay Amount</label>
							<input type="text" class="form-control" id="pay_amount" name="pay_amount" readonly/>
						</div>
					</div>										
					<div class="form-group">
						<div class="col-md-12">
							<label>Paid Amount</label>
							<input type="text" class="form-control" id="paid_amount" name="paid_amount" style="width:445px;"/>
						</div>						
					</div>
					<div class="box-footer">
						<input type="submit" name="submit"  class="btn btn-primary" value="Submit" style="margin-top: 10px; margin-left:5px;">
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
	});

$(document).ready(function () {
    var id =  $("#loan_id").val();
    if(id!="") {
        var date = $('#dp1').val();
		  if($('#payoffno').is(':checked')) {
		    var payoff = $('#payoffno').val();
		  } else {
		    var payoff = $('#payoffyes').val();
		  }        
        var data = { 'id': id , 'date': date, 'payoff': payoff };
        $.ajax({
            type: "post",
            url: base_url+"borrower/get_amount",
            data: data ,
            dataType: 'json', 
                success: function (loan_id) {
                $('#pay_amount').val(loan_id);
            }
        });
    }
    else {
    	alert("Please select Loan Id");
    }
});
	

$(document).ready(function () {
     $('input[name="payoff"]').click(function() {    	
        var id =  $("#loan_id").val();
        if(id!="") {
	        var date = $('#dp1').val();
			  if($('#payoffno').is(':checked')) {
			    var payoff = $('#payoffno').val();
			  } else {
			    var payoff = $('#payoffyes').val();
			  }        
	        var data = { 'id': id , 'date': date, 'payoff': payoff };
	        $.ajax({
	            type: "post",
	            url: base_url+"borrower/get_amount",
	            data: data ,
	            dataType: 'json', 
	                success: function (loan_id) {
	                $('#pay_amount').val(loan_id);
	            }
	        });
	    }
	    else {
	    	alert("Please select Loan Id");
	    }
    });
});	
</script>
<script type="text/javascript">
$('input[name="submit"]').click(function() { 
	var pay_amount=$('#pay_amount').val();
	var paid_amount=$('#paid_amount').val();
	if(pay_amount>paid_amount) {

		alert("Please checked Pay amount for payoff");

		$("#payoffno").prop("checked", true)
	       var id =  $("#loan_id").val();
	        if(id!="") {
	        var date = $('#dp1').val();
			  if($('#payoffno').is(':checked')) {
			    var payoff = $('#payoffno').val();
			  } else {
			    var payoff = $('#payoffyes').val();
			  }        
	        var data = { 'id': id , 'date': date, 'payoff': payoff };
	        $.ajax({
	            type: "post",
	            url: base_url+"borrower/get_amount",
	            data: data ,
	            dataType: 'json', 
	                success: function (loan_id) {
	                $('#pay_amount').val(loan_id);
	            }
	        });
		    }
		    else {
		    	alert("Please select Loan Id");
		    }	
		 $('#paid_amount').val("");	
		return false;
	}
});
</script>