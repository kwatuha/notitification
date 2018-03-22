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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">


<html>
<head>

   
	

<script src="../template/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="../viewdesign/js/jquery-ui-1.8.16.custom.min.js"></script>
	
<script type="text/javascript" src="../template/functions/coreSharedJavascript.js"></script>
<script type="text/javascript" src="../template/functions/window.js"></script>

<script type="text/javascript" src="../template/themes/Smart/scripts/style.js"></script>
<script language="JavaScript" src="../template/js/calendarDateInput.js"></script>
<script language="JavaScript" src="../template/functions/currentinsertjs.js"></script>
<script language="JavaScript" src="../template/functions/currentOptions.js"></script>
<script language="JavaScript" src="../template/functions/menuDisplayGroups.js"></script>
<script language="JavaScript" src="../template/js/dtpicker.js"></script>
     
	
    <script src="../template/ui/jquery.ui.core.js"></script>
	<script src="../template/ui/jquery.ui.widget.js"></script>
	<script src="../template/ui/jquery.ui.mouse.js"></script>
	<script src="../template/ui/jquery.ui.draggable.js"></script>
	<script src="../template/ui/jquery.ui.droppable.js"></script>



<script src="../viewdesign/dev/ui/jquery.ui.button.js"></script>
<script src="../viewdesign/dev/ui/jquery.ui.position.js"></script>
<script src="../viewdesign/dev/ui/jquery.ui.resizable.js"></script>
<script src="../viewdesign/dev/ui/jquery.ui.dialog.js"></script>
<script src="../viewdesign/dev/ui/jquery.effects.core.js"></script>
<script type="text/javascript" src="comodo.js"></script>
<script type="text/javascript" src="ignore.js"></script>
<script type="text/javascript" language="javascript" src="../media/js/jquery.dataTables.js"></script>

<style>
	#draggable { width: 150px; height: 150px; padding: 0.5em; }
	</style>
<style>
	.toggler { width: 500px; height: 200px; }
	#button { padding: .5em 1em; text-decoration: none; }
	#effect { width: 240px; height: 135px; padding: 0.4em; position: relative; }
	#effect h3 { margin: 0; padding: 0.4em; text-align: center; }
</style>
<script>
	/*$(function() {
		// run the currently selected effect
		function runEffect() {
			// get effect type from 
			var selectedEffect = 'Clip';

			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if ( selectedEffect === "scale" ) {
				options = { percent: 100 };
			} else if ( selectedEffect === "size" ) {
				options = { to: { width: 280, height: 185 } };
			}

			// run the effect
			$( "#effect" ).show( selectedEffect, options, 500, callback );
			displayNotifionIntroMsg();
		};

		//callback function to bring a hidden box back
		function callback() {
		
			setTimeout(function() {
				$( "#effect:visible" ).removeAttr( "style" ).fadeOut();
			}, 10000 );
		};

		// set effect from select menu value
		$(document).ready(function()  {
			runEffect();
			displayNotifionIntroMsg();
			return false;
		});

		$( "#effect" ).hide();
	});
	
	
	
	//$(document).ready(function()*/ 
	</script>
<script>
function positionDIVElem(elemid){
	$(function() {
		$( '#'+elemid ).draggable();
		$('#tabs').mousemove(function(e){
       $('#currentpositionCt').val(e.pageX +'|'+ e.pageY);
      });
	  
	  }); 
   
}

function displayModifiedPosition(elemid,leftoffset,topoffset){

//$("#"+elemid).offset({left:leftoffset,top:topoffset});
}
function saveCurrentContrlPosition(activetable,currentcontrol,utype){
var currentpos=document.getElementById('currentpositionCt').value;
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
		document.getElementById('updateclient'+activetable).innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","saveCurrentCTLPosition.php?ctl="+currentcontrol+'&position='+currentpos+'&t='+activetable+'&act='+utype,true);
xmlHttp.send(null);
}
</script>
<?php
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

<link rel="stylesheet" type="text/css" href="../template/images/style.css" />
<link rel="stylesheet" href="../template/themes/Smart/css/customCSSfortables.css" />
<link rel="stylesheet" href="../template/images/dtpicker.css" type="text/css" />
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/fonts/fonts.css">
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/container/assets/container.css">
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/button/assets/button.css">
<!--[if IE]>
<script type="text/javaScript">
	tableDisplayStyle = "block";
</script>
<![endif]-->

<link href="../template/themes/Smart/css/style.css" rel="stylesheet" type="text/css">

