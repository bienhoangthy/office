<?php
	class calendar extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();						
			$this->load->Model("cms/mcalendar");				
		}

		public function index()
		{
			$this->_data['title'] = 'Lịch book nghỉ phép nhân viên';
			$this->my_layout->view("cms/calendar/calendar",$this->_data);
		}

		public function booklist()
		{	
			$this->muser->checkPermission('calendar', 'booklist');  			
			$this->_data["title"]  = 'Danh sách lịch book nghỉ';			
			$this->_data['formData'] = array(
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
			);
			$and = ' 1 ';				

			// my_lib::printArr($_SERVER);
			
			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'calendar/?'.$query_string.'&page=';			
			/*end phan trang*/

			$this->_data['orderby']=$orderby = 'id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->mcalendar->getQuery($object="",$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->mcalendar->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompany = $this->mcalendar->getData('',array("id"=>$value));
							if($myCompany['id']>0){								
								$this->mcalendar->delete($value);
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

			$this->my_layout->view("cms/calendar/index",$this->_data);
		}		
		public function add()
		{												
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Book lịch nghỉ';
			$this->_data['formData']	= array(																		
				"calendar_startday"=>date("Y-m-d"),
				"calendar_endday"=>date("Y-m-d"),
				"calendar_note"=>""	
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"calendar_startday"=>$this->input->post('calendar_startday'),
					"calendar_endday"=>$this->input->post('calendar_endday'),
					"calendar_status"=>1,
					"calendar_note"=>$this->input->post('calendar_note'),
					"user_id"=>$this->_data['s_info']['s_user_id'],
					"calendar_createday"=>date("Y-m-d")
				);	
				$insert = $this->mcalendar->add($this->_data['formData']);
				if(is_numeric($insert)>0){
					$this->_data['success'][] = "Add success";
					$this->_data['formData'] = NULL;
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						// header("location:".my_lib::cms_site()."calendar/");
						header("location:".my_lib::cms_site()."calendar/edit/".$insert."/");
					}
					/**end chuyen trang*/
				}else{
					$this->_data['error'][] = "Add Not Success";
				}
			}
			$this->my_layout->view("cms/calendar/add",$this->_data);
		}				

		public function edit($id)
		{
			$myCalendar = '';
			if(is_numeric($id)){
				$myCalendar = $this->mcalendar->getData('',array("id"=>$id));
				if($myCalendar['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$this->_data['s_info'] = $this->session->userdata('userInfo');
			if ($myCalendar['user_id'] != $this->_data['s_info']['s_user_id'] && $this->_data['s_info']['s_user_group'] != 1 && $this->_data['s_info']['s_user_group'] != 5) {
				header("location:".my_lib::cms_site().'error/permission');
				exit();
			}
			$this->_data['id'] = $id;
			$this->_data['status'] = $myCalendar['calendar_status'];
			$myUser = $this->muser->getData("",array("id"=>$myCalendar['user_id']));
            $this->_data['user_fullname'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:''; 
			$this->_data['type'] = isset($_REQUEST['type']) ? $_REQUEST['type'] :'';			
			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật book nghĩ phép';
			$this->_data['formData']	= array(
				"calendar_startday"=>$myCalendar['calendar_startday'],
				"calendar_endday"=>$myCalendar['calendar_endday'],
				"calendar_note"=>$myCalendar['calendar_note']		
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"calendar_startday"=>$this->input->post('calendar_startday'),
					"calendar_endday"=>$this->input->post('calendar_endday'),
					"calendar_note"=>$this->input->post('calendar_note')					
				);	
				if($this->mcalendar->edit($id,$this->_data['formData'])){
					$this->_data['formData'] = NULL;
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."calendar/");
					}
					/**end chuyen trang*/
				}else{
					$this->_data['error'][] = "Edit Not Success";
				}
			}
			$this->my_layout->view("cms/calendar/add",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{	
			$this->muser->checkPermission('calendar', 'delete'); 	
			$myCalendar = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCalendar = $this->mcalendar->getData('',array("id"=>$id));
				if(isset($myCalendar['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcalendar->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."calendar/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/calendar/delete",$this->_data);
		}
		/**end delete */

		public function allow($id)
		{
			$this->muser->checkPermission('calendar', 'allow');
			if(is_numeric($id)){
				$myCalendar = $this->mcalendar->getData('id,calendar_status',array("id"=>$id));
				if(isset($myCalendar['id'])<=0 || $myCalendar['calendar_status'] != 1){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcalendar->edit($id,array('calendar_status' => 2));
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."calendar/edit/".$id);
					}								
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
		}

		public function aj_LoadCalendar()
		{						
			$start = isset($_POST['start']) ? date("Y-m-d",$_POST['start']):date("Y-m-d");
			$end = $start == "" ? date("Y-m-d"):date("Y-m-d",($_POST['end'] +(30*24*60*60)));
			$and = 'calendar_startday >= "'.$start.'" and calendar_endday <= "'.$end.'"';
			$result = $this->mcalendar->getQuery("","",$and,"id desc","");		
			$rs = array();				
	        if($result)
	        {
	            foreach ($result as $key => $value) {
	                $row_array['id'] = $value['id']; 
	                $myUser = $this->muser->getData("",array("id"=>$value['user_id']));
                    $value['user_id'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';  
                    if ($value['calendar_status'] == 1) {
                     	$row_array['title'] = $value['user_id'].' - Chưa duyệt'; 
                     } else {
                     	$row_array['title'] = $value['user_id'].' - Đã duyệt'; 
                     }               	                             
	                $row_array['start'] = str_replace("-", ",",$value["calendar_startday"]);                              
	                $row_array['end'] = str_replace("-", ",",$value["calendar_endday"]);   
	                $status = $this->mcalendar->listStatus($value['calendar_status']);
	                $row_array['color'] = $status["color"];
	                $row_array['detail'] = $value["calendar_note"];
	                array_push($rs, $row_array);                        
	            }
	        }            
	        echo json_encode($rs);
		}	
				
	}
?>