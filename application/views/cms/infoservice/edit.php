
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
                        <li><a href="<?= my_lib::cms_site()?>infoservice/">Thông tin dịch vụ</a></li>
                        <li class="active"><?= $title?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="panel panel-default form-horizontal form-bordered" enctype="multipart/form-data"  method="post">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hợp đồng: <?= $formData['id']?></h3>
                    </div>
                    <div class="panel-body">

                        <div class="panel-footer">
                            <div class="form-group no-border">
                                <div class="col-sm-12 text-right">
                                    <?php if (!empty($formData['company_id'])): ?>
                                        <?php $link_company = my_lib::cms_site().'company/working/'.$formData['company_id'].'/?redirect='.base64_encode(current_url()); ?>
                                        <a class="btn btn-teal pull-left" href="<?= $link_company?>"><i class="ico-backward2"></i>  Bảng làm việc</a>
                                    <?php endif ?>
                                    <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>
                                    <a class="btn btn-success" href="<?= my_lib::cms_site()?>infoservice/"><i class="ico-list"></i>  Danh sách</a>                                        
                                </div>
                            </div> 
                        </div> 
                        <?php if (isset($success) && $success): ?>
                            <div class="alert alert-success">
                                <ul>
                                    <li><?= $success?></li>
                                </ul>
                            </div>
                        <?php endif ?>   
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
                                <input type="text" readonly="readonly" class="form-control" name="company_id" id="company_id" value="<?= $formData['company_id']?>"/>
                            </div>
                        </div>                                                              
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mã hợp đồng</label>
                            <div class="col-sm-9">
                                <input type="text" readonly="readonly" class="form-control" name="service_code" id="service_code" value="<?= $formData['service_code']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên miền quản lý</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly="readonly" name="service_domain" id="service_domain"  required="required"  value="<?= $formData['service_domain']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">User Server</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" readonly="readonly" name="service_userser" id="service_userser"  required="required"  value="<?= $formData['service_userser']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email đăng ký</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="service_email" id="service_email" value="<?= $formData['service_email']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Loại dịch vụ</label>
                            <div class="col-sm-9">
                                <select name="service_type" disabled="disabled" id="service_type" class="form-control input-sm">
                                    <?= $this->minfoservice->dropdownlistType($formData['service_type'])?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gói dịch vụ</label>
                            <div class="col-sm-9">
                                <select name="service_package" id="service_package" class="form-control input-sm">
                                    <?= $this->minfoservice->dropdownlistPackage($formData['service_package'],$formData['service_type'])?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ngày đăng ký</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datepicker" id="service_start" name="service_start" value="<?= $formData['service_start']?>" placeholder="Ngày" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ngày hết hạn</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datepicker" id="service_end" name="service_end" value="<?= $formData['service_end']?>" placeholder="Ngày" />
                            </div>
                        </div>
                        <!-- <?php if ($boss == 1): ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select name="service_status" class="form-control input-sm">
                                        <?= $this->minfoservice->dropdownlistStatus($formData['service_status'])?>
                                    </select>
                                </div>
                            </div>
                        <?php endif ?> -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nơi đăng ký</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="service_place" id="service_place"  value="<?= $formData['service_place']?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ghi chú</label>
                            <div class="col-sm-9">
                                <textarea name="service_note" class="form-control" placeholder="Note..."><?= $formData['service_note']?></textarea>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group no-border">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9 text-right">                                   
                                    <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>                                        
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
<script>
$(document).ready(function(){
    $("#service_type").on('change', function(){
        var id = this.value;
        var url = '<?= my_lib::cms_site()."service/getAjax"?>';
        $.ajax({
            type: 'post',
            data: {"id":id},
            cache: false,
            url: url,
            success: function(rs) {
                $("#service_package").empty();
                $("#service_package").append(rs);
            }
        });
    });
});
</script>