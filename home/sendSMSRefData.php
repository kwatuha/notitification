<?php
require_once('../Connections/cf4_HH.php');
$GLOBALS['msg_center'] = getMsgCenter(); 
getMessageStatus();
 function sendData($data){

    $url = 'http://intellibizafrica.co.ke/impact/index.php?user=intellibiz';
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$data_string));

    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
}

function getMsgCenter(){
    $sql=" select max(msgcenter_id) as last_id from sms_msgcenterdefault ";
    $last_id = 0;
    $Rcd_tbody_results = mysql_query($sql) or die($sql);
     while ($rows=mysql_fetch_array($Rcd_tbody_results)){
    $last_id=$rows['last_id'];
    }
    
    return trim($last_id);
 }

 function createMessage($messageType,$messageSize,$dateSent,$msgsentId){
    $data['msgcenter_id'] = $GLOBALS['msg_center'] ;
    $data['message_type'] = $messageType;
    $data['message_size'] = $messageSize;
    $data['date_sent'] = $messageSize ;
    $data['msgsent_ref'] = $msgsentId ;
    sendData($data);
 }

 function getMessageStatus(){
      $msgsentId =  getLastUpdate();
      if(!$msgsentId)  $msgsentId =0;
      $sql=" select msgsent_id,CEILING((CHAR_LENGTH(message)+11)/160) as message_size, date_created as date_sent,message_type 
      FROM  sms_msgsent where msgsent_id > $msgsentId limit 5";

    $Rcd_tbody_results = mysql_query($sql) or die($sql);
    while ($rows=mysql_fetch_array($Rcd_tbody_results)){
    $messageType =$rows['message_type'];
    $messageSize =$rows['message_size']; 
    $dateSent=$rows['date_sent'];
    $msgsentId=$rows['msgsent_id'];
    createMessage($messageType,$messageSize,$dateSent,$msgsentId);
    }
 }

 function getLastUpdate(){
    $centerId= $GLOBALS['msg_center'];
    $sql=" select max(sys_track) as last_id from sms_ref where msgcenter_id= $centerId ";
    $last_id = 0;
    $Rcd_tbody_results = mysql_query($sql) or die($sql);
     while ($rows=mysql_fetch_array($Rcd_tbody_results)){
    $last_id=$rows['last_id'];
    }
    
    return trim($last_id);
 }
?>