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
$effectOnTable=trim($_GET['effectOnTable']);
$displaygroup=trim($_GET['displaygroup']);
echo("<p class=\"date\">".$_SESSION[$table_name.$table_field]."</p>");               
echo("<div id =\"INFoptions\"></div>");              

print"<input  name=\"fielddisplay\" type=\"radio\" value=\"Set auto fill\" onclick=\"defineSpecificDisplayFeature('".$displaygroup."','".$table_name."','".$effectOnTable."','".$table_field."','autofill')\" />Set auto fill<br>";

print"<input name=\"fielddisplay\"  type=\"radio\" value=\"Drop Down List\"  onclick=\"defineSpecificDisplayFeature('".$displaygroup."','".$table_name."','".$effectOnTable."','".$table_field."','list')\"/>Drop Down List<br>";

print"<input name=\"fielddisplay\"  type=\"radio\" value=\"options\" onclick=\"defineSpecificDisplayFeature('".$displaygroup."','".$table_name."','".$effectOnTable."','".$table_field."','options')\" />Options<br>";

print"<input name=\"fielddisplay\"  type=\"radio\" value=\"Set to default\" onclick=\"defineSpecificDisplayFeature('".$displaygroup."','".$table_name."','".$effectOnTable."','".$table_field."','default')\" />Set to default<br>";

print"<input name=\"fielddisplay\"  type=\"radio\" value=\"Create custom\" onclick=\"defineSpecificDisplayFeature('".$displaygroup."','".$table_name."','".$effectOnTable."','".$table_field."','customdata')\" />Custom Data<br>";

print"<input name=\"fielddisplay\"  type=\"radio\" value=\"Show Tables List\" onclick=\"defineSpecificDisplayFeature('".$displaygroup."','".$table_name."','".$effectOnTable."','".$table_field."','displaytablelist')\" />Show Sections<br>";
   
?>