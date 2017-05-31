
<section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">Xem bình chọn</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li><a href="<?= my_lib::cms_site()?>vote/">Bình chọn</a></li>
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
                                                <h4 class="bold nm text-primary text-center"><?= isset($myVote['vote_create_date']) && $myVote['vote_create_date'] ? date("d",strtotime($myVote['vote_create_date'])):date("d")?></h4>
                                            </div>
                                            <hr class="nm">
                                            <div class="pa10 bgcolor-default">
                                                <p class="semibold nm text-default text-center"><?= isset($myVote['vote_create_date']) && $myVote['vote_create_date'] ? date("M",strtotime($myVote['vote_create_date'])):date("M")?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ post date -->

                                    <!-- post content -->
                                    <div class="col-xs-9 col-sm-11 col-md-11">
                                        <!-- heading -->
                                        <h4 class="mt0"><a class="text-primary"><?= isset($myVote['vote_name']) && $myVote['vote_name'] ? $myVote['vote_name']:''?></a></h4>
                                        <!--/ heading -->

                                        <!-- text -->
                                        <div class="text-default">
                                            <?= isset($myVote['vote_content']) && $myVote['vote_content'] ? $myVote['vote_content']:''?>
                                        </div>
                                        <!--/ text -->

                                        <!-- meta -->
                                        <p class="meta mt15 mb0">
                                            <?php if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']) { ?><a href="<?= base64_decode($_REQUEST['redirect'])?>"><i class="ico-enter4"></i> trở về</a><?php } ?>
                                        </p>
                                        <!--/ meta -->
                                    </div>
                                    <!--/ post content -->
                                </div>
                            </section>
                            <!--/ Content -->

                            <hr />

                            <!-- Content -->
                            <section class="panel-body">
                                <div class="row">
                                    <!-- post content -->
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <!-- heading -->
                                        <h4 class="mt0"><a class="text-primary text-center"></a></h4>
                                        <!--/ heading -->

                                        <!-- text -->
                                        <div class="text-default">
                                            <table class="table table-hover">
                                                <caption><b>Kết quả bình chọn</b></caption>
                                                <tbody>
                                                    <?php
                                                    if(isset($listVoteReply) && $listVoteReply)
                                                    {
                                                        foreach ($listVoteReply as $key => $value) {
                                                            # code...
                                                            $percent = isset($value["reply_view"]) && $value["reply_view"] > 0 ? ($value["reply_view"] * 100)/$countVoteReply:0;
                                                            $percent = round($percent,2);
                                                            $tmp_stautus = $this->mvote->listStatusName($value['reply_status']);                                                
                                                            $value['reply_status'] = '<label class="label label-xs" style="background:'.$tmp_stautus["bg"].';color:'.$tmp_stautus["color"].'">'.$tmp_stautus["name"].'</label>';
                                                            $link_delete = my_lib::cms_site().'vote_reply/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                            echo '<tr>';
                                                                echo '<td width="23%">'.$value["reply_name"].'<br />'.$value['reply_status'].'</td>';
                                                                echo '<td width="50%" align="left">';
                                                                    echo '<div class="progress progress-sm progress-striped active">';
                                                                        echo '<div style="width: '.$percent.'%" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">';
                                                                        echo '</div>';
                                                                    echo '</div>';
                                                                echo '</td>';
                                                                echo '<td width="15%" align="right"><label class="label label-primary">'.$percent.' %</label>';
                                                                echo '</td>';
                                                                echo '<td width="10%" align="right"><label class="label label-success">'.$value["reply_view"].'</label>';
                                                                echo '</td>';
                                                                echo '<td width="10%" align="right"><a onclick="return Delete();" class="btn btn-default btn-xs" href="'.$link_delete.'"><i class="ico-trash"></i></a></td>';
                                                            echo '</tr>';
                                                        }
                                                    }
                                                    ?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" align="right">Tổng cộng: <label class="label label-danger"><?=  $countVoteReply?></label></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!--/ text -->

        
                                    </div>
                                    <!--/ post content -->
                                </div>
                            </section>
                            <!--/ Content -->

                            <!-- Post Comments -->
                            <section class="panel-footer pb0">
                                <h4 class="mt0 mb15 text-primary"><i class="ico-plus"></i> Đăng thêm câu bình chọn</h4>
                                <!-- form -->
                                <form class="form-horizontal" method="post">
                                    <div class="form-group message-container">
                                        <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                                            
                                            <p class="nm">Mời bạn nhập câu trả lời cho bình chọn</p>
                                        </div>
                                    </div><!-- will be use as done/fail message container -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Câu trả lời</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="reply_name" name="reply_name" value="<?= $formData['reply_name']?>" required="required">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Số thứ tự</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="reply_orderby" name="reply_orderby" value="<?= $formData['reply_orderby']?>" required="required">
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Trạng thái</label>
                                        <div class="col-sm-9">
                                            <select class="form-control reply_status" name="reply_status" placeholder="Select a person...">
                                                <?= $reply_status;?>
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
                       


                        <!-- Tabbed content -->
                        <div class="row">
                            <div class="col-xs-12">                                
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#popular" data-toggle="tab">Các bình chọn khác</a></li>                                    
                                </ul>
                                <div class="tab-content panel nm">
                                    <div class="tab-pane active pl0 pr0" id="popular">
                                        <!-- Media list -->
                                        <div class="media-list">
                                            <?php
                                            if(isset($ortherVote) && $ortherVote)
                                            {
                                                foreach ($ortherVote as $key => $value) {
                                                    # code...
                                                    $link_view = my_lib::cms_site().'vote/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());                                                    
                                                    $tmp_stautus = $this->mvote->listStatusName($value['vote_status']);                                                
                                                    $value['vote_status'] = '<small class="btn btn-xs" style="background:'.$tmp_stautus["bg"].';color:'.$tmp_stautus["color"].'">'.$tmp_stautus["name"].'</small>';
                                                    echo '<a href="'.$link_view.'" class="media border-dotted">';
                                                        echo '<span class="media-body">';                           
                                                            echo '<span class="media-heading">'.$value["vote_name"].'</span>';
                                                            echo '<span class="media-meta">'.date("d/m/Y", strtotime($value["vote_create_date"])).'</span>';                                 
                                                            echo '<span class="media-meta">| Trạng thái: '.$value["vote_status"].'</span>';                                 
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