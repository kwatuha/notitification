<?php


require_once('cf4_HH.php');
 $statusAction='sendit';
 $typeSource='sms_msgqueue';
if($statusAction=='sendit'){
 if($typeSource=='sms_groupqueue')sendToGroup();
   if($typeSource=='sms_generalsmshandle')
	$qry="SELECT generalsmshandle_id,recepient, phone_number,message,sys_track FROM  sms_generalsmshandle order by generalsmshandle_id asc";

	if($typeSource=='sms_msgqueue')
	$qry="SELECT  phone_number,message,sys_track,msgqueue_id FROM  sms_msgqueue order by msgqueue_id asc";


    if($qry){
		$resultsSelect=mysql_query($qry) or die('Could not execute the query = '+$qry);
		$cntreg_stmnt=mysql_num_rows($resultsSelect);
		$credit=getSmsCreditBalance();
	}


		if($cntreg_stmnt>0  && $credit>$cntreg_stmnt ){
			
                $created_by= $_SESSION['my_useridloggened'];
                $date_created=date('Y-m-d');
                $uuid=gen_uuid();
                $stdcolumnsinster="created_by,date_created,voided,uuid";
                $stdcolumnsvals="'$created_by','$date_created','$voided','$uuid'";
                $messageListTag='';
				while($rws=mysql_fetch_array($resultsSelect)){
				$count++;
				$billhandle_id=$rws['billhandle_id'];
				$smsmsgcust_id=$rws['smsmsgcust_id'];
                $generalsmshandle_id=$rws['generalsmshandle_id'];
                $msgqueue_id=$rws['msgqueue_id'];
				$ac=$rws['connection_number'];
				$connection_number=mysql_real_escape_string($rws['connection_number']);
                $recepient=mysql_real_escape_string($rws['recepient']);
				$phone_number=mysql_real_escape_string($rws['phone_number']);
                $message=mysql_real_escape_string($rws['message']);
				$billdate=mysql_real_escape_string($rws['pay_before']);
				$commtype=trim($rws['sys_track']);
				$commtype=trim($rws['sys_track']);
                $commtypeArray=explode('_',$commtype);
                $messageId="200".$msgqueue_id;
                $messageListTag.= createSmsTag($phone_number,$message,$messageId);
			    $created_by= $_SESSION['my_useridloggened'];
                $date_created=date('Y-m-d');

				
				
				

				if($msgqueue_id || $generalsmshandle_id){
	               $insertSQl= "";
					 insertMsg('sms_msgsent',$message,$phone_number,$commtype);
                    $deleteSQl='';// "Delete from  sms_msgqueue where msgqueue_id=$msgqueue_id";

				}
                if( $insertSQl)
				$results=mysql_query($insertSQl) or die('Could not execute the query Insert=='.$insertSQl);
				//echo $insertSQl;
				//delete from handler
                if($deleteSQl)
				$results=mysql_query($deleteSQl) or die('Could not execute the query delete=='.$deleteSQl);


	        } //end while handle queue
           createSmsContent($messageListTag);
		   $smsData=getSmsContent();

         if($smsData){
          $smsResp=SendSms($smsData);
		  $oXML = new SimpleXMLElement($smsResp);
           processSMSResponse($oXML,$commtype);
		 }  
      }
	///

}
if($statusAction=='view'){
$qry="SELECT *  FROM  sms_billhandle order by billhandle_id asc";

$results=mysql_query($qry) or die('Could not execute the query');

$cntreg_stmnt=mysql_num_rows($results);

	if($cntreg_stmnt>0){
	echo '<div id="SMSststatus">SMS Status show</div>';
	print"<table border='0' class=\"display\"><thead>";
	print "<tr><th align=\"left\">Phone Number</th><th align=\"left\">Name</th><th align=\"left\">
	<th align=\"left\">Message </th><th align=\"left\">Action</th></tr></thead><tbody>";
		while($rws=mysql_fetch_array($results)){
		$billhandle_id=$rws['billhandle_id'];
		$customer_name=$rws['customer_name'];
		$phone_number=$rws['phone_number'];
		$message=$rws['message'];


		print "<tr class=\"gradeX\"><td>$phone_number</td><td>$customer_name</td><td>
		<td>$message</td><td><a href='#' onClick=\"deleteRecepient('SMSststatus','$billhandle_id','Delete');sendSMS('Sms','view')\">Remove</a></td></tr>";


		/*print "$phone_number  $customer_name
		$message  $pay_before $balance <a href='#' onClick=\"deleteRecepient('SMSststatus','$smshandle_id','Delete')\">Remove</a><br>";*/
		}

	}
}

