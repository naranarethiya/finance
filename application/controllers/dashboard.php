<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('uid')== '') {
			redirect(base_url());
		}
	}
	public function index()
	{
			$data['pageTitle']="Dashboard";
			$this->load->model('dashboard_model');
			$data['borrowerloan']=$this->dashboard_model->get_loan_borrow();
			$data['installment']=$this->dashboard_model->get_installment_byloan();
			$data['contant']=$this->load->view('dashboard',$data,true);
			$this->load->view('master',$data);
	}
	public function report() {
			$data['pageTitle']="Report";
			$this->load->model('dashboard_model');
			$data['installment']=$this->dashboard_model->get_installment();
			$data['contant']=$this->load->view('insallment_report',$data,true);
			$this->load->view('master',$data);		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */