/*

This file is part of Ext JS 4

Copyright (c) 2011 Sencha Inc

Contact:  http://www.sencha.com/contact

GNU General Public License Usage
This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

*/
Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '../sview/ux');
Ext.require([
    'Ext.form.Panel',
    'Ext.ux.form.MultiSelect',
    'Ext.ux.form.ItemSelector'
]);
Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.dd.*'
]);
function createAutofillFields(fieldId) {
        return [{
            xtype: 'toolbar',
            dock: 'top',
            items: {
                text: 'Options',
                menu: [{
                    text: 'Set value (2,3)',
                    handler: function(){
                        Ext.getCmp(fieldId).setValue(['2', '3']);
                    }
                },{
                    text: 'Toggle enabled',
                    checked: true,
                    checkHandler: function(item, checked){
                        Ext.getCmp(fieldId).setDisabled(!checked);
                    }
                },{
                    text: 'Toggle delimiter',
                    checked: true,
                    checkHandler: function(item, checked) {
                        var field = Ext.getCmp(fieldId);
                        if (checked) {
                            field.delimiter = ',';
                            Ext.Msg.alert('Delimiter Changed', 'The delimiter is now set to <b>","</b>. Click Save to ' +
                                          'see that values are now submitted as a single parameter separated by the delimiter.');
                        } else {
                            field.delimiter = null;
                            Ext.Msg.alert('Delimiter Changed', 'The delimiter is now set to <b>null</b>. Click Save to ' +
                                          'see that values are now submitted as separate parameters.');
                        }
                    }
                }]
            }
        }, {
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'footer',
            defaults: {
                minWidth: 75
            },
            items: ['->', {
                text: 'Clear',
                handler: function(){
                    var field = Ext.getCmp(fieldId);
                    if (!field.readOnly && !field.disabled) {
                        field.clearValue();
                    }
                }
            }, {
                text: 'Reset',
                handler: function() {
                    Ext.getCmp(fieldId).up('form').getForm().reset();
                }
            }, {
                text: 'Save',
                handler: function(){
                    var form = Ext.getCmp(fieldId).up('form').getForm();
                    if (form.isValid()){
                        /*Ext.Msg.alert('Submitted Values', 'The following will be sent to the server: <br />'+
                            form.getValues(true));*/
						
						form.submit({
                    url: 'bodysave.php',
                    waitMsg: 'saving changes...',
                    success: function(fp, o) {
                        Ext.Msg.alert('Success', 'Your changes has been saved.');
                    }
                });
						
						
                    }
                }
            }]
        }];
    }
function showAutofillOptions(){
	
    Ext.define('cmbdesigner_sform', {
    extend: 'Ext.data.Model',
	fields:['sform_id','sform_name']
	});

var designer_sformdata = Ext.create('Ext.data.Store', {
    model: 'cmbdesigner_sform',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_sform',
        reader: {
            type: 'json'
        }
    }
});
designer_sformdata.load();

Ext.define('cmbSadmin_sview', {
    extend: 'Ext.data.Model',
	fields:['sview_id','sview_name']
	});

var sviewdata = Ext.create('Ext.data.Store', {
    model: 'cmbSadmin_sview',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_sview',
        reader: {
            type: 'json'
        }
    }
});
sviewdata.load();


	Ext.define('cmbtableListdata', {
    extend: 'Ext.data.Model',
	fields:['table_caption','table_name']
	});

var tableListdata = Ext.create('Ext.data.Store', {
    model: 'cmbtableListdata',
    proxy: {
        type: 'ajax',
        url : 'cmbdesgn.php?tbp=admin_table',
        reader: {
            type: 'json'
        }
    }
});
tableListdata.load();

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

 Ext.define('cmbviewmodedata', {
    extend: 'Ext.data.Model',
	fields:['viewmode_name','viewmode_id']
	});
var viewmodedata = Ext.create('Ext.data.Store', {
    model: 'cmbviewmodedata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_viewmode',
        reader: {
            type: 'json'
        }
    }
});
viewmodedata.load();

Ext.define('cmbviewicondata', {
    extend: 'Ext.data.Model',
	fields:['viewicon_name','viewicon_id']
	});
var viewicondata = Ext.create('Ext.data.Store', {
    model: 'cmbviewicondata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_viewicon',
        reader: {
            type: 'json'
        }
    }
});
viewicondata.load();


