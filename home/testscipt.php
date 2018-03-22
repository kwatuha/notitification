<?php
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


Ext.onReady(function(){
//////////////////////////////////////////////////////////////////////
var displayhere='dynamicchild',loadtype='Save',rid='NOID', searchitem='NO';

Ext.define('cmbsysgroups', {
    extend: 'Ext.data.Model',
	fields:['group_name','group_caption']
	});

var admin_grpdata = Ext.create('Ext.data.Store', {
    model: 'cmbsysgroups',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tgr=ggrp',
        reader: {
            type: 'json'
        }
    }
});

admin_grpdata.load();
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
	fields:[{name:'first_name'},{name:'middle_name'},{name:'last_name'},{name:'personpersontype_name'},{name:'empnhif_name'},{name:'empnssf_name'},{name:'salary_basic'},{name:'paygradedecr_name'},{name:'paygradeleveldescr_name'},{name:'dept_name'},{name:'totalallowance'},{name:'totaldeductions'}]
	}); 
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_table',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?prlemdt=ui' ,
        reader: {
            type: 'json'
        }
    }
});
 store.load();
  
  ;
  ////////

     var selModel = Ext.create('Ext.selection.CheckboxModel', {
        listeners: {
            selectionchange: function(sm, selections) {
                //grid.down('#removeButton').setDisabled(selections.length == 0);
            }
        }
    });
  ////////
      var sellAction = Ext.create('Ext.Action', {
        icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
        text: 'Delete',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
                alert('asdfasdas');
            } else {
                alert('Please select a company from the grid');
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
             
        ]
    });

  //////////
   var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
        clicksToMoveEditor: 1,
        autoCancel: false
    });

//////////////////
///////////////////////////////////////////////


    var columns = [
		new Ext.grid.RowNumberer(),
{ header : ' First name' , width : 80 , sortable : true , dataIndex : 'first_name' },
{ header : ' Middle name' , width : 80 , sortable : true , dataIndex : 'middle_name' },
{ header : ' Last name' , width : 80 , sortable : true , dataIndex : 'last_name' },
{ header : ' Emp #' , width : 80 , sortable : true , dataIndex : 'personpersontype_name' },
{ header : ' NHIF #' , width : 80 , sortable : true , dataIndex : 'empnhif_name' },
{ header : ' NSSF #' , width : 80 , sortable : true , dataIndex : 'empnssf_name' },
{ header : ' Basic Pay' , width : 80 , sortable : true , dataIndex : 'salary_basic' },
{ header : ' Grade' , width : 80 , sortable : true , dataIndex : 'paygradedecr_name' },
{ header : ' Grade Level' , width : 80 , sortable : true , dataIndex : 'paygradeleveldescr_name' },
{ header : ' Dept' , width : 80 , sortable : true , dataIndex : 'dept_name' },
{ header : ' Total Allowance' , width : 80 , sortable : true , dataIndex : 'totalallowance' },
{ header : ' Total Deductions' , width : 80 , sortable : true , dataIndex : 'totaldeductions' }
    ];
var empname;
var showsummary = function(grid,rowIndex,e){
alert(rowIndex);
}
    // declare the source Grid
    var grid = Ext.create('Ext.grid.Panel', {
        store            : store,
        columns          : columns,
        enableDragDrop   : true,
        stripeRows       : true,
        width            : 600,
        margins          : '0 2 0 0',
		columnLines: true,
        selModel: selModel,
        region           : 'west',
        title            : 'Employee Details',
		listeners : {
    itemclick: function(dv, record, item, index, e) {
	  //itemdblclick
        
		empname=record.get('first_name')+' '+record.get('middle_name')+' '+record.get('last_name');
		Ext.getCmp('empname').setValue(empname);
		Ext.getCmp('nssf').setValue(record.get('empnssf_name'));
		Ext.getCmp('nhif').setValue(record.get('empnhif_name'));
		Ext.getCmp('dept').setValue(record.get('dept_name'));
		Ext.getCmp('empnumber').setValue(record.get('personpersontype_name'));
		Ext.getCmp('paygrade').setValue(record.get('paygradedecr_name')+' '+record.get('paygradeleveldescr_name'));
		Ext.getCmp('salary_basic').setValue(record.get('salary_basic'));
		Ext.getCmp('allowances').setValue(record.get('totalallowance')); 
		Ext.getCmp('deductions').setValue(record.get('totaldeductions'));		
		/*Ext.getCmp('taxable').setValue(record.get('taxable'));
		Ext.getCmp('relief').setValue(record.get('relief'));
		Ext.getCmp('paye').setValue(record.get('paye'));*/
		
		
		
		var bas=record.get('salary_basic')
		var all=record.get('totalallowance');
		var d=record.get('totaldeductions');
		filloutPaye(bas,all,d);
		
		
		
		
    }
},
    });

    // Declare the text fields.  This could have been done inline, is easier to read
    // for folks learning :)
    var textField1 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Name',
        id       : 'empname'
    });

  var textField12 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Payroll #',
        id       : 'empnumber'
    });
    var textField2 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'NSSF #',
        id       : 'nssf'
    });

    var textField3 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'NHIF #',
        id       : 'nhif'
    });

var textField4 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Department',
        id       : 'dept'
    });
	var textField44 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Grade',
        id       : 'paygrade'
    });

var textField5 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Allowances',
        id       : 'allowances'
    });
	var textField55 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Basic Salary',
        id       : 'salary_basic'
    });
	
	var textField66 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Gross Pay',
        id       : 'grosspay'
    });	
	var textField6 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Deductions',
        id       : 'deductions'
    });
	
	var textField7 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Taxable Income',
        id       : 'taxable'
    });
	
	var textField77 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Tax',
        id       : 'payetax'
    });
	var textField8 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Personal Relief',
        id       : 'relief'
    });
	var textField9 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Paye',
        id       : 'paye'
    });
	var textField10 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Minimal Pay',
        id       : '1third'
    });
	var textField11 = Ext.create('Ext.form.field.Text', {
        fieldLabel : 'Net Pay',
        id       : 'netpay'
    });
    // Setup the form panel
    var formPanel = Ext.create('Ext.form.Panel', {
        region     : 'center',
        title      : 'Summary',
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        labelWidth : 100,
        width      : 200,
        margins    : '0 0 0 3',
        items      : [
            textField1,
			textField12,
            textField2,
            textField3,
			textField4,
			textField44,
            textField55,
			textField5,
			textField66,
            textField6,
			textField7,
			textField77,
            textField8,
            textField9,
			textField10,
            textField11
        ]
    });

    //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 900,
        height   : 550,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
        bodyPadding: '5',
        items    : [
            grid,
            formPanel
        ],
        bbar    : [
            '->', // Fill
            {
                text    : 'Reset Example',
                handler : function() {
                    //refresh source grid
                    gridStore.loadData(myData);
                    formPanel.getForm().reset();
                }
            }
        ]
    });

var win = Ext.create('Ext.window.Window', {
        title: 'Payroll Employees',
        width: 800,
		
		bodyPadding:10,
        //layout: 'fit',
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'frmselectlandlord',
        plain: true,
		layout: 'fit',
        items: displayPanel,
		
		dockedItems: [{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'header',
            layout: {
                pack: 'center'
            },
            items: [{
    xtype: 'combobox',
	name:'person_id',
	id:'groupinfo',
	forceSelection:true,
    fieldLabel: 'Payperiod',
	labelWidth:80,
	width:300,
    store: admin_grpdata,
	margin: '0 5 0 0',
    queryMode: 'remote',
    displayField: 'group_caption',
    valueField: 'group_name',
	listeners: { select: function(combo, record, index ) { 
	var secelVallid = Ext.getCmp('groupinfo').getValue();
	store.proxy.extraParams = { findgroup:secelVallid};
	store.load();
	}}
	},{
                minWidth: 80,
				
                text: 'Save',
				handler:function(){
					var s = grid.getSelectionModel().getSelection();
							var selected='';
							var orther='';
							Ext.each(s, function (item) {
							 selected+=item.data.rolenotificationhist_id+',';
							 
							 orther+=item.data.notification_details+',';
							});
							var secelVallid = Ext.getCmp('person_id').getValue();
							
							if(secelVallid>0){
							//alert(secelVallid);	
								   Ext.Ajax.request({
								   url: 'ntp.php',
								   params:{theKeys:secelVallid,theKeys2:selected,orther:orther},
								   success: function(action){
										grid.store.reload();
									},
									failure: function(action){
									// you could put an error message here
									}
								   });
							
							}else{
								alert(secelVallid+'Ksssss');
							}
	
				}
            },{
                minWidth: 80,
                text: 'Cancel'
            }]
        }],
        buttonAlign:'center',
        buttons: [{
            text: 'Save Pay period',
			//alignTo:'center',
			handler:function(){
			//tenantfullname,personname,tenantid,tpid
			
			var lnameid = Ext.getCmp('liperson_id').getValue();
			var lname = Ext.getCmp('lipersonname').getValue();
			
			var lunilid = Ext.getCmp('landlordid').getValue();
			//tenantid tpid
			housing_housingtenantFormRevised('detailinfo','Save','NOID',tenantfullname,tpid,personname,lnameid,lname,lunilid,tenantid);
			
			Ext.getCmp('frmselectlandlord').close();
			}
        },{
            text: 'Cancel'
			
        }]
    });

    win.show();

});

";

?>