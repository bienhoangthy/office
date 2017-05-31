<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?>
                <span class="badge badge-teal"><?= $record?></span>
                <div class="btn-group" style="margin-bottom:5px;">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Dịch vụ đăng ký <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <?php if (!empty($listService)): ?>
                            <?php foreach ($listService as $key => $value): ?>
                                <li><a href="<?= my_lib::cms_site().'company/filter/'.$value['id']?>"><?= $value['service_name']?></a></li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </div>
                </h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active">Danh sách khách hàng</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- START row -->
        <div class="row">
        
            <div class="col-md-12">
                <!--begin masseage-->
                <?php if(isset($error) && $error) { 
                    echo '<div class="alert alert-danger">';
                        echo '<ul>';
                        foreach ($error as $key => $value) {
                            # code...
                            echo '<li>'.$value.'</li>';
                        }
                        echo '</ul>';
                    echo '</div>';
                 } ?>
                <!--end masseage-->

                <!-- START panel -->
                <div class="panel panel-primary">
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
                            <!--/ option -->
                        </div>
                        <!--/ panel toolbar -->
                    </div>
                    <!--/ panel heading/header -->
                    <!-- panel toolbar wrapper -->
                    
                    <!--/ panel toolbar wrapper -->

                    <!--begin form tim kiem-->
                    <?php 
                        $action = my_lib::cms_site() . 'company/';
                        $margin = 'mt10';
                        if (isset($filter) && $filter == 1) {
                            $action = my_lib::cms_site() . 'company/filter/'.$idService;
                            $margin = '';
                        }
                     ?>
                    <form method="get" action="<?= $action?>" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: tên công ty, địa chỉ, số điện thoại, email">
                                </div>
                                <?php if (!isset($filter) && $filter != 1): ?>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                        <select onchange="this.form.submit()" class="form-control fsuccess" name="fsuccess">                                            
                                            <?= $fsuccess?>
                                        </select>  
                                    </div> 
                                    <?php if ($formData['fsuccess'] == 1): ?>
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                            <select disabled="disabled" class="form-control fstatus" name="fstatus">                                            
                                            <?= $fstatus;?>
                                            </select>  
                                        </div>
                                    <?php else: ?>
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                            <select onchange="this.form.submit()" class="form-control fstatus" name="fstatus">                                            
                                            <?= $fstatus;?>
                                            </select>  
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fcompany_rate" name="fcompany_rate">                                            
                                    <?= $fcompany_rate;?>
                                    </select>  
                                </div> 
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">                                         
                                    <select onchange="this.form.submit()"  class="form-control fcompany_sector" name="fcompany_sector" placeholder="Select a person..." required="required">
                                    <?= $fcompany_sector;?>
                                    </select>  
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fuserid" name="fuserid" >                                           
                                    <?= $fuserid;?>
                                    </select>  
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2 <?= $margin?>">                                         
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
                                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-2 <?= $margin?>">                                         
                                    <select onchange="this.form.submit()" class="form-control fyear" name="fyear">                                            
                                    <?= $fyear;?>
                                    </select>  
                                </div> 
                                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-2 <?= $margin?>">
                                    <div class="input-group">
                                        <input type="text" name="fid" class="form-control" placeholder="Nhập mã KH">
                                        <span class="input-group-btn">
                                            <button class="btn btn-teal" type="submit">Search</button>
                                        </span>
                                    </div>
                                </div>                                    
                                <input type="hidden" name="page" value="<?= $page?>">
                            </div>                                        
                        </div>
                        <!--end form tim kiem-->
                   
                        <!-- panel body with collapse capabale -->
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th colspan="10">
                                        
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
                                        <form method="post" action="<?= my_lib::cms_site()?>company/" id="flistData">
                                        <div class="checkbox custom-checkbox pull-left">  
                                            <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                            <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                            <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                        </div>
                                        <div class="pull-left" style="margin-left:5px;">                                            
                                            <!-- <a class="btn btn-sm  btn-success"><i class="ico-file-excel"></i> Import khách hàng</a>
                                            <a class="btn btn-sm btn-info"><i class="ico-history"></i> Chuyển khách hàng</a> -->
                                            <a href="<?= my_lib::cms_site()?>company/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Thêm mới</a>
                                            <?php if ($boss == 1): ?>
                                                <a href="<?= my_lib::cms_site()?>company/exportExcel/?and=<?= $and?>" class="btn btn-sm btn-teal"><i class="ico-file-excel"></i> Xuất file Excel</a>
                                            <?php endif ?>
                                            <!-- <a href="<?= my_lib::cms_site()?>company/?fsuccess=1" class="btn btn-sm btn-success"><i class="ico-list-alt"></i> Danh sách khách hàng thành công</a>   -->                                        
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                            
                                    <th width="6%">Mã KH</th>                                                                        
                                    <th width="200px">Tên</th>                                                                        
                                    <th width="200px">Địa chỉ</th>                                                                        
                                    <th width="100px">Lĩnh vực</th>                                                                        
                                    <th width="100px">Điện thoại</th>                                                                        
                                    <!-- <th>Email</th>                                                                         -->
                                    <th width="130px" class="text-center" width="15%">Trạng thái</th>                                                                           
                                    <th width="150px" class="text-center">NV phụ trách</th>                                                                                                                       
                                    <th width="150px" class="text-center">Loại KH</th>                                                                                                                       
                                </tr>
                            </thead>
                            <tbody>
                                

                                <?php 
                                if(isset($list) && $list){
                                    $i=1;
                                    foreach ($list as $key => $value) {
                                        # code... 
                                        $myUser = $this->muser->getData("",array("id"=>$value['user_id']));
                                        $value['user_id'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';

                                        $myUser = $this->muser->getData("",array("id"=>$value['user_typing']));
                                        $value['user_typing'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';

                                        $tmpStatus = $this->mcompany_status->getData(array("cst_name","cst_note"),array("id"=>$value["status"]));
                                        $value["status"] = $tmpStatus ? '<small class="label" style="background:'.$tmpStatus["cst_note"].'">'.$tmpStatus["cst_name"].'</small>':'';

                                        $tmpSector = $this->mcompany_sector->getData(array("sector_name"),array("id"=>$value["company_sector"]));
                                        $value["company_sector"] = $tmpSector ? $tmpSector["sector_name"] :'';
                                        
                                        $tmpRate = $this->mcompany_rate->getData(array("rate_name","rate_color"),array("id"=>$value["company_rate"]));
                                        $value["company_rate"] = $tmpRate ? $tmpRate["rate_name"] :'';

                                        $link_update = my_lib::cms_site().'company/edit/'.$value["id"].'/?page='.$page;
                                        $link_working = my_lib::cms_site().'company/working/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        $link_delete = my_lib::cms_site().'company/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        echo '<tr>';
                                            echo '<td>';
                                                echo '<div class="checkbox custom-checkbox nm">';
                                                    echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                    echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                echo '</div>';
                                            echo '</td>';                                                

                                            echo '<td><a target="_blank" href="'.$link_update.'">'.$value["id"].'</a></td>';                                                 
                                            echo '<td><a target="_blank" href="'.$link_working.'"><small>'.$value["company_name"].'</small></a></td>';                                                 
                                            echo '<td><small>'.$value["company_address"].'</small></td>';                                                 
                                            echo '<td><small>'.$value["company_sector"].'</small></td>';                                                 
                                            echo '<td><small>'.$value["phone"].'</small></td>';                                                 
                                            // echo '<td><small>'.$value["email"].'</small></td>';                                                 
                                            if ($value["success"] == 1) {
                                                echo '<td class="text-center"><small class="label label-success">Thành công</small></td>';
                                            } else {
                                                echo '<td class="text-center">'.$value["status"].'</td>';
                                            }
                                            echo '<td class="text-center">'.$value["user_id"].'</td>';                                                                                                    
                                            echo '<td class="text-center" style="color:'.$tmpRate["rate_color"].'">'.$value["company_rate"].'</td>';                                                                                                    
                                        echo '</tr>';                                                
                                        $i++;
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="10">
                                        <div class="text-right"> 
                                        <ul class="pagination pagination-sm mt0">                                            
                                           <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                        </div>
                                    </td>
                                </tr>
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
