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

        <!--begin form thu chi-->
        <div class="row">
            <div class="col-md-12">                        
                <form class="panel panel-primary form-horizontal form-bordered"  method="post">                            
                    <div class="panel-heading">
                        <h3 class="panel-title">Form nhập</h3>
                    </div>                                                        
                    <div class="panel-body">                                
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
                        

                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label  text-danger">Loại</label>
                                <div class="col-sm-9">
                                    <select name="type_id" id="type_id" class="form-control" >
                                        <?= $dropdownlistType?>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label  text-danger">Mục chi/thu</label>
                                <div class="col-sm-9">
                                    <select name="a_type_chilrd" id="a_type_chilrd" class="form-control" >
                                        <?= $dropdownlistTypeChirld?>
                                    </select>
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label  text-danger">Số tiền</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="a_money" name="a_money" placeholder="Số tiền phải là số." value="<?= $formData['a_money']?>" required="required">
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label text-danger">Từ tài khoản</label>
                                <div class="col-sm-9">
                                    <select name="ac_id" id="ac_id" class="form-control" >
                                        <?= $dropdownlistAccountName?>
                                    </select>
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Ngày</label>
                                <div class="col-sm-9">                                    
                                    <input type="text" class="form-control datepicker" name="a_date" id="a_date" value="<?= $formData['a_date']?>"/>                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Thời gian</label>
                                <div class="col-sm-9">                                    
                                    <input type="text" class="form-control" name="a_time" id="a_time" value="<?= $formData['a_time']?>"/>                                    
                                </div>
                            </div> 
                        </div>

                        
                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nhân viên</label>
                                <div class="col-sm-9">                                    
                                    <select name="a_user"  id="a_user" class="form-control" >
                                        <?= $dropdownlistUser?>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-6">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nhân viên nhập</label>
                                <div class="col-sm-9">                                    
                                    <input type="text" class="form-control" name="user_typing" id="user_typing" disabled="disable" value="<?= $formData['user_typing']?>"/>                                    
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-12">  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Ghi chú</label>
                                <div class="col-sm-9">                                        
                                    <textarea class="form-control" name="a_note" id="a_note" placeholder="Ghi chú cho việc thu chi"></textarea>
                                </div>
                            </div> 
                        </div>

                        <div class="panel-footer">
                            <div class="form-group no-border">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Lưu lại</button>                                    
                                </div>
                            </div> 
                        </div>                                                          
                    </div>                            
                </form>                        
            </div>
        </div>  
        <!--end form thu chi-->              


        <!--begin danh sach thu chi-->
        <div class="row">
            <!--begin thu-->  
            <div class="col-md-12">
                <div class="panel panel-teal">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-money"></i></span> Quản lý thu</h3>                                                                
                    </div> 
    
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th width="3%" class="text-center"></th>                                            
                                    <th>Loại thu</th>                                                                                                                                                                               
                                    <th>Vào tài khoản</th>                                                                                                                                                                               
                                    <th>Ngày</th>                                                                                                                                                                               
                                    <th>Ghi chú</th>                                                                                                                                                                               
                                    <th>Người thu</th>                                                                                                                                                                               
                                    <th>NV nhập</th>   
                                    <th>Số tiền</th>                                                                                                                                                                               
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($listThu) && $listThu){
                                    $i=1;
                                    $total= 0;
                                    foreach ($listThu as $key => $value) {
                                        $myAccountName = $this->maccount_name->getData(array("ac_name"),array("id"=>$value["ac_id"]));
                                        $myAccountTypeChilrd = $this->maccount_type->getData(array("type_name"),array("id"=>$value["a_type_chilrd"]));
                                        $myUser = $this->muser->getData(array("user_fullname"),array("id"=>$value["a_user"]));
                                        $user_fullname = isset($myUser["user_fullname"]) ? $myUser["user_fullname"]:"Công ty";
                                        $total += $value['a_money'];
                                        echo '<tr>';                                              
                                            echo '<td>'.$i++.'</td>';                                                
                                            echo '<td>'.$myAccountTypeChilrd["type_name"].'</td>';                                                
                                            echo '<td>'.$myAccountName["ac_name"].'</td>';                                                
                                            echo '<td>'.date("H:i",strtotime($value["a_time"])).' '.date("d/m/Y",strtotime($value["a_date"])).'</td>';                                                
                                            echo '<td>'.$value["a_note"].'</td>';                                                                                            
                                            echo '<td>'.$user_fullname.'</td>';                                                                                                
                                            echo '<td>'.$value["user_typing"].'</td>';                                                                                                
                                            echo '<td>'.number_format($value["a_money"]).'</td>';                                                
                                        echo '</tr>';                                        
                                    }
                                    echo '<tr class="text-danger">';
                                        echo '<td colspan="6"></td>';
                                        echo '<td>Tổng cộng</td>';
                                        echo '<td>'.number_format($total).'</td>';
                                    echo '</tr>';
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
            <!--end thu-->  

            <!--begin chi-->  
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-money"></i></span> Quản lý chi</h3>                                                                
                    </div> 
    
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th width="3%" class="text-center"></th>                                            
                                    <th>Mục tiêu chi</th>                                                                                                                                                                               
                                    <th>Tài khoản</th>                                                                                                                                                                               
                                    <th>Ngày</th>                                                                                                                                                                               
                                    <th>Ghi chú</th>                                                                                                                                                                               
                                    <th>Chi cho ai</th>                                                                                                                                                                               
                                    <th>NV nhập</th>   
                                    <th>Số tiền</th>                                                                                                                                                                               
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($listChi) && $listChi){
                                    $i=1;
                                    $total= 0;
                                    foreach ($listChi as $key => $value) {
                                        $myAccountName = $this->maccount_name->getData(array("ac_name"),array("id"=>$value["ac_id"]));
                                        $myAccountTypeChilrd = $this->maccount_type->getData(array("type_name"),array("id"=>$value["a_type_chilrd"]));
                                        $myUser = $this->muser->getData(array("user_fullname"),array("id"=>$value["a_user"]));
                                        $user_fullname = isset($myUser["user_fullname"]) ? $myUser["user_fullname"]:"Công ty";
                                        $total += $value['a_money'];
                                        echo '<tr>';                                              
                                            echo '<td>'.$i++.'</td>';                                                
                                            echo '<td>'.$myAccountTypeChilrd["type_name"].'</td>';                                                
                                            echo '<td>'.$myAccountName["ac_name"].'</td>';                                                
                                            echo '<td>'.date("H:i",strtotime($value["a_time"])).' '.date("d/m/Y",strtotime($value["a_date"])).'</td>';                                                
                                            echo '<td>'.$value["a_note"].'</td>';                                                                                            
                                            echo '<td>'.$user_fullname.'</td>';                                                                                                
                                            echo '<td>'.$value["user_typing"].'</td>';                                                                                                
                                            echo '<td>'.number_format($value["a_money"]).'</td>';                                                
                                        echo '</tr>';                                        
                                    }
                                    echo '<tr class="text-danger">';
                                        echo '<td colspan="6"></td>';
                                        echo '<td>Tổng cộng</td>';
                                        echo '<td>'.number_format($total).'</td>';
                                    echo '</tr>';
                                }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
            <!--end chi-->                  
        </div>
        <!--end danh sach thu chi-->

        <!--beign thu chi trong tuan-->
        <div class="row">
            <div class="col-lg-12">
                <div id="container_daily"></div>
            </div>
        </div>
        <script type="text/javascript" charset="utf-8" async defer>
            $(function () {
                $('#container_daily').highcharts({
                    
                    title: {
                        text: 'Biều đồ thu chi'
                    },
                    subtitle: {
                        text: '(Ghi chú: 1M = 1 triệu = 1.000.000 VND )'
                    },
                    chart: {
                        type: 'bar'
                    },                    
                    xAxis: {
                        categories: [<?= $chartName?>],
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'VND',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' VND'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 100,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Thu',
                        data: [<?= $chartThu?>]
                    },{
                        name: 'Chi',
                        data: [<?= $chartChi?>]
                    }]
                });
            });

        </script>
        <!--end thu chi trong tuan-->

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