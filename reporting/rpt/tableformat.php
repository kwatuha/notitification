<?php
function load_data()
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

echo"<table width=100%>";
echo"<tr>";
echo"<td>Basic Salary</td>";
echo"<td>Benefits</td>";
echo"<td>Quarters</td>";
echo"<td>Gross</td>";
echo"<td>E1</td>";
echo"<td>E2</td>";
echo"<td>E3</td>";
echo"<td>Saving Plan</td>";
echo"<td>Ret-Cont</td>";
echo"<td>Chargeable</td>";
echo"<td>Tax</td>";
echo"<td>Relief</td>";
echo"<td>Paye</td>";
echo"</tr>";
while($results=mysql_fetch_array($results_qry)){
////////////////////////

//$data=array();
$size=sizeof($results);
$basic[]=$results['Basic_sal'];
$benefits[]=$results['Benefits'];
$quartervalue[]=$results['Quarters'];
$e2[]=$results['E2'];
$e3[]=$results['E3'];
$saving_plan[]=$results['saving_plan'];
$relief[]=$results['monthly_relief'];
//-----------------------------




//-----------------------------

/*foreach($basic as $bas){
print $bas."<br>";
}*/


}//end for{}
$color=0;
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
$taxpaid=(15/100 * $chargeable_pay);
$paye=($taxpaid-$monthly_relief);

if($color_code==0){
$color="gray";

}
else{
$color="=white";
}

echo"<tr bg-color=>";
echo"<td>$basic_sal</td>";
echo"<td>$ben</td>";
echo"<td>$quarter_value</td>";
echo"<td>$gross</td>";
echo"<td>$e1</td>";
echo"<td>$E2</td>";
echo"<td>$E3</td>";
echo"<td>$savingPlan</td>";
echo"<td>$ret_cont_sav_plan</td>";
echo"<td>$chargeable_pay</td>";
echo"<td>$taxpaid</td>";
echo"<td>$monthly_relief</td>";
echo"<td>$paye</td>";
echo"</tr>";
}//end while
echo"</table>";
echo mysql_num_rows($results_qry)." rows returned";
}//end function
load_data();
?>