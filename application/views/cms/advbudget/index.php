
        <section id="main" role="main">        
            <div class="container-fluid">            
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">Danh sách thông báo</h4>
                    </div>
                    <div class="page-header-section">                    
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">Thông báo</li>
                            </ol>
                        </div>                    
                    </div>
                </div>            
            
                <div class="row">
                <form method="post">
                    <div class="col-md-12">                    
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
                    
                        <div class="panel panel-primary">                        
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Danh sách</h3>                            
                                <div class="panel-toolbar text-right">                                
                                    <div class="option">
                                        <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                        <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                                    </div>                                
                                </div>                            
                            </div>                                                
                            <div class="panel-toolbar-wrapper pl0 pt5 pb5">
                                <div class="panel-toolbar pl10">
                                    <div class="checkbox custom-checkbox pull-left">  
                                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                        <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                        <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                    </div>
                                </div>
                                <div class="panel-toolbar text-right">

                                    <a href="<?= my_lib::cms_site()?>advbudget/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Add</a>
                                </div>
                            </div>                        
                        
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                            
                                            <th>Tiêu đề</th>                                                                           
                                            <th class="text-center" width="15%">Trạng thái</th>                                                                           
                                            <th class="text-center" width="15%">Nhân viên tạo</th>                                                                           
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                # code... 
                                                $myUser = $this->muser->getData('',array("id"=>$value['user']));
                                                $value['user'] = isset($myUser['user_fullname']) && $myUser['user_fullname'] ? $myUser['user_fullname']:'';
                                                $value["adv_budget_status"] = $value["adv_budget_status"] == 1 ? '<small class="btn btn-primary btn-xs"><i class=" ico-eye"></i> Active</small>':'<small class="btn btn-danger btn-xs"><i class=" ico-eye-blocked"></i> Block</small>';                                            
                                                $link_update = my_lib::cms_site().'advbudget/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                                $link_delete = my_lib::cms_site().'advbudget/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                                echo '<tr>';
                                                    echo '<td>';
                                                        echo '<div class="checkbox custom-checkbox nm">';
                                                            echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                            echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                        echo '</div>';
                                                    echo '</td>';                                                

                                                    echo '<td><a>'.$value["adv_budget_name"].'</a></td>';                                                
                                                    echo '<td class="text-center">'.$value["adv_budget_status"].'</td>';
                                                    echo '<td>'.$value["user"].'</td>';                                                    

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
                                                $i++;
                                            }
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>                        
                        </div>
                    </div>
                    </form>
                </div>                    
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>        
        </section>    
        