<link href="../template/rpc/CSS/suggestionsDIV.css" rel="stylesheet" type="text/css">
<!--[if lte IE 6]>
<link href="../template/themes/Smart/css/IE6_style.css" rel="stylesheet" type="text/css"/>
<![endif]-->
<!--[if IE]>
<link href="../template/themes/Smart/css/IE_style.css" rel="stylesheet" type="text/css"/>
<![endif]-->
<style type="text/css">
    <!--

  .showFlashMSG {
		right:0px; 
		bottom:0px; 
		padding:2px; 
		font-size:10px;
		 border: thin; 
		 background: #cc9966; 
height:100; width:105; 
position:absolute;   
font z-index:10;
font-family:Arial, Helvetica, sans-serif; 
font-size:12px;
<!--border-bottom: 1px solid #888888;-->
	}


   .hideFlashMSG {
   	visibility:collapse;
	border-top: 0px;
		border-left: 0px;
		border-right: 0px;
	border-bottom: 1px solid #888888;
	}
	:disabled:not([type="image"]) {
		background-color:#FFFFFF;
		color:#444444;
	}

	/*input[type=text] {
		border-top: 0px;
		border-left: 0px;
		border-right: 0px;
		border-bottom: 1px solid #888888;
	}
	
	input[type=password] {
		border-top: 0px;
		border-left: 0px;
		border-right: 0px;
		border-bottom: 1px solid #888888;
	}*/
 
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

 
<div style="display: none;" class="yui-calcontainer single withtitle" id="cal1Container"><a class="link-close" href="#"><span class="close-icon calclose"></span></a></div>
<div id="status" style="display: none;" align="right"><img src="../template/themes/beyondT/icons/loading.gif" alt="" style="vertical-align: bottom;" width="20" height="20"> <span style="vertical-align: text-top;">Loading Page...</span></div>


<link type="text/css" href="../viewdesign/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

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
left:4px;
top:100px;

}

.photoposition
{
position:absolute;
left:640px;
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
					alert(aTrs[i]);
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
/*$(document).ready(function()
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
*/

///////////////////////////////////////////////////////////////////

</script>
 <script type="text/javascript">  
    /* floatingMenu.add('floatdiv',  
         {  
             // Represents distance from left or right browser window  
            // border depending upon property used. Only one should be  
             // specified.  
             // targetLeft: 0,  
             targetRight: 100,  
   
             // Represents distance from top or bottom browser window  
             // border depending upon property used. Only one should be  
             // specified.  
             targetTop: 450,  
             // targetBottom: 0,  
   
             // Uncomment one of those if you need centering on  
             // X- or Y- axis.  
             // centerX: true,  
             // centerY: true,  
   
             // Remove this one if you don't want snap effect  
             snap: true  
         });  
		 weath*/
 </script>
 
 <script type="text/javascript">
            $(document).ready(function(){
                $('#test').load('sendSMS.php', '', function(response, status, xhr) {
                    if (status == 'error') {
                        var msg = "Sorry but there was an error: ";
                        $(".content").html(msg + xhr.status + " " + xhr.statusText);
                    }
                });
            });
			
</script>
<script>
	/*$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//llFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-user" )
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
			$( "#Billing" )
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
			$( "#Billing" )
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
	});
*/	
$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 450,
			width: 200,
			modal: true,
			buttons: {
				   
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//llFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
      
			
			$( "#userightsdisplay" )
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				 displayRightsOptions('filldata','primary','NoId');
				 //$('#dialog-form').css({height: "600px", width: "800px"});

			});
			
			$( "#sysconfghtsdisplay" )
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				displaySubSections('filldata');
			});
			$( "#actionNotificationHist" )
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				saveNotificationDetailsStatus();
			});
			
			});
			
			function closeDialog(){
			$(  "#dialog-form" ).dialog( "close" );
			/*var dialoghtml=document.getElementById('dialog-form');
			dialoghtml.innerHTML='';*/
			
			}
			function openDialog(currenttable){
			
			$( "#dialog-form" ).dialog( "open" );
				//fillthisdiv();
				viewDetails(currenttable);
			}
			
			function openOptions(currenttable){
			
			/*$('#dialog-form').css({height: "600px", width: "800px"});
			$('#filldata').css({height: "600px", width: "800px"});*/
///////////////
 
                  // $("#dialog-form").dialog({ width: $(window).width(), height: $(window).height(), resizable: false });


/////

				 //$("#dialog-form").css({'max-height': 10, 'overflow-y': 'auto'});
				 //$('#dialog-form').css({height: "1400px", width: "2000px"});
				 $( "#dialog-form" ).dialog( "open" );
				//fillthisdiv();
				
				displayConfigOptions(currenttable);
			}
			
