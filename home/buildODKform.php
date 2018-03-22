<?php
restrictaccessMenu_mlkns();
function restrictaccessMenu_mlkns(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized_menu_fmks($strUsers, $strGroups, $UserName, $UserGroup) { 
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
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menu_fmks("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
$tablename=$_GET['t'];
}  
?><?php

function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}

				  
			
 ///Alert
//read data
$maxrows=' Limit 15 ';

$pk=explode('_',$tablename);
$whereclause='';
if($_GET['acn']){
   $whereclause=" WHERE $tablename.".$pk[1]."_id=".$_GET['id'];
}


 if($_GET['searhfield']){
 $searhfield=trim($_GET['searhfield']);
 $searhvalue=trim($_GET['searhvalue']);
 //echo $_GET['searhfield'].$_GET['searhvalue'];
 $additionalparams=" $searhfield like '%$searhvalue%'";
   //$whereclause=" WHERE $pk[1]_id=".$_GET['id'];
   }
   if($whereclause){
		   if($additionalparams){
		  $whereclause.='  AND '.$additionalparams ;
		   }
   }else{
		   if($additionalparams){
		   $whereclause = " WHERE $additionalparams ";
		   }
   }
///
$searchNotifications=$_SESSION["form_amrsformquestion_SearchSQL"];
$alertQueryResults=mysql_query( $searchNotifications);
$cntAlert=mysql_num_rows($alertQueryResults);

    $alertArr='';
	$ctn=0;
	$alertrevised='';
          //while($alert=mysql_fetch_array($alertQueryResults))
		  $dataStr='';
		  while($e=mysql_fetch_assoc($alertQueryResults)){
					$amrsformquestion_id=$e['amrsformquestion_id'];
					$form_id=$e['form_id'];
					$amrsgroup_id=$e['amrsgroup_id'];
					$group_id=$e['group_id'];
					$subgroup_id=$e['subgroup_id'];
					$displaytype_id=$e['displaytype_id'];
					$stype=$e['stype'];
					$scnname=$e['scnname'];
					$scncaption=$e['scncaption'];
					$amrsconceptid=$e['amrsconceptid'];
					$amrsconceptname=$e['amrsconceptname'];
					$Datatype=$e['Datatype'];
					 $dataStr.=$amrsconceptname;
					echo $subgroup_id;
      }


$mobileform='../template/mobileforms/phctform.xml';
file_put_contents($mobileform, $dataStr);

function getFormData($form_id){
$searchNotifications=$_SESSION["mobile_form_SearchSQL"].' where form_id='.$form_id;
$alertQueryResults=mysql_query( $searchNotifications);
$cntAlert=mysql_num_rows($alertQueryResults);

    $alertArr='';
	$ctn=0;
	$alertrevised='';
		  $dataStr='';
		  while($e=mysql_fetch_assoc($alertQueryResults)){
					$form_name=$e['form_name'];
					$form_title=$e['form_title'];
					$formid=$e['formid'];
					$xmlns_openmrs=$e['xmlns_openmrs'];
					$xmlns_xd=$e['xmlns_xd'];
					$form_version=$e['form_version'];
					
					
					$dataStr['form_title']=$form_title;
					$dataStr['form_name']=$form_name;
					$dataStr['formid']=$formid;
					$dataStr['xmlns_openmrs']=$xmlns_openmrs;
					$dataStr['xmlns_xd']=$xmlns_xd;
					$dataStr['form_version']=$form_version;
           }
		  return $dataStr;
}		  
?>