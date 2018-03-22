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
include('../template/functions/searchSQL.php');
include('../template/functions/customizesearchSQL.php');

?><?php
require_once('../PHPMailer/class.phpmailer.php');
include('../template/functions/menuLinks.php');
//sms
include('../template/functions/sms/sms_functions.php');
$campanyDetail=fillPrimaryData('admin_company',1);
  $companyname=$campanyDetail['company_name'];
  $personal=fillPrimaryData('admin_person',$_SESSION['my_useridloggened']);
  $cusername=$personal['person_fullname'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<link rel="stylesheet" type="text/css" href="../sview/resources/css/ext-all.css"/>

    <!-- GC -->
	
	<script type="text/javascript" src="../template/js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="../sview/bootstrap.js"></script>
	<!-- sm s -->
	<script type="text/javascript" src="../template/functions/sms/sms_js.js"></script>
   
	<!-- sms -->
	<script type="text/javascript" src="../template/functions/landlord.js"></script>
	<script type="text/javascript" src="../template/functions/selectLandlord.js"></script>
	<script type="text/javascript" src="../template/functions/tenant.js"></script>
   <script type="text/javascript" src="../template/functions/insuranceDBNotev2.js"></script>
    <script type="text/javascript" src="../template/functions/createcustviews.js"></script>
	 <script type="text/javascript" src="../template/functions/selectUnderwriter.js"></script>
<script type="text/javascript" src="../template/functions/personreg.js"></script>
<script type="text/javascript" src="../template/functions/advanceRequest.js"></script>
<script type="text/javascript" src="../template/functions/notificationaltert.js"></script>
<script type="text/javascript" src="../template/functions/selectnotification.js"></script>
<script type="text/javascript" src="../template/functions/labqueue.js"></script>
<script type="text/javascript" src="../template/functions/cytology.js"></script>
<script type="text/javascript" src="../template/functions/histology.js"></script>
<script type="text/javascript" src="../template/functions/papsmear.js"></script>
<script type="text/javascript" src="../template/functions/notificationform.js"></script>
<script type="text/javascript" src="../template/functions/notificationformgrid.js"></script>
<script type="text/javascript" src="../template/functions/formeditor.js"></script>
<script type="text/javascript" src="../template/functions/reporting.js"></script>
<script type="text/javascript" src="../template/functions/tablegroups.js"></script>
<script type="text/javascript" src="../template/functions/payroll.js"></script>
<script type="text/javascript" src="../template/functions/selectInsuranceClass.js"></script>


	
	<script>
	
				Ext.onReady(function() {
			  setTimeout(function(){
				Ext.get('loading').remove();
				Ext.get('loading-mask').fadeOut({remove:true});
			  }, 250);
			});
	</script>
    <link rel="stylesheet" type="text/css" href="../sview/shared/example.css"/>
    <link rel="stylesheet" type="text/css" href="../view/layout-browser.css"/>
    <link rel="stylesheet" type="text/css" href="../sview/ux/css/ItemSelector.css" />
    <link rel="stylesheet" type="text/css" href="../layout/css/desktop.css"/>
	
	<script type="text/javascript">
    //<![CDATA[
    function imageResize() {
        var imgHeight = $("#empPic").attr("height");
        var imgWidth = $("#empPic").attr("width");
        var newHeight = 0;
        var newWidth = 0;
        
        $('#currentImage').css('height', 'auto');

        //algorithm for image resizing
        //resizing by width - assuming width = 150,
        //resizing by height - assuming height = 180

        var propHeight = Math.floor((imgHeight/imgWidth) * 150);
        var propWidth = Math.floor((imgWidth/imgHeight) * 180);

        if (isNaN(propHeight) || (propHeight <= 180)) {
            newHeight = propHeight;
            newWidth = 150;
        }

        if (isNaN(propWidth) || (propWidth <= 150)) {
            newWidth = propWidth;
            newHeight = 180;
        }

        if(fileModified == 1) {
            newWidth = newImgWidth;
            newHeight = newImgHeight;
        }

        $("#empPic").attr("height", newHeight);
        $("#empPic").attr("width", newWidth);
        $("#empPic").attr("visibility", "visible");
    }
    
  //$(document).ready(function() {
   Ext.onReady(function() {
        imageResize();
    });
    
	
    //]]>
</script> 

 <style type="text/css">
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

      /* photo */
    #currentImage {
        padding: 2px;
        /*margin: 2px 4px 14px 2px;
        border: 1px solid #FAD163;*/
        cursor:pointer;
    }

    #imageSizeRule {
        width:200px;
    }

    #imageHint {
        font-size:10px;
        color:#999999;
        padding-left:8px;
    }


</style>
    <style type="text/css">
        .x-panel-body p {
            margin: 10px;
            font-size: 12px;
        }
    </style>
	<!-- page specific -->
    <style type="text/css">
        /* style rows on mouseover */
		.smallHelpText {
       font-size: 8pt;
       color:black;
    }
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
	<style type="text/css" media="screen">
        .task .x-grid-cell-inner {
            padding-left: 15px;
        }
        .x-grid-row-summary .x-grid-cell-inner {
            font-weight: bold;
            font-size: 11px;
        }
        .icon-grid {
            background: url(../sview/shared/icons/fam/grid.png) no-repeat 0 -1px;
        }
		
		.showFlashMSG{ background-image:url(../sview/desktop/wallpapers/blue.jpg) !important
		; font:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#FF3399; padding:3px; margin-left:150px}
		.hideFlashMSG{background:#3300FF; border:thin;}
		#welcome{padding:10;font-weight:bold; color: #000066; font-size:13px; font-family:"Courier New", Courier, monospace;  margin-left:150px }
		
    </style>
	<script>
	var rsptext;
	</script>
	
	
	<script language="JavaScript" src="../template/functions/gridbinding.js"></script>
	<!--<script language="JavaScript" src="../template/functions/tabb1.js"></script>-->
	<script language="JavaScript" src="../template/functions/createSummaryFields.js"></script>
	<script language="JavaScript" src="../template/functions/autofill.js"></script>
	<script language="JavaScript" src="../template/functions/createtblcustomization.js"></script>
	<script language="JavaScript" src="../template/functions/accountPosting.js"></script>
	<script language="JavaScript" src="../template/functions/extforms.js"></script>
	<script language="JavaScript" src="../template/functions/grid.js"></script>
	<script language="JavaScript" src="../template/functions/formload.js"></script>
   
<script>


function MainPage(){
Ext.onReady(function() { 
        var accordion = new Ext.Panel({ 
            region:'west',
			loadMask:true, 
            margins:'5 0 5 5', 
            split:true, 
            width: 210, 
            layout:'border',
			tbar:[{
                    text:'Log Out',
                    tooltip:'End your current session',
                    iconCls:'logout',
					handler:logoutuser
                }, '-', {
                    text:'User Rights',
                    tooltip:'New Mobile Form',
                    iconCls:'settings',
					handler:function(){
					gridViewform_amrsconceptsFQM('editdiv','updateload',1);
					}
                }]
        }); 
		///////////////////////////add containiner
var contentEl = new Ext.Panel({
     region: "west",
	 html:'KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK'
	
});

		//////////////////////////end of containner add
 //// 
  var myviewport=  new Ext.Viewport({ 
		      loadMask: true,
             layout:'border', 
            items:[
			{
            xtype: 'box',
            id: 'header',
            region: 'north',
            html: '<h1><b><?php echo $companyname; ?></b> </h1>',
            height: 30
		    } ,{region:'center',
			   autoScroll:true,
			   xtype: 'panel',
			   height: 700,
			   bodyStyle:'background-image:url(../sview/desktop/wallpapers/Wood-Sencha.jpg);padding:10px;',
			   html:'<table><tr><td><div id="detailinfo"  ></div></td><td><div id="editdiv"  ></div></td></tr><tr>'+
			   '<td><div id="dynamicchild"  ></div></td><td><div id="other"  ></div></td></tr></table>',
			   tbar:[{
                    text:'Sign Out',
                    tooltip:'End your current session',
                    iconCls:'logout',
					handler:logoutuser
                },'-',{
                    text:'Send Batch SMS',
                    tooltip:'Batch SMS',
                    iconCls:'myemail',
					handler:SendBatchSMSs
                },'-',{
                    text:'Messages',
                    tooltip:'View Messages',
                    iconCls:'myinbox',
					handler:individualNotification
                },'-',
				/*{
                    text:'MSG Form',
                    tooltip:'View Messages',
                    iconCls:'myinbox',
					handler:admin_rolenotificationhistFormRevsd
                },'-',	{
                    text:'Now!!!!!!!!',
                    tooltip:'View Messages',
                    iconCls:'myinbox',
					handler:individualNotificationGridform
                },'-',*/{
                    text:'My Tickets',
                    tooltip:'View Tickets',
                    iconCls:'mytickets',
					handler:showmynotifications
                },'-',{
                    text:'Refresh',
                    tooltip:'View Tickets',
                    iconCls:'myrefresh',
					handler:refreshfhome
                }]
			   }
			   ,{
    
        title: false,
        region:'west',
        xtype: 'box',
        margins: '5 20 0 5',
		padding:'50 0 0 0',
		

		align:'bottom',
		//bodyStyle:'padding:100px 10px 20px 10px',
        width: 150,
        collapsible: true,   // make collapsible
        id: 'west-region-container',
		html:'<div id="leftmenu"></div>',
        layout: 'fit'
		    }
			//jjjjjjjjjjjjjjjjj
			
			   
			   ] ,
			    
        }
		
		
		); 
          
  Ext.Ajax.request({
  loadMask: true,
  url: 'menuGrid.php',
  params: {id: "1"},
  success: function(resp) {
    // resp is the XmlHttpRequest object
    var optionss = Ext.decode(resp.responseText).optionss;
	var cfgs = [];
	 var tables = Ext.decode(resp.responseText).tables;
	     
	Ext.each(optionss, function(op) {
	          groupname=op.message;
			   var tbars = [];
			  ///////////////////////
					  Ext.each(tables, function(op) {
					  var tablevalue=op.tbl;
					  var searchstr=0;
					  var tablevalgrpArr=[];
					  searchstr=tablevalue.indexOf('||'+groupname+'||');
								  if(searchstr>0){
								  tablevalgrpArr=tablevalue.split('||');
								  }
					  if(tablevalgrpArr[1]==groupname){
					 
						 tbars.push(
									{
									text: tablevalgrpArr[0],
									iconCls:'user-girl',
									handler:function(buttonObj, eventObj) { 
									eventObj.click(eval(tablevalgrpArr[2]));
									}
									}
									);//push
					  }
                   });

			  
				cfgs.push({
				text:op.message,
				menu:tbars
				}) ;
				
				
				
    });
	//accordion.add(cfgs);
	var ld=document.getElementById('leftmenu');
	//ld.innerHTML='kwatuha';
	Ext.create('Ext.menu.Menu',{
items:cfgs,
floating: false,
border:false, 
width: 300,

renderTo:'leftmenu'
///////////////
///////////////
});
	 
  }
});//on onready
}); 

}	


</script>
<style>
.summaryinfo{ background-image:url(../sview/desktop/wallpapers/blue.jpg) !important
		; font:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#0033FF;padding:3px;}
		
		
#loading-mask {
  position: absolute;
  left:     0;
  top:      0;
  width:    100%;
  height:   100%;
  z-index:  20000;
  background-color: white;
}

#loading {
  position: absolute;
  left:     50%;
  top:      50%;
  padding:  2px;
  z-index:  20001;
  height:   auto;
  margin:   -35px 0 0 -30px;
}

#loading .loading-indicator {
  background: url(../sview/shared/extjs/images/extanim32.gif) no-repeat;
  color:      #555;
  font:       bold 13px tahoma,arial,helvetica;
  padding:    8px 42px;
  margin:     0;
  text-align: center;
  height:     auto;
}

