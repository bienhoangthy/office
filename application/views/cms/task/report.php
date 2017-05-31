
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Thống kê công việc của <?= $userCur['user_fullname']?> từ ngày <?= $date?></h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li><a href="<?= my_lib::cms_site()?>task/">Danh sách công việc</a></li>
                        <li class="active">Thống kê</li>
                    </ol>
                </div>
            </div>
            <div class="text-left">
                <a href="<?= my_lib::cms_site()?>task/"><button type="button" class="btn btn-teal"><span class="ico-backspace"></span> Bảng danh sách công việc</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-4">
                        <!-- START Statistic Widget -->
                        <div class="table-layout animation animating fadeInDown">
                            <div class="col-xs-4 panel bgcolor-info">
                                <div class="ico-stats-up fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-8 panel">
                                <div class="panel-body text-center">
                                    <h4 class="semibold nm"><?= $total?></h4>
                                    <p class="semibold text-muted mb0 mt5">CÔNG VIỆC</p>
                                </div>
                            </div>
                        </div>
                        <!--/ END Statistic Widget -->
                    </div>
                    <div class="col-sm-4">
                        <!-- START Statistic Widget -->
                        <div class="table-layout animation animating fadeInUp">
                            <div class="col-xs-4 panel bgcolor-success">
                                <div class="ico-smile fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-8 panel">
                                <div class="panel-body text-center">
                                    <h4 class="semibold nm"><?= $complete?></h4>
                                    <p class="semibold text-muted mb0 mt5">HOÀN THÀNH</p>
                                </div>
                            </div>
                        </div>
                        <!--/ END Statistic Widget -->
                    </div>
                    <div class="col-sm-4">
                        <!-- START Statistic Widget -->
                        <div class="table-layout animation animating fadeInDown">
                            <div class="col-xs-4 panel bgcolor-danger">
                                <div class="ico-frown fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-8 panel">
                                <div class="panel-body text-center">
                                    <h4 class="semibold nm"><?= $total - $complete?></h4>
                                    <p class="semibold text-muted mb0 mt5">CHƯA HOÀN THÀNH</p>
                                </div>
                            </div>
                        </div>
                        <!--/ END Statistic Widget -->
                    </div>
                    <div class="col-sm-4">
                        <!-- START Statistic Widget -->
                        <div class="table-layout animation animating fadeInDown">
                            <div class="col-xs-4 panel bgcolor-warning">
                                <div class="ico-minus-circle2 fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-8 panel">
                                <div class="panel-body text-center">
                                    <h4 class="semibold nm"><?= $delay?></h4>
                                    <p class="semibold text-muted mb0 mt5">DELAY</p>
                                </div>
                            </div>
                        </div>
                        <!--/ END Statistic Widget -->
                    </div>
                    <div class="col-sm-4">
                        <!-- START Statistic Widget -->
                        <div class="table-layout animation animating fadeInUp">
                            <div class="col-xs-4 panel bgcolor-default">
                                <div class="ico-wave2 fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-8 panel">
                                <div class="panel-body text-center">
                                    <h4 class="semibold nm"><?= $plan?></h4>
                                    <p class="semibold text-muted mb0 mt5">TỰ LÊN KẾ HOẠCH</p>
                                </div>
                            </div>
                        </div>
                        <!--/ END Statistic Widget -->
                    </div>
                    <div class="col-sm-4">
                        <!-- START Statistic Widget -->
                        <div class="table-layout animation animating fadeInDown">
                            <div class="col-xs-4 panel bgcolor-teal">
                                <div class="ico-wand fsize24 text-center"></div>
                            </div>
                            <div class="col-xs-8 panel">
                                <div class="panel-body text-center">
                                    <h4 class="semibold nm"><?= $assigned?></h4>
                                    <p class="semibold text-muted mb0 mt5">VIỆC ĐƯỢC GIAO</p>
                                </div>
                            </div>
                        </div>
                        <!--/ END Statistic Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ END row -->
                    
    </div>
    <!--/ END Template Container -->

    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>