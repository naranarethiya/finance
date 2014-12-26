<?php
	class loan_model extends CI_Model{   
	public function __construct()
	{
		$this->load->database();
	}	

	function save_loan($data){
		return $this->db->insert('loan',$data);
	}  

	function get_loan_byid($id){
	  $query = $this->db->get_where('loan',array('loan_id'=>$id));
	  return $query->result_array();       
	}

	function get_loan() {
		$this->db->select('loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('loan');
		$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');
 		$this->db->order_by('loan.borrower_id','ASC');
		$rs=$this->db->get();
		return $rs->result_array();		  
	}

	function get_loan_borrow($id){
	  $query = $this->db->get_where('loan',array('loan_id'=>$id));
	  return $query->result_array();       
	}

	function get_installment_byloan($id){
	  $query = $this->db->get_where('installment',array('loan_id'=>$id));
	  return $query->result_array();       
	}
			
	function get_transaction_byloan($id){
	  $query = $this->db->get_where('loan_transaction',array('loan_id'=>$id));
	  return $query->result_array();       
	}

	function get_search_loan($loan_id,$amount,$rate,$period,$start_date,$status) {
		if($loan_id=="" && $amount == "" && $rate=="" && $period=="" && $start_date=="" && $status=="") {
				$this->db->select('loan.*, borrower.firstname, borrower.lastname');
				$this->db->from('loan');
				$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');
		 		$this->db->order_by('loan.borrower_id','ASC');
				$rs=$this->db->get();
			return $rs->result_array();		
		}
		else {
			if($status=="0") {
				$where = "SELECT loan.*, borrower.firstname, borrower.lastname FROM loan JOIN `borrower` ON `loan`.`borrower_id`=`borrower`.`borrower_id` WHERE loan_id='".$loan_id."' OR amount='".$amount."' OR rate='".$rate."' OR start_date='".$start_date."' OR installment_duration='".$period."' OR status='0'";
				$rs=$this->db->query($where);
				return $rs->result_array();
			}
			else {
				$where = "SELECT loan.*, borrower.firstname, borrower.lastname FROM loan JOIN `borrower` ON `loan`.`borrower_id`=`borrower`.`borrower_id` WHERE loan_id='".$loan_id."' OR amount='".$amount."' OR rate='".$rate."' OR start_date='".$start_date."' OR installment_duration='".$period."' OR status='1'";
				$rs=$this->db->query($where);
				return $rs->result_array();				
			}
		}	
	}
}
?>