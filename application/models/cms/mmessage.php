<?php
	/**
	* 
	*/
	class mmessage extends CI_Model
	{
		public $path            = 'media/message';
		public function __construct()
		{
			# code...
			parent::__construct();
		}
		protected $table = "tkwp_message";
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

	    /**begin thong bao*/
		public function showMessage()
		{					
			$object_messa="id,ms_title,ms_file,ms_create_date,ms_end_date";
			$join_messa="";	
				$and_messa="ms_status = 1";				
			$orderby_messa=" ms_create_date desc";
			$limit_messa="0,10";
			$listShowMessage = $this->getQuery($object_messa,$join_messa,$and_messa,$orderby_messa,$limit_messa);
			return $listShowMessage;		
		}
		/**end thong bao*/
		public function getUploadPath()
	    {
	        return FCPATH . $this->path.'/';
	    }


	    public function sendMessage($note,$link,$img)
		{
			$content = array(
			"en" => $note,
			"vn" => $note
			);
			$heading = array(
			"en" => 'CRM Office TSMedia',
			"vn" => 'CRM Office TSMedia'
			);
		
			$fields = array(
				'app_id' => "141222d1-61b5-4bd5-89fc-8b24d54be640",
				'headings' => $heading,
				'included_segments' => array('All'),
	      		'url' => $link,
	      		//'chrome_big_picture' => $img,
				'contents' => $content
			);
			
			$fields = json_encode($fields);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
													   'Authorization: Basic ZGVlNWIwYTItYjA3YS00YmE4LTlmMzktODE3MmRiOTgwNGI2'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			$response = curl_exec($ch);
			curl_close($ch);
			
			return $response;
		}
	   
	}
?>