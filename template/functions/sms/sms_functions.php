<?php

//Adding group functions
function uplodeGroupContactsFileData($fileToUploade,$program,$groupId,$scheduleId){

if($program=='smsprogramming'){
$output = array('Pass' => 0, 'Fail' => 0);

ini_set('auto_detect_line_endings',1);


$handle = fopen($fileToUploade, 'r');
$countrowshdls=0;
$fileARR=explode('/',$fileToUploade);
updateGroupContactScheduleFile($scheduleId,$fileARR[1],$groupId);
while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
$countrowshdls++;
$phone_number= trim(mysql_real_escape_string($data[0]));
$recepient= trim(mysql_real_escape_string($data[1]));
$additionalDetails= trim(mysql_real_escape_string($data[2]));
$phone_number=padPhoneNumberWithZero($phone_number);
 $numberLen=strlen($phone_number);
 //echo ( $numberLen.'=tttttttt= '."$recepient,$phone_number,$additionalDetails,$groupId,$scheduleId" );
	if($countrowshdls>1){

			if($phone_number){

    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
              if(($numberLen==10)&&(is_numeric($phone_number))){

	          insertGroupContacts($recepient,$phone_number,$additionalDetails,$groupId,$scheduleId);
              }else{
                  insertInvalidPhoneNumber($recepient,$phone_number,$scheduleId);
              }
			//
			}

	 $phone_number='';
	 $recepient='';

	}

}


}}


function updateGroupContactScheduleFile($scheduleId,$schedulefile,$smsgroup_id){

$sql="update sms_uploadtogroup set file_brouwse='$schedulefile',smsgroup_id='$smsgroup_id' where uploadtogroup_id='$scheduleId'";
$alertQueryResults=mysql_query($sql);
}



function insertGroupContacts($recepient,$phone_number,$other,$groupId,$scheduleId){

    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
	$uuid=gen_uuid();
	$sys_track=$scheduleId;
	$insertSQl=  "Insert into sms_smsgroupmember (member_description,phone_number,other_details,smsgroup_id,date_created,created_by,voided,sys_track,uuid) values
                        ('$recepient','$phone_number','$other','$groupId','$date_created','$created_by','0','$sys_track','$uuid')";
        $phoneExistsInGroup=  checkDuplicatePhone('sms_smsgroupmember',$phone_number,$groupId);
        if(!$phoneExistsInGroup)
    $Result1 = mysql_query($insertSQl) or die(mysql_error());

}
function insertGroupQueue($recepient,$phone_number,$message,$groupId,$track){

    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
	$uuid=gen_uuid();
	$sys_track=$scheduleId;
	$insertSQl=  "Insert into sms_groupqueue (message,phone_number,recepient,smsgroup_id,date_created,created_by,voided,sys_track,uuid) values
                        ('$message','$phone_number','$recepient','$groupId','$date_created','$created_by','0','$track','$uuid')";
       $phoneExistsInGroup=  checkDuplicatePhone('sms_groupqueue',$phone_number,$groupId);
       if(!$phoneExistsInGroup)
   $Result1 = mysql_query($insertSQl) or die(mysql_error());

}

function queueFromGroupMembers($groupId,$message,$track){

$sql="select member_description,phone_number,other_details from sms_smsgroupmember where smsgroup_id='$groupId'";
$Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
$phone_number="";$recepient='';$other_details='';
 while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$phone_number=$rows['phone_number'];
$recepient=$rows['member_description'];
$other_details=$rows['other_details'];
insertGroupQueue($recepient,$phone_number,$message,$groupId,$track);
}

}

function checkDuplicatePhone($table,$phone_number,$groupId){
$sql="select phone_number from $table where phone_number like '$phone_number' AND smsgroup_id like '$groupId'";
$Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
$phone_number="";
 while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$phone_number=$rows['phone_number'];
}
return trim($phone_number);
}

