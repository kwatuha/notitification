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
if($_GET['t']!=''){
$foundrecordid=trim($_GET['q']);
$searchid=trim($_GET['searchid']);
$hidethisdiv=trim($_GET['hidethisdiv']);
$fillid=trim($_GET['fillid']);
$ctable='';
//echo $_GET['t'];
$ctable=explode('_',trim($_GET['t']));
$currentactivetable=trim($_GET['currentactivetable']);
$parenttableid=trim($_GET['parenttableid']);
$limitfield=trim($_GET['limitfield']);
$whereclauseAnd='';
if($currentactivetable!='NL'){
		if(($currentactivetable)&&($parenttableid)){
		  $whereclauseAnd=" And $ctable[1]_id not in(select $ctable[1]_id from   $currentactivetable where $limitfield='$parenttableid')";
		}
}


if($searchid){
$fillthisid=trim($_GET['fillid']);
$activetableBody=trim($_GET['t']);
$searchcolmn=explode('_',$activetableBody);
$searchcolmn_name=$searchcolmn[1].'_name';
$searchcolmn_id=$searchcolmn[1].'_id';

$query_Rcd_getbody= "SELECT $searchcolmn_id, $searchcolmn_name  FROM $activetableBody where $searchcolmn_name like '%$searchid%'
$whereclauseAnd ";
$Rcd_tbody_results = mysql_query($query_Rcd_getbody) or die(mysql_error());
 $cnt_rows=mysql_num_rows($Rcd_tbody_results);

		if($cnt_rows>0){
$searchcolmn=explode('_',$activetableBody);
$searchcolmn_name=$searchcolmn[1].'_name';
$searchcolmn_id=$searchcolmn[1].'_id';
			while($table_rows=mysql_fetch_array($Rcd_tbody_results)){

			   $rowid=$table_rows[$searchcolmn_id]; 
			   $rowname=$table_rows[$searchcolmn_name];

			//echo $fillid.'_fkhidden';
			$filddDatar=explode('xxx',$fillthisid);
			  if($filddDatar[1]=='rlp'){
			  echo "<li onClick=\"myfillfunction('".$fillthisid."','".$rowname."','".$hidethisdiv."');myfillfunction('".$filddDatar[0]."','".$rowid."','".$hidethisdiv."');\">".$rowname."</li>"; 
			  }
			  else{
			  echo "<li onClick=\"myfillfunction('".$fillid."','".$rowname."','".$hidethisdiv."');myfillfunction('".$fillid."_fkhidden','".$rowid."','".$hidethisdiv."');\">".$rowname."</li>"; 
			 
			  }
			  $filddDatar='';
			  

			}
		}else{
		echo 'No matching data found';
		}
}

}
?>