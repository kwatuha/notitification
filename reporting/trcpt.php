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
?><?php
require('createIReceipt.php');
$irs=base64_decode($_GET['i']);
$arr=explode('|',$irs);
$tpid=$arr[1];
$_SESSION['rptreceivedfromfullname']=$arr[2];
$_SESSION['rptrptmode']=$arr[3];
$_SESSION['rptrptref']=$arr[4];
$_SESSION['rptrptamount']=$arr[5];
$arrBanked=explode('^',$arr[6]);
$_SESSION['rptrptbank']=$arrBanked[0];
$_SESSION['rptrptbranch']=$arrBanked[1];
$_SESSION['rptrptcheck_number']=$arrBanked[2];
$_SESSION['rptrptcheck_details']=$arrBanked[3];
$_SESSION['rptrptvoucher_number']=$arrBanked[4];
$_SESSION['rptrptpaytype']=$arr[7];
$_SESSION['rcpttransref']=$arr[8];
$_SESSION['rcptNumSelected']=$arr[9];
$_SESSION['rcptnaration']=$arr[10];
$_SESSION['crraccountid']=$arr[0];
$prefferedContacts=getPrefferedContact('admin_person',$tpid);
$_SESSION['rptphone']=$prefferedContacts['mobile_number'];
$_SESSION['rptemailaddress']=$prefferedContacts['email_address']; 
$_SESSION['rptpostaladdress']=$prefferedContacts['postal_address'];
  
  if($_SESSION['rcptNumSelected']){
  $_SESSION['rptrcptnumber']=$_SESSION['rcptNumSelected'];
  
  }
  else{
  $existRcptID=createReceipt($_SESSION['crraccountid'],$_SESSION['rcpttransref']);
  $fielddata=fillPrimaryData('accounts_receipt',$existRcptID);
  $_SESSION['rptrcptnumber']= $fielddata['receipt_name'];
            $receipt_id=$fielddata['receipt_id'];
			$existReceiptItemID=searchTableValues('accounts_receiptitems',"receipt_id|$receipt_id",0);
			
			if($existReceiptItemID>0){
			//voidEntry('accounts_receiptitems','receipt_id|'.$receipt_id,2);
			//do nothing
			}else{
			createReceiptItem($receipt_id,$_SESSION['rptrptamount'],$_SESSION['rcptnaration']);
			}
           
  }
  
  
$pdf=new PDF_MC_Table();
$pdf->SetWelcomeData();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

//$tbl=1;//trim($_GET['r']);
//$rpt=fillPrimaryData('designer_queryfield',$tbl);
$limitcurracc="WHERE accounts_accaccount.accaccount_id='".$_SESSION['crraccountid']."'";
$_SESSION['indivgeneralaccountspayments']="select 

bp.tranrefid refid,
bp.transtbl,
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner ,
accounts_accaccount.syownerid ,
bp.banktrans_name,
bp.voucher_number,
payment_currency.currency_name,
bp.currency_id,
bp.amount,
bp.transaction_type,
bp.naration,
bp.bankaccount_name,
bp.bank,
bp.branch,
bp.check_details,
bp.check_number,
bp.check_date,
bp.date_cleared


from
(select
accounts_banktrans.accaccount_id,
accounts_banktrans.banktrans_name, 
accounts_banktrans.banktrans_id tranrefid,
'accounts_banktrans' transtbl,
accounts_banktrans.voucher_number,
bank_bankaccount.bankaccount_name,
bank_bankaccount.bank	,
bank_bankaccount.	branch	,
 ' '	check_details	,
 ' '	check_number	,
 ' '	check_date	,
' '  date_cleared,
bank_bankaccount.currency_id,
accounts_banktrans.amount, 
accounts_banktrans.transaction_type,
accounts_banktrans.naration,
'Deposited Cash to Bank' payment_mode

from accounts_banktrans
inner join bank_bankaccount on bank_bankaccount.bankaccount_id = accounts_banktrans.bankaccount_id  
{accounts_banktranswhere}

union 
select
accounts_cashtrans.accaccount_id  ,
 accounts_cashtrans.cashtrans_name , 
accounts_cashtrans.cashtrans_id tranrefid,
'accounts_cashtrans' transtbl,
accounts_cashtrans.voucher_number  voucher_number,
' '     bankaccount_name,
 ' '	bank	,
 ' '	branch	,
 ' '	check_details	,
 ' '	check_number	,
 ' '	check_date	,
' ' date_cleared,
accounts_cashtrans.currency_id , 
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type ,
 accounts_cashtrans.naration ,
'Cash ' payment_mode

from accounts_cashtrans

{accounts_cashtranswhere}
union
select 
accounts_checkregister.accaccount_id , 
 accounts_checkdeposit.checkdeposit_name , 
accounts_checkdeposit.checkdeposit_id  tranrefid,
'accounts_checkdeposit' transtbl,
' ' voucher_number,
bank_bankaccount.bankaccount_name,
accounts_checkregister.bank,
accounts_checkregister.branch,
accounts_checkregister.check_details,
accounts_checkregister.check_number,
accounts_checkregister.check_date , 
accounts_checkdeposit.date_cleared ,
 bank_bankaccount.currency_id,
accounts_checkregister.amount,
accounts_checkregister.transaction_type,
accounts_checkregister.naration,  
'Bank Check ' payment_mode



 from accounts_checkdeposit  inner join accounts_checkregister on accounts_checkregister.checkregister_id = accounts_checkdeposit.checkregister_id  
inner join bank_bankaccount on bank_bankaccount.bankaccount_id = accounts_checkdeposit.bankaccount_id
where accounts_checkdeposit.voided =0
{accounts_checkregisterwhere}
) bp

