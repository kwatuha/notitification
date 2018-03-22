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
?><?php

$tbl=trim($_GET['t']);
$dbtable_input_tbl=base64_decode($tbl);
$_SESSION[statementfromtbl]="stm$dbtable_input_tbl";
$stmtable=$statementfrom;
include('../template/functions/menuLinks.php');
createadmin_adminuserPDFreports($dbtable_input_tbl);
function createadmin_adminuserPDFreports($dbtable_input_tbl){
require('../template/pdf/fpdf.php');

class PDF extends FPDF

{
//Start column headers
//public $statementfrom ="stm$dbtable_input_tbl";
function getheaders($table_name){
$this->cell(0,4,$_SESSION['stm'.$table_name],0,1,'L');
$this->Ln(1);
}		  

//end column headers
function Header()
{
$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
$this->setFont('Arial','B',10);
$year='/2011';
/*$this->setY(40);
$this->cell(0,4,$companyArr[0],0,1,'C');
$this->Ln(2);
*/
$this->setY(40);
$this->SetFont('Times','B',24);
//$this->SetTextColor(90,100,100);
$this->SetTextColor(0,51,102);

//$companyArr[0]
$this->cell(0,5,'Zulmac Insurance Brokers Limited',0,1,'C');
$this->SetFont('Times','B',10);



$mynewsess=$_SESSION[statementfromtbl];

$this->Ln(1);
$this->SetFont('Arial','B',8);
$date_printed=date('d-m-Y');
$this->Image('../template/reportimages/images/zul_logo.jpg',93,10,27,27);
$this->Cell(40,5,'P.O. Box  '.$companyArr[4].' - '.$companyArr[5].'  '.$companyArr[6],0,0,'L');
//$this->Cell(80);
$this->setX(150);
$this->Cell(40,5,'Tel: '.$companyArr[7].' Fax: '.$companyArr[8],0,1,'L');
$this->Cell(40,5,$companyArr[13],0,0,'L');

$this->setX(150);
$this->Cell(30,5,'Email: '.$companyArr[10],0,1,'L');

$this->Cell(40,5,$companyArr[14],0,0,'L');

$this->setX(150);
$this->Cell(40,5,$companyArr[16],0,1,'L');

$this->Cell(40,5,$companyArr[15],0,0,'L');
$this->setX(150);

$this->Cell(30,5,'Website: '.$companyArr[11],0,1,'L');

//$this->Cell(80);
//$this->Cell(20,5,' Mobile: '.$companyArr[9],0,0,'C');


$this->Cell(200,0,'','T');

//
/*    13            14                        15           16
'||'$building.'||'$location_description.'||'$street.'||'$email_address2;
*/
//company info
 /* $this->SetY(40);
$this->SetFont('Arial','',6);
$this->cell(0,4,ucwords($_SESSION[$mynewsess]),0,1,'C');
$this->Cell(80,5,$toname,0,1,'L');
$this->Cell(30,5,$toaddress,0,1,'L');
$this->Cell(80,5,$totown,0,1,'L');
$this->Cell(20,5,'Tel.: ' .$totel,0,1,'L');*/

  $this->Cell(200,0,'','T');
$this->SetFont('Arial','',12);
  $this->Ln(2);
  $this->SetFont('Courier','',8);
  $this->Ln(5);
}
//Page footer
function Footer()
{
/*$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
$mynewsess=$_SESSION[statementfromtbl];
    //Position at 1.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
	$date_printed=date('d-m-Y');
    $this->SetFont('Courier','',8);
    $this->Cell(180,6,$companyArr[0],0,1,'C');
	 $this->SetY(-18);
	 $this->SetFont('Courier','I',6);
	 $this->Cell(180,6,ucwords($_SESSION[$mynewsess]).'  printed by '.$_SESSION['my_username'].'  as at '.$date_printed,0,1,'C');
  //$this->Cell(100,6,$_SESSION[stmadmin_adminuser'].'  printed by '.$_SESSION['my_username'],0,1,'R');
  $this->Cell(100,6,' Page '.$this->PageNo().' of {nb}',0,1,'R');
*/}

function LoadData($dbtable_input_tbl,$headerfields)
{
$sql=$_SESSION[$dbtable_input_tbl.'_SearchSQL'];
$results_qry=mysql_query($sql) or die(ucwords($_SESSION[$dbtable_input_tbl]).' Data not Found ');
$countRowsOut=0;
while($count=mysql_fetch_array($results_qry)){
$cntcols=0;
$countRowsOut++;
foreach($headerfields as $pdffielditem){


$arrCutblArr=explode('_',$dbtable_input_tbl);
$curtpk=$arrCutblArr[1].'_id';
if($pdffielditem==$curtpk){
$arrDataRow[$cntcols]=$countRowsOut;

}else{
$arrDataRow[$cntcols]=$count[$pdffielditem];

}

$processedfieldname=$pdffielditem;
$cntcols++;
}
$data[]=array_unique($arrDataRow);
}
return $data;
}
//Colored table
function CreateDynamicPDFLayout($header,$data,$headerfields,$headerWidth)
{


///Invoice
//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
 // $this->Rect(10, 50, 170, 240, $style='');
  $toname='Joseph Mwalimu Nyerere';
  $toaddress='P. O. Box 2012-30100';
  $totown='Eldoret';
  $totel='0723686454';
  $toemailaddress='mwalimu@yahoo.com';
  $invoiceDate='08/07/2012';
  
  
  
  
  
  //client data
$this->SetY(70);

      //Rect($x, $y, $w, $h, $style='')
 //$this->Rect(10, 68, 85,40, $style='');
$clientinfointend=30;
$clientinfointendIn=34;
$indeta=10;
$indetails=15;
$invoiceNum='0000100010021';

$this->SetX($indeta);
$this->SetFont('Times','B',12);
$this->SetFont('Times','',8);
$this->SetX($indetails);
$this->SetX($indetails);
$this->cell(20,4,'Invoice To: ',0,1,'L');
$this->setX($clientinfointend);

$genInvoiceYPos=80;
$genInvoiceXPos=110;
$this->SetFont('Times','',10);
$this->MultiCell(100,4,"$toname,\n$toaddress,\n$totown, \n$totel,\n".$toemailaddress,0,'L',0);

$this->setY($genInvoiceYPos);
$this->setX($genInvoiceXPos);
$this->SetFont('Times','',11);
$this->MultiCell(100,4,"DATE OF ISSUE:$invoiceDate,\nINVOICE #:    $invoiceNum",0,'L',0);

//Rect($x, $y, $w, $h, $style='')
 $coldesinvals=100;
 $coldesinvalsLast=180;
 $iwidth=80;
 $this->Rect(10, $coldesinvals, 5,$iwidth, $style='');
 $this->Rect(15, $coldesinvals, 20,$iwidth, $style='');
 $this->Rect(35, $coldesinvals, 10,$iwidth, $style='');
  $this->Rect(45, $coldesinvals, 80,$iwidth, $style='');
 $this->Rect(125, $coldesinvals, 15,$iwidth, $style='');
  $this->Rect(140, $coldesinvals, 20,$iwidth, $style='');
  $this->Rect(10, $coldesinvalsLast,150,0.5, true);
  
  //$this->Rect(160, $coldesinvals, 20,$iwidth, $style='');
  
  //Bottom
  /*$this->Rect(10, 230, 170,30, $style='');
   $this->Rect(10, 250, 170,0, $style='');
  */ 
  //$this->Rect(10, 250, 250,20, $style='');
//$this->Rect(180, 50, 20,240, $style='');
    /*$this->Rect(200, 50, 20,240, $style='');*/
 
 $subtotalindent=183;
 $totalamount=10299209393;
 $subtotaldecrint=100;
 $subtotalvalint=150;

$totTax=0.16*$totalamount;
$this->setY($subtotalindent);
 
$this->setX($subtotaldecrint);

//$this->SetFillColor(150,125,255);

$this->SetFillColor(49,67,140);
    $this->SetTextColor(255);
    //$this->SetDrawColor(128,0,0);
	$this->SetDrawColor(0,0,0);
   
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
$this->Cell(60,5,'Invoice Summary',1,1,'L',true);
$this->SetFont('Times','B',9);
$this->SetTextColor(0,0,0);
$this->setX($subtotaldecrint);
$this->Cell(20,5,'Sub Total',1,0,'L');
$this->Cell(40,5,number_format($totalamount,2,'.',','),1,1,'R');


$this->setX($subtotaldecrint);
$this->Cell(20,5,'Taxes',1,0,'L');
$this->Cell(40,5,number_format($totTax,2,'.',','),1,1,'R');
$this->setX($subtotaldecrint);

$this->Cell(20,5,'Other',1,0,'L');
$this->Cell(40,5,number_format($totTothercharges,2,'.',','),1,1,'R');

$this->setX($subtotaldecrint);
$this->SetFont('Times','B',11);
$this->Cell(20,7,'TOTAL',1,0,'L');
$amountDue=$totTothercharges+$totTax+$totalamount;
$this->Cell(40,7,number_format($amountDue,2,'.',','),1,1,'R');
$this->setX($subtotaldecrint);
$this->Cell(60,1,'',1,0,'L',true);
//$this->setX($clientinfointend);

 
 
   $this->SetY($coldesinvals);
//invoice
    //$this->SetFillColor(150,125,255);
	
	$this->SetFillColor(49,67,140);
	 $this->SetTextColor(255);
   // $this->SetDrawColor(128,0,0);
   
   $this->SetDrawColor(0,0,0);
   
    $this->SetLineWidth(.3);
    //$this->SetFont('','B');
	$this->SetFont('Times','B',9);
    //Header
  $w=array(5,20,10,80,15,20,20,20);
  
    for($i=0;$i<sizeof($header);$i++){
	
    $this->Cell($w[$i],6,$header[$i],0,0,'L',true);
	$rowitemnumberNext=$i+1;
		//$total=$raw[2]*$raw[4];//*$raw[$rowitemnumber];
		if($rowitemnumberNext==sizeof($header)){
		$this->Cell(20,6,'Line Total',0,0,'L',true);
		}
	}
	
	
	
	
	
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    //$this->SetFont('Courier','',8);
	$this->SetFont('Times','',8);
    //Data
    $fill=false;
	$rowitemnumber=0;
	$tcolmns=sizeof($headerWidth);
    
	foreach($data as $raw)
  {
        for($rowitemnumber=0;$rowitemnumber<$tcolmns;$rowitemnumber++){
		if($header[$rowitemnumber]!=''){
		
		if($rowitemnumber==4){
		$this->Cell($w[$rowitemnumber],5,number_format($raw[$rowitemnumber],2,'.',','),'LR', 0,'R', $fill);
		}else{
		
		$this->Cell($w[$rowitemnumber],5,$raw[$rowitemnumber],'LR', 0,'L', $fill);
		
		}
		}
		
		$rowitemnumberNext=$rowitemnumber+1;
		$total=$raw[2]*$raw[4];//*$raw[$rowitemnumber];
		 
		if($rowitemnumberNext==$tcolmns){
		$this->Cell(20,5,number_format($total,2,'.',','),'LR', 0,'R', $fill);
		}
		}
       
		$rowitemdetails++;                    
        
        $this->Ln();
        $fill=!$fill;
    }
		$curentwidhtotal=array_sum($headerWidth);
    //$this->Cell($curentwidhtotal,0,'','T');
}

function summary_calculations($header,$data)
{
    //Column widths
    $w=array(1,15,10, 1);
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    //Data
    foreach($data as $row)
    {

     $totalsum=$row[4];
    }

}
function summary_table($data,$dbtable_input_tbl){
     $this->Ln();
    $this->SetFont('Arial','',8);

  
 foreach($data as $raw)
  {

     //$totalsum=$raw[4];
    }


   $this->Cell(120,3,'',0,1,'L');
$this->Ln(5);
}

}
$orientpdf='P';
if(sizeof($header)>6){
$orientpdf='L';
};
$pdf=new PDF($orientpdf,'mm','A4');
$sqlcontrols="select distinct fieldname , fieldcaption, tablecaption , pdfvisible , position,colnwidth,isautoincrement from admin_controller where tablename='$dbtable_input_tbl' and pdfvisible='Show' order by position";   
			
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='';
			if($cnt_cols>0){
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			
			  $tablename=$table_formcontrols['tablename']; 
			  $isautoincrement=$table_formcontrols['isautoincrement'];
			  $table_caption=$table_formcontrols['tablecaption'];$table_field=$table_formcontrols['fieldname'];
			  $table_col_caption=$table_formcontrols['fieldcaption'];
			  $table_col_viewdetails=$table_formcontrols['detailsvisiblepdf'];
              $table_col_viewonpdf=$table_formcontrols['pdfvisible'];
			  $table_col_positionb=$table_formcontrols['position'];
              $displayvalues[$countcurrentfield]=$table_formcontrols[0];
			  $header[$countcurrentfield]=$table_formcontrols[1];
			  $table_col_colnwidth=$table_formcontrols['colnwidth'];
			  if($table_formcontrols[3]=='Show'){
			  $headerWidth[$countcurrentfield]=$table_formcontrols[5];
			  }else{
			  $headerWidth[$countcurrentfield]=0;}
			  
			   $fieldnameARR=explode('_',$table_formcontrols['fieldname']);
			  if(( $fieldnameARR[1]=='id')&&(!$isautoincrement)){
			  $headerfields[$countcurrentfield]=$fieldnameARR[0].'_name';
			  }
			  else{
			  $headerfields[$countcurrentfield]=$table_formcontrols[0];
			  }
			  $isautoincrement='';
			  
			  
			  $countcurrentfield++;
			  
			  
			  
			  }}//end of while

//Instanciation of inherited class
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
//for($i=1;$i<=40;$i++)
///$pdf->getheaders($dbtable_input_tbl);
$data=$pdf->LoadData($dbtable_input_tbl,$headerfields);
$pdf->SetFont('Arial','',8);
$pdf->CreateDynamicPDFLayout($header,$data,$headerfields,$headerWidth);
//$pdf->summary_table($data);
$pdf->Output();

}

?><?php
define('FPDF_FONTPATH', 'font/');
//require('mc_table.php');

function GenerateWord()
{
    //Get a random word
    $nb=rand(3, 10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'), ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1, 10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s, 0, -1);
}

$pdf=new PDF_MC_Table();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30, 50, 30, 40));
srand(microtime()*1000000);
for($i=0;$i<20;$i++)
    $pdf->Row(array(GenerateSentence(), GenerateSentence(), GenerateSentence(), GenerateSentence()));
$pdf->Output();
?> 