#header {
    background: #7F99BE url(images/layout-browser-hd-bg.gif) repeat-x center;
}
		#header h1 {
    font-size: 16px;
    color: #fff;
    font-weight: normal;
    padding: 5px 10px;
}
</style>
<script>
function createDynamicChart(chartdiv){
//var obj=document.getElementById(chartdiv);
//obj.innerHTML='';
 Ext.Ajax.request({
  loadMask: true,
  url: 'analysis.php',
  params: {id: "1"},
  success: function(resp) {
    // resp is the XmlHttpRequest object
    var dyaxis = Ext.decode(resp.responseText).dyaxis;
	var cfgs = [];
	Ext.each(dyaxis, function(op) {
	  var chartData=op.ydata;
	  
	  //alert(charttitle);
	  var chartAxes=chartData.split('||');
	  xda=chartAxes[1];
	  charttitle=chartAxes[2];
	  
	  //alert( xda);
	  //{"date1":"eldoret", "count":1}
			cfgs.push({
						"date1": xda,"count":chartAxes[0]
						}
						);//push
		});//each
		//draw chart
		//alert(charttitle+'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww');
		//charttitle='Kwatuha';
		chart2(cfgs,charttitle,chartdiv);
		//end of chart
      }//close success
    });//request
}//close function
//general chart
function chart2(chartArray,charttitle,chartdiv){


Ext.onReady(function() {
//alert(charttitle+'Kwatuha');
    var datatitle=charttitle;
    var store1 = new Ext.data.JsonStore({
        fields: [
            {name: 'date1', type: 'data'},
            {name: 'count', type: 'int'}
        ],
        data: chartArray
    });

    Ext.create('widget.panel', {
        width: 500,
        height: 400,
		theme:'blue',
		resizable:true,
		title:'Company Information',
        renderTo: chartdiv,
        layout: 'fit',
        items: {
            xtype: 'chart',
            animate: true,
            store: store1,
            insetPadding: 30,
            legend: {
                position: 'bottom'
            },
            axes: [
                {
                    type: 'Numeric',
                    minimum: 0,
                    maximum: 400,
                    position: 'left',
                    fields: ['date1'],
                    title: 'growth',
                    grid: {
                        stroke: '#0F0',
                        fill: '#0F0',
                        'stroke-width': 5

                    },
                    label: {
                        font: '10px Arial',
                        fill: '#80858D',
                        color: '#FFFFFF',
                        renderer: function(val) {
                            return val;
                        }

                    }
                },
                {
                    type: 'Category',
                    position: 'bottom',
                    color: '#FFFFFF',
                    grid: false,
                    fields: ['date1'],
                    fill: '#0F0',
                    title: datatitle,
                    label: {
                        font: '11px Arial',
                        color: '#FFFFFF',
                        fill: '#80858D',
                        rotate: {degrees: 315},
                        renderer: function(date) {
                            console.log("Date: " + date);
                            return date;
                        }
                    }
                }
            ],
            series: [
                {
                    type: 'line',
                    axis: 'left',
                    xField: 'date1',
                    yField: 'count',
                    style: {
                        fill: '#f47d23',
                        stroke: '#f47d23',
                        'stroke-width': 3
                    },
                    markerConfig: {
                        type: 'circle',
                        size: 2,
                        radius: 2,
                        'stroke-width': 0,
                        fill: '#38B8BF',
                        stroke: '#38B8BF'
                    }
                }
            ]
        }
    });
});
}
//general chart
</script>
</head>

<body>
<div id="loading-mask"></div>
<div id="loading">
<div class="loading-indicator">
Loading...
</div>
</div>

<!--<div id="formview"></div>
<input type="button" onClick="createBarGraph()" value="read Data"/>
<input type="button" onClick="createDynamicChart()" value="where eit it personal"/>
<div id="charts" style="background-image:url(../sview/desktop/wallpapers/blue.jpg)" > Chart Infor sdsdas </div>-->

<div id="formin"></div>


<!--<script type="text/javascript" src="reorder.js"></script>-->
<script>

function showMenu(){
/*var x=document.getElementById('bottommenu');
x.innerHTML='';
Ext.create('Ext.menu.Menu',{
items: [{ // 1
text: "<b>Users</b>",
iconCls:'user-girl',
menu:[{text:'musee'},{text:'mulimani'}]
},
{
text: "<i>Italic</i>"
},
{
text: "<u>Underline</u>"
}],
floating: false, // 2
width: 100, // 3
renderTo:'bottommenu'
});*/
var sampleToolbar = new Ext.Toolbar({ // 1
width: 400,
height: 40,
renderTo: 'bottommenu', // 2
style: { marginBottom: '20px'} // 3
});
var samplePanel = new Ext.Panel({ // 4
width: 400,
height: 300,
title: "Panel with Top & Bottom Toolbars",
tbar: { // 5
height: 30,
},
bbar: { // 6
height: 30
},
renderTo: 'bottommenu',
alignTo:'center'
});
sampleToolbar.alignTo("leftmenu","bl-bl");
}

////////////////////////

/////////////////////////

//**************Othe idears
function drawme(){
var drawComponent = Ext.create('Ext.draw.Component', {
    viewBox: false,
    items: [{
        type: 'circle',
        fill: '#ffc',
        radius: 100,
        x: 100,
        y: 100
    }]
});

Ext.create('Ext.Window', {
    width: 230,
    height: 230,
    layout: 'fit',
    items: [drawComponent]
}).show();
}

function logOut(){

var m=document.getElementById('top-menu');
m.innerHTML='';
var mx=document.getElementById('detailinfo');
mx.innerHTML='';


Ext.require('Ext.container.Viewport');
Ext.application({
    name: 'HelloExt',
    launch: function() {
        Ext.create('Ext.container.Viewport', {
            layout: 'fit',
			
            items: [
		 
                {
                    title: '<?php echo $companyname; ?>',
					bodyStyle:'background-image:url(../sview/desktop/wallpapers/Wood-Sencha.jpg);padding:100px 10px 50px 120px',
                    html : '<div id="lin"</div>'
					
                }
            ]
        });
    }
});


 authUser();
}

///login
function authUser(){patientaddress
var displayhere='lin';
var obj=document.getElementById(displayhere);

obj.innerHTML='';



Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
        frame: true,
		url:'bodysave.php',
        width: 400,
		hieght: 250,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'User Authentication',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { //prevents showing global error when form first loads
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'nlbasss'
			 },{
            xtype: 'textfield',
            name: 'username',
            fieldLabel: 'Username',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'password',
            fieldLabel: 'Password ',
			 inputType: 'password',
            allowBlank: false,
            minLength: 8
        
		}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    // Update CSS class and tooltip content
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	//now submit
	//submitbutton
	{
		xtype: 'button',
        text: 'Login',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'lbl.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
                    }
                });
            }
        }
    }
	///end of cols
		]
        }]
    });
	


});



}//launchForm()

Ext.onReady(function() {
//createTopMenu();
MainPage();

});

//////

</script>
<script>
function createTopMenu(){
var x=document.getElementById('topmenu');
x.innerHTML='';
Ext.create('Ext.menu.Menu',{
items: [{ // 1
text: "<b>Users</b>",
iconCls:'user-girl',
menu:[{text:'musee'},{text:'mulimani'}]
},
{
text: "<i>Italic</i>"
},
{
text: "<u>Underline</u>"
}],
floating: false, // 2
width: 100, // 3
renderTo:'popupmenu'
});
}
///////////////////////////////////
function logoutuser(){
 Ext.Ajax.request({
  loadMask: true,
  url: '../logs/logout.php',
  params: {id: "1"},
  success: function(resp) {
   window.location = '../';
      }
    });
}

