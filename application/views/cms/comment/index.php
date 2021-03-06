<!--START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold"><?= $title?> <span class="badge badge-teal"><?= $record?></span></h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">Bình luận</li>
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                <form method="post">
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
                            </div>
                            <!--/ panel heading/header -->
                            
                            <!-- panel toolbar wrapper -->
                            <div class="panel-toolbar-wrapper pl0 pt5 pb5">
                                <div class="panel-toolbar pl10">
                                    <div class="checkbox custom-checkbox pull-left">  
                                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                        <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                        <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                    </div>
                                </div>
                                <div class="panel-toolbar text-right">

                                    <a href="<?= my_lib::cms_site()?>comment/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Add</a>
                                </div>
                            </div>
                            <!--/ panel toolbar wrapper -->

                            <!--begin form tim kiem-->
                            <div class="panel-toolbar-wrapper pt5 pb5">
                                <div class="row">                                   
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">                                         
                                        <select class="form-control fstatus" name="fstatus">                                            
                                        <?= $fstatus;?>
                                        </select>  
                                    </div> 
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">                                         
                                        <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Search">
                                    </div>                                        
                                    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">                                         
                                        <button type="submit" value="Search" class="btn btn-primary"><i class="ico-search"></i> Tìm kiếm</button>
                                    </div>

                                </div>                                        
                            </div>
                            <!--end form tim kiem-->

                            <!-- panel body with collapse capabale -->
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                            
                                            <th>Lời bình luận</th>
                                            <th>Bài viết</th>
                                            <th width="15%">Ngày đăng</th>
                                            <th class="text-center" width="10%">Trạng thái</th>
                                            <th width="12%">Người đăng</th>                                                                                        
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                # code... 
                                                $myUser = $this->muser->getData('',array("id"=>$value['user']));
                                                $value['user'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';
                                                
                                                $myNews = $this->mnews->getData('',array("id"=>$value['news_id']));
                                                $link_news = my_lib::cms_site().'news/detail/'.$value["news_id"].'/#comment'.$value["id"];
                                                $value['news_id'] = isset($myNews['news_name']) && $myNews['news_name'] ? $myNews['news_name']:'';

                                                $tmp_stautus = $this->mcomment->listStatusName($value['com_status']);                                                
                                                $value['com_status'] = '<small class="btn btn-xs" style="background:'.$tmp_stautus["bg"].';color:'.$tmp_stautus["color"].'">'.$tmp_stautus["name"].'</small>';
                                                $link_view = my_lib::cms_site().'comment/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_update = my_lib::cms_site().'comment/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = my_lib::cms_site().'comment/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                                echo '<tr>';
                                                    echo '<td>';
                                                        echo '<div class="checkbox custom-checkbox nm">';
                                                            echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                            echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                        echo '</div>';
                                                    echo '</td>';                                                

                                                    echo '<td>';
                                                        echo '<a href="'.$link_view.'">'.$value["com_title"].'</a><br />';
                                                        echo '<small><a class="label label-success" href="#"><i class="ico-reply"></i> Xem trả lời: 0</a></small>';
                                                    echo '</td>';
                                                    echo '<td><a href="'.$link_news.'">'.$value["news_id"].'</a></td>';
                                                    echo '<td>'.$value["com_create_date"].'</td>';                                                    
                                                    echo '<td class="text-center">'.$value["com_status"].'</td>';
                                                    echo '<td>'.$value["user"].'</td>';                                                    

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
                                                                    echo '<li><a href="'.$link_delete.'" onclick="return Delete();" class="text-danger"><i class="icon ico-remove3"></i>Delete</a></li>';
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
                            </div>
                            <!--/ panel body with collapse capabale -->
                        </div>
                    </div>
                    </form>
                </div>
                <!--/ END row -->                        
            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main-->
        