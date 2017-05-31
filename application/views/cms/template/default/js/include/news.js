/*! ========================================================================
 * tinhnguyenvan
 * tinhnguyenvan91@gmail.com
 * 0909 977 920
 * ======================================================================== */


$(document).ready(function(){
    $('.iframe-btn').fancybox({ 
        'width'     : 900,
        'height'    : 600,
        'type'      : 'iframe',
        'autoScale'     : false,
        success: function(){            
            $(".aj_scrop").show(100);
        }
    });

    $(".aj_scrop").on("click",function(){
        var _valImg = $(".news_picture").val();            
        if(_valImg=="")
        {            
            $(".show_msg").html('<div class="msg_img alert alert-warning">Bạn chưa chọn file</div>');
        }
        else
        {
            $(".msg_img").remove();
        }
    });

    /**begin xu ly drop hinh truoc*/
    $(".aj_scrop").bind("click",function(){
        var scr_img = $(".news_picture").val();   
        if(scr_img)
        {
            com_datastring = 'scr_img='+scr_img;
            $.ajax({
                type:'post',
                data:com_datastring,
                url:configs.cms_site+'news/aj_scropImgBegin/',
                success:function(arr){
                    if(arr){
                        $(".view_tmp").show(100);
                        $(".aj_scrop").hide(100);
                        $(".aj_upload").show(200);
                        $("#hdimgroot").val(arr);
                        $("#img169").attr('src',arr);;                  
                    }
                }
            });
        }
        else
        {
            $(".show_msg").html('<div class="msg_img alert alert-warning">Bạn chưa chọn file</div>');
        }
    });
    /**end xu ly drop hinh truoc*/

    /**begin truong hop copy link anh*/
    $("#fieldID").bind("blur",function(){
        var _valImg = $(".news_picture").val();            
        if(_valImg=="")
        {            
            $(".show_proccess").hide(100);
            $(".view_tmp").hide(100);
            $(".aj_scrop").hide(100);
            $(".aj_proccess").hide(100);
            $(".show_msg").html('<div class="msg_img alert alert-warning">Bạn chưa chọn file</div>');
        }
        else
        {
            $(".aj_scrop").show(100);
            $(".view_tmp").show(100);
            $(".aj_proccess").show(100);
            $(".msg_img").remove();
        }
    })
    /**end truong hop copy link anh*/

    $(document).on('click', '.aj_upload', function(event) {        
        /**begin change button*/        
        /**end change button*/
        // $(".show_proccess").html('<div class="indicator show"><span class="spinner spinner10"></span></div>');
        _fieldID = $("#fieldID").val();
        if(_fieldID)
        {
            $(".aj_proccess").show();                        
            /**begin xu ly hinh 16:9*/
            var _root_img = $("#img169").attr("src");
            var _img169_x = $("#img169_x").val();
            var _img169_y = $("#img169_y").val();
            var _img169_x1 = $("#img169_x1").val();
            var _img169_y1 = $("#img169_y1").val();
            var _img169_x2 = $("#img169_x2").val();
            var _img169_y2 = $("#img169_y2").val();
            var _prefix_name = $("#news_alias").val();            
            if(_root_img && _img169_x!=0 && _img169_y!=0 && _img169_x1 && _img169_y1 && _img169_x2 && _img169_y2)
            {
                var com_datastring = 'root_img='+_root_img+'&img169_x='+_img169_x+'&img169_y='+_img169_y+'&img169_x1='+_img169_x1+'&img169_y1='+_img169_y1+'&img169_x2='+_img169_x2+'&img169_y2='+_img169_y2+'&prefix_name='+_prefix_name;            
                $.ajax({
                    type:'post',
                    data:com_datastring,
                    url:configs.cms_site+'news/aj_proccessImages/',
                    success:function(arr){
                        if(arr){                                                 
                            $(".show_proccess").html(arr).show();
                        }
                    }
                });
            }else{                
                $(".show_proccess").html('<div class="alert alert-warning">Bạn chưa chọn tỉ lệ scrop hình</div>').show(100);
            }
            /**end xu ly hinh 16:9*/
        }
        else
        {
            $(".show_proccess").html('<div class="alert alert-warning">Vui lòng chọn hình ảnh</div>');
        }
    });
    
    /**begin change button when choose img*/
    $(".choose_img").on("click",function(){
        $(".aj_proccess").hide(100);
        $(".aj_deleteImg").hide(100);
        $(".aj_scrop").show(100);        
    });
    /**end change button when choose img*/

    /**begin xu ly luu hinh*/
    $(document).on('click', '.aj_proccess', function() {
        var _save_img = $("#save_img").attr("src");
        if(_save_img)
        {
            $(".aj_deleteImg").show();
            $(".imgareaselect-selection").parent("div").hide();
            $(".imgareaselect-outer").hide();
            $(".aj_upload,.aj_proccess").hide(100);
            $(".view_tmp").slideUp(200);
            $("#fieldID").val(_save_img);
        }
    });
    /**end xu ly luu hinh*/

    /**begin xu ly xoa hinh anh */
    $(document).on('click', '.aj_deleteImg', function() {        
        var _tmp_del_thumb169 = $(".tmp_del_thumb169").attr("src");
        var _tmp_del_thumb43 = $(".tmp_del_thumb43").attr("src");
        var _tmp_del_thumb11 = $(".tmp_del_thumb11").attr("src");        
        if(_tmp_del_thumb11 && _tmp_del_thumb43 && _tmp_del_thumb169)
        {   
            com_datastring = 'thumb169='+_tmp_del_thumb169+'&thumb43='+_tmp_del_thumb43+'&thumb11='+_tmp_del_thumb11;            
            $.ajax({
                    type:'post',
                    data:com_datastring,
                    url:configs.cms_site+'news/aj_proccessDelImg/',
                    success:function(arr){
                        if(arr==1){                                                 
                            $(".show_proccess").html("").hide();
                            $(".aj_deleteImg").hide();
                            $(".aj_scrop").show();
                            $("#fieldID").val($("#hdimgroot").val);
                        }else{
                            $(".show_proccess").html(arr).show();
                        }
                    }
                });
        }
        else{
            $(".show_proccess").html('<div class="alert alert-warning">Không tìm thấy link anh để xóa</div>');
        }
    });
    /**end xu ly xoa hinh anh */

    /**begin code drop hinh anh**/         
    $('#img169').imgAreaSelect({ 
        x1: 120, y1: 90, x2: 280, y2: 210 ,
        aspectRatio: '16:9',        
        handles: true,
        onSelectEnd: function (img, selection) {
            $('input[name="img169_x"]').val(selection.width);
            $('input[name="img169_y"]').val(selection.height);
            $('input[name="img169_x1"]').val(selection.x1);
            $('input[name="img169_y1"]').val(selection.y1);
            $('input[name="img169_x2"]').val(selection.x2);
            $('input[name="img169_y2"]').val(selection.y2);            
        }
     });                     
});
/**end code drop hinh anh*/

 /**popup upload file
|
| chon file bang popup
|
 */


