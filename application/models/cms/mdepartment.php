<?php
	/**
	* 
	*/
	class mdepartment extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_department";
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
	        }else{	        	
	            $sql .= ' order by id asc';
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

	    /**begin drop down parent*/
		public function dropdownlist($parent='')
		{
			# code...
			$html = '';
			$data = $this->mdepartment->getQuery("id,department_name",$join="","department_parent = 0","department_order","");
			if($data){
				$html .= '<option value="0">-- Chọn phòng ban --</option>';
				foreach ($data as $key => $value) {
					# code...
					$selected = $parent==$value['id'] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["department_name"].'</option>';	
					$data2 = $this->mdepartment->getQuery("id,department_name",$join="","department_parent = ".$value['id'],"department_order","");
					if($data2){
						foreach ($data2 as $key2 => $value2) {
							# code...
							$selected = $parent==$value2['id'] ? 'selected':'';
							$html .= '<option '.$selected.' value="'.$value2["id"].'">'.$value["department_name"].' » '.$value2["department_name"].'</option>';	
						}
					}
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}
		/**end drop down parent*/
	   
	}
?>