<?php
frestrictaccess();
function frestrictaccess(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isFAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
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
if (!((isset($_SESSION['MM_Username'])) && (isFAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
require('pdf/fpdf.php');
$table_name='pim_employee';
include('../template/functions/menuLinks.php');
class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
//////////////////////////////////////////////////////
//end column headers
function Header()
{
$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
$this->setFont('Arial','B',10);
$year='/2011';
$this->SetFont('helvetica','B',10);
$this->SetTextColor(0,51,102);

//$companyArr[0]
$this->SetXY(10,32);
if($_SESSION['rptrptpaytype']=='Rent Receipt'){
$this->cell(0,5,'Zulmac Agencies Limited',0,1,'L');
}
else{
$this->cell(0,5,'Zulmac Insurance Brokers Limited',0,1,'L');
}
$this->SetFont('helvetica','B',10);
$mynewsess=$_SESSION[statementfromtbl];
$this->Ln(1);
$this->SetFont('Arial','B',8);
$date_printed=date('d-m-Y');
//assign receipt number
$fillarr=createTableGridSummaries('accounts_receipt','receipt_name');
$receiptNo=$fillarr['filval'];
$this->Image('../template/reportimages/images/zul_logo.jpg',10,5,27,27);
$this->SetFont('helvetica','B',13);
$this->SetXY(125,22);
//$receiptNo="ZUL/RCPT/201020/101";
$this->Cell(10,5,'NO. ',0,0,'L');
$this->SetFont('helvetica','B',13);
$this->Cell(0,5, $_SESSION['rptrcptnumber'],0,1,'L');
$this->SetFont('helvetica','B',13);
$this->SetXY(125,30);
$this->Cell(0,5,'RECEIPT FOR PAYMENT',0,1,'L');

$this->SetXY(10,40);
 $this->SetTextColor(0,0,0);
$this->SetFont('helvetica','B',11);
$this->Cell(10,5,'STANDARD DETAILS',0,1,'L');

$this->SetXY(10,37);
$this->Cell(190,4,'','T');
//$this->Cell(0,0,'','T');
$this->SetFont('Arial','',12);
  $this->Ln(2);
  $this->SetFont('helvetica','B',11);
  $this->Ln(5);
  
  //$this->CreateAddressHeader();
  

/////////////////////////////////////////////
//Now create table headers
$_SESSION['accreceiptcolumns']="
#^
Voucher #^
Check #^
TransType ^
Bank#^
Branch^
amount^
naration^
Payment Mode
"; 
$_SESSION['rcptcolumnswidthdfn']="
AI|5,
voucher_number|20,
check_number|20,
transaction_type|40,
bank |25,
branch|20,
amount|10,
naration|50,
payment_mode|20
";
$headercaptions=explode('^',$_SESSION['accreceiptcolumns']);
$finfo=explode(',',$_SESSION['rcptcolumnswidthdfn']);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
//$this->CreateQueryTableHeaders($headercaptions,$widthdetails);
}

//Page footer
function Footer()
{
}

function getTotalPages(){
$nb=$this->page;
$this->pages[$nb];	
}
function getheaders($table_name){
$this->cell(0,4,$_SESSION['stm'.$table_name],0,1,'L');
$this->Ln(1);
}	
///////////////////////////////////////////////////////
function SetWelcomeData(){
$this->Cell(120,3,'welcome home',0,1,'L');}
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}
function AlligneReceiptDetails(){
$this->SetY(86);
}
function Row($data,$widthdetails)
{
	//Calculate the height of the row
	$nb=0;
	
	
	for($i=0;$i<sizeof($widthdetails);$i++){
	  // echo $this->widths[$i].'<br>';
		$colwidth2=$widthdetails[$i];
		//echo $colwidth2.'<br>';
		$nb=max($nb,$this->NbLines($widthdetails[$i],$data[$i]));
		}
	$h=5*$nb;
	//$h=100;
	//Issue a page break first if needed
	$this->CheckPageBreak($h,$widthdetails);
	//Draw the cells of the row
	//$dz=count($data)+2;
	//$widthdetails=array(5,10,20,20,20,20,100);
	$it=sizeof($widthdetails);
	
	for($i=0;$i<=$it;$i++)
	{    
		$w=$widthdetails[$i];
		
		//echo $w.' '.$data[$i+1].'<br>';
		
		//20;//$this->widths[$i];
		//echo $i.' '.$widthdetails[$i].' '.$w.'<br>';
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		
		$this->SetFont('helvetica','B',8);
	
		$this->MultiCell($w,5,trim($data[$i]),'',$a,false);
		//$this->Rect($x,$y,$w,$h,'DF');
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//$this->Rect($x,$y,$w,$h);
	//Go to the next line
	
	$this->Ln($h);
	
}

function createColumns($numcols,$curY,$psize){
$this->Rect(10,$curY,array_sum($numcols),$psize);
$myX=10;
foreach($numcols as $col){

$this->Rect($myX,$curY,$col,$psize);
$myX=$myX+$col;
}
}

function CheckPageBreak($h,$numcols)
{
	//If the height h would cause an overflow, add a new page immediately
	
	$psize=($this->PageBreakTrigger-36.997583333);
	$curY=$this->GetY();
	if($this->GetY()+$h>$psize){
	    //$this->Cell(array_sum($numcols),0,'','T');
		$this->AddPage($this->CurOrientation);
		//$this->Cell(array_sum($numcols),0,'','T');
		$this->SetX(10);
				    $this->createColumns($numcols,98,140);
		
		//echo $this->SetY();
		}
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}


//////////////////////////
function CreateDynamicPDFLayout($headerfields,$headerWidth,$tablename)
{
    $this->SetFillColor(229,229,229);
    $this->SetTextColor(0,0,0);
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->SetFont('helvetica','B',9);
    //$this->SetFont('','B');
    //Header
    for($i=0;$i<sizeof($headerfields);$i++){
	  if($i==0){
	  //$this->Cell($headerWidth[$i],6,'No.',1,0,'L',true);
			
	  }
			$this->Cell($headerWidth[$i],6,$_SESSION[$tablename.$headerfields[$i]],1,0,'L',true);
			
			
	}
	
	$this->Ln();
   
    
}

/////////////////////////
function CreateQueryTableHeaders($headercaptions,$headerWidth)
{
    $this->Ln(1);
	$headerLoc=$this->GetY();
	
	$this->SetFillColor(229,229,229);
    $this->SetTextColor(0,0,0);
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->SetFont('helvetica','B',9);
    //$this->SetFont('','B');
    //Header
	//$this->SetY(80);
    for($i=0;$i<sizeof($headercaptions);$i++){
	  $this->Cell(trim($headerWidth[$i]),6,trim($headercaptions[$i]),'TB',0,'L',false);
	}
	$cy=$this->GetY();
	//$this->SetXY(120,$cy-6);
	$this->Cell(50,6,'','TB',1,'L');
	$this->Ln();
	
	return $headerLoc;
 }
 function CreateAddressHeader(){
  $addressloc=$this->GetY();
   $toname=$_SESSION['rptrptname'];
  $toaddress=$_SESSION['rptpostaladdress'];
  $totel=$_SESSION['rptphone'];
   $toemailaddress=$_SESSION['rptemailaddress'];
	$invoiceDate='08/07/2012';
	$clientinfointend=10;
	$clientinfointendIn=34;
	$indeta=30;
	$indetails=15;
	$invoiceNum='0000100010021';
	$clientinfointend=10;
	$dw=50;
	$bd=0;
	$this->setX($clientinfointend);
	//$this->Rect($clientinfointend,$addressloc,$dw,20);
	$this->SetFont('helvetica','B',11);
	$this->Cell($dw,5,$toname,$bd,1,'L');
	$this->SetFont('helvetica','B',11);
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toaddress,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$totel,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toemailaddress,$bd,1,'L');
	$this->Ln(2);
	
	$this->setXY(60,$addressloc+7);
	
	//$this->setY($addressloc+3);
	$this->SetFont('helvetica','B',18);
	//$this->Cell($dw,5,'RECEIPT FOR PAYMENT SAWA',$bd,1,'L');
	return $addressloc;
 }
 
 function CreateInvoiceAddress($header,$data,$headerfields,$headerWidth){
  $addressloc=$this->GetY();
   $toname=$_SESSION['rptrptname'];
  $toaddress=$_SESSION['rptpostaladdress'];
  $totel=$_SESSION['rptphone'];
   $toemailaddress=$_SESSION['rptemailaddress'];
	$invoiceDate='08/07/2012';
	$clientinfointend=10;
	$clientinfointendIn=34;
	$indeta=30;
	$indetails=15;
	$invoiceNum='0000100010021';
	$clientinfointend=10;
	$dw=50;
	$bd=0;
	$this->setX($clientinfointend);
	//$this->Rect($clientinfointend,$addressloc,$dw,20);
	$this->SetFont('helvetica','B',11);
	$this->Cell($dw,5,$toname,$bd,1,'L');
	$this->SetFont('helvetica','B',11);
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toaddress,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$totel,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toemailaddress,$bd,1,'L');
	$this->Ln(2);
	
	$this->setXY(80,$addressloc+7);
	
	//$this->setY($addressloc+3);
	$this->SetFont('helvetica','B',18);
	$this->Cell(60,5,'RECEIPT FOR PAYMENT',$bd,1,'L');
	return $addressloc;
 }
 
 function CreateDocumentSummary($sumLoc){
  $toname=$_SESSION['rptrptname'];//'Joseph Mwalimu Nyerere';
  $toaddress='P. O. Box 2012-30100';
  $totown='Eldoret';
  $totel='0723686454';
	$toemailaddress='mwalimu@yahoo.com';
	$invoiceDate='08/07/2012';
	$clientinfointend=10;
	$clientinfointendIn=34;
	$indeta=10;
	$indetails=15;
	$invoiceNum='0000100010021';
	$sumLoc=-55;
	$this->setY($sumLoc);
	$clientinfointend=135;
	$dw=70;
	$bd=1;
	$this->setX($clientinfointend);
	$this->SetFont('helvetica','B',11);
	$this->Cell($dw,5,$toname,$bd,1,'L');
	$this->SetFont('helvetica','B',11);
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toaddress,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,'Tel.: ' .$totel,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,'Email Address: '.$toemailaddress,$bd,1,'L');
	$this->Ln(2);
 }
 
 
 function CreateTables($lablevals,$loc,$xintent,$labelwidth,$bd,$ptype){
  	$this->Ln(2);
	if($ptype=='L'){
	$this->SetFont('helvetica','B',11);
	}
	if($ptype=='V'){
	$this->SetFont('helvetica','B',11);
	}
	$labelPos=$this->GetY();
	$clientinfointend=$xintent;
	$dw=$labelwidth;
	$this->setXY($xintent,$loc);
	foreach($lablevals as $cl){
	$this->setX($clientinfointend);
	$this->SetFont('helvetica','B',11);
	$this->Cell($dw,5,trim($cl),$bd,1,'L');
	}
	
	$this->Ln(2);
	return $labelPos;
 }
 
function createReceiptDetails(){
$valueslbl="Date|A/C Number|Type of Payment|Received From";
$valueslbl=explode('|',$valueslbl);
$this->CreateReceiptTables($valueslbl,45,10,35,1,'L');


$receiptdate=date('d-m-Y');
$acnum=$_SESSION['rptrptref'];
$paytype=$_SESSION['rptrptpaytype'];
$rptrptname=$_SESSION['rptreceivedfromfullname'];
$values="$receiptdate|$acnum|$paytype|$rptrptname";
$values=explode('|',$values);
$this->CreateReceiptTables($values,45,45,70,1,'V');

}

  function CreateReceiptTables($lablevals,$loc,$xintent,$labelwidth,$bd,$ptype){
    $bd=0;
  	$this->Ln(2);
	if($ptype=='L'){
	$this->SetFont('helvetica','B',9);
	}
	if($ptype=='V'){
	$this->SetFont('helvetica','B',9);
	}
	$labelPos=$this->GetY();
	$clientinfointend=$xintent;
	$dw=$labelwidth;
	$this->setXY($xintent,$loc);
	foreach($lablevals as $cl){
	$this->setX($clientinfointend);
	$this->SetFont('helvetica','B',9);
	//$this->Ln(5);
	$this->Cell($dw,7,trim($cl),$bd,1,'L');
	}
	/////////////////Now add payment mode
	//Bank Check
    if(trim($_SESSION['rptrptmode'])=='Bank Check'){
	$ystart=45;
	//$_SESSION['rptrptmode'].'|'.
	$actvals=$_SESSION['rptrptcheck_number'].'|'.$_SESSION['rptrptbank'].'|'.$_SESSION['rptrptbranch'].'|'.$_SESSION['rptrptcheck_details'].'|'.$_SESSION['rptrptamount'];
	$Actualvaluepayvals=explode('|',$actvals);
	
	$lablevals=explode(',',"Cheque,Bank,Branch,Drawer,Amount");
	}else{
	$ystart=61;
	$lablevals=explode(',',"Voucher,Amount");
	//$_SESSION['rptrptmode'].'|'.
	$ctvaluescash=$_SESSION['rptrptvoucher_number'].'|'.$_SESSION['rptrptamount'];
	$Actualvaluepayvals=explode('|',$ctvaluescash);
	}
	
	  
	  $bd=0;
 
 
 /////
		if($_SESSION['rptrptstart']){
		$starts=$_SESSION['rptrptstart'];
		}else{
		$starts=$_SESSION['rptrptcontractdate'];
		}

if($_SESSION['rptrptend']){
$ends=$_SESSION['rptrptend'];
}else{
$ends=date('Y-m-d');//
}
$datetoday=date('d-m-Y');



//echo $checkdescVals;
$this->CreatePaymentMode($lablevals,$ystart,125,15,$bd,'L');
$this->CreatePaymentMode($Actualvaluepayvals,$ystart,140,45,$bd,'V');
	///end of payment mode
	//////////////aLLOCATION DETAILS
$this->SetXY(10,75);
$this->SetFont('helvetica','B',11);
$this->Cell(10,5,'ALLOCATION DETAILS',0,1,'L');

//Now create table headers
//echo $_SESSION['rptrptpaytype'];
if($_SESSION['rptrptpaytype']=='Rent Receipt'){
$otherdetailsL='Water^Electricity^';	
$otherdetailsV='water|20,electricity|20,';
}else{
$otherdetailsL='';	
$otherdetailsV='';
}	
$otherdetailsL='';	
$otherdetailsV='';
$_SESSION['accreceiptcolumns']="
#^
Description^
$otherdetailsL
Amount^^

"; 
/*Tax^
Line Total*/
$_SESSION['rcptcolumnswidthdfn']="
AI|10,
naration|60,
amount|20,
$otherdetailsV
amount|25,
amount|25
";
$headercaptions=explode('^',$_SESSION['accreceiptcolumns']);
$finfo=explode(',',$_SESSION['rcptcolumnswidthdfn']);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryTableHeaders($headercaptions,$widthdetails);
/////////////END OF ALLOCATION

	$this->Ln(2);
	return $labelPos;
	
 }
 
 function receiptFooter(){
  $oY=$this->GetY();
$this->SetY($oY+1);
$this->SetFont('helvetica','B',9);
$this->Cell(190,5,'','T',1);
$this->Cell(70,5,'Issued By '.$_SESSION['my_username'],0,0);
$this->Cell(15,5,'Signature:',0,'L');
$this->Cell(40,5,'','B',0);
$this->SetXY(0,$oY+15);
$this->SetFont('helvetica','B',8);

$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
//.' '.$companyArr[15]
$footerdetails=trim($companyArr[0]
.' , '.$companyArr[13]
.' , '.$companyArr[15]
.' ,Box '.$companyArr[4]
.' - '.$companyArr[5]
.'  '.$companyArr[6]
.' ,'.$companyArr[9]
/*.' , '.$companyArr[7]
.' , '.$companyArr[8]
.' , '.$companyArr[10]
.' , '.$companyArr[11]*/);
$this->Cell(0,5,$footerdetails,0,'C');
/*
0 company_name
1 pin_num
2 vat_num
3 incorp_dt
4 postal_address
5 postal_code
6 town
7 telephone
8 fax
9 mobile
10 email_address
11 website
12 institution_reg
13 building
14 location_description
15 street
16 email_address2;
*/

		
 }
function CreatePaymentMode($lablevals,$loc,$xintent,$labelwidth,$bd,$ptype){

  	$this->Ln(2);
	if($ptype=='L'){
	$this->SetFont('helvetica','B',9);
	}
	if($ptype=='V'){
	$this->SetFont('helvetica','B',9);
	}
	$labelPos=$this->GetY();
	$clientinfointend=$xintent;
	$dw=$labelwidth;
	$this->setXY($xintent,$loc);
	foreach($lablevals as $cl){
	$this->setX($clientinfointend);
	$this->SetFont('helvetica','B',9);
	$this->Cell($dw,5,trim($cl),$bd,1,'L');
	}
	
	$this->Ln(2);
	return $labelPos;
 }
}
?>
