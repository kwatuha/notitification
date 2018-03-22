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
$table_name =trim($_GET['t']); 
$table_field =trim($_GET['tablefield']);
$action=trim($_GET['action']);
$effectOnTable=trim($_GET['effectOnTable']);
  $query_Rcd_getbody= "SELECT fieldname FROM admin_controller where  tablename='$table_name' ";
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	//saveINFoptions(activetable,tablefield,fieldoptions,prefix,suffix,digitnumber,actionitem,dispaydiv)
	echo "<p class='date'>".$_SESSION[$table_name]."</p>"; 
	
	print"<table  width=\"40%\">";
	print"<tr>";
	if($action=='list'){
	$listOptions='text';
	}else{
	$listOptions='hidden';
	}
	
	
	if($action=='autofill'){
	$prefix='text';
	$suffix='text';
	$digitnumber='text';
	print"<th width=\"20%\" align='left'>Prefix</th>";
	print"<th  width=\"15%\" align='left'>Suffix</th>";
	print"<th width=\"5%\" align='left'>Numeric Digits</th>";
	print"<th  width=\"60%\" align='left'>Input Control</th>";
	print"</tr>";
	}
	else{
	$prefix='hidden';
	$suffix='hidden';
	$digitnumber='hidden';
	}
	 $count_AFN='';
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$fieldname=$count_tbrows['fieldname'];
	
	$query_Rcd_AF= "SELECT prefix,sufix,digit_number FROM admin_autofill where  tablename='$table_name' AND tablefield='$fieldname' AND displaytype='autofill' ";
    $Rcd_AF_results = mysql_query($query_Rcd_AF) or die(mysql_error());
	$count_AFN='';
    $count_AFN=mysql_num_rows($Rcd_AF_results);
	if($count_AFN){
	while($count_AF=mysql_fetch_array($Rcd_AF_results)){
      $prefixVal=$count_AF['prefix'];
	  $suffixVal=$count_AF['sufix'];
	  $digitnumberVal=$count_AF['digit_number'];
	   
	}
	}
	$tableCfieldname=$table_name.$fieldname;
	$saveINFautoFill= "saveINFoptions('".$table_name."','".$effectOnTable."','".$fieldname."','".$action."','".'displaytfieldsactualresults'."')";
	print"<tr>";
	print"<td width=\"20%\"><input type=\"$prefix\" id=\"$tableCfieldname"."prefix\" size=\"6\" value=\"$prefixVal\"></td>";
	print"<td width=\"15%\"><input type=\"$suffix\" id=\"$tableCfieldname"."suffix\" size=\"6\" value=\"$suffixVal\"></td>";
	print"<td width=\"5%\"><input type=\"$digitnumber\" id=\"$tableCfieldname"."digitnumber\"  size=\"6\" value=\"$digitnumberVal\"></td>";
    print"<td width=\"60%\"><input name=\"$table_name\"  type=\"radio\" value=\"Options\" onclick=\"$saveINFautoFill\" />".$_SESSION[$table_name.$fieldname];
	print "<input type=\"$listOptions\" id=\"$tableCfieldname"."fieldoptions\"  size=\"6\" value=\"$digitnumberVal\">";
	echo"</td></tr>";
	$digitnumberVal='';
	$suffixVal='';
	$prefixVal='';
	}
   print"</table>";
?>