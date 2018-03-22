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
?><?php

$tbl=trim($_GET['t']);
$dbtable_input_tbl='accounts_accountactivity';
$_SESSION[statementfromtbl]="stm$dbtable_input_tbl";
$stmtable=$statementfrom;

//headers and footers:


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
		$s=sizeof($headerWidth)	+1;
		$headerWidth[$s]=20;  
	return $headerWidth;
	
	}  
?>
<?php
require('createrNCLPDF.php');
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

$activetablelinked=$dbtable_input_tbl;//'pim_employee';
$widthdetails=array(5,5,20,40,10,20,20,20,10);
$headerfields=array(
accountactivity_id		,
accountactivity_name		,
accountscategory_name		,
accaccount_name		,
currency_name	,
amount		,
transaction_type		,
naration,
transaction_date,	
);//getHeaderDetails($activetablelinked);


$multidataColumns=LoadTableData($activetablelinked,$headerfields);

//create headers
$pdf->createReceiptHeaders();
$pdf->CreateDynamicPDFLayout($headerfields,$widthdetails,$activetablelinked);
//Table with from database
$pdf->SetWidths($widthdetails);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields)+1;

for($i=0;$i<$numofrows;$i++){

			for($k=0;$k<=$headerde;$k++){
			     //foreach($headerfields as $itemsd) echo $itemsd;
				$myrow[$k]=$multidataColumns[$i][$k];
				}
$pdf->Row($myrow);
}

$pdf->Output();


?>
