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
require_once('../Connections/cf4_HH.php');?><?php
include('../template/functions/menuLinks.php');
?><?php
$account=$_POST['account'];
$tpid=$_POST['pid'];

$tname=$_POST['cname'];
$amount=$_POST['amount'];
$ref=$_POST['ref'];
$payment_mode=$_POST['payment_mode'];
$banked=$_POST['banked'];
$paytype=$_POST['paytype'];
$account=$_POST['account'];
$trans_ref=$_POST['trans_ref'];
$mypst=$_POST['mypst'];
$rcptitemed=$_POST['rcptitemed'];

$naration=$_POST['naration'];
//itemized
$amountDS=$_POST['amountDS'];
$amountS=$_POST['amountS'];
$receipt_id=$_POST['receipt_id'];
$totalamount=$_POST['totalamount'];

$receipt_num=$_POST['receipt_num'];

$grp=$_POST['cystype'];

$tid=base64_encode($account.'|'.$tpid.'|'.$tname.'|'.$payment_mode.'|'.$ref.'|'.$amount.'|'.$banked.'|'.$paytype.'|'.$trans_ref.'|'.$receipt_num.'|'.$naration);

if($mypst=='split'){
$existRcptID=createReceipt($account,$trans_ref);
$fielddata=fillPrimaryData('accounts_receipt',$existRcptID);
  $recptNumber= $fielddata['receipt_name'];

echo "
function OpenRcptTrans(amount,receipt_id,receipt_num,payment_mode,banked,trans_ref,paytype){
createIndivReceiptItems(amount,receipt_id,'Landlord','Jae Ma',receipt_num,'$banked');
}OpenRcptTrans($amount,$existRcptID,'$recptNumber','$payment_mode','$banked','$trans_ref','$paytype');";
}
if($rcptitemed){
$amountDS=explode('|',$amountDS);
$amountS=explode('|',$amountS);
$it=0;
$existReceiptItemID=searchTableValues('accounts_receiptitems',"receipt_id|$receipt_id",0);

if($existReceiptItemID>0){
voidEntry('accounts_receiptitems','receipt_id|'.$receipt_id,2);
}
foreach($amountS as $amt){
$descrpn=trim($amountDS[$it]);
if(($amt>0)&&($descrpn)){
createReceiptItem($receipt_id,$amt,$amountDS[$it]);
}
$it++;
}
echo "
function OpenRcptItemized(descr,amountArr,receipt_id,payment_mode,banked,trans_ref,paytype,totalamount){
var receipt_num= Ext.getCmp('treceipt_num').getValue();
var orign='$grp';
////////////////////////////
if(orign=='INS'){
		var tenantfullname=Ext.getCmp('cinsured').getValue(); 
		var clandlord=Ext.getCmp('cunderwriter').getValue();
		var personname=Ext.getCmp('personreft').getValue();
		var account= Ext.getCmp('insuredaccountid').getValue();
		var tpid= Ext.getCmp('cinsuredpid').getValue();
		var paytype='Premium Receipt';
}else{
var tenantfullname=Ext.getCmp('ctenanat').getValue(); 
var clandlord=Ext.getCmp('clandlord').getValue();
var personname=Ext.getCmp('personreft').getValue();

var account= Ext.getCmp('taccountid').getValue();

var tpid= Ext.getCmp('chousingtenantpid').getValue();
var secelVallid='LLi';
var paytype='Rent Receipt';
}
	
/////////////////

Ext.Ajax.request({
url: 'ereceipt.php',
params:{amount:totalamount,totalamount:totalamount,cname:tenantfullname,
ref:personname,account:account,
pid:tpid,payment_mode:payment_mode,
banked:banked,paytype:paytype,
trans_ref:trans_ref,receipt_num:receipt_num},
success: function(resp){
eval(resp.responseText);
},
failure: function(action){
// you could put an error message here
}
});
							
}OpenRcptItemized('$amountDS','$amountS',$receipt_id,'$payment_mode','$banked','$trans_ref','$paytype',$totalamount);";
}
if(!$rcptitemed&&!$mypst){
echo "
function OpenTransRcpt(){
window.open('../reporting/trcpt.php?i=$tid');
}OpenTransRcpt();";
}
?>