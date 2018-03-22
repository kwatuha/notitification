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

$MM_restrictGoTo = "../../index.php";
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
require_once('../../Connections/cf4_HH.php');
require_once('../../template\functions\menuLinks.php');
?>
<?php
$tbl=trim($_GET['t']);
$dbtable_input_tbl=base64_decode($tbl);
$_SESSION[statementfromtbl]="stm$dbtable_input_tbl";
$stmtable=$statementfrom;

//headers and footers:

$activetablelinked=$dbtable_input_tbl;
$headerfields=getHeaderDetailsRevisedPdf($activetablelinked);
$company=getCompanyDetails();
$w=getHeaderWithDetails($activetablelinked);
$multidataColumns=LoadPDFData($activetablelinked,$headerfields);

$a = array(
        array('data' => $multidataColumns),
        array('company' => $company)

		);
$json = json_encode($a);
echo $json;

function getCompanyDetails(){
$companyArrInfo=getCompanyInfo();
 $mynewsess=$_SESSION[statementfromtbl];
$companyArr=explode('||', $companyArrInfo[0]);
$date_printed=date('d-m-Y');
	$a = array(
        array('name' => $companyArr[0]),
        array('address' => 'Address: P.O. Box  '.$companyArr[4].' - '.$companyArr[5].'  '.$companyArr[6]),
        array('tel' => ' Tel: '.$companyArr[7].' Fax: '.$companyArr[8]),
        array('mobile' => ' Mobile: '.$companyArr[9]),
        array('email' => 'Email: '.$companyArr[10]),
        array('website' => 'Website: '.$companyArr[11]),
        array('mobile' => ' Mobile: '.$companyArr[9]),
        array('date' => $date_printed),
        array('user' => $_SESSION['my_username']),
        array('section' => ucwords($_SESSION[$mynewsess]))
		);

return $a;
}
function LoadPDFData($activetablelinked,$headerfields)
{

$sql=$_SESSION[$activetablelinked.'_SearchSQL'];
$results_qry=mysql_query($sql) or die($sql);
$countrowsfoundfordesplay=mysql_num_rows($results_qry);
$cntcols=0;
$countouter=1;
$activetablelinkedArray=explode('_',$activetablelinked);
$myfolder=$activetablelinkedArray[0];
////
if($countrowsfoundfordesplay>0){
    $c=0;
	//$multidataColumns[0][0]='#';
foreach($headerfields as $key => $value){
  $multidataColumns[0][$c]=$key;
    $c++;
   }


}
//////////////////
while($count=mysql_fetch_array($results_qry)){
$countinner=0;



foreach($headerfields  as $key => $pdffielditem ){
$currid=$activetablelinkedArray[1];
$nmr=explode('_',$pdffielditem);



if(($nmr[1]=='id')&&($currid!=$nmr[0])){
$arrDataRow[$cntcols]=$count[$nmr[0].'_name'];
$processedfieldname=$pdffielditem;
$dataColumns[$cntcols]=$count[$nmr[0].'_name'];
$multidataColumns[$countouter][$countinner]=$count[$nmr[0].'_name'];
$countinner++;
$cntcols++;

} else{
$arrDataRow[$cntcols]=$count[$pdffielditem];
$processedfieldname=$pdffielditem;
$dataColumns[$cntcols]=$count[$pdffielditem];

if($countinner==0){
$multidataColumns[$countouter][0]=$count[$activetablelinkedArray[1].'_id'];
}else{
$multidataColumns[$countouter][$countinner]=$count[$pdffielditem];
}
$countinner++;
$cntcols++;
}

}
$countouter++;
}

return $multidataColumns;
}

function getHeaderDetailsRevisedPdf($activetablelinked){
$sqlcontrols="select distinct fieldname , fieldcaption, tablecaption , detailsvisiblepdf , position,colnwidth,primarykeyidentifier from admin_controller where tablename='$activetablelinked' and detailsvisiblepdf='Show' order by position";

			//echo $sqlcontrols;
			$results_ctrls=mysql_query($sqlcontrols);
	        $cnt_cols=mysql_num_rows($results_ctrls);
			$countcurrentfield=0;
			$displayvalues='';
			if($cnt_cols>0){
			$countlns=0;
			$foundforeingperons='';
			while($table_formcontrols=mysql_fetch_array($results_ctrls)){
			$countlns++;



			  $table_field=$table_formcontrols['fieldname'];
			  $table_fieldcaption=$table_formcontrols['fieldcaption'];

			  if(($table_field=='person_id')&&($tablename!='admin_person'))
			  $foundforeingperons='True';

			  $ctableArr=explode('_',$activetablelinked);
			  $ctablePr=trim(strtoupper($ctableArr[1].'_id'));
			 $vs=explode('_',$table_field);


					 $headerfields[$table_fieldcaption]=$table_field;
					 if(($vs[1]=='id')&&($ctablePr!=trim(strtoupper($table_field)))){

					 $headerfields[$table_fieldcaption]=$vs[0].'_name';
					 }

			  }

			  }//end of whileperson_fullname
			  if( $foundforeingperons){
			  $headerfields['Person Name']='person_fullname';
			  }


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
			  $table_caption=$table_formcontrols['tablecaption'];
              $table_field=$table_formcontrols['fieldname'];
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