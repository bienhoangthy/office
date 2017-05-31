<?php
	/**
	* 
	*/
	class mpermission extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_permission";
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

	    public function getObject($object = '', $where = '', $order_by = '', $limit = '', $group_by = '')
	    {
	        if ($object) {
	            $this->db->select($object);
	        }
	        if ($where) {
	            $this->db->where($where);
	        }
	        if ($order_by) {
	            $this->db->order_by($order_by);
	        }
	        if ($limit) {
	            /*$l = explode(",", $limit);
	            if (isset($l[1])) {
	                $this->db->limit($l[0], $l[1]);
	            } else {
	                $this->db->limit($l[0]);
	            }*/
	            $this->db->limit($limit);
	        }
	        if ($group_by) {
	            $this->db->group_by($group_by);
	        }
	        $rs = $this->db->get($this->table);
	        return $rs->result_object();
	    }

	   public function myPermission($group_id)
	    {
	        $html   = array();
	        $object = array("gc_id");
	        $and    = array("group_id" => $group_id);
	        $data   = $this->getObject($object, $and);
	        if ($data) {
	            foreach ($data as $key => $value) {
	                $html[$key] = $value->gc_id;
	            }
	        }
	        return $html;
	    }
	}
?>