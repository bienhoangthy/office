
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?></h4>
            </div>
            <div class="page-header-section">
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li><a href="<?= my_lib::cms_site()?>project/">Dự án</a></li>
                        <li class="active"><?= $title?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-4">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#info" data-toggle="tab">Thông Tin</a></li>
                    <li><a href="#description" data-toggle="tab">Mô tả</a></li>
                    <li><a href="#note" data-toggle="tab">Ghi chú</a></li>
                    <?php if ($boss == 1): ?>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Hành động <i class="caret"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="<?= my_lib::cms_site()?>project/edit/<?= $myProject['id'].'/?redirect='.base64_encode(current_url())?>">Cập nhật</a></li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
                <!--/ tab -->
                <!-- tab content -->
                <div class="tab-content panel">
                    <div class="tab-pane active" id="info">
                        <div class="panel-body pt0">
                            <?php 
                            $project_startday = date("Y-m-d",strtotime($myProject['project_startday']));
                            $day = (strtotime($myProject['project_deadline']) - strtotime($project_startday));
                            $workday = (strtotime(date('Y-m-d')) - strtotime($project_startday));
                            $per = ($workday * 100)/$day;
                            $per = $per>=0 ? $per: 100;
                            $color = $per<80.0 ? 'success' : 'danger';
                            $color_bonus = ($myProject['project_status'] == 2) ? 'warning' : 'teal' ;
                            //Deadline
                            $date_now = date('Y-m-d');
                            if ($myProject['project_status'] == 2) {
                                $date_now = date("Y-m-d", strtotime($myProject['project_endday']));
                            }
                            $restday = (strtotime($myProject['project_deadline']) - strtotime($date_now)) / (60 * 60 * 24);
                            if ($restday < 0 && $myProject['project_status'] == 1) {
                                $this->mproject->edit($myProject['id'],array('project_delay' => 1));
                                $myProject['project_delay'] = 1;
                            }
                            $day = $day / (60 * 60 * 24);
                            ?>
                            <?php if ($myProject['project_bonus'] > 0): ?>
                                <?php 
                                    if ($restday == 0) {
                                        $plus = 0;
                                        $minus = 0;
                                    } else {
                                        if ($restday > 0) {
                                            $plus = ($restday * 100) / $day;
                                            $plus = number_format($plus,2);
                                            $minus = 0;
                                            if ($myProject['project_status'] == 2) {
                                                $moneyBonus = $myProject['project_bonus'] * $plus / 100;
                                                $myProject['project_bonus'] = $myProject['project_bonus'] + $moneyBonus;
                                            }
                                        } else {
                                            $plus = 0;
                                            $minus = (abs($restday) * 100) / $day;
                                            $minus = number_format($minus,2);
                                            $minus = ($minus > 50) ? 100 : $minus;
                                            if ($myProject['project_status'] == 2) {
                                                $moneyBonus = $myProject['project_bonus'] * $minus / 100;
                                                $myProject['project_bonus'] = $myProject['project_bonus'] - $moneyBonus;
                                            }
                                        }
                                    }
                                 ?>
                                <div class="widget panel bgcolor-<?= $color_bonus?>">
                                    <!-- panel body -->
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <p class="pull-left semibold">THƯỞNG DỰ ÁN (VNĐ)</p>
                                        </div>
                                        <div class="text-center mt15 mb15">
                                            <h1 class="semibold">
                                                <i class="ico-gift22"></i>
                                                <span class=""><?= number_format($myProject['project_bonus'])?></span>
                                            </h1>
                                        </div>
                                        <div class="clearfix">
                                            <?php if ($plus != 0): ?>
                                                <p class="pull-left semibold nm">
                                                    <i class="ico-plus"></i> <?= $plus?>%
                                                </p>
                                            <?php endif ?>
                                            <?php if ($minus != 0): ?>
                                                <p class="pull-left semibold nm">
                                                    <i class="ico-minus"></i> <?= $minus?>%
                                                </p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <!--/ panel body -->
                                </div>
                            <?php endif ?>
                            
                            <p class="semibold mb5">Tên dự án</p>
                            <ul class="list-unstyled mb10">
                                <i class="ico-notebook text-muted mr5"></i> <?= $myProject['project_name']?>
                            </ul>
                            <p class="semibold mb5">Ngày bắt đầu</p>
                            <ul class="list-unstyled mb10">
                                <i class="ico-bookmark text-muted mr5"></i> <?= $myProject['project_startday']?>
                            </ul>
                            <p class="semibold mb5">Deadline</p>
                            <ul class="list-unstyled mb10">
                                <li><i class="ico-busy4 text-muted mr5"></i> <?= $myProject['project_deadline']?></li>
                                <li>
                                    <div class="progress progress-xs mb5">
                                        <div class="progress-bar progress-bar-<?= $color?>" style="width:<?= $per?>%"></div>
                                    </div>
                                </li>
                            </ul>
                            <p class="semibold mb5">Có <?= $day?> ngày làm <?php if ($restday >= 0): ?>
                                (Còn <?= $restday ?> ngày)
                            <?php endif ?></p>
                            <p class="semibold mb5">Ngày hoàn thành <?php if ($myProject['project_delay'] == 1): ?>
                                <span class="label label-danger">Delay</span>
                            <?php endif ?></p>
                            <ul class="list-unstyled mb10">
                                <i class="ico-racing text-muted mr5"></i> <?= $myProject['project_endday']?>
                            </ul>
                            <p class="semibold mb5">Trạng thái</p>
                            <?php $status = $this->mproject->listStatus($myProject['project_status']); ?>
                            <ul class="list-unstyled mb10">
                                <span class="label label-<?= $status['color']?>"><?= $status['name']?></span>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="description">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                    </div>
                                    <div class="table-responsive panel-collapse pull out">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Giai đoạn</th>
                                                    <th>Thời gian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($listPhase)): ?>
                                                    <?php foreach ($listPhase as $key => $value): ?>
                                                        <?php
                                                        $phaseSub = $this->mproject_phase->listPhase($value['phase_name']);
                                                        $daywork = (strtotime($value['phase_deadline']) - strtotime($value['phase_startday'])) / (60 * 60 * 24);
                                                        ?>
                                                        <tr>
                                                            <td><?= $phaseSub['name']?></td>
                                                            <td><?= $daywork?> ngày</td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/ panel body with collapse capabale -->
                                </div>
                                <!--/ END panel -->
                            </div>
                        </div>
                        <hr>
                        <?= $myProject['project_description']?>
                    </div>
                    <div class="tab-pane" id="note">
                        <div class="row" id="tags-note">
                            <?php if (!empty($listNote)): ?>
                                <?php foreach ($listNote as $key => $value): ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-<?= $value['note_color']?>">
                                            <strong><?= $value['note_user_fullname']?>:</strong> <?= $value['note_content']?><br>
                                            <small><?= $value['note_date']?></small>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                        <hr>
                        <div class="panel-toolbar">
                            <div class="form-group">
                                <select id="color-note" class="form-control">
                                    <option value="default">Chọn màu</option>
                                    <option value="success">Green</option>
                                    <option value="info">Blue</option>
                                    <option value="warning">Yellow</option>
                                    <option value="danger">Red</option>
                                </select>
                            </div>
                            <div class="input-group" style="width:100%;">
                                <input type="text" id="content-note" class="form-control" placeholder="Nội dung">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="send-note" type="button"><i class="ico-paper-plane"></i> <span class="semibold">Gửi</span></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ tab content -->
            </div>
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="ico-users mr5"></i> Nhân sự dự án</h3>
                        <div class="panel-toolbar text-right">
                            <?php if ($boss == 1): ?>
                                <a href="<?= my_lib::cms_site().'project/addPersonnel/'.$myProject['id'].'/?redirect='.base64_encode(current_url());?>"><button class="btn btn-teal"><i class="ico-user-plus2"></i> Thêm</button></a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="panel-collapse pull out">
                        <div class="panel-body">
                            <div class="row">
                            	<?php if (!empty($listPhase)): ?>
                            		<?php foreach ($listPhase as $key => $value): ?>
                            			<?php 
                                        $day = -1;
                                        $date_now = date('Y-m-d');
                                        if ($value['phase_delay'] != 1 && $value['phase_status'] != 3 && strtotime($date_now) >= strtotime($value['phase_startday'])) {
                                            $day = (strtotime($value['phase_deadline']) - strtotime($date_now)) / (60 * 60 * 24);
                                            if ($day<0) {
                                                if ($this->mproject_phase->edit($value['id'],array("phase_delay"=>1))) {
                                                    $value['phase_delay'] = 1;
                                                }
                                            }
                                        }
                                        $phase_name = $this->mproject_phase->listPhase($value['phase_name']);
                                        $phase_status = $this->mproject_phase->listStatus($value['phase_status']);
                                        $user = $this->muser->getData("user_fullname,user_avatar",array("id"=>$value['user_id']));
                                        $avatar_emp = $user['user_avatar'] != '' ? my_lib::base_url().'media/user/'.$user['user_avatar'] : my_lib::cms_img().'logo.png';
                                        $link_update = my_lib::cms_site().'project/editPersonnel/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        ?>
                                        <div class="col-md-12" style="margin-top: -15px;">
                                           <div class="thumbnail thumbnail-album animation animating fadeInLeft">
                                              <ul class="meta">
                                               <li>
                                                   <div class="img-group img-group-stack">
                                                       <img src="<?= $avatar_emp?>" class="img-circle" alt="<?= $user['user_fullname']?>" />
                                                   </div>
                                                   <?php if ($s_info['s_user_id'] == $value['user_id']): ?>
                                                     <a href="<?= $link_update?>" class="pull-right"><button class="btn btn-primary btn-sm">Cập nhật</button></a>
                                                 <?php endif ?>
                                                 <li>
                                                  <h3 class="semibold pull-right mt0 mb5 text-<?= $phase_name['color']?>"><?= $phase_name['name']?><br><span class="label label-<?= $phase_status['color']?> pull-right"><?= $phase_status['name']?></span></h3>
                                              </li>
                                          </li>
                                      </ul>
                                      <h5 class="text-primary semibold mt0"><?= $user['user_fullname']?> <code>Hoàn thành <?= $value['phase_percent']?>% công việc</code></h5>
                                      <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: <?= $value['phase_percent']?>%">
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-4">
                                          <p class="semibold mb5">Ngày bắt đầu</p>
                                          <ul class="list-unstyled mb10">
                                              <i class="ico-racing text-muted mr5"></i> <?= $value['phase_startday']?>
                                          </ul>
                                      </div>
                                      <div class="col-md-4">
                                          <p class="semibold mb5">Deadline <?php if ($day > 0): ?>
                                             (<?= $day?> ngày)
                                         <?php endif ?></p>
                                         <ul class="list-unstyled mb10">
                                          <i class="ico-stopwatch text-muted mr5"></i> <span class="text-danger"><?= $value['phase_deadline']?></span>
                                      </ul>
                                  </div>
                                  <div class="col-md-4">
                                      <p class="semibold mb5">Ngày hoàn thành</p>
                                      <ul class="list-unstyled mb10">
                                          <i class="ico-medal text-muted mr5"></i> <?= $value['phase_endday']?>
                                      </ul>
                                  </div>
                              </div>
                              <address class="nm">
                                <p class="semibold nm">Ghi chú <?php if ($value['phase_delay'] == 1): ?>
                                   <span class="label label-danger">Delay</span>
                               <?php endif ?></p>
                               <code><?= $value['phase_note']?></code>
                           </address>
                           <hr/>
                       </div>
                   </div>
               <?php endforeach ?>
           <?php endif ?>
       </div>
   </div>
