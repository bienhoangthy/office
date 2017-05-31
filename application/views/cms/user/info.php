
<!--START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">List menu</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">Danh sách</li>
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                    <div class="row" id="shuffle-grid">
                        <?php                         
                            if(isset($list) && $list){         
                            $i=1;                      
                                foreach ($list as $key => $value) {
                                    # code...
                                    $tmpDepart = $this->mdepartment->getData(array('department_name'),array("id"=>$value['user_department']));
                                    $value['user_department'] = $tmpDepart['department_name'];
                                    $link_profile = my_lib::cms_site().'user/profile/'.$value["id"];
                                    $avatar = my_lib::base_url().'media/user/'.$value['user_avatar'];
                                    if ($value['user_avatar'] == "") {
                                        $avatar = my_lib::cms_img().'avatar/avatar.png'; 
                                    }                               
                              ?>
                                <div class="col-sm-6 col-md-4 shuffle">
                                    <div class="panel widget">
                                        <div class="table-layout nm">
                                            <div class="col-xs-4 text-center">
                                                <img src="<?= $avatar?>" width="100%">
                                            </div>
                                            <div class="col-xs-8 valign-middle">
                                                <div class="panel-body">
                                                    <a href="<?= my_lib::cms_site()?>task/?femployee=<?= $value["id"]?>" class="btn btn-sm btn-teal"><i class="ico-list-alt"></i> DS công việc</a>
                                                    <a href="<?= my_lib::cms_site().'task/report/'.$value["id"].'/?redirect='.base64_encode(current_url());?>" class="btn btn-sm btn-default"><i class="ico-bar-chart"></i> Thống kê</a>
                                                    <h5 class="semibold mt5 mb5"><a href="<?= $link_profile?>"><?= $value["user_fullname"]?></a></h5>
                                                    <p class="ellipsis text-muted mb5"><i class="ico-envelop mr5"></i> <?= $value["user_email"]?></p>
                                                    <p class="text-muted nm"><i class="ico-location2 mr5"></i> <?= $value["user_address"]?></p>
                                                    <p class="text-muted nm"><i class="ico-phone2 mr5"></i> <?= $value["user_hotline"]?></p>
                                                    <p class="text-muted nm"><i class="ico-gift22 mr5"></i> <?= $value["user_birthday"]?></p>
                                                    <p class="text-muted nm"><i class="ico-sitemap mr5"></i> <?= $value["user_position"]?></p>
                                                    <p class="text-muted nm"><i class="ico-office mr5"></i> <?= $value["user_department"]?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                if($i++%3==0)
                                {
                                    echo '<div class="clr"></div>';
                                }
                              }
                            }
                        ?>                       
                    </div>               
            </div>
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>            
        </section>
    
        