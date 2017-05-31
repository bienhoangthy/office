
<section id="main" role="main">    
    <div class="container-fluid">        
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?></h4>
            </div>
            <div class="page-header-section">                
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li><a href="<?= my_lib::cms_site()?>company/">Danh sách</a></li>
                        <li class="active"><?= $title?></li>
                    </ol>
                </div>                
            </div>
        </div>        
        <?php
        if(isset($error) && $error ){
            echo '<div class="alert alert-danger">';
                echo '<ul>';
                    echo '<li>'.$error.'</li>';
                echo '</ul>';
            echo '</div>';
        }
        ?> 
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">                
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="ico-quotes-left mr5"></i> Thông tin khách hàng 
                        <?php if ($boss == 1): ?>
                            <?php if ($myCompany['success'] == 1): ?>
                                <a href="<?= my_lib::cms_site().'company/working/'.$myCompany["id"].'/?redirect='.base64_encode(current_url()).'&success=2'?>"><button class="btn btn-default">Hủy thành công</button></a>
                            <?php else: ?>
                                <a href="<?= my_lib::cms_site().'company/working/'.$myCompany["id"].'/?redirect='.base64_encode(current_url()).'&success=1'?>"><button class="btn btn-primary">Thành công</button></a>
                            <?php endif ?>
                        <?php endif ?>
                        <a href="<?= my_lib::cms_site().'company/edit/'.$myCompany["id"].'/?redirect='.base64_encode(current_url())?>" class="pull-right"><button class="btn btn-danger"><i class="ico-pencil6"></i> Cập nhật khách hàng</button></a>
                        </h3>                                                            
                    </div>                
                                    
                    <div class="panel-collapse pull out">
                        <div class="panel-body">
                        <address>
                            <ul>
                                <?php if($myCompany['id']) { ?><li class="col-lg-4"><abbr title="">Mã công ty:</abbr> <?= $myCompany['id']?></li><?php } ?>
                                <?php if($myCompany['company_name']) { ?><li class="col-lg-4"><abbr title="">Tên công ty:</abbr> <?= $myCompany['company_name']?></li><?php } ?>
                                <?php if($myCompany['short_name']) { ?><li class="col-lg-4"><abbr title="">Tên viết tắt:</abbr> <?= $myCompany['short_name']?></li><?php } ?>
                                <?php if($myCompany['company_name_en']) { ?><li class="col-lg-4"><abbr title="">Tên tiếng anh:</abbr> <?= $myCompany['company_name_en']?></li><?php } ?>
                                <?php if($myCompany['company_address']) { ?><li class="col-lg-4"><abbr title="">Địa chỉ:</abbr> <?= $myCompany['company_address']?></li><?php } ?>
                                <?php if($myCompany['phone']) { ?><li class="col-lg-4"><abbr title="">Điện thoại:</abbr> <?= $myCompany['phone']?></li><?php } ?>
                                <?php if($myCompany['fax']) { ?><li class="col-lg-4"><abbr title="">Fax:</abbr> <?= $myCompany['fax']?></li><?php } ?>
                                <?php if($myCompany['website']) { ?><li class="col-lg-4"><abbr title="">Website:</abbr> <?= $myCompany['website']?></li><?php } ?>
                                <?php if($myCompany['email']) { ?><li class="col-lg-4"><abbr title="">Email:</abbr> <?= $myCompany['email']?></li><?php } ?>
                                <?php if($myCompany['tax_code']) { ?><li class="col-lg-4"><abbr title="">Mã số thuế:</abbr> <?= $myCompany['tax_code']?></li><?php } ?>
                                <?php if($myCompany['createdate']) { ?><li class="col-lg-4"><abbr title="">Ngày thành lập:</abbr> <?= $myCompany['createdate']?></li><?php } ?>
                                <?php if($myCompany['owner_name']) { ?><li class="col-lg-4"><abbr title="">Tên tài khoản:</abbr> <?= $myCompany['owner_name']?></li><?php } ?>
                                <?php if($myCompany['account_bank']) { ?><li class="col-lg-4"><abbr title="">Số tài khoản:</abbr> <?= $myCompany['account_bank']?></li><?php } ?>
                                <?php if($myCompany['bank_id']) { ?><li class="col-lg-4"><abbr title="">Ngân hàng:</abbr> <?= $myCompany['bank_id']?></li><?php } ?>

                                <?php if($myCompany['user_id']) { ?><li class="col-lg-4"><abbr class="text-primary"  title="">NV phụ trách:</abbr> 
                                    <select class="se_list input-sm form-control fuser_id" <?= $s_disabled;?> name="fuser_id"  id="fuser_id" data-company-id="<?= $myCompany['id']?>">
                                    <?= $formData['user_id'];?>
                                    </select> 
                                </li><?php } ?>

                                <?php if ($myCompany['success'] == 1): ?>
                                    <?php if($myCompany['status']) { ?><li class="col-lg-4"><abbr class="text-primary" title="">Trình trạng làm việc:</abbr> 
                                        <select class="se_list input-sm form-control fstatusWorking" disabled="disabled" name="fstatusWorking" id="fstatusWorking" data-company-id="<?= $myCompany['id']?>">
                                        <?= $formData['status'];?>
                                        </select> 
                                    </li><?php } ?>
                                <?php else: ?>
                                    <?php if($myCompany['status']) { ?><li class="col-lg-4"><abbr class="text-primary" title="">Trình trạng làm việc:</abbr> 
                                        <select class="se_list input-sm form-control fstatusWorking" name="fstatusWorking" id="fstatusWorking" data-company-id="<?= $myCompany['id']?>">
                                        <?= $formData['status'];?>
                                        </select> 
                                    </li><?php } ?>
                                <?php endif ?>

                                <?php if($myCompany['company_rate']) { ?><li class="col-lg-4"><abbr class="text-primary" title="">Loại khách hàng:</abbr> 
                                    <select class="se_list input-sm form-control fcompanyrateWorking" name="fcompanyrateWorking" id="fcompanyrateWorking" data-company-id="<?= $myCompany['id']?>">
                                    <?= $formData['company_rate'];?>
                                    </select> 
                                </li><?php } ?>

                                <?php if($myCompany['company_type']) { ?><li class="col-lg-4"><abbr title="">Hình thức liên hệ:</abbr> <?= $myCompany['company_type']?></li><?php } ?>                                
                                <?php if($myCompany['adv_budget']) { ?><li class="col-lg-4"><abbr title="">Ngân sách quảng cáo:</abbr> <?= $myCompany['adv_budget']?></li><?php } ?>
                                <?php if($myCompany['company_scale']) { ?><li class="col-lg-4"><abbr title="">Quy mô khách hàng:</abbr> <?= $myCompany['company_scale']?></li><?php } ?>
                                <?php if($myCompany['business_type']) { ?><li class="col-lg-4"><abbr title="">Loại công ty:</abbr> <?= $myCompany['business_type']?></li><?php } ?>
                                <?php if($myCompany['company_sector']) { ?><li class="col-lg-4"><abbr title="">Linh vực kinh doanh:</abbr> <?= $myCompany['company_sector']?></li><?php } ?>
                                <li class="col-lg-4 mt10"><abbr class="text-primary"  title="">Loại tư vấn:</abbr> 
                                    <select class="se_list input-sm form-control ftype_consult" name="ftype_consult"  id="ftype_consult" data-company-id="<?= $myCompany['id']?>">
                                    <?= $formData['type_consult'];?>
                                    </select> 
                                </li>
                                <li class="col-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><i class="ico-quotes-left mr5"></i> Ghi chú</h3>
                                                    <div class="panel-toolbar text-right">
                                                        <div class="option">
                                                            <button class="btn" data-toggle="panelremove" data-parent=".col-md-4"><i class="remove"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-collapse pull out">
                                                    <div class="panel-body">
                                                        <?php if ($myCompany['note'] != ""): ?>
                                                            <?php $noteContent = explode("|", $myCompany['note']); ?>
                                                            <?php if (!empty($noteContent)): ?>
                                                                <ul id="note-content" style="list-style: none;">
                                                                    <?php foreach ($noteContent as $key => $value): ?>
                                                                        <?php if ($value != ""): ?>
                                                                            <li><p class="text-danger"><?= $value?></p></li>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </ul>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="indicator"><span class="spinner"></span></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group mt10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="text_note" id="text_note" placeholder="Thêm ghi chú">
                                            <span class="input-group-btn">
                                                <button class="btn btn-teal" id="add-note" type="button">Thêm</button>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        </address>
                    </div>                
                
                    <div class="indicator"><span class="spinner"></span></div>                
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">                   
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Thông tin người liên hệ</h3>                                        
                        <!-- panel toolbar -->
                        <div class="panel-toolbar text-right">
                            <a class="btn btn-default btn-sm addInfoContactPopup"  data-toggle="modal" data-target="#addInfoContactPopup"><i class="ico-plus"></i>  Thêm mới</a>
                        </div>
                        <!--/ panel toolbar -->
                    </div>
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>                             
                                <tr>                                            
                                    <th width="3%" class="text-center">ID</th>                                                                         
                                    <th class="text-center">Nhân xưng</th>                                                                           
                                    <th>Người liên hệ</th>                                                                           
                                    <th class="text-center" width="15%">Điện thoại</th>                                                                           
                                    <th class="text-center">Email</th>                                                                           
                                    <th class="text-center">Chức vụ</th>                                                                           
                                    <th>Nội dung</th> 
                                    <th class="text-center" width="20px"></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($listInfoContact) && $listInfoContact){
                                    $i=1;
                                    foreach ($listInfoContact as $key => $value) {
                                        # code...    
                                        $link_update = my_lib::cms_site().'infocontact/edit/'.$value["id"].'/?type=working&redirect='.base64_encode(current_url());                              
                                        $tmpNamcall = $this->minfocontact->listNhanXung($value['contact_name_call']);                                        
                                        echo '<tr class="check_phone_'.$value["id"].'" data-contact-name="'.$value["contact_name"].'" data-contact-phone="'.$value["contact_phone"].'">';
                                        $value['contact_name_call'] = $tmpNamcall['name'];                                           
                                        echo '<td class="text-center">'.$value["id"].'</td>';                                               
                                        echo '<td class="text-center">'.$value["contact_name_call"].'</td>';                                                    
                                        echo '<td class="text-center">'.$value["contact_name"].'</td>';
                                        echo '<td class="text-center">'.$value["contact_phone"].'</td>';                                                    
                                        echo '<td class="text-center">'.$value["contact_email"].'</td>';                                                    
                                        echo '<td class="text-center">'.$value["contact_position"].'</td>';                                                    
                                        echo '<td>'.$value["contact_note"].'</td>';                                                                                            
                                        echo '<td class="text-center"><a href="'.$link_update.'" class="btn btn-default btn-xs"><i class="icon ico-pencil"></i></a></td>';                                                                                            
                                        echo '</tr>';                                                
                                        $i++;
                                    }
                                }
                                ?>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php if ($myCompany['success'] == 1): ?>
                <div class="col-md-12">
                    <div class="panel panel-danger">                   
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-profile"></i></span> Hợp đồng</h3>                                        
                            <!-- panel toolbar -->
                            <div class="panel-toolbar text-right">
                                <a class="btn btn-default btn-sm addInfoContactPopup"  data-toggle="modal" data-target="#addInfoServicePopup"><i class="ico-plus"></i>  Thêm mới</a>
                            </div>
                            <!--/ panel toolbar -->
                        </div>
                        <div class="table-responsive panel-collapse pull out">
                            <table class="table table-bordered table-hover" id="table1">
                                <thead>                             
                                    <tr>                                            
                                        <th width="3%" class="text-center">ID</th>                                                                                                             
                                        <th>Code</th>                                                                           
                                        <th>Tên miền</th>                                                                           
                                        <th class="text-center">Loại dịch vụ</th>                                                                           
                                        <th class="text-center">Gói dịch vụ</th>                                                                           
                                        <th class="text-center">Trạng thái</th>  

                                        <th class="text-center">Ngày đăng ký</th>                          
                                        <th class="text-center">Ngày hết hạn</th>                          
                                        <th class="text-center">Hành động</th>                          
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listInfoService)): ?>
                                        <?php foreach ($listInfoService as $key => $value): ?>
                                            <?php 
                                                $name_type_service = '';
                                                $name_package_service = '';
                                                $object = 'service_name';
                                                $object1 = 'service_name';
                                                $and_type = 'id = '.$value["service_type"];
                                                $and_package = 'id = '.$value["service_package"];
                                                $type_service = $this->mservice->getData($object,$and_type);
                                                $package_service = $this->mservice->getData($object1,$and_package);
                                                if (!empty($type_service)) {
                                                    $name_type_service = $type_service['service_name'];
                                                }
                                                if (!empty($package_service)) {
                                                    $name_package_service = word_limiter($package_service['service_name'], 3);
                                                }
                                                $day="";
                                                $date_now = date('Y-m-d');
                                                $day = (strtotime($value['service_end']) - strtotime($date_now)) / (60 * 60 * 24);
                                                $link_detail = my_lib::cms_site().'infoservice/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());                              
                                                $link_update = my_lib::cms_site().'infoservice/edit/'.$value["id"].'/?type=working&redirect='.base64_encode(current_url());                              
                                                $link_delete = my_lib::cms_site().'infoservice/delete/'.$value["id"].'/?type=working&redirect='.base64_encode(current_url());                              
                                                $status = $this->minfoservice->listStatus($value['service_status']);
                                             ?>
                                             <tr>
                                                 <td class="text-center"><?= $value['id']?></td>
                                                 <td><?= $value['service_code']?></td>
                                                 <td><?= $value['service_domain']?></td>
                                                 <td class="text-center"><?= $name_type_service?></td>
                                                 <td class="text-center"><?= $name_package_service?></td>
                                                 <td class="text-center"><span class="label label-<?= $status['color']?>"><?= $status['name']?></span></td>
                                                 <td class="text-center"><?= $value['service_start']?></td>
                                                 <td class="text-center"><?= $value['service_end']?><span class="label label-teal pull-right"><?= $day?></span></td>
                                                 <td class="text-center"><a href="<?= $link_detail?>" title="Detail" class="btn btn-teal btn-xs"><i class="icon ico-folder-open4"></i></a>
                                                 <a href="<?= $link_update?>" title="Edit" class="btn btn-default btn-xs"><i class="icon ico-pencil"></i></a> 
                                                 <a href="<?= $link_delete?>" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-xs"><i class="icon ico-trash"></i></a>
                                                 </td>
                                             </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>     
            <?php endif ?>        
            <div class="col-md-12">                        
                <ul class="timeline">
                    <li class="header">                                
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        Ngày
                                        <input type="text" class="form-control datepicker" id="fcreate_date" name="fcreate_date" value="<?= date("Y-m-d")?>" placeholder="Ngày" />
                                    </div>
                                </div> 
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        Thời gian
                                        <input type="text" class="form-control" id="ftime" name="ftime" value="<?= date("H:i")?>" placeholder="Thời gian" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        Người liên hệ
                                        <select class="form-control finfocontactid" name="finfocontactid" id="finfocontactid" required="required">
                                        <?= $dropdownlistInfo;?>
                                        </select>  
                                    </div>
                                </div> 
                                 <div class="col-lg-2">
                                    <div class="form-group">
                                        Số điện thoại
                                        <input type="text" class="form-control" id="fphone" name="fphone"  required="required" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        Trạng thái
                                        <select class="form-control fstatus" name="fstatus"  id="fstatus" required="required">
                                        <?= $fcompany_working_status;?>
                                        </select>  

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        Nhân viên liên hệ
                                        <input type="text" class="form-control" id="femployee_name" name="femployee_name" value="<?= $s_info['s_user_fullname']?>" readonly="readonly" placeholder="Nhận viên liên hệ" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                         <textarea class="form-control" rows="3" name="fcontact_content" id="fcontact_content" placeholder="Ghi chú"></textarea>
                                    </div>
                                </div> 
                            </div>
                           
                            <div class="panel-footer">
                                <div class="panel-toolbar-wrapper">
                                    <div class="panel-toolbar text-center">  
                                        <input type="hidden" id="hdfinfocontactid">                                                                              
                                        <input type="hidden" id="hdfstatus">                                                                              
                                        <button type="submit" class="btn  btn-primary fSaveAj" data-style="expand-left"><i class="ico-save"></i> <span class="ladda-spinner"></span> Lưu hành động</button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </li>     
                    <li class="wrapper">      
                        <ul class="events ajPrepend">             
                    <?php                                    
                    if(isset($listCompanyWork) && $listCompanyWork)
                    {                        
                        foreach ($listCompanyWork as $key => $value) {
                            $myComWokStatus = $this->mcompany_work_status->getData(array('wk_name','wk_bg','wk_color','wk_icon'),array("id"=>$value['status']));
                            $myInfoContact = $this->minfocontact->getData('',array("id"=>$value["infocontact_id"]));
                            $myUser = $this->muser->getData(array('user_avatar'),array("id"=>$value['user']));
                            $avatar = isset($myUser['user_avatar']) && $myUser['user_avatar'] ? my_lib::base_url().'media/user/'.$myUser['user_avatar']:my_lib::cms_img().'no_avatar.gif';

                            $tmpDate = $value['create_date'];
                            
                            echo '<li class="wrapper">';
                                echo '<div class=" year date_work">'.date("D, d-m-Y",strtotime($value["create_date"])).'</div>';
                                echo '<div class="panel">';
                                    echo '<div class="panel-body">';
                                        echo '<ul class="list-table">';
                                            echo '<li class="text-left" style="width:60px;">';
                                                echo '<img class="img-circle" src="'.$avatar.'" alt="" width="50px" height="50px">';
                                            echo '</li>';
                                            echo '<li class="text-left">';
                                                echo '<p class="mb5"><span class="semibold text-accent semibold nm">'.$value["employee_name"].'</span> <i class="ico-clock7"></i> '.date("H:i",strtotime($value["time"]));
                                                echo ' <label class="label" style="background:'.$myComWokStatus['wk_bg'].'; color:'.$myComWokStatus['wk_color'].'"><i class="'.$myComWokStatus['wk_icon'].'"></i> '.$myComWokStatus['wk_name'].'</label>';
                                                echo '</p>';                                                
                                                echo '<div>'.$value["contact_content"].'</div>';
                                            echo '</li>';
                                        echo '</ul>';
                                    echo '</div>';
                                    echo '<div class="panel-footer">';
                                        if($myInfoContact['contact_name'])
                                            echo '<span class="col-lg-5">- Người liên hệ: '.$myInfoContact['contact_name'].'</span>';
                                        if($myInfoContact['contact_phone'])
                                            echo '<span class="col-lg-7">- Điện thoại: '.$myInfoContact['contact_phone'].'</span>';
                                        if($myInfoContact['contact_position'])
                                            echo '<span class="col-lg-5">- Chức vụ: '.$myInfoContact['contact_position'].'</span>';
                                        if($myInfoContact['contact_email'])
                                            echo '<span class="col-lg-7">- Email: '.$myInfoContact['contact_email'].'</span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</li>';                            
                        }                    
                    }
                    ?>
                        </ul>
                    </li>                                                                                            
                </ul>                        
            </div>                    
        </div>                        
    </div>        
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>    
</section>