//
function userRightsPop(){
var displayhere='lin';
var obj=document.getElementById(displayhere);

obj.innerHTML='';



Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
        frame: true,
		url:'bodysave.php',
        width: 400,
		hieght: 250,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'User Authentication',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { //prevents showing global error when form first loads
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'nlbasss'
			 },{
            xtype: 'textfield',
            name: 'username',
            fieldLabel: 'Username',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'password',
            fieldLabel: 'Password ',
			 inputType: 'password',
            allowBlank: false,
            minLength: 1
        
		}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    // Update CSS class and tooltip content
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	//now submit
	//submitbutton
	{
		xtype: 'button',
        text: 'Login',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'lbl.php',
                    waitMsg: 'Authenticating user...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
						if(o.result.savemsg>0){
						MainPage();
						}
                    }
                });
            }
        }
    }
	///end of cols
		]
        }]
    });
	


});



}//launchForm()
		
		///////////////
function userRightsPops(){
var displayhere='detailinfo';
var obj=document.getElementById(displayhere);
obj.innerHTML='';
Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
        frame: true,
		url:'bodysave.php',
        width: 400,
		hieght: 250,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'User Authentication',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { //prevents showing global error when form first loads
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'nlbasss'
			 },{
            xtype: 'textfield',
            name: 'username',
            fieldLabel: 'Username',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'password',
            fieldLabel: 'Password ',
			 inputType: 'password',
            allowBlank: false,
            minLength: 1
        
		}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    // Update CSS class and tooltip content
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	//now submit
	//submitbutton
	{
		xtype: 'button',
        text: 'Login',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'lbl.php',
                    waitMsg: 'Authenticating user...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
						if(o.result.savemsg>0){
						MainPage();
						}
                    }
                });
            }
        }
    }
	///end of cols
		]
        }]
    });
	


});



}//launchForm()
function createForm(loadtype,rid,tablename,e){
 Ext.Ajax.request({
  loadMask: true,
  url: 'form.php?t='+tablename+'&ty='+e,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}

function createFormGrid(loadtype,rid,tablename,e){
 Ext.Ajax.request({
  loadMask: true,
  url: 'formgrid.php?t='+tablename+'&ty='+e,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}

</script>
<script language="JavaScript" src="../template/functions/multiselector.js"></script>
<!--<script language="JavaScript" src="../template/functions/groupview.js"></script>
-->
<!--<script language="JavaScript" src="../template/functions/grid_to_grid_drag.js"></script>
-->

<script language="JavaScript" src="../template/functions/testtabpanel.js"></script>

<div id="la"></div>
<div id="chart1"></div> 
<div id="filldata" ></div>
<div id="actionstatusupateinfo"></div>
<div id="topmenu"></div>
<div id="multiselect" class="demo-ct"></div>
<div id="itemselector" class="demo-ct"></div>
<div id="panel" class="demo-ct"></div>
<div id="panelpanel" class="demo-ct"></div>
<input type="hidden" onClick="showItemSelecton();" value="show desihgnb"/>
<input type="hidden" onClick="ChangeRequestForm('panelpanel');" value="show view created"/>
<script>


function ChangeRequestForm3(displayhere){

var obj=document.getElementById(displayhere);
obj.innerHTML='';



Ext.define('cmbAdmin_usergroup', {
    extend: 'Ext.data.Model',
	fields:['usergroup_id','usergroup_name']
	});

var admin_usergroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_usergroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_usergroup',
        reader: {
            type: 'json'
        }
    }
});

admin_usergroupdata.load();


Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','admin_rights','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' admin rights',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{
            xtype: 'fieldlist',
			
            fieldLabel: 'Change Request',
            iconCls:'usergroup',
            items:[
	{xtype: 'displayfield', value: '*'},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},
   {
    xtype: 'combobox',
	name:'alert_id',
	forceSelection:true,
    fieldLabel: 'Alert Id ',
    store: admin_alertdata,
    queryMode: 'local',
    displayField: 'alert_name',
    valueField: 'alert_id'
	},{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'status',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		}]
        },{
            xtype: 'checkboxfieldlist',
			
            fieldLabel: 'Change Request',
            iconCls:'usergroup',
            items: {
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},
   {
    xtype: 'combobox',
	name:'controller_id',
	forceSelection:true,
    fieldLabel: 'Controller Id ',
    store: admin_controllerdata,
    queryMode: 'local',
    displayField: 'controller_name',
    valueField: 'controller_id'
	},{
            xtype: 'textfield',
            name: 'view',
            fieldLabel: 'View ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'edit',
            fieldLabel: 'Edit ',
            allowBlank: false,
            minLength: 1
        
		},
        {
            xtype: 'fieldlist',
			
            fieldLabel: 'Change Request',
            iconCls:'usergroup',
            items: {
            xtype: 'textfield',
            name: 'company_name',
            fieldLabel: 'Company Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'pin_num',
            fieldLabel: 'Pin Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'vat_num',
            fieldLabel: 'Vat Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'institution_reg',
            fieldLabel: 'Institution Reg ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'incorp_dt',
            fieldLabel: 'Incorp Dt ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'postal_address',
            fieldLabel: 'Postal Address ',
            allowBlank: false,
            minLength: 1
        
		},
        {
            xtype: 'tabpanel',
			
            fieldLabel: 'Change Request',
            iconCls:'usergroup',
            items:[ 
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'textfield',
            name: 'view',
            fieldLabel: 'View ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'edit',
            fieldLabel: 'Edit ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'del',
            fieldLabel: 'Del ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadadmin_rightsinfo(formPanel,rid);
}

});



}/*launchForm()*/
//ChangeRequestForm('detailinfo','Save','NOID');

</script>
<script>

function createView(viewId){
 Ext.Ajax.request({
  loadMask: true,
    url: 'formview.php?tview='+viewId,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}
function ChangeRequestForm(displayhere,tview){


Ext.define('cmbAdmin_usergroup', {
    extend: 'Ext.data.Model',
	fields:['usergroup_id','usergroup_name']
	});

var admin_usergroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_usergroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_usergroup',
        reader: {
            type: 'json'
        }
    }
});

admin_usergroupdata.load();


Ext.define('cmbAdmin_alert', {
    extend: 'Ext.data.Model',
	fields:['alert_id','alert_name']
	});

var admin_alertdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_alert',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_alert',
        reader: {
            type: 'json'
        }
    }
});

admin_alertdata.load();

var obj=document.getElementById(displayhere);
obj.innerHTML='';



Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','admin_rights','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'change view',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{
						xtype: 'fieldset',
						layout:'fit',
						bodyPadding:10,
						title: 'Change Request',
						iconCls:'usergroup',
						items: [
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},
   {
    xtype: 'combobox',
	name:'alert_id',
	forceSelection:true,
    fieldLabel: 'Alert Id ',
    store: admin_alertdata,
    queryMode: 'local',
    displayField: 'alert_name',
    valueField: 'alert_id'
	},{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'status',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		}]
					}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadadmin_rightsinfo(formPanel,rid);
}

});



}/*launchForm()*/


</script>
<script>
function gridViewadmin_table( searchitem){
alert(searchitem);

var viewdiv=document.getElementById('detailinfo');
viewdiv.innerHTML='';
Ext.QuickTips.init();

/*var encode = false;
var local = true;
var filters = {
        ftype: 'filters',
        encode: encode, 
        local: local, 
        filters: [
            {
                type: 'boolean',
                dataIndex: 'visible'
            }
        ]
    };*/

Ext.define('cmbadmin_table', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchadmin_tabledata = Ext.create('Ext.data.Store', {
    model: 'cmbadmin_table',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_table&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchadmin_tabledata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_table = Ext.get('gridViewadmin_table');	

	Ext.define('Admin_table', {
    extend: 'Ext.data.Model',
	fields:['table_id','table_name','table_caption','statement_caption','flexcolumn','gridwidth','gridhieght']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_table',
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=admin_table&fdn='+searchitem,
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
		/*features: [filters],*/
		columns:[
		new Ext.grid.RowNumberer(),{
		text     : ' Table Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'table_id'/*,
		 filterable: true*/
		 },
		 {
		text     : ' Table Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'table_name'/*,
		 filterable: true*/
		 },
		 {
		text     : ' Table Caption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'table_caption'/*,
		 filterable: true*/
		 },
		 {
		text     : ' Statement Caption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'statement_caption'/*,
		 filterable: true*/
		 },
		 {
		text     : ' Flexcolumn ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'flexcolumn'/*,
		 filterable: true*/
		 },
		 {
		text     : ' Gridwidth ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'gridwidth'/*,
		 filterable: true*/
		 },
		 {
		text     : ' Gridhieght ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'gridhieght'/*,
		 filterable: true*/
		 },
		 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 50,
                items: [{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'action ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        alert('Sell ' + rec.get('alert_name'));
                    }
                }, {
                    getClass: function(v, meta, rec) { 
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Hold stock';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Buy stock';
                            return 'buy-col';
                        }
                    },
				
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
//alert("wassssssssssssssssssssss");
var ctv='admin_table';
var ccrecordid=rec.get('table_id');
if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
gridViewform_amrsconceptsFQM('editdiv','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('table_id')+'table_id');
var ccrecordid=rec.get('table_id');
admin_tableForm('editdiv','updateload',ccrecordid);

}
                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 600,
		resizable:true,
        title: 'System Sections',
        renderTo: 'detailinfo',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
		},
		listeners: {
                selectionchange: function(model, records) {
				 alert("How do  You");
                    if (records[0]) {
                    alert("How do  You");
                    }
                }},
		tbar:[{
                    text:'Add Record',
                    tooltip:'Create Section',
                    iconCls:'add',
					handler:function(){
						createForm("Save","NOID","admin_table","f")
					}
                }, '-', {
                    text:'Options',
                    tooltip:'Create options',
                    iconCls:'option'
                },'-',{
                    text:'Delete',
                    tooltip:'Delete record',
                    iconCls:'remove'
                },'-',
				{ text:'Search', 
 tooltip:'Find', 
 iconCls:'find',
  handler: function(grid, rowIndex, colIndex) { 
testme();
 }

 }
 ,
 
 {
    xtype: 'combobox',
	name:'grdsearchadmin_table',
	id:'grdsearchadmin_table',
	forceSelection:true,
    fieldLabel: false,
    store: searchadmin_tabledata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchadmin_table').getValue();
	var selValtx = Ext.getCmp('searchfield').getValue();
  alert(selValtx+selVal);
}}

	},
 { title:'Search', 
 tooltip:'Find record', 
 xtype:'textfield',
 name:'searchfield',
 id:'searchfield',
 iconCls:'remove',
 listeners: {'render': function(cmp) { 
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
	if((ke==39)||(ke==13)||(ke==112)||(ke==37)||(ke==34)||(ke==38)||(ke==20)){
	var selVal = Ext.getCmp('grdsearchadmin_table').getValue();
    var searchitem=el.value;
	store.proxy.extraParams = { searhfield:selVal,searhvalue:searchitem};
	 store.load();
	 }
	
      });            
    }}
 }]
		
    });
	
	
	
	
}

