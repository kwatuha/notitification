<?php
require_once('cf4_HH.php');
function insertMsg($table,$message,$phoneNumber, $sys_track){
    $message=mysql_real_escape_string($message);
    $phoneNumber=mysql_real_escape_string($phoneNumber);
    $created_by= 14;
    $date_created=date('Y-m-d');
    $uuid=genUuid();
    $voided="0";
    $insertSQl= "Insert into $table (phone_number,message,date_created,created_by,voided,sys_track,uuid) values
                        ('$phoneNumber','$message','$date_created','$created_by','$voided','$sys_track','$uuid')";

	$Result1 = mysql_query($insertSQl) or die($insertSQl);

}


$row=getMSAccData();

insertRawData($row);
$latest=selectLatestData();

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

function getTemplate($custID){
return 1;
}

function getTemplateByLanguage($Language,$type){
   $Language=trim(strtoupper($Language));
   $type=trim(strtoupper($type));
    $sql="select smsmsgcust_id from sms_smsmsgcust where ucase(smsmsgcust_name) like '$Language $type'";
    $message='';
    $Rcd_tbody_results = mysql_query($sql) or die($sql); //mysql_error()
         while ($rows=mysql_fetch_array($Rcd_tbody_results)){
        $message=$rows['smsmsgcust_id'];
        } 
        return trim($message);
}

function insertRawData($rows){

    foreach ($rows as $row) {
        $values= '"'.$row['MARPs_No'] . '","'. $row['Q1_ClientName']. '","'. $row['Q2_Phone'] 
        .'","'. $row['QA3_RegDate'].'","'. $row['Appointment_Date'].'","'
        . $row['Language'].'","'. $row['GetSMS'].'"';
        $sql ="Insert into sms_msgraw(MARPs_No,Q1_ClientName,Q2_Phone,QA3_RegDate,Appointment_Date,Language,GetSMS
        ) values($values)";
        $exists=findRow($row['MARPs_No'],$row['Q2_Phone'],$row['Q1_ClientName'],$row['Appointment_Date'],$row['Language'],$row['GetSMS'],$row['QA3_RegDate']);
		$formatedPhoneNumber=formatPhoneNumber(trim($row['Q2_Phone']));
		if ( $formatedPhoneNumber){
			        if($exists[0]['EXISTS']==0)
        $result = mysql_query($sql) or die($sql);//mysql_error());
		}

    
    }
    
}

