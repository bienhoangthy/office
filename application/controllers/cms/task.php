<?php
	class task extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mtask");		
		}
		public function index()
		{
			$this->muser->checkPermission('task', 'index');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['boss'] =	0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5 || $this->_data['s_info']['s_user_group'] == 7) {
				$this->_data['boss'] =	1;
			}	
			$this->_data["title"]  = 'Danh sách công việc của '. $this->_data['s_info']['s_user_fullname'];		
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
				"ftype"=>isset($_REQUEST['ftype']) && $_REQUEST['ftype'] ? $_REQUEST['ftype']:"all",
				"femployee"=>isset($_REQUEST['femployee']) && $_REQUEST['femployee'] ? $_REQUEST['femployee']:"all",
				"fdate"=>isset($_REQUEST['fdate']) && $_REQUEST['fdate'] ? $_REQUEST['fdate']:"",
			);
			$and = ' task_employee = '.$this->_data['s_info']['s_user_id'];
			if ($this->_data['boss'] == 1) {
				$and = 'id > 0';
				$this->_data["title"]  = 'Danh sách công việc của tất cả nhân viên';
				if($this->_data['formData']['femployee']!="all")
	            {
	                $and .= ' and task_employee ='.$this->_data['formData']['femployee'];
	            }
	            $this->_data['femployee'] = $this->muser->dropdownlistAccount1($this->_data['formData']['femployee']);
			}
			if($this->_data['formData']['fstatus']!="all")
            {
                $and .= ' and task_status ='.$this->_data['formData']['fstatus'];
            }
            if($this->_data['formData']['ftype']!="all")
            {
                $and .= ' and task_type ='.$this->_data['formData']['ftype'];
            }
            if($this->_data['formData']['fdate']!="")
            {
                $and .= ' and task_startday between "'.$this->_data['formData']['fdate'].' 00:00:00" and "'.$this->_data['formData']['fdate'].' 23:59:59"';
            }
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (task_name like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or task_note like "%'.$this->_data['formData']['fkeyword'].'%")';
			}					
			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'task/?'.$query_string.'&page=';			
			/*end phan trang*/
			$object = "id,task_name,task_employee,task_assigner,task_status,task_delay,task_type,task_startday,task_endday,task_expectedday";
			$this->_data['orderby']=$orderby = 'id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->mtask->getQuery($object,$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->mtask->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myTask = $this->mtask->getData('',array("id"=>$value));
							if($myTask['id']>0){	
								$this->mtask->delete($value);
							}
						}
					}
					/**begin chuyen trang*/
					header("location:".current_url());
					/**end chuyen trang*/
				}else{
					$this->_data['error'][] = 'Vui lòng kiểm tra check chọn';
				}
			}
			/**end xoa check chon*/
			$this->_data['fstatus'] = $this->mtask->dropdownlistStatus($this->_data['formData']['fstatus']);
			$this->_data['ftype'] = $this->mtask->dropdownlistType($this->_data['formData']['ftype']);
			$this->_data['fdate'] = $this->_data['formData']['fdate'];
			$this->my_layout->view("cms/task/index",$this->_data);
		}	

		public function mytask()
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['boss'] =	0;
			$this->_data["title"]  = 'Danh sách công việc của '. $this->_data['s_info']['s_user_fullname'];		
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
				"ftype"=>isset($_REQUEST['ftype']) && $_REQUEST['ftype'] ? $_REQUEST['ftype']:"all",
				"fdate"=>isset($_REQUEST['fdate']) && $_REQUEST['fdate'] ? $_REQUEST['fdate']:"",
			);
			$and = ' task_employee = '.$this->_data['s_info']['s_user_id'];
			if($this->_data['formData']['fstatus']!="all")
            {
                $and .= ' and task_status ='.$this->_data['formData']['fstatus'];
            }
            if($this->_data['formData']['ftype']!="all")
            {
                $and .= ' and task_type ='.$this->_data['formData']['ftype'];
            }
            if($this->_data['formData']['fdate']!="")
            {
                $and .= ' and task_startday between "'.$this->_data['formData']['fdate'].' 00:00:00" and "'.$this->_data['formData']['fdate'].' 23:59:59"';
            }
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (task_name like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or task_note like "%'.$this->_data['formData']['fkeyword'].'%")';
			}			
			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'task/mytask?'.$query_string.'&page=';			
			/*end phan trang*/
			$object = "id,task_name,task_employee,task_assigner,task_status,task_delay,task_type,task_startday,task_endday,task_expectedday";
			$this->_data['orderby']=$orderby = 'id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->mtask->getQuery($object,$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->mtask->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			
			/**end xoa check chon*/
			$this->_data['fstatus'] = $this->mtask->dropdownlistStatus($this->_data['formData']['fstatus']);
			$this->_data['ftype'] = $this->mtask->dropdownlistType($this->_data['formData']['ftype']);
			$this->_data['fdate'] = $this->_data['formData']['fdate'];
			$this->my_layout->view("cms/task/index",$this->_data);
		}	

		public function assign()
		{
			$s_info = $this->session->userdata('userInfo');
			$this->_data["title"] = "Giao việc";
			$this->muser->checkPermission('task', 'assign');
			if (isset($_POST['fsubmit'])) {
				$hurry = $this->input->post('hurry');
				if ($hurry == 1) {
					$task_type = 4;
				} else {
					$task_type = 3;
				}
				$task_name = $this->input->post('task_name');
				$task_note = $this->input->post('task_note');
				if ($task_note != '') {
					$task_note = date("Y-m-d H:i:s").' :'.$task_note.'<br>';
				}
				$task_startday = date("Y-m-d H:i:s");
				$task_expectedday = $this->input->post('task_expectedday');

				$list_employs = $this->input->post('task_employs');
				foreach ($list_employs as $key => $value) {
					$data = array(
						'task_name' => $task_name,
						'task_employee' => $value,
						'task_assigner' => $s_info['s_user_id'],
						'task_note' => $task_note,
						'task_status' => 1,
						'task_delay' => 0,
						'task_type' => $task_type,
						'task_startday' => $task_startday,
						'task_endday' => "",
						'task_expectedday' => $task_expectedday,
						'task_log' => "1/"
					 );
					$insert = $this->mtask->add($data);
					if ($insert > 0) {
						$push_user_id = $this->muser->getData("user_push_id",array('id' => $value));
						if ($push_user_id['user_push_id'] != "") {
							$img = my_lib::base_url().'media/user/'.$s_info['s_user_avatar'];
							$this->mtask->sendMessage(array($push_user_id['user_push_id']),$task_name,my_lib::cms_site()."task/edit/".$insert,$img);
						}
					}
				}
				$this->_data['success'] = "Giao việc thành công!";
				$this->_data['formData'] = NULL;
				header("location:".my_lib::cms_site()."task/");
			}

			$this->my_layout->view("cms/task/add",$this->_data);
		}

		public function report($user_id)
		{
			$myUser = $this->muser->getData('user_fullname',array("id"=>$user_id));
			$this->_data['userCur'] = $this->muser->getData('user_fullname',array("id"=>$user_id));
			// var_dump($myUser);
			// die();
			//$this->_data['userCurInfo'] = $myUser["user_fullname"];
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			if ($this->_data['s_info']['s_user_group'] != 1 && $this->_data['s_info']['s_user_id'] != $user_id) {
				header("location:".my_lib::cms_site().'error/permission');
				exit();
			} else {
				$date = date('Y-m-d',time()-(7*86400));
				$and = ' task_employee = '.$user_id;
				$and .= ' and task_startday >= "'. $date.'"';
				$this->_data['date'] = $date;
				$this->_data['total'] = $this->mtask->countQuery($join="",$and);
				$this->_data['delay'] = $this->mtask->countQuery($join="",$and.' and task_delay = 1');
				$this->_data['waiting'] = $this->mtask->countQuery($join="",$and.' and task_status = 1');
				$this->_data['complete'] = $this->mtask->countQuery($join="",$and.' and task_status = 2');
				//$this->_data['then'] = $this->mtask->countQuery($join="",$and.' and task_status = 4');
				$this->_data['plan'] = $this->mtask->countQuery($join="",$and.' and task_type in (1,2)');
				$this->_data['assigned'] = $this->mtask->countQuery($join="",$and.' and task_type in (3,4)');
				//$this->_data['list'] = $this->mtask->getQuery($object="",$join="",$and,$orderby);
				$this->my_layout->view("cms/task/report",$this->_data);
			}


		}	
		
		public function popup()
		{
			$this->_data['lang'] = my_lib::lang();
			$redirect = $this->input->post('redirect');

			$s_info = $this->session->userdata('userInfo');

			if ($this->input->post('user_id') == $s_info['s_user_id']) {
				$task_note = $this->input->post('task_note');
				if ($task_note != '') {
					$task_note = date("Y-m-d H:i:s").' :'.$task_note.'<br>';
				}
				$this->_data['formData']	= array(
					"task_name"=>$this->input->post('task_name'),
					"task_employee"=>$s_info['s_user_id'],
					"task_assigner"=>0,
					"task_note"=>$task_note,
					"task_status"=>1,
					"task_delay"=>0,
					"task_type"=>1,
					"task_startday"=>date("Y-m-d H:i:s"),
					"task_endday"=>"",
					"task_expectedday"=>$this->input->post('task_expectedday'),
					"task_log"=>"1/"
				);	
				if($this->_data['formData']['task_name']){
					$insert = $this->mtask->add($this->_data['formData']);
					if(is_numeric($insert)>0){			
						header("location:".base64_decode($redirect));					
					}
				}
			}
		}

		public function edit($id)
		{
			$myTask = '';
			if(is_numeric($id)){
				$myTask = $this->mtask->getData('',array("id"=>$id));
				if($myTask['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$this->_data['boss'] =	0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5 || $this->_data['s_info']['s_user_group'] == 7) {
				$this->_data['boss'] =	1;
			}
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			if ($myTask['task_employee'] != $this->_data['s_info']['s_user_id'] && $this->_data['boss'] != 1) {
				header("location:".my_lib::cms_site().'error/permission');
				exit();
			}
			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật';
			$this->_data['formData']	= array(
				"id"=>$id,
				"task_name"=>isset($myTask['task_name']) && $myTask['task_name'] ? $myTask['task_name']:'',
				"task_employee"=>$myTask['task_employee'],
				"task_note"=>isset($myTask['task_note']) && $myTask['task_note'] ? $myTask['task_note']:'',
				"task_status"=>isset($myTask['task_status']) && $myTask['task_status'] ? $myTask['task_status']:'',
				"task_delay"=>isset($myTask['task_delay']) && $myTask['task_delay'] ? $myTask['task_delay']:'',
				"task_type"=>isset($myTask['task_type']) && $myTask['task_type'] ? $myTask['task_type']:'',
				"task_startday"=>isset($myTask['task_startday']) && $myTask['task_startday'] ? $myTask['task_startday']:'',
				"task_endday"=>isset($myTask['task_endday']) && $myTask['task_endday'] ? $myTask['task_endday']:'',
				"task_expectedday"=>isset($myTask['task_expectedday']) && $myTask['task_expectedday'] ? $myTask['task_expectedday']:'',
				"task_log"=>isset($myTask['task_log']) && $myTask['task_log'] ? $myTask['task_log']:'',
				);			

			if(isset($_POST['fsubmit'])){
				$endday = '';
				$log_status = $myTask['task_log'];
				if ($this->input->post('task_status') == 2) {
					$endday = date("Y-m-d H:i:s");
				}
				if ($this->input->post('task_status') != $myTask['task_status']) {
					$log_status .= $this->input->post('task_status') . '/';
				}
				$task_expectedday = $this->_data['formData']['task_expectedday'];
				if ($this->_data['boss'] == 1) {
					$task_expectedday = $this->input->post('task_expectedday');
				}
				$task_note = $this->_data['formData']['task_note'];
				$task_note_new = $this->input->post('task_note');
				if ($task_note_new != '') {
					$task_note .= date("Y-m-d H:i:s").' :'.$task_note_new.'<br>';
				}
				$this->_data['formData']	= array(
					"task_name"=>$this->input->post('task_name'),
					"task_status"=>$this->input->post('task_status'),
					"task_note"=>$task_note,
					"task_endday"=>$endday,
					"task_expectedday"=>$task_expectedday,
					"task_log"=>$log_status
				);	
				if($this->_data['formData']['task_name']){					
					if($this->mtask->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."task/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			/**begin com parent*/			
			/**end com parent*/

			$this->my_layout->view("cms/task/edit",$this->_data);
		}

		
		public function send()
		{
			$rs = $this->mtask->sendMessage(array('c15a848f-863c-4f68-85ff-665e25ff0229'),"Bạn vừa nhận được việc mới","http://office.ioi.vn/cms/message/detail/9/?redirect=aHR0cDovL29mZmljZS5pb2kudm4vY21zL21lc3NhZ2U=");
			echo $rs;
		}

	}
?>