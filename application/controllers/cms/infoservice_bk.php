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
			$this->load->helper('text');
		}

		public function index()
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách các dịch vụ';			
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
				"fid"=>isset($_REQUEST['fid']) && $_REQUEST['fid'] ? $_REQUEST['fid']:'',
				"fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
				"fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
				"ftype"=>isset($_REQUEST['ftype']) && $_REQUEST['ftype'] ? $_REQUEST['ftype']:"all",
				"fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all",
				"fuser"=>isset($_REQUEST['fuser']) && $_REQUEST['fuser'] ? $_REQUEST['fuser']:"all",
			);
			$and = ' 1 ';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and (service_domain like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or company_id like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or service_email like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or service_price like "%'.$this->_data['formData']['fkeyword'].'%"';
				$and .= ' or service_place like "%'.$this->_data['formData']['fkeyword'].'%")';
			}
			if(isset($this->_data['formData']['fid']) && $this->_data['formData']['fid'])
			{
				$and .= ' and id ='.$this->_data['formData']['fid'];
			}	
			if($this->_data['formData']['fstatus']!="all")
            {
                $and .= ' and service_status ='.$this->_data['formData']['fstatus'];
            }	
            if($this->_data['formData']['ftype']!="all")
            {
                $and .= ' and service_type ='.$this->_data['formData']['ftype'];
            }
            if($this->_data['formData']['fyear']!="all")
            {
                $and .= ' and YEAR(service_start) ='.$this->_data['formData']['fyear'];
            }
            if($this->_data['formData']['fuser']!="all")
            {
                $and .= ' and user ='.$this->_data['formData']['fuser'];
            }		
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

			$this->_data['fstatus'] = $this->minfoservice->dropdownlistStatus($this->_data['formData']['fstatus']);
			$this->_data['ftype'] = $this->minfoservice->dropdownlistType($this->_data['formData']['ftype']);
			$this->_data['fyear'] = $this->minfoservice->dropdownlistYear($this->_data['formData']['fyear']);
			$this->_data['fuser'] = $this->muser->dropdownlist($this->_data['formData']['fuser']);

			$this->my_layout->view("cms/infoservice/index",$this->_data);
		}

		public function popup()
		{
			$this->_data['lang'] = my_lib::lang();
			//$redirect = $this->input->post('redirect');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			//$service_status = $this->input->post('service_status') == 5 ? 1 : $this->input->post('service_status');
			$this->_data['formData']	= array(
				"company_id"=>$this->input->post('company_id'),
				"service_domain"=>$this->input->post('service_domain'),
				"service_email"=>$this->input->post('service_email'),
				"service_userser"=>$this->input->post('service_userser'),
				"service_type"=>$this->input->post('service_type'),
				"service_package"=>$this->input->post('service_package'),
				"service_start"=>$this->input->post('service_start'),
				"service_end"=>$this->input->post('service_end'),				
				"service_status"=>$this->input->post('service_status'),				
				"service_price"=>$this->input->post('service_price'),				
				"service_place"=>$this->input->post('service_place'),			
				"service_note"=>$this->input->post('service_note'),			
				"service_pay"=>1,			
				"user"=>$this->_data['s_info']['s_user_id'],			
				"service_noti"=>0		
			);	
			if($this->_data['formData']['company_id']){
				$insert = $this->minfoservice->add($this->_data['formData']);
				$service_files = $this->uploadFileMul($insert);

				if(is_numeric($insert)>0){			
					header("location:".my_lib::cms_site().'infoservice/detail/'.$insert.'/?redirect='.base64_encode(current_url()));					
				}
			}
		}

		public function detail($id)
		{
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Chi tiết hợp đồng';
			$_SESSION["contract"] = $id;
			if(is_numeric($id)){
				$this->_data['infoService'] = $this->minfoservice->getData('',array("id"=>$id));
				if($this->_data['infoService']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
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
			# code...
			$myInfoService = '';
			if(is_numeric($id)){
				$myInfoService = $this->minfoservice->getData('',array("id"=>$id));
				if($myInfoService['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			$_SESSION["contract"] = $id;
			//$this->_data['type'] = isset($_REQUEST['type']) ? $_REQUEST['type'] :'';
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật';
			$this->_data['formData']	= array(
				"id"=>$id,
				"company_id"=>$myInfoService['company_id'],
				"service_domain"=>$myInfoService['service_domain'],
				"service_email"=>$myInfoService['service_email'],
				"service_userser"=>$myInfoService['service_userser'],
				"service_type"=>$myInfoService['service_type'],
				"service_package"=>$myInfoService['service_package'],
				"service_start"=>$myInfoService['service_start'],
				"service_end"=>$myInfoService['service_end'],
				"service_status"=>$myInfoService['service_status'],
				"service_price"=>$myInfoService['service_price'],
				"service_place"=>$myInfoService['service_place'],
				"service_pay"=>$myInfoService['service_pay'],
				"service_note"=>$myInfoService['service_note'],
				
			);			
			if (isset($_POST['fsubmit-suspend'])) {
				$service    =$this->mservice->getData('service_name',array("id"=>$myInfoService['service_type']));
				$service = url_title($service['service_name'], 'dash',true);
				$user    = $myInfoService['service_userser'];
				$this->Action_TS_Server($service,$user,'suspend');
			}
			if (isset($_POST['fsubmit-unsuspend'])) {
				$service    =$this->mservice->getData('service_name',array("id"=>$myInfoService['service_type']));
				$service = url_title($service['service_name'], 'dash',true);
				$user    = $myInfoService['service_userser'];
				$this->Action_TS_Server($service,$user,'unsuspend');
			}
			if(isset($_POST['fsubmit'])){
				// $service_status = $this->input->post('service_status');
				// $idNoti = $this->_data['formData']['service_noti'];
				// if ($this->_data['formData']['service_end'] != $this->input->post('service_end')) {
				// 	$date_now = date('Y-m-d');
	   //              $day = (strtotime($this->input->post('service_end')) - strtotime($date_now)) / (60 * 60 * 24);
	   //              if ($day < 7) {
	   //              	if ($day >= 1) {
	   //              		//$service_status = 5;
    //             			$name_service = "";
    //                 		$name_company = "";
    //                 		$service = $this->mservice->getData('service_name',array("id"=>$this->input->post('service_type')));
    //                 		if (isset($service)) {
    //                 			$name_service = $service['service_name'];
    //                 		}
    //                 		$company = $this->mcompany->getData('company_name',array("id"=>$this->_data['formData']['company_id']));
    //                 		if (isset($company)) {
    //                 			$name_company = $company['company_name'];
    //                 		}
    //                 		$notiData = array(
    //                 				'notification_id_contracts' => $this->_data['formData']['id'], 
    //                 				'notification_endday' => $this->input->post('service_end'), 
    //                 				'notification_service' => $name_service, 
    //                 				'notification_company' => $name_company, 
    //                 				);
    //                 		if ($idNoti > 0) {
    //                 			$service_status = 5;
    //                 			$this->mnotification->edit($idNoti,$notiData);
    //                 		} else {
    //                 			$idNoti = $this->mnotification->add($notiData);
    //                 			$service_status = 5;

    //                 		}
	   //              	} else {
	   //              		$service_status = 3;
	   //              		if ($idNoti > 0) {
	   //              			$this->mnotification->delete($idNoti);
	   //              			$idNoti = 0;
	   //              		}
	   //              	}
	   //              } else {
	   //              	$service_status = 1;
	   //              	if ($idNoti > 0) {
    //             			$this->mnotification->delete($idNoti);
    //             			$idNoti = 0;
    //             		}
	   //              }
				// } else {
				// 	if ($service_status != 5) {
				// 		if ($idNoti > 0) {
    //             			$this->mnotification->delete($idNoti);
    //             			$idNoti = 0;
    //             		}
				// 	}
				// }
				
				$this->_data['formData']	= array(
					"service_domain"=>$this->input->post('service_domain'),
					"service_email"=>$this->input->post('service_email'),
					"service_userser"=>$this->input->post('service_userser'),
					"service_type"=>$this->input->post('service_type'),
					"service_package"=>$this->input->post('service_package'),
					"service_start"=>$this->input->post('service_start'),
					"service_end"=>$this->input->post('service_end'),				
					"service_status"=>$this->input->post('service_status'),				
					"service_price"=>$this->input->post('service_price'),				
					"service_place"=>$this->input->post('service_place'),			
					"service_pay"=>$this->input->post('service_pay'),			
					"service_note"=>$this->input->post('service_note'),		
				);	
				if($this->_data['formData']['service_domain']){					
					if($this->minfoservice->edit($id,$this->_data['formData'])){
						$this->_data['success'] = "Edit success";
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

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myInfoService = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myInfoService = $this->minfoservice->getData('',array("id"=>$id));
				if(isset($myInfoService['id'])<=0){
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
	                $this->_data['success'] = 'Upload thành công';
	            }
	        }
	        mkdir($this->minfoservice->getUploadPath($id));
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

		public function set_status()
		{
			// $date_now = date('Y-m-d');
			// $object = 'id,company_id,service_type,service_end,service_noti';
			// $and = 'service_status in (1,5)';
			// $orderby = 'id desc';
			// $list = $this->minfoservice->getQuery($object,$join="",$and,$orderby,$limit="");
			// if (!empty($list)) {
			// 	foreach ($list as $key => $value) {
   //                  $day = (strtotime($value['service_end']) - strtotime($date_now)) / (60 * 60 * 24);
   //                  if ($day < 7) {
   //                  	if ($day > 1) {
   //                  		if ($value['service_noti'] > 0) {
   //                  			$this->minfoservice->edit($value['id'],array('service_status' => 5));
   //                  		} else {
   //                  			$name_service = "";
	  //                   		$name_company = "";
	  //                   		$service = $this->mservice->getData('service_name',array("id"=>$value['service_type']));
	  //                   		if (isset($service)) {
	  //                   			$name_service = $service['service_name'];
	  //                   		}
	  //                   		$company = $this->mcompany->getData('company_name',array("id"=>$value['company_id']));
	  //                   		if (isset($company)) {
	  //                   			$name_company = $company['company_name'];
	  //                   		}
	  //                   		$notiData = array(
	  //                   				'notification_id_contracts' => $value['id'], 
	  //                   				'notification_endday' => $value['service_end'], 
	  //                   				'notification_service' => $name_service, 
	  //                   				'notification_company' => $name_company, 
	  //                   				);
	  //                   		$idNoti = $this->mnotification->add($notiData);
	  //                   		$this->minfoservice->edit($value['id'],array('service_status' => 5,'service_noti' => $idNoti));
   //                  		}
   //                  	} else {
   //                  		$this->mnotification->delete($value['service_noti']);
   //                  		$this->minfoservice->edit($value['id'],array('service_status' => 3,'service_noti' => 0));
   //                  	}
   //                  }
			// 	}
			// }
			// header("location:".my_lib::cms_site()."infoservice/");
		}

	 //    public function delFileAjax()
		// {
		// 	if ($this->input->post('filename')) {
		// 		$file_name = $this->input->post('filename');
		// 		$idSer = $this->input->post('idSer');
		// 		$myService = $this->minfoservice->getData('',array("id"=>$idSer));
		// 		$link_file = 'media/customer/'.$file_name;
		// 		if (!empty($myService)) {
		// 			if (file_exists($link_file))
		// 			{
		// 				$new_file = str_replace($file_name.'/', "", $myService["service_file"]);
		// 				$update_data	= array(
		// 					"service_file"=>$new_file
		// 				);
		// 				if ($this->minfoservice->edit($idSer,$update_data)) {
		// 					unlink($link_file);
		// 					echo "ok";
		// 				}
		// 			}
		// 		}
		// 	}
		// }
				
	}
?>