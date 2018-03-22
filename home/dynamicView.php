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

$roles=$_POST['roles'];
$primarykey=$_POST['primarykey'];
$displytype=$_POST['displytype'];
$displytype='tbl';
$dtable=$primarytable;

$showcolArrays=explode(',',$showcols);
$hidecolArrays=explode(',',$showashidden);
//8,9,10,11,12,14,17
$mainmenuitems=createTopDyanamicMenu($dtable,$roles);
$gridproperty=createDynamicGridbySQL($showcolArrays,$hidecolArrays);

$gridmodel=$gridproperty['model'];
//if($gridmodel)
//echo $gridmodel.'<br /><br /><br /><br /><br />';
$gridcols=$gridproperty['gridcols'];
$selcols=$gridproperty['selcols'];

$primarycolA=explode('_',$primarytable);
$primaryclmn=$primarycolA[1].'_id';


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
        region    : 'center',
        maxWidth  : 650,
        width     :650,
		autoScroll:true,
		maxHeight:650,
		height: 650,
		margins    : '0 0 0 3',
		id:'estsearchform',
        title      : 'Information',
		html:'<div id=\"dynamicviewdetailinfo\"  ></div>',
		//collapsible:true,
		//autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        
		
		
		
        items      : [
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 }
  
			]
		,buttons: [
		]
    });
//hide unencessary fields
   /////////////////////////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
var viewdiv=document.getElementById('detailinfo'),searchitem;
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
            type: 'json',
            totalProperty: 'totalCount',
            root: 'data'
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
		//showEmployeePersonAccts();
		
		var dpid=Ext.getCmp('selectedmenuitem').getValue();
		 if(dpid<=0) dpid=1;
createFormTabs('Save',dpid,'$primarytable ',record.get('person_id'),'NO','showdynamictableview');

		},
    itemclick: function(dv, record, item, index, e) {
	     var dpid=Ext.getCmp('selectedmenuitem').getValue();
		 //if(dpid<=0) dpid=1;
		  var dyamicdiv=document.getElementById('dynamicviewdetailinfo');
          dyamicdiv.innerHTML='';
		  if('$primarytable'=='admin_role'){
				createCheRolePrivileges('Admin',record.get('$primaryclmn'),'dynamicviewdetailinfo');
				}
			else{
		  Ext.getCmp('selectedpersonid').setValue(record.get('$primaryclmn'));
createFormTabs('Save',dpid,'$primarytable ',record.get('person_id'),'NO','dynamicviewdetailinfo');
                }
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
		
		new Ext.grid.RowNumberer(),$gridcols,
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 30,
                items: [
				  {
                    icon   : '../shared/icons/fam/report-paper.png',
                    tooltip: 'Contract ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var accaccount_name=rec.get('accaccount_name');
						 var accaccount_id=rec.get('accaccount_id');
						  var person_fullname=rec.get('person_fullname');
						   var person_id=rec.get('person_id');
						   var insurancedebitnote_id=rec.get('insurancedebitnote_id');
						    var tid='';
		insuredStatement(tid,person_id,person_fullname,accaccount_name,insurancedebitnote_id,accaccount_id,57);
                    }
                }]
            }
        ]
		
		,width: 500,
		maxHeight: 650,
        maxWidth: 500,
        title: 'Details',
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

////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 1180,
        height   : 680,
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
        title: 'Personal Information View',
        width: 1200,		
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :false,
		collapsible :false,
        maximized:false,
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
        buttonAlign:'center',
        buttons: [{
            text: 'Close',
			handler:function(){
				Ext.getCmp('idestatemgtwin').close();
				}
			
        }]
    });

    win.show();

});
}
insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,2);
";

?>