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
require_once('../../Connections/cf4_HH.php');
include('../../template/functions/searchSQL.php');
include('../../template/functions/customizesearchSQL.php');

?><?php
require_once('../../PHPMailer/class.phpmailer.php');
include('../../template/functions/menuLinks.php');
//sms
include('../../template/functions/sms/sms_functions.php');

?><?php
require_once '../PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('zultenanttml.docx');
$primaryselector=trim($_POST['lid']);
$tpid=trim($_POST['tp']);


$fielddata=fillPrimaryData('housing_housingtenant',$primaryselector);
$pid=$tpid;//$fielddata['tenantpid'];

$landlordid=$fielddata['housinglandlord_id'];
$otherlandlorddetails=fillPrimaryData('housing_housinglandlord',$landlordid);
$idpassport=fillPrimaryData('admin_person',$pid);

$prefferedContacts=getPrefferedContact('admin_person',$pid);
$postal_address=$prefferedContacts['postal_address'];

$landlordid=$fielddata['housinglandlord_id'];
$otherlandlorddetails=fillPrimaryData('housing_housinglandlord',$landlordid);


$document->setValue('Value1', $fielddata['contract_day']	);
$document->setValue('Value2', $fielddata['month_name']	);
$document->setValue('Value3', $fielddata['contract_year']	);
$document->setValue('Value4', strtoupper($fielddata['housingtenant_name'])	);
$document->setValue('Value5', strtoupper($postal_address));
$document->setValue('Value6', $idpassport['idorpassport_number']	);
$document->setValue('Value7', $prefferedContacts['mobile_number']	);

$document->setValue('Value8', $fielddata['property_description']	);
$document->setValue('Value9', number_format($fielddata['rent'],2)	);
$document->setValue('Value10', $fielddata['rentperiod_name']	);
$document->setValue('Value11', $fielddata['deposit_description']	);

$document->setValue('Value12', number_format($fielddata['electricity_water'],2)	);
$document->setValue('Value13', $fielddata['tenancy_period']	);
$document->setValue('Value14', $fielddata['period_starts']	);
$document->setValue('Value15', $fielddata['contract_dated']	);

$document->setValue('Value16', strtoupper($otherlandlorddetails['person_fullname'])	);
$document->setValue('Value17', strtoupper($otherlandlorddetails['property'])	);

/*$document->setValue('weekday', date('l'));
$document->setValue('time', date('H:i'));*/

$document->save('zultenancyAgrmnt.doc');
echo "function OpenLandlordAgmnt(){
window.location.assign('../msdoc/ref/zultenancyAgrmnt.doc');
}OpenLandlordAgmnt();";
?>