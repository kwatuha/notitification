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
//updateUuidAll('admin_adminuser','2012-02-10');

if($_POST['pid']!=''){
		$foundrecordid=trim(strtoupper($_POST['q']));
		$category=trim($_POST['c']); 
		$pid=trim($_POST['pid']);
		
		////
		
  
  /////////
		
		$existAccItemID=searchTableValues('accounts_accaccount',"accaccount_name|$foundrecordid",0);
		
		$prefferedContacts=getPrefferedContact('admin_person',$pid);
		$email_address=$prefferedContacts['email_address'];
		$mobile_number=$prefferedContacts['mobile_number'];
		$postal_address=$prefferedContacts['postal_address'];
		$physical_address=$prefferedContacts['physical_address'];
		$fax=$prefferedContacts['fax'];
		$telephone=$prefferedContacts['telephone'];
		$preferred=$prefferedContacts['preferred'];
		
		if($preferred=='preferred'){
		$preferredctns=true;
		}else{
		$preferredctns=false;
		}


        $postal_address=str_replace("\r", "\\n",$postal_address);
		$postal_address=str_replace("\n", "\\n",$postal_address);
		$postal_address=str_replace("'", "\'",$postal_address);
		$mobile_number=str_replace("\r", "\\n",$mobile_number);
		$mobile_number=str_replace("\n", "\\n",$mobile_number);
		$email_address=str_replace("\n", "\\n",$email_address);
		$email_address=str_replace("\r", "\\n",$email_address);
		$physical_address=str_replace("\r", "\\n",$physical_address);
		$physical_address=str_replace("\n", "\\n",$physical_address);
		$physical_address=str_replace("'", "\'",$physical_address);
		$telephone=str_replace("\r", "\\n",$telephone);
		$telephone=str_replace("\n", "\\n",$telephone);
		$telephone=str_replace("'", "\'",$telephone);
		$fax=str_replace("\r", "\\n",$fax);
		$fax=str_replace("\n", "\\n",$fax);
		$type=$_POST['type'];
				$contacts="\"$postal_address\",\"$mobile_number\",\"$email_address\",\"$physical_address\",\"$fax\",\"$telephone\",\"$preferredctns\"
";

		$contactsB="'postal_address','mobile_number','email_address','physical_address','fax','telephone',false";
		$bankAc="\"$bankaccount_name\",\"$bank\",\"$currency_id\",\"$branch\",\"$description\"";
		$bankB="\"bankaccount_name\",\"bank\",\"currency_id\",\"branch\",\"description\"";
		echo "function fillAccountSummary(){";
		echo "
		Ext.getCmp('postal_address').setValue('$postal_address');
		Ext.getCmp('mobile_number').setValue('$mobile_number');
		Ext.getCmp('email_address').setValue('$email_address');
		Ext.getCmp('physical_address').setValue('$physical_address');
		Ext.getCmp('fax').setValue('$fax');
		Ext.getCmp('telephone').setValue('$telephone');
		Ext.getCmp('preferred').setValue('$preferred');
		
		
		
		}
		fillAccountSummary();
		";
}
?>