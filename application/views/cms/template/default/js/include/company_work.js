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
    $("#fkeyword").on("blur",function(){
        $("#flistData").submit();
    });  

     $('#fkeyword').autocomplete({             
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
                            value: item.user_fullname,                                
                        }                       
                    }));
                }
            });
        },
        autoFocus: false,
        minLength: 2       
      });             
});

