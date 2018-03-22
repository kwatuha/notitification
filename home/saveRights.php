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
$sectiongroup=$_GET['sectiongroup'];
$action=$_GET['actiontype'];
$usergroup=$_GET['usergroupPed'];
$tableKey=$_GET['tableKey'];
$view=$_GET[viewaction];
$edit=$_GET[editaction];
$delete=$_GET[deleteaction];
//$usergroup_id=$usergroup;
$effective_date=date('Y-m-d');
$role_id='';
$currentgroup=$_GET['currentgroup'];
$accessrightsExisting='';	
if($usergroup!='NoGroup'){

if(($action=='Group')&&($sectiongroup!='')&&($usergroup!='')){
     $query_Rcd_getbody= "SELECT controller_id FROM admin_controller where  displaygroup='$tableKey' ";
	 echo $query_Rcd_getbody;
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
  $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	$controller_id=0;
	$count_xrights=0;
	
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$controllerFound=$count_tbrows['controller_id'];
	//echo 	$controllerFound.'<br />
	$query_Rcd_ctr= "
     select usergroup_id	, controller_id from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound ";
    $Rcd_ctr_results = mysql_query($query_Rcd_ctr) or die(mysql_error());
	$count_xrights=mysql_num_rows($Rcd_ctr_results); 
    
	
	if(($view=='v')&&($edit=='e')&&($delete=='d')){
	//Remove user rights
	$deleterightsSQL="delete from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound";
	$Rcd_del_results = mysql_query($deleterightsSQL) or die(mysql_error());
	//$count_xrights=mysql_num_rows($Rcd_ctr_results);
	}
	
			  if($count_xrights>0)
			{
							$updateRights="update admin_rights set view='$view', edit='$edit', del='$delete'  where usergroup_id=$usergroup AND controller_id=$controllerFound";
							
							
							$Resultsupdate = mysql_query($updateRights) or die(mysql_error());
			}	else{
			if($view=='v'){
      $view=0;
      }
      if($edit=='e'){
      $edit=0;
      }
      if($delete=='d'){
      $delete=0;
      }
      
				
					$usergroup_id=$usergroup;
					$controller_id=$controller_id;
					$effective_date=date('Y-m-d');
					$insertRights="insert into admin_rights(
          usergroup_id
					,controller_id
					,view
					,edit
					,del
					,effective_date)  values(
					
					'$usergroup_id'
					,'$controllerFound'
					,'$view'
					,'$edit'
					,'$delete'
					,'$effective_date')";
					 
					if(($view==1)||($edit==2)||($delete==3)){
					$ResultRightsInserts = mysql_query($insertRights) or die(mysql_error());
					}
					} 
	
	}//end of while for controlers
}

if(($action=='SubGroup')&&($sectiongroup!='')&&($usergroup!='')){
$query_Rcd_getbody= "SELECT controller_id FROM admin_controller where  displaysubgroup='$tableKey' and displaygroup='$sectiongroup'";
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	$controller_id=0;
	$count_xrights=0;
	
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$controllerFound=$count_tbrows['controller_id'];
	
	$query_Rcd_ctr= "
     select usergroup_id	, controller_id from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound ";
    $Rcd_ctr_results = mysql_query($query_Rcd_ctr) or die(mysql_error());
	$count_xrights=mysql_num_rows($Rcd_ctr_results); 
    
	
	if(($view=='v')&&($edit=='e')&&($delete=='d')){
	//Remove user rights
	$deleterightsSQL="delete from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound";
	$Rcd_del_results = mysql_query($deleterightsSQL) or die(mysql_error());
	//$count_xrights=mysql_num_rows($Rcd_ctr_results);
	}
	
			  if($count_xrights>0)
			{
	$updateRights="update admin_rights set view='$view', edit='$edit', del='$delete'  where usergroup_id=$usergroup AND controller_id=$controllerFound";
	$Resultsupdate = mysql_query($updateRights) or die(mysql_error());
			}	else{
					if($view=='v'){
      $view=0;
      }
      if($edit=='e'){
      $edit=0;
      }
      if($delete=='d'){
      $delete=0;
      }
      
				
					$usergroup_id=$usergroup;
					$controller_id=$controller_id;
					$effective_date=date('Y-m-d');
					$insertRights="insert into admin_rights(
          usergroup_id
					,controller_id
					,view
					,edit
					,del
					,effective_date)  values(
						'$usergroup_id'
					,'$controllerFound'
					,'$view'
					,'$edit'
					,'$delete'
					,'$effective_date')";
					
					if(($view==1)||($edit==2)||($delete==3)){
					$ResultRightsInserts = mysql_query($insertTRights) or die(mysql_error());
					}
					} 
	
	}//end of while for controlers
	
}

