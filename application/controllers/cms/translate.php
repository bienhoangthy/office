<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class translate extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();			
			$this->load->Model("cms/mtranslate");															
			$this->load->Model("cms/mlanguage");	
		}
		public function index()
		{
			# code...	
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');			
			$this->_data["title"]  = 'Danh sách translate';			
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',				
			);
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mtranslate->getQuery($object="",$join="",$and,$orderby,"0,20");
			$this->_data['record'] = $this->mtranslate->countQuery($join="",$and);

			/**begin xoa check chon*/
			if(isset($_POST['delAll'])){
				$checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
				if($checkid){
					foreach ($checkid as $key => $value) {
						# code...
						if(is_numeric($value)){
							$myTranslate = $this->mtranslate->getData('',array("id"=>$value));
							if($myTranslate['id']>0){								
								$this->mtranslate->delete($value);															
								$this->mtranslate_lang->deleteLang($value);
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
			$this->_data['translate_lang'] = $this->mlanguage->listTypeName();
			$this->my_layout->view("cms/translate/index",$this->_data);
		}		
		public function add()
		{
			# code...
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');							
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data['lang'] = my_lib::lang();
			$this->_data["title"]  = 'Thêm mới translate';
			$this->_data['translate_lang'] = $this->mlanguage->listTypeName();
			$this->_data['formData']	= array(
				"translate_name"=>"",																																					
				"translate_code"=>"",																																					
				"translate_lang"=>"",												
				"translate_create_date"=>date("Y-m-d H:i:s"),				
				"translate_type"=>1,
			);			

			if(isset($_POST['fsubmit'])){				
				$this->_data['formData']	= array(
					"translate_name"=>isset($_POST['translate_name']) && $_POST['translate_name'] ? $_POST['translate_name']:'',																				
					"translate_code"=>isset($_POST['translate_code']) && $_POST['translate_code'] ? $_POST['translate_code']:'',																																								
					"translate_type"=>isset($_POST['translate_type']) && $_POST['translate_type'] ? $_POST['translate_type']:'',																				
					"translate_create_date"=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['translate_name']){
					$insert = $this->mtranslate->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						if($this->_data['translate_lang']){
                            foreach($this->_data['translate_lang'] as $item){
                                $this->_data['translate_lang'] = "";
                                $this->_data['translate_lang']["translate_id"] = $insert;
                                $this->_data['translate_lang']["translate_lang"] = $item['lang'];
                                $this->_data['translate_lang']["translate_name"] = $_POST[$item['language_alias']];
                                if($this->_data['translate_lang']){
                                    $this->mtranslate_lang->add($this->_data["translate_lang"]);
                                }
                            }
                        }
						$this->_data['success'][] = "Add success";
						// $this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							// header("location:".my_lib::cms_site()."translate/");
							header("location:".my_lib::cms_site()."translate/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			$this->_data['translate_type'] = $this->mtranslate->dropdownlistType($this->_data['formData']['translate_type']);
			

			$this->my_layout->view("cms/translate/add",$this->_data);
		}

		
		public function edit($id)
		{
			# code...
			$myTranslate = '';
			if(is_numeric($id)){
				$myTranslate = $this->mtranslate->getData('',array("id"=>$id));
				if($myTranslate['id']<=0){
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
			$this->_data["title"]  = 'Cập nhật translate';
			$this->_data['translate_lang'] = $this->mlanguage->listTypeName();

			$this->_data['formData']	= array(
				"id"=>$id,
				"translate_name"=>isset($myTranslate['translate_name']) && $myTranslate['translate_name'] ? $myTranslate['translate_name']:'',															
				"translate_code"=>isset($myTranslate['translate_code']) && $myTranslate['translate_code'] ? $myTranslate['translate_code']:'',																											
				"translate_type"=>isset($myTranslate['translate_type']) && $myTranslate['translate_type'] ? $myTranslate['translate_type']:'',																																								
				"translate_create_date"=>date("Y-m-d H:i:s"),				
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"translate_name"=>isset($_POST['translate_name']) && $_POST['translate_name'] ? $_POST['translate_name']:'',																				
					"translate_code"=>isset($_POST['translate_code']) && $_POST['translate_code'] ? $_POST['translate_code']:'',																																								
					"translate_type"=>isset($_POST['translate_type']) && $_POST['translate_type'] ? $_POST['translate_type']:'',																									
					"translate_create_date"=>date("Y-m-d H:i:s"),					
				);	
				if($this->_data['formData']['translate_name']){					
					if($this->mtranslate->edit($id,$this->_data['formData'])){
						$this->_data['success'][] = "Add success";
						if($this->_data['translate_lang']){
                            foreach($this->_data['translate_lang'] as $item){
                                $this->_data['translate_lang'] = "";
                                $this->_data['translate_lang']["translate_id"] = $id;
                                $this->_data['translate_lang']["translate_lang"] = $item['lang'];
                                $this->_data['translate_lang']["translate_name"] = $_POST[$item['language_alias']];
                                if($this->_data['translate_lang']){                                	
                                    $this->mtranslate_lang->editLang($id,$item['lang'],$this->_data["translate_lang"]);
                                }
                            }
                        }
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."translate/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tiêu đề";
				}
			}

			$this->_data['translate_type'] = $this->mtranslate->dropdownlistType($this->_data['formData']['translate_type']);

			$this->my_layout->view("cms/translate/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myTranslate = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myTranslate = $this->mtranslate->getData('',array("id"=>$id));
				if(!isset($myTranslate['id']) || $myTranslate['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mtranslate->delete($id);
					$this->mtranslate_lang->deleteLang($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."translate/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/translate/delete",$this->_data);
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
	        	$and .= ' and (translate_name like "%'.$key.'%"';				
				$and .= ' or translate_code like "%'.$key.'%")';	           
	        }
	        $object = 'DISTINCT translate_name,id';
	        $orderby = 'translate_name asc';	        
	        $result = $this->mtranslate->getQuery($object="",$join="",$and,$orderby,$limit="");        
	        $this->_data = array();
	        if($result)
	        {
	            foreach ($result as $key => $value) {
	                # code...
	                $row_array['translate_name'] = $value['translate_name'];                	                             
	                $row_array['id'] = $value['id'];                	                             
	                array_push($this->_data, $row_array);                        
	            }
	        }            
	        echo json_encode($this->_data);
		}
		/**begin ajax search autocomplete trang danh sach + tim kiem bai viet trong binh luan*/		

		/**begin alias menu*/
		public function aj_aliasTranslate()
		{
			# code...
			# code...
			$html = '';
			$name = isset($_REQUEST['name']) ? trim($_REQUEST['name']):'';
			if($name){
				$html  = my_lib::convert_alias($name);
				$html = str_replace("-", "_",$html);
				/**begin kiem tra va conver name thanh alias*/
				$check = $this->mtranslate->countQuery("","translate_code='".$html."'");
				if($check>0){
					$html = $html.'_trung_lap';
				}
			}
			echo $html;
		}
		/**end alias menu*/
	}
?>