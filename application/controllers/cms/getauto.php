<?php
		/**
	* name: tinhnguyenvan
	* email: tinhnguyenvan91@gmail.com
	* phone: 0909 977 920
	* @__construct => khoi tao doi tuong
	* @ index() => mac dinh
	*/
	set_time_limit(0);
	class getauto extends MY_Controller
	{
		private $items = array();
		function __construct()
		{
			# code...
			parent::__construct();
			$this->load->Model("cms/mgetauto");			
			$this->load->Model("cms/mgetauto_site");			
			$this->load->Model("cms/mnews");			
			$this->load->Model("cms/mmenu");
		}
		public function index()
		{
			# code...			
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data["title"]  = 'Danh sách ';			
			$and = '';
			$this->_data['orderby']=$orderby = 'id desc';
			$this->_data['list'] = $this->mgetauto->getQuery($object="",$join="",$and,$orderby,$limit="");		
			$this->my_layout->view("cms/getauto/index",$this->_data);
		}
		public function add()
		{
			# code...
			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');							
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Thêm mới lấy tin';
			$this->_data['formData']	= array(
				"category_id"=>"",																
				"name"=>"",																
				"host"=>"",																
				"url"=>"",																
				"extra"=>"",																
				"pattern_bound"=>"",																
				"image_dir"=>"",																
				"image_pattern"=>"",																
				"tag"=>"",																
				"user"=>$s_info['s_user_id']							
			);			

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"category_id"=>isset($_POST['category_id']) && $_POST['category_id'] ? $_POST['category_id']:'',														
					"name"=>isset($_POST['name']) && $_POST['name'] ? $_POST['name']:'',														
					"host"=>isset($_POST['host']) && $_POST['host'] ? $_POST['host']:'',														
					"url"=>isset($_POST['url']) && $_POST['url'] ? $_POST['url']:'',														
					"extra"=>isset($_POST['extra']) && $_POST['extra'] ? $_POST['extra']:'',														
					"pattern_bound"=>isset($_POST['pattern_bound']) && $_POST['pattern_bound'] ? $_POST['pattern_bound']:'',														
					"image_pattern"=>isset($_POST['image_pattern']) && $_POST['image_pattern'] ? $_POST['image_pattern']:'',														
					"image_dir"=>isset($_POST['image_dir']) && $_POST['image_dir'] ? $_POST['image_dir']:'',														
					"tag"=>isset($_POST['tag']) && $_POST['tag'] ? $_POST['tag']:'',														
					'createdate_get'=>date("Y-m-d H:i:s"),
					'createdate'=>date("Y-m-d H:i:s"),
					'updatedate'=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['name']){
					$insert = $this->mgetauto->add($this->_data['formData']);
					if(is_numeric($insert)>0){
						$field = isset($_POST['field']) && $_POST['field'] ? $_POST['field']:'';
		                if($field){
		                    foreach ($field as $key => $value) {
		                        $this->_data["set_value_site"] = array(
		                            "site_id"=>$insert,
		                            "field_name"=>$key,
		                            "extra"=>$value["extra"],
		                            'element_delete'=>$value['element_delete'],
		                        );
		                        $this->mgetauto_site->add($this->_data["set_value_site"]);
		                    }
		                }

						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."getauto/");
							// header("location:".my_lib::cms_site()."getauto/edit/".$insert."/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên";
				}
			}

			/**begin com parent*/
			$this->_data['parent'] = $this->mmenu->dropdownlist($this->_data['formData']['category_id']);			
			/**end com parent*/

			$this->my_layout->view("cms/getauto/add",$this->_data);
		}

		public function edit($id)
		{
			# code...

			$myGetauto = '';
			if(is_numeric($id)){
				$myGetauto = $this->mgetauto->getData(array("id"=>$id));
				$myGetautoSite = $this->mgetauto_site->getQuery("","","site_id=".$id,"site_id","");
				$site = '';
				if($myGetautoSite)
				{
				    foreach ($myGetautoSite as $key => $value) 
				    {		

			            $site[$value["field_name"]] = array(			            
			                "extra"=>$value["extra"],
			                "element_delete"=>$value["element_delete"]
			            );				        
				    }
				}				
				if($myGetauto['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}

			$this->_data = array();
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');				
			$this->_data['error'] = "";
			$this->_data['success'] = "";
			$this->_data["title"]  = 'Cập nhật lấy tin';
			$this->_data['formData']	= array(
				"category_id"=>isset($myGetauto['category_id']) ? $myGetauto['category_id']:'',								
				"name"=>isset($myGetauto['name']) ? $myGetauto['name']:'',								
				"url"=>isset($myGetauto['url']) ? $myGetauto['url']:'',								
				"host"=>isset($myGetauto['host']) ? $myGetauto['host']:'',																		
				"extra"=>isset($myGetauto['extra']) ? $myGetauto['extra']:'',																		
				"pattern_bound"=>isset($myGetauto['pattern_bound']) ? $myGetauto['pattern_bound']:'',																		
				"image_pattern"=>isset($myGetauto['image_pattern']) ? $myGetauto['image_pattern']:'',																		
				"image_dir"=>isset($myGetauto['image_dir']) ? $myGetauto['image_dir']:'',																		
				"tag"=>isset($myGetauto['tag']) ? $myGetauto['tag']:'',																		
				"news_name_extra"=>isset($site["news_name"]['extra']) ? $site["news_name"]['extra']:'',																		
				"news_name_delete"=>isset($site["news_name"]['element_delete']) ? $site["news_name"]['element_delete']:'',				
				"news_detail_extra"=>isset($site["news_detail"]['extra']) ? $site["news_detail"]['extra']:'',																		
				"news_detail_delete"=>isset($site["news_detail"]['element_delete']) ? $site["news_detail"]['element_delete']:'',				
				"user"=>$s_info['s_user_id']						
			);				

			if(isset($_POST['fsubmit'])){
				$this->_data['formData']	= array(
					"category_id"=>isset($_POST['category_id']) && $_POST['category_id'] ? $_POST['category_id']:'',														
					"name"=>isset($_POST['name']) && $_POST['name'] ? $_POST['name']:'',														
					"host"=>isset($_POST['host']) && $_POST['host'] ? $_POST['host']:'',														
					"url"=>isset($_POST['url']) && $_POST['url'] ? $_POST['url']:'',														
					"extra"=>isset($_POST['extra']) && $_POST['extra'] ? $_POST['extra']:'',														
					"pattern_bound"=>isset($_POST['pattern_bound']) && $_POST['pattern_bound'] ? $_POST['pattern_bound']:'',														
					"image_pattern"=>isset($_POST['image_pattern']) && $_POST['image_pattern'] ? $_POST['image_pattern']:'',														
					"image_dir"=>isset($_POST['image_dir']) && $_POST['image_dir'] ? $_POST['image_dir']:'',														
					"tag"=>isset($_POST['tag']) && $_POST['tag'] ? $_POST['tag']:'',														
					'createdate_get'=>date("Y-m-d H:i:s"),
					'createdate'=>date("Y-m-d H:i:s"),
					'updatedate'=>date("Y-m-d H:i:s"),
					"user"=>$s_info['s_user_id']
				);	
				if($this->_data['formData']['host']){					
					if($this->mgetauto->edit($id,$this->_data['formData'])){
						$field = isset($_POST['field']) && $_POST['field'] ? $_POST['field']:'';
		                if($field){
		                	$this->mgetauto_site->deleteSiteId($id);
		                    foreach ($field as $key => $value) {
		                        $this->_data["set_value_site"] = array(
		                            "site_id"=>$id,
		                            "field_name"=>$key,
		                            "extra"=>$value["extra"],
		                            'element_delete'=>$value['element_delete'],
		                        );
		                        $this->mgetauto_site->add($this->_data["set_value_site"]);
		                    }
		                }

						$this->_data['success'][] = "Add success";
						$this->_data['formData'] = NULL;
						/**begin chuyen trang*/
						if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
							header("location:".base64_decode($_REQUEST['redirect']));
						}else{
							header("location:".my_lib::cms_site()."getauto/");
						}
						/**end chuyen trang*/
					}else{
						$this->_data['error'][] = "Add Not Success";
					}
				}else{
					$this->_data['error'][] = "Bạn chưa nhập tên";
				}
			}
			
			/**begin com parent*/
			$this->_data['parent'] = $this->mmenu->dropdownlist($this->_data['formData']['category_id']);			
			/**end com parent*/
			$this->my_layout->view("cms/getauto/edit",$this->_data);
		}
		/**end them moi menu*/

		/**begin delete */
		public function delete($id)
		{			
			# code...
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$myGetauto = '';
			$this->_data['title'] = "Delete";
			if(is_numeric($id)){
				$myGetauto = $this->mgetauto->getData(array("id"=>$id));
				if($myGetauto['id']<=0){
					header("location:".my_lib::cms_site().'error/notfound');
					exit();
				}else{					
					$this->mgetauto->delete($id);
					$this->mgetauto_site->deleteSiteId($id);
					/**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."getauto/");
					}
					/**end chuyen trang*/									
				}
			}else{
				header("location:".my_lib::cms_site().'error/notfound');
				exit();
			}		
			$this->my_layout->view("cms/getauto/delete",$this->_data);
		}
		/**end delete */

		/**begin lay tin*/		
		public function get($id){
			$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['title'] = 'Lấy tin tự động';
	        if(isset($id) && is_numeric($id)){
	            /**begin cap nhat ngay lay tin*/
	            $this->_data["value_get_date"] = array("createdate_get"=>date("Y-m-d H:i:s"));
	            $this->mgetauto->edit($id,$this->_data["value_get_date"]);
	            /**end cap nhat ngay lay tin*/

	            $id = $id;
	            $get_site = $this->mgetauto->getData(array("id"=>$id));
	            $get_site_struc = $this->mgetauto_site->getQuery("","","site_id=".$id,$orderby="",$limit="");	            
	            if($get_site["url"]){
	                $html = $this->html_no_comment($get_site["url"]);
	                if($html){
	                    $hd = $get_site["begin"];
	                    $ft = $get_site['end'];
	                    if(!$hd or !($bg = strpos($html,$hd))) $bg = 0;
	                    if(!$ft or !($end = strpos($html,$ft))) $end = strlen($html);

	                    $html = substr($html,$bg+strlen($hd),$end-$bg-strlen($hd));

	                    $html = $this->dom_parser->str_get_html($html);

	                    $host = $get_site['host'];
	                    $pattern_bound = $get_site['pattern_bound'];
	                    $pattern_link = $get_site['extra'];
	                    $pattern_img = $get_site['image_pattern'];


	                    $folder=$get_site['image_dir']; // Thư mục chứa ảnh thumbnail
	                    $folder_nothumb = 'media/upload/file/news'; // thu muc chua anh goc	                    
	                    if(!is_dir($folder)) @mkdir($folder,0755,true);
	                    $num=0;
	                    $maxitem=1000;
	                    $picture_alias = $this->mmenu->getData(array("id"=>$get_site['category_id']));

	                    foreach($html->find($pattern_bound) as $item)
	                    {
	                        if($num>=$maxitem) break;
	                        $num++;
	                        foreach($item->find($pattern_link) as $link){
	                            $link = $this->check_link($link->getAttribute('href'),$host);
	                        }	                    		                        
	                        if($this->check_url($link)){
	                        
	                            $this->items = $item->find($pattern_img);	                            
	                            if($this->items and count($this->items)){
	                                foreach($this->items as $img){
	                                    $image_url=$img->src;
	                                }
	                                $source = $this->check_link($image_url,$get_site['host']);
	                                
	                                $basename = $picture_alias["menu_alias"]."-".date("d-m-Y-h-i-s",time()).".jpg";
	                                
	                                // Thư mục chứa ảnh
	                                if(file_exists($folder.'/'.$basename))
	                                {
	                                    $dest = $folder.'/phu-nu-viet-nam-'.$basename;
	                                    $dest_nothumb = $folder_nothumb.'/phu-nu-viet-nam-'.$basename;
	                                    $basename = 'phu-nu-viet-nam-'.$basename;
	                                }else{
	                                    $dest = $folder.'/'.$basename;
	                                    $dest_nothumb = $folder_nothumb.'/'.$basename;
	                                }
	                                $this->save($source,$dest);
	                                $this->save($source,$dest_nothumb);
	                                $get_site['picture'] = $basename;
	                            }else{
	                                $get_site['picture'] = '';
	                            }
	                            
	                            $this->parse_row($link,$get_site_struc,$get_site,$host);
	                        }	                        
	                    }
	                }
	                $html->clear();
	                unset($html);
	                /**begin chuyen trang*/
					if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
						header("location:".base64_decode($_REQUEST['redirect']));
					}else{
						header("location:".my_lib::cms_site()."getauto/");						
					}
					/**end chuyen trang*/
	            }
	            echo 'Lấy tin thành công';
	        }
	        $this->my_layout->view("cms/getauto/get",$data);
	    }
	    /**end content*/

	    /**begin lay 1 tin*/
	    function parse_row($link,$pattern,$site,$host)
	    {
	        $s_info = $this->session->userdata('userInfo');
	        $html=$this->html_no_comment($link);
	        if($html){
	            $html = $this->dom_parser->str_get_html($html);
	            $item = array();
	            $check = false;
	            /**begin check images*/
	            $allowedExts = array("gif", "jpeg", "jpg", "png");
	            $temp = explode(".", $site['picture']);
	            $extension = end($temp);

	            if(in_array($extension, $allowedExts) && isset($site['picture']) && $site['picture'] ){
	                $picture_im =$site['picture'];
	            }else{
	                $picture_im = "";
	            }
	            /**end check images*/	            
	            if($pattern)
	            {
	                foreach($pattern as $key=>$value)
	                {
	                    $element_delete = $value['element_delete'];
	                    if($detail_pattern = $value['extra']){
	                        foreach($html->find($detail_pattern) as $element)
	                        {
	                            if($element_delete){
	                                $arr = explode(',',$element_delete);
	                                for($i=0;$i<count($arr);$i++){
	                                    foreach($element->find($arr[$i]) as $e){
	                                        $e->outertext='';
	                                    }
	                                }
	                            }
	                            if($value['field_name']=='news_name' or $value['field_name']=='brief'){
	                                $item[$value['field_name']] = trim($element->plaintext);
	                            }else{
	                                $item[$value['field_name']] = $element->innertext;
	                            }
	                            break;
	                        }
	                    }
	                }	 

	                if(isset($item['news_name']))
	                {
	                    // Viết lại đường dẫn ảnh trong nội dung
	                    if(isset($item['news_detail']) and $item['news_detail']){
	                        /**begin down load hinh anh trong bai viet*/
	                        $content_root = $item["news_detail"];
	                        $content = $this->dom_parser->str_get_html($item['news_detail']);
	                        $picture_alias= mb_strtolower(url_title(my_lib::convert_alias($item['news_name'])));
	                        /**begin format link href*/
	                        foreach($content->find('a') as $img){
	                            $link_item=$img->href;
	                            $content_root = str_replace($link_item," ",$content_root);
	                        }
	                        /**end format link href*/
	                        foreach($content->find('img') as $img){
	                            $image_url=$host.str_replace($host,"",$img->src);
	                            $folder = "media/upload/file/".date("Y",time())."/".date("m",time())."/".date("d",time());
	                            if(!is_dir($folder)) @mkdir($folder,0755,true);
	                            $basename = $picture_alias."-".date("d-m-Y-h-i-s",time()).'.jpg';
	                            /**kiem tra anh co tron tai chua*/
	                            if(file_exists($folder.'/'.$basename)){
	                                $dest = $folder.'/pnvn-'.$basename;
	                                $basename = 'pnvn-'.$basename;
	                            }else{
	                                $dest = $folder.'/'.$basename;
	                            }
	                            /**luu hinh*/
	                            if(file_get_contents($image_url)){
	                                file_put_contents($dest,file_get_contents($image_url));
	                            }
	                            /**thay doi duong dan hinh anh*/
	                            $content_root =  str_replace($image_url,my_lib::base_url().$dest,$content_root);
	                        }
	                        $item['news_detail']=$content_root;
	                        /**end down load hinh anh trong bai viet*/
	                    }
	                    /**begin nguon*/
	                    $news_source = $site["host"];
	                    $news_source = str_replace("http://", "", $news_source);
	                    $news_source = str_replace("/", "", $news_source);
	                    /**end nguon*/
	                    $news_name=$item['news_name'];
	                    $news_parent=$site['category_id'];
	                    $news_create_date=date("Y-m-d H:i:s");
	                    $user=$s_info["s_user_id"];
	                    $news_search=my_lib::convert($item['news_name']);
	                    $news_alias= mb_strtolower(url_title(my_lib::convert_alias($item['news_name'])));
	                    $news_detail = $item['news_detail'];
	                    $news_summary = my_lib::substring(strip_tags($item['news_detail']),300);
	                    /**begin check images*/
	                    $news_picture = $picture_im;
	                    /**end check images*/

	                    $check_article = $this->mnews->getData(array("news_alias"=>$news_alias));
	                    if($check_article==NULL || $check_article==""){
	                        if($news_name  && $news_picture){
	                            /**begin them moi vao co so du lieu*/
	                            $data["set_value"] = array(
	                            	"news_name"=>$news_name,
	                                "news_alias"=>$news_alias,
	                                "news_type"=>3,
	                                "news_parent"=>$news_parent,
	                                "news_search"=>$news_search,
	                                "news_summary"=>$news_summary,
	                                "news_detail"=>$news_detail,
	                                "news_begin_date"=>$news_create_date,
	                                "news_status"=>1,
	                                "news_picture"=>'/media/upload/file/news/'.$news_picture,
	                                "news_create_date"=>$news_create_date,
	                                "news_source"=>trim($news_source),
	                                "news_lang"=>"vn",
	                                "user"=>$user
	                            );
	                            $insert = $this->mnews->add($data["set_value"]);
	                            if($insert){	                               
	                                /**begin lay tags*/
	                                $box_tags = $site["tag"];
	                                $news_seo_keyword = '';
	                                if($box_tags){
	                                    foreach($html->find($box_tags) as $value){
	                                        if($value->plaintext){
	                                        	$news_seo_keyword .= $value->plaintext.',';
	                                        }
	                                    }
	                                    $data["set_value_tag"]["news_seo_keyword"] = rtrim($news_seo_keyword,",");
                                        $this->mnews->edit($insert,$data["set_value_tag"]);
	                                }
	                                /**end lay tags*/
	                            }
	                            /**end them moi vao co so du lieu*/	                            
	                        }
	                    }

	                }
	            }
	            $html->clear();
	            unset($html);
	        }
	    }
	    /**end lay 1 tin*/

	    /**begin formet link*/
	    function format_link($source,$format=false)
	    {
	        if($format)
	        {
	            $source = str_replace(' ','%20',$source);
	        }
	        else
	        {
	            if(strrpos($source,'?')===true)
	            {
	                $source = substr($source,0,strrpos($source,'?'));
	            }
	            $source = str_replace(' ','',$source);
	        }
	        return $source;
	    }
	    function save($sour,$dest)
	    {
	        $sour = $this->format_link($sour,true);
	        if(!file_put_contents($dest, file_get_contents($sour))){
	            $dest = '';
	        }
	    }

	    function check_link($url,$host='')
	    {
	        if((strpos($url,'http://')===false) and (preg_match_all('/http:\/\/(.*)\.([a-z]+)\//',$host,$matches,PREG_SET_ORDER)))
	        {
	            while ($url{0}=='/'){
	                $url=substr($url,1);
	            }
	            if($matches[0][0]{strlen($matches[0][0])-1}!='/'){
	                $matches[0][0]=$matches[0][0].'/';
	            }
	            $url = $matches[0][0].$url;
	        }
	        return $url;
	    }
	    public function check_url($url=NULL){	    	
	        if($url == NULL) return false;
	        $ch = curl_init($url);
	        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        $data = curl_exec($ch);	        
	        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);//lay code tra ve cua http
	        curl_close($ch);
	        return ($httpcode>=200 && $httpcode<300);
	    }
	    function _isCurl(){
	        return function_exists('curl_version');
	    }
	    function _urlencode($url){
	        $output="";
	        for($i = 0; $i < strlen($url); $i++)
	            $output .= strpos("/:@&%=?.#", $url[$i]) === false ? urlencode($url[$i]) : $url[$i];
	        return $output;
	    }
	    function file_get_contents_curl($url) {
	        //$url=urlencode($url);
	        //debug($url);
	        $ch = curl_init();

	        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	        curl_setopt($ch, CURLOPT_HEADER, 0);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_URL, $url);
	        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

	        $data = curl_exec($ch);
	        curl_close($ch);

	        return $data;
	    }
	    function html_no_comment($url) {
	        // create HTML DOM
	        $check_curl=$this->_isCurl();
	        if(!$html=$this->dom_parser->file_get_html($url)){
	            if(!$html=str_get_html($this->file_get_contents_curl($url)) or !$check_curl){
	                return false;
	            }
	        }
	        // remove all comment elements
	        foreach($html->find('comment') as $e)

	            $e->outertext = '';

	        $ret = $html->save();

	        // clean up memory
	        $html->clear();
	        unset($html);
	        return $ret;
	    }
	    function debug($arr){
	        echo '<pre>';
	        print_r($arr);
	        echo '</pre>';
	        exit();
	    }
			
	}
?>