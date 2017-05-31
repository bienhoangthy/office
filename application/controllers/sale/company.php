<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company extends MY_Sale
	{		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_rate");	
		}
		public function index()
		{
			echo 'aaaaaaaa';
		}
	}