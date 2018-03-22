<?php
restrictaccessMenu();
function restrictaccessMenu(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized_menu($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menu("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
}
require_once('../Connections/cf4_HH.php');
include('../template/functions/menuLinks.php');
if($_GET['t']!=''){

$foundrecordid=trim($_GET['q']);
$activetableBody=trim($_GET['t']);
$query_Rcd_getbody= "SELECT distinct tablename,fieldname FROM admin_controller where tablename='$activetableBody'";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
}
$countrows=0;
$postvariables='';
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
$insertStr='';
$postvariables='';
$primaryid='';
$updateStrArr='';
$updateVariables='';
$postcolns='';
$updateVariables='';
$cnt=0;
$y=0;
$updateString='';
while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
if($countrows==0){
 //$postvariables[0]="0,";
 //$postcolns=$count_tbrows[1].',';
 
		if($recordid!='NOID'){
		 $primaryid=$count_tbrows[fieldname];
		}
		
		
}else{
$x=$countrows+1;

if($x==$count_tbrowsfound){$comma='';}
else{$comma=',';}
$colval=trim($count_tbrows[fieldname]);

$fieldNameRetrieved=trim($count_tbrows['fieldname']);
$expectedTableArr=explode('_',$activetableBody);


$updateStrArr[$y]=$fieldNameRetrieved;

$y++;
$currentDateTodat=date('Y-m-d');
if(($count_tbrows[1]=='effective_dt')&&($_GET[$count_tbrows[1]]=='')){
$postvariables[$countrows]="'".$currentDateTodat."'".$comma;
}else
{
$postvariables[$countrows]="'".$_GET[$count_tbrows[1]]."'".$comma;
}

$postcolns.=$count_tbrows[1].$comma;
$updateVariables[$countrows]=$count_tbrows['fieldname'];

$tablename=$count_tbrows[0];
}
$countrows++;
}
$cnt=0;

foreach($postvariables as $val){
$insertStr.=$val;


//if($cnt>0){

$cnt++;

}

$actionitem=trim($_GET['act']);

if($actionitem=='Update'){
$itupda=1;
$updateVal;
foreach($updateVariables as $updateVal){
//if($itupda>0){
if($itupda==sizeof($updateVariables)){
$addcomma='';
}else{$addcomma=',';}
$updateString.=$updateVariables[$itupda].'='."'".$_GET[$updateVal]."'".$addcomma;
//}

$itupda++;
}
$tblid=explode('_',$activetableBody);
$tblidvar=$tblid[1].'_id';
$currentRecordIdentifier=$_SESSION['current'.$tablename.$tblidvar];
$tblidvalue=trim($_GET['attendance_id']);
$updateSql="Update $tablename SET ".$updateString." Where $tblidvar= $currentRecordIdentifier";
$un++;

$Resultsupdate = mysql_query($updateSql) or die(mysql_error());
if($Resultsupdate){
echo 'Saved Successfully';
echo"<script> alert('here '); resetform();</script>";
}else{
echo 'Record could not be saved';
}
}
if($actionitem=='Save'){
//echo $postcolns;
$insertSQL = "INSERT INTO $tablename($postcolns) VALUES ($insertStr)";

$primaryFieldARR='';
$isprimary='';

$primaryFieldARR=explode('_',$tablename);

$isprimary=strpos($postcolns,'_name');
if($primaryFieldARR[1]){
$fld=$primaryFieldARR[1].'_name';
	if($isprimary){
	$dups=getDuplicates($tablename,$primaryFieldARR[1].'_name','Record Exists','IND');
	////Validate
	
	
	//end of validation
	}
		$validated=validateTableInfo($postcolns,$insertStr,$tablename);
		if(($dups==0)($validated=='Done')){
		$Result1 = mysql_query($insertSQL) or die(mysql_error());
		$lastsaved=mysql_insert_id();
		//echo $lastsaved.'Was saved';
				if($lastsaved){
				insertNotification($tablename,$lastsaved);
				
				//echo 'Saved Successfully';
				echo '{success:true, savestatus:'.json_encode("Saved Successfully").'}';
				$postcolns='';
				}else{
				echo 'Record could not be saved';
				}
		}else{
		 echo ucwords($_GET[$fld]).' Exists';
	}
}      
}
?>