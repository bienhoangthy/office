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
                                <li><a href="<?= my_lib::cms_site()?>news/">Danh sách</a></li>
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
                                    <label class="col-sm-3 control-label">Loại bài viết</label>
                                    <div class="col-sm-9">
                                        <select class="form-control news_type" name="news_type" placeholder="Select a person...">
                                            <?= $news_type;?>
                                        </select>                                        
                                    </div>
                                </div>         
                                <!--multiple="multiple"                                              -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Danh mục</label>
                                    <div class="col-sm-9">
                                        <select  class="form-control news_parent" id="selectize-select" name="news_parent" placeholder="Select a person..." required="required">
                                            <?= $parent;?>
                                        </select>                                        
                                    </div>
                                </div>                                                             
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Dòng sự kiện</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="form-control" id="news_event" name="news_event" value="<?= $formData['news_event']?>">
                                        <input type="text" class="form-control" id="hdnews_event" name="hdnews_event"  placeholder="Nhập từ khóa cần tìm...">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên bài viết</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_name" name="news_name" value="<?= $formData['news_name']?>">
                                    </div>
                                </div> 
                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_alias" name="news_alias" value="<?= $formData['news_alias']?>" placeholder="Alias Code tự động tạo">
                                    </div>
                                </div>                                 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tóm tắt</label>
                                    <div class="col-sm-9">                                        
                                        <textarea class="form-control" id="news_summary" rows="5" name="news_summary" ><?= $formData['news_summary']?></textarea>
                                    </div>
                                </div>                                 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">                                        
                                        <textarea class="form-control" id="news_detail" name="news_detail" ><?= $formData['news_detail']?></textarea>
                                    </div>
                                </div> 

                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Bình luận</label>
                                    <div class="col-sm-9">
                                        <span class="radio custom-radio custom-radio-primary">  
                                            <input <?= $formData['news_comment']==1?'checked':''?> type="radio" id="news_comment1" name="news_comment" value="1">  
                                            <label for="news_comment1">&nbsp;&nbsp;Enable</label>

                                            <input <?= $formData['news_comment']==0?'checked':''?> type="radio" id="news_comment0" name="news_comment" value="0">  
                                            <label for="news_comment0">&nbsp;&nbsp;Disable</label>                                          
                                        </span>                                     
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <select class="form-control news_status" name="news_status" placeholder="Select a person...">
                                            <?= $news_status;?>
                                        </select>                                         
                                    </div>
                                </div> 
        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Vị trí</label>
                                    <div class="col-sm-9">
                                        <span class="checkbox custom-checkbox">
                                            <input <?= $formData['news_hot']==1?'checked':''?> type="checkbox" id="news_hot" name="news_hot" value="1" />  
                                            <label for="news_hot">&nbsp;&nbsp;Hot</label>   
                                            <input <?= $formData['news_vip']==1?'checked':''?> type="checkbox" id="news_vip" name="news_vip" value="1" />  
                                            <label for="news_vip">&nbsp;&nbsp;VIP</label> 
                                            <input <?= $formData['news_home']==1?'checked':''?> type="checkbox" id="news_home" name="news_home" value="1" />  
                                            <label for="news_home">&nbsp;&nbsp;Home</label>   
                                        </span>                                    
                                    </div>
                                </div> 

                                
                                

                                <!-- <div class="form-group">                    
                                   <label class="col-sm-3 control-label">Picture</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="news_picture" name="news_picture" value="<?= $formData['news_picture']?>">
                                            <span class="input-group-btn">
                                                <a href="<?= my_lib::cms_fileupload()?>dialog.php?type=1&amp;field_id=news_picture"  class="iframe-btn btn btn-default" type="button">Select</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>  -->

                                <div class="form-group"> 
                                    <label class="col-sm-3 control-label">Picture</label>
                                    <div class="col-sm-9">                                                                 
                                        <div class="input-group">
                                            <span class="input-group-btn">                                    
                                                <a href="<?= my_lib::cms_fileupload()?>dialog.php?type=1&amp;field_id=fieldID" class="btn iframe-btn btn-success choose_img" type="button"><i class="ico-image3"></i> Chọn hình...</a>
                                            </span>
                                            <input type="text" id="fieldID" value="<?= $formData['news_picture']?>" name="news_picture" class="form-control news_picture">
                                        </div>
                                                                                
                                        <div class="row">                                                                        
                                                <img class="view_tmp" id="img169" src="<?= my_lib::cms_img()?>logo.png">
                                                <input id="img169_x" type="hidden" name="img169_x" />
                                                <input id="img169_y" type="hidden" name="img169_y" />
                                                <input id="img169_x1" type="hidden" name="img169_x1" />
                                                <input id="img169_y1" type="hidden" name="img169_y1" />
                                                <input id="img169_x2" type="hidden" name="img169_x2" />
                                                <input id="img169_y2" type="hidden" name="img169_y2" />                                                                            
                                        </div>            
                                        <!--begin show ket qua-->
                                        <div class="row">
                                            <div class="show_proccess ">                                                                                                
                                            </div>
                                        </div>
                                        <!--end show ket qua-->
                                        <div class="text-left" style="margin-top:10px;">
                                            <input type="hidden" id="hdimgroot">
                                            <button type="button" class="btn btn-primary aj_scrop"><i class="ico-folder-upload3"></i> Xử lý hình</button>
                                            <button type="button" class="btn btn-info aj_upload"><i class="ico-folder-upload3"></i> Scrop hình</button>
                                            <button type="button" class="btn btn-success aj_proccess"><i class="ico-save"></i> Save</button>                                        
                                            <button type="button" class="btn btn-danger aj_deleteImg"><i class="ico-trash"></i> Delete</button>                                        
                                        </div>

                                        <div class="show_msg"></div>                    
                                    </div> 

                                </div>
                                


                                <!-- <div class="form-group">
                                    <label class="col-sm-3 control-label">Số thứ tự</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_orderby" name="news_orderby" value="<?= $formData['news_orderby']?>">
                                    </div>
                                </div> --> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Lượt xem</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_view" name="news_view" value="<?= $formData['news_view']?>">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tác giả</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_author" name="news_author" value="<?= $formData['news_author']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Source nguồn</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_source" name="news_source" value="<?= $formData['news_source']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Thời gian</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="news_begin_date" id="news_begin_date" value="<?= $formData['news_begin_date']?>"/></div>
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="to" name="news_end_date" id="news_end_date" value="<?= $formData['news_end_date']?>"/></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_password" name="news_password" value="<?= $formData['news_password']?>">
                                    </div>
                                </div> --> 

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Seo title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="news_seo_title" name="news_seo_title" value="<?= $formData['news_seo_title']?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Seo Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="news_seo_description" name="news_seo_description" ><?= $formData['news_seo_description']?></textarea>                                        
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tagging</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="selectize-tagging" name="news_seo_keyword" value="<?= $formData['news_seo_keyword']?>">
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
    
        <link rel="stylesheet" type="text/css" href="<?= my_lib::cms_css()?>imgareaselect-default.css" />        
        <script type="text/javascript" src="<?= my_lib::cms_js()?>jquery.imgareaselect.pack.js"></script>       