
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
                                <li><a >Thông báo</a></li>
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
                                                <h4 class="bold nm text-primary text-center"><?= isset($myFeedback['feedback_create_date']) && $myFeedback['feedback_create_date'] ? date("d",strtotime($myFeedback['feedback_create_date'])):date("d")?></h4>
                                            </div>
                                            <hr class="nm">
                                            <div class="pa10 bgcolor-default">
                                                <p class="semibold nm text-default text-center"><?= isset($myFeedback['feedback_create_date']) && $myFeedback['feedback_create_date'] ? date("M",strtotime($myFeedback['feedback_create_date'])):date("M")?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ post date -->

                                    <!-- post content -->
                                    <div class="col-xs-9 col-sm-11 col-md-11">
                                        <!-- heading -->
                                        <h4 class="mt0"><a class="text-primary"><?= isset($myFeedback['feedback_title']) && $myFeedback['feedback_title'] ? $myFeedback['feedback_title']:''?></a></h4>
                                        <!--/ heading -->

                                        <!-- text -->
                                        <div class="text-default">
                                            <?= isset($myFeedback['feedback_detail']) && $myFeedback['feedback_detail'] ? $myFeedback['feedback_detail']:''?>
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
                                    <li class="active"><a href="#popular" data-toggle="tab">Feedback chưa khắc phục</a></li>                                    
                                </ul>
                                <div class="tab-content panel nm">
                                    <div class="tab-pane active pl0 pr0" id="popular">
                                        <!-- Media list -->
                                        <div class="media-list">
                                            <?php
                                            if(isset($ortherFeedback) && $ortherFeedback)
                                            {
                                                foreach ($ortherFeedback as $key => $value) {
                                                    # code...
                                                    $link_view = my_lib::cms_site().'feedback/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());                                                    
                                                    echo '<a href="'.$link_view.'" class="media border-dotted">';
                                                        echo '<span class="media-body">';                           
                                                            echo '<span class="media-heading">'.$value["feedback_title"].'</span>';
                                                            echo '<span class="media-meta">'.date("d/m/Y", strtotime($value["feedback_create_date"])).'</span>';                                 
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