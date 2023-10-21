<?php
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\Config;
 
function SetCountry($country_name=NULL)
{
	$countries=array('bh'=>'973','omn'=>'968','sau'=>'966','uae'=>'971','pak'=>'92','iq'=>'964');
	
	if(!isset($countries[$country_name]) && $country_name!=NULL)
	{
	   Session::forget('country_code');
	   remove_customurl();
	   abort(404, 'Something went wrong');
	   return false;
	}
	else if(isset($countries[$country_name]) && $country_name!=NULL)
	{
	  $data=array('name'=>$country_name,'code'=>$countries[$country_name]);
	  Session::put('country_code',$data);	
	  custom_url($country_name);
	  $res=getCountry();
	  return $res;
	}
	else if($country_name==NULL)
	{
      $data=array('name'=>'uae','code'=>'971');	
      Session::put('country_code',$data);
      //custom_url('uae');
      $res=getCountry();
	  return $res;	
	}
	else
	{
		session()->forget('country_code');
	}
	
	return true;	
}

function getCountry(){
	
	if(Session::has('country_code')){
		$res=Session::get('country_code');
		return $res;
	}
	else
	{
		$res=SetCountry();
		if($res){
			$country=getCountry();
			return $country;
		}
	}
}
function setLanguage(){
	if(Session::has('language'))
	{
		$lang=Session::get('language');
		if($lang=='en')
		{
			Session::put('language','ar');
		}
		else if($lang=='ar'){
			Session::put('language','en');
		}
		return Session::get('language');
	}
	else
	{
	  Session::put('language','en');	
	  return Session::get('language');
	}
}
function getLang(){
	if(Session::has('language')){
		$lang=Session::get('language');
		return $lang;
	}
	else
	{
		$lang=setLanguage();
		return $lang;
	}

}
function deleteCountry(){
	
	Session::forget('country_code');
}
function isAuthenticate()
{
       
   if(!Session::has('auth_token'))
   {
      $url=env('API_URL').'sampleReqEncrptYourPwd?str=y$002db!nhd&pkey=ajhe72m3j87%263';
      $res=Http::withoutVerifying()->post($url);
      $res->body();

      if($res!='')
      {
        $url1=env('API_URL').'getOrSetToken?usr=jdwweb&pwd='.$res;
        $result=Http::withoutVerifying()->post($url1);
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
function op_json_arr($result_data)
{
	
	$jsonres = array();
	 $data=array();
	 $countires = [];
	 $opids = [];
	 $opdata = [];

	 foreach ($result_data as $key => $value) 
	 {
    	$countires[$value['cid']]=$value['cid'];
	 }
	 $i=0;
	 foreach ($countires as $key => $value) {
	 	
	 	foreach ($result_data as $k => $v) 
	 	{
	 		$i++;

	 		if($v['cid']==$key){
	 			$r1=json_decode($v['RES']);
	 			$data[$v['cid']][key($r1)]=$r1;	
	 			
	 		}

	 	}
	 }
	 
	 //$data=str_replace('"',"'", $data);
	return $data;
	
}
function filter_keyby_arr($arr,$column)
{
	$data=array();

	foreach ($arr as $key => $value) 
	{
		if($key==$column)
		{
		  foreach ($value as $k => $v) 
		  {

		  	$v=(array)$v;

		  	$arr1=json_decode($v[$k],true);
		  	$arr1[]=array('operator'=>$k);
		  	
		  	$collection1 = collect($arr1);
				$data[] = $collection1->flatMap(function ($values) 
				{
				    return array_map('strtoupper', $values);
				});
		  }
		}
		
	}
	return $data;
}
function custom_url($country_name)
{

	 //$url=url()->full();
	$url=env('APP_URL');
	//Session::put('custome_url',$url.$country_name);
	 session(['custome_url' =>$url.$country_name]);
	 $res=getCustom_url();
   return $res;
}
function getCustom_url(){
	$country_data=getCountry();
    Config::set('global.url',env('APP_URL').$country_data['name']); 
    $url=config('global.url');
	return $url;
}
function remove_customurl()
{
	Session::forget('custome_url');
}

function login($d)
{
		
	if(isset($d->subId) && $d->subId != 0)
	{
		$arr=array(); 
		$arr['creditsAvailable']=$d->creditsAvailable;
		$arr['sub_id']=$d->subId;
		$arr['mobile_no']=$d->mobile_no;

		$arr['opname']=$d->opName;
		$arr['t_credit']=$d->totalcredits;
		$arr['provider']=$d->provider;
		$arr['serv_name']=$d->srvName;

		$arr['subDate']=$d->subDate;
		$arr['renewal']=$d->nextRenew;
		$arr['srvcost']=$d->srvcost;
		$arr['msisdn']=$d->msisdn;
		$arr['opid']=$d->opId;
		$arr['country_no']=$d->country_no;
		
		Session::put('user_login',$arr);
		return true;
	}
	else
	{
		return false;
	}
}
function CheckLogin(){

	$isLogin=false;
	if(Session::has('user_login')){
		$isLogin=true;
	}
	return true;
}
function UserLogout()
{

	if(Session::has('user_login'))
	{
		Session::forget('user_login');
		return true;
	}
	else
	{
		return false;
	}
}
function unsubscribe($mob,$sub)
{
	$mobile=$mob;
	$sub_id=$sub;
	
	$reasone_str='msisdn_'.$mobile.'-cc_tool_reason_ Customer Unsubscribe';
	$token='YPdOjtjT6yeRasbg8KHk9M5/nrLIxhlEN/je02UrCuE=';
	$authorization =array("Authorization: token".$token);
	$url='http://taiftec.com/sutil/usub?usr=1001&pwd=1001@Ip&reason='.urlencode($reasone_str).'&cancelsrc=WEB&subid='.$sub_id;


	$result=Http::withHeaders($authorization)->get($url);
	$result=$result->json();
	return $result;
}
function getSendPinUrl($carrier,$unique,$mobile_number){
    $data=creditionals();
    
	$url=$data['domain'].'wr/sendpin?usr='.$data['aff_user'].'&pwd='.$data['aff_pwd'].'&reqfor='.$carrier.'&clientunqid='.$unique.'&msisdn='.$mobile_number.'&jsonstr={"apiver":"2","reqtype":"portal","reqidFrmPixelCompany":"'.$unique.'"}';
    return $url;
}
function creditionals()
{
    $aff_usr='taiftecadv';
    $aff_pwd='dk@20200127';
    $domain='https://taiftec.com/';
    return array('aff_user'=>$aff_usr,'aff_pwd'=>$aff_pwd,'domain'=>$domain);
}
function setup_curl($url){
        $ip = get_ip_address();
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "X-Forwarded-For: $ip","User-agent: ".$_SERVER['HTTP_USER_AGENT']));
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
}
function get_ip_address(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
            $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
            $ip = $forward;
    }
    else
    {
            $ip = $remote;
    }

    return $ip;
}
function setUrl(){
	 $country_data=getCountry();


     Config::set('global.url',env('APP_URL').$country_data['name']);
}
function apiCurl($method,$url,$param=NULL,$header=NULL,$body=NULL,$isLogin=false,$api='KD_API')
{

    $api_link = !empty(env('API_URL'))?env('API_URL'):env('API_URL');
    
    $url = $api_link.$url;

    try
    {
        $http_obj = Http::withoutVerifying()->withOptions([
            'base_uri' =>env('API_URL')
        ]);
        $response=NULL;
        if($method=='post')
        {

            if($header!=NULL)
            {
                $http_obj->withHeaders($header);
            }
            if($body!=NULL)
            {
                $http_obj->withBody($body);
            }
            if($param!=NULL)
            {
                $response=$http_obj->asForm()->post($url,$param);
            }
            else
            {
                $response=$http_obj->asForm()->post($url);
            }


            return $response->json();
        }

        if($method=='get')
        {

            if($header!=NULL)
            {
                $http_obj->withHeaders($header);
            }
            if($body!=NULL)
            {
                $http_obj->withBody($body);
            }
            if($param!=NULL)
            {
                $response=$http_obj->get($url,$param);
            }
            else
            {
                $response=$http_obj->get($url);
            }
            if($response->body()==true){

            }


            return $response->json();
        }
        if($method=='delete')
        {


            if($header!=NULL)
            {
                $http_obj->withHeaders($header);
            }
            if($body!=NULL)
            {
                $http_obj->withBody($body);
            }
            if($param!=NULL)
            {
                $response=$http_obj->delete($url,$param);
            }
            else
            {
                ///dd($url);
                $response=$http_obj->delete($url);
            }
            if($response->body()==true){

            }


            return $response->json();
        }
    }
    catch(\Exception $e)
    {

      //throw new \Exception("Error Processing Request", 1);


    }


}
?>