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
<script language="JavaScript" src="../template/functions/currentinsertjs.js"></script>
<script language="JavaScript" src="../template/js/dtpicker.js"></script>



<script type="text/javascript" src="scripts/archive.js"></script>
<script type="text/javascript" src="lib/common/xajax/xajax_js/xajax.js"></script>
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/fonts/fonts.css">
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/container/assets/container.css">
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/button/assets/button.css">
<script type="text/javascript" src="../template/scripts/yui/yahoo/yahoo-min.js"></script>
<script type="text/javascript" src="../template/scripts/yui/event/event-min.js"></script>
<script type="text/javascript" src="../template/scripts/yui/dom/dom-min.js"></script>
<script type="text/javascript" src="../template/scripts/yui/container/container-min.js"></script>
<script type="text/javascript" src="../template/scripts/yui/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="../template/scripts/yui/element/element-beta-min.js"></script>
<script type="text/javascript" src="../template/scripts/yui/animation/animation-min.js"></script>
<script type="text/javascript" src="../template/scripts/yui/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript" src="../template/scripts/time.js"></script>





<!--[if IE]>
<script type="text/javaScript">
	tableDisplayStyle = "block";
</script>
<![endif]-->
<script type="text/javascript" src="../template/functions/coreSharedJavascript.js"></script>
<script type="text/javascript" src="../template/themes/Smart/scripts/style.js"></script>
<link href="../template/themes/Smart/css/style.css" rel="stylesheet" type="text/css">
<!--[if lte IE 6]>
<link href="../template/themes/Smart/css/IE6_style.css" rel="stylesheet" type="text/css"/>
<![endif]-->
<!--[if IE]>
<link href="../template/themes/Smart/css/IE_style.css" rel="stylesheet" type="text/css"/>
<![endif]-->
<style type="text/css">
    <!--

	:disabled:not([type="image"]) {
		background-color:#FFFFFF;
		color:#444444;
	}

	/*input[type=text] {

        border-top-width: 0px;
        border-left: 0px;
        border-right: 0px;
        border-bottom: 1px solid #888888;
    }  */

    table.historyTable th {
        border-width: 0px;
        padding: 3px 3px 3px 5px;
        text-align: left;
    }
    table.historyTable td {
        border-width: 0px;
        padding: 3px 3px 3px 5px;
        text-align: left;
    }

	input.fileselect {
		margin:8px 0px 4px 10px;
	}

    .locationDeleteChkBox {
        padding:2px 4px 2px 4px;
        border-style: solid;
        border-width: thin;
        display:block;
    }

	.pimpanel {
	    position:absolute;
	    left:-9999px;
	}
	.currentpanel {
		margin-top: 10px;
	    left:190px;
	}
	#photodiv {
		margin-top:19px;
	    float:left;
	    text-align:center;
	    margin-left: 650px;
	    padding: 2px;
	    border: 1px solid #FAD163;
	}
	#photodiv span {
	    color: black;
	    font-weight: bold;
	}

	#empname {
	    display:block;
	    color: black;
	}

	#personalIcons,
	#employmentIcons,
	#qualificationIcons {
	    display:block;
	    position:absolute;
	    left:-999px;
	   	width:400px;
	   	text-align:center;
	   	padding-left:100px;
	   	padding-right:100px;
	}

	#icons div a {
	    display:block;
	    float:left;
		height: 50px;
		width: 54px;
	    text-decoration:none;
		text-align:center;
	    vertial-align:bottom;
		padding-top: 45px;
		outline: 0;
		background-position: top center;
		margin-left:8px;
		margin-right:8px;
	}

	#icons div a:hover {
	    color: black;
	    text-decoration: underline;
	}

	#icons div a.current {
	    font-weight: bold;
	    color:black;
	    cursor:default;
	}

	#icons div a.current:hover {
	    color:black;
	    text-decoration:none;
	}

	#icons {
	    display:block;
	    clear:both;
	    margin-left: 130px;
	    margin-top: 5px;
	    margin-bottom: 2px;#FAD163
	    width:500px;
		height: 60px;
	}
	#pimleftmenu {
	    display:block;
	    float: left;
	    background: #FFFBED;
	    padding: 2px 2px 2px 2px;
	    margin: 10px 0px 0px 5px;
	}
	#pimleftmenu ul {
	    list-style-type: none;
	    padding-left: 0;
	    margin-left: 0;
	    width: 12em;
	}

	#pimleftmenu ul.pimleftmenu li {
	    list-style-type:none;
	    margin-left: 0;
	    margin-bottom: 1px;
		padding-left:5px;
	}

	#pimleftmenu ul li.parent {
	    padding-left: 0px;
	    padding-top:4px;
	    font-weight: bold;
	}

	#pimleftmenu ul.pimleftmenu li a {
	    display:block;
	    outline: 0;
		padding: 2px 2px 2px 4px;
		text-decoration: none;
		background:#FAD163 none repeat scroll 0 0;
		border-color:#CD8500 #8B5A00 #8B5A00 #CD8500;
		border-style:solid;
		border-width:1px;
		color:#d87415;
		font-size: 11px;
		font-weight:bold;
		text-align: left;
	}
	#pimleftmenu ul.pimleftmenu li a:hover {
		color: #FFFBED;
		background-color: #e88d1e;
	}

	#pimleftmenu ul.pimleftmenu li a.current {
		color: #FFFBED;
		background-color: #e88d1e;
	}

	#pimleftmenu ul.pimleftmenu li a.collapsed,
	#pimleftmenu ul.pimleftmenu li a.expanded {
	    display:block;
	    outline: 0;
		padding: 2px 2px 2px 4px;
		text-decoration: none;
		border: 0 ;
		color: #CC6600;
		font-size: 11px;
		font-weight:bold;
		text-align: left;
	}

	#pimleftmenu ul.pimleftmenu li a.expanded {
		background: #FFFBED url(../template/themes/Smart/icons/expanded.gif) no-repeat center right;
	}

	#pimleftmenu ul.pimleftmenu li a.collapsed {
		background: #FFFBED url(../template/themes/Smart/icons/collapsed.gif) no-repeat center right;
		border-bottom: 1px solid #d87415;
	}

	#pimleftmenu ul.pimleftmenu li a.collapsed:hover span,
	#pimleftmenu ul.pimleftmenu li a.expanded:hover span {
		color: #8d4700;
	}


	#pimleftmenu ul span {
	    display:block;
	}

	#pimleftmenu li.parent span.parent {
		color: #CC6600;
	}

	#pimleftmenu ul span span {
	    display:inline;
	    text-decoration:underline;
	}

	div.requirednotice {
	    margin-left: 15px;
	}

	#parentPaneDependents {
	    float:left;
		width: 50%;
	}

	#parentPaneChildren {
	    float:left;
	    width: 50%;
	}
    -->
