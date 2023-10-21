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
  $lbl_left=($language=='ar')? 'left' : 'right';
@endphp
<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/myaccount.css') !!}">
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
  <section class="fsection">
        <div class="container pt-3 pl-0 mb-0">
            <div class="row mt-4">
                <div class="col-12">
                   <a href="{{$url}}"><img class="img-responsive logo lazy" data-src="{!! asset('assets/images/logo.webp') !!}"></a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section2">
      <div class="container pb-5">
                    
            <div class="container h-100 d-flex justify-content-center">
               <div class=" col-md-6 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 login-image-main text-center">
                  <div class=" d-lg-none text-left mt-1">
                     <!-- <a onclick="goback()" > -->
                     <a href="{{$url}}" class="heading-link login_btn mr-3" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Back">
                        <!-- <i class="fa fa-user-o"></i> -->
                         <img src="{!! asset('assets/images/icons/Next.png') !!}" class="log_icons back_icon">
                     </a>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <div class="d-none d-lg-block text-left mt-1">
                           <a href="{{$url}}" class="heading-link  mr-3" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Back">
                              <!-- <i class="fa fa-user-o"></i> -->
                               <img src="{!! asset('assets/images/icons/Next.png') !!}" class="log_icons back_icon">
                           </a>
                        </div>
                        <h3 class="text-white">{{__('label.my_acc')}}</h3>
                     </div>
                     <div class=" col-sm-12 col-xs-12 d-flex justify-content-center mb-2">
                        <div class="user-image-section ">
                        </div>
                        <!-- <img src="https://www.nicesnippets.com/demo/businessman.png"> -->
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 user-login-box">
                        <div class=" frm_lbl text-white" role="alert">
                           <label class="form-control first_lbl  frm_lbl {{$dir_text_alig}}" style="color:#fff200;" data-text="">{{__('label.mobile_number')}} : 
                             @php echo (isset($acc) && isset($acc['mobile_no']))? $acc['mobile_no']: ''; @endphp
                            <i class="fa fa-check-circle" aria-hidden="true" style="float: {{$lbl_left}}"></i>
                           </label>
                        </div>
                        <div class="form-group">
                        </div>
                        <label class="form-control text-white frm_lbl {{$dir_text_alig}}">{{__('label.Sub_date')}} : 
                            @php echo (isset($acc) && isset($acc['subDate']))? date('Y-m-d',strtotime($acc['subDate'])): ''; @endphp
                        </label>
                        <div class="form-group">
                        </div>
                        <label class="form-control text-white frm_lbl {{$dir_text_alig}}">{{__('label.renewal_date')}}: 
                            @php echo (isset($acc) && isset($acc['renewal']))? date('Y-m-d',strtotime($acc['renewal'])): ''; @endphp
                        </label>
                        <div class="form-group">
                        </div>
                        <label class="form-control text-white frm_lbl {{$dir_text_alig}}">{{__('label.credit')}} : 
                            @php echo (isset($acc) && isset($acc['creditsAvailable']))? $acc['creditsAvailable']: 0; @endphp
                        </label>
                        <div class="form-group">
                        </div>
                        <label class="form-control text-white frm_lbl {{$dir_text_alig}}">{{__('label.service_cost')}} : 
                            @php echo (isset($acc) && isset($acc['srvcost']))? $acc['srvcost']: ''; @endphp
                        </label>
                        <div class="form-group">
                        </div>
                        <a data-subid="@php echo (isset($acc) && isset($acc['sub_id']))? $acc['sub_id']: ''; @endphp" data-mob="@php echo (isset($acc) && isset($acc['mobile_no']))? $acc['mobile_no']: ''; @endphp"  class="btn btn-defualt unsub">{{__('label.unsubscribe')}}</a>
                     </div>
                     <div class="col-md-12">
                         <div class="error_div">
                             
                         </div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 last-part">
                        <a href="@php echo (isset($acc) && isset($acc['opid']))? url('terms/'.$acc['opid']): ''; @endphp"><u>{{__('label.tfu')}}</u></a>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </section>
@include('include.footer')

<body>
</html>