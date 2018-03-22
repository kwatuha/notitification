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
require_once('../Connections/cf4_HH.php');
include('../template/functions/searchSQL.php');

?><?php
include('../template/functions/menuLinks.php');

?><?php
//$Result1 = mysql_query($insertSQL) or die(mysql_error());
$recommendations          =   $_POST['recommendations']          ;
$patient_number=$_POST['patient_number'];
$gross_description        =   $_POST['gross_description']        ;
$microscopic_description  =   $_POST['microscopic_description']  ;
$diagnosis                =   $_POST['diagnosis']                ;
$date_printed                =   $_POST['date_reported']                ;
$user_id                  =   $_POST['user_id']                  ;

//$patient_number='0001';

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function Header()
{
//$this->setY(10);
$this->Image('images/mtrh_log.jpg',10,10,27,30);
$this->Image('images/moi.jpg',110,10,27,27);
$this->Image('images/mtrh_log.jpg',155,10,27,30);
$this->Image('images/moi.jpg',255,10,27,27);
$this->SetFont('Arial','',13);
$this->SetY(45);
$this->SetX(10);
$this->Cell(75,5, 'MTRH-HISTOPATHOLOGY REFERENCE LABORATORY',0,0,'L');
$this->SetX(155);
$this->Cell(75,5, 'MTRH-HISTOPATHOLOGY REFERENCE LABORATORY',0,1,'L');
$this->SetFont('Arial','',10);
$this->SetY(51);
$this->SetX(48);
$this->Cell(75,5, 'An ISO 9001:2008 Certified Hospital',0,0,'L');
$this->SetX(194);
$this->Cell(75,5, 'An ISO 9001:2008 Certified Hospital',0,1,'L');
//$this->Rect($x, $y, $w, $h, $style='')
  $this->Rect(5, 5, 140, 200, $style='');
  $this->Rect(150, 5, 140,200, $style='');
 // $this->Cell(75,5, 'Patient Details',1,1,'L');
  $this->SetFont('Arial','',10);
  $this->Rect(5, 50, 140, 152, $style='');
  $this->Rect(150, 50, 140,152, $style='');
  
  $this->Rect(7, 60, 136,25, $style='');
  $this->Rect(152, 60,136,30, $style='');
  
  $this->Rect(7, 91, 136,20, $style='');
  $this->Rect(152, 91,136,20, $style='');
  
  $this->Rect(7, 112, 136,20, $style='');
  $this->Rect(152,112,136,20, $style='');
  
    $this->Rect(7, 133, 136,20, $style='');
  $this->Rect(152,133,136,20, $style='');
  
  $this->Rect(7, 154, 136,20, $style='');
  $this->Rect(152,154,136,20, $style='');
  
  $name='Kwatuha Alfayo Mulimamin';
  $age=127;
  $gender='Female';
  $LabNum='hs/1221/32/2011';
  $hospNo='MTRH/1a3221/32/2011';
  $sampledate='2011/12/02';
  $reportingdate='2011/12/02';
   $referringfacility='Eldoret Hospital';
  $this->SetY(65);
$this->SetFont('Arial','B',10);
$this->Cell(20,5, 'Name ',1,0,'L');
$this->SetX(87);
$this->Cell(17,5, 'Gender ',1,0,'L');
$this->SetX(122);
$this->Cell(10,5, 'Age ',1,0,'L');
$this->SetX(155);
$this->Cell(20,5, 'Name ',1,0,'L');
$this->SetX(232);
$this->Cell(17,5, 'Gender ',1,0,'L');
$this->SetX(267);
$this->Cell(10,5, 'Age ',1,0,'L');

$this->SetFont('Arial','',9);
$this->SetX(30);
$this->Cell(55,5, $name,1,0,'L');
$this->SetX(175);
$this->Cell(55,5, $name,1,0,'L');
$this->SetX(104);
$this->Cell(15,5, $gender,1,0,'L');
$this->SetX(249);
$this->Cell(15,5, $gender,1,0,'L');
$this->SetX(132);
$this->Cell(8,5, $age,1,0,'L');
$this->SetX(277);
$this->Cell(8,5, $age,1,1,'L');

$this->SetFont('Arial','B',10);
$this->Cell(20,5, 'Lab no. ',1,0,'L');
$this->SetX(155);
$this->Cell(20,5, 'Lab no. ',1,0,'L');
$this->SetX(87);
$this->Cell(17,5, 'Hosp no.',1,0,'L');
$this->SetX(232);
$this->Cell(17,5, 'Hosp no.',1,0,'L');

$this->SetFont('Arial','',9);
$this->SetX(30);
$this->Cell(55,5,$LabNum,1,0,'L');
$this->SetX(175);
$this->Cell(55,5,$LabNum,1,0,'L');
$this->SetX(104);
$this->Cell(36,5,$hospNo,1,0,'L');
$this->SetX(249);
$this->Cell(36,5,$hospNo,1,1,'L');

$this->SetFont('Arial','B',10);
$this->Cell(41,5, 'Sample collection Date ',1,0,'L');
$this->SetX(155);
$this->Cell(41,5, 'Sample collection Date ',1,0,'L');
$this->SetX(87);
$this->Cell(32,5,'Reporting Date ',1,0,'L');
$this->SetX(232);
$this->Cell(32,5,'Reporting Date ',1,0,'L');

$this->SetFont('Arial','',9);
$this->SetX(51);
$this->Cell(34,5, $sampledate,1,0,'L');
$this->SetX(196);
$this->Cell(34,5, $sampledate,1,0,'L');
$this->SetX(119);
$this->Cell(21,5,$reportingdate,1,0,'L');
$this->SetX(264);
$this->Cell(21,5,$reportingdate,1,1,'L');

$this->SetFont('Arial','B',10);
$this->Cell(32,5, 'Referring facility ',1,0,'L');
$this->SetX(155);
$this->Cell(32,5, 'Referring facility ',1,0,'L');

$this->SetFont('Arial','',9);
$this->SetX(42);
$this->Cell(43,5,$referringfacility,1,0,'L');
$this->SetX(187);
$this->Cell(43,5,$referringfacility,1,1,'L');
}

