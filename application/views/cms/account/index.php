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
    
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-12">
            <form method="get">
                <select name="year" class="form-control" onchange="this.form.submit()" id="selectize-select">
                    <?php
                    for ($i=2012; $i <= (date("Y")+1); $i++) { 
                        $selected = $year==$i?"selected":"";
                        echo '<option '.$selected.' value="'.$i.'"> Năm '.$i.'</option>';
                    }
                    ?>
                </select>
            </div>
            </form>
        </div> 

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs bg-danger">
                    <li class="active"><a href="#tongketname" data-toggle="tab">Tổng kết năm</a></li>                    
                    <li><a href="#tongketquy" data-toggle="tab">Tổng kết quý</a></li>                    
                    <li><a href="#tongketthang" data-toggle="tab">Tổng kết tháng</a></li>                    
                </ul> 
                <div class="tab-content panel">
                    <!--begin tong ket nam-->
                    <div class="tab-pane active" id="tongketname">
                        <div id="container_account"></div>
                    </div>
                    <!--end tong ket nam-->

                    <!--begin tong ket quy-->
                    <div class="tab-pane" id="tongketquy">
                        <div id="container_account_quy"></div>
                    </div>
                    <!--end tong ket quy-->

                    <!--begin tong ket thang-->
                    <div class="tab-pane" id="tongketthang">
                        <div class="table-responsive panel-collapse pull out">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                <?php for ($i=1; $i <= 12 ; $i++) { 
                                    $tong_cong = $account_thang[$i]["thu"] + $account_thang[$i]["chi"];
                                    $percen_thu = $account_thang[$i]["thu"] > 0 ? round(($account_thang[$i]["thu"] * 100)/$tong_cong,1):0;
                                    $percen_chi = $account_thang[$i]["chi"] > 0 ? 100 - $percen_thu:0;
                                    if($tong_cong>0){
                                    ?>
                                    <tr>
                                        <td class="text-teal bold" colspan="3"><i class="ico-calendar5"></i> Tháng <?= $i?> - <small class="label label-teal">Còn: <?= number_format($account_thang[$i]["loinhuan"])?></small></td>
                                    </tr>
                                    <tr>
                                        <td style="width:100px" class="bold text-center text-teal">Thu</td>
                                        <td>
                                            <div class="progress progress-xs nm">
                                                <div class="progress-bar progress-bar-teal" title="<?= $percen_thu?>%" style="width:<?= $percen_thu?>%;"></div>
                                            </div>
                                        </td>
                                        <td style="width:150px" class="text-center text-teal bold"><?= number_format($account_thang[$i]["thu"])?> <u>đ</u></td>
                                    </tr>
                                    <tr>
                                        <td style="width:100px" class="bold text-center text-danger">Chi</td>
                                        <td>
                                            <div class="progress progress-xs nm">
                                                <div class="progress-bar progress-bar-danger" title="<?= $percen_chi?>%" style="width:<?= $percen_chi?>%;"></div>
                                            </div>
                                        </td>
                                        <td style="width:150px" class="text-center text-danger bold"><?= number_format($account_thang[$i]["chi"])?> <u>đ</u></td>
                                    </tr>
                                <?php } } ?>                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end tong ket thang-->
                </div>
            </div>
        </div>    
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a></section>
<script>
$(function () {    
    $('#container_account').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tổng kết thu chi <?= $year?>'
        },
        xAxis: {
            categories: [
                'Tháng 1',
                'Tháng 2',
                'Tháng 3',
                'Tháng 4',
                'Tháng 5',
                'Tháng 6',
                'Tháng 7',
                'Tháng 8',
                'Tháng 9',
                'Tháng 10',
                'Tháng 11',
                'Tháng 12'
            ],
            
        },
           
        credits: {
            enabled: false
        },
        series: [{
            name: 'Thu',
            data: [<?= $account_thu?>]

        }, {
            name: 'Chi',
            data: [<?= $account_chi?>]

        }, {
            name: 'Còn lại',
            data: [<?= $account_loinhuan?>]

        }]
    });

    $('#container_account_quy').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tổng kết thu chi quý <?= $year?>'
        },
        xAxis: {
            categories: [
                'Quý 1',
                'Quý 2',
                'Quý 3',
                'Quý 4',                
            ],
            
        },
           
        credits: {
            enabled: false
        },
        series: [{
            name: 'Thu',
            data: [<?= $account_thu_quy?>]

        }, {
            name: 'Chi',
            data: [<?= $account_chi_quy?>]

        }, {
            name: 'Còn lại = (Thu - Chi)',
            data: [<?= $account_loinhuan_quy?>]

        }]
    });
});
</script>