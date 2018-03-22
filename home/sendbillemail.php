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
require('bill/bill.php');
?><?php
// define('GUSER', 'nzoiawaterservices@gmail.com'); // Gmail username
// define('GPWD', 'Kitale1010'); // Gmail password
define('GUSER', 'bills@nzoiawater.or.ke'); // Gmail username
define('GPWD', 'bills@2017'); // Gmail password
require_once('../phpmailer/class.phpmailer.php');
include('../template/functions/menuLinks.php');
include('../Connections/bill_access.php');
// include('Function.Array-Group-By.php');
function smtpMailBills($to, $from, $from_name, $subject, $body,$mailAttachment) {
       global $error;
       $mail = new PHPMailer();  // create a new object
       $mail->IsSMTP(); // enable SMTP
       $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
       $mail->SMTPAuth = true;  // authentication enabled
       $mail->SMTPSecure = 'tls';//'ssl'; // secure transfer enabled REQUIRED for Gmail
       $mail->Host = 'mail.nzoiawater.or.ke';
       $mail->Port = 587;
       $mail->Username = GUSER;  
       $mail->Password = GPWD;         
       $mail->AddStringAttachment($mailAttachment,'bill.pdf');         
       $mail->SetFrom($from, $from_name);
       $mail->Subject = $subject;
       $mail->Body = $body;
       $mail->AddAddress($to);
       if(!$mail->Send()) {
               $error = 'Mail error: '.$mail->ErrorInfo;
			   
			   echo "  Mail error eeeeeeeeeeeee  $status $status,$period,$Year,$zone,$emailAddress,$ConnectionNumber ".$status;
               return  $error;
       } else {
		   echo "  Message sent Mail error eeeeeeeeeeeee  $status $status,$period,$Year,$zone,$emailAddress,$ConnectionNumber ".$status;
               $error = 'Message sent!';
               return 1;
       }
}
?><?php
  //  sendBillInformation(1212,'kwatuha@gmail.com',5001212,'November 2013 Water Bill','Nov Water Bill') ;
   //sendBillInformation($emailhandle_id,$email_address,$connection_number,$message,$emailsubject);	nc
sendAllQueuedEmails();

function getBillInfo(){
  $bills=getMSAccData();
  $revisedBills=array();
  foreach ($bills as $bill) {
    $connectionNum=$bill['Connection number'];
    $revisedBills[$connectionNum][]=$bill;
    }
   array_walk($revisedBills, 'parseBills');

}

function sendAllQueuedEmails(){
    $sql="select billyear_id,billmonth_id,zone from sms_emailhandle ";
    $Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
    while ($rows=mysql_fetch_array($Rcd_tbody_results)){
        $year=trim($rows['billyear_id']);
		 $month=trim($rows['billmonth_id']);
        $zone=trim($rows['zone']);
		$connection_number='';
        $bills=getMSAccData($zone,$connection_number,$month,$year);
		       //getMSAccData($zone,$connection_number,$month,$year);
            $revisedBills=array();
              foreach ($bills as $bill) {
                $connectionNum=trim($bill['Connection number']);
                $revisedBills[$connectionNum][]=$bill;
				
                }
          array_walk($revisedBills, 'parseBills');
        
    }

}

function parseBills($item, $key) {
    $emailAddress=$item[0][2];
    $ConnectionNumber=$item[0][1];
    $billDate=date('d-m-Y', strtotime($item[0][25]));
    $zone=$item[0][0];
	$Year=trim($item[0][5]);
	$period=trim($item[0][4]);

    $emailfrom="bills@nzoiawater.or.ke";
    $mailto= 'pkakai@nzoiawater.or.ke'; 
	//$mailto= 'kwatuha@gmail.com';
    $namefrom="Nzoia Water";
    $emailsubject= 'Bill_'.date('M_Y', strtotime($billDate)).' For Connection No. '.$ConnectionNumber;
    $billDueDate=date('d-m-Y', strtotime($item[0][25]. ' + 14 days'));
    
    $emailbody= ' Please find attached bill for period '.date('M Y', strtotime($billDate))."."
	             ."\n Pay your bill before $billDueDate to avoid disconnection."
				 ."\n Pay through:\n 1) Mpesa Business number 548600, enter your Connection number as Account no."
				 ."\n".' 2) KCB Webuye Branch bank a/c no. 1107155924'
				 ."\n\n Nzoia Water Services Company.\n Maji Safi Maisha Poa";


    $pdfDoc=getBillDoc($item);
    $status= smtpMailBills($mailto, $emailfrom, $namefrom, $emailsubject, $emailbody,$pdfDoc);
	echo " eeeeeeeeeeeee  $status $status,$period,$Year,$zone,$emailAddress,$ConnectionNumber ".$status;
    if($status==1){
         emailTrack(2,$period,$Year,$zone,$emailAddress,$ConnectionNumber);
         removeFromMailQueue('sms_emailhandle',$ConnectionNumber,$period,$Year,$emailAddress,$zone);
    }else{
		echo " rrrrrrrrrr  $status $status,$period,$Year,$zone,$emailAddress,$ConnectionNumber ";
        trackFailedEmails($status,$period,$Year,$zone,$emailAddress,$ConnectionNumber);
        removeFromMailQueue('sms_emailhandle',$ConnectionNumber,$period,$Year,$emailAddress,$zone);
    }

}