function insertInvalidPhoneNumber($recepient,$phone_number,$scheduleId){

    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
	$uuid=gen_uuid();
	$sys_track=$scheduleId;
	$insertSQl=  "Insert into sms_invalidphonenumber (recepient,phone_number,date_created,created_by,voided,sys_track,uuid) values
                        ('$recepient','$phone_number','$date_created','$created_by','0','$sys_track','$uuid')";
    $Result1 = mysql_query($insertSQl) or die(mysql_error());

}

function executeFunction($returnFunction){

      return $returnFunction;
}
//  end of goup functions
// Delivery Reports

function initDeliveryReport($messageid,$mobileno,$externalId,$track){
    $created_by= 14;
    $date_created=date('Y-m-d');
    $uuid=gen_uuid();

$sql="INSERT INTO sms_msgdelivery(messageid,mobileno,externalid,sys_track,created_by,date_created,uuid) 
      VALUES ('$messageid','$mobileno','$externalId','$track','$created_by','$date_created','$uuid')";

    // if(existMessage($messageid)){
    //     updateDeliveryStatus($messageid,$externalid,$deliverytime,$status,$undeliveredreason);
    // } else{
        $Result1 = mysql_query($sql) or die($sql);
    // }


}

function processSMSResponse($response,$track){
   
    foreach($response as $val){
              initDeliveryReport($val->messageid,$val->{'mobile-no'}, $val->smsclientid,$track);

    }
}
////////////////////////////////////////// End of Delivery Reports
function formatPhoneNumber($phoneNumber){
    if($phoneNumber){
			$firstdigit=substr($phoneNumber,0,1);
			if($firstdigit!=0){
			$phoneNumber='0'.$phoneNumber;
			}
      $numberLen=strlen($phoneNumber);
     if(($numberLen==10)&&(is_numeric($phoneNumber))){
       return $phoneNumber;
     }
    
    }
return null;
}

function customizeMessage($columDefinition,$messageTypeId,$dataRow){
     $message="" ;  
   if($messageTypeId){
        $data=fillPrimaryData('sms_smsmsgcust',$messageTypeId);
        $message= $data['message'];
   } 
            foreach ($columDefinition as $key => $value){
                if($value){
                  $message=str_replace('{'.trim($value).'}',$dataRow[$key],$message);
                }              

            }
return $message;
}


function customizeGeneralMessage($columDefinition,$message,$dataRow){
     
            foreach ($columDefinition as $key => $value){
                if($value){
                  $message=str_replace('{'.trim($value).'}',$dataRow[$key],$message);
                }              

            }
return $message;
}

function colDefinition($dataRow){

    $colDefs=array();
    $colCnt=0;
    foreach($dataRow as $column){
        if($column){
            $colDefs[$colCnt]=$column;
          }
      $colCnt++;
    }
    return $colDefs;

}

function insertMsg($table,$message,$phoneNumber,$sysTrack){
    $message=mysql_real_escape_string($message);
    $phoneNumber=mysql_real_escape_string($phoneNumber);
    $sysTrack=mysql_real_escape_string($sysTrack);
    $created_by= $_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
    $uuid=gen_uuid();     
    $voided=0;

    $insertSQl= "Insert into $table (phone_number,message,date_created,created_by,voided,sys_track,uuid) values
                        ('$phoneNumber','$message','$date_created','$created_by','$voided','$sysTrack','$uuid')";

	$Result1 = mysql_query($insertSQl) or die($insertSQl);

}

//////////////////Addition of general message
function checkDuplicateConnections($conncetionId){
$sql="select connection_number from sms_billhandle where connection_number like '$conncetionId'";
$query_Rcd_getbody= $sql;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
 while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$connection=$rows['connection_number'];
}

return trim($connection);

}

