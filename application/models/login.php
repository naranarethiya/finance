<?php
	class customer extends CI_Model{ 
	
		public $login_table="user";
		public $username_col="username";
		public $password_col="password";
	
		public function __construct()
		{
			$this->load->database();
		}	
   
		public function query($sql) {
			$result = $this->conn->query($sql);
			return $result;
		}
		public function app_login($username,$pass) {

			$username=htmlspecialchars($username,ENT_QUOTES);
			$sql="SELECT * FROM ".$this->login_table." WHERE ".$this->username_col."='".$username."'";
			$result=$this->query($sql);
			$row=mysql_fetch_array($result);
			if(mysql_num_rows($result) > 0)
			{
				if(strcmp($row['password'],$pass)==0) {
					$this->session['username']=$row[$username_col];
					return $this->session;
				} 
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}		
	}
?>