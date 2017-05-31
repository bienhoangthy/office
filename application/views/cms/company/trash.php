<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Danh sách khách hàng
                <span class="badge badge-teal"><?= $record?></span></h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active">Trạng thái</li>
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
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Danh sách</h3>
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
                    <form method="get" action="<?= my_lib::cms_site()?>company/trash/" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" onchange="this.form.submit()">                                         
                                    <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: tên công ty, địa chỉ, số điện thoại, email">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">                                         
                                    <select onchange="this.form.submit()"  class="form-control fcompany_sector" name="fcompany_sector" placeholder="Select a person..." required="required">
                                    <?= $fcompany_sector;?>
                                    </select>  
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fstatus" name="fstatus">                                            
                                    <?= $fstatus;?>
                                    </select>  
                                </div> 
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fuserid" name="fuserid">                                            
                                    <?= $fuserid;?>
                                    </select>  
                                </div> 
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fcityhouse" name="fcityhouse">                                            
                                    <?= $fcityhouse;?>
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
                                        <form method="post" action="<?= my_lib::cms_site()?>company/trash/" id="flistData">
                                        <div class="checkbox custom-checkbox pull-left">  
                                            <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                            <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                            <button type="submit" name="apllyAll" class="btn btn-sm btn-success" ><i class="ico-history"></i> Phục hồi</button>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                            
                                    <th class="css_id">ID</th>                                                                        
                                    <th>Tên</th>                                                                        
                                    <th>Địa chỉ</th>                                                                        
                                    <th width="100px">Lĩnh vực</th>                                                                        
                                    <th>Địện thoại</th>                                                                        
                                    <th>Email</th>                                                                        
                                    <th width="130px" class="text-center" width="15%">Trạng thái</th>                                                                           
                                    <th width="150px" class="text-center">Nhân viên phụ trách</th>                                                                                                                       
                                    <th width="150px" class="text-center">Nhân viên nhập</th>                                                                                                                       
                                    <th width="150px" class="text-center">Ngày xóa</th>                                                                                                                       
                                    <th width="150px" class="text-center">Nhân viên xóa</th>                                                                                                                       
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

                                        $myUser = $this->muser->getData("",array("id"=>$value['user_trash']));
                                        $value['user_trash'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';

                                        $tmpStatus = $this->mcompany_status->getData(array("cst_name","cst_note"),array("id"=>$value["status"]));
                                        $value["status"] = $tmpStatus ? '<small class="label" style="background:'.$tmpStatus["cst_note"].'">'.$tmpStatus["cst_name"].'</small>':'';

                                        $tmpSector = $this->mcompany_sector->getData(array("sector_name"),array("id"=>$value["company_sector"]));
                                        $value["company_sector"] = $tmpSector ? $tmpSector["sector_name"] :'';

                                        $link_update = my_lib::cms_site().'company/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        $link_working = my_lib::cms_site().'company/working/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        $link_delete = my_lib::cms_site().'company/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        echo '<tr>';
                                            echo '<td>';
                                                echo '<div class="checkbox custom-checkbox nm">';
                                                    echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                    echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                echo '</div>';
                                            echo '</td>';                                                

                                            echo '<td><a href="'.$link_update.'">'.$value["id"].'</a></td>';                                                 
                                            echo '<td><a href="'.$link_working.'"><small>'.$value["company_name"].'</small></a></td>';                                                 
                                            echo '<td><small>'.$value["company_address"].'</small></td>';                                                 
                                            echo '<td><small>'.$value["company_sector"].'</small></td>';                                                 
                                            echo '<td><small>'.$value["phone"].'</small></td>';                                                 
                                            echo '<td><small>'.$value["email"].'</small></td>';                                                 
                                            echo '<td class="text-center">'.$value["status"].'</td>';
                                            echo '<td class="text-center">'.$value["user_id"].'</td>';                                                                                                    
                                            echo '<td class="text-center">'.$value["user_typing"].'</td>';                                                                                                    
                                            echo '<td class="text-center">'.$value["update_date"].'</td>';                                                                                                    
                                            echo '<td class="text-center">'.$value["user_trash"].'</td>';                                                                                                    
                                        echo '</tr>';                                                
                                        $i++;
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="12">
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
