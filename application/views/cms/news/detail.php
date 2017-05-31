
<section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold"><a><?= isset($myNews['news_name']) && $myNews['news_name'] ? $myNews['news_name']:''?></a></h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li><a href="<?= my_lib::cms_site()?>news/">Xem trước</a></li>
                                <li class="active"><?= $title?></li>
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                <div class="row">
                    <div class="col-lg-9">
                        <!-- Blog post #1 -->
                        <article class="panel overflow-hidden">                            
                            <!-- Content -->
                            <section class="panel-body">
                                <div class="row">
                                    <!-- post date -->
                                    <div class="col-xs-3 col-sm-1 col-md-1 pr0">
                                        <div class="panel widget">
                                            <div class="pa10">
                                                <h4 class="bold nm text-primary text-center"><?= isset($myNews['news_create_date']) && $myNews['news_create_date'] ? date("d",strtotime($myNews['news_create_date'])):date("d")?></h4>
                                            </div>
                                            <hr class="nm">
                                            <div class="pa10 bgcolor-default">
                                                <p class="semibold nm text-default text-center"><?= isset($myNews['news_create_date']) && $myNews['news_create_date'] ? date("M",strtotime($myNews['news_create_date'])):date("M")?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ post date -->

                                    <!-- post content -->
                                    <div class="col-xs-9 col-sm-11 col-md-11">
                                        <!-- heading -->
                                        <!-- <h4 class="mt0"><a class="text-primary"></a></h4> -->
                                        <!--/ heading -->

                                        <!-- text -->
                                        <div class="text-default news_detail">
                                            <?= isset($myNews['news_detail']) && $myNews['news_detail'] ? $myNews['news_detail']:''?>
                                        </div>
                                        <!--/ text -->

                                        <!-- meta -->
                                        <p class="meta mt15 mb0">
                                            <?php if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']) { ?><a href="<?= base64_decode($_REQUEST['redirect'])?>"><i class="ico-enter4"></i> trở về</a><?php } ?>
                                            <span class="text-muted mr5 ml5">&#8226;</span>
                                            
                                            <a href="#view_comment"><i class="ico-comment-alt"></i> <?= $countComment?> bình luận</a><!-- comments -->
                                            <span class="text-muted mr5 ml5">&#8226;</span>
                                            <a><i class="ico-eye"></i> <?= isset($myNews['news_view']) && $myNews['news_view'] ? $myNews['news_view']:0?> lượt xem</a><!-- view -->
                                            <span class="text-muted mr5 ml5">&#8226;</span>
                                            <a><i class="ico-clock6"></i> <?= isset($myNews['news_create_date']) && $myNews['news_create_date'] ? $myNews['news_create_date']:''?></a><!-- ngay dang -->
                                            <span class="text-muted mr5 ml5">&#8226;</span>
                                            <a><i class="ico-user"></i> Tác giả: <?= isset($myNews['news_author']) && $myNews['news_author'] ? $myNews['news_author']:'admin'?></a><!-- ngay dang -->                                            
                                        </p>
                                        <!--/ meta -->
                                    </div>
                                    <!--/ post content -->
                                </div>
                            </section>
                            <!--/ Content -->
                                
                            <hr />

                             <!-- Comments -->
                            <section class="panel-body" id="view_comment">
                                <h4 class="mt0 mb15 text-primary"><i class="ico-comment-alt"></i> Bình luận (<?= $countComment?>)</h4>
                                <div class="media-list media-list-bubble">                                    
                                <?php
                                if(isset($listComment) && $listComment)
                                {
                                    foreach ($listComment as $key => $value) 
                                    {
                                        # code...
                                        $myUser = $this->muser->getData('',array("id"=>$value['user_post']));
                                        $value['user_post'] = isset($myUser['user_fullname']) ? $myUser['user_fullname']:'';
                                        $value['avatar'] = isset($myUser['user_avatar']) ? $myUser['user_avatar']:'';
                                        $tmp_stautus = $this->mcomment->listStatusName($value['com_status']);                                                
                                                $value['com_status'] = '<spam class="label" style="background:'.$tmp_stautus["bg"].';color:'.$tmp_stautus["color"].'">'.$tmp_stautus["name"].'</spam>';
                                        $link_update = my_lib::cms_site().'comment/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());

                                        echo '<div class="media" id="comment'.$value["id"].'">';
                                            echo '<a class="media-object pull-left">';
                                                echo '<img src="'.$value['avatar'].'" class="img-circle" alt="">';
                                            echo '</a>';
                                            echo '<div class="media-body">';
                                                echo '<div class="media-text">';
                                                    echo '<h5 class="semibold mt0 mb5 text-default"><a>'.$value["com_title"].'</a></h5>';
                                                    echo '<p class="mb5">'.$value["com_detail"].'</p>';                                                    
                                                    echo '<p class="mt5 mb0">';
                                                        echo '<small><i class="ico-user"></i> '.$value['user_post'].'</small>';
                                                        echo '<span class="mr5 ml5 text-muted">&nbsp;</span>';
                                                        echo '<span class="media-meta"><i class="ico-clock6"></i> '.date("D, d/m/Y H:i:s a",strtotime($value["com_create_date"])).'</span>';
                                                        echo $value['com_status'];
                                                        echo ' <a class="label label-info" href="'.$link_update.'"><i class="icon ico-pencil"></i> Edit</a>';
                                                    echo '</p>';                                                    
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                }
                                ?>                                
                                </div>
                            </section>
                            <!-- Comments -->

                            <!-- Post Comments -->
                            <section class="panel-footer pb0">
                                <h4 class="mt0 mb15 text-primary">Đăng bài bình luận</h4>
                                <!-- form -->
                                <form class="form-horizontal" method="post">
                                    <div class="form-group message-container">
                                        <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                                            
                                            <p class="nm">Mời bạn nhập lời bình luận cho bài viết</p>
                                        </div>
                                    </div><!-- will be use as done/fail message container -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tiêu đề</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="com_title" name="com_title" value="<?= $formData['com_title']?>" required="required">
                                        </div>
                                    </div> 
                                                            

                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nội dung</label>
                                        <div class="col-sm-9">
                                        <textarea class="form-control" rows="8" id="com_detail" name="com_detail" ><?= $formData['com_detail']?></textarea>                                        
                                        </div>
                                    </div>
                            
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Trạng thái</label>
                                        <div class="col-sm-9">
                                            <select class="form-control com_status" name="com_status" placeholder="Select a person...">
                                                <?= $com_status;?>
                                            </select>                                        
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
                                </form>
                                <!-- form -->
                            </section>
                            <!--/ Post Comments -->


                        </article>
                        <!--/ Blog post #1 -->
                    </div>
                    <!--/ END left / top side -->

                    <!-- START right / bottom side -->
                    <div class="col-lg-3">                                
                        <!-- Duyeejt ti -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="semibold mt0 text-primary">Trạng thái & Danh mục</h5>
                                <div class="btn-tag">
                                    <form method="post">
                                        <div class="form-group">
                                             <select  class="form-control news_parent" name="news_parent" placeholder="Select a person..." required="required">
                                                <?= $parent;?>
                                            </select>                                         
                                        </div>
                                        <div class="form-group">
                                             <select class="form-control news_status" name="news_status" placeholder="Select a person...">
                                                <?= $news_status;?>
                                            </select>  
                                        </div>
                                        <div class="form-group">
                                             <textarea class="form-control" name="news_status_note" placeholder="Ghi chú trạng thái"><?= isset($myNews['news_status_note']) && $myNews['news_status_note'] ? $myNews['news_status_note']:''?></textarea>
                                        </div>
                                        <div class="form-group pull-right">
                                            <a href="<?= my_lib::cms_site().'news/index/';?>" class="btn btn-default">Quay về</a>
                                            <button type="submit" name="fsubmitStatus" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Duyeejt ti -->
                        
                        <hr><!-- horizontal line -->                                  
                        <!-- Tags -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="semibold mt0 text-primary">Ảnh đại diện</h5>
                                <div class="btn-tag">
                                    <img src="<?= isset($myNews['news_picture']) && $myNews['news_picture'] ? $myNews['news_picture'] :my_lib::cms_img().'avatar/avatar.png';?>" width="100%">
                                </div>
                            </div>
                        </div>
                        <!-- Tags -->
                        
                        <hr><!-- horizontal line -->                               
                        <!-- Tags -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="semibold mt0 text-primary">Tags</h5>
                                <div class="btn-tag">
                                    <?php
                                    if(isset($myNews['news_seo_keyword']) && $myNews['news_seo_keyword'])
                                    {
                                        $keyword = explode(",", $myNews['news_seo_keyword']);
                                        if($keyword)
                                        {
                                            foreach ($keyword as $key => $value) 
                                            {
                                                # code...
                                                echo '<a style="margin-left:3px;" class="btn btn-default btn-sm">'.$value.'</a>';
                                            }
                                        }
                                    }
                                    ?>
                                                                    
                                </div>
                            </div>
                        </div>
                        <!-- Tags -->
                        
                        <hr><!-- horizontal line -->

                        <!-- Tabbed content -->
                        <div class="row">
                            <div class="col-xs-12">                                
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#popular" data-toggle="tab">Tin khác</a></li>                                    
                                </ul>
                                <div class="tab-content panel nm">
                                    <div class="tab-pane active pl0 pr0" id="popular">
                                        <!-- Media list -->
                                        <div class="media-list">
                                            <?php
                                            if(isset($ortherNews) && $ortherNews)
                                            {
                                                foreach ($ortherNews as $key => $value) {
                                                    # code...
                                                    $link_view = my_lib::cms_site().'news/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());                                                    
                                                    echo '<a href="'.$link_view.'" class="media border-dotted">';
                                                        echo '<span class="media-body">';                           
                                                            echo '<span class="media-heading">'.$value["news_name"].'</span>';
                                                            echo '<span class="media-meta">'.date("d/m/Y", strtotime($value["news_create_date"])).'</span>';                                 
                                                        echo '</span>';
                                                    echo '</a>';
                                                }
                                            }
                                            ?>                                        
                                        </div>
                                        <!--/ Message list -->
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <!-- Tabbed content -->
                    </div>
                    <!--/ END right / bottom side -->
                </div>
                </div>
                <!--/ END row -->
                            
            </div>
            <!--/ END Template Container -->

            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>