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
?>
<?php require_once('../Connections/cf4_HH.php');
require_once('../template/functions/menuLinks.php');
?>
<?php  
$table_name =trim($_GET['t']);
$table_fieldvalue=trim($_GET['fieldname']);
$selectedSection= trim($_GET['fieldVal']);
 $action= trim($_GET['action']);
 $note1 =trim($_GET['notification1']);
 $note2 =trim($_GET['notification2']);
 $note3 =trim($_GET['notification3']);
 
 
 $sstatus =trim($_GET['sstatus']);
 $usergroup =trim($_GET['usergroup']);
 $comments =trim($_GET['comments']);
 
$currenttable=$table_fieldvalue;
$isActive='Yes';
$todaydate=date('Y-m-d');
 if($action=='InsertUsergroupNotification'){
	if($usergroup ){
					 $note='';
					 if($note1!='NotCheckedToSave'){
					 $note=$note1;
					 }
					 
					 if($note2!='NotCheckedToSave'){
					 $note=$note2;
					 }
					 
					 if($note3!='NotCheckedToSave'){
					 $note=$note3;
					 }
	 
$insertSql=" insert into admin_groupnotification values('','$usergroup','$note','$table_fieldvalue','$sstatus','$comments','$todaydate')";
	 
					 if($note){
					 $RcdQryAlertresults = mysql_query($insertSql) or die(mysql_error());
					 }
   }
 }

if($action=='InsertNotificationTypes'){
	if($table_fieldvalue){
	
			 if($note1!='NotCheckedToSave'){
			  $inserttTypes= "insert into admin_ntg values(
			  '','$table_fieldvalue','$note1','$isActive','$todaydate')  
				  ";
				 if(confirmAlertExists($note1,$currenttable)){
				 $RcdQryAlertresults = mysql_query($inserttTypes) or die(mysql_error());
				 }
			  }
			  if($note2!='NotCheckedToSave'){
				$inserttTypes= "insert into admin_ntg values(
			  '','$table_fieldvalue','$note2','$isActive','$todaydate')  
				  ";
				 if(confirmAlertExists($note2,$currenttable)){
				 $RcdQryAlertresults = mysql_query($inserttTypes) or die(mysql_error());
				 }
			  }
			  if($note3!='NotCheckedToSave'){
			  $inserttTypes= "insert into admin_ntg values(
			  '','$table_fieldvalue','$note3','$isActive','$todaydate')  
				  ";
				if(confirmAlertExists($note3,$currenttable)){
				 $RcdQryAlertresults = mysql_query($inserttTypes) or die(mysql_error());
				 }
			  }
	 
	 }
}
function confirmAlertExists($alertid,$currenttable){
		if($alertid){
			$Sqlgetalert= "select alert_id from admin_ntg where alert_id='$alertid' and tablename='$currenttable'";
			 $RcdQryAlertresults = mysql_query($Sqlgetalert) or die(mysql_error());
			 $cntreg=mysql_num_rows($RcdQryAlertresults);
					 if($cntreg){
					 $alertExists='';
					 }
					 else{$alertExists='NOT';
					 }
		  }
  return $alertExists;
  }
?>