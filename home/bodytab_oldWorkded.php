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
?><?php require_once('../Connections/cf4_HH.php');
if($_GET['q']!=''){
$activelinkdDataId=trim(strtoupper(($_GET['q'])));
$currentTbl=trim($_GET['t']);
$activetableBody=trim(strtoupper(($_GET['t'])));

 
$query_Rcd_getbody= "SELECT distinct tablename,fieldname,fieldcaption,fieldcaption,dataformat,dispaytype,
required,screenpostion FROM admin_controller where ucase(tablename)='$activetableBody'";
//echo $query_Rcd_getmenus;
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
}
?>

<table border="1">
<?php 
$countrows=0;
$postdatainsert="''";
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$countrows++;
$postdatainsert.=$count_tbrows['fieldname'];

if($countrows==1){
$postdata="'".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';

$javascriptVar='
function saveDetailsTableInfo(){
var xmlHttp;'.'<br>'.'
	try{	'.'<br>'.'
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari'.'<br>'.'
	}'.'<br>'.'
	catch (e){'.'<br>'.'
		try{'.'<br>'.'
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer'.'<br>'.'
		}'.'<br>'.'
		catch (e){'.'<br>'.'
		    try{'.'<br>'.'
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");'.'<br>'.'
			}'.'<br>'.'
			catch (e){'.'<br>'.'
				alert("No AJAX!?");'.'<br>'.'
				return false;'.'<br>'.'
			}'.'<br>'.'
		}'.'<br>'.'
	}'.'<br>'.'

xmlHttp.onreadystatechange=function(){'.'<br>'.'
	if(xmlHttp.readyState==4){'.'<br>';
$javascriptVar.='var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$count_tbrows['fieldname']."')".'.value;'.'<br>';
}else{
$postdata.="+'&".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';

$javascriptVar.='var '. $count_tbrows['fieldname'].'=document.getElementById('."'".$count_tbrows['fieldname']."')".'.value;'.'<br>';

}

if($countrows==$count_tbrowsfound){
$javascriptVar.='
fdata=document.getElementById('."'postdata'".');'.'<br>'.'
	
		document.getElementById('."'saveEvent'".').innerHTML=xmlHttp.responseText;'.'<br>'.'
		
	}'.'<br>'.'
}'.'<br>'.'

xmlHttp.open("GET","http://localhost:8080/clockplus/home/bodysave.php?t="+'."'".$currentTbl."'".'+'."'&q='+'".$activelinkdDataId."'+".$postdata.',true);'.'<br>'.'
xmlHttp.send(null);'.'<br>'.'
}'.'<br>'.'

window.onload=function(){'.'<br>'.'
	
}'.'<br>'.'


'.'<br>'.'
';

}
////////////////////////////////////////////////
/////////////////////////////////////////
$tablename=$count_tbrows['tablename'];
$fieldname=$count_tbrows['fieldname'];
$fieldcaption=$count_tbrows['fieldcaption'];
$fieldcaption=$count_tbrows['fieldcaption'];
$dataformat=$count_tbrows['dataformat'];
$dispaytype=$count_tbrows['dispaytype'];
$required=$count_tbrows['required'];
$screenpostion=$count_tbrows['screenpostion']; 
print"<tr><td>$fieldcaption</td><td><input type=\"text\" name=\"$fieldname\" id=\"$fieldname\"></td></tr>";
}
?>
<?php 

print"<tr><td>
<input type=\"button\" name=\"cancel_$tablename\"  value=\"Save\" onclick=\"saveDetailsTableInfo()\" class=\"savebutton\" ></td><td><input class=\"savebutton\" type=\"button\" name=\"submit_$tablename\" value=\"Cancel\"  ></td></tr>";
$jsdata='../template/functions/currentinsertjs.js';

file_put_contents($jsdata,'<script>'.$javascriptVar.'</script>');
?>


</table>

