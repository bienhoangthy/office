/*! ========================================================================
 * tinhnguyenvan
 * tinhnguyenvan91@gmail.com
 * 0909 977 920
 * ======================================================================== */


$(document).ready(function(){
	$("#type_id").on("change",function(){
		var _val = $(this).val();
		if(_val)
		{
			dataString = 'type_parent='+_val;
            $.ajax({
                url:configs.cms_site+'account_type/aj_getDropDown/',
                dataType: "text",
                type:'GET',
                data: dataString,
                 success: function( data ) {                                                    
					$("#a_type_chilrd").html(data);
                }
            });

		}
	})
});

/*! ========================================================================
 * button.js
 * Page/renders: components-button.html
 * Plugins used: 
 * ======================================================================== */

