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
  // For security, start by assumiaccng the visitor is NOT authorized. 
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
require_once('../PHPMailer/class.phpmailer.php');
///sms
include('../template/functions/menuLinks.php');
?><?php
$isapproved=$_POST['filterapproved'];
$primarytable=$_POST['primarytable'];
$showashidden=$_POST['showashidden'];
$showcols=$_POST['showcols'];
//$primarytable='admin_person';
//$showcols='person_fullname';
//$showashidden='pin,gender,dob,person_id';
$primarykey=$_POST['primarykey'];
$displytype=$_POST['displytype'];
$rptroles=$_POST['rptroles'];
$displytype='tbl';
$dtable=$primarytable;

$showcolArrays=explode(',',$showcols);
$hidecolArrays=explode(',',$showashidden);
$actableArray=explode('_',$primarytable);
$primarytableColumn=$actableArray[1].'_id';
$mainmenuitems=createTopDyanamicMenu($dtable,$rptroles);
$gridproperty=createDynamicGridbySQL($showcolArrays,$hidecolArrays);

$gridmodel=$gridproperty['model'];
$gridcols=$gridproperty['gridcols'];
$selcols=$gridproperty['selcols'];


$gridcolsRprtview=$gridcols;
$gridmodelrptview=$gridmodel;
$rptroles='1,2,23';	
//echo $mainmenuitems;
echo "/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.Loader.setConfig({
    enabled: true
});
Ext.Loader.setPath('Ext.ux', '../sview/ux');

Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.ux.RowExpander',
    'Ext.selection.CheckboxModel'
]);


function insurance_insurancedebitnoteFormRevised(fullname,personcode,iowner,pid,dbnoteid){

var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';


Ext.onReady(function(){ 

Ext.define('cmbShowUsers', {
    extend: 'Ext.data.Model',
	fields:['person_fullname','person_id']
	});

var searchentrydata = Ext.create('Ext.data.Store', {
    model: 'cmbShowUsers',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?showusers=t',
        reader: {
            type: 'json'
        }
    }
});
searchentrydata.load();
var hospitalnum='',queuid='',labnum='',personname='';
///****************************************
//***************************************************
var formPanel3 = Ext.create('Ext.form.Panel', {
        region     : 'center',
		maxWidth     : 700,
		autoScroll:true,
		maxHeight:1000,
		height: 700,
		margins    : '0 0 0 3',
		id:'estsearchform',
        title      : false,
		html:'<div id=\"dynamicviewdetailinfo\"  ></div>',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        
		
		
		
        items      : [
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 }
  
			]
		,buttons: [
		{
            text: 'View PDF',
			id:'btnpf',
			handler:function(){
			    
				}
			
        },{
            text: 'Approve',
			id:'approvebtn', 
			handler:function(){
			    var dn=Ext.getCmp('dbnote_id').getValue();
				
	showApprovalComments('Approve Insurance Debit Note','insurance_approvedbnote',dn,'insurancedebitnote_id','is_approved','Approved')
				}
			
        },{
            text: 'Reject',
			id:'rejectbtn',
			handler:function(){
			var dn=Ext.getCmp('dbnote_id').getValue();
	showApprovalComments('Reject Insurance Debit Note','insurance_approvedbnote',dn,'insurancedebitnote_id','is_approved','Rejected')
				}
			
        },{
            text: 'Update',
			id:'updatebtn',  
			handler:function(){
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        }]
    });
//hide unencessary fields
   /////////////////////////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
var viewdiv=document.getElementById('detailinfo'),searchitem;
viewdiv.innerHTML='';

Ext.QuickTips.init();
Ext.define('cmbhousing_housinglandlord', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchhousing_housinglandlorddata = Ext.create('Ext.data.Store', {
    model: 'cmbhousing_housinglandlord',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_housinglandlord&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchhousing_housinglandlorddata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnhousing_housinglandlord = Ext.get('gridViewhousing_housinglandlord');	

	Ext.define('Housing_housinglandlord', {
    extend: 'Ext.data.Model',
	fields:[$gridmodel]
			
	});
	
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housinglandlord',
	
	
    proxy: {
        type: 'ajax',
		url : 'buidgrid.php?dnvgrid=1&sc=$selcols&dt=$displytype&dtt=$dtable',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
  
  ;
  ////////
      var sellAction = Ext.create('Ext.Action', {
        icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
        text: 'Delete',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
                
            } else {
                alert('Please select a record to delete');
            }
        }
    });
	
	
		var itemAction22 = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: 'Housing',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
			   var ccrecordid=rec.get('housinglandlord_id');
			   var ctableval='housing_housinglandlord';
                
				if(ctableval=='admin_role'){
				createCheRolePrivileges('Admin',ccrecordid);
				}else{
				//createFormTabs('Save',22,'housing_housinglandlord',ccrecordid);
				//alert('There was an error');
				
				}
				
				
            } else {
                alert('Please select a Housing from the grid');
            }
        }
    });
	
    var buyAction = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: 'Edit',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
                alert('asdfasdas dfdfdf');
            } else {
                alert('Please select a company from the grid');
            }
        }
    });
	
	var contextMenu = Ext.create('Ext.menu.Menu', {
        items: [
             buyAction,sellAction,itemAction22
        ]
    });

  //////////
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
		margins    : '0 0 0 3',
		listeners : {
		itemdblclick:function(dv, record, item, index, e){
		showEmployeePersonAccts();
		},
    itemclick: function(dv, record, item, index, e) {
	    
		 var ctbc='$primarytableColumn';
		Ext.getCmp('selectedrpt').setValue(record.get(ctbc));
		showSpecificReport(record.get(ctbc));
	
		}}
	   ,
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
		
		new Ext.grid.RowNumberer(),$gridcolsRprtview,
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 40,
                items: [
				 {
                    icon   : '../shared/icons/fam/Report.png',
                    tooltip: 'Show Chart ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('housingtenant_id');
						var mtid=rec.get('tenantpid');
						OpenTenantNotification(ccrecordid,mtid);
						//alert(ccrecordid+\":There was an error\");
						//createFormTabs('loadtype',ccrecordid,'housing_housingtenant');
                    }
                },{
                    icon   : '../shared/icons/fam/page_white_acrobat.png',
                    tooltip: 'Export to PDF ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('housingtenant_id');
						var mtid=rec.get('tenantpid');
						OpenTenantNotification(ccrecordid,mtid);
						//alert(ccrecordid+\":There was an error\");
						//createFormTabs('loadtype',ccrecordid,'housing_housingtenant');
                    }
                }]
            }
        ]
		
		,width: 300,
		maxHeight: 600,
        maxWidth: 300,
        title: 'Report Definition',
        region: 'west',
        viewConfig: {
            stripeRows: true,
           // enableTextSelection: true,
			listeners: {
                itemcontextmenu: function(view, rec, node, index, e) {
                    e.stopEvent();
                    contextMenu.showAt(e.getXY());
                    return false;
                }
            }
		}

	
    });
	
	///grid selection
	
	grid.getSelectionModel().on({
        selectionchange: function(sm, selections) {
            if (selections.length) {
                buyAction.enable();
                sellAction.enable();
				itemAction22.enable(); 
            } else {
                buyAction.disable();
                sellAction.disable();
				itemAction22.disable();
            }
        }
    });
	///end of grid selection	


   //hide unencessary fields
