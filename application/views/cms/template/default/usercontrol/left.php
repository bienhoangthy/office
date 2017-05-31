
<aside class="sidebar sidebar-left sidebar-menu">
    <!-- START Sidebar Content -->
    <section class="content slimscroll">
    <?php 
        $ddate = date("Y-m-d");
        $date = new DateTime($ddate);
        $week = $date->format("W");
     ?>
        <h5 class="heading text-teal">Tuần: <?= $week;?> | <?= date("d-m-Y")?></h5>
        <!-- START Template Navigation/Menu -->
        <ul class="topmenu" data-toggle="menu">                    
            <li class="<?= $this->uri->segment(2)=="home"?"active open":""?> ">
                <a href="<?= my_lib::cms_site()?>home" data-toggle="submenu" data-target="#home" data-parent=".topmenu">
                    <span class="figure"><i class="ico-home2"></i></span>
                    <span class="text">Dashboard</span>                            
                </a>                                            
            </li>
            <li class="<?= $this->uri->segment(3)=="mytask"?"active open":""?>">
                <a href="<?= my_lib::cms_site()?>task/mytask"   class="<?= $this->uri->segment(3)=="mytask"?"active":""?>">
                    <span class="figure"><i class="ico-books"></i></span>
                    <span class="text">Công việc của tôi <span class="count badge badge-danger"><?php if(isset($showTask) && count($showTask) > 0) { echo count($showTask) ;} ?></span></span>                            
                </a>                                                                    
            </li>
            

            
            

            <?php if($s_info['s_user_group']==1 || 
                     $s_info['s_user_group']==2 || 
                     $s_info['s_user_group']==3 || 
                     $s_info['s_user_group']==6 || 
                     $s_info['s_user_group']==9 || 
                     $s_info['s_user_group']==5) { ?>
            
            <li class="<?= $this->uri->segment(2)=="file" ? "active open" : ""?> ">
                <a href="javascript:void(0);" data-toggle="submenu" data-target="#file" data-parent=".topmenu">
                    <span class="figure"><i class="ico-files"></i></span>
                    <span class="text">Hỗ trợ</span>
                    <span class="arrow"></span>
                </a>
                 
                <ul id="file" class="submenu collapse 
                    <?= $this->uri->segment(2)=="file" ?"in":""?> ">
                    <li class="submenu-header ellipsis">Hỗ trợ</li>
                    <?php if (!empty($listFile_lv1)): ?>
                        <?php foreach ($listFile_lv1 as $key => $value): ?>
                            <li>
                                <a href="<?= my_lib::cms_site()?>file/detail/<?= $value['id']?>"  class="<?= $this->uri->segment(4)== $value['id'] ?"active":""?>">
                                    <span class="text"><?= $value['file_title']?></span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>                         
            </li>
            <?php if ($s_info['s_user_group']==1 || 
                     $s_info['s_user_group']==2 || 
                     $s_info['s_user_group']==3 || 
                     $s_info['s_user_group']==9 || 
                     $s_info['s_user_group']==5): ?>

                <li class="<?= $this->uri->segment(2)=="company" ?"active open":""?> ">
                    <a href="<?= my_lib::cms_site()?>company/">
                        <span class="figure"><i class="ico-users5"></i></span>
                        <span class="text">Khách hàng</span>
                    </a>                        
                </li>
            <?php endif ?>
            <?php if ($s_info['s_user_group']==1 || 
                     $s_info['s_user_group']==2 || 
                     $s_info['s_user_group']==3 || 
                     $s_info['s_user_group']==9 || 
                     $s_info['s_user_group']==5): ?>
                <li class="<?= $this->uri->segment(2)=="infoservice" ?"active open":""?> ">
                    <a href="<?= my_lib::cms_site()?>infoservice/">
                        <span class="figure"><i class="ico-certificate"></i></span>
                        <span class="text">Hợp đồng</span>
                    </a>                        
                </li>
            <?php endif ?>
            <?php } ?>
            <?php if ($s_info['s_user_group']==1 || 
                     $s_info['s_user_group']==2 || 
                     $s_info['s_user_group']==5): ?>

                <li class="<?= $this->uri->segment(2)=="message" ?"active open":""?> ">
                    <a href="<?= my_lib::cms_site()?>message/">
                        <span class="figure"><i class="ico-newspaper"></i></span>
                        <span class="text">Thông báo</span>
                    </a>                        
                </li>
            <?php endif ?>
            <?php if($s_info['s_user_group']==7 || 
                     $s_info['s_user_group']==5 || 
                     $s_info['s_user_group']==2 || 
                     $s_info['s_user_group']==1) { ?>
            <li class="<?= $this->uri->segment(2)=="user" || $this->uri->segment(2)=="department" || $this->uri->segment(3)=="assign"?"active open":""?> ">
                <a href="javascript:void(0);" data-toggle="submenu" data-target="#user" data-parent=".topmenu">
                    <span class="figure"><i class="ico-user"></i></span>
                    <span class="text">Nhân sự</span>
                    <span class="arrow"></span>
                </a>
                 
                <ul id="user" class="submenu collapse 
                    <?= $this->uri->segment(2)=="user" || $this->uri->segment(3)=="assign" || $this->uri->segment(2)=="department" ?"in":""?> ">
                    <li class="submenu-header ellipsis">Quản lý user</li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>task/assign/"  class="<?= $this->uri->segment(3)=="assign"?"active":""?>">
                            <span class="text">Giao việc</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>task/"  class="<?= $this->uri->segment(2)=="task"?"active":""?>">
                            <span class="text">Danh sách công việc</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>user/info/"  class="<?= $this->uri->segment(3)=="info"?"active":""?>">
                            <span class="text">Xem thông tin NV</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>user"  class="<?= $this->uri->segment(2)=="user"?"active":""?>">
                            <span class="text">Danh sách nhân sự</span>
                        </a>
                    </li>                            
                    <li>
                        <a href="<?= my_lib::cms_site()?>department/"  class="<?= $this->uri->segment(2)=="department"?"active":""?>">
                            <span class="text">Phòng ban</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>user/sitemap"  class="<?= $this->uri->segment(3)=="sitemap"?"active":""?>">
                            <span class="text">Sơ đồ tổ chức</span>
                        </a>
                    </li>
                </ul>                         
            </li>
            <?php } ?>


            <?php if($s_info['s_user_group']==5|| 
                     $s_info['s_user_group']==2 ||                              
                     $s_info['s_user_group']==1) { ?>

            <li class="<?= $this->uri->segment(2)=="account" ?"active open":""?> ">
                <a href="javascript:void(0);" data-toggle="submenu" data-target="#account" data-parent=".topmenu">
                    <span class="figure"><i class="ico-money"></i></span>
                    <span class="text">Kế toán</span>
                    <span class="arrow"></span>
                </a>
                 
                <ul id="account" class="submenu collapse 
                    <?= $this->uri->segment(2)=="account" ?"in":""?> ">
                    <li>
                        <a href="<?= my_lib::cms_site()?>account/daily"  class="<?= $this->uri->segment(3)=="daily"?"active":""?>">
                            <span class="text">Quản lý thu chi</span>
                        </a>
                    </li>      
                      <li>
                        <a href="<?= my_lib::cms_site()?>account/report"  class="<?= $this->uri->segment(3)=="report"?"active":""?>">
                            <span class="text">Báo cáo thống kê</span>
                        </a>
                    </li> 
                    <li>
                        <a href="<?= my_lib::cms_site()?>account/"  class="<?= $this->uri->segment(3)==""?"active":""?>">
                            <span class="text">Tình hình thu chi</span>
                        </a>
                    </li>                              
                      
                    <!-- <li>
                        <a href="<?= my_lib::cms_site()?>account/history"  class="<?= $this->uri->segment(3)=="history"?"active":""?>">
                            <span class="text">Lịch sử thu chi</span>
                        </a>
                    </li>  --> 
                    <li>
                        <a href="<?= my_lib::cms_site()?>account/revenue"  class="<?= $this->uri->segment(3)=="revenue"?"active":""?>">
                            <span class="text">Lịch sử thu</span>
                        </a>
                    </li> 
                    <li>
                        <a href="<?= my_lib::cms_site()?>account/expenditure"  class="<?= $this->uri->segment(3)=="expenditure"?"active":""?>">
                            <span class="text">Lịch sử chi</span>
                        </a>
                    </li>   
                                                                        
                </ul>                         
            </li>
            <?php } ?>

            <?php if ($s_info['s_user_group']==1 || 
                     $s_info['s_user_group']==5 || 
                     $s_info['s_user_group']==8 || 
                     $s_info['s_user_group']==6): ?>

                <li class="<?= $this->uri->segment(2)=="project"?"active open":""?>">
                    <a href="<?= my_lib::cms_site()?>project">
                        <span class="figure"><i class="ico-map2"></i></span>
                        <span class="text">Dự án</span>
                    </a>                        
                </li>
            <?php endif ?>
            <!-- <li class="<?= $this->uri->segment(3)=="pushNotification"?"active open":""?>">
                <a href="<?= my_lib::cms_site()?>message/pushNotification"   class="<?= $this->uri->segment(3)=="pushNotification"?"active":""?>">
                    <span class="figure"><i class="ico-podcast2"></i></span>
                    <span class="text">Push Notification</span>                            
                </a>                                                                    
            </li> -->
            <li class="<?= $this->uri->segment(2)=="media"?"active open":""?>">
                <a href="<?= my_lib::cms_site()?>media"   class="<?= $this->uri->segment(2)=="media"?"active":""?>">
                    <span class="figure"><i class="ico-folder"></i></span>
                    <span class="text">Thư viện cá nhân</span>                            
                </a>                                                                    
            </li>
            <li class="<?= $this->uri->segment(2)=="calendar"?"active open":""?>">
                <a href="<?= my_lib::cms_site()?>calendar"   class="<?= $this->uri->segment(2)=="calendar"?"active":""?>">
                    <span class="figure"><i class="ico-sun-glasses"></i></span>
                    <span class="text">Book lịch nghỉ</span>                            
                </a>                                                                    
            </li>

            <?php if($s_info['s_user_group']==1){ ?>
            <li class="<?= $this->uri->segment(2)=="group"?"active open":""?> ">
                <a href="javascript:void(0);" data-toggle="submenu" data-target="#group" data-parent=".topmenu">
                    <span class="figure"><i class="ico-cog4"></i></span>
                    <span class="text">System</span>
                    <span class="arrow"></span>
                </a>
                 
                <ul id="group" class="submenu collapse 
                    <?= $this->uri->segment(2)=="system" || 
                        $this->uri->segment(2)=="account_name" || 
                        $this->uri->segment(2)=="account_type" || 
                        $this->uri->segment(2)=="company_rate" || 
                        $this->uri->segment(2)=="company_work" ||
                        $this->uri->segment(2)=="company_work_status" || 
                        $this->uri->segment(2)=="infocontact" || 
                        $this->uri->segment(2)=="service" || 
                        $this->uri->segment(2)=="company_type" || 
                        $this->uri->segment(2)=="company_scale" || 
                        $this->uri->segment(2)=="company_sector" || 
                        $this->uri->segment(2)=="company_status" || 
                        $this->uri->segment(2)=="city" || 
                        $this->uri->segment(2)=="business" || 
                        $this->uri->segment(2)=="bank" || 
                        $this->uri->segment(2)=="advbudget" || 
                        $this->uri->segment(2)=="translate" || 
                        $this->uri->segment(2)=="feedback" || 
                        $this->uri->segment(2)=="groupaction" || 
                        $this->uri->segment(2)=="permission" || 
                        $this->uri->segment(2)=="config" ||  
                        $this->uri->segment(2)=="history_login" ||  
                        $this->uri->segment(2)=="group" ?"in":""?> ">
                    <li class="submenu-header ellipsis">System</li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>system/"  class="<?= $this->uri->segment(2)=="system"?"active":""?>">
                            <span class="text">Hệ thống</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>history_login" class="<?= $this->uri->segment(2)=="history_login"?"active":""?>">
                            <span class="text">Lịch sử đăng nhập</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>account_name"  class="<?= $this->uri->segment(2)=="account_type" || $this->uri->segment(2)=="account_name"?"active":""?>">
                            <span class="text">Quản lý kế toán</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>translate"  class="<?= $this->uri->segment(2)=="translate"?"active":""?>">
                            <span class="text">Dịch thuật</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>config"  class="<?= $this->uri->segment(2)=="config"?"active":""?>">
                            <span class="text">Config site</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>group"  class="<?= $this->uri->segment(2)=="group"?"active":""?>">
                            <span class="text">Group Level</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>groupaction"  class="<?= $this->uri->segment(2)=="groupaction"?"active":""?>">
                            <span class="text">Group Action</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>permission"  class="<?= $this->uri->segment(2)=="permission"?"active":""?>">
                            <span class="text"> Quyền truy cập</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>feedback/"  class="<?= $this->uri->segment(2)=="feedback"?"active":""?>">
                            <span class="text">Feedback</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>service/"  class="<?= $this->uri->segment(2)=="service"?"active":""?>">
                            <span class="text">Dịch vụ</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>advbudget/"  class="<?= $this->uri->segment(2)=="advbudget"?"active":""?>">
                            <span class="text">Ngân sách quảng cáo</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>bank/"  class="<?= $this->uri->segment(2)=="bank"?"active":""?>">
                            <span class="text">Ngân hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>business/"  class="<?= $this->uri->segment(2)=="business"?"active":""?>">
                            <span class="text">Loại công ty</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>city/"  class="<?= $this->uri->segment(2)=="city"?"active":""?>">
                            <span class="text">Thành phố</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>company_rate/"  class="<?= $this->uri->segment(2)=="company_rate"?"active":""?>">
                            <span class="text">Loại khách hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>company_scale/"  class="<?= $this->uri->segment(2)=="company_scale"?"active":""?>">
                            <span class="text">Quy mô khách hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>company_sector/"  class="<?= $this->uri->segment(2)=="company_sector"?"active":""?>">
                            <span class="text">Linh vực kinh doanh</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>company_status/"  class="<?= $this->uri->segment(2)=="company_status"?"active":""?>">
                            <span class="text">Trạng thái khách hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>company_type/"  class="<?= $this->uri->segment(2)=="company_type"?"active":""?>">
                            <span class="text">Hình thức liên hệ</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>company_work/"  class="<?= $this->uri->segment(2)=="company_work"?"active":""?>">
                            <span class="text">Lịch làm việc KH</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>infocontact/"  class="<?= $this->uri->segment(2)=="infocontact"?"active":""?>">
                            <span class="text">Thông tin làm việc KH</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= my_lib::cms_site()?>company_work_status/"  class="<?= $this->uri->segment(2)=="company_work_status"?"active":""?>">
                            <span class="text">Trạng thái lịch làm việc</span>
                        </a>
                    </li>
                    
                </ul>                         
            </li>
            <?php } ?>
        </ul>
        
    </section>
    <!--/ END Sidebar Container -->
</aside>
<!--/ END Template Sidebar (Left)-->