<?php
	/**
	* 
	*/
	class mcalendar extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_calendar";
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
	    		1=>array(
	    			'name'=>'Chưa duyệt',
	    			'color'=>'danger'
	    			),
	    		2=>array(
	    			'name'=>'Đã duyệt',
	    			'color'=>'success'
	    			)
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
	    /**end danh sach trang thai bai viet*/

	    /**begin drop down type*/
		public function dropdownListStatus($active='')
		{
			# code...
			$html = '';
			$data = $this->listStatus();
			if($data){				
				$html .= '<option value="all">-- Chọn trạng thái --</option>';
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
		/**end drop down type*/	  


		/**begin thong bao lich ca nhan cho nhan vien*/	
		/***
		@ neu nhan vien chi thay thong bao cho nhan vien hien tai, 
		@ neu admin thi thay duoc nhieu nhan vien khac
		*/
		// public function showCalendar($user)
		// {		
		// 	$object_calendar="";
		// 	$join_calendar="";		
		// 	if($user)
		// 		$and_calendar=" calendar_start >= '".date("Y-m-d")."' and user in (".$user.")";
		// 	else
		// 		$and_calendar=" calendar_start >= '".date("Y-m-d")."'";				
		// 	$orderby_calendar=" calendar_start asc";
		// 	$limit_calendar="";
		// 	$listCompanyWork = $this->getQuery($object_calendar,$join_calendar,$and_calendar,$orderby_calendar,$limit_calendar);
		// 	return $listCompanyWork;		
		// }
		/**end thong bao lich ca nhan cho nhan vien*/	  
	}
?>