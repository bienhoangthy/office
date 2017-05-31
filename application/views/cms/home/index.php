
<!--START Template Main -->
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
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- START row -->
        <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="ico-bar-chart"></i> Biểu đồ doanh số <?= date('Y')?> <i class="ico-arrow-right"></i></h3>
                            <div class="panel-toolbar text-right">
                                <div class="option">
                                    <button class="btn down" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-collapse pull in">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-8">
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
                                                            text: 'Biểu đồ doanh số thực thu'
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
                                                                <?= $targets?>
                                                            ]
                                                        }]
                                                    });
                                                });
                                            </script>                                
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-sm-12">
                                            <div class="table-layout animation animating fadeInDown">
                                                <div class="col-xs-4 panel bgcolor-teal">
                                                    <div class="ico-trophy22 fsize24 text-center"></div>
                                                </div>
                                                <div class="col-xs-8 panel">
                                                    <div class="panel-body text-center">
                                                        <h4 class="semibold nm">CHỈ TIÊU</h4>
                                                        <p class="semibold text-danger mb0 mt5"><?= number_format($targetYear)?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="table-layout animation animating fadeInDown">
                                                <div class="col-xs-4 panel" style="background-color: rgb(124, 181, 236);color: #fff;">
                                                    <div class="ico-money fsize24 text-center"></div>
                                                </div>
                                                <div class="col-xs-8 panel">
                                                    <div class="panel-body text-center">
                                                        <h4 class="semibold nm">THỰC THU</h4>
                                                        <p class="semibold text-danger mb0 mt5"><?= number_format($targetCompany)?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="table-layout animation animating fadeInDown">
                                                <div class="col-xs-4 panel" style="background-color: rgb(67, 67, 72);color: #fff;">
                                                    <div class="ico-bomb fsize24 text-center"></div>
                                                </div>
                                                <div class="col-xs-8 panel">
                                                    <div class="panel-body text-center">
                                                        <h4 class="semibold nm">CÒN LẠI</h4>
                                                        <p class="semibold text-danger mb0 mt5"><?= number_format($rest)?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="indicator"><span class="spinner"></span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-teal">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="ico-drawer3"></i> Hợp đồng về  <?= date("Y-m-d")?></h4>
                        </div>
                        <div class="panel-collapse">
                            <div class="panel-body slimscroll" style="height:195px;">
                                <ol>
                                    <?php if (!empty($listContract)): ?>
                                        <?php foreach ($listContract as $key => $value): ?>
                                            <?php 
                                                $myCompany = $this->mcompany->getData(array('id','company_name'),array("id"=>$value['company_id'])); 
                                                $name_type_service = '';
                                                $and_type = 'id = '.$value["service_type"];
                                                $type_service = $this->mservice->getData("service_name",$and_type);
                                                if (!empty($type_service)) {
                                                    $name_type_service = $type_service['service_name'];
                                                }
                                                $link_detail = my_lib::cms_site().'infoservice/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                             ?>
                                            <a href="<?= $link_detail?>"><li><?= $value["service_code"]?> - <?= $myCompany["company_name"]?> - <?= $name_type_service?></li></a>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ol>
                            </div>
                        </div>
                        <!--/ panel body with collapse capabale -->
                    </div>
                    <!--/ END panel -->
                </div>
                <div class="col-md-6">
                    <div class="panel panel-teal">
                        <div class="panel-heading">
                            <h3 class="panel-title">Hợp đồng thu phí</h3>
                            <div class="panel-toolbar text-right">
                                <form class="form-horizontal" method="get" action="<?= my_lib::cms_site()?>infoservice/">
                                    <div class="form-group has-feedback">
                                        <i class="ico-key6 form-control-feedback"></i>
                                        <input type="text" name="fkeyword" class="form-control" placeholder="Mã hợp đồng">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-body slimscroll" style="height:195px;" >
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-hover table-bordered">
                                    
                                    <tbody>
                                        <?php if (!empty($listContractPay)): ?>
                                            <?php foreach ($listContractPay as $key => $value): ?>
                                                <?php 
                                                    $myCompany = $this->mcompany->getData(array('id','company_name'),array("id"=>$value['company_id'])); 
                                                    $name_type_service = '';
                                                    $and_type = 'id = '.$value["service_type"];
                                                    $type_service = $this->mservice->getData("service_name",$and_type);
                                                    if (!empty($type_service)) {
                                                        $name_type_service = $type_service['service_name'];
                                                    }
                                                    $link_detail = my_lib::cms_site().'infoservice/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                 ?>
                                                 <tr>
                                                    <td><a href="<?= $link_detail?>"><?= $value["service_code"]?></a></td>
                                                    <td><p data-toggle="tooltip" title="<?= $myCompany["company_name"]?>"><?php echo word_limiter($myCompany["company_name"], 4) ?></p></td>
                                                    <td><span class="label label-teal"><?= $name_type_service?></span></td>
                                                    <td class="text-center"><span class="label label-primary"><?= $value['service_pay_no']?></span></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary" id="toolbar-showcase">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-stats-up"></i></span> Tiến độ dự án</h3>
                            <div class="panel-toolbar text-right">
                                <div class="option">
                                    <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                    <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive panel-collapse pull out">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên dự án</th>
                                        <th>Mã HĐ</th>
                                        <th>NV Quản lý</th>
                                        <th>Trạng thái</th>
                                        <th>Giao đoạn</th>
                                        <th width="10%">Tiến độ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listProject)): ?>
                                        <?php foreach ($listProject as $key => $value): ?>
                                            <?php 
                                                $infoService = $this->minfoservice->getData('id,service_code',array("id"=>$value['infoservice_id']));
                                                $link_infoservice = my_lib::cms_site().'infoservice/detail/'.$infoService["id"].'/?redirect='.base64_encode(current_url());
                                                $user = $this->muser->getData("user_fullname",array("id"=>$value['project_manager']));
                                                $link_project = my_lib::cms_site().'project/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $status = $this->mproject->listStatus($value['project_status']);
                                                $lastPhase = $this->mproject_phase->getQuery("phase_percent,phase_name","","project_id = ".$value['id']." and phase_status <> 1","id desc",1);
                                                $phaseName = $this->mproject_phase->listPhase($lastPhase['phase_name']);
                                             ?>
                                            <tr>
                                                <td><a href="<?= $link_project?>"><p data-toggle="tooltip" title="<?= $value["project_name"]?>"><?php echo word_limiter($value["project_name"], 4) ?></p></a></td>
                                                <td><a href="<?= $link_infoservice?>"><?= $infoService['service_code']?></a></td>
                                                <td><?= $user['user_fullname']?></td>
                                                <td><span class="label label-<?= $status['color']?>"><?= $status['name']?></span></td>
                                                <?php if (!empty($lastPhase)): ?>
                                                    <td><span class="label label-teal"><?= $phaseName['name']?> (<?= $lastPhase['phase_percent']?>%)</span></td>
                                                    <td>
                                                        <div class="progress progress-xs nm">
                                                            <div class="progress-bar progress-bar-success" style="width:<?= $lastPhase['phase_percent']?>%;"></div>
                                                        </div>
                                                    </td>
                                                <?php else: ?>
                                                    <td><span class="label label-default">Khởi taọ</span></td>
                                                    <td>
                                                        <div class="progress progress-xs nm">
                                                            <div class="progress-bar progress-bar-danger" style="width:0%;"></div>
                                                        </div>
                                                    </td>
                                                <?php endif ?>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <!--/ panel body with collapse capabale -->
                    </div>
                </div>
            </div>                                                            
        </div>
            <!--/ END Left Side -->

            <!-- START Right Side -->
            <div class="col-md-3">                                         
                <!--begin thong bao-->
                <div class="panel panel-minimal" style="margin-left: -20px;">
                    <div class="panel-heading"><h5 class="panel-title"><i class="ico-health mr5"></i>Thông báo</h5></div>                                                
                    <ul class="media-list media-list-feed nm">
                        <?php
                        if(isset($listMessage) && $listMessage)
                        {
                            foreach ($listMessage as $key => $value) {
                                # code...
                                $link_view = my_lib::cms_site().'message/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                echo '<li class="media" style="margin-top: -20px;">';
                                echo '<div class="media-object pull-left">';
                                    echo '<i class="ico-megaphone bgcolor-success"></i>';
                                    echo '</div>';
                                    echo '<div class="media-body">';
                                        echo '<p class="media-heading"><a href="'.$link_view.'">'.$value["ms_title"].'</a></p>';
                                        echo '<p class="media-text">'.my_lib::substring(strip_tags($value["ms_content"]),150).' '.date("d/m/Y", strtotime($value["ms_create_date"])).'</p>';
                                    echo '</div>';
                                echo '</li>';
                            }
                        }
                        ?>                                                                                        
                    </ul>                            
                </div>
                <!--end thong bao-->
                <hr />
                <!--begin thong bao-->
                <div class="panel panel-minimal" style="margin-left: -20px;">
                    <div class="panel-heading"><h5 class="panel-title"><i class="ico-feed3 mr5"></i>Feedback</h5></div>                                                
                    <ul class="media-list media-list-feed nm">
                        <?php
                        if(isset($listFeedback) && $listFeedback)
                        {
                            foreach ($listFeedback as $key => $value) {
                                # code...
                                $link_view = my_lib::cms_site().'feedback/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                echo '<li class="media">';
                                echo '<div class="media-object pull-left">';
                                    echo '<i class=" ico-feed2 bgcolor-warning"></i>';
                                    echo '</div>';
                                    echo '<div class="media-body">';
                                        echo '<p class="media-heading"><a href="'.$link_view.'">'.$value["feedback_title"].'</a></p>';
                                        echo '<p class="media-text">'.my_lib::substring(strip_tags($value["feedback_detail"]),200).'</p>';
                                        echo '<p class="media-meta">'.date("d/m/Y H:i:s", strtotime($value["feedback_create_date"])).'</p>';
                                    echo '</div>';
                                echo '</li>';
                            }
                        }
                        ?>                                                                                        
                    </ul>                            
                </div>
                <!--end thong bao-->
            </div>
        </div>
    </div>
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<!--/ END Template Main-->


<script type="text/javascript" src="<?= my_lib::cms_js()?>fullcalendar/js/fullcalendar.min.js"></script>
<link rel="stylesheet" href="<?= my_lib::cms_js()?>fullcalendar/css/fullcalendar.min.css">
<script type="text/javascript" charset="utf-8" async defer>
$(function () {
    var date = new Date(),
        d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();

    $("#full_calendar").fullCalendar({
        header: {
            left: false,
            center: false,
            right: false
        }
    });    
});

</script>