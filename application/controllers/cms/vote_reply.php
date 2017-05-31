<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class vote_reply extends MY_Controller
	{
		function __construct()
		{
			# code...
			parent::__construct();						
			$this->load->Model("cms/mvote");							
			$this->load->Model("cms/mvote_reply");							
			$this->load->Model("cms/mmenu");					
		}
		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myVoteReply = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myVoteReply = $this->mvote_reply->getData('',array("id"=>$id));
				if($myVoteReply['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mvote_reply->delete($id);
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
			$this->my_layout->view("cms/vote_reply/delete",$this->_data);
		}
		/**end delete */
	}
?>