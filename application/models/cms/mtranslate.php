<?php
	/**
	* 
	*/
	class mtranslate extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mtranslate_lang");			
		}
		protected $table = "tkwp_translate";
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
	   
	   /**begin danh sach trang thai bai viet*/
	    public function listTypeName($item="")
	    {
	    	# code...
	    	$arr = array(
	    		1=>array(
	    			'name'=>'Admin',
	    			'bg'=>'#ffd66a',
	    			'color'=>'#fff'
	    			),
	    		2=>array(
	    			'name'=>'Site',
	    			'bg'=>'#00b1e1',
	    			'color'=>'#fff'
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
		public function dropdownlistType($active='')
		{
			# code...
			$html = '';
			$data = $this->listTypeName();
			if($data){				
				$html .= '<option value="all">Select a item...</option>';
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

		// tao config dich thuat cho toan wwebsite
		//@ $translate_type default 1 = backend
		public function defined($translate_type=1)
		{			
			$lang = my_lib::lang();
			$data = $this->getQuery($object="id,translate_code",$join="","translate_type=".$translate_type,$orderby="",$limit="");
			if($data)
			{
				foreach ($data as $key => $value) {
					# code...
					$tmp = $this->mtranslate_lang->getData(array("translate_name"),array("translate_lang"=>$lang,"translate_id"=>$value["id"]));
					if(!defined($value["translate_code"]))
					{
						define($value['translate_code'],$tmp['translate_name']);
					}
				}
			}
		}
	}
?>