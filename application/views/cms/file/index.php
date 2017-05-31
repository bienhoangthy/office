<!--START Template Main -->
<section id="main" role="main">
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><?= $title?>
                <?php if ($boss == 1): ?>
                    <a href="<?= my_lib::cms_site()?>file/add"><button class="btn btn-success">Thêm file</button></a>
                <?php endif ?>
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
            <?php if (!empty($listFile_lv1)): ?>
                <?php $i=1; ?>
                <?php foreach ($listFile_lv1 as $key => $value): ?>
                    <div class="col-lg-6">
                        <!-- heading -->
                        <h4><?= $value['file_title']?></h4>
                        <!--/ heading -->
                        <!-- Accordion -->
                        <div class="panel-group" id="accordion<?= $value['id']?>">
                            <?php if (!empty($listFile_lv2)): ?>
                                <?php foreach ($listFile_lv2 as $key => $val): ?>
                                    <?php if ($val['file_parent'] == $value['id']): ?>
                                        <div class="panel panel-minimal">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion<?= $value['id']?>" href="#collapseTwo<?= $val['id']?>" class="collapsed text-primary">
                                                        <span class="plus mr5"></span> <?= $val['file_title']?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo<?= $val['id']?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <?= $val['file_note']?>
                                                    <br>
                                                    <a href="<?= my_lib::base_url()?>media/file/<?= $val['file_name']?>"><button class="btn btn-success">Download</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                        <!--/ Accordion -->
                    </div>
                    
                    <?php if ($i==2): ?>
                        <div class="clearfix"></div>
                        <?php $i=1; ?>
                    <?php endif ?>
                    <?php $i++; ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <!--/ END row -->                        
    <!-- START To Top Scroller -->
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>
    <!--/ END To Top Scroller -->
</section>
<!--/ END Template Main-->
