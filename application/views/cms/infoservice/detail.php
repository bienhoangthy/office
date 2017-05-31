
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
                    <!-- <a href="page-invoice-printable.html" target="_new" class="btn btn-primary"><i class="ico-print3"></i> Print</a> -->
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li><a href="<?= my_lib::cms_site()?>infoservice/">Hợp đồng</a></li>
                        <li class="active"><?= $title?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-layout">
                    <!-- Left / Top Side -->
                    <div class="col-lg-3 panel bgcolor-default valign-top">
                        <ul class="list-unstyled text-left pa15">
                            <?php if (!empty($company)): ?>
                                <li>
                                    <a href="<?= my_lib::cms_site().'company/working/'.$company["id"].'/?redirect='.base64_encode(current_url());?>"><h4 class="semibold mb0 mt15"><?= $company['company_name']?></h4></a>
                                    <p class="nm">Mã khách hàng: <?= $company['id']?></p>
                                    <br/>
                                    <p class="nm"><i class="ico-office"></i> <?= $company['company_address']?></p>
                                    <p class="nm"><i class="ico-phone"></i> Phone: <?= $company['phone']?></p>
                                    <p class="nm"><i class="ico-print"></i> Fax: <?= $company['fax']?></p>
                                    <p class="nm"><i class="ico-earth"></i> Web: <a href="<?= $company['website']?>" target="_blank"><?= $company['website']?></a></p>
                                    <p class="nm"><i class="ico-mail-send"></i> Email: <a href="mailto:<?= $company['email']?>" target="_top"><?= $company['email']?></a></p>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <!--/ Left / Top Side -->
                    <!-- Left / Bottom Side -->
                    <div class="col-lg-9 panel">
                        <!-- panel body -->
                        
                        <!-- panel body -->
                        <hr class="nm">
                        <!-- panel body -->
                        <?php if (!empty($infoService)): ?>
                        	<div class="panel-body">
	                            <ul class="list-table">
	                                <li class="text-left">
	                           			<?php 
	                           				$status = $this->minfoservice->listStatus($infoService['service_status']);
	                           				$name_type_service = '';
                                            $name_package_service = '';
                                            $object = 'service_name';
                                            $object1 = 'service_name,service_price';
                                            $and_type = 'id = '.$infoService["service_type"];
                                            $and_package = 'id = '.$infoService["service_package"];
                                            $type_service = $this->mservice->getData($object,$and_type);
                                            $package_service = $this->mservice->getData($object1,$and_package);
                                            if (!empty($type_service)) {
                                                $name_type_service = $type_service['service_name'];
                                            }
                                            if (!empty($package_service)) {
                                                $name_package_service = $package_service['service_name'].' ('.number_format($package_service['service_price'],0,',','.').')';
                                                //$name_package_service = word_limiter($package_service['service_name'], 3);
                                            }  
                                            $day="";
                                            $date_now = date('Y-m-d');
                                            $day = (strtotime($infoService['service_end']) - strtotime($date_now)) / (60 * 60 * 24);
                                            if ($infoService['service_status'] == 1) {
                                            	$pay_no = 'Đã thanh toán 100%';
                                            	$color_label = 'success';
                                            } else {
                                            	if ($infoService['service_pay_no'] > 0) {
	                                            	$pay_no = 'Đã thanh toán lần '.$infoService['service_pay_no'];
	                                            	$color_label = 'info';
	                                            } else {
	                                            	$pay_no = 'Chưa thanh toán';
	                                            	$color_label = 'danger';
	                                            }
                                            }
	                           			 ?>
	                           			 <p class="semibold text-primary nm">Mã hợp đồng : <?= $infoService['service_code']?></p>
	                           			 <h5 class="semibold">Trạng thái <span class="label label-<?= $status['color']?>"><?= $status['name']?></span></h5>
	                           			 <h5 class="semibold">Thời hạn <span class="label label-teal"><?= $day?> ngày</span></h5>
	                                </li>
	                                <li class="text-right">
	                                    <?php if (!empty($employee)): ?>
			                        		<h4 class="semibold nm"><?= $employee['user_fullname']?></h4>
				                            <p class="text-muted nm"><?= $employee['user_email']?></p>
				                            <p class="text-muted nm"><?= $employee['user_position']?></p>
			                        	<?php endif ?>
	                                </li>
	                            </ul>
	                        </div>
	                        <!-- panel body -->
	                        <!-- panel table -->
	                        <div class="table-responsive">
	                            <table class="table">
	                                <thead>
	                                    <tr>
	                                        <th>Description</th>
	                                        <th class="text-center"></th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">Tên miền quản lý</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $infoService['service_domain']?></td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">Email đăng ký</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $infoService['service_email']?></td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">User server</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $infoService['service_userser']?></td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">Loại dịch vụ</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $name_type_service?></td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">Gói dịch vụ</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $name_package_service?></td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">Ngày đăng ký</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $infoService['service_start']?></td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">Ngày hết hạn</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $infoService['service_end']?></td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                            <h5 class="semibold mt0 mb5">Nơi đăng ký</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $infoService['service_place']?></td>
	                                    </tr>
	                                    <tr>
	                                    	<td>
	                                            <h5 class="semibold mt0 mb5">Note</h5>
	                                        </td>
	                                        <td class="valign-top"><?= $infoService['service_note']?></td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                        <div class="panel-footer">
	                        	<?php if ($infoService['service_status'] == 3 && $boss == 1): ?>
	                            	<a href="<?= my_lib::cms_site().'infoservice/allow/'.$infoService["id"].'/?redirect='.base64_encode(current_url());?>"><button class="btn btn-danger">Duyệt</button></a>
	                            <?php endif ?>
	                            <?php if ($boss == 1 && $infoService['service_type'] == 4): ?>
			                        <a class="btn btn-primary newProject pull-right"  data-toggle="modal" data-target="#newProject"><i class="ico-plus"></i>  Tạo dự án</a>
	                            <?php endif ?>
	                            <a href="<?= my_lib::cms_site().'infoservice/';?>"><button class="btn btn-teal">Danh sách</button></a>
	                            <a href="<?= my_lib::cms_site().'infoservice/edit/'.$infoService["id"].'/?redirect='.base64_encode(current_url());?>"><button class="btn btn-default">Cập nhật thông tin</button></a>
	                        </div>
                        <?php endif ?>
                        <!-- panel footer -->
                    </div>
                    <!--/ Left / Bottom Side -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Trình trạng thanh toán: <span class="label label-<?= $color_label?>"><?= $pay_no?></span></h3>
                        <div class="panel-toolbar text-right">
                            <div class="btn-group">
                                <a href="<?= my_lib::cms_site().'infoservice/pay/'.$infoService["id"].'/?redirect='.base64_encode(current_url());?>"><button type="button" class="btn btn-sm btn-danger">Cập nhật trình trạng thanh toán</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
			                <div class="table-layout">
			                    <div class="col-md-2 panel panel-default valign-top">
			                        <!-- panel heading -->
			                        <div class="panel-heading text-center pa15">
			                            <h4 class="semibold mt0">
			                                <small>NGÀY - GIỜ</small>
			                            </h4>
			                        </div>
			                        <div class="panel-body text-center">
			                            <h2 class="bold text-muted nm"><?php echo mdate('%H:%i:%s %d-%m-%Y', strtotime($infoService['service_pay_dayupdate'])); ?></h2>
			                        </div>
			                    </div>
			                    <div class="col-md-2 panel panel-teal valign-top">
			                        <!-- panel heading -->
			                        <div class="panel-heading text-center pa15">
			                            <h4 class="semibold mt0">
			                                DS THỰC THU
			                            </h4>
			                        </div>
			                        <!-- panel heading -->
			                        <!-- panel body -->
			                        <div class="panel-body text-center">
			                            <h2 class="bold text-teal nm"><?= number_format($infoService['service_pay_real'])?></h2>
			                            <p class="bold text-teal nm">VNĐ</p>
			                        </div>
			                    </div>
			                    <div class="col-md-2 panel panel-teal valign-top">
			                        <!-- panel heading -->
			                        <div class="panel-heading text-center pa15">
			                            <h4 class="semibold mt0">
			                                DS KÝ
			                            </h4>
			                        </div>
			                        <div class="panel-body text-center">
			                            <h2 class="bold text-teal nm"><?= number_format($infoService['service_pay_sign'])?></h2>
			                            <p class="bold text-teal nm">VNĐ</p>
			                        </div>
			                    </div>
			                    <div class="col-md-2 panel panel-teal valign-top">
			                        <!-- panel heading -->
			                        <div class="panel-heading text-center pa15">
			                            <h4 class="semibold mt0">
			                            	<?php if ($infoService['service_pay_no'] > 0): ?>
			                            		TIỀN TT LẦN <?= $infoService['service_pay_no']?>
			                            	<?php else: ?>
			                            		CHƯA TT
			                            	<?php endif ?>
			                            </h4>
			                        </div>
			                        <div class="panel-body text-center">
			                            <h2 class="bold text-teal nm"><?= number_format($infoService['service_pay_perform'])?></h2>
			                            <p class="bold text-teal nm">VNĐ</p>
			                        </div>
			                    </div>
			                    <div class="col-md-2 panel panel-danger valign-top">
			                        <!-- panel heading -->
			                        <div class="panel-heading text-center pa15">
			                            <h4 class="semibold mt0">
			                                DS CÔNG NỢ	
			                            </h4>
			                        </div>
			                        <div class="panel-body text-center">
			                            <h2 class="bold text-danger nm"><?= number_format($infoService['service_pay_debt'])?></h2>
			                            <p class="bold text-danger nm">VNĐ</p>
			                        </div>
			                    </div>
			                    <div class="col-md-2 panel panel-inverse valign-top">
			                        <!-- panel heading -->
			                        <div class="panel-heading text-center pa15">
			                            <h4 class="semibold mt0">
			                                DS HỦY
			                            </h4>
			                        </div>
			                        <div class="panel-body text-center">
			                            <h2 class="bold text-inverse nm"><?= number_format($infoService['service_pay_cancel'])?></h2>
			                            <p class="bold text-inverse nm">VNĐ</p>
			                        </div>
			                    </div>
			                </div>
			                <!--/ END Table layout -->
		            	</div>
                    </div>
                    <!--/ panel body -->
                </div>
                <!--/ END panel -->
            </div>
            <div class="col-md-12">
                <label class="col-sm-3 control-label">File đính kèm hợp đồng</label>                           
                <iframe src="<?= my_lib::cms_fileupload()?>dialog.php?type=0" width="100%" scrolling="auto" marginwidth="0" height="450px" frameborder="0"></iframe>            
            </div>
        </div>
        <!--/ END row -->
                    
    </div>
    <!--/ END Template Container -->

    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<div id="newProject" class="modal fade">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= my_lib::cms_site()?>project/popup/" method="post">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="semibold modal-title text-primary"><i class="ico-new"></i>
                Tạo dự án</h4>                        
            </div>
            <div class="modal-body">
                <div class="row">       
                    <div class="col-lg-12">
                    	<div class="row">
                    		<div class="col-sm-6">
                    			<div class="form-group">
		                            <label class="control-label">Tên dự án<span class="text-danger">*</span></label>
		                            <input name="project_name" required="required" value="<?= $company['company_name']?>" type="text" class="form-control input-sm" >
		                        </div>
                    		</div>
                    		<div class="col-sm-6">
                    			<div class="form-group">
		                            <label class="control-label">Loại dự án<span class="text-danger">*</span></label>
		                            <select class="form-control project_type" required="required" name="project_type" required="required">
                                    	<?= $this->mproject->dropdownlistType()?>
                                    </select>
		                        </div>
                    		</div>
                    	</div>
                    </div>  
                    <div class="clr"></div>

                    <div class="col-lg-12">
                        <div class="row">                          
                            <div class="col-sm-6">
                                <label class="control-label">Deadline<span class="text-danger">*</span></label>
                                <input type="text" class="form-control datepicker" required="required" id="project_deadline" name="project_deadline" value="<?= date("Y-m-d")?>" placeholder="Ngày" />
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">  
                                    <label class="control-label">NV phụ trách<span class="text-danger">*</span></label>
                                    <select class="form-control project_manager" required="required" name="project_manager" placeholder="Select a person..." required="required">
                                    	<?= $this->muser->dropdownlist($s_info['s_user_id'])?>
                                    </select>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Mô tả</label>
                            <textarea name="project_description" class="form-control" rows="8" placeholder=""></textarea>
                        </div>
                    </div>                            
                </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="infoservice_id" value="<?= $infoService['id']?>">
                <button type="submit" name="fsubmit" class="btn btn-success"><i class="ico-save"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>