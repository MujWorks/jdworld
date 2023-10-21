 
 @php 
 $url=config('global.url');
 $dir=($language=='ar')? 'rtl' : 'ltr';
 @endphp
<nav class="fixed-top header_row_div">
        <div class="container">
            <!-- Header LTR -->
            <div class="row align-items-center">
                <div class="col-5">
                    <a href="{{$url}}"><img class="img-fluid logo" src="{!! asset('assets/images/logo.webp') !!}"></a>
                </div>
                <div class="col-7 text-right">
                    <div class="login_div">
                    @if(Session::has('user_login'))
                    
                        
                        <a href="{{url('logout')}}" class="heading-link mr-3" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Sign In">
                            <img class="log_icons" src="{!! asset('assets/images/icons/Logout.png') !!}">
                        </a>
                        <a href="{{url('myaccount')}}" class="my-account">
                            <img class="log_icons" src="{!! asset('assets/images/icons/My-Account.png') !!}">
                        </a>
                    
                     @else
                     
                      <a href="{{$url}}" class="text-dark btn btn-sm signUp-link d-none d-lg-block mr-3">{{__('label.sign_up_free')}}</a>
                      <a href="{{url('change_lang')}}" class="my-account" dir="{{$dir}}">
                        <i class="fa fa-globe mx-2" aria-hidden="true"></i>{{($language=='ar')?'EN':'عربي  '}}
                        
                     </a>  


                    @endif
                    
                    
                    </div>
                    
                </div>
                <!-- <div class="col-12 text-right">
                    <div class="d-block d-lg-none">
                        <div class="login_div">
                            <a href="https://jdworld.me/en/logout" class="heading-link" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Sign In">
                                <img src="https://jdworld.me/en/assets/img/icon/Next.png" class="log_icons">
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
           
        </div>
    </nav>