<!DOCTYPE html>
<html>    
<head>      
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title?> CMS</title>
        <meta name="author" content="pampersdry.info">
        <meta name="description" content="Adminre is a clean and flat admin theme build with Twitter bootstrap 3.1.1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">    
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>layout.min.css">
        <link rel="stylesheet" href="<?= my_lib::cms_css()?>uielement.min.css">        
        <script src="<?= my_lib::cms_js()?>modernizr.min.js"></script>        
    </head>
    <!--/ END Head -->

    <!-- START Body -->
    <body>
        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <section class="container">
                <!-- START row -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <!-- Brand -->
                        <div class="text-center" style="margin-bottom:40px;">
                            <img src="<?= my_lib::cms_img()?>logo.png" alt="" height="100%">
                            <img src="<?= my_lib::cms_img()?>logopnvn.png" alt="" height="88">
                        </div>

                        <hr>
                        <form class="panel" name="form-login" method="post">
                            <div class="panel-body">
                                <!-- Alert message -->
                                <?php if(isset($error) && $error) 
                                { 
                                    echo '<div class="alert alert-danger">';
                                        echo '<ul>';
                                        foreach ($error as $key => $value) {
                                            # code...
                                            echo '<li>'.$value.'</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                 }
                                 else
                                 {
                                    echo '<div class="alert alert-success">';
                                        echo 'Mời bạn nhập username và password';
                                    echo '</div>';
                                 } 
                                 ?>
                                 <?php if (isset($success) && $success): ?>
                                     <div class="alert alert-success">
                                         <ul>
                                             <li><?= $success?></li>
                                         </ul>
                                     </div>
                                 <?php endif ?>
                                <div class="form-group">
                                    <div class="form-stack has-icon pull-left">
                                        <input autocomplete="off" required="required" name="username" value="<?= $formData['username']?>" type="text" class="form-control input-lg" placeholder="Username" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username " data-parsley-required>
                                        <i class="ico-user2 form-control-icon"></i>
                                    </div>
                                    <div class="form-stack has-icon pull-left">
                                        <input required="required" name="password" type="password" class="form-control input-lg" placeholder="Password" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your password" data-parsley-required>
                                        <i class="ico-lock2 form-control-icon"></i>
                                    </div>
                                </div>

                                <!-- Error container -->
                                <div id="error-container" class="mb15"></div>
                                <!--/ Error container -->

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="checkbox custom-checkbox">  
                                                <input type="checkbox" name="remember" id="remember" value="1">  
                                                <label for="remember">&nbsp;&nbsp;Remember me</label>   
                                            </div>
                                        </div>
                                        <div class="col-xs-12 text-right">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#bs-modal">Lost password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group nm">
                                    <button type="submit" name="flogin" class="btn btn-block btn-success"><span class="semibold">Sign In</span></button>
                                </div>
                            </div>
                        </form>
                        <div id="bs-modal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form class="panel" name="form-register" method="post">
                                        <div class="panel-body">
                                            <p class="semibold text-muted">Nhập email khi bạn đăng ký tài khoản, để hệ thống gửi password mới cho bạn!</p>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <div class="has-icon pull-left">
                                                    <input type="email" required="required" class="form-control" name="email_reset" placeholder="you@ioi.vn">
                                                    <i class="ico-envelop form-control-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <button type="submit" name="submit_reset" class="btn btn-success"><span class="semibold">Send</span></button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <!-- Login form -->

                        <hr><!-- horizontal line -->

                        <p class="text-muted text-center">Designed by <a class="semibold" href="http://tsmedia.ioi.vn">TS Media</a></p>
                    </div>
                </div>
                <!--/ END row -->
            </section>
            <!--/ END Template Container -->
        </section>
        <!--/ END Template Main -->

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- Library script : mandatory -->
        <script type="text/javascript" src="<?= my_lib::cms_js()?>jquery.min.js"></script>
        <script type="text/javascript" src="<?= my_lib::cms_js()?>jquery-migrate.min.js"></script>
        <script type="text/javascript" src="<?= my_lib::cms_js()?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= my_lib::cms_js()?>core.min.js"></script>
        <script type="text/javascript" src="<?= my_lib::cms_js()?>notification.js"></script>
        <!--/ Library script -->

        <!-- App and page level script -->
        <script type="text/javascript" src="plugins/sparkline/js/jquery.sparkline.min.js"></script><!-- will be use globaly as a summary on sidebar menu -->
        <script type="text/javascript" src="javascript/app.min.js"></script>
        
        <script type="text/javascript" src="plugins/parsley/js/parsley.min.js"></script>
        
        <script type="text/javascript" src="javascript/pages/login.js"></script>
        
        <!--/ App and page level scrip -->
        <!--/ END JAVASCRIPT SECTION -->
    </body>    
</html>