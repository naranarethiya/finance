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
			$jsurl='https://www.google.com/jsapi';
			$data['loadJs']=array($jsurl);
			$data['borrowerloan']=$this->dashboard_model->get_loan_borrow();
			$data['installment']=$this->dashboard_model->get_installment_byloan();
			$week_loan_data=$this->dashboard_model->get_total_loan();
			$data['totalloan']=$week_loan_data;
			$week_insta_data=$this->dashboard_model->get_total_installment();
			$data['totalinsta']=$week_insta_data;
			$loan=$this->dashboard_model->get_loan_borrow();
			foreach ($loan as $row) {
				$chkdate=$this->dashboard_model->check_date($row['loan_id']);
				if($chkdate=="0") {
					$date=strtotime($row['start_date']);
					$nextdate = date('Y-m-d', strtotime("+".$row['installment_duration']." days", $date));
					$week = date("W");
					$res=$this->getWeekDates(date('Y'), $week, $nextdate);
					if($res=="true") {
						$row['nextdate']=$nextdate;		
						$datetime1 = new DateTime($row['start_date']);
						$datetime2 = new DateTime($nextdate);
						$interval = $datetime2->diff($datetime1);
						$diff=$interval->format('%a');						
						$diff=number_format($diff/365,2);
						$rate=number_format(($row['rate']*12)/100,2);
						$pay_amount=$row['amount']*$diff*$rate;
						$row['pay_amount']=$pay_amount;	
						$data['next_installment'][]=$row;						
					}			
				}
				else {
					$date=$this->dashboard_model->get_date($row['loan_id']);	
					foreach ($date as $rowdate) {	
						$date=strtotime($rowdate['paid_date']);	
						$nextdate = date('Y-m-d', strtotime("+".$row['installment_duration']." days", $date));
						$week = date("W");
						$res=$this->getWeekDates(date('Y'), $week, $nextdate);	
						if($res=="true") {
							$row['nextdate']=$nextdate;
							$datetime1 = new DateTime($rowdate['paid_date']);
							$datetime2 = new DateTime($nextdate);
							$interval = $datetime2->diff($datetime1);
							$diff=$interval->format('%a');						
							$diff=number_format($diff/365,2);
							//$rate=number_format(($row['rate']*12)/100,2);
							$pay_amount=$row['amount']*$diff*$rate;
							$pay_amount=calculate_interest($row['amount'],$row['rate'],$row['installment_duration']);
							$row['pay_amount']=$pay_amount;	
							$data['next_installment'][]=$row;
						}									
					}
				}				
			}

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

	function getWeekDates($year, $week, $date, $start=true)
	{
	    $from = date("Y-m-d", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
	    $to = date("Y-m-d", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week
		if(($date >= $from)) {
			return "true";
		}
		else {
			return "false";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */