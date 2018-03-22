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
$action=$_GET['action'];
$accountNumber=$_GET['accountNumber'];
$current_reading=$_GET['notification1'];
$comments=$_GET['notification2'];
$isestimated=$_GET['notification3'];
$previous_reading='';
$reading_id='';
$reading_name='WWSAR/'.$accountNumber.'/'.rand(01,1000000);
$reading_date=date('Y-m-d');
$meter_type=1;
echo $action.'WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW'; 
if($action=='showAccountsDetails'){
$query_Rcd_getbody= "SELECT
Distinct
account_connection.connection_name,
admin_meter.meter_name,
account_consumer.consumer_name,
admin_classification.classification_name,
admin_consumercategory.consumercategory_name,
admin_location.location_name

FROM
account_connection 
inner join account_consumer
on account_consumer.consumer_id=account_connection.consumer_id
inner join admin_meter
on account_connection.meter_id=admin_meter.meter_id
inner join   admin_classification
on account_connection.classification_id=admin_classification.classification_id
inner join admin_consumercategory
on account_connection.consumercategory_id=admin_consumercategory.consumercategory_id
inner join admin_location on
admin_location.location_id=account_connection.location_id
";

$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
$cntreg=mysql_num_rows($Rcd_tbody_results);

if ($cntreg>0){ 
$num_found_contacts=$cntreg;
echo("<form name =\"frm$table_name\" action=\"\" method=\"post\"><tr><td  colspan=\"4\">");
echo("<h3>$_SESSION[$table_name]</h3></p></td></tr>");
print( "<input type=\"hidden\"   name=\"num_found_controls\" value=\"$num_found_contacts\"> "); 
print"<div id=\"displayMenuGroup\">
</div>";                       
echo("<table  id=\"sectionOptions\" >"); 

echo("<thead><tr>"); 
print "<th>Connection</th>";		     
print "<th>Meter Number </th>";
print "<th>Consumer </th>";      
print "<th >Classification</th>";
print "<th>Consumer  Category</th>";      
print "<th >Location</th>"; 
print "<th >Current Reading</th>";  
print "<th >Comments</th>"; 
print "<th >Estimated</th>";   
echo("</tr></thead><tbody>"); 
        
			$rec_count=0;
			$emp_count=0;  
			$saveDisplayaOpts='';
			$tablenameFolder=explode('_',$table_name);        
			while($count_ctrls=mysql_fetch_array($Rcd_tbody_results)){ 
            $emp_count++;                    
		
 //$tablename=$count_ctrls['tablename'];
 // $saveDisplayaOpts.="savemenudisplyOptions".$tablename."();";

 $connection_name=$count_ctrls['connection_name'];
 $meter_name=$count_ctrls['meter_name'];
 $consumer_name=$count_ctrls['consumer_name'];
 $classification_name=$count_ctrls['classification_name'];
 $consumercategory_name=$count_ctrls['consumercategory_name'];
 $location_name=$count_ctrls['location_name'];



if($showgroup=='Show'){
$listdiso='checked';
$listdisVal="Show";
}


print ("<tr class='gradeX'>");
echo"
<td >	  
$connection_name
</td>
<td >	  
$meter_name
</td>
<td >	  
$consumer_name
</td>
<td >	  
$classification_name
</td>
<td >	  
$consumercategory_name
</td>
<td >	  
$location_name
</td>
<td>			  	  
<input type=\"text\"    size=\"5\"  id=\"$meter_name"."1\" value=\"\">
</td>
<td>			  
<input type=\"text\"  $listdiso size=\"10\"  id=\"$meter_name"."2\" value=\"\">
</td>
<td>			  
<input type=\"checkbox\"  $listdiso size=\"10\"  id=\"$meter_name"."3\" value=\"Estimate\">Estimate
</td>";

print"</tr>";
$rec_count++; 
$listdiso='';
$pdfdiso='';
}
echo("</tbody></able>");
echo("<table>");
echo("<tr> <td><input type=\"button\" class=\"savebutton\"    size=\"20\" name=\"ctrupdate$table_name\" value=\"Save  Reading\"  onclick=\"SaveAccountReading('Ex20019PY', 'displaymyaccounts','SaveAccountDetails')\">");
print"</td><tr><td>";
print" </td></tr>";
print" <tr><td><td>";
echo("</table>");



}

echo("</form>");

}
if($action=='SaveAccountDetails'){

$insertReadingSQL="
Insert Into billing_reading values('$reading_id','$reading_name','$accountNumber','$meter_type',
'$current_reading','$reading_date','$isestimated','$comments')
";
echo $insertReadingSQL;
$RcdSave = mysql_query($insertReadingSQL) or die(mysql_error());
$cntreg=mysql_num_rows($RcdSave);
if($cntreg){
echo 'Reading posted successfully';
}
}
?>