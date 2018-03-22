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

?><?php
include('../template/functions/menuLinks.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../sview/resources/css/ext-all.css"/>

    <!-- GC -->
	
    <script type="text/javascript" src="../sview/bootstrap.js"></script>
	
	<script>
	
				Ext.onReady(function() {
			  setTimeout(function(){
				Ext.get('loading').remove();
				Ext.get('loading-mask').fadeOut({remove:true});
			  }, 250);
			});
	</script>
	
	<!--<script language="JavaScript" src="../template/functions/direct.js"></script>
	<script type="text/javascript" src="php/api.php"></script>-->
   
    <link rel="stylesheet" type="text/css" href="../sview/shared/example.css"/>
 <link rel="stylesheet" type="text/css" href="../view/layout-browser.css"/>
 <link rel="stylesheet" type="text/css" href="../layout/css/desktop.css"/>
	
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
	<script>
	var rsptext;
	</script>
	<script src="../sview/dialog.js"></script>
	<script language="JavaScript" src="../template/functions/formload.js"></script>
    <script language="JavaScript" src="analysis/example-data.js"></script>
	<script language="JavaScript" src="analysis/column.js"></script>
	<script type="text/javascript" src="../viewdesign/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="../template/functions/coreSharedJavascript.js"></script>

<script language="JavaScript" src="../template/functions/gridform.js"></script>

<script>


function MainPage(){
Ext.onReady(function() { 
        var accordion = new Ext.Panel({ 
            region:'west',
			loadMask:true, 
            margins:'5 0 5 5', 
            split:true, 
            width: 210, 
            layout:'accordion',
			tbar:[{
                    text:'Log Out',
                    tooltip:'End your current session',
                    iconCls:'logout',
					handler:logoutuser
                }, '-', {
                    text:'User Rights',
                    tooltip:'Assign User Rights',
                    iconCls:'settings',
					handler:displayRightsOptions
                }]
        }); 
 ////
    new Ext.Viewport({ 
		  loadMask: true,

            layout:'border', 
            items:[
			{
            xtype: 'box',
            id: 'header',
            region: 'north',
            html: '<h1><b>ODK Collect Forms </b> </h1>',
            height: 30
			
			///tbar
			
        },
		  
              accordion,  
              {region:'center',
			   //bodystyle:"background-image:url(../sview/desktop/wallpapers/blue.jpg)",
			   autoScroll:true,
			   height: 700,
			   bodyStyle:'background-image:url(../sview/desktop/wallpapers/Wood-Sencha.jpg);padding:10px;',
			   
			   html:'<div id="detailinfo"  ></div>'}]  
        }); 
          
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
									autoScroll:true,
									iconCls:'deleteicon',
									handler:function(buttonObj, eventObj) { 
									//alert(tablevalgrpArr[2]);
									eventObj.click(eval(tablevalgrpArr[2]));
									//eval(tablevalgrpArr[2]);
											}
									}
									);//push
					  }
                   });

			   ///////////////////////
				cfgs.push({
				html:'<div id="top-menu"></div>',
				title:op.message,
				lbar:tbars
				
				}) ;
				//Ext.erase(tbars);
				
				
    });
	accordion.add(cfgs);
  }
});//on onready
}); 
}	
</script>
<style>
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
function createDynamicChart(){
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
		chart2(cfgs,charttitle);
		//end of chart
      }//close success
    });//request
}//close function
//general chart
function chart2(chartArray){


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
        renderTo: 'chart1',
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
var x=document.getElementById('menugen');
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
width: 100 // 3
renderTo:'menugen'
});
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
                    title: 'X Forms',
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
function authUser(){
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

/*Ext.onReady(function() {
//createTopMenu();

MainPage();

});*/

Ext.onReady(function(){
       regionContent = new Ext.Panel({
        id: 'contentArea',
        region: 'center',
        padding:'10',
        autoScroll: true
    });

    var viewport = new Ext.Viewport({
        layout: 'border',
        items: [ regionMenu, regionContent ]
    });

    clearExtjsComponent(regionContent);
    var start_info_panel = new Ext.Panel({
        title: 'Start Info',
        padding: 10,
        width: 300,
        html: 'this panel was added from the start view'
    });
    regionContent.add(start_info_panel);
    regionContent.doLayout();

});


function clearExtjsComponent(cmp) {
    var f;
    while(f = cmp.items.first()){
        cmp.remove(f, true);
    }
}


//////

</script>
<script>
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
		});/////////////////
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
<script>
function gridViewform_amrsconcepts(){ 
var viewdiv=document.getElementById('detailinfo'); 
viewdiv.innerHTML=''; Ext.QuickTips.init(); 
var closebtn= Ext.get('close-btn'); 
var viewgrbtnform_amrsconcepts = Ext.get('gridViewform_amrsconcepts');
 Ext.define('Form_amrsconcepts', { extend: 'Ext.data.Model', fields:['amrsconcepts_id','formgenconcepts_name','amrsconceptname','Description','Synonyms','Answers','Set_Members','Class','Datatype','Changed_By','Creator'] }); 
 var store = Ext.create('Ext.data.Store', { model: 'Form_amrsconcepts', proxy: { type: 'ajax', url : 'buidgrid.php?t=form_amrsconcepts', reader: { type: 'json' } } }); store.load(); 
 var grid = Ext.create('Ext.grid.Panel', { store: store, stateful: true, multiSelect: true, iconCls: 'icon-grid', stateId: 'stateGrid', animCollapse:false, constrainHeader:true, layout: 'fit', columnLines: true, bbar:{height: 20}, columns:[ new Ext.grid.RowNumberer(),{ text : ' Amrsconcepts Id ' , width : 80 , sortable : true , dataIndex : 'amrsconcepts_id' }, 
 { text : ' Formgenconcepts Name ' , flex : 1 , sortable : true , dataIndex : 'formgenconcepts_name',filterable: true }, { text : ' Amrsconceptname ' , filterable: true, width : 80 , sortable : true , dataIndex : 'amrsconceptname' }, { text : ' Description ' , width : 80 , sortable : true , dataIndex : 'Description' }, { text : ' Synonyms ' , width : 80 , sortable : true , dataIndex : 'Synonyms' }, { text : ' Answers ' , width : 80 , sortable : true , dataIndex : 'Answers' }, { text : ' Set Members ' , width : 80 , sortable : true , dataIndex : 'Set_Members' }, { text : ' Class ' , width : 80 , sortable : true , dataIndex : 'Class' }, { text : ' Datatype ' , width : 80 , sortable : true , dataIndex : 'Datatype' }, { text : ' Changed By ' , width : 80 , sortable : true , dataIndex : 'Changed_By' }, { text : ' Creator ' , width : 80 , sortable : true , dataIndex : 'Creator' }, { menuDisabled: true, sortable: false, xtype: 'actioncolumn', width: 50, items: [{ icon : '../shared/icons/fam/delete.gif', tooltip: 'Sell stock', handler: function(grid, rowIndex, colIndex) { var rec = store.getAt(rowIndex); alert('Sell ' + rec.get('alert_name')); } }, { getClass: function(v, meta, rec) { if (rec.get('alert_name') < 0) { this.items[1].tooltip = 'Hold stock'; return 'alert-col'; } else { this.items[1].tooltip = 'Buy stock'; return 'buy-col'; } }, handler: function(grid, rowIndex, colIndex) { var rec = store.getAt(rowIndex); form_amrsconceptsForm('detailinfo','updateload',rec.get('amrsconcepts_id')); } }] } ] , maxHeight: 600, width: 600, resizable:true, title: ' Form Amrsconcepts', renderTo: 'detailinfo', viewConfig: { stripeRows: true, enableTextSelection: true }, tbar:[{ text:'Add Record', tooltip:'Add a new row', iconCls:'add', handler:function(){ alert('something');
 testme(); } }, '-', { text:'Options', tooltip:'Blah blah blah blaht', iconCls:'option' },'-',{ text:'Delete', tooltip:'Delete', iconCls:'remove' },'-',
 { text:'Search', 
 tooltip:'Find', 
 iconCls:'find',
  handler: function(grid, rowIndex, colIndex) { 
testme();
 }

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
	// alert(ke);
	 if(ke==13){
	 gridViewform_amrsconcepts();
	 }
	 // el
      });            
    }}
 }
 ] }); 
 
 
 
 //////////////////////////////kkkkkkkkkkkkkkkkkkkkkk
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 }
 
 function testme(){
 var x=Ext.getValue('searchfield');
 alert('kwatuha Lad=='+x);
 } 
 
 /////////////
 textfield.on('specialkey', function (el, e) {
    if(e.keyCode == e.ENTER) {
      //Call your Ajax Method
      Coolite.AjaxMethods.SearchDetails_Click(arguments);
    } 
 });
 ///////////////////////////////////////////////////////////////////////////
 function createPanels(){
 Ext.create('Ext.panel.Panel', {
    //width: 500,
	fit:true,
    height: 400,
    title: 'Border Layout',
    layout: 'border',
    items: [{
        title: 'South Region is resizable',
        region: 'south',     // position for region
        xtype: 'panel',
        height: 100,
        split: true,         // enable resizing
        margins: '0 5 5 5'
    },{
        // xtype: 'panel' implied by default
        title: 'West Region is collapsible',
        region:'west',
        xtype: 'panel',
        margins: '5 0 0 5',
        width: 200,
        collapsible: true,   // make collapsible
        id: 'west-region-container',
        layout: 'fit'
    },{
        title: 'Center Region',
        region: 'center',     // center region is required, no width/height specified
        xtype: 'panel',
        layout: 'fit',
        margins: '5 5 0 0'
    },
	{
        title: 'East',
        region: 'east',     // center region is required, no width/height specified
        xtype: 'panel',
        layout: 'fit',
        margins: '5 5 0 0',
		width: 100,
		collapsible: true,
		split: true 
    },
	/*{
        //title: 'North thern',
		id: 'header',
        region: 'north',     // center region is required, no width/height specified
        xtype: 'box',
        layout: 'fit',
        margins: '5 5 0 0',
		hieght: 10,
		html:'<div id="menugen">menu</div>',
		collapsible: true,
		tbar:[{
                    text:'Log Out',
                    tooltip:'End your current session',
                    iconCls:'logout',
					handler:logoutuser
                }, '-', {
                    text:'User Rights',
                    tooltip:'Assign User Rights',
                    iconCls:'settings',
					handler:displayRightsOptions
                }]
		//split: true 
    }*/],
	dockedItems: [{
    xtype: 'toolbar',
    dock: 'top',
    items: [{
      xtype: 'splitbutton',
      text: 'File',
      menu: {
        items: [{
          text: 'New...'
        },{
          text: 'Open...'
        }]
      }
    },{
      xtype: 'button',
      text: 'Logout',
	  iconCls:'user-girl'
      /*menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }*/
    },{
      xtype: 'splitbutton',
      text: 'Edit 2',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	//
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	//
	//
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	////
	,
	{
      xtype: 'splitbutton',
      text: 'Edit 3',
      menu: {
        items: [{
          text: 'Copy'
        },{
          text: 'Paste'
        }]
      }
    }
	//
	]    
  }],
    renderTo:'mainlink'
});

 }  
 Ext.onReady(function(){
 mainPage();
 createPanels();
 });
 
 
 
 //////////////////////////////////////////////////
 function viewWindows(){
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
                    title: 'X Forms',
					bodyStyle:'background-image:url(../sview/desktop/wallpapers/Wood-Sencha.jpg);padding:100px 10px 50px 120px',
                    html : '<div id="mainlink"</div>'
					
                }
            ]
        });
    }
});


 createPanels();
}
 ///////////////////////////////////////////////////
</script>
<div id="la"></div>
<input type="button" value="check me" onClick="loadinformaion()" />
<div id="chart1"></div> 
<div id="filldata" ></div>
<div id="actionstatusupateinfo"></div>
<div id="topmenu"></div>
<input type="button" value="show grid" onClick="gridViewform_amrsconcepts()  "/>
<input type="button" value="Panels" onClick="viewWindows()"/>
</body>
</head>
</html>