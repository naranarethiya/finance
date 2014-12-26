<?php
	class dashboard_model extends CI_Model{   
	public function __construct()
	{
		$this->load->database();
	}	

	function get_loan_borrow(){
		$this->db->select('*');
		$this->db->from('loan');
		$this->db->where('status',"1");
		$this->db->where('deleted_at',NULL,false);
		$query = $this->db->get();
	    return $query->result_array();       
	}

	
	function get_installment_byloan(){
		$this->db->select('*');
		$this->db->from('installment');
		$this->db->order_by('installment.insta_id','desc');
		$this->db->limit(10);
	  	$query = $this->db->get();
	 	return $query->result_array();       
	}

	function get_installment(){
		$this->db->select('installment.*, borrower.firstname, borrower.lastname');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');
 		$this->db->order_by('installment.insta_id','ASC');
		$query=$this->db->get();
		/*$this->db->select('*');
		$this->db->from('installment');
	  	$query = $this->db->get();*/
	 	return $query->result_array();       
	}
}
?>