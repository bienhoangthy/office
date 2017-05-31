
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
                                <li><a href="<?= my_lib::cms_site()?>file/">File</a></li>
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
                        <form class="panel panel-teal form-horizontal form-bordered" enctype="multipart/form-data"  method="post">
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
                                    <label class="col-sm-3 control-label">Level</label>
                                    <div class="col-sm-9">
                                        <span class="radio custom-radio custom-radio-primary">  
                                            <input <?= $formData['file_level']==2?'checked':''?> type="radio" id="file_level2" name="file_level" value="2">  
                                            <label for="file_level2">&nbsp;&nbsp;File</label>

                                            <input <?= $formData['file_level']==1?'checked':''?> type="radio" id="file_level1" name="file_level" value="1">  
                                            <label for="file_level1">&nbsp;&nbsp;Category file</label>
                                        </span>                                        
                                    </div>
                                </div>                                                           
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">File Category</label>
                                    <div class="col-sm-9">
                                        <select name="file_parent" id="f_parent" class="form-control input-sm">
                                            <option value="0">-Chọn danh mục file</option>
                                            <?php if (!empty($list_level_1)): ?>
                                                <?php foreach ($list_level_1 as $key => $value): ?>
                                                    <?php $select = $value["id"] == $formData['file_parent'] ? 'selected' : ''; ?>
                                                    <?php if ($formData['id'] != $value["id"]): ?>
                                                        <option <?= $select?> value="<?= $value["id"]?>"><?= $value["file_title"]?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên file</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="file_title" name="file_title" value="<?= $formData['file_title']?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">STT</label>
                                    <div class="col-sm-9">
                                        <input type="number" min="0" class="form-control" id="file_order" name="file_order" value="<?= $formData['file_order']?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">File</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="_file" id="_file" >
                                    </div>
                                    <?php if ($formData['file_name'] != ''): ?>
                                        <label class="col-sm-3 control-label">Current File</label>
                                        <div class="col-sm-9">
                                            <p class="text-primary" style="padding-top: 5px;"><?= $formData['file_name']?></p>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Hướng dẫn</label>
                                    <div class="col-sm-9">
                                        <textarea name="file_description" class="form-control" rows="8" placeholder="Note..."><?= $formData['file_description']?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <select name="file_status" id="file_status" class="form-control input-sm">
                                        <?= $this->mfile->dropdownlistStatus($formData['file_status'])?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Phòng được xem</label>
                                    <div class="col-sm-9">
                                        <div class="alert alert-dismissable alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>Để tất cả được xem</strong> Để trống mục này!
                                        </div>
                                        <select id="selectize-selectmultiple" class="form-control" placeholder="Chọn phòng" multiple name="file_permission[]">
                                            <?= $this->mgroup->dropdownlist();?>
                                        </select>
                                    </div>
                                </div>                      
                                <div class="panel-footer">
                                    <div class="form-group no-border">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9 text-right">
                                            <button type="submit" name="fsubmit" class="btn btn-primary"><i class="ico-save"></i> Save</button>
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
        <script type="text/javascript">
            jQuery(document).ready(function(){
                <?php if ($formData['file_level'] == 1): ?>
                    if ($('input:radio[name="file_level"]').val() == '1') {$("#f_parent").attr('disabled','disabled');}
                <?php endif ?>
                $('input:radio[name="file_level"]').change(function(){
                    if($(this).val() == '1'){
                       $("#f_parent").attr('disabled','disabled');
                    }
                    if($(this).val() == '2'){
                       $("#f_parent").removeAttr('disabled');
                    }
                });
            });
        </script>
