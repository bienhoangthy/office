    <body>
        <!-- START Template Header -->
        <header id="header" class="navbar navbar-fixed-top">
            <!-- START navbar header -->
            <div class="navbar-header">
                <!-- Brand -->
                <a class="navbar-brand" href="<?= my_lib::cms_site();?>home/">
                    <img src="<?= my_lib::cms_img()?>logo.png" alt="" height="80%">
                </a>
                <!--/ Brand -->
            </div>
            <!--/ END navbar header -->

            <!-- START Toolbar -->
            <div class="navbar-toolbar clearfix">
                <!-- START Left nav -->
                <ul class="nav navbar-nav navbar-left">
                    <!-- Sidebar shrink -->
                    <li class="hidden-xs hidden-sm">
                        <a href="javascript:void(0);" class="sidebar-minimize" data-toggle="minimize" title="Minimize sidebar">
                            <span class="meta">
                                <span class="icon"></span>
                            </span>
                        </a>
                    </li>
                    <li class="navbar-main hidden-lg hidden-md hidden-sm">
                        <a href="javascript:void(0);" data-toggle="offcanvas" data-direction="ltr" rel="tooltip" title="Menu sidebar">
                            <span class="meta">
                                <span class="icon"><i class="ico-paragraph-left3"></i></span>
                            </span>
                        </a>
                    </li>
                    
                    <li class="dropdown custom" id="header-dd-notification" title="Danh sách công việc">
                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="icon"><i class="ico-books"></i></span>
                                <?php if(isset($showTask) && count($showTask) > 0) { ?><span class="badge badge-danger"><?= count($showTask)?></span><?php } ?>
                            </span>
                        </a>
                                                
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-header">
                                <span class="title">Công việc cần xử lý: <span class="count badge badge-danger"><?php if(isset($showTask)) { echo count($showTask) ;} ?></span></span>                                
                            </div>
                            <div class="dropdown-body slimscroll">                                                            
                                <div class="media-list"> 
                                    <?php if (isset($showTask) && $showTask): ?>
                                        <?php foreach ($showTask as $key => $value): ?>
                                            <?php $link_task = my_lib::cms_site().'task/edit/'.$value["id"].'/?redirect='.base64_encode(current_url()); ?>  
                                            <a href="<?= $link_task?>" class="media read border-dotted">
                                                <?php if ($value['task_status'] == 1): ?>
                                                    <span class="media-object pull-left">
                                                        <i class="bgcolor-danger ico-pushpin"></i>
                                                    </span>
                                                    <span class="media-body">
                                                        <span class="media-text"><?= $value['task_name']?></span>&nbsp;
                                                        <?php if ($value['task_delay'] == 1): ?>
                                                            <label class="label label-danger">Delay</label>
                                                        <?php endif ?>
                                                        <span class="media-meta pull-left"><i class="ico-clock7"></i><?= date("d/m/Y",strtotime($value["task_expectedday"]))?></span>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="media-object pull-left">
                                                        <i class="bgcolor-warning ico-hand"></i>
                                                    </span>
                                                    <span class="media-body">
                                                        <span class="media-text"><?= $value['task_name']?></span>&nbsp;
                                                        <?php if ($value['task_delay'] == 1): ?>
                                                            <label class="label label-default">Việc hoãn</label>
                                                            <label class="label label-danger">Delay</label>
                                                        <?php endif ?>
                                                        <span class="media-meta pull-left"><i class="ico-clock7"></i><?= date("d/m/Y",strtotime($value["task_expectedday"]))?></span>
                                                    </span>
                                                <?php endif ?>
                                            </a>               
                                        <?php endforeach ?>                     
                                    <?php endif ?>                               
                                </div>                              
                            </div>
                        </div>                    
                    </li>
                    <!-- End Task -->

                    <!-- thong bao -->
                    <li class="dropdown custom" id="header-dd-notification" title="Thông báo">
                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="icon"><i class="ico-bell"></i></span>
                                <?php if(isset($showMessage) && count($showMessage) > 0) { ?><span class="badge badge-success"><?= count($showMessage)?></span><?php } ?>
                            </span>
                        </a>
                                                
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-header">
                                <span class="title">Thông báo: <span class="count badge badge-success"><?php if(isset($showMessage)) { echo count($showMessage) ;} ?></span></span>                                
                            </div>
                            <div class="dropdown-body slimscroll">                                                            
                                <div class="media-list"> 
                                    <?php if(isset($showMessage) && $showMessage) { 
                                            $i=1;
                                            foreach ($showMessage as $key => $value) {                                                                                                
                                                $link_detail = my_lib::cms_site().'message/detail/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $file = $value["ms_file"] != '' ? ' <span class="ico-file6"></span>' : '';
                                                $datenow = date("Y-m-d");
                                                if (strtotime($datenow) <= strtotime($value["ms_end_date"])) {
                                                    echo '<a href="'.$link_detail.'" class="media read border-dotted">
                                                        <span class="media-object pull-left">
                                                            <i class="bgcolor-success ico-quotes-left"></i>
                                                        </span>
                                                        <span class="media-body">
                                                            <span class="media-text">'.$value["ms_title"].'
                                                            </span>                                                        
                                                            <span class="media-meta pull-left"><i class="ico-clock7"></i> '.date("d/m/Y",strtotime($value["ms_create_date"])).'</span> '.$file.'                                                       
                                                        </span>
                                                    </a>';
                                                } else {
                                                    $this->mmessage->edit($value["id"],array('ms_status' => 0));
                                                }                                                    
                                            }
                                         } ?>                                    
                                </div>                              
                            </div>
                        </div>                    
                    </li>
                    <!--/ thong bao --> 
                    

                    <!-- sinh nhat -->
                    <li class="dropdown custom" id="header-dd-notification" title="Sinh nhật">
                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <span class="icon"><i class="ico-cake"></i></span>
                                <?php if((isset($listBDNow) || isset($listBDSoon)) && (count($listBDNow) +  count($listBDSoon)) > 0) { ?><span class="badge badge-primary"><?= count($listBDNow) +  count($listBDSoon)?></span> <?php } ?>
                            </span>
                        </a>
                                                
                        <div class="dropdown-menu" role="menu">
                            <div class="dropdown-header">
                                <span class="title">Sinh nhật: <span class="count badge badge-primary"><?php if(isset($listBDNow) || isset($listBDSoon)) { echo count($listBDNow) +  count($listBDSoon);} ?> nhân viên</span></span>                                
                            </div>
                            <div class="dropdown-body slimscroll">                                                            
                                <div class="media-list">
                                    <?php $marqueeBD = array(''); ?>
                                    <?php if (!empty($listBDNow)): ?>
                                        <?php foreach ($listBDNow as $key => $value): ?>
                                            <?php
                                                $userBDNow = $this->muser->getInfoBD($value);
                                                $avatar_user = my_lib::base_url().'media/user/'.$userBDNow['user_avatar'];
                                                    if ($userBDNow['user_avatar'] == "") {
                                                        $avatar_user = my_lib::cms_img().'logo.png';
                                                    }
                                                $noBD = date("Y") - date("Y",strtotime($userBDNow['user_birthday']));
                                                $BD = array('no' => $noBD,'name' => $userBDNow['user_fullname']);
                                                array_push($marqueeBD, $BD);
                                            ?>
                                            <a class="media border-dotted read">
                                                <span class="pull-left">
                                                    <img src="<?= $avatar_user?>" class="media-object img-circle" alt="<?= $userBDNow['user_fullname']?>">
                                                </span>
                                                <span class="media-body">
                                                    <span class="media-heading">Hôm nay là sinh nhật tuổi <?= $noBD?> của <span class="label label-warning"><?= $userBDNow['user_fullname']?></span></span>
                                                    <span class="media-meta pull-right"><?= date("d/m/Y", strtotime($userBDNow['user_birthday']))?></span>
                                                </span>
                                            </a>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                    <?php if (!empty($listBDSoon)): ?>
                                        <?php foreach ($listBDSoon as $key => $value): ?>
                                            <?php
                                                $userBDNow = $this->muser->getInfoBD($value);
                                                $avatar_user = my_lib::base_url().'media/user/'.$userBDNow['user_avatar'];
                                                    if ($userBDNow['user_avatar'] == "") {
                                                        $avatar_user = my_lib::cms_img().'logo.png';
                                                    }
                                                $noBD = date("Y") - date("Y",strtotime($userBDNow['user_birthday']));
                                            ?>
                                            <a class="media border-dotted read">
                                                <span class="pull-left">
                                                    <img src="<?= $avatar_user?>" class="media-object img-circle" alt="<?= $userBDNow['user_fullname']?>">
                                                </span>
                                                <span class="media-body">
                                                    <span class="media-heading">Hãy chuẩn bị sinh nhật tuổi <?= $noBD?> của <span class="label label-info"><?= $userBDNow['user_fullname']?></span> vào ngày mai</span>
                                                    <span class="media-meta pull-right"><?= date("d/m/Y", strtotime($userBDNow['user_birthday']))?></span>
                                                </span>
                                            </a>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>                              
                            </div>
                        </div>                    
                    </li>
                    <div class="btn-group mt10">
                        <button type="button" class="btn btn-teal dropdown-toggle" data-toggle="dropdown" title="Lọc danh sách họp đồng theo dịch vụ">Lọc dịch vụ <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($listService as $key => $value): ?>
                                <li><a href="<?= my_lib::cms_site()?>infoservice/?ftype=<?= $value['id']?>"><?= $value['service_name']?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </ul>
                <!--/ END Left nav -->

                <!-- START navbar form -->
                <div class="navbar-left" style="width: 400px;">
                    <marquee class="mt10" behavior="" direction="left" onmouseover="this.stop();" onmouseout="this.start();" >
                        <h5>
                            <?php if (isset($showMessage) && count($showMessage) > 0): ?>
                                <?php foreach ($showMessage as $key => $valmess): ?>
                                    <?php $link_detail = my_lib::cms_site().'message/detail/'.$valmess["id"].'/?redirect='.base64_encode(current_url()); ?>
                                    <i class="ico-bell text-danger"> </i><a href="<?= $link_detail?>" class="text-danger"><?= $valmess['ms_title']?></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php endforeach ?>
                            <?php endif ?>
                            <?php if (count($marqueeBD) > 1): ?>
                                <?php foreach ($marqueeBD as $key => $valBD): ?>
                                    <?php if ($valBD != ""): ?>
                                        <i class="ico-cake text-success"> </i><a class="text-success">Hôm nay là sinh nhật tuổi <?= $valBD['no']?> của <?= $valBD['name']?></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </h5>
                    </marquee>
                </div>
                <!-- START navbar form -->

                <!-- START Right nav -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Profile dropdown -->
                    <li class="dropdown profile">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                                <?php 
                                    $avatar = my_lib::base_url().'media/user/'.$s_info['s_user_avatar'];
                                    if ($s_info['s_user_avatar'] == "") {
                                        $avatar = my_lib::cms_img().'logo.png';
                                    }
                                 ?>
                                <span class="avatar"><img src="<?= $avatar?>" class="img-circle" alt="" /></span>
                                <span class="text hidden-xs hidden-sm pl20"><?= isset($s_info['s_user_fullname']) ? $s_info['s_user_fullname']:'admin.';?></span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu" role="menu">                            
                            <li class="divider"></li>
                            <li><a href="<?= my_lib::cms_site()?>user/profile/"><span class="icon"><i class="ico-user-plus2"></i></span> My Profiles</a></li>
                            <li><a href="<?= my_lib::cms_site()?>user/forgot/"><span class="icon"><i class="ico-cog4"></i></span> Reset Password</a></li>                            
                            <li class="divider"></li>
                            <li><a href="<?= my_lib::cms_site()?>index/logout/"><span class="icon"><i class="ico-exit"></i></span> Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/ END Toolbar -->
        </header>
        <!--/ END Template Header -->