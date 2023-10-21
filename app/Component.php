<?php
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http; 
 
 function gifHtml($data,$isLi=NULL,$isColumn){
	$isLogin=(Session::has('user_login')) ? 'display:none' : '';

	if(empty($data)){
        return '';
		return '<h3>No Data Found</h3>';
	}
	$str='';

	$liOpen=($isLi!=NULL)? '<li>' : '';
	$liClose=($isLi!=NULL)? '</li>' : '';

    $columnOpen=($isColumn!=NULL)? '<div class="col-md-3 p-2">' : '';
    $columnClose=($isColumn!=NULL)? '</div>' : '';
    $columnImgClass=($isColumn!=NULL)? 'video-img w-100' : 'video-img';

	$i=0;
	foreach($data as $v)
    {
      
      $isLogin=($i<1) ? 'display:none'  : '';
      $str.=$columnOpen.$liOpen.'<div class="card">
            <div class="card-body p-0">
                 <form action="'.url("download_gif").'" method="post" class="gif_frm">
                 <input type="hidden" value="'.$v['video_poster'].'" name="url">
                 '.csrf_field().'
                 
                <div class="video-box gif-box">
                    <img data-src="'.$v['video_poster'].'" class="lazy gif lazyload gif_img_tag s">
                    <div class="gif-black-glass-wrap">
                        <small class="text-white gif_name">'.$v['video_title'].'</small>
                        
                        <i class="fa fa-download gif_btn gif-overlayContainer" aria-hidden="true" style="color:white; '.$isLogin.'"></i>
                        
                    </div>
                </div>
                  </form>
            </div>
        </div>'.$liClose.$columnClose;

        $i++;
      }
    return $str;
}
function videoHtml($full_video,$isLi=NULL,$isColumn=NULL)
{
	if(empty($full_video)){
        return '';
		return '<h3>No Data Found</h3>';
	}

	 $isLogin=(Session::has('user_login')) ? 'display:none' : '';
	 $isEnable=(Session::has('user_login')) ? 'false' : 'true';
     $isLock=(Session::has('user_login')) ? '' : 'lock';
	 $str='';

	 $liOpen=($isLi!=NULL)? '<li>' : '';
	 $liClose=($isLi!=NULL)? '</li>' : '';
     $attr=($isLi!=NULL)? 'firstPage':'';
     $columnOpen=($isColumn!=NULL)? '<div class="col-md-4 p-2">' : '';
     $columnClose=($isColumn!=NULL)? '</div>' : '';
     $columnImgClass=($isColumn!=NULL)? 'video-img w-100' : 'video-img';

	 $i=0;
	foreach($full_video as $v)
    {
        if(Session::has('user_login'))
        {
          $isLogin='display:none';  
        }
        else
        {
          $isLogin=($i<2) ? 'display:none'  : '';  
        }
      

      $rnum=rand(1000,9999);
      $v['id']=$v['id'].$rnum;
      /*echo '<pre>';
      print_r($v);*/
      $str.=$columnOpen.$liOpen.'<div class="card">
                <div class="card-body p-0">
                    <div class="video-box '.$isLock.'">
                        <img data-id="'.$v['id'].'" data-url="https://player.vimeo.com'.$v['video_file'].'?api=1" data-src="'.$v['video_poster'].'" data-page="'.$attr.'" class="lazy '.$columnImgClass.'" unlock="'.$isEnable.'" alt="">
                        <div class="tube'.$v['id'].'" id="tub_'.$v['id'].'"></div>
                        <div  class="text-center overlay" style="'.$isLogin.'">
                            <img data-src="'.env("ASSETS_URL").'assets/images/lock.png" class="lazy text-center pt-5" style="width: 80px; margin: 0 auto;" >
                        </div>
                    </div>
                </div>
                <div class="card-footer px-2 pt-0 pb-0 mt-2">
                    <div class="video-title">
                        '.$v['video_title'].'
                    </div>
                    <div class="video-attribute">
                        <p><img data-src="'.env("ASSETS_URL").'assets/images/view.png" alt="" class="lazy"> '.$v['views'].' 
                          '.__("label.views").'
                         <img data-src="'.env("ASSETS_URL").'assets/images/like.png"
                                alt="" class="lazy"> '.$v['likes'].' '.__("label.likes").' </p>
                    </div>
                </div>
            </div>'.$liClose.$columnClose;
      /*$str.='<div class="col-12 col-md-6 col-lg-4  mt-2 px-2">
                <div class="funny-videos">
                    <div class="'.$isLogin.'">
                        <div class="" style="min-height:200px;">
                           <img data-id="'.$vid_custome_id.'" data-url="https://player.vimeo.com'.$v->video_file.'?api=1" src="'.$v->video_poster.'" class="img-fluid slider-img more_img etc">
                           <div class="video-time-detail font-number">'.$v->duration.'</div>
                           <div class="tube'.$vid_custome_id.'"></div>
                            
                        </div>
                        <div class="play-details">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h4 class="name originaltext">'.$v->video_title.'</h4>
                                    <div class="d-flex align-items-center time">
                                        <img src="'.env("ASSETS_URL").'assets/img/view.png">
                                        <span><span class="font-number">'.$v->views.'</span> Views</span>
                                        <img src="'.env("ASSETS_URL").'asets/img/like.png" class="ml-3">
                                        <span><span class="font-number">'.$v->likes.'</span> Likes</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <img src="'.env("ASSETS_URL").'assets/img/padlock_PNG9406.png" class="playbtn">
                        <!-- <h4 class="name hovertext">'.$v->video_title.'</h4> -->
                    </div>
                </div>
            </div>';*/

        $i++;    
      }
      return $str;
}
function temerscondition_html($data){
	
	$precyle=(isset($data['percycle']))?$data['percycle'] : '';
	$cost=(isset($data['cost']))? $data['cost'] :'';
	$ccy=(isset($data['ccy']))? $data['ccy'] : '';
    $language=getLang();
    $dir_text_alig=($language=='ar')? 'text-right' : 'text-left';
	$str="<ul class='footnotes-point op_desc ".$dir_text_alig."'>
		<li>By subscribing to the service, you are accepting all Terms & Conditions of the service & authorize <b>".$precyle."</b> to share your mobile number with our partner, who manages this subscription service. Subscription would be automatically renewed and your account would be debited with <b>".$ccy.' '.$cost." / ".$precyle."</b></li>
		<li> until you unsubscribe. You can unsubscribe on the <b>My Account</b></li>
		<li> page of this portal at any time.<br>Data charges apply for browsing & downloading contents on this portal.</li>
		<li>If you are sharing your mobile internet, you are responsible for the actions of the third party whom you are sharing your mobile internet with including but not limited to activation of the above services.</li>
		<li>If you are using a data SIM to opt for this service, your data SIM will be charged for this service.</li>";
	return $str;
}

 function mainLeft_Videocomponent($data,$obj){

 	$str='<div class="container pt-4">
            <div class="row">
                
                <div class="col-md-9 pr-0 pr-lg-5">
                    <ul id="lightSlider" class="lightSlider">
                        
                          '.videoHtml($data,"true").'
                        
                        
                    </ul>
                </div>
                <div class="col-12 col-lg-3 p-0 d-none d-sm-block">
                    <h2 class="cust-border videos-title b-bottom">'.$obj["head_title"].'</h2>
                    <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                    <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-12 col-lg-9">
                    <div class="d-flex align-items-center justify-content-center pr-0 pr-lg-5">
                        <a class="goToSlide" id="goToSlide0"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy prevarrow mr-5 mr-lg-3 owlarrow"></a>
                        <a class="goToPrevSlide" id="goToPrevSlide0"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy nextarrow owlarrow"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 pb-5 p-0 d-block d-sm-none text-center">
                <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
            </div>
        </div>';
        return $str;

 }
 function mainRight_Videocomponent($data,$obj){

 	$str='<div class="container pt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3 mt-lg-5 mb-3 pt-0 pt-lg-5 text-center d-block d-lg-none b-bottom">
                        <label class="vm-title">'.$obj["head_title"].'</label>
                    </div>
                </div>
                <div class="col-12 col-lg-3 p-0 d-none d-sm-block">
                    <h2 class="cust-border videos-title b-bottom">'.$obj["head_title"].'</h2>
                    <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                    <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
                </div>
                <div class="col-md-9 pr-0 pr-lg-5">
                    <ul id="lightSlider2" class="lightSlider">
                       
                          '.videoHtml($data,"true").'
                       
                    </ul>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-12 col-lg-9 offset-lg-3">
                    <div class="d-flex align-items-center justify-content-center pr-0 pr-lg-5">
                        <a class="goToSlide" id="goToSlide2"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy prevarrow mr-5 mr-lg-3 owlarrow"></a>
                        <a class="goToPrevSlide" id="goToPrevSlide2"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy nextarrow owlarrow"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 pb-5 p-0 d-block d-sm-none text-center">
                <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
            </div>
        </div>';
        return $str;
 }
 function mainLeft_Gifcomponent($data,$obj){
 	$str='<div class="container pt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3 mt-lg-5 mb-3 pt-0 pt-lg-5 text-center d-block d-lg-none b-bottom">
                        <label class="vm-title">'.$obj["head_title"].'</label>
                    </div>
                </div>
                
                <div class="col-md-9 pr-0 pr-lg-5">
                    <ul id="lightSlider3" class="lightSlider">
                         
                          '.gifHtml($data,"true",NULL).'
                        
                    </ul>
                </div>
                <div class="col-12 col-lg-3 p-0 d-none d-sm-block">
                    <h2 class="cust-border videos-title b-bottom">'.$obj["head_title"].'</h2>
                    <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                    <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-12 col-lg-9">
                    <div class="d-flex align-items-center justify-content-center pr-0 pr-lg-5">
                        <a class="goToSlide" id="goToSlide3"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy prevarrow mr-5 mr-lg-3 owlarrow"></a>
                        <a class="goToPrevSlide" id="goToPrevSlide3"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy nextarrow owlarrow"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 pb-1 p-0 d-block d-sm-none text-center">
                <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
            </div>
        </div>';
 	return $str;
 }
 function mainRigth_Gifcomponent($data,$obj){

 	$str='<div class="container pt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-3 mt-lg-5 mb-3 pt-0 pt-lg-5 text-center d-block d-lg-none b-bottom">
                        <label class="vm-title">'.$obj["head_title"].'</label>
                    </div>
                </div>
                
                
                <div class="col-12 col-lg-3 p-0 d-none d-sm-block">
                    <h2 class="cust-border videos-title b-bottom">'.$obj["head_title"].'</h2>
                    <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                    <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
                </div>
                <div class="col-md-9 pr-0 pr-lg-5">
                    <ul id="lightSlider3" class="lightSlider">
                         
                          '.gifHtml($data,"true",NULL).'
                        
                    </ul>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-12 col-lg-9">
                    <div class="d-flex align-items-center justify-content-center pr-0 pr-lg-5">
                        <a class="goToSlide" id="goToSlide3"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy prevarrow mr-5 mr-lg-3 owlarrow"></a>
                        <a class="goToPrevSlide" id="goToPrevSlide3"><img data-src="'.asset('assets/images/icons/right-arrow.png').'" class="lazy nextarrow owlarrow"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 pb-1 p-0 d-block d-sm-none text-center">
                <h4 class="sub-title">'.$obj["head_desc"].'</h4>
                <a href="'.$obj["btn_link"].'" class="btn btn-xl mt-3">'.$obj["btn_title"].'</a>
            </div>
        </div>';
 	return $str;

 }
?>