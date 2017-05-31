
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
            <div class="text-left">
            	<?php $link_back = my_lib::cms_site() . 'infoservice/detail/' . $myInfoService['id'] . '/?redirect=' . base64_encode(current_url()); ?>
                <a href="<?= $link_back?>"><button type="button" class="btn btn-teal"><span class="ico-backspace"></span> Quay lại chi tiết hợp đồng</button></a>
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Trạng thái thanh toán hiện tại của hợp đồng <span class="label label-teal"><?= $myInfoService['service_code']?></span></h3>
                    <div class="panel-toolbar text-right">
                    	<?php 
                    		$num_pay = '';
                    		$color_label = 'default';
                    		if ($myInfoService['service_pay_no'] < 1) {
                    			$num_pay = 'Chưa thanh toán';
                    			$color_label = 'danger';
                    		} else {
                    			$num_pay = 'Lần thanh toán thứ '.$myInfoService['service_pay_no'];
                    			$color_label = 'primary';
                    		}
                    	 ?>
                        <span class="label label-<?= $color_label?>"><?= $num_pay?></span>
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
		                        <!-- panel heading -->
		                        <!-- panel body -->
		                        <div class="panel-body text-center">
		                            <h2 class="bold text-muted nm"><?php echo mdate('%d-%m-%Y %H:%i:%s', strtotime($myInfoService['service_pay_dayupdate'])); ?></h2>
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
		                            <h2 class="bold text-teal nm"><?= number_format($myInfoService['service_pay_real'])?></h2>
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
		                            <h2 class="bold text-teal nm"><?= number_format($myInfoService['service_pay_sign'])?></h2>
		                            <p class="bold text-teal nm">VNĐ</p>
		                        </div>
		                    </div>
		                    <div class="col-md-2 panel panel-teal valign-top">
		                        <!-- panel heading -->
		                        <div class="panel-heading text-center pa15">
		                            <h4 class="semibold mt0">
		                            <?php if ($myInfoService['service_pay_no'] > 0): ?>
	                            		TIỀN TT LẦN <?= $myInfoService['service_pay_no']?>
	                            	<?php else: ?>
	                            		CHƯA TT
	                            	<?php endif ?>
		                            </h4>
		                        </div>
		                        <div class="panel-body text-center">
		                            <h2 class="bold text-teal nm"><?= number_format($myInfoService['service_pay_perform'])?></h2>
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
		                            <h2 class="bold text-danger nm"><?= number_format($myInfoService['service_pay_debt'])?></h2>
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
		                            <h2 class="bold text-inverse nm"><?= number_format($myInfoService['service_pay_cancel'])?></h2>
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
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4 class="semibold">Lưu ý!</h4>
                <p>Khi chọn trạng thái <span class="label label-success">Thu phí 100%</span> hệ thống sẽ tự động cập nhật <span class="text-teal">DS Thực thu</span> = <span class="text-info">DS Ký</span></p>
                <p>Khi chọn trạng thái <span class="label label-default">Hợp đồng hủy</span> hệ thống sẽ tự động tính số tiền <span class="text-inverse">DS Hủy</span> dựa thẹo <span class="text-info">DS Ký</span> - <span class="text-teal">DS Thực thu</span></p>
            </div>
        </div>
       <div class="col-md-6">
            <!-- Form default layout -->
            <form class="panel panel-teal" method="post">
                <div class="panel-heading">
                    <h3 class="panel-title">Thanh toán hợp đồng</h3>
                </div>               
                <div class="panel-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Trạng thái hợp đồng</label>
                                <select name="service_status" class="form-control" id="status_ser">
                                    <?= $this->minfoservice->dropdownlistStatus($myInfoService['service_status']);?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                            	<label class="control-label">Lần thanh toán tiếp theo</label>
                            	<input name="service_pay_no" value="<?= $myInfoService['service_pay_no']+1?>" type="number" min="0" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label">Thực thu (VNĐ)</label>
                                <input readonly="readonly" name="service_pay_real" id="real_ser" value="<?= $myInfoService['service_pay_real']?>" type="number" min="0" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label">Thu thêm (VNĐ)</label>
                                <input name="service_pay_more" id="more_ser" type="number" min="0" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="fsubmit" class="btn btn-primary">Lưu</button>
                    <button type="reset" class="btn btn-inverse">Reset</button>
                </div>
            </form>
            <!--/ Form default layout -->
        </div>
        <div class="col-md-6">
            <!-- START panel -->
            <div class="panel panel-info">
                <!-- panel heading/header -->
                <div class="panel-heading">
                    <h4 class="panel-title">Ghi chú hợp đồng</h4>
                </div>
                <!--/ panel heading/header -->
                <!-- panel body with collapse capabale -->
                <div class="panel-collapse">
                    <div class="panel-body slimscroll" style="height:246px;">
                        <ul id="content_note" style="list-style: none;">
                        	<?php if (!empty($myInfoService['pay_note'])): ?>
		                		<?php $content = explode(';', $myInfoService['pay_note']);$i=0; ?>
		                		<?php foreach ($content as $key => $val): ?>
		                			<?php if ($val != ''): ?>
		                				<li>
			                				<div class="alert alert-info pull-right" style="width: 100%;">
	                                            <strong style="word-wrap: break-word;"><?= $val?></strong>
	                                        </div>
	                                        <div class="clearfix"></div>
			                			</li>
		                			<?php endif ?>
		                		<?php endforeach ?>
		                	<?php endif ?>
                        </ul>
                    </div>
                    <div class="panel-footer">
		                <div class="panel-toolbar">
		                    <div class="panel-toolbar">
		                        <div class="input-group" style="width:100%;">
		                            <input type="text" id="text_note" class="form-control" placeholder="Nhập ghi chú">
		                            <span class="input-group-btn">
		                                <button class="btn btn-primary" id="save_note" type="button"><i class="ico-paper-plane"></i> <span class="semibold">Lưu</span></button>
		                            </span>
		                        </div>
		                    </div>
		                </div>
		            </div>
                </div>
                <!--/ panel body with collapse capabale -->
            </div>
            <!--/ END panel -->
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
    $("#status_ser").on('change', function(){
        var id = this.value;
        if (id == 1) {$("#real_ser").val(<?= $myInfoService['service_pay_sign']?>);$("#more_ser").val(0);}
        else {$("#real_ser").val(<?= $myInfoService['service_pay_real']?>);}
    });
    $("#save_note").click(function (){
    	var text = $("#text_note").val()+' <i class="ico-time"></i> <?= date('d-m-Y H:i:s')?>';
    	var idser = <?= $myInfoService['id']?>;
    	var url = '<?= my_lib::cms_site()."infoservice/noteAjax"?>';
    	$.ajax({
            type: 'post',
            data: {"idser":idser, "text":text},
            cache: false,
            url: url,
            success: function(rs) {
                $("#content_note").append(rs);
                $("#text_note").val('');
                jQuery('.slimscroll').slimscroll({ scrollBy: '2000px' });
            }
        });
    });
});
</script>