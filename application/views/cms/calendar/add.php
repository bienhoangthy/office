
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
                                <li><a>Lịch nghỉ phép</a></li>
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
                        <form class="panel panel-default form-horizontal form-bordered"  method="post">
                            <?php if (isset($id) && $status == 1): ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title">Lịch nghỉ phép của <code><?= $user_fullname?></code> trạng thái chờ duyệt <a href="<?= my_lib::cms_site()."calendar/allow/".$id?>"><button type="button" class="btn btn-danger">Duyệt</button></a></h3>
                                </div>
                            <?php endif ?>
                            <?php if (isset($id) && $status == 2): ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title text-success">Đã duyệt</h3>
                                </div>
                            <?php endif ?>
                            <div class="panel-body">
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                    </div> 
                                </div>
                                <?php if (isset($id)): ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nhân viên</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly="readonly" value="<?= $user_fullname?>">
                                        </div>
                                    </div> 
                                <?php endif ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Lý do xin nghỉ phép</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="calendar_note" name="calendar_note" value="<?= $formData['calendar_note']?>" required="required">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày bắt đầu</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="calendar_startday" id="calendar_startday" value="<?= $formData['calendar_startday']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày kết thúc</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="calendar_endday" id="calendar_endday" value="<?= $formData['calendar_endday']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>                                                                
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                           <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
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

        <!--end addInfoContactPopup-->
<script type="text/javascript" src="<?= my_lib::cms_js()?>jqueryui/js/jquery-ui-timepicker-addon.js"></script>
<link type="text/css" rel="stylesheet" href="<?= my_lib::cms_js()?>jqueryui/css/jquery-ui-timepicker-addon.css" media="screen" />
<script>
$(function () {
    $("#calendar_startday").datepicker({minDate: -1,dateFormat: 'yy-mm-dd'});   
    $("#calendar_endday").datepicker({minDate: -1,dateFormat: 'yy-mm-dd'});  
});
</script>