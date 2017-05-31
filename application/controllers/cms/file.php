<?php
	class file extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mfile");				
		}
		public function index()
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data['boss'] = 0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5) {
				$this->_data['boss'] = 1;
			}
			$and1 = ' file_level = 1 and file_status = 1 and file_parent = 0';
			$and2 = ' file_level = 2 and file_status = 1';
			$this->_data["title"]  = 'Danh sách files';			
			$orderby = 'id asc';
			$this->_data['listFile_lv1'] = $this->mfile->getQuery($object="id,file_title",$join="",$and1,$orderby,$limit="");
			$this->_data['listFile_lv2'] = $this->mfile->getQuery($object="",$join="",$and2,$orderby,$limit="");
			
			$this->my_layout->view("cms/file/index",$this->_data);
		}	

		public function set_per()
		{
			$orderby = 'id asc';
			$and2 = ' file_level = 2 and file_status = 1';
			$list_lv2 = $this->mfile->getQuery($object="",$join="",$and2,$orderby,$limit="");
			foreach ($list_lv2 as $key => $value) {
				$this->mfile->edit($value['id'],array('file_permission' => '12356789'));
			}
		}

		public function cate()
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			//$this->_data['id'] = $id;
			$this->_data['boss'] = 0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5) {
				$this->_data['boss'] = 1;
			}
			$fstatus = isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']: 1;
			$fkeyword = isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']: '';
			$this->_data['fileParent'] = $this->mfile->getData($object='',array('id' => $id));
			//$and1 = ' file_level = 1 and file_status = 1 and file_parent = 0';
			$and2 = ' file_level = 1 and file_status = '. $fstatus .' and file_permission like "%'. $this->_data['s_info']['s_user_group'] .'%"';
			if(isset($fkeyword) && $fkeyword)
			{
				$and2 .= ' and file_title like "%'.$fkeyword.'%"';
			}
			$this->_data['fkeyword'] = $fkeyword;
            //$and2 .= ' and file_status = '.$fstatus;
			$this->_data["title"]  = $this->_data['fileParent']['file_title'];			
			$orderby = 'id asc';
			//$this->_data['listFile_lv1'] = $this->mfile->getQuery($object="id,file_title",$join="",$and1,$orderby,$limit="");
			$this->_data['listFile_lv2'] = $this->mfile->getQuery($object="",$join="",$and2,$orderby,$limit="");

			$this->_data['fstatus'] = $this->mfile->dropdownlistStatus($fstatus);
			
			$this->my_layout->view("cms/file/list",$this->_data);
		}


		public function detail($id)
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data['id'] = $id;
			$this->_data['boss'] = 0;
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 5 || $this->_data['s_info']['s_user_group'] == 9) {
				$this->_data['boss'] = 1;
			}
			$fstatus = isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']: 1;
			$fkeyword = isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']: '';
			$this->_data['fileParent'] = $this->mfile->getData($object='',array('id' => $id));
			//$and1 = ' file_level = 1 and file_status = 1 and file_parent = 0';
			$and2 = ' file_level = 2 and file_status = '. $fstatus .' and file_parent = '.$id.' and file_permission like "%'. $this->_data['s_info']['s_user_group'] .'%"';
			if(isset($fkeyword) && $fkeyword)
			{
				$and2 .= ' and file_title like "%'.$fkeyword.'%"';
			}
			$this->_data['fkeyword'] = $fkeyword;
            //$and2 .= ' and file_status = '.$fstatus;
			$this->_data["title"]  = $this->_data['fileParent']['file_title'];			
			$orderby = 'id asc';
			//$this->_data['listFile_lv1'] = $this->mfile->getQuery($object="id,file_title",$join="",$and1,$orderby,$limit="");
			$this->_data['listFile_lv2'] = $this->mfile->getQuery($object="",$join="",$and2,$orderby,$limit="");

			$this->_data['fstatus'] = $this->mfile->dropdownlistStatus($fstatus);
			
			$this->my_layout->view("cms/file/list",$this->_data);
		}

		public function status($id, $status)
		{
			$this->muser->checkPermission('file', 'status');
			$data = array(
	            "file_status" => $status,
	        );
	        $this->mfile->edit($id, $data);
	        redirect(base64_decode($_REQUEST['redirect']));
		}

		public function add()
		{
			$this->muser->checkPermission('file', 'add');
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			
			$and1 = ' file_level = 1 and file_status = 1 and file_parent = 0';
			$orderby = 'id asc';
			$this->_data['list_level_1'] = $this->mfile->getQuery($object="id,file_title,file_parent",$join="",$and1,$orderby,$limit="");

			// $this->_data['error'] = "";
			// $this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới file';
			$this->_data['formData']	= array(			
				"file_title"=>"",
				"file_name"=>"",
				"file_status"=>"1",
				"file_parent"=>"",
				"file_order"=>"0",
				"file_description"=>"",
				"file_level"=>"2",
				"file_permission"=>""
			);			

			if(isset($_POST['fsubmit'])){				
				if ($this->input->post('file_level') == 1) {
					$file_name = "";
					$file_parent = 0;
					$file_level = 1;
					$file_re = "";
				} else {
					$file_name = "";
					if (isset($_FILES['_file'])) {
						if (move_uploaded_file($_FILES['_file']['tmp_name'], $this->mfile->getUploadPath().$_FILES['_file']['name'])) {
							$file_name = $_FILES['_file']['name'];
						} else {
							$this->_data['error'][] = "Upload file không thành công vui lòng kiểm tra lại tên file!";

						}
					}
					$file_parent = $this->input->post('file_parent');
					$file_level = 2;
					$file_re = "detail/".$file_parent;
				}
				$permission = $this->input->post('file_permission');
				$per = "";
				if (!empty($permission)) {
					foreach ($permission as $key => $value) {
						$per .= $value;
					}
				}
				if ($permission == "") {
					$per = '12356789';
				}
				$this->_data['formData']	= array(
					"file_title"=>$this->input->post('file_title'),
					"file_name"=>$file_name,
					"file_status"=>$this->input->post('file_status'),
					"file_description"=>$this->input->post('file_description'),
					"file_order"=>$this->input->post('file_order'),
					"file_parent"=>$file_parent,
					"file_level"=>$file_level,
					"file_permission"=>$per,
					"file_user"=>$this->_data['s_info']['s_user_id'],
					"file_create_day"=>date("Y-m-d")
				);	
				if($this->_data['formData']['file_title'] && $this->_data['formData']['file_name'] != ''){
					$insert = $this->mfile->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."file/".$file_re);
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/file/add",$this->_data);
		}

		public function edit($id)
		{
			$this->muser->checkPermission('file', 'edit');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			if ($this->_data['s_info']['s_user_group'] != 1 && $this->_data['s_info']['s_user_group'] != 5) {
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$myFile = $this->mfile->getData($object='',array('id' => $id));
			$and1 = ' file_level = 1 and file_status = 1 and file_parent = 0';
			$orderby = 'id asc';
			$this->_data['list_level_1'] = $this->mfile->getQuery($object="id,file_title,file_parent",$join="",$and1,$orderby,$limit="");

			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Sửa file';

			$this->_data["listGroup"] = $this->mgroup->getQuery("id,group_name","","","","");

			$this->_data['formData']	= array(			
				"file_title"=>$myFile['file_title'],
				"file_name"=>$myFile['file_name'],
				"file_description"=>$myFile['file_description'],
				"file_status"=>$myFile['file_status'],
				"file_parent"=>$myFile['file_parent'],
				"file_order"=>$myFile['file_order'],
				"file_level"=>$myFile['file_level'],
				"file_permission"=>$myFile['file_permission']
			);			

			if(isset($_POST['fsubmit'])){				
				if ($this->input->post('file_level') == 1) {
					$file_name = "";
					$file_parent = 0;
					$file_level = 1;
					$file_re = "";
					$link_file = my_lib::base_url().'media/file/'.$myFile['file_name'];
					if (file_exists($link_file)) {
						unlink($link_file);
					}
				} else {
					$file_name = $myFile['file_name'];
					if (isset($_FILES['_file'])) {
						if ($_FILES['_file']['name'] != "") {
							$link_file = my_lib::base_url().'media/file/'.$myFile['file_name'];
							if (file_exists($link_file)) {
								unlink($link_file);
							}
							move_uploaded_file($_FILES['_file']['tmp_name'], $this->mfile->getUploadPath().$_FILES['_file']['name']);
		               		$file_name = $_FILES['_file']['name'];
						}

					}
					$file_parent = $this->input->post('file_parent');
					$file_level = 2;
					$file_re = "detail/".$file_parent;
				}
				$permission = $this->input->post('file_permission');
				$per = "";
				if (!empty($permission)) {
					foreach ($permission as $key => $value) {
						$per .= $value;
					}
				}
				if ($permission == "") {
					$per = '123567';
				}
				$this->_data['formData']	= array(
					"file_title"=>$this->input->post('file_title'),
					"file_name"=>$file_name,
					"file_description"=>$this->input->post('file_description'),
					"file_status"=>$this->input->post('file_status'),
					"file_order"=>$this->input->post('file_order'),
					"file_parent"=>$file_parent,
					"file_level"=>$file_level,
					"file_permission"=>$per,
					"file_user"=>$this->_data['s_info']['s_user_id'],
					"file_create_day"=>date("Y-m-d")
				);	
				if($this->_data['formData']['file_title']){
					if($this->mfile->edit($id,$this->_data['formData'])){
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."file/".$file_re);
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Edit Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/file/add",$this->_data);
		}
		// /**end them moi menu*/

		// /**begin delete */
		public function delete($id)
		{	
			$this->muser->checkPermission('file', 'delete');
			$myFile = $this->mfile->getData($object='',array('id' => $id));
			if (!empty($myFile)) {
				$file_re = "detail/".$myFile['file_parent'];
				$this->mfile->delete($id);
				$link_file = $this->mfile->getUploadPath().$myFile['file_name'];
				if (file_exists($link_file)) {
					unlink($link_file);
				}
				header("location:".my_lib::cms_site()."file/".$file_re);
			}
		}
		/**end delete */

		
		
	}
?>