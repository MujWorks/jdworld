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
  $div_collapse_float=($language=='ar')? 'left' : 'right';
  $rtl_arrow_style=($language=='ar')? 'transform:rotate(0deg)': '';
@endphp
<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/collapse.css') !!}">
<body>
<style type="text/css">
.panel-default>.panel-heading a:after {
    
    float:{{$div_collapse_float}} !important;
    
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
                            <!-- <i class="fa fa-user-o"></i> -->
                                    <img src="{!! asset('assets/images/icons/Next.png') !!}" style="{{$rtl_arrow_style}}" class="log_icons back_icon">

                                </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pb-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white text-center">{{__('label.faq')}}</h2>
                </div>
            </div>         
            <div class="row">
                <div class="col-12">
                    <div class="panel-group {{$dir_text_alig}}" id="accordion" data-default="1">
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              Q: How to subscribe to the service ?
                            </a>
                          </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                               <ul class="text-white list-unstyled">
                                    <li > You can subscribe to the service by just clicking on subscribe in Home page. </li>
                                    <li >Due to security reasons we follow strick PIN process to subscribe and authenticate users.</li>
                                        
                               </ul>
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Q: How to unsubscribe ?
                            </a>
                          </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                              <p class="text-white">When you select each operator you will see terms and conditons , you can unsubscribe based on your Mobile Network.</p>
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Q: How to Download or Stream Content ?
                            </a>
                          </h4>
                          </div>
                          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                              <p class="text-white">Login to the portal through PIN process to access and stream content.</p>
                            </div>
                          </div>
                        </div>
                        
                        <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                              Q: Content access Terms ?
                            </a>
                          </h4>
                          </div>
                          <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                              <p class="text-white">Please make sure that your browser is not using any 3rd-party blocking technologies and you have a healthy internet connection for swift access to the content</p>
                            </div>
                          </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('include.footer')
<body>
</html>