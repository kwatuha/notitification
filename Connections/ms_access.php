<?php
restrictaccessMenuDb();
function restrictaccessMenuDb(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized_menuDb($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assumiaccng the visitor is NOT authorized. 
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
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menuDb("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
require_once('cf4_HH.php');
$rows=getMSAccData($zone,$connection_number,$period,$year);

insertRawData($rows);
selectLatestData();
function getMSAccData($zone,$connection_number,$period,$year) {
// $dbName = "D:\impactRDO\db\IRDOv1_SIAYA_KP_be_Test.mdb";
$dbName = "D:\impactRDO\db2\IRDOv1_SIAYA_KP_be_Test_3_18.mdb";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=root; Pwd='';");

$sql = "
select t2.MARPs_No,t2.Q1_ClientName, t2.Q2_Phone,t2.QA3_RegDate,t4.Appointment_Date
,DateAdd('d', -7, t4.Appointment_Date) as first_rmr
,DateAdd('d', -3, t4.Appointment_Date) as second_rmr
,DateAdd('d', -1, t4.Appointment_Date) as third_rmr
,GetSMS
,Language

 from
(select  t1.MARPs_No,t1.Q1_ClientName,t1.Q2_Phone, MAX(t1.QA3_RegDate) as QA3_RegDate,t1.GetSMS,t1.Language
from 
(SELECT Distinct tblKPFSWScreeningA.UniversalNo, tblKPFSWScreeningA.Q1_ClientName,tblKPFSWScreeningA.MARPs_No, 30 as Q4_Age, tblKPFSWFollowUp.Q4_KPType, tblKPFSWFollowUp.Q2_Phone, tblKPFSWFollowUp.QA3_RegDate, 
tblKPFSWFollowUp.Q26g_Appointment_Date as Appointment_Date,tblKPFSWFollowUp.GetSMS,tblKPFSWFollowUp.Language
FROM tblKPFSWScreeningA INNER JOIN tblKPFSWFollowUp ON tblKPFSWScreeningA.MARPs_No = tblKPFSWFollowUp.MARPs_No
where tblKPFSWFollowUp.QA3_RegDate<tblKPFSWFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPMSMScreeningA.UniversalNo, tblKPMSMScreeningA.Q1_ClientName,tblKPMSMScreeningA.MARPs_No, 30 as Q4_Age, tblKPMSMFollowUp.Q4_KPType, tblKPMSMFollowUp.Q2_Phone, tblKPMSMFollowUp.QA3_RegDate,
tblKPMSMFollowUp.Q26g_Appointment_Date as Appointment_Date ,tblKPMSMFollowUp.GetSMS,tblKPMSMFollowUp.Language
FROM tblKPMSMScreeningA INNER JOIN tblKPMSMFollowUp ON tblKPMSMScreeningA.MARPs_No = tblKPMSMFollowUp.MARPs_No
where tblKPMSMFollowUp.QA3_RegDate<tblKPMSMFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPIWDScreening.UniversalNo,tblKPIWDScreening.Q1_ClientName, tblKPIWDScreening.MARPs_No, 30 as Q4_Age, tblKPIWDFollowUp.Q4_KPType, tblKPIWDFollowUp.Q2_Phone, tblKPIWDFollowUp.QA3_RegDate, 
tblKPIWDFollowUp.Q26g_Appointment_Date as Appointment_Date ,tblKPIWDFollowUp.GetSMS,tblKPIWDFollowUp.Language
FROM tblKPIWDScreening INNER JOIN tblKPIWDFollowUp ON tblKPIWDScreening.MARPs_No = tblKPIWDFollowUp.MARPs_No
where tblKPIWDFollowUp.QA3_RegDate<tblKPIWDFollowUp.Q26g_Appointment_Date 
) as t1
group by  t1.MARPs_No,t1.Q1_ClientName,t1.Q2_Phone,t1.GetSMS,t1.Language) as t2

inner join 
(select  t3.MARPs_No,t3.Q2_Phone, MAX(t3.Appointment_Date) as Appointment_Date
from 
(SELECT Distinct tblKPFSWScreeningA.UniversalNo, tblKPFSWScreeningA.MARPs_No, 30 as Q4_Age, tblKPFSWFollowUp.Q4_KPType, tblKPFSWFollowUp.Q2_Phone, tblKPFSWFollowUp.QA3_RegDate, 
tblKPFSWFollowUp.Q26g_Appointment_Date as Appointment_Date ,tblKPFSWFollowUp.GetSMS,tblKPFSWFollowUp.Language
FROM tblKPFSWScreeningA INNER JOIN tblKPFSWFollowUp ON tblKPFSWScreeningA.MARPs_No = tblKPFSWFollowUp.MARPs_No
where tblKPFSWFollowUp.QA3_RegDate<tblKPFSWFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPMSMScreeningA.UniversalNo, tblKPMSMScreeningA.MARPs_No, 30 as Q4_Age, tblKPMSMFollowUp.Q4_KPType, tblKPMSMFollowUp.Q2_Phone, tblKPMSMFollowUp.QA3_RegDate,
tblKPMSMFollowUp.Q26g_Appointment_Date as Appointment_Date, tblKPMSMFollowUp.GetSMS,tblKPMSMFollowUp.Language
FROM tblKPMSMScreeningA INNER JOIN tblKPMSMFollowUp ON tblKPMSMScreeningA.MARPs_No = tblKPMSMFollowUp.MARPs_No
where tblKPMSMFollowUp.QA3_RegDate<tblKPMSMFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPIWDScreening.UniversalNo, tblKPIWDScreening.MARPs_No, 30 as Q4_Age, tblKPIWDFollowUp.Q4_KPType, tblKPIWDFollowUp.Q2_Phone, tblKPIWDFollowUp.QA3_RegDate, 
tblKPIWDFollowUp.Q26g_Appointment_Date as Appointment_Date , tblKPIWDFollowUp.GetSMS,tblKPIWDFollowUp.Language
FROM tblKPIWDScreening INNER JOIN tblKPIWDFollowUp ON tblKPIWDScreening.MARPs_No = tblKPIWDFollowUp.MARPs_No
where tblKPIWDFollowUp.QA3_RegDate<tblKPIWDFollowUp.Q26g_Appointment_Date 
) as t3
group by  t3.MARPs_No,t3.Q2_Phone) as t4
on t2.MARPs_No=t4.MARPs_No


"; 

 $result = $db->query($sql) or print_r ( $db->errorInfo());
 $row = $result->fetchAll();

$i = 1;
return $row;
}

function addRecordToSmsQueue($row){
    foreach ($row as $book) {
        echo $book['MARPs_No'] . '-- '. $book['Q2_Phone']. '-- '. $book['Appointment_Date'].' ------- '. $book[7];
        // print_r($row);
        echo "<br>";
    
    }
}

function insertRawData($rows){

    foreach ($rows as $row) {
        echo $row['MARPs_No'] . '-- '. $row['Q2_Phone']. '-- '. $row['Appointment_Date'].' ------- '. $row['Language'].'","'. $row['GetSMS'].'"';
        $values= '"'.$row['MARPs_No'] . '","'. $row['Q1_ClientName']. '","'. $row['Q2_Phone'] 
        .'","'. $row['QA3_RegDate'].'","'. $row['Appointment_Date'].'","'
        . $row['Language'].'","'. $row['GetSMS'].'"';
        $sql ="Insert into sms_msgraw(MARPs_No,Q1_ClientName,Q2_Phone,QA3_RegDate,Appointment_Date,GetSMS
        ,Language) values($values)";
        $result = mysql_query($sql) or die(mysql_error());
    
    }
    
}

function selectLatestData(){
    $sql="select  lv.MARPs_No,v.Q1_ClientName, v.Q2_Phone,lv.QA3_RegDate,lv.Appointment_Date, Language,GetSMS
    from sms_msgraw v 
   inner join (select MARPs_No, max(QA3_RegDate) QA3_RegDate ,max(Appointment_Date) Appointment_Date from sms_msgraw group by MARPs_No) lv on lv.MARPs_No=v.MARPs_No
   where  v.QA3_RegDate=lv.QA3_RegDate and v.Appointment_Date=lv.Appointment_Date order by lv.MARPs_No 
   
   ";
    
    $results = mysql_query($sql) or die(mysql_error());
    return mysql_fetch_array($results);

    
}
function addToQueue($bills,$zone,$month,$year,$trackType){

  foreach ($bills as $bill) {
       $emailAddress=str_replace('.com.','.com',trim($bill[2]));
	     $emailAddress=trim(str_replace(' ','',$emailAddress));
       $emailAddress=trim(str_replace("'",'',$emailAddress));
       $ConnectionNumber=trim($bill[1]);
	   $trackType=1;
       emailTrack($trackType,$month,$year,$zone,$emailAddress,$ConnectionNumber);
    }
   
}

			
function emailTrack($trackType,$month,$year,$zone,$emailAddress,$ConnectionNumber){
                        
                        $created_by=$_SESSION['my_useridloggened'];
                        $date_created=date('Y-m-d');
                        $uuid=gen_uuid();
						//$billDate=date('Y-m-d',strtotime($billDate));
                        if($trackType==1){
                            $emailArr=explode('@',$emailAddress) ;
                            $myvalidemail=$emailArr[1]  ;
							
					
                            if(sizeof($emailArr)>1){
                               $table='sms_emailhandle';
                            }
                            else{
                              $table='sms_invalidemailaddress';
                            }
                        }

                        if($trackType==2){
                            $table='sms_processedemail';
                        }

                        if($trackType==3){
                            $table='sms_processedfailedemail';
                        }

                        $insertSQl= "Insert into $table (connection_number,billmonth_id,billyear_id,email_address,zone,
                        date_created,
                        changed_by,
                        date_changed,
                        voided,
                        voided_by,
                        date_voided,
                        uuid) values ('$ConnectionNumber','$month','$year','$emailAddress','$zone',
                        '$date_created',
                        '$changed_by',
                        '$date_changed',
                        '$voided',
                        '$voided_by',
                        '$date_voided',
                        '$uuid')";
						
				
                            $connectionExists=checkDuplicatEmails($table,$ConnectionNumber,$month,$year,$emailAddress,$zone);

                                if($connectionExists ==''){
                                $Result1 = mysql_query($insertSQl) or die(mysql_error());
                                if($trackType==2){
                                removeFromMailQueue('sms_emailhandle',$ConnectionNumber,$month,$year,$emailAddress,$zone);
                                }
                                }

                        

                
}

function trackFailedEmails($reasonFailed,$month,$year,$zone,$emailAddress,$ConnectionNumber){
    $insertSQl= " Insert into sms_processedfailedemail (connection_number,billmonth_id,billyear_id,email_address,zone,reason_failed,
                        date_created,
                        changed_by,
                        date_changed,
                        voided,
                        voided_by,
                        date_voided,
                        uuid) values ('$ConnectionNumber','$month','$year','$emailAddress','$zone','$reasonFailed',
                        '$date_created',
                        '$changed_by',
                        '$date_changed',
                        '$voided',
                        '$voided_by',
                        '$date_voided',
                        '$uuid')";

                        $Result1 = mysql_query($insertSQl) or die(mysql_error());
}

function checkDuplicatEmails($table,$conncetionId,$month,$year,$emailAddress,$zone){
//$billDate=date('Y-m',strtotime($billDate));
$sql="select connection_number from $table 
where connection_number like '$conncetionId'
AND billmonth_id = '$month'
AND billyear_id = '$year'
AND email_address like '$emailAddress'
AND zone like '$zone'

";
//echo $sql;
$result = mysql_query($sql) or die(mysql_error());
$connection='';
 while ($rows=mysql_fetch_array($result)){
      $connection=$rows['connection_number'];
	  //echo $connection.'-----------------------------';
}


return trim($connection);

}

function removeFromMailQueue($table,$conncetionId,$month,$year,$emailAddress,$zone){
//$billDate=date('Y-m',strtotime($billDate));
$delSql="delete from $table 
where connection_number like '$conncetionId'
AND billyear_id= '$year'
AND billmonth_id= '$month'
AND email_address like '$emailAddress'
AND zone like '$zone'

";
$result = mysql_query($delSql) or die(mysql_error());
}

?>