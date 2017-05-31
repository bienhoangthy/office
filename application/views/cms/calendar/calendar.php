<section id="main" role="main">    
    <div class="container-fluid">        
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Nghỉ phép nhân viên</h4>
            </div>
            <div class="page-header-section text-right">
                <a href="<?= my_lib::cms_site()?>calendar/add/?redirect=<?= base64_encode(current_url())?>" class="btn btn-primary" ><span class="ico-plus-circle2"></span> Book</a>
                <a href="<?= my_lib::cms_site()?>calendar/booklist" class="btn btn-teal" ><span class="ico-th-list"></span> Danh sách</a>
            </div>
        </div>        
        
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-teal">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-icon mr5"><i class="ico-calendar3"></i></span> Lịch nghỉ nhân viên trong tháng</h3>                        
                        <div class="panel-toolbar text-right">                            
                            <div class="option">
                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                <button class="btn" data-toggle="panelremove"><i class="remove"></i></button>
                            </div>                            
                        </div>                        
                    </div>
                    <div class="panel-collapse pull out">
                        <div id="full_calendar" class="calendar"></div>
                    </div>
                </div>
            </div>
        </div>        
    
    
    <a href="#" class="totop animation" data-toggle="waypoints totop" data-marker="#main" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="-50%"><i class="ico-angle-up"></i></a>    
</section>

<script type="text/javascript" src="<?= my_lib::cms_js()?>fullcalendar/js/fullcalendar.min.js"></script>
<link rel="stylesheet" href="<?= my_lib::cms_js()?>fullcalendar/css/fullcalendar.min.css">
<script type="text/javascript" charset="utf-8" async defer>
$(function () {

    var date = new Date(),
        d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();

    $("#full_calendar").fullCalendar({
        header: {
            left: "prev,next",
            center: "title",
            right: "today,month,agendaWeek,agendaDay"
        },
        buttonText: {
            prev: '<i class="ico-angle-left"></i>',
            next: '<i class="ico-angle-right"></i>'
        },
        editable: true,
        events: function(start, end, callback) {           
            $.ajax({
                type: 'POST',
                url:configs.cms_site+'calendar/aj_LoadCalendar/',
                dataType: 'json',
                data: {                                    
                    start: Math.round(start.getTime() / 1000),
                    end: Math.round(end.getTime() / 1000),
                },                
                success: function(doc) {                                                
                    var events = [];
                    $(doc).each(function(index,item) 
                    {                        
                        events.push({
                            id: item.id,
                            title: item.title,
                            start: item.start,
                            className: "fc-event-"+item.color,                            
                            end: item.end,                            
                            detail: item.detail,  
                            allDay: true                          
                        });                             
                    });                                     
                    callback(events);
                }
            });
        },
        eventClick: function (calEvent, jsEvent, view) {
            // content
            var pcontent = "";
            pcontent += "<a href='"+configs.cms_site+"calendar/edit/"+calEvent.id+"'><h5 class=semibold>";            
            pcontent += calEvent.title;
            pcontent += "</h5></a>";
            pcontent += "<hr/>";
            pcontent += "<div class='detail'>";
            pcontent += calEvent.detail;
            pcontent += "</div>";           
            // bootstrap popover
            $(this).popover({
                placement: "left auto",
                html: true,
                trigger: "manual",
                content: pcontent
            }).popover("toggle");
        }           
        
    });
});

</script>
