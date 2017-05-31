<?php
	class user extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();	
			$this->load->Model("cms/minfoservice");		
			$this->load->Model("cms/mwork_history");		
		}
		public function index()
		{
			$this->muser->checkPermission('user', 'index');		
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data["title"]  = 'Danh sách user';		
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fuserdepartment"=>isset($_REQUEST['fuserdepartment']) && $_REQUEST['fuserdepartment'] ? $_REQUEST['fuserdepartment']:0,
				"fuserstatus"=>isset($_REQUEST['fuserstatus']) && $_REQUEST['fuserstatus'] ? $_REQUEST['fuserstatus']:0,
				"fusergroup"=>isset($_REQUEST['fusergroup']) && $_REQUEST['fusergroup'] ? $_REQUEST['fusergroup']:0,				
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:20,
			);	
			$and = '1';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (user_username like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_fullname like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_position like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_hotline like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_address like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_hometown like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_yahoo like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_academic like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or user_email like "%'.$this->_data['formData']['fkeyword'].'%")';
			}	
			if(isset($this->_data['formData']['fuserstatus']) && $this->_data['formData']['fuserstatus']!=0)
			{
				$and .= ' and user_status ='.$this->_data['formData']['fuserstatus'];
			}
			if(isset($this->_data['formData']['fuserdepartment']) && $this->_data['formData']['fuserdepartment']!=0)
			{
				$and .= ' and user_department ='.$this->_data['formData']['fuserdepartment'];
			}
			if(isset($this->_data['formData']['fusergroup']) && $this->_data['formData']['fusergroup']!=0)
			{
				$and .= ' and user_group ='.$this->_data['formData']['fusergroup'];
			}	

			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'user/?'.$query_string.'&page=';			
			/*end phan trang*/

			$this->_data['orderby']=$orderby = 'user_status, id desc';
			$limit = $paging['start'].','.$paging['per_page'];

			$this->_data['list'] = $this->muser->getQuery($object="",$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->muser->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$this->muser->checkPermission('user', 'delete');	
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myUser = $this->muser->getData('',array("id"=>$value));
							if($myUser['id']>0){								
								$this->muser->delete($value);															
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
			$this->_data['fuserdepartment'] = $this->mdepartment->dropdownlist($this->_data['formData']['fuserdepartment']);
			$this->_data['fusergroup'] = $this->mgroup->dropdownlist($this->_data['formData']['fusergroup']);
			$this->_data['fuserstatus'] = $this->muser->dropdownlistStatus($this->_data['formData']['fuserstatus']);
			$this->my_layout->view("cms/user/index",$this->_data);
		}		
		public function add()
		{
			$this->muser->checkPermission('user', 'add');	
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data["title"]  = 'Add';					
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Add User';
			$this->_data['formData']	= array(
				"user_fullname"		=>	"",								
				"user_department"	=>	"",								
				"user_group"		=>	"",								
				"user_position"		=>	"",								
				"user_contractday"		=>	date("Y-m-d"),								
				"user_contracttime"		=>	date("Y-m-d"),								
				"user_username"		=>	"",								
				"user_parent"		=>	"",								
				"user_password"		=>	"",								
				"user_gender"		=>	"1",								
				"user_birthday"		=>	"",								
				"user_address"		=>	"",								
				"user_hometown"		=>	"",								
				"user_accountbank"		=>	"",								
				"user_academic"		=>	"",								
				"user_wage"		=>	"",								
				"user_password"		=>	"",								
				"user_hotline"		=>	"",								
				"user_email"		=>	"",								
				"user_yahoo"		=>	"",								
				"user_google"		=>	"",		
				"user_facebook"		=>	"",		
				"user_twitter"		=>	"",		
				"user_skype"		=>	"",			
				"user_intro"		=>	"",		
				"user_website"		=>	"",		
				"user_avatar"		=>	"",		
				"user_state"		=>	1,
				"user_status"		=>	1,
				"user_targets"		=>	0,
			);			

			if(isset($_POST['fsubmit'])){	
				//File
				$file_name = "";
				if (isset($_FILES['_file'])) {
					move_uploaded_file($_FILES['_file']['tmp_name'], $this->muser->getUploadPath().$_FILES['_file']['name']);
               		$file_name = $_FILES['_file']['name'];
				}

				$this->_data['formData']	= array(
					"user_fullname"		=>  $this->input->post('user_fullname'),
					"user_department"	=>  $this->input->post('user_department'),
					"user_group"		=>  $this->input->post('user_group'),
					"user_position"		=>  $this->input->post('user_position'),
					"user_contractday"		=>  $this->input->post('user_contractday'),
					"user_contracttime"		=>  $this->input->post('user_contracttime'),
					"user_username"		=>  $this->input->post('user_username'),
					"user_parent"		=>  $this->input->post('user_parent'),
					"user_gender"		=>  $this->input->post('user_gender'),
					"user_birthday"		=>  $this->input->post('user_birthday'),
					"user_address"		=>  $this->input->post('user_address'),
					"user_hometown"		=>  $this->input->post('user_hometown'),
					"user_accountbank"		=>  $this->input->post('user_accountbank'),
					"user_academic"		=>  $this->input->post('user_academic'),
					"user_wage"		=>  $this->input->post('user_wage'),
					"user_password"		=>  md5($this->input->post('user_password')),
					"user_hotline"		=>  $this->input->post('user_hotline'),
					"user_email"		=>  $this->input->post('user_email'),
					"user_yahoo"		=>  $this->input->post('user_yahoo'),
					"user_google"		=>  $this->input->post('user_google'),
					"user_facebook"		=>  $this->input->post('user_facebook'),
					"user_twitter"		=>  $this->input->post('user_twitter'),
					"user_skype"		=>  $this->input->post('user_skype'),
					"user_intro"		=>  $this->input->post('user_intro'),
					"user_website"		=>  $this->input->post('user_website'),
					"user_avatar"		=>  '',
					"user_status"		=>  $this->input->post('user_status'),
					"user_state"		=>  $this->input->post('user_state'),
					"user_targets"		=>  0,
					"user_file"			=>  $file_name,
					"user_createdate"	=>  date("Y-m-d H:i:s"),
					"user_updatedate"	=>  date("Y-m-d H:i:s")
				);	
				if($this->_data['formData']['user_username']){
					$myUser = $this->muser->getData('',array("user_username"=>$this->_data['formData']['user_username']));
					if($myUser)
					{
						$this->_data['error'][] = "Username đã tồn tại";
					}
					else
					{

						$insert = $this->muser->add($this->_data['formData']);
						if(is_numeric($insert)>0){
							/**begin tao thuc muc ca nhan*/
							$str = md5($this->_data['formData']['user_username']);
							$user_folder = substr($str,1,6);
							$folder = dir_root.'/media/upload/file/nhanvien/'.$user_folder;
							if(!is_dir($folder)) @mkdir($folder,0777,true);
							$this->muser->edit($insert,array("user_folder"=>$user_folder));
							/**end tao thuc muc ca nhan*/
							//Work history
							$dataAddWH = array(
								'type_active' => $this->_data['formData']['user_state'],
								'work_startday' => date("Y-m-d"),
								'work_duration' => $this->_data['formData']['user_contracttime'],
								'position' => $this->_data['formData']['user_position'],
								'measure' => $this->_data['formData']['user_wage'],
								'user_id' => $insert
							);
							$this->mwork_history->add($dataAddWH);
							//End WH
							$this->_data['success'][] = "Add success";
							$this->_data['formData'] = NULL;
							/**begin chuyen trang*/
							if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
								header("location:".base64_decode($_REQUEST['redirect']));
							}else{
								header("location:".my_lib::cms_site()."user/");								
							}
							/**end chuyen trang*/
						}else{
							$this->_data['error'][] = "Add Not Success";
						}
					}
					
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên user";
				}
			}

			/**begin com more*/
			$this->_data['user_department'] = $this->mdepartment->dropdownlist($this->_data['formData']['user_department']);
			$this->_data['user_group'] = $this->mgroup->dropdownlist($this->_data['formData']['user_group']);
			$this->_data['user_parent'] = $this->muser->dropdownlist($this->_data['formData']['user_parent'],true);
			$this->_data['user_state'] = $this->muser->dropdownlistState($this->_data['formData']['user_state']);
			$this->_data['user_status'] = $this->muser->dropdownlistStatus($this->_data['formData']['user_status']);
			/**end com more*/
			$this->my_layout->view("cms/user/add",$this->_data);
		}

		public function edit($id)
		{
			$this->muser->checkPermission('user', 'edit');	
			$myUser = '';
			if(is_numeric($id)){
				$myUser = $this->muser->getData('',array("id"=>$id));				
				if($myUser['id']<=0){
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
			$this->_data["title"]  = 'Update User';
			$this->_data['formData']	= array(
				"user_fullname"=>isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'',															
				"user_parent"=>isset($myUser['user_parent']) && $myUser['user_parent'] ? $myUser['user_parent']:'',															
				"user_department"=>isset($myUser['user_department']) && $myUser['user_department'] ? $myUser['user_department']:'',															
				"user_group"=>isset($myUser['user_group']) && $myUser['user_group'] ? $myUser['user_group']:'',															
				"user_position"=>isset($myUser['user_position']) && $myUser['user_position'] ? $myUser['user_position']:'',															
				"user_contractday"=>isset($myUser['user_contractday']) && $myUser['user_contractday'] ? $myUser['user_contractday']:'',															
				"user_contracttime"=>isset($myUser['user_contracttime']) && $myUser['user_contracttime'] ? $myUser['user_contracttime']:'',															
				"user_username"=>isset($myUser['user_username']) && $myUser['user_username'] ? $myUser['user_username']:'',															
				"user_gender"=>isset($myUser['user_gender']) && $myUser['user_gender'] ? $myUser['user_gender']:'',															
				"user_birthday"=>isset($myUser['user_birthday']) && $myUser['user_birthday'] ? $myUser['user_birthday']:'',															
				"user_address"=>isset($myUser['user_address']) && $myUser['user_address'] ? $myUser['user_address']:'',															
				"user_hometown"=>isset($myUser['user_hometown']) && $myUser['user_hometown'] ? $myUser['user_hometown']:'',															
				"user_accountbank"=>isset($myUser['user_accountbank']) && $myUser['user_accountbank'] ? $myUser['user_accountbank']:'',															
				"user_academic"=>isset($myUser['user_academic']) && $myUser['user_academic'] ? $myUser['user_academic']:'',															
				"user_wage"=>isset($myUser['user_wage']) && $myUser['user_wage'] ? $myUser['user_wage']:'',															
				"user_password"=>isset($myUser['user_password']) && $myUser['user_password'] ? $myUser['user_password']:'',
				"user_hotline"=>isset($myUser['user_hotline']) && $myUser['user_hotline'] ? $myUser['user_hotline']:'',															
				"user_email"=>isset($myUser['user_email']) && $myUser['user_email'] ? $myUser['user_email']:'',															
				"user_yahoo"=>isset($myUser['user_yahoo']) && $myUser['user_yahoo'] ? $myUser['user_yahoo']:'',															
				"user_google"=>isset($myUser['user_google']) && $myUser['user_google'] ? $myUser['user_google']:'',															
				"user_facebook"=>isset($myUser['user_facebook']) && $myUser['user_facebook'] ? $myUser['user_facebook']:'',															
				"user_twitter"=>isset($myUser['user_twitter']) && $myUser['user_twitter'] ? $myUser['user_twitter']:'',															
				"user_skype"=>isset($myUser['user_skype']) && $myUser['user_skype'] ? $myUser['user_skype']:'',															
				"user_intro"=>isset($myUser['user_intro']) && $myUser['user_intro'] ? $myUser['user_intro']:'',															
				"user_website"=>isset($myUser['user_website']) && $myUser['user_website'] ? $myUser['user_website']:'',															
				"user_avatar"=>isset($myUser['user_avatar']) && $myUser['user_avatar'] ? $myUser['user_avatar']:'',															
				"user_status"=>isset($myUser['user_status']) && $myUser['user_status'] ? $myUser['user_status']:'',
				"user_state"=>isset($myUser['user_state']) && $myUser['user_state'] ? $myUser['user_state']:'',
				"user_file"=>isset($myUser['user_file']) && $myUser['user_file'] ? $myUser['user_file']:'',
				"user_push_id"=>isset($myUser['user_push_id']) && $myUser['user_push_id'] ? $myUser['user_push_id']:''
			);			

			if(isset($_POST['fsubmit'])){
				//File
				$file_name = "";
				if (isset($_FILES['_file'])) {
					move_uploaded_file($_FILES['_file']['tmp_name'], $this->muser->getUploadPath().$_FILES['_file']['name']);
               		$file_name = $_FILES['_file']['name'];
				}
				$oldWorkhistory = $this->_data['formData']['user_state'];
				$user_password = isset($_POST['user_password']) && $_POST['user_password'] && $_POST['user_password']!=$this->_data['formData']['user_password']? md5($_POST['user_password']):$this->_data['formData']['user_password'];
				$this->_data['formData']	= array(									
					"user_fullname"		=>  $this->input->post('user_fullname'),
					"user_department"	=>  $this->input->post('user_department'),
					"user_group"		=>  $this->input->post('user_group'),
					"user_position"		=>  $this->input->post('user_position'),
					"user_contractday"		=>  $this->input->post('user_contractday'),
					"user_contracttime"		=>  $this->input->post('user_contracttime'),
					"user_username"		=>  $this->input->post('user_username'),
					"user_parent"		=>  $this->input->post('user_parent'),
					"user_gender"		=>  $this->input->post('user_gender'),
					"user_birthday"		=>  $this->input->post('user_birthday'),
					"user_address"		=>  $this->input->post('user_address'),
					"user_hometown"		=>  $this->input->post('user_hometown'),
					"user_accountbank"		=>  $this->input->post('user_accountbank'),
					"user_academic"		=>  $this->input->post('user_academic'),
					"user_wage"		=>  $this->input->post('user_wage'),
					"user_password"		=>  $user_password,
					"user_hotline"		=>  $this->input->post('user_hotline'),
					"user_email"		=>  $this->input->post('user_email'),
					"user_yahoo"		=>  $this->input->post('user_yahoo'),
					"user_google"		=>  $this->input->post('user_google'),
					"user_facebook"		=>  $this->input->post('user_facebook'),
					"user_twitter"		=>  $this->input->post('user_twitter'),
					"user_skype"		=>  $this->input->post('user_skype'),
					"user_intro"		=>  $this->input->post('user_intro'),
					"user_website"		=>  $this->input->post('user_website'),
					"user_avatar"		=>  $this->input->post('user_avatar'),
					"user_status"		=>  $this->input->post('user_status'),
					"user_state"		=>  $this->input->post('user_state'),
					"user_push_id"		=>  $this->input->post('user_push_id'),
					"user_file"			=>  $file_name,
					"user_updatedate"	=>	date("Y-m-d H:i:s"),			
				);	
				if($this->_data['formData']['user_fullname']){					
					if($this->muser->edit($id,$this->_data['formData'])){
						//Work history
						if ($oldWorkhistory != $this->_data['formData']['user_state']) {
							$dataAddWH = array(
								'type_active' => $this->_data['formData']['user_state'],
								'work_startday' => date("Y-m-d"),
								'work_duration' => $this->_data['formData']['user_contracttime'],
								'position' => $this->_data['formData']['user_position'],
								'measure' => $this->_data['formData']['user_wage'],
								'user_id' => $id
							);
							$this->mwork_history->add($dataAddWH);
						}
						//End
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."user/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên user";
				}
			}

			/**begin com parent*/
			$this->_data['user_department'] = $this->mdepartment->dropdownlist($this->_data['formData']['user_department']);
			$this->_data['user_group'] = $this->mgroup->dropdownlist($this->_data['formData']['user_group']);			
			$this->_data['user_parent'] = $this->muser->dropdownlist($this->_data['formData']['user_parent'],true);
			$this->_data['user_status'] = $this->muser->dropdownlistStatus($this->_data['formData']['user_status']);
			$this->_data['user_state'] = $this->muser->dropdownlistState($this->_data['formData']['user_state']);
			/**end com parent*/

			$this->my_layout->view("cms/user/edit",$this->_data);
		}

		public function profile($id_user)
		{
			$this->_data['boss'] = 0;
			if (isset($id_user) && $id_user != '') {
				if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 2 || $this->_data['s_info']['s_user_group'] == 5 || $this->_data['s_info']['s_user_id'] == $id_user) {
					$id = $id_user;
					$this->_data['boss'] = 1;
				}
			} else {
				$id = $this->_data['s_info']['s_user_id'];
			}

			//Work history
			$this->_data['work_history'] = $this->mwork_history->getQuery("","","user_id = ".$id,"id asc","");

			$userCur = $this->muser->getData('user_password,user_avatar',array("id"=>$id));
			$avatar = $userCur['user_avatar'];
			$this->_data['tag'] = isset($_REQUEST['tag']) && $_REQUEST['tag'] ? $_REQUEST['tag']:'ttcb';
			if (isset($_POST['fbasicInfo'])) {
				if (isset($_FILES['_file'])) {
					if ($_FILES['_file']['name'] != "") {
						$extend = explode('.',$_FILES['_file']['name']);
						$extend = $extend[(count($extend)-1)];
						if ($extend === 'jpg' || $extend === 'png' || $extend === 'gif') {
							$link_file = my_lib::base_url().'media/user/'.$userCur['user_avatar'];
							if (file_exists($link_file)) {
								unlink($link_file);
							}
							move_uploaded_file($_FILES['_file']['tmp_name'], $this->muser->getUploadPath().$_FILES['_file']['name']);
		               		$avatar = $_FILES['_file']['name'];
						} else {
							$this->_data['error'] = "Vui lòng up ảnh .jpg, .png hoặc gif";
						}
					}
				}
				$dataEdit1 = array(
					'user_avatar' => $avatar, 
					'user_fullname' => $this->input->post('user_fullname'), 
					'user_gender' => $this->input->post('user_gender'), 
					'user_birthday' => $this->input->post('user_birthday'), 
					'user_academic' => $this->input->post('user_academic'), 
					'user_address' => $this->input->post('user_address'), 
					'user_hometown' => $this->input->post('user_hometown'), 
					'user_hotline' => $this->input->post('user_hotline'), 
					'user_identity' => $this->input->post('user_identity'), 
					'user_identity_day' => $this->input->post('user_identity_day'), 
					'user_identity_place' => $this->input->post('user_identity_place'), 
					'user_phone_parent' => $this->input->post('user_phone_parent'), 
					'user_phone_company' => $this->input->post('user_phone_company'), 
					'user_email' => $this->input->post('user_email')
				);
				if($this->muser->edit($id,$dataEdit1)){
					header("location:".my_lib::cms_site().'user/profile/?tag=ttcb');
					exit();														
				}else{
					$this->_data['error'][] = "Cập nhật không thành công vui lòng kiểm tra lại!";
				}
				$this->_data['tag'] = 'ttcb';
			}
			if (isset($_POST['fAccount'])) {
				$oldPass = md5($this->input->post('oldPass'));
				$newPass = $this->input->post('newPass');
				$renewPass = $this->input->post('renewPass');
				if ($oldPass == $userCur['user_password']) {
					if ($newPass == $renewPass && $newPass != "") {
						$newPass = md5($newPass);
						if($this->muser->edit($id,array('user_password' => $newPass))){
							header("location:".my_lib::cms_site().'user/profile/?tag=tk');
							exit();														
						}else{
							$this->_data['error'][] = "Cập nhật không thành công vui lòng kiểm tra lại!";
						}
					} else {
						$this->_data['error'][] = "Hai mật khẩu không trùng khớp, và không được để trống!";
					}
				} else {
					$this->_data['error'][] = "Mật khẫu cũ không chính xác!";
				}
				$this->_data['tag'] = 'tk';
			}
			if (isset($_POST['fSocial'])) {
				$dataEdit2 = array(
					'user_facebook' => $this->input->post('user_facebook'), 
					'user_google' => $this->input->post('user_google'), 
					'user_yahoo' => $this->input->post('user_yahoo'), 
					'user_twitter' => $this->input->post('user_twitter'), 
					'user_skype' => $this->input->post('user_skype'), 
					'user_intro' => $this->input->post('user_intro')
				);
				if($this->muser->edit($id,$dataEdit2)){
					header("location:".my_lib::cms_site().'user/profile/?tag=mxh');
					exit();															
				}else{
					$this->_data['error'][] = "Cập nhật không thành công vui lòng kiểm tra lại!";
				}
				$this->_data['tag'] = 'mxh';
			}
			if(is_numeric($id)){
				$myUser = $this->muser->getData('',array("id"=>$id));				
				if($myUser['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$this->_data["myUser"]  = $myUser;
			//Targets
			if ($myUser['user_targets'] > 0) {
				$this->_data['targetYear'] = $myUser['user_targets'];
				$totalTargets = $this->minfoservice->getTargetUser(date("Y"),$myUser['id']);
				$this->_data['targetUser'] = $totalTargets['0']['totalTargets'];
				$this->_data['signUser'] = $totalTargets['0']['totalSign'];
				$this->_data['debtUser'] = $totalTargets['0']['totalSign'] - $totalTargets['0']['totalTargets'];
				$this->_data['rest'] = $this->_data['targetYear'] - $this->_data['targetUser'];
				$percenReal = round(($this->_data['targetUser'] / $this->_data['targetYear'])*100,2);
				$percenRest = round(($this->_data['rest'] / $this->_data['targetYear'])*100,2);
				$this->_data['targetsUser'] ="['Thực thu', ".$percenReal."],['Còn lại', ".$percenRest."]";
			}
			//End Targets
			$this->_data["title"]  = 'Profile';
			$this->my_layout->view("cms/user/profile",$this->_data);
		}

		public function forgot()
		{					
			$myUser = '';
			$id = $this->_data['s_info']['s_user_id'];
			if(is_numeric($id)){
				$myUser = $this->muser->getData('',array("id"=>$id));				
				if($myUser['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			
			$this->_data['lang'] = my_lib::lang();	
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Update User';
			$this->_data['formData']	= array(					
				"user_email"=>$this->_data['s_info']['s_user_email'],																			
				"user_password"=>"",																			
			);			

			if(isset($_POST['fsubmit'])){
				$user_password = md5(trim($this->input->post('user_password')));
				$this->_data['formData']	= array(									
					"user_password"		=>  $user_password,				
					"user_updatedate"	=>	date("Y-m-d H:i:s"),			
				);	
				if($this->input->post('user_email')==$myUser['user_email']){									
					if($this->muser->edit($id,$this->_data['formData'])){
						/**begin sedmail*/
						$title = "Reset password ".$this->_data['s_info']['s_user_email'];
						$content = "Mật khẩu mới của bạn là: <strong><i>".$this->input->post('user_password')."</i></strong>";
						$this->Msendmail("BQT ".config_company,config_email_send,$this->input->post('user_email'),config_email_send,$bcc='',$title,$content,$file='');
						$this->_data['success'][] = "Vui lòng check mail để lấy mật khẩu";
						$this->_data['formData']	= array(					
							"user_email"=>$this->_data['s_info']['s_user_email'],
							"user_password"=>"",									
						);						
					}else{
						$this->_data['error'][] = "Update Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập email hoặc email không tồn tại";
				}
			}

			$this->my_layout->view("cms/user/forgot",$this->_data);
		}

		/**begin delete */
		public function delete($id)
		{			
			$this->muser->checkPermission('user', 'delete');	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$myUser = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myUser = $this->muser->getData('',array("id"=>$id));
				if($myUser['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->muser->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."user/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/user/delete",$this->_data);
		}
		/**end delete */


		/**begin ajax search autocomplete trang danh sach + tim kiem bai viet trong binh luan*/
		public function aj_autoCompleteIndex()
		{
			# code...		         
	        $key = isset($_REQUEST['key']) && $_REQUEST['key'] ? strtoupper($_REQUEST['key']):'';
	        $and='1';
	        if($key)
	        {
	        	$and .= ' and (user_fullname like "%'.$key.'%"';
				$and .= ' or user_username like "%'.$key.'%"';				
				$and .= ' or user_hotline like "%'.$key.'%"';
				$and .= ' or user_email like "%'.$key.'%")';				
	        }
	        $object = 'DISTINCT user_fullname,id';
	        $orderby = 'user_fullname asc';	        
	        $result = $this->muser->getQuery($object="",$join="",$and,$orderby,$limit="");        
	        $this->_data = array();
	        if($result)
	        {
	            foreach ($result as $key => $value) {
	                # code...
	                $row_array['user_fullname'] = $value['user_fullname'];                	                             
	                $row_array['id'] = $value['id'];                	                             
	                array_push($this->_data, $row_array);                        
	            }
	        }            
	        echo json_encode($this->_data);
		}
		/**begin ajax search autocomplete trang danh sach + tim kiem bai viet trong binh luan*/

		public function info()
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data["title"]  = 'Danh sách user';			
			$and = '  user_status = 1';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->muser->getQuery($object="",$join="",$and,$orderby,$limit="");
			$this->my_layout->view("cms/user/info",$this->_data);
		}
		public function sitemap()
		{
			$this->muser->checkPermission('user', 'sitemap');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data["title"]  = 'Sơ đồ tổ chức';			
			$and = 'user_status = 1 ';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->muser->getQuery($object="",$join="",$and,$orderby,$limit="");
			$this->my_layout->view("cms/user/sitemap",$this->_data);
		}

		public function targetAjax()
		{
			$html = '';
			$id = $this->input->post('id');
			$targets = $this->input->post('targets');
			if (isset($id) && $targets >= 0) {
				if($this->muser->edit($id,array('user_targets' => $targets))){
					$html .= '<div class="alert alert-dismissable alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Success!</strong> Cập nhật chỉ tiêu '. number_format($targets) .' thành công</div>';												
				}else{
					$html .= '<div class="alert alert-dismissable alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Error!</strong> Cập nhật không thành công!</div>';	
				}
			} else {
				$html .= '<div class="alert alert-dismissable alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Error!</strong> Chỉ tiêu phải là số dương</div>';	
                            }
			echo $html;
		}
		
	}
?>