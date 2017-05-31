<?php
	class mproject extends CI_Model
	{
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_project";
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
	    		1=>array('name'=>"Đang tiến hành",'color'=>"primary"),
	    		2=>array('name'=>"Hoàn thành",'color'=>"success"),
	    		3=>array('name'=>"Hủy",'color'=>"default"),
	    		
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
	    /**end danh sach trang thai bai viet*/

	    //Loại dự án
		public function listType($item="")
	    {
	    	$arr = array(
	    		1=>array('name'=>"Dự án web giá rẻ",'color'=>"primary"),
	    		2=>array('name'=>"Dự án web pro",'color'=>"teal"),
	    		3=>array('name'=>"Dự án web công ty",'color'=>"success"),
	    		4=>array('name'=>"Dự án liên kết",'color'=>"info")
	    		
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
	    //Dropdown
	    public function dropdownlistType($active='')
		{
			$html = '';
			$data = $this->listType();			
			if($data){				
				$html .= '<option value="">-- Chọn loại dự án --</option>';
				foreach ($data as $key => $value) {
					$selected = $active==$key ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$key.'">- '.$value["name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}


	    /**begin drop down Status*/
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

		// public function dropdownlistPhase($active='')
		// {
		// 	# code...
		// 	$html = '';
		// 	$data = $this->listPhase();			
		// 	if($data){				
		// 		$html .= '<option value="">-- Chọn giai đoạn --</option>';
		// 		foreach ($data as $key => $value) {
		// 			$selected = $active==$key ? 'selected':'';
		// 			$html .= '<option '.$selected.' value="'.$key.'">- '.$value["name"].'</option>';						
		// 		}
		// 	}else{
		// 		$html .= '<option value="0">Data empty</option>';
		// 	}
		// 	return $html;
		// }

	}
?>