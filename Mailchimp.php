<?php

	class MailChimp
	{
		public $_ApiKey = 'YOUR_MAILCHIMP_API_KEY'; 
		public $_Server	= null;
		public $_Endpoint	=	null;
		
		public function __construct()
		{
			$this->_Server = substr($this->_ApiKey, -4);
			$this->_Endpoint = 'https://' . $this->_Server . '.api.mailchimp.com/3.0';
		}
		
		public function list_create_member($data)
		{
			$curl = curl_init($this->_Endpoint . '/lists/' . $data['list_id'] . '/members');
			$curl_post_data = json_encode($data['request']);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_USERPWD, $this->_ApiKey . ':' . $this->_ApiKey);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
			$curl_response = curl_exec($curl);
			curl_close($curl);
			
			$curl_response = json_decode($curl_response, true);
			
			if(!is_numeric($curl_response['status']))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
?>