inner join accounts_accaccount on accounts_accaccount.accaccount_id =bp.accaccount_id
inner join payment_currency on payment_currency.currency_id =bp.currency_id


";


$_SESSION["indivgeneralaccountspayments"]="
						
						select accounts_receiptitems.receiptitems_id , accounts_receipt.receipt_id , accounts_receipt.receipt_name , accounts_receiptitems.amount , accounts_receiptitems.description , accounts_receiptitems.created_by , accounts_receiptitems.date_created , accounts_receiptitems.changed_by , accounts_receiptitems.date_changed , accounts_receiptitems.voided , accounts_receiptitems.voided_by , accounts_receiptitems.date_voided , accounts_receiptitems.uuid , accounts_receiptitems.sys_track  from accounts_receiptitems  inner join accounts_receipt on accounts_receipt.receipt_id = accounts_receiptitems.receipt_id
	{whererecept}				
						";
						
if($_SESSION['rptrptpaytype']=='Rent Receipt'){

$otherdetailsL='Water^Electricity^';	
$otherdetailsV='water|20,electricity|20,';
}else{
$otherdetailsL='';	
$otherdetailsV='';
}					
$_SESSION['accreceiptcolumns']="
#^
Description^
Amount^
$otherdetailsL
Tax Charged^
Line Total
"; 
$_SESSION['rcptcolumnswidthdfn']="
AI|10,
description|60,
amount|20,
$otherdetailsV
amounts|25,
amounts|25
";


$report_caption=$_SESSION['accreceiptcolumns'];//$rpt['report_caption'];
$section_caption='Reporting';//$rpt['section_caption'];
$column_width=$_SESSION['rcptcolumnswidthdfn'];//$rpt['column_width'];
$query=$_SESSION['indivgeneralaccountspayments'];
  
 $accounts_cashtranswhere=" WHERE accounts_cashtrans.accaccount_id='".$_SESSION['crraccountid']."'";

 $accounts_banktranswhere=" WHERE accounts_banktrans.accaccount_id='".$_SESSION['crraccountid']."'";
 
  $accounts_checkregister=" AND accounts_checkregister.accaccount_id='".$_SESSION['crraccountid']."'";
$query=str_replace('{accounts_cashtranswhere}',$accounts_cashtranswhere,$query);
$query=str_replace('{accounts_checkregisterwhere}',$accounts_checkregister,$query);
$query=str_replace('{accounts_banktranswhere}',$accounts_banktranswhere,$query);

$receiptconttranswhere=	" where accounts_receipt.receipt_name='".$_SESSION['rptrcptnumber']."' AND accounts_receiptitems.voided='0' ";
$query=str_replace('{whererecept}',$receiptconttranswhere,$query);
$headercaptions=explode('^',$report_caption);
$finfo=explode(',',$column_width);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$ctnI=0;
$gridfields='';
foreach($headerfields as $itu){

$gridfields.= ",{name:'".trim($itu)."'}";
				
}
//echo $gridfields;
$multidataColumns=LoadQueryData($query,$headerfields);
//create headers
//$curY=$pdf->CreateQueryTableHeaders($headercaptions,$widthdetails);

//$pdf->createColumns($widthdetails,98,140);
$pdf->SetWidths($widthdetails);
$pdf->AlligneReceiptDetails();
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$myrow='';
$ic=0;
$islast='';
for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
					   $myrow[$k]=$multidataColumns[$i][$k];
					   
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$pdf->Row($myrow,$widthdetails,$islast);
		}
}
$pdf->receiptFooter();
//$pdf->closeTableRow($widthdetails);
$xintent=100;
$labelwidth=35;

//$pdf->CreateTables($lablevals,-55,165,40,1);
$pdf->createReceiptDetails();

$pdf->getTotalPages();
$pdf->Output();
?>