Ext.define('cmbFieldlist_visible', { 
extend: 'Ext.data.Model', fields:['fieldname','fieldcaption'] }); 
var fieldlist_visibledata = Ext.create('Ext.data.Store', 
									   { model: 'cmbFieldlist_visible',
									   proxy: { type: 'ajax', 
									   url : 'cmbdesgn.php?selectedtbl=pim_employee&sfl=getit', 
									   reader: { type: 'json' } } }); 

//fieldlist_visibledata.load(); 
 
	var rdiv = document.getElementById('detailinfo').innerHTML=''; 
	rdiv.innerHTML='';
	 ////
    var isForm = Ext.widget('form', {
        title: 'Field Customization',
		closable:true,
        width: 800,
        bodyPadding: 10,
        renderTo: 'detailinfo',
        items:[{xtype:'hidden',
             name:'t',
			 value:'admin_autofill'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:'Save'
			 },
	
	 {xtype: 'fieldcontainer',
                fieldLabel:false,
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
    xtype: 'combobox',
	margin: '0 5 0 0',
	name:'primary_tablelist',
	id:'primary_tablelist',
	allowBlank: false,
	forceSelection:true,
    fieldLabel: 'Section',
    store: secondarytableListdata,
      queryMode: 'remote',
    displayField: 'table_caption',
    valueField: 'table_name',
	listeners: { select: function(combo, record, index ) { 
	var secelVal = Ext.getCmp('primary_tablelist').getValue();
	fieldlist_visibledata.proxy.extraParams = { fieldsearchtbl:secelVal}; 
	fieldlist_visibledata.load();
	 }}
	 },
	 {
	xtype: 'checkbox',
	margin: '0 5 0 0',
	name:'insurance_policygroup',
	boxLabel: 'Group Policies',
	 inputValue: 'insurance_policygroup'
	},
	 {
	xtype: 'checkbox',
	margin: '0 5 0 0',
	name:'admin_company',
	boxLabel: 'Companies',
	 inputValue: 'admin_company'
	},
	 {
	xtype: 'checkbox',
	margin: '0 5 0 0',
	name:'admin_persongroup',
	boxLabel: 'People Group',
	 inputValue: 'admin_persongroup'
	},
	 
	 {
	xtype: 'checkbox',
	margin: '0 5 0 0',
	name:'insurance_underwriter',
	boxLabel: 'Underwriters',
	 inputValue: 'insurance_underwriter'
	},{
	xtype: 'checkbox',
	margin: '0 5 0 0',
	name:'admin_person',
	boxLabel: 'People',
	 inputValue: 'admin_person'
	}]},

	{xtype: 'fieldcontainer',
                fieldLabel:false,
				
                combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[
	{
    xtype: 'numberfield',
	margin: '0 5 0 0',
	//labelWidth:50,
	//width:150,
	fieldLabel: 'min Len',
	name:'min_lem',
	id:'min_lem'
	},{
		fieldLabel: 'Max',
    xtype: 'numberfield',
	margin: '0 5 0 0',
	labelWidth:50,
	//width:150,
	name:'max_len'
	},{
		fieldLabel: 'Digits',
    xtype: 'numberfield',
	margin: '0 5 0 0',
	allowBlank: false,
	msgTarget:'side',
	labelWidth:50,
	//width:150,
	name:'digit_number'
	},{
		
    xtype: 'checkbox',
	name:'inf',
	boxLabel: 'INF',
	 inputValue: 'INF'
	}]
	}
	,
	{xtype: 'fieldcontainer',
	margin: '5 5 5 0',
                fieldLabel:false,
				
                combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
		fieldLabel: 'Regex',
		margin: '0 5 0 0',
    xtype: 'textfield',
	//labelWidth:50,
	name:'regex'
	}
	,
	{
    xtype: 'combobox',
	name:'viewmode_id',
	margin: '0 5 0 0',
	id:'viewmode_id',
	labelWidth:50,
	forceSelection:true,
    fieldLabel: 'Display',
    store: viewmodedata,
    queryMode: 'remote',
    displayField: 'viewmode_name',
    valueField: 'viewmode_id'
	
	},{
		fieldLabel: 'Ref',
    xtype: 'textfield',
	margin: '0 5 0 0',
	allowBlank: false,
	msgTarget:'side',
	labelWidth:50,
	//width:100,
	name:'autofill_name'
	},{
		boxLabel: 'Allow Edit',
    xtype: 'checkbox',
	name:'editable',
	 inputValue: 'editable'
	}]
	},{xtype: 'fieldcontainer',
                fieldLabel:false,
				
                combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[
	{
		fieldLabel: 'Caption',
    xtype: 'textfield',
	margin: '0 5 0 0',
	name:'caption',
	allowBlank: false,
            msgTarget: 'side'
	},{
		fieldLabel: 'Prefix',
    xtype: 'textfield',
	margin: '0 5 0 0',
	labelWidth:50,
	//width:100,
	name:'prefix'
	},{
		fieldLabel: 'Surfix',
    xtype: 'textfield',
	margin: '0 5 0 0',
	labelWidth:50,
	//width:100,
	name:'surfix'
	},{
		
    xtype: 'checkbox',
	name:'is_visible',
	boxLabel: 'Visible',
	 inputValue: 'visible'
	}]
	},{
           
			xtype: 'multiselect',
            name: 'fieldname',
            id: 'fieldname',
            anchor: '100%',

			
            fieldLabel: 'Selector',
            imagePath: '../ux/images/',
            store:fieldlist_visibledata,
            displayField: 'fieldcaption',
            valueField: 'fieldname',
            allowBlank: false,
            msgTarget: 'side'
        }
		],
        dockedItems: createDockedItems('fieldname')
    });
