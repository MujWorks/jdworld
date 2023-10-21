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
  $dots_align=($language=='ar')? '68em !important;' : '-3.142857em'; 

@endphp
<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/terms.css') !!}">
<style type="text/css">
  .fa-li{
    left:{{$dots_align}}
 }
</style>
<body>
  <section class="sec0">
         @if($language=='ar')
                @include('include.header_section_rtl')
              @else
                @include('include.header_section')
            @endif
            
            @php
              $str='<ul class="fa-ul text-white">
                                      <li><span class="fa-li"><i class="fa fa-circle" aria-hidden="true"></i></span>Terms &amp; Conditions:Welcome to the UAE-Etisalat- JD Daily subscription service. You will subscribe to the service.</li>
                                      <li><span class="fa-li"><i class="fa fa-circle" aria-hidden="true"></i></span>As a mobile subscriber, you will receive weekly 3 jokes, costing 2.25 AED daily (5% VAT Included with the price).</li>
                                      <li><span class="fa-li"><i class="fa fa-circle" aria-hidden="true"></i></span>This is a subscription service active until you SMS "C JOKD" to 1111.</li>
                                      <li><span class="fa-li"><i class="fa fa-circle" aria-hidden="true"></i></span>To make use of this service you must be more than 18 years old or have received permission from your parents or person who is authorized to pay your bill.</li>
                                      <li><span class="fa-li"><i class="fa fa-circle" aria-hidden="true"></i></span>We work in accordance with the international code of conduct for SMS service.</li>
                                      
                                    </ul>';
            @endphp
        <div class="container ">
                  
                    <div class="row">
                        <div class="col-12 div_main {{$dir_text_alig}}">

                             <div class="d-flex align-items-center justify-content-center mt-0">
                                <h4 class="text-white $dir_text_alig">Free for 24 hours, then AED 2.25 per day, weekly 3 jokes. VAT Incl.</h4>
                             </div>
                            <div class="d-flex align-items-center justify-content-center mt-0">
                                <div class="d-lg-none">
                                    
                                     <!-- <a><img src="https://jdworld.me/en/assets//img/aboutus-v1.png" class="logo"></a> -->
                                   
                                    {!!$str!!}
                                </div>
                                <div class="d-none d-lg-block">
                                   <!-- <a><img src="https://jdworld.me/en/assets//img/about_us_full.png"  style="width: 270px;" class=""></a> -->
                                     {!!$str!!}
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <section class="mt">
        
    </section>
@include('include.footer')

<body>
</html>