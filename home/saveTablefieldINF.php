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
?>
<?php require_once('../Connections/cf4_HH.php');
?>
<?php  
$tablename='';
$tablefield='';
$prefix='';
$sufix='';
$displaytype='';
$digitnumber='';

$tablename =trim($_GET['t']); 
$tablefield =trim($_GET['tablefield']);
$fieldoptions =trim($_GET['fieldoptions']); 
$prefix =trim($_GET['prefix']);
$actionitem =trim($_GET['actionitem']); 
$sufix =trim($_GET['suffix']);
$digitnumber=trim($_GET['digitnumber']);
$effectOnTable=trim($_GET['effectOnTable']);
$controlref='';
$controlref=$actionitem.'|'.$tablename;
$tablefieldArr=explode('_',$tablefield);
$tablefield_ID=$tablefieldArr[0].'_id';
$countAFResultsEffectiveTable=0;
$trackNeedToInsert='';
$countAFResults='';
$displaytype='';
$msgBox='';
$queryFindEFectRecord= "
SELECT tablename from admin_controller  where  
tablename='$effectOnTable' AND fieldname='$tablefield_ID' ";
    $queryFindEFectRecordRecordresults = mysql_query($queryFindEFectRecord) or die(mysql_error());
    $countAFResultsEffectiveTable=mysql_num_rows($queryFindEFectRecordRecordresults);
	
	
//Handle auto fill
if(($actionitem=='autofill')&&(($countAFResultsEffectiveTable>0)&&($tablefieldArr[1]!='name'))){
$msgBox= 'Auto fill not supported on referenced column';
echo $msgBox;
}
else{
if($actionitem=='autofill'){
$queryFindAutoRecord= "SELECT tablefield,displaytype FROM admin_autofill where  tablename='$tablename' AND tablefield='$tablefield' ";
$RcdqueryFindAutoRecordresults = mysql_query($queryFindAutoRecord) or die(mysql_error());
$countAFResults=mysql_num_rows($RcdqueryFindAutoRecordresults);


if($countAFResults){
	while($count_tbrows=mysql_fetch_array($RcdqueryFindAutoRecordresults)){
	$displaytype=trim($count_tbrows['displaytype']);
	
	}
	if($displaytype==''){
	$displaytype='autofill';
	$trackNeedToInsert='';
	$typeadded='New auto fill control added'; 
	}
				
if($displaytype=='autofill'){

$trackNeedToInsert='Update';
$typeadded= 'Auto fill control Updated';

}else{

if($displaytype){
$queryDeleteAutoRecord= "Delete from admin_autofill 
where  tablename='$tablename' AND tablefield='$tablefield'";
$RcdqueryDeleteAutoRecordresults = mysql_query($queryDeleteAutoRecord) or die(mysql_error());
$displaytype='autofill';
$trackNeedToInsert='';
$typeadded='New auto fill control added';
}}

}

}
if(($trackNeedToInsert=='')&&($actionitem=='autofill')){
 $displaytype=$actionitem;
  $queryInsertAutoRecord= "Insert into admin_autofill 
									Values('$autofill_id'
									,'$tablename'
									,'$tablefield'
									,'$prefix'
									,'$sufix'
									,'$displaytype'
									,'$digitnumber')";
$RcdqueryInstertAutoRecordresults = mysql_query($queryInsertAutoRecord) or die(mysql_error());
echo "Auto fill control added";
$msgBox='Instert Autofill';

$displaytypeRV=$displaytype.'|'.$tablename;
$queryUpdateAdminCtrlRecord= "Update admin_controller 
SET dispaytype='$displaytypeRV'  where  
tablename='$effectOnTable' AND fieldname='$tablefield'";
$RcdqueryAdminCtrlRecordresults = mysql_query($queryUpdateAdminCtrlRecord) or die(mysql_error());
}
if(($trackNeedToInsert=='Update')&&($actionitem=='autofill')){
$queryUpdateAutoRecord= "Update admin_autofill 
SET prefix='$prefix',sufix='$sufix',digit_number='$digitnumber',displaytype='$displaytype' where  
tablename='$tablename' AND tablefield='$tablefield'";
$RcdqueryUpdateAutoRecordresults = mysql_query($queryUpdateAutoRecord) or die(mysql_error());
echo $typeadded;
$msgBox='Update Autofill';
	 
}
}

