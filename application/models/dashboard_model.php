<?php
	class dashboard_model extends CI_Model{   
	public function __construct()
	{
		$this->load->database();
	}	

	/* get currant active loan by borrower  */
	function get_loan_borrow() {
		$this->db->select('loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('loan');
		$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');
		$this->db->where('loan.status',"1");
		$this->db->where('loan.deleted_at',NULL,false);
		$query = $this->db->get();
	    return $query->result_array();       
	}


	/* get installment by borrower */
	function get_installment_byloan() {
		$this->db->select('installment.*, borrower.*, loan.*');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');
		$this->db->join('loan','installment.loan_id=loan.loan_id');
		$this->db->order_by('installment.insta_id','desc');
		$this->db->limit(10);
	  	$query = $this->db->get();
	 	return $query->result_array();       
	}

	/* get installment with loan and borrower */
	function get_installment() {
		$this->db->select('installment.*,loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');
		$this->db->join('loan','installment.loan_id=loan.loan_id');	
 		$this->db->order_by('installment.insta_id','ASC');
		$query=$this->db->get();
	 	return $query->result_array();       
	}

	/*  get sum of given loan by week  */
	function get_total_loan() {
		$sql="SELECT sum(amount) as total FROM loan group by date_format(`start_date`,'%U')";
		$query=$this->db->query($sql);
		return $query->result_array();  
	}

	/* get sum of paid installment by week */
	function get_total_installment() {
		$sql="SELECT sum(`paid_amount`) as totalinsta FROM installment group by date_format(`paid_date`,'%U')";
		$query=$this->db->query($sql);
		return $query->result_array();		
	}

	/* get installment by loan id */
	function get_date($id) {
		$sql="SELECT * FROM installment WHERE loan_id='".$id."'";
		$query=$this->db->query($sql);
		return $query->result_array();		
	}

	/* check installment id */
	function check_date($id) {
		$sql="SELECT * FROM installment WHERE loan_id='".$id."'";
		$query=$this->db->query($sql);
		return $query->num_rows();		
	}	
	function get_loan_amount_loantxn($id) {
	  $query = $this->db->get_where('loan_transaction',array('loan_id'=>$id));
	  return $query->num_rows() ;		
	}
	function get_loan_finalamount($id) {
	  $query = $this->db->get_where('loan_transaction',array('loan_id'=>$id));
	  return $query->result_array(); 	
	}
}
?>