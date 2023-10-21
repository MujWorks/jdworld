@php
  $margin_icon=($language=='ar')? '0' : '2';
  $border_line=($language=='ar')? 'border-right' : '';
  $url=config('global.url');
@endphp
<footer class="footer mt-3r" dir="@php echo ($language=='ar')? 'rtl' : 'ltr' ; @endphp">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-none d-sm-block">
                <div class="text-center pt-3">
                    <a href="{{$url}}"><img class="lazy img-responsive mb-2 footer-logo" data-src="{{asset('assets/images/logo.webp')}}"></a>
                    <h3 class="mb-0 footer-heading text-center">{{__('label.cwu')}}</h3>
                </div>
                <div class="d-block d-lg-flex align-items-center justify-content-center mt-4 mb-3 mb-lg-0 eng-lang">
                    <div class="mb-3 mb-lg-0">
                        <a href="{{config('global.google_link')}}" class="mr-2" target="_blank">
                            <img data-src="{{asset('assets/images/icons/googleplay.svg')}}" class="lazy img-fluid foot-img-fluid">
                        </a>
                        <a href="{{config('global.ios_link')}}" class="mr-0 mr-lg-3" target="_blank">
                            <img data-src="{{asset('assets/images/icons/playstore.svg')}}" class="lazy img-fluid foot-img-fluid">
                        </a>
                    </div>
                    <div class="mr-2">
                        <a href="{{config('global.social_link.youtube')}}" target="_blank" class="footer-social mr-2">
                              <font color="grey"><i class="fa fa-youtube-square" style="font-size:36px"></i></font>
                          </a>
                        <a href="{{config('global.social_link.insta')}}" target="_blank" class="footer-social mr-{{$margin_icon}}">
                            <font color="grey"><i class="fa fa-instagram" style="font-size:36px"></i></font>
                        </a>
                        <a href="{{config('global.social_link.facebook')}}" target="_blank" class="footer-social">
                            <font color="grey"><i class="fa fa-facebook-square" style="font-size:36px"></i></font>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 m-view-wrap d-block d-sm-none">
                <div class="text-center">
                    <!-- <a href="{{$url}}"><img class="lazy img-responsive mb-2 footer-logo" data-src="{{asset('assets/images/logo.webp')}}"></a> -->
                </div>
            </div>
            <div class="col-6 m-view-wrap d-block d-sm-none">
                <div class="d-block d-lg-flex align-items-center justify-content-center eng-lang">
                    <!-- <h3 class="mb-0 footer-heading text-center">{{__('label.cwu')}}</h3> -->
                </div>
            </div>
            <div class="col-12 m-view-wrap d-block d-sm-none">
                <div class="d-flex">
                    <a href="{{config('global.google_link')}}" class="mr-2" target="_blank">
                        <img data-src="{{asset('assets/images/icons/googleplay.svg')}}" class="lazy img-fluid foot-img-fluid">
                    </a>
                    <a href="{{config('global.ios_link')}}" class="mr-0 mr-lg-3" target="_blank">
                        <img data-src="{{asset('assets/images/icons/playstore.svg')}}" class="lazy img-fluid foot-img-fluid">
                    </a>
                    <div class="{{$dir_foot_class1}} w-50">
                        <a href="{{config('global.social_link.youtube')}}" target="_blank" class="footer-social mr-2">
                            <font color="grey"><i class="fa fa-youtube-square"></i></font>
                        </a>
                        <a href="{{config('global.social_link.insta')}}" target="_blank" class="footer-social mr-{{$margin_icon}}">
                            <font color="grey"><i class="fa fa-instagram"></i></font>
                        </a>
                        <a href="{{config('global.social_link.facebook')}}" target="_blank" class="footer-social">
                            <font color="grey"><i class="fa fa-facebook-square"></i></font>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-12 mt-3 text-center">
                <a href="{{url('about')}}" class="border-right footer-link">{{__('label.about')}}</a>
                <a href="{{url('faq')}}" class="border-right footer-link">{{__('label.faq')}}</a>
                <a href="mailto:info@taiftec.com" class="{{$border_line}} footer-link">{{__('label.contact_us')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <hr>
                <div class="footer-copyright  mt-0">{{__('label.policy_desc')}}</div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
  $(document).ready(function(){
    $('.lazy').Lazy();
  })
  $(document).on("scroll", function(){
    if($(document).scrollTop() > 86)
    {
      $(".header_row_div").addClass("shrink");
    }
    else
    {
      $(".header_row_div").removeClass("shrink");
    }
   });
</script>