function formatSMSMessage($messageType,$connection_number,$amount,$billdate,$prevReading,$currReading,$consumption){
	  if($messageType){
                    $smsArrayDetails=fillPrimaryData('sms_smsmsgcust',$messageType);
    				    $mesage=$smsArrayDetails['message'];
          				$mesage=str_replace('{connectionID}',$connection_number,$mesage);
          				$message=str_replace('{amount}',$amount,$mesage);
          				$message=str_replace('{disconnectionDate}',$billdate,$message);
					   	$message=str_replace('{Prev_Reading}',$prevReading,$message);
          				$message=str_replace('{Curr_Reading}',$currReading,$message);
          				$message=str_replace('{Consumption}',$consumption,$message);
                        $message=str_replace('{bill_date}',$billdate,$message);
        }
		return $message;
}


function formatGeneralMessage($name,$msg,$userMsg){
	  if($userMsg){

    				        $mesage=$userMsg;
          				$mesage=str_replace('{name}',$name,$mesage);
          				$message=str_replace('{message}',$msg,$mesage);
        }
		return $message;
}




function updateCreditBalanceStatus($balstatus){
$sql="update sms_creditbalance set sys_track='$balstatus' where creditbalance_id=1";
$query_Rcd_getbody= $sql;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());


}

function getupdatedCreditBalance(){
$sql="select sys_track from sms_creditbalance";
$query_Rcd_getbody= $sql;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
 while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$balance=$rows['sys_track'];
}

return trim($balance);

}
function getSmsCreditBalance(){
     libxml_use_internal_errors(true);
     $URL = "http://messaging.advantasms.com/bulksms/smscredit.jsp?user=ImpactRDO&password=i12345";

            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $creditBalance='';
            if($output){
                $oXML = new SimpleXMLElement($output);
                $creditBalance= $oXML->credit;
                libxml_clear_errors();
            }
            curl_close($ch);
return trim($creditBalance);

}

function createSmsContent($smsContentList){
    $smsFile='../template/functions/sms/sms.xml';
    $smsPart1='<?xml version="1.0"?><smslist>';
    $smsPart2='</smslist>';
    $smsList='';

//Now create sms list
file_put_contents($smsFile,$smsPart1.$smsContentList.$smsPart2);

}


function createSmsTag($phoneNumber,$smsMessage,$messageId){
if(!$messageId){
$messageId=0;
}
    if($phoneNumber && $smsMessage)
    return '<sms><user>ImpactRDO</user><password>i12345</password><message>'.$smsMessage.'</message><mobiles>'.$phoneNumber.'</mobiles><senderid></senderid><cdmasenderid></cdmasenderid><group>-1</group><clientsmsid>'.$messageId.'</clientsmsid><accountusagetypeid>1</accountusagetypeid></sms>';

}

function getSmsContent(){
    $smsFile='../template/functions/sms/sms.xml';
    return file_get_contents($smsFile);
}
function SendSms( $smsListContent){
          $URL = "http://messaging.advantasms.com/bulksms/sendsms.jsp?";
	    $xml_data =str_replace('smsPhoneNumber',$phone,$xml_data );
	    $xml_data =str_replace('smsMessage',$msg,$xml_data );
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$smsListContent");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;



}?><?php
function getCreditBalance(){
$sql="select  balance from sms_creditbalance";
$query_Rcd_getbody= $sql;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cmdata='';
$pay_before='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$balance=$rows['balance'];
}

return trim($balance);

}?><?php
function updateSMSScheduleFile($schedule,$schedulefile,$commtype){

$comtypeArray=explode('_',$commtype);
if($comtypeArray[0]=='bill')
$sql="update sms_schedule set file_brouwse='$schedulefile' where schedule_name='$schedule'";

if($comtypeArray[0]=='disconnection')
$sql="update sms_disconnschedule set file_brouwse='$schedulefile' where disconnschedule_name='$schedule'";

$alertQueryResults=mysql_query($sql);
}

function updateEmailScheduleFile($schedule,$schedulefile){

$sql="update sms_emailschedule set file_brouwse='$schedulefile' where emailschedule_name='$schedule'";

$alertQueryResults=mysql_query($sql);
}

