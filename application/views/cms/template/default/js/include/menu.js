/*! ========================================================================
 * tinhnguyenvan
 * tinhnguyenvan91@gmail.com
 * 0909 977 920
 * ======================================================================== */

 /**popup upload file
|
| chon file bang popup
|
 */
$(function () {
    $('.iframe-btn').fancybox({ 
    'width'     : 900,
    'height'    : 600,
    'type'      : 'iframe',
        'autoScale'     : false
    });

/**begin load view theo com
| load du lieu du theo id controller
*/
var _hdmenu_com = $("#hdmenu_com").val();
var _hdmenu_view = $("#hdmenu_view").val();
if(_hdmenu_com!=""){
	/**truong hop danh cho khi cap nhat*/	
		var com_datastring = 'com='+_hdmenu_com+'&view='+_hdmenu_view;		
		$(".menu_view").html('');
        $.ajax({
            type:"post",
            data:com_datastring,
            url:configs.cms_site+'com/ajaxLoadView/',
            success:function(arr){                          
                if(arr){      
            		$(".menu_view").append(arr);                    
                }else{
                	$(".menu_view").html('<option value="">Data Empty</option');
                }
            }
        });
	
}

/**khi su kien change bat dau thay doi*/
$(".menu_com").bind("change",function(){
	_val_change = $(this).val();
	if(_val_change!=""){
		var com_datastring = 'com='+_val_change+'&view='+_hdmenu_view;
		$(".menu_view").html('');
        $.ajax({
            type:"post",
            data:com_datastring,
            url:configs.cms_site+'com/ajaxLoadView/',
            success:function(arr){                          
                if(arr){      
            		$(".menu_view").append(arr);                    
                }else{
                	$(".menu_view").html('<option value="">Data Empty</option');
                }
            }
        });
	}
});
/**end load view theo com*/

/**begin tao alias*/
$("#menu_name").bind("keyup",function(){
	_val_mn = $(this).val();	
	if(_val_mn){
		var com_datastring = 'name='+_val_mn;
		$.ajax({
			type:'post',
			data:com_datastring,
			url:configs.cms_site+'menu/aj_aliasmenu/',
			success:function(arr){
				if(arr){
					$("#menu_alias").val(arr);
				}
			}
		});
	}	
});
/**end tao alias*/

/**begin xu ly chon loai link menu*/
var _hd_menu_link_id = $(".hd_menu_link_id").val();
if(_hd_menu_link_id==1){
	$(".ra_menu_link_0").hide();
}else{
	$(".ra_menu_link_1").hide();
}

/**khi bat dau click*/
$(".menu_link_id").bind("click",function(){
	_val_ra = $(this).val();
	if(_val_ra==1){
		$(".ra_menu_link_0").hide(100);
		$(".ra_menu_link_1").show(200);
	}else{
		$(".ra_menu_link_1").hide(100);
		$(".ra_menu_link_0").show(200);
	}
})
/**end xu ly chon loai link menu*/
});