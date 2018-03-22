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
if($_GET['t']!=''){
$activetableBody=trim($_GET['t']);
$query_Rcd_getbody= "SELECT distinct 
controller_id,
tablename,
fieldname,
fieldcaption, 
detailsvisiblepdf,
pdfvisible,
position,
infpos,
colnwidth
FROM admin_controller where tablename='$activetableBody'";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
}
?>
<?php 
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);

while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$controller_id=$count_tbrows[controller_id];

$fieldname=$count_tbrows[fieldname];

$fieldcaption=$_GET[$fieldname.'1'];
$_SESSION[$activetableBody.$fieldname]=$fieldcaption;
$detailsvisiblepdf=$_GET[$fieldname.'2'];
$pdfvisible=$_GET[$fieldname.'3'];
$position=$_GET[$fieldname.'4'];
$colnwidth=$_GET[$fieldname.'5'];
$infshow=$_GET[$fieldname.'6'];
$infpos=$_GET[$fieldname.'7'];
$statementcaption=trim($_GET['statementcpn']);

if($infpos=='')  {
$infpos=0;
}

$updateSQL="Update admin_controller set fieldcaption='$fieldcaption',detailsvisiblepdf='$detailsvisiblepdf',pdfvisible='$pdfvisible',position='$position',infpos='$infpos',infshow='$infshow', colnwidth='$colnwidth' where controller_id='$controller_id' ";

$Resultsupdate = mysql_query($updateSQL) or die(mysql_error());

}

$activetableValue=trim($_GET['activetableValue']);
if($activetableValue){
$_SESSION[$activetableBody]=$activetableValue;
$updateSQLTbl="Update admin_table set table_caption='$activetableValue'  where table_name='$activetableBody' ";
$Resultsupdatetbl = mysql_query($updateSQLTbl) or die(mysql_error());
}
if($statementcaption){
$updateSQLTblstm="Update admin_table set statement_caption='$statementcaption'  where table_name='$activetableBody' ";
$_SESSION['stm'.$activetableBody]=$statementcaption;

$Resultsupdatetblstm = mysql_query($updateSQLTblstm) or die(mysql_error());
}
echo 'Settings Saved';

?>