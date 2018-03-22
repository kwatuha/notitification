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
?>
<?php

//createPDFstatements($table_name,$tableprimaryvalue);
function createPDFstatements($table_name,$tableprimaryvalue){
$part_PDF='./../template/pdf/pdftemp.php';
$pdfpartone = file_get_contents($part_PDF);
$newfilePDFdetails='../'.'statements'.'/'.'statement_v1.php';

$currentPdf.='
create'.$table_name.'PDFreports($table_name,$tableprimaryvalue);
function create'.$table_name.'PDFreports($table_name,$tableprimaryvalue){
require('."'".'../template/pdf/fpdf.php'."');
class PDF extends FPDF
{
//Start column headers
function getheaders(".'$table_name){
}		  

//end column headers
function Header()
{
$this->Image('."'".'../template/reportimages/images/zul_logo.jpg'."',93,12,27,27);".'
$this->Image('."'".'../template/reportimages/images/word_zul_V4.jpg'."'".',75,40,80,4);
$this->SetFont('."'"."Arial','',6);".'
$date_printed=date('."'"."d-m-Y');".'
$this->Ln(35.5);
$this->Cell(20);
$this->Cell(40,5,'."'Address: P.O. Box 208 KAKAMEGA  ',0,0,'C');".'
//$this->Cell(80);
$this->Cell(40,5,'."' Tel: 056 - 30352, 30373 Fax: 056 - 30793',0,0,'C');".'
//$this->Cell(80);
$this->Cell(40,5,'."' Mobile: 0722 248508 / 0733 557104 ',0,0,'C');".'
$this->Cell(40,5,'."'Email: zulmacinsurance@yahoo.com',0,1,'C');
".'$this->Cell(190,0,'."'','T');".'
//$this->Cell(80);
//$this->Cell(20,5,'."'Web: zulmacinsurance.com',0,1,'C');".'
$this->SetFont('."'Arial','',12);".'
  $this->Ln(10);
  $this->Cell(75,5, $_SESSION['."'".$table_name."'],0,1,'L');".'
  $this->SetFont'."('Courier','',8);".'
  //$this->Cell(75,5,'."'Date : '.".'$date_printed,1,1,'."'L');".
  '
  $this->Ln(5);
}
//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
	$date_printed=date('."'d-m-Y');".'
    $this->SetFont('."'Courier','',8);".'
    $this->Cell(180,6,'."' Zulmac Insurance Brokers Limited ',0,1,'C');".'
	 $this->SetY(-18);
	 $this->SetFont('."'Courier','I',6);".'
	 $this->Cell(180,6,$_SESSION['."'".$table_name."'].'  printed by '".'.$_SESSION['."'my_username'].'  as at '".'.$date_printed'.",0,1,'C');
  //".'$this->Cell(100,6,$_SESSION['.$table_name."'].'  printed by '.".'$_SESSION['."'my_username'],0,1,'R');";
  
  
  
  
  $currentPdf.='
  $this->Cell(100,6,'."' Page '.".'$this->PageNo()'.".' of {nb}',0,1,'R');
}".'

function summary_calculations($header,$data)
{
    //Column widths
    $w=array(1,15,10, 1);
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'."'C');".'
    $this->Ln();
    //Data
    foreach($data as $row)
    {

     $totalsum=$row[4];
    }

}
function summary_table($data,$table_name){
     $this->Ln();
    $this->SetFont('."'Arial','',8);

  
 foreach(".'$data as $raw)
  {

     //$totalsum=$raw[4];
    }


   $this->Cell(120,3,'."'',0,1,'L');".
'
$this->Ln(5);

}

';

//select related information

$sqlcontrolsSTS="
select 
distinct 
statement_id,
tablename,
statement_caption,
statement_link,
show_identifier,
first_only,
pdfvisible,
position from admin_statement where tablename='$table_name' and pdfvisible='Yes' order by position"; 

			$results_ctrls_stms=mysql_query($sqlcontrolsSTS);
	        $cnt_cols_stms=mysql_num_rows($results_ctrls_stms);
			$countcurrentfield=0; 
			$displayvalues='';
			
			echo "i got $cnt_cols_stms it==$tablename".$countstms."<br>".$sqlcontrolsSTS;
			if($cnt_cols_stms>0){
			
			$countstms=0;
			while($table_formcontrols=mysql_fetch_array($results_ctrls_stms)){
			$countstms++;
			
			  $tablename=$table_formcontrols['tablename']; 
			  $table_caption=$table_formcontrols['statement_caption'];
              $currentattbl=$table_formcontrols['statement_link'];
			  
			 ///
			 		//strat details.
	$currentPdf.='
	function CreateDynamicPDFLayout'.$countstms.'($header'.$countstms.',$data'.$countstms.',$headerfields'.$countstms.',$headerWidth'.$countstms.')
{
    $this->SetFillColor(150,125,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    
    //Header'.'
	$this->'."SetFont('','B');".'
    for($i=0;$i<sizeof($header'.$countstms.');$i++)
	
    $this->Cell($headerWidth'.$countstms.'[$i],6,$header'.$countstms.'[$i],1,0,'."'L',true);".'
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('."'');".'
    $this->SetFont('."'Courier','',7);".
	'
    //Data
    $fill=false;
	$rowitemnumber'.$countstms.'=0;
	$tcolmns'.$countstms.'=sizeof($headerWidth'.$countstms.');
    foreach($data'.$countstms.' as $raw'.$countstms.')
  {
        for($rowitemnumber'.$countstms.'=0;$rowitemnumber'.$countstms.'<$tcolmns'.$countstms.';$rowitemnumber'.$countstms.'++){
		if($header'.$countstms.'[$rowitemnumber'.$countstms.']!='."''){".'
		$this->Cell($headerWidth'.$countstms.'[$rowitemnumber'.$countstms.'],5,$raw'.$countstms.'[$rowitemnumber'.$countstms.'],'."'LRT'".', 0,'."'L'".', $fill);
		}
		}
       
		$rowitemdetails'.$countstms.'++;                    
        
        $this->Ln();
        $fill=!$fill;
    }
	$curentwidhtotal'.$countstms.'=array_sum($headerWidth'.$countstms.');
    $this->Cell($curentwidhtotal'.$countstms.',0,'."''".','."'T'".');
	$this->Ln();
	$this->SetFont('."'Arial','',8);".'
	$this->Cell(100,6,$_SESSION['."'".$currentattbl."'],0,1,'L');".'
	$this->Ln(3);'.'
}';
		
		//end details
			 ///
			 //create data functions
		$currentPdf.=	 "function LoadData".$countstms."(".'$table_name,$headerfields'.$countstms.')
{
$sql'.$countstms.'=$_SESSION['."'".$currentattbl."_SearchSQL'].\" WHERE $search_col = $tableprimaryvalue\";".'
$results_qry'.$countstms.'=mysql_query($sql'.$countstms.');'.'
$cnt_colrowsfnd'.$countstms.'=mysql_num_rows($results_qry'.$countstms.');

if($cnt_colrowsfnd'.$countstms.'>0){
while('.'$count'.$countstms.'=mysql_fetch_array($results_qry'.$countstms.')){
$cntcols'.$countstms.'=0;
foreach($headerfields'.$countstms.' as $pdffielditem'.$countstms.'){


$arrDataRow'.$countstms.'[$cntcols'.$countstms.']=$count'.$countstms.'[$pdffielditem'.$countstms.'];
$processedfieldname'.$countstms.'=$pdffielditem'.$countstms.';
$cntcols'.$countstms.'++;
}
$data'.$countstms.'[]=array_unique($arrDataRow'.$countstms.');
}
}//end of cnt for rows found
return $data'.$countstms.';
}
///end of data functions
 
';

if($cnt_cols_stms==$countstms){
$currentPdf.='}//end of fpdfcl';
}
			 
		// function createclmnheaders'.$countstms.'(){	
		$currentheadersdetails.=	$lastdetailspdfend. '
		
		
		
$sqlcontrols'.$countstms.'="select distinct fieldname , fieldcaption, tablecaption , pdfvisible , position,colnwidth from admin_controller where tablename='."'".$currentattbl."' and pdfvisible='Show' order by position".'"; '.'  
			$results_ctrls'.$countstms.'=mysql_query($sqlcontrols'.$countstms.');
	        $cnt_cols'.$countstms.'=mysql_num_rows($results_ctrls'.$countstms.');
			$countcurrentfield'.$countstms.'=0; 
			$displayvalues'.$countstms.'='."''".';
			if($cnt_cols'.$countstms.'>0){
			while($table_formcontrols'.$countstms.'=mysql_fetch_array($results_ctrls'.$countstms.')){
			  $tablename'.$countstms.'=$table_formcontrols'.$countstms.'['."'tablename']; ".'
			  $table_caption'.$countstms.'=$table_formcontrols'.$countstms.'['."'tablecaption'];".
			  '$table_field'.$countstms.'=$table_formcontrols'.$countstms.'['."'fieldname'];".'
			  $table_col_caption'.$countstms.'=$table_formcontrols'.$countstms.'['."'fieldcaption'];".'
			  $table_col_viewdetails'.$countstms.'=$table_formcontrols'.$countstms.'['."'detailsvisiblepdf'];".'
              $table_col_viewonpdf'.$countstms.'=$table_formcontrols'.$countstms.'['."'pdfvisible'];".'
			  $table_col_positionb'.$countstms.'=$table_formcontrols'.$countstms.'['."'position'];".'
              $displayvalues'.$countstms.'[$countcurrentfield'.$countstms.']=$table_formcontrols'.$countstms.'[0];
			  $header'.$countstms.'[$countcurrentfield'.$countstms.']=$table_formcontrols'.$countstms.'[1];
			  $table_col_colnwidth'.$countstms.'=$table_formcontrols'.$countstms.'['."'colnwidth'".'];
			  if($table_formcontrols'.$countstms.'[3]=='."'Show'".'){
			  $headerWidth'.$countstms.'[$countcurrentfield'.$countstms.']=$table_formcontrols'.$countstms.'[5];
			  }else{
			  $headerWidth'.$countstms.'[$countcurrentfield'.$countstms.']=0;}
			  $headerfields'.$countstms.'[$countcurrentfield'.$countstms.']=$table_formcontrols'.$countstms.'[0];
			  $countcurrentfield'.$countstms.'++;
			  }}//end of while
  
 
';
$currenttblloop.='$sqlTest'.$countstms.'=$_SESSION['."'".$currentattbl."_SearchSQL'];".'
$resultsTEST'.$countstms.'=mysql_query($sqlTest'.$countstms.');
if($resultsTEST'.$countstms.'){
$countresultsTEST'.$countstms.'=mysql_num_rows($resultsTEST'.$countstms.');
}';

$currenttblloop.='
if($countresultsTEST'.$countstms.'>0){

$data'.$countstms.'=$pdf->LoadData'.$countstms.'('."'".$currentattbl."'".',$headerfields'.$countstms.');
$pdf->SetFont('."'Arial','',8);".'
$pdf->CreateDynamicPDFLayout'.$countstms.'($header'.$countstms.',$data'.$countstms.',$headerfields'.$countstms.',$headerWidth'.$countstms.');

}
';

				 }//end of whileea
			 

			 
			 } //end of dataArrays


//satement


$lastdetailsp='$orientpdf='."'P';
if(sizeof(".'$header)>6){
$orientpdf='."'L';
};
".'$pdf=new PDF($orientpdf,'."'mm','A4');".'
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('."'Arial','',12);";

$currentPdf.='
'.$currentheadersdetails.'
'.$lastdetailsp.'
'.$currenttblloop;
$currenttblloop='';

$currentPdf.='
$pdf->Output();

}';
$currentPdf=$pdfpartone.'<?php

 
'.$currentPdf.'

?>';
file_put_contents($newfilePDFdetails, $currentPdf);
$currentPdf='';

}//end of pdf func
?>