function updateGeneralSmsScheduleFile($schedule,$schedulefile){

$sql="update sms_schedulegeneralsms set file_brouwse='$schedulefile' where schedulegeneralsms_name='$schedule'";

$alertQueryResults=mysql_query($sql);
}
?><?php
function getBillScheduleDate($schedule,$days,$commtype){
$schedule=strtoupper(trim($schedule));
$strComtypes=explode('_',$commtype);
if($strComtypes[0]=='disconnection')
$sql="select  DATE_add(bill_date, INTERVAL $days  DAY) as 'pay_before' from sms_disconnschedule where ucase(disconnschedule_name)='$schedule'";

//  if($strComtypes[0]=='bill')
 $sql="select  DATE_add(bill_date, INTERVAL $days  DAY) as 'pay_before' from sms_schedule where ucase(schedule_name)='$schedule'";

$query_Rcd_getbody= $sql;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die($sql);
$cmdata='';
$pay_before='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$pay_before=$rows['pay_before'];
}

return trim($pay_before);

}


function getEmailBillScheduleDate($schedule,$days){
$schedule=strtoupper(trim($schedule));
$sql="select  DATE_add(bill_date, INTERVAL $days  DAY) as 'pay_before' from sms_emailschedule where ucase(emailschedule_name)='$schedule'";


$query_Rcd_getbody= $sql;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cmdata='';
$pay_before='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$pay_before=$rows['pay_before'];
}

return trim($pay_before);

}

?><?php

function getSystemStatus(){
$sql="select current_mode from sms_systemmode limit 1";
$query_Rcd_getbody= $sql;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cmdata='';
$current_mode='';
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$current_mode=$rows['current_mode'];
}

return trim(strtoupper($current_mode));

}

?><?PHP
function markResponse($message_from,$message_message,$request_type){
$sms_autoresponse='';
$created_by=$_SESSION['my_useridloggened'];
$date_created=date('Y-m-d');
$uuid=gen_uuid();
$sms_receivedrqts="insert into sms_autoresponse(autoresponse_id,
						message_from,
						request_type,
						message_message,
						date_created,
						changed_by,
						date_changed,
						voided,
						voided_by,
						date_voided,
						uuid
						) values('$autoresponse_id',
						'$message_from',
						'$request_type',
						'$message_message',
						'$date_created',
						'$changed_by',
						'$date_changed',
						'$voided',
						'$voided_by',
						'$date_voided',
						'$uuid')";
						$qryresults= mysql_query($sms_receivedrqts) or die(mysql_error());
}
?><?php
function uplodeFileData($fileToUploade,$program,$schedule,$days,$commtype,$messageType){

// $pay_before=getBillScheduleDate($schedule,$days,$commtype);
if($program=='smsprogramming'){
$output = array('Pass' => 0, 'Fail' => 0);

ini_set('auto_detect_line_endings',1);


$handle = fopen($fileToUploade, 'r');
$countrowshdls=0;
$fileARR=explode('/',$fileToUploade);

updateSMSScheduleFile($schedule,$fileARR[1],$commtype);
$columDefinition=array();
$messageId=createMsgTrack(4);
while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
$countrowshdls++;
$effectivedate=date('Y-m-d');
$phone_number= trim(mysql_real_escape_string($data[0]));
if($countrowshdls==1){
 $columDefinition= colDefinition($data);
}
	if($countrowshdls>1){
        $phoneNumber=formatPhoneNumber($phone_number);
        $msgct=customizeMessage($columDefinition,$messageType,$data);

        if($phoneNumber){
          
           insertMsg('sms_msgqueue',$msgct,$phoneNumber,$messageId.'_'.$commtype);
        } else{
             insertMsg('sms_msginvalid',$msgct,$phone_number,$messageId.'_'.$commtype);
        }
 
// 			if(($connection_number)&&($phone_number)&&($amount)){
// 			$firstdigit=substr($phone_number,0,1);
// 			if($firstdigit!=0){
// 			$phone_number='0'.$phone_number;
// 			}
//  $numberLen=strlen($phone_number);
//   $startcommtype=explode('_',$commtype);

// if(($startcommtype[0]=='bill')||($startcommtype[0]=='disconnection')){

//     if(($numberLen==10)&&(is_numeric($phone_number))){

//     $connectionExists=checkDuplicateConnections(trim($connection_number));
//     if(!$connectionExists){
//     insertWaterBillHandler($phone_number,$connection_number,$amount,$pay_before,$commtype,$messageType,$prevReading,$currReading,$consumption);
//     }

//     }else{
//       splitDelimitedWaterBillNumbers($phone_number,$connection_number,$amount,$pay_before,$commtype,$messageType,$prevReading,$currReading,$consumption);
//     }
// }


// 			}
// 	 $connection_number='';
// 	 $phone_number='';
// 	 $amount='';
// 	 $pay_before='';
	}

}


}}