</script>
<script>
function HouseAllowanceFormForm(displayhere){
Ext.define('cmbAdmin_usergroup', {
    extend: 'Ext.data.Model',
	fields:['usergroup_id','usergroup_name']
	});

var admin_usergroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_usergroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_usergroup',
        reader: {
            type: 'json'
        }
    }
});

admin_usergroupdata.load();

var obj=document.getElementById(displayhere);
obj.innerHTML='';



Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','admin_company','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 600,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'House Allowance Form',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none'
			/*,
            invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{
						xtype: 'fieldset',
						title: 'personal data',
						//width:600,
						layout: 'fit',
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
			
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			width:500,
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		}]
		},{
						xtype: 'tabpanel',
						
						
						title: 'Personal  Roles',
						collapsible:true,
						width:600,
						iconCls:'usergroup',
						items: [{
						title:'Intro to must',
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'role_name',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'user_status',
            fieldLabel: 'User Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'previlege',
            fieldLabel: 'Previlege ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'resource',
            fieldLabel: 'Resource ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		}]
					},{
						xtype: 'fieldset',
						checkboxToggle:true,
						collapsed:true,
						title: 'personal  company',
						width:600,
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'role_name',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'user_status',
            fieldLabel: 'User Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'previlege',
            fieldLabel: 'Previlege ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'resource',
            fieldLabel: 'Resource ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'company_name',
            fieldLabel: 'Company Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'pin_num',
            fieldLabel: 'Pin Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'vat_num',
            fieldLabel: 'Vat Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'institution_reg',
            fieldLabel: 'Institution Reg ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'incorp_dt',
            fieldLabel: 'Incorp Dt ',
            allowBlank: false,
            minLength: 1
        
		}] }], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
						eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadadmin_companyinfo(formPanel,rid);
}

});



}/*launchForm()*/


</script>
<script>
function OpenReport(tablename){
window.open('../reporting/report.php?t='+tablename);
}
function QuereyReport(rid){
window.open('../reporting/qrpt.php?r='+rid);
}

function OpenInvoice(tablename){
//window.close('../reporting/invoice.php?t='+tablename);
window.open('../reporting/invoice.php?t='+tablename);
}
function OpenReceipt(tablename){
//window.close('../reporting/invoice.php?t='+tablename);
window.open('../reporting/receipt.php?t='+tablename);
}
function OpenStatement(tablename){
//window.close('../reporting/invoice.php?t='+tablename);
window.open('../reporting/statement.php?t='+tablename);
}
</script>
<script>
function HouseAllowanceFormForm2(displayhere){


Ext.define('cmbAdmin_usergroup', {
    extend: 'Ext.data.Model',
	fields:['usergroup_id','usergroup_name']
	});

var admin_usergroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_usergroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_usergroup',
        reader: {
            type: 'json'
        }
    }
});

admin_usergroupdata.load();


Ext.define('cmbAccount_accountclosure', {
    extend: 'Ext.data.Model',
	fields:['accountclosure_id','accountclosure_name']
	});

var account_accountclosuredata = Ext.create('Ext.data.Store', {
    model: 'cmbAccount_accountclosure',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_accountclosure',
        reader: {
            type: 'json'
        }
    }
});

account_accountclosuredata.load();


Ext.define('cmbAccount_account', {
    extend: 'Ext.data.Model',
	fields:['account_id','account_name']
	});

var account_accountdata = Ext.create('Ext.data.Store', {
    model: 'cmbAccount_account',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=account_account',
        reader: {
            type: 'json'
        }
    }
});

account_accountdata.load();

var obj=document.getElementById(displayhere);
obj.innerHTML='';



Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','account_accountclosure','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 600,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: 'House Allowance Form',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none'
			/*,
            invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{
						xtype: 'fieldset',
						
						
						title: 'personal data',
						width:600,
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},]
					},{
						xtype: 'fieldset',
						
						
						title: 'Personal  Roles',
						width:600,
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'role_name',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'user_status',
            fieldLabel: 'User Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'previlege',
            fieldLabel: 'Previlege ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'resource',
            fieldLabel: 'Resource ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},]
					},{
						xtype: 'fieldset',
						
						
						title: 'personal  company',
						width:600,
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'role_name',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'user_status',
            fieldLabel: 'User Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'previlege',
            fieldLabel: 'Previlege ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'resource',
            fieldLabel: 'Resource ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'company_name',
            fieldLabel: 'Company Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'pin_num',
            fieldLabel: 'Pin Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'vat_num',
            fieldLabel: 'Vat Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'institution_reg',
            fieldLabel: 'Institution Reg ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'incorp_dt',
            fieldLabel: 'Incorp Dt ',
            allowBlank: false,
            minLength: 1
        
		},]
					},{
						xtype: 'tabpanel',
						
						
						title: 'kwatuhaMy tabls',
						width:600,
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
            name: 'tablename',
            fieldLabel: 'Tablename ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'comments',
            fieldLabel: 'Comments ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'usergroup_id',
	forceSelection:true,
    fieldLabel: 'Usergroup Id ',
    store: admin_usergroupdata,
    queryMode: 'local',
    displayField: 'usergroup_name',
    valueField: 'usergroup_id'
	},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'role_name',
            fieldLabel: 'Role Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'user_status',
            fieldLabel: 'User Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'previlege',
            fieldLabel: 'Previlege ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'resource',
            fieldLabel: 'Resource ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'effective_date',
            fieldLabel: 'Effective Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'company_name',
            fieldLabel: 'Company Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'pin_num',
            fieldLabel: 'Pin Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'vat_num',
            fieldLabel: 'Vat Num ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'institution_reg',
            fieldLabel: 'Institution Reg ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'incorp_dt',
            fieldLabel: 'Incorp Dt ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'accountclosure_id',
	forceSelection:true,
    fieldLabel: 'Accountclosure Id ',
    store: account_accountclosuredata,
    queryMode: 'local',
    displayField: 'accountclosure_name',
    valueField: 'accountclosure_id'
	},{
            xtype: 'textfield',
            name: 'accountclosure_name',
            fieldLabel: 'Accountclosure Name ',
            allowBlank: false,
            minLength: 1
        
		},
   {
    xtype: 'combobox',
	name:'account_id',
	forceSelection:true,
    fieldLabel: 'Account Id ',
    store: account_accountdata,
    queryMode: 'local',
    displayField: 'account_name',
    valueField: 'account_id'
	},{
            xtype: 'textfield',
            name: 'athourized_by',
            fieldLabel: 'Athourized By ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
            name: 'closure_reason',
            fieldLabel: 'Closure Reason ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'closure_date',
            fieldLabel: 'Closure Date ',
            allowBlank: false,
            minLength: 1
        
		},]
					}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadaccount_accountclosureinfo(formPanel,rid);
}

});



}/*launchForm()*/


