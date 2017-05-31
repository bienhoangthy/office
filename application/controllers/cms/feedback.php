<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class feedback extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();			
			$this->load->Model("cms/mfeedback");				
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách feedback';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mfeedback->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myFeedback = $this->mfeedback->getData('',array("id"=>$value));
							if($myFeedback['id']>0){								
								$this->mfeedback->delete($value);															
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
			$this->my_layout->view("cms/feedback/index",$this->_data);
		}		
		public function add()
		{
			# code...
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data["title"]  = 'Add';					
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới feedback';
			$this->_data['formData']	= array(
				"feedback_title"=>"",																																					
				"feedback_detail"=>"",												
				"feedback_create_date"=>date("Y-m-d H:i:s"),
				"feedback_status"=>0,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"feedback_title"=>isset($_POST['feedback_title']) && $_POST['feedback_title'] ? $_POST['feedback_title']:'',																				
					"feedback_detail"=>isset($_POST['feedback_detail']) && $_POST['feedback_detail'] ? $_POST['feedback_detail']:'',																																			
					"feedback_status"=>isset($_POST['feedback_status']) && $_POST['feedback_status'] ? $_POST['feedback_status']:'',																				
					"feedback_create_date"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['feedback_title']){
					$insert = $this->mfeedback->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."feedback/");
							header("location:".my_lib::cms_site()."feedback/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			$this->_data['feedback_status'] = $this->mfeedback->dropdownlistStatus($this->_data['formData']['feedback_status']);

			$this->my_layout->view("cms/feedback/add",$this->_data);
		}

		public function popup()
		{
			# code...
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data["title"]  = 'Add';					
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới feedback';
			
			
			$this->_data['formData']	= array(
				"feedback_title"=>isset($_POST['feedback_title']) && $_POST['feedback_title'] ? $_POST['feedback_title']:'',																				
				"feedback_detail"=>isset($_POST['feedback_detail']) && $_POST['feedback_detail'] ? $_POST['feedback_detail']:'',																																			
				"feedback_status"=>0,
				"feedback_create_date"=>date("Y-m-d H:i:s"),
				"user"=>$s_info['s_user_id']
			);	
			if($this->_data['formData']['feedback_title']){
				$myFeedback = $this->mfeedback->getData('',array("feedback_title"=>$this->_data['formData']['feedback_title'],"feedback_detail"=>$this->_data['formData']['feedback_detail']));
				if($myFeedback==NULL)
				{
					$insert = $this->mfeedback->add($this->_data['formData']);

					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Cám ơn bạn đã gửi yêu cầu cho chúng tôi. Sự cố này sẽ được khắc phục trong thời gian sớm nhất.";
						$title = "Feedback gửi từ tài khoản ".$this->_data['s_info']['s_user_username'];
						$this->Msendmail($this->_data['formData']['feedback_title'],config_email_send,config_email_send,$this->_data['s_info']['s_user_email'],$bcc='',$title,$this->_data['formData']['feedback_detail'],$file='');
						$this->_data['formData'] = NULL;					
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}
				else
				{
					$this->_data['error'][] = "Nội dung đã tồn tại. Vui lòng kiểm tra lại thông tin gửi";
				}
				
			}else{
				$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
			}			

			$this->my_layout->view("cms/feedback/popup",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myFeedback = '';
			if(is_numeric($id)){
				$myFeedback = $this->mfeedback->getData('',array("id"=>$id));
				if($myFeedback['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật feedback';
			$this->_data['formData']	= array(
				"feedback_title"=>isset($myFeedback['feedback_title']) && $myFeedback['feedback_title'] ? $myFeedback['feedback_title']:'',															
				"feedback_detail"=>isset($myFeedback['feedback_detail']) && $myFeedback['feedback_detail'] ? $myFeedback['feedback_detail']:'',																							
				"feedback_status"=>isset($myFeedback['feedback_status']) && $myFeedback['feedback_status'] ? $myFeedback['feedback_status']:'',																																								
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"feedback_title"=>isset($_POST['feedback_title']) && $_POST['feedback_title'] ? $_POST['feedback_title']:'',																				
					"feedback_detail"=>isset($_POST['feedback_detail']) && $_POST['feedback_detail'] ? $_POST['feedback_detail']:'',																																			
					"feedback_status"=>isset($_POST['feedback_status']) && $_POST['feedback_status'] ? $_POST['feedback_status']:'',																									
					"feedback_create_date"=>date("Y-m-d H:i:s"),					
				);	
				if($this->_data['formData']['feedback_title']){					
					if($this->mfeedback->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."feedback/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			$this->_data['feedback_status'] = $this->mfeedback->dropdownlistStatus($this->_data['formData']['feedback_status']);

			$this->my_layout->view("cms/feedback/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myFeedback = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myFeedback = $this->mfeedback->getData('',array("id"=>$id));
				if(!isset($myFeedback['id']) || $myFeedback['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mfeedback->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."feedback/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/feedback/delete",$this->_data);
		}
		/**end delete */

		public function detail($id)
		{
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myFeedback = '';
			$this->_data['ortherFeedback'] = '';
			$this->_data['title'] = "Chi tiết";
			if(is_numeric($id)){
				$this->_data['myFeedback'] = $myFeedback = $this->mfeedback->getData('',array("id"=>$id));
				if($myFeedback['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
				$this->_data['ortherFeedback'] = $this->mfeedback->getQuery($object="",$join="","feedback_status!=1 and id != ".$id,"id desc","0,10");
				$this->_data['title'] = $myFeedback['feedback_title'];
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}				
			$this->my_layout->view("cms/feedback/detail",$this->_data);
		}
		
	}
?>