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

function showResult(btn){
Ext.example.msg('Button Click', 'You clicked the {0} button', btn);
};

function confirmDelete(del){
Ext.MessageBox.show({
           title:'Save Changes?',
           msg: 'You are about to Delete '+del+'. <br />Are you sure you want to delete?',
           buttons: Ext.MessageBox.YESNOCANCEL,
           fn: showResult,
           
           icon: Ext.MessageBox.QUESTION
       });
}
function insurance_insurancedebitnoteFormRevised(fullname,personcode,iowner,pid,dbnoteid){

var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';



Ext.define('cmbAdmin_personttypecategory', {
    extend: 'Ext.data.Model',
	fields:['personttypecategory_id','personttypecategory_name']
	});

var admin_personttypecategorydata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_personttypecategory',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_personttypecategory',
        reader: {
            type: 'json'
        }
    }
});

admin_personttypecategorydata.load();
Ext.onReady(function(){ 
var formPanel3 = Ext.create('Ext.form.Panel', {
        region     : 'west',
		margins    : '0 0 0 3',
		id:'estsearchform',
        title      : 'Search',
		collapsible:true,
		autoScroll:true,
        bodyStyle  : 'padding: 10px; background-color: #DFE8F6',
        width     : 250,
		height:50,
		maxHeight:200,
		maxWidth:250,
        items      : [
		
	
			 {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
			labelWidth:80,
			id: 'insltsearch_name',
			value:'',
            fieldLabel: 'Tenant',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            labelWidth:80,
			id: 'inslsearch_name',
			anchor:'100%',
			value:'',
            fieldLabel: 'Landlord',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			anchor:'100%',
			msgTarget : 'side',
			labelWidth:80,
            id: 'inssearchperiod_from',
			value:'',
            fieldLabel: 'From ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            id: 'inssearchperiod_to',
			value:'',
            fieldLabel: 'To ',
            allowBlank: false,
            minLength: 1
        
		}]
		,buttons: [{
            text: 'Find',
			handler:function(){
				//Ext.getCmp('insdestatemgtwin').close();
				}
			
        },{
            text: 'Excel',
			handler:function(){
				//Ext.getCmp('insdestatemgtwin').close();
				}
			
        },{
            text: 'PDF',
			handler:function(){
				//Ext.getCmp('insdestatemgtwin').close();
				}
			
        }]
    });
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

Ext.define('cmbinsurance_insurancedebitnote', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchinsurance_insurancedebitnotedata = Ext.create('Ext.data.Store', {
    model: 'cmbinsurance_insurancedebitnote',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=insurance_insurancedebitnote&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchinsurance_insurancedebitnotedata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtninsurance_insurancedebitnote = Ext.get('gridViewinsurance_insurancedebitnote');	

	Ext.define('Insurance_insurancedebitnote', {
    extend: 'Ext.data.Model',
	fields:[{name:'insurancedebitnote_id'},{name:'insurancedebitnote_name'},
	{name:'policy_number'},{name:'underwriter_name'},
	{name:'person_name'},{name:'other_details'},{name:'currency_name'},{name:'pcf'},
	{name:'training_levy'},{name:'insured'},
	{name:'dbnotetransact_id'},
	{name:'stamp_duty'},{name:'wtax'},{name:'person_fullname'}]


	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Insurance_insurancedebitnote',
	sorters: {property: 'underwriter_name', direction: 'ASC'},
	groupField: 'underwriter_name',
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?insrpt=res',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
  
  var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
        clicksToEdit: 1,
        listeners: {
            edit: function(){
                // refresh summaries
                grid.getView().refresh();
            }
        }
    });
	var showSummary = true;;
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
	
	
		var itemAction40 = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: 'Manage',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
			   var ccrecordid=rec.get('insurancedebitnote_id');
			   var ctableval='insurance_insurancedebitnote';
                
				if(ctableval=='admin_role'){
				createCheRolePrivileges('Admin',ccrecordid);
				}else{
				createFormTabs('Save',40,'insurance_insurancedebitnote',ccrecordid);
				//alert('There was an error');
				
				}
				
				
            } else {
                alert('Please select a Manage from the grid');
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
             buyAction,sellAction,itemAction40
        ]
    });

  //////////
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
		margins    : '0 0 0 3',
		/*bbar:[items:[{
		xtype:'button',
		text:'Close'
		}],*/
        stateful: true,
		
		plugins: [cellEditing],
dockedItems: [{
            dock: 'top',
            xtype: 'toolbar',
            items: [{
                tooltip: 'Toggle the visibility of the summary row',
                text: 'Toggle Summary',
                handler: function(){
                    var view = grid.getView();
                    showSummary = !showSummary;
                    view.getFeature('group').toggleSummaryRow(showSummary);
                    view.refresh();
                }
            }]
        }],
		features: [{
            id: 'group',
            ftype: 'groupingsummary',
            groupHeaderTpl: '{name}',
            hideGroupedHeader: true,
            enableGroupingMenu: false
        }],
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
            text: 'Task',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'insurancedebitnote_name',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Records)' : '(1 Record)');
            }
        },{
				header     : 'Insured ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'insured'
				 },
				 {
				header     : ' Policy Number ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'policy_number'
				 },
				 {
				header     : ' Underwriter' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'underwriter_name'
				 },
				 {
				header     : ' Person Id ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'person_name'
				 },
				 {
				header     : ' Other Details ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'other_details'
				 },
				 {
				header     : ' Currency' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'currency_name'
				 },
				 {
				header     : ' Pcf ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'pcf'
				 },
				 {
				header     : ' Training Levy ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'training_levy'
				 },
				 {
				header     : ' Stamp Duty ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'stamp_duty'
				 },
				 {
				header     : ' Wtax ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'wtax'
				 },
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 80,
                items: [
				  {
                    icon   : '../shared/icons/fam/cog.gif',
                    tooltip: 'action ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('insurancedebitnote_id');
						//alert(ccrecordid+\":There was an error\");
						//createFormTabs('loadtype',ccrecordid,'insurance_insurancedebitnote');
                    }
                },{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
						var ridtr=rec.get('dbnotetransact_id');
						confirmDelete();
						//deleteRecord('insurance_dbnotetransact',ridtr);
						
                    }
                }, {
                    getClass: function(v, meta, rec) { 
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Edit';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Edit';
                            return 'buy-col';
                        }
                    },
					handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
