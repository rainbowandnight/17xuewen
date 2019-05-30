<?php 
//查询菜单
include("token.php");
//$access_token="-4x_me5Zm6KZcxPDY8X14SfeYba9a6dEqNY7BVKEkeaAAzIkjS_VzshftzuypOxkFBjL_xpO9mpffjY7q1KD5ulbECuKNDzcYCJv0vYPdgkgLRRKhEQJWFUy68jTAdmkRMLdAGAJED";
$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$access_token;
$result = https_request($url);
var_dump($result);

function https_request($url, $data = null){
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