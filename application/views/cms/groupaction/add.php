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
                        <li><a href="<?= my_lib::cms_site()?>groupaction/">Group Action</a></li>
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
                            <label class="col-sm-3 control-label">Tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="gc_name" name="gc_name" value="<?= $formData['gc_name']?>">
                            </div>
                        </div>                                                                                          
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Value</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="gc_value" name="gc_value" value="<?= $formData['gc_value']?>">
                            </div>
                        </div>                                                                                                            
                        <div class="form-group">
                            <label class="col-sm-3 control-label">STT</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="gc_order" name="gc_order" value="<?= $formData['gc_order']?>">
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