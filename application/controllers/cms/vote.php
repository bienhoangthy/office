<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class vote extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mvote");							
			$this->load->Model("cms/mvote_reply");							
			$this->load->Model("cms/mmenu");						
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách bình chọn';			
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:0,
				"fmenuid"=>isset($_REQUEST['fmenuid']) && $_REQUEST['fmenuid'] ? $_REQUEST['fmenuid']:0,
			);
			$and = '1';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (vote_name like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or vote_content like "%'.$this->_data['formData']['fkeyword'].'%")';				
			}		
			if(isset($this->_data['formData']['fnewsid']) && $this->_data['formData']['fnewsid']!=0)
			{
				$and .= ' and vote_note_status ='.$this->_data['formData']['fnewsid'];
			}		
			if(isset($this->_data['formData']['fstatus']) && $this->_data['formData']['fstatus']!=0)
			{
				$and .= ' and vote_status ='.$this->_data['formData']['fstatus'];
			}

			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mvote->getQuery($object="",$join="",$and,$orderby,$limit="");
			$this->_data['record'] = $this->mvote->countQuery($join="",$and);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myVote = $this->mvote->getData('',array("id"=>$value));
							if($myVote['id']>0){								
								$this->mvote->delete($value);															
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
			$this->_data['fmenuid'] = $this->mmenu->dropdownlist($this->_data['formData']['fmenuid']);
			$this->_data['fstatus'] = $this->mvote->dropdownlistStatus($this->_data['formData']['fstatus']);
			$this->my_layout->view("cms/vote/index",$this->_data);
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
			$this->_data["title"]  = 'Thêm mới bình chọn';
			$this->_data['formData']	= array(
				"vote_name"=>"",																																					
				"vote_content"=>"",
				"vote_note_status"=>"",
				"menu_id"=>"",			
				"vote_create_date"=>date("Y-m-d"),			
				"vote_update_date"=>date("Y-m-".(date("d")+7)),			
				"vote_status"=>2,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"vote_name"=>isset($_POST['vote_name']) && $_POST['vote_name'] ? $_POST['vote_name']:'',																				
					"vote_content"=>isset($_POST['vote_content']) && $_POST['vote_content'] ? $_POST['vote_content']:'',																				
					"vote_note_status"=>isset($_POST['vote_note_status']) && $_POST['vote_note_status'] ? $_POST['vote_note_status']:'',																				
					"menu_id"=>isset($_POST['menu_id']) && $_POST['menu_id'] ? $_POST['menu_id']:'',																																							
					"vote_status"=>isset($_POST['vote_status']) && $_POST['vote_status'] ? $_POST['vote_status']:'',																									
					"vote_create_date"=>isset($_POST['vote_create_date']) && $_POST['vote_create_date'] ? $_POST['vote_create_date']:date("Y-m-d H:i:s"),																									
					"vote_update_date"=>isset($_POST['vote_update_date']) && $_POST['vote_update_date'] ? $_POST['vote_update_date']:date("Y-m-d H:i:s"),																									
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['vote_name']){
					$insert = $this->mvote->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."vote/");
							header("location:".my_lib::cms_site()."vote/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}			
			$this->_data['menu_id'] = $this->mmenu->dropdownlist($this->_data['formData']['menu_id']);
			$this->_data['vote_status'] = $this->mvote->dropdownlistStatus($this->_data['formData']['vote_status']);
			$this->my_layout->view("cms/vote/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myVote = '';
			if(is_numeric($id)){
				$myVote = $this->mvote->getData('',array("id"=>$id));
				if($myVote['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật bình chọn';		
			$this->_data['formData']	= array(
				"vote_name"=>isset($myVote['vote_name']) && $myVote['vote_name'] ? $myVote['vote_name']:'',															
				"vote_content"=>isset($myVote['vote_content']) && $myVote['vote_content'] ? $myVote['vote_content']:'',															
				"menu_id"=>isset($myVote['menu_id']) && $myVote['menu_id'] ? $myVote['menu_id']:'',															
				"vote_note_status"=>isset($myVote['vote_note_status']) && $myVote['vote_note_status'] ? $myVote['vote_note_status']:'',																																					
				"vote_status"=>isset($myVote['vote_status']) && $myVote['vote_status'] ? $myVote['vote_status']:'',																							
				"vote_create_date"=>isset($myVote['vote_create_date']) && $myVote['vote_create_date'] ? $myVote['vote_create_date']:'',																							
				"vote_update_date"=>isset($myVote['vote_update_date']) && $myVote['vote_update_date'] ? $myVote['vote_update_date']:'',																							
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"vote_name"=>isset($_POST['vote_name']) && $_POST['vote_name'] ? $_POST['vote_name']:'',																				
					"vote_content"=>isset($_POST['vote_content']) && $_POST['vote_content'] ? $_POST['vote_content']:'',																				
					"vote_note_status"=>isset($_POST['vote_note_status']) && $_POST['vote_note_status'] ? $_POST['vote_note_status']:'',																				
					"menu_id"=>isset($_POST['menu_id']) && $_POST['menu_id'] ? $_POST['menu_id']:'',																				
					"vote_status"=>isset($_POST['vote_status']) && $_POST['vote_status'] ? $_POST['vote_status']:'',																									
					"vote_create_date"=>isset($_POST['vote_create_date']) && $_POST['vote_create_date'] ? $_POST['vote_create_date']:date("Y-m-d H:i:s"),																									
					"vote_update_date"=>isset($_POST['vote_update_date']) && $_POST['vote_update_date'] ? $_POST['vote_update_date']:date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['vote_name']){					
					if($this->mvote->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."vote/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			$this->_data['menu_id'] = $this->mmenu->dropdownlist($this->_data['formData']['menu_id']);
			$this->_data['vote_status'] = $this->mvote->dropdownlistStatus($this->_data['formData']['vote_status']);
			$this->my_layout->view("cms/vote/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myVote = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myVote = $this->mvote->getData('',array("id"=>$id));
				if($myVote['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mvote->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."vote/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/vote/delete",$this->_data);
		}
		/**end delete */

		public function detail($id)
		{
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myVote = '';
			$this->_data['ortherVote'] = '';
			$this->_data['title'] = "Chi tiết";
			if(is_numeric($id)){
				$this->_data['myVote'] = $myVote = $this->mvote->getData('',array("id"=>$id));
				if($myVote['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
				/**begin them moi binh chon*/
				$this->_data['formData']	= array(
					"reply_name"=>"",																																					
					"reply_orderby"=>"",
					"vote_id"=>$id,					
					"reply_status"=>1,					
					"reply_view"=>0,
					"reply_create_date"=>date("Y-m-d H:i:s"),
					"reply_update_date"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id'],
				);

				if(isset($_POST['fsubmit'])){				
					$this->_data['formData']	= array(
						"reply_name"=>isset($_POST['reply_name']) && $_POST['reply_name'] ? $_POST['reply_name']:'',																				
						"reply_orderby"=>isset($_POST['reply_orderby']) && $_POST['reply_orderby'] ? $_POST['reply_orderby']:'',
						"vote_id"=>$id,
						"reply_view"=>0,
						"reply_status"=>isset($_POST['reply_status']) && $_POST['reply_status'] ? $_POST['reply_status']:'',
						"reply_create_date"=>date("Y-m-d H:i:s"),
						"reply_update_date"=>date("Y-m-d H:i:s"),
						"user"=>$s_info['s_user_id']
					);	
					if($this->_data['formData']['reply_name']){
						$insert = $this->mvote_reply->add($this->_data['formData']);
						if(is_numeric($insert)>0){
							$this->_data['success'][] = "Add success";
							$this->_data['formData'] = NULL;
							/**begin chuyen trang*/										
							$redirect = isset($_REQUEST['redirect']) && $_REQUEST['redirect'] ? '?'.$_REQUEST['redirect']:'';			
							header("location:".my_lib::cms_site()."vote/detail/".$id."/".$redirect);							
							/**end chuyen trang*/
						}else{
							$this->_data['error'][] = "Add Not Success";
						}
					}else{
						$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
					}
				}	
				/**end them moi binh chon*/
				$this->_data['listVoteReply'] = $this->mvote_reply->getQuery("","","vote_id=".$myVote['id'],"reply_orderby","");

				//tong tat ca binh chon
				$this->_data['countVoteReply'] = $this->mvote_reply->getQuery("sum(reply_view) as count","","vote_id=".$myVote['id'],"reply_orderby",""); 
				$this->_data['countVoteReply'] = isset($this->_data['countVoteReply'][0]['count']) && $this->_data['countVoteReply'][0]['count']>0 ? $this->_data['countVoteReply'][0]['count']:0;
				$this->_data['reply_status'] = $this->mvote_reply->dropdownlistStatus($this->_data['formData']['reply_status']);	
				$this->_data['ortherVote'] = $this->mvote->getQuery($object="",$join="","id != ".$id,"id desc","0,10");
				$this->_data['title'] = $myVote['vote_name'];
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}				
			$this->my_layout->view("cms/vote/detail",$this->_data);
		}
		
	}
?>