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
require_once('../PHPMailer/class.phpmailer.php');
///sms
include('../template/functions/menuLinks.php');

//echo $_POST['q'].'  '.$_POST['t'];
if($_POST['strfillrptdsgnr']){
$r=fillRptFields($_POST['strfillrptdsgnr']);
$query_show=str_replace("\r", "\\n",$r['cols']);
$query_show=str_replace("\n", "\\n",$query_show);
$query_hide=str_replace("\r", "\\n",$r['pdfcols']);
$query_hide=str_replace("\n", "\\n",$query_hide);
		
echo "function fillrpts(){
Ext.getCmp('query_show').setValue('".$query_show."');
Ext.getCmp('query_hide').setValue('".$query_show."');
Ext.getCmp('pdf_column').setValue('".$query_hide."'); 
} 
fillrpts();";
}
if($_POST['insdbstmntpr']){
$dbnoteid=trim($_POST['insdbstmntpr']);
 $displayvalues=getDBNoteSummary($dbnoteid);
$amount_insured=$displayvalues['amount_insured'];
$basic_premium=$displayvalues['basic_prem'];
$pcfamount=$displayvalues['pcfamount'];
$levyamount=$displayvalues['levyamount'];
$stamp_duty=$displayvalues['stampduty'];
$total=$displayvalues['totalpremium'];
$period_to=$displayvalues['period_to'];
$period_from=$displayvalues['period_from'];

echo "
function fillInsuranceApprovalData(){
Ext.getCmp('inssumassured').setValue('$amount_insured');
Ext.getCmp('inspremium').setValue('$basic_premium');
Ext.getCmp('inslevyamount').setValue('$levyamount');
Ext.getCmp('inspcfamount').setValue('".$pcfamount."');
Ext.getCmp('insstamp_duty').setValue('$stamp_duty');
Ext.getCmp('instotal').setValue('$total');
Ext.getCmp('insperiod_from').setValue('".$period_from."');
Ext.getCmp('insperiod_to').setValue('".$period_to."');
}
fillInsuranceApprovalData();
";
}
if($_POST['q']!=''){
		$foundrecordid=trim(strtoupper($_POST['q']));
		$category=trim($_POST['c']); 
		
		
		$acc=" Where  ucase(accounts_accaccount.accaccount_name) like '$foundrecordid' AND accounts_accountactivity.accountscategory_id='$category' 
		";
		
		$sql=$sourcetable=str_replace('{where}',$acc,$_SESSION['paymentbyaccount']);
		
		
		$accts=calculateAccTotals($sql);
		$totalpaidArr=explode('|',$accts[4]);
		
		$accRent=" Where  ucase(accounts_accaccount.accaccount_name) like '$foundrecordid' ";
		$sqlac=str_replace('{where}',$accRent,$_SESSION['calculateRent']);
		
		$totalPayableRent=calculateRentAccrued($sqlac);
		
		$tpas=$totalPayableRent[0]*(-1);
		$bal=(($tpas+$totalPayableRent[3]+$totalPayableRent[2])-$totalpaidArr[1]);
		$myacc=$totalPayableRent[1];
		$bfrd=trim($accts[2]); 
		if($bfrd=='P'){
		$bal=$bal-$accts[0];
		}else{
		$bal=$bal+$accts[0];
		}
		echo "function fillAccountSummary(){
		Ext.getCmp('taccountid').setValue('$myacc');
		Ext.getCmp('ttotalpenalty').setValue('0.00'); 
		Ext.getCmp('ttotalbf').setValue('$accts[0]');
		Ext.getCmp('telectricity_water').setValue('$totalPayableRent[3]');
		Ext.getCmp('tdeposit').setValue('$totalPayableRent[2]');
		var otype='$bfrd';
		if(otype=='P'){
				 Ext.getCmp('ttotalbf').addCls('markPositiveNumbers');
				 }else{
				 Ext.getCmp('ttotalbf').removeCls('markPositiveNumbers');
				 }
				 
		Ext.getCmp('ttotalrent').setValue('".($totalPayableRent[0]*-1)."');
		Ext.getCmp('ttotalpaid').setValue('$totalpaidArr[1]');
		
		
		Ext.getCmp('tbalance').setValue('$bal');
		         
				 if($bal<0){
				 Ext.getCmp('tbalance').removeCls('markNegativeNumbers');
				 Ext.getCmp('tbalance').addCls('markPositiveNumbers');
				 }else{
				  Ext.getCmp('tbalance').removeCls('markPositiveNumbers');
				 Ext.getCmp('tbalance').addCls('markNegativeNumbers');
				 }
		
						 
		}
		fillAccountSummary();
		";
}
?>