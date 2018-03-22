<?php

$hostname_c4g = "localhost";
$username_c4g = "Kitale";
$password_c4g = "Admin2010@#";
$database_c4g = "ktldb2017";
 $_SESSION['voideindb']=$database_c4g ;
$c4g = mysql_pconnect($hostname_c4g, $username_c4g, $password_c4g) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_c4g, $c4g);

function insertMsg($table,$message,$phoneNumber, $sys_track){
    $message=mysql_real_escape_string($message);
    $phoneNumber=mysql_real_escape_string($phoneNumber);
    $created_by= 14;
    $date_created=date('Y-m-d');
    $uuid=genUuid();
    // $sys_track='1223';
    $voided="0";
    $insertSQl= "Insert into $table (phone_number,message,date_created,created_by,voided,sys_track,uuid) values
                        ('$phoneNumber','$message','$date_created','$created_by','$voided','$sys_track','$uuid')";

	$Result1 = mysql_query($insertSQl) or die($insertSQl);

}


$row=getMSAccData();
addRecordsToSmsQueue($row);
function getTemplate($custID){
return 1;
}



function customizeMessage($messageTypeId,$name,$appointmentDate,$regDate){
    $message="" ;    
  if($messageTypeId){
       $message=getMessage($messageTypeId);
       $message=str_replace('{name}',$name,$message);
       $message=str_replace('{appointmentDate}',$appointmentDate,$message);
       $message=str_replace('{regDate}',$regDate,$message);
       
  } 
           
return $message;
}

function getMessage($messageTypeId){
    $sql="select message from sms_smsmsgcust where smsmsgcust_id like '$messageTypeId'";
    $Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
     while ($rows=mysql_fetch_array($Rcd_tbody_results)){
    $message=$rows['message'];
    }
    
    return trim($message);
    
    }

