
<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?></h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active"><?= $title?></li>
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

                    <!--begin form tim kiem-->
                    <form method="get" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                                         
                                    <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: mã công ty, người liên hệ, Điện thoại, Email, Chức vụ, Nội dung">
                                </div>  -->                                       
                                                                        
                                <input type="hidden" name="page" value="<?= $page?>">
                            </div>                                        
                        </div>
                        <!--end form tim kiem-->
                   

                    <!-- panel body with collapse capabale -->
                    <div class="table-responsive panel-collapse pull out">
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
                                    <form method="post" id="flistData">
                                    <div class="checkbox custom-checkbox pull-left">  
                                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                        <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                        <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                    </div>
                                </th>
                            </tr>
                                <tr>
                                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                            
                                    <th width="3%" class="text-center">ID</th>                                            
                                    <th class="text-center" width="130px">Nhân viên</th>                                                                          
                                    <th class="text-center">Ngày bắt đầu nghỉ</th>                                                                           
                                    <th class="text-center">Ngày kết thúc</th>                                                                           
                                    <th class="text-center">Ghi chú</th>                                                                           
                                    <th class="text-center">Trạng thái</th>                                                                                                                                                   
                                    <th width="90" class="text-center">Xem chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $j=0; ?>
                                <?php foreach ($list as $key => $value): ?>
                                    <?php 
                                        $myUser = $this->muser->getData("",array("id"=>$value['user_id']));
                                        $value['user_id'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';  
                                        $status = $this->mcalendar->listStatus($value['calendar_status']);
                                        $link_edit = my_lib::cms_site().'calendar/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        $j++;
                                     ?>
                                <tr>
                                    <td>
                                         <div class="checkbox custom-checkbox nm">
                                             <input type="checkbox" id="customcheckbox-one<?= $j?>" value="<?= $value["id"]?>" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">
                                             <label for="customcheckbox-one<?= $j?>"></label>
                                         </div>
                                     </td>
                                     <td class="text-center"><?= $value['id']?></td>
                                     <td class="text-center"><?= $value['user_id']?></td>
                                     <td class="text-center"><?= $value['calendar_startday']?></td>
                                     <td class="text-center"><?= $value['calendar_endday']?></td>
                                     <td class="text-center"><?= $value['calendar_note']?></td>
                                     <td class="text-center"><span class="label label-<?= $status['color']?>"><?= $status['name']?></span></td>
                                     <td class="text-center"><a href="<?= $link_edit?>" title="Detail"><i class="ico-pencil" style="color: #EE0000;"></i></a></td>
                                </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td colspan="10">
                                        <div class="text-right"> 
                                        <ul class="pagination pagination-sm mt0">                                            
                                           <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                        </div>
                                    </td>
                                </tr>
                                </form>
                            </tbody>
                        </table>
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