//alert(\"wassssssssssssssssssssss\");
var ctv='insurance_insurancedebitnote';
var ccrecordid=rec.get('insurancedebitnote_id');


if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
//editdiv
gridViewform_amrsconceptsFQM('detailinfo','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('insurancedebitnote_id')+'insurancedebitnote_id');
var ccrecordid=rec.get('insurancedebitnote_id');
insurance_insurancedebitnoteForm('detailinfo','updateload',ccrecordid);

}

                    }
                }]
            }
        ]
		,
		resizable:true,
        title: ' Insurance Insurancedebitnote',
       maxHeight: 600,
        width: 800,
		resizable:true,
        title: 'Insurance Information',
        region: 'center',
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
,
		tbar:[{
                    text:'Add Record',
                    tooltip:' insurance insurancedebitnote',
                    iconCls:'add',
					handler:function(){
						Ext.getCmp('insdestatemgtwin').close();
						registerperson();
					}
                }, '-', {
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReport('aW5zdXJhbmNlX2luc3VyYW5jZWRlYml0bm90ZQ==');
					}
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenInvoice('aW5zdXJhbmNlX2luc3VyYW5jZWRlYml0bm90ZQ==');
					}
                },/*
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReceipt('aW5zdXJhbmNlX2luc3VyYW5jZWRlYml0bm90ZQ==');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenStatement('aW5zdXJhbmNlX2luc3VyYW5jZWRlYml0bm90ZQ==');
					}
                },'-',{
                    text:'Delete',
                    tooltip:'Delete record',
                    iconCls:'remove'
                },*/'-',
				{ text:'Search', 
 tooltip:'Find', 
 iconCls:'find',
  handler: function(grid, rowIndex, colIndex) { 
testme();
 }

 }
 ,
 
 {
    xtype: 'combobox',
	name:'grdsearchinsurance_insurancedebitnote',
	id:'grdsearchinsurance_insurancedebitnote',
	forceSelection:true,
    fieldLabel: false,
    store: searchinsurance_insurancedebitnotedata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchinsurance_insurancedebitnote').getValue();
	var selValtx = Ext.getCmp('searchfield').getValue();
  alert(selValtx+selVal);
}}

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
	if((ke==39)||(ke==13)||(ke==112)||(ke==37)||(ke==34)||(ke==38)||(ke==20)){
	var selVal = Ext.getCmp('grdsearchinsurance_insurancedebitnote').getValue();
    var searchitem=el.value;
	store.proxy.extraParams = { searhfield:selVal,searhvalue:searchitem};
	 store.load();
	 }
	
      });            
    }}
 }]
	
    });
	
	///grid selection
	
	grid.getSelectionModel().on({
        selectionchange: function(sm, selections) {
            if (selections.length) {
                buyAction.enable();
                sellAction.enable();
				itemAction40.enable(); 
            } else {
                buyAction.disable();
                sellAction.disable();
				itemAction40.disable();
            }
        }
    });
	///end of grid selection	
////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
  //Simple 'border layout' panel to house both grids
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 1000,
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
        title: 'Insurance Management',
        width: 1000,
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'insdestatemgtwin',
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
				Ext.getCmp('insdestatemgtwin').close();
				}
            }]
        }],*/
        buttonAlign:'center',
        buttons: [{
            text: 'Close',
			handler:function(){
				Ext.getCmp('insdestatemgtwin').close();
				}
			
        }]
    });

    win.show();

});
}
insurance_insurancedebitnoteFormRevised('Kwatuha Alfayo','IN20012','admin_person',51,2);
";

?>