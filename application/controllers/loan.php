<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('uid')== '') {
			redirect(base_url());
		}

	}
	public function index($id=false)
	{
		$data['pageTitle']="Loan Information";
		$this->load->helper('form');
		$this->load->model('loan_model');
		if($id) {
			$data['borrower_id']=$id;
			$jsurl=base_url().'public/datepicker/bootstrap-datepicker.js';
			$data['loadJs']=array($jsurl);
			$cssurl=base_url().'public/datepicker/datepicker.css';
			$data['loadCss']=array($cssurl);	
			$data['borrower']=$this->loan_model->get_borrower($id);					
		    $data['contant']=$this->load->view('newloan',$data,true);
		    $this->load->view('master',$data);
		}
		else
		{
			$jsurl=base_url().'public/datepicker/bootstrap-datepicker.js';
			$data['loadJs']=array($jsurl);
			$cssurl=base_url().'public/datepicker/datepicker.css';
			$data['loadCss']=array($cssurl);			

			$data['loan']=$this->loan_model->get_loan();	
			$data['contant']=$this->load->view('loan_details',$data,true);
			$this->load->view('master',$data);	
			/*$data['contant']=$this->load->view('loan_info','',true);
			$this->load->view('master',$data);*/
		}
	}
	public function view($id=false)
	{
		$data['pageTitle']="Loan Information";
		$this->load->helper('form');
		$this->load->model('loan_model');
		if($id) {
			$data['loan']=$this->loan_model->get_loan_byid($id);	
			$data['borrowerloan']=$this->loan_model->get_loan_borrow($id);
			$data['installment']=$this->loan_model->get_installment_byloan($id);
			$data['ltxn']=$this->loan_model->get_transaction_byloan($id);
			
			$data['contant']=$this->load->view('loan_info',$data,true);
			$this->load->view('master',$data);
		}
		else {
			$data['loan']=$this->loan_model->get_loan();	
			$data['contant']=$this->load->view('loan_details',$data,true);
			$this->load->view('master',$data);		
		}
	}	

	function save(){
		$id = $this->input->post('borrower_id');
		// Including Validation Library
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// Validating Name Field
		$this->form_validation->set_rules('amount', 'Loan Amount', 'required|numeric');
		// Validating Email Field
		$this->form_validation->set_rules('rate', 'Rate', 'required|numeric');
		// Validating Mobile no. Field
		$this->form_validation->set_rules('installment_duration', 'Installment Duration', 'required|numeric');
		$this->form_validation->set_rules('duration_in_month', 'Installment Duration in Month', 'required|numeric');
		if ($this->form_validation->run() == FALSE) {
			redirect(base_url().'loan_info');
		}
		else {

			$this->load->model('loan_model');
			$borrower_id = $this->input->post('borrower_id');
			$amount = $this->input->post('amount');
			$rate = $this->input->post('rate');
			$start_date = $this->input->post('start_date');
			$payoff_date = $this->input->post('payoff_date');		
			$installment_duration = $this->input->post('installment_duration');
			$duration_in_month = $this->input->post('duration_in_month');
			$note = $this->input->post('note');
			$status="1";
			$loanname=$amount." for ".$rate."% on ". date('M', strtotime( $start_date ))." - ".date('Y', strtotime( $start_date ));
			$created_at = date('Y-m-d h:i:s');
			$data = array(
				'borrower_id'=>$borrower_id,
				'amount'=>$amount,
				'rate'=>$rate,
				'start_date'=>$start_date,
				'payoff_date'=>$payoff_date,
				'installment_duration'=>$installment_duration,
				'duration_in_month'=>$duration_in_month,
				'note'=>$note,
				'status'=>$status,
				'loanname'=>$loanname,
				'created_at'=>$created_at		
			);
			
			$result=$this->loan_model->save_loan($data);
			if($result) {
				$this->session->set_flashdata('success','Loan Added successfully');
				redirect(base_url().'loan');
			}
			else {
				$this->session->set_flashdata('error','Something went wrong');
				redirect(base_url().'loan/index/'.$id);
			}  
		}
	}

	function search() {
		//dsm($this->input->post()); die;		
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$amount = $this->input->post('amount');
		$rate = $this->input->post('rate');
		$period = $this->input->post('period');	
		$start_date = $this->input->post('start_date');
		$status = $this->input->post('status');
		
		$jsurl=base_url().'public/datepicker/bootstrap-datepicker.js';
		$data['loadJs']=array($jsurl);
		$cssurl=base_url().'public/datepicker/datepicker.css';
		$data['loadCss']=array($cssurl);		
	
		$this->load->helper('form');
		$data['pageTitle']="Loan Information";
		$this->load->model('loan_model');
		$data['loan']=$this->loan_model->get_search_loan($firstname,$lastname,$amount,$rate,$period,$start_date,$status);			
		$data['contant']=$this->load->view('loan_details',$data,true);
		$this->load->view('master',$data);		
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */