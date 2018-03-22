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
$addtionalctnr='';



if(trim($_GET['remotedtid'])){
  $remoteID=trim($_GET['remotedtid']); 
    echo getQueryRemoteParams($remoteID);
}
if($_GET['sydocprsn']){
	$query_Rcd_getmenus= "select  
admin_person.person_id , 
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) 'person_name'
 from admin_person 

where admin_person.person_id  in  (select admin_personpersontype.person_id from admin_personpersontype where admin_personpersontype.personttypecategory_id=8  )
AND admin_person.voided=0";
	$alertQueryResults=mysql_query($query_Rcd_getmenus);
	$cntAlert=mysql_num_rows($alertQueryResults);
	 while($e=mysql_fetch_assoc($alertQueryResults))
	$output[]=$e;
	$vrjsn=json_encode($output);
	if($vrjsn){
	print  $vrjsn;
	mysql_close();
	}
}

if($_GET['tgr']=='ggrp'){
$query_Rcd_getmenus= "SELECT  distinct displaygroup group_name,displaygroup group_caption 
 FROM admin_controller 
where  showgroup='Show'  order by displaygroup";
$alertQueryResults=mysql_query($query_Rcd_getmenus);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
mysql_close();
}
}
///////////////////////////////////////////////////////////////////////
if($_GET['cnactivity']==12)
$addtionalctnr=" accounts_accountscategory.accountscategory_id in(18,17)";

if($_GET['fieldsearchtbl']){
$tblname=trim($_GET['tbp']);
$bankid=trim($_GET['fieldsearchtbl']);
if($tblname=='bank_bankaccount')
$addtionalctnr=" bank_bankaccount.bank_id=$bankid ";
//echo $addtionalctnr.'kkkkkkkkkkkkkkkkkkkkkkkkk';
}
$addtionalctnr=trim($_GET['fieldsearchtbl']);

