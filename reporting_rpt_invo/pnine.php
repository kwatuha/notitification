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
  // For security, start by assumiaccng the visitor is NOT authorized. 
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
require('fpdf.php');
require_once('../Connections/cf4_HH.php'); 
include('../template/functions/menuLinks.php');
$employeeid=$_GET['t'];

class pdf extends FPDF
{
function Header(){
	$this->setFont('Arial','B',14);
	
$year='/2011';

$this->setY(10);

$this->cell(0,8,'Laserview Info Systems',0,1,'C');
//$this->Image('images/moi.jpg',175,30,27,23);
$this->cell(0,8,'P.O Box 817 Nairobi',0,1,'C');
$this->cell(0,8,'Tax Deduction Card for the Year 2011',0,0,'C');

$this->Ln(10);


		
	}
	
function Footer(){
	
	//Position at 2.5 cm from bottom
    $this->SetY(-50);
    //Arial italic 8
    $this->SetFont('Courier','',10);
    $this->cell(48,5,'Total Tax(COL.L) Ksh.',0,0,'L');
	$this->cell(35,5,'','B',1,'L');
	$this->Ln(5);
	$this->cell(70,5,'Total Chargeable Pay(COL.H) Ksh.',0,0,'L');
	$this->cell(35,5,'','B',1,'L');
	
	$this->setY(-20);
	//set font for the footer
	$this->setfont('Courier','',8);
	$this->cell(0,5,'Laserview Info Systems',0,1,'C');
	$this->Ln(4);
		
	}
function load_data(){

$employees_name='';
$employees_National='';
$department='';
$employeePF='';
$employeedid=14;//$_POST["employee_name"]; 
 $employeeArrayItem= getEmployeeInfo($employeedid);
  if($employeeArrayItem){
	  $employeeArrayItemsARR='';
	  foreach($employeeArrayItem as $empitem){
	  $employeeArrayItemsARR=explode('||', $empitem);
	  
	  $employees_name=$employeeArrayItemsARR[0];
	  $employees_National=$employeeArrayItemsARR[1];
	  $employeePF=$employeeArrayItemsARR[2];
	  }
  }
  
  $deptArr=getDepartment($employeedid);
  if($deptArr){
	  $deptItemsARR='';
	  foreach($deptArr as $deptitem){
	  $deptItemsARR=explode('||', $deptitem);
	  
	  $department=$deptItemsARR[0];
	  
	  }
  }
  $paygradeLevel='';
  $basicPay='';
  $paygradeArr=getPaygradeLevel($employeedid);
  if($paygradeArr){
	  $paygradeArrARR='';
	  foreach($paygradeArr as $plitem){
	  $paygradeArrARR=explode('||', $plitem);
	  
	  $paygradeLevel=$paygradeArrARR[0].'  '.$paygradeArrARR[1];
	  $basicPay=$paygradeArrARR[2];
	  
	  }
  }
  
 // $employeedid=$_POST["employee_name"]; 

$relief=1162;
$TotalTax=calculate_tax($taxablepay);
$monthdate=date('F-Y');


$xplodname=explode(" ",$employees_name);
$arrsize=sizeof($xplodname);
if($arrsize==3){
$fname=$xplodname[0];
$lname=$xplodname[1];
$mname=$xplodname[2];
}
else{
$fname=$xplodname[0];
$lname=$xplodname[1];
$mname="";
}

 $nssf=200;
 $totalbenefits='';
$benefits=getAllowance($employeedid);
if($benefits){
	  $benefitARR='';
	  foreach($benefits as $benefititem){
	  $benefitARR=explode('||', $benefititem);
	  $this->Cell(60,5,$benefitARR[1],0,0,'L');
	  $this->Cell(10,5,number_format($benefitARR[0],2),0,1,'R');
	   $totalbenefits=$totalbenefits+$benefitARR[0];
	  }
  }	

//$this->setY(20);
$this->setFont('Courier','B',10);

$this->cell(35,5,'Employee No:','BTL',0,'R');
$this->cell(35,5,$employeedid,'BT',0,'L');
$this->cell(35,5,'Last Name:','BT',0,'R');
$this->cell(35,5,$lname,'BT',0,'L');
$this->cell(35,5,'First Name:','BT',0,'R');
$this->cell(35,5,$fname,'BT',0,'L');
$this->cell(35,5,'Middle Name:','BT',0,'R');
$this->cell(36,5,$mname,'BTR',1,'L');
$my=$this->getY();
/*$this->SetFont('Courier','',10);

$this->cell(180,5,'Employer\'s Name........................',0,0,'L');
$this->cell(40,5,'Employer\'s PIN',0,0,'R');
$this->cell(40,8,'',1,1,'L');

$this->cell(180,5,'Employees Main Name........................',0,1,'L');
$this->Ln(2);

$this->cell(180,5,'Employees other Name'.$empID,0,0,'L');
$this->cell(40,5,'Employee\'s PIN',0,0,'R');
$this->cell(40,8,'',1,1,'L');
$this->Ln(2);*/
$this->SetFont('Courier','',8);
//Drawing rectangles:row one

$this->rect(10,46,16,18);
$this->rect(26,46,17,18);
$this->rect(43,46,17,18);
$this->rect(60,46,20,18);
$this->rect(80,46,18,18);
$this->rect(98,46,44,18);
$this->rect(142,46,17,18);
$this->rect(159,46,26,18);
$this->rect(185,46,23,18);
$this->rect(208,46,25,18);
$this->rect(233,46,24,18);
$this->rect(257,46,17,18);
$this->rect(274,46,17,18);

//Drawing rectangles:row two
$this->rect(10,59,16,20);
$this->rect(26,59,17,20);
$this->rect(43,59,17,20);
$this->rect(60,59,20,20);
$this->rect(80,59,18,20);
$this->rect(98,59,44,8);
$this->rect(98,67,15,12);
$this->rect(113,67,16,12);
$this->rect(129,67,13,12);
$this->rect(142,59,17,20);
$this->rect(159,59,26,20);
$this->rect(185,59,23,8);
$this->rect(185,67,23,12);
$this->rect(208,59,25,8);
$this->rect(208,67,25,12);
$this->rect(233,59,24,8);
$this->rect(233,67,46,12);
$this->rect(257,59,17,8);
$this->rect(274,59,17,8);
$this->rect(274,67,17,12);

//printing the last portion of the header
//$this->setY($my+5);
$this->cell(16,4,'MONTH',0,0,'L');
$this->cell(17,4,'Basic',0,0,'L');
$this->cell(17,4,'Benefits',0,0,'L');
$this->cell(20,4,'Value',0,0,'L');
$this->cell(18,4,'Total',0,0,'L');
$this->cell(44,4,'Defined Contribution',0,0,'L');
$this->cell(17,4,'Savings',0,0,'L');
$this->cell(26,4,'Retirement',0,0,'L');
$this->cell(23,4,'Chargeable',0,0,'L');
$this->cell(25,4,'Tax',0,0,'L');
$this->cell(24,4,'Monthly',0,0,'L');
$this->cell(17,4,'Insurance',0,0,'L');
$this->cell(17,4,'P.A.Y.E',0,1,'L');

$this->cell(16,4,'',0,0,'L');
$this->cell(17,4,'Pay',0,0,'L');
$this->cell(17,4,'Non-Cash',0,0,'L');
$this->cell(20,4,'of Quarters',0,0,'L');
$this->cell(18,4,'Gross Pay',0,0,'L');
$this->cell(44,4,'Retirement Scheme',0,0,'L');
$this->cell(17,4,'Plan',0,0,'L');
$this->cell(26,4,'Contribution &',0,0,'L');
$this->cell(23,4,'Pay',0,0,'L');
$this->cell(25,4,'Charged',0,0,'L');
$this->cell(24,4,'Relief',0,0,'L');
$this->cell(17,4,'Relief',0,0,'L');
$this->cell(17,4,'Tax',0,1,'L');

$this->cell(16,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(20,4,'',0,0,'L');
$this->cell(18,4,'A+B+C',0,0,'L');
$this->cell(44,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(26,4,'Savings plan',0,0,'L');
$this->cell(23,4,'',0,0,'L');
$this->cell(25,4,'',0,0,'L');
$this->cell(24,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,1,'L');
//$this->cell(1);

$this->cell(16,6,'',0,0,'L');
$this->cell(17,6,'Kshs.',0,0,'L');
$this->cell(17,6,'Kshs.',0,0,'L');
$this->cell(20,6,'Kshs.',0,0,'L');
$this->cell(18,6,'Kshs.',0,0,'L');
$this->cell(44,6,'Kshs.',0,0,'L');
$this->cell(17,6,'Kshs.',0,0,'L');
$this->cell(26,6,'Kshs.',0,0,'L');
$this->cell(23,6,'Kshs.',0,0,'L');
$this->cell(25,6,'Kshs.',0,0,'L');
$this->cell(24,6,'Kshs.',0,0,'L');
$this->cell(17,6,'Kshs.',0,0,'L');
$this->cell(17,6,'Kshs.',0,1,'L');


$this->cell(16,4,'',0,0,'L');
$this->cell(17,4,'A',0,0,'L');
$this->cell(17,4,'B',0,0,'L');
$this->cell(20,4,'C',0,0,'L');
$this->cell(18,4,'D',0,0,'L');
$this->cell(44,4,'E',0,0,'C');
$this->cell(17,4,'F',0,0,'L');
$this->cell(26,4,'G',0,0,'L');
$this->cell(23,4,'H',0,0,'L');
$this->cell(25,4,'J',0,0,'L');
$this->cell(24,4,'K',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'L',0,1,'L');

$this->cell(16,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(20,4,'',0,0,'L');
$this->cell(18,4,'',0,0,'L');
$this->cell(44,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(26,4,'',0,0,'L');
$this->cell(23,4,'',0,0,'L');
$this->cell(25,4,'',0,0,'L');
$this->cell(24,4,'1162',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,1,'L');


$this->cell(16,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(20,4,'',0,0,'L');
$this->cell(18,4,'',0,0,'L');
$this->cell(15,4,'E1',0,0,'L');
$this->cell(16,4,'E2',0,0,'L');
$this->cell(13,4,'E3',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(26,4,'',0,0,'L');
$this->cell(23,4,'',0,0,'L');
$this->cell(25,4,'',0,0,'L');
$this->cell(24,4,'Total',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,1,'L');

$this->cell(16,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(20,4,'',0,0,'L');
$this->cell(18,4,'',0,0,'L');
$this->cell(15,4,'30%',0,0,'L');
$this->cell(16,4,'Actual',0,0,'L');
$this->cell(13,4,'Legal',0,0,'L');
$this->cell(17,4,'Amount',0,0,'L');
$this->cell(26,4,'The lowest of',0,0,'L');
$this->cell(23,4,'',0,0,'L');
$this->cell(25,4,'',0,0,'L');
$this->cell(24,4,'Kshs. 1162',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,1,'L');

$this->cell(16,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(20,4,'',0,0,'L');
$this->cell(18,4,'',0,0,'L');
$this->cell(15,4,'of A',0,0,'L');
$this->cell(16,4,'Cont',0,0,'L');
$this->cell(13,4,'Limit',0,0,'L');
$this->cell(17,4,'Deposited',0,0,'L');
$this->cell(26,4,'E added to F',0,0,'L');
$this->cell(23,4,'',0,0,'L');
$this->cell(25,4,'',0,0,'L');
$this->cell(24,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,1,'L');


$fill=true;
for($i=0;$i<12;$i++){
$basic_sal=$basicPay;

$ben=$totalbenefits;
$quarter_value=0;
$gross=$basic_sal +$ben + $quarter_value;
$e1=(30/100 * $basic_sal);
$E2=$e2[$i];
$E3=$e3[$i];
$monthly_relief=$relief;
$savingPlan=$nssf;
$ret_cont_sav_plan=(min($e1,$E2,$E3) + $savingPlan);
$chargeable_pay=($gross - $ret_cont_sav_plan);
$taxpaid=PayeCal($chargeable_pay);;
$paye=($taxpaid-$monthly_relief);

$this->SetFillColor(200, 255, 220);
$this->SetTextColor(10);
$this->SetFont( 'Courier', 'B', 8 );



$this->cell(16,4,'',1,0,'L',$fill);
$this->cell(17,4,number_format($basic_sal),1,0,'R',$fill);
$this->cell(17,4,number_format($ben),1,0,'R',$fill);
$this->cell(20,4,number_format($quarter_value),1,0,'R',$fill);
$this->cell(18,4,number_format($gross),1,0,'R',$fill);
$this->cell(15,4,number_format($e1),1,0,'R',$fill);
$this->cell(16,4,number_format($E2),1,0,'R',$fill);
$this->cell(13,4,number_format($E3),1,0,'R',$fill);
$this->cell(17,4,number_format($savingPlan),1,0,'R',$fill);
$this->cell(26,4,number_format($ret_cont_sav_plan),1,0,'R',$fill);
$this->cell(23,4,number_format($chargeable_pay),1,0,'R',$fill);
$this->cell(25,4,number_format($taxpaid),1,0,'R',$fill);
$this->cell(41,4,number_format($monthly_relief),1,0,'R',$fill);

$this->cell(17,4,number_format($paye),1,1,'R',$fill);

 $fill=!$fill;

}//end for


$this->Ln(500);

	
	
	
}
}
$pdf=new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier','',8);
$pdf->load_data();
$pdf->SetFont('Arial','',8);
$pdf->Output();
?>