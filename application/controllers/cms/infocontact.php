<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* contact_name_call: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class infocontact extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/minfocontact");	
			$this->load->Model("cms/mcompany");	
		}
		public function index()
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách khách hàng';			
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
			);
			$and = ' 1 ';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (contact_name like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or company_id like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or contact_name_call like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or contact_email like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or contact_position like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or contact_note like "%'.$this->_data['formData']['fkeyword'].'%")';
			}					

			// my_lib::printArr($_SERVER);
			
			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'infocontact/?'.$query_string.'&page=';			
			/*end phan trang*/

			$this->_data['orderby']=$orderby = 'id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->minfocontact->getQuery($object="",$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->minfocontact->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompany = $this->minfocontact->getData('',array("id"=>$value));
							if($myCompany['id']>0){								
								$this->minfocontact->delete($value);
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

			$this->my_layout->view("cms/infocontact/index",$this->_data);
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
				"company_id"=>"",																																																	
				"contact_name"=>"",
				"contact_name_call"=>"",
				"contact_phone"=>"",
				"contact_email"=>"",
				"contact_position"=>"",
				"contact_note"=>"",
				"user"=>$s_info['s_user_id']
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"company_id"=>$this->input->post('company_id'),
					"contact_name_call"=>$this->input->post('contact_name_call'),
					"contact_name"=>$this->input->post('contact_name'),
					"contact_email"=>$this->input->post('contact_email'),
					"contact_position"=>$this->input->post('contact_position'),
					"contact_note"=>$this->input->post('contact_note'),
					"contact_phone"=>$this->input->post('contact_phone'),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['company_id']){
					$insert = $this->minfocontact->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."infocontact/");
							header("location:".my_lib::cms_site()."infocontact/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/infocontact/add",$this->_data);
		}		
		public function popup()
		{
			
			$this->_data['lang'] = my_lib::lang();
			$redirect = $this->input->post('redirect');			
			$this->_data['formData']	= array(
				"company_id"=>$this->input->post('company_id'),
				"contact_name_call"=>$this->input->post('contact_name_call'),
				"contact_name"=>$this->input->post('contact_name'),
				"contact_email"=>$this->input->post('contact_email'),
				"contact_position"=>$this->input->post('contact_position'),
				"contact_note"=>$this->input->post('contact_note'),
				"contact_phone"=>$this->input->post('contact_phone'),				
				"user"=>$this->_data['s_info']['s_user_id']
			);	
			if($this->_data['formData']['company_id']){
				$insert = $this->minfocontact->add($this->_data['formData']);
				if(is_numeric($insert)>0){			
					header("location:".base64_decode($redirect));					
				}
			}
			
			$this->my_layout->view("cms/infocontact/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myInfoContact = '';
			if(is_numeric($id)){
				$myInfoContact = $this->minfocontact->getData('',array("id"=>$id));
				if($myInfoContact['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}

			$this->_data['type'] = isset($_REQUEST['type']) ? $_REQUEST['type'] :'';
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật';
			$this->_data['formData']	= array(
				"company_id"=>$myInfoContact['company_id'],
				"contact_name"=>$myInfoContact['contact_name'],
				"contact_name_call"=>$myInfoContact['contact_name_call'],
				"contact_phone"=>$myInfoContact['contact_phone'],
				"contact_email"=>$myInfoContact['contact_email'],
				"contact_position"=>$myInfoContact['contact_position'],
				"contact_note"=>$myInfoContact['contact_note'],
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"company_id"=>$this->input->post('company_id'),
					"contact_name_call"=>$this->input->post('contact_name_call'),
					"contact_name"=>$this->input->post('contact_name'),
					"contact_email"=>$this->input->post('contact_email'),
					"contact_position"=>$this->input->post('contact_position'),
					"contact_note"=>$this->input->post('contact_note'),
					"contact_phone"=>$this->input->post('contact_phone')
				);	
				if($this->_data['formData']['company_id']){					
					if($this->minfocontact->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."infocontact/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/infocontact/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myInfoContact = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myInfoContact = $this->minfocontact->getData('',array("id"=>$id));
				if(isset($myInfoContact['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->minfocontact->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."infocontact/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/infocontact/delete",$this->_data);
		}
		/**end delete */

				
	}
?>