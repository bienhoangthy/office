/*! ========================================================================
 * tinhnguyenvan
 * tinhnguyenvan91@gmail.com
 * 0909 977 920
 * ======================================================================== */

$(document).ready(function($) {
	$(document).on('click', '.aj_proccess', function() {		
		/* Act on the event */
		$(".display_ms").show(1);
		var _val = $(this).val();
		var _obj = $(this);		
		if(_val)
		{
			var com_datastring = 'val='+_val;
			$.ajax({
				type:'post',
				data:com_datastring,
				url:configs.cms_site+'permission/aj_proccess/',
				success:function(arr){					
					if(arr)
					{
						$(".display_ms").append('<div class="alert alert-success alert-info">'+arr+' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
					}					
					if(_obj.is(':checked'))
					{
						_obj.attr('checked',true);
					}
					else
					{
						_obj.attr('checked',false);
					}
					setTimeout(function(){ $(".display_ms").hide(1000);}, 3000);
					setTimeout(function(){ $(".display_ms").html("");}, 4000);

				}
			});
		}
	});
});