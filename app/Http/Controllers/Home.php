<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;  

use Redirect;
use Log;
use Config;


class Home extends Controller
{
     
    public function __construct()
    {
       //$this->middleware('checkStatus');
        
    }
    public function index($country=NULL)
    {
        //SetCountry();
        //deleteCountry();
        //getCountry();
        $country_data=getCountry();
        if($country==NULL){
            SetCountry('uae');
        }
        //echo config('global.url');
        
        getCustom_url();
        $language=getLang();
        

        $arr=array();
        $arr['offset']=1;
        $arr['limit']=3;
        $arr['country']=$country_data['code'];
        $arr['op_info']='true';
        //key=>category and value=>media_type
        $arr['arr']=array('cat'=>array(1=>1,2=>1,3=>1));
        isAuthenticate();
        $token='';

        if(Session::has('auth_token'))
        {
           $token=Session::get('auth_token');     
        }
        if($token!='')
        {
          //$result=apiCurl('post',env('API_URL').'vLoadAllContent',$arr,['Usr' => 'jdwweb','X-Auth-Token' => $token]);  
          //dd($result);
          $result=Http::withHeaders(['Usr' => 'jdwweb','X-Auth-Token' => $token])->asForm()->post(env('API_URL').'vLoadAllContent',[$arr]);
          $res1=$result->json();
          
          /*$data['videos']=videoHtml($res1['video']);
          $data['riddles']=videoHtml($res1['riddles']);
          $data['gif']=gifHtml($res1['gif']);*/
          if(isset($res1['test']))
          {
            $res2=base64_decode($res1['test']);
            $res3=json_decode($res2,true);
            $res4=op_json_arr($res3);  
            $sort_arr=filter_keyby_arr($res4,$country_data['code']);
            $x=json_encode($res1);


              $data['video']=$res1['video'];
              $data['riddles']=$res1['riddles'];
              $data['gif']=$res1['gif'];
              $data['ops']=$sort_arr;
              $data['country']=$country_data['code'];
              $data['language']=$language;
          }
          else
          {
            $res1=NULL;
            $data['country']=$country_data['code'];
            $data['language']=$language;
          }
          
          app()->setLocale($language);
          
          return view('pages.main',$data);    
        }

    }
   public function content_page()
   {
     

     $language=getLang();
     $country_data=getCountry();

     getCustom_url();   
     //echo config('global.url');
     $arr=array();
     $arr['offset']=1;
     $arr['limit']=10;
     $arr['country']=$country_data['code'];
     //
     //key=>category and value=>media_type
     $arr['arr']=array('cat'=>array(1=>array(1,2,3),2=>array(1,2,3),3=>array(1,2,3)));
     $token='';

       if(Session::has('auth_token'))
       {
         $token=Session::get('auth_token');     
       }
       if($token!='')
       {
          $result=Http::withHeaders(['Usr' => 'jdwweb','X-Auth-Token' => $token])->asForm()->post(env('API_URL').'vLoadCustContent',[$arr]);
          $res1=$result->json();
          //dd($res1);
          $data['video']=$res1['video'];
          $data['riddles']=$res1['riddles'];
          $data['gif']=$res1['gif'];
          $data['country']=$country_data['code'];
          $data['language']=$language;
         
          app()->setLocale($language);
          
          return view('pages.content',$data);    
       }

     
   }
   public function faq_page(){

    $language=getLang();
    $country_data=getCountry();

    getCustom_url();

    $data['country']=$country_data['code'];
    $data['language']=$language;
    app()->setLocale($language);
    return view('pages.faq',$data);  
   }
   public function about_page(){

    $language=getLang();
    $country_data=getCountry();
    getCustom_url();
    $data['country']=$country_data['code'];
    $data['language']=$language;
    app()->setLocale($language);
    return view('pages.about',$data);  
   }
   public function accout_page(){

    $language=getLang();
    $country_data=getCountry();
    $url=getCustom_url();
    $data['country']=$country_data['code'];
    $data['language']=$language;

    if(!Session::has('user_login')){
        return Redirect::to('/');
    }
    app()->setLocale($language);
    $udata=Session::get('user_login');
    $data['acc']=$udata;
    $data['url']=$url;

    return view('pages.myaccount',$data);  
   }
   public function dir_accout_page(){

    $language=getLang();
    $country_data=getCountry();
    $url=getCustom_url();
    $data['country']=$country_data['code'];
    $data['language']=$language;

    if(!Session::has('user_login')){
        return Redirect::to('/');
    }
    app()->setLocale($language);
    $udata=Session::get('user_login');
    $data['acc']=$udata;
    $data['url']=$url;

    return view('pages.myaccount',$data);  
   }
   public function terms_page($opid)
   {

      /*$result=Http::get(env('API_URL').'loadJdOpInfo/'.$opid);

      $res1=$result->json();
      print_r($res1);
      exit;*/

        /*$terms_arr=array();
        $terms_arr['cost']='';
        $terms_arr['ccy']='';
        foreach ($arr as $key => $value) 
        {
            foreach ($value as $k => $v) 
            {
                $terms_arr[$k]=$v;
            }
        }
        
        $data['terms_data']=$terms_arr;*/

        $language=getLang();
        $country_data=getCountry();

        getCustom_url();

        $data['country']=$country_data['code'];
        $data['language']=$language;
        app()->setLocale($language);
        return view('pages.terms',$data);  
   }
   public function popular_more_video(Request $request)
   {

        $section=$request->input('section');
        $category=$request->input('category');
        $vtype=$request->input('vtype');
        $country=$request->input('country');
        $offset=$request->input('offset');
        $limit=$request->input('limit');
        
        $country_data=getCountry();
        $token=(Session::has('auth_token')) ? Session::get('auth_token') : '';
        
        
        $id_prefix="";

        if($token==''){
            return false;
        }
        $range=$offset.'/'.$limit;
        

        $result=Http::withHeaders(['Usr' => 'jdwweb','X-Auth-Token' => $token])->get(env('API_URL').'loadMoreContent/'.$country.'/'.$range.'/'.$category.'/'.$vtype);
        $res1=$result->json();
        //dd($res1);
        $res2='';
        if($section=='video' || $section=='riddles'){
            $res2=videoHtml($res1,NULL,'true');
        }
        else if($section=='gif')
        {
            $res2=gifHtml($res1,NULL,'true');
        }
        echo $res2;
        exit;

        if($section=='video')
        {
          $result=Http::withHeaders(['Usr' => 'jdwweb','X-Auth-Token' => $token])->get(env('API_URL').'vLoadContent/'.$country_code.'/'.$range.'/1/1');
        }
        else if($section=='riddles')
        {
          $result=Http::withHeaders(['Usr' => 'jdwweb','X-Auth-Token' => $token])->get(env('API_URL').'vLoadContent/'.$country_code.'/'.$range.'/2/1');
        }
        else if($section=='gif')
        {
          $result=Http::withHeaders(['Usr' => 'jdwweb','X-Auth-Token' => $token])->get(env('API_URL').'vLoadContent/'.$country_code.'/'.$range.'/3/1');
        }
        
    
   }
   public function login(Request $request)
   {
        $mobile_ = $request->input('mobile_no');
        $mobile_no = ''.$mobile_;
        
        $unique = rand(0,10000);
        $country_code = substr($mobile_, 0,3);
        
        $token=(Session::has('auth_token')) ? Session::get('auth_token') : '';
        Log::info('Login Info: '.json_encode(['token'=>$token,'mobile'=>$mobile_no,'Url'=>env('API_URL').'getSub/','date'=>date('Y-m-d H:i:s')]));
        if($token!='')
        {
           $result=Http::withoutVerifying()->withHeaders(['Usr' => 'jdwweb','X-Auth-Token' => $token])->get(env('API_URL').'getSub/'.$mobile_no);
           $d=json_decode('['.rtrim($result->body(),'true').']');
           
           if(!empty($d[0]))
           {
             $country=getCountry();  
             $d=$d[0];
             $d->mobile_no=$mobile_no;
             $d->country_no=$country['code'];
           }
           Log::info('Login Response: '.json_encode($d));
           $rs=login($d);
           if($rs)
           {
              return json_encode($d);  
           }
           else
           {
              return array('status'=>'fail','message'=>'token not found');
           }
           
        }
        else
        {
            return array('status'=>'fail','message'=>'token not found');
        }
   }
   public function logout()
   {

      $country_data=getCountry();
      $res=UserLogout();
      Session::forget('user_login');
      $url=getCustom_url();
      return Redirect::to($url);
   }