function sendBillInformation($handlerId,$email,$connection_number,$message,$emailsubject){

$emailfrom="bills@nzoiawater.or.ke";
$mailto=$email;
$namefrom="Nzoia Water";
$emailsubject=$emailsubject;
$emailbody= $message;

$billData=getMSAccData();
sendCustomerBills($billData);
    //   echo  $reasonFailed;
		// if ($reasonFailed==1) 
    // {
			   
         
    //       saveSentEmails($handlerId,$mailto,$connection_number,$message,$date_created,$created_by);
		// }
    // else{
    //       saveFailedEmails($handlerId,$email,$connection_number,$message,$date_created,$created_by,$reasonFailed);
    // }
}
 // sendAllBillsByEmail();
function sendAllBillsByEmail(){
$qry="SELECT emailhandle_id,connection_number, email_address, amount, pay_before,sys_track FROM  sms_emailhandle order by emailhandle_id asc";
	$resultsSelect=mysql_query($qry) or die('Could not execute the query');
	$cntreg_stmnt=mysql_num_rows($resultsSelect);
    // echo $qry;
		if($cntreg_stmnt>0){	
$created_by= $_SESSION['my_useridloggened'];
$date_created=date('Y-m-d');
$uuid=gen_uuid();
$stdcolumnsinster="date_created,voided,uuid";
$stdcolumnsvals="'$date_created','$voided','$uuid'";
				while($rws=mysql_fetch_array($resultsSelect)){
				$count++;
				$emailhandle_id=$rws['emailhandle_id'];
				$ac=$rws['connection_number'];
				$connection_number=$rws['connection_number'];
				$email_address=$rws['email_address'];
				$message=$rws['amount'];
				$billdate=$rws['pay_before'];
				$commtype=trim($rws['sys_track']);
        $emailsubject='Bill Notification For:  Connection No. '.$connection_number.' Due For Payment By '.$billdate;
        //collect email details
          $smsArrayDetails=fillPrimaryData('sms_smsmsgcust',3);
      				$custmsg=$smsArrayDetails['message'];
      				$usecustmsg=trim(strtoupper($smsArrayDetails['status']));
      				 			
      				$messagecut=str_replace('{connectionID}',$connection_number,$custmsg); 
      				$message=str_replace('{amount}',$message,$messagecut);
      				$message=str_replace('{bill_date}',$billdate,$message);
      			      
      			sendBillInformation($emailhandle_id,$email_address,$connection_number,$message,$emailsubject);	
        //
        
        }
        
             
        
  }


}

function saveSentEmails($handlerId,$email_address,$connection_number,$message,$date_created,$created_by){
$uuid=gen_uuid();
$insertSQl= "Insert into sms_processedemail (email_address,connection_number,message,date_created,created_by,uuid) 
        values ('$email_address','$connection_number','$message','$date_created','$created_by','$uuid')";
				
				$results=mysql_query($insertSQl) or die('Could not execute the query');
				  
				//delete from handler
				$deleteSQl= "Delete from  sms_emailhandle where emailhandle_id=$handlerId";
				$results=mysql_query($deleteSQl) or die('Could not execute the query');

}

function saveFailedEmails($handlerId,$email_address,$connection_number,$message,$date_created,$created_by,$reasonFailed){
$uuid=gen_uuid();
$insertSQl= "Insert into sms_processedfailedemail (email_address,connection_number,message,date_created,created_by,uuid,reason_failed) 
        values ('$email_address','$connection_number','$message','$date_created','$created_by','$uuid','$reasonFailed')";
				
				$results=mysql_query($insertSQl) or die('Could not execute the query');
				
				//delete from handler
				$deleteSQl= "Delete from  sms_emailhandle where emailhandle_id=$handlerId";
				$results=mysql_query($deleteSQl) or die('Could not execute the query');

}
?>