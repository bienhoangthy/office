
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
                                <li><a href="<?= my_lib::cms_site()?>message/">Thông báo</a></li>
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
                        <form class="panel panel-default form-horizontal form-bordered" enctype="multipart/form-data" method="post">
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
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>message/add/"><i class="ico-plus"></i> Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>message/">List</a>
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
                                    <label class="col-sm-3 control-label">Phòng ban</label>
                                    <div class="col-sm-9">
                                        <select class="form-control ms_department" name="ms_department" placeholder="Select a person..." required="required">
                                            <?= $ms_department;?>
                                        </select>                                        
                                    </div>
                                </div>                                                         
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Level</label>
                                    <div class="col-sm-9">
                                        <select class="form-control ms_group" name="ms_group" placeholder="Select a person..." required="required">
                                            <?= $ms_group;?>
                                        </select>                                        
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tiêu đề</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ms_title" name="ms_title" value="<?= $formData['ms_title']?>" required="required">
                                    </div>
                                </div> 

                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày hiện thị</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="ms_create_date" id="ms_create_date" value="<?= $formData['ms_create_date']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày kết thúc</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="ms_end_date" id="ms_end_date" value="<?= $formData['ms_end_date']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">File đính kèm</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="_file" id="_file" >
                                    </div>
                                    <?php if ($formData['ms_file'] != ''): ?>
                                        <label class="col-sm-3 control-label">Current File</label>
                                        <div class="col-sm-9">
                                            <p class="text-primary" style="padding-top: 5px;"><?= $formData['ms_file']?></p>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">
                                    <textarea class="form-control" id="ms_content" name="ms_content" ><?= $formData['ms_content']?></textarea>                                        
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <span class="radio custom-radio custom-radio-primary">  
                                            <input <?= $formData['ms_status']==1?'checked':''?> type="radio" id="ms_status1" name="ms_status" value="1">  
                                            <label for="ms_status1">&nbsp;&nbsp;Active</label>

                                            <input <?= $formData['ms_status']==0?'checked':''?> type="radio" id="ms_status0" name="ms_status" value="0">  
                                            <label for="ms_status0">&nbsp;&nbsp;Block</label>
                                        </span>                                        
                                    </div>
                                </div>
                                                            
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>                                            
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>message/add/"><i class="ico-plus"></i> Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>message/">List</a>
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