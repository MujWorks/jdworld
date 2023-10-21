<!DOCTYPE html>
<html>
@include('include.header')
@include('include.footer_link')

@php
  $dir=($language=='ar')? 'rtl' : 'ltr';
  $dir_col=($language=='ar')? 'col-6 text-right' : 'col-6';
  $dir_col1=($language=='ar')? 'col-6' : 'col-6 text-right';
  $dir_foot_class1=($language=='ar')? '' : 'text-right';
  $dir_text_alig=($language=='ar')? 'text-right' : 'text-left';
@endphp
<body>
  <section class="section-detail">
        @if(Session::has('user_login'))
            @include('include.header_section_rtl')
          @else
            @include('include.header_section')
        @endif
        <div class="container px-5 pt-3">
            <div class="row mt-5 pt-3 mb-5 d-none d-lg-flex">
                <div class="col-md-12 text-center">
                    <h1 class="detail-heading">{{__('label.best_unlimited')}} <br>{{__('label.fvrg')}}</h1>
                </div>
            </div>
        </div>
        <div class="container mt-5 pb-5">
            <div class="row">
                <div class="col-12 px-0 px-lg-3 overflow-hidden overflow-lg-auto">
                    <ul class="nav nav-pills nav-fill text-center" id="pills-tab" role="tablist" dir="{{$dir}}">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#home">
                                <img src="./images/funny-video.png" alt="" class="d-block mb-3 mx-auto">
                                {{__('label.funny_videos')}}
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#riddle">
                                <img src="./images/riddle.png" alt="" class="d-block mb-3 mx-auto">
                                {{__('label.riddles')}}
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#gif">
                                <img src="./images/gif.png" alt="" class="d-block mb-3 mx-auto">
                                {{__('label.gifs')}}
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active">
                            <div class="row mt-5 mb-5 mb-lg-3 align-items-center">
                                <div class="col-6 d-none d-md-block">
                                    <div class="Popular_Video">{{__('label.popular_video')}}</div>
                                </div>
                                <div class="col-12 col-md-6 text-left text-md-right">
                                    <select class="funnytabdropdown">
                                        <option value="popular">{{__('label.popular_video')}}</option>
                                        <option value="recent">{{__('label.recent_video')}}</option>
                                        <option value="all">{{__('label.all_video')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="popular-vid" class="common-tab popular">
                                <div class="row" id="videosect1">
                                    @if(isset($video) && !empty($video))
                                      {!!videoHtml($video['Popular'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="video" data-cat="1" class="text-dark btn btn-sm d-lg-block mr-3 popular_more"  data-type="1" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                            <div id="recent-vid" class="common-tab recent">
                                <div class="row" id="videosect2">
                                    @if(isset($video) && !empty($video))
                                      {!!videoHtml($video['Recent'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="video" data-cat="1" class="btn btn-outline-danger popular_more"  data-type="2" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                            <div id="all-vid" class="common-tab all">
                                <div class="row" id="videosect3">
                                    @if(isset($video) && !empty($video))
                                      {!!videoHtml($video['jdPicks'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="video" data-cat="1" class="btn btn-outline-danger popular_more"  data-type="3" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="riddle" class="container tab-pane fade">
                            <div class="row mt-5 mb-5 mb-lg-3 align-items-center">
                                <div class="col-6 d-none d-md-block">
                                    <div class="Popular_Video_riddle riddles">Popular Riddles</div>
                                </div>
                                <div class="col-12 col-md-6 text-left text-md-right">
                                    <select class="riddletabdropdown">
                                        <option value="popular_rid">Popular Riddles</option>
                                        <option value="recent_rid">Recent Riddles</option>
                                        <option value="all_rid">All</option>
                                    </select>
                                </div>
                            </div>
                            <div id="popular-rid" class="common-tab-rid popular_rid">
                                <div class="row" id="riddle_video1">
                                    @if(isset($riddles) && !empty($riddles))
                                      {!!videoHtml($riddles['Popular'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="riddles" data-cat="2" class="btn btn-outline-danger popular_more"  data-type="1" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                            <div id="recent-rid" class="common-tab-rid recent_rid">
                                <div class="row" id="riddle_video2">
                                   @if(isset($riddles) && !empty($riddles))
                                      {!!videoHtml($riddles['Recent'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="riddles" data-cat="2" class="btn btn-outline-danger popular_more"  data-type="2" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                            <div id="all-rid" class="common-tab-rid all_rid">
                                <div class="row" id="riddle_video3">
                                    @if(isset($riddles) && !empty($riddles))
                                      {!!videoHtml($riddles['jdPicks'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="riddles" data-cat="2" class="btn btn-outline-danger popular_more"  data-type="3" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div id="gif" class="container tab-pane fade">
                            <div class="row mt-5 mb-5 mb-lg-3 align-items-center">
                                <div class="col-6 d-none d-md-block">
                                    <div class="gif-heading">TRENDING GIF'S</div>
                                </div>
                                <div class="col-12 col-md-6 text-left text-md-right">
                                    <select class="giftabdropdown">
                                        <option value="trending_gif">Trending gif's</option>
                                        <option value="recent_gif">Recent gifs</option>
                                        <option value="all_gif">All</option>
                                    </select>
                                </div>
                            </div>
                            <div id="trending-gif" class="common-tab-gif trending_gif">
                                <div class="row" id="gif_div1">
                                   @if(isset($gif) && !empty($gif))
                                      {!!gifHtml($gif['Popular'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="gif" data-cat="3" class="btn btn-outline-danger popular_more"  data-type="1" data-country="{{$country}}" data-offset="20" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                            <div id="recent-gif" class="common-tab-gif recent_gif">
                                <div class="row" id="gif_div2">
                                    @if(isset($gif) && !empty($gif))
                                      {!!gifHtml($gif['Recent'],NULL,'true')!!}
                                    @endif
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="gif" data-cat="3" class="btn btn-outline-danger popular_more"  data-type="2" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                            <div id="all-gif" class="common-tab-gif all_gif">
                                <div class="row" id="gif_div3">
                                     @if(isset($gif) && !empty($gif))
                                      {!!gifHtml($gif['jdPicks'],NULL,'true')!!}
                                    @endif
                                    
                                </div>
                                <div class="row">
                                   <div class="col-12 col-md-12 mt-2">
                                      <center>
                                         <button type="button" data-section="gif" data-cat="3" class="btn btn-outline-danger popular_more"  data-type="3" data-country="{{$country}}" data-offset="13" data-limit="6" data-loading-text="Loading...">{{__('label.load_more')}}
                                         </button>
                                      </center>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row pt-2"> 
                           <div class="col-md-12 error_div">
                               
                           </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('include.footer')
<script>
        /*$(document).on('click', '.video-img', function () {
            if ($(this).attr('unlock') == "true") {
                $(this).parent().html('<iframe src="' + $(this).attr('data-url') + '" width="100%" frameborder="0" height="' + $(this).innerHeight() + '" ></iframe>');
            }
        })*/
        $(window).ready(function(){
            if(location.hash != ''){
                // setTimeout(function(){
                 $('a[href="'+location.hash+'"]').tab('show')
                // }, 3000);
            }
        })
        $(function() {
            $('#recent-vid').hide();
            $('#all-vid').hide();
            $('#recent-rid').hide();
            $('#all-rid').hide();
            $('#recent-gif').hide();
            $('#all-gif').hide();
            $(".funnytabdropdown").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    var selected = $('.funnytabdropdown option:selected').val();
                    $(".Popular_Video").text(selected +' VIDEOS');
                    if(optionValue){
                        $(".common-tab").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else{
                        $(".common-tab").hide();
                    }
                });
            }).change();

            $(".riddletabdropdown").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    var selected = $('.riddletabdropdown option:selected').html();
                    $(".riddles").text(selected);
                    if(optionValue){
                        $(".common-tab-rid").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else{
                        $(".common-tab-rid").hide();
                    }
                });
            }).change();

            $(".giftabdropdown").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    var selected = $('.giftabdropdown option:selected').html();
                    $(".gif-heading").text(selected);
                    if(optionValue){
                        $(".common-tab-gif").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else{
                        $(".common-tab-gif").hide();
                    }
                });
            }).change();
        });
    </script>
<body>
</html>