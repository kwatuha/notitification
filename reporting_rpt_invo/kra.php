<?php

require('fpdf.php');
require('tax_table.php');
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
$sql="SELECT Basic_sal,Benefits,Quarters,E2,E3,saving_plan,monthly_relief FROM employees";
$results_qry=mysql_query($sql) or die('Could not execute the query');
$basic=array();
$benefits=array();
$quartervalue=array();
$e2=array();
$e3=array();
$saving_plan=array();
$relief=array();

while($results=mysql_fetch_array($results_qry)){
//define array of data
$size=sizeof($results);
$basic[]=$results['Basic_sal'];
$benefits[]=$results['Benefits'];
$quartervalue[]=$results['Quarters'];
$e2[]=$results['E2'];
$e3[]=$results['E3'];
$saving_plan[]=$results['saving_plan'];
$relief[]=$results['monthly_relief'];

}//end while
$fill=true;
for($i=0;$i<sizeof($basic);$i++){
$basic_sal=$basic[$i];

$ben=$benefits[$i];
$quarter_value=$quartervalue[$i];
$gross=$basic_sal +$ben + $quarter_value;
$e1=(30/100 * $basic_sal);
$E2=$e2[$i];
$E3=$e3[$i];
$monthly_relief=$relief[$i];
$savingPlan=$saving_plan[$i];
$ret_cont_sav_plan=(min($e1,$E2,$E3) + $savingPlan);
$chargeable_pay=($gross - $ret_cont_sav_plan);
$taxpaid=calculate_tax($chargeable_pay);
$paye=($taxpaid-$monthly_relief);

$this->SetFillColor(200, 255, 220);
$this->SetTextColor(10);
$this->SetFont( 'Courier', 'B', 8 );



$this->cell(16,4,'',1,0,'L',$fill);
$this->cell(17,4,number_format($basic_sal),1,0,'L',$fill);
$this->cell(17,4,number_format($ben),1,0,'L',$fill);
$this->cell(20,4,number_format($quarter_value),1,0,'L',$fill);
$this->cell(18,4,number_format($gross),1,0,'L',$fill);
$this->cell(10,4,number_format($e1),1,0,'L',$fill);
$this->cell(23,4,number_format($E2),1,0,'L',$fill);
$this->cell(11,4,number_format($E3),1,0,'L',$fill);
$this->cell(17,4,number_format($savingPlan),1,0,'L',$fill);
$this->cell(26,4,number_format($ret_cont_sav_plan),1,0,'L',$fill);
$this->cell(23,4,number_format($chargeable_pay),1,0,'L',$fill);
$this->cell(25,4,number_format($taxpaid),1,0,'L',$fill);
$this->cell(41,4,number_format($monthly_relief),1,0,'L',$fill);

$this->cell(17,4,number_format($paye),1,1,'L',$fill);

 $fill=!$fill;

}//end for
/*echo"</table>";
echo mysql_num_rows($results_qry)." Rows returned";*/
}//end function FancyTable


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