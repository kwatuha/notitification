<?php
require('fpdf.php');
include('tax_table.php');
class pdf extends FPDF
{
	
function Header(){
	$this->setFont('Arial','B',14);
	$this->cell(0,8,'G7 Systems Kenya Ltd',0,1,'C');
	$this->cell(0,8,'P.O Box 817 Kakamega',0,1,'C');
	$this->cell(0,8,'Salary Slip for the Month of April 2011','B',1,'C');
	
	}
function Footer(){
	//signatory
	$this->setY(-40);
	$this->setFont('Times','B',12);
	$this->cell(70,7,'Authorised signatory with Stamp',0,0,'L');
	$this->cell(70,7,'','B',1,'L');

	
	$this->setY(-20);
	//set font for the footer
	$this->setfont('Courier','',8);
	$this->cell(0,5,'G7 Systems kenya limited',0,1,'C');
		
	}

function load_data()
{
require('config.php');
$sql_emp_no="SELECT distinct emp_no FROM employees";
$results_qry_emp_no=mysql_query($sql_emp_no) or die('Could not execute the query on employees table');
$emp_nos=array();


while($results=mysql_fetch_array($results_qry_emp_no)){

//$data=array();

$emp_nos[]=$results['emp_no'];
}
foreach($emp_nos as $emp){
$sql_details="SELECT emp_name,designation,account_no,department from employees where emp_no=$emp";
$qry_details=mysql_query($sql_details);
$details_results=mysql_fetch_array($qry_details);

$sql_slip="SELECT Basic_sal,Benefits,Quarters,E2,E3,saving_plan,monthly_relief FROM employees where emp_no=$emp";
$query_slip=mysql_query($sql_slip);
$slip_results=mysql_fetch_array($query_slip);

//retrieving total benefits
$sql_benefit_total="SELECT sum(amount) as totalBen from emp_benefit where emp_no=$emp group by emp_no";
$qry_ben_tot=mysql_query($sql_benefit_total);
$res_ben_total=mysql_fetch_array($qry_ben_tot);
$totalBen=$res_ben_total['totalBen'];

//retrieving other benefit details

$sql_benefits="SELECT benefit_name,amount from emp_benefit where emp_no=$emp";
$query_benefit=mysql_query($sql_benefits);

$benefitss=array();
while($benefits_results=mysql_fetch_array($query_benefit)){
	$benefitss[]=$benefits_results;
	
	}
	//$totalBen=$benefits_results['totalBen'];
	$ben_size=sizeof($benefitss);
	
//retrieving total earnings
$sql_earning_total="SELECT sum(amount) as total_e from earnings where emp_no=$emp group by emp_no";
$qry_e_tot=mysql_query($sql_earning_total);
$res_e_total=mysql_fetch_array($qry_e_tot);
$total_e=$res_e_total['total_e'];

//resultset for earnings
$sql_earnings="SELECT earning,amount from earnings where emp_no=$emp";
$query_earnings=mysql_query($sql_earnings);

$earnings=array();
while($earnings_results=mysql_fetch_array($query_earnings)){
	$earnings[]=$earnings_results;
	
	}
	//$totalEarning=$earnings_results['totalEarning'];
	$e_size=sizeof($earnings);

//retrieving total deductions
$sql_ded_total="SELECT sum(amount) as total_ded from deduction where emp_no=$emp group by emp_no";
$qry_ded_tot=mysql_query($sql_ded_total);
$res_ded_total=mysql_fetch_array($qry_ded_tot);
$total_ded=$res_ded_total['total_ded'];

	
//resultset for deductions
$sql_deductions="SELECT deduction_name,amount from deduction where emp_no=$emp";
$query_deductions=mysql_query($sql_deductions);

$deductions=array();
while($deductions_results=mysql_fetch_array($query_deductions)){
	$deductions[]=$deductions_results;
	
	}
	
	$ded_size=sizeof($deductions);

//resultset for leave details
/*
$sql_deductions="SELECT deduction_name,amount from hs_hr_leave where emp_no=$emp";
$query_deductions=mysql_query($sql_deductions);

$deductions=array();
while($deductions_results=mysql_fetch_array($query_deductions)){
	$deductions[]=$deductions_results;
	
	} */


$dept=$details_results['department'];
$desig=$details_results['designation'];
$name=$details_results['emp_name'];
$acc=$details_results['account_no'];

$basic=$slip_results['Basic_sal'];
$benefits=$slip_results['Benefits'];
$quartervalue=$slip_results['Quarters'];
$e2=$slip_results['E2'];
$e3=$slip_results['E3'];
$saving_plan=$slip_results['saving_plan'];
$relief=$slip_results['monthly_relief'];
$gross=$basic +$benefits + $quartervalue;
$e1=(30/100 * $basic);
$ret_cont_sav_plan=(min($e1,$e2,$e3) + $saving_plan);
$chargeable_pay=($gross - $ret_cont_sav_plan);
$taxpaid=(15/100 * $chargeable_pay);
//$paye=($taxpaid-$relief);

//computing total gross salary=basic + benefits
$total_gross= ($totalBen + $basic);
$taxable=$total_gross + $total_e;
//computing PAYE
$paye=calculate_tax($taxable);
//calculating net salary
$net_salary=$taxable- $paye -$total_ded;
//sum of paye and other deductions
$ded_paye=$total_ded + $paye;



$this->setFont('Courier','',8);

$this->cell(28,5,'Name:','BL',0,'R');
$this->cell(34,5,$name,'B',0,'L');
$this->cell(28,5,'Employee Number:','B',0,'R');
$this->cell(28,5,$emp,'B',0,'L');
$this->cell(28,5,'Department:','B',0,'R');
$this->cell(20,5,$dept,'B',0,'L');
$this->cell(28,5,'Designation:','B',0,'R');
$this->cell(28,5,$desig,'B',0,'L');
$this->cell(28,5,'Acc. No:','B',0,'R');
$this->cell(28,5,$acc,'BR',1,'L');


$this->cell(70,5,'Gross Salary','LRB',0,'L');
$this->cell(70,5,'Earnings','LRB',0,'L');
$this->cell(70,5,'Deductions','LRB',0,'L');
$this->cell(68,5,'Leave Details','LRB',1,'L');

$this->cell(35,5,'Basic','L',0,'L');
$this->cell(35,5,number_format($basic),'R',1,'R');
foreach($benefitss as $benefit){
	$b_name=$benefit['benefit_name'];
	$b_val=$benefit['amount'];
	$this->cell(35,5,$b_name,'L',0,'L');
	$this->cell(35,5,number_format($b_val),'R',1,'R');
	}
	
//$this->Rect(80,44,70,20);//setting for earnings column
//$this->Rect(150,44,70,20);//setting for deduction column
//$this->Rect(220,44,70,20);//setting for leave details column
//set X and Y for Earnings
$this->setXY(80,44);
foreach($earnings as $earning){
	$e_name=$earning['earning'];
	$e_val=$earning['amount'];
	$this->cell(35,5,$e_name,'L',0,'L');
	$this->cell(35,5,number_format($e_val),'R',1,'R');
	$this->setX(80);
	}



//set X and Y for Deductions
$this->setXY(150,44);
$this->cell(35,5,'P.A.Y.E','L',0,'L');
$this->cell(35,5,number_format($paye),'R',1,'R');
$this->setXY(150,49);
foreach($deductions as $deduction){
	$d_name=$deduction['deduction_name'];
	$d_val=$deduction['amount'];
	$this->cell(35,5,$d_name,'L',0,'L');
	$this->cell(35,5,number_format($d_val),'R',1,'R');
	$this->setX(150);
	
	}
//setting X and Y points for leave details
$this->setXY(220,44);
$this->cell(35,5,'Opening Balance','L',0,'L');
$this->cell(33,5,'opening bal','R',0,'R');

//restoring X and Y positions
$this->setXY(220,49);
$this->cell(35,5,'Availed','L',0,'L');
$this->cell(33,5,'Availed','R',0,'R');

//restoring X and Y positions
$this->setXY(220,54);
$this->cell(35,5,'Closing Balance','L',0,'L');
$this->cell(33,5,'Closing bal','R',0,'R');

//restoring X and Y positions
$this->setXY(220,74);
$this->cell(35,5,'Total Days worked','TBL',0,'L');
$this->cell(33,5,'Nil','TBR',0,'R');

//setting rectangle size
$height=max($ben_size,$e_size,$ded_size);
$height=($height * 5) + 40;
//drawing rectangles
$this->Rect(10,44,70,$height);//setting for earnings column
$this->Rect(80,44,70,$height);//setting for earnings column
$this->Rect(150,44,70,$height);//setting for deduction column
$this->Rect(220,44,68,$height);//setting for leave details column

$height=$height+44;

//positioning cells for total gross

$this->setXY(10,$height);
$this->cell(35,5,'Total:','L',0,'R');
$this->cell(35,5,number_format($total_gross),'R',1,'R');

//positioning cells for total earnings
$this->setXY(80,$height);
$this->cell(35,5,'Total:','L',0,'R');
$this->cell(35,5,number_format($total_e),'R',1,'R');

//positioning cells for deductions
$this->setXY(150,$height);
$this->cell(35,5,'Total:','L',0,'R');
$this->cell(35,5,number_format($ded_paye),'R',1,'R');

$this->setXY(220,$height);
$this->cell(68,5,'Authorised signatory with stamp','R',1,'R');

//inserting cellsfor remarks and net salary
$this->cell(210,8,'Remarks',1,0,'L');
$this->cell(35,8,'Net Salary:','TB',0,'R');
$this->cell(33,8,number_format($net_salary),'TRB',1,'R');


//abnormal spacing to provide page break
$this->Ln(400);
	}//ends foreach
	
}//ends load_data funtion
}//ends pdf class

$pdf=new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier','',8);
$pdf->load_data();
$pdf->SetFont('Arial','',8);
$pdf->Output();
?>