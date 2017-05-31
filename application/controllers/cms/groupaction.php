<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class groupaction extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mgroupaction");	
		}
		public function index()
		{
			$this->muser->checkPermission('groupaction', 'index');	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');		
			$this->_data["title"]  = 'Danh sách';			
			$and = '';
			$this->_data['orderby']=$orderby = 'gc_value asc';
			$this->_data['list'] = $this->mgroupaction->getQuery($object="",$join="",$and,$orderby,$limit="");		
			$this->my_layout->view("cms/groupaction/index",$this->_data);
		}		
		public function add()
		{
			$this->muser->checkPermission('groupaction', 'add');
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');		
			$this->_data["title"]  = 'Add';					
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Add Group Action';
			$this->_data['formData']	= array(
				"gc_name"=>"",								
				"gc_value"=>"",																						
				"gc_order"=>0,
				"gc_create"=>date("Y-m-d H:i:s"),				
				"user"=>$s_info['s_user_id']							
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"gc_name"=>isset($_POST['gc_name']) && $_POST['gc_name'] ? $_POST['gc_name']:'',										
					"gc_value"=>isset($_POST['gc_value']) && $_POST['gc_value'] ? $_POST['gc_value']:'',															
					"gc_order"=>isset($_POST['gc_order']) ? $_POST['gc_order']:0,
					"gc_create"=>date("Y-m-d H:i:s"),					
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['gc_name']){
					$myGroupActionCheck = $this->mgroupaction->getData('',array("gc_value"=>$this->_data['formData']['gc_value']));					
					if(isset($myGroupActionCheck['id']) > 0){
						$this->_data['error'][] = "Value is exist";
						$this->_data['formData']['gc_value'] = "";
					}
					else					
					{
						$insert = $this->mgroupaction->add($this->_data['formData']);
						if(is_numeric($insert)>0){
							$this->_data['success'][] = "Add success";
							$this->_data['formData'] = NULL;
							/**begin chuyen trang*/
							if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
								header("location:".base64_decode($_REQUEST['redirect']));
							}else{
								// header("location:".my_lib::cms_site()."groupaction/");
								header("location:".my_lib::cms_site()."groupaction/edit/".$insert."/?info=add");
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
			$this->my_layout->view("cms/groupaction/add",$this->_data);
		}

		public function edit($id)
		{
			$this->muser->checkPermission('groupaction', 'edit');
			$myGroupAction = '';
			if(is_numeric($id)){
				$myGroupAction = $this->mgroupaction->getData('',array("id"=>$id));
				if($myGroupAction['id']<=0){
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
				$this->_data['info'][] = 'Add success';
			}
			$this->_data["title"]  = 'Edit menu';
			$this->_data['formData']	= array(
				"gc_name"=>isset($myGroupAction['gc_name']) ? $myGroupAction['gc_name']:'',												
				"gc_value"=>isset($myGroupAction['gc_value']) ? $myGroupAction['gc_value']:'',												
				"gc_order"=>isset($myGroupAction['gc_order']) ? $myGroupAction['gc_order']:0,
				"gc_create"=>date("Y-m-d H:i:s"),				
				"user"=>$s_info['s_user_id']						
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"gc_name"=>isset($_POST['gc_name']) && $_POST['gc_name'] ? $_POST['gc_name']:'',										
					"gc_value"=>isset($_POST['gc_value']) && $_POST['gc_value'] ? $_POST['gc_value']:'',
					"gc_order"=>isset($_POST['gc_order']) && $_POST['gc_order'] ? $_POST['gc_order']:'',
					"gc_create"=>date("Y-m-d H:i:s"),	
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['gc_name']){	
					/*begin check gc_value*/				
					$myGroupActionCheck = $this->mgroupaction->getData('',array("id !="=>$id,"gc_value"=>$this->_data['formData']['gc_value']));					
					if($myGroupActionCheck['id'] > 0){
						$this->_data['error'][] = "Value is exist";
						$this->_data['formData']['gc_value'] = "";
					}
					else					
					{
						if($this->mgroupaction->edit($id,$this->_data['formData'])){
							$this->_data['success'][] = "Edit success";
							$this->_data['formData'] = NULL;
							/**begin chuyen trang*/
							if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
								header("location:".base64_decode($_REQUEST['redirect']));
							}else{
								header("location:".my_lib::cms_site()."groupaction/");
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
			$this->my_layout->view("cms/groupaction/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			$this->muser->checkPermission('groupaction', 'delete');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');		
			$myGroupAction = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myGroupAction = $this->mgroupaction->getData('',array("id"=>$id));
				if($myGroupAction['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mgroupaction->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."groupaction/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/groupaction/delete",$this->_data);
		}
		/**end delete */	
	}
?>