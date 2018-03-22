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
$table=$_POST["id"];
$commtype=$_POST["commtype"];

function clearQueuedSMSScheduleId($scheduleTable,$schedule_id,$actualId){
$qrystat=" Delete from $scheduleTable  where $schedule_id=$actualId ";
$qryreading=mysql_query($qrystat);
} 

if($table=='sms_emailhandle'){
     clearSmsQueues($table);
}else{
       deleteScheduleIds($table);
}

function clearSmsQueues($table){
$hostname_c4g = "localhost";
$username_c4g = "Kitale";
$password_c4g = "Admin2010@#";
$database_c4g = "impact_ksm";
$con=mysqli_connect($hostname_c4g,$username_c4g,$password_c4g,$database_c4g);
mysqli_query($con,"Delete from $table");
}

function deleteScheduleIds($table){
$sql="select distinct sys_track from $table where sys_track like '%_%'";
if($table=='sms_groupqueue')deleteAllRecords($table);
if($table=='sms_generalsmshandle')$sql="select distinct sys_track from $table";

$Rcd_tbody_results = mysql_query($sql) or die(mysql_error());
clearSmsQueues($table);
while ($rows=mysql_fetch_array($Rcd_tbody_results)){
$schedules=explode('_',$rows['sys_track']);


if($schedules[0]=='bill'){
    
   clearQueuedSMSScheduleId('sms_schedule','schedule_id',$schedules[1]) ;  
}
if($schedules[0]=='disconnection'){
 clearQueuedSMSScheduleId('sms_disconnschedule','disconnschedule_id',$schedules[1]) ;  
}

if($table=='sms_generalsmshandle'){
 clearQueuedSMSScheduleId('sms_schedulegeneralsms','schedulegeneralsms_id',$rows['sys_track']) ;  
}

}

} 

function deleteAllRecords($table){
$qrystat=" Delete from $table";
//echo $qrystat;
$qryreading=mysql_query($qrystat);
}
?>