if(($_GET['tbp']!='')&&(!$_GET['vt'])){
$activetableBody=trim($_GET['tbp']);


if($_GET['find']=='thistable'){ 
$query=$_GET["query"];
$addclause='';
if($query){
$query=trim($query);
$addclause="  And fieldcaption like '%$query%'  ";
}
$query_Rcd_getbody= "SELECT fieldname, fieldcaption  FROM  admin_controller where tablename='$activetableBody'  $addclause ";
$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;

if($cntAlert==0){
echo '{"fieldname":"none","fieldcaption":"Not found"}';
}
}

else{
$searchcolmn=explode('_',$activetableBody);
$searchcolmn_name=$searchcolmn[1].'_name';
$searchcolmn_id=$searchcolmn[1].'_id';
$query=$_GET["query"];
$addclause='';
if($query){
$query=trim($query);

$addclause="  WHERE $searchcolmn_name like '%$query%'  ";
}
if($addtionalctnr){
	if($addclause){
	$addclause.=" AND ".$addtionalctnr;
	}
	else{
	$addclause.=" Where ".$addtionalctnr;
	}
}
$addfullnames='';
if($activetableBody=='admin_person'){
$addfullnames=" CONCAT(admin_person.person_name,' ',admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name ) person_name ";
$searchcolmn_name='';
$ptyrestriction='';
if($_GET['rptp']){
$rtbpid=trim($_GET['rptp']);
$ptyrestriction=" person_id in (select person_id from admin_personpersontype where personttypecategory_id='$rtbpid')";
if($addclause){
$addclause.=$addclause.' AND '.$ptyrestriction;
}else{
$addclause=' where '.$ptyrestriction;

}
}
}

$query_Rcd_getbody= "SELECT $searchcolmn_id, $searchcolmn_name  $addfullnames FROM $activetableBody  $addclause";

if($activetableBody=='bank_bankaccount'){
$query_Rcd_getbody=$_SESSION[$activetableBody."_SearchSQL"]; //;" where bank_bankaccount.bank_id=$bankid ";

if($_GET['lfpid']){
$query_Rcd_getbody=$query_Rcd_getbody. " where bank_bankaccount.syownerid ='".$_GET['lfpid']."' and bank_bankaccount.syowner='Admin_person' ";

}
}

//filter company accounts only

if($activetableBody=='gtcompanybank'){
$query_Rcd_getbody=$_SESSION["bank_bankaccount_SearchSQL"]; //;" where bank_bankaccount.bank_id=$bankid ";
$companyIDcf=1;
if($_GET['cfcid']){
$query_Rcd_getbody=$query_Rcd_getbody. " where bank_bankaccount.syownerid ='".$companyIDcf."' and bank_bankaccount.syowner='Admin_company' ";

}
}
//
if($activetableBody=='accounts_accaccount')
$query_Rcd_getbody=$_SESSION[$activetableBody."_SearchSQL"].$addclause;
//echo $query_Rcd_getbody;

if($_GET['cvif']){
$addclausecut=" sview_id in(select sview_id from designer_fasttbldesign where primary_tablelist='admin_generaview' )";
if($addclause){
$addclause=$addclause." AND ".$addclausecut;
}else{
$addclause=" WHERE ".$addclausecut;
}
$query_Rcd_getbody=$_SESSION['designer_sview'."_SearchSQL"].$addclause;
}
$alertQueryResults=mysql_query($query_Rcd_getbody) or die($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
if($cntAlert==0){
if($tblname=='bank_bankaccount'){
//echo '[{"bankaccount_id":"10000000","bankaccount_name":"No Accounts"}]';

}else{
echo '[{"'.$searchcolmn_id.'":"none","'.$searchcolmn_name.'":"Not found"}]';

}
}
}
$vrjsn=json_encode($output);
if($vrjsn){
$foundinfolen=sizeof($output);
if($foundinfolen>0)
print  $vrjsn;
mysql_close();
}



}

if($_GET['myfields']=='admin_controller'){
$activetableBody=$_GET['vt'];
$query_Rcd_getbody= "SELECT fieldname as 'sectionValue', fieldcaption as 'sectionCaption'  FROM admin_controller where tablename='$activetableBody'";
$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
mysql_close();
}

}
//list tables anf fields
if(($_GET['tbp']!='')&&($_GET['vt'])){
$activetableBody=trim($_GET['vt']); 
$tbp=$_GET['tbp'];

if($tbp=='admin_table'){
$query_Rcd_getbody= "SELECT table_name, table_caption  FROM admin_table order by table_name";
$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
mysql_close();
}

}


if($tbp=='admin_controller'){
$query_Rcd_getbody= "SELECT fieldname, fieldcaption  FROM admin_controller where tablename='$activetableBody'";
$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
mysql_close();
}

}



}
if($_GET['sptid']){
$lid=trim($_GET['sptid']);
$owner=trim($_GET['yor']);
$query_Rcd_getbody= "SELECT property,housinglandlord_id FROM housing_housinglandlord where person_id='$lid'";

$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
$property='';
$housinglandlord_id='';
 while($table_autofillrows=mysql_fetch_array($alertQueryResults)){
					 $property.=$table_autofillrows['property'];
					 $housinglandlord_id=$table_autofillrows['housinglandlord_id'];
					 }

$llarr=fillPrimaryData('admin_person',$lid);
				$lfullname=$llarr['last_name'].' '.$llarr['middle_name'].' '.$llarr['first_name'];
echo $property.'||'.$lfullname.'||'.$housinglandlord_id;
mysql_close();
}

if($_GET['showusers']){
$query_Rcd_getbody= "
select 'ALL' person_id  ,'All Users'  person_fullname 
union
select  admin_person.person_id, CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ', admin_person. last_name ) person_fullname  from admin_adminuser  inner join admin_person on admin_person.person_id = admin_adminuser.person_id

Where admin_adminuser.status='Active'
";
$alertQueryResults=mysql_query($query_Rcd_getbody);
$cntAlert=mysql_num_rows($alertQueryResults);
 while($e=mysql_fetch_assoc($alertQueryResults))
$output[]=$e;
$vrjsn=json_encode($output);
if($vrjsn){
print  $vrjsn;
mysql_close();
}

}
?>