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



/**search autocomplete tim kiem bai viet*/
$(function() {
    $('#hdnews_id').autocomplete({        
        select: function (e, ui) {
            if (ui.item) 
            {
                $("#hdnews_id").val(ui.item.label);
                $("#news_id").val(ui.item.value);
            }
            else
            {
                $("#hdnews_id").val("");
                $("#news_id").val("");
            }    
            return false;        
        }, 
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
                            value: item.id,                                
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 2       
      });        
});
/**end autocomplete tim kiem bai viet*/

/**search autocomplete tim kiem thành viên*/
$(function() {
    $('#hduser_post').autocomplete({        
        select: function (e, ui) {
            if (ui.item) 
            {
                $("#hduser_post").val(ui.item.label);
                $("#user_post").val(ui.item.value);
            }
            else
            {
                $("#hduser_post").val("");
                $("#user_post").val("");
            }    
            return false;        
        }, 
        source: function( request, response ) {
            $.ajax({
                url:configs.cms_site+'user/aj_autoCompleteIndex/',
                dataType: "json",
                data: {
                   key: request.term,                           
                },
                 success: function( data ) {
                     response( $.map( data, function( item ) {
                        return {
                            label: item.user_fullname,
                            value: item.id,                                
                        }
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 2       
      });        
});
/**end autocomplete tim kiem thành viên*/