<?php
    class company extends MY_Controller
    {       
        function __construct()
        {
            # code...
            parent::__construct();
            $this->load->Model("cms/mcompany_type");    
            $this->load->Model("cms/mcompany_status");  
            $this->load->Model("cms/mcompany_sector");  
            $this->load->Model("cms/mcompany_scale");   
            $this->load->Model("cms/mcompany_rate");    
            $this->load->Model("cms/mbusiness");    
            $this->load->Model("cms/minfoservice");    
            $this->load->Model("cms/minfocontact");    
            $this->load->Model("cms/madvbudget");   
            $this->load->Model("cms/mcity");    
            $this->load->Model("cms/mbank");                
            $this->load->Model("cms/mservice");                
            $this->load->Model("cms/mcompany_work");                        
            $this->load->helper('text');                        
        }

    
        public function index()
        {   
            $this->muser->checkPermission('company', 'index');                        
            $this->_data["title"]  = 'Danh sách khách hàng';  

            $s_info = $this->session->userdata('userInfo');     
            $this->_data['boss'] = 0;   
            if ($s_info['s_user_group'] == 1) {
                $this->_data['boss'] = 1;   
            }

            $this->_data['formData'] = array(
                "fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
                "fcompany_sector"=>isset($_REQUEST['fcompany_sector']) && $_REQUEST['fcompany_sector'] ? $_REQUEST['fcompany_sector']:0,
                "fsuccess"=>isset($_REQUEST['fsuccess']) && $_REQUEST['fsuccess'] ? $_REQUEST['fsuccess']:0,
                "fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
                "fuserid"=>isset($_REQUEST['fuserid']) && $_REQUEST['fuserid'] ? $_REQUEST['fuserid']:$this->_data['andUser'],
                "fcompany_rate"=>isset($_REQUEST['fcompany_rate']) && $_REQUEST['fcompany_rate'] ? $_REQUEST['fcompany_rate']:"all",
                "fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:20,
                "ftime"=>isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:"all",
                "ftypeTime"=>isset($_REQUEST['ftypeTime']) && $_REQUEST['ftypeTime'] ? $_REQUEST['ftypeTime']:0,
                "fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all",
                "fid"=>isset($_REQUEST['fid']) && $_REQUEST['fid'] ? $_REQUEST['fid']:"all",
            );
            
            $and = ' active = 1 ';
            if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
            {

                $and .= ' and (company_name like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or company_address like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or company_search like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or phone like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or website like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or email like "%'.$this->_data['formData']['fkeyword'].'%")';
            }       
            if( $this->_data['formData']['fcompany_sector']!=0)
            {
                $company_sector = $this->mcompany_sector->checkParent($this->_data['formData']['fcompany_sector']);
                $and .= ' and company_sector in ('.$company_sector.')';
            } 
            
            if($this->_data['formData']['fsuccess']!=0)
            {
                $and .= ' and success = '.$this->_data['formData']['fsuccess'];
            }       
            if($this->_data['formData']['fstatus']!="all")
            {
                $and .= ' and status ='.$this->_data['formData']['fstatus'];
            }       
            if($this->_data['formData']['fuserid'])
            {
                $and .= ' and user_id in('.$this->_data['formData']['fuserid'].')';
            }   
            $this->_data['textFilter'] = '';
            if($this->_data['formData']['fyear']!="all")
            {
                $and .= ' and YEAR(create_date) ='.$this->_data['formData']['fyear'];
                if ($this->_data['formData']['ftime']!="all") {
                    switch ($this->_data['formData']['ftypeTime']) {
                        case '1':
                            $and .= ' and WEEKOFYEAR(create_date) ='.$this->_data['formData']['ftime'];
                            $this->_data['textFilter'] = 'Tuần '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                            break;

                        case '2':
                            $and .= ' and MONTH(create_date) ='.$this->_data['formData']['ftime'];
                            $this->_data['textFilter'] = 'Tháng '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                            break;

                        case '3':
                            $and .= ' and QUARTER(create_date) ='.$this->_data['formData']['ftime'];
                            $this->_data['textFilter'] = 'Quý '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                            break;
                        default:
                            $add .= '';
                            $this->_data['textFilter'] = 'Bạn chưa chọn tuần, tháng hoặc quý của năm '.$this->_data['formData']['fyear'];
                            break;
                    }
                }
            } 
            
            if($this->_data['formData']['fcompany_rate']!="all")
            {
                $and .= ' and company_rate ='.$this->_data['formData']['fcompany_rate'];
            }

            if ($this->_data['formData']['fid'] != "all") {
                $and = ' active = 1 and id = '.$this->_data['formData']['fid'];
            }

            $this->_data['and'] = $and;
            // my_lib::printArr($_SERVER);
            
            /*begin phan trang*/
            $paging['per_page']         =   $this->_data['formData']['fperpage'];
            $paging['num_links']         =   5;
            $paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
            $paging['start']      =   (($paging['page']-1)   * $paging['per_page']);            
            $query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';                   
            $paging['base_url']         =   my_lib::cms_site().'company/?'.$query_string.'&page='; 
            $this->_data['page'] = $paging['page'];      
            /*end phan trang*/

            $this->_data['orderby']=$orderby = 'id desc';
            $limit = $paging['start'].','.$paging['per_page'];
            $this->_data['list'] = $this->mcompany->getQuery($object="",$join="",$and,$orderby,$limit);
            $this->_data['record'] = $this->mcompany->countQuery($join="",$and);
            $this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

            /**begin xoa check chon*/
            if(isset($_POST['delAll'])){
                $checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
                $this->muser->checkPermission('company', 'delete');
                if($checkid){
                    foreach ($checkid as $key => $value) {
                        if(is_numeric($value)){
                            $myCompany = $this->mcompany->getData('',array("id"=>$value));
                            if($myCompany['id']>0){                             
                                $this->mcompany->edit($value,array("active"=>0,"update_date"=>date("Y-m-d"),"user_trash"=>$this->_data['s_info']['s_user_id']));                                                            
                            }
                        }
                    }
                    /**begin chuyen trang*/
                    header("location:".current_url());
                    /**end chuyen trang*/
                }else{
                    $this->_data['error'][] = 'Vui lòng kiểm tra check chọn';
                }
            }
            /**end xoa check chon*/
            $this->_data['fcompany_rate'] = $this->mcompany_rate->dropdownlist($this->_data['formData']['fcompany_rate'],$this->_data['formData']['fsuccess']);
            $this->_data['fcompany_sector'] = $this->mcompany_sector->dropdownlist($this->_data['formData']['fcompany_sector']);
            $this->_data['fstatus'] = $this->mcompany_status->dropdownlist($this->_data['formData']['fstatus']);                                      
            $this->_data['fuserid'] = $this->muser->dropdownlist($this->_data['formData']['fuserid'],true);
            $this->_data['fsuccess'] = $this->mcompany->dropdownlistStatus($this->_data['formData']['fsuccess']);
            $this->_data['fyear'] = $this->minfoservice->dropdownlistYear($this->_data['formData']['fyear']);
            $this->_data['ftypeTime'] = $this->minfoservice->dropdownlistTypetime($this->_data['formData']['ftypeTime']);

            $this->my_layout->view("cms/company/index",$this->_data);
        }

        // public function updateSuccess()
        // {
        //     $and = 'status = 5';
        //     $list = $this->mcompany->getQuery($object="id",$join="",$and,$orderby="",$limit="");
        //     foreach ($list as $key => $value) {
        //         $this->mcompany->edit($value['id'],array('status' => 1));
        //     }
        // }

        public function filter($idService)
        {
            $myService = $this->mservice->getData("service_name",array('id' => $idService));
            if ($myService == NULL) {
                header("location:".my_lib::cms_site().'error/notfound');
            }
            $this->_data['filter'] = 1;
            $this->_data['idService'] = $idService;
            $this->_data["title"]  = 'Danh sách khách hàng sử dụng dịch vụ '.$myService['service_name'];            
            $this->_data['formData'] = array(
                "fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
                "fcompany_sector"=>isset($_REQUEST['fcompany_sector']) && $_REQUEST['fcompany_sector'] ? $_REQUEST['fcompany_sector']:0,
                // "fsuccess"=>isset($_REQUEST['fsuccess']) && $_REQUEST['fsuccess'] ? $_REQUEST['fsuccess']:0,
                // "fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
                "fuserid"=>isset($_REQUEST['fuserid']) && $_REQUEST['fuserid'] ? $_REQUEST['fuserid']:$this->_data['andUser'],
                "fcompany_rate"=>isset($_REQUEST['fcompany_rate']) && $_REQUEST['fcompany_rate'] ? $_REQUEST['fcompany_rate']:"all",
                "ftime"=>isset($_REQUEST['ftime']) && $_REQUEST['ftime'] ? $_REQUEST['ftime']:"all",
                "ftypeTime"=>isset($_REQUEST['ftypeTime']) && $_REQUEST['ftypeTime'] ? $_REQUEST['ftypeTime']:0,
                "fyear"=>isset($_REQUEST['fyear']) && $_REQUEST['fyear'] ? $_REQUEST['fyear']:"all",
                "fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
            );
            
            $and = ' j.success = 1 and j.active = 1 and s.service_type = '.$idService;
            if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
            {

                $and .= ' and (company_name like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or company_address like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or company_search like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or phone like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or phone like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or website like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or email like "%'.$this->_data['formData']['fkeyword'].'%")';
            }       
            if( $this->_data['formData']['fcompany_sector']!=0)
            {
                $company_sector = $this->mcompany_sector->checkParent($this->_data['formData']['fcompany_sector']);
                $and .= ' and company_sector in ('.$company_sector.')';
            } 
            $this->_data['textFilter'] = '';
            if($this->_data['formData']['fyear']!="all")
            {
                $and .= ' and YEAR(create_date) ='.$this->_data['formData']['fyear'];
                if ($this->_data['formData']['ftime']!="all") {
                    switch ($this->_data['formData']['ftypeTime']) {
                        case '1':
                            $and .= ' and WEEKOFYEAR(create_date) ='.$this->_data['formData']['ftime'];
                            $this->_data['textFilter'] = 'Tuần '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                            break;

                        case '2':
                            $and .= ' and MONTH(create_date) ='.$this->_data['formData']['ftime'];
                            $this->_data['textFilter'] = 'Tháng '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                            break;

                        case '3':
                            $and .= ' and QUARTER(create_date) ='.$this->_data['formData']['ftime'];
                            $this->_data['textFilter'] = 'Quý '.$this->_data['formData']['ftime'].' của năm '.$this->_data['formData']['fyear'];
                            break;
                        default:
                            $add .= '';
                            $this->_data['textFilter'] = 'Bạn chưa chọn tuần, tháng hoặc quý của năm '.$this->_data['formData']['fyear'];
                            break;
                    }
                }
            } 
            // if( $this->_data['formData']['fsuccess']!=0)
            // {
            //     $and .= ' and success = '.$this->_data['formData']['fsuccess'];
            // }       
            // if($this->_data['formData']['fstatus']!="all")
            // {
            //     $and .= ' and status ='.$this->_data['formData']['fstatus'];
            // }       
            if($this->_data['formData']['fuserid'])
            {
                $and .= ' and user_id in('.$this->_data['formData']['fuserid'].')';
            }   

            
            if($this->_data['formData']['fcompany_rate']!="all")
            {
                $and .= ' and company_rate ='.$this->_data['formData']['fcompany_rate'];
            }

            $join = ' inner join tkwp_infoservice s on j.id = s.company_id';

            // my_lib::printArr($_SERVER);
            
            /*begin phan trang*/
            $paging['per_page']         =   $this->_data['formData']['fperpage'];
            $paging['num_links']         =   5;
            $paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
            $paging['start']      =   (($paging['page']-1)   * $paging['per_page']);            
            $query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';                   
            $paging['base_url']         =   my_lib::cms_site().'company/filter/'.$idService.'?'.$query_string.'&page=';          
            /*end phan trang*/

            $this->_data['orderby']=$orderby = 's.id desc';
            $limit = $paging['start'].','.$paging['per_page'];
            $object = 'j.id,user_id,user_typing,status,company_sector,company_rate,company_name,company_address,company_sector,phone,success';
            $this->_data['list'] = $this->mcompany->getQuery($object,$join,$and,$orderby,$limit);
            $this->_data['record'] = $this->mcompany->countQuery($join,$and);
            $this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

            /**begin xoa check chon*/
            if(isset($_POST['delAll'])){
                $checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
                if($checkid){
                    foreach ($checkid as $key => $value) {
                        # code...
                        if(is_numeric($value)){
                            $myCompany = $this->mcompany->getData('',array("id"=>$value));
                            if($myCompany['id']>0){                             
                                $this->mcompany->edit($value,array("active"=>0,"update_date"=>date("Y-m-d"),"user_trash"=>$this->_data['s_info']['s_user_id']));                                                            
                            }
                        }
                    }
                    /**begin chuyen trang*/
                    header("location:".current_url());
                    /**end chuyen trang*/
                }else{
                    $this->_data['error'][] = 'Vui lòng kiểm tra check chọn';
                }
            }
            /**end xoa check chon*/
            $this->_data['fcompany_rate'] = $this->mcompany_rate->dropdownlist($this->_data['formData']['fcompany_rate'],1);
            $this->_data['fcompany_sector'] = $this->mcompany_sector->dropdownlist($this->_data['formData']['fcompany_sector']);
            //$this->_data['fstatus'] = $this->mcompany_status->dropdownlist($this->_data['formData']['fstatus']);                                      
            $this->_data['fuserid'] = $this->muser->dropdownlist($this->_data['formData']['fuserid'],true);
            $this->_data['fyear'] = $this->minfoservice->dropdownlistYear($this->_data['formData']['fyear']);
            $this->_data['ftypeTime'] = $this->minfoservice->dropdownlistTypetime($this->_data['formData']['ftypeTime']);
            //$this->_data['fsuccess'] = $this->mcompany->dropdownlistStatus($this->_data['formData']['fsuccess']);

            $this->my_layout->view("cms/company/fiter",$this->_data);
        }

        #thung rac khac hang
        public function trash()
        {
            $this->muser->checkPermission('company', 'trash');                    
            $this->_data["title"]  = 'Danh sách khách hàng';            
            $this->_data['formData'] = array(
                "fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
                "fcompany_sector"=>isset($_REQUEST['fcompany_sector']) && $_REQUEST['fcompany_sector'] ? $_REQUEST['fcompany_sector']:0,
                "fstatus"=>isset($_REQUEST['fstatus']) && $_REQUEST['fstatus'] ? $_REQUEST['fstatus']:"all",
                "fuserid"=>isset($_REQUEST['fuserid']) && $_REQUEST['fuserid'] ? $_REQUEST['fuserid']:"all",
                "fcityhouse"=>isset($_REQUEST['fcityhouse']) && $_REQUEST['fcityhouse'] ? $_REQUEST['fcityhouse']:"all",
                "fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
            );
            $and = ' active = 0 ';
            if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
            {
                $and .= ' and (company_name like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or company_address like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or phone like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or phone like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or website like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or email like "%'.$this->_data['formData']['fkeyword'].'%")';
            }       
            if(isset($this->_data['formData']['fcompany_sector']) && $this->_data['formData']['fcompany_sector']!=0)
            {
                $and .= ' and company_sector ='.$this->_data['formData']['fcompany_sector'];
            }       
            if(isset($this->_data['formData']['fstatus']) && $this->_data['formData']['fstatus']!="all")
            {
                $and .= ' and status ='.$this->_data['formData']['fstatus'];
            }       
            if(isset($this->_data['formData']['fuserid']) && $this->_data['formData']['fuserid']!="all")
            {
                $and .= ' and user_id ='.$this->_data['formData']['fuserid'];
            }   
            if(isset($this->_data['formData']['fcityhouse']) && $this->_data['formData']['fcityhouse']!="all")
            {
                $and .= ' and city_house ='.$this->_data['formData']['fcityhouse'];
            }

            // my_lib::printArr($_SERVER);
            
            /*begin phan trang*/
            $paging['per_page']         =   $this->_data['formData']['fperpage'];
            $paging['num_links']         =   5;
            $paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
            $paging['start']      =   (($paging['page']-1)   * $paging['per_page']);            
            $query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';                   
            $paging['base_url']         =   my_lib::cms_site().'company/trash/?'.$query_string.'&page=';            
            /*end phan trang*/

            $this->_data['orderby']=$orderby = 'status,id desc';
            $limit = $paging['start'].','.$paging['per_page'];
            $this->_data['list'] = $this->mcompany->getQuery($object="",$join="",$and,$orderby,$limit);
            $this->_data['record'] = $this->mcompany->countQuery($join="",$and);
            $this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);

            /**begin xoa check chon*/
            if(isset($_POST['apllyAll'])){
                $checkid = isset($_POST['checkid']) ? $_POST['checkid']:'';
                if($checkid){
                    foreach ($checkid as $key => $value) {
                        # code...
                        if(is_numeric($value)){
                            $myCompany = $this->mcompany->getData('',array("id"=>$value));
                            if($myCompany['id']>0){                             
                                $this->mcompany->edit($value,array("active"=>1,"update_date"=>date("Y-m-d")));                                                          
                            }
                        }
                    }
                    /**begin chuyen trang*/
                    header("location:".current_url());
                    /**end chuyen trang*/
                }else{
                    $this->_data['error'][] = 'Vui lòng kiểm tra check chọn';
                }
            }
            /**end xoa check chon*/
            $this->_data['fcompany_sector'] = $this->mcompany_sector->dropdownlist($this->_data['formData']['fcompany_sector']);
            $this->_data['fstatus'] = $this->mcompany_status->dropdownlist($this->_data['formData']['fstatus']);
            $this->_data['fcityhouse'] = $this->mcity->dropdownlist($this->_data['formData']['fcityhouse']);
            $this->_data['fuserid'] = $this->muser->dropdownlist($this->_data['formData']['fuserid']);

            $this->my_layout->view("cms/company/trash",$this->_data);
        }


        public function add()
        {       
            $this->muser->checkPermission('company', 'add');                    
            $this->_data['error'] = "";
            $this->_data['success'] = "";
            $this->_data['lang'] = my_lib::lang();
            $this->_data["title"]  = 'Thêm mới khách hàng';
            $this->_data['formData']    = array(
                "company_name"      =>  "",
                "short_name"        =>  "",
                "company_name_en"   =>  "",
                "company_address"   =>  "",
                "city_house"        =>  "",
                "phone"             =>  "",
                "fax"               =>  "",
                "website"           =>  "",
                "email"             =>  "",
                "tax_code"          =>  "",
                "owner_name"        =>  "",
                "account_bank"      =>  "",
                "bank_id"           =>  "",
                "account_bank"      =>  "",
                "status"            =>  1, //dang lam viet
                "success"           =>  2, //chua thanh cong
                "pos_status"        =>  "",
                "company_type"      =>  "",
                "company_rate"      =>  4,
                "adv_budget"        =>  "",
                "company_scale"     =>  "",
                "business_type"     =>  "",
                "company_sector"    =>  "",
                "type_consult"      =>  0,
                "createdate"        =>  "",
                "user_id"           =>  $this->_data['s_info']['s_user_id'],
                "user_typing"       =>  $this->_data['s_info']['s_user_id'],
                "create_date"       =>  date("Y-m-d") //ngay tao
            );          

            if(isset($_POST['fsubmit'])){               
                $this->_data['formData']    = array(
                    "company_name"      =>  $this->input->post('company_name'),
                    "short_name"        =>  $this->input->post('short_name'),
                    "company_search"    =>  url_title(convert($this->input->post('company_name')),' ',TRUE),
                    "company_name_en"   =>  $this->input->post('company_name_en'),
                    "company_address"   =>  $this->input->post('company_address'),
                    "city_house"        =>  $this->input->post('city_house'),
                    "phone"             =>  $this->input->post('phone'),
                    "fax"               =>  $this->input->post('fax'),
                    "website"           =>  $this->input->post('website'),
                    "email"             =>  $this->input->post('email'),
                    "tax_code"          =>  $this->input->post('tax_code'),
                    "owner_name"        =>  $this->input->post('owner_name'),
                    "account_bank"      =>  $this->input->post('account_bank'),
                    "bank_id"           =>  $this->input->post('bank_id'),
                    "account_bank"      =>  $this->input->post('account_bank'),
                    "status"            =>  $this->input->post('status'),
                    "success"            =>  2,
                    "pos_status"        =>  $this->input->post('pos_status'),
                    "company_type"      =>  $this->input->post('company_type'),
                    "company_rate"      =>  $this->input->post('company_rate'),
                    "adv_budget"        =>  $this->input->post('adv_budget'),
                    "company_scale"     =>  $this->input->post('company_scale'),
                    "business_type"     =>  $this->input->post('business_type'),
                    "company_sector"    =>  $this->input->post('company_sector'),
                    "type_consult"      =>  $this->input->post('type_consult'),
                    "createdate"        =>  $this->input->post('createdate'),
                    "user_id"           =>  $this->input->post('user_id'),
                    "user_typing"       =>  $this->input->post('user_typing'),
                    "create_date"       =>  date("Y-m-d") //ngay tao
                );  
                if($this->_data['formData']['company_name']==""){
                    $this->_data['error'][] = "Bạn chưa nhập tiêu đề";
                }
                if($this->_data['formData']['company_address']==""){
                    $this->_data['error'][] = "Bạn chưa nhập địa chỉ";
                }
                if($this->_data['formData']['phone']==""){
                    $this->_data['error'][] = "Bạn chưa nhập số điện thoại";
                }
                
                if($this->_data['formData']['company_rate']==0){
                    $this->_data['error'][] = "Bạn chưa chọn loại KH";
                }
                if($this->_data['formData']['company_sector']==0){
                    $this->_data['error'][] = "Bạn chưa chọn dòng ngành";
                }
                if($this->_data['formData']['company_name'] && 
                   $this->_data['formData']['company_rate'] && 
                   $this->_data['formData']['company_sector']){
                    $insert = $this->mcompany->add($this->_data['formData']);
                    if(is_numeric($insert)>0){
                        $this->_data['success'][] = "Add success";
                        $this->_data['formData'] = NULL;
                        /**begin chuyen trang*/
                        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                            header("location:".base64_decode($_REQUEST['redirect']));
                        }else{
                            // header("location:".my_lib::cms_site()."company/");
                            header("location:".my_lib::cms_site()."company/edit/".$insert."/");
                        }
                        /**end chuyen trang*/
                    }else{
                        $this->_data['error'][] = "Add Not Success";
                    }
                }
            }
            $this->_data['company_sector'] = $this->mcompany_sector->dropdownlist($this->_data['formData']['company_sector']);
            $this->_data['company_scale'] = $this->mcompany_scale->dropdownlist($this->_data['formData']['company_scale']);
            $this->_data['company_rate'] = $this->mcompany_rate->dropdownlist($this->_data['formData']['company_rate'],2);
            $this->_data['business_type'] = $this->mbusiness->dropdownlist($this->_data['formData']['business_type']);
            $this->_data['adv_budget'] = $this->madvbudget->dropdownlist($this->_data['formData']['adv_budget']);
            $this->_data['company_type'] = $this->mcompany_type->dropdownlist($this->_data['formData']['company_type']);
            $this->_data['status'] = $this->mcompany_status->dropdownlist($this->_data['formData']['status']);
            $this->_data['user_id'] = $this->muser->dropdownlist($this->_data['formData']['user_id']);
            $this->_data['user_typing'] = $this->muser->dropdownlist($this->_data['formData']['user_typing']);
            $this->_data['bank_id'] = $this->mbank->dropdownlist($this->_data['formData']['bank_id']);
            $this->_data['city_house'] = $this->mcity->dropdownlist($this->_data['formData']['city_house']);            
            $this->_data['type_consult'] = $this->mcompany->dropdownlistConsult($this->_data['formData']['type_consult']);            
            $this->my_layout->view("cms/company/add",$this->_data);
        }

        public function edit($id)
        {
            $this->muser->checkPermission('company', 'edit');
            $myCompany = '';
            if(is_numeric($id)){
                $myCompany = $this->mcompany->getData('',array("id"=>$id));
                if($myCompany['id']<=0){
                    header("location:".my_lib::cms_site().'error/notfound');
                    exit();
                }
            }else{
                header("location:".my_lib::cms_site().'error/notfound');
                exit();
            }           
            $this->_data['error'] = "";
            $this->_data['success'] = "";
            $this->_data['lang'] = my_lib::lang();
            $this->_data["title"]  = 'Cập nhật khách hàng';
            $this->_data['formData']    = array(
                "company_name"      =>  $myCompany['company_name'],
                "short_name"        =>  $myCompany['short_name'],
                "company_name_en"   =>  $myCompany['company_name_en'],
                "company_address"   =>  $myCompany['company_address'],
                "city_house"        =>  $myCompany['city_house'],
                "phone"             =>  $myCompany['phone'],
                "fax"               =>  $myCompany['fax'],
                "website"           =>  $myCompany['website'],
                "email"             =>  $myCompany['email'],
                "tax_code"          =>  $myCompany['tax_code'],
                "owner_name"        =>  $myCompany['owner_name'],
                "account_bank"      =>  $myCompany['account_bank'],
                "bank_id"           =>  $myCompany['bank_id'],
                "account_bank"      =>  $myCompany['account_bank'],
                "status"            =>  $myCompany['status'], //dang lam viet
                "pos_status"        =>  $myCompany['pos_status'],
                "company_type"      =>  $myCompany['company_type'],
                "company_rate"      =>  $myCompany['company_rate'],
                "adv_budget"        =>  $myCompany['adv_budget'],
                "company_scale"     =>  $myCompany['company_scale'],
                "business_type"     =>  $myCompany['business_type'],
                "company_sector"    =>  $myCompany['company_sector'],
                "type_consult"      =>  $myCompany['type_consult'],
                "createdate"        =>  $myCompany['createdate'],
                "user_id"           =>  $myCompany['user_id'],
                "user_typing"       =>  $myCompany['user_typing'],
                "update_date"       =>  date("Y-m-d") //ngay tao
            );          

            if(isset($_POST['fsubmit'])){               
                $this->_data['formData']    = array(
                    "company_name"      =>  $this->input->post('company_name'),
                    "short_name"        =>  $this->input->post('short_name'),
                    "company_name_en"   =>  $this->input->post('company_name_en'),
                    "company_search"    =>  url_title(convert($this->input->post('company_name')),' ',TRUE),
                    "company_address"   =>  $this->input->post('company_address'),
                    "city_house"        =>  $this->input->post('city_house'),
                    "phone"             =>  $this->input->post('phone'),
                    "fax"               =>  $this->input->post('fax'),
                    "website"           =>  $this->input->post('website'),
                    "email"             =>  $this->input->post('email'),
                    "tax_code"          =>  $this->input->post('tax_code'),
                    "owner_name"        =>  $this->input->post('owner_name'),
                    "account_bank"      =>  $this->input->post('account_bank'),
                    "bank_id"           =>  $this->input->post('bank_id'),
                    "account_bank"      =>  $this->input->post('account_bank'),
                    "status"            =>  $this->input->post('status'),
                    "pos_status"        =>  $this->input->post('pos_status'),
                    "company_type"      =>  $this->input->post('company_type'),
                    "company_rate"      =>  $this->input->post('company_rate'),
                    "adv_budget"        =>  $this->input->post('adv_budget'),
                    "company_scale"     =>  $this->input->post('company_scale'),
                    "business_type"     =>  $this->input->post('business_type'),
                    "company_sector"    =>  $this->input->post('company_sector'),
                    "type_consult"      =>  $this->input->post('type_consult'),
                    "createdate"        =>  $this->input->post('createdate'),
                    "user_id"           =>  $this->input->post('user_id'),
                    "user_typing"       =>  $this->input->post('user_typing'),
                    "update_date"       =>  date("Y-m-d") //ngay tao
                );  
                if($this->_data['formData']['company_name']){                   
                    if($this->mcompany->edit($id,$this->_data['formData'])){
                        $this->_data['success'][] = "Update success";
                        $this->_data['formData'] = NULL;
                        /**begin chuyen trang*/
                        header("location:".my_lib::cms_site()."company/working/".$id);
                        /**end chuyen trang*/
                    }else{
                        $this->_data['error'][] = "Update Not Success";
                    }
                }else{
                    $this->_data['error'][] = "Bạn chưa nhập tiêu đề";
                }           
            }
            $this->_data['company_sector'] = $this->mcompany_sector->dropdownlist($this->_data['formData']['company_sector']);
            $this->_data['company_scale'] = $this->mcompany_scale->dropdownlist($this->_data['formData']['company_scale']);
            $this->_data['company_rate'] = $this->mcompany_rate->dropdownlist($this->_data['formData']['company_rate'],$myCompany['success']);
            $this->_data['business_type'] = $this->mbusiness->dropdownlist($this->_data['formData']['business_type']);
            $this->_data['adv_budget'] = $this->madvbudget->dropdownlist($this->_data['formData']['adv_budget']);
            $this->_data['company_type'] = $this->mcompany_type->dropdownlist($this->_data['formData']['company_type']);
            $this->_data['status'] = $this->mcompany_status->dropdownlist($this->_data['formData']['status']);
            $this->_data['user_id'] = $this->muser->dropdownlist($this->_data['formData']['user_id']);
            $this->_data['user_typing'] = $this->muser->dropdownlist($this->_data['formData']['user_typing']);
            $this->_data['bank_id'] = $this->mbank->dropdownlist($this->_data['formData']['bank_id']);
            $this->_data['city_house'] = $this->mcity->dropdownlist($this->_data['formData']['city_house']);
            $this->_data['type_consult'] = $this->mcompany->dropdownlistConsult($this->_data['formData']['type_consult']);

            $this->my_layout->view("cms/company/edit",$this->_data);
        }

        /**begin lam viec voi khach hang*/
        public function working($id)
        {     
            $this->muser->checkPermission('company', 'working');
        	$this->_data['s_info'] = $s_info = $this->session->userdata('userInfo');
			$this->_data['boss'] =	0;
            $this->_data['myCompany'] = '';
            if(is_numeric($id)){
                $this->_data['myCompany'] = $this->mcompany->getData('',array("id"=>$id));
                if($this->_data['myCompany']['id']<=0){
                    header("location:".my_lib::cms_site().'error/notfound');
                    exit();
                }
            }else{
                header("location:".my_lib::cms_site().'error/notfound');
                exit();
            } 
			if ($this->_data['s_info']['s_user_group'] == 1 || $this->_data['s_info']['s_user_group'] == 2 || $this->_data['s_info']['s_user_group'] == 5 || $this->_data['s_info']['s_user_group'] == 9) {
				$this->_data['boss'] =	1;
				$success = isset($_REQUEST['success']) && $_REQUEST['success'] ? $_REQUEST['success']:"all";
                if(isset($success) && $success!="all")
                {
                    if ($success == 1) {
                        $contact = $this->minfocontact->countQuery("","company_id = ".$id);
                        if ($contact < 1 || $this->_data['myCompany']['tax_code'] == "") {
                            $link_update = my_lib::cms_site().'company/edit/'.$id.'/?redirect='.base64_encode(current_url());
                            $this->_data['error'] = 'Vui lòng click vào <a href="'.$link_update.'">đây</a> để nhập đầy đủ thông tin: email, mã số thuế và người liên hệ.';
                        } else{
                            if($this->mcompany->edit($id,array('success' => $success,'status' => 1))){
                                header("location:".my_lib::cms_site().'company/working/'.$id.'/?redirect='.base64_encode(current_url()));
                            }
                        }
                    } else {
                        if($this->mcompany->edit($id,array('success' => 0))){
                            header("location:".my_lib::cms_site().'company/working/'.$id.'/?redirect='.base64_encode(current_url()));
                        }
                    }
                } 

			}

            //$this->_data['error'] = "";
            $this->_data['success'] = "";
            $this->_data['lang'] = my_lib::lang();
            $this->_data["title"]  = 'BẢNG LÀM VIỆC';

            $tmp_company_sector=$this->mcompany_sector->getData(array("sector_name"),array('id'=>$this->_data['myCompany']['company_sector']));
            $this->_data['myCompany']['company_sector'] = isset($tmp_company_sector['sector_name']) ? $tmp_company_sector['sector_name']:'';

            $tmp_company_scale=$this->mcompany_scale->getData(array("scale_name"),array('id'=>$this->_data['myCompany']['company_scale']));
            $this->_data['myCompany']['company_scale'] = isset($tmp_company_scale['scale_name']) ? $tmp_company_scale['scale_name']:'';

            $and1 = 'service_level = 1';
            $and2 = 'service_level = 2';
            $this->_data['orderby']=$orderby = 'service_orderby asc, id asc';
            $this->_data['listService_level_1'] = $this->mservice->getQuery($object="",$join="",$and1,$orderby,$limit="");
            $this->_data['listService_level_2'] = $this->mservice->getQuery($object="",$join="",$and2,$orderby,$limit="");

            $tmp_business=$this->mbusiness->getData(array("business_name"),array('id'=>$this->_data['myCompany']['business_type']));
            $this->_data['myCompany']['business_type'] = isset($tmp_business['business_name']) ? $tmp_business['business_name']:'';

            $tmp_advbudget=$this->madvbudget->getData(array("adv_budget_name"),array('id'=>$this->_data['myCompany']['adv_budget']));
            $this->_data['myCompany']['adv_budget'] = isset($tmp_advbudget['adv_budget_name']) ? $tmp_advbudget['adv_budget_name']:'';

            $tmp_company_type=$this->mcompany_type->getData(array("type_name"),array('id'=>$this->_data['myCompany']['company_type']));
            $this->_data['myCompany']['company_type'] = isset($tmp_company_type['type_name']) ? $tmp_company_type['type_name']:'';

            $this->_data['formData']['status'] = $this->mcompany_status->dropdownlist($this->_data['myCompany']['status']);
            $this->_data['formData']['user_id'] = $this->muser->dropdownlist($this->_data['myCompany']['user_id']);
            $this->_data['formData']['type_consult'] = $this->mcompany->dropdownlistConsult($this->_data['myCompany']['type_consult']);
            $this->_data['formData']['company_rate'] = $this->mcompany_rate->dropdownlist($this->_data['myCompany']['company_rate']);
            

            $tmp_user_typing=$this->muser->getData(array("user_fullname"),array('id'=>$this->_data['myCompany']['user_typing']));
            $this->_data['myCompany']['user_typing'] = isset($tmp_user_typing['user_fullname']) ? $tmp_user_typing['user_fullname']:'';

            $tmp_bank=$this->mbank->getData(array("bank_name"),array('id'=>$this->_data['myCompany']['bank_id']));
            $this->_data['myCompany']['bank_id'] = isset($tmp_bank['bank_name']) ? $tmp_bank['bank_name']:'';

            $tmp_city=$this->mcity->getData(array("city_name"),array('id'=>$this->_data['myCompany']['city_house']));
            $this->_data['myCompany']['city_house'] = isset($tmp_city['city_name']) ? $tmp_city['city_name']:'';


            /**begin danh sach thong tin nguoi lien he*/
            $this->_data['listInfoContact']  = $this->minfocontact->getQuery("","","company_id=".$id,"id desc","");
            /**end danh sach thong tin nguoi lien he*/
            // DS Service
            $this->_data['listInfoService']  = $this->minfoservice->getQuery("","","company_id=".$id,"id asc","");

            /**begin lay tat ca thong tin lam viec thong qua tat ca ID cua nugoi lien he $id = company_id*/
            $tmpIDInfoContact = $this->minfocontact->getIDAnd($id); 
            if($tmpIDInfoContact)
            {
                $object_work="";
                $join_work="";
                $and_work="infocontact_id in (".$tmpIDInfoContact.")";
                $orderby_work="id desc";
                $limit_work="";
                $this->_data['listCompanyWork'] = $this->mcompany_work->getQuery($object_work,$join_work,$and_work,$orderby_work,$limit_work);
            }
            $this->_data['fcompany_working_status'] = $this->mcompany_work_status->dropdownlist(0); 
            $this->_data['dropdownlistInfo'] = $this->minfocontact->dropdownlistInfo($id,''); //5 dien thoai

            $this->my_layout->view("cms/company/working",$this->_data);
        }
        /**end lam viec voi khach hang*/

        /**begin thong ke luong KH*/
        public function chartcompany()
        {
            $this->_data['title'] = 'Biều đồ khách hàng mới';
            /**begin chart company_work*/
            $this->_data['company_all']  = '';
            $this->_data['company_my']  = '';        
            $this->_data['company_group']  = '';        
            $company_group = $company_all = $company_my = "";
            for ($i=1; $i <= 12; $i++) {        
                $and_company_my = ' user_id in ('.$this->_data["s_info"]["s_user_id"].') and create_date >= "'.date("Y").'-'.$i.'-1" and create_date <= "'.date("Y").'-'.$i.'-31"' ;                    
                
                if($this->_data["andUser"])
                    $and_company_group = ' user_id in ('.$this->_data["andUser"].') and create_date >= "'.date("Y").'-'.$i.'-1" and create_date <= "'.date("Y").'-'.$i.'-31"' ;                    
                else
                    $and_company_group = ' create_date >= "'.date("Y").'-'.$i.'-1" and create_date <= "'.date("Y").'-'.$i.'-31"' ;                    
                
                $and_company_all = ' create_date >= "'.date("Y").'-'.$i.'-1" and create_date <= "'.date("Y").'-'.$i.'-31"' ;                   
               
                $company_all .= $this->mcompany->countQuery($join="",$and_company_all).',';                   
                $company_group .= $this->mcompany->countQuery($join="",$and_company_group).',';                   
                $company_my .= $this->mcompany->countQuery($join="",$and_company_my).',';                   
            }                        
            $this->_data['company_all'] = rtrim($company_all,",");
            $this->_data['company_group'] = rtrim($company_group,",");
            $this->_data['company_my'] = rtrim($company_my,",");                              
            /**end chart company_work*/         
            $this->my_layout->view("cms/company/chartcompany",$this->_data);
        }
        /**end thong ke luong KH*/

        /**begin function lich lamviec*/
        public function calendar()
        {
            $this->_data['title'] = 'Lịch làm việc';    
            $this->_data['formData']['fuserid'] = isset($_REQUEST["fuserid"]) ? $_REQUEST['fuserid']:$this->_data['s_info']['s_user_id'];           
            $this->_data['fuserid'] = $this->muser->dropdownlist($this->_data['formData']['fuserid'],true);                 
            $this->my_layout->view("cms/company/calendar",$this->_data);
        }
        /**end function lich lamviec*/

        /**begin function lich lamviec*/
        public function showwork()
        {
            $this->_data['title'] = 'Thông tin lịch làm việc';      
            
            $this->_data['formData'] = array(
                "fkeyword"=>isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] ? $_REQUEST['fkeyword']:'',
                "fperpage"=>isset($_REQUEST['fperpage']) && $_REQUEST['fperpage'] ? $_REQUEST['fperpage']:10,
                "fcreatedate"=>isset($_REQUEST['fcreatedate']) && $_REQUEST['fcreatedate'] ? $_REQUEST['fcreatedate']:date("Y-m-d"),
            );
            $and = 1;
            if($this->_data['andUser'])
                $and .= ' and user in ('.$this->_data['andUser'] .') ';         
            $and .= ' and create_date = "'.$this->_data['formData']['fcreatedate'].'"';

            if(isset($this->_data['formData']['fkeyword']) && $this->_data['formData']['fkeyword'])
            {
                $and .= ' and (employee_name like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or phone like "%'.$this->_data['formData']['fkeyword'].'%"';              
                $and .= ' or infocontact_id like "%'.$this->_data['formData']['fkeyword'].'%"';
                $and .= ' or contact_content like "%'.$this->_data['formData']['fkeyword'].'%")';
            }                               

            // my_lib::printArr($_SERVER);
            
            /*begin phan trang*/
            $paging['per_page']         =   $this->_data['formData']['fperpage'];
            $paging['num_links']         =   5;
            $paging['page'] = $this->_data['page'] = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page']:1;
            $paging['start']      =   (($paging['page']-1)   * $paging['per_page']);            
            $query_string = isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING'] ? str_replace("&page=".$this->_data['page'], "", $_SERVER['REDIRECT_QUERY_STRING']):'';                   
            $paging['base_url']         =   my_lib::cms_site().'company/showwork/?'.$query_string.'&page=';         
            /*end phan trang*/

            $this->_data['orderby']=$orderby = 'status_work asc,create_date desc,time desc';
            $limit = $paging['start'].','.$paging['per_page'];
            $this->_data['list'] = $this->mcompany_work->getQuery($object="",$join="",$and,$orderby,$limit);
            $this->_data['record'] = $this->mcompany_work->countQuery($join="",$and);
            $this->_data["pagination"] = $this->my_paging->paging_donturl($this->_data["record"],$paging['page'],$paging['per_page'],$paging['num_links'],$paging['base_url']);     

            $this->my_layout->view("cms/company/showwork",$this->_data);
        }
        /**end function lich lamviec*/


        /**begin ajax search autocomplete trang danh sach + tim kiem bai viet trong*/
        public function aj_autoCompleteIndex()
        {
            # code...                
            $key = isset($_REQUEST['key']) && $_REQUEST['key'] ? strtoupper($_REQUEST['key']):'';
            $and='active = 1';
            if($key)
            {
                $and .= ' and (company_name like "%'.$key.'%"';
                $and .= ' or company_address like "%'.$key.'%"';                
                $and .= ' or company_search like "%'.$key.'%"';             
                $and .= ' or phone like "%'.$key.'%"';              
                $and .= ' or website like "%'.$key.'%"';
                $and .= ' or email like "%'.$key.'%")';          
            }
            $object = 'DISTINCT company_name,id,user_id';
            $orderby = 'company_name asc';  
            $result = $this->mcompany->getQuery($object,$join="",$and,$orderby,$limit="0,50");        
            $this->_data = array();
            if($result)
            {
                foreach ($result as $key => $value) {
                    $myUser = $this->muser->getData("user_fullname",array("id"=>$value["user_id"]));
                    $row_array['name'] = $value['company_name'];
                    $row_array['id'] = $value['id'];                                                 
                    $row_array['user'] = $myUser['user_fullname'];                                               
                    array_push($this->_data, $row_array);                        
                }
            }            
            echo json_encode($this->_data);
        }
        /**begin ajax search autocomplete trang danh sach + tim kiem bai viet trong*/


        /**begin ajax cap nhat trang thai trong bang lam viec */
        public function aj_updateStatus()
        {
            $id = isset($_REQUEST['id']) && $_REQUEST['id'] ? $_REQUEST['id']:'';
            $status = isset($_REQUEST['status']) && $_REQUEST['status'] ? $_REQUEST['status']:'';
            if(is_numeric($id)>0 && is_numeric($status)>0)
            {
                if($this->mcompany->edit($id,array("status"=>$status))){
                    return 1; // OK
                }else{
                    return 0 ; // NOT OK
                }
            }
            else{
                return 0;
            }
        }
        /**end ajax cap nhat trang thai trong bang lam viec */

        /**begin ajax cap nhat company_rate {loai khach hang} trong bang lam viec */
        public function aj_updateCompanyRate()
        {
            $id = isset($_REQUEST['id']) && $_REQUEST['id'] ? $_REQUEST['id']:'';
            $company_rate = isset($_REQUEST['company_rate']) && $_REQUEST['company_rate'] ? $_REQUEST['company_rate']:'';
            if(is_numeric($id)>0 && is_numeric($company_rate)>0)
            {
                if($this->mcompany->edit($id,array("company_rate"=>$company_rate))){
                    return 1; // OK
                }else{
                    return 0 ; // NOT OK
                }
            }
            else{
                return 0;
            }
        }
        /**end ajax cap nhat company_rate {loai khach hang} trong bang lam viec */

        /**begin ajax cap nhat trang thai trong bang lam viec */
        public function aj_updateUser()
        {
            $id = isset($_REQUEST['id']) && $_REQUEST['id'] ? $_REQUEST['id']:'';
            $user_id = isset($_REQUEST['user_id']) && $_REQUEST['user_id'] ? $_REQUEST['user_id']:'';
            if(is_numeric($id)>0 && is_numeric($user_id)>0)
            {
                if($this->mcompany->edit($id,array("user_id"=>$user_id))){
                    return 1; // OK
                }else{
                    return 0 ; // NOT OK
                }
            }
            else{
                return 0;
            }
        }

        //Ajax Loại tư vấn
        public function aj_updateTypeConsult()
        {
            $id = isset($_REQUEST['id']) && $_REQUEST['id'] ? $_REQUEST['id']:'';
            $type_consult = isset($_REQUEST['type_consult']) && $_REQUEST['type_consult'] ? $_REQUEST['type_consult']:'';
            if(is_numeric($id)>0 && is_numeric($type_consult)>0)
            {
                if($this->mcompany->edit($id,array("type_consult"=>$type_consult))){
                    return 1; // OK
                }else{
                    return 0 ; // NOT OK
                }
            }
            else{
                return 0;
            }
        }

        //Ajax note
        public function noteAjax()
        {
            $company_id = $this->input->post('company_id');
            $text_note = $this->input->post('text_note');
            $html = '';
            $myCompany = $this->mcompany->getData('note',array("id"=>$company_id));
            if (!empty($myCompany)) {
                if ($myCompany['note'] != "") {
                    $noteNew = $myCompany['note'].'|'.date("Y-m-d").': '.$text_note;
                } else {
                    $noteNew = date("Y-m-d").': '.$text_note;
                }
                if ($this->mcompany->edit($company_id,array("note"=>$noteNew))) {
                    $html = '<li><p class="text-danger">'.date("Y-m-d").': '.$text_note.'</p></li>';
                    echo $html;
                } else {
                    echo "Error! Vui lòng thử lại sau!";
                }
            } else {
                echo "Error! Vui lòng thử lại sau!";
            }
        }

        public function exportExcel()
        {
            $this->muser->checkPermission('company', 'exportExcel');
            require_once(APPPATH.'libraries/php-excel.class.php'); 
            $and = isset($_REQUEST['and']) && $_REQUEST['and'] ? $_REQUEST['and']:'all';
            if ($and != 'all') {
                $list = $this->mcompany->getQuery("id,company_name,company_address,phone,website,email",$join="",$and,"id asc",$limit=""); 
                $data = array(
                    array ('Mã KH', 'Tên KH', 'Địa chỉ', 'SĐT', 'Web','Email')
                );
                if (!empty($list)) {
                    foreach ($list as $key => $value) {
                        array_push($data, array($value['id'],$value['company_name'],$value['company_address'],$value['phone'],$value['website'],$value['email']));
                    }
                }
                $xls = new Excel_XML('UTF-8', false, 'Workflow Management');
                $xls->addArray($data);
                $xls->generateXML('FileExport');
            }
        } 

        public function editCompanyUser()
        {
            $listCompany = $this->mcompany->getQuery($object="",$join="","user_id = 150",$orderby="",$limit="");
            foreach ($listCompany as $key => $value) {
                $dataEdit = array(
                    'user_id' => 157,
                );
                $this->mcompany->edit($value['id'],$dataEdit);
            }
        }

        public function changeStatus()
        {
            $listCompany = $this->mcompany->getQuery($object="",$join="","status = 7",$orderby="",$limit="");
            var_dump($listCompany);
            // foreach ($listCompany as $key => $value) {
            //     $dataEdit = array(
            //         'status' => 1,
            //     );
            //     $this->mcompany->edit($value['id'],$dataEdit);
            // }
        }

        public function deleteTrash()
        {
            $this->muser->checkPermission('company', 'deleteTrash');
            $list = $this->mcompany->getQuery("","","active = 0","","");
            foreach ($list as $key => $value) {
                $this->mcompany->delete($value["id"]);
            }
        }

        //Chuyển người phụ trách

        public function transferCompany($id_sector,$id_user)
        {
        	$this->muser->checkPermission('company', 'transferCompany');
        	$company_sector = $this->mcompany_sector->checkParent($id_sector);
            $and = 'active = 1 and company_sector in ('.$company_sector.')';
        	$list = $this->mcompany->getQuery("id","",$and,"id asc","");
        	if (!empty($list)) {
        		foreach ($list as $key => $value) {
        			$dataEdit = array('user_id' => $id_user);
        			$this->mcompany->edit($value['id'],$dataEdit);
        		}
        	}
        }

        /**end ajax cap nhat trang thai trong bang lam viec */  

        // public function update_search()
        // {
        //  $list = $this->mcompany->getQuery();
        //  if($list){
        //      foreach ($list as $key => $value) {
        //          $aliat =  url_title(convert($value["company_name"]), ' ', TRUE);
        //          $this->mcompany->edit($value["id"],array("company_search"=>$aliat));

        //      }
        //  }
        // }
    }