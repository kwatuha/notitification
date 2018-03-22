<?php require_once('../Connections/cf4_HH.php'); ?>
<?PHP 
function calculate_tax($taxable_income)
{


$sql="SELECT * FROM hrpayroll_taxsetup";
$results_qry=mysql_query($sql) or die('Could not execute the query on tax_table');
$lowelimit=array();
$upperlimit=array();
$rate=array();

while($results=mysql_fetch_array($results_qry)){
//define array of data

$lowelimit[]=$results['lower_limit'];
$upperlimit[]=$results['upper_limit'];
$active[]=$results['active'];
$rate[]=$results['rate'];

}//end while
$total_tax=0;
for($i=0;$i<sizeof($lowelimit);$i++){ //beginning of for loop
$l_limit=$lowelimit[$i];
$u_limit=$upperlimit[$i];
$r=$rate[$i];
//--------------------------------
if(($taxable_income >=$l_limit) and ($taxable_income<=$u_limit))//first if condition
{
$tax=$r/100 * $taxable_income;
$total_tax +=$tax;
break;

}// end of first if condition
else if(($taxable_income >=$l_limit) and ($taxable_income > $u_limit)){//second if condition

$tax=$r/100 * $u_limit;
$taxable_income -=$u_limit;
$total_tax +=$tax;
}//end of second if statement
else //if(($taxable_income>=$l_limit) and ($i==sizeof($lowelimit)))//third if statement
{
$tax=$r/100 * $taxable_income;
$total_tax +=$tax;
break;
}//end of third if statement
/*else{
echo "Check your values";
}//end of if statement*/
}//end for loop
return $total_tax;

}//end function calculate_tax
echo calculate_tax(100000);

?>