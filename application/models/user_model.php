<?php
class user_model extends CI_Model
{
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//insert into user table
	function insertUser($data)
    {
		return $this->db->insert('user', $data);
	}
	
	//send verification email to user's email id
	function sendEmail($to_email)
	{
			
		//configure email settings with google	
		$from_email = 'josegallo@gmail.com';
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://localhost/matrix1/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';		
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name, 'ssl://smtp.gmail.com' ssl://smtp.mydomain.com
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email; //josegallo@gmail.com
		$config['smtp_pass'] = 'Vamosaconseguirlo'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);
		
		//configure email settings with piensasolutions server ...
		
		//$from_email = 'jose2@josegallo.net';
		//$subject = 'Verify Your Email Address';
		//$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://localhost/matrix1/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
		
		//$config['protocol'] = 'sendmail'; 
		//if sendmail, $config['protocol']  'smtp_host' => 'your domain SMTP host','smtp_port' => 25, 'smtp_user' => 'SMTP Username','smtp_pass' => 'SMTP Password',
		//if google, $config['protocol'] = ssl, ['smtp_host'] 'ssl://smtp.gmail.com' $config['smtp_port'] = '465'; 
		//$config['smtp_host'] = 'smtp.josegallo.net'; //smtp host name, for google'ssl://smtp.gmail.com' ssl://smtp.mydomain.com, 
		//$config['smtp_port'] = '25'; //smtp port number
		//$config['smtp_user'] = $from_email; //josegallo@gmail.com
		//$config['smtp_pass'] = 'Alam11eerda'; //$from_email password
		//$config['mailtype'] = 'html';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		//$config['newline'] = "\r\n"; //use double quotes
		//$this->email->initialize($config);
		
		//send mail
		$this->email->from($from_email, 'Jose Gallo');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);
		return $this->email->send();
	}
	
	//activate user account
	function verifyEmailID($key)
	{
		$data = array('status' => 1);
		$this->db->where('md5(email)', $key);
		return $this->db->update('user', $data);
	}
}