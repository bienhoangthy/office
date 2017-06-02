<?php
	/**
	* 
	*/
	class mtask extends CI_Model
	{
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_task";
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

	    /**begin lay nhieu dong co dieu kien*/
	    public function getDataList($object='',$and=""){
	    	if($object)
	    	{
	    		$this->db->select($object);
	    	}
	    	if($and){
		        $this->db->where($and);
		        $rs = $this->db->get($this->table);
		        return $rs->result_array();
		    }
	    }
	    /**end lay nhieu dong co dieu kien*/

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

	    /**begin danh sach trang thai bai viet*/
	    public function listStatus($item="")
	    {
	    	# code...
	    	$arr = array(
	    		1=>array('name'=>"Đang chờ xử lý",'color'=>"primary"),
	    		2=>array('name'=>"Đã hoàn thành",'color'=>"success"),
	    		3=>array('name'=>"Hoãn việc",'color'=>"default"),
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
	    /**end danh sach trang thai bai viet*/

	    public function listType($item="")
	    {
	    	# code...
	    	$arr = array(
	    		1=>array('name'=>"Tự lên kế hoạch",'color'=>"teal"),
	    		2=>array('name'=>"Việc ưu tiên",'color'=>"success"),
	    		3=>array('name'=>"Được giao",'color'=>"warning"),
	    		4=>array('name'=>"Được giao gấp",'color'=>"danger"),
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }

	    /**begin drop down type*/
		public function dropdownlistStatus($active='')
		{
			# code...
			$html = '';
			$data = $this->listStatus();			
			if($data){				
				$html .= '<option value="">-- Chọn trang thái --</option>';
				foreach ($data as $key => $value) {
					# code...
					$selected = $active==$key ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$key.'">- '.$value["name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}

		public function dropdownlistType($active='')
		{
			# code...
			$html = '';
			$data = $this->listType();			
			if($data){				
				$html .= '<option value="">-- Chọn loại công việc --</option>';
				foreach ($data as $key => $value) {
					# code...
					$selected = $active==$key ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$key.'">- '.$value["name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}
		public function showTask($user)
		{
			$object_task = "id,task_name,task_delay,task_expectedday,task_status";
			$and_task = " task_status <> 2 and task_employee = ".$user;
			$orderby = "id asc";
			$listTask = $this->getQuery($object_task,"",$and_task,$orderby,"");
			return $listTask;
		}
		
		public function sendMessage($id_code_user,$note,$link,$img)
		{
			$content = array(
			"en" => $note,
			"vn" => $note
			);
			$heading = array(
			"en" => 'CRM Office TSMedia',
			"vn" => 'CRM Office TSMedia'
			);
		
			$fields = array(
				'app_id' => "141222d1-61b5-4bd5-89fc-8b24d54be640",
				'headings' => $heading,
				'include_player_ids' => $id_code_user,
	      		'url' => $link,
	      		'chrome_web_icon' => $img,
				'contents' => $content
			);
			
			$fields = json_encode($fields);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
													   'Authorization: Basic ZGVlNWIwYTItYjA3YS00YmE4LTlmMzktODE3MmRiOTgwNGI2'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			curl_close($ch);
			
			return $response;
		}

	}
?>