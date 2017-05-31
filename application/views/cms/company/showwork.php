<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Danh sách thông báo
                <span class="badge badge-teal"><?= $record?></span></h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active">Làm việc khách hàng</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- START row -->
        <div class="row">
            <div class="col-md-12">
                <!--begin masseage-->
                <?php if(isset($error) && $error) { 
                    echo '<div class="alert alert-danger">';
                        echo '<ul>';
                        foreach ($error as $key => $value) {
                            # code...
                            echo '<li>'.$value.'</li>';
                        }
                        echo '</ul>';
                    echo '</div>';
                 } ?>
                <!--end masseage-->

                <!-- START panel -->
                <div class="panel panel-primary">
                    <!-- panel heading/header -->
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Danh sách</h3>
                        <!-- panel toolbar -->
                        <div class="panel-toolbar text-right">
                            <!-- option -->
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                            </div>
                            <!--/ option -->
                        </div>
                        <!--/ panel toolbar -->
                    </div>
                    <!--/ panel heading/header -->

                    <!--begin form tim kiem-->
                    <form method="get" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <div class="col-xs-123 col-sm-123 col-md-3 col-lg-3">                                         
                                    <input type="text" name="fcreatedate" id="fcreatedate" onchange="this.form.submit()"  value="<?= $formData['fcreatedate']?>" class="form-control datepicker" placeholder="">
                                </div>   
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">                                         
                                    <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: nhân viên liên hệ, nội dung">
                                </div>                                        
                                                                        
                                <input type="hidden" name="page" value="<?= $page?>">
                            </div>                                        
                        </div>
                        <!--end form tim kiem-->
                   

                    <!-- panel body with collapse capabale -->
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                             <tr>
                                <th colspan="10">                                            
                                    <div class="pull-right">
                                        <ul class="pagination pagination-sm mt0">
                                        <li class="limit_form">
                                            <label>Show: </label>
                                            <select name="fperpage" onchange="this.form.submit()" class="form-control input-sm ">
                                                <?php
                                                for ($i=1; $i <= 10 ; $i++) { 
                                                    $show = $i*10;
                                                    $selected = $show==$formData['fperpage'] ? 'selected':'';
                                                    echo '<option '.$selected.' value="'.$show.'">'.$show.'</option>';
                                                }
                                                ?>
                                                option
                                            </select>
                                        </li>
                                        <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                    </div>
                                    </form>
                                                                      
                                </th>
                            </tr>
                                <tr>                                    
                                    <th width="3%" class="text-center">ID</th>                                            
                                    <th width="200px">Công ty</th>
                                    <th width="100px">Ngày</th>                                                                           
                                    <th width="100px">Thời gian</th>                                                                           
                                    <th class="text-center" width="15%">Người liên hệ</th>                                                                           
                                    <th>Nội dung</th>                                                                           
                                    <th class="text-center" width="15%">Nhân viên liên hệ</th>                                                                           
                                    <th class="text-center">Trạng thái</th>                                                                           
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($list) && $list){
                                    $i=1;
                                    foreach ($list as $key => $value) {
                                        $tmpInfo = $this->minfocontact->getData(array("contact_name","company_id"),array("id"=>$value['infocontact_id']));
                                    	$myCompany = $this->mcompany->getData(array("id","company_name"),array("id"=>$tmpInfo['company_id']));
                                        $value["infocontact_id"] = $tmpInfo?$tmpInfo['contact_name']:'';
                                        $link_working = my_lib::cms_site().'company/working/'.$tmpInfo["company_id"].'/?redirect='.base64_encode(current_url());
                                        $status_work = $value['status_work']==1 ? '<small class="label label-success">Đã hoàn thành</small>':'<small class="label label-danger label-sm">Chưa hoàn thành</small>';
                                        $text_danger = $value['create_date'] > date("Y-m-d") ? 'text-danger':'';
                                        echo '<tr>';                                     
                                            echo '<td>'.$value["id"].'</td>';                                                
                                            echo '<td><a href="'.$link_working.'">'.$myCompany["company_name"].'</a></td>';
                                            echo '<td class="'.$text_danger.'">'.$value["create_date"].'</td>';                                                
                                            echo '<td class="text-center">'.date("H:i a",strtotime($value["time"])).'</td>';
                                            echo '<td class="text-center">'.$value["infocontact_id"].'</td>';                                                    
                                            echo '<td>'.$value["contact_content"].'</td>';                                                                                                                                                                                                                                          
                                            echo '<td class="text-center"><a>'.$value["employee_name"].'</a></td>';                                                    
                                            echo '<td class="text-center"><a class="pointer ajUpdateWorkingStatus" data-id="'.$value["id"].'" data-status="'.$value["status_work"].'">'.$status_work.'</a></td>';                                                    
                                        echo '</tr>';                                                
                                        $i++;
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="10">
                                        <div class="text-right"> 
                                        <ul class="pagination pagination-sm mt0">                                            
                                           <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                        </div>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                    <!--/ panel body with collapse capabale -->
                </div>
            </div>
        </div>
        <!--/ END row -->                        
    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<!--/ END Template Main-->
