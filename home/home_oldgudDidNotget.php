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
include('../template/functions/menuLinks.php');
include('../template/functions/insertSQL.php');
include('../template/functions/folderlinks.php');
include('../template/functions/searchSQL.php');
include('../template/functions/updateSQL.php');
?><?php
$requestcode= base64_decode(trim($_GET['r']));
if($requestcode=='ESS'){
$where=" WHERE employee_id=".$_SESSION['my_username_id'];
}


$maxRows_Rcd_patientDetails = 4050;
$pageNum_Rcd_patientDetails = 0;
if (isset($_GET['pageNum_Rcd_patientDetails'])) {
  $pageNum_Rcd_patientDetails = $_GET['pageNum_Rcd_patientDetails'];
}
$startRow_Rcd_patientDetails = $pageNum_Rcd_patientDetails * $maxRows_Rcd_patientDetails;

$query_Rcd_users_table= "SELECT * FROM pim_employee".$where;
$Rcd_users_table_results = mysql_query($query_Rcd_users_table) or die(mysql_error());

?>
<?php
//echo $_SESSION['currentusergroup'];
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../template/images/style.css" />
	<link rel="stylesheet" href="../template/images/dtpicker.css" type="text/css" />
<script language="JavaScript" src="../template/js/calendarDateInput.js"></script>
<script language="JavaScript" src="../template/js/dtpicker.js"></script>