</div>
<div class="indicator"><span class="spinner"></span></div>
</div>
</div>
<div class="col-md-3">
    <div class="widget panel">
        <div class="panel-body">
            <h4 class="mb0">Hoạt động <i class="ico-bubble-quote text-danger pull-right"></i></h4>
            <hr/>
            <?php if (!empty($manager)): ?>
               <?php 
               $avatar = $manager['user_avatar'] != '' ? my_lib::base_url().'media/user/'.$manager['user_avatar'] : my_lib::cms_img().'logo.png';
               ?>
               <ul class="list-table">
                   <li style="width:70px;">
                       <img class="img-circle img-bordered-primary" src="<?= $avatar?>" alt="<?= $manager['user_fullname']?>" width="50px" />
                   </li>
                   <li class="text-left">
                       <h5 class="semibold ellipsis nm"><?= $manager['user_fullname']?></h5>
                       <p class="text-muted nm">Quản lý dự án</p>
                   </li>
               </ul>
           <?php endif ?>
       </div>
       <!--/ panel body -->
       <!-- List group -->
       <ul class="list-group">
           <?php
           $listActive = explode('/', $myProject['project_log']);
           ?>
           <?php foreach ($listActive as $key => $value): ?>
              <?php if ($value != ''): ?>
                 <li class="list-group-item">
                    <?php $active = explode('|', $value) ?>
                    <p class="nm"><?= $active[0]?></p>
                    <small class="text-muted"><?= $active[1]?></small>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>
</div>
</div>      
</div>
<a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#send-note").click(function(){
            var content = $("#content-note").val();
            var color = $("#color-note").val();
            var fullname = "<?= $s_info['s_user_fullname']?>";
            var project_id = <?= $myProject['id']?>;
            var url = '<?= my_lib::cms_site()."project/noteAjax"?>';
            $.ajax({
                type: 'post',
                data: {"content":content, "color":color, "fullname":fullname, "project_id":project_id},
                cache: false,
                url: url,
                success: function(rs) {
                    $("#tags-note").append(rs);
                    $("#content-note").val('');
                }
            });
        });
    });
</script>