<?php
	class notification extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index()
		{
			$this->_data['title'] = "Nhận thông báo từ Office CRM";
			$this->my_layout->view("cms/notification/index",$this->_data);
		}	
	}
?>