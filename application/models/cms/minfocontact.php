<?php
	/**
	* 
	*/
	class minfocontact extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_infocontact";
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
	    public function listNhanXung($item="")
	    {
	    	# code...
	    	$arr = array(
	    		0=>array('name'=>"Cập nhật sau"),
	    		1=>array('name'=>"Mr"),
	    		2=>array('name'=>"Mrs"),
	    		3=>array('name'=>"Ms"),
	    		4=>array('name'=>"Other"),
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
	    /**end danh sach trang thai bai viet*/

	    /**begin drop down type*/
		public function dropdownlistNhanXung($active='')
		{
			# code...
			$html = '';
			$data = $this->listNhanXung();			
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

		/**begin truy vao thong so ID company lay ra thong ID của thong tin KH da lien
		@company_id
		*/
	    public function getIDAnd($company_id)
	    {
	        # code...
	        $id = '';	       
	        if($company_id)
	        {            
	            $tmpList = $this->getDataList(array("id"),array("company_id"=>$company_id));
	            if($tmpList)
	            {
	               $tmpListC2 = $this->getDataList(array("id"),array("company_id"=>$company_id));
                    if($tmpListC2)
                    {
                        foreach ($tmpListC2 as $keyC2 => $valueC2) {
                            # code...
                            $id .= $valueC2['id'].',';
                        }
                    }    	                                     
	                $id = rtrim($id,",");                
	            }

	        }
	        return $id;
	    }


	    /**begin drop cho phan lam viec cua khach hang*/
		public function dropdownlistInfo($company_id,$active='')
		{
			# code...
			$html = '';
			if($company_id){			
				$data = $this->getQuery("id,contact_name",$join="","company_id = ".$company_id,"id desc","");
				if($data){
					$html .= '<option value="0">-- Chọn người liên hệ --</option>';
					foreach ($data as $key => $value) {
						# code...
						$selected = $active==$value['id'] ? 'selected':'';
						$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["contact_name"].'</option>';							
					}
				}else{
					$html .= '<option value="0">Data empty</option>';
				}
			}
			return $html;
		}
		/**end drop cho phan lam viec cua khach hang*/
	}
?>