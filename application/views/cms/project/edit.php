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
                                <li><a href="<?= my_lib::cms_site()?>project/detail/<?= $formData['id'].'/?redirect='.base64_encode(current_url())?>">Dự án</a></li>
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
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên dự án</label>
                                    <div class="col-sm-9">
                                        <input name="project_name" required="required" value="<?= $formData['project_name']?>" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Thưởng dự án</label>
                                    <div class="col-sm-9">
                                        <input name="project_bonus" value="<?= $formData['project_bonus']?>" type="number" min="0" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Deadline</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control datepicker" id="project_deadline" name="project_deadline" value="<?= $formData['project_deadline']?>" placeholder="Ngày" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại dự án</label>
                                    <div class="col-sm-9">
                                        <select class="form-control project_type" name="project_type" required="required">
                                            <?= $this->mproject->dropdownlistType($formData['project_type'])?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">NV phụ trách</label>
                                    <div class="col-sm-9">
                                        <select class="form-control project_manager" name="project_manager" required="required">
                                            <?= $this->muser->dropdownlist($formData['project_manager'])?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mô tả</label>
                                    <div class="col-sm-9">
                                        <textarea name="project_description" class="form-control" rows="8" placeholder=""><?= $formData['project_description']?></textarea>
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