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

$MM_restrictGoTo = "../index.php";
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
//include('../template/functions/menuLinks.php');
?><?php
require('createInvoice.php');
$irs=base64_decode($_GET['i']);
//echo $irs;
$arr=explode('|',$irs);
$tid=$arr[0];
$tpid=$arr[1];;
$tname=$arr[2];
$_SESSION['rptrptend']=$arr[3];
$_SESSION['rptrptref']=$arr[4];
$_SESSION['rptrptstart']=$arr[5];
$_SESSION['rptrptcontractdate']=$arr[6];
$_SESSION['rptrptpaid']=$arr[7];
$_SESSION['rptrptrent']=$arr[8];
$_SESSION['rptrptbf']=$arr[9];
$_SESSION['rptrptbal']=$arr[10]; 
$_SESSION['rptaccountcat']=$arr[11];
$_SESSION['rptrptwater_elec']=$arr[12]; 
$_SESSION['rptdeposit']=$arr[13];
$_SESSION['rptacccategory']=$arr[14];
$_SESSION['rptsyssource']=$arr[15];
$_SESSION['rptlandlordID']=$arr[16];
//$_SESSION['rptaccountid']=436;//$arr[17];
//echo $_SESSION['rptaccountcat'];
$_SESSION['confdbnoteaccount']=$arr[11];
$_SESSION['rptrptname']=$tname;
$_SESSION['ccaccountid']=$arr[0];
$_SESSION['insdebitnoteid']=$arr[17];
	$prefferedContacts=getPrefferedContact('admin_person',$tpid);
	$_SESSION['rptphone']=$prefferedContacts['mobile_number'];
	$_SESSION['rptemailaddress']=$prefferedContacts['email_address']; 
	$_SESSION['rptpostaladdress']=$prefferedContacts['postal_address'];
  

$pdf=new PDF_MC_Table();
$pdf->SetWelcomeData();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$xintent=100;
$labelwidth=35;
$dbid=$_SESSION['insdebitnoteid'];
$noteMotorDtls=getMotorRiskDBN($dbid);
$dbitems=getMotorRiskDBNItems($dbid);
$pdf->createDNAddress($dbid);
$pdf->createDBMotorPolicyDBNote($noteMotorDtls,$dbitems);//createDBSpecific();
//$pdf->createDBClass($dbid);
//$pdf->createDbNoteTotals($dbid);
//$pdf->createPaymentModality($dbid);
//$yloc=$pdf->createIPFrows($dbid);
//$pdf->createNBCheck($dbid,$yloc);
//$pdf->createNBCash($dbid,$yloc);
$pdf->Output();
?>