<link type="text/css" href="../viewdesign/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../viewdesign/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../viewdesign/js/jquery-ui-1.8.16.custom.min.js"></script>
<script language="javascript">
function lookup_admin_role(role_id) {
    if(role_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_role.php", {queryString: ""+role_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_role   lookup




function fill_role_id(thisValue) {
	
    $('#role_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenrole_id(thisValue) {
	
    $('#role_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_admin_status(statustypestatus_id) {
    if(statustypestatus_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_status.php", {queryString: ""+statustypestatus_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_status   lookup




function fill_statustypestatus_id(thisValue) {
	
    $('#statustypestatus_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenstatustypestatus_id(thisValue) {
	
    $('#statustypestatus_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_admin_statustype(statustype_id) {
    if(statustype_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_statustype.php", {queryString: ""+statustype_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_statustype   lookup




function fill_statustype_id(thisValue) {
	
    $('#statustype_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenstatustype_id(thisValue) {
	
    $('#statustype_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_admin_user(id_id) {
    if(id_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_user.php", {queryString: ""+id_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_user   lookup




function fill_id(thisValue) {
	
    $('#id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenid(thisValue) {
	
    $('#idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_admin_usergroup(usergroup_id) {
    if(usergroup_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_usergroup.php", {queryString: ""+usergroup_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_usergroup   lookup




function fill_usergroup_id(thisValue) {
	
    $('#usergroup_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenusergroup_id(thisValue) {
	
    $('#usergroup_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_attendance_event(event_id) {
    if(event_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../attendance/rpcattendance_event.php", {queryString: ""+event_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // attendance_event   lookup




function fill_event_id(thisValue) {
	
    $('#event_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenevent_id(thisValue) {
	
    $('#event_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_attendance_holiday(holiday_id) {
    if(holiday_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../attendance/rpcattendance_holiday.php", {queryString: ""+holiday_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // attendance_holiday   lookup




function fill_holiday_id(thisValue) {
	
    $('#holiday_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenholiday_id(thisValue) {
	
    $('#holiday_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_comp_assign(assign_id) {
    if(assign_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../comp/rpccomp_assign.php", {queryString: ""+assign_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // comp_assign   lookup




function fill_assign_id(thisValue) {
	
    $('#assign_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenassign_id(thisValue) {
	
    $('#assign_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_comp_comp(comp_id) {
    if(comp_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../comp/rpccomp_comp.php", {queryString: ""+comp_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // comp_comp   lookup




function fill_comp_id(thisValue) {
	
    $('#comp_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddencomp_id(thisValue) {
	
    $('#comp_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_comp_details(details_id) {
    if(details_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../comp/rpccomp_details.php", {queryString: ""+details_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // comp_details   lookup




function fill_details_id(thisValue) {
	
    $('#details_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddendetails_id(thisValue) {
	
    $('#details_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_leave_leave(leave_id) {
    if(leave_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../leave/rpcleave_leave.php", {queryString: ""+leave_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // leave_leave   lookup




function fill_leave_id(thisValue) {
	
    $('#leave_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenleave_id(thisValue) {
	
    $('#leave_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_pim_dept(dept_id) {
    if(dept_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../pim/rpcpim_dept.php", {queryString: ""+dept_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // pim_dept   lookup




function fill_dept_id(thisValue) {
	
    $('#dept_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddendept_id(thisValue) {
	
    $('#dept_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_pim_employee(employee_id) {
    if(employee_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../pim/rpcpim_employee.php", {queryString: ""+employee_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // pim_employee   lookup




function fill_employee_id(thisValue) {
	
    $('#employee_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenemployee_id(thisValue) {
	
    $('#employee_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_pim_location(location_id) {
    if(location_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../pim/rpcpim_location.php", {queryString: ""+location_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // pim_location   lookup




function fill_location_id(thisValue) {
	
    $('#location_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenlocation_id(thisValue) {
	
    $('#location_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script><script language="javascript">
function lookup_transport_vehicle(vehicle_id) {
    if(vehicle_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../transport/rpctransport_vehicle.php", {queryString: ""+vehicle_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // transport_vehicle   lookup




function fill_vehicle_id(thisValue) {
	
    $('#vehicle_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenvehicle_id(thisValue) {
	
    $('#vehicle_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script>
<script type="text/javascript" src="../viewdesign/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../viewdesign/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
				$('#tabs2').tabs();
	            $('#tabsinnermain').tabs();
				
				$('#topmenubar').tabs();
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

function loadOtherDetails(activetablename){
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
		document.getElementById(activetablename).innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost:8080/clockplus/home/"+activetablename+".php",true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}


function loadActiveMenuDetails(activemenutab){
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
		document.getElementById('activemenu').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost:8080/clockplus/menu/menutab.php?q="+activemenutab,true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}

function loadActiveTableAddDetails(activemtable,fld){

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
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost:8080/clockplus/"+fld+"/"+activemtable,true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}


function loadDefaultTableAddDetails(activemtable,fld){

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
		
	}
}

xmlHttp.open("GET","http://localhost:8080/clockplus/"+fld+"/"+activemtable+'.php',true);
xmlHttp.send(null);
}

window.onload=function(){
	
}


function loadInfo(activetable,fld){

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
	var tb=activetable;
	tbarr=tb.split('_');
		document.getElementById(tbarr[0]).innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost:8080/clockplus/"+tbarr[0]+"/"+activetable+'.php',true);
xmlHttp.send(null);
}

window.onload=function(){
	
}
</script>

	</head>
<body>


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


<table border="2">
<tr><td valign="middle"><div id="firstpane" class="menu_list"> <!--Code for menu starts here-->
		<p class="menu_head">Menu</p>
		<div class="menu_body"><div id="activemenu"></div>
		</div>
	</div> <p>
	Search box 77777777777777777777777777<?php print_ajax_search_box();?>
</td>
<td>
<div id="tabs2"  width="1000px"> 
<?php 


if($_SESSION['isESS']){
echo $_SESSION['isESSMenu'];
$r=strpos('leave_request',$_SESSION['isESSMenu']);

}
else{

include('../template/functions/topMenu.php');
}
echo "<li><a href=\"#tabs-1\" >Reports</a></li>
<li><a href=\"#tabs-1\" >Analysis</a></li>
<li><a href=\"#tabs-1\" >Help</a></li>
</ul>";
?>
<div id="tabs-1">
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>

<div id="tabs-2">
    *  admin
    


<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>

<div id="tabs-2">
* attendance
  
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>


<div id="tabs-3">
  * comp
    
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>

<div id="tabs-4">
* leave
    
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>

<div id="tabs-5">
* pim
   
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>

<div id="tabs-6">
 * Reports
    
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>

<div id="tabs-7">
* Analysis
  
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>

  <div id="tabs-8">
* Help
  
<table width="20%" border="5" bordercolor="#993366">
  <tr>
    <td width="70%" valign="top">
	<div id="tablecontentdetails">
	</div>
	</td></tr>
	<tr>
	<td bgcolor="#0066CC" bordercolor="#CC0066">zz</td>
  </tr>
</table>
</div>
</div>
</td></tr></table>
</body>
</html>


