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
                                <li><a href="<?= my_lib::cms_site()?>message/">Thông báo</a></li>
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
                                <?php if (isset($success)): ?>
                                    <div class="col-md-12" style="padding-top: 10px;">
                                        <div class="alert alert-dismissable alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <?= $success?>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <?php if (isset($error)): ?>
                                    <div class="col-md-12" style="padding-top: 10px;">
                                        <div class="alert alert-dismissable alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <?= $error?>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Gửi cho</label>
                                    <div class="col-sm-9">
                                        <select class="form-control user_id" name="user_push_id" required="required">
                                            <option value="all">Gửi tất cả</option>
                                            <?php if (!empty($listUserPush)): ?>
                                                <?php foreach ($listUserPush as $key => $value): ?>
                                                    <option value="<?= $value['user_push_id']?>"><?= $value['user_fullname']?></option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required="required" name="title" placeholder="Dưới 20 từ"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" required="required" name="link" placeholder="http://office.ioi.vn/cms/message/pushNotification/"/>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="form-group no-border">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9 text-right">
                                       <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Send</button>
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