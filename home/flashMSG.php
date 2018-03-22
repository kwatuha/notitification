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
 //echo $_SESSION['my_usergroup_id'];
 //echo $_SESSION['my_useridloggened'];
$searchNotifications="select admin_groupnotificationhist.groupnotificationhist_id , 
admin_groupnotificationhist.tablename,
admin_groupnotificationhist.status,
 admin_groupnotificationhist.recordid, 
admin_alert.notificationalert_id ,
 admin_alert.alert_name , 
admin_groupnotificationhist.actioned_by , 
admin_groupnotificationhist.action , 
admin_groupnotificationhist.effective_date  
from admin_groupnotificationhist 
 inner join admin_alert on admin_alert.alert_id = admin_groupnotificationhist.alert_id 
where admin_groupnotificationhist.status=0 AND  admin_groupnotificationhist.alert_id in( select alert_id from admin_groupnotification 
 

order by admin_groupnotificationhist.notification_id,admin_rolenotificationhist.tablename
";
$rols=getCurrentSystemRoles();
$searchNotifications=$_SESSION["admin_rolenotificationhist_SearchSQL"]. " where admin_rolenotificationhist.rolenotificationevent_id in(select rolenotificationevent_id  from admin_rolenotification where admin_rolenotification.role_id in($rols)) ";
   
    $RcdQryAlertresults = mysql_query($searchNotifications) or die(mysql_error());
	 $cntreg=mysql_num_rows($RcdQryAlertresults);
	 if($cntreg<=0){
	 echo 'New Messages Not Available';
	 $SQR='';
	 }
	 if($cntreg>0){
	 $strms='';
	 if($cntreg>1)
	 $strms='s';
	 
	 echo   ' You have '.$cntreg.' Message'.$strms;
	 $countOpts=1;
	 $varArr='';
	 
	 $itemName=''; 
			/* while($count_ctrls=mysql_fetch_array($RcdQryAlertresults)){
			 $alert_name=$count_ctrls['notificationalert_name'];
			 $alert_id=$count_ctrls['notificationalert_id'];
			 $groupnotificationhist_id=$count_ctrls['groupnotificationhist_id'];
			 $effective_date=$count_ctrls['date_created'];
			 $action=$count_ctrls['action'];
			  $tablename=$count_ctrls['primary_tablelist'];
			  $recordid=$count_ctrls['recordid'];
			 $countOpts++;
			    
				 $varArr=explode('_',$tablename);
			     $SQRNameItems=" select $varArr[1]_name from $tablename where $varArr[1]_id='$recordid' ";
				 $foundRows= mysql_query($SQRNameItems) or die(mysql_error());
			     
				 while($countFNDItems=mysql_fetch_array($foundRows)){
				 $itemName=$countFNDItems[0];
				 }
			 
			 
			 
			 echo $_SESSION[$tablename].' '.$itemName.' '.$effective_date."<a onMouseOver=\"myfillControl('alertNotificatioID','$alert_id'); myfillControl('currentNotificatioID','$groupnotificationhist_id')\" id=\"IdnotficationLInkIDNGS\" href=\"#\" >$alert_name</a>".'<br>';
			 
					 
			}*/
		}
		
		
?>
