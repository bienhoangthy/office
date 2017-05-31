<?php
	class account_name extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();	
			$this->load->Model("cms/maccount_name");			
			$this->load->Model("cms/maccount_name_history");			
		}
		public function index()
		{
			$this->muser->checkPermission('account_name', 'index');
			$this->_data["title"]  = 'Danh sách tài khoản công ty';		
			$object_name = '';
			$join_name = '';
			$and_name = '';
			$orderby_name = 'id desc ';
			$limit_name = '';		
			$this->_data['list'] = $this->maccount_name->getQuery($object_name,$join_name,$and_name,$orderby_name,$limit_name);
			# end danh sach muc chi					
			$this->my_layout->view("cms/account_name/index",$this->_data);
		}
		
	}
?>