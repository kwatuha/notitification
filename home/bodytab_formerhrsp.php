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
if($_GET['t']!=''){

$currentTbl=trim($_GET['t']);
$currentTblfld=explode('_',$currentTbl);
$actionitem=trim($_GET['act']);
$mysaveflder=explode('_',$currentTbl);

$activetableBody=trim(strtoupper(($_GET['t'])));
echo $query_Rcd_getbody;
$query_Rcd_getbody= "SELECT distinct tablename,fieldname,fieldcaption,fieldcaption,dataformat,dispaytype,
required,screenpostion FROM admin_controller where ucase(tablename)='$activetableBody'";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
}


?>
<?php echo "<p><a  href=\"../home/view.php?token=".base64_encode($currentTbl)."\"/>Edit/View </a>&nbsp;&nbsp;"; ?>|&nbsp;&nbsp;<?php echo "<a  href=\"../$currentTblfld[0]/".$currentTbl."_pdf.php\"/>View PDF </a>"; 
print"<p class=\"date\"></p>";?>
<?php echo $_SESSION[$currentTbl];?>
<table border="1">

<?php 
$countrows=0;
$postdatainsert="''";
$existingDataArr='';
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$countrows++;
$postdatainsert.=$count_tbrows['fieldname'];

if($countrows==1){
$postdata="'".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';
$primarykefield=$count_tbrows['fieldname'];


//$activelinkdDataId=1;
///////////////////
$btnCaption='Save';
$activelinkdDataId=base64_decode(trim(strtoupper(($_GET['q']))));
if($actionitem=='Save'){
$activelinkdDataId='NOID';
$updatestatus='save'.$mysaveflder[0];
}

if($actionitem=='Update'){
		$btnCaption='Update';
		$recordIdentifier=$activelinkdDataId;
		$updatestatus='updatestatus';
	
	$getDataForUpdateSQL="Select * from $currentTbl where $primarykefield=$activelinkdDataId";
	$wheremodifier="where $primarykefield=$activelinkdDataId";
	$getDataForUpdateSQL=$_SESSION[$currentTbl.'_SearchSQL'].$wheremodifier;
		$Rcd_fillddata_results = mysql_query($getDataForUpdateSQL) or die(mysql_error());
		$count_tbrowsfilledfound=mysql_num_rows($Rcd_fillddata_results);
		if($count_tbrowsfilledfound){$existingDataArr=mysql_fetch_array($Rcd_fillddata_results);
		$_SESSION['current'.$currentTbl.$primarykefield]=$existingDataArr[$primarykefield];
		}
		}
		

}else{

$postdata.="+'&".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';
}



$tablename=$count_tbrows['tablename'];
$fieldname=$count_tbrows['fieldname'];
$fieldcaption=$count_tbrows['fieldcaption'];
$fieldcaption=$count_tbrows['fieldcaption'];
$dataformat=$count_tbrows['dataformat'];
$dispaytype=$count_tbrows['dispaytype'];
$required=$count_tbrows['required'];
$screenpostion=$count_tbrows['screenpostion']; 
$displaysize=$count_tbrows['displaysize'];


$fknamefieldcheck=explode('_',$fieldname);
$curArr=explode('_',$currentTbl);

if(($fknamefieldcheck[1]=='id')&&($curArr[1]!=$fknamefieldcheck[0])){
$datafieldpicker=$fknamefieldcheck[0].'_name';
}else{
$datafieldpicker=$fieldname;
}

if($countrows==1){
print '<tr><td>'.$_SESSION[$currentTbl].$fieldname.'</td><td><input type="text"  size="8" id="'.$currentTbl.$fieldname.'">'.'</td></tr>';
}
else{ //check if first item
if( substr($dataformat,0,3)=='tex'){
	print'<tr><td>'.$fieldcaption.'</td><td><textarea cols="48"'.'"  rows="4" id="'.$currentTbl.$fieldname.'" name="'.$currentTbl.$fieldname.'">'.$existingDataArr[$datafieldpicker].'</textarea></td></tr>';
	}else{//text
if(substr($dataformat,0,3)=='dat'){
 
 print"<tr><td>$fieldcaption</td><td>";
 print_date_picker($currentTbl.$fieldname,$fieldcaption,$existingDataArr[$datafieldpicker]);
 print"</td></tr>";
 }
 else{
 $fieldnameIsForeighnkeyitem=explode('_',$fieldname);
 if(($countrows>1)&&($fieldnameIsForeighnkeyitem[1]=='id')){
 $lookfo='lookup_mylinked'.$fieldname;
 $lookupcomplete='onkeyup="'.$lookfo.'(this.value);"';
 $hiddenfield='<tr><td>'.$currentTbl.$fieldname.'hidden</td><td><input type="text"  size="32" id="'.$currentTbl.$fieldname.'hidden"></td></tr>';

}
else
{
$lookfo='';
$lookupcomplete='';
 $hiddenfield='';
}
print $hiddenfield;

 print"<tr><td>$fieldcaption</td><td><input size=\"$displaysize\" $lookupcomplete type=\"text\" autocomplete=off name=\"$currentTbl.$fieldname\" id=\"".$currentTbl.$fieldname."\" value=\"$existingDataArr[$datafieldpicker]\">
 ";
 print_ajax_search_box($fieldname,$currentTbl);
 print"</td></tr>";}
}
}//end of if text arear
}//end if for firstitem
?>
<?php 
print"<tr><td>
<input type=\"button\" name=\"cancel_$tablename\"  value=\"$btnCaption\" onclick=\"save".$tablename."DetailsInfo('".$tablename."','$activelinkdDataId','".$actionitem."','".$updatestatus."')\" class=\"savebutton\" ></td><td><input class=\"savebutton\" type=\"button\" name=\"submit_$tablename\" value=\"Cancel\"  ></td></tr>";


?>


</table>

