<?php
function load_data()
{
require('config.php');
$sql_emp_no="SELECT distinct emp_no FROM employees";
$results_qry_emp_no=mysql_query($sql_emp_no) or die('Could not execute the query');
$emp_nos=array();

echo'<table>';

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
$paye=($taxpaid-$relief);


	
	echo"<tr>";
	echo"<td>$emp</td>";
	echo"<td>$name</td>";
	echo"<td>$dept</td>";
	echo"<td>$desig</td>";
	echo"<td>$acc</td>";
	
	echo"<td>$basic</td>";
	echo"<td>$benefits</td>";
	echo"<td>$quartervalue</td>";
	echo"<td>$gross</td>";
	echo"<td>$e1</td>";
	echo"<td>$e2</td>";
	echo"<td>$e3</td>";
	echo"<td>$saving_plan</td>";
	echo"<td>$ret_cont_sav_plan</td>";
	echo"<td>$chargeable_pay</td>";
	echo"<td>$taxpaid</td>";
	echo"<td>$relief</td>";
	echo"<td>$paye</td>";
	echo"</tr>";
		
	}
	echo"</table>";
}
load_data();
?>