   public function unsub(Request $request)
   {
        
        $url=getCustom_url();
        
        $user_data=Session::get('user_login');

        $mobile=$request->input('mobile_no');
        $sub=$request->input('subid');

        $result=unsubscribe($mobile,$sub);

        /*echo '<pre>';
        print_r($result['errCode']);
        exit;*/

        if($result['errCode']==1002)
        {
            $result['status']='success';
            echo json_encode($result);
            exit;
        }
        else
        {
            echo json_encode(array('status'=>'fail','msg'=>$result['errDesc']));
            exit;
        }
   }
   public function myAccount()
   {
      $redirect_url=getCustom_url();
      if(Session::has('user_login'))
      {
        $status=true;
        $data['status']=$status;
        $op_id="";

        $user_data=Session::get('user_login');
        if(isset($user_data['opid']))
        {
          $op_id=$user_data['opid'];
          $countr_no=$user_data['country_no'];       
        }
        
        $data['redirect_url']=$redirect_url;
        $data['opid']=$op_id;
        $data['country_code']=$countr_no;

        $data['user_data']=$user_data;
        
      }
      else
      {
        return Redirect::to($redirect_url);
      }
   }
   public function download_gif(Request $request)
   {
     $url=$request->input('url');
     $ext = pathinfo($url, PATHINFO_EXTENSION);
     $filename = 'download.'.$ext;
     $tempImage = tempnam(sys_get_temp_dir(), $filename);
     copy($url, $tempImage);

     return response()->download($tempImage, $filename);

   }
   public function subscribe_login(Request $request)
   {

       $mobile=$request->input('mobile_no');
       $carrier = $mobile[3].$mobile[4];
        $carrier_du = [52,55];
        if(!in_array($carrier ,$carrier_du))
            $carrier = 25;
        else
            $carrier = 54;
       

         $unique =md5(time());
         
         $domain = 'https://mobilevideos.info/';
         $domain = 'https://taiftec.com/';
         

        $url = getSendPinUrl($carrier,$unique,$mobile);
        if($carrier==54)
        {
            $data=array('redirect'=>$url); 
            echo json_encode($data);
            exit;
        }
        else
        {
            $url = getSendPinUrl($carrier,$unique,$mobile);
            $output=setup_curl($url);
            
            $data=json_decode($output);
            if(isset($data->string))
            {
                $data=json_decode($data->string);
            }

            $response=strtoupper($data->errordesc);
            if($response=="INVALID_MSISDN")
            {
               $carrier = $carrier==25?54:25;
               
                    $url = getSendPinUrl($carrier,$unique,$mobile);
                    
                     if($carrier==54)
                    {
                       $data=array('redirect'=>$url); 
                       echo json_encode($data);
                       exit();
                    }
                    else
                    {
                        $output=setup_curl($url);
                        $data=json_decode($output);
                        $data=json_decode($data->string);
                    }
            }
        }
        echo json_encode($data);exit;
   }
   public function lang_change(){
    setLanguage();
    $url=getCustom_url();
      return Redirect::to($url);
   }
   
}
