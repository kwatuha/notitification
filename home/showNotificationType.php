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
$table_field =trim($_GET['fieldname']);
$selectedSection= trim($_GET['fieldVal']);
$action= trim($_GET['action']);
 
if($action=='MultInsert'){
    $getAllAlertTypes= "select distinct alert_name,alert_id from admin_alert  
	  ";
     $RcdQryAlertresults = mysql_query($getAllAlertTypes) or die(mysql_error());
	 $cntreg=mysql_num_rows($RcdQryAlertresults);
	 if($cntreg){
	


	 print"<form name=\"myform\" method=\"post\">";
	 $countOpts=1;
			 while($count_ctrls=mysql_fetch_array($RcdQryAlertresults)){
			 $alert_name=$count_ctrls['alert_name'];
			 $alert_id=$count_ctrls['alert_id'];
			echo "<input type=\"checkbox\" value=\"$alert_id\" name=\"alerttype\"   id=\"$table_name$countOpts\" >".$alert_name.'<br>';
			
			$countOpts++;
			 }

print"<div id=\"savesectionoptions\"></div>";
print"<input type=\"button\" name=\"CheckAll\" value=\"Check All\"
onClick=\"checkAllCheckBoxes(document.myform.alerttype)\">
<input type=\"button\" name=\"UnCheckAll\" value=\"Uncheck All\"
onClick=\"uncheckAllCheckboxes(document.myform.alerttype)\">";
$updatestatus='save'.$_SESSION['tablegroup'.$table_name];



			 print"</form>";
	 }
}  



if($action=='IndivInsert'){
    $getAllAlertTypes= "select distinct alert_name,alert_id from admin_alert  where alert_id in(select alert_id from admin_groupnotification) 
	  ";
     $RcdQryAlertresults = mysql_query($getAllAlertTypes) or die(mysql_error());
	 $cntreg=mysql_num_rows($RcdQryAlertresults);
	 if($cntreg){
	


	 print"<form name=\"myform\" method=\"post\">";
	 $countOpts=1;
			 while($count_ctrls=mysql_fetch_array($RcdQryAlertresults)){
			 $alert_name=$count_ctrls['alert_name'];
			 $alert_id=$count_ctrls['alert_id'];
			echo "<input type=\"radio\" value=\"$alert_id\" name=\"alerttype\"   id=\"$table_name$countOpts\" >".$alert_name.'<br>';
$countOpts++;
			 }

print"<div id=\"savesectionoptions\"></div>";


			 print"</form>";
	 }
}


?>