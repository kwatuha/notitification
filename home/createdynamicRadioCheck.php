<?php
restrictaccessMenu_mlkns();
function restrictaccessMenu_mlkns(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

/*** Restrict Access To Page: Grant or deny access to this page*/
function isAuthorized_menu_fmks($strUsers, $strGroups, $UserName, $UserGroup) { 
/* For security, start by assuming the visitor is NOT authorized. */
  $isValid = False; 

  /*When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  Therefore, we know that a user is NOT logged in if that Session variable is blank. */ 
  if (!empty($UserName)) { 
    /* Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    Parse the strings into arrays. */
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    /* Or, you may restrict access to only certain users based on their username. */
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
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized_menu_fmks("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
//createdynamicRadioCheck.php?tview='+display+'&t='+source+'&div='+div
$tview=$_GET['tview'];
$activetableBody=$_GET['t'];
$div=$_GET['div'];

if (($tview)&($activetableBody)&&($div)){
		$searchcolmn=explode('_',$activetableBody);
		$searchcolmn_name=$searchcolmn[1].'_name';
		$searchcolmn_id=$searchcolmn[1].'_id';
		$query=$_GET["query"];
		$addclause='';
		if($query){
		$query=trim($query);
		$addclause="  WHERE $searchcolmn_name like '%$query%'  ";
		}
		$query_Rcd_getbody= "SELECT $searchcolmn_id, $searchcolmn_name  FROM $activetableBody  $addclause";
		
		//echo $query_Rcd_getbody;
		$alertQueryResults=mysql_query($query_Rcd_getbody);
		$cntAlert=mysql_num_rows($alertQueryResults);
		if($cntAlert>0){
		$ct=0;
		$str='';
		 while($e=mysql_fetch_array($alertQueryResults)){
		 $ct++;
		 if($ct==$cntAlert){
		 $comma='';
		 }else{
		 $comma=',';
		 }
		 
		 $str.= "{ boxLabel: '$e[1]', name: '$e[0]', inputValue: '$e[0]' }".$comma;
		 }
		 
	   }
		
		
	
}


$title=$_SESSION['stm'.$activetableBody];
echo "function dynamicRadioGroup(){ 
 Ext.create('Ext.form.Panel', {
 title: '$title',
 width: 300,
 height: 125,
 bodyPadding: 10,
 draggable:true,
 shadow :true,
 stateEvents:['click', 'customerchange'],
 renderTo:'$div',
 items:[{
 xtype: '$tview',
 fieldLabel: 'Two Columns',
 columns: 2,
 vertical: true,
 items: [$str
 ]
 }]
 });
 
 }dynamicRadioGroup()";
?>