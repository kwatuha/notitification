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

$dbtable_input_tbl='admin_person';//trim($_GET['t']);
//$dbtable_input_tbl=base64_decode($tbl);
$_SESSION[statementfromtbl]="stm$dbtable_input_tbl";
$stmtable=$statementfrom;

//headers and footers:

$ar1=array('kenya','uganda','mauritiurs');
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
class PDF extends FPDF
{
#******************************
function PDF($orientation='l', $unit='mm', $format='tabloid')
{
$this->FPDF($orientation,$unit,$format);
}

function CheckPageBreak($h)
{
#If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger){
		$this->AddPage($this->CurOrientation);
		}
}

//
function NbLines($w,$txt)
{
//Computes the number of lines a MultiCell of width w will take
$cw=&$this->CurrentFont['cw'];
if($w==0)
$w=$this->w-$this->rMargin-$this->x;
$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
$s=str_replace("\r",'',$txt);
$nb=strlen($s);
if($nb>0 and $s[$nb-1]=="\n")
$nb--;
$sep=-1;
$i=0;
$j=0;
$l=0;
$nl=1;
while($i<$nb)
{
$c=$s[$i];
if($c=="\n")
{
$i++;
$sep=-1;
$j=$i;
$l=0;
$nl++;
continue;
}
if($c==' ')
$sep=$i;
$l+=$cw[$c];
if($l>$wmax)
{
if($sep==-1)
{
if($i==$j)
$i++;
}
else
$i=$sep+1;
$sep=-1;
$j=$i;
$l=0;
$nl++;
}
else
$i++;
}
return $nl;
}

///////
function Section($ar1)
{
# add the page header
$this->CustomHeader();
# set the font that will be used
$this->SetFont('Arial', '', 9);
for($i=0; $i<count($ar1); $i++)
{
# bring the array element back to a local variable f1
$f1 = $ar1[$i];
# the following will return the number of lines for the
# text field f1 based on the font selected above as well
# as a MultiCell width of 25
$lines = $this->NbLines($f1, 25);
# variable hx will yeild the amount of Y consummed by this
# line of text
$hx = $lines * 6;
# now going to check to see if the text in f1 will cause
# a page break

# now going to check
if($this->GetY() + $hx > $this->PageBreakTrigger)
{
# going to add a new page
$this->AddPage($this->CurOrientation);
# add the page header
$this->CustomHeader();
# space the start of the text 5 mm below the end of the header
$this->Ln(5);
# reset the font to what is needed for the text display (content)
$this->SetFont('Arial', '', 9);
}


# now going to generate the MultiCell
$this->MultiCell(25,6,$f1,1,'L',0);
# if you want a space between the next row, insert a value
# in the Ln() call, otherwise insert a 0
$this->Ln(0);
}
}
//From the example above
////

$file_nm='test.pdf';
$pdf=new PDF();
$pdf->Section($ar1);
$pdf->Open($file_nm);
$pdf->SetTopMargin(10);
$pdf->AddPage(L);
?>