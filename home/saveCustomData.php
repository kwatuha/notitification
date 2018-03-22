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
?>
<?php 

$tablename='';
$stored_value='';
$display_caption='';
$displaytype='';
$actionitem='';

$tablename =trim($_GET['t']); 
$stored_value =trim($_GET['stored_value']); 
$display_caption =trim($_GET['display_caption']); 
$displaytype =trim($_GET['displaytype']); 
$actionitem =trim($_GET['actionitem']); 
$recordid=trim($_GET['recordid']);
$fieldname=trim($_GET['fieldname']);

if($tablename){

if($actionitem=='SaveOpt'){
$custom_id='';
		$insertOptions= "insert into admin_custom values(
		'$custom_id'
		,'$tablename'
		,'$fieldname'
		,'$stored_value'
		,'$display_caption'
		,'$displaytype'
		)";
		if(($stored_value)&&($display_caption)){
	$insertOptionsRecordresults = mysql_query($insertOptions) or die(mysql_error());
}
echo 'Custom Data Added';
}	
if($actionitem=='deleteOpt'){
        $custom_id=$recordid;
		$UpdateOptions= "Delete from admin_custom 
		 where custom_id=$custom_id";
$updateOptionsRecordresults = mysql_query($UpdateOptions) or die(mysql_error());
echo 'Custom Data Deleted';
}

if($actionitem=='updateOpt'){
        $custom_id=$recordid;
		$UpdateOptions= "Update admin_custom Set
		stored_value='$stored_value',display_caption='$display_caption'	,displaytype='$displaytype'
		 where custom_id=$custom_id";

if(($stored_value)&&($display_caption)){
$updateOptionsRecordresults = mysql_query($UpdateOptions) or die(mysql_error());
echo 'Custom Data Updated';
}

}
$UpdateOptions= "Update admin_custom Set displaytype='$displaytype'
		 where tablename='$tablename' AND fieldname='$fieldname'";
$updateOptionsRecordresults = mysql_query($UpdateOptions) or die(mysql_error());

//Update the admin_controller
$controlref=$displaytype.'|admin_custom';
$queryUpdateAdminCtrlRecord= "Update admin_controller 
SET dispaytype='$controlref'  where  
tablename='$tablename' AND fieldname='$fieldname'";
echo '<br>ww'.$queryUpdateAdminCtrlRecord.'<br>'.'<br>';
$RcdqueryAdminCtrlRecordresults = mysql_query($queryUpdateAdminCtrlRecord) or die(mysql_error());
}