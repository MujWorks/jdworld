<!DOCTYPE html>
<html>
@include('include.header')
@include('include.footer_link')

@php
  $dir=($language=='ar')? 'rtl' : 'ltr';
  $dir_col=($language=='ar')? '0 pr-5' : '6';
  $dir_foot_class1=($language=='ar')? '' : 'text-right';
  $dir_text_alig=($language=='ar')? 'text-right' : 'text-left';
  $url=config('global.url');

  $log_err_msg=($language=='ar')?config('global.login_error_msg_ar'):config('global.login_error_msg_eng');
@endphp
<script type="text/javascript">
    var log_errMsg='{{$log_err_msg}}';
</script>
<body>
    
<section class="section-home mb-5">
        <div class="container pb-5">
            @if($language=='ar')
                @include('include.header_section_rtl')
              @else
                @include('include.header_section')
            @endif
            
            <style type="text/css">
                .signUp-link{
                    display: none !important;
                }
            </style>
            <div class="row pt-5 ">
                <div class="col-md-12 mt-5">
                    <div class="cust-center">
                        <h2 class="text-center login-title-text">{{__('label.best_unlimited')}}</h2>
                        <h2 class="text-center login-title-text">{{__('label.fvrg')}}</h2>
                    </div>
                    @if(!Session::has('user_login'))
                    <div class="d-flex justify-content-center " dir="{{$dir}}">
                        <div class="mt-2 input-group col-md-5 ml-1 row text-center">
                            <div class="card-container manual-flip">
                                <div id="card" class="flip-card"> 
                                    <div class="front"> 
                                        <form class="form-signin" action="#">
                                            <div class="form-group {{$dir_text_alig}}">
                                                <label class="">{{__('label.emn')}}</label>
                                                <input class="form-control" type="phone" id="mobile_no" name="{{__('label.emn')}}" required="" length="13" maxlength="13" value="{{$country}}" style="">
                                                <center><div id="fill_out_error" class="col-md-12 mt-2" style="display:none; padding: 9px 0 0 0;">
                                                   <span class="alert alert-danger"></span>
                                                </div></center>
                                            </div>
                                            <div class="log_btn_div">
                                                <button class="btn btn-block yellow-bg log_btn_y blog " data-err="{{__('label.pemn')}}" onclick="login(this)" id="log_btn" type="button">{{__('label.sign_in')}}</button>
                                            </div>
                                        </form>
                                        <div class="mt-2" style="font-size: 10px;">
                                            <p>{{__('label.dasn')}}
                                                <a href="javascript:void(0)" style="color:#fff200;" id="rotateCard" onclick="flip()" class="sg_btn">
                                                  {{__('label.sign_up')}}
                                               </a> 
                                                {{__('label.now')}}
                                            </p> 
                                        </div>
                                        <a href="{{config('global.google_link')}}" target="_blank" class="sharing-app mr-2 mr-md-3">
                                            <img data-src="{!! asset('assets/images/googleplay.png') !!}" class="lazy img-fluid s-icons">
                                        </a>
                                       <a href="{{config('global.ios_link')}}" class="sharing-app" target="_blank">
                                            <img data-src="{!! asset('assets/images/playstore.png') !!}" class="lazy img-fluid s-icons">
                                        </a>
                                    </div> 
                                    <div class="back">
                                        <p onclick="flip()"style="color:#fff200; font-family:rubik;float: left;cursor: pointer;position: absolute;">{{__('label.back')}}</p>
                                        <div class="card mt-3 tab-card" style="background: transparent;">
                                            <div class="card-header tab-card-header">
                                              <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">

                                                @if(isset($ops) && !empty($ops))
                                                  @php $i=0; @endphp
                                                  @foreach($ops as $row)
                                                    @php $isActive=($i==0)? 'active' : ''; @endphp
                                                    <li class="nav-item">
                                                        <a class="nav-link login-nav-link {{$isActive}}" id="one-tab{{$row['srvid']}}" data-toggle="tab" href="#one{{$row['srvid']}}" role="tab" aria-controls="One" aria-selected="true">{{$row['opname']}} JD @php (isset($row['cycle'])) ? $row['cycle'] : '' @endphp</a>
                                                    </li>

                                                    @php $i++; @endphp
                                                   @endforeach
                                                @endif
                                                
                                              </ul>
                                            </div>

                                            <div class="tab-content" id="myTabContent">

                                             @if(isset($ops) && !empty($ops))
                                              @php $ii=0; @endphp
                                              @foreach($ops as $row)
                                                @php $isActives=($ii==0)? 'active' : ''; @endphp       
                                                  <div class="tab-pane fade show {{$isActives}} p-3" id="one{{$row['srvid']}}" role="tabpanel" aria-labelledby="one-tab">
                                                    <div class="login-card-body">
                                                        <div class="">{{__('label.tss')}}</div>
                                                         @if($row['operator']==268)
                                                             <input class="form-control" type="phone" id="sub_mobile_no" name="sub_mobile_no" length="12" required=""  oninput="this.value = this.value.replace(/[^0-9]/g, "").replace(/(\..*)\./g,'.'$1'.')" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g,"").replace(/(\..*)\./g,'.'$1'.')" />
                                                             <button class="btn btn-block yellow-bg log_btn_y blog mt-2" id="log_btn" onclick="sub_log()" type="button">{{__('label.sub')}}</button>
                                                          @else
                                                            <h5 class="card-title op_desc_code_pink">{{$row['submo']}} to  
                                                        {{$row['subsc']}}</h5>  
                                                         @endif
                                                        <p class="card-text">Service Cost {{$row['cost']}} {{$row['ccy']}} per @php (isset($row['cycle'])) ? $row['cycle'] : '' @endphp </p>
                                                    </div>
                                                    {!!temerscondition_html($row)!!}         
                                                  </div>
                                                    @php $ii++; @endphp
                                                   @endforeach
                                                @endif  
                                             
                                            </div>
                                          </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="second-sec mt-5">
        <div class="row"> 
            <div class="col-md-12">
                <div class="px-5 pt-0 pb-0 text-center mt-5">
                    <h2 class="sub-heading">
                        {!! __('label.jopjw') !!}
                    </h2>
                </div>
                <div class="mt-0 mt-lg-5 mb-3 pt-0 pt-lg-5 text-center d-block d-lg-none b-bottom">
                    <!-- <label class="vm-title">Funny Videos</label> -->
                </div>
            </div>
        </div>
        @php
            $arr=array();
            $arr['head_title']=__('label.funny_videos');
            $arr['head_desc']=__('label.fvwttsl');
            $arr['btn_title']=__('label.view_all');
            $arr['btn_link']=url('contents');
            if(isset($video) && !empty($video)):
               if(isset($language) && $language=='ar'):
                 echo mainRight_Videocomponent($video,$arr);   
                elseif(isset($language) && $language=='en'):
                 echo mainLeft_Videocomponent($video,$arr);   
               endif; 
             
            endif;

        @endphp
    </section>

    <!-- <section class="second-sec">
        @php
            $arr=array();
            $arr['head_title']=__('label.urls');
            $arr['head_desc']=__('label.urtbssr');
            $arr['btn_title']=__('label.view_all');
            $arr['btn_link']=url('contents');
            if(isset($riddles) && !empty($riddles)):
              if(isset($language) && $language=='ar'):
                  //echo mainLeft_Videocomponent($riddles,$arr);

                elseif(isset($language) && $language=='en'):
                  //echo mainRight_Videocomponent($riddles,$arr);

              endif;

             
            endif;

        @endphp
    </section> -->

    <section class="second-sec">
        @php
            $arr=array();
            $arr['head_title']=__('label.exg');
            $arr['head_desc']=__('label.geelgc');
            $arr['btn_title']=__('label.view_all');
            $arr['btn_link']=url('contents');
            if(isset($gif) && !empty($gif)):

              if(isset($language) && $language=='ar'):
                  echo mainLeft_Gifcomponent($gif,$arr);

                elseif(isset($language) && $language=='en'):
                  echo mainLeft_Gifcomponent($gif,$arr);

              endif;
            endif;

        @endphp
    </section>