///////////////////
			$( "#optionsmodal" ).dialog( "destroy" );
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 450,
			width: 200,
			modal: true,
			buttons: {
				   
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				//llFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
			</script>
<script language="JavaScript" src="../template/functions/modalscripts.js"></script>
    <style type="text/css">
        .x-panel-body p {
            margin: 10px;
            font-size: 12px;
        }
    </style>
	<!-- page specific -->
    <style type="text/css">
        /* style rows on mouseover */
        .x-grid-row-over .x-grid-cell-inner {
            font-weight: bold;
        }
        /* shared styles for the ActionColumn icons */
        .x-action-col-cell img {
            height: 16px;
            width: 16px;
            cursor: pointer;
        }
        /* custom icon for the "buy" ActionColumn icon */
        .x-action-col-cell img.buy-col {
            background-image: url(../sview/shared/icons/fam/accept.png);
        }
        /* custom icon for the "alert" ActionColumn icon */
        .x-action-col-cell img.alert-col {
            background-image: url(../sview/shared/icons/fam/error.png);
        }

        .x-ie6 .x-action-col-cell img.buy-col {
            background-image: url(../sview/shared/icons/fam/accept.gif);
        }
        .x-ie6.x-action-col-cell img.alert-col {
            background-image: url(../sview/shared/icons/fam/error.gif);
        }

        .x-ie6 .x-action-col-cell img {
            position:relative;
            top:-1px;
        }
    </style>
   
   
	<!--<script type="text/javascript" src="alert.js"></script>
	<script type="text/javascript" src="employeedata.js"></script>
	<!--
	<script type="text/javascript" src="grid_arr.js"></script>
	<script type="text/javascript" src="grid_original.js"></script>-->
	<script>
	var rsptext;
	</script>
	<script type="text/javascript" src="../template/functions/check_worked.js"></script>
<script>

//End of ext integreation


//////////////////

///Tool bars
Ext.create('Ext.panel.Panel', {
    width: 500,
    height: 800,
	expandable:true,
    renderTo: document.body,
    title: 'A Panel',
	html:'What is the work',
    tools: [{
        type: 'help',
        handler: function(){
            // show help here
        }
    },
	
	///ll
	{
        type: 'minimize',
        handler: function(){
            // show help here
        }
    },
	///ll
	///ll
	{
        type: 'maximize',
        handler: function(){
            // show help here
        }
    },
	///ll
	
	
	{
        itemId: 'refresh',
        type: 'refresh',
        hidden: true,
        handler: function(){
            // do refresh
        }
    }, {
        type: 'search',
        handler: function(event, target, owner, tool){
            // do search
            owner.child('#refresh').show();
        }
    }]
});


//*************************
</script>
</head>

<body background="<img src='../sview/desktop/wallpapers/desk.jpg'>" onLoad="showHidConfDIV('viewconfig','hide');showHidConfDIV('hiddencontrolls','hide');  ">
<input type="button" id="show-btn" value="Layout Window"/>
<div id="kwatuha" >
<a href="#" onClick="runEXT('kwatuha','show-btndd')"> ttest the script</a>
<table>
<tr><td> Four help </td><td><input type="text" id="dd" value=""/></td></tr>
<tr><td> four </td><td><input type="text" id="dd" value=""/></td></tr>
<tr><td> two </td><td><input class="savebutton" type="button" id="show-btnd" value="Layout Window"/></td></tr>
<tr><td>one </td><td><input class="savebutton" type="button" id="show-btndd" value="Layout Window"/></td></tr>
</table>

</div>

<div class="slogan" style="top:80px; left:200; width:200;"  ><a id="actionNotificationHist" href="#">Inbox </a>|&nbsp;<a id="sysconfghtsdisplay" href="#">Sys Conf </a>|&nbsp;<a id="userightsdisplay" href="#"> User Rights </a></div> 

<table border="0" width="95%">
<tr><td  width="20%">

<div class="menucustompostion" >
<div class="menu_body"><div id="activemenu"></div>
</div>
<?php


/*style=\"  
    position:absolute;  
     width:200px;height:50px;top:120px;right:20px;
	  border:2px solid #2266AA;  
     z-index:120\"
*/ 
?>

<?php // print_ajax_search_box();?>
</td width="60%">
<td>
<div style=" background: #CCCCCC; font-size:10px; height:20px ">Welcome <?php echo $_SESSION['my_username']; ?>&nbsp;<a href="../logs/logout.php"> Log Out </a></div>
<div id="tabs" style="top:5px;">
<?php 
//include('../template/functions/topMenu.php');

buildlangTopMenuLinksDetailsV2();
//echo $detailss;
?>
<script>
//createMainMenu('2','ptabs','tmenu') ;//ttabs
//createMainMenu('2','menubodytabs','ttabs') ;//

</script>
<?php 
//include('../template/functions/hometabs.php');
?>
</div>
<?php 
$attachfile="cv";
$caption='attachmentsDoc';
$other='other';
$attachfor='usergroup';
$folder='attachmentsDoc';
$displayDiv='activemenu';

///$temporryLoc=addAttachment($attachfile,$caption,$other,$attachfor);
//echo getactualfile($folder,$name);     
function addAttachment($attachfile,$caption,$other,$attachfor){
print"<input name=\"".$attachfile."\" type=\"file\" id=\"".$attachfile."\" />";
print"usergroup<input name=\"".$attachfor."\" type=\"text\" id=\"".$attachfor."\" />";
$attachmentLoc = $target_path . trim(basename( $_FILES[$name]['name'])); 
$attachment=str_replace(' ','_',$attachmentLoc);

$temporryLoc=$_FILES[$attachfile]['tmp_name'];
return $temporryLoc;
}

/*function getactualfile($folder,$name){
if(!is_dir($folder)){
	  mkdir($folder);
}

         $target_path = "$folder/";
         $attachmentLoc = $target_path . trim(basename( $_FILES[$name]['name'])); 
		$attachment=str_replace(' ','_',$attachmentLoc);
         move_uploaded_file($_FILES[$name]['tmp_name'], $attachment);

}
*/
//print"<input name=\"$name\" type=\"button\"  value=\"savbutton\" onclick=\"saveFileAttachment('".$attachfile."','".$temporryLoc."','".$folder."','".$attachfor."','".$displayDiv."')\" />";
//echo "saveFileAttachment('".$filename."','".$folder."','".$attachfor."','".$displayDiv;
?>
</td></tr></table><!--
<style>
		body { font-size: 62.5%; }
		label, input { display:block; }
		input.text { margin-bottom:12px; width:95%; padding: .4em; } 
		fieldset { padding:0; border:0; margin-top:25px; }
		h1 { font-size: 1.2em; margin: .6em 0; }
		div#filldata { width: 0px; height: 400px; margin: 20px 0; }
		div#filldata table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#filldata table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
</style>-->
<div id="dialog-form" style="width:inherit" title="Detail View">

		<div id="filldata" ></div>
		<div id="actionstatusupateinfo">
		  
		</div>
    <div id="subsectionsdetailsstatus"></div> 
		<div id="updatestatus"></div>
   
</div>

<?php echo $_SESSION['myexcptions'];?>
<div id="displaymyaccounts">
 </div>
 <p>
 
 <!--<div id="ntgbtn" style=" right:140px; bottom:0px; padding:2px; font-size:10px; border: thin; height:auto; width:20; position:absolute;   font z-index:10;
font-family:Arial, Helvetica, sans-serif; font-size:12px">
</div>-->

 <div id="viewNotifications" style=" right:0px; bottom:0px; padding:2px; font-size:10px; visibility:hidden; border: thin; background: #cc9966; height:auto; width:105; position:absolute;   font z-index:10;
font-family:Arial, Helvetica, sans-serif; font-size:12px">
</div>

<script>
/*
function init() {
	document.getElementById('file_upload_form').onsubmit=function() {
		document.getElementById('file_upload_form').target = 'upload_target'; //'upload_target' is the name of the iframe
	}
}
window.onload=init;
*/

window.onload=function(){
	setTimeout('displayNotifionIntroMsg()',20000);
	
	
}

//(URL, windowName[, windowFeatures])
//dynamic js calling
jQuery.cachedScript = function(url, options) {

  // allow user to set any option except for dataType, cache, and url
  options = $.extend(options || {}, {
    dataType: "script",
    cache: true,
    url: url
  });

  // Use $.ajax() since it is more flexible than $.getScript
  // Return the jqXHR object so we can chain callbacks
  return jQuery.ajax(options);
};

// Usa
function dynamicGridEval(tablename){
/*$.cachedScript("../template/functions/coregrid.js").done(function(script, textStatus) {
  console.log( textStatus );
});*/
}

</script>

<!--<input type="button" value="upload file from her" onClick="uploadthisfile()"/>

<input type="button" value="alert infor upload adminuesr ssads" onClick="admin_alertForm('alertdata');">

<div id="displayhere">here</div>
<input type="button" value="Dynamic Js" onClick="launchForm('Admin')"/>-->

<!--<input type="button" name="grid-win" id="grid-win" value="show grid">
<input type="hidden" id="currentpositionCt" />-->
<div   id="alertdata"></div>
<div id="flashnotificationMSG">
</div>
</body>
</html>
