<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	class com extends MY_Controller
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mcom");
		}
		/**ajax load view menu*/
		public function ajaxLoadView()
		{
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$com = isset($_REQUEST['com']) ? $_REQUEST['com']:'';
			$view = isset($_REQUEST['view']) ? $_REQUEST['view']:'';
			$html = '';
			if($com){
				/**lay iD*/				
				$this->_data = $this->mcom->getQuery($object="",$join="",$and="com_com='".$com."' and com_status=1 and com_parent != 0",$orderby="",$limit="");								
				if($this->_data){
					$html .= '<option value="">Select a item...</option>';
					foreach ($this->_data as $key => $value) {
						# code...
						$selected = $view==$value["com_type"]?'selected':'';
						$html .= '<option '.$selected.' value="'.$value["com_type"].'">'.$value['com_name'].'</option>';
					}
				}
			}
			echo $html;
		}
		/**ajax load view menu*/
		
	}
?>