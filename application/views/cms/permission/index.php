
<!--START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header page-header-block">
                    <div class="page-header-section">
                        <h4 class="title semibold">List Group</h4>
                    </div>
                    <div class="page-header-section">
                        <!-- Toolbar -->
                        <div class="toolbar">
                            <ol class="breadcrumb breadcrumb-transparent nm">
                                <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                                <li class="active">Group</li>
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
                        <!--end masseage-->
                        <div class="display_ms"></div>                        
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

                            <!-- panel body with collapse capabale -->
                            <div class="table-responsive panel-collapse pull out">                            
                            <form class="panel panel-default form-horizontal form-bordered"  method="post">
                                <table class="table table-hover" id="table1">                                   
                                    <thead>
                                        <th></th>
                                        <?php
                                        if(isset($group) && $group)
                                        {
                                            foreach ($group as $key => $value) 
                                            {
                                                # code...
                                                echo '<th class="text-center">'.$value["group_name"].'</th>';
                                            }
                                        }
                                        ?>                                        
                                        <th width="20px" class="text-center"><a class="btn btn-primary btn-xs" href="<?= my_lib::cms_site()?>group/add/?redirect=<?= base64_encode(current_url())?>"><i class="ico-plus"></i></a></th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($groupaction) && $groupaction)
                                    {
                                        foreach ($groupaction as $key => $value) 
                                        {
                                            # code...
                                            echo '<tr>';
                                                echo '<td><code>'.$value["gc_value"].'</code> <small>('.$value["gc_name"].')</small></td>';
                                                if(isset($group) && $group)
                                                {
                                                    foreach ($group as $k => $val) 
                                                    {
                                                        # code...         
                                                            $myPermission = $this->mpermission->getData('',array("gc_id"=>$value["id"],"group_id"=>$val["id"]));                                                            
                                                            $checked = $myPermission ? 'checked="checked"':'';
                                                            echo '<td class="text-center">';
                                                                echo '<span class="checkbox custom-checkbox">';
                                                                    echo'<input type="checkbox" id="aj_proccess_'.$value["id"].'_'.$val["id"].'" '.$checked.' class="aj_proccess" value="'.$value["id"].'-'.$val["id"].'" />';
                                                                    echo '<label for="aj_proccess_'.$value["id"].'_'.$val["id"].'"></label>';
                                                                echo '</span>';
                                                            echo '</td>';                                                        
                                                    }
                                                }
                                                echo '<td></td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>                                                                                                                
                                    </tbody>
                                </table>                               
                            </form>
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
        