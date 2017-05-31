
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
                                <li><a href="<?= my_lib::cms_site()?>translate/">Dịch thuật</a></li>
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
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>translate/add/">Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>translate/">List</a>
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
                                        <input type="text" class="form-control" id="translate_name" name="translate_name" value="<?= $formData['translate_name']?>" required="required">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Alias code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="translate_code" name="translate_code" value="<?= $formData['translate_code']?>" required="required">
                                    </div>
                                </div> 
                                
                                <?php
                                if(isset($translate_lang) && $translate_lang)
                                {
                                    foreach ($translate_lang as $key => $value) {
                                        # code...
                                        $getTranslateLang = '';
                                        $getTranslateLang = $this->mtranslate_lang->getData('',array("translate_id"=>$formData["id"],"translate_lang"=>$value["lang"]));

                                        echo '<div class="form-group">';
                                            echo '<label class="col-sm-3 control-label">'.$value["language_name"].'</label>';
                                            echo '<div class="col-sm-9">';
                                                echo '<input type="text" class="form-control" id="'.$value["language_alias"].'" name="'.$value["language_alias"].'" value="'.$getTranslateLang["translate_name"].'" required="required">';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                }
                                ?>
                                                            
                                                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại</label>
                                    <div class="col-sm-9">
                                        <select class="form-control translate_type" name="translate_type" placeholder="Select a person...">
                                            <?= $translate_type;?>
                                        </select>                                       
                                    </div>
                                </div>
                                                            
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary">Save</button>                                            
                                            <a class="btn btn-success" href="<?= my_lib::cms_site()?>translate/add/">Add</a>
                                            <a class="btn btn-info" href="<?= my_lib::cms_site()?>translate/">List</a>
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