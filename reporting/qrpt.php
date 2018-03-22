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
require('createPDF.php');

$pdf=new PDF_MC_Table();
$pdf->SetWelcomeData();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

$tbl=1;//trim($_GET['r']);
$rpt=fillPrimaryData('designer_queryfield',$tbl);
$report_caption=$rpt['report_caption'];
$section_caption=$rpt['section_caption'];
$column_width=$rpt['column_width'];
$query=$rpt['query'];

$headercaptions=explode('^',$report_caption);
$finfo=explode(',',$column_width);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$ctnI=0;
/*foreach($headerfields as $itu){

echo "{
				header     : '$headercaptions[$ctnI]' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : '".trim($itu)."'
				 },</br>";
				 $ctnI++;
}

echo '<br />
<br />
<br />
<br />
';*/
$gridfields='';
foreach($headerfields as $itu){

$gridfields.= ",{name:'".trim($itu)."'}";
				
}
//echo $gridfields;
$multidataColumns=LoadQueryData($query,$headerfields);

//create headers
$pdf->CreateQueryTableHeaders($headercaptions,$widthdetails);
//Table with from database
//echo sizeof($headerfields);

$pdf->SetWidths($widthdetails);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$myrow='';
for($i=0;$i<$numofrows;$i++){

			  for($k=0;$k<=$headerde;$k++){
			   $myrow[$k]=$multidataColumns[$i][$k];
			   
			   }
				
$pdf->Row($myrow,$widthdetails);
}
$pdf->Output();


?>
