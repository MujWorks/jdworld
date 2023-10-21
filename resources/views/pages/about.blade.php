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
  $rtl_arrow_style=($language=='ar')? 'transform:rotate(0deg)': '';
@endphp
<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/aboutus.css') !!}">
<body>
<style type="text/css">
.log_icons{
  transform: rotate(180deg);
}
@media (max-width:768px)  
{
  footer{
    display: none;
  }
}
</style>
  <section>
        <div class="container pt-3 pl-0 mb-0">
            <div class="row mt-4">
                <div class="col-12 {{$dir_text_alig}}">
                   <a href="https://jdworld.me/en/myaccount" class="heading-link login_btn mr-3 " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="My Account">
                       <img src="{!! asset('assets/images/icons/Next.png') !!}" style="{{$rtl_arrow_style}}" class="log_icons back_icon">
                   </a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section2">
      <div class="container pb-5">
            <div class="row">
               <div class="col-12 text-center">
                    <a href="./"><img class="img-responsive logo lazy" data-src="{!! asset('assets/images/logo.webp') !!}"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center">{{__('label.about_us')}}</h2>
                </div>
            </div>         
            <div class="row">
                <div class="col-12">
                    <p class="text-white  abt_cont_text text-center">Best indian hindi jokes! All Jokes oreated by JOKES DHAMAKA.<br>We are posted best Hindi jokes there.<br>You just subscribe to our channel and enjoy a bounch of funny Indian Jokes! You oan visit our youtube channel</p>
                </div>
            </div>
        </div>
    </section>
@include('include.footer')

<body>
</html>