function createDynamicCkRD(display,source,div){
 Ext.Ajax.request({
  loadMask: true,
    url: 'createdynamicRadioCheck.php?tview='+display+'&t='+source+'&div='+div,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}
/*function dynamicRadioGroup(source){ 
 
 Ext.create('Ext.form.Panel', {
 title: 'RadioGroup Example',
 width: 300,
 height: 125,
 bodyPadding: 10,
 draggable:true,
 shadow :true,
 stateEvents:['click', 'customerchange'],
 renderTo:'myradios',
 items:[{
 xtype: 'checkboxgroup',
 fieldLabel: 'Two Columns',
 columns: 2,
 vertical: true,
 items: [
 { boxLabel: 'Item 1', name: 'rb', inputValue: '1' },
 { boxLabel: 'Item 2', name: 'rb', inputValue: '2' },
 { boxLabel: 'Item 3', name: 'rb', inputValue: '3' },
 { boxLabel: 'Item 4', name: 'rb', inputValue: '4' },
 { boxLabel: 'Item 5', name: 'rb', inputValue: '5' },
 { boxLabel: 'Item 6', name: 'rb', inputValue: '6',
 handler:function(){
 alert('kwwwwwwwwwwwwww'
 );
 } }
 ]
 }]
 });
 
 }*/
 
 function customerchange(){
 alert('Kwatuha');
 }
</script>
<input type="hidden" value="Preview Form" onClick="createView(1)"/>
<input type="hidden" value="Preview Form startic" onClick="ChangeRequestForm('detailinfo',2);"/>
<input type="hidden" value="Test Grid" onClick="gridViewadmin_table();"/>
<input type="hidden" value="view5 " onClick="TestMy('detailinfo');"/>
<input type="hidden" value=" show colums " onClick="TestMy('detailinfo');"/>


<input type="hidden" value="add  " onClick="createDynamicCkRD('checkboxgroup','insurance_policytype','sideoptions');"/>

<input type="hidden" value=" show colums " onClick="showColumnsAlpha();createDynamicCkRD('radiobuttongroup','insurance_policytype','sideoptions')"/>
<div id="myradios"></div>
<div id="cardview"></div>
<input type="hidden" onClick="createCardView()" value="card" />
<input type="hidden" onClick="bank_bankstmntitemsForm('detailinfo','Save','NOID');" value="add fields" />
</body>
</head>
</html>
<script>
// All columns are percentages -- they must add up to 1
function showColumnsAlpha(){
Ext.create('Ext.panel.Panel', {
    title: 'Column Layout - Percentage Only',
    width: 650,
    height: 250,
    layout:'column',
    items: [{
        title: 'Options',
        columnWidth: .4,
		margin: '10 5 5 5',
		bodyPadding: 10,
		bodyBorder: true,
		items:[{
           html: '<div id="sideoptions">My data</div>'        
		}]
    },{
        title:'Entries',
		margin: '10 5 5 5',
        columnWidth: 0.6,
		frame: true,
		bodyPadding: 10,
		
        bodyBorder: true,
		items:[{
            xtype: 'textfield',
			//margin: '10 5 5 5',
            name: 'athourized_by',
            fieldLabel: 'Athourized By ',
            allowBlank: false,
			width:360,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			//margin: '5 5 5 5',
            name: 'closure_reason',
            fieldLabel: 'Closure Reason ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			//margin: '5 5 5 5',
            name: 'closure_date',
            fieldLabel: 'Closure Date ',
            allowBlank: false,
            minLength: 1
        
		}]
    }],
    renderTo: 'detailinfo'
});
}

function opendChildElem(tablename,tparam){
 Ext.Ajax.request({
  loadMask: true,
    url: 'form.php?t='+tablename+'&ty=f&dcrspdn='+tparam,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}

function opendChildElemGrid(tablename,tparam){

 Ext.Ajax.request({
  loadMask: true,
    url: 'formgrid.php?t='+tablename+'&ty=g&dcrspdn='+tparam,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}			
</script><script>
function createCardView(){
var navigate = function(panel, direction){
    var layout = panel.getLayout();
    layout[direction]();
    Ext.getCmp('move-prev').setDisabled(!layout.getPrev());
    Ext.getCmp('move-next').setDisabled(!layout.getNext());
};

Ext.create('Ext.panel.Panel', {
    title: 'Example Wizard',
    width: 550,
    height: 300,
    layout: 'card',
	
    bodyStyle: 'padding:15px',
    defaults: {
        // applied to each contained panel
        border: false
    },
    // just an example of one possible navigation scheme, using buttons
    bbar: [
        {
            id: 'move-prev',
            text: 'Back',
            handler: function(btn) {
                navigate(btn.up("panel"), "prev");
				x.innerHTML='Kwwwwwwwwwwwwwwwwwwwwwwwwwwww';
				if (this.clickCount) {
            // looks like the property is already set, so lets just add 1 to that number and alert the user
            this.clickCount++;
            alert('You have clicked the button "' + this.clickCount + '" times.\n\nTry clicking it again..');
        } else {
            // if the clickCount property is not set, we will set it and alert the user
            this.clickCount = 1;
            alert('You just clicked the button for the first time!\n\nTry pressing it again..');
        }
				//////////////////////////////////////////
            },
            disabled: true
        },
        '->', // greedy spacer so that the buttons are aligned to each side
        {
            id: 'move-next',
            text: 'Next',
            handler: function(btn) {
                navigate(btn.up("panel"), "next");
				//alert('here');
				var x=document.getElementById('metoo');
				x.innerHTML='Kwwwwwwwwwwwwwwwwwwwwwwwwwwww';
				if (this.clickCount) {
            // looks like the property is already set, so lets just add 1 to that number and alert the user
            this.clickCount++;
            //alert('You have clicked the button "' + this.clickCount + '" times.\n\nTry clicking it again..');
        } else {
            // if the clickCount property is not set, we will set it and alert the user
            this.clickCount = 1;
          //  alert('You just clicked the button for the first time!\n\nTry pressing it again..');
        }
				//////////////////////////////////////////
				
            }
        }
    ],
    // the panels (or "cards") within the layout
    items: [{
        id: 'card-0',
        html: '<h1>Welcome to the Wizard!</h1><p>Step 1 of 3</p>'
    },{
        id: 'card-1',
        html: '<p>Step 2 of 3</p>'
    },{
        id: 'card-2',
        html: '<h1>Congratulations!</h1><p>Step 3 of 3 - Complete</p>'
    },{
        id: 'card-3',
        html: '<h1>Congratulations!</h1><p>Step 3 of 5 - Complete</p>'
    },{
        id: 'card-4',
        html: '<h1>Congratulations!</h1><p><input value="testing me" type="button" onClick="createrDynamicControlls()" /><div id="metoo" >Sema</div>Step 5 of 5 - Complete</p>'
    }],
    renderTo:'detailinfo'
});
}
</script><script>
/*Ext.create('Ext.Button', {
    text    : 'Dynamic Handler Button',
    renderTo: Ext.getBody(),
    handler : function() {
        // this button will spit out a different number every time you click it.
        // so firstly we must check if that number is already set:
        if (this.clickCount) {
            // looks like the property is already set, so lets just add 1 to that number and alert the user
            this.clickCount++;
            alert('You have clicked the button "' + this.clickCount + '" times.\n\nTry clicking it again..');
        } else {
            // if the clickCount property is not set, we will set it and alert the user
            this.clickCount = 1;
            alert('You just clicked the button for the first time!\n\nTry pressing it again..');
        }
    }
});*/
</script>
<style>
/* Full credit to Evan Trimboli */
.x-fieldset-header-icon, .ext-ie .x-fieldset-header-icon {
    padding-left: 18px !important;
    background-repeat: no-repeat;
}
</style>
<script>
function account_accreationForm(displayhere,loadtype,rid){
var obj=document.getElementById(displayhere);
obj.innerHTML='';
Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		resizable:true,
        frame: true,
		id:'accountform',
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' account accreation',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'account_accreation'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'numberfield',
            name: 'Credit_limit',
            fieldLabel: 'Credit Limit ',
            allowBlank: false,
            minLength: 1
        
		},{xtype:'fieldset',
		   title:'Testing',
		   id:'mysuser',
		   items:[{
            xtype: 'numberfield',
            name: 'Closing_Balance',
            fieldLabel: 'Closing Balance ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'Cnature',
            fieldLabel: 'Cnature ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'button',
			text:'Add new field',
			handler: function() {
			
    var container = this.up('fieldset');
    var config = Ext.apply({}, container.initialConfig.items[1]);
    config.fieldLabel = container.items.length + 1;
    container.add({
            xtype: 'numberfield',
            name: 'Closing_Balance',
            fieldLabel: 'Closing Balance ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'Closing_Balance',
            fieldLabel: 'Closing Balance ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'Closing_Balance',
            fieldLabel: 'Closing Balance ',
            allowBlank: false,
            minLength: 1
        
		});
        }}]}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data field',
		handler: function() {
    var container = this.up('fieldset');
    var config = Ext.apply({}, container.initialConfig.items[0]);
    config.fieldLabel = container.items.length + 1;
    container.add(config);
}

        /*handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
                    }
                });
            }
        }*/
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadaccount_accreationinfo(formPanel,rid);
}

});
var usr=Ext.getCmp('mysuser').add({
            xtype: 'numberfieldv2',
            name: 'Credit_limit2',
            fieldLabel: 'Credit Limit by Kwatuha ',
            allowBlank: false,
            minLength: 1
        
		});
fielset.add()

}/*launchForm()*/

</script>
<script>
function bank_bankstmntitemsForm(displayhere,loadtype,rid){
/*alert('bank_bankstmntitems');*/
var obj=document.getElementById(displayhere);

obj.innerHTML='';



Ext.define('cmbBank_bankstatement', {
    extend: 'Ext.data.Model',
	fields:['bankstatement_id','bankstatement_name']
	});

var bank_bankstatementdata = Ext.create('Ext.data.Store', {
    model: 'cmbBank_bankstatement',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=bank_bankstatement',
        reader: {
            type: 'json'
        }
    }
});

bank_bankstatementdata.load();


Ext.onReady(function() {
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','bank_bankstmntitems','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' bank bankstmntitems',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'bank_bankstmntitems'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
   {
    xtype: 'combobox',
	name:'bankstatement_id',
	forceSelection:true,
    fieldLabel: 'Bankstatement Id ',
    store: bank_bankstatementdata,
    queryMode: 'remote',
    displayField: 'bankstatement_name',
    valueField: 'bankstatement_id'
	},{
            xtype: 'datefield',
            name: 'transaction_date',
            fieldLabel: 'Transaction Date ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'transaction_type',
            fieldLabel: 'Transaction Type ',
            allowBlank: false,
            minLength: 1
        
		},
		{
		xtype:'fieldset',
		 id:'tesingmyd',
		 bodyBorder:false,
		items:[{
            xtype: 'button',
			text:'Add new field',
			handler: function() {
			
    var container = this.up('fieldset');
    var config = Ext.apply({}, container.initialConfig.items[1]);
    config.fieldLabel = container.items.length + 1;
	container.remove(
    container.add({
    xtype: 'combobox',
	name:'bankstatement_id',
	forceSelection:true,
    fieldLabel: 'Bankstatement Id ',
    store: bank_bankstatementdata,
    queryMode: 'remote',
    displayField: 'bankstatement_name',
    valueField: 'bankstatement_id'
	});}},{
            xtype: 'numberfield',
            name: 'amount',
            fieldLabel: 'Amount ',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'textfield',
            name: 'status',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'status',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1
        
		}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}'+
				'</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadbank_bankstmntitemsinfo(formPanel,rid);
}

});



}/*launchForm()*/
//field.label.update('New label');
//grid.getColumnModel().setColumnHeader(2, 'Inst');
</script>
<script>
function dynamicRadioGroupTest(){ 
loadtype='Save';
Ext.create('Ext.panel.Panel', {
    renderTo: 'detailinfo',
    width: 700,
    //height: 300,
	bodyPadding:10,
    title: 'Container Panel',
    items: [
			     {
	layout:'column',
    items: [{
        title: false,
        columnWidth: .65,
		//hieght:100,
		
		margin: '10 5 5 5',
		bodyPadding: 10,
		border:false,
		//frame: true,
		
		items:[
		   
		{
						xtype: 'fieldset',
						title: 'Personal Details',
						width:380,
						collapsible:true,
						iconCls:'usergroup',
						items: [{
            xtype: 'textfield',
            name: 'person_name',
            fieldLabel: 'Person Name ',
            allowBlank: false,
            minLength: 1
        
								},{
            xtype: 'textfield',
            name: 'last_name',
            fieldLabel: 'Last Name ',
            allowBlank: false,
            minLength: 1,
			msgTarget: 'side'
        
		},{
            xtype: 'textfield',
            name: 'middle_name',
            fieldLabel: 'Middle Name ',
            allowBlank: false,
            minLength: 1,
			msgTarget: 'side'
        
		},{
            xtype: 'textfield',
            name: 'first_name',
            fieldLabel: 'First Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'idorpassport_number',
            fieldLabel: 'Idorpassport Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'dob',
            fieldLabel: 'Dob ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'pin',
            fieldLabel: 'Pin ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'gender',
            fieldLabel: 'Gender ',
            allowBlank: false,
            minLength: 1
        
		}]
		}
		  ]
    },{
        title:false,
		
		margin: '10 5 5 5',
        columnWidth: 0.25,
		border:false,
		bodyPadding: 10,
		items:[/*{
            html: '<div id="personpicture">'
			+'<img src="../template/images/default_employee_image.gif" alt="emp" width="95" height="112" /></div>'
        
		},{
            xtype: 'button',
			//margin: '5 5 5 5',
            name: 'closure_reason',
            text: 'Add Photo',
            allowBlank: false,
            minLength: 1
        
		}*/]
    }]
						
						
						
						
						/////////////////////////////////////////////////
					},
				 //
				 {xtype:'tabpanel',
				 
				 title:false,
				 bodyPadding: 10,
				 items:[
        {
        xtype: 'form',
		tbar:[{
                    text:'Add new',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Configure options',
                    iconCls:'option'
                },'-',{
                    text:'Search',
                    tooltip:'Delete selected item',
                    iconCls:'search'
                },'-',{
                    text:'View',
                    tooltip:'View table Grid',
                    iconCls:'grid',
					handler:function(buttonObj, eventObj) { 
									createFormGrid('Save','NOID','admin_person','g')
									}
                }],
		resizable:true,
        frame: true,
		url:'bodysave.php',
        width: 550,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' admin person',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'admin_person'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
            name: 'person_name',
            fieldLabel: 'Person Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'last_name',
            fieldLabel: 'Last Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'middle_name',
            fieldLabel: 'Middle Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'first_name',
            fieldLabel: 'First Name ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'idorpassport_number',
            fieldLabel: 'Idorpassport Number ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
            name: 'dob',
            fieldLabel: 'Dob ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'pin',
            fieldLabel: 'Pin ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'gender',
            fieldLabel: 'Gender ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
            name: 'status',
            fieldLabel: 'Status ',
            allowBlank: false,
            minLength: 1

        
		}],dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Save Person',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                       // Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   eval(o.result.savemsg);
                    }
                });
            }
        }
    }
	
		]
        }]
   
						
						},{
						xtype: 'form',
						title: 'Child Panel 3',
						//height: 500,
						width: '75%',
						items:[{html: '<div id="innerdata"></div>'},{xtype: 'textfield',margin:'5 5 5 5', name: 'status',fieldLabel: 'Tribe ',msgTarget: 'side',allowBlank: false,minLength: 1},{xtype: 'textfield',margin:'5 5 5 5',name: 'status',fieldLabel: 'age ',msgTarget: 'side',allowBlank: false,minLength: 1}],
						
						
						
						////////////////////////////////////////////////++++++++++++++++++++++++++++++++++
						 dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'formMytiple.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
					   
                    }
                });
            }
        }
    }
	
		]
        }]
   
						
						//************************************************************************************
				  }]}
				  //
		]
        
});

 
 }
 
