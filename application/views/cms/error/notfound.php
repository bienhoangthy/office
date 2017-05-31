<section id="main" role="main">    
    <div class="container-fluid">        
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold"><i class="ico-power"></i> <?= $title?></h4>
            </div>
            <div class="page-header-section">                
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="<?= my_lib::cms_site()?>"><i class="ico-home6"></i> Trang chủ</a></li>
                        <li class="active"><i class="ico-power"></i> <?= $title?></li>
                    </ol>
                </div>                
            </div>
        </div>        
        
        <div class="row">
            <div class="col-md-12">
                <div class="page_error text-danger"><i class="ico-power"></i> Not Found !</div>            
            </div>
        </div>        
    </div>    
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>    
</section>