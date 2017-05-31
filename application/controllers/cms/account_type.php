<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class account_type extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();					
			$this->load->Model("cms/maccount_type");				
		}
		public function index()
		{
			$this->muser->checkPermission('account_type', 'index');
			$this->_data["title"]  = 'Danh sách loại thu chi';
			$this->_data['formData'] = array(
					"type_name"=>"",
					"type_parent"=>"",
					"type_orderby"=>"",
			);
			$object_type = '';
			$join_type = '';
			$and_type = 'type_parent=0';
			$orderby_type = 'id desc ';
			$limit_type = '';

			$this->_data['dropdownlist'] = $this->maccount_type->dropdownlist($this->_data['formData']['type_parent']);
			$this->_data['list'] = $this->maccount_type->getQuery($object_type,$join_type,$and_type,$orderby_type,$limit_type);
			# end danh sach muc chi
			
			//them moi du lieu
			if(isset($_POST['fsubmit']))
			{
				$this->_data['formData'] = array(
					"type_name"=>$this->input->post("type_name"),
					"type_parent"=>$this->input->post("type_parent"),
					"type_orderby"=>$this->input->post("type_orderby"),
					"type_status"=>1,
					"type_create"=>date("Y-m-d"),							
					"user"=>$this->_data['s_info']['s_user_id'],							
				);
				if($this->_data['formData']['type_name']){
					$insert = $this->maccount_type->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;	
						header("location:".current_url());							
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			//end them moi du lieu
			$this->my_layout->view("cms/account_type/index",$this->_data);
		}
		

		public function update_status($id,$status)
		{
			$this->muser->checkPermission('account_type', 'update_status');
			$myAccountType = '';
			if(is_numeric($id)){
				$myAccountType = $this->maccount_type->getData('',array("id"=>$id));
				if($myAccountType['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
				$this->_data['formDataSpend'] = array(
					"type_status"=>$status,
					"type_create"=>date("Y-m-d"),
					"user"=>$this->_data['s_info']['s_user_id'],							
				);
				if($this->_data['formDataSpend'])
				{
					$this->maccount_type->edit($id,$this->_data['formDataSpend']);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."account_type");						
					}
					/**end chuyen trang*/
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}			
		}
		
		/**begin aj_getDropDown*/
		public function aj_getDropDown()
		{
			$html = '';
			$type_parent = isset($_REQUEST['type_parent']) && $_REQUEST['type_parent'] ? $_REQUEST['type_parent']:'';
			if($type_parent)
			{
				$html = $this->maccount_type->dropdownlist($active='',$type_parent,$cap=2);
			}
			echo $html;
		}
		/**end aj_getDropDown*/
	}
?>