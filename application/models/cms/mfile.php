<?php
	/**
	* 
	*/
	class mfile extends CI_Model
	{
		public $path            = 'media/file';
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_file";
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

	    public function listStatus($item="")
	    {
	    	# code...
	    	$arr = array(
	    		1=>array('name'=>"Hiển thị",'color'=>"success"),
	    		2=>array('name'=>"Ẩn",'color'=>"default"),
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }

	    public function dropdownlistStatus($active="")
	    {
			# code...
			$html = '';
			$data = $this->listStatus();			
			if($data){
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

		public function upload($path, $name, $watermark = true)
	    {
	        if (!is_dir($path)) {
	            mkdir($path, 0777, true);
	            chmod($path, 0777);
	        }
	        $tmpName = pathinfo($_FILES[$name]['name']);
	        $config = array('upload_path' => $path,
	            'allowed_types'               => 'gif|jpg|png|pdf|doc|docx|xls|xlsx|jpeg|txt',
	            'file_name'                   => mb_strtolower(url_title($tmpName['filename'], '-', true)),
	            'max_size'                    => '50000');
	        $this->load->library("upload", $config);
	        if (!$this->upload->do_upload($name)) {
	            $error = array($this->upload->display_errors());
	            return $error;
	        } else {
	            $image_data = $this->upload->data();
	            $this->load->library("image_lib");
	            // /*resize*/
	            $config['image_library']  = 'gd2';
	            $config['source_image']   = $path . '/' . $image_data['file_name'];
	            $config['create_thumb']   = false;
	            $config['maintain_ratio'] = true;

	            $config['width']  = '800';

	            $this->image_lib->initialize($config);
	            $this->image_lib->resize(); // resize
	            $this->image_lib->clear();
	            unset($config);
	            return $image_data;
	        }
	    }

	    public function getUploadPath()
	    {
	        return FCPATH . $this->path.'/';
	    }

	    /**begin drop down */
		// public function dropdownlist($active='')
		// {
		// 	# code...
		// 	$html = '';
		// 	$data = $this->getQuery("id,bank_name",$join="","","id","");
		// 	if($data){
		// 		$html .= '<option value="0">-- Chọn ngân hàng --</option>';
		// 		foreach ($data as $key => $value) {
		// 			# code...
		// 			$selected = $active==$value['id'] ? 'selected':'';
		// 			$html .= '<option '.$selected.' value="'.$value["id"].'">'.$value["bank_name"].'</option>';						
		// 		}
		// 	}else{
		// 		$html .= '<option value="0">Data empty</option>';
		// 	}
		// 	return $html;
		// }
		/**end drop down */
	   
	}
?>