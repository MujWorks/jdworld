$(document).on('click','.gif_btn',function()
{
	var url=$(this).parent().closest('form').attr('action')
	if (typeof url === "undefined") 
	{
		return false;
	}
	$(this).parent().closest('form').submit();
	
});
$(document).on('click', '.video-img', function () 
{
	var url = $(this).data('url');
	var vid = $(this).data('id');
	var page=$(this).data('page');
	var sequence=(page=='firstPage')?1:0;
		/*$(this).parent().html('< div class = "video-container`+vid+`" ><iframe src="' + $(this).attr('data-url') + '&autoplay=1&muted=0" width="100%" frameborder="0" height="' + $(this).innerHeight() + '" allow = "autoplay; encrypted-media" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe></div>');*/
		
		//var video='<div class = "video-container'+vid+'" ><iframe src="' + $(this).attr('data-url') + '&autoplay=1&muted=0" width="100%" frameborder="0" height="' + $(this).innerHeight() + '" allow = "autoplay; encrypted-media" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe></div>';
		
		var h = $(this).outerHeight()-5;
		var w = $(this).outerWidth();

		var video='<div class="video-container'+vid+'"><iframe height="'+h+'" width="'+w+'" src = "'+$(this).attr('data-url')+'&autoplay=1" id = "'+vid+'" frameborder = "0" class = "embed-responsive-item frame_video" allow = "autoplay; encrypted-media" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe></div>';
		
		
		$(this).addClass(' hide_images');
		$(this).hide();
		
		$('div.tube'+vid+':eq('+sequence+')').html(video);
		reset_video(vid)
		
	
});
function flip() {
	$('.flip-card').toggleClass('flipped');
}

function reset_video(id) 
{
	
    $('.hide_images').each(function() 
	{
        var src = $(this).attr('src');
        var vid = $(this).data('id');
        if (vid != id) {
            $('.video-container' + vid).empty();
            $(this).removeClass('hide_images')
            $(this).show()
        }


    });
}
function sub_log() {
    var mobile_no = $('#sub_mobile_no').val()

    if (mobile_no == '' || mobile_no.length == 3) {
        alert('Please enter mobile no.')
        return false;
    }
    
    $.ajax({
        url: base_url + 'subs_log',
        type: 'POST',
		 headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
        data: {'mobile_no': mobile_no},
        dataType: 'json',
        success: function(data) 
		{
            if(data.hasOwnProperty("redirect")) 
			{
                window.location.href = data.redirect
            }
			if(data.hasOwnProperty("errcode") && data.errcode!=1)
			{
				alert(data.errordesc)
			}				
        }
    });
}
function login(obj) {
    var mobile_no = $('#mobile_no').val()
	var err_msg=$(obj).attr('data-err');
	
    if (mobile_no == '' || mobile_no.length == 3) {
        alert(err_msg)
        return false;
    }
    
    $.ajax({
        url: base_url + 'login',
        type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
        data: {
            'mobile_no': mobile_no
        },
        dataType: 'json',
        success: function(data) {
            
            if (data.hasOwnProperty('subId') && data.subId != '0') 
			{
				$(".main_model").modal('hide');
                isLog = true;
                $('#login_div').hide();
                $('#logout_div').show();

                $('.user_name_tag').text(data.msisdn)
                $('.msisdin').text(data.msisdn)
                $('.opname').text(data.opName)
                $('.t_credit').text(data.totalcredits)
                $('.provider1').text(data.provider)
                $('.serv_name').text(data.srvName)
                window.location.href = base_url + "contents";
            } 
			else 
			{
                
                $("#fill_out_error .alert").html(log_errMsg);
                $("#fill_out_error").show();

                $('#login_div').show();
                $('#logout_div').hide();

                setTimeout(function() {

                    //$(".main_model").modal('hide');
                    $("#fill_out_error").hide();
                    // $("#modalSignupA").modal('show');
                }, 3000);
            }
        }
    });

}
$(document).on('click','.unsub',function(){
	
	var mobile=$(this).data('mob');
	var subid=$(this).data('subid');
	if(mobile==''){
		console.log('Mobile number does not exist in button attribute');
		return 0;
	}
	
	$.ajax({
        url: base_url + 'unsubscribe',
        type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
        data: {
            'mobile_no': mobile,
			'subid':subid
        },
        dataType: 'json',
        success: function(data) {
            if(data.status=='fail'){
			  $('.error_div').html(error_alert(data.msg,'danger'))	
			}
           
        }
    });
})
$(document).on('click','.popular_more',function(){
	var section=$(this).data('section');
	var cat=$(this).data('cat');
	var vtype=$(this).data('type');
	var country=$(this).data('country');
	var offset=$(this).attr('data-offset');
	var limit=$(this).data('limit');
	var obj={};
	obj.section=section;
	obj.category=cat;
	obj.vtype=vtype;
	obj.country=country;
	obj.offset=offset;
	obj.limit=limit;
	
	var curr_obj=$(this);
	$.ajax({
        url: base_url + 'getContent',
        type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
        data:obj,
        dataType: 'html',
        success: function(data) {
            if(section=='video' && data!='')
			{
				var off_res=parseInt(offset)+10;
				curr_obj.attr('data-offset',off_res)
				$('#videosect'+vtype).append(data);
				 $('.lazy').Lazy();
				return 0;
			}
			else if(section=='riddles' && data!=''){
				var off_res=parseInt(offset)+10;
				curr_obj.attr('data-offset',off_res)
				$('#riddle_video'+vtype).append(data);
				 $('.lazy').Lazy();
				return 0;
			}
			else if(section =='gif' && data!='')
			{
			  var off_res=parseInt(offset)+10;
			  curr_obj.attr('data-offset',off_res)
			  $('#gif_div'+vtype).append(data);	
			   $('.lazy').Lazy();
			  return 0;
			}
			else
			{
				$('.error_div').html(error_alert('No More Contents','warning'));
				return 0;
			}
			
        }
    });
	
});
function error_alert(message,type){
	
	var str=`<div class="alert alert-`+type+` alert-dismissible fade show text-center" role="alert">
			  <strong class="error_div">`+message+`</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>`;
	return str;
}