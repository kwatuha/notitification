<?php require_once('../Connections/cf4_HH.php'); ?>

<?php
$maxRows_Rcd_patientDetails = 4050;
$pageNum_Rcd_patientDetails = 0;
if (isset($_GET['pageNum_Rcd_patientDetails'])) {
  $pageNum_Rcd_patientDetails = $_GET['pageNum_Rcd_patientDetails'];
}
$startRow_Rcd_patientDetails = $pageNum_Rcd_patientDetails * $maxRows_Rcd_patientDetails;

$query_Rcd_users_table= "SELECT * FROM pim_employee";
$Rcd_users_table_results = mysql_query($query_Rcd_users_table) or die(mysql_error());

?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO pim_employee (employee_name, DOB, gender, effective_date) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['employee_name'], "text"),
                       GetSQLValueString($_POST['DOB'], "date"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['effective_date'], "date"));

 
  $Result1 = mysql_query($insertSQL) or die(mysql_error());
}
?><!DOCTYPE html>
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
function showList(diveid){
var activelist= document.getElementById(diveid)
activelist.style.visibility="visible";

}

//Add columns dynamically

function addNewColumns(){
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
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost:8080/ampath/addcolumns.php",true);
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
<li><table><tr><td><b>Manage Employees</b></td></tr></table></li>
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
<div id="options_tab"><p><a href="#" onClick="addNewColumns();hideList('demo')"> Add </a> | <a href="#" onClick="Ajax();hideList('demo')"> Stment </a>| <a href="#" onClick="Ajax()"> Options </a> | <a href="#" onClick="Ajax();hideList('demo')"> PDF </a> | <a href="#" onClick="showList('demo')"> View </a> | <a href="#" onClick="showList('demo')">  All </a></p></div></div>


<div id="ReloadThis">

 </div>

<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
<thead><tr><?php
//echo '<th>'.'user_id'.'</th>';
echo '<th width="20px">'.'employee_id'.'</th>';
echo '<th width="20px">'.'employee_name'.'</th>';
echo '<th width="20px">'.'DOB'.'</th>';
echo '<th width="20px">'.'gender'.'</th>';
echo '<th width="20px">'.'effective_date'.'</th>';
echo '<th width="20px">'.'Edit'.'</th>';
echo '<th width="20px">'.'Delete'.'</th>';

?></tr></thead>
<tbody>
<?php do { ?>
<tr class="gradeX"> 
<?php 
/*foreach ($row_Rcd_users_table_array as $item){
print '<td>'.$item.'</td>';
}*/
//print '<td>'.$row_Rcd_users_table_array['user_id'].'</td>';
print '<td width="20px">'.$row_Rcd_users_table_array['employee_id'].'</td>';
print '<td width="20px">'.$row_Rcd_users_table_array['employee_name'].'</td>';
print '<td width="20px">'.$row_Rcd_users_table_array['DOB'].'</td>';
print '<td width="20px">'.$row_Rcd_users_table_array['gender'].'</td>';
print '<td width="20px">'.$row_Rcd_users_table_array['effective_date'].'</td>';
print '<td width="20px">'."<a href=\"#\">Edit</a>".'</td>';
print '<td width="20px">'.Delete.'</td>';
//<img src=\"images/btn_edit.gif\" alt=\"\" />
?></tr>
 <?php } while ($row_Rcd_users_table_array = mysql_fetch_array($Rcd_users_table_results)); ?>
 <div id="additonalRows"></div>
</tbody>
</table>

</div>
</div>
 
</div>




</DIV>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <style type="text/css">
body {
	margin: 10px auto;
	font: 75%/120% Verdana,Arial, Helvetica, sans-serif;
}
.menu_list {	
	width: 150px;
	font: 75%/120% Verdana,Arial, Helvetica, sans-serif;
}
.menu_head {
	padding: 5px 10px;
	cursor: pointer;
	position: relative;
	margin:1px;
    font-weight:bold;
    background: #eef4d3 url(images/left.png) center right no-repeat;
}
.menu_body {
	display:none;
}
.menu_body a{
  display:block;
  color:#006699;
  background-color:#EFEFEF;
  padding-left:1px;
  font-weight:bold;
  text-decoration:none;
}
.menu_body a:hover{
  color: #000000;
  text-decoration:underline;
  }
</style> 



<h2 class="demoHeaders">&nbsp;</h2>
	<h2 class="demoHeaders">&nbsp;</h2>
</body>
</html>


