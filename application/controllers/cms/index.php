<?php
session_start();
	class index extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();		
			$this->load->Model("cms/mhistory");				
		}
		public function index()
		{
			# code...		
			$s_info = $this->session->userdata('userInfo');            
			if($s_info){
                header("location:".my_lib::cms_site()."home/");
			}	
			$this->_data["title"]  = 'Login';			
			$this->_data['error'] = NULL;
			$this->_data['formData'] = array(
				"username"=>"",
				"password"=>"",
			);
			if(isset($_POST['flogin']))
			{
				$this->_data['formData']['username'] = isset($_POST['username']) && $_POST['username'] ? $_POST['username']:'';
				$this->_data['formData']['password'] = isset($_POST['password']) && $_POST['password'] ? $_POST['password']:'';
				if($this->_data['formData']['username']=='')
				{
					$this->_data['error'][] = "Bạn chưa nhập tên đăng nhập";
				}
				if($this->_data['formData']['password']=='')
				{
					$this->_data['error'][] = "Bạn chưa nhập mật khẩu";
				}
				if($this->_data['formData']['username'] && $this->_data['formData']['password'])
				{
					$myUser = $this->muser->getData("",array("user_username"=>$this->_data['formData']['username'],"user_password"=>md5($this->_data['formData']['password']),"user_status"=>1));					
					if($myUser && isset($myUser['id']) && is_numeric($myUser['id'])>0)
					{
						/**beign history*/
						if ($this->agent->is_browser())
						{
						    $agent = $this->agent->browser();
						}
						elseif ($this->agent->is_robot())
						{
						    $agent = $this->agent->robot();
						}
						elseif ($this->agent->is_mobile())
						{
						    $agent = $this->agent->mobile();
						}
						else
						{
						    $agent = 'Unidentified User Agent';
						}				

						$myDepartment = $this->mdepartment->getData('',array("id"=>$myUser['user_department']));
                        $history_department = isset($myDepartment['department_name']) ? $myDepartment['department_name']:'';
                        $myGroup = $this->mgroup->getData('',array("id"=>$myUser['user_group']));
                        $history_group = isset($myGroup['group_name']) ? $myGroup['group_name']:'';

						$this->_data['history'] = array(
							"history_username"=>$myUser['user_username'],
							"history_group"=>$history_group,
							"history_department"=>$history_department,
							"history_ip"=>$this->session->userdata('ip_address'),
							"history_time"=>date('Y-m-d H:i:s'),
							"history_agent"=>$agent,
							"history_version"=>$this->agent->version(),							
							"history_platform"=>$this->agent->platform(),
						);
						if($this->_data['history'])
						{
							$this->mhistory->add($this->_data['history']);
						}	
						//End

						$getUserParent = $this->muser->checkUserParent($myUser['id']);
						$userInfo = array(
                            "s_user_id"=>$myUser["id"],
                            "s_user_parent"=>$getUserParent,
                            "s_user_email"=>$myUser["user_email"],
                            "s_user_username"=>$myUser["user_username"],
                            "s_user_password"=>$myUser["user_password"],
                            "s_user_fullname"=>$myUser["user_fullname"],                                                        
                            "s_user_group"=>$myUser["user_group"],                                                                                                             
                            "s_user_department"=>$myUser["user_department"],
                            "s_user_position"=>$myUser["user_position"],
                            "s_user_avatar"=>$myUser["user_avatar"],
                            "s_user_folder"=>$myUser["user_folder"],
                            "s_logged_in"=>true
                        );
                        $_SESSION["id_user_sc"] = $myUser['id'];
                        if($myUser["user_group"]!=1)
                        	$_SESSION["f_user_folder"] = $myUser["user_folder"];
                        else
                        	$_SESSION["f_user_folder"] = "";

                        /**end gan session*/
                        
                        $this->session->set_userdata('userInfo',$userInfo);
                        $s_info = $this->session->userdata('userInfo');
                        if($s_info){                                                                            
                            /**begin xu ly chuyen trang*/
                            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                                header("location:".base64_decode($_REQUEST['redirect']));
                            else                                
								header('location:'.my_lib::cms_site().'home/');
                            /**end xu ly chuyen trang*/
                        }

						header('location:'.my_lib::cms_site().'home/');
					}
					else
					{
						$this->_data['error'][] = "Vui lòng kiểm tra lại thông tin";
					}
				}
				else
				{
					$this->_data['error'][] = "Bạn chưa nhập thông tin";					
				}
			}
			if (isset($_POST['submit_reset'])) {
				$this->_data['formData']['email_reset'] = isset($_POST['email_reset']) && $_POST['email_reset'] ? $_POST['email_reset']:'';
				if($this->_data['formData']['email_reset']=='')
				{
					$this->_data['error'][] = "Bạn chưa nhập mail reset!";
				}
				$myUserReset = $this->muser->getData("",array("user_email"=>$this->_data['formData']['email_reset'],"user_status"=>1));
				if ($myUserReset && isset($myUserReset['id']) && is_numeric($myUserReset['id'])>0) {
					$newPass = mt_rand();
					$to = $this->_data['formData']['email_reset'];
					$content = "Password mới của ".$myUserReset['user_fullname']." là: ".$newPass;
					if ($this->muser->edit($myUserReset['id'], array('user_password' => md5($newPass)))) {
						$this->Msendmail("Admin CRM","hotro@ioi.vn",$to,$cc='',$bcc='',"Reset password Office CRM",$content,$file='');
						$this->_data['success'] = "Vui lòng check mail để nhận password mới!";
					}
				} else {
					$this->_data['error'][] = "Email không tồn tại!";
				}
			}
			$this->load->view("cms/index/login",$this->_data);
		}
		
		public function logout()
		{
			# code...
			$this->session->unset_userdata("userInfo");
			session_destroy();
			header('location:'.my_lib::cms_site().'index/');
		}
	}
?>