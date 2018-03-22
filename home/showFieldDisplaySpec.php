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
?>
<?php  
$table_name =trim($_GET['t']); 
$table_field =trim($_GET['tablefield']); 
$action =trim($_GET['action']); 
$table_name =trim($_GET['t']); 
$table_field =trim($_GET['tablefield']);
$action=trim($_GET['action']);
$effectOnTable=trim($_GET['effectOnTable']);
$displaygroup=trim($_GET['displaygroup']);      
echo("<table width=\"100%\""); 
echo("<tr class=\"ewTableRow\">");
 
if($action=='default'){
    $queryUpdateAutoRecord= "Update admin_controller 
	 SET dispaytype='Normalview' where  
	 tablename='$effectOnTable' AND fieldname='$table_field'";
     $RcdqueryUpdateAutoRecordresults = mysql_query($queryUpdateAutoRecord) or die(mysql_error());
}

if($action=='displaytablelist'){
    $queryUpdateAutoRecord= "Update admin_controller 
	 SET dispaytype='dbtlist' where  
	 tablename='$effectOnTable' AND fieldname='$table_field'";
     $RcdqueryUpdateAutoRecordresults = mysql_query($queryUpdateAutoRecord) or die(mysql_error());
}

if($action=='customdata'){
$customQry="select * from admin_custom where tablename='$effectOnTable'";
$customQryRecordresults = mysql_query($customQry) or die(mysql_error());
$countcustomQryResults=mysql_num_rows($customQryRecordresults);
print'<div id="saveCustOption"></div>';
print'<table>';
print"<tr><th align=\"left\">Value</th><th align=\"left\">Caption</th><th align=\"left\">Display</th><th align=\"left\">Action</th></tr>";
if($countcustomQryResults){
while($count_tbrows=mysql_fetch_array($customQryRecordresults)){
$value=$count_tbrows['stored_value'];
$display_caption=$count_tbrows['display_caption'];
$recordid=$count_tbrows['custom_id'];
$CurrDisp=$count_tbrows['displaytype'];
$editclick="saveINFCustom('".$effectOnTable."','".$table_field."','".$recordid."','updateOpt','saveCustOption')";
$deleteClick="saveINFCustom('".$effectOnTable."','".$table_field."','".$recordid."','deleteOpt','saveCustOption')";
$editLink="<a href=\"#\" onClick=\"$editclick\"/>Edit</a>";
$deleteLink="<a href=\"#\" onClick=\"$deleteClick\"/>Delete</a>";
print"<tr><td>$value</td><td>$display_caption</td><td>$CurrDisp</td><td>$editLink &nbsp;&nbsp;$deleteLink</td></tr>";
}

}  
$AddValue="<input name=\"$effectOnTable"."AddVal\" id=\"$effectOnTable"."AddVal\" type=\"text\" />";
$AddCaption="<input name=\"$effectOnTable"."AddCap\" id=\"$effectOnTable"."AddCap\" type=\"text\" />";
$AddDisp="<select class=\"listview\" name=\"$effectOnTable"."AddDisp\" id=\"$effectOnTable"."AddDisp\">
	<option value=\"options\">Radio</option>
	<option value=\"list\">List</option>
	<option value=\"Normalview\">Ajax</option>
</select>";
$recordid='NOID';
$onclickEvent="saveINFCustom('".$effectOnTable."','".$table_field."','".$recordid."','SaveOpt','saveCustOption')";
$AddButton="<input name=\"$effectOnTable"."AddBtn\" id=\"$effectOnTable"."AddBtn\" type=\"button\" class=\"savebutton\" onClick=\"$onclickEvent\" value=\"Add\"/>";
print"<tr><td>$AddValue</td><td>$AddCaption</td><td>$AddDisp</td><td>$AddButton</td></tr>";
print'</table>';
  /*$queryUpdateAutoRecord= "Update admin_custom
	  SET  value='$value',display_caption='$display_caption',displaytype='$displaytype'
      where tablename='$effectOnTable' ";
     $RcdqueryUpdateAutoRecordresults = mysql_query($queryUpdateAutoRecord) or die(mysql_error());*/
}

