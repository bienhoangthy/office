<!DOCTYPE html>
<html>
<head>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php if(isset($showTask) && count($showTask) > 0) { echo "(".count($showTask).")";} ?> <?= $title?></title>
        <meta name="author" content="TS Media">
        <meta name="description" content="TS Media">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
        <link href="<?= my_lib::cms_img()?>favicon.ico" rel="shortcut icon" type="image/ico" />      
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>layout.min.css">
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>uielement.min.css">                
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>uielement.min.css">                
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>tsmedia.css">
        <link rel="stylesheet" href="<?= my_lib::cms_js()?>selectize/css/selectize.min.css">                
        <link rel="stylesheet" href="<?= my_lib::cms_js()?>jqueryui/css/jquery-ui.min.css">                
        <script type="text/javascript" src="<?= my_lib::cms_js()?>jquery.min.js"></script>
        
        <script type="text/javascript" src="<?= my_lib::cms_js()?>jqueryui/js/jquery-ui.min.js"></script>
        <script src="<?= my_lib::cms_js()?>modernizr.min.js"></script>    
        <!--begin upload file-->
        <link rel="stylesheet" type="text/css" href="<?= my_lib::cms_js()?>fancybox/jquery.fancybox-1.3.4.css" media="screen" />        
        <!--begin upload file-->


        <script type="text/javascript">
            var configs = {
            base_url: '<?= my_lib::base_url()?>',            
            cms_site: '<?= my_lib::cms_site()?>',
            cms_js: '<?= my_lib::cms_js()?>',
            admin_name: '<?=$this->uri->segment(1)?>',
            base_component: '<?=$this->uri->segment(2)?>',
            task:'<?= $this->uri->segment(3)?>',            
            page:'<?= isset($_REQUEST["page"]) ? $_REQUEST["page"]:1?>',   
            user_id: '<?= $s_info["s_user_id"]?>'    
            }
        </script>
        <!-- push -->
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
        <script type="text/javascript" src="<?= my_lib::cms_js()?>push.js"></script>
    </head>    