//print"<tbody></table>";
if($statusAction=='Delete'){
$billhandle_id=$_GET['smsid'];
$deleteSQl= "Delete from  sms_billhandle where billhandle_id=$billhandle_id";

//echo $deleteSQl;
$results=mysql_query($deleteSQl) or die('Could not execute the query');
}

if($statusAction=='SendINDiv'){

$reciepient=$_GET['reciepient'];
$message=$_GET['message'];
$effective_date=date('Y-m-d');
$firstdigit=substr($reciepient,0,1);
$numberLen=strlen($reciepient);
$credit=getSmsCreditBalance();
if($credit>1){
	$messageId="300".$_GET['smsid'];
    $messageListTag= createSmsTag($reciepient,$message,$messageId);
    createSmsContent($messageListTag);
    $smsData=getSmsContent();

}


if($message){
	if(($numberLen==10)&&(is_numeric($reciepient))&&($firstdigit==0)){
	$insertSMSInd="Insert into sms_indsms(reciepient,message,$stdcolumnsinster) values ('$reciepient','$message',$stdcolumnsvals)";
	$smsRSP=SendSms($smsData);
	$oXML = new SimpleXMLElement($smsRSP);
	$commtype='Single Message';
	processSMSResponse($oXML,$commtype);

	$results=mysql_query($insertSMSInd) or die('Could not execute the query');
	echo 'SMS sent';
	}else{echo 'Invalid Phone Number';
	}
 }else{ echo 'Missing message';}
}
//send scheduled
if($statusAction=='rrspd'){
        $qry="SELECT *  FROM  sms_receivedrqts ";
		$results=mysql_query($qry) or die('Could not execute the query');
		$ctn=mysql_num_rows($results);
	if($ctn>0){
			while($rws=mysql_fetch_array($results)){
					$receivedrqts_id=$rws['receivedrqts_id'];
					$message_from=$rws['message_from'];
					$request_type=$rws['request_type'];
					$message_message=$rws['message_message'];
					$effective_date=$rws['effective_date'];

					/*$partial=substr($message_from,0,3);
					if($partial==254){
					$message_from='0'.substr($message_from,3,10);
					}*/
			 $credit=getSmsCreditBalance();
				if($credit>1){
					SendSms($message_from, $message_message);
					markResponse($message_from,$message_message,$request_type);
					$deleteSQl= "Delete from  sms_receivedrqts where receivedrqts_id=$receivedrqts_id ";
					$resultsDel=mysql_query($deleteSQl) or die('Could not execute the query');
				}
			}
		}

}
function SendSms( $smsListContent){
	$URL = "ududududududu/bulksms/sendsms.jsp?";
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



}
function processSMSResponse($response,$track){
   
    foreach($response as $val){
              initDeliveryReport($val->messageid,$val->{'mobile-no'}, $val->smsclientid,$track);

    }
}

function initDeliveryReport($messageid,$mobileno,$externalId,$track){
    $created_by= 14;
    $date_created=date('Y-m-d');
    $uuid=gen_uuid();

$sql="INSERT INTO sms_msgdelivery(messageid,mobileno,externalid,sys_track,created_by,date_created,uuid) 
      VALUES ('$messageid','$mobileno','$externalId','$track','$created_by','$date_created','$uuid')";

   
        $Result1 = mysql_query($sql) or die($sql);

}

function getSmsCreditBalance(){
	libxml_use_internal_errors(true);
	$URL = "ududududududu/bulksms/smscredit.jsp?user=ImpactRDO&password=i12345";

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

function gen_uuid() {
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

function createSmsTag($phoneNumber,$smsMessage,$messageId){
	if(!$messageId){
	$messageId=0;
	}
		if($phoneNumber && $smsMessage)
		return '<sms><user>ImpactRDO</user><password>i12345</password><message>'.$smsMessage.'</message><mobiles>'.$phoneNumber.'</mobiles><senderid></senderid><cdmasenderid></cdmasenderid><group>-1</group><clientsmsid>'.$messageId.'</clientsmsid><accountusagetypeid>1</accountusagetypeid></sms>';
	
}


function createSmsContent($smsContentList){
    $smsFile='sms.xml';
    $smsPart1='<?xml version="1.0"?><smslist>';
    $smsPart2='</smslist>';
    $smsList='';

//Now create sms list
file_put_contents($smsFile,$smsPart1.$smsContentList.$smsPart2);

}

function getSmsContent(){
    $smsFile='sms.xml';
    return file_get_contents($smsFile);
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

?>