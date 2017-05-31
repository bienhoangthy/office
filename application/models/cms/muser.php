<?php
	/**
	* 
	*/
	class muser extends CI_Model
	{
		public $path            = 'media/user';
		public function __construct()
		{			
			parent::__construct();
			$this->load->Model("cms/mpermission");
	        $this->load->Model("cms/mgroupaction");
	        $this->load->Model("cms/mgroup");
			$this->load->library(array("session"));					
		}
		protected $table = "tkwp_user";
		protected $table_event = "tkwp_event";
		/**begin danh sach*/
	    public function getQuery($object="",$join="",$and="",$orderby="",$limit=""){
	        if($object){
	            $sql = 'select '.$object.' ';
	        }else{
	            $sql = 'select * ';
	        }

	        $sql .= 'from '.$this->table.' j ';
	        if($join){
	            $sql .= $join;
	        }
	        if($and){
	            $sql .= ' where '.$and;
	        }

	        if($orderby){
	            $sql .= ' order by '.$orderby;
	        }

	        if($limit){
	            $sql .= ' limit '.$limit;
	        }
	        $query = $this->db->query($sql);
	        return $query->result_array();

	    }
	    /**end danh sach*/	 

	    //Info BD
	    public function getInfoBD($id)
	    {
	    	$sql = 'select user_fullname,user_avatar,user_birthday from '.$this->table.' where id = '.$id;
	    	$query = $this->db->query($sql);
	        return $query->row_array();
	    }   

	    /**begin dem theo query sql*/
	    public function countQuery($join="",$and=""){
	        $sql = 'select * from '.$this->table.' j' ;
	        if($join){
	            $sql .= $join;
	        }
	        $sql .= ' where 1 ';
	        if($and){
	        	
	            $sql .= ' and '.$and;
	        }
	        $query = $this->db->query($sql);
	        $count = $query->num_rows();
	        return $count;
	    }
	    /**end dem theo query sql*/

	    /**begin lay 1 dong co dieu kien*/
	    public function getData($object='',$and=""){
	    	if($object)
	    	{
	    		$this->db->select($object);
	    	}
	    	if($and){
		        $this->db->where($and);
		        $rs = $this->db->get($this->table);
		        return $rs->row_array();
		    }
	    }
	    /**end lay 1 dong co dieu kien*/
	    /**them moi data*/
	    public function add($data){
	        $this->db->insert($this->table,$data);
	        $id = $this->db->insert_id(); /**lay ra insert_id*/
	        return $id;
	    }
	    /**end them moi*/

	    /**begin cap nhat*/
	    public function edit($id,$data){
	        $this->db->where("id",$id);
	        $this->db->update($this->table,$data);
	        return true;
	    }
	    /**end cap nhat*/

	    /**begin xoa*/
	    public function delete($id){
	        if(is_numeric($id)){
	            $this->db->where('id',$id);
	        }elseif(is_array($id)){
	            $this->db->where_in('id',$id);
	        }
	        return $this->db->delete($this->table);
	    }
	    /**end xoa*/
	   
	   /**begin check permission*/
	   public function checkLogin()
	   {	   		
	   		$s_info = $this->session->userdata('userInfo');
	   		if($s_info==NULL){
                header("location:".my_lib::cms_site().'?redirect='.base64_encode(my_lib::cms_site().'/'.$_SERVER["REDIRECT_URL"]));
				exit();		
			}
	   }
	   /**end check permission*/

	   
	   /**begin check user parent*/
	   public function checkUserParent($user_parent)
	   {
	   		$html = '';
	   		$object="id";
	   		$join="";
	   		$and="user_parent=".$user_parent;
	   		$orderby="id";
	   		$limit="";
	   		$tmpData = $this->getQuery($object,$join,$and,$orderby,$limit);
	   		if($tmpData)
	   		{
	   			foreach ($tmpData as $key => $value) {
	   				$html .= $value["id"].',';
	   				$tmpData_C2 = $this->getQuery($object,$join,"user_parent=".$value['id'],$orderby,$limit);
	   				if($tmpData_C2)
	   				{
	   					foreach ($tmpData_C2 as $key_C2 => $value_C2) {
	   						$html .= $value_C2["id"].',';
	   						$tmpData_C3 = $this->getQuery($object,$join,"user_parent=".$value_C2['id'],$orderby,$limit);
	   						if($tmpData_C3)
	   						{
	   							foreach ($tmpData_C3 as $key_C3 => $value_C3) {
	   								$html .= $value_C3["id"].',';
	   								$tmpData_C4 = $this->getQuery($object,$join,"user_parent=".$value_C3['id'],$orderby,$limit);
	   								if($tmpData_C4){
	   									foreach ($tmpData_C4 as $key_C4 => $value_C4) {
	   										$html .= $value_C4["id"].',';
			   								$tmpData_C5 = $this->getQuery($object,$join,"user_parent=".$value_C4['id'],$orderby,$limit);
			   								if($tmpData_C5)
			   								{
			   									foreach ($tmpData_C5 as $key_C5 => $value_C5) {
			   										$html .= $value_C5["id"].',';
			   									}
			   								}
	   									}
	   								}
	   							}
	   						}
	   					}
	   				}
	   			}
	   			$html .= $user_parent;
	   		}
	   		else
	   		{
	   			$html = $user_parent;
	   		}
	   		return $html;
	   }
	   /**end check user parent*/



	   /**begin danh sach trang thai bai viet*/
	    public function listStatusName($item="")
	    {	    	
	    	$arr = array(
	    		1=>array(
	    			'name'=>'Hoạt động',
	    			'bg'=>'#00b1e1',
	    			'color'=>'#fff'
	    			),	 
	    		2=>array(
	    			'name'=>'Bị khóa',
	    			'bg'=>'#2a2a2a',
	    			'color'=>'#fff'
	    			),   		
	    		3=>array(
	    			'name'=>'Chưa kích hoạt mail',
	    			'bg'=>'#ffd66a',
	    			'color'=>'#fff'
	    			),
	    		4=>array(
	    			'name'=>'Đã nghỉ',
	    			'bg'=>'#ed5466',
	    			'color'=>'#fff'
	    			),
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
		public function dropdownlistStatus($active='')
		{			
			$html = '';
			$data = $this->listStatusName();
			if($data){				
				$html .= '<option value="all">-- Chọn trạng thái --</option>';
				foreach ($data as $key => $value) {					
					$selected = $active==$key ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$key.'">- '.$value["name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}
		/**end drop down type*/	 
		public function getUploadPath()
	    {
	        return FCPATH . $this->path.'/';
	    }

		// State
		public function listState($item="")
	    {	    	
	    	$arr = array(
	    		1=>array(
	    			'name'=>'Nhân viên chính thức',
	    			'color'=>'primary'
	    			),	 
	    		2=>array(
	    			'name'=>'Thử việc',
	    			'color'=>'info'
	    			),   		
	    		3=>array(
	    			'name'=>'Thực tập',
	    			'color'=>'teal'
	    			),
	    		4=>array(
	    			'name'=>'Cộng tác viên',
	    			'color'=>'danger'
	    			),
	    		5=>array(
	    			'name'=>'Hợp đồng thời vụ',
	    			'color'=>'warning'
	    			),
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
		public function dropdownlistState($active='')
		{			
			$html = '';
			$data = $this->listState();
			if($data){				
				$html .= '<option value="all">-- Chọn trình trạng --</option>';
				foreach ($data as $key => $value) {					
					$selected = $active==$key ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$key.'">- '.$value["name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}
		// End 

	   /**begin drop down parent*/
		public function dropdownlist($parent='')
		{						
			$html = '';				
			$s_info  = $this->session->userdata('userInfo');				
			$getUserParent = $this->checkUserParent($s_info['s_user_id']);					
			// $and = "user_status = 1 ";	
			$and = "user_status != 4 ";	
			if($s_info['s_user_group']!=1 && $s_info['s_user_group']!=3 && $s_info['s_user_group']!=5 && $getUserParent )
			{
				$and .= " and id in (".$getUserParent.",".$s_info['s_user_id'].")";	
			}													
			
			$data = $this->getQuery("id,user_fullname",$join="",$and,"id asc","");
			if($data){
				$html .= '<option value="0">-- Chọn nhân viên --</option>';
				foreach ($data as $key => $value) {										
					$selected = $parent==$value['id'] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["user_fullname"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}

		public function dropdownlist1($parent='')
		{						
			$html = '';				
			$s_info  = $this->session->userdata('userInfo');				
			$getUserParent = $this->checkUserParent($s_info['s_user_id']);					
			// $and = "user_status = 1 ";	
			$and = "user_status != 4 ";	
			if($s_info['s_user_group']!=1 && $getUserParent )
			{
				$and .= " and id in (".$getUserParent.",".$s_info['s_user_id'].")";	
			}													
			
			$data = $this->getQuery("id,user_fullname",$join="",$and,"id asc","");
			if($data){
				$html .= '<option value="">-- Chọn nhân viên --</option>';
				foreach ($data as $key => $value) {										
					$selected = $parent==$value['id'] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["user_fullname"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}
		/**end drop down parent*/

		public function dropdownlistAccountDepartment($parent='',$department='')
		{						
			$html = '';							
			$and = "user_status != 4 and user_department = ".$department;				
			$data = $this->getQuery("id,user_fullname",$join="",$and,"id asc","");
			if($data){
				$html .= '<option value="0">-- Chọn nhân viên --</option>';
				foreach ($data as $key => $value) {										
					$selected = $parent==$value['id'] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["user_fullname"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}

	   /**begin drop */
		public function dropdownlistAccount($parent='')
		{						
			$html = '';							
			$and = "user_status != 4 ";				
			$data = $this->getQuery("id,user_fullname",$join="",$and,"id asc","");
			if($data){
				$html .= '<option value="0">-- Chọn nhân viên --</option>';
				foreach ($data as $key => $value) {										
					$selected = $parent==$value['id'] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["user_fullname"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}
		public function dropdownlistAccount1($parent='')
		{						
			$html = '';							
			$and = "user_status != 4 ";				
			$data = $this->getQuery("id,user_fullname",$join="",$and,"id asc","");
			if($data){
				$html .= '<option value="0">-- Chọn nhân viên --</option>';
				foreach ($data as $key => $value) {										
					$selected = $parent==$value['id'] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["user_fullname"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}
		/**end drop down parent*/

		//Edit Event
		public function editEvent($id,$data){
	        $this->db->where("id",$id);
	        $this->db->update($this->table_event,$data);
	        return true;
	    }

		/**begin lay ra ngay sinh nhat cua nhan vien*/
		public function showBirthDay()
		{
			if (date("H:i:s") < "08:20:00") {
				$today = date("Y-m-d");
				$tomorrow = strtotime(date("Y-m-d", strtotime($today)) . " +1 day");
  				$tomorrow = strftime("%Y-%m-%d", $tomorrow);
  				$daysoon = date("d",strtotime($tomorrow));
				$monthsoon = date("m",strtotime($tomorrow));
				$day = date("d",strtotime($today));
				$month = date("m",strtotime($today));
				$and="user_status = 1 and DAYOFMONTH(user_birthday) = ".$day." and MONTH(user_birthday) = ".$month;
				$and2="user_status = 1 and DAYOFMONTH(user_birthday) = ".$daysoon." and MONTH(user_birthday) = ".$monthsoon;
				$listEmpBD = $this->getQuery('id',$join="",$and,$orderby="",$limit="");
				$listEmpBDsoon = $this->getQuery('id',$join="",$and2,$orderby="",$limit="");
				$BDToday = '';
				$BDSoon = '';
				if (!empty($listEmpBD)) {
					foreach ($listEmpBD as $key => $value) {
						$BDToday .= $value['id'].',';
					}
				}
				if (!empty($listEmpBDsoon)) {
					foreach ($listEmpBDsoon as $key => $value) {
						$BDSoon .= $value['id'].',';
					}
				}
				$this->editEvent(1,array('event_detail' => $BDToday));
				$this->editEvent(2,array('event_detail' => $BDSoon));
				return true;
			}
			return true;
		}

		public function checkPermission($controller, $action)
	    {
	        $s_info = $this->session->userdata('userInfo');
	        if ($controller && $action) {
	            $groupId       = $s_info['s_user_group'];
	            $myPermission  = $this->mpermission->myPermission($groupId);
	            $gc_value      = $controller . '_' . $action;
	            $myGroupAction = $this->mgroupaction->myGroupAction($gc_value);
	            if ($myPermission && $myGroupAction) {
	                if (!in_array($myGroupAction, $myPermission)) {
	                    redirect(my_lib::cms_site() . 'error/permission');
	                }
	            } else {
	                redirect(my_lib::cms_site() . 'error/permission');
	            }
	        } else {
	            redirect(my_lib::cms_site() . 'error/permission');
	        }
	    }
	}
?>