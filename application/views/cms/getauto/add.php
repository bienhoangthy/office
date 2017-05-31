
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
                                <li><a href="<?= my_lib::cms_site()?>getauto/">Lấy tin tự động</a></li>
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

                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                    </div> 
                                </div> 

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
                                    <label class="col-sm-3 control-label">Danh mục</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="category_id" placeholder="Select a person..." required="required">
                                            <?= $parent;?>
                                        </select>                                        
                                    </div>
                                </div>                                                             
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tiêu đề</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $formData['name']?>" required="required">
                                    </div>
                                </div>                                                         
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Đường dẫn chính</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="host" name="host" value="<?= $formData['host']?>" required="required">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Đường dẫn lấy tin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="url" name="url" value="<?= $formData['url']?>" required="required">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Khung bao ngoài tin lấy</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pattern_bound" name="pattern_bound" value="<?= $formData['pattern_bound']?>" required="required">
                                    </div>
                                </div> 
                            

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Liên kết của tin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="extra" name="extra" value="<?= $formData['extra']?>" required="required">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Lấy hình ảnh</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="image_pattern" name="image_pattern" value="<?= $formData['image_pattern']?>" required="required">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Thư mục lưu hình</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="image_dir" name="image_dir" value="<?= $formData['image_dir']?>" required="required">
                                    </div>
                                </div> 


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên bài viết</label>
                                    <div class="col-sm-5">                                        
                                        <input type="text" name="field[news_name][extra]" value="" id="news_name_extra" class="form-control" placeholder="Lấy tên" required="required" >
                                    </div>  
                                    <div class="col-sm-4">                                        
                                        <input type="text" name="field[news_name][element_delete]" value="" id="news_name_element_delete" class="form-control" placeholder="Xóa không cần thiết">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Chi tiết</label>
                                    <div class="col-sm-5">                                        
                                        <input type="text" name="field[news_detail][extra]" value="" id="news_detail_extra" class="form-control" placeholder="Lấy chi tiết" required="required" >
                                    </div>  
                                    <div class="col-sm-4">                                        
                                        <input type="text" name="field[news_detail][element_delete]" value="" id="news_detail_element_delete" class="form-control" placeholder="Xóa không cần thiết">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tag</label>
                                    <div class="col-sm-9">                                        
                                        <input type="text" name="tag"  id="tag" class="form-control" value="<?= $formData['tag']?>" placeholder="" required="required" >
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