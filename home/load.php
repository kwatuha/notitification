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
include('../template/functions/menuLinks.php');
include('../template/functions/insertSQL.php');
include('../template/functions/folderlinks.php');
include('../template/functions/searchSQL.php');
include('../template/functions/updateSQL.php');
?><?php

$query_Rcd_users_table= "Show tables";
$Rcd_users_table_results = mysql_query($query_Rcd_users_table) or die(mysql_error());

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Registration Details</title>
		<link type="text/css" href="../viewdesign/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		
		
		<script type="text/javascript" src="../viewdesign/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../viewdesign/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
				$('#tabs2').tabs();
	
	// Options
				//$('#options_tab').options();
				
//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
				
			});
		</script>
		<style type="text/css">
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>
		<style type="text/css" title="currentStyle">
			@import "../media/css/demo_page.css";
			@import "../media/css/demo_table.css";
		</style>
		
		<script type="text/javascript" language="javascript" src="../media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				/* Add a click handler to the rows - this could be used as a callback */
				$('#example tr').click( function() {
					if ( $(this).hasClass('row_selected') )
						$(this).removeClass('row_selected');
					else
						$(this).addClass('row_selected');
				} );
				
				/* Init the table */
				var oTable = $('#example').dataTable( );
			} );
			
			/*
			 * I don't actually use this here, but it is provided as it might be useful and demonstrates
			 * getting the TR nodes from DataTables
			 */
			function fnGetSelected( oTableLocal )
			{
			    //var oTable = $('#oTableLocal').dataTable( );
				var aReturn = new Array();
				var aTrs = oTableLocal.fnGetNodes();
				
				for ( var i=0 ; i<aTrs.length ; i++ )
				{
					if ( $(aTrs[i]).hasClass('row_selected') )
					{
						aReturn.push( aTrs[i] );
					}
				}
				divto=document.getElementById('selecteddata');
	            divto.innerHTML=myarray;
				alert('It is workin d');
				return aReturn;
			}
			
		</script>
		<script type="text/javascript">
