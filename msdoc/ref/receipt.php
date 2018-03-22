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

$document = $PHPWord->loadTemplate('Receipttpl.docx');
//evalLetter('Alfayo','Invoicetpl');


////////////
$primaryselector=trim($_GET['lid']);
$dnnotetrans=getPolicyNumber($primaryselector);
$nbitems=getDBNoteItems($primaryselector);
$motor='';


foreach($nbitems as $U){
$arrDB=explode('|', $U);
$class=$arrDB[0];
$description=$arrDB[1];
if(strtoupper($class)=='MOTOR')
$motor=$description;
if(strtoupper($class)=='DOMESTIC PACKAGE')
$domestic=$description;
if(strtoupper($class)=='FIRE')
$fire=$description;
if(strtoupper($class)=='BURGLARY')
$burglary=$description;
if(strtoupper($class)=='POLITICAL RISK')
$political=$description;
if(strtoupper($class)=='MARINE')
$marine=$description;
if(strtoupper($class)=='OTHERS')
$others=$description;

}
$policyNumber=$dnnotetrans['policy_number'];
$fielddata=fillPrimaryData('insurance_insurancedebitnote',$primaryselector);
$pid=$fielddata['person_id'];

$personname=$fielddata['person_fullname'];
//echo  $personname.$pid;
$idpassportArr=fillPrimaryData('admin_person',$pid);

$idpassport=$idpassportArr['idorpassport_number'];
$krapin=$idpassportArr['pin'];
$prefferedContacts=getPrefferedContact('admin_person',$pid);
$postal_address=$prefferedContacts['postal_address'];
$email_address=$prefferedContacts['email_address'];
$mobile_number=$prefferedContacts['mobile_number'];
$telephone=$prefferedContacts['telephone'];
if($mobile_number||$telephone){
$tel='';
	if($mobile_number){
	$tel=$mobile_number;
	}
		    if($telephone){
				if($tel){
				$tel=$tel.'/'.$telephone;
				}else{
				$tel=$telephone;
				}
			}
}

$da='';

$acno='Alfa';
$policynum=$policyNumber;
$fillarr=createTableGridSummaries('insurance_insurancedebitnote','insurancedebitnote_name');
$dbrfname=$fillarr['filval'];


$risks=$fielddata['risk_covered_naration'];
$pcf=$fielddata['pcf']/100;
$sdtl=$fielddata['sdtl']/100;

$period_from=$fielddata['period_from'];
$period_to=$fielddata['period_to'];
$amount_insured=$fielddata['amount_insured'];
$pcf=number_format($amount_insured*$pcf,2);
$stdl=number_format($amount_insured*$sdtl,2);
$totalpremium=number_format(($amount_insured+$stdl+$pcf),2);
$policy_value=$fielddata['policy_value'];
$risks=$fielddata['risk_covered_naration'];


$document->setValue('Value81', $idpassport);
$dbdate=date('d-m-Y');
$document->setValue('Value82', $krapin);
$document->setValue('Value83', $policynum);

$document->setValue('Value84',$fielddata['pcf']);
$document->setValue('Value85', $fielddata['sdtl']);
/////////////////////////////
$document->setValue('Value1', $dbrfname);
$document->setValue('Value2', $dbdate);
$document->setValue('Value3', $personname);
$document->setValue('Value4', $acno);
$document->setValue('Value5', $tel);
$document->setValue('Value6', $postal_address);
$document->setValue('Value7', $email_address);
$document->setValue('Value8', $motor);
$document->setValue('Value9', $domestic);
$document->setValue('Value10', $fire);
$document->setValue('Value11', $burglary);
$document->setValue('Value12', $political);
$document->setValue('Value13', $marine);
$document->setValue('Value14', $others);
$document->setValue('Value15', $period_from);
$document->setValue('Value16', $period_to);
$document->setValue('Value17', $risks);
$document->setValue('Value18', $policy_value);
$document->setValue('Value19', $amount_insured);
$document->setValue('Value20', $pcf); 
$document->setValue('Value21', $stdl);
$document->setValue('Value22', $totalpremium);
$document->setValue('Value23', $da);
$document->setValue('Value24', $da);
$document->setValue('Value25', $da);
$document->setValue('Value26', $da);
$document->setValue('Value27', $da);
$document->setValue('Value28', $da);
$document->setValue('Value29', $da);


$document->save('receipt.doc');
echo "function OpenDebitNoteR(){
window.location.assign('../msdoc/ref/receipt.doc');
}OpenDebitNoteR();";
?>