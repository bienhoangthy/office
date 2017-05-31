
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
                                <li><a href="<?= my_lib::cms_site()?>">Trang chủ</a></li>
                                <li><a href="<?= my_lib::cms_site()?>menu/">Menu</a></li>
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
                        <form class="panel panel-default form-horizontal form-bordered"  method="post">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title">Form control</h3>
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel body -->
                            <div class="panel-body">
                                <!-- <p>Selectize is the hybrid of a textbox and box. It's jQuery-based and it's useful for tagging, contact lists, country selectors, and so on.</p> -->
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
                                                                                            
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?= $formData['menu_name']?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Link ID</label>
                                    <div class="col-sm-9">
                                        <span class="radio custom-radio custom-radio-primary">  
                                            <input <?= $formData['menu_link_id']==1?'checked':''?> type="radio" class="menu_link_id" id="menu_link_id1" name="menu_link_id" value="1">  
                                            <label for="menu_link_id1">&nbsp;&nbsp;Alias</label> 

                                            <input type="radio" <?= $formData['menu_link_id']==0?'checked':''?>  class="menu_link_id" id="menu_link_id0" name="menu_link_id" value="0">  
                                            <label for="menu_link_id0">&nbsp;&nbsp;Link</label>
                                           
                                            <input type="hidden" value="<?= $formData['menu_link_id']?>" class="hd_menu_link_id">
                                        </span>                                         
                                    </div>
                                </div> 
                                <div class="form-group ra_menu_link_1">
                                    <label class="col-sm-3 control-label">Alias</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menu_alias" name="menu_alias" value="<?= $formData['menu_alias']?>">
                                    </div>
                                </div> 
                                <div class="form-group ra_menu_link_0">
                                    <label class="col-sm-3 control-label">Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menu_link" name="menu_link" value="<?= $formData['menu_link']?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Detail</label>
                                    <div class="col-sm-9">                                        
                                        <textarea class="form-control" id="menu_detail" name="menu_detail" ><?= $formData['menu_detail']?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Parent</label>
                                    <div class="col-sm-9">
                                        <select class="form-control menu_parent" name="menu_parent" placeholder="Select a person...">
                                            <?= $parent;?>
                                        </select>
                                        <!-- <input type="text" class="form-control" id="menu_parent" name="menu_parent" value="<?= $formData['menu_parent']?>"> -->
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Controller</label>
                                    <div class="col-sm-9">                                        
                                        <select id="selectize-select" class="form-control menu_com" name="menu_com" placeholder="Select a person...">
                                            <option value="">Select a item...</option>
                                            <?php

                                            if(isset($getCom)  && $getCom) {
                                                foreach ($getCom as $key => $value) {
                                                    # code...
                                                    $selected = $formData['menu_com']==$value['com_com']?"selected":"";
                                                    echo '<option '.$selected.' value="'.$value["com_com"].'">'.$value["com_name"].'</option>';
                                                }
                                            }
                                            ?>                                                                                    
                                        </select>
                                        <input type="hidden" class="form-control" id="hdmenu_com" name="hdmenu_com" value="<?= $formData['menu_com']?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">View</label>
                                    <div class="col-sm-9">
                                        <select id="selectize-select" class="form-control menu_view" name="menu_view" placeholder="Select a person...">
                                                                                                                            
                                        </select>
                                        <input type="hidden" class="form-control" id="hdmenu_view" name="hdmenu_view" value="<?= $formData['menu_view']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">OrderBy</label>
                                    <div class="col-sm-9">

                                        <input type="text" class="form-control" id="menu_orderby" name="menu_orderby" value="<?= $formData['menu_orderby']?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <span class="radio custom-radio custom-radio-primary">  
                                            <input <?= $formData['menu_status']==1?'checked':''?> type="radio" id="menu_status1" name="menu_status" value="1">  
                                            <label for="menu_status1">&nbsp;&nbsp;Enable</label>

                                            <input <?= $formData['menu_status']==0?'checked':''?> type="radio" id="menu_status0" name="menu_status" value="0">  
                                            <label for="menu_status0">&nbsp;&nbsp;Disable</label>
                                        </span>                                        
                                    </div>
                                </div> 
                                <div class="form-group">                    
                                       <label class="col-sm-3 control-label">Picture</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                            <input type="text" class="form-control" id="menu_picture" name="menu_picture" value="<?= $formData['menu_picture']?>">
                                            <span class="input-group-btn">
                                                <a href="<?= my_lib::cms_fileupload()?>dialog.php?type=1&amp;field_id=menu_picture"  class="iframe-btn btn btn-default" type="button">Select</a>
                                            </span>
                                        </div>
                                    </div>

                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Seo title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="menu_seo_title" name="menu_seo_title" value="<?= $formData['menu_seo_title']?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Seo Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="menu_seo_description" name="menu_seo_description" ><?= $formData['menu_seo_description']?></textarea>                                        
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tagging</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="selectize-tagging" name="menu_seo_keyword" value="<?= $formData['menu_seo_keyword']?>">
                                    </div>
                                </div>  
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" name="fsubmit" class="btn btn-primary">Submit button</button>
                                            <button type="reset" class="btn btn-danger">Reset button</button>
                                        </div>
                                    </div> 
                                </div>                                                          
                            </div>
                            <!--/ panel body -->
                        </form>
                        <!-- END panel -->
                    </div>
                </div>
                <!--/ END row -->
                            
            </div>
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>