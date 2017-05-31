<section id="main" role="main">    
    <div class="container-fluid">        
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?></h4>
            </div>           
        </div>        
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-bar-chart"></i></span> <?= $title?></h3>                        
                                            
                    </div>
                    <div class="panel-collapse pull out">
                        <div id="chartCompany">
                    </div>
                </div>
            </div>
        </div>                        
    </div>
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>    
</section>
<script type="text/javascript" charset="utf-8" async defer>
    $(function () {
        $('#chartCompany').highcharts({
            title: {
                text: 'Lượng khách hàng mới',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Số lượng'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: 'Cá nhân',
                data: [<?= $company_my?>]
            }, {
                name: 'Công ty',
                data: [<?= $company_all?>]
            }, {
                name: 'Nhóm',
                data: [<?= $company_group?>]
            }]
        });
    });
</script>