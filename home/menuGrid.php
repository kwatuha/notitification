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
require_once('../Connections/cf4_HH.php');
include('../template/functions/menuLinks.php');

?>
<?php 
$roleprivilegedetails=findPersonSystemRoles();


$roleprivl='';
$cntrprvl=0;
		foreach($roleprivilegedetails as $priv){
		$cntrprvl++;
		if($cntrprvl==sizeof($roleprivilegedetails)){
		$comma=' ';		}else{
		$comma=',';
		}
		
		$rolarr=explode('^^',$priv);
		$roleprivl.="'".$rolarr[0]."'".$comma;
		}
$userrestriction=$_SESSION['my_useridloggened'];
$userrestrictionClause= " AND uuid in($roleprivl) ";
$roleprivl=$userrestrictionClause;

function getAllowedSections($roleprivl){
$query_Rcd_getmenus= "SELECT  distinct tablename
 FROM admin_controller  where tablename not in(select distinct secondary_tablelist from designer_fasttbldesign) AND tablename not in(select distinct sytable_tablelist from designer_sytable where ucase(invisible)='Y') $roleprivl
/*where  showgroup='Show' */ order by displaygroup,tablename";

$Rcd_menu_results = mysql_query($query_Rcd_getmenus) or die(mysql_error());
$count_fdnrows=mysql_num_rows($Rcd_menu_results);

if($count_fdnrows>0){
$sections='';
$sectionAdditional='';
$sectionAdditionalData='';
		$sectionAdditionalData='';
		$outofrayy='';
		while($count_menurows=mysql_fetch_array($Rcd_menu_results)){
		$countrows++;
        $tablename=$count_menurows['tablename'];
		
				if($count_fdnrows==$countrows){
				$comma='';
				}
				else{
				$comma=',';
				}
				
				$formsAdd=getAllowedFormsIDs();
				if($tablename=='admin_autofill'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'showAutofillOptions()'."'}".$comma;
				}
				
				elseif
				($tablename=='sms_smsgroupmember'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				."gridViewFormGroup()"."'}".$comma;   
				}
				elseif
				($tablename=='designer_tblsummary'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'showcreateSummaryFieldsOptions()'."'}".$comma;
				}
				elseif
				($tablename=='designer_fieldcustomization'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'createOtherTablesFields()'."'}".$comma;
				}
				elseif
				($tablename=='accounts_accountactivity'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'accounts_accountactivityFormRevised()'."'}".$comma;
				}
				
				elseif
				($tablename=='admin_generaview'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'admin_generaviewFormRevised()	'."'}".$comma;
				}
				elseif
				($tablename=='admin_rolenotification'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'admin_rolenotificationRevisedForm()	'."'}".$comma;
				}
				/*elseif
				($tablename=='admin_person'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'admin_personFormRevised()	'."'}".$comma;
				}*/
				elseif 
				($tablename=='accounts_banktrans'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				
				.'createFormGrid("Save","NOID","'.$tablename.'","g")'."'}".$comma;
				}
				elseif($tablename=='insurance_approvedbnote'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'reviewDbResults()'."'}".$comma;
				}
				elseif
				($tablename=='insurance_insurancedebitnote'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'insuranceAccounts2()'."'}".$comma;
				}
				elseif
				($tablename=='admin_person'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'registerperson()'."'}".$comma;
				}
				elseif
				($tablename=='housing_housingtenant'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'housingrpts()'."'}".$comma;
				}elseif
				($tablename=='housing_housinglandlord'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'housingLandlordRvd()'."'}".$comma;
				}elseif
				($tablename=='accounts_cashtrans'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'cashTransSummary()'."'}".$comma;
				$sections.="{ tbl:'Summary||Accounts||"
				.'transSummary()'."'}".$comma;
				}
				elseif
				($tablename=='medicallab_labresult'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'medicallab_labresultFormRevised("030039"'.',50,"92200","Krimi Mwikalo Wawire")'."'}".$comma;
				}elseif
				($tablename=='medicallab_histology'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'medicallab_histologyFormRevised("030039"'.',50,"92200","Krimi Mwikalo Wawire")'."'}".$comma;
				}elseif
				($tablename=='medicallab_papsmear'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'medicallab_papsmearFormRevised("030039"'.',50,"92200","Krimi Mwikalo Wawire")'."'}".$comma;
				}elseif
				($tablename=='medicallab_queue'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'medicallab_queueFormRevised(50,"Krimi Mwikalo Wawire")'."'}".$comma;
				}elseif
				($tablename=='medicallab_resultreview'){
				
				$_SESSION['allowedpatientresultsapproval']=1;
				}
				elseif	($tablename=='sms_smsremotesource'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				."customizedRemoteDSForm()"."'}".$comma;   
				}
				elseif	($tablename=='sms_msgdelivery'){
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				."createSMSDelReport()"."'}".$comma;   
				}
				else{
				
				//sms_smsgroupForm('editdiv','updateload',ccrecordid);
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename]."||"
				.'createForm("Save","NOID","'.$tablename.'","f")'."'}".$comma;
				}
				
		//	 (personid,personname)
  }
  //insurance_insurancedebitnoteFormRevised
}
$othergeneralviews=findPersonViewRoles();
if($othergeneralviews)
$othergeneralviews=','.$othergeneralviews;
return $formsAdd.$sections.$othergeneralviews;
}
$allowgroups=getAllowedGroups($roleprivl);
$allowedsections=getAllowedSections($roleprivl);