function findRow($MARPs_No,$Q2_Phone,$Q1_ClientName,$Appointment_Date,$Language,$GetSMS,$QA3_RegDate){
    $sql="
      
    SELECT EXISTS(select MARPs_No from sms_msgraw where 
    ucase(MARPs_No) like '$MARPs_No' and
    ucase(Q2_Phone) like '$Q2_Phone' and
    ucase(Q1_ClientName) like '$Q1_ClientName' and
    Appointment_Date = '$Appointment_Date' and
    ucase(Language) like '$Language' and
    ucase(GetSMS) like '$GetSMS' and
    QA3_RegDate = '$QA3_RegDate'
    )   
    
    "; 
    
    $Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
    return mysql_fetch_array($Rcd_tbody_results);
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

function checkDuplicateMessage($findMessage,$phone,$table){
        $sql="select message from  $table  where message like '$findMessage' and phone_number like  '$phone' ";
        $message ='';
        $Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
         while ($rows=mysql_fetch_array($Rcd_tbody_results)){
        $message=$rows['message'];
        }        
        return trim($message);       
}

function selectLatestData(){
    $sql="select  lv.MARPs_No,v.Q1_ClientName, v.Q2_Phone,lv.QA3_RegDate,lv.Appointment_Date, Language,GetSMS, lv.QA3_RegDate,
    lv.Appointment_Date
    ,DATE_ADD(lv.Appointment_Date, INTERVAL -7 DAY) as first_rmr
    ,DATE_ADD(lv.Appointment_Date, INTERVAL -3 DAY) as second_rmr
    ,DATE_ADD(lv.Appointment_Date, INTERVAL -1 DAY)  as third_rmr
    
     from sms_msgraw v 
    inner join (select MARPs_No, max(QA3_RegDate) QA3_RegDate ,max(Appointment_Date) Appointment_Date from sms_msgraw group by MARPs_No) lv on lv.MARPs_No=v.MARPs_No
    where  v.QA3_RegDate=lv.QA3_RegDate and v.Appointment_Date=lv.Appointment_Date  and v.GetSMS='Y' order by lv.MARPs_No 
   
   ";
    
    $Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
    while ($rows=mysql_fetch_array($Rcd_tbody_results)){
        // $message=$rows['message'];
        addRecordsToSmsQueue($rows);
        }

    
}

function addRecordsToSmsQueue($book){
  
    // print_r($row);
    if ($book) {
        // $messageTypeId=getTemplate($book['MARPs_No']);
       
        $dataRow='';
        $sys_track='reminder';
        $regDate=date("d-m-Y",strtotime($book['QA3_RegDate']));
        $appointmentDate=date("d-m-Y",strtotime($book['Appointment_Date']));
        $GetSMS=trim($book['GetSMS']);
        $Language=trim($book['Language']);
        $first_rmr=date("d-m-Y",strtotime($book['first_rmr']));
        $second_rmr=date("d-m-Y",strtotime($book['second_rmr']));
        $third_rmr=date("d-m-Y",strtotime($book['third_rmr']));
       
        $name = $book['Q1_ClientName'];
        $regDate= date("d-m-Y", strtotime($regDate));
        $today=date("d-m-Y");

        $phoneNumber=$book['Q2_Phone'];
        $table='sms_msgqueue';
        $phoneNumber ='0703399915';        
        // $regDate = '2018-05-10';
		// $today='2018-05-10';
        // $first_rmr='2018-05-10';
		//echo $GetSMS;
        if($GetSMS =='Y'){
            if($today == $regDate){
				//echo $GetSMS."Mine";
                $messageTypeId=getTemplateByLanguage($Language,'Appreciation');            
                $message= customizeMessage($messageTypeId,$name,$appointmentDate,$regDate, $Language);
    
                       
                        $messageExists=checkDuplicateMessage(trim($message),$phoneNumber,'sms_msgqueue');
                        $isSent=checkDuplicateMessage(trim($message),$phoneNumber,'sms_msgsent');
                        if(!$messageExists && !$isSent &&  strlen( trim($message))>2 ){
                            insertMsg($table,$message,$phoneNumber,'Appreciation');
                        }
                        
                
            }
            if($today == $first_rmr || $today == $second_rmr || $today == $third_rmr){
                $messageTypeId=getTemplateByLanguage($Language,'Reminder');
                $message= customizeMessage($messageTypeId,$name,$appointmentDate,$regDate, $Language);                
                $messageExists=checkDuplicateMessage(trim($message),$phoneNumber,'sms_msgqueue');
                $isSent=checkDuplicateMessage(trim($message),$phoneNumber,'sms_msgsent');
                
                        if(!$messageExists && !$isSent &&  strlen( trim($message))>2){
                            insertMsg($table,$message,$phoneNumber,'Reminder');
                        }
            }

        }

   
    }
}
function getMSAccData() {
$dbName = "E:\Project\SMS\UGUNJA\IRDOv1_UGUNJA_KP_be.mdb";

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
where tblKPFSWFollowUp.QA3_RegDate<tblKPFSWFollowUp.Q26g_Appointment_Date and  tblKPFSWFollowUp.Q2_Phone <> '' and tblKPFSWFollowUp.GetSMS='Y'

union
SELECT Distinct tblKPMSMScreeningA.UniversalNo, tblKPMSMScreeningA.Q1_ClientName,tblKPMSMScreeningA.MARPs_No, 30 as Q4_Age, tblKPMSMFollowUp.Q4_KPType, tblKPMSMFollowUp.Q2_Phone, tblKPMSMFollowUp.QA3_RegDate,
tblKPMSMFollowUp.Q26g_Appointment_Date as Appointment_Date ,tblKPMSMFollowUp.GetSMS,tblKPMSMFollowUp.Language
FROM tblKPMSMScreeningA INNER JOIN tblKPMSMFollowUp ON tblKPMSMScreeningA.MARPs_No = tblKPMSMFollowUp.MARPs_No
where tblKPMSMFollowUp.QA3_RegDate<tblKPMSMFollowUp.Q26g_Appointment_Date and  tblKPMSMFollowUp.Q2_Phone <> '' and tblKPMSMFollowUp.GetSMS='Y'

union
SELECT Distinct tblKPIWDScreening.UniversalNo,tblKPIWDScreening.Q1_ClientName, tblKPIWDScreening.MARPs_No, 30 as Q4_Age, tblKPIWDFollowUp.Q4_KPType, tblKPIWDFollowUp.Q2_Phone, tblKPIWDFollowUp.QA3_RegDate, 
tblKPIWDFollowUp.Q26g_Appointment_Date as Appointment_Date ,tblKPIWDFollowUp.GetSMS,tblKPIWDFollowUp.Language
FROM tblKPIWDScreening INNER JOIN tblKPIWDFollowUp ON tblKPIWDScreening.MARPs_No = tblKPIWDFollowUp.MARPs_No
where tblKPIWDFollowUp.QA3_RegDate<tblKPIWDFollowUp.Q26g_Appointment_Date and   tblKPIWDFollowUp.Q2_Phone <> '' and  tblKPIWDFollowUp.GetSMS='Y'
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