</script>
<script>
function createFormTabs(loadtype,rid,tablename,pd){
 Ext.Ajax.request({
  loadMask: true,
  url: 'tabform.php?t='+tablename+'&fd='+rid+'&pd='+pd,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}
</script>
<script>
function createTabbedv2(){
   loadtype='Save';
    Ext.create('Ext.panel.Panel', {
    renderTo: 'detailinfo',
    width: 700,
	bodyPadding:10,
    title: 'User registration',
    items: [
			     {
	layout:'column',
    items: [{
        title: false,
        columnWidth: .65,
		bodyPadding: 10,
		border:false,
		items:[{
			xtype: 'fieldset',
			title: 'Personal Details',
			width:380,
			collapsible:true,
			iconCls:'usergroup',
			items: [{xtype:'hidden',
             name:'t',
			 value:'admin_person'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'textfield',
            name: 'person_name',
            fieldLabel: 'Person Name ',
            allowBlank: false,
            minLength: 1}]
		      }]
    },{
        title:'photo',
		margin: '10 5 5 5',
        columnWidth: 0.25,
		border:false,
		bodyPadding: 10,
		items:[{
            xtype: 'textfield',
            name: 'person_name',
            fieldLabel: 'Person Name ',
            allowBlank: false,
            minLength: 1}]
    }]
			/////////////////////////////////////////////////
					},
				 //
				 {xtype:'tabpanel',
				 title:false,
				 bodyPadding: 10,
				 items:[{
            xtype: 'textfield',
            name: 'person_name',
            fieldLabel: 'Person Name ',
            allowBlank: false,
            minLength: 1}]
				 }
				 
			]}
				 );

 
 }
 </script>
 <script>
 function showMenuDesign(){
var x=document.getElementById('mycurrentmenu');
x.innerHTML='';
Ext.create('Ext.menu.Menu',{
items: [{ // 1
text: "<b>Users</b>",
iconCls:'user-girl',
menu:[{text:'musee'},
{text:'mulimani'}]
},
{
text: "<i>Italic</i>"
},
{
text: "<u>Underline</u>"
}],
floating: false, // 2
width: 100, // 3
renderTo:'mycurrentmenu'
});
}
 </script>
 <script>
 function showContextMenu(grid, index, event) {
	      event.stopEvent();
	      var record = grid.getStore().getAt(index);
	      var menu = new Ext.menu.Menu({
	            items: [{
	                text: 'Show Job ID',
	                handler: function() {
	                    alert(record.get('role_id'));
	                }
	            }, {
	                text: 'Show Customer',
	                handler: function() {
	                    alert(rec.get('role_name'));
	                }
	            }]
	        }).showAt(event.xy);
	}
</script>
<input type="hidden" onClick="dynamicRadioGroupTest();" value="test panels;"/>
<input type="hidden" onClick="createFormTabs('loadtype','rid','tablename');" value="create primary view;"/>
<input type="hidden" onClick=" createTabbed1();" value="primary static from file"/>
<input type="hidden" onclick="showMenuDesign();" value="Popup Menu"/>
<div id="mycurrentmenu"></div>
<script>
function repeatingRegionAdd(displayhere,loadtype,rid){
var obj=document.getElementById(displayhere);
obj.innerHTML='';
Ext.onReady(function() {
var fieldnamed='';
Ext.tip.QuickTipManager.init();
        var formPanel = Ext.widget('form', {
        renderTo: displayhere,
		resizable:true,
        frame: true,
		id:'accountform',
		url:'bodysave.php',
        width: 700,
        bodyPadding: 10,
        bodyBorder: true,
		wallpaper: '../sview/desktop/wallpapers/desk.jpg',
        wallpaperStretch: false,
        title: ' account accreation',

        defaults: {
            anchor: '100%'
        },
        fieldDefaults: {
            labelAlign: 'left',
            msgTarget: 'none',
            /*invalidCls: '' 
			unset the invalidCls so individual fields do not get styled as invalid*/
        },

        /*
         * Listen for validity change on the entire form and update the combined error icon
         */
        listeners: {
            fieldvaliditychange: function() {
                this.updateErrorState();
            },
            fielderrorchange: function() {
                this.updateErrorState();
            }
        },

        updateErrorState: function() {
            var me = this,
                errorCmp, fields, errors;

            if (me.hasBeenDirty || me.getForm().isDirty()) { 
                errorCmp = me.down('#formErrorState');
                fields = me.getForm().getFields();
                errors = [];
                fields.each(function(field) {
                    Ext.Array.forEach(field.getErrors(), function(error) {
                        errors.push({name: field.getFieldLabel(), error: error});
                    });
                });
                errorCmp.setErrors(errors);
                me.hasBeenDirty = true;
            }
        },

        items: [
		
		{xtype:'hidden',
             name:'t',
			 value:'account_accreation'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },{
            xtype: 'numberfield',
            name: 'Credit_limit',
            fieldLabel: 'Credit Limit ',
            allowBlank: false,
            minLength: 1
        
		},{xtype:'fieldset',
		   title:'Testing',
		   id:'mysuser',
		   items:[{
            xtype: 'textfield',
            name: 'invoice_id',
            fieldLabel: 'invoice',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'button',
			margin: '5 5 5 5',
			text:'Add item',
			handler: function() {
			
    var container = this.up('fieldset');
	var itemnum=0;
    var config = Ext.apply({}, container.initialConfig.items[1]);
    config.fieldName = container.items.length + 1;
	
	
	var fieldnamed=container.items.length + 1;
	itemnum=fieldnamed-2;
    container.add({
            xtype: 'textfield',
            name: 'item',
			width:400,
            fieldLabel: 'Item ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
            name: 'amount',
			width:300,
            fieldLabel: 'Amount ',
            allowBlank: false,
            minLength: 1
        
		});
        }}]}], dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
            layout: {
                type: 'hbox',
                align: 'middle'
            },
            padding: '10 10 5',

            items: [{
                xtype: 'component',
                id: 'formErrorState',
                baseCls: 'form-error-state',
                flex: 1,
                validText: 'Form is valid',
                invalidText: 'Form has errors',
                tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for=><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),

                getTip: function() {
                    var tip = this.tip;
                    if (!tip) {
                        tip = this.tip = Ext.widget('tooltip', {
                            target: this.el,
                            title: 'Error Details:',
                            autoHide: false,
                            anchor: 'top',
                            mouseOffset: [-11, -2],
                            closable: true,
                            constrainPosition: false,
                            cls: 'errors-tip'
                        });
                        tip.show();
                    }
                    return tip;
                },

                setErrors: function(errors) {
                    var me = this,
                        baseCls = me.baseCls,
                        tip = me.getTip();

                    errors = Ext.Array.from(errors);

                    
                    if (errors.length) {
                        me.addCls(baseCls + '-invalid');
                        me.removeCls(baseCls + '-valid');
                        me.update(me.invalidText);
                        tip.setDisabled(false);
                        tip.update(me.tipTpl.apply(errors));
                    } else {
                        me.addCls(baseCls + '-valid');
                        me.removeCls(baseCls + '-invalid');
                        me.update(me.validText);
                        tip.setDisabled(true);
                        tip.hide();
                    }
                }
            }, 
			
			
	/*now submit*/
	{
		xtype: 'button',
        text: 'Submit Data field',
	handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'saverepeat.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
                    }});
            }
        }
    }
	
		]
        }]
    });
	
	
