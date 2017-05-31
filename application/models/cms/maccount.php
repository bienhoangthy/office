<?php
	/**
	* 
	*/
	class maccount extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_account";
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

	    public function totalMoney($id_type,$and="")
	    {
	    	$sql = 'select sum(a_money) as totalMoney from '.$this->table.' where a_type_chilrd = '.$id_type;
	    	if ($and) {
	    		$sql .= ' '.$and;
	    	}
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

	    public function dropdownlistYear($active='')
		{
			# code...
			$html = '';
			$data = array(
				2012 => '2012',
				2013 => '2013',
				2014 => '2014',
				2015 => '2015',
				2016 => '2016',
				2017 => '2017',
				2018 => '2018',
				2019 => '2019',
				2020 => '2020',
				2021 => '2021',
				2022 => '2022',
				2023 => '2023',
				2024 => '2024',
				2025 => '2025'
				);		
			if($data){				
				$html .= '<option value="all">Năm</option>';
				foreach ($data as $key => $value) {
					# code...
					$selected = $active==$key ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$key.'">'.$value.'</option>';						
				}
			}
			return $html;
		} 

		// DropdownTypeTime
		public function dropdownlistTypetime($active='')
		{
			$html = '';
			$data = array(
				1 => 'Tuần',
				2 => 'Tháng',
				3 => 'Quý'
				);		
			if($data){				
				$html .= '<li><option value="all">All</option></li>';
				foreach ($data as $key => $value) {
					$selected = $active==$key ? 'selected':'';
					$html .= '<li><option '.$selected.' value="'.$key.'">'.$value.'</option></li>';						
				}
			}
			return $html;
		}

		public function getSum($and)
	    {
	    	$sql = 'select sum(a_money) as totalMoney from '.$this->table.' where '.$and;
	    	$query = $this->db->query($sql);
	        return $query->row_array();
	    }	   	   	 
	}
?>