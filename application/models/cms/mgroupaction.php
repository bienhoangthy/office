<?php
	/**
	* 
	*/
	class mgroupaction extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_group_action";
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
	   
	   public function myGroupAction($gc_value)
	    {
	        $html   = '';
	        $object = array("id");
	        $and    = array("gc_value" => $gc_value);
	        $data   = $this->getData($object, $and);
	        $html   = isset($data['id']) ? $data['id'] : '';
	        return $html;
	    }

	   public function loadGroupAction($arrCategory, $group_id = '')
	    {
	        $data = '';
	        if ($arrCategory) {
	            if (is_array($arrCategory)) {
	                $arrCategory = ltrim(implode(",", $arrCategory), ",");
	            }
	            $myCate = $this->mcategory->getQuery("category_name,category_component", 'id in (' . $arrCategory . ')', $orderby = "", $limit = "");
	            if ($myCate) {
	                foreach ($myCate as $key => $value) {
	                    $data .= '<div class="col-lg-12 alert alert-success mt10">' . $value["category_name"] . '</div>';
	                    $myGA = $this->getQuery("id,gc_name,gc_value", "gc_value like '" . $value['category_component'] . "%'");
	                    if ($myGA) {
	                        $i = 1;
	                        foreach ($myGA as $k => $item) {
	                            $checked = '';
	                            if ($group_id) {
	                                $myPermission = $this->mpermission->getData("id", array("gc_id" => $item["id"], "group_id" => $group_id));
	                                $checked      = $myPermission ? 'checked="checked"' : '';
	                            }
	                            $data .= '<div class="col-lg-4">';
	                            $data .= '<span class="checkbox custom-checkbox dis_inline">';
	                            $data .= '<input type="checkbox" id="permission' . $item["id"] . '" name="permission[]" ' . $checked . ' value="' . $item["id"] . '" />  ';
	                            $data .= '<label for="permission' . $item["id"] . '">&nbsp;&nbsp;' . $item["gc_name"] . ' <code>' . $item["gc_value"] . '</code> &nbsp;&nbsp;</label> ';
	                            $data .= '</span>';
	                            $data .= '</div>';
	                            $i++;
	                        }
	                    }
	                }
	            }
	        }
	        return $data;
	    }
	}
?>