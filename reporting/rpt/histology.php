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
require_once('../../Connections/cf4_HH.php');
?><?php
include('../../template/functions/menuLinks.php');
require('fpdf.php');
?><?php

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$insertSQL = sprintf("INSERT INTO prescription (prescription_id, recommendations, patient_number, gross_description, microscopic_description, diagnosis, `date`, user_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['prescription_id'], "text"),
                       GetSQLValueString($_POST['recommendations'], "text"),
                       GetSQLValueString($_POST['patient_number'], "text"),
                       GetSQLValueString($_POST['gross_description'], "text"),
                       GetSQLValueString($_POST['microscopic_description'], "text"),
                       GetSQLValueString($_POST['diagnosis'], "text"),
                       GetSQLValueString($_POST['date_reported'], "text"),
                       GetSQLValueString($_POST['Employee_Number'], "text"));

  mysql_select_db($database_dp);
//$Result1 = mysql_query($insertSQL) or die(mysql_error());
$recommendations          =   $_POST['recommendations']          ;
$patient_number='CA/1298/11';
//$_POST['patient_number'];
//patient_number=
$gross_description        =   $_POST['gross_description']        ;
$microscopic_description  =   $_POST['microscopic_description']  ;
$diagnosis                =   $_POST['diagnosis']                ;
$date_printed                =   $_POST['date_reported']                ;
$user_id                  =   $_POST['user_id']                  ;

//$patient_number='0001';


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
  
  $this->Rect(7, 62, 136,25, $style='');
  $this->Rect(152, 62,136,25, $style='');
  
  $this->Rect(7,88,136,15, $style='');
  $this->Rect(152,88,136,15, $style='');
  
  $this->Rect(7, 104, 136,15, $style='');
  $this->Rect(152,104,136,15, $style='');
  
  $this->Rect(7, 120, 136,15, $style='');
  $this->Rect(152,120,136,15, $style='');
  
  $this->Rect(7, 136, 136,15, $style='');
  $this->Rect(152,136,136,15, $style='');
  
  $this->Rect(7, 152, 136,15, $style='');
  $this->Rect(152,152,136,15, $style='');
  
  $this->Rect(7, 168, 136,15, $style='');
  $this->Rect(152,168,136,15, $style='');
  $pid=$_GET['rd'];
  $ldata=fillPrimaryData('medicallab_histology',$pid);
   $quid=$ldata['queue_id'];
   
  $llarr=fillPrimaryData('medicallab_queue',$quid);
$name=$llarr['person_fullname'];

$pesronid=$llarr['person_id'];
$pdata=fillPrimaryData('admin_person',$pesronid);
$referringfacility=$llarr['referring_facility'];
$gender=$pdata['gender_id'];
if($gender==1)
$gender='F';

if($gender==2)
$gender='M';
$age=$llarr['patient_age'];
/*$referringfacility=$llarr['referring_facility'];
$referringfacility=$llarr['referring_facility'];
*/ //// $name='Kwatuha Alfayo Mulimamin';
  //$age=127;
  //$gender='Female';
  $LabNum=$llarr['queue_name'];//'hs/1221/32/2011';
  $hospNo=$llarr['hospital_number'];//'MTRH/1a3221/32/2011';
  
  
  //lab tests
  $ldata=fillPrimaryData('medicallab_histology',1);
  $sampledate=$ldata['sample_collection_date'];
  
  $reportingdate=$ldata['reporting_date'];
  
  
  
  //$biopsysite $clinicalhistory $gross_description $microscopic_description $recommendations $diagnosis
//$referringfacility='Eldoret Hospital';
$_SESSION['doctorName']='Dr. Nyamuki Ondieki';

$this->SetY(65);
$this->SetFont('Arial','B',10);
$this->Cell(20,5, 'Name ',0,0,'L');
$this->SetX(87);
$this->Cell(17,5, 'Gender ',0,0,'L');
$this->SetX(122);
$this->Cell(10,5, 'Age ','R',0,'L');
$this->SetX(155);
$this->Cell(20,5, 'Name ',0,0,'L');
$this->SetX(232);
$this->Cell(17,5, 'Gender ',0,0,'L');
$this->SetX(267);
$this->Cell(10,5, 'Age ','R',0,'L');

$this->SetFont('Arial','',9);
$this->SetX(30);
$this->Cell(55,5, $name,0,0,'L');
$this->SetX(175);
$this->Cell(55,5, $name,0,0,'L');
$this->SetX(104);
$this->Cell(15,5, $gender,0,0,'L');
$this->SetX(249);
$this->Cell(15,5, $gender,0,0,'L');
$this->SetX(132);
$this->Cell(8,5, $age,'L',0,'L');
$this->SetX(277);
$this->Cell(8,5, $age,'L',1,'L');