@include('include.footer')
<script type="text/javascript">
    
    $(document).ready(function() 
    {
        var slider1 = $('#lightSlider').lightSlider({
            easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
            speed:600,
            adaptiveHeight:true,
            item:1,
            slideMargin:10,
            loop:true,
            pager:false,
            autoWidth:true,
            adaptiveHeight:true,
            verticalHeight:500,
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:3,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:2,
                        slideMove:1
                      }
                }
            ]
        });
        // Second Slider
        var slider2 = $('#lightSlider2').lightSlider({
            easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
            speed:600,
            adaptiveHeight:true,
            item:1,
            slideMargin:10,
            loop:true,
            pager:false,
            autoWidth:true,
            adaptiveHeight:true,
            verticalHeight:500,
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:3,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:2,
                        slideMove:1
                      }
                }
            ]
        });
        // Third Slider
        var slider3 = $('#lightSlider3').lightSlider({
            easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
            speed:600,
            adaptiveHeight:true,
            item:1,
            slideMargin:10,
            loop:true,
            pager:false,
            autoWidth:true,
            adaptiveHeight:true,
            verticalHeight:500,
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:3,
                        slideMove:1,
                        slideMargin:6,
                      }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:2,
                        slideMove:1
                      }
                }
            ]
        });
        $('#goToSlide0').on('click', function () {
            slider1.goToPrevSlide();
        });
        $('#goToPrevSlide0').on('click', function () {
            slider1.goToNextSlide();
        });
        $('#goToSlide2').on('click', function () {
            slider2.goToPrevSlide();
        });
        $('#goToPrevSlide2').on('click', function () {
            slider2.goToNextSlide();
        });
        $('#goToSlide3').on('click', function () {
            slider3.goToPrevSlide();
        });
        $('#goToPrevSlide3').on('click', function () {
            slider3.goToNextSlide();
        });
    });


    </script>
<body>
</html>