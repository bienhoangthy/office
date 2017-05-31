<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class login extends CI_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->library(array("session"));					
		}
		public function index()
		{
			# code...		
			$s_info = $this->session->userdata('userInfo');            
			if($s_info){
                header("location:".my_lib::cms_site()."home/");
			}else
			{
				# code...
                header("location:".my_lib::cms_site()."index/");
			}	
			
		}		
				
	}
?>