$this->SetFont('Arial','B',10);
$this->Cell(20,5, 'Lab no. ',0,0,'L');
$this->SetX(155);
$this->Cell(20,5, 'Lab no. ',0,0,'L');
$this->SetX(87);
$this->Cell(17,5, 'Hosp no.',0,0,'L');
$this->SetX(232);
$this->Cell(17,5, 'Hosp no.',0,0,'L');

$this->SetFont('Arial','',9);
$this->SetX(30);
$this->Cell(55,5,$LabNum,0,0,'L');
$this->SetX(175);
$this->Cell(55,5,$LabNum,0,0,'L');
$this->SetX(104);
$this->Cell(36,5,$hospNo,0,0,'L');
$this->SetX(249);
$this->Cell(36,5,$hospNo,0,1,'L');

$this->SetFont('Arial','B',10);
$this->Cell(41,5, 'Sample collection Date ',0,0,'L');
$this->SetX(155);
$this->Cell(41,5, 'Sample collection Date ',0,0,'L');
$this->SetX(87);
$this->Cell(32,5,'Reporting Date ',0,0,'L');
$this->SetX(232);
$this->Cell(32,5,'Reporting Date ',0,0,'L');

$this->SetFont('Arial','',9);
$this->SetX(51);
$this->Cell(34,5, $sampledate,0,0,'L');
$this->SetX(196);
$this->Cell(34,5, $sampledate,0,0,'L');
$this->SetX(119);
$this->Cell(21,5,$reportingdate,0,0,'L');
$this->SetX(264);
$this->Cell(21,5,$reportingdate,0,1,'L');

$this->SetFont('Arial','B',10);
$this->Cell(32,5, 'Referring facility ',0,0,'L');
$this->SetX(155);
$this->Cell(32,5, 'Referring facility ',0,0,'L');

$this->SetFont('Arial','',9);
$this->SetX(42);
$this->Cell(43,5,$referringfacility,0,0,'L');
$this->SetX(187);
$this->Cell(43,5,$referringfacility,0,1,'L');
}
function Footer()
{
  $this->SetFont('Arial','B',9);
  $this->setY(-20);
  $this->setX(7);
  $this->Cell(19,5,'Pathologist',0,0,'L',$fill=false);
  $this->SetFont('Arial','',9);
  $this->Cell(45,5,$_SESSION['doctorName'],0,0,'L');
  $this->SetX(74);
  $this->SetFont('Arial','B',9);
  $this->Cell(10,5,'Sign',0,0,'L',$fill=false);
  $this->SetX(84);
  $this->Cell(45,5,'','B',0,'L');
  $this->SetX(152);
  $this->SetFont('Arial','B',9);
  $this->Cell(19,5,'Pathologist',0,0,'L',$fill=false);
  $this->SetFont('Arial','',9);
  $this->Cell(45,5,$_SESSION['doctorName'],0,0,'L');
  $this->SetX(217);
  $this->SetFont('Arial','B',9);
  $this->Cell(10,5,'Sign',0,0,'L',$fill=false);
  $this->Cell(45,5,'','B',1,'L');
  
  $this->SetX(152);
  
}

function LoadData($patient_number)
{

$sql=$_SESSION["medicallab_histology_SearchSQL"]." WHERE person_id=$patient_number "; 
$results_qry=mysql_query($sql) or die($sql);
while($count=mysql_fetch_array($results_qry)){
$results =$count['queue_id'];
$clinical_diagnosis_code    =$count['clinical_diagnosis_code'];
$diagnosis_type_code     =$count['diagnosis_type_code'];
$data[]=array($diagnosis_type_code,$clinical_diagnosis_code,$results);
}
return $data;
}

