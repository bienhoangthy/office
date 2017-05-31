<?php
	/**
	* 
	*/
	class mlanguage extends CI_Model
	{
		
		public function __construct()
		{
			# code...
			parent::__construct();
		}
			  
	   /**begin danh sach trang thai bai viet*/
	    public function listTypeName($item="")
	    {
	    	# code...
	    	$arr = array(
	    		1=>array(
	    			'language_name'=>'Tiếng Việt',
	    			'lang'=>'vn',	    			
	    			'language_alias'=>'tieng-viet',	    			
	    			),
	    		2=>array(
	    			'language_name'=>'English',
	    			'lang'=>'en',	    			
	    			'language_alias'=>'english',	    			
	    			)
    			);	
	    	if(is_numeric($item)){
	    		return $arr[$item];
	    	}else{
	    		return $arr;
	    	}
	    }
	    /**end danh sach trang thai bai viet*/	   
	}
?>