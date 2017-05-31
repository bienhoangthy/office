<?php
	/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
class MY_Controller extends CI_Controller{
    	protected $_data;
    	public function __construct(){
		parent::__construct();
		$this->load->library(array("my_layout","my_paging","form_validation","session","user_agent"));
		$this->my_layout->setLayout("cms/template/default/default");/**load file layout chinh*/
		$this->load->Model("cms/muser");				
		$this->load->Model("cms/mdepartment");			
		$this->load->Model("cms/mgroup");
		$this->load->Model("cms/mconfig");
		$this->load->Model("cms/mtranslate");
		$this->load->Model("cms/mcompany");
		$this->load->Model("cms/minfocontact");
		$this->load->Model("cms/mcompany_work_status");
		$this->load->Model("cms/mcalendar");
		$this->load->Model("cms/mcompany_work");
		$this->load->Model("cms/mmessage");
		$this->load->Model("cms/mservice");
		$this->load->Model("cms/mtask");
		$this->load->Model("cms/mfile");
		$this->load->Model("cms/mevent");
		//$this->load->Model("cms/mnotification");
		if($this->uri->segment(2)!=""){
			$this->muser->checkLogin();			
		}
		$this->_data['s_info'] = $user_login = $this->session->userdata('userInfo');	
		$this->_data['andUser'] = $this->_data['s_info']['s_user_parent'];
		
		$this->_data['s_readonly'] = "readonly";
		$this->_data['s_disabled'] = "disabled";
		if($this->_data['s_info']['s_user_group']==1)
		{
			$this->_data['s_readonly'] = "";
			$this->_data['s_disabled'] = "";
			$this->_data['andUser'] = "";
		}elseif($this->_data['s_info']['s_user_group']==5){ //kinh doanh
			$this->_data['s_readonly'] = "";
			$this->_data['s_disabled'] = "";			
		}			
		$this->mconfig->defined();			
		$this->mtranslate->defined();		
		$this->_data['showMessage']  = $this->mmessage->showMessage();
		if (!empty($user_login['s_user_id'])) {
			$this->_data['showTask']  = $this->mtask->showTask($user_login['s_user_id']);
		}
		$this->_data['listService'] = $this->mservice->getQuery("id,service_name","","service_parent = 0","id asc","");		

		//Files
		$and1 = ' file_level = 1 and file_status = 1 and file_parent = 0';
		$orderby = 'file_order asc, id asc';
		$this->_data['listFile_lv1'] = $this->mfile->getQuery($object="id,file_title",$join="",$and1,$orderby,$limit="");

		//BD
		$listBDNow = '';
		$listBDSoon = '';
		if ($this->muser->showBirthDay() == true) {
			$listBDNow = $this->mevent->getDetail(1);
			$listBDNow = explode(',', $listBDNow['event_detail']);
			$listBDSoon = $this->mevent->getDetail(2);
			$listBDSoon = explode(',', $listBDSoon['event_detail']);
			array_pop($listBDNow);
			array_pop($listBDSoon);
		}
		$this->_data['listBDNow'] = $listBDNow;
		$this->_data['listBDSoon'] = $listBDSoon;
		
	}


	

	public function Msendmail($name,$from,$to,$cc='',$bcc='',$title,$content,$file='')
    	{
	       	# code...
	        	// $html = 1; //thanh cong
	        	$this->load->library('email');
	       	$this->load->library('parser');
	        	$config['useragent']        = 'CodeIgniter';        
		$config['protocol']         = 'smtp';        
		$config['mailpath']         = '/usr/sbin/sendmail';
		$config['smtp_host']        = config_email_server;
		$config['smtp_user']        = config_email_send;
		$config['smtp_pass']        = config_email_pass;
		$config['smtp_port']        = config_email_port;
		$config['smtp_timeout']     = 5;
		$config['wordwrap']         = FALSE;
		$config['wrapchars']        = 76;
		$config['mailtype']         = 'html';
		$config['charset']          = 'utf-8';
		$config['validate']         = FALSE;
		$config['priority']         = 3;
		$config['crlf']             = "\r\n";
		$config['newline']          = "\r\n";
		$config['bcc_batch_mode']   = FALSE;
		$config['bcc_batch_size']   = 200;

        		$this->email->initialize($config);
        		$this->email->from($from, $name);
        		$this->email->to($to); 
        		if($cc){
            			$this->email->cc($cc);              
        		}
        		if($bcc){
            			$this->email->bcc($bcc);              
        		}

        		$this->email->subject($title);
        		$this->email->message($content); 
        		if($file){
            			$this->email->attach($file); 
        		}
        		if($name && $from && $to && $title && $content){
            			$this->email->send();
        		}
        		// return $html;
    	}  

    	public function Action_TS_Server($service,$username,$action)
    	{
    		$this->load->helper("httpsocket_ts_server");
    		$sock = new HTTPSocket;
		$server_ip="125.212.219.88"; //IP của server
		$server_login= $service; // Tài khoản RSL
		if ($service="vps" || $service="Vps") {
			$server_pass="VCVNM2QxYUApISY="; // Mật khẩu RSL
		}
		if ($service="hosting" || $service="Hosting") {
			$server_pass="QTNoNDVHMnk="; // Mật khẩu RSL
		}
		$package="Host-TS01"; // Tên gói packages
		$server_host=$server_ip; //where the API connects to 127.0.0.1
		$server_ssl="Y";
		$server_port=1212;

		if ($server_ssl == 'Y')
		{
			$sock->connect("ssl://".$server_host, $server_port);
		}
		else
		{ 
			$sock->connect($server_host, $server_port);
		}
		$sock->set_login($server_login,$server_pass);
		if ($action == "suspend"){
			$key = 'dosuspend';
		}
		if ($action == "unsuspend"){
			$key = 'dounsuspend';
		}
		$sock->query('/CMD_SELECT_USERS',
				array(
					'location' => 'CMD_USER_SHOW',
					$key=>'1',
					'select0' => $username
			    	));
		$result = $sock->fetch_parsed_body();
		
    	}  
}
?>