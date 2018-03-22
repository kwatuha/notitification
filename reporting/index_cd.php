<?php
restrictaccess();
function restrictaccess(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
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
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
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
//include('../template/functions/menuLinks.php');
include('../template/functions/insertSQL.php');
include('../template/functions/folderlinks.php');
include('../template/functions/searchSQL.php');
include('../template/functions/updateSQL.php');
?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cf4_HH = "localhost";
$database_cf4_HH = "ampathdb";
$username_cf4_HH = "root";
$password_cf4_HH = "";
$cf4_HH = mysql_pconnect($hostname_cf4_HH, $username_cf4_HH, $password_cf4_HH) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_cf4_HH);

function LoadTableData($activetablelinked,$headerfields)
{
$sql=$_SESSION[$activetablelinked.'_SearchSQL'];
//echo $sql;
$results_qry=mysql_query($sql) or die('Could not execute the query');
$countrowsfoundfordesplay=mysql_num_rows($results_qry);
$cntcols=0;
$countouter=0;
$activetablelinkedArray=explode('_',$activetablelinked);
$myfolder=$activetablelinkedArray[0];
//print"<input type=\"text\" id=\"folderid\" value=\"".$myfolder." ppp\">";
while($count=mysql_fetch_array($results_qry)){
$countinner=1;

$multidataColumns[$countouter][0]=$count[$activetablelinkedArray[1].'_id'];
foreach($headerfields as $pdffielditem){

$arrDataRow[$cntcols]=$count[$pdffielditem];
$processedfieldname=$pdffielditem;
$dataColumns[$cntcols]=$count[$pdffielditem];
$multidataColumns[$countouter][$countinner]=$count[$pdffielditem];
$countinner++;
$cntcols++;

}
$countouter++;
//$data[]=array_unique($arrDataRow);
}
//return $data;
return $multidataColumns;
}
function getHeaderDetails($activetablelinked){
$sqlcontrols="select distinct fieldname , fieldcaption, tablecaption , detailsvisiblepdf , position,colnwidth from admin_controller where tablename='$activetablelinked' and detailsvisiblepdf='Show' order by position";   
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='';
			if($cnt_cols>0){
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			  $tablename=$table_formcontrols['tablename']; 
			  $table_caption=$table_formcontrols['tablecaption'];$table_field=$table_formcontrols['fieldname'];
			  $table_col_caption=$table_formcontrols['fieldcaption'];
			  $table_col_viewdetails=$table_formcontrols['detailsvisiblepdf'];
              $table_col_viewonpdf=$table_formcontrols['detailsvisiblepdf'];
			  $table_col_positionb=$table_formcontrols['position'];
              $displayvalues[$countcurrentfield]=$table_formcontrols[0];
			  $header[$countcurrentfield]=$table_formcontrols[1];
			  $table_col_colnwidth=$table_formcontrols['colnwidth'];
			  if($table_formcontrols[3]=='Show'){
			  $headerWidth[$countcurrentfield]=$table_formcontrols[5];
			  }else{
			  $headerWidth[$countcurrentfield]=0;}
			  $headerfields[$countcurrentfield]=$table_formcontrols[0];
			  $countcurrentfield++;
			  }}//end of while
			  
	return $headerfields;
	
	}

function getHeaderWithDetails($activetablelinked){
$sqlcontrols="select distinct fieldname , fieldcaption, tablecaption , detailsvisiblepdf , position,colnwidth from admin_controller where tablename='$activetablelinked' and detailsvisiblepdf='Show' order by position";   
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0; 
			$displayvalues='';
			if($cnt_cols>0){
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			  $tablename=$table_formcontrols['tablename']; 
			  $table_caption=$table_formcontrols['tablecaption'];$table_field=$table_formcontrols['fieldname'];
			  $table_col_caption=$table_formcontrols['fieldcaption'];
			  $table_col_viewdetails=$table_formcontrols['detailsvisiblepdf'];
              $table_col_viewonpdf=$table_formcontrols['detailsvisiblepdf'];
			  $table_col_positionb=$table_formcontrols['position'];
              $displayvalues[$countcurrentfield]=$table_formcontrols[0];
			  $header[$countcurrentfield]=$table_formcontrols[1];
			  $table_col_colnwidth=$table_formcontrols['colnwidth'];
			  if($table_formcontrols[3]=='Show'){
			  $headerWidth[$countcurrentfield]=$table_formcontrols[5];
			  }else{
			  $headerWidth[$countcurrentfield]=0;}
			  $headerfields[$countcurrentfield]=$table_formcontrols[0];
			  $countcurrentfield++;
			  }}//end of while
			  
	return $headerWidth;
	
	}  
?>
<?php
require('mc_table.php');
//require_once('Connections/cf4_HH.php');

function GenerateWord()
{
	//Get a random word
	$nb=rand(3,10);
	$w='';
	for($i=1;$i<=$nb;$i++)
		$w.=chr(rand(ord('a'),ord('z')));
	return $w;
}

function GenerateSentence()
{
	//Get a random sentence
	$nb=rand(1,10);
	$s='';
	for($i=1;$i<=$nb;$i++)
		$s.=GenerateWord().' ';
	return substr($s,0,-1);
}

$pdf=new PDF_MC_Table();
$pdf->SetWelcomeData();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

$activetablelinked='pim_employee';
$widthdetails=getHeaderWithDetails($activetablelinked);
$headerfields=getHeaderDetails($activetablelinked);
$multidataColumns=LoadTableData($activetablelinked,$headerfields);

//Table with 20 rows and 4 columns
$pdf->SetWidths($widthdetails);
$pdf->Header();
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
for($i=0;$i<$numofrows;$i++){
			for($k=0;$k<$headerde;$k++){
				$myrow[$k]=$multidataColumns[$i][$k];
				}
$pdf->Row($myrow);
}

$pdf->Footer();
$pdf->Output();


?>
