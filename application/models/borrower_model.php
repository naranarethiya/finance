<?php
	class borrower_model extends CI_Model{   
	public function __construct()
	{
		$this->load->database();
	}	

	function save_borrower($data){
			$result=$this->db->insert('borrower',$data);
			return $result;
	}  

	function get_borrower($id){
	  //$this->db->where('deleted_at',NULL,false);
	  $this->db->where('borrower_id',$id);
	  $query = $this->db->get('borrower');
	  return $query->result_array();       
	}	

	function get_search_borrower($firstname,$mobile,$city,$gender,$status) {
		if($firstname!='') {
			$this->db->like("borrower.firstname",$firstname);
			$this->db->or_like("borrower.lastname",$firstname);
 		}
 		if($mobile!='') {
			$this->db->where("borrower.mobile",$mobile);
		}
		
		if($city!='') {
			$this->db->where("borrower.city",$city);
		}
		
		if($gender!='') {
			$this->db->where("borrower.gender",$gender);
		}
		
		if($status!='') {
			$this->db->where("loan.status",$status);
		}
		
		$this->db->join("loan","loan.borrower_id=borrower.borrower_id",'left');
		
		$rs=$this->db->get("borrower");
		return $rs->result_array();
	}
	
	function update_borrower($data, $borrower_id){
		$this->db->where('borrower_id', $borrower_id);
		return $this->db->update('borrower', $data); 
	}
	function delete_borrower($data, $del_id){
		foreach ($del_id as $borrower_id) {
			$this->db->where('borrower_id', $borrower_id);
			return $this->db->update('borrower', $data); 
		}		
	}

	/* return loan status by customer */
	function get_borrower_info() {
		/*$this->db->select("borrower.firstname,borrower.lastname,borrower.email,borrower.city,borrower.address,borrower.borrower_id,borrower.dob,borrower.mobile,l1.status");
		$this->db->join("loan l1","borrower.borrower_id=l1.borrower_id","INNER JOIN");
		$this->db->join("loan l2","borrower.borrower_id=l2.borrower_id","LEFT OUTER JOIN");
	  	$this->db->where('borrower.deleted_at',NULL,false);
	  	//$this->db->group_by("borrower.borrower_id");
	  	$this->db->order_by('l1.status','desc');
	  	//$query = $this->db->get('borrower');*/
		$sql="select borrower.firstname,borrower.lastname,borrower.email,borrower.city,borrower.address,borrower.borrower_id,borrower.dob,borrower.mobile,loan.status
			from borrower left join (select status,borrower_id from loan order by status desc) as loan on borrower.borrower_id=loan.borrower_id group by borrower_id";
		$query=$this->db->query($sql);
	  	return $query->result_array();       
	}

	function get_loan_byborrower($id){
		$this->db->select('loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('loan');
		$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');	
		$this->db->where('borrower.borrower_id',$id);	
	    $query = $this->db->get();		
	  	return $query->result_array();       
	}	
	function get_activeloan_byborrower($id){
	  $query = $this->db->get_where('loan',array('borrower_id'=>$id, 'status'=>'1'));
	  return $query->result_array();       
	}	
	function get_loan_amount($id) {
	  $query = $this->db->get_where('loan',array('loan_id'=>$id));
	  return $query->result_array(); 		
	}
	function get_loan_installment($lid, $bid) {
	  $query = $this->db->get_where('installment',array('loan_id'=>$lid, 'borrower_id'=>$bid));
	  return $query->result_array(); 		
	}

	function save_loan_installment($data){
			$result=$this->db->insert('installment',$data);
			return $result;
	} 	

	function save_loan_installment_txn($data){
		$result=$this->db->insert('loan_transaction',$data);
		return $result;
	} 

	function get_loan_amount_loantxn($id) {
	  $query = $this->db->get_where('loan_transaction',array('loan_id'=>$id));
	  return $query->num_rows() ;		
	}
	function get_loan_finalamount($id) {
	  $query = $this->db->get_where('loan_transaction',array('loan_id'=>$id));
	  return $query->result_array(); 	
	}

	function get_installment($id){
		$this->db->select('installment.*, borrower.firstname, borrower.lastname,loan.*');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');	
		$this->db->join('loan','installment.loan_id=loan.loan_id');
		$this->db->where('borrower.borrower_id',$id);	
	  	$query = $this->db->get();
	 	return $query->result_array();       
	}
	function get_transaction_byloan($id){
		$this->db->select('loan_transaction.*, borrower.firstname, borrower.lastname,loan.*');
		$this->db->from('loan_transaction');
		$this->db->join('borrower','loan_transaction.borrower_id=borrower.borrower_id');
		$this->db->join('loan','loan_transaction.loan_id=loan.loan_id');	
		$this->db->where('borrower.borrower_id',$id);		
	  	$query = $this->db->get();
	  	return $query->result_array();       
	}

	function get_loan_date($id) {
	  $query = $this->db->get_where('installment',array('loan_id'=>$id));
	  return $query->num_rows();		
	}

	function get_date($id) {
	  $query = $this->db->get_where('installment',array('loan_id'=>$id));
	  return $query->result_array();		
	}	

	function get_installment_last($id) {
		$this->db->select('installment.*, borrower.*, loan.*');
		$this->db->from('installment');
		$this->db->join('borrower','installment.borrower_id=borrower.borrower_id');	
		$this->db->join('loan','installment.loan_id=loan.loan_id');	
		$this->db->where('borrower.borrower_id',$id);
		$this->db->order_by('installment.insta_id','desc');
		$this->db->limit(10);			
	  	$query = $this->db->get();
	 	return $query->result_array();		
	}

	function get_loan($id) {
		$this->db->select('loan.*, borrower.firstname, borrower.lastname');
		$this->db->from('loan');
		$this->db->join('borrower','loan.borrower_id=borrower.borrower_id');
		$this->db->where('loan.borrower_id',$id);
 		$this->db->order_by('loan.borrower_id','ASC');
		$rs=$this->db->get();
		return $rs->result_array();	 		
	}

	function next_week_installment() {
		$sql="Select loan.loanname,borrower.firstname,borrower.lastname,loan.amount,loan_transation.final_amount
			(( IF(loan_transation.final_amount IS NULL,loan.amount,loan_transation.final_amount)*(loan.rate*12)/36500)*loan.installment_duration) as amount,
			date_add(installment.paid_date,INTERVAL loan.installment_duration DAY) as payment_date
			from loan 
		left join borrower on loan.borrower_id=borrower.borrower_id
		left join installment on loan.loan_id=installment.loan_id 
		left join (select amount,loan_id,final_amount from (select * from loan_transaction order by lt_id desc) as transation group by transation.loan_id) as loan_transation on loan.loan_id=loan_transation.loan_id
		where loan.status='1' 
		and date_add(installment.paid_date,INTERVAL loan.installment_duration DAY) <  date_add(curdate(),INTERVAL 7 day) order by installment.paid_date";
		$rs=$this->db->query($sql);
		return $rs->result_array();
	}
}
?>