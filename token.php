<?php
//$memcache = new Memcache;
//$memcache->connect('127.0.0.1',11211) or die('shit');
// 
//$memcache->set('key','hello memcache!');
// 
//$out = $memcache->get('key');
// 
//echo $out;

//$mmc=memcache_init();//初始化缓存



$mmc=memcache_connect('127.0.0.1', 11211);
$token=memcache_get($mmc,"token");//获取token
$access_token=memcache_get($mmc,"token");//获取token
if(empty($token) or  $_GET[aaa])//判断是否为空,如空重新获取token
{
	
$appid="wx6aa29c161a9fca3b";
$secret="8b19ea2a32e4cca00b917aba8fa2dee8";


//wx6aa29c161a9fca3b
//8b19ea2a32e4cca00b917aba8fa2dee8
 
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
//echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

$jsoninfo = json_decode($output, true);
$access_token = $jsoninfo["access_token"];
echo $access_token;
memcache_set($mmc,"token",$access_token,false,7000);//过期时间7200秒
$token=memcache_get($mmc,"token");//获取token
$access_token=memcache_get($mmc,"token");//获取token

}
echo $access_token;
?>