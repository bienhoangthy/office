
        <section id="main" role="main">            
            <div class="container-fluid">                
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">List Group</h4>
                    </div>
                    <div class="page-header-section">                        
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">Group</li>
                            </ol>
                        </div>                        
                    </div>
                </div>                
                
                <div class="row">
                <form method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                    <div class="col-md-12">                        
                        <?php if(isset($error) && $error) { 
                            echo '<div class="alert alert-danger">';
                                echo '<ul>';
                                foreach ($error as $key => $value) {
                                    
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
                                <div class="panel-toolbar text-right">
                                <?php if($s_info['s_user_group']==1 ) {?>
                                    <div class="btn-group">
                                        <a href="<?= my_lib::cms_site()?>group/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Add</a>                                        
                                    </div>                             
                                <?php } ?>   
                                </div>
                            </div>                            
                            
                            <div class="table-responsive panel-collapse pull out">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>                                                                                        
                                            <th width="20px">ID</th>                                            
                                            <th width="20%">Tên</th>                                            
                                            <th>Ghi chú</th>                                            
                                            <th>Module</th>                                            
                                            <th width="15%">Create</th>                                            
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(isset($list) && $list){
                                            $i=1;
                                            foreach ($list as $key => $value) {
                                                $value["group_category"] = $this->mcategory->showNameUnserialize($value["group_category"]);
                                                $link_update = my_lib::cms_site().'group/edit/'.$value["id"].'/?redirect='.$redirect;
                                                $link_delete = my_lib::cms_site().'group/delete/'.$value["id"].'/?redirect='.$redirect;;
                                                echo '<tr>';                                                                                                   
                                                    echo '<td class="text-center">'.$value["id"].'</td>';
                                                    echo '<td>'.$value["group_name"].'</td>';
                                                    echo '<td>'.$value["group_note"].'</td>';                                                    
                                                    echo '<td>'.$value["group_category"].'</td>';
                                                    echo '<td>'.$value["group_create"].'</td>';

                                                    echo '<td>';
                                                    if($s_info['s_user_group']==1 ) {
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
                                                    }
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
        