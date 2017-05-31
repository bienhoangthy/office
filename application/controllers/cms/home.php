<?php
	class home extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->helper('text');
			$this->load->Model("cms/mconfig");			
			//$this->load->Model("cms/mhistory");
			$this->load->Model("cms/mcompany");
			$this->load->Model("cms/mmessage");
			$this->load->Model("cms/mfeedback");
			$this->load->Model("cms/minfoservice");
			$this->load->Model("cms/mservice");
			$this->load->Model("cms/mproject");
			$this->load->Model("cms/mproject_phase");
			//$this->load->Model("cms/mcompany_work");
			//$this->load->Model("cms/mcompany_status");
		}
		public function index()
		{			
			$this->_data["title"]  = 'Dashboard';
			$this->muser->checkPermission('home', 'index');
			//$and = " service_start = '".date('Y-m-d')";
			$and = " service_start = '". date('Y-m-d') ."' and service_status <> 3";
			$day = strtotime('-7 day', strtotime(date("Y-m-d")));
			$day = date("Y-m-d", $day);
			$andpay = ' service_pay_real > 0 and service_pay_dayupdate > '.$day;
			$this->_data['listContract'] = $this->minfoservice->getQuery("id,service_code,company_id,service_type",$join="",$and,"id desc",$limit="");
			$this->_data['listContractPay'] = $this->minfoservice->getQuery("id,service_code,company_id,service_type,service_pay_no",$join="",$andpay,"service_pay_dayupdate desc",20);
			$this->_data['listMessage'] = $this->mmessage->getQuery($object="",$join="","ms_create_date <= '".date("Y-m-d")."'","id desc","0,3");
			$this->_data['listFeedback'] = $this->mfeedback->getQuery($object="",$join="","feedback_status!=1","id desc","0,10");


            //Targets
			$user_main = $this->muser->getData('user_targets',array('id' => 12));
			$this->_data['targetYear'] = $user_main['user_targets'];
			$totalTargets = $this->minfoservice->getTarget(date("Y"));
			$this->_data['targetCompany'] = $totalTargets['0']['totalTargets'];
			$this->_data['rest'] = $this->_data['targetYear'] - $this->_data['targetCompany'];
			$percenReal = round(($this->_data['targetCompany'] / $this->_data['targetYear'])*100,2);
			$percenRest = round(($this->_data['rest'] / $this->_data['targetYear'])*100,2);
			$this->_data['targets'].="['Thực thu', ".$percenReal."],['Còn lại', ".$percenRest."]";
			//End Targets

			//Project
			$this->_data['listProject'] = $this->mproject->getQuery("id,infoservice_id,project_name,project_startday,project_status,project_manager","","1","id desc",10);


			$this->my_layout->view("cms/home/index",$this->_data);
		}		
		
	}
?>