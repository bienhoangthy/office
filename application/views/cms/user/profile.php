<section id="main" role="main">    
    <div class="container-fluid">        
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?></h4>
            </div>
            <div class="page-header-section">                
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>                        
                        <li class="active"><?= $title?></li>
                    </ol>
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
        <?php if (!empty($myUser)): ?>
              <div class="row">
                <div class="col-lg-3">
                    <!-- tab menu -->
                    <ul class="list-table">
                        <li style="width:70px;">
                            <?php 
                                $avatar = my_lib::base_url().'media/user/'.$myUser['user_avatar'];
                                if ($myUser['user_avatar'] == "") {
                                    $avatar = my_lib::cms_img().'logo.png';
                                }
                             ?>
                            <img class="img-circle img-bordered" src="<?= $avatar?>">
                        </li>
                        <li class="text-left">
                            <h5 class="semibold ellipsis mt0"><?= $myUser['user_fullname']?></h5>
                            <span class="pull-right text-muted">ID: <?= $myUser['id']?></span>
                            <span class="pull-left text-muted"><?= $myUser['user_username']?></span><br>
                            <?php $nameStatus = $this->muser->listStatusName($myUser['user_status']) ?>
                            <span class="label label-primary"><?= $nameStatus['name']?></span>
                        </li>
                    </ul>
                    <hr>
                    <ul class="list-group list-group-tabs">
                        <li class="list-group-item <?= $tag == 'ttcb' ? 'active' : ''?>"><a href="#ttcb" data-toggle="tab"><i class="ico-user2 mr5"></i> Thông tin cơ bản</a></li>
                        <li class="list-group-item <?= $tag == 'tk' ? 'active' : ''?>"><a href="#tk" data-toggle="tab"><i class="ico-archive2 mr5"></i> Tài khoản</a></li>
                        <li class="list-group-item <?= $tag == 'ttld' ? 'active' : ''?>"><a href="#ttld" data-toggle="tab"><i class="ico-shield3 mr5"></i> Thông tin lao động</a></li>
                        <li class="list-group-item <?= $tag == 'mxh' ? 'active' : ''?>"><a href="#mxh" data-toggle="tab"><i class="ico-github mr5"></i> Mạng xã hội</a></li>
                    </ul>
                    <?php if (!empty($targetsUser) && $myUser['user_group'] != 1): ?>
                        <hr>
                        <div>
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>DS Nhận</th>
                                        <td><span class="label label-teal"><?= number_format($myUser['user_targets'])?> vnđ</span></td>
                                    </tr>
                                    <tr>
                                        <th>DS Thực thu</th>
                                        <td><span class="label label-teal"><?= number_format($targetUser)?> vnđ</span></td>
                                    </tr>
                                    <tr>
                                        <th>DS Ký</th>
                                        <td><span class="label label-teal"><span class="label label-teal"><?= number_format($signUser)?> vnđ</span></td>
                                    </tr>
                                    <tr>
                                        <th>Còn lại</th>
                                        <td><span class="label label-danger"><span class="label label-danger"><?= number_format($myUser['user_targets'] - $targetUser)?> vnđ</span></td>
                                    </tr>
                                    <tr>
                                        <th>Nợ</th>
                                        <td><span class="label label-danger"><?= number_format($debtUser)?> vnđ</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="panel panel-default">  
                                <div id="target"></div>
                                <script type="text/javascript" charset="utf-8" async defer>
                                    $(function () {
                                        $('#target').highcharts({
                                            chart: {
                                                plotBackgroundColor: null,
                                                plotBorderWidth: null,
                                                plotShadow: false
                                            },
                                            title: {
                                                text: 'Biểu đồ doanh số'
                                            },
                                            tooltip: {
                                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                            },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: 'pointer',
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                        style: {
                                                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                                        }
                                                    }
                                                }
                                            },
                                            series: [{
                                                type: 'pie',
                                                name: 'Browser share',
                                                data: [
                                                    <?= $targetsUser?>
                                                ]
                                            }]
                                        });
                                    });
                                </script>                                
                            </div> 
                        </div>
                    <?php endif ?>
                    <?php if ($s_info['s_user_group'] == 1): ?>
                        <hr>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="ico-pie5 mr5"></i> Gán doanh số</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="result"></div>
                                    <div class="input-group">
                                        <input type="number" min="0" step="1000000" value="<?= $myUser['user_targets']?>" id="input_targets" class="form-control">
                                        <span class="input-group-btn">
                                            <button id="targetbtn" class="btn btn-teal" type="button">Go!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content">
                        <div class="tab-pane <?= $tag == 'ttcb' ? 'active' : ''?>" id="ttcb">
                            <form class="panel form-horizontal form-bordered" name="form-profile" enctype="multipart/form-data" method="post">
                                <div class="panel-body pt0 pb0">
                                    <div class="form-group header bgcolor-default">
                                        <div class="col-md-12">
                                            <h4 class="semibold text-primary mt0 mb5">Thông tin cơ bản</h4>
                                            <p class="text-default nm">Các thông tin cơ bản về bản thân các bạn có thể cập nhật để chính xác hơn.</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Avatar</label>
                                        <div class="col-sm-9">
                                            <div class="btn-group pr5">
                                                <img class="img-circle img-bordered" src="<?= $avatar?>">
                                            </div>
                                            <input type="file" name="_file" id="_file" class="form-control mt10" style="width: 405px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Họ và tên <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="user_fullname" value="<?= $myUser['user_fullname']?>" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giới tính</label>
                                        <div class="col-sm-5">
                                            <span class="radio custom-radio custom-radio-primary">  
                                                <input <?= $myUser['user_gender']==1?'checked':''?> type="radio" id="user_gender1" name="user_gender" value="1">  
                                                <label for="user_gender1">&nbsp;&nbsp;Nam</label>

                                                <input <?= $myUser['user_gender']==0?'checked':''?> type="radio" id="user_gender0" name="user_gender" value="0">  
                                                <label for="user_gender0">&nbsp;&nbsp;Nữ</label>
                                            </span> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ngày sinh</label>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="1991-19-12" class="form-control" id="user_birthday" name="user_birthday" value="<?= $myUser['user_birthday']?>">
                                                    <small class="help-block text-danger">Năm-Tháng-Ngày</small>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Trình độ học vấn</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="user_academic" name="user_academic" value="<?= $myUser['user_academic']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Địa chỉ tạm trú</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="user_address" name="user_address" value="<?= $myUser['user_address']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Địa chỉ thường trú</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="user_hometown" name="user_hometown" value="<?= $myUser['user_hometown']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Chứng minh nhân dân</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="user_identity" name="user_identity" value="<?= $myUser['user_identity']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ngày cấp</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="1991-19-12" id="user_identity_day" name="user_identity_day" value="<?= $myUser['user_identity_day']?>">
                                            <small class="help-block text-danger">Năm-Tháng-Ngày</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nơi cấp</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="user_identity_place" name="user_identity_place" value="<?= $myUser['user_identity_place']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Số điện thoại <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="user_hotline" name="user_hotline" value="<?= $myUser['user_hotline']?>" required="required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">SĐT người thân</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="user_phone_parent" name="user_phone_parent" value="<?= $myUser['user_phone_parent']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">SĐT Cty cung cấp</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="user_phone_company" name="user_phone_company" value="<?= $myUser['user_phone_company']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" id="user_email" name="user_email" value="<?= $myUser['user_email']?>" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="submit" name="fbasicInfo" class="btn btn-primary">Lưu thay đổi</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </form>
                            <!--/ form profile -->
                        </div>
                        <div class="tab-pane <?= $tag == 'tk' ? 'active' : ''?>" id="tk">
                            <form class="panel form-horizontal form-bordered" name="form-account" method="post">
                                <div class="panel-body pt0 pb0">
                                    <div class="form-group header bgcolor-default">
                                        <div class="col-md-12">
                                            <h4 class="semibold text-primary mt0 mb5">Tài khoản</h4>
                                            <p class="text-default nm">Tài khoản bạn có thể sử dụng để đăng nhập vào CRM của TS Media.</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Username</label>
                                        <div class="col-sm-6">
                                            <input type="text" readonly="readonly" class="form-control" value="<?= $myUser['user_username']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Level</label>
                                        <div class="col-sm-6">
                                            <select class="form-control user_group" disabled="disabled">
                                                <?= $this->mgroup->dropdownlist($myUser['user_group']);?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group header bgcolor-default">
                                        <div class="col-md-12">
                                            <h4 class="semibold text-primary mt0 mb5">Đổi mật khẩu</h4>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mật khẩu cũ <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="password" name="oldPass" class="form-control" placeholder="Nhập mật khẩu cũ" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mật khẩu mới <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="password" name="newPass" class="form-control" placeholder="Nhập mật khẩu mới" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nhập lại <span class="text-danger">*</span></label>
                                        <div class="col-sm-6">
                                            <input type="password" name="renewPass" class="form-control" placeholder="Nhập mật khẩu mới" >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="submit" name="fAccount" class="btn btn-primary">Lưu thay đổi</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </form>
                            <!--/ form account -->
                        </div>
                        <div class="tab-pane <?= $tag == 'ttld' ? 'active' : ''?>" id="ttld">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="semibold text-primary mt0 mb5" style="padding-top: 10px;">Thông tin lao động</h4>
                                        <p class="text-default nm" style="padding-bottom: 10px;">Thông tin về chức vụ, người quản lý, hợp động, lương...</p>
                                    </div>
                                    <div class="panel-collapse pull out">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <address>
                                                        <strong>Phòng Ban</strong><br>
                                                        <?php $department = $this->mdepartment->getData('department_name',array('id' => $myUser['user_department'])) ?>
                                                        <?php if (!empty($department)): ?>
                                                            <?= $department['department_name']?><br>
                                                        <?php endif ?>
                                                    </address>
                                                    <address>
                                                        <strong>Người quản lý</strong><br>
                                                        <?php $parent = $this->muser->getData('user_fullname',array('id' => $myUser['user_parent'])) ?>
                                                        <?php if (!empty($parent)): ?>
                                                            <?= $parent['user_fullname']?><br>
                                                        <?php endif ?>
                                                    </address>
                                                    <address>
                                                        <strong>Chức vụ</strong><br>
                                                        <?= $myUser['user_position']?><br>
                                                    </address>
                                                    <address>
                                                        <strong>Tình trạng</strong><br>
                                                        <?php $nameState = $this->muser->listState($myUser['user_state']) ?>
                                                        <?= $nameState['name']?><br>
                                                    </address>
                                                </div>
                                                <div class="col-md-6">
                                                    <address>
                                                        <strong>Ngày ký hợp đồng</strong><br>
                                                        <?= date('d-m-Y', strtotime($myUser['user_contractday']))?><br>
                                                    </address>
                                                    <address>
                                                        <strong>Thời hạn</strong><br>
                                                        <?= $myUser['user_contracttime']?> Tháng<br>
                                                    </address>
                                                    <address>
                                                        <strong>Mức lương</strong><br>
                                                        <?= number_format($myUser['user_wage'])?> VNĐ<br>
                                                    </address>
                                                    <address>
                                                        <strong>Thông tin tài khoản ngân hàng</strong><br>
                                                        <?= $myUser['user_accountbank']?><br>
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Lịch sử hoạt động</h3>
                                        <!-- <div class="panel-toolbar text-right">
                                            <a href="#"><button class="btn btn-primary"><i class="ico-plus"></i> Thêm</button></a>
                                        </div> -->
                                    </div>
                                    <div class="table-responsive panel-collapse pull out">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Loại hoạt động</th>
                                                    <th class="text-center">Chức vụ</th>
                                                    <th class="text-center">Ngày bắt đầu</th>
                                                    <th class="text-center">Thời hạn</th>
                                                    <th class="text-center">Lương căn bản</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($work_history)): ?>
                                                    <?php foreach ($work_history as $key => $value): ?>
                                                        <?php $type_active = $this->muser->listState($value['type_active']); ?>
                                                        <tr>
                                                            <td class="text-center"><span class="label label-<?= $type_active['color']?>"><?= $type_active['name']?></span></td>
                                                            <td class="text-center"><?= $value['position']?></td>
                                                            <td class="text-center"><?= $value['work_startday']?></td>
                                                            <td class="text-center"><?= $value['work_duration']?> tháng</td>
                                                            <td class="text-center"><?= number_format($value['measure'])?> vnđ</td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane <?= $tag == 'mxh' ? 'active' : ''?>" id="mxh">
                            <!-- form password -->
                            <form class="panel form-horizontal form-bordered" name="form-social" method="post">
                                <div class="panel-body pt0 pb0">
                                    <div class="form-group header bgcolor-default">
                                        <div class="col-md-12">
                                            <h4 class="semibold text-primary mt0 mb5">Các trang mạng xã hội.</h4>
                                            <p class="text-default nm">Cập nhật các mạng xã hội cho profile</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Facebook</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="user_facebook" name="user_facebook" value="<?= $myUser['user_facebook']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Google +</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="user_google" name="user_google" value="<?= $myUser['user_google']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Yahoo</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="user_yahoo" name="user_yahoo" value="<?= $myUser['user_yahoo']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Twitter</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="user_twitter" name="user_twitter" value="<?= $myUser['user_twitter']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Skype</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="user_skype" name="user_skype" value="<?= $myUser['user_skype']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giới thiệu</label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control" id="user_intro" name="user_intro" ><?= $myUser['user_intro']?></textarea>  
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                <button type="submit" name="fSocial" class="btn btn-primary">Lưu thay đổi</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        <?php endif ?>      
                    
    </div>    
    
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>    
</section>
<script>
    $(document).ready(function(){
        $("#targetbtn").click(function(){
            var id = <?= $myUser['id']?>;
            var targets = $("#input_targets").val();
            var url = '<?= my_lib::cms_site()."user/targetAjax"?>';
            $.ajax({
            type: 'post',
            data: {"id":id, "targets":targets},
            cache: false,
            url: url,
            success: function(rs) {
                $("#result").append(rs);
            }
        });
        });
    });
</script>