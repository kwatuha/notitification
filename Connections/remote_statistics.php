<?php
require_once('cf4_HH.php');
$lastId=getLastId();
if(!$lastId) $lastId=0;
getSMSRefRemoteData($lastId);
function getSMSRefRemoteData($refId){
    ini_set("allow_url_fopen", 1);
    $url = 'http://intellibizafrica.co.ke/impact/status.php?refid='.$refId;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,  $url);
    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result);

    if(sizeof($obj)>0) insertRefData($obj);
}

function insertRefData($data){
    foreach($data as $dataItem){
        $ref =" 
        '$dataItem->msgcenter_id' , 
        '$dataItem->message_type' , 
        '$dataItem->remote_ref' , 
        '$dataItem->message_size' , 
        '$dataItem->date_sent',
        '$dataItem->msgsent_ref',
        '$dataItem->date_created'";
        inserRef($ref);
    }
}


function inserRef($ref){
   $sql = "insert into sms_ref(msgcenter_id,message_type,remote_ref,message_size,date_sent,sys_track,date_created) values ($ref)";
   $Result1 = mysql_query($sql) or die($sql);
}
function getLastId(){
   $sql=" select max(remote_ref) as last_id from sms_ref ";
   $last_id = 0;
   $Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
    while ($rows=mysql_fetch_array($Rcd_tbody_results)){
   $last_id=$rows['last_id'];
   }
   
   return trim($last_id);
}


						
?>