<!--begin addInfoContactPopup-->

<div id="addInfoContactPopup" class="modal fade">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= my_lib::cms_site()?>infocontact/popup/" method="post">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="semibold modal-title text-primary"><i class="ico-feed2"></i>
                Thêm mới người liên hệ</h4>                        
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="row">                          
                            <div class="col-sm-3">
                                <label class="control-label">Nhân xưng</label>
                                <select name="contact_name_call" class="form-control input-sm">
                                    <?= $this->minfocontact->dropdownlistNhanXung()?>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">  
                                    <label class="control-label">Họ tên<span class="text-danger">*</span></label>
                                    <input name="contact_name" type="text" autocomplete="off" class="form-control input-sm" required="required" >
                                </div>
                            </div>
                        </div>                                                           
                    </div>        
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Chức vụ</label>
                            <input name="contact_position" type="text" class="form-control input-sm" >
                        </div>
                    </div>  
                    <div class="clr"></div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Điện thoại<span class="text-danger">*</span></label>
                            <input name="contact_phone" type="text" class="form-control input-sm" required="required" >
                        </div>
                    </div>                                                       
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input name="contact_email" type="email" class="form-control input-sm"  >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <textarea name="contact_note" class="form-control" rows="8" placeholder=""></textarea>
                        </div>
                    </div>                            
                   
                </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="company_id" value="<?= $myCompany["id"]?>">
            <input type="hidden" name="redirect" value="<?= base64_encode(current_url())?>">
            <input type="hidden" id="tmpDate" value="<?= date("Y-m-").date("d")-1; ?>">
                <button type="submit" name="fsubmit" class="btn btn-success"><i class="ico-save"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end addInfoContactPopup-->
