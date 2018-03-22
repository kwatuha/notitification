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
?>
<?php 
//displaygroup='$activelinkdData' and
//and   controller_id in(select controller_id from admin_rights where usergroup_id='". $_SESSION['my_usergroup_id']."')
function getAllowedSections(){
$query_Rcd_getmenus= "SELECT  distinct tablename
 FROM admin_controller 
/*where  showgroup='Show' */ order by displaygroup";

$Rcd_menu_results = mysql_query($query_Rcd_getmenus) or die(mysql_error());
$count_fdnrows=mysql_num_rows($Rcd_menu_results);

if($count_fdnrows>0){
$sections='';
		while($count_menurows=mysql_fetch_array($Rcd_menu_results)){
		$countrows++;
        $tablename=$count_menurows['tablename'];
		
				if($count_fdnrows==$countrows){
				$comma='';
				}
				else{
				$comma=',';
				}
				
				$sections.="{ tbl:'".$_SESSION[$tablename]."||".$_SESSION['tablegroup'.$tablename].                 "||"
				.'createForm("Save","NOID","'.$tablename.'","f")'."'}".$comma;
				//showinfo
				//$tablename.'Form("formview")'.
				 
  }
  
}
//admin_companyForm(displayhere,loadtype,rid)
return $sections;
}
$allowgroups=getAllowedGroups();
$allowedsections=getAllowedSections();

echo "{ optionss: [".$allowgroups.'],'. "tables: [".$allowedsections.']}';
/*echo "{ optionss: [{ message:'Users'},{message:'Forms'},{message:'Structure'}],
		  tables: [{ tbl:'AdminUser||Users||'},{tbl:'formtable'},{tbl:'StructureTable'}]
		}
";
*/


function getAllowedGroups(){
$query_Rcd_getmenus= "SELECT  distinct displaygroup 
 FROM admin_controller 
where  showgroup='Show'   order by displaygroup";
/*and   controller_id in(select controller_id from admin_rights where usergroup_id='". $_SESSION['my_usergroup_id']."')*/

$Rcd_menu_results = mysql_query($query_Rcd_getmenus) or die(mysql_error());
$countrwsfnd=mysql_num_rows($Rcd_menu_results);
if($countrwsfnd>0){
$message='';
$countrows=0;
  while($count_menurows=mysql_fetch_array($Rcd_menu_results)){
		$countrows++;
		if($countrwsfnd==$countrows){
		$comma='';
		}
		else{
		$comma=',';
		}
		$message.='{message:'."'".$count_menurows['displaygroup']."'}".$comma;
   }
 }
 
 return $message;
}

 ?>
