<?php
$tid=$_POST['tid'];
$tpid=$_POST['tpid'];
$tname=$_POST['tname'];
$end=$_POST['end'];
$ref=$_POST['ref'];
$start=$_POST['start'];
$contractdate=$_POST['con'];


$bf=$_POST['bf'];
$tr=$_POST['tr'];
$tp=$_POST['tp'];
$tbll=$_POST['tbl'];
$acc=$_POST['acc'];
$water_elec=$_POST['water_elec'];
$deposit=$_POST['deposit'];
$accountsCategory=$_POST['acccategory'];
$accountid=$_POST['accountid'];
$est=$_POST['est'];
$lid=$_POST['lid'];

$insdbnoteid=$_POST['insdbnoteid'];
$tid=base64_encode($tid.'|'.$tpid.'|'.$tname.'|'.$end.'|'.$ref.'|'.$start.'|'.$contractdate.'|'.$tp.'|'.$tr.'|'.$bf.'|'.$tbll.'|'.$acc.'|'.$water_elec.'|'.$deposit.'|'.$accountsCategory.'|'.$est.'|'.$lid.'|'.$insdbnoteid);


if($accountsCategory==53){
		echo "function openLandlordStmnt(){
		window.open('../reporting/landstmt.php?i=$tid');}
		openLandlordStmnt();";
}elseif($accountsCategory==57){
		echo "function openLandlordStmnt(){
		window.open('../reporting/dbnote.php?i=$tid');}
		openLandlordStmnt();";
}else{
echo "
function OpenTrpt(){
window.open('../reporting/tinvrpt.php?i=$tid');
}OpenTrpt();";
}

?>