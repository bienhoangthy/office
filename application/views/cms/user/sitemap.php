<script src="<?= my_lib::cms_js()?>sitemap/primitives.min.js"></script>
<link rel="stylesheet" href="<?= my_lib::cms_js()?>sitemap/primitives.latest.css">
<script type='text/javascript'>//<![CDATA[ 
    $(window).load(function () {
        var options = new primitives.orgdiagram.Config();

        var items = [
            new primitives.orgdiagram.ItemConfig({
                id: 0,
                parent: null,
                title: "TS Media",
                description: "TS Media",
                image: "<?= my_lib::cms_img()?>logo.png",
            }),
            <?php if(isset($list) && $list){         
                $i=1;                      
                foreach ($list as $key => $value) {
                    $avatar = my_lib::base_url().'media/user/'.$value['user_avatar'];
                    if ($value['user_avatar'] == "") {
                        $avatar = my_lib::cms_img().'avatar/avatar.png'; 
                    }                     
                ?>
                new primitives.orgdiagram.ItemConfig({
                    id: <?= $value['id']?>,
                    parent: <?= $value['user_parent']?>,
                    title: "<?= $value['user_position']?>",
                    description: "<?= $value['user_fullname']?>",
                    image: "<?= $avatar?>",
                }),
            <?php } } ?>
        ];

        options.items = items;
        // options.cursorItem = 0;
        // options.hasSelectorCheckbox = primitives.common.Enabled.True;

        jQuery("#basicdiagram").orgDiagram(options);
    });//]]>  

</script>

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
                                <li class="active">Danh sách</li>
                            </ol>
                        </div>
                        <!--/ Toolbar -->
                    </div>
                </div>
                <!-- Page Header -->

                <!-- START row -->
                    <div class="row">
                        <div id="basicdiagram" style="width: 100%; min-height:768px " />                      
                    </div>               
            </div>
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>            
        </section>
    
        