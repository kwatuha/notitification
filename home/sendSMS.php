<?php
restrictaccessMenu();
function restrictaccessMenu(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized_menu($strUsers, $strGroups, $UserName, $UserGroup) {
  // For security, start by assuming the visitor is NOT authorized.
  $isValid = False;

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
  // Therefore, we know that a user is NOT logged in if that Session variable is blank.
  if (!empty($UserName)) {
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
    // Parse the strings into arrays.
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    // Or, you may restrict access to only certain users based on their username.
    if (in_array($UserGroup, $arrGroups)) {
      $isValid = true;
    }
    if (($strUsers == "") && true) {
      $isValid = true;
    }
  }
  return $isValid;
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menu("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0)
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo);
  exit;
}
}
require_once('../Connections/cf4_HH.php');
?><?php
include('../template/functions/sms/sms_functions.php');
include('../template/functions/menuLinks.php');
$statusAction=$_GET['statusAction'];
 $typeSource=$_GET['type'];
/*if($statusAction=='sendit'){
$msgbox="Ext.Msg.alert('Success', '' + msgout + '\"');";
echo
'
function respondToclient(){
msgout'."='Send Successfully';
$msgbox
};
respondToclient();
";
}*/
//SELECT effective_date , DATE_add(effective_date, INTERVAL 14  DAY) AS 'pay_before'  FROM sms_smsinvalid;
//$currStatus=getSystemStatus();
if($statusAction=='sendit'){
$campanyDetail=fillPrimaryData('admin_company',1);
  $companyname=$campanyDetail['company_name'];



   ///
 if($typeSource=='sms_groupqueue')sendToGroup();
 if($typeSource=='sms_billhandle')
	$qry="SELECT billhandle_id,connection_number, phone_number, amount,proposed_message message, pay_before,sys_track ,smsmsgcust_id
    FROM  sms_billhandle order by billhandle_id asc";

   if($typeSource=='sms_generalsmshandle')
	$qry="SELECT generalsmshandle_id,recepient, phone_number,message,sys_track FROM  sms_generalsmshandle order by generalsmshandle_id asc";

	if($typeSource=='sms_msgqueue')
	$qry="SELECT  phone_number,message,sys_track,msgqueue_id FROM  sms_msgqueue order by msgqueue_id asc";


    if($qry){
		$resultsSelect=mysql_query($qry) or die('Could not execute the query = '+$qry);
		$cntreg_stmnt=mysql_num_rows($resultsSelect);
		$credit=getSmsCreditBalance();
	}


	// echo "rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr   if($cntreg_stmnt>0  && $credit>$cntreg_stmnt ){";
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
				// $connection_number=str_replace("'",' ',$connection_number);
                $recepient=mysql_real_escape_string($rws['recepient']);
				$phone_number=mysql_real_escape_string($rws['phone_number']);
                $message=mysql_real_escape_string($rws['message']);
				$billdate=mysql_real_escape_string($rws['pay_before']);
				$commtype=trim($rws['sys_track']);
				//$message="Please pay Nzoia Water via M-Pesa PayBill No. 548600 $message for Connection No: $ac Before $billdate Thanks for your continued support";

				$commtype=trim($rws['sys_track']);
        $commtypeArray=explode('_',$commtype);
                // echo 'yyyyyyyyyyyyyyyyyyyyyyyyyyyy'.$msgqueue_id;
                $messageId="200".$msgqueue_id;
                $messageListTag.= createSmsTag($phone_number,$message,$messageId);
			    $created_by= $_SESSION['my_useridloggened'];
                $date_created=date('Y-m-d');

				
				
				if($billhandle_id){
	               $insertSQl= "Insert into sms_processedsms (phone_number,connection_number,message,$stdcolumnsinster,sys_track)
                     values ('$phone_number','$connection_number','$message',$stdcolumnsvals,'$commtype')";
                    $deleteSQl= "Delete from  sms_billhandle where billhandle_id=$billhandle_id";

				}

				if($msgqueue_id || $generalsmshandle_id){
	               $insertSQl= "";
					 insertMsg('sms_msgsent',$message,$phone_number,$commtype);
                    $deleteSQl= "Delete from  sms_msgqueue where msgqueue_id=$msgqueue_id";

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
		//    echo 'sssssssssssssssssssssssssssssssssss'.$smsData;
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



?>