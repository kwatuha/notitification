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
	<script type="text/javascript" src="../template/functions/extforms.js"></script>
	<script type="text/javascript" src="../template/functions/grid.js"></script>
	 <script src="../sview/dialog.js"></script>
	<script language="JavaScript" src="../template/functions/formload.js"></script>
	<script language="JavaScript" src="../template/functions/grid.js"></script>
    <script language="JavaScript" src="../template/functions/forms.js"></script>
	<script language="JavaScript" src="../template/functions/extforms.js"></script>
	
	<script language="JavaScript" src="analysis/example-data.js"></script>
	<script language="JavaScript" src="analysis/column.js"></script>
<script>


function MainPages(){
Ext.onReady(function() { 
        var accordion = new Ext.Panel({ 
            region:'west', 
            margins:'5 0 5 5', 
            split:true, 
            width: 210, 
            layout:'accordion' 
        }); 
 
        new Ext.Viewport({ 
		  loadMask: true,

            layout:'border', 
            items:[
			{
            xtype: 'box',
            id: 'header',
            region: 'north',
            html: '<h1><b> Xforms Forms </b> </h1>',
            height: 30
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
									handler:function(buttonObj, eventObj) { 
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
				lbar:tbars,wowo
				
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

<div id="formview"></div>
<input type="button" onClick="createBarGraph()" value="read Data"/>
<input type="button" onClick="createDynamicChart()" value="where eit it personal"/>
<div id="charts" style="background-image:url(../sview/desktop/wallpapers/blue.jpg)" > Chart Infor sdsdas </div>

<div id="formin"></div>


<!--<script type="text/javascript" src="reorder.js"></script>-->
<script>

function showMenu(){
var x=document.getElementById('popupmenu');
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



//////

</script>
<div id="la">

<input type="button" value="login" class="ux-start-button-icon" onClick=" MainPage()"/>
<input type="button" value="Logout" onClick=" logOut()"/>
</div>
 <div id="popupmenu">my menu</div>
<div id="chart1"></div> 
<div id="chartDiv"></div> 
 <img src="../../interfaceDesign/examples/desktop/images/chart48x48.png" longdesc="../layout/images/chart48x48.png" onMouseOver="showMenu()" >Charts
</body>
</head>
</html>