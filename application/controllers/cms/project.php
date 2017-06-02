<?php
	class project extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mproject");	
			$this->load->Model("cms/mproject_phase");	
			$this->load->Model("cms/minfoservice");	
			$this->load->Model("cms/mnote");
			$this->load->Model("cms/mtask");	
		}
		public function index()
		{
			$this->muser->checkPermission('project', 'index');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['boss'] =	0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5 || $this->_data['s_info']['s_user_group'] == 6) {
				$this->_data['boss'] =	1;
			}	
			$this->_data["title"]  = 'Danh sách dự án của công ty';		
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
				"ftype"=>isset($_REQUEST['ftype']) && $_REQUEST['ftype'] ? $_REQUEST['ftype']:"all",
				"fuser"=>isset($_REQUEST['fuser']) && $_REQUEST['fuser'] ? $_REQUEST['fuser']:"all",
				"ftime"=>isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:"all",
				"ftypeTime"=>isset($_REQUEST['ftypeTime']) && $_REQUEST['ftypeTime'] ? $_REQUEST['ftypeTime']:0,
				"fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all",
			);
			$and = ' 1';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
            {
                $and .= ' and project_name like "%'.$this->_data['formData']['fkeyword'].'%"';
            }  
			if($this->_data['formData']['fstatus']!="all")
            {
                $and .= ' and project_status ='.$this->_data['formData']['fstatus'];
            }
            if($this->_data['formData']['ftype']!="all")
            {
                $and .= ' and project_type ='.$this->_data['formData']['ftype'];
            }
            if($this->_data['formData']['fuser']!="all")
            {
                $and .= ' and project_manager ='.$this->_data['formData']['fuser'];
            }
            $this->_data['textFilter'] = '';
            if($this->_data['formData']['fyear']!="all")
            {
                $and .= ' and YEAR(project_startday) ='.$this->_data['formData']['fyear'];
                if ($this->_data['formData']['ftime']!="all") {
                	switch ($this->_data['formData']['ftypeTime']) {
                		case '1':
                			$and .= ' and WEEKOFYEAR(project_startday) ='.$this->_data['formData']['ftime'];
			            	$this->_data['textFilter'] = 'Tuần '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '2':
                			$and .= ' and MONTH(project_startday) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Tháng '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '3':
                			$and .= ' and QUARTER(project_startday) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Quý '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;
                		default:
              				$add .= '';
              				$this->_data['textFilter'] = 'Bạn chưa chọn tuần, tháng hoặc quý của năm '.$this->_data['formData']['fyear'];
                			break;
                	}
                }
            }				
			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'project/?'.$query_string.'&page=';			
			/*end phan trang*/
			$object = "";
			$this->_data['orderby']=$orderby = 'id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->mproject->getQuery($object,$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->mproject->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$this->muser->checkPermission('project', 'delete');
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						if(is_numeric($value)){
							$myProject = $this->mproject->getData('',array("id"=>$value));
							if($myProject['id']>0){	
								$this->mproject->delete($value);
								$list_phase = $this->mproject_phase->getQuery("id","","project_id = ".$value,"id asc","");
								if (!empty($list_phase)) {
									foreach ($list_phase as $key => $val) {
										$this->mproject_phase->delete($val['id']);
									}
								}
								$list_note = $this->mnote->getQuery("id","","note_controller = 'project' and note_parent = ".$value,"id asc","");
								if (!empty($list_note)) {
									foreach ($list_note as $key => $v) {
										$this->mnote->delete($v['id']);
									}
								}
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
			$this->_data['fstatus'] = $this->mproject->dropdownlistStatus($this->_data['formData']['fstatus']);
			$this->_data['ftype'] = $this->mproject->dropdownlistType($this->_data['formData']['ftype']);
			$this->_data['fuser'] = $this->muser->dropdownlist($this->_data['formData']['fuser']);
			$this->_data['fyear'] = $this->minfoservice->dropdownlistYear($this->_data['formData']['fyear']);
			$this->_data['ftypeTime'] = $this->minfoservice->dropdownlistTypetime($this->_data['formData']['ftypeTime']);
			$this->my_layout->view("cms/project/index",$this->_data);
		}	

		//Add popup
		public function popup()
		{
			$this->muser->checkPermission('project', 'add');
			$s_info = $this->session->userdata('userInfo');
			//$myUser = $this->muser->getData("user_fullname",array("id"=>$s_info['s_user_id']));
			$user_fullname = isset($s_info['s_user_fullname']) && $s_info['s_user_fullname'] ? $s_info['s_user_fullname']:'';
			if (isset($_POST['fsubmit'])) {
				$addData = array(
					'infoservice_id' => $this->input->post('infoservice_id'),
					'project_name' => $this->input->post('project_name'),
					'project_bonus' => 0,
					'project_startday' => date("Y-m-d H:i:s"),
					'project_deadline' => $this->input->post('project_deadline'),
					'project_endday' => '',
					'project_status' => 1,
					'project_type' => $this->input->post('project_type'),
					'project_manager' => $this->input->post('project_manager'),
					'project_description' => $this->input->post('project_description'),
					'project_log' => $user_fullname.' đã tạo dự án|'.date("d-m-Y : H:i:s").'/',
				);
				if (!empty($addData)) {
					$insert = $this->mproject->add($addData);
					if(is_numeric($insert)>0){			
						header("location:".my_lib::cms_site()."project/");				
					}
				}
			}
		}

		public function detail($id)
		{
			$this->muser->checkPermission('project', 'detail');
			$this->_data['s_info'] = $this->session->userdata('userInfo');
			$this->_data['boss'] = 0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5) {
				$this->_data['boss'] = 1;
			}
			$this->_data["title"]  = 'Chi tiết dự án';
			if(is_numeric($id)){
				$this->_data['myProject'] = $this->mproject->getData('',array("id"=>$id));
				if($this->_data['myProject']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				} else {
					$this->_data['myInfoservice'] = $this->minfoservice->getData('',array("id"=>$this->_data['myProject']['infoservice_id']));
					$this->_data['manager'] = $this->muser->getData("user_fullname,user_avatar",array("id"=>$this->_data['myProject']['project_manager']));
					$this->_data['listPhase'] = $this->mproject_phase->getQuery("","","project_id = ".$id,"id asc","");
					$this->_data['listNote'] = $this->mnote->getQuery("","","note_controller = 'project' and note_parent = ".$id,"id asc","");
					$this->my_layout->view("cms/project/detail",$this->_data);
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
		}

		public function addPersonnel($project_id)
		{
			$this->muser->checkPermission('project', 'addPersonnel');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['title'] = "Thêm nhân sự vào dự án";
			$phase_name = 1;
			$this->_data['project_id'] = $project_id;
			$phase = $this->mproject_phase->getQuery("","","project_id = ".$project_id,"phase_name desc",1);
			if (!empty($phase)) {
				$phase_name = $phase['phase_name'];
			}
			$this->_data['formData'] = array(
				"user_id" => "", 
				"phase_status" => 1,
				"phase_startday" => date("Y-m-d"),
				"phase_percent" => 0,
				"phase_deadline" => date("Y-m-d"), 
				"phase_endday" => "", 
				"phase_name" => $phase_name+1, 
				"phase_note" => "", 
			);
			if (isset($_POST['fsubmit'])) {
				if ($this->input->post('user_id') > 0) {
					$dataAdd = array(
						"project_id" => $project_id, 
						"user_id" => $this->input->post('user_id'), 
						"phase_status" => 1,
						"phase_startday" => $this->input->post('phase_startday'),
						"phase_deadline" => $this->input->post('phase_deadline'), 
						"phase_endday" => "", 
						"phase_name" => $this->input->post('phase_name'), 
						"phase_note" => $this->input->post('phase_note'), 
					);
					if (!empty($dataAdd)) {
						$this->mproject_phase->add($dataAdd);
						//Log
						$myProject = $this->mproject->getData('project_name,project_log',array("id"=>$project_id));
						$logProject = $myProject['project_log'];
						$myUser = $this->muser->getData("user_fullname,user_push_id",array("id"=>$this->input->post('user_id')));
						$user_fullname = isset($s_info['s_user_fullname']) && $s_info['s_user_fullname'] ? $s_info['s_user_fullname']:'';
						$user_fullname_emp = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';
						$phase_name_log = $this->mproject_phase->listPhase($this->input->post('phase_name'));
						$logProject .= $user_fullname.' đã thêm '.$user_fullname_emp.' vào thực hiện '.$phase_name_log['name'].'|'.date("d-m-Y : H:i:s").'/';
						$this->mproject->edit($project_id,array('project_log' => $logProject));
						//Task
						$dataAddTask = array(
							'task_name' => $phase_name_log['name'].' '.$myProject['project_name'],
							'task_employee' => $this->input->post('user_id'),
							'task_assigner' => $s_info['s_user_id'],
							'task_note' => date("Y-m-d H:i:s").' :'.$this->input->post('phase_note').'<br>',
							'task_status' => 1,
							'task_delay' => 0,
							'task_type' => 3,
							'task_startday' => $this->input->post('phase_startday'),
							'task_endday' => "",
							'task_expectedday' => $this->input->post('phase_deadline'),
							'task_log' => "1/"
						 );
						$insert = $this->mtask->add($dataAddTask);
						if ($insert > 0) {
							if ($myUser['user_push_id'] != "") {
								$img = my_lib::base_url().'media/user/'.$s_info['s_user_avatar'];
								$this->mtask->sendMessage(array($myUser['user_push_id']),$dataAddTask['task_name'],my_lib::cms_site()."project/detail/".$project_id,$img);
							}
						}
						header("location:".my_lib::cms_site()."project/detail/".$project_id);
					}
				} else {
					$this->_data['error'] = "Vui lòng chọn nhân viên";
				}
			}
			$this->_data['update'] = 0;
			$this->my_layout->view("cms/project/addpersonnel",$this->_data);
		}

		public function editPersonnel($id)
		{
			$this->muser->checkPermission('project', 'editPersonnel');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['title'] = "Cập nhật trạng thái công việc";
			$myPhase = $this->mproject_phase->getQuery("","","id = ".$id,"id desc",1);
			$this->_data['project_id'] = $myPhase['project_id'];
			if ($s_info['s_user_id'] == $myPhase['user_id']) {
				$this->_data['formData'] = array(
					"project_id" => $myPhase['project_id'], 
					"user_id" => $myPhase['user_id'], 
					"phase_status" => $myPhase['phase_status'],
					"phase_startday" => $myPhase['phase_startday'],
					"phase_percent" => $myPhase['phase_percent'],
					"phase_deadline" => $myPhase['phase_deadline'], 
					"phase_endday" => $myPhase['phase_endday'], 
					"phase_name" => $myPhase['phase_name'], 
					"phase_note" => $myPhase['phase_note'], 
				);
				$this->_data['update'] = 1;
				if (isset($_POST['fsubmit'])) {
					$myProject = $this->mproject->getData('project_name,project_log',array("id"=>$myPhase['project_id']));
					$user_fullname = isset($s_info['s_user_fullname']) && $s_info['s_user_fullname'] ? $s_info['s_user_fullname']:'';
					$phase_name_log = $this->mproject_phase->listPhase($myPhase['phase_name']);
					//
					$logProject = $myProject['project_log'];
					$user_id = $myPhase['user_id'];
					$phase_endday = "";
					$user_tran = $this->input->post('user_id_tran');
					$phase_percent = $this->input->post('phase_percent');
					$phase_status = $myPhase['phase_status'];
					$phase_deadline = $this->input->post('phase_deadline');
					$phase_note = $this->input->post('phase_note');
					if ($user_tran != 0 && $user_tran != $myPhase['user_id']) {
						$userTran = $this->muser->getData("user_fullname,user_push_id",array("id"=>$user_tran));
						$user_fullname_tran = isset($userTran['user_fullname']) && $userTran['user_fullname'] ? $userTran['user_fullname']:'';
						$logProject .= $user_fullname.' đã bàn giao việc '.$phase_name_log['name'].' lại cho '.$user_fullname_tran.'|'.date("d-m-Y : H:i:s").'/';
						//Task
						$dataAddTask = array(
							'task_name' => $phase_name_log['name'].' '.$myProject['project_name'],
							'task_employee' => $user_tran,
							'task_assigner' => $s_info['s_user_id'],
							'task_note' => date("Y-m-d H:i:s").' :Việc chuyển giao từ '.$user_fullname.' cho '.$user_fullname_tran.'<br>',
							'task_status' => 1,
							'task_delay' => 0,
							'task_type' => 3,
							'task_startday' => date("Y-m-d H:i:s"),
							'task_endday' => "",
							'task_expectedday' => $this->input->post('phase_deadline'),
							'task_log' => "1/"
						 );
						$insert = $this->mtask->add($dataAddTask);
						$user_id = $user_tran;
						if ($insert > 0) {
							if ($userTran['user_push_id'] != "") {
								$img = my_lib::base_url().'media/user/'.$s_info['s_user_avatar'];
								$this->mtask->sendMessage(array($userTran['user_push_id']),$dataAddTask['task_name'],my_lib::cms_site()."project/detail/".$myPhase['project_id'],$img);
							}
						}
					}
					if ($phase_percent != $myPhase['phase_percent']) {
						if ($phase_percent > 0) {
							$phase_status = 2;
						}if ($phase_percent == 100) {
							$namebeforePhase = $myPhase['phase_name'] - 1;
							$beforePhase = $this->mproject_phase->getQuery("phase_status","","project_id = ".$myPhase['project_id']." and phase_name = ".$namebeforePhase,"id desc",1);
							if (!empty($beforePhase) && $beforePhase['phase_status'] == 3 || $myPhase['phase_name'] == 2) {
								$phase_status = 3;
							} else {
								$phase_percent = 99;
								$phase_status = 2;
							}
						}
					}
					if ($phase_status != $myPhase['phase_status']) {
						$phase_status_name = $this->mproject_phase->listStatus($phase_status);
						$logProject .= $user_fullname.' đã đổi trạng thái '.$phase_status_name['name'].' cho việc '.$phase_name_log['name'].' |'.date("d-m-Y : H:i:s").'/';
						if ($phase_status == 3) {
							$phase_endday = date("Y-m-d");
							if ($myPhase['phase_name'] == 6) {
								$this->mproject->edit($myPhase['project_id'],array('project_status' => 2,'project_endday' => date("Y-m-d H:i:s")));
							}
						} else {
							$this->mproject->edit($myPhase['project_id'],array('project_status' => 1,'project_endday' => ""));
						}
					}
					if ($phase_deadline != $myPhase['phase_deadline']) {
						$logProject .= $user_fullname.' đã thay đổi deadline '.$phase_name_log['name'].' từ '.$myPhase['phase_deadline'].' sang '.$phase_deadline.'|'.date("d-m-Y : H:i:s").'/';
					}
					if ($myPhase['phase_note'] != "" && $phase_note != "") {
						$phase_note = $myPhase['phase_note'].' <br>'.$phase_note;
					}
					$dataEdit = array(
						'user_id' => $user_id,
						'phase_status' => $phase_status,
						'phase_percent' => $phase_percent,
						'phase_deadline' => $phase_deadline,
						'phase_endday' => $phase_endday,
						'phase_note' => $phase_note,
					);
					if ($this->mproject_phase->edit($id,$dataEdit)) {
						$this->mproject->edit($myPhase['project_id'],array('project_log' => $logProject));
						header("location:".my_lib::cms_site()."project/detail/".$myPhase['project_id']);
					}
				}
				$this->my_layout->view("cms/project/addpersonnel",$this->_data);
			} else {
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
		}

		public function noteAjax()
		{
			$html = "";
			$content = $this->input->post('content');
			$color = $this->input->post('color');
			$fullname = $this->input->post('fullname');
			$project_id = $this->input->post('project_id');
			$addData = array(
				'note_content' => $content, 
				'note_controller' => 'project', 
				'note_parent' => $project_id, 
				'note_color' => $color, 
				'note_user_fullname' => $fullname, 
				'note_date' => date("Y-m-d H:i:s"), 
			);
			$insert = $this->mnote->add($addData);
			if(is_numeric($insert)>0){			
				$html = '<div class="col-md-12"><div class="alert alert-'.$color.'"><strong>'.$fullname.': </strong> '.$content.'<br><small>'.$addData['note_date'].'</small></div></div>';		
			} else {
				$html = '<div class="col-md-12"><div class="alert alert-danger"><strong>Lỗi!</strong> Không gửi được nội dung.</div></div>';
			}
			echo $html;
		}

		public function edit($id)
		{
			$this->muser->checkPermission('project', 'edit');
			$myProject = '';
			if(is_numeric($id)){
				$myProject = $this->mproject->getData('',array("id"=>$id));
				if($myProject['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$this->_data['boss'] =	0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5) {
				$this->_data['boss'] =	1;
			}
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			if ($this->_data['boss'] != 1) {
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$this->_data["title"]  = 'Cập nhật dự án';
			$this->_data['formData']	= array(
				"id"=>$id,
				"project_name"=>isset($myProject['project_name']) && $myProject['project_name'] ? $myProject['project_name']:'',
				"project_bonus"=>isset($myProject['project_bonus']) && $myProject['project_bonus'] ? $myProject['project_bonus']:'',
				"project_type"=>isset($myProject['project_type']) && $myProject['project_type'] ? $myProject['project_type']:0,
				"project_deadline"=>isset($myProject['project_deadline']) && $myProject['project_deadline'] ? $myProject['project_deadline']:'',
				"project_manager"=>isset($myProject['project_manager']) && $myProject['project_manager'] ? $myProject['project_manager']:'',
				"project_description"=>isset($myProject['project_description']) && $myProject['project_description'] ? $myProject['project_description']:'',
				);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"project_name"=>$this->input->post('project_name'),
					"project_bonus"=>$this->input->post('project_bonus'),
					"project_type"=>$this->input->post('project_type'),
					"project_deadline"=>$this->input->post('project_deadline'),
					"project_manager"=>$this->input->post('project_manager'),
					"project_description"=>$this->input->post('project_description'),
				);	
				if($this->_data['formData']['project_manager'] != 0){
					if($this->mproject->edit($id,$this->_data['formData'])){
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."project/detail".$id."/?redirect=".base64_encode(current_url()));
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'] = "Sửa không thành công";
					}
				}else{
					$this->_data['error'] = "Vui lòng nhập đầy đủ thông tin";
				}
			}

			$this->my_layout->view("cms/project/edit",$this->_data);
		}
		
	}
?>