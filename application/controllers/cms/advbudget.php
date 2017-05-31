<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class advbudget extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();			
			$this->load->Model("cms/madvbudget");						
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách ';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->madvbudget->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myAdvbudget = $this->madvbudget->getData('',array("id"=>$value));
							if($myAdvbudget['id']>0){								
								$this->madvbudget->delete($value);															
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
			$this->my_layout->view("cms/advbudget/index",$this->_data);
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
			$this->_data["title"]  = 'Thêm mới ';
			$this->_data['formData']	= array(
				"adv_budget_name"=>"",																																																	
				"adv_budget_create"=>date("Y-m-d"),
				"adv_budget_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"adv_budget_name"=>isset($_POST['adv_budget_name']) && $_POST['adv_budget_name'] ? $_POST['adv_budget_name']:'',																																		
					"adv_budget_status"=>isset($_POST['adv_budget_status']) && $_POST['adv_budget_status'] ? $_POST['adv_budget_status']:'',																				
					"adv_budget_create"=>isset($_POST['adv_budget_create']) && $_POST['adv_budget_create'] ? $_POST['adv_budget_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['adv_budget_name']){
					$insert = $this->madvbudget->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."advbudget/");
							header("location:".my_lib::cms_site()."advbudget/edit/".$insert."/");
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
			/**end com more*/

			$this->my_layout->view("cms/advbudget/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myAdvbudget = '';
			if(is_numeric($id)){
				$myAdvbudget = $this->madvbudget->getData('',array("id"=>$id));
				if($myAdvbudget['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật ';
			$this->_data['formData']	= array(
				"adv_budget_name"=>isset($myAdvbudget['adv_budget_name']) && $myAdvbudget['adv_budget_name'] ? $myAdvbudget['adv_budget_name']:'',																											
				"adv_budget_status"=>isset($myAdvbudget['adv_budget_status']) && $myAdvbudget['adv_budget_status'] ? $myAdvbudget['adv_budget_status']:'',																			
				"adv_budget_create"=>isset($myAdvbudget['adv_budget_create']) && $myAdvbudget['adv_budget_create'] ? $myAdvbudget['adv_budget_create']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"adv_budget_name"=>isset($_POST['adv_budget_name']) && $_POST['adv_budget_name'] ? $_POST['adv_budget_name']:'',																																		
					"adv_budget_status"=>isset($_POST['adv_budget_status']) && $_POST['adv_budget_status'] ? $_POST['adv_budget_status']:'',																				
					"adv_budget_create"=>isset($_POST['adv_budget_create']) && $_POST['adv_budget_create'] ? $_POST['adv_budget_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['adv_budget_name']){					
					if($this->madvbudget->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."advbudget/");
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
			/**end com parent*/

			$this->my_layout->view("cms/advbudget/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myAdvbudget = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myAdvbudget = $this->madvbudget->getData('',array("id"=>$id));
				if($myAdvbudget['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->madvbudget->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."advbudget/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/advbudget/delete",$this->_data);
		}
		/**end delete */

		
		
	}
?>