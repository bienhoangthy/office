
<!--START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">Danh sách nhân viên
                        <span class="badge badge-teal"><?= $record?></span></h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">News</li>
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                
                    <div class="col-md-12">
                        <!--begin masseage-->
                        <?php if(isset($error) && $error) { 
                            echo '<div class="alert alert-danger">';
                                echo '<ul>';
                                foreach ($error as $key => $value) {
                                    # code...
                                    echo '<li>'.$value.'</li>';
                                }
                                echo '</ul>';
                            echo '</div>';
                         } ?>
                        <!--end masseage-->

                        <!-- START panel -->
                        <div class="panel panel-primary">
                            <!-- panel heading/header -->
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Danh sách</h3>
                                <!-- panel toolbar -->
                                <div class="panel-toolbar text-right">
                                    <!-- option -->
                                    <div class="option">
                                        <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                        <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                                    </div>
                                    <!--/ option -->
                                </div>
                                <!--/ panel toolbar -->
                            </div>
                            <!--/ panel heading/header -->
                            <!-- panel toolbar wrapper -->
                            <form method="get" action="<?= my_lib::cms_site()?>user/" id="flistData">
                                <div class="panel-toolbar-wrapper pt5 pb5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-5" onchange="this.form.submit()">                                         
                                            <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: tên công ty, địa chỉ, số điện thoại, email">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">                                         
                                            <select onchange="this.form.submit()"  class="form-control fusergroup" name="fusergroup" placeholder="Select a person..." required="required">
                                            <?= $fusergroup;?>
                                            </select>  
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                            <select onchange="this.form.submit()" class="form-control fuserstatus" name="fuserstatus">                                            
                                            <?= $fuserstatus;?>
                                            </select>  
                                        </div> 
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                            <select onchange="this.form.submit()" class="form-control fuserdepartment" name="fuserdepartment">                                            
                                            <?= $fuserdepartment;?>
                                            </select>  
                                        </div> 
                                                            
                                        <input type="hidden" name="page" value="<?= $page?>">
                                        <!-- <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">                                         
                                            <button type="submit" value="Search" class="btn btn-success"><i class="ico-search"></i> Tìm kiếm</button>
                                        </div> -->

                                    </div>                                        
                                </div>
                                <!--end form tim kiem-->
                            </form>
                            <!--/ panel toolbar wrapper -->

                            <!-- panel body with collapse capabale -->
                            <div class="table-responsive panel-collapse pull out">
                            <form method="post">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th colspan="10">                                                
                                                <div class="pull-right">
                                                    <ul class="pagination pagination-sm mt0">
                                                    <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                                </div>
                                                <div class="pull-left" style="margin-left:5px;">                                                                                               
                                                    <a href="<?= my_lib::cms_site()?>user/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Thêm mới</a>                                          
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>
                                            <th width="5%"></th>
                                            <th width="20%">Họ tên/username</th>
                                            <th>Phòng ban</th>
                                            <th>Level</th>
                                            <th>Chức vụ</th>                                            
                                            <th>Người quản lý</th>                                            
                                            <th width="10%" class="text-center">Trạng thái</th>
                                            <th>Đăng nhập lần cuối</th>                                            
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                # code...
                                                $avatar = my_lib::base_url().'media/user/'.$value['user_avatar'];
                                                if ($value['user_avatar'] == "") {
                                                    $avatar = my_lib::cms_img().'avatar/avatar.png'; 
                                                }                                                  
                                                $myDepartment = $this->mdepartment->getData('',array("id"=>$value['user_department']));
                                                $myUser = $this->muser->getData('user_fullname',array("id"=>$value['user_parent']));
                                                $value['user_department'] = isset($myDepartment['department_name']) ? $myDepartment['department_name']:'';
                                                $myGroup = $this->mgroup->getData('',array("id"=>$value['user_group']));
                                                $value['user_group'] = isset($myGroup['group_name']) ? $myGroup['group_name']:'';
                                                $value['group_note'] = isset($myGroup['group_note']) ? $myGroup['group_note']:'';
                                                
                                                $tmpStatus = $this->muser->listStatusName($value['user_status']);
                                                $value["user_status"] = '<small class="label" style="background:'.$tmpStatus["bg"].';color:'.$tmpStatus["color"].'">'.$tmpStatus["name"].'</small>';

                                                $link_update = my_lib::cms_site().'user/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_profile = my_lib::cms_site().'user/profile/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = my_lib::cms_site().'user/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                echo '<tr>';
                                                    echo '<td class="text-center">'.$value["id"].'</td>';
                                                    echo '<td>';
                                                        echo '<div class="media-object"><img src="'.$avatar.'" alt="" class="img-circle"></div>';
                                                    echo '</td>';

                                                    echo '<td>'.$value["user_fullname"].'/<code>'.$value["user_username"].'</code></td>';
                                                    echo '<td>'.$value["user_department"].'</td>';                                                    
                                                    echo '<td title="'.$value['group_note'].'">'.$value["user_group"].'</td>';                                                    
                                                    echo '<td>'.$value["user_position"].'</td>';                                                    
                                                    echo '<td class="text-center">'.$myUser["user_fullname"].'</td>';                                                    
                                                    echo '<td class="text-center">'.$value["user_status"].'</td>';                                                    
                                                    echo '<td>'.$value["user_updatedate"].'</td>';                                                    

                                                    echo '<td>';
                                                        echo '<div class="toolbar">';
                                                            echo '<div class="btn-group">';
                                                                echo '<button type="button" class="btn btn-sm btn-default">Action</button>';
                                                                echo '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">';
                                                                    echo '<span class="caret"></span>';
                                                                echo '</button>';
                                                                echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                                    echo '<li><a href="'.$link_update.'"><i class="icon ico-pencil"></i>Update</a></li>';
                                                                    echo '<li class="divider"></li>';
                                                                    echo '<li><a href="'.$link_profile.'"><i class="icon ico-drawer3"></i>Profile</a></li>';
                                                                    //echo '<li><a href="'.$link_delete.'" onclick="return Delete();" class="text-danger"><i class="icon ico-remove3"></i>Delete</a></li>';
                                                                echo '</ul>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    echo '</td>';
                                                echo '</tr>';                                                
                                                $i++;
                                            }
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                </form>
                            </div>
                            
                            <!--/ panel body with collapse capabale -->
                        </div>
                    </div>                  
                </div>
                <!--/ END row -->                        
            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main-->
        