<?php
	class department extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mdepartment");	
		}
		public function index()
		{
			$this->muser->checkPermission('department', 'index');		
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data["title"]  = 'Danh sách phòng ban';			
			$and = 'department_parent=0';
			$this->_data['orderby']=$orderby = 'department_order asc';
			$this->_data['list'] = $this->mdepartment->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myDepartment = $this->mdepartment->getData('',array("id"=>$value));
							if($myDepartment['id']>0){								
								$this->mdepartment->delete($value);															
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
			$this->my_layout->view("cms/department/index",$this->_data);
		}		
		public function add()
		{
			$this->muser->checkPermission('department', 'add');
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data["title"]  = 'Add';					
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Add menu';
			$this->_data['formData']	= array(
				"department_name"=>"",								
				"department_parent"=>0,
				"department_note"=>"",																						
				"department_order"=>0,
				"department_create"=>date("Y-m-d H:i:s"),				
				"user"=>$s_info['s_user_id']
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"department_name"=>isset($_POST['department_name']) && $_POST['department_name'] ? $_POST['department_name']:'',										
					"department_parent"=>isset($_POST['department_parent']) && $_POST['department_parent'] ? $_POST['department_parent']:'',															
					"department_note"=>isset($_POST['department_note']) ? $_POST['department_note']:'',
					"department_order"=>isset($_POST['department_order']) ? $_POST['department_order']:0,
					"department_create"=>date("Y-m-d H:i:s"),					
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['department_name']){
					$insert = $this->mdepartment->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."news/");
							header("location:".my_lib::cms_site()."department/edit/".$insert."/?info=add");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên";
				}
			}		
			$this->_data['department_parent'] = $this->mdepartment->dropdownlist($this->_data['formData']['department_parent']);
			$this->my_layout->view("cms/department/add",$this->_data);
		}

		public function edit($id)
		{
			$this->muser->checkPermission('department', 'edit');
			$myDepartment = '';
			if(is_numeric($id)){
				$myDepartment = $this->mdepartment->getData('',array("id"=>$id));
				if($myDepartment['id']<=0){
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
			$this->_data["title"]  = 'Edit menu';
			$this->_data['formData']	= array(
				"department_name"=>isset($myDepartment['department_name']) ? $myDepartment['department_name']:'',																
				"department_note"=>isset($myDepartment['department_note']) ? $myDepartment['department_note']:'',												
				"department_order"=>isset($myDepartment['department_order']) ? $myDepartment['department_order']:0,
				"department_parent"=>isset($myDepartment['department_parent']) ? $myDepartment['department_parent']:0,
				"news_update_date"=>date("Y-m-d H:i:s"),				
				"user"=>$s_info['s_user_id']						
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"department_name"=>isset($_POST['department_name']) && $_POST['department_name'] ? $_POST['department_name']:'',															
					"department_note"=>isset($_POST['department_note']) && $_POST['department_note'] ? $_POST['department_note']:'',
					"department_parent"=>isset($_POST['department_parent']) && $_POST['department_parent'] ? $_POST['department_parent']:'',
					"department_order"=>isset($_POST['department_order']) && $_POST['department_order'] ? $_POST['department_order']:'',
					"department_create"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['department_name']){					
					if($this->mdepartment->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Edit success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."department/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Edit Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên";
				}
			}	
			$this->_data['department_parent'] = $this->mdepartment->dropdownlist($this->_data['formData']['department_parent']);
			$this->my_layout->view("cms/department/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			$this->muser->checkPermission('department', 'delete');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$myDepartment = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myDepartment = $this->mdepartment->getData('',array("id"=>$id));
				if($myDepartment['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mdepartment->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."department/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/department/delete",$this->_data);
		}
		/**end delete */	
	}
?>