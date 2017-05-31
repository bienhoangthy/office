<?php
	/**
	* 
	*/
	class minfoservice extends CI_Model
	{
		public $path            = 'media/customer';
    	public $path_url        = '/media/customer/';
		public function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mservice");
		}
		protected $table = "tkwp_infoservice";
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

	    //Targets
	    public function getTarget($year)
	    {
	    	$sql = 'select sum(service_pay_real) as totalTargets from '.$this->table.' where service_status <> 3 and year(service_start) = '.$year;
	    	$query = $this->db->query($sql);
	        return $query->result_array();
	    }
	    public function getTargetUser($year,$id_user)
	    {
	    	$sql = 'select sum(service_pay_real) as totalTargets,sum(service_pay_sign) as totalSign from '.$this->table.' where service_status <> 3 and user = '.$id_user.' and year(service_start) = '.$year;
	    	$query = $this->db->query($sql);
	        return $query->result_array();
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

	    //Thời hạn
	    public function listDuration($item="")
	    {
	    	$arr = array(
	    		1=>array('name'=>"Còn hạn",'color'=>"teal"),
	    		2=>array('name'=>"Gần hết hạn",'color'=>"warning"),
	    		3=>array('name'=>"Hết hạn",'color'=>"inverse")
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }

	    public function dropdownlistDuration($active='')
		{
			$html = '';
			$data = $this->listDuration();			
			if($data){				
				$html .= '<option value="">-- Thời hạn --</option>';
				foreach ($data as $key => $value) {
					$selected = $active==$key ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$key.'">- '.$value["name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}

		//End thời hạn

	    /**begin danh sach trang thai bai viet*/
	    public function listStatus($item="")
	    {
	    	# code...
	    	$arr = array(
	    		1=>array('name'=>"Thu phí 100%",'color'=>"success"),
	    		2=>array('name'=>"Triển khai hợp đồng",'color'=>"primary"),
	    		3=>array('name'=>"Chờ HĐ 2 chiều",'color'=>"danger"),
	    		4=>array('name'=>"Nợ quá hạn",'color'=>"warning"),
	    		5=>array('name'=>"Hợp đồng hủy",'color'=>"default")
	    		);
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
	    /**end danh sach trang thai bai viet*/

	    /**begin drop down type*/
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
		/**end drop down type*/
		public function dropdownlistType($active='')
		{
			# code...
			$html = '';
			$and = 'service_level = 1';
			$orderby = 'id asc';
			$data = $this->mservice->getQuery($object="",$join="",$and,$orderby,$limit="");			
			if($data){				
				$html .= '<option value="all">-- Chọn loại dịch vụ --</option>';
				foreach ($data as $key => $value) {
					# code...
					$selected = $active==$value["id"] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">- '.$value["service_name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
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

		//DropdownYear
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

		public function sumPrice($user,$year)
		{
			$object_infoservice = "service_price";
			$and_infoservice = " user = ".$user;
			$and_infoservice .= ' and YEAR(service_start) ='.$year;
			$orderby = "id asc";
			$listPrice = $this->getQuery($object_infoservice,$join="",$and_infoservice,$orderby,$limit="");
			$sum = 0;
			if (!empty($listPrice)) {
				foreach ($listPrice as $key => $value) {
					$sum +=$value['service_price'];
				}
			}
			return $sum;
		}

		public function dropdownlistPackage($active='',$parent='')
		{
			# code...
			$html = '';
			$and = 'service_level = 2 and service_parent = '.$parent;
			$orderby = 'service_orderby asc, id asc';
			$data = $this->mservice->getQuery($object="",$join="",$and,$orderby,$limit="");			
			if($data){	
				$html = '<option value="0">- Chọn gói dịch vụ</option>';			
				foreach ($data as $key => $value) {
					# code...
					$selected = $active==$value["id"] ? 'selected':'';
					$html .= '<option '.$selected.' value="'.$value["id"].'">- '.$value["service_name"].'</option>';						
				}
			}else{
				$html .= '<option value="0">Data empty</option>';
			}
			return $html;
		}

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
	    public function trashFile($path, $name)
	    {
	        if (file_exists($path . '/' . $name)) {
	            unlink($path . '/' . $name);
	        }
	    }

	    public function getUploadPath($id)
	    {
	        return FCPATH . $this->path . '/' . $id;
	    }
	    public function getUploadPathThumbs($id)
	    {
	        return FCPATH . $this->path . '/thumbs/' . $id;
	    }
	    public function getUploadUrl()
	    {
	        return $this->path_url;
	    }

	    public function removeFileMul($name, $tour_id = '')
	    {
	        if ($tour_id) {
	            $myTour       = $this->getData('', array('id' => $tour_id));
	            $picture_more = !empty($myTour) && $myTour['tour_picture_more'] ? unserialize($myTour['tour_picture_more']) : '';
	            if (!empty($picture_more)) {
	                if (($key = array_search($name, $picture_more)) !== false) {
	                    unset($picture_more[$key]);
	                }
	                $set_picture_mote = !empty($picture_more) ? serialize($picture_more) : '';
	                $this->updateData($myTour['id'], array('tour_picture_more' => $set_picture_mote));
	                $url = dir_root . '/public/frontend/uploads/files/tour/';
	                if (file_exists($url . $name)) {
	                    unlink($url . $name);
	                }
	            }
	        }
	    }

	}
?>