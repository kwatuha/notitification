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
//echo $_GET['m'];
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
$pk=explode('_',$tablename);
$whereclause='';
if($_GET['acn']){
   $whereclause=" WHERE $pk[1]_id=".$_GET['id']." ";
   }



///
/*$searchNotifications=$_SESSION[$tablename."_SearchSQL"].$whereclause;

$alertQueryResults=mysql_query( $searchNotifications);
$cntAlert=mysql_num_rows($alertQueryResults);
    $alertArr='';
	$ctn=0;
	$alertrevised='';
          //while($alert=mysql_fetch_array($alertQueryResults))
		  
		  while($e=mysql_fetch_assoc($alertQueryResults))

                  $output[]=$e;

              $vrjsn=json_encode($output);
         //$var='"total":'.$cntAlert.',"offset": 0,'.  '"muresults:'.$vrjsn;
		 
		 print  $vrjsn;
        mysql_close();
		
		
		
		  { temperature: 63, dated: '2011' },
        { temperature: 73, dated: '2012' },
        { temperature: 78, dated: '2014' },
        { temperature: 81, dated: '2016' }";
		
		*/
		
		//////////////////////////////////
		//[{"callcentre":"cc1@example.com","calls":0},{"callcentre":"cc2@example.com","calls":4},]
		echo '{dyaxis:
		[{ydata: "13||Kitale||Consumption"},
        { ydata: "98||Bungoma||Consumption"},
		{ ydata: "40||Webuye||Consumption"},
        { ydata: "40||Kakamega||Consumption"}]
		}';
		
	
		
		
		
		
		
		
?>