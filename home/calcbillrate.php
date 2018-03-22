<?php 
//function val($pvalue,$scale){
function val($pvalue){
include('db_connections/aardb_conn.php');
//require('../db_connections/aardb_conn.php');
//$scale='valplantmachinery';
/*
if($scale==1){
$scale='valurbanrate';

}
else if($scale==2){
$scale='valagricrate';

}
else if($scale==3){
$scale='valcompacq';

}
else if($scale==4){
$scale='valrental';

}
else if($scale==5){
$scale='valplantmachinery';

}
else if($scale==6){
$scale='valfurniture';

}
else if($scale==7){
$scale='valfittings';

}
 */
$qry="SELECT minstep,maxstep,rate FROM tariff_table order by autoid asc";
$results=mysql_query($qry) or die('Could not execute the query');
$llimit=array();
$ulimit=array();
$rate=array();

while($rws=mysql_fetch_array($results)){

$llimit[]=$rws['minstep'];
$ulimit[]=$rws['maxstep'];
$rate[]=$rws['rate'];
}
$rowsize=sizeof($llimit);
//echo $rowsize;
$totalvalcost=0;
$pvalue=$pvalue;
for($i=0;$i<$rowsize;$i++){
$lower=$llimit[$i];
$upper=$ulimit[$i];
$r=$rate[$i];
#####
if($i==($rowsize-1)){
$levelcharge=($r*$pvalue);
	
		$totalvalcost=$totalvalcost + $levelcharge;
		
}
else{
		if($pvalue>=$lower and $pvalue<=$upper){
		$levelcharge=($r*$pvalue);
		$totalvalcost=$totalvalcost + $levelcharge;
		break;
		
		}
		else if($pvalue>=$lower and $pvalue>$upper){
		$levelcharge=($r*$upper);
		$totalvalcost=$totalvalcost + $levelcharge;
		$pvalue=$pvalue-$upper;
		}
		else {
		echo"Please check your values";
		
		}
}

#####

}
return $totalvalcost;
}
/*
$charge=val(70);
$charge=number_format($charge,2);
echo $charge;
*/
?>