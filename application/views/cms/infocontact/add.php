
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
                        <li><a href="<?= my_lib::cms_site()?>infocontact/">Thông tin liên hệ</a></li>
                        <li class="active"><?= $title?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="panel panel-default form-horizontal form-bordered"  method="post">
                    <div class="panel-heading">
                        <h3 class="panel-title">Form control</h3>
                    </div>
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
                            <label class="col-sm-3 control-label">Mã công ty</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company_id" id="company_id" value="<?= $formData['company_id']?>" required="required" />
                            </div>
                        </div>                                          
                                                
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Người liên hệ</label>
                            <div class="col-sm-1">
                                <select name="contact_name_call" class="form-control input-sm">
                                    <?= $this->minfocontact->dropdownlistNhanXung($formData['contact_name_call'])?>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="contact_name" id="contact_name"  required="required"  value="<?= $formData['contact_name']?>"/>
                            </div>
                        </div>
                        
          
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Điện thoại</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="<?= $formData['contact_phone']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contact_email" id=" contact_email" value="<?= $formData['contact_email']?>"/>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Chức vụ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contact_position" id=" contact_position" value="<?= $formData['contact_position']?>"/>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ghi chú</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="contact_note" rows="5" id="contact_note"><?= $formData['contact_note']?></textarea>
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