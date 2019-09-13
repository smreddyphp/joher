<?php  
defined('BASEPATH') or exit('No direct script access allowed');

if( ! function_exists('send_mail') )
{
	function send_mail($to,$subject,$template)
	{
		
	  $CI =& get_instance();
	  
	  $CI->email->initialize(array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => 'styticket@gmail.com',
			'smtp_pass' => 'styticket123',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'crlf'      => "\r\n",
			'newline'   => "\r\n",
			'charset'	=> "utf-8"
		));
		
	  $CI->email->from('styticket@gmail.com',strtoupper('Carfix Team'));
	  $CI->email->to($to);
	  $CI->email->subject($subject);
	  $CI->email->message($template);
      
	  $result = $CI->email->send();
	  
	  if($result){
		return true; 
	  }else{
		return false; 
	  }
	  
	}
}