<?php
restrictaccessMenu_mlkns();
function restrictaccessMenu_mlkns(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

/*** Restrict Access To Page: Grant or deny access to this page*/
function isAuthorized_menu_fmks($strUsers, $strGroups, $UserName, $UserGroup) { 
/* For security, start by assuming the visitor is NOT authorized. */
  $isValid = False; 

  /*When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  Therefore, we know that a user is NOT logged in if that Session variable is blank. */ 
  if (!empty($UserName)) { 
    /* Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    Parse the strings into arrays. */
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    /* Or, you may restrict access to only certain users based on their username. */
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



?>
<?php
function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}






/*createFormUpdateScript('admin_rights');*/

/*$tablename=$_GET['t'];
$tablename='admin_person';
if($tablename){
createFormItemObject($tablename);
}
*/

$primarymargins="margin: '10 5 5 5',";
$primarywidth='.65';
$tabbedformwidth='700';
$tabbedformtitle='User registration';
$primarysectitle='Personal Details';
$photowidth='0.25';
$detailinfo='detailinfo';
$photosectitle=false;
$formview=1;

createTabbedForm(
$formview,
$primaryphoto,
$combodata,
$detailinfo,
$tabbedformtitle,
$tabbedformwidth,
$primarywidth,
$photowidth,
$primarymargins,
$primarysectitle,
$photosectitle);


    ?>