function summary_table($data){
     $this->Ln();
    $this->SetFont('Arial','',8);
$clinicalhistory='Clinical History desc Information';
$biopsysite='Biopsy Site Information';
  
 foreach($data as $raw)
  {

     $totalsum=$raw[4];
    }
/*$gross_description        =   $_POST['gross_description']        ;
$microscopic_description  =   $_POST['microscopic_description']  ;
$recommendations  =$_POST['recommendations']  ;
$diagnosis=$_POST['diagnosis'];
*/
   $rid=$_GET['rd'];
   $ldata=fillPrimaryData('medicallab_histology',$rid);
   $sampledate=$ldata['sample_collection_date'];
   $reportingdate=$ldata['reporting_date'];
   
  $biopsysite=$ldata['biopsy_site'];
   $clinicalhistory=$ldata['clinical_history'];
  $gross_description=$ldata['conclusion'];
    $clinicalhistory=$ldata['clinical_history'];
  $gross_description=$ldata['gross_description'];
   $microscopic_description=$ldata['microscopy'];
  $recommendations=$ldata['comments'];
   
   
$this->Cell(120,3,'',0,1,'L');
$this->setY(88);
$this->Cell(55,5,'Biopsy site: ','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $biopsysite , $border=0, $align='J', $fill=false);

$this->setY(88);
$this->SetX(152);
$this->Cell(55,5,'Biopsy site:' ,'B',1,'L',$fill=false);
$this->setY(93);
$this->SetX(152);
$this->MultiCell(130, 5, $biopsysite , $border=0, $align='J', $fill=false);

$this->Cell(120,3,'',0,1,'L');
$this->setY(104);
$this->Cell(55,5,'Clinical History: ','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $clinicalhistory , $border=0, $align='J', $fill=false);

$this->setY(104);
$this->SetX(152);
$this->Cell(55,5,'Clinical History:','B',1,'L',$fill=false);
$this->setY(111);
$this->SetX(152);
$this->MultiCell(130, 5, $clinicalhistory , $border=0, $align='J', $fill=false);


$this->Cell(120,3,'',0,1,'L');
$this->setY(120);
$this->Cell(55,5,'Gross description:','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $gross_description , $border=0, $align='J', $fill=false);

$this->setY(120);
$this->SetX(152);
$this->Cell(55,5,'Gross description:','B',1,'L',$fill=false);
$this->setY(125);
$this->SetX(152);
$this->MultiCell(130, 5, $gross_description , $border=0, $align='J', $fill=false);

$this->setY(136);
$this->Cell(55,5,'Microscopy','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $microscopic_description , $border=0, $align='J', $fill=false);

$this->setY(136);
$this->SetX(152);
$this->Cell(55,5,'Microscopy','B',1,'L',$fill=false);
$this->setY(141);
$this->SetX(152);
$this->MultiCell(130, 5, $microscopic_description , $border=0, $align='J', $fill=false);

$this->setY(152);
$this->Cell(55,5,'Diagnosis','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $diagnosis , $border=0, $align='J', $fill=false);

$this->setY(152);
$this->SetX(152);
$this->Cell(55,5,'Diagnosis','B',1,'L',$fill=false);
$this->setY(157);
$this->SetX(152);
$this->MultiCell(130, 5, $diagnosis , $border=0, $align='J', $fill=false);

$this->setY(168);
$this->Cell(55,5,'Comments','B',1,'L',$fill=false);
$this->MultiCell(130, 5, $recommendations , $border=0, $align='J', $fill=false);

$this->setY(168);
$this->SetX(152);
$this->Cell(55,5,'Comments','B',1,'L',$fill=false);

$this->setY(173);
$this->SetX(152);
$this->MultiCell(130, 5, $recommendations, $border=0, $align='J', $fill=false);

$this->Cell(130,3,'',0,1,'L');




$diagnosis='malignant tumor';
$key=trim('malignant tumor');
 $key=strtoupper($key);
$diagnosis=trim(strtoupper($diagnosis));
    /* if($diagnosis==$key){
  $this->Cell(40,6,'Name',1,0,'L',true);
  $this->Cell(80,8,$name,1,1,'L');
  $this->Cell(40,8,'Signature',1,0,'L',true);
  $this->Cell(80,8,'',1,1,'L');
   }*/
   
  $this->SetFont('Arial','B',9);
  $this->setY(184);
   $this->setX(7);
   
  $this->Cell(19,5,'Pathologist',0,0,'L',$fill=false);
   if($diagnosis==$key){
   $this->setX(74);
  $this->Cell(10,5,'Sign',0,0,'L',$fill=false);
   $this->SetX(84);
  $this->Cell(45,5,'','B',0,'L');
   }
  
  $this->SetX(152);
  $this->Cell(19,5,'Pathologist',0,0,'L',$fill=false);
  if($diagnosis==$key){
   $this->setX(217);
  $this->Cell(10,5,'Sign',0,0,'L',$fill=false);
  $this->SetX(227);
  $this->Cell(45,5,'','B',0,'L');
   }
  $this->SetX(27);
  $this->SetFont('Arial','',9);
  $this->Cell(45,5,$name,0,0,'L');
  $this->SetX(172);
  $this->Cell(45,5,$name,0,1,'L');
  
 
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
$pid=$_GET['rd'];
$ldata=fillPrimaryData('medicallab_histology',$pid);
$quid=$ldata['queue_id'];
$llarr=fillPrimaryData('medicallab_queue',$quid);
$name=$llarr['person_fullname'];
$pid=$llarr['person_id'];
$data=$pdf->LoadData($pid);
$pdf->SetFont('Arial','',8);
//$pdf->FancyTable($header,$data);
$pdf->summary_table($data);
$pdf->Output();


?>