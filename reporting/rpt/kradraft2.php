<?php

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function Header()
{
    //Logo
$year='/2011';
//$this->Image('Sunset.jpg',93,12,27,27);
//$this->Ln(33);
$this->setY(10);
$this->SetFont('Times','B',12);
$this->cell(0,5,'KENYA REVENUE AUTHORITY',0,1,'C');
//$this->Image('images/moi.jpg',175,30,27,23);
$this->cell(0,5,'INCOME TAX DEPARTMENT',0,1,'C');
$this->cell(0,5,'TAX DEDUCTION CARD YEAR 2010'.$year,0,0,'C');

$this->Ln(4);

$this->SetFont('Courier','',10);

$this->cell(180,5,'Employer\'s Name........................',0,0,'L');
$this->cell(40,5,'Employer\'s PIN',0,0,'R');
$this->cell(40,8,'',1,1,'L');

$this->cell(180,5,'Employees Main Name........................',0,1,'L');
$this->Ln(2);

$this->cell(180,5,'Employees other Name.......................',0,0,'L');
$this->cell(40,5,'Employee\'s PIN',0,0,'R');
$this->cell(40,8,'',1,1,'L');
$this->Ln(2);
$this->SetFont('Courier','',8);
//Drawing rectangles:row one
$this->rect(10,49,16,18);
$this->rect(26,49,17,18);
$this->rect(43,49,17,18);
$this->rect(60,49,20,18);
$this->rect(80,49,18,18);
$this->rect(98,49,44,18);
$this->rect(142,49,17,18);
$this->rect(159,49,26,18);
$this->rect(185,49,23,18);
$this->rect(208,49,25,18);
$this->rect(233,49,24,18);
$this->rect(257,49,17,18);
$this->rect(274,49,17,18);

//Drawing rectangles:row two

$this->rect(10,67,16,20);
$this->rect(26,67,17,20);
$this->rect(43,67,17,20);
$this->rect(60,67,20,20);
$this->rect(80,67,18,20);
$this->rect(98,67,44,8);
$this->rect(98,75,10,12);
$this->rect(108,75,23,12);
$this->rect(131,75,11,12);
$this->rect(142,67,17,20);
$this->rect(159,67,26,20);
$this->rect(185,67,23,8);
$this->rect(185,75,23,12);
$this->rect(208,67,25,8);
$this->rect(208,75,25,12);
$this->rect(233,67,24,8);
$this->rect(233,75,41,12);
$this->rect(257,67,17,8);
$this->rect(274,67,17,8);
$this->rect(274,75,17,12);

//printing the last portion of the header
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
$this->cell(10,4,'E1',0,0,'L');
$this->cell(23,4,'E2',0,0,'L');
$this->cell(11,4,'E3',0,0,'L');
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
$this->cell(10,4,'30%',0,0,'L');
$this->cell(23,4,'Actual',0,0,'L');
$this->cell(11,4,'Legal',0,0,'L');
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
$this->cell(10,4,'of A',0,0,'L');
$this->cell(23,4,'Contribution',0,0,'L');
$this->cell(11,4,'Limit',0,0,'L');
$this->cell(17,4,'Deposited',0,0,'L');
$this->cell(26,4,'E added to F',0,0,'L');
$this->cell(23,4,'',0,0,'L');
$this->cell(25,4,'',0,0,'L');
$this->cell(24,4,'',0,0,'L');
$this->cell(17,4,'',0,0,'L');
$this->cell(17,4,'',0,1,'L');

//the first record from the database

/*$this->cell(16,4,'September',1,0,'L');
$this->cell(17,4,number_format(10000),1,0,'L');
$this->cell(17,4,'',1,0,'L');
$this->cell(20,4,'',1,0,'L');
$this->cell(18,4,'',1,0,'L');
$this->cell(10,4,'',1,0,'L');
$this->cell(23,4,'',1,0,'L');
$this->cell(11,4,'',1,0,'L');
$this->cell(17,4,'',1,0,'L');
$this->cell(26,4,'',1,0,'L');
$this->cell(23,4,'',1,0,'L');
$this->cell(25,4,'',1,0,'L');
$this->cell(41,4,'',1,0,'L');
//$this->cell(17,4,'',1,0,'L');
$this->cell(17,4,'',1,1,'L');*/
/*

$this->cell(20,6,'MONTH',1,0,'L');
$this->cell(20,6,'Basic Pay',1,0,'L');
$this->cell(40,6,'Benefits-Non-cash',1,0,'L');
$this->cell(40,6,'Value of Quarters',1,0,'L');
$this->cell(50,12,'Total Gross Pay'.$this->Ln(0.5).' A+B+C',1,0,'L');
/*$this->cell(20,6,'Defined Contribution Retirement Scheme',1,0,'L');
$this->cell(20,6,'Savings Plan',1,0,'L');
$this->cell(20,6,'Retirement Contribution & Savings Plan',1,0,'L');
$this->cell(20,6,'Chargeable Pay',1,0,'L');
$this->cell(20,6,'Tax Charged',1,0,'L');
$this->cell(20,6,'Monthly Relief',1,0,'L');
$this->cell(20,6,'Insurance Relief',1,0,'L');
$this->cell(20,6,'P.A.Y.E Tax',1,0,'L');*/

//
//$this->Image('images/word.jpg',10,45,190,23);
//Arial bold 15
/*$this->Ln(10);
$this->SetFont('Arial','',8);
$employers_name      ='Moi University';
$employees_name    ='Ojwang\'';
$employees_other_name    ='Antony Wachiaje\'';
$employees_address  ='P.O Box 29-40401 Karungu';
$Date_of_Paymment='21st February, 2011';
$Basic_sal=100000;
$Benefits=20000;
$Deductions=8000;
$Gross_sal=$Basic_sal + $Benefits;
$Net_sal=$Gross_sal - $Deductions;
*/
//$date_printed=$_POST['date_reported'];
//$date_printed==$_POST['date'];
   /* $this->Ln(5);
  $this->SetFont('Times','BU',12);
  $this->Cell(75,5, 'Employee\'s Details',0,1,'L');
  $this->SetFont('Courier','',8);
   $this->Cell(110,5,'Name of Employee: '.$employees_name,0,0,'L');
  $this->Cell(75,5,'Name of Employer: '.$employers_name,0,1,'L');
  $this->Cell(110,5,'Other Names: '.$employees_other_name,0,0,'L');
  $this->Cell(75,5,'Date of Payment: '.$Date_of_Paymment,0,1,'L');
  $this->Cell(75,5,'Address: '.$employees_address,0,1,'L');
  
  $this->Ln(5);
  $this->SetFont('Times','BU',12);
  $this->Cell(75,5, 'Income Details',0,1,'L');
  $this->SetFont('Courier','',10);
  $this->Cell(75,5,'Basic Salary: '.$Basic_sal,0,0,'L');
  $this->Cell(30,5,'Add',0,1,'L');
  $this->Cell(113,5,'Benefits: '.$Benefits,0,1,'R');
  $this->Cell(75,5,'Gross Salary: '.$Gross_sal,0,0,'L');
  $this->Cell(30,5,'Less',0,1,'L');
  $this->Cell(115,5,'Deductions: '.$Deductions,0,1,'R');
  $this->Cell(75,5,'Net Salary: '.$Net_sal,0,1,'L');
  



    $this->Ln(5);*/
}
//Page footer
function Footer()
{
    //Position at 2.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
    $this->SetFont('Courier','',10);
    $this->cell(250,5,'Total Tax(COL.L) Ksh.',0,0,'R');
	$this->cell(30,5,'______________',0,1,'L');
	$this->cell(70,5,'Total Chargeable Pay(COL.H) Ksh.',0,0,'L');
	$this->cell(70,5,'____________________',0,0,'L');
	
	$this->cell(70,5,'Name of Approved Institution',0,0,'L');
	$this->cell(70,5,'_________________________',0,1,'L');
	//Page number
  // $this->Cell(190,6,'Moi University',0,1,'C');
	 $this->SetY(-10);
	 $this->SetFont('Courier','B',8);
  $this->Cell(0,6,'Page '.$this->PageNo().' of {nb}',0,1,'C');
}

