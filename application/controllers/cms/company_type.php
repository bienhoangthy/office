<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company_type extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_type");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mcompany_type->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompanyType = $this->mcompany_type->getData('',array("id"=>$value));
							if($myCompanyType['id']>0){								
								$this->mcompany_type->delete($value);															
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
			$this->my_layout->view("cms/company_type/index",$this->_data);
		}		
		public function add()
		{
			# code...
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');							
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới';
			$this->_data['formData']	= array(
				"type_name"=>"",																																																					
				"type_create"=>date("Y-m-d"),
				"type_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"type_name"=>isset($_POST['type_name']) && $_POST['type_name'] ? $_POST['type_name']:'',																																							
					"type_status"=>isset($_POST['type_status']) && $_POST['type_status'] ? $_POST['type_status']:'',																				
					"type_create"=>isset($_POST['type_create']) && $_POST['type_create'] ? $_POST['type_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['type_name']){
					$insert = $this->mcompany_type->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."company_type/");
							header("location:".my_lib::cms_site()."company_type/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_type/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCompanyType = '';
			if(is_numeric($id)){
				$myCompanyType = $this->mcompany_type->getData('',array("id"=>$id));
				if($myCompanyType['id']<=0){
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
				"type_name"=>isset($myCompanyType['type_name']) && $myCompanyType['type_name'] ? $myCompanyType['type_name']:'',																															
				"type_status"=>isset($myCompanyType['type_status']) && $myCompanyType['type_status'] ? $myCompanyType['type_status']:'',																			
				"type_create"=>isset($myCompanyType['type_create']) && $myCompanyType['type_create'] ? $myCompanyType['type_create']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"type_name"=>isset($_POST['type_name']) && $_POST['type_name'] ? $_POST['type_name']:'',																																							
					"type_status"=>isset($_POST['type_status']) && $_POST['type_status'] ? $_POST['type_status']:'',																				
					"type_create"=>isset($_POST['type_create']) && $_POST['type_create'] ? $_POST['type_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['type_name']){					
					if($this->mcompany_type->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_type/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_type/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myCompanyType = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCompanyType = $this->mcompany_type->getData('',array("id"=>$id));
				if(isset($myCompanyType['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcompany_type->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."company_type/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/company_type/delete",$this->_data);
		}
		/**end delete */		
	}
?>