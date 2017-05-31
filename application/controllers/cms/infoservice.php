<?php
session_start();
	class infoservice extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/minfoservice");	
			$this->load->Model("cms/mcompany");	
			$this->load->Model("cms/mservice");
			$this->load->Model("cms/mproject");
			$this->load->helper('text');
			$this->load->helper('date');
		}

		public function index()
		{
			$this->muser->checkPermission('infoservice', 'index');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data['boss'] = 0;	
			if ($s_info['s_user_group'] == 1) {
				$this->_data['boss'] = 1;	
			}
			$this->_data["title"]  = 'Danh sách hợp đồng';
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 2 || $this->_data['s_info']['s_user_group'] == 5) {
				$and = ' 1';
			} else {
				$and = ' user = '.$this->_data['s_info']['s_user_id'];
			}
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:20,
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
				"ftype"=>isset($_REQUEST['ftype']) && $_REQUEST['ftype'] ? $_REQUEST['ftype']:"all",
				"ftime"=>isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:"all",
				"ftypeTime"=>isset($_REQUEST['ftypeTime']) && $_REQUEST['ftypeTime'] ? $_REQUEST['ftypeTime']:0,
				"fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all",
				"fuser"=>isset($_REQUEST['fuser']) && $_REQUEST['fuser'] ? $_REQUEST['fuser']:"all",
				"fduration"=>isset($_REQUEST['fduration']) && $_REQUEST['fduration'] ? $_REQUEST['fduration']:"all",
				"fview"=>isset($_REQUEST['fview']) && $_REQUEST['fview'] ? $_REQUEST['fview']:"all",
			);
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (service_domain like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or company_id like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or service_code like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or service_email like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or service_place like "%'.$this->_data['formData']['fkeyword'].'%")';
			}	
			if($this->_data['formData']['fstatus']!="all")
            {
                $and .= ' and service_status ='.$this->_data['formData']['fstatus'];
            }	
            if($this->_data['formData']['ftype']!="all")
            {
                $and .= ' and service_type ='.$this->_data['formData']['ftype'];
            }
            $this->_data['textFilter'] = '';
            if($this->_data['formData']['fyear']!="all")
            {
                $and .= ' and YEAR(service_start) ='.$this->_data['formData']['fyear'];
                if ($this->_data['formData']['ftime']!="all") {
                	switch ($this->_data['formData']['ftypeTime']) {
                		case '1':
                			$and .= ' and WEEKOFYEAR(service_start) ='.$this->_data['formData']['ftime'];
			            	$this->_data['textFilter'] = 'Tuần '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '2':
                			$and .= ' and MONTH(service_start) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Tháng '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '3':
                			$and .= ' and QUARTER(service_start) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Quý '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;
                		default:
              				$add .= '';
              				$this->_data['textFilter'] = 'Bạn chưa chọn tuần, tháng hoặc quý của năm '.$this->_data['formData']['fyear'];
                			break;
                	}
                }
            }
            if($this->_data['formData']['fuser']!="all")
            {
                $and .= ' and user ='.$this->_data['formData']['fuser'];
            }
            if($this->_data['formData']['fduration']!="all")
            {
                $and .= ' and service_duration ='.$this->_data['formData']['fduration'];
            }
            $view = 'index';		
            if($this->_data['formData']['fview']!="all")
            {
                if ($this->_data['formData']['fview'] == 1) {
                	$view = 'index';
                } else {
                	$view = 'index_target';
                }
            }	
            $this->_data['condition'] = $and;
			// my_lib::printArr($_SERVER);
			
			/*begin phan trang*/
			$paging['per_page']         =   $this->_data['formData']['fperpage'];
			$paging['num_links']         =   5;
			$paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
			$paging['start']      =   (($paging['page']-1)   * $paging['per_page']);			
			$query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';					
			$paging['base_url']         =   my_lib::cms_site().'infoservice/?'.$query_string.'&page=';			
			/*end phan trang*/

			$this->_data['orderby']=$orderby = 'id desc';
			$limit = $paging['start'].','.$paging['per_page'];
			$this->_data['list'] = $this->minfoservice->getQuery($object="",$join="",$and,$orderby,$limit);
			$this->_data['record'] = $this->minfoservice->countQuery($join="",$and);
			$this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$this->muser->checkPermission('infoservice', 'delete');
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myInfoService = $this->minfoservice->getData('',array("id"=>$value));
							if($myInfoService['id']>0){	
								$this->delete_files($this->minfoservice->getUploadPath($value));
								$this->delete_files($this->minfoservice->getUploadPathThumbs($value));
								$this->minfoservice->delete($value);
								// if ($myInfoService['service_noti']>0) {
								// 	$this->mnotification->delete($myInfoService['service_noti']);
								// }
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

			//Cập nhật thời hạn
			$this->_data['flagDuration'] = 0;
			if ((int)config_update_duration < strtotime(date("Y-m-d"))) {
				$this->_data['flagDuration'] = 1;
			}

			$this->_data['fstatus'] = $this->minfoservice->dropdownlistStatus($this->_data['formData']['fstatus']);
			$this->_data['ftype'] = $this->minfoservice->dropdownlistType($this->_data['formData']['ftype']);
			$this->_data['fyear'] = $this->minfoservice->dropdownlistYear($this->_data['formData']['fyear']);
			$this->_data['ftypeTime'] = $this->minfoservice->dropdownlistTypetime($this->_data['formData']['ftypeTime']);
			$this->_data['fduration'] = $this->minfoservice->dropdownlistDuration($this->_data['formData']['fduration']);
			$this->_data['fuser'] = $this->muser->dropdownlist($this->_data['formData']['fuser']);

			$this->my_layout->view("cms/infoservice/".$view,$this->_data);
		}

		public function reportAjax()
		{
			$html = '';
			if ($this->input->post('and')) {
				$and = $this->input->post('and');
				$real = 0;
				$sign = 0;
				$debt = 0;
				$cancel = 0;
				$listRS = $this->minfoservice->getQuery($object="",$join="",$and,"id asc",$limit="");
				if (!empty($listRS)) {
					foreach ($listRS as $key => $value) {
						$real += $value['service_pay_real'];
						$sign += $value['service_pay_sign'];
						$debt += $value['service_pay_debt'];
						$cancel += $value['service_pay_cancel'];
					}
					$html .= '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title"><i class="ico-bar-chart"></i> Thống kê doanh số</h3><div class="panel-toolbar text-right"><div class="option"><button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button></div>
                        </div></div><div class="panel-collapse pull out"><div class="panel-body"><div class="row"><div class="col-sm-3"><div class="table-layout animation animating fadeInDown"><div class="col-xs-4 panel bgcolor-teal"><div class="ico-money fsize24 text-center"></div></div><div class="col-xs-8 panel"><div class="panel-body text-center">';
                    $html .= '<h4 class="semibold nm">'. number_format($real) .'</h4>';
                    $html .= '<p class="semibold text-muted mb0 mt5">DANH SỐ THỰC THU</p></div></div></div></div><div class="col-sm-3"><div class="table-layout animation animating fadeInUp"><div class="col-xs-4 panel bgcolor-teal"><div class="ico-pencil6 fsize24 text-center"></div></div><div class="col-xs-8 panel"><div class="panel-body text-center">';
                    $html .= '<h4 class="semibold nm">'. number_format($sign) .'</h4>';
                    $html .= '<p class="semibold text-muted mb0 mt5">DANH SỐ KÝ</p></div></div></div></div><div class="col-sm-3"><div class="table-layout animation animating fadeInDown"><div class="col-xs-4 panel bgcolor-danger"><div class="ico-pushpin fsize24 text-center"></div></div><div class="col-xs-8 panel"><div class="panel-body text-center">';
                    $html .= '<h4 class="semibold nm">'. number_format($debt) .'</h4>';
                    $html .= '<p class="semibold text-muted mb0 mt5">CÔNG NỢ</p></div></div></div></div><div class="col-sm-3"><div class="table-layout animation animating fadeInUp"><div class="col-xs-4 panel bgcolor-inverse"><div class="ico-stack-cancel fsize24 text-center"></div></div><div class="col-xs-8 panel"><div class="panel-body text-center">';
                    $html .= '<h4 class="semibold nm">'. number_format($cancel) .'</h4>';
                    $html .= '<p class="semibold text-muted mb0 mt5">DANH SỐ HỦY</p></div></div></div></div></div></div>
                    </div></div>';
				} else {
					$html = '<span class="label label-danger">Dữu liệu đang được cập nhật</span>';
				}
			}
			echo $html;
		}

		public function popup()
		{
			$this->muser->checkPermission('infoservice', 'add');
			$this->_data['lang'] = my_lib::lang();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			//$service_status = $this->input->post('service_status') == 5 ? 1 : $this->input->post('service_status');
			$id_type_service = $this->input->post('service_type');
			$sign = $this->input->post('service_pay_sign');
			$perform = $this->input->post('service_pay_perform');
			$no = 0;
			$real = 0;
			$debt = $sign;
			$cancel = 0;
			if ($perform != "" && $perform != 0) {
				$no = 1;
				$real = $perform;
				$debt = $sign - $perform;
			}
			$type_service = $this->mservice->getData('service_acronym',array('id' => $id_type_service));
			$service_code_tmp = "";
			$this->_data['formData']	= array(
				"company_id"=>$this->input->post('company_id'),
				"service_domain"=>$this->input->post('service_domain'),
				"service_code"=>$service_code_tmp,
				"service_email"=>$this->input->post('service_email'),
				"service_userser"=>$this->input->post('service_userser'),
				"service_type"=>$id_type_service,
				"service_package"=>$this->input->post('service_package'),
				"service_start"=>$this->input->post('service_start'),
				"service_end"=>$this->input->post('service_end'),				
				"service_duration"=>1,				
				"service_status"=>3,			
				"service_place"=>$this->input->post('service_place'),			
				"service_note"=>$this->input->post('service_note'),		
				"service_pay_no"=>$no,		
				"service_pay_sign"=>$sign,		
				"service_pay_real"=>$real,		
				"service_pay_perform"=>$perform,		
				"service_pay_debt"=>$debt,		
				"service_pay_cancel"=>$cancel,		
				"service_pay_dayupdate"=>date("Y-m-d H:i:s"),		
				"user"=>$this->_data['s_info']['s_user_id']	
			);	
			if($this->_data['formData']['company_id']){
				$insert = $this->minfoservice->add($this->_data['formData']);
				$service_files = $this->uploadFileMul($insert);
				if (!empty($type_service)) {
					$service_code = $type_service['service_acronym'].$insert.'/TS'.date('y');
					$this->minfoservice->edit($insert,array('service_code' => $service_code));
				}

				if(is_numeric($insert)>0){	
					header("location:".my_lib::cms_site().'infoservice/detail/'.$insert.'/?redirect='.base64_encode(current_url()));					
				}
			}
		}

		public function boss($user_group)
		{
			if ($user_group == 1 || $user_group == 2 || $user_group == 5) {
				return 1;
			} else {
				return 0;
			}
		}

		public function set_per($id)
		{
			$s_info = $this->session->userdata('userInfo');
			if ($s_info['s_user_group'] == 1 || $s_info['s_user_group'] == 2 || $s_info['s_user_group'] == 5 || $s_info['s_user_group'] == 9 || $s_info['s_user_id'] == $id) {
				return 1;
			} else {
				return 0;
			}
		}

		public function detail($id)
		{
			$this->muser->checkPermission('infoservice', 'detail');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$this->_data['boss'] = $this->boss($s_info['s_user_group']);
			$this->_data["title"]  = 'Chi tiết hợp đồng';
			$_SESSION["contract"] = $id;
			if(is_numeric($id)){
				$this->_data['infoService'] = $this->minfoservice->getData('',array("id"=>$id));
				if($this->_data['infoService']<=0 || $this->set_per($this->_data['infoService']['user']) != 1){
					header("location:".my_lib::cms_site().'error/permission');
					exit();
				} else {
					$this->_data['company'] = $this->mcompany->getData('',array("id"=>$this->_data['infoService']['company_id']));
					$this->_data['employee'] = $this->muser->getData("",array("id"=>$this->_data['infoService']['user']));
					$this->my_layout->view("cms/infoservice/detail",$this->_data);
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}

		}


		public function edit($id)
		{
			$this->muser->checkPermission('infoservice', 'edit');
			$myInfoService = '';
			if(is_numeric($id)){
				$myInfoService = $this->minfoservice->getData('',array("id"=>$id));
				if($myInfoService['id']<=0 || $this->set_per($myInfoService['user']) != 1){
					header("location:".my_lib::cms_site().'error/permission');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['boss'] = $this->boss($s_info['s_user_group']);

			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật';
			$this->_data['formData']	= array(
				"id"=>$id,
				"company_id"=>$myInfoService['company_id'],
				"service_code"=>$myInfoService['service_code'],
				"service_domain"=>$myInfoService['service_domain'],
				"service_email"=>$myInfoService['service_email'],
				"service_userser"=>$myInfoService['service_userser'],
				"service_type"=>$myInfoService['service_type'],
				"service_package"=>$myInfoService['service_package'],
				"service_start"=>$myInfoService['service_start'],
				"service_end"=>$myInfoService['service_end'],
				"service_place"=>$myInfoService['service_place'],
				"service_note"=>$myInfoService['service_note'],
				
			);			

			if(isset($_POST['fsubmit'])){
				$duration = $myInfoService['service_duration'];
				if ($this->input->post('service_end') != $myInfoService['service_end']) {
					$date_now = date('Y-m-d');
                    $day = (strtotime($this->input->post('service_end')) - strtotime($date_now)) / (60 * 60 * 24);
                    if ($day > 0) {
	        			if ($day > 30) {
	        				$duration = 1;
	        			} else {
	        				$duration = 2;
	        			}
	        			
	        		} else {
	        			$duration = 3;
	        		}
				}
				$this->_data['formData']	= array(
					"service_code"=>$myInfoService['service_code'],
					"service_domain"=>$myInfoService['service_domain'],
					"service_email"=>$this->input->post('service_email'),
					"service_userser"=>$myInfoService['service_userser'],
					"service_type"=>$myInfoService['service_type'],
					"service_package"=>$this->input->post('service_package'),
					"service_start"=>$this->input->post('service_start'),
					"service_end"=>$this->input->post('service_end'),		
					"service_duration"=>$duration,		
					"service_place"=>$this->input->post('service_place'),		
					"service_note"=>$this->input->post('service_note'),		
				);	
				if($this->_data['formData']['service_domain']){					
					if($this->minfoservice->edit($id,$this->_data['formData'])){
						//$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						//header("location:".my_lib::cms_site().'company/working/'.$this->_data['formData']['company_id'].'/?redirect='.base64_encode(current_url()));
						header("location:".my_lib::cms_site().'infoservice/detail/'.$id.'/?redirect='.base64_encode(current_url()));
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Vui lòng nhập đầy đủ thông tin";
				}
			}
			$this->my_layout->view("cms/infoservice/edit",$this->_data);
		}
		/**end them moi menu*/
		// Pay
		public function pay($id)
		{
			$this->muser->checkPermission('infoservice', 'pay');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['title'] = 'Cập nhật trình trạng thanh toán';	
			$boss = $this->boss($s_info['s_user_group']);
			if ($boss != 1) {
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			} else {
				$this->_data['myInfoService']= $myInfoService = $this->minfoservice->getData('',array("id"=>$id));
				if(isset($_POST['fsubmit'])){
					$no = $this->input->post('service_pay_no');
					$perform = $this->input->post('service_pay_more');
					$sign = $myInfoService['service_pay_sign'];
					$status = $this->input->post('service_status');
					$real = $myInfoService['service_pay_real'] + $this->input->post('service_pay_more');
					$cancel = 0;
					if ($status == 1) {
						$real = $sign;
					}
					if ($status == 5) {
						$cancel = $sign - $real;
						$no = $myInfoService['service_pay_no'];
					}

					$this->_data['formData']	= array(
						"service_pay_no"=>$no,
						"service_status"=>$status,	
						"service_pay_perform"=>$real,
						"service_pay_real"=>$real,
						"service_pay_debt"=>$sign - $real,
						"service_pay_cancel"=>$cancel,
						"service_pay_dayupdate"=>date("Y-m-d H:i:s")
						
					);
					if ($this->minfoservice->edit($id,$this->_data['formData'])) {
						header("location:".my_lib::cms_site().'infoservice/detail/'.$id.'/?redirect='.base64_encode(current_url()));
					}
				}
				$this->my_layout->view("cms/infoservice/pay",$this->_data);
			}
		}
		// End

		// Duyệt
		public function allow($id)
		{
			$this->muser->checkPermission('infoservice', 'allow');
			$myInfoService = $this->minfoservice->getData('',array("id"=>$id));
			if ($myInfoService['service_status'] == 3) {
				if ($myInfoService['service_pay_real'] == $myInfoService['service_pay_sign']) {
					$status = 1;
				} else {
					$status = 2;
				}
				if($this->minfoservice->edit($id,array("service_status"=>$status))){
					header("location:".my_lib::cms_site().'infoservice/detail/'.$id.'/?redirect='.base64_encode(current_url()));
				}
			}
			
		}
		// End

		/**begin delete */
		public function delete($id)
		{			
			$this->muser->checkPermission('infoservice', 'delete');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myInfoService = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myInfoService = $this->minfoservice->getData('',array("id"=>$id));
				if(isset($myInfoService['id'])<=0 || $s_info['s_user_group'] == 1 || $s_info['s_user_group'] == 2 || $s_info['s_user_group'] == 5){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{
					$this->minfoservice->delete($id);
					$this->delete_files($this->minfoservice->getUploadPath($id));
					$this->delete_files($this->minfoservice->getUploadPathThumbs($id));
					// if ($myInfoService['service_noti']>0) {
					// 	$this->mnotification->delete($myInfoService['service_noti']);
					// }
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."infoservice/");
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

		public function uploadFileMul($id)
	    {
	        $arr = array();
	        mkdir($this->minfoservice->getUploadPath($id), 0775);
	        mkdir($this->minfoservice->getUploadPathThumbs($id), 0775);
	        if (isset($_FILES['service_file'])) {
	            $boxfile = $_FILES['service_file'];
	            if ($boxfile) {
	                $count = count($boxfile['name']);
	                for ($i = 0; $i < $count; $i++) {
	                    if ($boxfile['name'][$i]) {
	                        $_FILES['upfile']['name']     = $boxfile['name'][$i];
	                        $_FILES['upfile']['type']     = $boxfile['type'][$i];
	                        $_FILES['upfile']['tmp_name'] = $boxfile['tmp_name'][$i];
	                        $_FILES['upfile']['error']    = $boxfile['error'][$i];
	                        $info = $this->minfoservice->upload($this->minfoservice->getUploadPath($id), 'upfile');
	                        array_push($arr, $info['file_name']);
	                    }
	                }
	            }
	        }
	        return $arr;
	    }

	    public function delete_files($target) {
		    if(is_dir($target)){
		        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
		 
		        foreach( $files as $file )
		        {
		            $this->delete_files($file);      
		        }
		 
		        rmdir( $target );
		    } elseif(is_file($target)) {
		        unlink( $target );  
		    }
		}

		public function noteAjax()
		{
			$id = $this->input->post('idser');
			$text = $this->input->post('text');
			$html = '';
			$myInfoService = $this->minfoservice->getData('',array("id"=>$id));
			if (!empty($myInfoService)) {
				$texttpm = $myInfoService['pay_note'].$text.';';
				if ($this->minfoservice->edit($id,array("pay_note"=>$texttpm))) {
					$html = '<li><div class="alert alert-info pull-right" style="width: 100%;">';
                    $html .= '<strong style="word-wrap: break-word;">'.$text.'</strong>';
                    $html .= '</div><div class="clearfix"></div></li>';
					echo $html;
				} else {
					echo "Error! Vui lòng thử lại sau!";
				}
			} else {
				echo "Error! Vui lòng thử lại sau!";
			}
		}

		public function exportExcel()
        {
        	$this->muser->checkPermission('infoservice', 'exportExcel');
            require_once(APPPATH.'libraries/php-excel.class.php'); 
            $and = isset($_REQUEST['and']) && $_REQUEST['and'] ? $_REQUEST['and']:'all';
            if ($and != 'all') {
                $list = $this->minfoservice->getQuery("service_code,company_id,service_type,service_package,service_start,service_end,service_pay_sign,service_pay_real,service_pay_debt,service_pay_cancel",$join="",$and,"id asc",$limit=""); 
                $data = array(
                    array ('Mã HĐ', 'Tên KH', 'Loại DV', 'Gói DV', 'Ngày tạo','Ngày hết hạn','DS ký','Thực thu','Công nợ','DS hủy')
                );
                if (!empty($list)) {
                    foreach ($list as $key => $value) {
                    	$myCompany = $this->mcompany->getData(array('id','company_name'),array("id"=>$value['company_id'])); 
                    	$companyName = !empty($myCompany) ? $myCompany["company_name"] : '';
                    	$type_service = $this->mservice->getData('service_name','id = '.$value["service_type"]);
                    	$serviceType = !empty($type_service) ? $type_service['service_name'] : '';
                    	$package_service = $this->mservice->getData('service_name','id = '.$value["service_package"]);
                    	$servicePackage = !empty($package_service) ? $package_service['service_name'] : '';
                        array_push($data, array($value['service_code'],$companyName,$serviceType,$servicePackage,$value['service_start'],$value['service_end'],number_format($value['service_pay_sign']),number_format($value['service_pay_real']),number_format($value['service_pay_debt']),number_format($value['service_pay_cancel'])));
                    }
                }
                $xls = new Excel_XML('UTF-8', false, 'Workflow Management');
                $xls->addArray($data);
                $xls->generateXML('ExportContract');
            }
        }	

        public function setDuration()
        {
        	$this->muser->checkPermission('infoservice', 'setDuration');
        	$date_now = date('Y-m-d');
        	$date_condition = strtotime(date($date_now) . " +30 day");
        	$date_condition = strftime("%Y-%m-%d", $date_condition);
        	$and = "service_duration <> 3 and service_end <= '".$date_condition."'";
        	$list = $this->minfoservice->getQuery("id,service_end","",$and,"id asc","");
        	foreach ($list as $key => $value) {
        		$day = (strtotime($value['service_end']) - strtotime($date_now)) / (60 * 60 * 24);
        		if ($day > 0) {
        			$this->minfoservice->edit($value['id'],array('service_duration' => 2));
        		} else {
        			$this->minfoservice->edit($value['id'],array('service_duration' => 3));
        		}
        	}
        	$this->mconfig->edit(2,array('config_value' => strtotime($date_now)));
        	header("location:".my_lib::cms_site()."infoservice/");
        }
	}
?>