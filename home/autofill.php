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
fillAutoFillController($activetableBody);
function fillAutoFillController($activetableBody){
$sqldefineAutofill="select * from admin_autofill where tablename='$activetableBody'";
$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die(mysql_error());
$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
 
			 if($cnt_autorows){
			 
					 while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $autofill_id=$table_autofillrows[autofill_id];
					 $tablename=$table_autofillrows[tablename];
					 $tablefield=$table_autofillrows[tablefield];
					 $prefix=$table_autofillrows[prefix];
					 $sufix=$table_autofillrows[sufix];
					 $digit_number=$table_autofillrows[digit_number];
					 }
			 
			}
$cnt_autorows='';
$query_Rcdcount= "select count(*) as rowscount from  $activetableBody ";
$Rcd_rcdn_results = mysql_query($query_Rcdcount) or die(mysql_error());
$cnt_rows=mysql_num_rows($Rcd_rcdn_results);

					if($cnt_rows>0){
						while($table_rows=mysql_fetch_array($Rcd_rcdn_results)){
						   $numofrows=$table_rows[rowscount]; 
						 $fillvalue=$prefix.$numofrows.$sufix;
						  }
	
				}
return $autofillCtrlvalue;
}



?>