function LoadData($patient_number)
{
require_once('Connections/dp.php');
$sql="SELECT * FROM diagnosis  WHERE patient_number = '$patient_number' ORDER BY diagnosis_type_code, clinical_diagnosis_code";
$results_qry=mysql_query($sql) or die('Could not execute the query');
while($count=mysql_fetch_array($results_qry)){
$results =$count['results'];
$clinical_diagnosis_code    =$count['clinical_diagnosis_code'];
$diagnosis_type_code     =$count['diagnosis_type_code'];
$data[]=array($diagnosis_type_code,$clinical_diagnosis_code,$results);
}
return $data;
}

/*//Colored table
function FancyTable($header,$data)
{
    //Colors, line width and bold font
    $this->SetFillColor(150,125,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    //Header
    //$w=array(40,35,40,45);
  $w=array(25,35,130);
   $this->Cell($w[0],6,$header[0],1,0,'L',true);
    for($i=1;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'L',true);
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    //Data
    $fill=false;
    foreach($data as $raw)
  {
        $this->Cell($w[0],5,$raw[0],'LR',0,'L',$fill);
        $this->Cell($w[1],5,$raw[1],'LR',0,'L',$fill);
        $this->Cell($w[2],5,$raw[2],'LR',0,'L',$fill);
        $this->Cell($w[3],5,$raw[3],'LR',0,'L',$fill);
        $this->Ln();
        $fill=!$fill;
    }
    $this->Cell(array_sum($w),0,'','T');
}*/

/*function summary_calculations($header,$data)
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
*/

function summary_table($data){
     $this->Ln();
    $this->SetFont('Arial','',8);

  
 foreach($data as $raw)
  {

     $totalsum=$raw[4];
    }
$gross_description        =   $_POST['gross_description']        ;
$microscopic_description  =   $_POST['microscopic_description']  ;
$recommendations  =$_POST['recommendations']  ;
$diagnosis=$_POST['diagnosis'];

   $this->Cell(120,3,'',0,1,'L');
//$this->SetFillColor(150,125,255);
$this->setY(91);
$this->Cell(35,5,'Gross Description','B',1,'L',$fill=false);
$this->setY(96);
$this->MultiCell(130, 5, $gross_description, $border=0, $align='J', $fill=false);

$this->setY(114);
$this->Cell(35,5,'Microscopic Description','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $microscopic_description, $border=0, $align='J', $fill=false);

$this->setY(134);
$this->Cell(35,5,'Diagnosis','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $diagnosis, $border=0, $align='J', $fill=false);

$this->setY(154);
$this->Cell(35,5,'Comments','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $recommendations, $border=0, $align='J', $fill=false);
$this->Cell(130,3,'',0,1,'L');

require_once('Connections/dp.php');
$Employee_Number        =   trim($_POST['Employee_Number'])      ;
$sql="SELECT * FROM employees   WHERE emp_id = '$Employee_Number'";
$results_qry=mysql_query($sql) or die('Could not execute the query');
while($count=mysql_fetch_array($results_qry)){
$name=$count['last_name'].' '.$count['first_name'];

}

  $this->SetFont('Arial','B',9);
  $this->setY(177);
   $this->setX(7);
  $this->Cell(35,5,'Pathologist',0,0,'L',$fill=false);
  $this->SetX(152);
  $this->Cell(35,5,'Pathologist',0,0,'L',$fill=false);
  $this->SetX(30);
  $this->SetFont('Arial','',9);
  $this->Cell(95,5,$name,0,0,'L');
  $this->SetX(190);
  $this->Cell(95,5,$name,0,1,'L');
  
  $this->SetFont('Arial','B',9);
  $this->setY(184);
   $this->setX(7);
  $this->Cell(35,5,'Signature',0,0,'L',$fill=false);
  $this->SetX(152);
  $this->Cell(35,5,'Signature',0,0,'L',$fill=false);
   $this->SetX(30);
  $this->Cell(45,5,'','B',0,'L');
  $this->SetX(190);
  $this->Cell(45,5,'','B',1,'L');
  /*$this->Cell(18,5,'Signature',1,0,'L',$fill=false);
   $this->SetX(155);
  $this->Cell(18,5,'Signature',1,0,'L',$fill=false);
  $this->Cell(48,5,'',1,0,'L');*/
  
/*     $key=trim('malignant tumor');
   $key=strtoupper($key);
   $diagnosis=trim(strtoupper($diagnosis));
     if($diagnosis==$key){
  $this->Cell(40,6,'Name',1,0,'L',true);
  $this->Cell(80,8,$name,1,1,'L');
  $this->Cell(40,8,'Signature',1,0,'L',true);
  $this->Cell(80,8,'',1,1,'L');
   }*/
}

}
$pdf=new PDF('L');
//Column titles
$header=array('Diagnosis Type','Diagnosis','Diagnosis Findings');
//Data loading
//Instanciation of inherited class
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
for($i=1;$i<=40;$i++)
$data=$pdf->LoadData($patient_number);
$pdf->SetFont('Arial','',8);
//$pdf->FancyTable($header,$data);
$pdf->summary_table($data);
$pdf->Output();


?>