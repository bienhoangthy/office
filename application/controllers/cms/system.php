<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class system extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();				
			$this->output->enable_profiler(TRUE);
		}
		public function index()
		{
			// $this->_data['title'] = "System";
			// $this->my_layout->view("cms/system/index",$this->_data);
		}
	}