function checkDuplicateMessage($message){
        $sql="select message from sms_msgqueue where message like '$message'";
        $query_Rcd_getbody= $sql;
        $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
         while ($rows=mysql_fetch_array($Rcd_tbody_results)){
        $message=$rows['message'];
        }
        
        return trim($message);
        
}
function addRecordsToSmsQueue($row){
    foreach ($row as $book) {
        // $messageTypeId=getTemplate($book['MARPs_No']);
        $dataRow='';
        $sys_track='reminder';
        $regDate=date("d-m-Y",strtotime($book['QA3_RegDate']));
        $appointmentDate=date("d-m-Y",strtotime($book['Appointment_Date']));
        $first_rmr=date("d-m-Y",strtotime($book['first_rmr']));
        $second_rmr=date("d-m-Y",strtotime($book['second_rmr']));
        $third_rmr=date("d-m-Y",strtotime($book['third_rmr']));
       
        $name = $book['Q1_ClientName'];
        $regDate= date("d-m-Y", strtotime($regDate));
        $today=date("d-m-Y");

        $phoneNumber=$book['Q2_Phone'];
        $table='sms_msgqueue';
        
        if($today==$regDate){
            $messageTypeId=2;
            $message= customizeMessage($messageTypeId,$name,$appointmentDate,$regDate);

                    $messageExists=checkDuplicateMessage(trim($message));
                    if(!$messageExists){
                        insertMsg($table,$message,$phoneNumber,$sys_track);
                    }
            
        }
        if($today==$second_rmr || $today==$second_rmr || $today==$third_rmr){
            $messageTypeId=1;
            $message= customizeMessage($messageTypeId,$name,$appointmentDate,$regDate);
            $messageExists=checkDuplicateMessage(trim($message));
                    if(!$messageExists){
                        insertMsg($table,$message,$phoneNumber,$sys_track);
                    }
        }
   
    }
}
function getMSAccData() {
$dbName = "D:\impactRDO\db\IRDOv1_SIAYA_KP_be_Test.mdb";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=root; Pwd='';");

$sql = "select t2.MARPs_No,t2.Q1_ClientName, t2.Q2_Phone,t2.QA3_RegDate,t4.Appointment_Date
,DateAdd('d', -7, t4.Appointment_Date) as first_rmr
,DateAdd('d', -3, t4.Appointment_Date) as second_rmr
,DateAdd('d', -1, t4.Appointment_Date) as third_rmr

 from
(select  t1.MARPs_No,t1.Q1_ClientName,t1.Q2_Phone, MAX(t1.QA3_RegDate) as QA3_RegDate
from 
(SELECT Distinct tblKPFSWScreeningA.UniversalNo, tblKPFSWScreeningA.Q1_ClientName,tblKPFSWScreeningA.MARPs_No, 30 as Q4_Age, tblKPFSWFollowUp.Q4_KPType, tblKPFSWFollowUp.Q2_Phone, tblKPFSWFollowUp.QA3_RegDate, 
tblKPFSWFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPFSWScreeningA INNER JOIN tblKPFSWFollowUp ON tblKPFSWScreeningA.MARPs_No = tblKPFSWFollowUp.MARPs_No
where tblKPFSWFollowUp.QA3_RegDate<tblKPFSWFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPMSMScreeningA.UniversalNo, tblKPMSMScreeningA.Q1_ClientName,tblKPMSMScreeningA.MARPs_No, 30 as Q4_Age, tblKPMSMFollowUp.Q4_KPType, tblKPMSMFollowUp.Q2_Phone, tblKPMSMFollowUp.QA3_RegDate,
tblKPMSMFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPMSMScreeningA INNER JOIN tblKPMSMFollowUp ON tblKPMSMScreeningA.MARPs_No = tblKPMSMFollowUp.MARPs_No
where tblKPMSMFollowUp.QA3_RegDate<tblKPMSMFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPIWDScreening.UniversalNo,tblKPIWDScreening.Q1_ClientName, tblKPIWDScreening.MARPs_No, 30 as Q4_Age, tblKPIWDFollowUp.Q4_KPType, tblKPIWDFollowUp.Q2_Phone, tblKPIWDFollowUp.QA3_RegDate, 
tblKPIWDFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPIWDScreening INNER JOIN tblKPIWDFollowUp ON tblKPIWDScreening.MARPs_No = tblKPIWDFollowUp.MARPs_No
where tblKPIWDFollowUp.QA3_RegDate<tblKPIWDFollowUp.Q26g_Appointment_Date 
) as t1
group by  t1.MARPs_No,t1.Q1_ClientName,t1.Q2_Phone) as t2

inner join 
(select  t3.MARPs_No,t3.Q2_Phone, MAX(t3.Appointment_Date) as Appointment_Date
from 
(SELECT Distinct tblKPFSWScreeningA.UniversalNo, tblKPFSWScreeningA.MARPs_No, 30 as Q4_Age, tblKPFSWFollowUp.Q4_KPType, tblKPFSWFollowUp.Q2_Phone, tblKPFSWFollowUp.QA3_RegDate, 
tblKPFSWFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPFSWScreeningA INNER JOIN tblKPFSWFollowUp ON tblKPFSWScreeningA.MARPs_No = tblKPFSWFollowUp.MARPs_No
where tblKPFSWFollowUp.QA3_RegDate<tblKPFSWFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPMSMScreeningA.UniversalNo, tblKPMSMScreeningA.MARPs_No, 30 as Q4_Age, tblKPMSMFollowUp.Q4_KPType, tblKPMSMFollowUp.Q2_Phone, tblKPMSMFollowUp.QA3_RegDate,
tblKPMSMFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPMSMScreeningA INNER JOIN tblKPMSMFollowUp ON tblKPMSMScreeningA.MARPs_No = tblKPMSMFollowUp.MARPs_No
where tblKPMSMFollowUp.QA3_RegDate<tblKPMSMFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPIWDScreening.UniversalNo, tblKPIWDScreening.MARPs_No, 30 as Q4_Age, tblKPIWDFollowUp.Q4_KPType, tblKPIWDFollowUp.Q2_Phone, tblKPIWDFollowUp.QA3_RegDate, 
tblKPIWDFollowUp.Q26g_Appointment_Date as Appointment_Date
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