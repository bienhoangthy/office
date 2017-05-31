<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class event extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();		
			$this->load->Model("cms/mevent");					
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách sự kiện';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mevent->getQuery($object="",$join="",$and,$orderby,$limit="");

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myEvent = $this->mevent->getthis->_Data(array("id"=>$value));
							if($myEvent['id']>0){								
								$this->mevent->delete($value);															
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
			$this->my_layout->view("cms/event/index",$this->_data);
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
			$this->_data["title"]  = 'Thêm mới sự kiện';
			$this->_data['formData']	= array(
				"event_name"=>"",																																					
				"event_detail"=>"",				
				"event_create_date"=>date("Y-m-d"),
				"event_update_date"=>date("Y-m-d"),
				"event_status"=>1,								
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"event_name"=>isset($_POST['event_name']) && $_POST['event_name'] ? $_POST['event_name']:'',																				
					"event_detail"=>isset($_POST['event_detail']) && $_POST['event_detail'] ? $_POST['event_detail']:'',																														
					"event_status"=>isset($_POST['event_status']) && $_POST['event_status'] ? $_POST['event_status']:'',																														
					"event_create_date"=>date("Y-m-d H:i:s"),
					"event_update_date"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['event_name']){
					$insert = $this->mevent->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."event/");
							header("location:".my_lib::cms_site()."event/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			
			$this->my_layout->view("cms/event/add",$this->_data);
		}

		public function edit($id)
		{
			# code...
			$myEvent = '';
			if(is_numeric($id)){
				$myEvent = $this->mevent->getthis->_Data(array("id"=>$id));
				if($myEvent['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật sự kiện';
			$this->_data['formData']	= array(
				"event_name"=>isset($myEvent['event_name']) && $myEvent['event_name'] ? $myEvent['event_name']:'',															
				"event_detail"=>isset($myEvent['event_detail']) && $myEvent['event_detail'] ? $myEvent['event_detail']:'',																			
				"event_status"=>isset($myEvent['event_status']) && $myEvent['event_status'] ? $myEvent['event_status']:'',																			
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"event_name"=>isset($_POST['event_name']) && $_POST['event_name'] ? $_POST['event_name']:'',																				
					"event_detail"=>isset($_POST['event_detail']) && $_POST['event_detail'] ? $_POST['event_detail']:'',																									
					"event_status"=>isset($_POST['event_status']) && $_POST['event_status'] ? $_POST['event_status']:'',																									
					"event_update_date"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['event_name']){					
					if($this->mevent->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."event/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}
			
			$this->my_layout->view("cms/event/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');	
			$myEvent = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myEvent = $this->mevent->getthis->_Data(array("id"=>$id));
				if($myEvent['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mevent->delete($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."event/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/event/delete",$this->_data);
		}
		/**end delete */			

		public function aj_getName()
		{
			# code...		         
	        $key = isset($_REQUEST['key']) && $_REQUEST['key'] ? strtoupper($_REQUEST['key']):'';
	        $and='';
	        if($key)
	        {
	            $and .= " 1 and (event_name like '%".$key."%' or event_detail like '%".$key."%')";                
	        }
	        $object = 'DISTINCT event_name,id';
	        $orderby = 'event_name asc';	        
	        $result = $this->mevent->getQuery($object="",$join="",$and,$orderby,$limit="");        
	        $this->_data = array();
	        if($result)
	        {
	            foreach ($result as $key => $value) {
	                # code...
	                $row_array['event_name'] = $value['event_name'];                
	                $row_array['id'] = $value['id'];                
	                array_push($this->_data, $row_array);                        
	            }
	        }            
	        echo json_encode($this->_data);
		}
	}
?>