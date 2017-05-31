<?php
	class config extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mconfig");	
		}
		public function index()
		{
			$this->muser->checkPermission('config', 'index');		
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mconfig->getQuery($object="",$join="",$and,$orderby,$limit="");		
			$this->my_layout->view("cms/config/index",$this->_data);
		}		
		public function add()
		{
			$this->muser->checkPermission('config', 'add');
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data["title"]  = 'Add';					
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Add Config';
			$this->_data['formData']	= array(
				"config_name"=>"config_",								
				"config_value"=>"",																										
				"config_note"=>"",																										
				"config_create"=>date("Y-m-d H:i:s"),				
				"user"=>$s_info['s_user_id']						
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"config_name"=>isset($_POST['config_name']) && $_POST['config_name'] ? $_POST['config_name']:'',										
					"config_note"=>isset($_POST['config_note']) && $_POST['config_note'] ? $_POST['config_note']:'',																				
					"config_value"=>isset($_POST['config_value']) && $_POST['config_value'] ? $_POST['config_value']:'',																				
					"config_create"=>date("Y-m-d H:i:s"),					
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['config_name']){
					$myConfigCheck = $this->mconfig->getData('',array("config_name"=>$this->_data['formData']['config_name']));					
					if(isset($myConfigCheck['id']) && $myConfigCheck['id'] > 0){
						$this->_data['error'][] = "Name is exist";
						$this->_data['formData']['config_name'] = "";
					}
					else					
					{
						$insert = $this->mconfig->add($this->_data['formData']);
						if(is_numeric($insert)>0){
							$this->_data['success'][] = "Add success";
							$this->_data['formData'] = NULL;
							/**begin chuyen trang*/
							if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
								header("location:".base64_decode($_REQUEST['redirect']));
							}else{
								// header("location:".my_lib::cms_site()."news/");
								header("location:".my_lib::cms_site()."config/edit/".$insert."/?info=add");
							}
							/**end chuyen trang*/
						}else{
							$this->_data['error'][] = "Add Not Success";
						}
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên";
				}
			}			
			$this->my_layout->view("cms/config/add",$this->_data);
		}

		public function edit($id)
		{
			$this->muser->checkPermission('config', 'edit');
			$myConfig = '';			
			if(is_numeric($id)){
				$myConfig = $this->mconfig->getData('',array("id"=>$id));
				if($myConfig['id']<=0){
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
			$this->_data["title"]  = 'Update';		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['info'] = "";
			if(isset($_REQUEST['info']) && $_REQUEST['info']=="add")
			{
				$this->_data['info'][] = 'Edit success';
			}
			$this->_data["title"]  = 'Edit Config';
			$this->_data['formData']	= array(
				"config_name"=>isset($myConfig['config_name']) ? $myConfig['config_name']:'',												
				"config_note"=>isset($myConfig['config_note']) ? $myConfig['config_note']:'',																
				"config_value"=>isset($myConfig['config_value']) ? $myConfig['config_value']:'',																
				"config_create"=>date("Y-m-d H:i:s"),				
				"user"=>$s_info['s_user_id']						
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"config_name"=>isset($_POST['config_name']) && $_POST['config_name'] ? $_POST['config_name']:'',										
					"config_note"=>isset($_POST['config_note']) && $_POST['config_note'] ? $_POST['config_note']:'',					
					"config_value"=>isset($_POST['config_value']) && $_POST['config_value'] ? $_POST['config_value']:'',					
					"config_create"=>date("Y-m-d H:i:s"),	
					"user"=>$s_info['s_user_id']			
				);	
				if($this->_data['formData']['config_name']){					
					$myConfigCheck = $this->mconfig->getData('',array("id !="=>$id,"config_name"=>$this->_data['formData']['config_name']));					
					if(isset($myConfigCheck['id']) && $myConfigCheck['id'] > 0){
						$this->_data['error'][] = "Name is exist";
						$this->_data['formData']['config_name'] = "";
					}
					else					
					{
						if($this->mconfig->edit($id,$this->_data['formData'])){
							$this->_data['success'][] = "Edit success";
							$this->_data['formData'] = NULL;
							/**begin chuyen trang*/
							if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
								header("location:".base64_decode($_REQUEST['redirect']));
							}else{
								header("location:".my_lib::cms_site()."config/");
							}
							/**end chuyen trang*/
						}else{
							$this->_data['error'][] = "Edit Not Success";
						}
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên";
				}
			}	
			$this->my_layout->view("cms/config/edit",$this->_data);
		}
		/**end them moi*/

		/**begin delete */
		public function delete($id)
		{			
			$this->muser->checkPermission('config', 'delete');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myConfig = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myConfig = $this->mconfig->getData('',array("id"=>$id));
				if($myConfig['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mconfig->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."config/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/config/delete",$this->_data);
		}
		/**end delete */	
	}
?>