////////////////////////	  
if( ($countAFResultsEffectiveTable>0)&&($tablefieldArr[1]=='name'))
	{
  //Handle auto Drop Downs

 if($actionitem=='list'){
    $queryFindAutoRecord= "SELECT tablefield,displaytype FROM admin_autofill where  tablename='$tablename' AND tablefield='$tablefield' ";
	$RcdqueryFindAutoRecordresults = mysql_query($queryFindAutoRecord) or die(mysql_error());
    $countAFResults=mysql_num_rows($RcdqueryFindAutoRecordresults);
	if($countAFResults){
	while($count_tbrows=mysql_fetch_array($RcdqueryFindAutoRecordresults)){
	$displaytype=$count_tbrows['displaytype'];
	}
		if($displaytype==''){
	     $displaytype='list';
		 $trackNeedToInsert='';
	     $typeadded='New List control added'; }
	if($displaytype=='list'){
	 //do nothing
	 }else{
		if($displaytype){
		
		$queryDeleteAutoRecord= "Delete from admin_autofill 
		  where  tablename='$tablename' AND tablefield='$tablefield'";
		 $RcdqueryDeleteAutoRecordresults = mysql_query($queryDeleteAutoRecord) or die(mysql_error());
		 $displaytype='list';
		 $trackNeedToInsert='';
	     $typeadded='New List control added';
		 }}}}
  

  //Handle auto Options
 if($actionitem=='options'){
    $queryFindAutoRecord= "SELECT tablefield,displaytype FROM admin_autofill where  tablename='$tablename' AND tablefield='$tablefield' ";
	$RcdqueryFindAutoRecordresults = mysql_query($queryFindAutoRecord) or die(mysql_error());
    $countAFResults=mysql_num_rows($RcdqueryFindAutoRecordresults);
	if($countAFResults){
	while($count_tbrows=mysql_fetch_array($RcdqueryFindAutoRecordresults)){
	$displaytype=$count_tbrows['displaytype'];
	}
	if($displaytype==''){
	     $displaytype='options';
		 $trackNeedToInsert='';
	     $typeadded='New Options List control added'; }
	if($displaytype=='options'){
	 //do nothing
	 } else{
		if($displaytype){
		$queryDeleteAutoRecord= "Delete from admin_autofill 
		  where  tablename='$tablename' AND tablefield='$tablefield'";
		 $RcdqueryDeleteAutoRecordresults = mysql_query($queryDeleteAutoRecord) or die(mysql_error());
		 $displaytype='options';
		 $trackNeedToInsert='';
	     $typeadded='New Options List control added';
		 }}} }
 
 
 //Insert Display
if(($trackNeedToInsert=='')&&($tablefieldArr[1]=='name')){
$displaytype=$actionitem;
$queryInsertAutoRecord= "Insert into admin_autofill 
Values('$autofill_id','$tablename','$tablefield','$prefix','$sufix','$displaytype','$digitnumber')";
$RcdqueryInstertAutoRecordresults = mysql_query($queryInsertAutoRecord) or die(mysql_error());
echo $typeadded;
$msgBox='sa';
}
//Update auto fill table
 if($trackNeedToInsert=='Update'){
$queryUpdateAutoRecord= "Update admin_autofill 
SET prefix='$prefix',sufix='$sufix',digit_number='$digitnumber',displaytype='$displaytype' where  
tablename='$tablename' AND tablefield='$tablefield'";
$RcdqueryUpdateAutoRecordresults = mysql_query($queryUpdateAutoRecord) or die(mysql_error());
echo $typeadded;	 
}
 //Update the admin_controller
if($displaytype!='autofill'){ 
$queryUpdateAdminCtrlRecord= "Update admin_controller 
SET dispaytype='$controlref'  where  
tablename='$effectOnTable' AND fieldname='$tablefield_ID'";
$RcdqueryAdminCtrlRecordresults = mysql_query($queryUpdateAdminCtrlRecord) or die(mysql_error());
}	 
}//end of checking effective table change
else{
if($msgBox==''){
echo 'Action not supported';}
}
$tablefieldArr='';
$tablefield_ID='';  
?>