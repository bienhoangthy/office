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
                    <li><a href="<?= my_lib::cms_site()?>account_name">Thông tin tài khoản</a></li>
                    <li class="active" ><a href="<?= my_lib::cms_site()?>account_type">Loại thu chi</a></li>                    
                </ul>                                
                <div class="tab-content panel">
                    <!--begin thu-->
                    <div class="tab-pane active">                        
                        <div class="row">
                            <div class="col-lg-12">
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
                                <form class="panel panel-default form-horizontal form-bordered"  method="post"> 
                                <div class="panel-body">  
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tiêu đề</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="type_name" name="type_name" value="<?= $formData['type_name']?>" required="required">
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cấp cha</label>
                                        <div class="col-sm-9">
                                            <select name="type_parent" id="type_parent" class="form-control" >
                                                <?= $dropdownlist;?>
                                            </select>                                        
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">STT</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="type_orderby" name="type_orderby" value="<?= $formData['type_orderby']?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9">
                                           <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>
                                        </div>
                                    </div>

                                </div>                         
                                </form>
                            </div> 

                            <div class="col-lg-12">                        
                                <div class="table-responsive panel-collapse pull out">
                                    <table class="table table-bordered table-hover" id="table1">
                                        <thead>
                                            <tr>
                                                <th width="3%" class="text-center"></th>                                            
                                                <th>Tiêu đề</th>                                                                                                                                                                                               
                                                <th class="text-center">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($list) && $list){
                                                $i=1;
                                                foreach ($list as $key => $value) {
                                                    $tmpStatus = $value["type_status"]==1 ?0:1;
                                                    $link_update_status = my_lib::cms_site().'account_type/update_status/'.$value["id"].'/'.$tmpStatus.'/';
                                                    $value["type_status"] = $value["type_status"] == 1 ? '<small class="btn btn-primary btn-xs"><i class=" ico-eye"></i> Active</small>':'<small class="btn btn-danger btn-xs"><i class=" ico-eye-blocked"></i> Block</small>';                                                                                        
                                                    echo '<tr>';                                              
                                                        echo '<td>'.$i++.'</td>';                                                
                                                        echo '<td class="text-danger">'.$value["type_name"].'</td>';                                                                                                        
                                                        echo '<td class="text-center"><a href="'.$link_update_status.'">'.$value["type_status"].'</a></td>';                                                                                               
                                                    echo '</tr>';  

                                                    $data_c2  = $this->maccount_type->getQuery("","","type_parent=".$value["id"],"type_orderby","");                                          
                                                    if(isset($data_c2) && $data_c2){
                                                        foreach ($data_c2 as $key_c2 => $value_c2) {
                                                            $tmpStatus_c2 = $value_c2["type_status"]==1 ?0:1;
                                                            $link_update_status_c2 = my_lib::cms_site().'account_type/update_status/'.$value_c2["id"].'/'.$tmpStatus_c2.'/';
                                                            $value_c2["type_status"] = $value_c2["type_status"] == 1 ? '<small class="btn btn-primary btn-xs"><i class=" ico-eye"></i> Active</small>':'<small class="btn btn-danger btn-xs"><i class=" ico-eye-blocked"></i> Block</small>';                                                                                        
                                                            echo '<tr>';                                              
                                                                echo '<td>'.$i++.'</td>';                                                
                                                                echo '<td class="text-success">-- '.$value_c2["type_name"].'</td>';                                                                                                        
                                                                echo '<td class="text-center"><a href="'.$link_update_status_c2.'">'.$value_c2["type_status"].'</a></td>';                                                                                              
                                                            echo '</tr>'; 
                                                            /**begin cap 3*/ 
                                                            $data_c3  = $this->maccount_type->getQuery("","","type_parent=".$value_c2["id"],"type_orderby","");                                          
                                                            if(isset($data_c3) && $data_c3){
                                                                foreach ($data_c3 as $key_c3 => $value_c3) {
                                                                    $tmpStatus_c3 = $value_c3["type_status"]==1 ?0:1;
                                                                    $link_update_status_c3 = my_lib::cms_site().'account_type/update_status/'.$value_c3["id"].'/'.$tmpStatus_c3.'/';
                                                                    $value_c3["type_status"] = $value_c3["type_status"] == 1 ? '<small class="btn btn-primary btn-xs"><i class=" ico-eye"></i> Active</small>':'<small class="btn btn-danger btn-xs"><i class=" ico-eye-blocked"></i> Block</small>';                                                                                        
                                                                    echo '<tr>';                                              
                                                                        echo '<td>'.$i++.'</td>';                                                
                                                                        echo '<td class="text-info">------ '.$value_c3["type_name"].'</td>';                                                                                                        
                                                                        echo '<td class="text-center"><a href="'.$link_update_status_c3.'">'.$value_c3["type_status"].'</a></td>';                                                                                             
                                                                    echo '</tr>';                                                
                                                                }
                                                            } 
                                                            /**end cap 3*/                                                
                                                        }
                                                    }                                                            
                                                }
                                            }
                                            ?>                                            
                                        </tbody>
                                    </table>
                                </div>                    
                            </div>        
                                                
                    </div>
                    <!--end thu-->                
                </div>                
            </div>
        </div>
    </div>
</section>