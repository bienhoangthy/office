<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class company_work extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mcompany_work");	
			$this->load->Model("cms/minfocontact");	
			$this->load->Model("cms/mcompany_work_status");	
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
				$and .= ' and (create_date like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or phone like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or employee_name like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or infocontact_id like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or contact_content like "%'.$this->_data['formData']['fkeyword'].'%")';
			}					

			// my_lib::printArr($_SERVER);
			
			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'company_work/?'.$query_string.'&page=';			
			/*end phan trang*/

			$this->_data['orderby']=$orderby = 'status,id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->mcompany_work->getQuery($object="",$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->mcompany_work->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myCompany = $this->mcompany_work->getData('',array("id"=>$value));
							if($myCompany['id']>0){								
								$this->mcompany_work->delete($value);
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

			$this->my_layout->view("cms/company_work/index",$this->_data);
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
				"create_date"=>"",																																																	
				"time"=>"",
				"phone"=>"",
				"employee_name"=>"",
				"infocontact_id"=>"",
				"contact_content"=>"",
				"user"=>$s_info['s_user_id']
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"create_date"=>$this->input->post('create_date'),
					"phone"=>$this->input->post('phone'),
					"time"=>$this->input->post('time'),
					"infocontact_id"=>$this->input->post('infocontact_id'),
					"contact_content"=>$this->input->post('contact_content'),
					"employee_name"=>$this->input->post('employee_name'),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['create_date']){
					$insert = $this->mcompany_work->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."company_work/");
							header("location:".my_lib::cms_site()."company_work/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_work/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myCompanyWork = '';
			if(is_numeric($id)){
				$myCompanyWork = $this->mcompany_work->getData('',array("id"=>$id));
				if($myCompanyWork['id']<=0){
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
			$this->_data['formData']	= array(
				"create_date"=>$myCompanyWork['create_date'],
				"time"=>$myCompanyWork['time'],
				"phone"=>$myCompanyWork['phone'],
				"employee_name"=>$myCompanyWork['employee_name'],
				"infocontact_id"=>$myCompanyWork['infocontact_id'],
				"contact_content"=>$myCompanyWork['contact_content'],
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"create_date"=>$this->input->post('create_date'),
					"phone"=>$this->input->post('phone'),
					"time"=>$this->input->post('time'),
					"infocontact_id"=>$this->input->post('infocontact_id'),
					"contact_content"=>$this->input->post('contact_content'),
					"employee_name"=>$this->input->post('employee_name')
				);	
				if($this->_data['formData']['create_date']){					
					if($this->mcompany_work->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."company_work/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/company_work/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myCompanyWork = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myCompanyWork = $this->mcompany_work->getData('',array("id"=>$id));
				if(isset($myCompanyWork['id'])<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mcompany_work->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."company_work/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/company_work/delete",$this->_data);
		}
		/**end delete */

		/**begin cap nhat trang thai viec lam*/
		public function aj_updateWorkingStatus()
		{
			$html = '';
			$id = isset($_REQUEST['id']) && $_REQUEST['id'] ? (int)$_REQUEST['id']:'';
			$status = isset($_REQUEST['status']) && $_REQUEST['status'] ? (int) $_REQUEST['status']:0;			
			if(is_numeric($id) && is_numeric($status))
			{		
				$status = $status==1?0:1;
				$this->_data['formData']= array(					
					"status_work"=>$status
				);
				if($this->_data['formData']){
					$this->mcompany_work->edit($id,$this->_data['formData']);
					if($status==0)
					{
						$html = '<small class="label label-danger label-sm">Chưa hoàn thành</small>';
					}
					else
					{
						$html = '<small class="label label-success">Đã hoàn thành</small>';
					}
				}
			}
			echo $html;
		}
		/**end cap nhat trang thai viec lam*/

		public function aj_insertData()
		{
			# code...s
			$html = ""; // them moi khong thanh cong
			$hdfinfocontactid = isset($_REQUEST['hdfinfocontactid']) && $_REQUEST['hdfinfocontactid'] ? $_REQUEST['hdfinfocontactid']:'';
            $hdfstatus = isset($_REQUEST['hdfstatus']) && $_REQUEST['hdfstatus'] ? $_REQUEST['hdfstatus']:'';
            $fcontact_content = isset($_REQUEST['fcontact_content']) && $_REQUEST['fcontact_content'] ? $_REQUEST['fcontact_content']:'';
            $femployee_name = isset($_REQUEST['femployee_name']) && $_REQUEST['femployee_name'] ? $_REQUEST['femployee_name']:'';
            $fstatus = isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:'';
            $fphone = isset($_REQUEST['fphone']) && $_REQUEST['fphone'] ? $_REQUEST['fphone']:'';
            $ftime = isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:'';
            $fcreate_date = isset($_REQUEST['fcreate_date']) && $_REQUEST['fcreate_date'] ? $_REQUEST['fcreate_date']:'';            
            if($hdfinfocontactid && $hdfstatus && $fcontact_content && $femployee_name && $fstatus && $fphone && $ftime && $fcreate_date)
            {
            	$status_work = 1;
            	if($fcreate_date > date("Y-m-d"))
            	{
            		$status_work = 0;
            	}
            	elseif($fcreate_date == date("Y-m-d"))
        		{
        			if($ftime < date("H:i"))
        			{
        				$status_work = 1; // xem lai
        			}            			
        		}else{
        			$status_work = 0;	
        		}            	
            	// $status_work = $fcreate_date > date("Y-m-d") && $ftime < date("H:i") ? 0:1;
            	
            	$this->_data['formData']	= array(
					"create_date"=>$fcreate_date,
					"phone"=>$fphone,
					"time"=>$ftime,
					"infocontact_id"=>$hdfinfocontactid,
					"contact_content"=>htmlspecialchars($fcontact_content,ENT_QUOTES),
					"employee_name"=>$femployee_name,
					"status"=>$fstatus,
					"status_work"=>$status_work ,
					"user"=>$this->_data['s_info']['s_user_id']
				);

				if($this->_data['formData']['create_date']){
					$insert = $this->mcompany_work->add($this->_data['formData']);
					if($insert>1)
					{
						$myInfoContact = $this->minfocontact->getData('',array("id"=>$hdfinfocontactid));
                        $avatar = isset($this->_data['s_info']['s_user_avatar']) &&  $this->_data['s_info']['s_user_avatar'] ? $this->_data['s_info']['s_user_avatar']:my_lib::cms_img().'no_avatar.gif';
                        $myComWokStatus = $this->mcompany_work_status->getData(array('wk_name','wk_bg','wk_color','wk_icon'),array("id"=>$fstatus));					
						$html .= '<li class="wrapper">';
                            $html .= '<div class=" year date_work">'.date("D, d-m-Y",strtotime($fcreate_date)).'</div>';
                            $html .= '<div class="panel">';
                                $html .= '<div class="panel-body">';
                                    $html .= '<ul class="list-table">';
                                        $html .= '<li class="text-left" style="width:60px;">';
                                            $html .= '<img class="img-circle" src="'.$avatar.'" alt="" width="50px" height="50px">';
                                        $html .= '</li>';
                                        $html .= '<li class="text-left">';
                                            $html .= '<p class="mb5"><span class="semibold text-accent semibold nm">'.$femployee_name.'</span> <i class="ico-clock7"></i> '.date("H:i",strtotime($ftime));
                                            $html .= ' <label class="label" style="background:'.$myComWokStatus['wk_bg'].'; color:'.$myComWokStatus['wk_color'].'"><i class="'.$myComWokStatus['wk_icon'].'"></i> '.$myComWokStatus['wk_name'].'</label>';
                                            $html .= '</p>';
                                            $html .= '<div>'.$fcontact_content.'</div>';
                                        $html .= '</li>';
                                    $html .= '</ul>';
                                $html .= '</div>';
                                $html .= '<div class="panel-footer">';
                                        if($myInfoContact['contact_name'])
                                            $html .= '<span class="col-lg-5">- Người liên hệ: '.$myInfoContact['contact_name'].'</span>';
                                        if($myInfoContact['contact_phone'])
                                            $html .= '<span class="col-lg-7">- Điện thoại: '.$myInfoContact['contact_phone'].'</span>';
                                        if($myInfoContact['contact_position'])
                                            $html .= '<span class="col-lg-5">- Chức vụ: '.$myInfoContact['contact_position'].'</span>';
                                        if($myInfoContact['contact_email'])
                                            $html .= '<span class="col-lg-7">- Email: '.$myInfoContact['contact_email'].'</span>';
                                    $html .= '</div>';
                            $html .= '</div>';
                        $html .= '</li>';					
					}				
				}
            }
            echo $html;
		}
				
	}
?>