?><?php
//SERVER IP  eg localhost
$serverurl="http://localhost:5000/";
//HTTP REQUEST FUNCTION
function httpRequest($url){
    $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
    preg_match($pattern,$url,$args);
    $in = "";
    $fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
    if (!$fp) {
       return("$errstr ($errno)");
    } else {
        $out = "GET /$args[3] HTTP/1.1\r\n";
        $out .= "Host: $args[1]:$args[2]\r\n";
        $out .= "User-agent: Crowny PHP client\r\n";
        $out .= "Accept: */*\r\n";
        $out .= "Connection: Close\r\n\r\n";

        fwrite($fp, $out);
        while (!feof($fp)) {
           $in.=fgets($fp, 128);
        }
    }
    fclose($fp);
    return($in);
}


//SEND SMS FUNCTION
function SendSmsOriginal($phone, $msg, $debug=false)
{
 	  global $serverurl;

   	  $url=$serverurl;
	  $url.= 'sendsms?';
      $url.= 'Recipient='.urlencode($phone);
      $url.= '&Message='.$msg;

	  //$url.= '&Message='.urlencode($msg);

       if ($debug) { echo "Request URL: <br>$url<br><br>"; }

      //Open the URL to send the message
      $response = httpRequest($url);
      if ($debug) {
           echo "Response: <br><pre>".
           str_replace(array("<",">"),array("&lt;","&gt;"),$response).
           "</pre><br>"; }

      return($response);
}



?>
<?php
function uploadScheduleFile($file_id, $folder="", $types="",$otherdetails) {
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = split("\.",basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
    $file_name = $uniqer . '_' .$otherdetails.$file_title;//Get Unique Name

    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
            return array('',$result);
        }
    }

    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder don't exist.";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';

    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
        }
    }

    return array($file_name,$result);
}
?><?php
function uplodeEmailFileData($fileToUploade,$program,$schedule,$days){

$pay_before=getEmailBillScheduleDate($schedule,$days);


if($program=='smsprogramming'){
$output = array('Pass' => 0, 'Fail' => 0);

ini_set('auto_detect_line_endings',1);


$handle = fopen($fileToUploade, 'r');
$countrowshdls=0;
$fileARR=explode('/',$fileToUploade);
updateEmailScheduleFile($schedule,$fileARR[1]);
while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
$countrowshdls++;
$effectivedate=date('Y-m-d');
$connection_number = trim(mysql_real_escape_string($data[0]));
$amount= trim(mysql_real_escape_string($data[1]));
$email_address= trim(mysql_real_escape_string($data[2]));
$pay_before=getEmailBillScheduleDate($schedule,$days);

//oaf

$time = strtotime( $pay_before );

//$pay_before = date( 'Y-m-d', $time );


	if($countrowshdls>1){
	       // echo " first \n\n\n Con====$connection_number)&&($phone_number)&&($amount)\n\n\n".$insertSQl;
			if(($connection_number)&&($email_address)&&($amount)){

    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
	$uuid=gen_uuid();


			$insertSQl= "Insert into sms_emailhandle (connection_number,amount,email_address,pay_before,
date_created,
changed_by,
date_changed,
voided,
voided_by,
date_voided,
uuid) values ('$connection_number','$amount','$email_address','$pay_before',
'$date_created',
'$changed_by',
'$date_changed',
'$voided',
'$voided_by',
'$date_voided',
'$uuid')";





		$insertInvalidSQl= "Insert into sms_invalidemailaddress (connection_number,amount,email_address,pay_before,date_created,
changed_by,
date_changed,
voided,
voided_by,
date_voided,
uuid) values ('$connection_number','$amount','$email_address','$pay_before','$date_created',
'$changed_by',
'$date_changed',
'$voided',
'$voided_by',
'$date_voided',
'$uuid')";

//if oaf


      $emailArr=explode('@',$email_address) ;
      $myvalidemail=$emailArr[1]  ;
	if($myvalidemail){
	$Result1 = mysql_query($insertSQl) or die(mysql_error());
    }
    else{
	   $Result1 = mysql_query($insertInvalidSQl) or die(mysql_error());
   }

			}
			 $connection_number='';
	 $phone_number='';
	 $amount='';
	 $pay_before='';
	}

}


}}



