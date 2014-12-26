<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class login_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	function app_login($username,$pass)
	{
		$username=htmlspecialchars($username,ENT_QUOTES);

		$this->db->where("username",$username);
		$row=$this->db->get('user');
		//if username exists
		if($row->num_rows() > 0)
		{
			$row=$row->row(0);
			//print_r($row);die;
			if(strcmp($row->password,$pass)==0)
			{
				$session['uid']=$row->uid;
				$session['name']=$row->name;
				$date=date("Y-m-d h:r:s");
				$login_history=array('uid'=>$row->uid);
				$this->db->set('login_date','now()',false);
				$this->db->insert('login_history',$login_history);
				return $session;
			} 
			else 
			{
				return false;
			}
		}
		else 
		{
			return false;
		}
	}
	public function check_old_password($old_pass,$uid)
	{
		print_r($this->session->all_userdata());
		$sql="select * from users where uid=?";
		$row=$this->db->query($sql,$uid);
		if($row->num_rows() > 0)
		{
			$row=$row->row(0);
			if(strcmp($row->password,$old_pass)==0)
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
		else 
		{
			return false;
		}
		
	}
	public function change_password($old,$new,$confirm)
	{
		if($this->check_old_password($old,$this->session->userdata('user_id')))
		{
			if(strcmp($new,$confirm)==0)
			{
				$this->db->query("update users set password=? where uid=?",array($confirm,$this->session->userdata('user_id')));
				return("Password Change Successfully");
			}
			else
			{
				return("Confirm Password Done Note Match");
			}
		}
		else
		{
			return("Old Password Is Wrong");
		}
	}
	
	public function check_user($user)
	{
		if($this->session->userdata('role')==$user)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}