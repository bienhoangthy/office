<?php
	class service extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mservice");		
		}
		public function index()
		{
			$this->muser->checkPermission('service', 'index');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách';			
			$and1 = 'service_level = 1';
			$and2 = 'service_level = 2';
			$this->_data['orderby']=$orderby = 'service_orderby asc, id asc';
			$this->_data['list_level_1'] = $this->mservice->getQuery($object="",$join="",$and1,$orderby,$limit="");
			$this->_data['list_level_2'] = $this->mservice->getQuery($object="",$join="",$and2,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$this->muser->checkPermission('service', 'delete');
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myService = $this->mservice->getData('',array("id"=>$value));
							if($myService['id']>0){								
								$this->mservice->delete($value);															
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
			$this->my_layout->view("cms/service/index",$this->_data);
		}		
		public function add()
		{
			$this->muser->checkPermission('service', 'add');
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$and1 = 'service_level = 1';
			$this->_data['orderby']=$orderby = 'id asc, service_orderby asc';
			$this->_data['list_level_1'] = $this->mservice->getQuery($object="",$join="",$and1,$orderby,$limit="");

			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới';
			$this->_data['formData']	= array(			
				"service_name"=>"",
				"service_acronym"=>"",
				"service_parent"=>"",
				"service_price"=>"",
				"service_level"=>"1",
				"service_note"=>"",
				"service_orderby"=>""
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"service_name"=>$this->input->post('service_name'),
					"service_acronym"=>$this->input->post('service_acronym'),
					"service_parent"=>$this->input->post('service_parent'),
					"service_price"=>$this->input->post('service_price'),
					"service_level"=>$this->input->post('service_level'),
					"service_note"=>$this->input->post('service_note'),
					"service_orderby"=>$this->input->post('service_orderby')
				);	
				if($this->_data['formData']['service_name']){
					$insert = $this->mservice->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."service/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			$this->my_layout->view("cms/service/add",$this->_data);
		}

		public function edit($id)
		{
			$this->muser->checkPermission('service', 'edit');
			$and1 = 'service_level = 1';
			$this->_data['orderby']=$orderby = 'service_orderby asc, id asc';
			$this->_data['list_level_1'] = $this->mservice->getQuery($object="",$join="",$and1,$orderby,$limit="");
			$myService = '';
			if(is_numeric($id)){
				$myService = $this->mservice->getData('',array("id"=>$id));
				if($myService['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}
			
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['lang'] = my_lib::lang();		
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật';
			$this->_data['formData']	= array(
				"id"=>$id,
				"service_name"=>isset($myService['service_name']) && $myService['service_name'] ? $myService['service_name']:'',																		
				"service_acronym"=>isset($myService['service_acronym']) && $myService['service_acronym'] ? $myService['service_acronym']:'',																		
				"service_parent"=>isset($myService['service_parent']) && $myService['service_parent'] ? $myService['service_parent']:'',															
				"service_price"=>isset($myService['service_price']) && $myService['service_price'] ? $myService['service_price']:'',																		
				"service_level"=>isset($myService['service_level']) && $myService['service_level'] ? $myService['service_level']:'',																		
				"service_note"=>isset($myService['service_note']) && $myService['service_note'] ? $myService['service_note']:'',																		
				"service_orderby"=>isset($myService['service_orderby']) && $myService['service_orderby'] ? $myService['service_orderby']:'',																		
			);			

			if(isset($_POST['fsubmit'])){
					$parent = $this->input->post('service_parent');
				if ($this->input->post('service_level') == 1) {
					$parent = 0;
				}
				$this->_data['formData']	= array(
					"service_name"=>$this->input->post('service_name'),
					"service_acronym"=>$this->input->post('service_acronym'),
					"service_parent"=>$parent,
					"service_price"=>$this->input->post('service_price'),
					"service_level"=>$this->input->post('service_level'),
					"service_note"=>$this->input->post('service_note'),
					"service_orderby"=>$this->input->post('service_orderby')
				);	
				if($this->_data['formData']['service_name']){					
					if($this->mservice->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."service/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			/**begin com parent*/			
			/**end com parent*/

			$this->my_layout->view("cms/service/add",$this->_data);
		}
		// /**end them moi menu*/

		// /**begin delete */
		public function delete($id)
		{			
			$this->muser->checkPermission('service', 'delete');
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myService = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myService = $this->mservice->getData('',array("id"=>$id));
				if($myService['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mservice->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."service/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/service/delete",$this->_data);
		}
		/**end delete */

		public function getAjax()
		{
			if ($this->input->post('id')) {
	            $id = $this->input->post('id');
	            $and = 'service_parent = '.$id;
				$orderby = 'service_orderby asc, id asc';
				$listPack = $this->mservice->getQuery($object="",$join="",$and,$orderby,$limit="");
				if (!empty($listPack)) {
					$html = '';
					foreach ($listPack as $key => $value) {
						$html .= '<option value="'.$value["id"].'"> '.$value["service_name"].'</option>';
					}
				} else{
					$html .= '<option value="0">Data empty</option>';
				}
				echo $html;
	        }
		}

		public function getPriceAjax()
		{
			$id = $this->input->post('id');
            $package = $this->mservice->getData('service_price',array('id' => $id ));
            if (!empty($package)) {
            	echo $package['service_price'];
            } else {
            	echo 0;
            }
		}
		
	}
?>