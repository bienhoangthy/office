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
	/**begin tao alias*/
	$("#translate_name").bind("keyup",function(){
		_val_mn = $(this).val();	
		if(_val_mn){
			var com_datastring = 'name='+_val_mn;
			$.ajax({
				type:'post',
				data:com_datastring,
				url:configs.cms_site+'translate/aj_aliasTranslate/',
				success:function(arr){
					if(arr){
						$("#translate_code").val(arr);
					}
				}
			});
		}	
	});
/**end tao alias*/
});


/**search autocomplete danh sach*/
$(function() {
    $('#fkeyword').autocomplete({        
        source: function( request, response ) {
            $.ajax({
                url:configs.cms_site+'translate/aj_autoCompleteIndex/',
                dataType: "json",
                data: {
                   key: request.term,                           
                },
                 success: function( data ) {
                     response( $.map( data, function( item ) {
                        return {
                            label: item.translate_name,
                            value: item.translate_name,                                
                        }
                    }));
                }
            });
        },
        autoFocus: false,
        minLength: 2       
      });        
});
/**end autocomplete danh sach*/
    