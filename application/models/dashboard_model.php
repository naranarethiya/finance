<?php
	class dashboard_model extends CI_Model{   
	public function __construct()
	{
		$this->load->database();
	}	

	function get_loan_borrow(){
		$this->db->select('loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('loan');
		$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');
		$this->db->where('loan.status',"1");
		$this->db->where('loan.deleted_at',NULL,false);
		$query = $this->db->get();
	    return $query->result_array();       
	}

	function get_installment_byloan(){
		$this->db->select('installment.*, borrower.firstname, borrower.lastname');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');
		$this->db->order_by('installment.insta_id','desc');
		$this->db->limit(10);
	  	$query = $this->db->get();
	 	return $query->result_array();       
	}

	function get_installment(){
		$this->db->select('installment.*,loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');
		$this->db->join('loan','installment.loan_id=loan.loan_id');	
 		$this->db->order_by('installment.insta_id','ASC');
		$query=$this->db->get();
	 	return $query->result_array();       
	}

	function get_total_loan() {
		$sql="SELECT sum(amount) as total FROM loan group by date_format(`start_date`,'%U')";
		$query=$this->db->query($sql);
		return $query->result_array();  
	}

	function get_total_installment() {
		$sql="SELECT sum(`paid_amount`) as totalinsta FROM installment group by date_format(`paid_date`,'%U')";
		$query=$this->db->query($sql);
		return $query->result_array();		
	}
}
?>