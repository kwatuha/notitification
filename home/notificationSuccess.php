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
$tv=$_GET['tv'];
$t=$_GET['t'];
if(($tv)&&($t)){
$tablename=trim($t);
$recordid=trim($tv);
                $varArr=explode('_',$tablename);
			     $SQRNameItems=" select $varArr[1]_name from $tablename where $varArr[1]_id='$recordid' ";
				 $foundRows= mysql_query($SQRNameItems) or die(mysql_error());
			     
				 while($countFNDItems=mysql_fetch_array($foundRows)){
				 $itemName=$countFNDItems[0];
				 }
			 echo $itemName;
}  		

////////////////
//tablename, rid,gnid, actionid
$t=trim($_GET['t']);
$tablename=trim($_GET['t']);
$rid=trim($_GET['rid']);
$recordid=$rid;
$gnid=trim($_GET['gnid']);
$actionid=trim($_GET['actionid']);
$actiontype=trim($_GET['actiontype']);
$alert_id=$actionid; 
$comment=trim($_GET['comment']);
$actionedItemCompleteStatus=trim($_GET['statuscaption']);
$subactivitycaption=trim($_GET['currentactivity']);
$success_action=trim($_GET['success_action']);


          //tablename, rid, gnid, actionid,actiontype,statuscaption,currentactivity)

if(($t)&&($rid)&&($gnid)&&($actionid)&&($actiontype=='viewIND')){
$varArr=explode('_',$tablename);

$fieldColArr='';
$fieldColCaptArr='';

$foundFieldNames= mysql_query("select fieldname,fieldcaption,isautoincrement from admin_controller where tablename='$tablename' ") or die(mysql_error());
  $isautoincrement='';
			while($countFoundNames=mysql_fetch_array($foundFieldNames)){
			$fieldname=$countFoundNames['fieldname'];
			$isautoincrement=$countFoundNames['isautoincrement'];
			$fieldcaption=$countFoundNames['fieldcaption'];
			
			$fieldColArr[$fieldname]=$fieldname.'|'.$isautoincrement;
			$fieldColCaptArr[$fieldname]=$fieldcaption;

   }

//$SQRNameItems=" select $varArr[1]_name from $tablename where $varArr[1]_id='$recordid' ";
$nsql=$_SESSION[$tablename."_SearchSQL"];
$whereclause="  where $varArr[1]_id='$recordid'  ";
$nsql=$nsql.$whereclause;

            $foundRows= mysql_query($nsql) or die(mysql_error());
			
			$cntreg=mysql_num_rows($foundRows);
	 if($cntreg){
	 $tableView='<table>';
	  $tableViewclose='</table>';
	  print $tableView;
	 }
	   $fiednameRVS='';
	
			while($countFNDItems=mysql_fetch_array($foundRows)){
			     
		foreach($fieldColArr as $col){
			$arrf='';
			$fiednameRVS='';
			
			$fiednameRVS=explode('|',$col);
			$arrf=explode('_',$fiednameRVS[0]);
			$fieldColCaptArr[$fieldname]=$fieldcaption;
			
			if((!$fiednameRVS[1])&& ($arrf[1]=='id')){
			$revisedField=$arrf[0].'_name';
			}
			else{
			$revisedField=$fiednameRVS[0];
			}
			
				 
				if(!$fiednameRVS[1]){
				 echo '<tr><td>'.$fieldColCaptArr[$fiednameRVS[0]].'</td>';
				 echo '<td>'.$countFNDItems[$revisedField].'</td></tr>';
				 
				 }
				 
				 }
				print $tableViewclose; 
			}
			 
///now get uttons
$nsqlAct=$_SESSION["admin_alertactivity_SearchSQL"];
$nsqlAct.=" where admin_alert.alert_id='$alert_id'";
$success_action='';
$foundalertactivities= mysql_query($nsqlAct) or die(mysql_error());
 $cntregAct=mysql_num_rows($foundalertactivities);
	 if($cntregAct){
	 print'<table><tr><td>';
	 $success_actionRV='';
			while($countFoundAct=mysql_fetch_array($foundalertactivities)){
			$success_actionRV=$countFoundAct[alert_success];
			print "<button onClick=\"actionNotificationSubActivity('$tablename','$recordid','$gnid','$alert_id','showDialogComent','$countFoundAct[status_after_action]','$countFoundAct[alert_success_caption]','$success_actionRV')\">".$countFoundAct[alert_success_caption].'</button>&nbsp;&nbsp;';
			}
	 print'</td></tr></table>';
	}
//// 

}

if($actiontype=='showDialogComent'){
print "<h3>Comment </h3><hr>";
print "<textarea id='notificationactivitycomment' cols='40' rows='5'></textarea><br>";
print "<button onClick=\"actionNotificationSubActivity('$tablename','$recordid','$gnid','$alert_id','saveIND','$actionedItemCompleteStatus','$subactivitycaption','$success_action')\">$subactivitycaption</button>" ;
}
//save record after action
if($actiontype=='saveIND'){
//////Update current activity
$sql_upDateNTG=" Update admin_groupnotificationhist  set status='$actionedItemCompleteStatus', comment='$comment' where groupnotificationhist_id='$gnid'";
$updateHist= mysql_query($sql_upDateNTG) or die(mysql_error());

//Add new activity
$groupnotificationhist_id='';
$actioned_by=$_SESSION['my_useridloggened'];
$status='No';
$flashed='No';
$comment='';
$effective_date=date('Y-m-d');

if($success_action){
        $alertArr=explode('|',$success_action);
//New process is selected
			if($alertArr[1]=='admin_alert'){
			$alert_id=$alertArr[0];
			}
//Group Notification
			if($alertArr[1]=='admin_usergroup'){
				$alert_id=1;
				$status='Group of users  informed';
				$flashed='Yes';				
			}
			if($alertArr[1]=='pim_employee'){
			$alert_id=2;
			$status='One person informed';
			$flashed='No';
			}
$insertSQLNh=" Insert into admin_groupnotificationhist
(groupnotificationhist_id,alert_id,actioned_by,action,tablename,recordid,status,flashed,comment,effective_date) 
						values(
						'$groupnotificationhist_id','$alert_id'
						,'$actioned_by'
						,'$action'
						,'$tablename'
						,'$recordid'
						,'$status'
						,'$flashed'
						,'$comment'
						,'$effective_date')	
						";
						mysql_query($insertSQLNh) or die(mysql_error());
 }
//////////////////////////
}
//end of save action
if($actiontype=='taskcomplete'){
$sql=" select success_status from admin_alert where alert_id='$alert_id'";
$successresults=mysql_query($sql);
while($countFoundSuccessCaption=mysql_fetch_array($successresults)){
echo $countFoundSuccessCaption[0];
}

}

//check if taskcompletion status is set
if($actiontype=='checktaskcompletionstatus'){
$sql=" select success_status from admin_alert where alert_id='$alert_id'";
$successresults=mysql_query($sql);
$ct=mysql_num_rows($successresults);
if($ct>0){
$taskcaption='';
while($countFoundSuccessCaption=mysql_fetch_array($successresults)){
 $taskcaption=$countFoundSuccessCaption[0];
}
echo 'Task Completion is set|'.$taskcaption;
}


}	
?>