if(loadtype=='updateload'){
loadaccount_accreationinfo(formPanel,rid);
}

});
var usr=Ext.getCmp('mysuser').add({
            xtype: 'numberfieldv2',
            name: 'Credit_limit2',
            fieldLabel: 'Credit Limit by Kwatuha ',
            allowBlank: false,
            minLength: 1
        
		});
fielset.add()

}/*launchForm()*/




function OpenBills(){
//window.close('../reporting/invoice.php?t='+tablename);
window.location.assign('bill/wb2.php');
}

function OpenPayslip(){
//window.close('../reporting/invoice.php?t='+tablename);
window.location.assign('../reporting/rpt/payslip.php');
}

function OpenPayslip(){
//window.close('../reporting/invoice.php?t='+tablename);
window.location.assign('../reporting/rpt/payslip.php');
}
function OpenVariance(){
//window.close('../reporting/invoice.php?t='+tablename);
window.location.assign('bill/variance.php');
}

function OpenFieldcard(){
//window.close('../reporting/invoice.php?t='+tablename);
window.location.assign('bill/fieldcard.php');
}
//////////////
function openWord() {
file='../msdoc/ref/AdvancedTable.docx';
    try {
        var objword = new ActiveXObject("Word.Application");
    } catch (e) {
        alert(e + 'Error Word');
    }

    if (objword != null) {
        objword.Visible = true;
        objword.Documents.Open(file);
        objword.WindowState = 2;
        objword.WindowState = 1;
    }
}
///
function CreateRightsAssignment(){
///////
Ext.define('cmbsecondarytableListdata', {
    extend: 'Ext.data.Model',
	fields:['table_caption','table_name']
	});

var secondarytableListdata = Ext.create('Ext.data.Store', {
    model: 'cmbsecondarytableListdata',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});
secondarytableListdata.load();
///////////
Ext.create('Ext.panel.Panel', {
    title: 'Column Layout - Percentage Only',
    width: 650,
   // height: 250,
    layout:'column',
    items: [{
        title: 'AddRoles',
        columnWidth: .4,
		margin: '10 5 5 5',
		bodyPadding: 10,
		bodyBorder: true,
		items:[{
    xtype: 'combobox',
	name:'tablelist_secondary',
	id:'tablelist_secondary',
	forceSelection:true,
    fieldLabel: 'Sub',
    store: secondarytableListdata,
      queryMode: 'remote',
    displayField: 'table_caption',
    valueField: 'table_name',
	listeners: { select: function(combo, record, index ) { 
	var secelVal = Ext.getCmp('tablelist_secondary').getValue();
	alert(secelVal);
	fieldlist_visibledata.proxy.extraParams = { fieldsearchtbl:secelVal}; 
	fieldlist_visibledata.load();
	 }}
	},{
 xtype: 'checkboxgroup',
 fieldLabel: 'Two Columns',
 columns: 2,
 vertical: true,
 items: [
 { boxLabel: 'Item 1', name: 'rb', inputValue: '1' },
 { boxLabel: 'Item 2', name: 'rb', inputValue: '2' },
 { boxLabel: 'Item 3', name: 'rb', inputValue: '3' },
 { boxLabel: 'Item 4', name: 'rb', inputValue: '4' },
 { boxLabel: 'Item 5', name: 'rb', inputValue: '5' },
 { boxLabel: 'Item 6', name: 'rb', inputValue: '6',
 handler:function(){
 alert('kwwwwwwwwwwwwww'
 );
 } }
 ]
 }]
 
    },{
        title:'Existing Roles',
		margin: '10 5 5 5',
        columnWidth: 0.6,
		frame: true,
		bodyPadding: 10,
		
        bodyBorder: true,
		items:[{
            xtype: 'textfield',
			//margin: '10 5 5 5',
            name: 'athourized_by',
            fieldLabel: 'Athourized By ',
            allowBlank: false,
			width:360,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			//margin: '5 5 5 5',
            name: 'closure_reason',
            fieldLabel: 'Closure Reason ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			//margin: '5 5 5 5',
            name: 'closure_date',
            fieldLabel: 'Closure Date ',
            allowBlank: false,
            minLength: 1
        
		}]
    }],
    renderTo: 'detailinfo'
});
}
</script>
<script>

////
function createCheckitesm(viewId){

 Ext.Ajax.request({
  loadMask: true,
    url: 'cmbdesgn.php?rtr=admin_table&grp='+viewId,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}
///////
</script>
<script>
function createCheRolePrivileges(viewId,rid){

 Ext.Ajax.request({
  loadMask: true,
    url: 'rtn.php?rtr=admin_table&grp='+viewId+'&rid='+rid,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
      }
    });
}

function showPhotoMenu(primarytable,pid,photoname,currentpicture,formid){
Ext.require([
    'Ext.form.*',
    'Ext.window.Window'
]);

	
Ext.onReady(function() {
    var form = Ext.create('Ext.form.Panel', {
        border: false,
        fieldDefaults: {
            labelWidth: 55
        },
        
        defaultType: 'textfield',
        bodyPadding: 10,
		maximizable:true,

        items: [
		{xtype:'hidden',value:'admin_photo',name:'t'},
		
		{xtype:'hidden',value:photoname,name:'photo_name'},
		{xtype:'hidden',value:pid,name:'source_ref'},
		{xtype:'hidden',value:primarytable,name:'source_tablelist'},
		{xtype:'hidden',value:'Save',name:'tttact'},{
            fieldLabel: 'Picture',
			msgTarget:'side',
			xtype:'filefield',
            name: 'photo',
			allowBlank:false,
            anchor: '100%'  // anchor width by percentage
        },{
            boxLabel: 'Preferred',
            name: 'prefered',
			msgTarget:'side',
			xtype:'checkbox',
			inputValue:'Preferred',
			allowBlank:false,
            anchor:'100%'  // anchor width by percentage
        }],
		dockedItems: [{
            xtype: 'container',
            dock: 'bottom',
			layout: {
                type: 'hbox',
                align: 'middle'
            },
            items:[
		{
		xtype: 'button',
		margin:'5 5 5 5',
        text: 'Upload',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
						//createFormTabs('Save',formid,primarytable,pid);
						//primarytable,pid,photoname,currentpicture,formid,cphoto
						eval(o.result.savemsg);
			
						
                    }
                });
            }//if
        }//handler
    },{
		xtype: 'button',
		margin:'2 5 5 0',
        text: 'Cancel',
        handler: function() {
            var form = this.up('form').getForm();
            if(form.isValid()){
                form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        //Ext.Msg.alert('Success', '' + o.result.savemsg + '"');
						eval(o.result.savemsg);
						
						
						
                    }
                });
            }//if
        }//handler
    }]}]
    });

    var win = Ext.create('Ext.window.Window', {
        title: 'Manage Photo',
		maximize:true,
        width: 300,
        height:80,
        minWidth: 300,
        minHeight: 200,
        layout: 'fit',
        plain: true,
        items: form,
    });

    win.show();
	
});
}


///////////
</script>

    <script type="text/javascript" src="../dataview/data-view.js"></script>
	<script type="text/javascript" src="../dataview/viewCharts.js"></script>
	<script type="text/javascript" src="../template/functions/createGroupedGrids.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../dataview/data-view.css"/>
	
<div id="dataview-example"></div>

<div id="dataviewselected"></div>
<!--<input type="button" onClick="createDataView('admin_person')" value="Show data"/>
<input type="button" onClick="repeatingRegionAdd('detailinfo','save',1)" value="repeat"/>
<input type="button" onClick="OpenContract()" value="Open Contract"/>
<input type="button" onClick="CreateRightsAssignment()" value="Rights"/>
<input type="button" onClick="createCheckitesm( 'admin');" value="rights for me"/>
<input type="button" onClick="createRoleTabbed();" value="Role Rights"/>