<!--begin addInfoServicePopup-->
<div id="addInfoServicePopup" class="modal fade">
    <div class="modal-dialog">
        <form class="modal-content" enctype="multipart/form-data" action="<?= my_lib::cms_site()?>infoservice/popup/" method="post">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="semibold modal-title text-primary"><i class="ico-feed2"></i>
                Thêm mới hợp đồng</h4>                        
            </div>
            <div class="modal-body">
                <div class="row">        
                    <!-- <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Mã hợp đồng<span class="text-danger">*</span></label>
                            <input name="service_code" type="text" placeholder="HD0153" class="form-control input-sm" required="required">
                        </div>
                    </div>  --> 
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Tên miền quản lý<span class="text-danger">*</span></label>
                            <input name="service_domain" type="text" class="form-control input-sm" required="required">
                        </div>
                    </div>  
                    <div class="clr"></div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Email đăng ký<span class="text-danger">*</span></label>
                            <input name="service_email" type="text" class="form-control input-sm" >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">User Server</label>
                            <input name="service_userser" type="text" class="form-control input-sm" required="required" >
                        </div>
                    </div>
                    <div class="col-md-12"> 
                        <div class="row">                          
                            <div class="col-sm-6">
                                <label class="control-label">Loại dịch vụ</label>
                                <select name="service_type" id="service_type" class="form-control input-sm">
                                    <?= $this->minfoservice->dropdownlistType()?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">  
                                    <label class="control-label">Gói dịch vụ</label>
                                    <select name="service_package" id="service_package" class="form-control input-sm">
                                    <option>-- Chọn gói dịch vụ --</option>
                                </select>
                                </div>
                            </div>
                        </div>                                                           
                    </div>
                    <div class="col-md-12"> 
                        <div class="row">                          
                            <div class="col-sm-6">
                                <label class="control-label">Ngày đăng ký</label>
                                <input type="text" class="form-control datepicker" id="service_start" name="service_start" value="<?= date("Y-m-d")?>" placeholder="Ngày" />
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">  
                                    <label class="control-label">Ngày hết hạn</label>
                                    <input type="text" class="form-control datepicker" id="service_end" name="service_end" value="<?= date("Y-m-d")?>" placeholder="Ngày" />
                                </select>
                                </div>
                            </div>
                        </div>                                                           
                    </div>
                    <!-- <div class="col-md-12"> 
                        <div class="row">                          
                            <div class="col-sm-6">
                                <label class="control-label">Trạng thái</label>
                                <select name="service_status" class="form-control input-sm">
                                    <?= $this->minfoservice->dropdownlistStatus(2)?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">  
                                    <label class="control-label">Phí dịch vụ</label>
                                    <input name="service_price" id="service_price" type="text" class="form-control input-sm" required="required" >
                                </select>
                                </div>
                            </div>
                        </div>                                                           
                    </div>  -->  
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">  
                                    <label class="control-label">Phí hợp đồng<span class="text-danger">*</span></label>
                                    <input name="service_pay_sign" id="service_pay_sign" min="0" type="number" class="form-control input-sm" required="required" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">  
                                    <label class="control-label">Đã thanh toán</label>
                                    <input name="service_pay_perform" id="service_pay_perform" min="0" type="number" class="form-control input-sm" >
                                </div>
                            </div>
                        </div>
                    </div>                                                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Nơi đăng ký</label>
                            <input name="service_place" type="text" class="form-control input-sm" >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Ghi chú</label>
                            <textarea name="service_note" class="form-control" placeholder="Note..."></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">File đính kèm</label>
                            <input type="file" class="form-control" name="service_file[]" id="service_file" multiple="multiple" >
                        </div>
                    </div>                            
                   
                </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="company_id" value="<?= $myCompany["id"]?>">
            <input type="hidden" name="redirect" value="<?= base64_encode(current_url())?>">
                <button type="submit" name="servicesubmit" class="btn btn-success"><i class="ico-save"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--end addInfoServicePopup-->