function FancyTable()
{
    
require('config.php');
$sql="SELECT Basic_sal,Benefits,Quarters,E2,E3,saving_plan FROM employees";
$results_qry=mysql_query($sql) or die('Could not execute the query');
$data=array();
$data[]=mysql_fetch_array($results_qry);
$numRows=mysql_num_rows($results_qry);

    $this->SetFillColor(200, 255, 220);
    $this->SetTextColor(10);
$row=1;
$rownum=$data[$row];
$fill=true;	
foreach ( $data as $datarow ) {
  // Create the data cells
$basic_sal=$datarow['Basic_sal'];
$benefits=$datarow['Benefits'];
$quartervalue=$datarow['Quarters'];
$gross_sal=($basic_sal + $benefits + $quartervalue);
$e1=(30/100 * $basic_sal);
$e2=$datarow['E2'];
$e3=$datarow['E3'];
$saving_plan=$datarow['saving_plan'];
$ret_cont_sav_plan=min($e1,$e2,$e3) + $saving_plan;
$chargeable_pay=($gross_sal -$ret_cont_sav_plan);
$taxpaid=(15/100 * $chargeable_pay);
$monthly_relief=800;
$paye=($taxpaid-$monthly_relief);
do{
  $this->SetFont( 'Courier', 'B', 8 );
  
  $this->cell(16,4,$rownum,1,0,'L',$fill);
$this->cell(17,4,number_format($basic_sal),1,0,'L',$fill);
$this->cell(17,4,number_format($benefits),1,0,'L',$fill);
$this->cell(20,4,number_format($quartervalue),1,0,'L',$fill);
$this->cell(18,4,number_format($gross_sal),1,0,'L',$fill);
$this->cell(10,4,number_format($e1),1,0,'L',$fill);
$this->cell(23,4,number_format($e2),1,0,'L',$fill);
$this->cell(11,4,number_format($e3),1,0,'L',$fill);
$this->cell(17,4,number_format($saving_plan),1,0,'L',$fill);
$this->cell(26,4,number_format($ret_cont_sav_plan),1,0,'L',$fill);
$this->cell(23,4,number_format($chargeable_pay),1,0,'L',$fill);
$this->cell(25,4,number_format($taxpaid),1,0,'L',$fill);
$this->cell(41,4,number_format($monthly_relief),1,0,'L',$fill);
//$this->cell(17,4,'',1,0,'L');
$this->cell(17,4,number_format($paye),1,1,'L',$fill);
 $rownum++;
 $fill=!$fill;
}while($rownum<$numRows);

}
  
  $this->Ln();
 
  
 } 
 }
$pdf=new PDF('L');
//$header=array('Diagnosis Type','Diagnosis','Diagnosis Findings');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier','',8);
$pdf->FancyTable();
$pdf->SetFont('Arial','',8);
$pdf->Output();


?>