var approvalvar='".$isapproved."';
if(approvalvar=='APPROVED'){
Ext.getCmp('approvebtn').hide();
Ext.getCmp('updatebtn').hide();
Ext.getCmp('rejectbtn').hide();
}else{
Ext.getCmp('approvebtn').show(); 
Ext.getCmp('updatebtn').show();  
Ext.getCmp('rejectbtn').show();  
}
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
var  viewgrbtnhousing_housinglandlord = Ext.get('gridViewhousing_housinglandlord');	
     Ext.define('ReportViewModel', {
    extend: 'Ext.data.Model',
	fields:[$gridmodelrptview]
			
	});
	
	var rptviewstore = Ext.create('Ext.data.Store', {
    model: 'ReportViewModel',
	
	
    proxy: {
        type: 'ajax',
		url : 'buidgrid.php?dnvgrid=1&sc=$selcols&dt=$displytype&dtt=$dtable',
        reader: {
            type: 'json'
        }
    }
});
  rptviewstore.load();
  
  ;

var formPanel3 = Ext.create('Ext.form.Panel', {
        region     : 'center',
		maxWidth     : 1000,
		autoScroll:true,
		maxHeight:500,
		height: 350,
		margins    : '0 0 0 3',
		id:'estsearchform',
        title      : false,
		html:'<div id=\"dynamicviewdetailinfo\"  ></div>',
		//collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        
		
		
		
        items      : [
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
			 {xtype:'hiddenfield',
             id:'selectedrpt'
			 }
  
			],
			buttonAlign:'center',
		 buttons: [
		{
            text: 'View PDF',
			id:'btnpf',
			handler:function(){
			    var selrpt=Ext.getCmp('selectedrpt').getValue();
		         openRptPDFDn(selrpt);
				}
			
        },{
            text: 'Export Excel',
			id:'approvebtn', 
			handler:function(){
			   	}
			
        },{
            text: 'Chart View',
			id:'rejectbtn',
			handler:function(){
					}
			
        },{
            text: 'Close',
			id:'updatebtn',  
			handler:function(){
				Ext.getCmp('idestatemgtwin').close();
				}
			
        }]
    });
	///end of grid selection	


//HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        //width    : 1000,
        height   : 600,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
		  tbar:[$mainmenuitems],
        bodyPadding: '5',
        items    : [
            //formPanel
            
			grid,
			formPanel3
			
        ]
        
    });



var win = Ext.create('Ext.window.Window', {
        title: 'Reporting',
        width: 1000,
		
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'idestatemgtwin',
        plain: true,
		layout: 'fit',
        items: displayPanel,
		
	/*	dockedItems: [{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'header',
            layout: {
                pack: 'center'
            },
            items: [{
                minWidth: 80,
                text: 'Close',
				handler:function(){
				Ext.getCmp('idestatemgtwin').close();
				}
            }]
        }],*/
        /*buttonAlign:'center',
        buttons: [{
            text: 'Close',
			handler:function(){
				Ext.getCmp('idestatemgtwin').close();
				}
			
        }]*/
    });

    win.show();

});
}
insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,2);
";

?>