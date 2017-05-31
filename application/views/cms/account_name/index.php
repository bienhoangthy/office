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
    
        <div class="row">
            <div class="col-md-12">                                                        
                <ul class="nav nav-tabs">
                    <li class="active"><a href="<?= my_lib::cms_site()?>account_name">Thông tin tài khoản</a></li>
                    <li><a href="<?= my_lib::cms_site()?>account_type">Loại thu chi</a></li>                    
                </ul>                                
                <div class="tab-content panel">
                    <!--begin thu-->
                    <div class="tab-pane active" >                        
                        <div class="table-responsive panel-collapse pull out">
                            <table class="table table-bordered table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th width="3%" class="text-center">ID</th>                                            
                                        <th>Tiêu đề</th>                                                                           
                                        <th class="text-center" width="15%">Số tiền</th>                                                                           
                                        <th class="text-center" width="15%">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($list) && $list){
                                        $i=1;
                                        foreach ($list as $key => $value) {
                                            $value["ac_status"] = $value["ac_status"] == 1 ? '<small class="btn btn-primary btn-xs"><i class=" ico-eye"></i> Active</small>':'<small class="btn btn-danger btn-xs"><i class=" ico-eye-blocked"></i> Block</small>';                                                                                        
                                            echo '<tr>';                                              
                                                echo '<td>'.$value["id"].'</td>';                                                
                                                echo '<td><a>'.$value["ac_name"].'</a></td>';                                                
                                                echo '<td class="text-center"></td>';
                                                echo '<td class="text-center">'.$value["ac_status"].'</td>';       
                                            echo '</tr>';                                                
                                            $i++;
                                        }
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>                    
                    </div>
                    <!--end thu-->                
                </div>                
            </div>
        </div>
    </div>
</section>