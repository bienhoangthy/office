<section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">Giao việc</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li><a href="<?= my_lib::cms_site()?>task/">Danh sách công việc của nhân viên</a></li>
                                <li class="active">Giao việc</li>
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
                                <h3 class="panel-title">Bảng giao việc</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                                <p>Việc làm có thể giao cho nhiều nhân viên.</p>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Công việc</label>
                                    <div class="col-sm-9">
                                        <input name="task_name" type="text" required="required" class="form-control input-sm" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nhân viên</label>
                                    <div class="col-sm-9">
                                        <select id="selectize-selectmultiple" class="form-control" placeholder="Chọn nhân viên" multiple name="task_employs[]">
                                            <?= $this->muser->dropdownlistAccount1();?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Việc được giao</label>
                                    <div class="col-sm-9">
                                        <span class="checkbox custom-checkbox">
                                            <input type="checkbox" name="hurry" id="customcheckbox2" value="1" />
                                            <label for="customcheckbox2">&nbsp;&nbsp;Việc gấp</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày hoàn thành dự kiến</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control datepicker" id="task_expectedday" name="task_expectedday" value="<?= date("Y-m-d")?>" placeholder="Ngày" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ghi chú</label>
                                    <div class="col-sm-9">
                                        <textarea name="task_note" class="form-control" rows="8" placeholder="Note..."></textarea>
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