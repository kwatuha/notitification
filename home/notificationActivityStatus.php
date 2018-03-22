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
require_once('../template/functions/menuLinks.php');
?><script>
/*function hideList(diveid){
var activelist= document.getElementById(diveid)
activelist.style.visibility="hidden";

}

function showList(diveid){
var activelist= document.getElementById(diveid)
activelist.style.visibility="visible";

}*/
</script>
<?php  
$altert_id=trim($_GET['altert_id']);
print"<input name=\"selectoption\" onClick=\"hideList('usergroupNTP');hideList('employeeNTP');showList('processNTP')\" id=\"Gotoprocess\" type=radio value=\"Gotoprocess\" />Go to process<br>";
print"<input onClick=\"hideList('processNTP');hideList('employeeNTP');showList('usergroupNTP')\"
name=\"selectoption\" id=\"NotifyUserGroup\" type=radio value=\"NotifyUserGroup\" />Notify User Group<br>";
print"<input 
onClick=\"hideList('processNTP');hideList('usergroupNTP');showList('employeeNTP')\"
name=\"selectoption\" id=\"NotifySpeficUser\" type=radio value=\"NotifySpeficUser\" />Notify Spefic User<br>";

//buildDBFromList($currenttbl,$fildcontrol,$fillnum,$changecontrolcaption){
//if($fillnum=='nsf'){

 echo "<div id='processNTP' style='position:absolute;top:120px;visibility:hidden;'>";
 buildDBFromList('admin_alert','admin_alertactivityalert_success','nsf','Proceed to ',"$altert_id");
 echo '</div>';
 
 echo "<div id='usergroupNTP' style='position:absolute;top:120px;visibility:hidden;'>"; 
 buildDBFromList('admin_usergroup','admin_alertactivityalert_success','nsf','Inform ',''); 
 echo '</div>';
 
 echo "<div id='employeeNTP' style='position:absolute;top:120px;visibility:hidden;'>";  
 buildDBFromList('pim_employee','admin_alertactivityalert_success','nsf','Inform ',''); 
 echo '</div>';
 
  		
		
?>
