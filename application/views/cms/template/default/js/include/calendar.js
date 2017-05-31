/*! ========================================================================
 * tinhnguyenvan
 * tinhnguyenvan91@gmail.com
 * 0909 977 920
 * ======================================================================== */
$(document).ready(function(){
    $("#fkeyword").on("blur",function(){
        $("#flistData").submit();
    });
    
});

/**begin editor*/
tinymce.init({
    selector: "textarea#calendar_detail",theme: "modern",width: "100%",height: 300,
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

