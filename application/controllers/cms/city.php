<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class city extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcity");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mcity->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCity = $this->mcity->getData('',array("id"=>$value));
							if($myCity['id']>0){								
								$this->mcity->delete($value);															
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
			$this->my_layout->view("cms/city/index",$this->_data);
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
				"city_name"=>"",																																																	
				"city_create"=>date("Y-m-d"),
				"city_status"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"city_name"=>isset($_POST['city_name']) && $_POST['city_name'] ? $_POST['city_name']:'',																																		
					"city_status"=>isset($_POST['city_status']) && $_POST['city_status'] ? $_POST['city_status']:'',																				
					"city_create"=>isset($_POST['city_create']) && $_POST['city_create'] ? $_POST['city_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['city_name']){
					$insert = $this->mcity->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."city/");
							header("location:".my_lib::cms_site()."city/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/city/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCity = '';
			if(is_numeric($id)){
				$myCity = $this->mcity->getData('',array("id"=>$id));
				if($myCity['id']<=0){
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
				"city_name"=>isset($myCity['city_name']) && $myCity['city_name'] ? $myCity['city_name']:'',																											
				"city_status"=>isset($myCity['city_status']) && $myCity['city_status'] ? $myCity['city_status']:'',																			
				"city_create"=>isset($myCity['city_create']) && $myCity['city_create'] ? $myCity['city_create']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"city_name"=>isset($_POST['city_name']) && $_POST['city_name'] ? $_POST['city_name']:'',																																		
					"city_status"=>isset($_POST['city_status']) && $_POST['city_status'] ? $_POST['city_status']:'',																				
					"city_create"=>isset($_POST['city_create']) && $_POST['city_create'] ? $_POST['city_create']:'',																														
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['city_name']){					
					if($this->mcity->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."city/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/city/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myCity = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCity = $this->mcity->getData('',array("id"=>$id));
				if(isset($myCity['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcity->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."city/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/city/delete",$this->_data);
		}
		/**end delete */		
	}
?>