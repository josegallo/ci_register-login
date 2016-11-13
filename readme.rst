This is a simple example of register and login with codeigniter, mysql and bootstrap

You would need to create a ddbb in phpMyAdmin with the name you desire and then create a table named user:

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

Configurate the params in application>config>database.php

Email settings: 
On application>models> User.php configurate the sendEmail function/method:

- For google account:

		$from_email = 'xxxx@gmail.com';
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://yourdomain/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';		
		
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; 
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email; 
		$config['smtp_pass'] = '*********'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes
		$this->email->initialize($config);

- For email provider:

		$from_email = 'user@mydomain.***';
		$subject = 'Verify Your Email Address';
		$message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://mydomain/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';
		
		$config['protocol'] = 'sendmail'; 
		$config['smtp_host'] = 'smtp.mydomain.xxx'; //smtp host name
		//$config['smtp_port'] = '25'; 
		//$config['smtp_user'] = $from_email; 
		//$config['smtp_pass'] = '********'; //$from_email password
		//$config['mailtype'] = 'html';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		//$config['newline'] = "\r\n"; //use double quotes
		//$this->email->initialize($config);
