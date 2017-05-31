<section id="main" role="main">
    <div class="container-fluid">    
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?> <span class="label label-danger"><?= $textFilter?></span></h4>
                <form method="get" action="<?= my_lib::cms_site()?>account/report" id="flistData">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">                                         
                         <div class="input-group">
                            <input type="number" value="<?= $formData['ftime']?>" name="ftime" min="1" class="form-control">
                            <div class="input-group-btn">
                                <select class="btn btn-primary dropdown-toggle" name="ftypeTime" data-toggle="dropdown">
                                    <ul class="dropdown-menu pull-right">
                                        <?= $ftypeTime?>
                                    </ul>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-1 col-lg-3">                                         
                        <select onchange="this.form.submit()" class="form-control fyear" name="fyear">                      
                            <?= $fyear;?>
                        </select>  
                    </div>
                </form>
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
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-teal">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="ico-enter3 mr5"></i> Báo cáo thu</h3>
                        <div class="panel-toolbar text-right">
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Loại thu</th>
                                    <th>Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listIn as $key => $value): ?>
                                    <?php
                                        $totalType = $this->maccount->totalMoney($value['id'],$and);
                                        $totalIn += $totalType['totalMoney']; 
                                    ?>
                                    <tr>
                                        <td><?= $value['type_name']?></td>
                                        <td class="text-center"><?php if ($totalType['totalMoney'] > 0): ?>
                                            <?= number_format($totalType['totalMoney'])?>
                                        <?php endif ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr>
                                    <td class="text-center text-teal"><h3>Tổng cộng</h3></td>
                                    <td class="text-center text-danger"><h3><?= number_format($totalIn)?></h3></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--/ panel body with collapse capabale -->
                </div>
                <!--/ END panel -->
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="ico-exit3 mr5"></i> Báo cáo chi</h3>
                        <div class="panel-toolbar text-right">
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Loại chi</th>
                                    <th>Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listOut as $key => $value): ?>
                                    <?php 
                                        $totalType_parent = $this->maccount->totalMoney($value['id'],$and);
                                        $totalOut += $totalType_parent['totalMoney'];
                                        $outSub = $this->maccount_type->getQuery('','','type_status = 1 and type_parent = '.$value['id'],'type_orderby asc','');
                                     ?>
                                    <tr>
                                        <td><?= $value['type_name']?></td>
                                        <td class="text-center"><?php if ($totalType_parent['totalMoney'] > 0): ?>
                                            <?= number_format($totalType_parent['totalMoney'])?>
                                        <?php endif ?></td>
                                    </tr>
                                    <?php if (!empty($outSub)): ?>
                                        <?php foreach ($outSub as $key => $val): ?>
                                            <?php
                                                $totalType = $this->maccount->totalMoney($val['id'],$and);
                                                $totalOut += $totalType['totalMoney'];
                                            ?>
                                            <tr>
                                                <td class="text-teal">&nbsp; &nbsp;<?= $val['type_name']?></td>
                                                <td class="text-center"><?php if ($totalType['totalMoney'] > 0): ?>
                                                    <?= number_format($totalType['totalMoney'])?>
                                                <?php endif ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <tr>
                                    <td class="text-center text-primary"><h3>Tổng cộng</h3></td>
                                    <td class="text-center text-danger"><h3><?= number_format($totalOut)?></h3></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--/ panel body with collapse capabale -->
                </div>
                <!--/ END panel -->
            </div>
        </div>  
        <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a></section>
    </div>
</section>
<!--end addInfoContactPopup-->
<script type="text/javascript" src="<?= my_lib::cms_js()?>jqueryui/js/jquery-ui-timepicker-addon.js"></script>
<link type="text/css" rel="stylesheet" href="<?= my_lib::cms_js()?>jqueryui/css/jquery-ui-timepicker-addon.css" media="screen" />
<script>
$(function () {
    $("#a_date").datepicker({minDate: -1,maxDate: 1,dateFormat: 'yy-mm-dd'});
    $('#a_time').timepicker();    
});
</script>