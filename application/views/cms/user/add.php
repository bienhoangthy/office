
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
                                <li><a href="<?= my_lib::cms_site()?>user/">User</a></li>
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
                        <form class="panel panel-default form-horizontal form-bordered" enctype="multipart/form-data"  method="post" >
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
                                <div class="row">
                                    <div class="col-lg-6">                                                            
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phòng ban</label>
                                            <div class="col-sm-9">
                                                <select class="form-control user_department" name="user_department" placeholder="Select a person..." required="required">
                                                    <?= $user_department;?>
                                                </select>                                        
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">                                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Level</label>
                                            <div class="col-sm-9">
                                                <select class="form-control user_group" name="user_group" placeholder="Select a person..." required="required">
                                                    <?= $user_group;?>
                                                </select>                                        
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">                                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Cấp quản lý</label>
                                            <div class="col-sm-9">
                                                <select class="form-control user_parent" name="user_parent" placeholder="Select a person..." required="required">
                                                    <?= $user_parent;?>
                                                </select>                                        
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Chức vụ</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_position" name="user_position" value="<?= $formData['user_position']?>" required="required">
                                            </div>
                                        </div>  
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_username" name="user_username" value="<?= $formData['user_username']?>" required="required">
                                            </div>
                                        </div> 
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="user_password" name="user_password" value="<?= $formData['user_password']?>" required="required">
                                            </div>
                                        </div>    
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tên nhân viên</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_fullname" name="user_fullname" value="<?= $formData['user_fullname']?>" required="required">
                                            </div>
                                        </div> 
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Giới tính</label>
                                            <div class="col-sm-9">
                                                <span class="radio custom-radio custom-radio-primary">  
                                                    <input <?= $formData['user_gender']==1?'checked':''?> type="radio" id="user_gender1" name="user_gender" value="1">  
                                                    <label for="user_gender1">&nbsp;&nbsp;Nam</label>

                                                    <input <?= $formData['user_gender']==0?'checked':''?> type="radio" id="user_gender0" name="user_gender" value="0">  
                                                    <label for="user_gender0">&nbsp;&nbsp;Nữ</label>
                                                </span>                                        
                                            </div>
                                        </div>

                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ngày sinh</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="From" name="user_birthday" id="user_birthday" value="<?= $formData['user_birthday']?>"/></div>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Địa chỉ</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_address" name="user_address" value="<?= $formData['user_address']?>">
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Địa chỉ thường trú</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_hometown" name="user_hometown" value="<?= $formData['user_hometown']?>">
                                            </div>
                                        </div>  
                                    </div>
                                
                                    <div class="col-lg-6">       
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_hotline" name="user_hotline" value="<?= $formData['user_hotline']?>">
                                            </div>
                                        </div>   
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="user_email" name="user_email" value="<?= $formData['user_email']?>" required="required">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Trình trạng</label>
                                            <div class="col-sm-9">
                                                <select class="form-control user_state" name="user_state" placeholder="Select state">
                                                    <?= $user_state;?>
                                                </select>  
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ngày ký hợp đồng</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-6"><input type="text" class="form-control datepicker" placeholder="Ngày ký hợp đồng" name="user_contractday" id="user_contractday" value="<?= $formData['user_contractday']?>"/></div>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Thời hạn (Tháng)</label>
                                            <div class="col-sm-9">
                                                <input type="number" min="1" class="form-control" id="user_contracttime" name="user_contracttime" value="<?= $formData['user_contracttime']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">TK Ngân hàng</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="user_accountbank" name="user_accountbank" ><?= $formData['user_accountbank']?></textarea> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Trình độ học vấn</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_academic" name="user_academic" value="<?= $formData['user_academic']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Mức lương</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="user_wage" name="user_wage" value="<?= $formData['user_wage']?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Yahoo</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_yahoo" name="user_yahoo" value="<?= $formData['user_yahoo']?>">
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Google +</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_google" name="user_google" value="<?= $formData['user_google']?>">
                                            </div>
                                        </div> 
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Facebook</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_facebook" name="user_facebook" value="<?= $formData['user_facebook']?>">
                                            </div>
                                        </div> 
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Twitter</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_twitter" name="user_twitter" value="<?= $formData['user_twitter']?>">
                                            </div>
                                        </div>  
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Skype</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_skype" name="user_skype" value="<?= $formData['user_skype']?>">
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Giới thiệu</label>
                                            <div class="col-sm-9">
                                            <textarea class="form-control" id="user_intro" name="user_intro" ><?= $formData['user_intro']?></textarea>                                        
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Website</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_website" name="user_website" value="<?= $formData['user_website']?>">
                                            </div>
                                        </div>  
                                    </div>
                                    
                                    <!-- <div class="col-lg-6">
                                        <div class="form-group">                    
                                            <div class="row">                    
                                               <label class="col-sm-3 control-label">Picture</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="user_avatar" name="user_avatar" value="<?= $formData['user_avatar']?>">
                                                        <span class="input-group-btn">
                                                            <a href="<?= my_lib::cms_fileupload()?>dialog.php?type=1&amp;field_id=user_avatar"  class="iframe-btn btn btn-default" type="button">Select</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Trạng thái</label>
                                            <div class="col-sm-9">
                                                <select class="form-control user_status" name="user_status" placeholder="Select a person...">
                                                    <?= $user_status;?>
                                                </select>                                         
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">File</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" name="_file" id="_file" >                                    
                                            </div>
                                        </div> 
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