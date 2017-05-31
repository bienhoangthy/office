<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class comment extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcomment");							
			$this->load->Model("cms/mnews");	
			$this->muser->checkLogin();						
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách bình luận';			
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fnewsid"=>isset($_REQUEST['fnewsid']) && $_REQUEST['fnewsid'] ? $_REQUEST['fnewsid']:0,
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
			);
			$and = '1';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (com_title like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or com_detail like "%'.$this->_data['formData']['fkeyword'].'%")';				
			}		
			if(isset($this->_data['formData']['fnewsid']) && $this->_data['formData']['fnewsid']!=0)
			{
				$and .= ' and news_id ='.$this->_data['formData']['fnewsid'];
			}		
			if(isset($this->_data['formData']['fstatus']) && $this->_data['formData']['fstatus']!="all")
			{
				$and .= ' and com_status ='.$this->_data['formData']['fstatus'];
			}

			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mcomment->getQuery($object="",$join="",$and,$orderby,$limit="");
			$this->_data['record'] = $this->mcomment->countQuery($join="",$and);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myComment = $this->mcomment->getData(array("id"=>$value));
							if($myComment['id']>0){								
								$this->mcomment->delete($value);															
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

			$this->_data['fstatus'] = $this->mcomment->dropdownlistStatus($this->_data['formData']['fstatus']);
			$this->my_layout->view("cms/comment/index",$this->_data);
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
			$this->_data["title"]  = 'Thêm mới bình luận';
			$this->_data['formData']	= array(
				"com_title"=>"",																																					
				"com_detail"=>"",
				"news_id"=>"",
				"hdnews_id"=>"",
				"com_parent"=>"",
				"user_post"=>"",
				"hduser_post"=>"",				
				"com_status"=>0,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"com_title"=>isset($_POST['com_title']) && $_POST['com_title'] ? $_POST['com_title']:'',																				
					"com_detail"=>isset($_POST['com_detail']) && $_POST['com_detail'] ? $_POST['com_detail']:'',																				
					"news_id"=>isset($_POST['news_id']) && $_POST['news_id'] ? $_POST['news_id']:'',																				
					"com_parent"=>isset($_POST['com_parent']) && $_POST['com_parent'] ? $_POST['com_parent']:'',																				
					"user_post"=>isset($_POST['user_post']) && $_POST['user_post'] ? $_POST['user_post']:'',																				
					"com_status"=>isset($_POST['com_status']) && $_POST['com_status'] ? $_POST['com_status']:'',																									
					"com_create_date"=>date("Y-m-d H:i:s"),
					"com_update_date"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['com_title']){
					$insert = $this->mcomment->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."comment/");
							header("location:".my_lib::cms_site()."comment/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}			
			$this->_data['com_status'] = $this->mcomment->dropdownlistStatus($this->_data['formData']['com_status']);
			$this->my_layout->view("cms/comment/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myComment = '';
			if(is_numeric($id)){
				$myComment = $this->mcomment->getData(array("id"=>$id));
				if($myComment['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật bình luận';
			$myNews = $this->mnews->getData(array("id"=>$myComment['news_id']));			
			$myUser = $this->muser->getData(array("id"=>$myComment['user_post']));			
			$this->_data['formData']	= array(
				"com_title"=>isset($myComment['com_title']) && $myComment['com_title'] ? $myComment['com_title']:'',															
				"com_detail"=>isset($myComment['com_detail']) && $myComment['com_detail'] ? $myComment['com_detail']:'',															
				"com_parent"=>isset($myComment['com_parent']) && $myComment['com_parent'] ? $myComment['com_parent']:'',															
				"news_id"=>isset($myComment['news_id']) && $myComment['news_id'] ? $myComment['news_id']:'',																			
				"hdnews_id"=>isset($myNews['news_name']) && $myNews['news_name'] ? $myNews['news_name']:'',																			
				"user_post"=>isset($myComment['user_post']) && $myComment['user_post'] ? $myComment['user_post']:'',																			
				"hduser_post"=>isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'',																			
				"com_status"=>isset($myComment['com_status']) && $myComment['com_status'] ? $myComment['com_status']:'',																							
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"com_title"=>isset($_POST['com_title']) && $_POST['com_title'] ? $_POST['com_title']:'',																				
					"com_detail"=>isset($_POST['com_detail']) && $_POST['com_detail'] ? $_POST['com_detail']:'',																				
					"news_id"=>isset($_POST['news_id']) && $_POST['news_id'] ? $_POST['news_id']:'',																				
					"com_parent"=>isset($_POST['com_parent']) && $_POST['com_parent'] ? $_POST['com_parent']:'',																				
					"user_post"=>isset($_POST['user_post']) && $_POST['user_post'] ? $_POST['user_post']:'',																				
					"com_status"=>isset($_POST['com_status']) && $_POST['com_status'] ? $_POST['com_status']:'',																									
					"com_update_date"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['com_title']){					
					if($this->mcomment->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Update success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."comment/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Update Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			$this->_data['com_status'] = $this->mcomment->dropdownlistStatus($this->_data['formData']['com_status']);
			$this->my_layout->view("cms/comment/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myComment = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myComment = $this->mcomment->getData(array("id"=>$id));
				if($myComment['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcomment->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."comment/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/comment/delete",$this->_data);
		}
		/**end delete */

		public function detail($id)
		{
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myComment = '';
			$this->_data['ortherComment'] = '';
			$this->_data['title'] = "Chi tiết";
			if(is_numeric($id)){
				$this->_data['myComment'] = $myComment = $this->mcomment->getData(array("id"=>$id));
				if($myComment['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
				$this->_data['ortherComment'] = $this->mcomment->getQuery($object="",$join="","news_id = ".$myComment["news_id"]." and id != ".$id,"id desc","0,10");
				$this->_data['title'] = $myComment['com_title'];
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}				
			$this->my_layout->view("cms/comment/detail",$this->_data);
		}
		
	}
?>