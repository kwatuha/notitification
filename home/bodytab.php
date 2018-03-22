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
  if (isset($QUERY_STRING) && strlen($QUERY_STRING)>0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
}
?><?php require_once('../Connections/cf4_HH.php');
require_once('../template/functions/menuLinks.php');
if($_GET['t']!=''){

$currentTbl=trim($_GET['t']);

create2dcode($currentTbl,$currentTbl);
$currentTblfld=explode('_',$currentTbl);
$actionitem=trim($_GET['act']);
$mysaveflder=explode('_',$currentTbl);
$activelinkdDataId=trim($_GET['q']);


$activetableBody=trim(strtoupper(($_GET['t'])));
$query_Rcd_getbody= "SELECT tablename,fieldname,fieldcaption,dataformat,dispaytype,
required,control_position,caption_position,infshow,infpos,isautoincrement,displaysize FROM admin_controller    where ucase(tablename)='$activetableBody'  and controller_id in(select controller_id from admin_rights where usergroup_id='". $_SESSION['my_usergroup_id']."') order by infpos asc";


$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
}
//../home/view.php?token=".base64_encode($currentTbl)."
?><?php
echo "<p><h3>$_SESSION[$currentTbl]</h3><hr>";

echo"<Div id=\"updateclient".$currentTbl."\"></div>";
echo "<a  target=\"_blank\" href=\"../reporting/report.php?t=".base64_encode($currentTbl)."\"/>Print PDF </a>";
echo "&nbsp;|&nbsp;<a   href=\"#\"  onClick=\"gridView$currentTbl()\"/>View/Edit </a>&nbsp;|&nbsp;<a   href=\"#\"  onClick=\"openOptions('$currentTbl')\"/>Options</a>"; 
 /*echo "<p><h3>$_SESSION[$currentTbl]</h3><hr>
<a onmouseover=\"myfillControl('currentscreen','".$currentTbl."')\" href=\"#\" />Edit/View </a>
&nbsp;&nbsp;"; ?>|&nbsp;&nbsp;<?php 
echo "<a  target=\"_blank\" href=\"../$currentTblfld[0]/".$currentTbl."_pdf.php\"/>View PDF </a>"
.'|&nbsp;&nbsp'."<a  href=\"#\" onclick=\"displayConfigOptions('".$currentTbl."','".$_SESSION['tablegroup'.$currentTbl]."','position')\"/>Options </a>";*/  
print"<p class=\"date\"></p>"
;
//echo $_SESSION[$currentTbl];
?><title>'</title>
<form name="datafilledform"  id="datafilledform"  method="get">
<table border="0">
<?php 
$countrows=0;
$postdatainsert="''";
$existingDataArr='';
$isAutoIncrementedARR='';
$trackHiddend='';
$caption_positionArr='';
$control_positionArr='';
$infshowdARR='';
$count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
$dispaytype='';
$displayTypeOptions='0 ';
while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
$countrows++;
$actualfield=$count_tbrows['fieldname'];
$postdatainsert.=$count_tbrows['fieldname'];
$dispaytypeArr[$actualfield]=$count_tbrows['dispaytype'];
$caption_positionArr[$actualfield]=$count_tbrows['caption_position'];
$control_positionArr[$actualfield]=$count_tbrows['control_position'];
$isAutoIncrementedARR[$actualfield]=$count_tbrows['isautoincrement'];
$infshowdARR[$actualfield]=$count_tbrows['infshow'];
if($countrows==1){
$postdata="'".$count_tbrows['fieldname']."='+".$count_tbrows['fieldname'].'.value';
$primarykefield=$count_tbrows['fieldname'];
//$activelinkdDataId=1;
$onchangeControlData="clearUpdateClient('$currentTbl')";


$btnCaption='Save';
$activelinkdDataId=trim($_GET['q']);
if($actionitem=='Save'){
$activelinkdDataId='NOID';

$updatestatus='save'.$_SESSION['tablegroup'.$currentTbl];
$closediaglog='';
}

if($actionitem=='Update'){

		$btnCaption='Update';
		$recordIdentifier=$activelinkdDataId;
		//$updatestatus='updatestatus';
	   

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
$ypostion=$count_tbrows['caption_position']; 
$xpostion=$count_tbrows['control_position'];
$displaysize=$count_tbrows['displaysize'];
//echo 'p='.$displaysize.'<br>';
$dispaytype=$count_tbrows['dispaytype'];

$alertactive='';
$modifyactivityctrn='';
$checkifstatusiset='';
$checktaskcaptionstatus='';
/*if(($tablename=='admin_alertactivity') && ($fieldname=='status_after_action' )){
$checktaskcaptionstatus="validateNotificationSuccessCaption()";
}*/

if(($tablename=='admin_alertactivity') && ($fieldname=='alert_success_caption' )){
$checkifstatusiset="checkTaskCompletionStatus('checktaskcompletionstatus')";
$hiddenControll.='<input type="text"  size="8" id="hiddenCompletionstatus">';
}
if(($tablename=='admin_alertactivity') && ($fieldname=='alert_success' )){
//$checkifstatusiset="checkTaskCompletionStatus('checktaskcompletionstatus')";

$alertactive=" fillActivitySuccessAction();";
//$onchangeControlData.=$alertactive;
$hiddenControll.='<input type="hidden"  size="8" id="admin_alertactivityalert_success">';

$modifyactivityctrn='hds';
}
$addCustField='';
$txtdisplaytype='text';
if(($tablename=='admin_alertactivity') && ($fieldname=='mark_task_completion' )){
$txtdisplaytype='hidden';
$addCustField='<input onClick="getTaskCompletionStatus();" type="checkbox"   id="markcompletionalert_success">';
}

$fknamefieldcheck=explode('_',$fieldname);
$curArr=explode('_',$currentTbl);
/*/////////////////////////////////////////////
//echo $caption_positionArr[$fieldname].'wwwwwwwwwwwwwwwwwwwwwwww'.$fieldname;
if($caption_positionArr[$fieldname]>0){
//echo $caption_positionArr[$fieldname].'ppppppppppppppppppppppppppppppassssssssssssssssssssss';
		$style="position:absolute; top: ".$caption_positionArr[$fieldname].'px; left: '.
		$control_positionArr[$fieldname].'px;';
        $posDiv='<div id="div'.$tablename.$fieldname.'" style="'.$style.'">';
		$posDivEnd='</div>';
		}else{
		$style='';
		$posDiv='';
		$posDivEnd='';
}
    print $posDiv;
	if($dataformat=='text'){
	}
else{
print"<input  name=\"$tablename$fieldname\" type=\"text\"  size=\"$infwidth\" value=\"$fieldname\"/>";
	$currentcontrol='';
	}
print $posDivEnd;

/////////////////////////////////////////////
*/


if(($fknamefieldcheck[1]=='id')&&($curArr[1]!=$fknamefieldcheck[0])){
$datafieldpicker=$fknamefieldcheck[0].'_name';
//echo 'wwwwwwwwwwwwwwwwwwwwwwwwww';
}else{
$datafieldpicker=$fieldname;
}

if((trim($isAutoIncrementedARR[$fieldname]))||($infshowdARR[$fieldname]=='Hide')){
$hiddenControll.='<input type="hidden"  size="8" id="'.$currentTbl.$fieldname.'">';
}
else{ //check if first item
if( substr($dataformat,0,3)=='tex'){
	print'<tr><td>'.$fieldcaption.'</td><td><textarea cols="28"'.'"  rows="3" onKeyUp=\"clearUpdateClient(\'$currentTbl\');\" id="'.$currentTbl.$fieldname.'" name="'.$fieldname.'">'.$existingDataArr[$datafieldpicker].'</textarea></td></tr>';
	}else{//text
if(substr($dataformat,0,3)=='dat'){
 
 print"<tr><td>$fieldcaption</td><td>";
 print_date_picker($currentTbl,$fieldname,$fieldcaption,$existingDataArr[$datafieldpicker]);
 print"</td></tr>";
 }
 else{
 $fieldnameIsForeighnkeyitem=explode('_',$fieldname);



 if((!$isAutoIncrementedARR[$fieldname])&&($fieldnameIsForeighnkeyitem[1]=='id')){
$hiddenControll.='<input onBlur="$onchangeControlData"  type="hidden" id="'.$currentTbl.$fieldname.'_fkhidden" value="'.$existingDataArr[$fieldname].'">';
 $runtdisplay='onFocus="showsuggestion()"';
$suggestDiv=
"<div class=\"suggestionsBoxRevised\" id=\"suggestions\" >
<div  class=\"suggestionListRevised\" id=\"".$currentTbl.$fieldname."_suggestions\">
</div>
</div>";

 //displaysearchDitails(activetable,searchid,hidethisdiv,limitfield,currentactivetable)
 if(($currentTbl=='admin_alertactivity')&&($fieldname=='activitystatus_id')){
 $lookupcomplete='onKeyUp='."
 displaysearchDitails('"
 .$_SESSION[$fieldname]."','".$currentTbl.$fieldname."','".$currentTbl.$fieldname."_suggestions','alert_id','admin_alertactivity') ";
 }else{
 $lookupcomplete='onKeyUp='."
 displaysearchDitails('"
 .$_SESSION[$fieldname]."','".$currentTbl.$fieldname."','".$currentTbl.$fieldname."_suggestions','NO','NL') ";
}
}
else
{
$lookfo='';
$lookupcomplete='';
 $hiddenfield='';
 $runtdisplay='';
 
}
////////////////////////// 
$rlp='';
 if($currentTbl=='admin_supervisor'){

 if(($fieldname=='relation_to')||($fieldname=='person')){
  $rlp='xxxrlp';
$hiddenControll.='<input type="text"  id="'.$currentTbl.$fieldname.'" value="'.$existingDataArr[$fieldname].'">';
 $runtdisplay='onFocus="showsuggestion()"';
$suggestDiv=
"<div class=\"suggestionsBoxRevised\" id=\"suggestions\" >
<div  class=\"suggestionListRevised\" id=\"".$currentTbl.$fieldname."_suggestions\">
</div>
</div>";
//displaysearchDitails(activetable,searchid,hidethisdiv)
$lookupcomplete='onKeyUp='."
 displaysearchDitails('pim_employee','".$currentTbl.$fieldname.$rlp."','".$currentTbl.$fieldname."_suggestions','No','NL') ";
}
}


$addControll='';
$onchangeinf='';
if($currentTbl=='loans_emploan'){

if(($fieldname=='repayment_period')){
$onchangeinf="onKeyUp=\"calculateLoanInfo()\"";
print"<div id=\"loaninfo\"  style=\" background:gray; right:20px\"></div>";
$addControll='add';
}
}
if($currentTbl=='pim_employee'){
//printphoto($fieldname);
}
//////////////////////////////////////
$displayTypeArr=explode('|',$dispaytypeArr[$fieldname]);

///
$currentcontrol="<input size=\"$displaysize\"  $clearcontrolEditSessions $onchangeinf $lookupcomplete $runtdisplay type=\"$txtdisplaytype\" autocomplete=off name=\"$fieldname\" id=\"$modifyactivityctrn$currentTbl$fieldname$rlp\"  onKeyUp=\"$onchangeControlData ; $alertactive ; $checkifstatusiset ;$checktaskcaptionstatus\" value=\"$fillval$existingDataArr[$datafieldpicker]\">$addCustField$suggestDiv";
if($dispaytype=='photo'){
//
}else{
if(($displayTypeArr[0]=='autofill')&&($actionitem=='Save')){
print"<tr><td valign=\"top\" >$fieldcaption</td><td valign=\"top\">";
$fillval=fillAutoFillController($currentTbl,$fieldname);
//echo $fillval;
$currentcontrol='';
}
if($displayTypeArr[1]!='admin_custom'){ 

if(($displayTypeArr[0]=='list')&&($actionitem=='Save')){
print"<tr><td valign=\"top\" >$fieldcaption</td><td valign=\"top\">";
fillListFillController($displayTypeArr[1],$currentTbl);
$currentcontrol='';
$hiddenfk='';
}

if(($displayTypeArr[0]=='dbtlist')&&($actionitem=='Save')){
print"<tr><td valign=\"top\" >$fieldcaption</td><td valign=\"top\">";
//fillListFillController($displayTypeArr[1],$currentTbl);
build_DbTableList($currentTbl,$fieldname,'MultInsert');
print"<tr><td valign=\"top\" >Select options</td><td valign=\"top\"><div id=\"shownotificationtype\"</td></tr>";
$currentcontrol='';
$hiddenfk='';                                                 
}
if(($displayTypeArr[0]=='gvdbtlist')&&($actionitem=='Save')){
print"<tr><td valign=\"top\" >$fieldcaption</td><td valign=\"top\">";
//fillListFillController($displayTypeArr[1],$currentTbl);

build_DbTableList($currentTbl,$fieldname,'IndivInsert');
print"<tr><td valign=\"top\" >Select options</td><td valign=\"top\"><div id=\"shownotificationtype\"</td></tr>";
$currentcontrol='';
$hiddenfk='';
}



if(($displayTypeArr[0]=='options')&&($actionitem=='Save')){
 print"<tr><td valign=\"top\" >$fieldcaption</td><td valign=\"top\">";
fillOptionsFillController($displayTypeArr[1],$currentTbl);
$currentcontrol='';
$displayTypeOptions.=' '.$fieldname;
$hiddenfk='';
}

}//test if custom data
else{
if($displayTypeArr[0]=='options'){
$displayTypeOptions.=' '.$fieldname;
}
 print"<tr><td valign=\"top\" >$fieldcaption</td><td valign=\"top\">";
fillCustomDataFillController($currentTbl,$fieldname,$dispaytypeArr[$fieldname]);
$currentcontrol='';

}
if($currentcontrol){

 //print $hiddenfk;
 
 $fcaptionArr='';
 $fctlArr='';
 $fcaptionArr=explode('|',$caption_positionArr[$fieldname]);
 $fctlArr=explode('|',$control_positionArr[$fieldname]);
 $useABSCaption='';
 $useABSControl='';
 if($fctlArr[1]){
 $useABSControl=" style=\" left:".($fctlArr[0])."em   ; top:".($fctlArr[1])."em position:absolute \"";
 //$useABSControl=" style=\" left:".($fctlArr[0]/16)."px   ; top:".($fctlArr[1]/16)."em position:absolute \"";

 }
 
 if($fcaptionArr[1]){
 $useABSCaption=" style=\" left:".($fcaptionArr[0])."em  ; top:".($fcaptionArr[1])."em  position:absolute \"";
 //$useABSCaption=" style=\" left:".($fcaptionArr[0]/16)."px  ; top:".($fcaptionArr[1]/16)."em  position:absolute \"";
 
 }
 
 $draghandle="[$fieldcaption]";
 $draghandle='';
 $activatedraghandlecptn="onMouseOver=\"positionDIVElem('caption$currentTbl$fieldname')\"  onMouseUp=\"saveCurrentContrlPosition('$currentTbl','$fieldname','caption')\"";
 $activatedraghandlecptn='';
 
 print "<tr><td><div onmouseout=\"displayModifiedPosition('caption$currentTbl$fieldname',$fcaptionArr[1],$fcaptionArr[1])\" $activatedraghandlecptn id=\"caption$currentTbl$fieldname\">$fieldcaption</div></td><td>";
 
 
 $activatedraghandlectl=" onmouseover=\"positionDIVElem('control$currentTbl$fieldname')\"   onMouseUp=\"saveCurrentContrlPosition('$currentTbl','$fieldname','ctl')\" ";
 $activatedraghandlectl='';
 //echo "onmouseout=\"displayModifiedPosition('control$currentTbl$fieldname',$fctlArr[1],$fctlArr[1])";
 print "<div onmouseout=\"displayModifiedPosition('control$currentTbl$fieldname',$fctlArr[1],$fctlArr[1])\"  $activatedraghandlectl id=\"control$currentTbl$fieldname\">$currentcontrol$draghandle</div>";

 }
 print"</td></tr>";

 }
 
 
 
 $suggestDiv='';
 $hiddenfk='';
 $lookupcomplete='';
 $autocomplete='';
 $fillval='';
 $clearcontrolEditSessions='';
 $clearcontrolEditSessions='';
 }
}
}//end of if text arear
}//end if for firstitem
?>
<?php 

/*if($caption_positionArr[$fieldname])
{
=$count_tbrows['caption_position'];
$control_positionArr)



}*/

if($currentTbl=='admin_ntg'){
$onclick="SaveNotificationTypes('$currentTbl','admin_ntgtablename','InsertNotificationTypes','$updatestatus')";
}else{

$onclick="save".$tablename."DetailsInfo('".$tablename."','$activelinkdDataId','".$actionitem."','".$displayTypeOptions."','".'updateclient'."','".$_SESSION['tablegroup'.$tablename]."')";
}
if($currentTbl=='admin_groupnotification'){
$onclick="SaveNotificationTypesByGroup('$currentTbl','admin_groupnotificationtablename','InsertUsergroupNotification','$updatestatus')";
}


if($currentTbl=='admin_alertactivity'){
$onclick="validateNotificationSuccessCaption()";
}

$validatedetails='';
if($currentTbl=='pim_employee'){
$onclick='';
$validatedetails='checkSsn();';
}

$validatenNUM='';
if($currentTbl=='pim_employee'){
$onclick='';
$validatenNUM='checkSsn();';
}
print"<tr><td>&nbsp;</td><td>&nbsp;</td></tr> ";
print"<tr><td>
<input type=\"button\" id=\"actionbtn$tablename\" name=\"cancel_$tablename\"  value=\"$btnCaption\" onclick=\"$validatedetails $validatenNUM clearUpdateClient('$currentTbl');$onclick \" class=\"savebutton\" ></td><td>
<input class=\"savebutton\" type=\"reset\" name=\"submit_$tablename\" value=\"Cancel\">
</td></tr>";


print"<div onmouseover=\"myfillControl('currentscreen','".$currentTbl."')\" ".' id="viewconfig" style="bottom:-30px;  left:-270px;  width:1090; height:5; position:absolute; font z-index:5;
font-family:Arial, Helvetica, sans-serif; font-size:12px">
</div>';
print"<div onmouseover=\"myfillControl('currentscreen','".$currentTbl."')\" ".' id="viewconfig" style="bottom:-50px;  left:-270px;  width:1090; height:5; position:absolute;  font z-index:5;
font-family:Arial, Helvetica, sans-serif; font-size:12px">';


?></table>
<?php
print '<div id="bodyhiddendis" style="visibility:invisible; background:blue" >'.$hiddenControll.'</div>';
print "<script>
showHidConfDIV('bodyhiddendi','hide');
</script>";

?>
</form>
