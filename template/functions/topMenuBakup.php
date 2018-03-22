<?php
restrictaccess();
function restrictaccess(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
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
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
?>
<?php 
if($_SESSION['isESS']){
echo $_SESSION['isESSMenu'];
$r=strpos('leave_request',$_SESSION['isESSMenu']);

}
else{
?>
<ul><li><a href="#tabs-1" 
onclick="loadActiveMenuDetails('admin');loadDefaultTableAddDetails('admin_autofill','admin')" >admin</a></li>
<li><a href="#tabs-2" onclick="loadActiveMenuDetails('attendance');
loadDefaultTableAddDetails('attendance_attendance','attendance')" >attendance</a></li>
<li><a href="#tabs-3"  
onclick="loadActiveMenuDetails('comp');loadDefaultTableAddDetails('comp_assign','comp')">comp</a></li>
<li><a href="#tabs-4"  onclick="loadActiveMenuDetails('leave');loadDefaultTableAddDetails('leave_leave','leave')" >leave</a></li><li><a href="#tabs-5"  onclick="loadActiveMenuDetails('pim');loadTableInfo('pim_employee','NOID','Save')" >pim</a></li>

<?php
echo "<li><a href=\"#tabs-6\" onClick=\"loadTableInfo('pim_employee','NOID','Save')\" >Reports</a></li>
<li><a href=\"#tabs-7\" >Analysis</a></li>
<li><a href=\"#tabs-8\" >Help</a></li>
</ul>";

}?>
