<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function send_notification_android($registration_ids, $data)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array (
		        'to' => $registration_ids,
		        'notification' => array (
		         "body" => $data,
		          "title" => $data['title']
		        )
		);
	
		
		/*$fields = array(
			'to'  => $registration_ids,
			'notification' => $data,
			'data' => $data
    	);*/
		$fields = json_encode ($fields);
		$headers = array (
		        'Authorization: key=' . "AIzaSyAF17mEvDeKvmzAuUwN6Eq4Ep1_jz66ueA",
		        'Content-Type: application/json'
		);
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		$result = curl_exec ($ch);
		curl_close ( $ch );
		return $result;
	}
	

	function send_notification_ios($device_token, $data)
	{ 
	    
		$deviceToken = $device_token; 

	
		//$passphrase = 'suman123';  // development;
		$passphrase = 'volive@hyd';  // production;
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert',"JoherDistrubutionCertificates.pem.pem");
		//stream_context_set_option($ctx, 'ssl', 'local_cert',"JoherCertificates.pem");
		stream_context_set_option($ctx, 'ssl', 'passphrase',$passphrase);
	
		//$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
		//production
		$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		if (empty($fp))
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		// Create the payload body
		/*$body['aps'] = array(
			'alert' => array(
			        'title' => 'New message ',
             		 'body' => $data		   	 
			 ),
			'sound' => 'default'
		);*/
		$body['aps'] = array(
    		'badge' => +1,
    		'alert' => $data['message'],
    		'info' => $data,
    		'sound' => 'default'
    	);
		// Encode the payload as JSON
		$payload = json_encode($body);
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		// Close the connection to the server
		fclose($fp);
		if (!$result)
			return 'Message not delivered';
		else
			return 'Message Successfully delivered';
	}


