<?php
restrictaccess();
function restrictaccess(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
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

$MM_restrictGoTo = "../../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
?><?php
include('../template/functions/menuLinks.php');
$grosspa=trim($_GET['p']);
$all=trim($_GET['a']);
$d=trim($_GET['d']);
$total=$grosspa+$all;


$relief=1162;
  $taxablepay=$total-200;
  $TotalTax=PayeCal($taxablepay);
  $paye=$TotalTax-$relief;
  $netpay=$total-$d;
  $netpay=number_format(($netpay-$paye),2);
  $third=number_format(($total/3),2);
  $totalgrouss=number_format($total,2);
  $taxablepay=number_format($taxablepay,2);
  
  echo "function filltaxInfo(){
        Ext.getCmp('grosspay').setValue('$totalgrouss');
        Ext.getCmp('taxable').setValue('$taxablepay');
	    Ext.getCmp('payetax').setValue('$TotalTax');
		Ext.getCmp('relief').setValue('$relief');
		Ext.getCmp('paye').setValue('$paye');
		Ext.getCmp('1third').setValue('$third');
		Ext.getCmp('netpay').setValue('$netpay');
		
  }filltaxInfo();";
  ?>