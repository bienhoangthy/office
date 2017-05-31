<?php
	
	class account extends MY_Controller
	{
		
		function __construct()
		{
			#$id = 38 => la chi, $id = 39 => thu tien
			parent::__construct();	
			$this->load->Model("cms/maccount");				
			$this->load->Model("cms/maccount_name");				
			$this->load->Model("cms/maccount_type");			
			$this->load->Model("cms/maccount_name_history");			
		}
		public function index()
		{
			$this->muser->checkPermission('account', 'index');
			$this->_data["year"]  = isset($_REQUEST["year"]) && $_REQUEST["year"] ? $_REQUEST["year"] : date("Y");
			$this->_data["title"]  = 'Quản lý thu chi '.$this->_data["year"];	

			/**begin chart nam */
			$this->_data['account_thu']  = '';
	        $this->_data['account_chi']  = '';        
	        $this->_data['account_loinhuan']  = '';        
            $account_loinhuan = $account_thu = $account_chi = "";
            for ($i=1; $i <= 12; $i++) {        
                $and_acount_chi = array('type_id'=>38,'a_date >='=> $this->_data["year"].'-'.$i.'-1','a_date <='=>$this->_data["year"].'-'.$i.'-31');                
                $and_acount_thu = array('type_id'=>39,'a_date >='=> $this->_data["year"].'-'.$i.'-1','a_date <='=>$this->_data["year"].'-'.$i.'-31');                
               
                $myThu = $this->maccount->getData("sum(a_money) as money",$and_acount_thu);
                $myChi = $this->maccount->getData("sum(a_money) as money",$and_acount_chi);
                $tienchi = isset($myChi["money"]) && $myChi["money"] > 0 ? $myChi["money"]:0;
                $tienthu = isset($myThu["money"]) && $myThu["money"] > 0 ? $myThu["money"]:0;
                $account_chi .= $tienchi.',';    
                $account_thu .= $tienthu.',';  
                $account_loinhuan .= $tienthu - $tienchi.',';          
            }                        
            $this->_data['account_thu'] = rtrim($account_thu,",");
            $this->_data['account_loinhuan'] = rtrim($account_loinhuan,",");
            $this->_data['account_chi'] = rtrim($account_chi,",");                                      
			/**end chart nam */	

			/**begin chart theo quy */				
			$account_loinhuan_quy = $account_thu_quy = $account_chi_quy = "";		
			$begin = array(1,4,7,10);						
			$end = array(3,6,9,12);		
			for($h=0;$h<4;$h++) {
	            $date_begin_quy = $this->_data["year"].'-'.$begin[$h].'-1';
	            $date_end_quy = $this->_data["year"].'-'.$end[$h].'-31';	            	            
                $and_acount_chi = array('type_id'=>38,'a_date >='=> $date_begin_quy,'a_date <='=>$date_end_quy);                
                $and_acount_thu = array('type_id'=>39,'a_date >='=> $date_begin_quy,'a_date <='=>$date_end_quy);                                
               
                $myThu = $this->maccount->getData("sum(a_money) as money",$and_acount_thu);
                $myChi = $this->maccount->getData("sum(a_money) as money",$and_acount_chi);
                $tienchi_quy = isset($myChi["money"]) && $myChi["money"] > 0 ? $myChi["money"]:0;
                $tienthu_quy = isset($myThu["money"]) && $myThu["money"] > 0 ? $myThu["money"]:0;
                $account_chi_quy .= $tienchi_quy.',';    
                $account_thu_quy .= $tienthu_quy.',';  
                $account_loinhuan_quy .= $tienthu_quy - $tienchi_quy.',';         	                 
	        }   
	        $this->_data['account_thu_quy'] = rtrim($account_thu_quy,",");
            $this->_data['account_loinhuan_quy'] = rtrim($account_loinhuan_quy,",");
            $this->_data['account_chi_quy'] = rtrim($account_chi_quy,",");    	                                 	        
			/**end chart theo quy */

			/**begin chart theo thang */				
			for($h=0;$h<12;$h++) {		
	            $date_begin_thang = $this->_data["year"].'-'.($h+1).'-1';
	            $date_end_thang = $this->_data["year"].'-'.($h+1).'-31';	            	            
                $and_acount_chiT = array('type_id'=>38,'a_date >='=> $date_begin_thang,'a_date <='=>$date_end_thang);                
                $and_acount_thuT = array('type_id'=>39,'a_date >='=> $date_begin_thang,'a_date <='=>$date_end_thang);                                
               
                $myChiT = $this->maccount->getData("sum(a_money) as money",$and_acount_chiT);
                $myThuT = $this->maccount->getData("sum(a_money) as money",$and_acount_thuT);
                $tienchiT = isset($myChiT["money"]) && $myChiT["money"] > 0 ? $myChiT["money"]:0;
                $tienthuT = isset($myThuT["money"]) && $myThuT["money"] > 0 ? $myThuT["money"]:0;
                $loinhuanT = $tienthuT - $tienchiT;         	                 

	            $this->_data['account_thang'][($h+1)]["thu"]  = $tienthuT;
	            $this->_data['account_thang'][($h+1)]["chi"]  = $tienchiT;
	            $this->_data['account_thang'][($h+1)]["loinhuan"]  = $loinhuanT;
	        }    	                                 	        
			/**end chart theo thang */		

			$this->my_layout->view("cms/account/index",$this->_data);
		}	
		public function daily()
		{		
			$this->muser->checkPermission('account', 'daily');	
			$this->_data["title"]  = 'Thu chi hằng ngày';	

			//begin thu
			$object_thu='';
			$join_thu = '';
			$and_thu = 'a_date="'.date("Y-m-d").'" and type_id=39'; //  thu 
			$limit_thu = '';
			$orderby_thu = 'id desc';						
			$this->_data['listThu'] = $this->maccount->getQuery($object_thu,$join_thu,$and_thu,$orderby_thu,$limit_thu);
			//end thu
			
			//begin chi
			$object_chi='';
			$join_chi = '';
			$and_chi = 'a_date="'.date("Y-m-d").'" and type_id=38'; //  chi 
			$limit_chi = '';
			$orderby_chi = 'id desc';						
			$this->_data['listChi'] = $this->maccount->getQuery($object_chi,$join_chi,$and_chi,$orderby_chi,$limit_chi);
			//end chi

			$this->_data['listAll'] = $this->maccount->getQuery('','','a_date="'.date("Y-m-d").'"','id desc','');
			/**begin bieu do thu chi trong ngay*/
			$this->_data['chartThu'] = "";
			$this->_data['chartChi'] = "";
			$this->_data['chartName'] = "";
			if($this->_data['listAll'])
			{
				foreach ($this->_data['listAll'] as $key => $value) {
					$myAccountType = $this->maccount_type->getData(array("type_name"),array("id"=>$value["a_type_chilrd"]));

					$this->_data['chartName'] .= '"'.$myAccountType["type_name"].'",';
					if($value["type_id"]==39){
						$this->_data['chartThu'] .= $value["a_money"].',';
						$this->_data['chartChi'] .= '0,';
					}
					if($value["type_id"]==38){
						$this->_data['chartChi'] .= $value["a_money"].',';
						$this->_data['chartThu'] .= '0,';
					}
				}
				$this->_data['chartThu'] = rtrim($this->_data['chartThu'],",");
				$this->_data['chartChi'] = rtrim($this->_data['chartChi'],",");
				$this->_data['chartName'] = rtrim($this->_data['chartName'],",");
			}
			/**end bieu do thu chi trong ngay*/

			$this->_data['formData'] = array(
				"ac_id"				=>	"",
				"type_id"			=>	0,
				"a_money"			=>	"",
				"a_type_chilrd"		=>	"",
				"a_note"			=>	"",
				"a_date"			=>	date("Y-m-d"),
				"a_time"			=>	date("H:i:s"),
				"a_user"			=>	"",
				"a_create"			=>	"",
				"user_typing"		=>	$this->_data['s_info']['s_user_fullname'],
			);	

			if(isset($_POST['fsubmit']))
			{
				$this->_data['formData'] = array(
					"ac_id"				=>	$this->input->post("ac_id"),
					"type_id"			=>	$this->input->post("type_id"),
					"a_money"			=>	$this->input->post("a_money"),
					"a_type_chilrd"		=>	$this->input->post("a_type_chilrd"),
					"a_note"			=>	$this->input->post("a_note"),
					"a_date"			=>	$this->input->post("a_date"),
					"a_time"			=>	$this->input->post("a_time"),
					"a_user"			=>	$this->input->post("a_user"),
					"a_create"			=>	$this->input->post("a_create"),
					"user_typing"		=>	$this->_data['s_info']['s_user_fullname'],
					"a_create"			=> date("Y-m-d")
				);
				if($this->_data['formData']['a_money'] && 
					$this->_data['formData']['ac_id'] && 
					$this->_data['formData']['a_type_chilrd'] && 
					$this->_data['formData']['a_date'] && 
					$this->_data['formData']['user_typing'] && 
					$this->_data['formData']['type_id']){
					$this->maccount->add($this->_data['formData']);
					
					header("location:".my_lib::cms_site().'account/daily/');
				}
				else
				{
					$this->_data['error'][] = 'Vui lòng kiểm tra.';
				}
			}
			$this->_data['dropdownlistAccountName'] = $this->maccount_name->dropdownlist($this->_data['formData']['ac_id']);
			$this->_data['dropdownlistUser'] = $this->muser->dropdownlistAccount($this->_data['formData']['a_user']);
			$this->_data['dropdownlistType'] = $this->maccount_type->dropdownlist($this->_data['formData']['type_id'],0,1);
			$this->_data['dropdownlistTypeChirld'] = $this->_data['formData']['type_id'] >0 ? $this->maccount_type->dropdownlist($this->_data['formData']['a_type_chilrd'],$this->_data['formData']['type_id'],2):'';
			$this->my_layout->view("cms/account/daily",$this->_data);
		}	

		public function history()
		{
			// $this->muser->checkPermission('account', 'history');
			// $this->_data['title'] = "Lịch sử thu chi";
			// $this->_data["year"]  = isset($_REQUEST["year"]) && $_REQUEST["year"] ? $_REQUEST["year"] : date("Y");

			// //begin thu
			// $object_thu='';
			// $join_thu = '';
			// $and_thu = 'a_date >= " '.$this->_data["year"].'-1-1" and a_date <= "'.$this->_data["year"].'-12-31" and type_id=39'; //  thu 
			// $limit_thu = '';
			// $orderby_thu = 'a_date desc';						
			// $this->_data['listThu'] = $this->maccount->getQuery($object_thu,$join_thu,$and_thu,$orderby_thu,$limit_thu);
			// //end thu
			
			// //begin chi
			// $object_chi='';
			// $join_chi = '';
			// $and_chi = 'a_date >= " '.$this->_data["year"].'-1-1" and a_date <= " '.$this->_data["year"].'-12-31" and type_id=38'; //  chi			
			// $limit_chi = '';
			// $orderby_chi = 'a_date desc';						
			// $this->_data['listChi'] = $this->maccount->getQuery($object_chi,$join_chi,$and_chi,$orderby_chi,$limit_chi);
			// //end chi

			// $this->my_layout->view("cms/account/history",$this->_data);
		}

		public function revenue()
		{
			$this->muser->checkPermission('account', 'revenue');
			$this->_data['title'] = "Lịch sử thu";
			$this->_data['type'] = 1;
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
                "fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:20,
                "ftype"=>isset($_REQUEST['ftype']) && $_REQUEST['ftype'] ? $_REQUEST['ftype']:"all",
                "faccount_name"=>isset($_REQUEST['faccount_name']) && $_REQUEST['faccount_name'] ? $_REQUEST['faccount_name']:"all",
                "fuser"=>isset($_REQUEST['fuser']) && $_REQUEST['fuser'] ? $_REQUEST['fuser']:"all",
                "ftime"=>isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:"all",
				"ftypeTime"=>isset($_REQUEST['ftypeTime']) && $_REQUEST['ftypeTime'] ? $_REQUEST['ftypeTime']:0,
				"fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all"
            );
			$and = 'type_id = 39';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and a_note like "%'.$this->_data['formData']['fkeyword'].'%"';
			}	
			if($this->_data['formData']['ftype']!="all")
            {
                $and .= ' and a_type_chilrd ='.$this->_data['formData']['ftype'];
            }
            if($this->_data['formData']['faccount_name']!="all")
            {
                $and .= ' and ac_id ='.$this->_data['formData']['faccount_name'];
            }
            if($this->_data['formData']['fuser']!="all")
            {
                $and .= ' and a_user ='.$this->_data['formData']['fuser'];
            }
            $this->_data['textFilter'] = '';
            if($this->_data['formData']['fyear']!="all")
            {
                $and .= ' and YEAR(a_date) ='.$this->_data['formData']['fyear'];
                if ($this->_data['formData']['ftime']!="all") {
                	switch ($this->_data['formData']['ftypeTime']) {
                		case '1':
                			$and .= ' and WEEKOFYEAR(a_date) ='.$this->_data['formData']['ftime'];
			            	$this->_data['textFilter'] = 'Tuần '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '2':
                			$and .= ' and MONTH(a_date) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Tháng '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '3':
                			$and .= ' and QUARTER(a_date) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Quý '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;
                		default:
              				$add .= '';
              				$this->_data['textFilter'] = 'Bạn chưa chọn tuần, tháng hoặc quý của năm '.$this->_data['formData']['fyear'];
                			break;
                	}
                }
            }
            $this->_data['condition'] = $and;
			/*begin phan trang*/
            $paging['per_page']         =   $this->_data['formData']['fperpage'];
            $paging['num_links']         =   5;
            $paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
            $paging['start']      =   (($paging['page']-1)   * $paging['per_page']);            
            $query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';                   
            $paging['base_url']         =   my_lib::cms_site().'account/revenue/?'.$query_string.'&page='; 
            $this->_data['page'] = $paging['page'];      
            /*end phan trang*/
            $this->_data['orderby']=$orderby = 'id desc';
            $limit = $paging['start'].','.$paging['per_page'];
            $this->_data['list'] = $this->maccount->getQuery($object="",$join="",$and,$orderby,$limit);
            $this->_data['record'] = $this->maccount->countQuery($join="",$and);
            $this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);
            $this->_data['ftype'] = $this->maccount_type->dropdownlist($this->_data['formData']['ftype'],39);
            $this->_data['faccount_name'] = $this->maccount_name->dropdownlist($this->_data['formData']['faccount_name']);
            $this->_data['fuser'] = $this->muser->dropdownlistAccount1($this->_data['formData']['fuser']);
            $this->_data['fyear'] = $this->maccount->dropdownlistYear($this->_data['formData']['fyear']);
			$this->_data['ftypeTime'] = $this->maccount->dropdownlistTypetime($this->_data['formData']['ftypeTime']);
            $this->my_layout->view("cms/account/history",$this->_data);
		}

		public function expenditure()
		{
			$this->muser->checkPermission('account', 'expenditure');
			$this->_data['title'] = "Lịch sử chi";
			$this->_data['type'] = 2;
			$this->_data['formData'] = array(
				"fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
                "fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:20,
                "ftype"=>isset($_REQUEST['ftype']) && $_REQUEST['ftype'] ? $_REQUEST['ftype']:"all",
                "faccount_name"=>isset($_REQUEST['faccount_name']) && $_REQUEST['faccount_name'] ? $_REQUEST['faccount_name']:"all",
                "fuser"=>isset($_REQUEST['fuser']) && $_REQUEST['fuser'] ? $_REQUEST['fuser']:"all",
                "ftime"=>isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:"all",
				"ftypeTime"=>isset($_REQUEST['ftypeTime']) && $_REQUEST['ftypeTime'] ? $_REQUEST['ftypeTime']:0,
				"fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all"
            );
			$and = 'type_id = 38';
			if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
			{
				$and .= ' and a_note like "%'.$this->_data['formData']['fkeyword'].'%"';
			}	
			if($this->_data['formData']['ftype']!="all")
            {
                $and .= ' and a_type_chilrd ='.$this->_data['formData']['ftype'];
            }
            if($this->_data['formData']['faccount_name']!="all")
            {
                $and .= ' and ac_id ='.$this->_data['formData']['faccount_name'];
            }
            if($this->_data['formData']['fuser']!="all")
            {
                $and .= ' and a_user ='.$this->_data['formData']['fuser'];
            }
            $this->_data['textFilter'] = '';
            if($this->_data['formData']['fyear']!="all")
            {
                $and .= ' and YEAR(a_date) ='.$this->_data['formData']['fyear'];
                if ($this->_data['formData']['ftime']!="all") {
                	switch ($this->_data['formData']['ftypeTime']) {
                		case '1':
                			$and .= ' and WEEKOFYEAR(a_date) ='.$this->_data['formData']['ftime'];
			            	$this->_data['textFilter'] = 'Tuần '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '2':
                			$and .= ' and MONTH(a_date) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Tháng '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '3':
                			$and .= ' and QUARTER(a_date) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Quý '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;
                		default:
              				$add .= '';
              				$this->_data['textFilter'] = 'Bạn chưa chọn tuần, tháng hoặc quý của năm '.$this->_data['formData']['fyear'];
                			break;
                	}
                }
            }
            $this->_data['condition'] = $and;
			/*begin phan trang*/
            $paging['per_page']         =   $this->_data['formData']['fperpage'];
            $paging['num_links']         =   5;
            $paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
            $paging['start']      =   (($paging['page']-1)   * $paging['per_page']);            
            $query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';                   
            $paging['base_url']         =   my_lib::cms_site().'account/expenditure/?'.$query_string.'&page='; 
            $this->_data['page'] = $paging['page'];      
            /*end phan trang*/
            $this->_data['orderby']=$orderby = 'id desc';
            $limit = $paging['start'].','.$paging['per_page'];
            $this->_data['list'] = $this->maccount->getQuery($object="",$join="",$and,$orderby,$limit);
            $this->_data['record'] = $this->maccount->countQuery($join="",$and);
            $this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);
            $this->_data['ftype'] = $this->maccount_type->dropdownlist($this->_data['formData']['ftype'],38);
            $this->_data['faccount_name'] = $this->maccount_name->dropdownlist($this->_data['formData']['faccount_name']);
            $this->_data['fuser'] = $this->muser->dropdownlistAccount1($this->_data['formData']['fuser']);
            $this->_data['fyear'] = $this->maccount->dropdownlistYear($this->_data['formData']['fyear']);
			$this->_data['ftypeTime'] = $this->maccount->dropdownlistTypetime($this->_data['formData']['ftypeTime']);
            $this->my_layout->view("cms/account/history",$this->_data);
		}

		public function report()
		{
			$this->muser->checkPermission('account', 'report');
			$this->_data['title'] = 'Báo cáo thống kê kế toán';
			$this->_data['formData'] = array(
				"ftime"=>isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:"all",
				"ftypeTime"=>isset($_REQUEST['ftypeTime']) && $_REQUEST['ftypeTime'] ? $_REQUEST['ftypeTime']:0,
				"fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all",
			);

			$this->_data['textFilter'] = 'Tháng '.date('m').' của năm '.date('Y');
			$this->_data['and'] = 'and YEAR(a_date) ='.date('Y').' and MONTH(a_date) ='.date('m');
            if($this->_data['formData']['fyear']!="all")
            {
                $and = ' and YEAR(a_date) ='.$this->_data['formData']['fyear'];
                if ($this->_data['formData']['ftime']!="all") {
                	switch ($this->_data['formData']['ftypeTime']) {
                		case '1':
                			$and .= ' and WEEKOFYEAR(a_date) ='.$this->_data['formData']['ftime'];
			            	$this->_data['textFilter'] = 'Tuần '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '2':
                			$and .= ' and MONTH(a_date) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Tháng '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;

                		case '3':
                			$and .= ' and QUARTER(a_date) ='.$this->_data['formData']['ftime'];
            				$this->_data['textFilter'] = 'Quý '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                			break;
                		default:
              				$add .= '';
              				$this->_data['textFilter'] = 'Bạn chưa chọn tuần, tháng hoặc quý của năm '.$this->_data['formData']['fyear'];
                			break;
                	}
                }
                $this->_data['and'] = $and;
            }

			$this->_data['listIn'] = $this->maccount_type->getQuery('','','type_status = 1 and type_parent = 39','type_orderby asc','');
			$this->_data['listOut'] = $this->maccount_type->getQuery('','','type_status = 1 and type_parent = 38','type_orderby asc','');
			$this->_data['fyear'] = $this->maccount->dropdownlistYear();
			$this->_data['ftypeTime'] = $this->maccount->dropdownlistTypetime($this->_data['formData']['ftypeTime']);
			$this->my_layout->view("cms/account/report",$this->_data);
		}

		public function sumAjax()
		{
			$html = '';
			if ($this->input->post('and')) {
				$and = $this->input->post('and');
				$sum = $this->maccount->getSum($and);
				$html .= '<div class="row"><div class="col-sm-4"><div class="table-layout animation animating fadeInDown"><div class="col-xs-4 panel bgcolor-teal"><div class="ico-dollar fsize24 text-center"></div></div><div class="col-xs-8 panel"><div class="panel-body text-center"><h4 class="semibold nm">'.number_format($sum['totalMoney']).'</h4>
                    <p class="semibold text-muted mb0 mt5">VNĐ</p></div></div></div></div></div>';
			}
			echo $html;
		}
	}
?>