//drawDragGrids();
}
////////////Grid to grid

function drawDragGrids(){


Ext.define('DataObject', {
    extend: 'Ext.data.Model',
    fields: ['name', 'column1', 'column2']
});

    var myData = [
        { name : "Rec 0", column1 : "0", column2 : "0" },
        { name : "Rec 1", column1 : "1", column2 : "1" },
        { name : "Rec 2", column1 : "2", column2 : "2" },
        { name : "Rec 3", column1 : "3", column2 : "3" },
        { name : "Rec 4", column1 : "4", column2 : "4" },
        { name : "Rec 5", column1 : "5", column2 : "5" },
        { name : "Rec 6", column1 : "6", column2 : "6" },
        { name : "Rec 7", column1 : "7", column2 : "7" },
        { name : "Rec 8", column1 : "8", column2 : "8" },
        { name : "Rec 9", column1 : "9", column2 : "9" }
    ];

    // create the data store
    var firstGridStore = Ext.create('Ext.data.Store', {
        model: 'DataObject',
        data: myData
    });


    // Column Model shortcut array
    var columns = [
        {text: "Record Name", flex: 1, sortable: true, dataIndex: 'name'},
        {text: "column1", width: 70, sortable: true, dataIndex: 'column1'},
        {text: "column2", width: 70, sortable: true, dataIndex: 'column2'}
    ];

    // declare the source Grid
    var firstGrid = Ext.create('Ext.grid.Panel', {
        multiSelect: true,
        viewConfig: {
            plugins: {
                ptype: 'gridviewdragdrop',
                dragGroup: 'firstGridDDGroup',
                dropGroup: 'secondGridDDGroup'
            },
            listeners: {
                drop: function(node, data, dropRec, dropPosition) {
                    var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                    Ext.example.msg("Drag from right to left", 'Dropped ' + data.records[0].get('name') + dropOn);
                }
            }
        },
        store            : firstGridStore,
        columns          : columns,
        stripeRows       : true,
        title            : 'First Grid',
        margins          : '0 2 0 0'
    });

    var secondGridStore = Ext.create('Ext.data.Store', {
        model: 'DataObject'
    });

    // create the destination Grid
    var secondGrid = Ext.create('Ext.grid.Panel', {
        viewConfig: {
            plugins: {
                ptype: 'gridviewdragdrop',
                dragGroup: 'secondGridDDGroup',
                dropGroup: 'firstGridDDGroup'
            },
            listeners: {
                drop: function(node, data, dropRec, dropPosition) {
                    var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                    Ext.example.msg("Drag from left to right", 'Dropped ' + data.records[0].get('name') + dropOn);
                }
            }
        },
        store            : secondGridStore,
        columns          : columns,
        stripeRows       : true,
        title            : 'Second Grid',
        margins          : '0 0 0 3'
    });

    //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width        : 750,
        height       : 300,
        layout       : {
            type: 'hbox',
            align: 'stretch',
            padding: 5
        },
        renderTo     : 'gridselector',
        defaults     : { flex : 1 }, //auto stretch
        items        : [
            firstGrid,
            secondGrid
        ],
        dockedItems: {
            xtype: 'toolbar',
            dock: 'bottom',
            items: ['->', // Fill
            {
                text: 'Reset both grids',
                handler: function(){
                    //refresh source grid
                    firstGridStore.loadData(myData);

                    //purge destination grid
                    secondGridStore.removeAll();
                }
            }]
        }
    });
}
