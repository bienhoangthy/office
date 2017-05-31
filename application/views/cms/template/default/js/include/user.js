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
    
    $("#fkeyword").on("blur",function(){
        $("#flistData").submit();
    });

});