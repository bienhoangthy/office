<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company_sector extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_sector");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = 'sector_parent = 0';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mcompany_sector->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompanySector = $this->mcompany_sector->getData('',array("id"=>$value));
							if($myCompanySector['id']>0){								
								$this->mcompany_sector->delete($value);															
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

			
			$this->my_layout->view("cms/company_sector/index",$this->_data);
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
				"sector_name"=>"",																																																	
				"sector_create"=>date("Y-m-d"),
				"sector_status"=>1,
				"sector_parent"=>0,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"sector_name"=>isset($_POST['sector_name']) && $_POST['sector_name'] ? $_POST['sector_name']:'',																																		
					"sector_status"=>isset($_POST['sector_status']) && $_POST['sector_status'] ? $_POST['sector_status']:'',																				
					"sector_create"=>isset($_POST['sector_create']) && $_POST['sector_create'] ? $_POST['sector_create']:'',																														
					"sector_parent"=>isset($_POST['sector_parent']) && $_POST['sector_parent'] ? $_POST['sector_parent']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['sector_name']){
					$insert = $this->mcompany_sector->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."company_sector/");
							header("location:".my_lib::cms_site()."company_sector/edit/".$insert."/");
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
			$this->_data['parent'] = $this->mcompany_sector->dropdownlist($this->_data['formData']['sector_parent']);
			/**end com parent*/
			$this->my_layout->view("cms/company_sector/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCompanySector = '';
			if(is_numeric($id)){
				$myCompanySector = $this->mcompany_sector->getData('',array("id"=>$id));
				if($myCompanySector['id']<=0){
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
				"sector_name"=>isset($myCompanySector['sector_name']) && $myCompanySector['sector_name'] ? $myCompanySector['sector_name']:'',																											
				"sector_status"=>isset($myCompanySector['sector_status']) && $myCompanySector['sector_status'] ? $myCompanySector['sector_status']:'',																			
				"sector_create"=>isset($myCompanySector['sector_create']) && $myCompanySector['sector_create'] ? $myCompanySector['sector_create']:'',																			
				"sector_parent"=>isset($myCompanySector['sector_parent']) && $myCompanySector['sector_parent'] ? $myCompanySector['sector_parent']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"sector_name"=>isset($_POST['sector_name']) && $_POST['sector_name'] ? $_POST['sector_name']:'',																																		
					"sector_status"=>isset($_POST['sector_status']) && $_POST['sector_status'] ? $_POST['sector_status']:'',																				
					"sector_create"=>isset($_POST['sector_create']) && $_POST['sector_create'] ? $_POST['sector_create']:'',																														
					"sector_parent"=>isset($_POST['sector_parent']) && $_POST['sector_parent'] ? $_POST['sector_parent']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['sector_name']){					
					if($this->mcompany_sector->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_sector/");
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
			$this->_data['parent'] = $this->mcompany_sector->dropdownlist($this->_data['formData']['sector_parent']);
			/**end com parent*/
			$this->my_layout->view("cms/company_sector/edit",$this->_data);
		}
		/**end them moi */

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$myCompanySector = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCompanySector = $this->mcompany_sector->getData('',array("id"=>$id));
				if($myCompanySector['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{
					/**bein check parent*/
					$myCount = $this->mcompany_sector->countQuery("","sector_parent=".$id);					
					if($myCount==0){
						$this->mcompany_sector->delete($id);
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_sector/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Đây là danh mục cấp cha không thể xóa ! Click <a href='javascript:javascript:history.go(-1)'>vào đây</a> để quay lại.";
					}
					/**end check parent*/					
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/company_sector/delete",$this->_data);
		}
		/**end delete */		
	}
?>