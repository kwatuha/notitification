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

?><?php

$isapproved=$_POST['filterapproved'];
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
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';

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
Ext.define('cmbAdmin_person', {
    extend: 'Ext.data.Model',
	fields:['person_id','person_name']
	});

var admin_persondata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_person',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?sydocprsn=1',
        reader: {
            type: 'json'
        }
    }
});

admin_persondata.load();
//***************************************************
var formPanel3 = Ext.create('Ext.form.Panel', {
        region     : 'center',
		maxWidth     : 800,
		autoScroll:true,
		//maxHeight:520,
		margins    : '0 0 0 3',
		id:'estsearchform',
        title      : 'Medical Results',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        
		
		
		
        items      : [{xtype:'hidden',
             name:'t',
			 value:'medicallab_histology'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
  {
    xtype: 'hidden',
	name:'queue_id',
	id:'queue_id',
	value:queuid
	},
	{
    xtype: 'hidden',
	name:'msource_id',
	id:'msource_id',
	value:queuid
	},
	{
    xtype: 'hidden',
	name:'msource',
	id:'msource',
	value:queuid
	},
	
	
	
	
	{
    xtype: 'hidden',
	name:'changed_by',
	id:'changed_by',
	value:''
	},
	{
    xtype: 'hidden',
	name:'date_changed',
	id:'date_changed',
	value:''
	},
	{
    xtype: 'hidden',
	name:'date_created',
	id:'date_created',
	value:''
	},
	{
    xtype: 'hidden',
	name:'created_by',
	id:'created_by',
	value:''
	},
	{xtype: 'fieldcontainer',
							fieldLabel:'Patient Name',
							msgTarget : 'side',
							layout: 'hbox',
							items:[
							{
            xtype: 'textfield',
			msgTarget : 'side',
			margin: '0 5 0 0',
            name: 'patiename',
			id: 'patientname',
			readOnly:true,
			fieldLabel: false,
            value:personname
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'patiennumb',
			readOnly:true,
			id: 'hospital_number',
			margin: '0 5 0 0',
            fieldLabel:'Hospital Number'
        
		},{
            xtype: 'textfield',
			margin: '0 5 0 0',
			msgTarget : 'side',
			readOnly:true,
            name: 'labnum',
			id: 'labnumber',
            value:labnum,
            fieldLabel: 'Lab Number '
        
		}]}, {
    xtype: 'multiselect',
	name:'physician',
	id:'physician',
	height:50,
	anchor:'100%',
	forceSelection:true,
    fieldLabel: 'Physician ',
    store: admin_persondata,
    queryMode: 'remote',
    displayField: 'person_name',
    valueField: 'person_id'
	},{xtype: 'fieldcontainer',
							fieldLabel:'Reporting Date',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'reporting_date',
			id: 'reporting_date',
			value:'',
			margin: '0 5 0 0',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'sample_collection_date',
			id: 'sample_collection_date',
			margin: '0 5 0 0',
			value:'',
            fieldLabel: 'Sample Collection Date ',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'adequacy',
			id: 'adequacy',
			value:'',
            fieldLabel: 'Adequacy'
			}
			,
			{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'within_normal',
			id: 'within_normal',
			value:'',
            fieldLabel: 'Within Normal'
			}
			,
			{xtype: 'textareafield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'squamous_cell_abnormalities',
			id: 'squamous_cell_abnormalities',
			value:'',
            fieldLabel: 'Squamous Cell Abnormalities'
			}
			,
			{xtype: 'textareafield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'non_neoplastic_conditions',
			id: 'non_neoplastic_conditions',
			value:'',
            fieldLabel: 'Non neoplastic conditions, '
			}
			,{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'biopsy_site',
			id: 'biopsy_site',
			value:'',
            fieldLabel: 'Biopsy site '
			}
			,{
            xtype: 'textareafield',
			anchor:'100%',
			msgTarget : 'side',
            name: 'clinical_history',
			id: 'clinical_history',
			value:'',
            fieldLabel: 'Clinical History ',
			anchor:'100%',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'microscopy',
			id: 'microscopy',
			anchor:'100%',
			value:'',
            fieldLabel: 'Microscopy ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
            name: 'conclusion',
			id: 'conclusion',
			anchor:'100%',
			value:'',
            fieldLabel: 'Conclusion ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textareafield',
			msgTarget : 'side',
			anchor:'100%',
            name: 'comments',
			id: 'comments',
			value:'',
            fieldLabel: 'Comments',
            allowBlank: false,
            minLength: 1
        
		}]
		,buttons: [{
            text: 'Approve',
			id:'approvebtn',
			handler:function(){
			    var quid=Ext.getCmp('queue_id').getValue();
				showApprovalComments('Approve Patient Results','medicallab_resultreview',quid,'queue_id','is_approved','Approved')
				}
			
        },{
            text: 'Reject',
			id:'rejectbtn', 
			handler:function(){
			var quid=Ext.getCmp('queue_id').getValue();
				showApprovalComments('Reject Patient Results','medicallab_resultreview',quid,'queue_id','is_approved','false')
				} 
			
        },{
            text: 'Update',
			id:'updatebtn',
			handler:function(){
			var source=Ext.getCmp('msource').getValue();
			var sourceId=Ext.getCmp('msource_id').getValue();
			updateMedicalRecords();
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        }]
    });
//hide unencessary fields
var approvalvar='".$isapproved."';

if(approvalvar=='APPROVED'){
//Ext.getCmp('estsearchform').show();
Ext.getCmp('approvebtn').hide();
Ext.getCmp('updatebtn').hide();
Ext.getCmp('rejectbtn').hide();
}else{
//Ext.getCmp('estsearchform').show();
Ext.getCmp('approvebtn').show();
Ext.getCmp('updatebtn').show();
Ext.getCmp('rejectbtn').show();
}
  
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
	fields:[{name:'diagnosis_type'}
			,{name:'referring_facility'}
			,{name:'reporting_date'}
			,{name:'hospital_number'}
			,{name:'person_id'}
			,{name:'patient_age'}
			,{name:'gender'}
			,{name:'sample_collection_date'}
			,{name:'queue_name'}
			,{name:'queue_id'}
			,{name:'hospital_number'}
			,{name:'person_fullname'}
			,{name:'physician'}
			,{name:'clinical_history'}
			,{name:'microscopy'}
			,{name:'conclusion'}
			,{name:'histology_id'}
			,{name:'source'}
			,{name:'source_id'}
			,{name:'diagnosis'}
			,{name:'non_neoplastic_conditions'}
			,{name:'squamous_cell_abnormalities'}
			,{name:'within_normal'}
			,{name:'adequacy'}
			,{name:'biopsy_site'}
			,{name:'comments'}
			,{name:'created_by'}
			,{name:'date_created'}]
			
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housinglandlord',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?pmrrcds=1&fa=$isapproved',
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
				createFormTabs('Save',22,'housing_housinglandlord',ccrecordid);
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
	    Ext.getCmp('estsearchform').show();
	    var empname=record.get('person_fullname');
		var phys=record.get('physician');
		var physARR=phys.split(','); 
		Ext.getCmp('patientname').setValue(empname);
		Ext.getCmp('labnumber').setValue(record.get('queue_name'));
		
var source=record.get('source');
Ext.getCmp('msource').setValue(source);
Ext.getCmp('msource_id').setValue(record.get('source_id'));
Ext.getCmp('created_by').setValue(record.get('created_by'));
Ext.getCmp('date_created').setValue(record.get('date_created'));

//hide unnecessary fields
if(source=='medicallab_labresult'){
Ext.getCmp('conclusion').hide();
Ext.getCmp('non_neoplastic_conditions').hide();
Ext.getCmp('squamous_cell_abnormalities').hide();
Ext.getCmp('within_normal').hide();
Ext.getCmp('adequacy').hide();

Ext.getCmp('biopsy_site').show();
Ext.getCmp('clinical_history').show();
Ext.getCmp('microscopy').show();
Ext.getCmp('biopsy_site').setValue(record.get('biopsy_site'));
//Ext.getCmp('clinical_history').setText('Clinical History');

}

if(source=='medicallab_histology'){
Ext.getCmp('biopsy_site').hide();

Ext.getCmp('clinical_history').show();
Ext.getCmp('microscopy').show();

Ext.getCmp('non_neoplastic_conditions').hide();
Ext.getCmp('squamous_cell_abnormalities').hide();
Ext.getCmp('within_normal').hide();
Ext.getCmp('adequacy').hide();
}		

if(source=='medicallab_papsmear'){
Ext.getCmp('non_neoplastic_conditions').show();
Ext.getCmp('squamous_cell_abnormalities').show();
Ext.getCmp('within_normal').show();
Ext.getCmp('adequacy').show();
Ext.getCmp('biopsy_site').hide();
Ext.getCmp('conclusion').hide();
Ext.getCmp('clinical_history').hide();
Ext.getCmp('microscopy').hide();
Ext.getCmp('non_neoplastic_conditions').setValue(record.get('non_neoplastic_conditions'));
Ext.getCmp('squamous_cell_abnormalities').setValue(record.get('squamous_cell_abnormalities'));
Ext.getCmp('within_normal').setValue(record.get('within_normal'));
Ext.getCmp('adequacy').setValue(record.get('adequacy'));
}
Ext.getCmp('hospital_number').setValue(record.get('hospital_number'));
		Ext.getCmp('physician').setValue(physARR);
		Ext.getCmp('queue_id').setValue(record.get('queue_id'));
		
		Ext.getCmp('reporting_date').setValue(record.get('reporting_date'));
		Ext.getCmp('sample_collection_date').setValue(record.get('sample_collection_date'));
		Ext.getCmp('clinical_history').setValue(record.get('clinical_history'));
		Ext.getCmp('microscopy').setValue(record.get('microscopy'));
		Ext.getCmp('conclusion').setValue(record.get('conclusion'));
		Ext.getCmp('comments').setValue(record.get('comments'));
		
	
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
		new Ext.grid.RowNumberer(),{
				header     : 'Hospital Number' , 
				 width : 80 , 
				sortable : true ,
				 dataIndex : 'hospital_number'
				 },
				 {
				header     : 'Patient Name ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'person_fullname'
				 },
				  {
				header     : 'Lab #' , 
				 width : 60 , 
				 sortable : true ,
				 dataIndex : 'queue_name'
				 },
				 {
				header     : 'Refered By' , 
				 width : 60 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'referring_facility'
				 },
				 {
				header     : 'Dignosis Type ' , 
				 width : 60 ,
				 hidden:true, 
				 sortable : true ,
				 dataIndex : 'diagnosis_type'
				 },
				 {
				header     : 'Reporting Date' , 
				 width : 60 ,
				 hidden:true, 
				 sortable : true ,
				 dataIndex : 'Reporting_date'
				 },
				 {
				header     : 'Sample Date ' , 
				 width : 60 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'sample_collection_date'
				 },
				
				 {
				header     : 'Age ' , 
				 width : 60 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'patient_age'
				 },
				 {
				header     : 'Gender' , 
				 width : 60 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'gender'
				 },
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 80,
                items: [
				  {
                    icon   : '../shared/icons/fam/report-paper.png',
                    tooltip: 'Patient Record ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var mysource=rec.get('source');
						var ccrecordid=rec.get('source_id');
						
						
						
						
						var posttypeid='".$isapproved."';
						
						
						if(posttypeid=='APPROVED'){
						//OpenlandlordContract(ccrecordid);
						//createWindowPdf();
						//alert(window.trackId);
								if (mysource=='medicallab_histology'){
								OpenMyhistology(ccrecordid);
								}
								if (mysource=='medicallab_papsmear'){
								//OpenMyhistology(ccrecordid);
								alert('Pap Smear not defined');
								}
								if (mysource=='medicallab_labresult'){
								OpenCytology(ccrecordid);
								
								}
						}
						
						
                    }
                }]
            }
        ]
		
		,width: 400,
		maxHeight: 600,
        maxWidth: 400,
        title: 'Personal Records',
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


   

		
	


   
   ////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   Ext.getCmp('estsearchform').hide();
   //Ext.getCmp('created_by').setValue('".$_SESSION['my_useridloggened']."');
    Ext.getCmp('changed_by').setValue('".$_SESSION['my_useridloggened']."');
  
   //date_changed
   Ext.getCmp('date_changed').setValue('".date('Y-m-d')."');
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        //width    : 1000,
        height   : 600,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
        bodyPadding: '5',
        items    : [
            //formPanel
            
			grid,
			formPanel3
			
        ]
        
    });


//Ext.getCmp('estsearchform').collapse();
var win = Ext.create('Ext.window.Window', {
        title: 'Review Medical Lab Results',
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