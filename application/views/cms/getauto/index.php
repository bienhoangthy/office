
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
                                <li class="active">News</li>
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                <div class="row process_get" style="display:none">
                    <div class="col-md-12">
                         <p class="alert alert-info">Hệ thống đang trong quá trình xử lý. Vui lòng chờ trong giây lát.</p>
                         <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar progress-bar-success" style="width: 100%">
                                <span class="sr-only">100% Complete (success)</span>
                            </div>
                        </div>
                         <div class="panel panel-default">                            
                            <div class="panel-body" style="min-height:200px;">                                
                                <div class="indicator show"><span class="spinner spinner11"></span></div>
                            </div>
                        </div>               
                    </div>
                </div>
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
                            <div class="panel-toolbar-wrapper pl0 pt5 pb5">
                                <!-- <div class="panel-toolbar pl10">
                                    <div class="checkbox custom-checkbox pull-left">  
                                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                        <label for="customcheckbox-one0">&nbsp;&nbsp;Select all</label>  
                                    </div>
                                </div> -->
                                <div class="panel-toolbar text-right">
                                    <a href="<?= my_lib::cms_site()?>getauto/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Add</a>
                                    <!-- <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i></button> -->
                                </div>
                            </div>
                            <!--/ panel toolbar wrapper -->

                            <!-- panel body with collapse capabale -->
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <!-- <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th> -->
                                            <th width="20px" class="text-center">ID</th>
                                            <th width="20%">Tên website lấy tin</th>
                                            <th>Đường dẫn gốc</th>
                                            <th>Liên kết</th>
                                            <th width="10%">Danh mục</th>
                                            <th width="15%">Ngày</th>                                                                                    
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                # code...
                                                $picture = isset($value['news_picture']) && $value['news_picture'] ? str_replace("/file/", "/thumbs/", $value['news_picture']):my_lib::cms_img().'avatar/avatar.png';                                                
                                                $myMenu = $this->mmenu->getData('',array("id"=>$value['category_id']));                                                
                                                $value['category_id'] = isset($myMenu['menu_name']) ? $myMenu['menu_name']:'';                                                
                                                $link_get = my_lib::cms_site().'getauto/get/'.$value["id"].'/?redirect='.base64_encode(current_url());                                                
                                                $link_update = my_lib::cms_site().'getauto/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = my_lib::cms_site().'getauto/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                                echo '<tr>';
                                                    // echo '<td>';
                                                    //     echo '<div class="checkbox custom-checkbox nm">';
                                                    //         echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                    //         echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                    //     echo '</div>';
                                                    // echo '</td>';

                                                    echo '<td class="text-center">';
                                                        echo '<div class="media-object">'.$value["id"].'</div>';
                                                    echo '</td>';

                                                    echo '<td>'.$value["name"].'</td>';                                                    
                                                    echo '<td>'.$value["host"].'</td>';                                                    
                                                    echo '<td>'.$value["url"].'</td>';                                                    
                                                    echo '<td>'.$value["category_id"].'</td>';                                                    
                                                    echo '<td>'.$value["createdate_get"].'</td>';

                                                    echo '<td>';
                                                        echo '<div class="toolbar">';
                                                            echo '<div class="btn-group">';
                                                                echo '<button type="button" class="btn btn-sm btn-default">Action</button>';
                                                                echo '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">';
                                                                    echo '<span class="caret"></span>';
                                                                echo '</button>';
                                                                echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                                    echo '<li><a class="get_auto_once" href="'.$link_get.'"><i class="icon ico-refresh"></i>Lấy tin</a></li>';
                                                                    echo '<li class="divider"></li>';
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
        