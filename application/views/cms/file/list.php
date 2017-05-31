<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?>
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
            <div class="col-md-12">
                <!-- START panel -->
                <div class="panel panel-primary">
                    <!-- panel heading/header -->
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-files"></i></span> Danh sách files</h3>
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
                        <div class="panel-toolbar-wrapper pt5 pb5">
                        <?php if ($boss == 1): ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                                    <a href="<?= my_lib::cms_site()?>file/add"><button class="btn btn-success"><i class="ico-new-tab"></i> Thêm file</button></a>
                                </div>
                                <!-- <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                                    <a href="<?= my_lib::cms_site()?>file/cate"><button class="btn btn-primary"><i class="ico-th-list"></i> DS Danh mục files</button></a>
                                </div> -->
                                <form method="get" action="<?= my_lib::cms_site()?>file/detail/<?= $id?>" id="flistData"> 
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">                                         
                                        <input type="text" name="fkeyword" id="fkeyword" value="<?= $fkeyword?>" class="form-control" placeholder="Từ khóa: Tên file">
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                                        <select onchange="this.form.submit()" class="form-control fstatus" name="fstatus">
                                            <?= $fstatus;?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        <?php endif ?>
                        </div>
                    </div>
                    <!--/ panel toolbar wrapper -->

                    <!-- panel body with collapse capabale -->
                    <div class="table-responsive panel-collapse pull out">
                        <table class="table table-bordered table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th width="3%" class="text-center"><i class="ico-long-arrow-down"></i></th>
                                    <th class="text-center">Tên file</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">Hướng dẫn</th>
                                    <?php if ($boss == 1): ?>
                                        <th class="text-center">Sửa | Ẩn | Xóa</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($listFile_lv2): ?>
                                    <?php $i=1; ?>
                                    <?php foreach ($listFile_lv2 as $key => $value): ?>
                                             <?php 
                                                $link_down = my_lib::base_url().'media/file/'.$value['file_name'];
                                                $link_view = 'http://docs.google.com/gview?url='.$link_down.'&embedded=true';
                                                $status_change = $value['file_status']==1?2:1;
                                                $link_status = my_lib::cms_site().'file/status/'.$value['id']. '/' . $status_change .'/?redirect='.base64_encode(current_url());
                                             ?>
                                            <tr>
                                                <td class="text-center"><?= $i?></td>
                                                <td class="text-center"><a href="<?= $link_view?>" class="word"><?= $value['file_title']?></a></td>
                                                <!-- <td class="text-center" width="200"><a target="_blank" class="word" href="<?= $link_view?>"><button class="btn btn-success"><i class="ico-eye3"></i> Xem file</button></a></td> -->
                                                <td class="text-center" width="200"><a href="<?= $link_down?>"><button class="btn btn-teal"><i class="ico-file-download"></i> Tải file</button></a></td>
                                                <td><?= $value['file_description']?></td>
                                                <?php if ($boss == 1): ?>
                                                    <td class="text-center" width="200">
                                                        <a href="<?= my_lib::cms_site()?>file/edit/<?= $value['id'].'/?redirect='.base64_encode(current_url())?>" title="Sửa"><button class="btn btn-teal"><i class="ico-pencil6"></i></button></a> | <a href="<?= $link_status?>" title = "Ẩn/Hiện"><button class="btn btn-default"><i class="ico-eye-close"></i></button></a> | <a href="<?= my_lib::cms_site()?>file/delete/<?= $value['id'].'/?redirect='.base64_encode(current_url())?>" title="Xóa" onclick="return Delete();"><button class="btn btn-danger"><i class="ico-trash"></i></button></a>
                                                    </td>
                                                <?php endif ?>
                                            </tr>
                                            <?php $i++; ?>
                                    <?php endforeach ?>
                                <?php endif ?>
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

<script type="text/javascript">
    $(document).ready(function() {
     $(".word").fancybox({
      'width': 1000, // or whatever
      'height': 1600,
      'type': 'iframe'
     });
    });
</script>