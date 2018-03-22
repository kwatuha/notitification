<?php

test();

function test(){
    ini_set("allow_url_fopen", 1);
    $url = 'http://intellibizafrica.co.ke/impact/status.php?user=ImpactRDO';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,  $url);
    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result);
//    var_dump($obj);
    print('fffffffffffff======'.$obj[0]->source);
    echo $obj->access_token;
}

?>