<!--//---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function()
{
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
	$("#firstpane p.menu_head").click(function()
    {
		$(this).css({backgroundImage:"url(images/down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(images/left.png)"});
	});
	//slides the element with class "menu_body" when mouse is over the paragraph
	$("#secondpane p.menu_head").mouseover(function()
    {
	     $(this).css({backgroundImage:"url(images/down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
         $(this).siblings().css({backgroundImage:"url(images/left.png)"});
	});
});
</script>
<script type="text/javascript">
function Ajax(){
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('ReloadThis').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
xmlHttp.open("GET","http://localhost:8080/ampath/control.php?t=k",true);
xmlHttp.send(null);
}

window.onload=function(){
	setTimeout('Ajax()',2000);
}
function hideList(diveid){
var activelist= document.getElementById(diveid)
activelist.style.visibility="hidden";

}
/*function showActivePage(tokenid){
var activelist= document.getElementById(folderid);
activelist.style.visibility="visible";

}
*/
//Add columns dynamically
function displayActivePage(recordid){
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('ReloadThis').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}

var activepage= document.getElementById(tokenid);
fdarr=split('_',activepage.value);
//+fdarr[0]+"/"+activepage.value
xmlHttp.open("GET","http://localhost:8080/payrollsystem/pim/pim_employee.php?q=1",true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}


</script>
	</head>
<body>


<div id="tabs">
<ul>
<li><table><tr><td><b><?php 
$activetablelinked=base64_decode($_GET['token']);
echo $_SESSION[$activetablelinked].'Details';
$activetablelinkedArray=explode('_',$activetablelinked);
$myfolder=$activetablelinkedArray[0];
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

print"<input type=\"hidden\" id=\"tokenid\" value=\"$activetablelinked\">";
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



///Create ESS details
$activetablelinked=base64_decode($_GET['token']);
$activetablelinked='leave_request';
echo $_SESSION[$activetablelinked].'Details';

function modifyDisplayESS($activetablelinked){
$essSQL="select tablefield from admin_tablerole where tablename='$activetablelinked' AND ess_view='Hide' order by ess_position ";

            $results_ess=mysql_query($essSQL);
	        $cnt_colsess=mysql_num_rows($results_ess);
			if($cnt_colsess>0){
			while($table_ess=mysql_fetch_array($results_ctrls)){
			   $tablefielddisplay=$table_ess['tablefield']; 
			  $activeTableArray[$tablefielddisplay]='hidden';} }
return $activeTableArray;
}

function modifyDisplayInputEss($activetablelinked){
 $essSQL="select tablefield,ess_view from admin_tablerole where tablename='$activetablelinked'  order by ess_position ";

            $results_ess=mysql_query($essSQL);
	        $cnt_colsess=mysql_num_rows($results_ess);
			
			if($cnt_colsess>0){
			while($table_ess=mysql_fetch_array($results_ctrls)){
			  $tablefielddisplay=$table_ess['tablefield']; 
			  $ess_view=$table_ess['ess_view'];

			  
			if($ess_view='Hide'	){
			$postValue[$tablefielddisplay]='';
			}
			else{
			$postValue[$tablefielddisplay]=$_POST["$tablefielddisplay"];
			}
	}
  }


return  $postValue;
}



if($_SESSION['isESS']){
$employee_id=$_SESSION['my_username_id'];
$activeTableArray=modifyDisplayESS($activetablelinked);
$postValue=modifyDisplayInputEss($activetablelinked);
}


///end of ess 


//Creating groups
?>
<?php
function dt_display_available_scheme_assign_options($drop_down_name , $drop_down_caption,$group_tbl  ,$group_name ,$group_id ){
echo("<table class='Stable_table'>");
echo("<tr bgcolor='#483B8D'> <th class='Stable_th' >Group Membership ");
print"<tr><td class='Stable_td'>";
build_db_table_list($drop_down_name ,$drop_down_caption,$group_tbl  ,$group_name , $group_id );  
print"</td ></tr>";

print"<tr><td >";
print "<P  class=\"date\"></p>";
print"<input  class=\"savebutton\"type=\"submit\"   size=\"6\" name=\"submit_button_$drop_down_name\" value=\"Save Group Members\"> ";
print "<P  class=\"date\"></p>";
print"</td ></tr>";
echo("</table>");
}
?><?php 
function submit_tiled_dt_details($drop_down_name,$insert_to_table){
	if (isset($_POST["num_found_contacts"])){
	$num_of_employees=$_POST["num_found_contacts"];

			if(isset($_POST["submit_button_$drop_down_name"])){
					for ($i=1;$i<=$num_of_employees;$i++){
			
						if (isset($_POST["checked_contact_id$i"])){
						$emp_details=trim($_POST["checked_contact_id$i"]);
						$effective_dt=date('Y-m-d');
						$group_id= trim($_POST["$drop_down_name"]);
						$dupsFound=-1;
									if(strlen($group_id)>0){
									$dupsFound=checkDupsGroups($emp_details,$group_id);
									}
									$insert_details="INSERT INTO `$insert_to_table` 
									VALUES ('','$emp_details','$group_id')";
									if (($dupsFound<=0)&&(strlen($group_id)>0)){
									$results=mysql_query($insert_details);
									
									}
			
							}
						}
				}
		}
}
?>
<?php 
//*************************************************
function displaySelectDetails($activetablelinked){
$headerfields=getHeaderDetails($activetablelinked);
//echo sizeof($headerfields);

$multidataColumns=LoadTableData($activetablelinked,$headerfields);
$rowid=1;
$tid=base64_encode($rowid);
?>

<input type="hidden" onClick="<?php echo "loadActiveTableAddDetails('".$tid."')";?>" value="clik here">
<?php if($multidataColumns){?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<thead><tr><?php


foreach ($headerfields as $fielddata){
 echo '<th width="20">'. $_SESSION[$activetablelinked.$fielddata].'</th>';
}
echo '<th width="20">'. 'Edit'.'</th>';
?></tr></thead>
<tbody>


<?php 
$numofrows=sizeof($multidataColumns);
for($i=0;$i<$numofrows;$i++){
  print"<tr class=\"gradeX\">"; 
  for($x=1;$x<=sizeof($headerfields);$x++){
   echo '<td width="20">'. $multidataColumns[$i][$x].'</td>';
 }
 $activetablefolder=explode('_',$activetablelinked);
/* echo '<td width="20">'. "<a href=\"../".$activetablefolder[0].'/'.$activetablelinked.'.php?q='.base64_encode($multidataColumns[$i][0]).'">'.'Edit'.'</a></td>';
*/ 
// echo '<td width="20">'. "<a href=\"#\" onclick=\"displayActivePage('".$multidataColumns[$i][0]."')\"".'>'.'Edit'.'</a></td>';
$recordid=$multidataColumns[$i][0];
//".$recordid."
echo '<td width="20">';
echo("<a href=\"#"."\" onclick=\"displayActivePage('pim_employee')\""." >");
echo("Edit");
echo("</a></td>");
print"</tr>";
}
//}
?></tr>
  <div id="additonalRows"></div>
</tbody>
</table>
<?php }else{
print "NO DATA ";
}
}//Mark end of displaySelectDetails function
?>
<?PHP 
function displayActiveTableRecords($activetablelinked){													
               $sql_available_rcds=$_SESSION[$activetablelinked.'_SearchSQL'];
               $results=mysql_query( $sql_available_rcds);                                          
				$cntreg=mysql_num_rows($results);  
	$cntreg_count=$cntreg;
			if ($cntreg_count>0){
	
	 }		
if ($cntreg>0){ 
$num_found_contacts=$cntreg;
print "<input type=\"text\"   name=\"num_found_contacts\" value=\"$num_found_contacts\"> ";                        
echo("<table width='98%' class='Stable_table'>"); 
echo("<tr class='Stable_th'>"); 		
print "<th> Phone Number </td >";
print "<th> Name </td >";      
print "<th>Email Address</td >";      
echo("</tr>");            
			$emp_count=0;          
			while($count=mysql_fetch_array($results)){                                   
			$emp_count++;  
			$em_num_row=$count['contact_id'];             $cphone=trim($count['phoneNumber']);                                               
	$em_name= ucwords($count['name']);
    $contact_id=$count['contact_id'];
	$emailadd=trim($count['emailAddress']);		            	
if(isset($emp_count)){
$even_row=$emp_count%2;
}

if($even_row<=0){

print ("<tr class='Stable_even_row'>");
}
if($even_row>0){
	print "<tr class='Stable_non_even_row'>";
	}
print"<td class='Stable_td'><input type=\"checkbox\"   checked=\"true\" size=\"11\" name=\"checked_contact_id$emp_count\" value=\"  $contact_id\">$cphone<td class='Stable_td'>$em_name </td><td class='Stable_td'>$emailadd</td>";
$selected_contact_id="'".$contact_id."',";
$selected_contact_id=$selected_contact_id.$selected_contact_id;
print"</tr>";
}

echo("<tr> <td>&nbsp;");
print"<tr><td>";

print" </td></tr>";
print" <tr><td><td>";
echo("</table>");

}

		
}

?>
</td></tr></table></li>
</ul>
<div id="tabs-1"> 
<tr>
      
      <td colspan="2"><p align="center">&nbsp;</p>
      </td>
    </tr>
 <div class="suggestionsBox" id="suggestions" style="display: none;">
 welccome
 <div class="suggestionList" id="autoSuggestionsList">
 </div></div>
 

<div id="container">
<div class="full_width big">
<div id="options_tab"><p><a href="../<?PHP $myfolder.'/'.$activetablelinked.'.php'; ?>" > Add </a> | <a href="#" > Statement </a>| <a href="../<?PHP $myfolder.'/'.$activetablelinked.'_options.php'; ?>" > Options </a> | <a href="../<?PHP $myfolder.'/'.$activetablelinked.'_pdf.php'; ?>" > PDF </a> | <a href="../home/view.php?token=<?PHP base64_encode($activetablelinked);?>" > View </a> |</p></div></div>

<?php $activetablelinkedArray=explode('_',$activetablelinked);
$myfolder=$activetablelinkedArray[0];
?>
<script>

function loadActiveTableAddDetails(tid){
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('tablecontentdetails').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
var s=document.getElementById('tokenid');
xd=s.value;
foldered=xd.split("_");
xmlHttp.open("GET","http://localhost:8080/payrollsystem/"+foldered[0]+"/"+s.value+".php?q="+tid,true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}

</script>
<div id="ReloadThis">

 </div>
 <div id="tablecontentdetails">
 </div>


<div id="demo">
<?php 
$headerfields=getHeaderDetails($activetablelinked);
//echo sizeof($headerfields);

$multidataColumns=LoadTableData($activetablelinked,$headerfields);
$rowid=1;
$tid=base64_encode($rowid);
?>

<input type="hidden" onClick="<?php echo "loadActiveTableAddDetails('".$tid."')";?>" value="clik here">
<?php if($multidataColumns){?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<thead><tr><?php


foreach ($headerfields as $fielddata){
 echo '<th width="20">'. $_SESSION[$activetablelinked.$fielddata].'</th>';
}
echo '<th width="20">'. 'Edit'.'</th>';
?></tr></thead>
<tbody>


<?php 
$numofrows=sizeof($multidataColumns);
for($i=0;$i<$numofrows;$i++){
  print"<tr class=\"gradeX\">"; 
  for($x=1;$x<=sizeof($headerfields);$x++){
   echo '<td width="20">'. $multidataColumns[$i][$x].'</td>';
 }
 $activetablefolder=explode('_',$activetablelinked);
/* echo '<td width="20">'. "<a href=\"../".$activetablefolder[0].'/'.$activetablelinked.'.php?q='.base64_encode($multidataColumns[$i][0]).'">'.'Edit'.'</a></td>';
*/ 
// echo '<td width="20">'. "<a href=\"#\" onclick=\"displayActivePage('".$multidataColumns[$i][0]."')\"".'>'.'Edit'.'</a></td>';
$recordid=$multidataColumns[$i][0];
//".$recordid."
echo '<td width="20">';
echo("<a href=\"#"."\" onclick=\"displayActivePage('pim_employee')\""." >");
echo("Edit");
echo("</a></td>");
print"</tr>";
}
//}
?></tr>
  <div id="additonalRows"></div>
</tbody>
</table>
<?php }else{
print "NO DATA ";
}?>
</div>
</div> 
</div>
</body>
</html>


