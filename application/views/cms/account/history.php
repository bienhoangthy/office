<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?>
                <span class="badge badge-teal"><?= $record?></span></h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>">Home</a></li>
                        <li class="active"><?= $title?></li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- START row -->
        <div class="row">
            <div class="col-md-12" id="content-sum">
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <!-- panel heading/header -->
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-table22"></i></span> Danh sách <span class="label label-danger"><?= $textFilter?></span></h3>
                        <!-- panel toolbar -->
                        <div class="panel-toolbar text-right">
                            <!-- option -->
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                            </div>
                        </div>
                    </div>
                    <form method="get" id="flistData">
                        <div class="panel-toolbar-wrapper pt5 pb5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <input type="text" name="fkeyword" id="fkeyword" value="<?= $formData['fkeyword']?>" class="form-control" placeholder="Từ khóa: ghi chú">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control ftype" name="ftype">
                                        <?= $ftype;?>
                                    </select>  
                                </div>  
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control faccount_name" name="faccount_name">
                                        <?= $faccount_name;?>
                                    </select>  
                                </div>  
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fuser" name="fuser">
                                        <?= $fuser;?>
                                    </select>  
                                </div>   
                                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">                                         
                                     <div class="input-group">
                                        <input type="number" value="<?= $formData['ftime']?>" id="ftime" name="ftime" min="1" class="form-control">
                                        <div class="input-group-btn">
                                            <select class="btn btn-teal dropdown-toggle" name="ftypeTime" data-toggle="dropdown">
                                                <ul class="dropdown-menu pull-right">
                                                    <?= $ftypeTime?>
                                                </ul>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-1 col-lg-2">                                         
                                    <select onchange="this.form.submit()" class="form-control fyear" name="fyear">                                            
                                    <?= $fyear;?>
                                    </select>  
                                </div>   
                                <input type="hidden" name="page" value="<?= $page?>">
                            </div>                                        
                        </div>
                    </form>
                    <div class="table-responsive panel-collapse pull out">
                    <form method="post" id="flistData">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th colspan="11">                                                
                                        <div class="pull-right">
                                            <ul class="pagination pagination-sm mt0">
                                            <?= isset($pagination) && $pagination ? $pagination:''?></ul>
                                        </div>
                                        <div class="pull-left" style="margin-left:5px;">
                                            <a href="javascript:void(0)" id="btn-sum-price" class="btn btn-sm btn-teal"><i class="ico-dollar"></i> Tổng số tiền</a>                                 
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <?php if ($type == 1): ?>
                                        <th class="css_id">ID</th>
                                        <th width="15%">Loại thu</th>
                                        <th class="text-center">Vào tài khoản</th> 
                                        <th width="10%" class="text-center">Ngày</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Người thu</th>
                                        <th class="text-center">Số tiền</th>
                                    <?php else: ?>
                                        <th class="css_id">ID</th>
                                        <th width="15%">Loại chi</th>
                                        <th class="text-center">Từ tài khoản</th> 
                                        <th width="10%" class="text-center">Ngày</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Chi cho</th>
                                        <th class="text-center">Số tiền</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($list)): ?>
                                    <?php foreach ($list as $key => $value): ?>
                                        <?php 
                                            $myAccountName = $this->maccount_name->getData(array("ac_name"),array("id"=>$value["ac_id"]));
                                            $myAccountTypeChilrd = $this->maccount_type->getData(array("type_name"),array("id"=>$value["a_type_chilrd"]));
                                            $myUser = $this->muser->getData(array("user_fullname"),array("id"=>$value["a_user"]));
                                            $user_fullname = isset($myUser["user_fullname"]) ? $myUser["user_fullname"]:"Công ty";
                                         ?>
                                         <tr>
                                             <td><?= $value['id']?></td>
                                             <td><?= $myAccountTypeChilrd["type_name"]?></td>
                                             <td><?= $myAccountName["ac_name"]?></td>
                                             <td><?= date("H:i",strtotime($value["a_time"])).' '.date("d/m/Y",strtotime($value["a_date"]))?></td>
                                            <td><?= $value["a_note"]?></td>
                                            <td><?= $user_fullname?></td>
                                            <td><?= number_format($value["a_money"])?></td>
                                         </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                        </form>
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
<script>
    $(document).ready(function(){
        $("#btn-sum-price").click(function(){
            var and = '<?= $condition?>';
            var url = '<?= my_lib::cms_site()."account/sumAjax"?>';
            $.ajax({
                type: 'post',
                data: {"and":and},
                cache: false,
                url: url,
                success: function(rs) {
                    $("#content-sum").empty();
                    $("#content-sum").append(rs);
                }
            });
        });
    });
</script>
