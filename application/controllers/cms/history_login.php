<?php
	class history_login extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->Model("cms/mhistory");
			
		}
		public function index()
		{			
			$this->_data["title"]  = 'Lịch sử đăng nhập';
			$this->muser->checkPermission('history_login', 'index');
			$this->_data['listHistory'] = $this->mhistory->getQuery($object="",$join="",$andHist,"id desc","0,20");
			$this->my_layout->view("cms/history_login/index",$this->_data);
		}		
		
	}
?>