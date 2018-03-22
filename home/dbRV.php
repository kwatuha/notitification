<?php
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
		maxWidth     : 550,
		autoScroll:true,
		maxHeight:400,
		margins    : '0 0 0 3',
		id:'estsearchform',
        title      : 'Insurance Debit Note',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        
		
		
		
        items      : [
			 {xtype:'hidden',
             name:'tttact',
			 value:loadtype
			 },
  {
    xtype: 'hidden',
	name:'dbnote_id',
	id:'dbnote_id'
	},{
    xtype: 'hidden',
	name:'insperson_id',
	id:'insperson_id',
	value:queuid
	},{
            xtype: 'textfield',
			msgTarget : 'side',
			margin: '0 5 5 0',
			anchor:'60%',
            name: 'personname',
			id: 'personname',
			readOnly:true,
			fieldLabel: 'Insured Name',
            value:personname
        
		},{
            xtype: 'textfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			readOnly:true,
            name: 'insunderwriter_name',
			anchor:'60%',
			id: 'insunderwriter_name',
            fieldLabel: 'Underwriter'
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            name: 'inspolicy_number',
			readOnly:true,
			anchor:'60%',
			id: 'inspolicy_number',
			margin: '0 5 5 0',
            fieldLabel:'Policy Number'
        
		}, {xtype: 'fieldcontainer',
							fieldLabel:'Period From',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'insperiod_from',
			id: 'insperiod_from',
			value:'',
			margin: '0 5 0 0',
            fieldLabel:false,
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			msgTarget : 'side',
            name: 'insperiod_to',
			id: 'insperiod_to',
			margin: '0 0 0 5',
			value:'',
			labelWidth:85,
            fieldLabel: 'Period To',
            allowBlank: false,
            minLength: 1
        
		}]},{xtype: 'fieldcontainer',
							fieldLabel:'Sum Assured',
							msgTarget : 'side',
							layout: 'hbox',
							items:[{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'inssumassured',
			id: 'inssumassured',
			margin: '0 5 5 0',
			value:'',
            fieldLabel: false
			}
			,{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'inspremium',
			id: 'inspremium',
			margin: '0 0 0 5',
			value:'',
			labelWidth:85,
            fieldLabel: 'Basic Premium'
			}]},
			{xtype: 'fieldcontainer',
			fieldLabel:'Training Levy',
			msgTarget : 'side',
			layout: 'hbox',
			items:[{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'inslevyamount',
			id: 'inslevyamount',
			margin: '0 5 5 0',
			value:'',
			labelWidth:85,
            fieldLabel:false
			},
			{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'insstamp_duty',
			id: 'insstamp_duty',
			margin: '0 0 0 5',
			value:'',
			labelWidth:85,
            fieldLabel: 'Stamp Duty'
			}]},
			{xtype: 'fieldcontainer',
			fieldLabel:'PCF',
			msgTarget : 'side',
			layout: 'hbox',
			items:[{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'inspcfamount',
			id: 'inspcfamount',
			margin: '0 5 5 0',
			value:'',
            fieldLabel:false
			},
			{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'instotal',
			id: 'instotal',
			labelWidth:85,
			margin: '0 0 0 5',
			value:'',
            fieldLabel:'Total Premium'
			}
			
			]},
			{xtype: 'fieldcontainer',
			fieldLabel:'Amount Paid',
			msgTarget : 'side',
			layout: 'hbox',
			items:[
			{xtype: 'textfield',
		    anchor:'100%',
			msgTarget : 'side',
            name: 'insamountpaid',
			id: 'insamountpaid',
			margin: '0 5 5 0',
			value:'',
			
            fieldLabel:false
			},
			{xtype: 'textfield',
		    maxWidth: 300,
			msgTarget : 'side',
            name: 'insbalance',
			id: 'insbalance',
			labelWidth:85,
			margin: '0 0 0 5',
			value:'',
			fieldLabel: 'Balance'
			}
			]}
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
	fields:[{name:'insurancedebitnote_id'},
	{name:'insurancedebitnote_name'},
	{name:'policy_number'},
	{name:'underwriter_name'},
	{name:'accaccount_name'},
	{name:'other_details'},
	{name:'date_created'},
	{name:'created_by'},
	{name:'person_fullname'},
	{name:'accaccount_id'},
	{name:'accaccount_name'},
	{name:'person_id'},
	{name:'other_details'}]
			
	});
	
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housinglandlord',
	
	
    proxy: {
        type: 'ajax',
		url : 'buidgrid.php?insrptdbn=res&dbna=$isapproved',
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
	
	    var empname=record.get('person_fullname');
		
		Ext.getCmp('personname').setValue(empname);
		Ext.getCmp('insunderwriter_name').setValue(record.get('underwriter_name'));
		Ext.getCmp('inspolicy_number').setValue(record.get('policy_number'));
		Ext.getCmp('insperson_id').setValue(record.get('person_id'));
		var noid=record.get('insurancedebitnote_id');
		Ext.getCmp('dbnote_id').setValue(noid);
		printByDbnote(noid);
	
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
		
		new Ext.grid.RowNumberer(),/*{
            text: 'Task',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'accaccount_name',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Records)' : '(1 Record)');
            }
        },*/{
				header     : 'Insured' , 
				 flex : 1 , 
				 sortable : true ,
				 dataIndex : 'person_fullname'
				 },
				 {
				header     : 'Policy Number ' , 
				 width : 80 , 
				 hidden : true ,
				 sortable : true ,
				 dataIndex : 'policy_number'
				 },
				 {
				header     : 'Underwriter' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'underwriter_name'
				 },
				 {
				header     : 'Ref' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'account_name'
				 },
				 {
				header     : ' Other Details ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'other_details'
				 },
				 
				 {
				header     : ' Date ' , 
				 width : 80 , 
				 hidden : true ,
				 sortable : true ,
				 dataIndex : 'date_created'
				 },
				 {
				header     : ' Entry By ' , 
				 width : 80 , 
				 hidden : true ,
				 sortable : true ,
				 dataIndex : 'created_by'
				 },
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
		
		,width: 400,
		maxHeight: 600,
        maxWidth: 400,
        title: 'Insured Clients',
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

////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
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



var win = Ext.create('Ext.window.Window', {
        title: 'Review Insurance Debit Notes',
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