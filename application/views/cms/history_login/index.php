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
                <div class="panel panel-teal">
                    <!-- panel heading/header -->
                    <div class="panel-heading">
                        <h3 class="panel-title ellipsis"><i class="ico-chrome mr5"></i>Lịch sử đăng nhập</h3>                                        
                    </div>
                    <!--/ panel heading/header -->
                    <!-- panel body with collapse capabale -->
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Phòng ban</th>
                                    <th>Trình duyệt</th>
                                    <th>Version</th>
                                    <th>Platform</th>
                                    <th>Thời gian</th>                                                    
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($listHistory) && $listHistory)
                            {                                                
                                foreach ($listHistory as $key => $value) 
                                {                                                    
                                    echo '<tr>';
                                        echo '<td>'.$value["history_username"].'</td>';                                                        
                                        echo '<td>'.$value["history_department"].'</td>';                                                        
                                        echo '<td><span class="semibold text-accent">'.$value["history_agent"].'</span></td>';
                                        echo '<td>'.$value["history_version"].'</td>';                                                        
                                        echo '<td>'.$value["history_platform"].'</td>';                                                        
                                        echo '<td>'.$value["history_time"].'</td>';                                                        
                                        echo '<td>'.$value["history_ip"];                                                        
                                        if($value["history_ip"] != config_ip){
                                            echo '<br /><label class="label label-danger">Không phải IP công ty</label>';
                                        }
                                        echo '</td>';
                                    echo '</tr>';                                                    
                                }
                            }
                            ?>                                                
                            </tbody>
                        </table>
                    </div><!--/ panel body with collapse capabale -->
                </div>                            
            </div>
        </div> 
        <!--/ END row -->                        
    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<!--/ END Template Main-->
        