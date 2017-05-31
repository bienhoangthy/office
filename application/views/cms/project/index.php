<section id="main" role="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?>
                <span class="badge badge-teal"><?= $record?></span></h4>
            </div>
            <div class="page-header-section">
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active">Danh sách dự án</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-teal">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Danh sách các dự án của công ty <span class="label label-danger"><?= $textFilter?></span></h3>
                        <div class="panel-toolbar text-right">
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                            </div>
                        </div>
                    </div>

                    <!--begin form tim kiem-->
                    <form method="get" action="<?= my_lib::cms_site()?>project/" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" title="Từ khóa: tên dự án" placeholder="Từ khóa: tên dự án">
                                        <span class="input-group-btn">
                                            <button class="btn btn-teal" type="submit">Search</button>
                                        </span>
                                    </div>
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
                                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fyear" name="fyear">
                                        <?= $fyear;?>
                                    </select>  
                                </div>         
                                <input type="hidden" name="page" value="<?= $page?>">
                            </div>                                        
                        </div>
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
                                        <form method="post" action="<?= my_lib::cms_site()?>project/" id="flistData">
                                        <?php if ($boss == 1): ?>
                                            <div class="checkbox custom-checkbox pull-left">  
                                                <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                                <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                                <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                            </div>
                                        <?php endif ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                                                        
                                    <th class="css_id">ID</th>                                                                        
                                    <th class="text-center">Hợp đồng</th>                                                                        
                                    <th class="text-center">Tên dự án</th>                                                                        
                                    <th class="text-center">Ngày/Giờ tạo</th>                                                                        
                                    <th class="text-center">Deadline</th>                                                                        
                                    <th class="text-center">Trạng thái</th>                                                                        
                                    <th class="text-center">Loại</th>                                                                        
                                    <th class="text-center">Tiến độ</th>                                                                        
                                    <th class="text-center">NV phụ trách</th>                                                                        
                                    <th width="90" class="text-center">Xem chi tiết</th>                                                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($list)): ?>
                                    <?php $j=0; ?>
                                    <?php foreach ($list as $key => $value): ?>
                                        <?php  
                                            $myUser = $this->muser->getData("user_fullname",array("id"=>$value['project_manager']));
                                            $user_fullname = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';
                                            $link_detail = my_lib::cms_site().'project/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                            $link_infoservice = my_lib::cms_site().'infoservice/detail/'.$value["infoservice_id"].'/?redirect='.base64_encode(current_url());
                                            $status = $this->mproject->listStatus($value['project_status']);
                                            $type = $this->mproject->listType($value['project_type']);
                                            $lastPhase = $this->mproject_phase->getQuery("phase_percent,phase_name","","project_id = ".$value['id']." and phase_status <> 1","phase_name desc",1);
                                            $j++;
                                         ?>
                                         <tr>
                                             <td>
                                                 <div class="checkbox custom-checkbox nm">
                                                     <input type="checkbox" id="customcheckbox-one<?= $j?>" value="<?= $value["id"]?>" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">
                                                     <label for="customcheckbox-one<?= $j?>"></label>
                                                 </div>
                                             </td>
                                             <td class="text-center"><?= $value["id"]?></td>
                                             <td class="text-center"><a href="<?= $link_infoservice?>"><?= $value['infoservice_id']?></a></td>
                                             <td class="text-center" width="16%"><?= $value["project_name"]?></td>
                                             <td class="text-center"><?= $value['project_startday']?></td>
                                             <td class="text-center"><?= $value['project_deadline']?></td>
                                             <td class="text-center"><span class="label label-<?= $status['color']?>"><?= $status['name']?></span></td>
                                             <td class="text-center"><span class="label label-<?= $type['color']?>"><?= $type['name']?></span></td>
                                             <td class="text-center">
                                                 <?php if (!empty($lastPhase)): ?>
                                                    <?php $name_phase = $this->mproject_phase->listPhase($lastPhase['phase_name']);?>
                                                     <span class="label label-teal"><?= $name_phase['name']?> (<?= $lastPhase['phase_percent']?>%)</span>
                                                 <?php else: ?>
                                                     <span class="label label-default">Khởi tạo</span>
                                                 <?php endif ?>
                                             </td>
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
