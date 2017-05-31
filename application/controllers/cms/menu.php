<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class menu extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();		
			$this->load->Model("cms/mmenu");
			$this->load->Model("cms/mcom");
		}
		public function index()
		{
			# code...		
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data["title"]  = 'Danh sách menu';		
			$and = 'menu_parent = 0';
			$this->_data['orderby']=$orderby = 'menu_orderby asc';
			$this->_data['list'] = $this->mmenu->getQuery($object="",$join="",$and,$orderby,$limit="");
			$this->my_layout->view("cms/menu/index",$this->_data);
		}
		public function add()
		{
			# code...
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Add menu';
			$this->_data['formData']	= array(
				"menu_name"=>"",				
				"menu_link_id"=>"1",
				"menu_alias"=>"",
				"menu_link"=>"",
				"menu_detail"=>"",
				"menu_parent"=>"",
				"menu_com"=>"",
				"menu_view"=>"",
				"menu_orderby"=>"",
				"menu_status"=>"1",
				"menu_picture"=>"",
				"menu_xml"=>"",
				"menu_create_date"=>"",
				"menu_update_date"=>"",
				"menu_seo_title"=>"",
				"menu_seo_description"=>"",
				"menu_seo_keyword"=>"",
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"menu_name"=>isset($_POST['menu_name']) && $_POST['menu_name'] ? $_POST['menu_name']:'',					
					"menu_link_id"=>isset($_POST['menu_link_id']) && $_POST['menu_link_id'] ? $_POST['menu_link_id']:'',
					"menu_alias"=>isset($_POST['menu_alias']) && $_POST['menu_alias'] ? $_POST['menu_alias']:'',
					"menu_link"=>isset($_POST['menu_link']) && $_POST['menu_link'] ? $_POST['menu_link']:'',
					"menu_detail"=>isset($_POST['menu_detail']) && $_POST['menu_detail'] ? $_POST['menu_detail']:'',
					"menu_parent"=>isset($_POST['menu_parent']) && $_POST['menu_parent'] ? $_POST['menu_parent']:'',
					"menu_com"=>isset($_POST['menu_com']) && $_POST['menu_com'] ? $_POST['menu_com']:'',
					"menu_view"=>isset($_POST['menu_view']) && $_POST['menu_view'] ? $_POST['menu_view']:'',
					"menu_orderby"=>isset($_POST['menu_orderby']) && $_POST['menu_orderby'] ? $_POST['menu_orderby']:'',
					"menu_status"=>isset($_POST['menu_status']) && $_POST['menu_status'] ? $_POST['menu_status']:'',
					"menu_picture"=>isset($_POST['menu_picture']) && $_POST['menu_picture'] ? $_POST['menu_picture']:'',
					"menu_xml"=>"",
					"menu_create_date"=>date("Y-m-d H:i:s",time()),
					"menu_update_date"=>date("Y-m-d H:i:s",time()),
					"menu_seo_title"=>isset($_POST['menu_seo_title']) && $_POST['menu_seo_title'] ? $_POST['menu_seo_title']:'',
					"menu_seo_description"=>isset($_POST['menu_seo_description']) && $_POST['menu_seo_description'] ? $_POST['menu_seo_description']:'',
					"menu_seo_keyword"=>isset($_POST['menu_seo_keyword']) && $_POST['menu_seo_keyword'] ? $_POST['menu_seo_keyword']:'',
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['menu_name']){
					$insert = $this->mmenu->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."menu/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên menu";
				}
			}
			// my_lib::printArr($this->_data['formData']);

			/**begin com parent*/
			$this->_data['parent'] = $this->mmenu->dropdownlist($this->_data['formData']['menu_parent']);
			/**end com parent*/

			/**begin get danh sach com*/
			$this->_data['getCom'] = $this->mcom->getQuery("id,com_name,com_com","","com_status=1 and com_parent=0","id asc","");			
			/**end get danh sach com*/
			$this->my_layout->view("cms/menu/add",$this->_data);
		}

		/**begin edit*/
		public function edit($id)
		{
			# code...
			$myMenu = '';
			if(is_numeric($id)){
				$myMenu = $this->mmenu->getData('',array("id"=>$id));
				if($myMenu['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}					
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Add menu';
			$this->_data['formData']	= array(
				"menu_name"=>isset($myMenu['menu_name']) ? $myMenu['menu_name']:'',
				"menu_link_id"=>isset($myMenu['menu_link_id']) ? $myMenu['menu_link_id']:'',
				"menu_alias"=>isset($myMenu['menu_alias']) ? $myMenu['menu_alias']:'',
				"menu_link"=>isset($myMenu['menu_link']) ? $myMenu['menu_link']:'',
				"menu_detail"=>isset($myMenu['menu_detail']) ? $myMenu['menu_detail']:'',
				"menu_parent"=>isset($myMenu['menu_parent']) ? $myMenu['menu_parent']:'',
				"menu_com"=>isset($myMenu['menu_com']) ? $myMenu['menu_com']:'',
				"menu_view"=>isset($myMenu['menu_view']) ? $myMenu['menu_view']:'',
				"menu_orderby"=>isset($myMenu['menu_orderby']) ? $myMenu['menu_orderby']:'',
				"menu_status"=>isset($myMenu['menu_status']) ? $myMenu['menu_status']:'',
				"menu_picture"=>isset($myMenu['menu_picture']) ? $myMenu['menu_picture']:'',
				"menu_xml"=>isset($myMenu['menu_xml']) ? $myMenu['menu_xml']:'',
				"menu_create_date"=>isset($myMenu['menu_create_date']) ? $myMenu['menu_create_date']:'',
				"menu_update_date"=>isset($myMenu['menu_update_date']) ? $myMenu['menu_update_date']:'',
				"menu_seo_title"=>isset($myMenu['menu_seo_title']) ? $myMenu['menu_seo_title']:'',
				"menu_seo_description"=>isset($myMenu['menu_seo_description']) ? $myMenu['menu_seo_description']:'',
				"menu_seo_keyword"=>isset($myMenu['menu_seo_keyword']) ? $myMenu['menu_seo_keyword']:'',
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"menu_name"=>isset($_POST['menu_name']) && $_POST['menu_name'] ? $_POST['menu_name']:'',					
					"menu_link_id"=>isset($_POST['menu_link_id']) && $_POST['menu_link_id'] ? $_POST['menu_link_id']:'',
					"menu_alias"=>isset($_POST['menu_alias']) && $_POST['menu_alias'] ? $_POST['menu_alias']:'',
					"menu_link"=>isset($_POST['menu_link']) && $_POST['menu_link'] ? $_POST['menu_link']:'',
					"menu_detail"=>isset($_POST['menu_detail']) && $_POST['menu_detail'] ? $_POST['menu_detail']:'',
					"menu_parent"=>isset($_POST['menu_parent']) && $_POST['menu_parent'] ? $_POST['menu_parent']:'',
					"menu_com"=>isset($_POST['menu_com']) && $_POST['menu_com'] ? $_POST['menu_com']:'',
					"menu_view"=>isset($_POST['menu_view']) && $_POST['menu_view'] ? $_POST['menu_view']:'',
					"menu_orderby"=>isset($_POST['menu_orderby']) && $_POST['menu_orderby'] ? $_POST['menu_orderby']:'',
					"menu_status"=>isset($_POST['menu_status']) && $_POST['menu_status'] ? $_POST['menu_status']:'',
					"menu_picture"=>isset($_POST['menu_picture']) && $_POST['menu_picture'] ? $_POST['menu_picture']:'',
					"menu_xml"=>"",					
					"menu_update_date"=>date("Y-m-d H:i:s",time()),
					"menu_seo_title"=>isset($_POST['menu_seo_title']) && $_POST['menu_seo_title'] ? $_POST['menu_seo_title']:'',
					"menu_seo_description"=>isset($_POST['menu_seo_description']) && $_POST['menu_seo_description'] ? $_POST['menu_seo_description']:'',
					"menu_seo_keyword"=>isset($_POST['menu_seo_keyword']) && $_POST['menu_seo_keyword'] ? $_POST['menu_seo_keyword']:'',
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['menu_name']){					
					if($this->mmenu->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Update success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."menu/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên menu";
				}
			}
			// my_lib::printArr($this->_data['formData']);

			/**begin com parent*/
			$this->_data['parent'] = $this->mmenu->dropdownlist($this->_data['formData']['menu_parent']);
			/**end com parent*/

			/**begin get danh sach com*/
			$this->_data['getCom'] = $this->mcom->getQuery("id,com_name,com_com","","com_status=1 and com_parent=0","id asc","");			
			/**end get danh sach com*/
			$this->my_layout->view("cms/menu/edit",$this->_data);
		}
		/**end edit*/

		/**begin delete */
		public function delete($id)
		{
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$myMenu = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myMenu = $this->mmenu->getData('',array("id"=>$id));
				if($myMenu['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{
					/**bein check parent*/
					$myCount = $this->mmenu->countQuery("","menu_parent=".$id);					
					if($myCount==0){
						$this->mmenu->delete($id);
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."menu/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Đây là menu cấp cha không thể xóa ! Click <a href='javascript:javascript:history.go(-1)'>vào đây</a> để quay lại.";
					}
					/**end check parent*/					
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/menu/delete",$this->_data);
		}
		/**end delete */

		/**begin tao moi alias*/
		public function aj_aliasmenu()
		{
			# code...
			$html = '';
			$name = isset($_REQUEST['name']) ? trim($_REQUEST['name']):'';
			if($name){
				$html  = my_lib::convert_alias($name);
				/**begin kiem tra va conver name thanh alias*/
				$check = $this->mmenu->countQuery("","menu_alias='".$html."'");
				if($check>0){
					$html = $html.'-trung-lap';
				}
			}
			echo $html;

		}
		/**end tao moi alias*/

	}
?>