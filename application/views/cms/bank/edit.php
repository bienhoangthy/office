
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
                                <li><a href="<?= my_lib::cms_site()?>message/">Message</a></li>
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
                                            <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>                                            
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>bank/add/"><i class="ico-plus"></i>  Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>bank/"><i class="ico-list"></i>  List</a>
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
                                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?= $formData['bank_name']?>" required="required">
                                    </div>
                                </div> 

                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ngày hiện thị</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="bank_create" id="bank_create" value="<?= $formData['bank_create']?>"/></div>                                            
                                        </div>
                                    </div>
                                </div>

                                
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <span class="radio custom-radio custom-radio-primary">  
                                            <input <?= $formData['bank_status']==1?'checked':''?> type="radio" id="bank_status1" name="bank_status" value="1">  
                                            <label for="bank_status1">&nbsp;&nbsp;Active</label>

                                            <input <?= $formData['bank_status']==0?'checked':''?> type="radio" id="bank_status0" name="bank_status" value="0">  
                                            <label for="bank_status0">&nbsp;&nbsp;Block</label>
                                        </span>                                        
                                    </div>
                                </div>
                                                            
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>                                            
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>bank/add/"><i class="ico-plus"></i>  Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>bank/"><i class="ico-list"></i>  List</a>
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