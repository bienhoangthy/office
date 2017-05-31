
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
                                <li><a>Lịch cá nhân</a></li>
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

                                <!-- <p>Selectize is the hybrid of a textbox and box. It's jQuery-based and it's useful for tagging, contact lists, country selectors, and so on.</p> -->
                                <?php
                                if(isset($success) && $success && count($success)>0){
                                    echo '<div class="alert alert-info">';
                                        echo '<ul>';
                                        foreach ($success as $key => $value) {
                                            # code...
                                            echo '<li>'.$value.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                ?>     
                                <?php
                                if(isset($error) && $error && count($error) >0 ){
                                    echo '<div class="alert alert-danger">';
                                        echo '<ul>';
                                        foreach ($error as $key => $value) {
                                            # code...
                                            echo '<li>'.$value.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                ?>                                                            
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label  text-danger">Nhân viên</label>
                                    <div class="col-sm-9">
                                        <select class="form-control user"  name="user" placeholder="Select a person...">
                                            <?= $user;?>
                                        </select>                                         
                                    </div>
                                </div>
   
                                <div class="form-group">
                                    <label class="col-sm-3 control-label  text-danger">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <select class="form-control calendar_status" name="calendar_status" placeholder="Select a person...">
                                            <?= $calendar_status;?>
                                        </select>                                         
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-danger">Tiêu đề</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="calendar_name" name="calendar_name" value="<?= $formData['calendar_name']?>" required="required">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày bắt đầu</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="calendar_start" id="calendar_start" value="<?= $formData['calendar_start']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Thời gian bắt đầu</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control" name="calendar_time_start" id="calendar_time_start" value="<?= $formData['calendar_time_start']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày kết thúc</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="calendar_end" id="calendar_end" value="<?= $formData['calendar_end']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Thời gian kết thúc</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control" name="calendar_time_end" id="calendar_time_end" value="<?= $formData['calendar_time_end']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Màu sắc</label>                                       
                                    <div class="col-sm-9">
                                        <span class="radio-inline custom-radio custom-radio-primary">  
                                            <input type="radio" name="calendar_color" id="color1" value="primary" <?= $formData['calendar_color']=="primary"?"checked":"";?>   data-parsley-group="event-color">  
                                            <label for="color1" class="pl10"></label>   
                                        </span>
                                        <span class="radio-inline custom-radio custom-radio-info">  
                                            <input type="radio" name="calendar_color" id="color2" value="info" <?= $formData['calendar_color']=="info"?"checked":"";?> data-parsley-group="event-color">  
                                            <label for="color2" class="pl10"></label>   
                                        </span>
                                        <span class="radio-inline custom-radio custom-radio-success">  
                                            <input type="radio" name="calendar_color" id="color3" value="success" <?= $formData['calendar_color']=="success"?"checked":"";?> data-parsley-group="event-color">  
                                            <label for="color3" class="pl10"></label>   
                                        </span>
                                        <span class="radio-inline custom-radio custom-radio-warning">  
                                            <input type="radio" name="calendar_color" id="color4" value="warning" <?= $formData['calendar_color']=="warning"?"checked":"";?> data-parsley-group="event-color">  
                                            <label for="color4" class="pl10"></label>   
                                        </span>
                                        <span class="radio-inline custom-radio custom-radio-danger">  
                                            <input type="radio" name="calendar_color" id="color5" value="danger" <?= $formData['calendar_color']=="danger"?"checked":"";?> data-parsley-group="event-color">  
                                            <label for="color5" class="pl10"></label>   
                                        </span>
                                        <span class="radio-inline custom-radio custom-radio-teal">  
                                            <input type="radio" name="calendar_color" id="color6" value="teal" <?= $formData['calendar_color']=="teal"?"checked":"";?> data-parsley-group="event-color">  
                                            <label for="color6" class="pl10"></label>   
                                        </span>
                                        <span class="radio-inline custom-radio custom-radio-inverse">  
                                            <input type="radio" name="calendar_color" id="color7" value="inverse" <?= $formData['calendar_color']=="inverse"?"checked":"";?> data-parsley-group="event-color">  
                                            <label for="color7" class="pl10"></label>   
                                        </span>
                                    </div>                                    
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="calendar_detail" name="calendar_detail"><?= $formData['calendar_detail']?></textarea>
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
    $("#calendar_start").datepicker({minDate: -1,dateFormat: 'yy-mm-dd'});    
    $("#calendar_end").datepicker({minDate: -1,dateFormat: 'yy-mm-dd'});    

    $('#calendar_time_start').timepicker();        
    $('#calendar_time_end').timepicker();    
});
</script>