function uplodeGeneralsmsFileData($fileToUploade,$message,$schedule,$scheduleId){

if($message){
$output = array('Pass' => 0, 'Fail' => 0);

ini_set('auto_detect_line_endings',1);


$handle = fopen($fileToUploade, 'r');
$countrowshdls=0;
$fileARR=explode('/',$fileToUploade);
updateGeneralSmsScheduleFile($schedule,$fileARR[1]);

$columDefinition=array();
$messageId=createMsgTrack(5);
while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
$countrowshdls++;
$effectivedate=date('Y-m-d');
$phone_number= trim(mysql_real_escape_string($data[0]));
if($countrowshdls==1){
 $columDefinition= colDefinition($data);
}
	


	if($countrowshdls>1){

        $phoneNumber=formatPhoneNumber($phone_number);
        $msgct=customizeGeneralMessage($columDefinition,$message,$data);
        $created_by=$_SESSION['my_useridloggened'];
        $date_created=date('Y-m-d');
        $commtype="";

	    if($phoneNumber){
              if($phoneNumber){
           
           insertMsg('sms_msgqueue',$msgct,$phoneNumber,$messageId.'_'.$scheduleId);
        } else{
           insertMsg('sms_msginvalid',$msgct,$phone_number,$messageId.'_'.$scheduleId);
        }

	}

}
}

}
}

function splitDelimitedNumbers($recepient,$phone_number,$message,$scheduleId){

       $actualfieldsArr=explode('/',$phone_number);

       if(sizeof($actualfieldsArr)<2){
         $actualfieldsArr=explode(',',$phone_number);
       }

        if(sizeof($actualfieldsArr)<2){
         $actualfieldsArr=explode(';',$phone_number);
       }

		for($i=0;$i<sizeof($actualfieldsArr);$i++){
            $Number=padPhoneNumberWithZero($actualfieldsArr[$i]);

            if((strlen($Number)==10)&&(is_numeric($Number))){

             insertOtherProcessingInfo($recepient,$Number,$message,$scheduleId);
            }else{
                  insertInvalidOtherAddress($recepient,$Number,$message,$scheduleId);
            }
		}
}

function splitDelimitedWaterBillNumbers($phone_number,$connection_number,$amount,$pay_before,$sys_track,$messageType,$prevReading,$currReading,$consumption){

       $actualfieldsArr=explode('/',$phone_number);

       if(sizeof($actualfieldsArr)<2){
         $actualfieldsArr=explode(',',$phone_number);
       }

        if(sizeof($actualfieldsArr)<2){
         $actualfieldsArr=explode(';',$phone_number);
       }

		for($i=0;$i<sizeof($actualfieldsArr);$i++){
            $Number=padPhoneNumberWithZero($actualfieldsArr[$i]);

            if((strlen($Number)==10)&&(is_numeric($Number))){
             insertWaterBillHandler($Number,$connection_number,$amount,$pay_before,$sys_track,$messageType,$prevReading,$currReading,$consumption);
            }else{
             insertInvalidAddressWaterBillHandler($Number,$connection_number,$amount,$pay_before,$prevReading,$currReading,$consumption,$sys_track);
            }
		}
}

