<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Danh sách thông báo
                <span class="badge badge-teal"><?= $record?></span></h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active">Làm việc khách hàng</li>
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

                    <!--begin form tim kiem-->
                    <form method="get" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                                         
                                    <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: Ngày {nam-thang-ngay}, nhân viên liên hệ, nội dung">
                                </div>                                        
                                                                        
                                <input type="hidden" name="page" value="<?= $page?>">
                            </div>                                        
                        </div>
                        <!--end form tim kiem-->
                   

                    <!-- panel body with collapse capabale -->
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                             <tr>
                                <th colspan="10">                                            
                                    <div class="pull-right">
                                        <ul class="pagination pagination-sm mt0">
                                        <li class="limit_form">
                                            <label>Show: </label>
                                            <select name="fperpage" onchange="this.form.submit()" class="form-control input-sm ">
                                                <?php
                                                for ($i=1; $i <= 10 ; $i++) { 
                                                    $show = $i*10;
                                                    $selected = $show==$formData['fperpage'] ? 'selected':'';
                                                    echo '<option '.$selected.' value="'.$show.'">'.$show.'</option>';
                                                }
                                                ?>
                                                option
                                            </select>
                                        </li>
                                        <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                    </div>
                                    </form>
                                    <form method="post" id="flistData">
                                    <div class="checkbox custom-checkbox pull-left">  
                                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">  
                                        <label for="customcheckbox-one0">&nbsp;&nbsp;</label>  
                                        <button type="submit" name="delAll" class="btn btn-sm btn-danger" onclick="return Delete();" ><i class="ico-remove3"></i> Delete</button>
                                    </div>
                                    <div class="pull-left" style="margin-left:5px;">                                                                                            
                                        <a href="<?= my_lib::cms_site()?>company_work/add/" class="btn btn-sm btn-primary"><i class="ico-plus"></i> Thêm mới</a>                                          
                                    </div>
                                </th>
                            </tr>
                                <tr>
                                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>                                            
                                    <th width="3%" class="text-center">ID</th>                                            
                                    <th width="100px">Ngày</th>                                                                           
                                    <th>Thời gian</th>                                                                           
                                    <th class="text-center" width="15%">Nhân viên liên hệ</th>                                                                           
                                    <th class="text-center" width="15%">Người liên hệ</th>                                                                           
                                    <th>Nội dung</th>                                                                           
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($list) && $list){
                                    $i=1;
                                    foreach ($list as $key => $value) {
                                        # code...            
                                        $tmpInfo = $this->minfocontact->getData(array("contact_name"),array("id"=>$value['infocontact_id']));
                                        $value["infocontact_id"] = $tmpInfo?$tmpInfo['contact_name']:'';
                                        $link_update = my_lib::cms_site().'company_work/edit/'.$value["id"].'/?redirect='.base64_encode(current_url());
                                        $link_delete = my_lib::cms_site().'company_work/delete/'.$value["id"].'/?redirect='.base64_encode(current_url());;
                                        echo '<tr>';
                                            echo '<td>';
                                                echo '<div class="checkbox custom-checkbox nm">';
                                                    echo '<input type="checkbox" id="customcheckbox-one'.$i.'" value="'.$value["id"].'" data-toggle="selectrow" data-target="tr" data-contextual="stroke" name="checkid[]">';
                                                    echo '<label for="customcheckbox-one'.$i.'"></label>';
                                                echo '</div>';
                                            echo '</td>';                                                

                                            echo '<td>'.$value["id"].'</td>';                                                
                                            echo '<td><a>'.$value["create_date"].'</a></td>';                                                
                                            echo '<td class="text-center">'.$value["time"].'</td>';
                                            echo '<td class="text-center">'.$value["employee_name"].'</td>';                                                    
                                            echo '<td class="text-center">'.$value["infocontact_id"].'</td>';                                                    
                                            echo '<td>'.$value["contact_content"].'</td>';                                                    

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
                                <tr>
                                    <td colspan="10">
                                        <div class="text-right"> 
                                        <ul class="pagination pagination-sm mt0">                                            
                                           <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                        </div>
                                    </td>
                                </tr>
                                </form>
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
<!--/ END Template Main-->
