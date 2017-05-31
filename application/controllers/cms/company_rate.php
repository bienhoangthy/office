<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company_rate extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_rate");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mcompany_rate->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompanyRate = $this->mcompany_rate->getData('',array("id"=>$value));
							if($myCompanyRate['id']>0){								
								$this->mcompany_rate->delete($value);															
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
			$this->my_layout->view("cms/company_rate/index",$this->_data);
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
				"rate_name"=>"",																																																	
				"rate_color"=>"",																																																	
				"rate_parent"=>1,																																																	
				"rate_create"=>date("Y-m-d"),
				"rate_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"rate_name"=>$this->input->post('rate_name'),
					"rate_status"=>$this->input->post('rate_status'),
					"rate_parent"=>$this->input->post('rate_parent'),
					"rate_create"=>$this->input->post('rate_create'),
					"rate_color"=>$this->input->post('rate_color'),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['rate_name']){
					$insert = $this->mcompany_rate->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."company_rate/");
							header("location:".my_lib::cms_site()."company_rate/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_rate/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCompanyRate = '';
			if(is_numeric($id)){
				$myCompanyRate = $this->mcompany_rate->getData('',array("id"=>$id));
				if($myCompanyRate['id']<=0){
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
				"rate_name"=>isset($myCompanyRate['rate_name']) && $myCompanyRate['rate_name'] ? $myCompanyRate['rate_name']:'',																											
				"rate_status"=>isset($myCompanyRate['rate_status']) && $myCompanyRate['rate_status'] ? $myCompanyRate['rate_status']:'',																			
				"rate_parent"=>isset($myCompanyRate['rate_parent']) && $myCompanyRate['rate_parent'] ? $myCompanyRate['rate_parent']:'',																			
				"rate_create"=>isset($myCompanyRate['rate_create']) && $myCompanyRate['rate_create'] ? $myCompanyRate['rate_create']:'',																			
				"rate_color"=>isset($myCompanyRate['rate_color']) && $myCompanyRate['rate_color'] ? $myCompanyRate['rate_color']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"rate_name"=>$this->input->post('rate_name'),
					"rate_status"=>$this->input->post('rate_status'),
					"rate_parent"=>$this->input->post('rate_parent'),
					"rate_create"=>$this->input->post('rate_create'),
					"rate_color"=>$this->input->post('rate_color'),																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['rate_name']){					
					if($this->mcompany_rate->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_rate/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_rate/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myCompanyRate = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCompanyRate = $this->mcompany_rate->getData('',array("id"=>$id));
				if(isset($myCompanyRate['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcompany_rate->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."company_rate/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/company_rate/delete",$this->_data);
		}
		/**end delete */		
	}
?>