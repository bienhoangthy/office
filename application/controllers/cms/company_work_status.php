<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company_work_status extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_work_status");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mcompany_work_status->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompanyWorkStatus = $this->mcompany_work_status->getData('',array("id"=>$value));
							if($myCompanyWorkStatus['id']>0){								
								$this->mcompany_work_status->delete($value);															
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
			$this->my_layout->view("cms/company_work_status/index",$this->_data);
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
				"wk_name"=>"",																																																	
				"wk_color"=>"",
				"wk_bg"=>"",
				"wk_icon"=>"",
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"wk_name"=>$this->input->post('wk_name'),
					"wk_bg"=>$this->input->post('wk_bg'),
					"wk_color"=>$this->input->post('wk_color'),
					"wk_icon"=>$this->input->post('wk_icon'),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['wk_name']){
					$insert = $this->mcompany_work_status->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."company_work_status/");
							header("location:".my_lib::cms_site()."company_work_status/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_work_status/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCompanyWorkStatus = '';
			if(is_numeric($id)){
				$myCompanyWorkStatus = $this->mcompany_work_status->getData('',array("id"=>$id));
				if($myCompanyWorkStatus['id']<=0){
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
				"wk_name"=>isset($myCompanyWorkStatus['wk_name']) && $myCompanyWorkStatus['wk_name'] ? $myCompanyWorkStatus['wk_name']:'',																											
				"wk_bg"=>isset($myCompanyWorkStatus['wk_bg']) && $myCompanyWorkStatus['wk_bg'] ? $myCompanyWorkStatus['wk_bg']:'',																			
				"wk_color"=>isset($myCompanyWorkStatus['wk_color']) && $myCompanyWorkStatus['wk_color'] ? $myCompanyWorkStatus['wk_color']:'',																			
				"wk_icon"=>isset($myCompanyWorkStatus['wk_icon']) && $myCompanyWorkStatus['wk_icon'] ? $myCompanyWorkStatus['wk_icon']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"wk_name"=>$this->input->post('wk_name'),
					"wk_bg"=>$this->input->post('wk_bg'),
					"wk_color"=>$this->input->post('wk_color'),	
					"wk_icon"=>$this->input->post('wk_icon'),	
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['wk_name']){					
					if($this->mcompany_work_status->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_work_status/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_work_status/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myCompanyWorkStatus = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCompanyWorkStatus = $this->mcompany_work_status->getData('',array("id"=>$id));
				if(isset($myCompanyWorkStatus['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcompany_work_status->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."company_work_status/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/company_work_status/delete",$this->_data);
		}
		/**end delete */		
	}
?>