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
                        <li><a href="<?= my_lib::cms_site()?>group/">Group</a></li>
                        <li class="active"><?= $title?></li>
                    </ol>
                </div>                        
            </div>
        </div>                
        
        <div class="row">
            <div class="col-md-12">                        
                <form class="panel panel-default form-horizontal form-bordered"  method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>                            
                    <div class="panel-heading">
                        <h3 class="panel-title">Form control</h3>
                    </div>                                                        
                    <div class="panel-body">

                        <div class="panel-footer">
                            <div class="form-group no-border">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9 text-right">
                                    <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div> 
                        </div> 
                        
                        <?php
                        if(isset($success) && $success && count($success)>0){
                            echo '<div class="alert alert-info">';
                                echo '<ul>';
                                foreach ($success as $key => $value) {
                                    
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
                                    
                                    echo '<li>'.$value.'</li>';
                                }
                                echo '</ul>';
                            echo '</div>';
                        }
                        ?>                                                                                            
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="group_name" name="group_name" value="<?= $formData['group_name']?>">
                            </div>
                        </div>                                                                                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ghi chú</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" id="group_note" name="group_note" ><?= $formData['group_note']?></textarea>                                        
                            </div>
                        </div>     
                        <div class="form-group">
                            <label class="col-sm-3 control-label">STT</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="group_order" name="group_order" value="<?= $formData['group_order']?>">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Module hiển thị</label>
                            <div class="col-sm-9">
                                <select name="group_category[]" id="group_category" multiple class="form-control">
                                    <?= $myCategory?>                                       
                                </select>
                            </div>
                        </div>        
                        <div class="form-group">                            
                            <div class="col-sm-12 aj_loadPermission">
                                    <?= $myPermission; ?>
                            </div>
                        </div>  
                                         
                        <div class="panel-footer">
                            <div class="form-group no-border">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9 text-right">
                                    <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div> 
                        </div>                                                          
                    </div>
                </form>                        
            </div>
        </div>                
                    
    </div>            
    
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>            
</section>