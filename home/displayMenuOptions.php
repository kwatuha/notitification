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
if($_GET['t']!=''){
/*$activetableBody=trim($_GET['t']);
$query_Rcd_getbody= "SELECT distinct 
tablename,
displaygroup,
displaysubgroup,
showgroup
FROM admin_controller where tablename='$activetableBody'";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());*/
}
?>
<?php 

$query_Rcd_getbody= "SELECT distinct 
tablename,
displaygroup,
displaysubgroup,
showgroup
FROM admin_controller where tablename='$activetableBody'";

$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cntreg=mysql_num_rows($Rcd_tbody_results);
if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td class='Stable_td' colspan=\"4\">");
//echo("<hr>");

echo("<h3>$_SESSION[$table_name]</h3></p></td></tr>");
print( "<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_contacts\"> ");                        
echo("<table width='98%' class='Stable_table'> "); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"4\"><hr></td >";
echo("<tr class='Stable_th'>"); 		     
print "<th align=left>showgroup </td >";
print "<th align=left>displaygroup </td >";      
print "<th align=left>displaysubgroup</td >";     
print "<th align=left>showgroupposition</td >";

echo("</tr>"); 
echo("<tr class='Stable_th'>");
print "<td colspan=\"4\"><hr></td >";
echo("</tr>");
          
			$rec_count=0;
			$emp_count=0;  
			$tablenameFolder=explode('_',$table_name);  
			$saveDisplayaOpts='';      
			while($count_ctrls=mysql_fetch_array($Rcd_tbody_results)){ 
            $emp_count++;                    
		
 $tablename=$count_ctrls['tablename'];
 $displaygroup=$count_ctrls['displaygroup'];
 $displaysubgroup=$count_ctrls['displaysubgroup'];
 $showgroup=$count_ctrls['showgroup'];
 $showgroupposition=$count_ctrls['showgroupposition'];
 $saveDisplayaOpts.="savedisplyOptions".$tablename."('".$tablename."','ReloadThis');";
	//ended		            	
if(isset($emp_count)){
$even_row=$emp_count%2;
}

if($table_col_viewonpdf=='Show'){
$pdfdiso='checked';
$pdfdisVal="Show";
}
if($table_col_viewdetails=='Show'){
$listdiso='checked';
$listdisVal="Show";
}

if($even_row<=0){

print ("<tr class='Stable_even_row'>");
}
if($even_row>0){
	print "<tr class='Stable_non_even_row'>";
	}
	//$listdiso $pdfdiso


echo"
<td class='Stable_td'>			  
<input type=\"checkbox\"  $listdiso size=\"20\" name=\"details$rec_count\" id=\"$tablename"."1\" value=\"Show\">
</td>
</td><td class='Stable_td'>			  
<input type=\"hidden\"    size=\"30\" name=\"ctrlerfound$rec_count\" value=\"$controller_id\">		  
<input type=\"text\"    size=\"20\" name=\"$tablename"."2\" id=\"$tablename"."2\" value=\"$displaygroup\">
</td>
<input type=\"hidden\"    size=\"30\" name=\"ctrlerfound$rec_count\" value=\"$controller_id\">		  
<input type=\"text\"    size=\"20\" name=\"$tablename"."3\" id=\"$tablename"."3\" value=\"$displaysubgroup\">
</td>
<td class='Stable_td'>
<input type=\"text\"    size=\"3\" id=\"$tablename"."4\" name=\"position$rec_count\" value=\"$showgroupposition\"> 
</td>";
print"</tr>";
$rec_count++; 
$listdiso='';
$pdfdiso='';


 
}
print"<tr><td colspan=\"5\"><p class=\"date\"></p></td></tr>";
print"<tr><td>Section Title</td><td colspan=\"4\"><input type=\"text\"    size=\"40\" id=\"$tablename"."\" name=\"$tablename\" value=\"".$_SESSION[$tablename]."\"></td></tr>";
print "<td colspan=\"5\"><p class=\"date\"></td >";
echo("</tr>");
echo("<tr> <td><input type=\"button\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Saveb Groups\"  onclick=\"$saveDisplayaOpts\">");
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table>");



}

echo("</form>");
?>