if($action=='autofill'){
 //////
  $query_Rcd_getbody= "SELECT table_name, table_caption FROM admin_table where table_name in 
  (select tablename from admin_controller where displaygroup='$displaygroup')  order by table_name ";
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	print "<tr class=\"ewTableRow\">";
	print "<td class=\"formatTableTd\">";
	$countrows=0;
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$countrows++;
	$table_nameNamed=$count_tbrows['table_name'];
	$table_captionNamed=$count_tbrows['table_caption'];
	$even_row=$countrows%2;
	
	$css='';
	if($even_row>0){
	$css="ewTableAltRow";
	}
	if($countrows<=10){
	print"<div class\"".$css."\"><input name=\"$table_name\"  type=\"radio\" value=\"Options\" onChange=\"displayTableFieldsOptions('".$table_nameNamed."','".$effectOnTable."','".$action."','Displaytfieldshere')\" />".$table_captionNamed;
	print "</div>";
	}
	if($countrows==10){
	   print "</td><td class=\"formatTableTd\">";
	   $countrows=0;
	}
	
	}
/*print"</td></tr>";
print "<tr><td class=\"ewTableRow\"></td>"; 
echo("</tr>");*/ 
}

///List Options
if($action=='list'){
 //////
  $query_Rcd_getbody= "SELECT table_name, table_caption FROM admin_table where table_name in 
  (select tablename from admin_controller where displaygroup='$displaygroup') order by table_name ";
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	print "<tr class=\"ewTableRow\">";
	print "<td class=\"formatTableTd\">";
	$countrows=0;
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$countrows++;
	$table_nameNamed=$count_tbrows['table_name'];
	$table_captionNamed=$count_tbrows['table_caption'];
	$even_row=$countrows%2;
	
	$css='';
	if($even_row>0){
	$css="ewTableAltRow";
	}
	if($countrows<=10){
	print"<div class\"".$css."\"><input name=\"$table_name\"  type=\"radio\" value=\"Options\" onChange=\"displayTableFieldsOptions('".$table_nameNamed."','".$effectOnTable."','".$action."','Displaytfieldshere')\" />".$table_captionNamed;
	print "</div>";
	}
	if($countrows==10){
	   print "</td><td class=\"formatTableTd\">";
	   $countrows=0;
	}
	
	}
/*print"</td></tr>";
print "<tr><td class=\"ewTableRow\"></td>"; 
echo("</tr>");*/ 
}

///List Options
if($action=='options'){

 //////
  $query_Rcd_getbody= "SELECT table_name, table_caption FROM admin_table where table_name in 
  (select tablename from admin_controller where displaygroup='$displaygroup') order by table_name";
  
  echo $query_Rcd_getbody;
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	print "<tr class=\"ewTableRow\">";
	print "<td class=\"formatTableTd\">";
	$countrows=0;
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$countrows++;
	$table_nameNamed=$count_tbrows['table_name'];
	$table_captionNamed=$count_tbrows['table_caption'];
	$even_row=$countrows%2;
	
	$css='';
	if($even_row>0){
	$css="ewTableAltRow";
	}
	if($countrows<=10){
	print"<div class\"".$css."\"><input name=\"$table_name\"  type=\"radio\" value=\"Options\" onChange=\"displayTableFieldsOptions('".$table_nameNamed."','".$effectOnTable."','".$action."','Displaytfieldshere')\" />".$table_captionNamed;
	print "</div>";
	}
	if($countrows==10){
	   print "</td><td class=\"formatTableTd\">";
	   $countrows=0;
	}
	
	}
/*print"</td></tr>";
print "<tr><td class=\"ewTableRow\"></td>"; 
echo("</tr>");*/ 
}
echo("</table>"); 


/////////////////////////////////////////////////////
echo "<div id='displaytfieldsactualresults'></div>";
echo "<div id='displaytfieldsactual'></div>";   
?>