<script type="text/javascript" src="<?= my_lib::cms_js()?>jqueryui/js/jquery-ui-timepicker-addon.js"></script>
<link type="text/css" rel="stylesheet" href="<?= my_lib::cms_js()?>jqueryui/css/jquery-ui-timepicker-addon.css" media="screen" />
<script>
$(function () {
    $("#fcreate_date").datepicker({minDate: -1,dateFormat: 'yy-mm-dd' });
    $('#ftime').timepicker();    
});
$(document).ready(function(){
    $("#service_type").on('change', function(){
        var id = this.value;
        var url = '<?= my_lib::cms_site()."service/getAjax"?>';
        $.ajax({
            type: 'post',
            data: {"id":id},
            cache: false,
            url: url,
            success: function(rs) {
                $("#service_package").empty();
                $("#service_package").append(rs);
            }
        });
    });

    $("#service_package").on('change', function(){
        var id = this.value;
        var url = '<?= my_lib::cms_site()."service/getPriceAjax"?>';
        $.ajax({
            type: 'post',
            data: {"id":id},
            cache: false,
            url: url,
            success: function(rs) {
                $("#service_pay_sign").val(rs);
            }
        });
    });

    $("#add-note").click(function(){
        var text_note = $("#text_note").val();
        var company_id = <?= $myCompany['id']?>;
        var url = '<?= my_lib::cms_site()."company/noteAjax"?>';
        if (text_note == "") {
            alert("Vui lòng nhập ghi chú!");
        } else {
            $.ajax({
                type: 'post',
                data: {"company_id":company_id,"text_note":text_note},
                cache: false,
                url: url,
                success: function(rs) {
                    $("#note-content").append(rs);
                    $("#text_note").val('');
                }
            });
        }
    });

    //Loại tư vấn
    $("#ftype_consult").on("change",function(){
        var _valTypeConsult = $(this).val();
        var _valIDCompany = $(this).attr("data-company-id");
        if(_valTypeConsult && _valIDCompany)
        {
            dataString = 'type_consult='+_valTypeConsult+'&id='+_valIDCompany;
            $.ajax({
                url:configs.cms_site+'company/aj_updateTypeConsult/',
                dataType: "json",
                data: dataString,
                 success: function( data ) {                    
                    alert("Đã cập nhật loại tư vấn!");
                }
            });
        }
    })
    //End
});


</script>