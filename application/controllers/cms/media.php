<?php
session_start();
	class media extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function index()
		{	
			$this->_data["title"]  = 'Media';
			unset($_SESSION["contract"]);							
			$this->my_layout->view("cms/media/index",$this->_data);
		}		
	}
?>