<?php
function load_data(){
require('tax_table.php');
require_once('../Connections/cf4_HH.php');


$sql_id="SELECT distinct person_id from admin_person";
$qry_id=mysql_query($sql_id);
$id_array=array();

echo"<table width=100% border=1>";


while($results_id=mysql_fetch_array($qry_id)){
$id_array[]=$results_id['person_id'];
}
foreach($id_array as $empID){
	$sql_name="SELECT  last_name,first_name from admin_person where person_id=$empID";
	$qry_name=mysql_query($sql_name);
	$results_name=mysql_fetch_array($qry_name);
	$fname=$results_name['first_name'];
	$lname=$results_name['last_name'];

	
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