<?php
require_once('cf4_HH.php');

$url="http://messaging.advantasms.com/bulksms/getDLR.jsp?userid=intellibiz&password=intellibiz&drquantity=20&fromdate=26-12-2017%2000:00:00&redownload=yes&responcetype=xml&externalid=30050000";



function getMsgCenter(){
    $sql=" select max(msgcenter_id) as last_id from sms_msgcenterdefault ";
    $last_id = 0;
    $Rcd_tbody_results = mysql_query($sql) or die($sql);
     while ($rows=mysql_fetch_array($Rcd_tbody_results)){
    $last_id=$rows['last_id'];
    }    
    return trim($last_id);
 }

 
function processDeliveryRpts($reports){

    foreach($reports as $rpt){
	 smsDeliveryReport($rpt->messageid,$rpt->externalid,$rpt->senderid,$rpt->mobileno,$rpt->message,
     $rpt->submittime,$rpt->senttime,$rpt->deliverytime,$rpt->status,$rpt->undeliveredreason,$rpt->details,$rpt->externalid);
    }

}
function getDeliveryReport(){
    $GLOBALS['msg_center'] = getMsgCenter();
$url="http://messaging.advantasms.com/bulksms/getDLR.jsp?userid=intellibiz&password=intellibiz&redownload=yes&responcetype=xml&externalid=".$GLOBALS['msg_center'];

     libxml_use_internal_errors(true);
     $URL = $url;

            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $data='';
            if($output){
				
                $oXML = new SimpleXMLElement($output);
				//print_r($oXML);
                 $data=$oXML->drlist->dr;
                libxml_clear_errors();
            }
            curl_close($ch);
return $data;

}

function smsDeliveryReport($messageid,$externalid,$senderid,$mobileno,$message,$submittime,$senttime,$deliverytime,$status,$undeliveredreason,$details){
    $created_by= 14;
    $date_created=date('Y-m-d');
    $uuid=genUuid();
    $message=mysql_real_escape_string($message);
$sql="INSERT INTO sms_msgdelivery(messageid,externalid,senderid,mobileno,message,submittime,senttime,deliverytime,status,undeliveredreason,details,created_by,date_created,uuid) 
      VALUES ('$messageid','$externalid','$senderid','$mobileno','$message','$submittime','$senttime','$deliverytime','$status','$undeliveredreason','$details','$created_by','$date_created','$uuid')";

    if(existMessage($messageid)){
        updateDeliveryStatus($messageid,$externalid,$deliverytime,$status,$undeliveredreason,$senderid,$message,$submittime,$senttime);
    } else{
        $Result1 = mysql_query($sql) or die(mysql_error());
    }


}

function updateDeliveryStatus($messageid,$externalid,$deliverytime,$status,$undeliveredreason,$senderid,$message,$submittime,$senttime ){

$sql=" update sms_msgdelivery 
set deliverytime='$deliverytime',deliverytime='$deliverytime',status='$status',undeliveredreason='$undeliveredreason',
senderid='$senderid',message='$message',submittime='$submittime',senttime='$senttime'
where messageid like '$messageid'  ";
$results = mysql_query($sql) or die(mysql_error());
//or externalid like '$externalid'
}

function existMessage($messageId){

$sql="select  messageid from sms_msgdelivery where messageid like '$messageId' ";
$results = mysql_query($sql) or die(mysql_error());
$messageid='';
while ($rows=mysql_fetch_array($results)){
$messageid=$rows['messageid'];
}

return trim($messageid);

}

function messageSource(){
    $sql="select  message_source from sms_msgsource where msgsource_id=1 ";
    $results = mysql_query($sql) or die(mysql_error());
    $message_source='';
    while ($rows=mysql_fetch_array($results)){
    $message_source=$rows['message_source'];
    }

    return trim($message_source);

}

function createExternalID($id){
    $sourceId=messageSource();
    return trim($sourceId.$id);

}

function genUuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

?>