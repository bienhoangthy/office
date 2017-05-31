
<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?>
                <span class="badge badge-teal"><?= $record?></span></h4>
                <a href="javascript:void(0)" id="report"><button class="btn btn-primary"><i class="ico-bar-chart"></i> Thống kê</button></a>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active">Danh sách dịch vụ</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- START row -->
        <div class="row">
            <div class="col-md-12" id="content-report">
            </div>
            <div class="col-md-12">
                <div class="panel panel-teal">
                    <!-- panel heading/header -->
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Danh sách <span class="label label-danger"><?= $textFilter?></span></h3>
                        <!-- panel toolbar -->
                        <div class="panel-toolbar text-right">
                            <!-- option -->
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                            </div>
                        </div>
                    </div>

                    <!--begin form tim kiem-->
                    <form method="get" action="<?= my_lib::cms_site()?>infoservice/" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" title="Từ khóa: mã công ty, mã hợp đồng, tên miền đăng ký, email, giá dịch vụ, nơi đăng ký" placeholder="Từ khóa: mã công ty, mã hợp đồng, tên miền đăng ký, email, giá dịch vụ, nơi đăng ký">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fstatus" name="fstatus">                                            
                                    <?= $fstatus;?>
                                    </select>  
                                </div> 
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control ftype" name="ftype">                                            
                                    <?= $ftype;?>
                                    </select>  
                                </div> 
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fuser" name="fuser">                                            
                                    <?= $fuser;?>
                                    </select>  
                                </div>  
                                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">                                         
                                     <div class="input-group">
                                        <input type="number" value="<?= $formData['ftime']?>" name="ftime" min="1" class="form-control">
                                        <div class="input-group-btn">
                                            <select class="btn btn-teal dropdown-toggle" name="ftypeTime" data-toggle="dropdown">
                                                <ul class="dropdown-menu pull-right">
                                                    <?= $ftypeTime?>
                                                </ul>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1">                                         
                                    <select onchange="this.form.submit()" class="form-control fyear" name="fyear">                                            
                                    <?= $fyear;?>
                                    </select>  
                                </div>  
                                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-1">                                         
                                    <select onchange="this.form.submit()" class="form-control fview" name="fview">             
                                        <option value="">View</o1ption>
                                        <option value="1">Thông tin</option>
                                        <option value="2">Doanh số</option>
                                    </select>  
                                </div>              
                                <input type="hidden" name="page" value="<?= $page?>">
                            </div>                                        
                        </div>
                        <!--end form tim kiem-->
                   
                        <!-- panel body with collapse capabale -->
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th colspan="12">
                                        
                                        <div class="pull-right">
                                            <ul class="pagination pagination-sm mt0">
                                            <li class="limit_form">
                                                <label>Show: </label>
                                                <select name="fperpage" onchange="this.form.submit()" class="form-control input-sm ">
                                                    <?php
                                                    for ($i=1; $i <= 10 ; $i++) { 
                                                        $show = $i*10;
                                                        $selected = $show==$formData['fperpage'] ? 'selected':'';
                                                        echo '<option '.$selected.' value="'.$show.'">'.$show.'</option>';
                                                    }
                                                    ?>
                                                    option
                                                </select>
                                            </li>
                                            <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                        </div>
                                        </form>
                                        <form method="post" action="<?= my_lib::cms_site()?>infoservice/" id="flistData">
                                        <?php if ($boss == 1): ?>
                                            <div class="checkbox custom-checkbox pull-left">  
                                                <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                                <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                                <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                            </div>
                                        <?php endif ?>
                                        <div class="pull-left" style="margin-left:5px;">
                                            <?php if ($s_info['s_user_group'] == 1 || $s_info['s_user_group'] == 5): ?>
                                                <!-- <a href="<?= my_lib::cms_site()?>infoservice/set_status"><button type="button" class="btn btn-sm btn-success"><i class="ico-spinner10"></i> Cập nhật trạng thái</button></a> -->
                                            <?php endif ?>                                            
                                            <!-- <a class="btn btn-sm  btn-success"><i class="ico-file-excel"></i> Import khách hàng</a>
                                            <a class="btn btn-sm btn-info"><i class="ico-history"></i> Chuyển khách hàng</a> -->
                                            <!-- <a href="<?= my_lib::cms_site()?>company/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Thêm mới</a> -->                                          
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                                                        
                                    <th class="css_id">Mã HĐ</th>                                                                        
                                    <th class="css_id">Mã KH</th>                                                                        
                                    <th class="text-center">Tên công ty</th>                                                                        
                                    <th class="text-center">Loại dịch vụ</th>                                                                        
                                    <th class="text-center">Gói dịch vụ</th>                                                                        
                                    <th class="text-center">Thời hạn</th>                                                                        
                                    <th class="text-center">Ngày ĐK</th>                                                                        
                                    <th class="text-center">Ngày hết hạn</th>                                                                        
                                    <th class="text-center">Trạng thái</th>                                                                        
                                    <th class="text-center">NV phụ trách</th>                                                                        
                                    <th width="90" class="text-center">Xem chi tiết</th>                                                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($list)): ?>
                                    <?php $j=0; ?>
                                    <?php foreach ($list as $key => $value): ?>
                                        <?php 
                                            $name_type_service = '';
                                            $name_package_service = '';
                                            $object = 'service_name';
                                            $object1 = 'service_name,service_price';
                                            $and_type = 'id = '.$value["service_type"];
                                            $and_package = 'id = '.$value["service_package"];
                                            $type_service = $this->mservice->getData($object,$and_type);
                                            $package_service = $this->mservice->getData($object1,$and_package);
                                            if (!empty($type_service)) {
                                                $name_type_service = $type_service['service_name'];
                                            }
                                            if (!empty($package_service)) {
                                                //$name_package_service = $package_service['service_name'].' ('.number_format($package_service['service_price'],0,',','.').')';
                                                $name_package_service = word_limiter($package_service['service_name'], 3);
                                            }  
                                            $myUser = $this->muser->getData("",array("id"=>$value['user']));
                                            $user_fullname = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';
                                            $day="";
                                            $date_now = date('Y-m-d');
                                            $day = (strtotime($value['service_end']) - strtotime($date_now)) / (60 * 60 * 24);
                                            $myCompany = $this->mcompany->getData(array('id','company_name'),array("id"=>$value['company_id'])); 
                                            $link_detail = my_lib::cms_site().'infoservice/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                            //$link_update = my_lib::cms_site().'infoservice/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                            //$link_delete = my_lib::cms_site().'infoservice/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                            $link_working = my_lib::cms_site().'company/working/'.$value["company_id"].'/?redirect='.base64_encode(current_url());
                                            $through = $value['service_status'] == 5 ? ' style="text-decoration: line-through;"': '';
                                            $status = $this->minfoservice->listStatus($value['service_status']);
                                            $j++;
                                         ?>
                                         <tr>
                                             <td>
                                                 <div class="checkbox custom-checkbox nm">
                                                     <input type="checkbox" id="customcheckbox-one<?= $j?>" value="<?= $value["id"]?>" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">
                                                     <label for="customcheckbox-one<?= $j?>"></label>
                                                 </div>
                                             </td>
                                             <td class="text-center" <?= $through?>><?= $value["service_code"]?></td>
                                             <td class="text-center" width="6%"><?= $myCompany["id"]?></td>
                                             <!-- <td class="text-center"><a href="<?= $link_working?>"><?= $myCompany["id"]?></a></td> -->
                                             <td class="text-center"><a href="<?= $link_working?>"><?= word_limiter($myCompany["company_name"], 5);?></a><br><?= word_limiter($value['service_domain'], 5);?></td>
                                             <td class="text-center"><?= $name_type_service?></td>
                                             <td class="text-center"><?= $name_package_service?></td>
                                             <?php if ($day>0): ?>
                                                 <td class="text-center"><span class="label label-primary"><?= $day?></span></td>
                                             <?php else: ?>
                                                 <td class="text-center"><span class="label label-inverse"><?= $day?></span></td>
                                             <?php endif ?>
                                             <td class="text-center"><?= $value['service_start']?></td>
                                             <td class="text-center"><?= $value['service_end']?></td>
                                             <td class="text-center"><span class="label label-<?= $status['color']?>"><?= $status['name']?></span></td>
                                             <td class="text-center"><?= $user_fullname?></td>
                                             <td class="text-center"><a href="<?= $link_detail?>" title="Detail"><i class="ico-folder-open4" style="color: #82c03e;"></i></a></td>
                                         </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                        </form>
                    </div>
                    <!--/ panel body with collapse capabale -->
                </div>
            </div>
        </div>
        <!--/ END row -->                        
    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<!--/ END Template Main-->
<script>
$(document).ready(function(){
    $("#report").click(function (){
        var and = '<?= $condition?>';
        var url = '<?= my_lib::cms_site()."infoservice/reportAjax"?>';
        $.ajax({
            type: 'post',
            data: {"and":and},
            cache: false,
            url: url,
            success: function(rs) {
                $("#content-report").empty();
                $("#content-report").append(rs);
            }
        });
    });
});
</script>
