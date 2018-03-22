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
include('../template/functions/menuLinks.php');
?>
<?php
$usrgrp=trim($_GET['usrgrp']); 
$userid=trim($_GET['userid']);



$query_Rcd_getbody= "SELECT distinct displaygroup,controller_id
FROM admin_controller  order by displaygroup ";

$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cntreg=mysql_num_rows($Rcd_tbody_results);

if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td  colspan=\"4\">");
//echo("<h3>$_SESSION[$table_name]</h3></p></td></tr>");
print( "<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_contacts\"> "); 
print"<div id=\"displayMenuGroup\">
</div>";
//echo "<p class=\"date\"><div align=\"left\">Main Groups</div></p>"; 
echo"<div id='subsectionsdetailsstatus'></div>"; 
echo "<div id='maingroupinfo'>";
echo "<hr>";  
 
$table='admin_usergroup';
$id='usergroup_id';
$caption='usergroup_name';
$groupname="usergroup_id";
$onchange="usergroupChange(this.value)";
build_DisplayList($table,$id,$caption,$groupname,$onchange,$userid) ;
$hiddenData="<input type=\"hidden\" id=\"sectionid\" value=\"MaingGroups\">";
$hiddenData.= "<input type=\"hidden\" id=\"currentgroup\" value=\"Group\">";

echo "<hr>";  

print"<div id='subsectionsdetails' style=\"height:200; width:auto; overflow:auto; border:thick;\">";            
echo("<table  id=\"sectionOptions\">"); 

echo("<tr>"); 
print "<th align=\"left\">&nbsp;</th>";		           
print "<th >V</th>"; 
print "<th >E</th>";
print "<th >D</th>";
print "<th align=\"left\">View</th>";
echo("</tr>"); 
        
			$rec_count=0;
			$emp_count=0;  
			$saveDisplayaOpts='';
			$tablenameFolder=explode('_',$table_name);   
			 $v='';
  $e='';
  $d=''; 
  $accessrightsArr='';  
  $arryControllerDetails=getUserGroupCurrentRigths($usrgrp) ;
while($count_ctrls=mysql_fetch_array($Rcd_tbody_results)){

$emp_count++;                    
$fieldname=$count_ctrls['displaygroup'];
$displaygroup=$count_ctrls['displaygroup'];

$controller_id=$count_ctrls['controller_id'];
if($fieldname!=$fieldnameProcessed){
$isview='';
$isEdit='';
$isview='';
$isDel='';
if($arryControllerDetails[$controller_id]){
$rightsArr=explode('#',$arryControllerDetails[$controller_id]);
if($rightsArr[0]==1){
$isview="checked='true'";
}
if($rightsArr[1]==2){
$isEdit="checked='true'";
}
if($rightsArr[2]==3){
$isDel="checked='true'";

}
}

$rec_count++; 
$listdiso='';
$pdfdiso='';

$action='Group';
$tableKey=$displaygroup;
$activegrp=$displaygroup;
$displayDiv='subsectionsdetailsstatus';
$fieldnameRTr=$fieldname;
//if($DONE=='')   {
$savestring="saveRightsAssignment('".$fieldnameRTr."','".$tableKey."','".$displayDiv."','".$action."');";
$savestr=$displaygroup.'|'.$tableKey.'|'.$displayDiv.'|'.$action;
$fiitnow="saveRightsAssignment(\'".$fieldnameRTr."\',\'".$tableKey."\',\'".$displayDiv."\',\'".$action."\');";
//echo $savestring;

print ("<tr>");
echo"
<td valign='top'>			  
$displaygroup
</td>
<td valign='top'><input type=\"checkbox\" 
 onClick=\"$savestring\"  $isview  size=\"10\" name=\"$fieldname="."1\" id=\"$fieldname"."1\" value=\"$v\">
</td>
<td valign='top'>
<input type=\"checkbox\"  onClick=\"$savestring\"   $isEdit  size=\"10\" name=\"$fieldname"."2\" id=\"$fieldname"."2\" value=\"$e\">
</td><td valign='top'>
<input type=\"checkbox\"  onClick=\"$savestring\"  $isDel size=\"10\" name=\"$fieldname"."3\" id=\"$fieldname"."3\" value=\"$d"."\">
</td>
<td border='1'>	
	  	  
<a href=\"#\"  onclick=\"displaySubGroupsInfo('".$displaygroup."','subsectionsdetails');\">View</a>
<div id =\"access".$displaygroup."\">
</div>	
</td>";

print"</tr>";


//echo $savestring;
// }
// $DONE='DDFSDFDSF';
//saveRightsAssignment(activegrp,tableKey,displayDiv,action)
}
$fieldnameProcessed =$fieldname;
//runSaveFunctions('rightsviewcontroll')
}//end of while
print"<tr><td colspan='5'>";
echo "<p class=\"date\"><div id=\"dtMainGroupLevel\"></div></p>";  
echo "</td></tr>";
echo("<tr> <td><input type=\"hidden\" class=\"savebutton\"  onClick=\"$savestring\"  size=\"20\" name=\"ctrupdate$table_name\" value=\"Save\"  >");
 //echo $savestring;
print"</td></tr><tr><td colspan='5'>";
echo "<hr>";
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table></div>");

//<input type=\"button\" class=\"savebutton\"    value=\"Hide\"  onclick=\"hideVisibleDiv('access".$displaygroup."')\"

}
echo "</div>";
echo "<div id=\"hiddenrightsdivs\">$hiddenData</div>";
echo("</form>");
?>