<input type="button" onClick="showPhotoMenu('admin_person',13);" value="Role photo"/>

<input type="button" onClick="com_sendemailForm('dynamicchild','Save','NOID');" value="Show repeat"/>
<input type="button" onClick="createGroupedGrid();" value="Show grouped"/>
<input type="button" onClick="checkURL('http://localhost:5000/' )" value="Check SMS Server"/>
<input type="button" onClick="checkInternetConnection()" value="Check Internet connectivity"/>
-->

<div id="formview"></div>
<!--<button onClick="createCounterLedger()" value="Dyanmic Show hide"></button>
--><!--<input type="button" onClick="createBarGraph()" value="read Data"/>
<input type="button" onClick="createDynamicChart('detailinfo')" value="show chart"/>
<input type="button" onClick="createDynamicChartView('admin_company')" value="show chart view"/>
-->
<script>
function OpenContract(){
//window.close('../reporting/invoice.php?t='+tablename);
window.location.assign('../msdoc/ref/AdvancedTable.docx');
}
function OpenlandlordContract(lid){

//window.close('../reporting/invoice.php?t='+tablename);
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/management.php?lid='+lid,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function OpenTenantContract(lid,tpid){

//window.close('../reporting/invoice.php?t='+tablename);
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/tenancy.php',
  params: {id: "1",tp:tpid,lid:lid},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function OpenTenantNotification(lid,tpid){

//window.close('../reporting/invoice.php?t='+tablename);
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/notification.php?lid='+lid,
  params: {id: "1",tp:tpid,lid:lid},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}
function createFillLandlordDetails(pid,owner){
 Ext.Ajax.request({
  loadMask: true,
  url: 'cmb.php?sptid='+pid+'&yor='+owner,
  params: {id: "1"},
  success: function(resp) {
  var pv=resp.responseText;
  var infor=pv.split('||');
	  var property=infor[0];
	  var lndid=infor[1];
	  
	  var lacid=infor[2];
    Ext.getCmp('landlordproperty').setValue(property);
    Ext.getCmp('lipersonname').setValue(lndid);
	Ext.getCmp('landlordid').setValue(lacid);
	
  
  
  
      }
    });
}

function OpenReceiptv2(tablename){
//window.close('../reporting/invoice.php?t='+tablename);
window.open('../reporting/rcpt.php?t='+tablename);
}

function OpenMyPayslip(pid){
//window.close('../reporting/invoice.php?t='+tablename);
window.open('../reporting/rpt/revisedpayslip.php?rd='+pid);
}
function OpenMyhistology(pid){
window.open('../reporting/rpt/histology.php?rd='+pid);
}
function OpenCytology(pid){
window.open('../reporting/rpt/cytology.php?rd='+pid);
}

function changeNotificationDiv(){
   var secelVallid = Ext.getCmp('notifyme').addClass('accordion');
	secelVallid.setValue('kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk');
}

//////////////
function displayNotifionIntroMsg(){
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
	//$('#flashnotificationMSG').addClass("showFlashMSG");
	//document.getElementById('flashnotificationMSG').innerHTML=xmlHttp.responseText;
	
	//setTimeout('displayNotifionIntroMsg()',20000);
		
	}
	if (xmlHttp.status == 200) {
					var response=xmlHttp.responseText;	
						if(response!="New Messages Not Available"){
						 
						
						//$('#notifyme').fadeIn('slow',hideDivBaseTime());
						$('#notifyme').addClass("showFlashMSG");
						$('#notifyme').removeClass('hideFlashMSG');
						document.getElementById('notifyme').innerHTML=xmlHttp.responseText;
						 
						
						}
						else{
						$('#notifyme').addClass("hideFlashMSG");
						}
}
}
xmlHttp.open("GET","flashMSG.php",true);
xmlHttp.send(null);
}//////////////////////////////////////

function hideDivBaseTime(){
	setTimeout("$('#notifyme').addClass('hideFlashMSG')",20000);
}
function showmynotifications (){
createFormGrid("Save","NOID",'admin_groupnotificationhist',"g");
}
function refreshfhome(){
window.location.assign('./');
}

function OpenEditField(lid){

//window.close('../reporting/invoice.php?t='+tablename);
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/editform.php?lid='+lid,
  params: {id: "1"},
  success: function(resp) {
  //eval(resp.responseText);
   alert('done');
      }
    });

}

//
function OpenDBnote(lid){

//window.close('../reporting/invoice.php?t='+tablename);
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/debitnote.php?lid='+lid,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}


function OpenWIncvoice(lid){

//window.close('../reporting/invoice.php?t='+tablename);
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/invoice.php?lid='+lid,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function OpenWIReceipt(lid){
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/receipt.php?lid='+lid,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}
function OpenWStatement(lid){
Ext.Ajax.request({
  loadMask: true,
    url: '../msdoc/ref/statement.php?lid='+lid,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}
 
 function createCks(lid){
 Ext.Ajax.request({
  loadMask: true,
    url: 'createcheck.php?lid='+lid,
  params: {id: "1"},
  success: function(resp) {
  //eval(resp.responseText);
  var cks=Ext.getCmp('reportview_id').add(resp.responseText);
      }
    });
	//alert('WSSSSSSS'+checks);

}

function TestSJ(){
Ext.Ajax.request({
  loadMask: true,
    url: 'testscipt.php',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function filloutPaye(amt,a,d){
Ext.Ajax.request({
  loadMask: true,
    url: 'calpayroll.php?p='+amt+'&a='+a+'&d='+d,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function createDNote(){
Ext.Ajax.request({
  loadMask: true,
    url: 'dnotedsn.php',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}
function registerperson(){
Ext.Ajax.request({
  loadMask: true,
    url: 'pr.php',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}
function housingrpts(){
Ext.Ajax.request({
  loadMask: true,
    url: 'hrpt.php',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function housingrpls(){
Ext.Ajax.request({
  loadMask: true,
    url: 'hrpl.php',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function savedData(){
Ext.Msg.show({
title:'Success',
msg: 'Changes saved!',
buttons: Ext.Msg.OK,
icon: Ext.Msg.INFO
});
}

function genMsg(mtitle,msg){
Ext.Msg.show({
title:mtitle,
msg: msg,
buttons: Ext.Msg.OK,
icon: Ext.Msg.INFO
});
}

function showerror(errorid){
Ext.Msg.show({
title:'Missing Info',
msg: errorid,
buttons: Ext.Msg.OK,
icon: Ext.Msg.ERROR
});
}

function insurancerpts(){
Ext.Ajax.request({
  loadMask: true,
    url: 'insrpt.php',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}

function insReceipts(){
Ext.Ajax.request({
  loadMask: true,
    url: '../reporting/rpt/receipt.php',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}
function deleteRecord(tbl,ti){
Ext.Ajax.request({
  loadMask: true,
    url: 'del.php',
  params: {id: "1",tb:tbl,tbi:ti},
  success: function(resp) {
  eval(resp.responseText);
  
      }
    });

}
</script>
<!--<input type="hidden" class="girl-user" onClick="createCheRolePrivileges('Com',4);" value="Roles"/><input type="button" onClick="SendBatchSMSs()" value="Batch SMS"/>
<input type="button" onClick="OpenFieldcard()" value="Field Card" />-->
<div id="welcome">Welcome  <?php echo $cusername; ?></div>
<div id="notifyme"></div>
<input type="hidden" onClick="createFormTabs('Save',23,'admin_person',2)" value="manage employee"/>
<input type="button" onClick="TestSJ()" value="Employee Data"/>
<!--<input type="button" onClick="createCheRolePrivileges('Com',4);" value="Role Rights"/>
--><!--/*<input type="button" onClick="OpenMyhistology(1)" value="Histopathology"/>
<input type="button" onClick="OpenCytology(2)" value="Cytology"/>
<input type="button" onClick="OpenDBnote(2)" value="Debot Note"/>*/-->

<!--<input type="button" onClick="OpenWIncvoice(2)" value="Invoice"/>
<input type="button" onClick="OpenWIReceipt(2)" value="Receipt"/>

<input type="button" onClick="OpenWStatement(2)" value="Statement"/>

<input type="button" onClick="QuereyReport(2)" value="Query"/>
<input type="button" onClick="createReportView()" value="Reports"/>

<input type="button" onClick="createReportGroups()" value="createReportGroups"/>

<input type="button" onClick="gridCreateReportGroups()" value=" Report groups"/>


<input type="button" onClick="createDNote()" value="Debit Note"/>

<input type="button" onClick="registerperson()" value="Regist"/>
<input type="button" onClick="rvdib('sdfsd','EMP/00000078/2012','admin_person',90,2);
" value="Registn IN"/>-->

<!--<input type="button" onClick="OpenBills()" value="Bills"/>
<input type="button" onClick="OpenVariance()" value="variance"/>

<input type="button" onClick="OpenPayslip()" value="Payslip"/>
<input type="button" onClick="createDataView('admin_person')" value="Employee Photos"/>
<input type="button" onClick="createDynamicChart('detailinfo')" value="Charts"/>



<input type="button" onClick="insurance_insurancedebitnoteFormRevised('Hurun Mwema','INS002','admin_person',2,'fillcode')" value="manage INClient"/>
<input type="button" value="invoice" onClick="OpenInvoice('accounts_accountactivity')" />
<input type="button" value="statement" onClick="OpenStatement('accounts_accountactivity')" />

<input type="button" value="Receipt" onClick="OpenReceipt('accounts_accountactivity')" />

<input type="button" value="Receipt v2" onClick="OpenReceiptv2('accounts_accountactivity')" />



<input type="button" value="client underwriter" onClick="selectUnderwriter('Hue Hurrison  anana','038308',1)" />

<input type="button" value="test insur" onClick="insurance_insurancedebitnoteFormRevised('harom fff ff','t10209ded','admin_person',3);" />
-->
