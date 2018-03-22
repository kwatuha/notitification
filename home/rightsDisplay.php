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

$query_Rcd_getbody= "SELECT distinct 
controller_id,
tablename,
displaygroup,
displaysubgroup,
fieldname
FROM admin_controller  order by displaygroup, displaysubgroup ";






$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cntreg=mysql_num_rows($Rcd_tbody_results);

if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td  colspan=\"4\">");
echo("<h3>$_SESSION[$table_name]</h3></p></td></tr>");
print( "<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_contacts\"> "); 
print"<div id=\"displayMenuGroup\">
</div>";                       
echo("<table  id=\"sectionOptions\">"); 

echo("<tr>"); 
print "<th align=\"left\">Section</th>";		     
print "<th align=\"left\">Group</th>";      
print "<th align=\"left\">Sub group</th>"; 
print "<th align=\"left\">Field</th>";  
print "<th >V</th>"; 
print "<th >E</th>";
print "<th >D</th>";
echo("</tr>"); 
        
			$rec_count=0;
			$emp_count=0;  
			$saveDisplayaOpts='';
			$tablenameFolder=explode('_',$table_name);   
			 $v='';
  $e='';
  $d=''; 
  $accessrightsArr='';    
			while($count_ctrls=mysql_fetch_array($Rcd_tbody_results)){ 
            $emp_count++;                    
		
 $tablename=$count_ctrls['tablename'];
  $saveDisplayaOpts.="savemenudisplyOptions".$tablename."();";

 $displaygroup=$count_ctrls['displaygroup'];
 $displaysubgroup=$count_ctrls['displaysubgroup'];
 $fieldname=$count_ctrls['fieldname'];
 $accessrights=trim($count_ctrls['accessrights']);
 if($accessrights){
  $accessrightsArr=explode('|', $accessrights);
  $v=$accessrightsArr[0];
  $e=$accessrightsArr[1];
  $d=$accessrightsArr[2];
  }
	            	



if($showgroup=='Show'){
$listdiso='checked';
$listdisVal="Show";
}


print ("<tr>");
echo"
<td>			  
<input type=\"text\"    size=\"20\" name=\"$tablename"."4\" id=\"$tablename"."4\" value=\"".trim($_SESSION[$tablename])."\">
</td>
<td>			  	  
<input type=\"text\"    size=\"10\" name=\"$tablename"."2\" id=\"$tablename"."2\" value=\"$displaygroup\">
</td>	
<td >	  
<input type=\"text\"    size=\"20\" name=\"$tablename"."3\" id=\"$tablename"."3\" value=\"$displaysubgroup\">
</td>
<td >	  
<input type=\"text\"    size=\"10\" name=\"$tablename"."4\" id=\"$fieldname"."3\" value=\"".$_SESSION[$tablename.$fieldname]."\">
</td>
<input type=\"checkbox\"    size=\"10\" name=\"$fieldname"."1\" id=\"$fieldname"."1"."3\" value=\"$v\">
</td>
<td >
<input type=\"checkbox\"    size=\"10\" name=\"$fieldname"."2\" id=\"$fieldname"."2\" value=\"$e\">
</td><td >
<input type=\"checkbox\"    size=\"10\" name=\"$fieldname"."3\" id=\"$fieldname"."3\" value=\"$d"."3\">
</td>";

print"</tr>";
$rec_count++; 
$listdiso='';
$pdfdiso='';


 
}
echo("</table>");
echo("<table>");
echo("<tr> <td><input type=\"button\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Save\"  onclick=\"$saveDisplayaOpts\">");
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table>");



}

echo("</form>");
?>