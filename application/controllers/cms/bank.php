<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class bank extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mbank");		
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mbank->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myBank = $this->mbank->getData('',array("id"=>$value));
							if($myBank['id']>0){								
								$this->mbank->delete($value);															
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
			$this->my_layout->view("cms/bank/index",$this->_data);
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
				"bank_name"=>"",																																																	
				"bank_create"=>date("Y-m-d"),
				"bank_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"bank_name"=>isset($_POST['bank_name']) && $_POST['bank_name'] ? $_POST['bank_name']:'',																																		
					"bank_status"=>isset($_POST['bank_status']) && $_POST['bank_status'] ? $_POST['bank_status']:'',																				
					"bank_create"=>isset($_POST['bank_create']) && $_POST['bank_create'] ? $_POST['bank_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['bank_name']){
					$insert = $this->mbank->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."bank/");
							header("location:".my_lib::cms_site()."bank/edit/".$insert."/");
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

			$this->my_layout->view("cms/bank/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myBank = '';
			if(is_numeric($id)){
				$myBank = $this->mbank->getData('',array("id"=>$id));
				if($myBank['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật';
			$this->_data['formData']	= array(
				"bank_name"=>isset($myBank['bank_name']) && $myBank['bank_name'] ? $myBank['bank_name']:'',																											
				"bank_status"=>isset($myBank['bank_status']) && $myBank['bank_status'] ? $myBank['bank_status']:'',																			
				"bank_create"=>isset($myBank['bank_create']) && $myBank['bank_create'] ? $myBank['bank_create']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"bank_name"=>isset($_POST['bank_name']) && $_POST['bank_name'] ? $_POST['bank_name']:'',																																		
					"bank_status"=>isset($_POST['bank_status']) && $_POST['bank_status'] ? $_POST['bank_status']:'',																				
					"bank_create"=>isset($_POST['bank_create']) && $_POST['bank_create'] ? $_POST['bank_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['bank_name']){					
					if($this->mbank->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."bank/");
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

			$this->my_layout->view("cms/bank/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myBank = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myBank = $this->mbank->getData('',array("id"=>$id));
				if($myBank['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mbank->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."bank/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/bank/delete",$this->_data);
		}
		/**end delete */

		
		
	}
?>