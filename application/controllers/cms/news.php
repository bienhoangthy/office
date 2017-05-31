<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class news extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mmenu");
			$this->load->Model("cms/mnews");
			$this->load->Model("cms/mevent");
			$this->load->Model("cms/mcomment");
		}
		public function index()
		{
			# code...		
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách bài viết';			
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fparent"=>isset($_REQUEST['fparent']) && $_REQUEST['fparent'] ? $_REQUEST['fparent']:0,
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
			);
			$and = '1';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (news_name like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or news_search like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or news_detail like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or news_alias like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or news_seo_title like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or news_seo_keyword like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or news_seo_description like "%'.$this->_data['formData']['fkeyword'].'%")';
			}		
			if(isset($this->_data['formData']['fparent']) && $this->_data['formData']['fparent']!=0)
			{
				$and .= ' and news_parent ='.$this->_data['formData']['fparent'];
			}		
			if(isset($this->_data['formData']['fstatus']) && $this->_data['formData']['fstatus']!="all")
			{
				$and .= ' and news_status ='.$this->_data['formData']['fstatus'];
			}

			// my_lib::printArr($_SERVER);
			
			/*begin phan trang*/
			$paging['per_page']         =   15;
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'news/?'.$query_string.'&page=';	
						
			/*end phan trang*/

			$this->_data['orderby']=$orderby = 'id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->mnews->getQuery($object="",$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->mnews->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myNews = $this->mnews->getData('',array("id"=>$value));
							if($myNews['id']>0){								
								$this->mnews->delete($value);															
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
			$this->_data['fparent'] = $this->mmenu->dropdownlist($this->_data['formData']['fparent']);
			$this->_data['fstatus'] = $this->mnews->dropdownlistStatus($this->_data['formData']['fstatus']);

			$this->my_layout->view("cms/news/index",$this->_data);
		}		
		public function add()
		{
			# code...
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');							
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới';
			$this->_data['formData']	= array(
				"news_name"=>"",								
				"news_alias"=>"",								
				"news_parent"=>"",								
				"news_orderby"=>"",								
				"news_type"=>"",								
				"news_event"=>"",								
				"hdnews_event"=>"",								
				"news_summary"=>"",								
				"news_detail"=>"",								
				"news_view"=>"",								
				"news_status"=>"1",								
				"news_hot"=>"",								
				"news_home"=>"",								
				"news_vip"=>"",									
				"news_comment"=>"",																																			
				"news_picture"=>"",								
				"news_picture_type"=>"",								
				"news_source"=>"",								
				"news_password"=>"",								
				"news_author"=>"",								
				"news_begin_date"=>date("Y-m-d"),
				"news_end_date"=>date((date("Y")+1)."-m-d"),
				"news_create_date"=>date("Y-m-d H:i:s"),
				"news_update_date"=>date("Y-m-d H:i:s"),
				"news_seo_title"=>"",								
				"news_seo_description"=>"",								
				"news_seo_keyword"=>"",								
				"news_lang"=>$this->_data['lang'],
				"user"=>$s_info['s_user_id']					
			);			

			if(isset($_POST['fsubmit'])){	
				/**begin chuyen doi hinh tu thu muc tmp sang thu muc news*/
				$picture = isset($_POST['news_picture']) && $_POST['news_picture'] ? $_POST['news_picture']:'';
				if($picture)
				{		
					$picture =  end(explode("/",$_POST['news_picture']));
					/**begin 4:3*/
					$tmp_file43 = dir_root.'/media/tmp/'.$picture;
					$tmp_copy43 = dir_root.'/media/news/'.$picture;	                
	                copy($tmp_file43, $tmp_copy43);	                
	                unlink($tmp_file43);
					/**begin 4:3*/

					/**begin 1:!*/
					$tmp_file11 = dir_root.'/media/tmp/'.str_replace("-thumb43", "-thumb11", $picture);
					$tmp_copy11 = dir_root.'/media/news/'.str_replace("-thumb43", "-thumb11", $picture);				               
	                copy($tmp_file11, $tmp_copy11);	  
	                unlink($tmp_file11);              
					/**begin 1:!*/

					/**begin 1:!*/
					$tmp_file169 = dir_root.'/media/tmp/'.str_replace("-thumb43", "-thumb169", $picture);
					$tmp_copy169 = dir_root.'/media/news/'.str_replace("-thumb43", "-thumb169", $picture);				               
	                copy($tmp_file169, $tmp_copy169);	
	                unlink($tmp_file169);                
					/**begin 1:!*/

					$picture = '/media/news/'.$picture; //mac dinh 4:3
	            }

			
				$this->_data['formData']	= array(
					"news_name"=>isset($_POST['news_name']) && $_POST['news_name'] ? htmlspecialchars($_POST['news_name'],ENT_QUOTES):'',
					"news_alias"=>isset($_POST['news_alias']) && $_POST['news_alias'] ? $_POST['news_alias']:'',										
					"news_parent"=>isset($_POST['news_parent']) && $_POST['news_parent'] ? $_POST['news_parent']:'',										
					"news_orderby"=>isset($_POST['news_orderby']) && $_POST['news_orderby'] ? $_POST['news_orderby']:'',										
					"news_type"=>isset($_POST['news_type']) && $_POST['news_type'] ? $_POST['news_type']:'',										
					"news_event"=>isset($_POST['news_event']) && $_POST['news_event'] ? $_POST['news_event']:'',										
					"news_summary"=>isset($_POST['news_summary']) && $_POST['news_summary'] ? $_POST['news_summary']:'',										
					"news_detail"=>isset($_POST['news_detail']) && $_POST['news_detail'] ? $_POST['news_detail']:'',										
					"news_view"=>isset($_POST['news_view']) && $_POST['news_view'] ? $_POST['news_view']:'',										
					"news_status"=>isset($_POST['news_status']) && $_POST['news_status'] ? $_POST['news_status']:'',										
					"news_hot"=>isset($_POST['news_hot']) && $_POST['news_hot'] ? $_POST['news_hot']:'',										
					"news_vip"=>isset($_POST['news_vip']) && $_POST['news_vip'] ? $_POST['news_vip']:'',															
					"news_home"=>isset($_POST['news_home']) && $_POST['news_home'] ? $_POST['news_home']:'',										
					"news_comment"=>isset($_POST['news_comment']) && $_POST['news_comment'] ? $_POST['news_comment']:'',										
					"news_picture"=>$picture,										
					"news_source"=>isset($_POST['news_source']) && $_POST['news_source'] ? $_POST['news_source']:'',										
					"news_password"=>isset($_POST['news_password']) && $_POST['news_password'] ? $_POST['news_password']:'',										
					"news_author"=>isset($_POST['news_author']) && $_POST['news_author'] ? $_POST['news_author']:'',										
					"news_begin_date"=>isset($_POST['news_begin_date']) && $_POST['news_begin_date'] ? $_POST['news_begin_date']:'',										
					"news_end_date"=>isset($_POST['news_end_date']) && $_POST['news_end_date'] ? $_POST['news_end_date']:'',										
					"news_create_date"=>date("Y-m-d H:i:s"),
					"news_update_date"=>date("Y-m-d H:i:s"),
					"news_seo_title"=>isset($_POST['news_seo_title']) && $_POST['news_seo_title'] ? $_POST['news_seo_title']:'',										
					"news_seo_description"=>isset($_POST['news_seo_description']) && $_POST['news_seo_description'] ? $_POST['news_seo_description']:'',										
					"news_seo_keyword"=>isset($_POST['news_seo_keyword']) && $_POST['news_seo_keyword'] ? $_POST['news_seo_keyword']:'',										
					"news_lang"=>$this->_data['lang'],
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['news_name']){
					$insert = $this->mnews->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."news/");
							header("location:".my_lib::cms_site()."news/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên bài viết";
				}
			}

			/**begin com parent*/
			$this->_data['parent'] = $this->mmenu->dropdownlist($this->_data['formData']['news_parent']);
			$this->_data['news_type'] = $this->mnews->dropdownlistType($this->_data['formData']['news_type']);
			$this->_data['news_status'] = $this->mnews->dropdownlistStatus($this->_data['formData']['news_status']);
			/**end com parent*/

			$this->my_layout->view("cms/news/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myNews = '';
			if(is_numeric($id)){
				$myNews = $this->mnews->getData('',array("id"=>$id));
				if($myNews['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật';
			$myEvent = $this->mevent->getData('',array("id"=>$myNews['news_event']));			
			$this->_data['formData']	= array(
				"news_name"=>isset($myNews['news_name']) ? $myNews['news_name']:'',								
				"news_alias"=>isset($myNews['news_alias']) ? $myNews['news_alias']:'',								
				"news_parent"=>isset($myNews['news_parent']) ? $myNews['news_parent']:'',								
				"news_orderby"=>isset($myNews['news_orderby']) ? $myNews['news_orderby']:'',								
				"news_type"=>isset($myNews['news_type']) ? $myNews['news_type']:'',								
				"news_event"=>isset($myNews['news_event']) ? $myNews['news_event']:'',								
				"hdnews_event"=>isset($myEvent['event_name']) ? $myEvent['event_name']:'',								
				"news_summary"=>isset($myNews['news_summary']) ? $myNews['news_summary']:'',								
				"news_detail"=>isset($myNews['news_detail']) ? $myNews['news_detail']:'',								
				"news_view"=>isset($myNews['news_view']) ? $myNews['news_view']:'',								
				"news_status"=>isset($myNews['news_status']) ? $myNews['news_status']:'',							
				"news_hot"=>isset($myNews['news_hot']) ? $myNews['news_hot']:'',								
				"news_home"=>isset($myNews['news_home']) ? $myNews['news_home']:'',								
				"news_vip"=>isset($myNews['news_vip']) ? $myNews['news_vip']:'',																																			
				"news_comment"=>isset($myNews['news_comment']) ? $myNews['news_comment']:'',																																			
				"news_picture"=>isset($myNews['news_picture']) ? $myNews['news_picture']:'',								
				"news_source"=>isset($myNews['news_source']) ? $myNews['news_source']:'',								
				"news_password"=>isset($myNews['news_password']) ? $myNews['news_password']:'',								
				"news_author"=>isset($myNews['news_author']) ? $myNews['news_author']:'',
				"news_begin_date"=>isset($myNews['news_begin_date']) ? $myNews['news_begin_date']:'',
				"news_end_date"=>isset($myNews['news_end_date']) ? $myNews['news_end_date']:'',				
				"news_update_date"=>date("Y-m-d H:i:s"),
				"news_seo_title"=>isset($myNews['news_seo_title']) ? $myNews['news_seo_title']:'',								
				"news_seo_description"=>isset($myNews['news_seo_description']) ? $myNews['news_seo_description']:'',								
				"news_seo_keyword"=>isset($myNews['news_seo_keyword']) ? $myNews['news_seo_keyword']:'',								
				"user"=>$s_info['s_user_id']						
			);			

			$this->_data["title"]  = $this->_data['formData']['news_name'] ? $this->_data['formData']['news_name'] : 'Cập nhật';			
			if(isset($_POST['fsubmit'])){
				/**begin chuyen doi hinh tu thu muc tmp sang thu muc news*/
				$picture = isset($_POST['news_picture']) && $_POST['news_picture'] ? $_POST['news_picture']:'';
				if($picture && $picture != $this->_data['formData']['news_picture'])
				{			
					$picture = end(explode("/",$_POST['news_picture']));
					/**begin 4:3*/
					$tmp_file43 = dir_root.'/media/tmp/'.$picture;
					$tmp_copy43 = dir_root.'/media/news/'.$picture;	                
	                copy($tmp_file43, $tmp_copy43);
	                unlink($tmp_file43);	                
					/**begin 4:3*/

					/**begin 1:!*/
					$tmp_file11 = dir_root.'/media/tmp/'.str_replace("-thumb43", "-thumb11", $picture);
					$tmp_copy11 = dir_root.'/media/news/'.str_replace("-thumb43", "-thumb11", $picture);				               
	                copy($tmp_file11, $tmp_copy11);
	                unlink($tmp_file11);	                
					/**begin 1:!*/

					/**begin 1:!*/
					$tmp_file169 = dir_root.'/media/tmp/'.str_replace("-thumb43", "-thumb169", $picture);
					$tmp_copy169 = dir_root.'/media/news/'.str_replace("-thumb43", "-thumb169", $picture);				               
	                copy($tmp_file169, $tmp_copy169);	
	                unlink($tmp_file169);                
					/**begin 1:!*/

					$picture = '/media/news/'.$picture; //mac dinh 4:3
	            }

				/**end chuyen doi hinh tu thu muc tmp sang thu muc news*/
				$this->_data['formData']	= array(
					"news_name"=>isset($_POST['news_name']) && $_POST['news_name'] ? htmlspecialchars($_POST['news_name'],ENT_QUOTES):'',
					"news_alias"=>isset($_POST['news_alias']) && $_POST['news_alias'] ? $_POST['news_alias']:'',										
					"news_parent"=>isset($_POST['news_parent']) && $_POST['news_parent'] ? $_POST['news_parent']:'',										
					"news_orderby"=>isset($_POST['news_orderby']) && $_POST['news_orderby'] ? $_POST['news_orderby']:'',										
					"news_type"=>isset($_POST['news_type']) && $_POST['news_type'] ? $_POST['news_type']:'',										
					"news_event"=>isset($_POST['news_event']) && $_POST['news_event'] ? $_POST['news_event']:'',										
					"news_summary"=>isset($_POST['news_summary']) && $_POST['news_summary'] ? $_POST['news_summary']:'',										
					"news_detail"=>isset($_POST['news_detail']) && $_POST['news_detail'] ? $_POST['news_detail']:'',										
					"news_view"=>isset($_POST['news_view']) && $_POST['news_view'] ? $_POST['news_view']:'',										
					"news_status"=>isset($_POST['news_status']) && $_POST['news_status'] ? $_POST['news_status']:'',										
					"news_hot"=>isset($_POST['news_hot']) && $_POST['news_hot'] ? $_POST['news_hot']:'',										
					"news_vip"=>isset($_POST['news_vip']) && $_POST['news_vip'] ? $_POST['news_vip']:'',															
					"news_home"=>isset($_POST['news_home']) && $_POST['news_home'] ? $_POST['news_home']:'',										
					"news_comment"=>isset($_POST['news_comment']) && $_POST['news_comment'] ? $_POST['news_comment']:'',										
					"news_picture"=>$picture,										
					"news_source"=>isset($_POST['news_source']) && $_POST['news_source'] ? $_POST['news_source']:'',										
					"news_password"=>isset($_POST['news_password']) && $_POST['news_password'] ? $_POST['news_password']:'',										
					"news_author"=>isset($_POST['news_author']) && $_POST['news_author'] ? $_POST['news_author']:'',										
					"news_begin_date"=>isset($_POST['news_begin_date']) && $_POST['news_begin_date'] ? $_POST['news_begin_date']:'',										
					"news_end_date"=>isset($_POST['news_end_date']) && $_POST['news_end_date'] ? $_POST['news_end_date']:'',															
					"news_update_date"=>date("Y-m-d H:i:s"),
					"news_seo_title"=>isset($_POST['news_seo_title']) && $_POST['news_seo_title'] ? $_POST['news_seo_title']:'',										
					"news_seo_description"=>isset($_POST['news_seo_description']) && $_POST['news_seo_description'] ? $_POST['news_seo_description']:'',										
					"news_seo_keyword"=>isset($_POST['news_seo_keyword']) && $_POST['news_seo_keyword'] ? $_POST['news_seo_keyword']:'',										
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['news_name']){					
					if($this->mnews->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."news/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên bài viết";
				}
			}

			/**begin com parent*/
			$this->_data['parent'] = $this->mmenu->dropdownlist($this->_data['formData']['news_parent']);
			$this->_data['news_type'] = $this->mnews->dropdownlistType($this->_data['formData']['news_type']);
			$this->_data['news_status'] = $this->mnews->dropdownlistStatus($this->_data['formData']['news_status']);
			/**end com parent*/

			$this->my_layout->view("cms/news/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$myNews = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myNews = $this->mnews->getData('',array("id"=>$id));
				if($myNews['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mnews->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."news/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/news/delete",$this->_data);
		}
		/**end delete */

		public function detail($id)
		{
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$myNews = '';
			$this->_data['ortherNews'] = '';			
			if(is_numeric($id)){
				$this->_data['myNews'] = $myNews = $this->mnews->getData('',array("id"=>$id));
				if($myNews['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
				$this->_data['listComment'] = $this->mcomment->getQuery("","","news_id=".$id,"id desc","");
				$this->_data['countComment'] = isset($this->_data['listComment']) && $this->_data['listComment'] ? count($this->_data['listComment']):0;
				$this->_data['ortherNews'] = $this->mnews->getQuery($object="",$join="","news_status=1 and id != ".$id,"id desc","0,10");
				$this->_data['title'] = $myNews['news_name'];

				/**begin moi binh luan khi xem bai viet*/
				$this->_data['formData']	= array(
					"com_title"=>"",																																					
					"com_detail"=>"",
					"news_id"=>$id,					
					"com_parent"=>0,
					"user_post"=>$s_info['s_user_id'],
					"com_status"=>0,
				);			
				/**begin cap nhat trang thai + duyet danh mục*/
				if(isset($_POST['fsubmitStatus'])){
					$this->_data['formData']	= array(						
						"news_parent"=>isset($_POST['news_parent']) && $_POST['news_parent'] ? $_POST['news_parent']:'',																
						"news_status"=>isset($_POST['news_status']) && $_POST['news_status'] ? $_POST['news_status']:'',																
						"news_status_note"=>isset($_POST['news_status_note']) && $_POST['news_status_note'] && isset($_POST['news_status']) && $_POST['news_status']!=1 ? $_POST['news_status_note']:'',																
						"news_update_date"=>date("Y-m-d H:i:s"),						
						"user"=>$s_info['s_user_id']
					);	
					if($this->_data['formData']['news_parent']){					
						if($this->mnews->edit($id,$this->_data['formData'])){							
							header("location:".my_lib::cms_site()."news/detail/".$id);							
						}
					}
				}
				/**end cap nhat trang thai + duyet danh mục*/

				/**begin add binh luan*/
				if(isset($_POST['fsubmit'])){				
					$this->_data['formData']	= array(
						"com_title"=>isset($_POST['com_title']) && $_POST['com_title'] ? $_POST['com_title']:'',																				
						"com_detail"=>isset($_POST['com_detail']) && $_POST['com_detail'] ? $_POST['com_detail']:'',
						"news_id"=>$id,
						"com_parent"=>0,
						"user_post"=>$s_info['s_user_id'],
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
							header("location:".my_lib::cms_site()."news/detail/".$id."/#comment".$insert);							
							/**end chuyen trang*/
						}else{
							$this->_data['error'][] = "Add Not Success";
						}
					}else{
						$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
					}
				}	
				/**end add binh luan*/					
				$this->_data['parent'] = $this->mmenu->dropdownlist($myNews['news_parent']);
				$this->_data['news_status'] = $this->mnews->dropdownlistStatus($myNews['news_status']);	
				$this->_data['com_status'] = $this->mcomment->dropdownlistStatus($this->_data['formData']['com_status']);
				/**end moi binh luan khi xem bai viet*/
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}				
			$this->my_layout->view("cms/news/detail",$this->_data);
		}

		/**begin alias menu*/
		public function aj_aliasnews()
		{
			# code...
			# code...
			$html = '';
			$name = isset($_REQUEST['name']) ? trim($_REQUEST['name']):'';
			if($name){
				$html  = my_lib::convert_alias($name);
				/**begin kiem tra va conver name thanh alias*/
				$check = $this->mnews->countQuery("","news_alias='".$html."'");
				if($check>0){
					$html = $html.'-trung-lap';
				}
			}
			echo $html;
		}
		/**end alias menu*/

		/**begin ajax search autocomplete trang danh sach + tim kiem bai viet trong binh luan*/
		public function aj_autoCompleteIndex()
		{
			# code...		         
	        $key = isset($_REQUEST['key']) && $_REQUEST['key'] ? strtoupper($_REQUEST['key']):'';
	        $and='1';
	        if($key)
	        {
	        	$and .= ' and (news_name like "%'.$key.'%"';
				$and .= ' or news_search like "%'.$key.'%"';				
				$and .= ' or news_alias like "%'.$key.'%"';
				$and .= ' or news_seo_title like "%'.$key.'%"';
				$and .= ' or news_seo_keyword like "%'.$key.'%"';
				$and .= ' or news_seo_description like "%'.$key.'%")';	           
	        }
	        $object = 'DISTINCT news_name,id';
	        $orderby = 'news_name asc';	        
	        $result = $this->mnews->getQuery($object="",$join="",$and,$orderby,$limit="");        
	        $this->_data = array();
	        if($result)
	        {
	            foreach ($result as $key => $value) {
	                # code...
	                $row_array['news_name'] = $value['news_name'];                	                             
	                $row_array['id'] = $value['id'];                	                             
	                array_push($this->_data, $row_array);                        
	            }
	        }            
	        echo json_encode($this->_data);
		}
		/**begin ajax search autocomplete trang danh sach + tim kiem bai viet trong binh luan*/


		/**begin ajax proccess hinh anh crop*/
		public function aj_proccessImages()
		{
			# code...
			$html = '';
			$path = 'media/tmp/';			
			/**begin hinh 16:9*/
			$root_img=isset($_REQUEST['root_img']) && $_REQUEST['root_img'] ? ltrim($_REQUEST['root_img'],"/"):'';			
			$img169_x=isset($_REQUEST['img169_x']) && $_REQUEST['img169_x'] ? $_REQUEST['img169_x']:'';
			$img169_y=isset($_REQUEST['img169_y']) && $_REQUEST['img169_y'] ? $_REQUEST['img169_y']:'';
			$img169_x1=isset($_REQUEST['img169_x1']) && $_REQUEST['img169_x1'] ? $_REQUEST['img169_x1']:'';
			$img169_y1=isset($_REQUEST['img169_y1']) && $_REQUEST['img169_y1'] ? $_REQUEST['img169_y1']:'';
			$img169_x2=isset($_REQUEST['img169_x2']) && $_REQUEST['img169_x2'] ? $_REQUEST['img169_x2']:'';
			$img169_y2=isset($_REQUEST['img169_y2']) && $_REQUEST['img169_y2'] ? $_REQUEST['img169_y2']:'';
			$name_img = end(explode("/", $root_img));
			$name_img = explode(".", $name_img);			
			$name_img = $name_img[0];
			$prefix_name=isset($_REQUEST['prefix_name']) && $_REQUEST['prefix_name'] ? $_REQUEST['prefix_name']:date("YMdHi");	
			$prefix_name = $prefix_name.rand(0,1000).'-'.$name_img;

			/**hinh 16:9*/	
			$path_img_news_169 = $path.$prefix_name.'-thumb169.jpg';
			$this->image_moo->load($root_img)
			->set_background_colour("#fff")
			->make_watermark_text("phunuvietnam.com.vn", "DANUBE__.TTF", 25, "#000")
			->crop($img169_x1,$img169_y1,$img169_x2,$img169_y2)
			->watermark(2)
			->save($path_img_news_169);  								
			$html .= '<div class="col-lg-4 show_img_16_9"><img class="tmp_del_thumb169" src="/'.$path_img_news_169.'" /> <br />{16:9}</div>';

			/**hinh 4:3*/				
			$path_img_news_43 = $path.$prefix_name.'-thumb43.jpg';
			$this->image_moo->load($root_img)				
			->set_background_colour("#fff")
			->make_watermark_text("phunuvietnam.com.vn", "DANUBE__.TTF", 25, "#000")
			->resize(400,300)
			->watermark(2)
			->save($path_img_news_43);  					
			$html .= '<div class="col-lg-4 show_img_4_3"><img class="tmp_del_thumb43" id="save_img" src="/'.$path_img_news_43.'" /> <br />{4:3}</div>';				
			

			/**hinh 4:3*/				
			$path_img_news_11 = $path.$prefix_name.'-thumb11.jpg';
			$this->image_moo->load($root_img)				
			->set_background_colour("#fff")
			->make_watermark_text("phunuvietnam.com.vn", "DANUBE__.TTF", 25, "#000")
			->resize_crop(200,200)
			->watermark(2)
			->save($path_img_news_11);  					
			$html .= '<div class="col-lg-4 show_img_1_1"><img class="tmp_del_thumb11" src="/'.$path_img_news_11.'" /> <br />{1:1}</div>';				
			


			echo $html;
			// echo $path_img_news;
		}
		/**end ajax proccess hinh anh crop*/

		/**begin scrop hinh anh khi chon hinh, dua hinh anh dang nho truoc aj_scropImgBegin
		@ dua ve kich thuoc chieu width: 400px
		*/
		public function aj_scropImgBegin()
		{
			# code...
			$scr_img=isset($_REQUEST['scr_img']) && $_REQUEST['scr_img'] ? ltrim($_REQUEST['scr_img'],"/"):'';						
			if($scr_img){
				$path = 'media/tmp/';			
				$name_img =end(explode("/", $scr_img));
				$path_img_news = $path.$name_img;
				$this->image_moo->load($scr_img)				
				->resize_crop(600,400)
				->save($path_img_news);  					
				/**end hinh 16:9*/
				echo '/'.$path_img_news;
			}
		}	

		/**begin xoa hinh anh khi xu ly upload*/
		public function aj_proccessDelImg()
		{
			# code...
			$html = '';
			$thumb169 = isset($_REQUEST['thumb169']) && $_REQUEST['thumb169'] ? ltrim($_REQUEST['thumb169'],"/"):'';
			$thumb43 = isset($_REQUEST['thumb43']) && $_REQUEST['thumb43'] ? ltrim($_REQUEST['thumb43'],"/"):'';
			$thumb11 = isset($_REQUEST['thumb11']) && $_REQUEST['thumb11'] ? ltrim($_REQUEST['thumb11'],"/"):'';			
			if($thumb169 && $thumb43 && $thumb11)
			{
				if(isset($thumb169) && file_exists($thumb169)){
                    unlink($thumb169);
                }
				if(isset($thumb43) && file_exists($thumb43)){
                    unlink($thumb43);
                }
				if(isset($thumb11) && file_exists($thumb11)){
                    unlink($thumb11);
                }
                $html = 1;
			}else{
				$html = '<div class="alert alert-warning">Error File</div>';
			}
			echo $html;
		}
		/**end xoa hinh anh khi xu ly upload*/
	}
?>