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

    /**begin danh sach*/
    $("#fkeyword").on("blur",function(){
        $("#flistData").submit();
    });
    $('#fkeyword').autocomplete({             
        source: function( request, response ) {
            $.ajax({
                url:configs.cms_site+'company/aj_autoCompleteIndex/',
                dataType: "json",
                data: {
                   key: request.term,                           
                },
                 success: function( data ) {                    
                    response( $.map( data, function( item ) {
                        return {
                            label: item.name + ' --> ' +item.user,
                            value: item.name,                                
                        }                       
                    }));
                }
            });
        },
        autoFocus: false,
        minLength: 1       
    });  
    /**end danh sach*/

    /**page lam viec khach hang*/
    $("#fstatusWorking").on("change",function(){
        var _valStatusID = $(this).val();
        var _valIDCompany = $(this).attr("data-company-id");
        if(_valStatusID && _valIDCompany)
        {
            dataString = 'status='+_valStatusID+'&id='+_valIDCompany;
            $.ajax({
                url:configs.cms_site+'company/aj_updateStatus/',
                dataType: "json",
                data: dataString,
                 success: function( data ) {                    
                    alert("Đã cập nhật trạng thái");
                }
            });
        }
    })
    /**end lam viec khach hang*/

    /**page lam viec khach hang*/
    $("#fcompanyrateWorking").on("change",function(){
        var _valCompanyRate = $(this).val();
        var _valIDCompany = $(this).attr("data-company-id");
        if(_valCompanyRate && _valIDCompany)
        {
            dataString = 'company_rate='+_valCompanyRate+'&id='+_valIDCompany;
            $.ajax({
                url:configs.cms_site+'company/aj_updateCompanyRate/',
                dataType: "json",
                data: dataString,
                 success: function( data ) {                    
                    alert("Đã cập nhật trạng thái");
                }
            });
        }
    })
    /**end lam viec khach hang*/

    /**page lam viec khach hang*/
    $("#fuser_id").on("change",function(){
        var _valUserID = $(this).val();
        var _valIDCompany = $(this).attr("data-company-id");
        if(_valUserID && _valIDCompany)
        {
            dataString = 'user_id='+_valUserID+'&id='+_valIDCompany;
            $.ajax({
                url:configs.cms_site+'company/aj_updateUser/',
                dataType: "json",
                data: dataString,
                 success: function( data ) {                    
                    alert("Đã cập nhật nhân viên");
                }
            });
        }
    })
    /**end lam viec khach hang*/
    $("#finfocontactid").bind("change",function(){
        var _ID = $(this).val();
        if(_ID)
        {
            $("#hdfinfocontactid").val(_ID);
            var _fphone = $(".check_phone_"+_ID).attr("data-contact-phone");          
            if(_fphone)
            {
                $("#fphone").val(_fphone);
            }
        }
    });
    $("#fstatus").bind("change",function(){
        var _ID = $(this).val();
        if(_ID)
        {
            $("#hdfstatus").val(_ID);            
        }
    });

    /**begin luu hanh dong bang ajax*/
    $(".fSaveAj").on("click",function(){        
        var _hdfinfocontactid = $("#hdfinfocontactid").val();
        var _hdfstatus = $("#hdfstatus").val();
        var _fcontact_content = $("#fcontact_content").val();
        var _femployee_name = $("#femployee_name").val();
        var _fstatus = $("#fstatus").val();
        var _fphone = $("#fphone").val();
        var _ftime = $("#ftime").val();
        var _fcreate_date = $("#fcreate_date").val();
        if(_hdfinfocontactid && _hdfstatus && _fcontact_content && _femployee_name && _fstatus && _ftime && _fcreate_date)
        {
            _datastring = 'hdfinfocontactid='+_hdfinfocontactid
                        + '&hdfstatus='+_hdfstatus
                        + '&fcontact_content='+_fcontact_content
                        + '&femployee_name='+_femployee_name
                        + '&fstatus='+_fstatus
                        + '&fphone='+_fphone
                        + '&ftime='+_ftime                        
                        + '&fcreate_date='+_fcreate_date; 
            $.ajax({
                url:configs.cms_site+'company_work/aj_insertData/',
                dataType: "text",
                data: _datastring,
                success: function( data ) {   
                    if(data)
                    {      
                        $("#fcontact_content").val("");
                        $(".ajPrepend").prepend(data);
                    }else{
                        alert("Không thêm dữ liệu được");
                    }
                }
            });                    
        }else{
            alert('Mời bạn nhập đầy đủ thông tin');
        }
    })
    /**end luu hanh dong bang ajax*/

    /**begin showwork
    @cap nhat trang thai trong company/showwork
    */
    $(".ajUpdateWorkingStatus").on("click",function(){
        var _data_status = $(this).attr("data-status");
        var _data_id = $(this).attr("data-id");
        var obj = $(this);
        if(_data_status && _data_id)
        {
            _datastring = 'id='+_data_id+'&status='+_data_status;                       
            $.ajax({
                url:configs.cms_site+'company_work/aj_updateWorkingStatus/',
                dataType: "text",
                data: _datastring,
                success: function( data ) {                       
                    if(data)
                    {      
                        obj.html(data);
                        if(_data_status==1)
                        {
                            _status = 0;
                        }else
                        {                        
                            _status = 1;
                        }
                        obj.attr("data-status",_status);   
                        alert("Đã cập nhật trạng thái");                     
                    }else{
                        alert("Không thêm dữ liệu được");
                    }
                }
            }); 
        }
    });
    /**end showwork*/
});

/**begin editor*/
// tinymce.init({
//     selector: "textarea#fcontact_content",theme: "modern",width: "100%",height: 100,
//     plugins: [
//             "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
//             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
//             "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
//     ],

//     toolbar1: "removeformat | emoticons charmap table | ltr rtl bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | insertdatetime forecolor backcolor | fullscreen",    

//     menubar: false,
//     toolbar_items_size: 'small',
//  });
/**end editor*/

/*! ========================================================================
 * button.js
 * Page/renders: components-button.html
 * Plugins used: 
 * ======================================================================== */