function padPhoneNumberWithZero($phone_number){
    $firstdigit=substr($phone_number,0,1);
			if($firstdigit!=0){
			$phone_number='0'.$phone_number;
			}
            return $phone_number;
}

function insertOtherProcessingInfo($recepient,$phone_number,$message,$scheduleId){

    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
	$uuid=gen_uuid();
	$sys_track=$scheduleId;
	$insertSQl=  "Insert into sms_generalsmshandle (recepient,phone_number,message,date_created,created_by,voided,sys_track,uuid) values
                        ('$recepient','$phone_number','$message','$date_created','$created_by','0','$sys_track','$uuid')";
    $Result1 = mysql_query($insertSQl) or die(mysql_error());

}

function insertInvalidOtherAddress($recepient,$phone_number,$message,$scheduleId){
    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
	$uuid=gen_uuid();
	$insertInvalidSQl= " Insert into sms_invalidgeneraladdress (recepient,phone_number,message,date_created,created_by,voided,sys_track,uuid)
                                        values ('$recepient','$phone_number','$message','$date_created','$created_by','0','$scheduleId','$uuid')";

   $Result1 = mysql_query($insertInvalidSQl) or die(mysql_error());

}


function insertWaterBillHandler($phone_number,$connection_number,$amount,$pay_before,$sys_track,$messageType,$prevReading,$currReading,$consumption){
        $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
  $uuid=gen_uuid();
  $voided=0;
  $message='';
  if($messageType) $message=formatSMSMessage($messageType,$connection_number,$amount,$pay_before,$prevReading,$currReading,$consumption);
    $insertSQl= "Insert into sms_billhandle (connection_number,amount,phone_number,pay_before,smsmsgcust_id,proposed_message,prev_reading,curr_reading,consumption,date_created,created_by,voided,sys_track,uuid) values
                        ('$connection_number','$amount','$phone_number','$pay_before','$messageType','$message','$prevReading','$currReading','$consumption','$date_created','$created_by','$voided','$sys_track','$uuid')";

	$Result1 = mysql_query($insertSQl) or die($insertSQl);


}

function insertInvalidAddressWaterBillHandler($phone_number,$connection_number,$amount,$pay_before,$prevReading,$currReading,$consumption,$sys_track){
    $created_by=$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
    $uuid=gen_uuid();
    $voided=0;
    $insertInvalidSQl= "Insert into sms_smsinvalid (connection_number,amount,phone_number,pay_before,prev_reading,curr_reading,consumption,date_created,created_by,voided,sys_track,uuid)
    values ('$connection_number','$amount','$phone_number','$pay_before','$prevReading','$currReading','$consumption','$date_created','$created_by','$voided','$sys_track','$uuid')";
    $Result1 = mysql_query($insertInvalidSQl) or die($insertInvalidSQl);
}



function errorNotification($errorTile)	{

    $msgback="function incorrectMessage(){
							Ext.Msg.show({
							 title:'Failure',
							 msg: '$errorTile',
							 buttons: Ext.Msg.OK,
							 icon: Ext.Msg.ERROR
							   });

							}
					incorrectMessage();";

   echo '{success:true, savemsg:'.json_encode($msgback).'}';
}


function successNotification($messageTitle){
    $msgback="function notifyUserChanges(){

				Ext.Msg.show({
				 title:'Success',
				 msg: '$messageTitle',
				 buttons: Ext.Msg.OK,
				 icon: Ext.Msg.INFO
                   });

				}
				notifyUserChanges();";
      return $msgback;
}


?>