if(($action=='Table')&&($sectiongroup!='')&&($usergroup!='')){
   $query_Rcd_getbody= "SELECT controller_id FROM admin_controller where  tablename='$tableKey' and displaysubgroup='$currentgroup'";
   
  
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	$controller_id=0;
	$count_xrights=0;
	
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$controllerFound=$count_tbrows['controller_id'];
	$query_Rcd_ctr= "
     select usergroup_id	, controller_id from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound ";
    $Rcd_ctr_results = mysql_query($query_Rcd_ctr) or die(mysql_error());
	$count_xrights=mysql_num_rows($Rcd_ctr_results); 
	
	
	if(($view=='v')&&($edit=='e')&&($delete=='d')){
	//Remove user rights
	$deleterightsSQL="delete from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound";
	$Rcd_del_results = mysql_query($deleterightsSQL) or die(mysql_error());
	//$count_xrights=mysql_num_rows($Rcd_ctr_results);
	}
	
			  if($count_xrights>0)
			{
							$updateRights="update admin_rights set view='$view', edit='$edit', del='$delete'  where usergroup_id=$usergroup AND controller_id=$controllerFound";
							$Resultsupdate = mysql_query($updateRights) or die(mysql_error());
			}	else{
			if($view=='v'){
      $view=0;
      }
      if($edit=='e'){
      $edit=0;
      }
      if($delete=='d'){
      $delete=0;
      }
      
				
					$usergroup_id=$usergroup;
					$controller_id=$controller_id;
					$effective_date=date('Y-m-d');
					$insertRights="insert into admin_rights(
         	'$usergroup_id'
					,controller_id
					,view
					,edit
					,del
					,effective_date) values(
					'$role_id'
					,'$usergroup_id'
					,'$controllerFound'
					,'$view'
					,'$edit'
					,'$delete'
					,'$effective_date')";
					if(($view==1)||($edit==2)||($delete==3)){
					
					$ResultRightsInserts = mysql_query($insertTRights) or die(mysql_error());
					}
					} 
	
	}//end of while for controlers
	
	
 
}///////End of table declarations

if(($action=='TableField')&&($sectiongroup!='')&&($usergroup!='')){
    $query_Rcd_getbody= "SELECT controller_id FROM admin_controller where  tablename='$tableKey' and fieldname='$sectiongroup'";
    $Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
    $count_tbrowsfound=mysql_num_rows($Rcd_tbody_results);
	$controller_id=0;
	
	while($count_tbrows=mysql_fetch_array($Rcd_tbody_results)){
	$controllerFound=$count_tbrows['controller_id'];
	}
	
	
//obtain current rights
$constantNum=0;
$query_Rcd_ctr= "
select usergroup_id	, controller_id from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound ";
$Rcd_ctr_results = mysql_query($query_Rcd_ctr) or die(mysql_error());
	$count_xrights=mysql_num_rows($Rcd_ctr_results); 
    $fieldname=$sectiongroup;
	$view=$_GET[$fieldname.'1'];
	$edit=$_GET[$fieldname.'2'];
	$delete=$_GET[$fieldname.'3'];
	
	if(($view=='v')&&($edit=='e')&&($delete=='d')){
	//Remove user rights
	$deleterightsSQL="delete from admin_rights where usergroup_id=$usergroup AND controller_id=$controllerFound";
	$Rcd_del_results = mysql_query($deleterightsSQL) or die(mysql_error());
	//$count_xrights=mysql_num_rows($Rcd_ctr_results);
	}
	
			  if($count_xrights>0)
			{
							$updateRights="update admin_rights set view='$view', edit='$edit', del='$delete'  where usergroup_id=$usergroup AND controller_id=$controllerFound";
							$Resultsupdate = mysql_query($updateRights) or die(mysql_error());
			}	else{
				if($view=='v'){
      $view=0;
      }
      if($edit=='e'){
      $edit=0;
      }
      if($delete=='d'){
      $delete=0;
      }
      
				
					$usergroup_id=$usergroup;
					$controller_id=$controller_id;
					$effective_date=date('Y-m-d');
					$insertRights="insert into admin_rights(
          role_id
					,usergroup_id
					,controller_id
					,view
					,edit
					,del
					,effective_date) values(
						'$usergroup_id'
					,'$controllerFound'
					,'$view'
					,'$edit'
					,'$delete'
					,'$effective_date')";
					                echo $insertTRights;
					if(($view==1)||($edit==2)||($delete==3)){
					$ResultRightsInserts = mysql_query($insertTRights) or die(mysql_error());
					}
					}
 }

echo 'Updated :'.$sectiongroup;

}//check group
?>