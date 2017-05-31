<?php
	/**
	* 
	*/
	class mcompany_work extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_company_work";
		/**begin danh sach*/
	    public function getQuery($object="",$join="",$and="",$orderby="",$limit="",$groupby=''){
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

	        if($groupby){
	            $sql .= ' group by  '.$groupby;
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

	    /**begin thong bao nhac lich cho nhan vien*/	
		/***
		@ neu nhan vien chi thay thong bao cho nhan vien hien tai, 
		@ neu admin thi thay duoc nhieu nhan vien khac
		*/
		public function showCompanyWorking($user)
		{		
			$object_work="";
			$join_work="";		
			if($user)
				$and_work="status_work = 0 and time <= '".date("H:i")."' and create_date = '".date("Y-m-d")."' and user in (".$user.")";
			else
				$and_work="status_work = 0 and time <= '".date("H:i")."' and create_date = '".date("Y-m-d")."'";				
			$orderby_work=" create_date desc,time desc";
			$limit_work="";
			$listCompanyWork = $this->getQuery($object_work,$join_work,$and_work,$orderby_work,$limit_work);
			return $listCompanyWork;		
		}
		/**end thong bao nhac lich cho nhan vien*/	
	  
	}
?>