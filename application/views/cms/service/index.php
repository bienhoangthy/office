
<!--START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">Danh sách dịch vụ</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">Danh sách dịch vụ</li>
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
                        <?php
                        if(isset($success) && $success && count($success)>0){
                            echo '<div class="alert alert-info">';
                                echo '<ul>';
                                foreach ($success as $key => $value) {
                                    # code...
                                    echo '<li>'.$value.'</li>';
                                }
                                echo '</ul>';
                            echo '</div>';
                        }
                        ?>
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
                                        <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                        <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                    </div>
                                </div>
                                <div class="panel-toolbar text-right">

                                    <a href="<?= my_lib::cms_site()?>service/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Add</a>
                                </div>
                            </div>
                            <!--/ panel toolbar wrapper -->

                            <!-- panel body with collapse capabale -->
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                            
                                                                                                   
                                            <th class="text-center" width="15%">Tên loại-gói dịch vụ</th>                                                                           
                                            <th class="text-center" width="5%">Tên viết tắt</th>                                                                           
                                            <th class="text-center" width="15%">Phí dịch vụ</th>                                                                           
                                            <th class="text-center" width="15%">Note</th>                                                                           
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list_level_1) && $list_level_1){
                                            $i=1;
                                            foreach ($list_level_1 as $key => $value) {
                                                # code...                                             
                                                $link_update = my_lib::cms_site().'service/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = my_lib::cms_site().'service/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                                echo '<tr>';
                                                    echo '<td>';
                                                        echo '<div class="checkbox custom-checkbox nm">';
                                                            echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                            echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                        echo '</div>';
                                                    echo '</td>'; 

                                                    echo '<td><a>'.$value["service_name"].'</a></td>';                                                
                                                    echo '<td class="text-center"><a>'.$value["service_acronym"].'</a></td>';                                                
                                                    echo '<td class="text-center"></td>';
                                                    echo '<td>'.$value["service_note"].'</td>';                                                    

                                                    echo '<td class="text-center">';
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
                                                // level2
                                                if(isset($list_level_2) && $list_level_2){
                                                $j= $i + 1000;
                                                foreach ($list_level_2 as $key => $val) {
                                                    if ($val["service_parent"] == $value["id"]) {
                                                        $link_update = my_lib::cms_site().'service/edit/'.$val["id"].'/?redirect='.base64_encode(current_url());
                                                        $link_delete = my_lib::cms_site().'service/delete/'.$val["id"].'/?redirect='.base64_encode(current_url());;
                                                        echo '<tr>';
                                                            echo '<td>';
                                                                echo '<div class="checkbox custom-checkbox nm">';
                                                                    echo '<input type="checkbox" id="customcheckbox-one'.$j.'" value="'.$val["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                                    echo '<label for="customcheckbox-one'.$j.'"></label>';
                                                                echo '</div>';
                                                            echo '</td>'; 


                                                            echo '<td>&nbsp;&nbsp;&nbsp;<a style ="color: black;"><i class="ico-arrow-right14">&nbsp;'.$val["service_name"].'</a></td>';  
                                                            echo '<td></td>';                                             
                                                            echo '<td class="text-center">'.number_format($val["service_price"],0,',','.').' vnđ</td>';
                                                            echo '<td>'.$val["service_note"].'</td>';                                                    

                                                            echo '<td class="text-center">';
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
                                                        $j++;                                         
                                                    }                                           
                                                }
                                            }
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
        