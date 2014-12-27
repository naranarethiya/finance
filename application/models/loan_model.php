<?php
	class loan_model extends CI_Model{   
	public function __construct()
	{
		$this->load->database();
	}	

	function get_borrower($id){
	  //$this->db->where('deleted_at',NULL,false);
	  $this->db->where('borrower_id',$id);
	  $query = $this->db->get('borrower');
	  return $query->result_array();       
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
		$this->db->select('loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('loan');
		$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');	
		$this->db->where('loan.loan_id',$id);	
	    $query = $this->db->get();
	    return $query->result_array();       
	}

	function get_installment_byloan($id){
		$this->db->select('installment.*, borrower.firstname, borrower.lastname,loan.*');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');	
		$this->db->join('loan','installment.loan_id=loan.loan_id');	
		$this->db->where('installment.loan_id',$id);	
	    $query = $this->db->get();		
	    return $query->result_array();       
	}
			
	function get_transaction_byloan($id){
		$this->db->select('loan_transaction.*, borrower.firstname, borrower.lastname,loan.*');
		$this->db->from('loan_transaction');
		$this->db->join('borrower','loan_transaction.borrower_id=borrower.borrower_id');
		$this->db->join('loan','loan_transaction.loan_id=loan.loan_id');		
		$this->db->where('loan_transaction.loan_id',$id);	
	    $query = $this->db->get();		
	  	return $query->result_array();       
	}

	function get_search_loan($firstname,$lastname,$amount,$rate,$period,$start_date,$status) {
		if($firstname=="" && $lastname=="" && $amount == "" && $rate=="" && $period=="" && $start_date=="" && $status=="") {
				$this->db->select('loan.*, borrower.firstname, borrower.lastname');
				$this->db->from('loan');
				$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');
		 		$this->db->order_by('loan.borrower_id','ASC');
				$rs=$this->db->get();
			return $rs->result_array();		
		}
		else {
			if($status=="0") {
				$where = "SELECT loan.*, borrower.firstname, borrower.lastname FROM loan JOIN `borrower` ON `loan`.`borrower_id`=`borrower`.`borrower_id` WHERE borrower.firstname='".$firstname."' OR borrower.lastname='".$lastname."' OR amount='".$amount."' OR rate='".$rate."' OR start_date='".$start_date."' OR installment_duration='".$period."' OR status='0'";
				$rs=$this->db->query($where);
				return $rs->result_array();
			}
			elseif($status=="1") {
				$where = "SELECT loan.*, borrower.firstname, borrower.lastname FROM loan JOIN `borrower` ON `loan`.`borrower_id`=`borrower`.`borrower_id` WHERE borrower.firstname='".$firstname."' OR borrower.lastname='".$lastname."' OR amount='".$amount."' OR rate='".$rate."' OR start_date='".$start_date."' OR installment_duration='".$period."' OR status='1'";
				$rs=$this->db->query($where);
				return $rs->result_array();				
			}
			elseif($status=="all") {
				$where = "SELECT loan.*, borrower.firstname, borrower.lastname FROM loan JOIN `borrower` ON `loan`.`borrower_id`=`borrower`.`borrower_id` WHERE borrower.firstname='".$firstname."' OR borrower.lastname='".$lastname."' OR amount='".$amount."' OR rate='".$rate."' OR start_date='".$start_date."' OR installment_duration='".$period."' OR status='1' OR status='0'";
				$rs=$this->db->query($where);
				return $rs->result_array();				
			}
		}	
	}
}
?>