<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company_status extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_status");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'cst_order asc, id asc';
			$this->_data['list'] = $this->mcompany_status->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompanyStatus = $this->mcompany_status->getData('',array("id"=>$value));
							if($myCompanyStatus['id']>0){								
								$this->mcompany_status->delete($value);															
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
			$this->my_layout->view("cms/company_status/index",$this->_data);
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
				"cst_name"=>"",																																																	
				"cst_note"=>"",																																																	
				"cst_order"=>0,																																																	
				"cst_create"=>date("Y-m-d"),
				"cst_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"cst_name"=>isset($_POST['cst_name']) && $_POST['cst_name'] ? $_POST['cst_name']:'',																																		
					"cst_note"=>isset($_POST['cst_note']) && $_POST['cst_note'] ? $_POST['cst_note']:'',																																		
					"cst_status"=>isset($_POST['cst_status']) && $_POST['cst_status'] ? $_POST['cst_status']:'',																				
					"cst_order"=>isset($_POST['cst_order']) && $_POST['cst_order'] ? $_POST['cst_order']:'',																				
					"cst_create"=>isset($_POST['cst_create']) && $_POST['cst_create'] ? $_POST['cst_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['cst_name']){
					$insert = $this->mcompany_status->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."company_status/");
							header("location:".my_lib::cms_site()."company_status/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_status/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCompanyStatus = '';
			if(is_numeric($id)){
				$myCompanyStatus = $this->mcompany_status->getData('',array("id"=>$id));
				if($myCompanyStatus['id']<=0){
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
				"cst_name"=>isset($myCompanyStatus['cst_name']) && $myCompanyStatus['cst_name'] ? $myCompanyStatus['cst_name']:'',																											
				"cst_note"=>isset($myCompanyStatus['cst_note']) && $myCompanyStatus['cst_note'] ? $myCompanyStatus['cst_note']:'',																											
				"cst_status"=>isset($myCompanyStatus['cst_status']) && $myCompanyStatus['cst_status'] ? $myCompanyStatus['cst_status']:'',																			
				"cst_create"=>isset($myCompanyStatus['cst_create']) && $myCompanyStatus['cst_create'] ? $myCompanyStatus['cst_create']:'',																			
				"cst_order"=>isset($myCompanyStatus['cst_order']) && $myCompanyStatus['cst_order'] ? $myCompanyStatus['cst_order']:0,																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"cst_name"=>isset($_POST['cst_name']) && $_POST['cst_name'] ? $_POST['cst_name']:'',																																		
					"cst_note"=>isset($_POST['cst_note']) && $_POST['cst_note'] ? $_POST['cst_note']:'',																																		
					"cst_status"=>isset($_POST['cst_status']) && $_POST['cst_status'] ? $_POST['cst_status']:'',																				
					"cst_create"=>isset($_POST['cst_create']) && $_POST['cst_create'] ? $_POST['cst_create']:'',																														
					"cst_order"=>isset($_POST['cst_order']) && $_POST['cst_order'] ? $_POST['cst_order']:0,																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['cst_name']){					
					if($this->mcompany_status->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_status/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_status/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myCompanyStatus = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCompanyStatus = $this->mcompany_status->getData('',array("id"=>$id));
				if(isset($myCompanyStatus['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcompany_status->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."company_status/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/company_status/delete",$this->_data);
		}
		/**end delete */
	}
?>