<section id="main" role="main">
<div class="row">
    <div class="col-md-12">
        <form class="panel panel-default form-horizontal form-bordered"  method="post">
        <div class="form-group"> 
            <label class="col-sm-3 control-label">Picture</label>
            <div class="col-sm-9">                           
                <div class="input-group">
                    <span class="input-group-btn">                                    
                        <a href="<?= my_lib::cms_fileupload()?>dialog.php?type=1&amp;field_id=fieldID" class="btn iframe-btn btn-success choose_img" type="button"><i class="ico-image3"></i> Chọn hình...</a>
                    </span>
                    <input type="text" id="fieldID" name="news_picture" class="form-control">
                </div>
            
                <div class="row">
                    <div class='col-lg-4'>                                
                        <img class="view_tmp" id="img169" src="<?= my_lib::cms_img()?>logo.png">

                        <input id="bee_x" type="hidden" name="bee_x" value="" />
                        <input id="bee_y" type="hidden" name="bee_y" value="" />
                        <input id="bee_x1" type="hidden" name="bee_x1" value="" />
                        <input id="bee_y1" type="hidden" name="bee_y1" value="" />
                        <input id="bee_x2" type="hidden" name="bee_x2" value="" />
                        <input id="bee_y2" type="hidden" name="bee_y2" value="" />
                    </div>


                    <div class='col-lg-4'>                                
                        <img class="view_tmp" id="img43" src="<?= my_lib::cms_img()?>logo.png">
                        <input id="img43_x" type="hidden" name="img43_x" />
                        <input id="img43_y" type="hidden" name="img43_y" />
                        <input id="img43_x1" type="hidden" name="img43_x1" />
                        <input id="img43_y1" type="hidden" name="img43_y1" />
                        <input id="img43_x2" type="hidden" name="img43_x2" />
                        <input id="img43_y2" type="hidden" name="img43_y2" />                                
                    </div>


                    <div class='col-lg-4'>                                
                        <img class="view_tmp" id="img11" src="<?= my_lib::cms_img()?>logo.png">
                        <input id="img11_x" type="hidden" name="img11_x" />
                        <input id="img11_y" type="hidden" name="img11_y" />
                        <input id="img11_x1" type="hidden" name="img11_x1" />
                        <input id="img11_y1" type="hidden" name="img11_y1" />
                        <input id="img11_x2" type="hidden" name="img11_x2" />
                        <input id="img11_y2" type="hidden" name="img11_y2" />                                
                    </div>

                    <!--begin show ket qua-->
                    <div class="show_proccess">
                        <div class="col-lg-4 show_img_16_9"></div>
                        <div class="col-lg-4 show_img_4_3"></div>
                        <div class="col-lg-4 show_img_1_1"></div>
                    </div>
                    <!--end show ket qua-->
                </div>

                <div class="clr"></div>
                <div class="modal-footer">                            
                    <button type="button" class="btn btn-primary aj_upload"><i class="ico-folder-upload3"></i> Scrop hình</button>
                    <button type="button" class="btn btn-success aj_proccess"><i class="ico-spinner"></i> Proccess</button>
                </div>       
            </div>                     
        </div>

        <link rel="stylesheet" type="text/css" href="<?= my_lib::cms_css()?>imgareaselect-default.css" />
        <!--<script type="text/javascript" src="scripts/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?= my_lib::cms_js()?>jquery.imgareaselect.pack.js"></script>
        <!--end drop hinh anh-->
        <script type="text/javascript">
        $(function () {            
            $('#img169').imgAreaSelect({ 
                x1: 120, y1: 90, x2: 280, y2: 210 ,
                aspectRatio: '16:9',
                handles: true,
                onSelectEnd: function (img, selection) {
                    $('input[name="bee_x"]').val(selection.width);
                    $('input[name="bee_y"]').val(selection.height);
                    $('input[name="bee_x1"]').val(selection.x1);
                    $('input[name="bee_y1"]').val(selection.y1);
                    $('input[name="bee_x2"]').val(selection.x2);
                    $('input[name="bee_y2"]').val(selection.y2);            
                }
             }); 
        });


        $(document).ready(function(){
            $(".aj_upload").bind("click",function(){
                /**begin change button*/
                $(this).hide(100);
                $(".aj_proccess").show(100);
                /**end change button*/
                // $(".show_proccess").html('<div class="indicator show"><span class="spinner spinner10"></span></div>');
                _fieldID = $("#fieldID").val();
                if(_fieldID)
                {
                    $("#img169").attr("src",_fieldID);                    
                    // $("#img43").attr("src",_fieldID);                    
                    // $("#img11").attr("src",_fieldID);                                
                }
                else
                {
                    $(".show_proccess").html('<div class="alert alert-warning">Vui lòng chọn hình ảnh</div>');
                }
            });

            /**begin xu ly hinh ajax*/
            $(".aj_proccess").on("click",function(){
                /**begin xu ly hinh 16:9*/
                var _root_img = $("#img169").attr("src");
                var _img169_x = $("#bee_x").val();
                var _img169_y = $("#bee_y").val();
                var _img169_x1 = $("#bee_x1").val();
                var _img169_y1 = $("#bee_y1").val();
                var _img169_x2 = $("#bee_x2").val();
                var _img169_y2 = $("#bee_y2").val();
                var _prefix_name = "large";
                if(_root_img && _img169_x && _img169_y && _img169_x1 && _img169_y1 && _img169_x2 && _img169_y2 && _prefix_name)
                {
                    var com_datastring = 'root_img='+_root_img+'&img169_x='+_img169_x+'&img169_y='+_img169_y+'&img169_x1='+_img169_x1+'&img169_y1='+_img169_y1+'&img169_x2='+_img169_x2+'&img169_y2='+_img169_y2+'&prefix_name='+_prefix_name;
                        // $(".show_proccess").html(com_datastring);
                    $.ajax({
                        type:'post',
                        data:com_datastring,
                        url:configs.cms_site+'news/aj_proccessImages/',
                        success:function(arr){
                            if(arr){
                                $(".show_proccess").show(100);
                                $(".show_img_16_9").html('<img src="/'+arr+'" />');;
                            }
                        }
                    });
                }
                /**end xu ly hinh 16:9*/
            });
            /**end xu ly hinh ajax*/

            /**begin change button when choose img*/
            $(".choose_img").on("click",function(){
                $(".aj_proccess").hide(100);
                $(".aj_upload").show(100);
            });
            /**end change button when choose img*/


        });
        </script>
    </div>
</div>
</section>