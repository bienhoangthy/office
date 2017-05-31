<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class business extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mbusiness");			
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mbusiness->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myBusiness = $this->mbusiness->getData('',array("id"=>$value));
							if($myBusiness['id']>0){								
								$this->mbusiness->delete($value);															
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
			$this->my_layout->view("cms/business/index",$this->_data);
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
			$this->_data["title"]  = 'Thêm mới';
			$this->_data['formData']	= array(
				"business_name"=>"",																																																	
				"business_create"=>date("Y-m-d"),
				"business_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"business_name"=>isset($_POST['business_name']) && $_POST['business_name'] ? $_POST['business_name']:'',																																		
					"business_status"=>isset($_POST['business_status']) && $_POST['business_status'] ? $_POST['business_status']:'',																				
					"business_create"=>isset($_POST['business_create']) && $_POST['business_create'] ? $_POST['business_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['business_name']){
					$insert = $this->mbusiness->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."business/");
							header("location:".my_lib::cms_site()."business/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/business/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myBusiness = '';
			if(is_numeric($id)){
				$myBusiness = $this->mbusiness->getData('',array("id"=>$id));
				if($myBusiness['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật';
			$this->_data['formData']	= array(
				"business_name"=>isset($myBusiness['business_name']) && $myBusiness['business_name'] ? $myBusiness['business_name']:'',																											
				"business_status"=>isset($myBusiness['business_status']) && $myBusiness['business_status'] ? $myBusiness['business_status']:'',																			
				"business_create"=>isset($myBusiness['business_create']) && $myBusiness['business_create'] ? $myBusiness['business_create']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"business_name"=>isset($_POST['business_name']) && $_POST['business_name'] ? $_POST['business_name']:'',																																		
					"business_status"=>isset($_POST['business_status']) && $_POST['business_status'] ? $_POST['business_status']:'',																				
					"business_create"=>isset($_POST['business_create']) && $_POST['business_create'] ? $_POST['business_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['business_name']){					
					if($this->mbusiness->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."business/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/business/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myBusiness = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myBusiness = $this->mbusiness->getData('',array("id"=>$id));
				if($myBusiness['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mbusiness->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."business/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/business/delete",$this->_data);
		}
		/**end delete */		
	}
?>