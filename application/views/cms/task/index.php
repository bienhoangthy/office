
<!--START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold"><?= $title?>
                        <span class="badge badge-teal"><?= $record?></span></h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">Danh sách công việc</li>
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
                         <?php if (isset($success) && $success): ?>
                            <div class="alert alert-success">
                                <p><?= $success?></p>
                            </div>
                        <?php endif ?>
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
                                </div>
                            </div>
                            <?php $link_action = $boss == 1 ? '' : 'mytask' ?>
                            <form method="get" action="<?= my_lib::cms_site()?>task/<?= $link_action?>" id="flistData">
                                <div class="panel-toolbar-wrapper pt5 pb5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-4" onchange="this.form.submit()">                                         
                                            <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: tên công việc, note">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">   
                                            <select onchange="this.form.submit()"  class="form-control fstatus" name="fstatus">
                                            <?= $fstatus?>
                                            </select>  
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">   
                                            <select onchange="this.form.submit()"  class="form-control ftype" name="ftype">
                                            <?= $ftype?>
                                            </select>  
                                        </div>
                                        <?php if ($boss == 1): ?>
                                            <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">   
                                                <select onchange="this.form.submit()"  class="form-control femployee" name="femployee">
                                                <?= $femployee?>
                                                </select>  
                                            </div>
                                        <?php endif ?>
                                        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" value="<?= $fdate?>" name="fdate" placeholder="Chọn ngày" />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-primary" type="submit">Search</button>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">   
                                            <input type="text" class="form-control datepicker" name="fdate" placeholder="Chọn ngày" />
                                            <span class="input-group-btn">
                                                <button class="btn btn-info" type="button">Go!</button>
                                            </span>
                                        </div> -->            
                                        <input type="hidden" name="page" value="<?= $page?>">
                                    </div>                                        
                                </div>
                            </form>
                            <div class="table-responsive panel-collapse pull out">
                            <form method="post" action="<?= my_lib::cms_site()?>task/<?= $link_action?>" id="flistData">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th colspan="11">                                                
                                                <div class="pull-right">
                                                    <ul class="pagination pagination-sm mt0">
                                                    <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                                </div>
                                                <?php if ($boss == 1): ?>
                                                    <div class="checkbox custom-checkbox pull-left">  
                                                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                                        <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                                        <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                                    </div>
                                                    <div class="pull-left" style="margin-left:5px;"> 
                                                        <a href="<?= my_lib::cms_site()?>task/assign/" class="btn btn-sm btn-teal"><i class="ico-plus"></i> Giao việc</a>                              
                                                    </div>
                                                <?php else: ?>
                                                    <div class="pull-left" style="margin-left:5px;"> 
                                                        <a href="<?= my_lib::cms_site()?>task/add/" class="btn btn-sm btn-teal" data-toggle="modal" data-target="#addTask"><i class="ico-plus"></i> Thêm mới</a>
                                                        <a href="<?= my_lib::cms_site().'task/report/'.$s_info["s_user_id"].'/?redirect='.base64_encode(current_url());?>" class="btn btn-sm btn-default"><i class="ico-bar-chart"></i> Thống kê</a>                              
                                                    </div>
                                                <?php endif ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php if ($boss == 1): ?>
                                                <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>
                                            <?php endif ?>
                                            <th class="css_id">ID</th>
                                            <th width="15%">Công việc</th>
                                            <th class="text-center">Người giao việc</th> 
                                            <th width="10%" class="text-center">Trạng thái</th>
                                            <th class="text-center">Loại công việc</th>
                                            <th class="text-center">Ngày bắt đầu</th>                                            
                                            <th class="text-center">Ngày xong dự kiến</th>                                  
                                            <?php if ($boss == 1): ?>
                                                <th class="text-center">Nhân viên</th>                  
                                            <?php endif ?>    

                                            <!-- <th class="text-center" width="15%">Ghi chú</th>    -->                               
                                            <th class="text-center" width="10%">Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($list)): ?>
                                            <?php $i=1; ?>
                                            <?php foreach ($list as $key => $value): ?>
                                                <?php 
                                                    $day = '';
                                                    if ($boss == 1) {
                                                        $myUser = $this->muser->getData('user_fullname',array("id"=>$value['task_employee']));
                                                    }
                                                    $assigner = '';
                                                    if ($value['task_assigner'] > 0) {
                                                        $assigner = $this->muser->getData('user_fullname',array("id"=>$value['task_assigner']));
                                                        $assigner = $assigner['user_fullname'];
                                                    }
                                                    if ($value['task_status'] != 2 && $value['task_delay'] != 1) {
                                                        $date_now = date('Y-m-d');
                                                        $day = (strtotime($value['task_expectedday']) - strtotime($date_now)) / (60 * 60 * 24);
                                                        if ($day<0) {
                                                            if ($this->mtask->edit($value['id'],array("task_delay"=>1))) {
                                                                $value['task_delay'] = 1;
                                                            }
                                                        }
                                                    }
                                                    $dayend = strtotime($value['task_endday']);
                                                    $dayend = date('Y-m-d',$dayend);
                                                    $status = $this->mtask->listStatus($value['task_status']);
                                                    $type = $this->mtask->listType($value['task_type']);
                                                    $link_update = my_lib::cms_site().'task/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                 ?>
                                                 <tr>
                                                    <?php if ($boss == 1): ?>
                                                         <td>
                                                             <div class="checkbox custom-checkbox nm">
                                                                 <input type="checkbox" id="customcheckbox-one<?= $i?>" value="<?= $value["id"]?>" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">
                                                                 <label for="customcheckbox-one<?= $i?>"></label>
                                                             </div>
                                                         </td>
                                                    <?php endif ?>
                                                     <td class="text-center"><?= $value['id']?></td>
                                                     <td>
                                                        <?= $value['task_name']?>
                                                        <?php if ($value['task_delay'] == 1): ?>
                                                            <span class="label label-danger pull-right">Delay</span>
                                                        <?php endif ?>
                                                        <?php if ($value['task_status'] == 2 && $value['task_delay'] != 1 && strtotime($dayend) <= strtotime($value['task_expectedday'])): ?>
                                                            <span class="label label-primary pull-right">Good</span>
                                                        <?php endif ?>
                                                     </td>
                                                     <td class="text-center"><?= $assigner?></td>
                                                     <td class="text-center">
                                                        <span class="label label-<?= $status['color']?>"><?= $status['name']?></span>
                                                        <?php if ($value['task_status'] == 2): ?>
                                                            <span class="label label-default pt5"><?= $value['task_endday']?></span>
                                                        <?php endif ?>
                                                     </td>
                                                     <td class="text-center"><span class="label label-<?= $type['color']?>"><?= $type['name']?></span></td>
                                                     <td class="text-center"><?= $value['task_startday']?></td>
                                                     <td class="text-center"><?= $value['task_expectedday']?><span class="label label-teal pull-right"><?= $day?></span></td>
                                                     <?php if ($boss == 1): ?>
                                                         <td class="text-center"><?= $myUser['user_fullname']?></td>
                                                     <?php endif ?>
                                                     <!-- <td><?= $value['task_note']?></td> -->
                                                     <td class="text-center"><a href="<?= $link_update?>"><button type="button" class="btn btn-primary mb5">Update</button></a></td>
                                                 </tr>
                                                 <?php $i++; ?>
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
            <!--begin addTask-->
            <div id="addTask" class="modal fade">
                <div class="modal-dialog">
                    <form class="modal-content" enctype="multipart/form-data" action="<?= my_lib::cms_site()?>task/popup/" method="post">
                        <div class="modal-header text-center">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="semibold modal-title text-primary"><i class="ico-pencil2"></i>
                            Thêm mới công việc</h4>                        
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Công việc<span class="text-danger">*</span></label>
                                        <input name="task_name" type="text" required="required" class="form-control input-sm" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Nhân viên</label>
                                        <input type="text" readonly="readonly" value="<?= $s_info['s_user_fullname']?>" class="form-control input-sm" >
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <div class="form-group">                          
                                        <label class="control-label">Ngày hoàn thành dự kiến</label>
                                        <input type="text" class="form-control datepicker" id="task_expectedday" name="task_expectedday" value="<?= date("Y-m-d")?>" placeholder="Ngày" />
                                    </div>                                                           
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">Ghi chú</label>
                                        <textarea name="task_note" class="form-control" rows="8" placeholder="Note..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" name="user_id" value="<?= $s_info['s_user_id']?>">
                        <input type="hidden" name="redirect" value="<?= base64_encode(current_url())?>">
                            <button type="submit" name="tasksubmit" class="btn btn-success"><i class="ico-save"></i> Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!--end addTask-->
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main-->
        