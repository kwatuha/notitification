<?php
function getRegionalStats(){
    $url="http://messaging.advantasms.com/bulksms/getDLR.jsp?userid=intellibiz&password=intellibiz&redownload=yes&responcetype=xml";
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

function processRegionalStats($reports){

    foreach($reports as $dataItem){

     if (strpos($dataItem->message, 'Ero kamano') !== false
     ||strpos($dataItem->message, 'thanks') !== false
     ||strpos($dataItem->message, 'Orio mno') !== false
     ||strpos($dataItem->message, 'Asante ') !== false
     
     ) {
        $message_type='Appreciation';
    }else if (strpos($dataItem->message, 'scheduled') !== false
     ||strpos($dataItem->message, 'Osiepa') !== false
     ||strpos($dataItem->message, 'itsulira') !== false
     ||strpos($dataItem->message, 'kujia ') !== false
     
     ) {
        $message_type='Reminder';
    }else{
        $message_type='Other SMS';
    }

     $ref =" 
        '$dataItem->externalid' , 
        '$message_type' , 
        '$dataItem->messageid' , 
        'strlen($dataItem->message_size)' , 
        '$dataItem->senttime',
        '$dataItem->messageid',
        '$dataItem->senttime'";
        $exists=checkReportMessage($dataItem->messageid);
        if( !$exists){
            inserRef($ref);
        }
        
    }
}

function inserRef($ref){
   $sql = "insert into sms_ref(msgcenter_id,message_type,remote_ref,message_size,date_sent,sys_track,date_created) values ($ref)";
   $Result1 = mysql_query($sql) or die($sql);
}
function checkReportMessage($messageid){
    $sql="select remote_ref from  sms_ref  where remote_ref like '$messageid' ";
    $message ='';
    $Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
     while ($rows=mysql_fetch_array($Rcd_tbody_results)){
    $message=$rows['remote_ref'];
    }        
    return trim($message);       
}

						
?>