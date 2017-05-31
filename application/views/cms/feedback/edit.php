
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
                                <li><a href="<?= my_lib::cms_site()?>feedback/">Message</a></li>
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
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>feedback/add/">Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>feedback/">List</a>
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
                                    <label class="col-sm-3 control-label">Tiêu đề</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="feedback_title" name="feedback_title" value="<?= $formData['feedback_title']?>" required="required">
                                    </div>
                                </div> 
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">
                                    <textarea class="form-control" id="feedback_detail" rows="8" name="feedback_detail" required="required"  placeholder="Nội dung góp ý bao gồm: Lỗi, yêu cầu chức năng, cải tiến và nâng cấp, câu hỏi,..."><?= $formData['feedback_detail']?></textarea>                                        
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <select class="form-control feedback_status" name="feedback_status" placeholder="Select a person...">
                                            <?= $feedback_status;?>
                                        </select>                                       
                                    </div>
                                </div>
                                                            
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>                                            
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>feedback/add/">Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>feedback/">List</a>
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