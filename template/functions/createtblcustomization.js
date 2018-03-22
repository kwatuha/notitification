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

function createOtherTablesFields(){
	
   

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

 

 Ext.define('cmbfddisplaytypedata', {
    extend: 'Ext.data.Model',
	fields:['displaytype_name','displaytype_id']
	});
var fddisplaytypedata = Ext.create('Ext.data.Store', {
    model: 'cmbfddisplaytypedata',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_displaytype',
        reader: {
            type: 'json'
        }
    }
});
fddisplaytypedata.load();

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
        title: 'Customize field views',
		closable:true,
        width: 800,
        bodyPadding: 10,
        renderTo: 'detailinfo',
        items:[{xtype:'hidden',
             name:'t',
			 value:'designer_fieldcustomization'
			 },
			 {xtype:'hidden',
             name:'tttact',
			 value:'Save'
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
	margin: '0 5 0 0',
	name:'field_tablelist',
	id:'field_tablelist',
	allowBlank: false,
	forceSelection:true,
    fieldLabel: 'Section',
    store: tableListdata,
      queryMode: 'remote',
    displayField: 'table_caption',
    valueField: 'table_name',
	listeners: { select: function(combo, record, index ) { 
	var secelVal = Ext.getCmp('field_tablelist').getValue();
	fieldlist_visibledata.proxy.extraParams = { fieldsearchtbl:secelVal}; 
	fieldlist_visibledata.load();
	 }}
	 },
     {
		
    xtype: 'checkbox',
	margin: '0 5 0 0',
	name:'is_visible',
	boxLabel: 'Visible',
	 inputValue: 'visible'
	}
	]
	},{xtype: 'fieldcontainer',
                fieldLabel:false,
				
                combineErrors: true,
				
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
		fieldLabel: 'Caption',
    xtype: 'textfield',
	margin: '0 5 0 0',
	//labelWidth:50,
	//width:100,
	name:'caption'
	},
	{
    xtype: 'combobox',
	name:'displaytype_id',
	margin: '0 5 0 0',
	id:'displaytype_id',
	labelWidth:50,
	forceSelection:true,
    fieldLabel: 'Display',
    store: fddisplaytypedata,
    queryMode: 'remote',
    displayField: 'displaytype_name',
    valueField: 'displaytype_id'
	
	},{
		fieldLabel: 'Cols',
    xtype: 'numberfield',
	margin: '0 5 0 0',
	labelWidth:50,
	//width:100,
	name:'num_cols'
	}]
	},{
           
			xtype: 'multiselect',
            name: 'current_fieldname',
            id: 'current_fieldname',
            anchor: '100%',

			
            fieldLabel: 'Selector',
            imagePath: '../ux/images/',
            store:fieldlist_visibledata,
            displayField: 'fieldcaption',
            valueField: 'fieldname',
            allowBlank: false,
            msgTarget: 'side'
        },{
		fieldLabel: 'Options',
    xtype: 'textareafield',
	margin: '0 5 0 0',
	anchor: '100%',
	name:'options'
	}
		],
        dockedItems: createDockedItems('current_fieldname')
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
