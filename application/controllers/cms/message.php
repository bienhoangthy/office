<?php
	class message extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();		
			$this->load->Model("cms/mmessage");	
		}
		public function index()
		{
			$this->muser->checkPermission('message', 'index');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách thông báo';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mmessage->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myMessage = $this->mmessage->getData('',array("id"=>$value));
							if($myMessage['id']>0){								
								$this->mmessage->delete($value);															
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
			$this->my_layout->view("cms/message/index",$this->_data);
		}		
		public function add()
		{
			$this->muser->checkPermission('message', 'add');
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data["title"]  = 'Add';					
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới thông báo';
			$this->_data['formData']	= array(
				"ms_title"=>"",																																					
				"ms_content"=>"",
				"ms_group"=>"",
				"ms_department"=>"",
				"ms_userid"=>"",
				"ms_create_date"=>date("Y-m-d"),
				"ms_end_date"=>date("Y-m-d"),
				"ms_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){	
				$file_name = "";
				if (isset($_FILES['_file'])) {
					if (move_uploaded_file($_FILES['_file']['tmp_name'], $this->mmessage->getUploadPath().$_FILES['_file']['name'])) {
						$file_name = $_FILES['_file']['name'];
					}
				}			
				$this->_data['formData']	= array(
					"ms_title"=>isset($_POST['ms_title']) && $_POST['ms_title'] ? $_POST['ms_title']:'',																				
					"ms_content"=>isset($_POST['ms_content']) && $_POST['ms_content'] ? $_POST['ms_content']:'',																				
					"ms_group"=>isset($_POST['ms_group']) && $_POST['ms_group'] ? $_POST['ms_group']:'',																				
					"ms_department"=>isset($_POST['ms_department']) && $_POST['ms_department'] ? $_POST['ms_department']:'',																				
					"ms_userid"=>isset($_POST['ms_userid']) && $_POST['ms_userid'] ? $_POST['ms_userid']:'',																				
					"ms_status"=>isset($_POST['ms_status']) && $_POST['ms_status'] ? $_POST['ms_status']:'',																				
					"ms_file"=>$file_name,																				
					"ms_end_date"=>isset($_POST['ms_end_date']) && $_POST['ms_end_date'] ? $_POST['ms_end_date']:'',																									
					"ms_create_date"=>isset($_POST['ms_create_date']) && $_POST['ms_create_date'] ? $_POST['ms_create_date']:'',																									
					"ms_update_date"=>date("Y-m-d"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['ms_title']){
					$insert = $this->mmessage->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						//Push Notification
						$img = my_lib::base_url().'media/user/'.$s_info['s_user_avatar'];
						$this->mmessage->sendMessage($this->_data['formData']['ms_title'],my_lib::cms_site()."message/detail/".$insert,$img);

						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."message/");
							header("location:".my_lib::cms_site()."message/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			/**begin com more*/
			$this->_data['ms_department'] = $this->mdepartment->dropdownlist($this->_data['formData']['ms_department']);
			$this->_data['ms_group'] = $this->mgroup->dropdownlist($this->_data['formData']['ms_group']);
			/**end com more*/

			$this->my_layout->view("cms/message/add",$this->_data);
		}

		public function edit($id)
		{
			$this->muser->checkPermission('message', 'edit');
			$myMessage = '';
			if(is_numeric($id)){
				$myMessage = $this->mmessage->getData('',array("id"=>$id));
				if($myMessage['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}

			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật thông báo';
			$this->_data['formData']	= array(
				"ms_title"=>isset($myMessage['ms_title']) && $myMessage['ms_title'] ? $myMessage['ms_title']:'',															
				"ms_content"=>isset($myMessage['ms_content']) && $myMessage['ms_content'] ? $myMessage['ms_content']:'',															
				"ms_department"=>isset($myMessage['ms_department']) && $myMessage['ms_department'] ? $myMessage['ms_department']:'',															
				"ms_group"=>isset($myMessage['ms_group']) && $myMessage['ms_group'] ? $myMessage['ms_group']:'',																			
				"ms_userid"=>isset($myMessage['ms_userid']) && $myMessage['ms_userid'] ? $myMessage['ms_userid']:'',																			
				"ms_status"=>isset($myMessage['ms_status']) && $myMessage['ms_status'] ? $myMessage['ms_status']:'',																			
				"ms_end_date"=>isset($myMessage['ms_end_date']) && $myMessage['ms_end_date'] ? $myMessage['ms_end_date']:'',																			
				"ms_file"=>isset($myMessage['ms_file']) && $myMessage['ms_file'] ? $myMessage['ms_file']:'',																			
				"ms_create_date"=>isset($myMessage['ms_create_date']) && $myMessage['ms_create_date'] ? $myMessage['ms_create_date']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$file_name = $this->_data['formData']['ms_file'];
				if (isset($_FILES['_file'])) {
					move_uploaded_file($_FILES['_file']['tmp_name'], $this->mmessage->getUploadPath().$_FILES['_file']['name']);
					$file_name = $_FILES['_file']['name'];
					if (file_exists(my_lib::base_url().'media/message/'.$myMessage['ms_file'])) {
						unlink(my_lib::base_url().'media/message/'.$myMessage['ms_file']);
					}
				}
				$this->_data['formData']	= array(
					"ms_title"=>isset($_POST['ms_title']) && $_POST['ms_title'] ? $_POST['ms_title']:'',																				
					"ms_content"=>isset($_POST['ms_content']) && $_POST['ms_content'] ? $_POST['ms_content']:'',																				
					"ms_group"=>isset($_POST['ms_group']) && $_POST['ms_group'] ? $_POST['ms_group']:'',																				
					"ms_department"=>isset($_POST['ms_department']) && $_POST['ms_department'] ? $_POST['ms_department']:'',																				
					"ms_userid"=>isset($_POST['ms_userid']) && $_POST['ms_userid'] ? $_POST['ms_userid']:'',																				
					"ms_status"=>isset($_POST['ms_status']) && $_POST['ms_status'] ? $_POST['ms_status']:'',																				
					"ms_end_date"=>isset($_POST['ms_end_date']) && $_POST['ms_end_date'] ? $_POST['ms_end_date']:'',																				
					"ms_file"=>$file_name,																				
					"ms_create_date"=>isset($_POST['ms_create_date']) && $_POST['ms_create_date'] ? $_POST['ms_create_date']:'',																									
					"ms_update_date"=>date("Y-m-d"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['ms_title']){					
					if($this->mmessage->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."message/");
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
			$this->_data['ms_department'] = $this->mdepartment->dropdownlist($this->_data['formData']['ms_department']);
			$this->_data['ms_group'] = $this->mgroup->dropdownlist($this->_data['formData']['ms_group']);
			/**end com parent*/

			$this->my_layout->view("cms/message/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			$this->muser->checkPermission('message', 'delete');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myMessage = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myMessage = $this->mmessage->getData('',array("id"=>$id));
				if($myMessage['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mmessage->delete($id);
					unlink($this->mmessage->getUploadPath().$myMessage['ms_file']);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."message/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/message/delete",$this->_data);
		}
		/**end delete */

		public function detail($id)
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myMessage = '';
			$this->_data['ortherMessage'] = '';
			$this->_data['title'] = "Chi tiết";
			if(is_numeric($id)){
				$this->_data['myMessage'] = $myMessage = $this->mmessage->getData('',array("id"=>$id));
				if($myMessage['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
				$this->_data['ortherMessage'] = $this->mmessage->getQuery($object="",$join="","ms_status=1 and id != ".$id,"id desc","0,10");
				$this->_data['title'] = $myMessage['ms_title'];
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}				
			$this->my_layout->view("cms/message/detail",$this->_data);
		}

		public function pushNotification()
		{
			$this->muser->checkPermission('message', 'pushNotification');
			$this->_data['title'] = "Push Notification";
			$this->_data['listUserPush'] = $this->muser->getQuery("user_fullname,user_push_id","","user_status = 1 and user_push_id <> ''","id asc","");
			if (isset($_POST['fsubmit'])) {
				$s_info = $this->session->userdata('userInfo');
				$img = my_lib::base_url().'media/user/'.$s_info['s_user_avatar'];
				$title = $s_info['s_user_fullname'].': '.$this->input->post('title');
				$send_user = $this->input->post('user_push_id');
				if ($send_user == "all") {
					$send = $this->mmessage->sendMessage($title,$this->input->post('link'));
					$send = json_decode($send, true);
					if ($send['recipients'] > 0) {
						$this->_data['success'] = "Đã gửi thành công!";
					} else {
						$this->_data['error'] = "Lỗi! Gửi không thành công.";
					}
					
				} else {
					$this->load->Model("cms/mtask");
					$send_user = array($send_user);	
					$send = $this->mtask->sendMessage($send_user,$title,$this->input->post('link'));
					$send = json_decode($send, true);
					if ($send['recipients'] > 0) {
						$this->_data['success'] = "Đã gửi thành công!";
					} else {
						$this->_data['error'] = "Lỗi! Gửi không thành công.";
					}
				}
			}
			$this->my_layout->view("cms/message/push",$this->_data);
		}
		
	}
?>