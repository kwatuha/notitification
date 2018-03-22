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

$document = $PHPWord->loadTemplate('landlordtml.docx');
$primaryselector=trim($_GET['lid']);
$fielddata=fillPrimaryData('housing_housinglandlord',$primaryselector);
/*$document->setValue('Value1', $fielddata[);
$document->setValue('Value2', 'iNDININ INZIRE WMI SENEN');
$document->setValue('Value32', 'pppppppppppppppppppppppppppppppppp');
$document->setValue('Value32', 'Kende in the cuttttttttttttttttttttttt');
*/
$pid=$fielddata['person_id'];
$prefferedContacts=getPrefferedContact('admin_person',$pid);
$postal_address=$prefferedContacts['postal_address'];
$document->setValue('housinglandlord', $fielddata['housinglandlord_name']	);

$document->setValue('Value1', $fielddata['contract_day']	);
$document->setValue('Value2', $fielddata['month_name']	);
$document->setValue('Value3', $fielddata['contract_year']	);
$document->setValue('Value4', strtoupper($fielddata['person_fullname'])	);
$document->setValue('Value5', strtoupper($postal_address));
$document->setValue('Value6', $fielddata['property']	);

$document->setValue('Value7', $fielddata['term_period']	);
//$document->setValue('Value7', $fielddata['term_months']	);
$document->setValue('Value8', $fielddata['commission']	);
$altcom=$fielddata['commission_alternative'];
if($fielddata['commission_alternative']==0)
$altcom='N/A';
$document->setValue('Value9', $altcom	);

$excess_amount=$fielddata['excess_amount'];
if($fielddata['excess_amount']==0)
$excess_amount='N/A';
$document->setValue('Value10', $excess_amount	);
$document->setValue('Value12', $fielddata['payment_day']	);

$document->setValue('Value32', strtoupper($fielddata['contract_dated'])	);
//$document->setValue('Value14', $fielddata['rentperiod_name']	);

/*$document->setValue('weekday', date('l'));
$document->setValue('time', date('H:i'));*/

$document->save('zullandloardAgrmnt.doc');
echo "function OpenLandlordAgmnt(){
window.location.assign('../msdoc/ref/zullandloardAgrmnt.doc');
}OpenLandlordAgmnt();";
?>