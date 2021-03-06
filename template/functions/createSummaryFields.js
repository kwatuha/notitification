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
function showcreateSummaryFieldsOptions(){
	
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

 Ext.define('cmbaggrigatetypedata', {
    extend: 'Ext.data.Model',
	fields:['aggrigatetype_name','aggrigatetype_id']
	});
var aggrigatetypedata = Ext.create('Ext.data.Store', {
    model: 'cmbaggrigatetypedata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_aggrigatetype',
        reader: {
            type: 'json'
        }
    }
});
aggrigatetypedata.load();


 Ext.define('cmbdatatypedata', {
    extend: 'Ext.data.Model',
	fields:['datatype_name','datatype_id']
	});
var datatypedata = Ext.create('Ext.data.Store', {
    model: 'cmbdatatypedata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_datatype',
        reader: {
            type: 'json'
        }
    }
});
datatypedata.load();

Ext.define('cmbpreaggrigatedata', {
    extend: 'Ext.data.Model',
	fields:['preaggrigate_name','preaggrigate_id']
	});
var preaggrigatedata = Ext.create('Ext.data.Store', {
    model: 'cmbpreaggrigatedata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=designer_preaggrigate',
        reader: {
            type: 'json'
        }
    }
});
preaggrigatedata.load();

/*Ext.define('cmbviewicondata', {
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
viewicondata.load();*/


Ext.define('cmbFieldlist_visible', { 
extend: 'Ext.data.Model', fields:['fieldname','fieldcaption'] }); 
var fieldlist_visibledata = Ext.create('Ext.data.Store', 
									   { model: 'cmbFieldlist_visible',
									   proxy: { type: 'ajax', 
									   url : 'cmbdesgn.php?selectedtbl=pim_employee&sfl=getit', 
									   reader: { type: 'json' } } }); 

//fieldlist_visibledata.load(); 
 
	var rdiv = document.getElementById('detailinfo').innerHTML=''; 
	//rdiv.setValue='';
	 ////
    var isForm = Ext.widget('form', {
        title: 'Create Summaries',
        width: 800,
        bodyPadding: 10,
        renderTo: 'detailinfo',
        items:[{xtype:'hidden',
             name:'t',
			 value:'designer_tblsummary'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:'Save'
			 },
	
	 {
    xtype: 'combobox',
	//margin: '0 5 0 0',
	name:'aggrigate_tablelist',
	id:'aggrigate_tablelist',
	allowBlank: false,
	forceSelection:true,
    fieldLabel: 'Section',
    store: secondarytableListdata,
      queryMode: 'remote',
    displayField: 'table_caption',
    valueField: 'table_name',
	listeners: { select: function(combo, record, index ) { 
	var secelVal = Ext.getCmp('aggrigate_tablelist').getValue();
	fieldlist_visibledata.proxy.extraParams = { fieldsearchtbl:secelVal}; 
	fieldlist_visibledata.load();
	 }}
	 },

	
	{xtype: 'fieldcontainer',
	margin: '5 5 5 0',
                fieldLabel:false,
				
                combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[
	{
    xtype: 'combobox',
	name:'aggrigatetype_id',
	margin: '0 5 0 0',
	id:'aggrigatetype_id',
	//labelWidth:50,
	forceSelection:true,
    fieldLabel: 'Type',
    store: aggrigatetypedata,
    queryMode: 'remote',
    displayField: 'aggrigatetype_name',
    valueField: 'aggrigatetype_id'
	
	},{
    xtype: 'combobox',
	name:'datatype_id',
	margin: '0 5 0 0',
	id:'datatype_id',
	labelWidth:50,
	forceSelection:true,
    fieldLabel: 'Data Type',
    store: datatypedata,
    queryMode: 'remote',
    displayField: 'datatype_name',
    valueField: 'datatype_id'
	
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
	name:'aggrigate_caption',
	//allowBlank: false,
            msgTarget: 'side'
	},{
    xtype: 'combobox',
	name:'preaggrigate_id',
	margin: '0 5 0 0',
	id:'preaggrigate_id',
	labelWidth:50,
	forceSelection:true,
    fieldLabel: 'Prefix',
    store: preaggrigatedata,
    queryMode: 'remote',
    displayField: 'preaggrigate_name',
    valueField: 'preaggrigate_id'
	
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
            name: 'aggrigate_field',
            id: 'aggrigate_field',
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
        dockedItems: createDockedItems('aggrigate_field')
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
