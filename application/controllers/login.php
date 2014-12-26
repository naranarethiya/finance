<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class login extends CI_Controller {
	public function index()
	{
		$data['title']="Sign me in";
		$this->load->helper('form');
		$data['contant']=$this->load->view('login','',true);
		$this->load->view('login',$data);
	}
	public function check() { 
		
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$remember_user=false;
		$this->load->model('login_model');
		if($data=$this->login_model->app_login($username, $password)) {
			$this->session->set_userdata($data);	
			redirect(base_url()."dashboard");
		}
		else {
			$this->session->set_flashdata('error',"Username or password is wrong");
			redirect(base_url()."login");
		}
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
	
	public function change_password() {
		$opasssword=$this->input->post('opasssword');
		$npasssword=$this->input->post('npasssword');
		$ncpasssword=$this->input->post('ncpasssword');
		$this->load->model('login_model');
		$rs=$this->login_model->change_password($opasssword,$npasssword,$ncpasssword);	
		if($rs=="Success") {
			$this->session->set_flashdata("success","Password Change Successfully");
			redirect(base_url().'dashboard');
		}
		elseif($rs=="Confirm fail") {
			$this->session->set_flashdata("error","Confirm Password Done Not Match");
			redirect(base_url().'dashboard');
		}
		elseif($rs=="Old fail") {
			$this->session->set_flashdata("error","Old Password Is Wrong");
			redirect(base_url().'dashboard');
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */