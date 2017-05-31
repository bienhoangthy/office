
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
                                <li><a href="<?= my_lib::cms_site()?>company/">Danh sách</a></li>
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
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Form control</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">

                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>                                            
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>company/add/"><i class="ico-plus"></i>  Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>company/"><i class="ico-list"></i>  List</a>
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label text-danger">Tên công ty</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fkeyword" name="company_name" value="<?= $formData['company_name']?>" required="required">
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tên viết tắt</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="short_name" name="short_name" value="<?= $formData['short_name']?>" />
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Địa chỉ</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="company_address" name="company_address" value="<?= $formData['company_address']?>" />
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Thành phố</label>
                                            <div class="col-sm-9">
                                                <select class="form-control city_house" name="city_house" placeholder="Select a person..." required="required">
                                                <?= $city_house;?>
                                                </select>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Số điện thoại</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="phone" name="phone" value="<?= $formData['phone']?>" />
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fax</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="fax" name="fax" value="<?= $formData['fax']?>" />
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Website</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="website" name="website" value="<?= $formData['website']?>" />
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email" value="<?= $formData['email']?>" />
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Mã số thuế</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="tax_code" name="tax_code" value="<?= $formData['tax_code']?>" />
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ngày thành lập</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control datepicker" id="createdate" name="createdate" value="<?= $formData['createdate']?>" />
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Chủ tài khoản</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="owner_name" name="owner_name" value="<?= $formData['owner_name']?>" />
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Số tài khoản</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="account_bank" name="account_bank" value="<?= $formData['account_bank']?>" />
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ngân hàng</label>
                                            <div class="col-sm-9">
                                                <select class="form-control bank_id" name="bank_id" placeholder="Select a person..." required="required">
                                                <?= $bank_id;?>
                                                </select>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label text-danger">NV phụ trách</label>
                                            <div class="col-sm-9">
                                                <select class="form-control user_id" name="user_id" placeholder="Select a person..." required="required">
                                                <?= $user_id;?>
                                                </select>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label text-danger">Nhân viên nhập</label>
                                            <div class="col-sm-9">
                                                <select class="form-control user_typing" name="user_typing" placeholder="Select a person..." required="required">
                                                <?= $user_typing;?>
                                                </select> 
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label text-danger">Trạng thái</label>
                                            <div class="col-sm-9">
                                                <select class="form-control status" name="status" placeholder="Select a person..." required="required">
                                                <?= $status;?>
                                                </select>                                                 
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Hình thức liên hệ</label>
                                            <div class="col-sm-9">
                                                <select class="form-control company_type" name="company_type" placeholder="Select a person..." required="required">
                                                <?= $company_type;?>
                                                </select>                                                 
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label text-danger">Loại khách hàng</label>
                                            <div class="col-sm-9">
                                                <select class="form-control company_rate" name="company_rate" placeholder="Select a person..." required="required">
                                                <?= $company_rate;?>
                                                </select> 
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ngân sách quảng cáo</label>
                                            <div class="col-sm-9">
                                                <select class="form-control adv_budget" name="adv_budget" placeholder="Select a person..." required="required">
                                                <?= $adv_budget;?>
                                                </select>                                                
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Quy mô khách hàng</label>
                                            <div class="col-sm-9">
                                                <select class="form-control company_scale" name="company_scale" placeholder="Select a person..." required="required">
                                                <?= $company_scale;?>
                                                </select>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Loại công ty</label>
                                            <div class="col-sm-9">
                                                <select class="form-control business_type" name="business_type" placeholder="Select a person..." required="required">
                                                <?= $business_type;?>
                                                </select>                                                 
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label text-danger">Linh vực kinh doanh</label>
                                            <div class="col-sm-9">
                                                <select class="form-control company_sector" name="company_sector" placeholder="Select a person..." required="required">
                                                <?= $company_sector;?>
                                                </select>                                                  
                                            </div>
                                        </div> 
                                    </div> 
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Loại tư vấn</label>
                                            <div class="col-sm-9">
                                                <select class="form-control type_consult" name="type_consult">
                                                <?= $type_consult;?>
                                                </select>                                                  
                                            </div>
                                        </div> 
                                    </div>
                                </div> 

                                
                                
                                                            
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>                                            
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>company/add/"><i class="ico-plus"></i>  Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>company/"><i class="ico-list"></i>  List</a>
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