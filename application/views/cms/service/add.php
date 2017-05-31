
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
                                <li><a href="<?= my_lib::cms_site()?>service/">Service</a></li>
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
                                    <label class="col-sm-3 control-label">Dịch vụ</label>
                                    <div class="col-sm-9">
                                        <span class="radio custom-radio custom-radio-primary">  
                                            <input <?= $formData['service_level']==1?'checked':''?> type="radio" id="service_level1" name="service_level" value="1">  
                                            <label for="service_level1">&nbsp;&nbsp;Loại</label>

                                            <input <?= $formData['service_level']==2?'checked':''?> type="radio" id="service_level2" name="service_level" value="2">  
                                            <label for="service_level2">&nbsp;&nbsp;Gói</label>
                                        </span>                                        
                                    </div>
                                </div>                                                           
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại dịch vụ</label>
                                    <div class="col-sm-9">
                                        <select name="service_parent" id="ser_parent" class="form-control input-sm">
                                            <option value="0">-Chọn loại dịch vụ</option>
                                            <?php if (!empty($list_level_1)): ?>
                                                <?php foreach ($list_level_1 as $key => $value): ?>
                                                    <?php $select = $value["id"] == $formData['service_parent'] ? 'selected' : ''; ?>
                                                    <?php if ($formData['id'] != $value["id"]): ?>
                                                        <option <?= $select?> value="<?= $value["id"]?>"><?= $value["service_name"]?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên dịch vụ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="service_name" name="service_name" value="<?= $formData['service_name']?>" required="required">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên viết tắt</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="service_acronym" name="service_acronym" value="<?= $formData['service_acronym']?>">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Phí dịch vụ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="service_price" name="service_price" value="<?= $formData['service_price']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ghi chú</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="service_note" rows="5" id="service_note"><?= $formData['service_note']?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Thứ tự</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="service_orderby" name="service_orderby" value="<?= $formData['service_orderby']?>">
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
                <?php if ($formData['service_level'] == 1): ?>
                    if ($('input:radio[name="service_level"]').val() == '1') {$("#ser_parent").attr('disabled','disabled');}
                <?php endif ?>
                $('input:radio[name="service_level"]').change(function(){
                    if($(this).val() == '1'){
                       $("#ser_parent").attr('disabled','disabled');
                    }
                    if($(this).val() == '2'){
                       $("#ser_parent").removeAttr('disabled');
                    }
                });
            });
        </script>
