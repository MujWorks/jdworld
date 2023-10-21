<?php
 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;  

use Redirect;
use Log;
class ApiController extends Controller
{
    private $RESTO_API_URL="";
    private $country_code=""; 
    public function __construct()
    {
        $this->RESTO_API_URL=env("API_URL");
        $this->country_code=(Session::has('country_code'))?Session::get('country_code') : NULL;
    }
    public function test(){
      return $this->country_code;
    }
    public function getmediaData(){
      $data=array();
      $res=ApiController::isAuthenticate();
      
      $country_code=$this->country_code;
      if($res=='true'){
       /* $data['videos']=ApiController::getVideoData($country_code,'1','10','2','1');
        $data['stories']=ApiController::getVideoData($country_code,'1','10','4','1');*/
        $data['granny']=ApiController::getVideoData($country_code,'1','10','4','1');
        $data['puzzle']=ApiController::getVideoData($country_code,'1','10','2','1');
        $data['reading']=ApiController::getVideoData($country_code,'1','10','5','1');
        return $data;  
      }
      else
      {
        return $res;
      }
      
    }
    public function getVideoData($country_code,$offset,$limit,$category,$vid_cont){
      /*
      Country code,
      offset,
      limit,
      cateogry of video[1=video,2=riddles,3=eng-stories],
      vid_cont[recent=1,popular=2,jdPics=3]
      */
      $token=Session::get('auth_token');

      $result=Http::withHeaders(['Usr' => 'kitabyweb','X-Auth-Token' => $token])
      ->get($this->RESTO_API_URL.'vLoadContent/'.$country_code.'/'.$offset.'/'.$limit.'/'.$category.'/'.$vid_cont);
      return $result->body();

    }
    public function isAuthenticate()
    {
       
       if(!Session::has('auth_token'))
       {
          $url=$this->RESTO_API_URL.'sampleReqEncrptYourPwd?str=y$002db!nhd&pkey=ajhe72m3j87%263';
          $res=Http::post($url);
          $res->body();

          if($res!='')
          {
            $url1=$this->RESTO_API_URL.'getOrSetToken?usr=kitabyweb&pwd='.$res;
            $result=Http::post($url1);
            $result=json_decode($result->body(),true);
            if(isset($result['token']) && !empty($result['token']) && $result['token']!='Configuration Not found')
            {
              
              Session::put('auth_token',$result['token']);
              Session::save();
              return 'true';
            }
            else
            {
              return array('status'=>'false','msg'=>$result['token']);
            }
          }
          else
          {
            return array('status'=>'false','msg'=>$res);
          }
       }
       else
       {
         return 'true';
       }
    }
    public function terms($opid=NULL)
    {
      
      $opid='215';
      $url=env('API_URL_JDAPP').'loadJdOpInfo/'.$opid;
      $res=Http::get($url);
      $res=$res->json();
      $arr =  json_decode(json_encode($res), true);
      
      $terms_arr=array();
      $terms_arr['cost']='';
      $terms_arr['ccy']='';
      foreach ($arr as $key => $value) 
      {
        foreach ($value as $k => $v) 
        {
          $terms_arr[$k]=$v;
        }
      }
      return $terms_arr;
    }
    public function unsubscribe()
    {
      if(Session::has('user'))
      {
        $data=Session::get('user');
        $mobile=$data['mobile_no'];
        $sub_id=$data['sub_id'];

        $reasone_str='msisdn_'.$mobile.'-cc_tool_reason_ Customer Unsubscribe';
        $token='YPdOjtjT6yeRasbg8KHk9M5/nrLIxhlEN/je02UrCuE=';
        
        $url='http://taiftec.com/sutil/usub?usr=1001&pwd=1001@Ip&reason='.urlencode($reasone_str).'&cancelsrc=WEB&subid='.$sub_id;

        $result=Http::withHeaders(['Authorization: token' => $token])->get($url);
        return $result;

      }
      else
      {
        return false;
      }
      
    }
}
