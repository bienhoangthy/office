
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
                                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Table </h3>                                
                            </div>
                            <!--/ panel heading/header -->

                            <!-- panel toolbar wrapper -->
                            <div class="panel-toolbar-wrapper pl0 pt5 pb5">
                                <div class="panel-toolbar pl10">
                                    
                                </div>
                                <div class="panel-toolbar text-right">

                                    <a href="<?= my_lib::cms_site()?>news/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Add</a>
                                </div>
                            </div>
                            <!--/ panel toolbar wrapper -->

                            <!--begin form tim kiem-->
                            <form method="get">
                                <div class="panel-toolbar-wrapper pt5 pb5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">                                         
                                            <select  class="form-control fparent" name="fparent" required="required" onchange="this.form.submit()">
                                            <?= $fparent;?>
                                            </select>  
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">                                         
                                            <select class="form-control fstatus" name="fstatus" onchange="this.form.submit()">                                            
                                            <?= $fstatus;?>
                                            </select>  
                                        </div> 
                                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">                                         
                                            <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Search">
                                        </div>                                        
                                        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">                                         
                                            <input type="hidden" name="page" value="<?= $page?>">
                                            <button type="submit" value="Search" class="btn btn-success"><i class="ico-search"></i> Tìm kiếm</button>
                                        </div>

                                    </div>                                        
                                </div>
                                <!--end form tim kiem-->
                            </form>
                            <!-- panel body with collapse capabale -->
                            <form method="post">
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th colspan="11">
                                                <div class="checkbox custom-checkbox pull-left">  
                                                    <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                                    <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                                    <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                                </div>
                                                <div class="pull-right">
                                                    <ul class="pagination pagination-sm mt0">                                                   
                                                    <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>
                                            <th width="5%"></th>
                                            <th width="20%">Tiêu đề</th>
                                            <th>Danh mục</th>
                                            <th class="text-center">Loại</th>                                            
                                            <th>Tác giả</th>
                                            <th width="14%">Tags</th>
                                            <th>Ngày đăng</th>       
                                            <th class="text-center">Trạng thái</th>                                     
                                            <th class="text-center">Nhân viên</th>                                     
                                            <th width="9%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                # code...
                                                $picture = isset($value['news_picture']) && $value['news_picture'] ?  $value['news_picture']:my_lib::cms_img().'avatar/avatar.png';
                                                $myMenu = $this->mmenu->getData('',array("id"=>$value['news_parent']));
                                                $value['news_parent'] = isset($myMenu['menu_name']) ? $myMenu['menu_name']:'';

                                                $myUser = $this->muser->getData('',array("id"=>$value['user']));
                                                $value['user'] = isset($myUser['user_fullname']) ? $myUser['user_fullname']:'';

                                                $value['news_type'] = $this->mnews->listTypeName($value['news_type']);

                                                $tmp_st = $value['news_status'];
                                                $tmp_stautus = $this->mnews->listStatusName($value['news_status']);                                                
                                                $value['news_status'] = '<span class="label" style="background:'.$tmp_stautus["bg"].';color:'.$tmp_stautus["color"].'">'.$tmp_stautus["name"].'</span>';
                                                
                                                $value['news_hot'] = isset($value['news_hot']) && $value['news_hot']==1 ? '<a class="btn btn-info btn-xs">H</a>':'<a class="btn btn-info btn-xs opacity05">H</a>';
                                                $value['news_home'] = isset($value['news_home']) && $value['news_home']==1 ? '<a class="btn btn-success btn-xs"><i class="ico-home"></i></a>':'<a class="btn btn-success btn-xs opacity05"><i class="ico-home"></i></a>';
                                                $countComment = $this->mcomment->countQuery("","news_id=".$value["id"]);
                                                $link_website = my_lib::base_url().$value["news_alias"].'-'.$value["id"].'.html';
                                                $link_comment = my_lib::cms_site().'comment/?fnewsid='.$value["id"].'&redirect='.base64_encode(current_url());
                                                $link_detail = my_lib::cms_site().'news/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_update = my_lib::cms_site().'news/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = my_lib::cms_site().'news/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                                echo '<tr>';
                                                    echo '<td>';
                                                        echo '<div class="checkbox custom-checkbox nm">';
                                                            echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                            echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                        echo '</div>';
                                                    echo '</td>';

                                                    echo '<td>';
                                                        echo '<div class="media-object"><img src="'.$picture.'" alt="" class="img-circle"></div>';
                                                    echo '</td>';

                                                    echo '<td>';
                                                        echo '<a target="_blank" href="'.$link_website.'">'.$value["news_name"].'</a><br />';
                                                        if($value['news_view']>0)
                                                        {                                                            
                                                            echo 'lượt xem: '.$value["news_view"];
                                                        }

                                                        if($countComment>0)
                                                        {                                                            
                                                            echo '<a class="text-black" href="'.$link_comment.'"> |  <i class="ico-comments-alt"></i> bình luận: '.$countComment.'</a>';
                                                        }
                                                        
                                                    echo '</td>';
                                                    echo '<td>'.$value["news_parent"].'</td>';
                                                    echo '<td><small>'.$value["news_type"].'</small></td>';                                                    
                                                    echo '<td><small>'.$value["news_author"].'</small></td>';
                                                    echo '<td><small>'.$value["news_seo_keyword"].'</small></td>';
                                                    echo '<td><small>'.$value["news_create_date"].'</small></td>';
                                                    echo '<td class="text-center">';
                                                        echo '<p data-toggle="modal" data-target="#bs-modal'.$value['id'].'">'.$value["news_status"].'</p>';
                                                        echo '<p>';
                                                        echo $value["news_hot"] .'&nbsp;';
                                                        echo $value["news_home"];
                                                        echo '</p>';
                                                    echo '</td>';
                                                    echo '<td class="text-center"><small>'.$value["user"].'</small></td>';

                                                    echo '<td class="text-center">';
                                                        echo '<div class="toolbar">';
                                                            echo '<div class="btn-group">';
                                                                echo '<button type="button" class="btn btn-xs btn-default">Action</button>';
                                                                echo '<button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">';
                                                                    echo '<span class="caret"></span>';
                                                                echo '</button>';
                                                                echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                                    echo '<li><a href="'.$link_detail.'"><i class="icon ico-eye"></i>Xem trước</a></li>';
                                                                    echo '<li class="divider"></li>';
                                                                    echo '<li><a href="'.$link_update.'"><i class="icon ico-pencil"></i>Update</a></li>';
                                                                    echo '<li class="divider"></li>';
                                                                    echo '<li><a href="'.$link_delete.'" onclick="return Delete();" class="text-danger"><i class="icon ico-remove3"></i>Delete</a></li>';
                                                                echo '</ul>';
                                                            echo '</div>';
                                                            if($tmp_st!=1)
                                                            {
                                                                echo '<p style="margin-top:10px;"><a href="'.$link_detail.'" class="label label-success">Duyệt tin</a></p>';
                                                            }
                                                        echo '</div>';
                                                    echo '</td>';
                                                echo '</tr>';   

                                                /**begin ghi chu trang thai*/   
                                                $value["news_status_note"] = $value["news_status_note"] && $tmp_st!=1 ? $value["news_status_note"]:'Không có lý do nào';
                                                echo '<div id="bs-modal'.$value["id"].'" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">                                                            
                                                            <div class="modal-body">
                                                                <h4 class="semibold mt0">Lý do không được duyệt</h4>
                                                                <hr />
                                                                <p>'.$value["news_status_note"].'</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                                /**end ghi chu trang thai*/                                             
                                                $i++;
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="11">
                                                <div class="text-right">
                                                    <ul class="pagination pagination-sm mt0"><?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>                                
                                </table>
                            </div>   
                            </form>                                                 
                        </div>                        
                    </div>
                    
                </div>
                <!--/ END row -->                        
            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main-->
        