echo "{ optionss: [".$allowgroups.'],'. "tables: [".$allowedsections.']}';


function getAllowedGroups($roleprivl){
$userrestriction=$_SESSION['my_useridloggened'];
$query_Rcd_getmenus= "SELECT  distinct displaygroup 
 FROM admin_controller 
where  showgroup='Show'   and  tablename not in(select distinct secondary_tablelist from designer_fasttbldesign) AND tablename not in(select distinct sytable_tablelist from designer_sytable where ucase(invisible)='Y') $roleprivl order by displaygroup";
/*and   controller_id in(select controller_id from admin_rights where usergroup_id='". $_SESSION['my_usergroup_id']."')*/

$Rcd_menu_results = mysql_query($query_Rcd_getmenus) or die(mysql_error());
$countrwsfnd=mysql_num_rows($Rcd_menu_results);
if($countrwsfnd>0){
$message='';
$countrows=0;
$ctproc=0;
  while($count_menurows=mysql_fetch_array($Rcd_menu_results)){
		$countrows++;
		if($countrwsfnd==$countrows){
		$comma='';
		}
		else{
		$comma=',';
		}
		
		
		$message.='{message:'."'".trim($count_menurows['displaygroup'])."'}".$comma;
   }
 }
 $cforms='{message:'."'".'Views'."'},";
 $cforms='';
 $otherfomviews=findPersonGeneralViewGroupRoles();
 if($otherfomviews);
 $otherfomviews=','.$otherfomviews;
 return $cforms.$message.$otherfomviews;
}

 ?><?php
 
 function getAllowedForms(){
$query_Rcd_getmenus= "select distinct designer_sform.sform_id , designer_sform.sform_name  from designer_tabmngr inner join designer_sform on designer_sform.sform_id = designer_tabmngr.sform_id ";

$Rcd_menu_results = mysql_query($query_Rcd_getmenus) or die(mysql_error());
$countrwsfnd=mysql_num_rows($Rcd_menu_results);
	if($countrwsfnd>0){
	$itcn=0;
	$forms='';
	$message='';
	$comma=',';
			  while($count_menurows=mysql_fetch_array($Rcd_menu_results)){
					$forms[$itcn]=$count_menurows['sform_id'].'|'.$count_menurows['sform_name'];
					//$message.='{message:'."'".$count_menurows['sform_name']."'}".$comma;
					
					$message='{message:'."'".'Views'."'}".$comma;
					$itcn++;
			 }
	 }
 return $message;
}

 ?><?php
 
 function getAllowedFormsIDs(){
$query_Rcd_getmenus= "select distinct designer_sform.sform_id , designer_sform.sform_name  from designer_tabmngr inner join designer_sform on designer_sform.sform_id = designer_tabmngr.sform_id ";

$Rcd_menu_results = mysql_query($query_Rcd_getmenus) or die(mysql_error());
$countrwsfnd=mysql_num_rows($Rcd_menu_results);
	if($countrwsfnd>0){
	$itcn=0;
	$forms='';
	$message='';
	$comma=',';
			  while($count_menurows=mysql_fetch_array($Rcd_menu_results)){
					$forms[$itcn]=$count_menurows['sform_id'].'|'.$count_menurows['sform_name'];
					//$message.='{message:'."'".$count_menurows['sform_name']."'}".$comma;
					$message.="{ tbl:'".$r[1]."||".'Views'."||".'createView('.$r[0].')'."'}".$comma;
					
			 }
	 }
	 //$message='';
 return $message;
}

 ?>
