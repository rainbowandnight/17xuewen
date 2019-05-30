

<?php 
include("token.php");
//新增菜单
//$jsonmenu = '{
$jsonmenu='
 {
    "button": [
        {
          "name": "我的应用", 
            "sub_button": [ 
			{
                    "type":"view",
               		"name":"少达网",
               		"url":"http://www.shaoda.com"
                 }, 
			{
                   "type":"click",
         		  	"name":"天气预报",
         		 	"key":"weather"
                },
				 {
                   "type":"click",
         		  	"name":"观音灵签",
         		 	"key":"guanyin"
                },
								 {
                   "type":"click",
         		  	"name":"笑话",
         		 	"key":"joke"
                }
            ]
        }, 
        {
            "name": "扫码发图", 
            "sub_button": [
			                {
                    "type": "scancode_waitmsg", 
                    "name": "扫码带提示", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "scancode_push", 
                    "name": "扫码推事件", 
                    "key": "rselfmenu_0_1", 
                    "sub_button": [ ]
                }, 
				 {
                    "type": "pic_sysphoto", 
                    "name": "系统拍照发图", 
                    "key": "rselfmenu_1_0", 
                   "sub_button": [ ]
                 }, 
                {
                    "type": "pic_photo_or_album", 
                    "name": "拍照或者相册发图", 
                    "key": "rselfmenu_1_1", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_weixin", 
                    "name": "微信相册发图", 
                    "key": "rselfmenu_1_2", 
                    "sub_button": [ ]
                  
                }
            ]
        }, 
        {
            "name": "我的应用", 
            "sub_button": [
              
				 {
                   "type":"click",
         		  	"name":"观音灵签",
         		 	"key":"guanyin"
                },
					    {
                    "type":"view",
               		"name":"少达社区",
               		"url":"http://i.shaoda.com"
                 }, 
				                 {
                    "type":"view",
               		"name":"夜读",
               		"url":"http://mp.weixin.qq.com/s/MfqsKMUtdhGm8j9ULB9aKw"
                 }, 
				 
				 
				 
                {
                    "type":"view",
               		"name":"个人中心",
               		"url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6aa29c161a9fca3b&redirect_uri=http://www.shaoda.com/weixin/4-5/oauth2_openid.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
                 }, 

                {
                      "name": "发送位置", 
          	 		 "type": "location_select", 
          		  "key": "rselfmenu_2_0"
                }
				
            ]
        }
    ]
}';//创建菜单
 
// $appid = "wxe70f44aeeaca52f7";
//$appsecret = "62ace525417accaabe8a67977bd23009";
//$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
//
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$output = curl_exec($ch);
//curl_close($ch);
//$jsoninfo = json_decode($output, true);
//$access_token = $jsoninfo["access_token"];
 
//$access_token="c0V2MZfhSr4nGnxDD_lPI6nFIN0FkOgKJTa9bArDGPtqPFVvZVO-d_gg9Ld6AO0gilUiToaZWgpnW_b5En0at0wZwB-8RGQMtK9cxFT_XSIEv1BipbfyK3XdhqtVYSZHVTReAGADBZ";
$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}


?>