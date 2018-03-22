<?php
function load_data(){
require('tax_table.php');
require('config.php');

$sql_id="SELECT distinct employee_id from hs_hr_employee";
$qry_id=mysql_query($sql_id);
$id_array=array();

echo"<table width=100% border=1>";


while($results_id=mysql_fetch_array($qry_id)){
$id_array[]=$results_id['employee_id'];
}
foreach($id_array as $empID){
	$sql_name="SELECT  emp_lastname,emp_firstname from hs_hr_employee where employee_id=$empID";
	$qry_name=mysql_query($sql_name);
	$results_name=mysql_fetch_array($qry_name);
	$fname=$results_name['emp_firstname'];
	$lname=$results_name['emp_lastname'];

	
	echo"<tr>";
	echo"<td>$empID</td>";
	echo"<td>$fname</td>";
	echo"<td>$lname</td>";

	echo"</tr>";
	}
	echo"</table>";
	
}
load_data();
?>