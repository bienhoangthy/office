<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company_scale extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_scale");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mcompany_scale->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompanyScale = $this->mcompany_scale->getData('',array("id"=>$value));
							if($myCompanyScale['id']>0){								
								$this->mcompany_scale->delete($value);															
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
			$this->my_layout->view("cms/company_scale/index",$this->_data);
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
				"scale_name"=>"",																																																	
				"scale_create"=>date("Y-m-d"),
				"scale_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"scale_name"=>isset($_POST['scale_name']) && $_POST['scale_name'] ? $_POST['scale_name']:'',																																		
					"scale_status"=>isset($_POST['scale_status']) && $_POST['scale_status'] ? $_POST['scale_status']:'',																				
					"scale_create"=>isset($_POST['scale_create']) && $_POST['scale_create'] ? $_POST['scale_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['scale_name']){
					$insert = $this->mcompany_scale->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."company_scale/");
							header("location:".my_lib::cms_site()."company_scale/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_scale/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCompanyScale = '';
			if(is_numeric($id)){
				$myCompanyScale = $this->mcompany_scale->getData('',array("id"=>$id));
				if($myCompanyScale['id']<=0){
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
				"scale_name"=>isset($myCompanyScale['scale_name']) && $myCompanyScale['scale_name'] ? $myCompanyScale['scale_name']:'',																											
				"scale_status"=>isset($myCompanyScale['scale_status']) && $myCompanyScale['scale_status'] ? $myCompanyScale['scale_status']:'',																			
				"scale_create"=>isset($myCompanyScale['scale_create']) && $myCompanyScale['scale_create'] ? $myCompanyScale['scale_create']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"scale_name"=>isset($_POST['scale_name']) && $_POST['scale_name'] ? $_POST['scale_name']:'',																																		
					"scale_status"=>isset($_POST['scale_status']) && $_POST['scale_status'] ? $_POST['scale_status']:'',																				
					"scale_create"=>isset($_POST['scale_create']) && $_POST['scale_create'] ? $_POST['scale_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['scale_name']){					
					if($this->mcompany_scale->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_scale/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_scale/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myCompanyScale = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCompanyScale = $this->mcompany_scale->getData('',array("id"=>$id));
				if(isset($myCompanyScale['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcompany_scale->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."company_scale/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/company_scale/delete",$this->_data);
		}
		/**end delete */		
	}
?>