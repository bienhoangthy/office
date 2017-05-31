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
                                <li><a href="<?= my_lib::cms_site()?>project/detail/<?= $project_id.'/?redirect='.base64_encode(current_url())?>">Dự án</a></li>
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
                        <!-- START panel -->
                        <form class="panel panel-teal form-horizontal form-bordered" method="post">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Form <?= $title?></h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                                <!-- <p>Việc làm có thể giao cho nhiều nhân viên.</p> -->
                                <?php if (isset($error)): ?>
                                    <div class="col-md-12" style="padding-top: 10px;">
                                        <div class="alert alert-dismissable alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>Lỗi!</strong> <?= $error?>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($update != 1): ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giai đoạn</label>
                                        <div class="col-sm-9">
                                            <select class="form-control phase_name" name="phase_name" required="required">
                                                <?= $this->mproject_phase->dropdownlistPhase($formData['phase_name']);?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nhân viên</label>
                                        <div class="col-sm-9">
                                            <select class="form-control user_id" name="user_id" required="required">
                                                <?= $this->muser->dropdownlistAccountDepartment($formData['user_id'],2);?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($update == 1): ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Chuyển giao</label>
                                        <div class="col-sm-9">
                                            <select class="form-control user_id_tran" name="user_id_tran">
                                                <?= $this->muser->dropdownlistAccountDepartment('',2);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Hoàn thành(%)</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="0" max="100" class="form-control" name="phase_percent" id="phase_percent"  required="required"  value="<?= $formData['phase_percent']?>"/>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($update != 1): ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ngày bắt đầu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control datepicker" id="phase_startday" name="phase_startday" value="<?= $formData['phase_startday']?>" placeholder="Ngày" />
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Deadline</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control datepicker" id="phase_deadline" name="phase_deadline" value="<?= $formData['phase_deadline']?>" placeholder="Ngày" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ghi chú</label>
                                    <div class="col-sm-9">
                                        <?php if ($formData['phase_note'] != ""): ?>
                                            <code><?= $formData['phase_note']?></code>
                                        <?php endif ?>
                                        <textarea name="phase_note" class="form-control" rows="8" placeholder="Note..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="form-group no-border">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9 text-right">
                                       <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>
                                        <button type="reset" class="btn btn-danger"><i class="ico-refresh"></i>  Reset</button>
                                    </div>
                                </div>
                            </div>
                            <!--/ panel body -->
                        </form>
                        <!-- END panel -->
                    </div>
                </div>
                <!--/ END row -->
                            
            </div>
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>