</style>
<!--[if IE]>
<style type="text/css">

	/* following style may not be needed */
	#pimleftmenu ul.pimleftmenu {
	    height:auto;
	}

	/* Give layout in IE (hasLayout) */
	#pimleftmenu a {
	    zoom: 1;
	}

</style>
<![endif]-->

</head><body class=""><div style="height: 372px; width: 1024px; display: none;" id="wait_mask" class="mask">&nbsp;</div>
<script type="text/javaScript"><!--//--><![CDATA[//><!--
  YAHOO.SmartHRM.container.init();
//--><!]]></script><div style="z-index: 9001; left: 391px; top: 160px; visibility: hidden;" id="wait_c" class="yui-panel-container shadow"><div style="visibility: inherit; width: 240px;" class="yui-module yui-overlay yui-panel" id="wait"><div style="cursor: auto;" class="hd">Loading, please wait...</div><div class="bd"><img src="../template/themes/beyondT/pictures/ajax-loader.gif"></div></div><div class="underlay"></div></div><iframe style="border-width: 0pt; position: absolute; visibility: visible; width: 10em; height: 10em; top: -120px; left: -120px;" id="_yuiResizeMonitor" src="data:text/html;charset=utf-8,%3Chtml%3E%3Chead%3E%3Cscript%20type%3D%22text%2Fjavascript%22%3Ewindow.onresize%3Dfunction%28%29%7Bwindow.parent.YAHOO.widget.Module.textResizeEvent.fire%28%29%3B%7D%3Bwindow.parent.YAHOO.widget.Module.textResizeEvent.fire%28%29%3B%3C%2Fscript%3E%3C%2Fhead%3E%3Cbody%3E%3C%2Fbody%3E%3C%2Fhtml%3E"></iframe>

<div style="display: none;" class="yui-calcontainer single withtitle" id="cal1Container"><a class="link-close" href="#"><span class="close-icon calclose"></span></a></div>
<div id="status" style="display: none;" align="right"><img src="../template/themes/beyondT/icons/loading.gif" alt="" style="vertical-align: bottom;" width="20" height="20"> <span style="vertical-align: text-top;">Loading Page...</span></div>


<link type="text/css" href="../viewdesign/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../viewdesign/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../viewdesign/js/jquery-ui-1.8.16.custom.min.js"></script>
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
		<style type="text/css">
.menucustompostion
{
position:absolute;
left:2px;
top:150px;
}
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

</head>
<body>
<div class="navigation">
	<input class="backbutton" value="Back" onClick="goBack()" type="button">
</div>
<table border="0" width="95%">
<tr><td  width="20%">

<div class="menucustompostion">
<div class="menu_body"><div id="activemenu"></div>
</div>
</div>
	<?php print_ajax_search_box();?>
</td width="60%">
<td>
<div id="tabs">
<?php 
/*if($_SESSION['isESS']){
echo $_SESSION['isESSMenu'];
$r=strpos('leave_request',$_SESSION['isESSMenu']);

}
else{
*/
include('../template/functions/topMenu.php');
/*}

echo "<li><a href=\"#tabs-6\" >Reports</a></li>
<li><a href=\"#tabs-7\" >Analysis</a></li>
<li><a href=\"#tabs-8\" >Help</a></li>
</ul>";*/
?>