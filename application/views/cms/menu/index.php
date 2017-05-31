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
                                <li class="active">Menu</li>
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
                            <div class="panel-toolbar-wrapper pl0 pt5 pb5">
                                <div class="panel-toolbar pl10">
                                    <div class="checkbox custom-checkbox pull-left">  
                                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                        <label for="customcheckbox-one0">&nbsp;&nbsp;Select all</label>  
                                    </div>
                                </div>
                                <div class="panel-toolbar text-right">
                                    <a href="<?= my_lib::cms_site()?>menu/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Add</a>
                                </div>
                            </div>
                            <!--/ panel toolbar wrapper -->

                            <!-- panel body with collapse capabale -->
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>
                                            <th width="5%"></th>
                                            <th width="3%"  class="text-center">ID</th>
                                            <th>Name</th>
                                            <th>Controller</th>
                                            <th>View</th>
                                            <th>Create</th>                                            
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                # code...
                                                $picture = isset($value['menu_picture']) && $value['menu_picture'] ? str_replace("/file/", "/thumbs/", $value['menu_picture']):my_lib::cms_img().'avatar/avatar.png';
                                                $link_update = my_lib::cms_site().'menu/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = my_lib::cms_site().'menu/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                                echo '<tr>';
                                                    echo '<td>';
                                                        echo '<div class="checkbox custom-checkbox nm">';
                                                            echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="1" data-toggle="selectrow" data-target="tr" data-contextual="stroke">';
                                                            echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                        echo '</div>';
                                                    echo '</td>';

                                                    echo '<td>';
                                                        echo '<div class="media-object"><img src="'.$picture.'" alt="" class="img-circle"></div>';
                                                    echo '</td>';

                                                    echo '<td class="text-center">'.$value["id"].'</td>';
                                                    echo '<td>'.$value["menu_name"].'</td>';
                                                    echo '<td>'.$value["menu_com"].'</td>';
                                                    echo '<td>'.$value["menu_view"].'</td>';
                                                    echo '<td>'.$value["menu_create_date"].'</td>';

                                                    echo '<td>';
                                                        // echo '<div class="toolbar">';
                                                        //     echo '<div class="btn-group">';
                                                        //         echo '<button type="button" class="btn btn-sm btn-default">Action</button>';
                                                        //         echo '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">';
                                                        //             echo '<span class="caret"></span>';
                                                        //         echo '</button>';
                                                        //         echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                        //             echo '<li><a href="'.$link_update.'"><i class="icon ico-pencil"></i>Update</a></li>';
                                                        //             echo '<li class="divider"></li>';
                                                        //             echo '<li><a href="'.$link_delete.'" onclick="return Delete();" class="text-danger"><i class="icon ico-remove3"></i>Delete</a></li>';
                                                        //         echo '</ul>';
                                                        //     echo '</div>';
                                                        // echo '</div>';
                                                    echo '</td>';
                                                echo '</tr>';
                                                /**begin menu cap 2*/
                                                $and_c2 = 'menu_parent = '.$value['id'];
                                                $list_c2 = $this->mmenu->getQuery($object="",$join="",$and_c2,$orderby,"");
                                                if($list_c2){
                                                    foreach ($list_c2 as $key_c2 => $value_c2) {
                                                        # code...
                                                        $picture = isset($value_c2['menu_picture']) && $value_c2['menu_picture'] ? str_replace("/file/", "/thumbs/", $value_c2['menu_picture']):my_lib::cms_img().'avatar/avatar.png';
                                                        $link_update_c2 = my_lib::cms_site().'menu/edit/'.$value_c2["id"].'/?redirect='.base64_encode(current_url());
                                                        $link_delete_c2 = my_lib::cms_site().'menu/delete/'.$value_c2["id"].'/?redirect='.base64_encode(current_url());;
                                                        echo '<tr>';
                                                            echo '<td>';
                                                                echo '<div class="checkbox custom-checkbox nm">';
                                                                    echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="1" data-toggle="selectrow" data-target="tr" data-contextual="stroke">';
                                                                    echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                                echo '</div>';
                                                            echo '</td>';

                                                            echo '<td>';
                                                                echo '<div class="media-object"><img src="'.$picture.'" alt="" class="img-circle"></div>';
                                                            echo '</td>';
                                                            echo '<td class="text-center">'.$value_c2["id"].'</td>';
                                                            echo '<td>» '.$value_c2["menu_name"].'</td>';
                                                            echo '<td>'.$value_c2["menu_com"].'</td>';
                                                            echo '<td>'.$value_c2["menu_view"].'</td>';
                                                            echo '<td>'.$value_c2["menu_create_date"].'</td>';

                                                            echo '<td>';
                                                                echo '<div class="toolbar">';
                                                                    echo '<div class="btn-group">';
                                                                        echo '<button type="button" class="btn btn-sm btn-default">Action</button>';
                                                                        echo '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">';
                                                                            echo '<span class="caret"></span>';
                                                                        echo '</button>';
                                                                        echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                                            echo '<li><a href="'.$link_update_c2.'"><i class="icon ico-pencil"></i>Update</a></li>';
                                                                            echo '<li class="divider"></li>';
                                                                            echo '<li><a href="'.$link_delete_c2.'" onclick="return Delete();" class="text-danger"><i class="icon ico-remove3"></i>Delete</a></li>';
                                                                        echo '</ul>';
                                                                    echo '</div>';
                                                                echo '</div>';
                                                            echo '</td>';
                                                        echo '</tr>';
                                                        /**begin menu cap 3*/
                                                        $and_c3 = 'menu_parent = '.$value_c2['id'];
                                                        $list_c3 = $this->mmenu->getQuery($object="",$join="",$and_c3,$orderby,"");
                                                        if($list_c3){
                                                            foreach ($list_c3 as $key_c3 => $value_c3) {
                                                                # code...
                                                                $picture = isset($value_c3['menu_picture']) && $value_c3['menu_picture'] ? str_replace("/file/", "/thumbs/", $value_c3['menu_picture']):my_lib::cms_img().'avatar/avatar.png';
                                                                $link_update_c3 = my_lib::cms_site().'menu/edit/'.$value_c3["id"].'/?redirect='.base64_encode(current_url());
                                                                $link_delete_c3 = my_lib::cms_site().'menu/delete/'.$value_c3["id"].'/?redirect='.base64_encode(current_url());;
                                                                echo '<tr>';
                                                                    echo '<td>';
                                                                        echo '<div class="checkbox custom-checkbox nm">';
                                                                            echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="1" data-toggle="selectrow" data-target="tr" data-contextual="stroke">';
                                                                            echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                                        echo '</div>';
                                                                    echo '</td>';

                                                                    echo '<td>';
                                                                        echo '<div class="media-object"><img src="'.$picture.'" alt="" class="img-circle"></div>';
                                                                    echo '</td>';
                                                                    echo '<td class="text-center">'.$value_c3["id"].'</td>';
                                                                    echo '<td>&nbsp;»» '.$value_c3["menu_name"].'</td>';
                                                                    echo '<td>'.$value_c3["menu_com"].'</td>';
                                                                    echo '<td>'.$value_c3["menu_view"].'</td>';
                                                                    echo '<td>'.$value_c3["menu_create_date"].'</td>';

                                                                    echo '<td>';
                                                                        echo '<div class="toolbar">';
                                                                            echo '<div class="btn-group">';
                                                                                echo '<button type="button" class="btn btn-sm btn-default">Action</button>';
                                                                                echo '<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">';
                                                                                    echo '<span class="caret"></span>';
                                                                                echo '</button>';
                                                                                echo '<ul class="dropdown-menu dropdown-menu-right">';
                                                                                    echo '<li><a href="'.$link_update_c3.'"><i class="icon ico-pencil"></i>Update</a></li>';
                                                                                    echo '<li class="divider"></li>';
                                                                                    echo '<li><a href="'.$link_delete_c3.'" onclick="return Delete();" class="text-danger"><i class="icon ico-remove3"></i>Delete</a></li>';
                                                                                echo '</ul>';
                                                                            echo '</div>';
                                                                        echo '</div>';
                                                                    echo '</td>';
                                                                echo '</tr>';
                                                            }
                                                        }
                                                        /**end menu cap 3*/
                                                    }
                                                }
                                                /**end menu cap 2*/
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
                </div>
                <!--/ END row -->                        
            <!-- START To Top Scroller -->
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
            <!--/ END To Top Scroller -->
        </section>
        <!--/ END Template Main