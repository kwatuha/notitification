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

$action =trim($_GET['action']);
$groupcontrol =trim($_GET['groupcontrol']);
$subgroupcontroller =trim($_GET['subgroupcontroller']);
$tablename =trim($_GET['tablename']); 
$fieldname =trim($_GET['fieldname']); 
$infwidth =trim($_GET['fwidth']);
$infhieght =trim($_GET['flength']);
$dataformat =trim($_GET['dataformat']);
$yposition=trim($_GET['yposition']);
$xposition=trim($_GET['xposition']);
if($action=='saveControllPosition'){
//update controller
$updateController="update admin_controller set yposition='$yposition',xposition='$xposition',infwidth='$infwidth',infhieght='$infhieght' where tablename='$tablename' and fieldname='$fieldname'";
if(($fieldname)&&($tablename)){
$Rcd_tbody_resultsUpdate = mysql_query($updateController) or die(mysql_error());
}

$query_Rcd_getbody= "SELECT distinct tablename,fieldname,infsubgroup,dataformat,yposition,xposition FROM admin_controller where infgroup='$groupcontrol' ";
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	 
	//print"<table  width=\"40%\">";
	 $displaygroup='';
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
    $tablename=$count_tbrows['tablename'];
	$fieldname=$count_tbrows['fieldname'];
	$infsubgroup=$count_tbrows['infsubgroup'];
	$dataformat=$count_tbrows['dataformat'];
	$yposition=$count_tbrows['yposition'];
	$xposition=$count_tbrows['xposition'];
	$infhieght=$count_tbrows['infhieght'];
	$infwidth=$count_tbrows['infwidth'];
	if($yposition>0){
$style="position:absolute; top: ".$yposition.'px; left: '.$xposition.'px;';
        $posDiv='<div id="div'.$tablename.$fieldname.'" style="'.$style.'">';
$posDivEnd='</div>';
}else{
$style='';
$posDiv='';
$posDivEnd='';
}
    print $posDiv;
	if($dataformat=='text'){
	}
else{
print"<input  name=\"$tablename$fieldname\" type=\"text\"  size=\"$infwidth\" value=\"$fieldname\"/>";
	}
print $posDivEnd;
}
}
if($action='showinterface'){
$groupcontrol='customer';
$query_Rcd_getbody= "SELECT distinct tablename,fieldname,infsubgroup,dataformat,yposition,xposition FROM admin_controller where infgroup='$groupcontrol' ";
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	 
	//print"<table  width=\"40%\">";
	 $displaygroup='';
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
    $tablename=$count_tbrows['tablename'];
	$fieldname=$count_tbrows['fieldname'];
	$infsubgroup=$count_tbrows['infsubgroup'];
	$dataformat=$count_tbrows['dataformat'];
	$yposition=$count_tbrows['yposition'];
	$xposition=$count_tbrows['xposition'];
	$infhieght=$count_tbrows['infhieght'];
	$infwidth=$count_tbrows['infwidth'];

if($yposition>0){
		$style="position:absolute; top: ".$yposition.'px; left: '.$xposition.'px;';
        $posDiv='<div id="div'.$tablename.$fieldname.'" style="'.$style.'">';
		$posDivEnd='</div>';
		}else{
		$style='';
		$posDiv='';
		$posDivEnd='';
}
    print $posDiv;
	if($dataformat=='text'){
	}
else{
print"<input  name=\"$tablename$fieldname\" type=\"text\"  size=\"$infwidth\" value=\"$fieldname\"/>";
	}
print $posDivEnd;
}
}
?>