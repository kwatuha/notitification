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
include('../template/functions/menuLinks.php');
//reload designer
$tbp=$_GET['tbp'];
$tbgp=$_GET['tbgp'];
$rtr=$_GET['rtr'];
$query=$_GET["query"];
$addclause='';
if($query){
$query=trim($query);
$addclause="  WHERE table_name like '%$query%' and table_name not in(select distinct sytable_tablelist from designer_sytable where ucase(invisible)='Y')  order by table_name";
}
//Show rights
if($rtr){
$dispgrp=trim($_GET['grp']);
$rdata=createPrivilegeAssigmentform($dispgrp);
echo $rdata;
}

///////////////////////////

//show groups
if($tbgp){
if($query){
$query=trim($query);
$addclause="  WHERE displaygroup like '%$query%' and tablename not in(select distinct sytable_tablelist from designer_sytable where ucase(invisible)='Y') ";
}else{
$addclause=" where tablename not in(select distinct sytable_tablelist from designer_sytable where ucase(invisible)='Y') ";
}


$query_Rcd_getbody= " SELECT distinct displaygroup from  admin_controller $addclause order by displaygroup ";

$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
print  $vrjsn;
}

///
if(($tbp=='admin_table')&&(!$_GET['stbl'])&&(!$_GET['sfl'])){
$query_Rcd_getbody= "SELECT table_name, table_caption  FROM admin_table $addclause";



$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
}
mysql_close();

if($cntAlert==0){
echo '{"table_name":"nosubcategoryselected","table_caption":"No Subcategory"}';
}
}

if($_GET['stbl']=='getit'){ 
$activetableBody=trim($_GET['selectedtbl']);
$primaryIDArray=explode('_',$activetableBody);
$id=$primaryIDArray[1].'_id';


$query_Rcd_getbody= "SELECT table_name,table_caption FROM  admin_table where table_name 
in(select distinct tablename from admin_controller where fieldname='$id' and tablename !='$activetableBody') order by table_name";
$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);

if($cntAlert==0){
echo '{"table_name":"nosubcategoryselected","table_caption":"No Subcategory"}';
}

if($cntAlert>0){
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
}
mysql_close();
}
}

if($_GET['sfl']=='getit'){ 

$activetableBody=trim($_GET['selectedtbl']);

if($_GET['fieldsearchtbl']){
$activetableBody=$_GET['fieldsearchtbl'];
}


$query_Rcd_getbody= "SELECT fieldname, fieldcaption  FROM  admin_controller where tablename='$activetableBody'";
$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);


if($cntAlert==0){
echo '{"fieldname":"No_visible_fields","fieldcaption":"No visible fields"}';
}

 if($cntAlert>0){
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
}
mysql_close();
}
}
?>