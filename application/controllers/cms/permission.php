<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class permission extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mpermission");			
			$this->load->Model("cms/mgroup");			
			$this->load->Model("cms/mgroupaction");	$this->muser->checkLogin();	
		}
		public function index()
		{
			$this->muser->checkPermission('permission', 'index');	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');		
			$this->_data["title"]  = 'Permission » Danh sách';			
			$and = '';
			$orderby = 'id desc';
			$this->_data['group'] = $this->mgroup->getQuery("id,group_name",$join_g="",'','group_order asc',"");
			$this->_data['groupaction'] = $this->mgroupaction->getQuery("id,gc_name,gc_value",$join_g="",'','gc_value asc',"");
			$this->_data['list'] = $this->mpermission->getQuery($object="",$join="",$and,$orderby,$limit="");		
			$this->my_layout->view("cms/permission/index",$this->_data);
		}	
		/**begin aj_proccess
		@ xu ly check chon permision
		*/
		public function aj_proccess()
		{
			# code...
			$html = ""; //return true || false
			$val = isset($_REQUEST['val']) && $_REQUEST['val'] ? $_REQUEST['val']:'';
			if($val)
			{				
				$tmpVal = explode("-", $val);				
				$group_id = (int) $tmpVal[1];
				$gc_id = (int) $tmpVal[0];
				if(is_numeric($group_id)>0 && is_numeric($gc_id)>0)				
				{
					$myPermission = $this->mpermission->getData('',array("gc_id"=>$gc_id,"group_id"=>$group_id));
					if($myPermission==NULL)
					{
						/**add*/
						$this->_data['formData'] = array(
							"gc_id"=>$gc_id,
							"group_id"=>$group_id,
							"per_create"=>date("Y-m-d H:i:s"),
							"user"=>""
						);
						if($this->_data['formData']['gc_id'] && $this->_data['formData']['group_id'])
						{
							$insert = $this->mpermission->add($this->_data['formData']);
							if(is_numeric($insert)>0)
							{
								$html =  "Gán quyền thành công";
							}
							else
							{
								$html =  "Gán quyền không thành công";
							}
						}
					}
					else
					{
						/**delete*/
						if(is_numeric($myPermission['id'])>0)
						{
							$this->mpermission->delete($myPermission['id']);
							$html = "Loại bỏ quyền thành công";
						}
						else
						{
							$html = "Loại bỏ quyền không thành công";
						}
					}
				}
				echo $html;				
			}
		}			
	}
?>