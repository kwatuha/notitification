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
class PDF extends FPDF
{
//Page header
function Header()
{
    //Logo
/*$this->Image('Sunset.jpg',130,12,27,20);
$this->Ln(25);
$this->SetFont('Arial','B',15);
$this->cell(0,7,'MOI TEACHING AND REFERRAL HOSPITAL',0,1,'C');
$this->cell(0,7,'P.O Box 7844-40401 Eldoret',0,1,'C');
$this->cell(0,10,'Salary Slip for the Month of March 2011',0,1,'C');
$this->cell(0,3,'','T',1,'C');*/
//
//$this->Image('images/word.jpg',10,45,190,23);
//Arial bold 15


//variables
$pid=base64_decode($_GET['rd']);
$personal=fillPrimaryData('admin_person',$pid);
$prefferedContacts=getPrefferedContact('admin_person',$pid);
$postal_address=$prefferedContacts['postal_address'];
//
$this->SetFont('Arial','',9);
$employers_name      =$companyArr[0];//'Moi University';
$employees_name    ='Ojwang\'';
$employees_other_name    ='Antony Wachiaje\'';
$employees_address  =$postal_address;//'P.O Box 29-40401 Karungu';
$Date_of_Paymment='21st February, 2011';
$Basic_sal=100000;
$Benefits=20000;
$Deductions=8000;
$Gross_sal=$Basic_sal + $Benefits;
$Net_sal=$Gross_sal - $Deductions;

/*//$date_printed=$_POST['date_reported'];
//$date_printed==$_POST['date'];
    $this->Ln(5);
  $this->SetFont('Times','',12);
  $this->Cell(60,5, 'Employee\'s Details',0,1,'L');
  $this->SetFont('Courier','',8);
   $this->Cell(110,5,'Name of Employee: '.$employees_name,0,0,'L');
  $this->Cell(60,5,'Name of Employer: '.$employers_name,0,1,'L');
  $this->Cell(110,5,'Other Names: '.$employees_other_name,0,0,'L');
  $this->Cell(60,5,'Date of Payment: '.$Date_of_Paymment,0,1,'L');
  $this->Cell(60,5,'Address: '.$employees_address,0,1,'L');
  $this->Cell(60,5,'wewewewe: '.$employees_address,0,1,'L');
  
  $this->Ln(5);
  $this->SetFont('Times','',12);
  $this->Cell(60,5, 'Income Details',0,1,'L');
  $this->SetFont('Courier','',10);
  $this->Cell(60,5,'Basic Salary: '.$Basic_sal,0,0,'L');
  $this->Cell(30,5,'Add',0,1,'L');
  $this->Cell(113,5,'Benefits: '.$Benefits,0,1,'R');
  $this->Cell(60,5,'Gross Salary: '.$Gross_sal,0,0,'L');
  $this->Cell(30,5,'Less',0,1,'L');
  $this->Cell(115,5,'Deductions: '.$Deductions,0,1,'R');*/
  
  $campanyDetail=fillPrimaryData('admin_company',1);
  $companyname=$campanyDetail['company_name'];
  $employees_name=$personal['person_fullname'];//'Kwatuha Alfayo Mulimani Mmbwanga';
  $employee=1255500.00;
  $this->SetFont('Arial','',9);
  
  //$this->Cell(60,5,'********************************************',0,1,'L');
   $this->SetFont('Times','B',18);
  $this->Cell(60,5,$companyname,0,1,'L');
   $this->SetFont('Times','',9);
   $this->Ln(2);
  
  $this->Cell(85,5,'********************************************',0,1,'L');
  
  $this->Cell(60,5,'Name: ',0,0,'L');
  $this->SetFont('Arial','B',9);
  $this->Cell(10,5,$employees_name,0,1,'R');
  $this->SetFont('Arial','',9);
  
  $this->Cell(60,5,'Dept: ',0,0,'L');
  $this->SetFont('Arial','B',9);
  $this->Cell(10,5,$employee,0,1,'R');
  $this->SetFont('Arial','',9);
  
  
  $this->Cell(60,5,'Grades: ',0,0,'L');
 $this->SetFont('Arial','B',9);
  $this->Cell(10,5,$employee,0,1,'R');
  $this->SetFont('Arial','',9);
  
  $this->Cell(60,5,'National: ',0,0,'L');
  $this->SetFont('Arial','B',9);
  $this->Cell(10,5,$employee,0,1,'R');
  $this->SetFont('Arial','',9);
  
  $this->Cell(60,5,'Month: ',0,0,'L');
  
  $this->SetFont('Arial','B',9);
  $this->Cell(10,5,$employee,0,1,'R');
  $this->SetFont('Arial','',9);
  
  $this->SetFont('Arial','B',10);
  $this->Ln(1);
  $this->Cell(60,5,'Earnings :-',0,1,'L');
  $this->SetFont('Arial','',9);
 $this->Cell(85,5,'********************************************',0,1,'L');
   $this->Cell(60,5,'Basic Salary',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  
  $this->Cell(60,5,'House Allowance: '.$employee,0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  $this->Cell(60,5,'Commuter allowance',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  $this->Cell(60,5,'Risk Allowance',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  $this->Cell(85,5,'********************************************',0,1,'L');
  
  
 $this->SetFont('Arial','B',10);
 $this->Cell(60,5,'Gross Pay ',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  $this->SetFont('Arial','',9);
  
  $this->SetFont('Arial','B',10);
   $this->Ln(1);
  $this->Cell(60,5,'Taxations :-',0,1,'L');
  $this->SetFont('Arial','',9);
  $this->Cell(85,5,'********************************************',0,1,'L');
  $this->Cell(60,5,'Contribution Benefit',0,0,'L');
  $this->Cell(10,5,'200.00',0,1,'R');

  
  $this->Cell(60,5,'Chargeable Pay',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  $this->Cell(60,5,'Tax Charged Month',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  $this->Cell(60,5,'Monthly Personal Relief',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');

   $this->Ln(1);
    $this->SetFont('Arial','B',9);
  $this->Cell(60,5,'Deductions :-',0,1,'L');
  $this->SetFont('Arial','',9);
 $this->Cell(85,5,'********************************************',0,1,'L');
   $this->Cell(60,5,'PAYE',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  
  $this->Cell(60,5,'NSSF '.$employee,0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  $this->Cell(60,5,'NHIF',0,0,'L');
  $this->Cell(10,5,$employee,0,1,'R');
  
 $this->SetFont('Arial','B',9);
 $this->Ln(1); 
 $this->Cell(60,5,'TOTAL DEDUCTIONS',0,0,'l');
 $this->Cell(10,5,$employee,0,1,'R');
 $this->SetFont('Arial','',9);
 
 $this->SetFont('Arial','B',9);
 $this->Ln(1); 
 $this->Cell(60,5,'NET PAY',0,0,'l');
 $this->Cell(10,5,$employee,0,1,'R');
 $this->SetFont('Arial','',9);
 
  $this->SetFont('Arial','B',9);
 $this->Ln(1); 
 $this->Cell(60,5,'Payment Details',0,0,'l');
 $this->Cell(10,5,$employee,0,1,'R');
 $this->SetFont('Arial','',9);
 
 $this->SetFont('Arial','B',9);
 $this->Ln(1); 
 $this->Cell(60,5,'Messages:-',0,0,'l');
 $this->Cell(10,5,'',0,1,'R');
 $this->SetFont('Arial','',9);
  $this->Cell(85,5,'********************************************',0,1,'L');

    $this->Ln(5);
}
//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
    $this->SetFont('Courier','',10);
    //Page number
    $this->Cell(190,6,'Moi University',0,1,'C');
	 $this->SetY(-18);
	 $this->SetFont('Courier','I',8);
  $this->Cell(190,6,'Page '.$this->PageNo().' of {nb}',0,1,'C');
}


/*function LoadData($patient_number)
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

//Colored table
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


function summary_table($data){
     $this->Ln();
    $this->SetFont('Arial','',9);

  
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
$this->Cell(35,5,'Gross Description',1,1,'L',true);
 $this->MultiCell(190, 5, $gross_description, $border=1, $align='J', $fill=false);
 $this->Ln(3);
   $this->Cell(35,5,'Microscopic Description',1,1,'L',true);
   $this->MultiCell(190, 5, $microscopic_description, $border=1, $align='J', $fill=false);
  
$this->Ln(3);
  $this->Cell(35,5,'Diagnosis',1,1,'L',true);
 
$this->MultiCell(190, 5, $diagnosis, $border=1, $align='J', $fill=false);
$this->Ln(3);
  $this->Cell(35,5,'Recommendations',1,1,'L',true);
  $this->MultiCell(190, 5, $recommendations, $border=1, $align='J', $fill=false);
  
  $this->Cell(190,3,'',0,1,'L');

 
 
 require_once('Connections/dp.php');
$Employee_Number        =   trim($_POST['Employee_Number'])      ;
$sql="SELECT * FROM employees   WHERE emp_id = '$Employee_Number'";
$results_qry=mysql_query($sql) or die('Could not execute the query');
while($count=mysql_fetch_array($results_qry)){
$name=$count['first_name'].' '.$count['last_name'];

}
$this->Ln(5);
  $this->SetFont('Arial','B',9);
  $this->Cell(35,8,'Name',1,0,'L',true);
  $this->Cell(95,8,$name,1,1,'L');
 

  $this->Cell(35,8,'Signature',1,0,'L',true);
  $this->Cell(95,8,'',1,1,'L');
     $key=trim('malignant tumor');
   $key=strtoupper($key);
   $diagnosis=trim(strtoupper($diagnosis));
     if($diagnosis==$key){
   $this->Ln(5);
   $this->Cell(40,6,'Name',1,0,'L',true);
  $this->Cell(80,8,$name,1,1,'L');
  $this->Cell(40,8,'Signature',1,0,'L',true);
  $this->Cell(80,8,'',1,1,'L');
   }
}
*/
}
$pdf=new PDF('P');
//Column titles
$header=array('Diagnosis Type','Diagnosis','Diagnosis Findings');
//Data loading
//Instanciation of inherited class
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
//for($i=1;$i<=40;$i++)
//$data=$pdf->LoadData($patient_number);
$pdf->SetFont('Arial','',8);
//$pdf->FancyTable($header,$data);
//$pdf->summary_table($data);
$pdf->Output();


?>