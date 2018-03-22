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
?><?php 
require_once('../Connections/cf4_HH.php');     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="images/style.css" />

<script type="text/javascript">

</script>



	<title>-Class Report- </title>
    <style type="text/css">
<!--
.style1 {color: #996666}
-->
    </style>
</head>
<body>
<font face="Georgia, Times New Roman, Times, serif" color="#FF0033" style="font-weight:bold">
<div id="msglabel"></div>
<div id="customerButtons" style=" width:500px;  border:thick; font-size:9px;">
<a href="#" onclick="newconnection(1,0);">New Property</a>&nbsp; 
<a href="#" onclick="newconnection(2,0);">Personal Information</a>&nbsp;
<a href="#" onclick="newconnection(3,0);">Meter-Details</a>&nbsp;
<a href="#" onclick="newconnection(4,0);">Deposit-Details</a>&nbsp;
</div>

<div id=students style="border : solid 3px #0099ff;background : #66ccff; font-size:14px;color : #000000; padding : 2px; width : 500px; height : 350px; overflow : auto;">Main Working Window</div>


</body>	
</html>

