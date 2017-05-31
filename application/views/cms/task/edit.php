
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Cập nhật trạng thái công việc</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li><a href="<?= my_lib::cms_site()?>task/">Danh sách công việc</a></li>
                        <li class="active">Cập nhật trạng thái</li>
                    </ol>
                </div>
            </div>
            <div class="text-left">
                <a href="<?= my_lib::cms_site()?>task/"><button type="button" class="btn btn-teal"><span class="ico-backspace"></span> Bảng danh sách công việc</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-footer">
                        <?php 
                            $logStatus = explode('/', $formData['task_log']);
                         ?>
                         <?php if (!empty($logStatus)): ?>
                            <?php $i=1; ?>
                             <?php foreach ($logStatus as $key => $value): ?>
                                 <?php 
                                    $status = $this->mtask->listStatus($value);
                                    $arrow = $i>1 ? 'class="ico-arrow-right"' : '';
                                    $i++;
                                 ?>
                                 <span <?= $arrow?>></span>&nbsp;<span class="label label-<?= $status['color']?>"><?= $status['name']?></span>
                             <?php endforeach ?>
                         <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Task Infomation</h3>
                        <div class="panel-toolbar text-right">
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-6"><i class="remove"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-collapse pull out">
                        <div class="panel-body">
                        <?php $myUser = $this->muser->getData('user_fullname',array("id"=>$formData['task_employee'])); ?>
                            <?php if (!empty($myUser)): ?>
                                <h4><span class="ico-user7" style="color: #60c8ae;">&nbsp;</span><?= $myUser['user_fullname']?></h4>
                            <?php endif ?>
                            <h4><span class="ico-history" style="color: #8ac448;">&nbsp;</span>Ngày bắt đầu: <?= $formData['task_startday']?></h4>
                            <h4><span class="ico-bell" style="color: #ec465a;">&nbsp;</span>Ngày hoàn thành dự kiến: <?= $formData['task_expectedday']?></h4>
                            <?php if ($formData['task_status'] == 2): ?>
                                <h4><span class="ico-bubble-check" style="color: #428bca;">&nbsp;</span>Ngày hoàn thành: <?= $formData['task_endday']?></h4>
                            <?php endif ?>
                            <?php $type = $this->mtask->listType($formData['task_type']); ?>
                            <?php if (!empty($type)): ?>
                                <span class="label label-<?= $type['color']?>"><?= $type['name']?></span>
                            <?php endif ?>
                            <?php if ($formData['task_delay'] == 1): ?>
                                <span class="label label-danger">Delay</span>
                            <?php endif ?>
                        </div>
                    </div>
                    <!--/ panel body with collapse capabale -->
                </div>
                <!--/ END panel -->
            </div>
            <div class="col-md-8">
                <form class="panel panel-teal" method="post">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit</h3>
                    </div>               
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="control-label">Công việc</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb10">
                                    <input name="task_name" readonly="readonly" type="text" class="form-control" placeholder="Công việc..." value="<?= $formData['task_name']?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label class="control-label">Trạng thái</label>
                                </div>
                                <div class="col-sm-8 mb10">
                                    <span class="radio custom-radio custom-radio-teal">  
                                        <input type="radio" <?= $formData['task_status'] == 1 ? 'checked="checked"' : ''?> name="task_status" id="task_status1" value="1">  
                                        <label for="task_status1">&nbsp;&nbsp;Đang chờ xử lý</label><br><br>
                                        <input type="radio" <?= $formData['task_status'] == 2 ? 'checked="checked"' : ''?> name="task_status" id="task_status2" value="2">
                                        <label for="task_status2">&nbsp;&nbsp;Đã hoàn thành</label><br><br>
                                        <input type="radio" <?= $formData['task_status'] == 3 ? 'checked="checked"' : ''?> name="task_status" id="task_status3" value="3">
                                        <label for="task_status3">&nbsp;&nbsp;Hoãn việc</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php if ($boss == 1): ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label">Ngày xong dự kiến</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb10">
                                       <input type="text" class="form-control datepicker" id="task_expectedday" name="task_expectedday" value="<?= $formData['task_expectedday']?>" placeholder="Ngày" />
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="control-label">Ghi chú</label>
                                    <dd class="text-primary" style="font-style: italic;font-weight: bold;"><?= $formData['task_note']?></dd>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb10 mt10">
                                    <textarea name="task_note" class="form-control" rows="4" placeholder="Note..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </form>
                <!--/ Form default layout -->
            </div>
        </div>
        <!--/ END row -->
                    
    </div>
    <!--/ END Template Container -->

    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>