$(function () {    
	/**begin tao alias*/
	$("#news_name").bind("keyup",function(){
		_val_mn = $(this).val();	
		if(_val_mn){
			var com_datastring = 'name='+_val_mn;
			$.ajax({
				type:'post',
				data:com_datastring,
				url:configs.cms_site+'news/aj_aliasnews/',
				success:function(arr){
					if(arr){
						$("#news_alias").val(arr);
					}
				}
			});
		}	
	});
/**end tao alias*/
});

/**begin editor*/
tinymce.init({
    selector: "textarea#news_detail",theme: "modern",width: "100%",height: 300,
    plugins: [
     "advlist autolink link image lists charmap print preview hr anchor pagebreak",
     "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
     "table contextmenu directionality emoticons paste textcolor filemanager fullscreen code"
    ],   
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code fullscreen",
    image_advtab: true ,
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,   

    external_filemanager_path:configs.base_url+"application/libraries/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : configs.base_url+"application/libraries/filemanager/plugin.min.js"}
 });
/**end editor*/



/**begin autocomplete event*/
$(function() {
    $('#hdnews_event').autocomplete({
        select: function (e, ui) {
            if (ui.item) 
            {
                $("#hdnews_event").val(ui.item.label);
                $("#news_event").val(ui.item.value);
            }
            else
            {
                $("#hdnews_event").val("");
                $("#news_event").val("");
            }    
            return false;        
        }, 
        source: function( request, response ) {
            $.ajax({
                url:configs.cms_site+'event/aj_getName/',
                dataType: "json",
                data: {
                   key: request.term,                           
                },
                 success: function( data ) {
                     response( $.map( data, function( item ) {
                        return {
                            label: item.event_name,
                            value: item.id,                                
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0        
      });        
});
/**end autocomplete event*/

/**search autocomplete danh sach*/
$(function() {
    $('#fkeyword').autocomplete({        
        source: function( request, response ) {
            $.ajax({
                url:configs.cms_site+'news/aj_autoCompleteIndex/',
                dataType: "json",
                data: {
                   key: request.term,                           
                },
                 success: function( data ) {
                     response( $.map( data, function( item ) {
                        return {
                            label: item.news_name,
                            value: item.news_name,                                
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 2       
      });        
});
/**end autocomplete danh sach*/