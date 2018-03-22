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
    'Ext.selection.CheckboxModel',
	'Ext.form.field.Number',
    'Ext.form.field.Date',
    'Ext.tip.QuickTipManager'
]);


function showTransactionSummary(){

var displayhere='detailinfo';
var loadtype='Save';
var rid='NOID';
var obj=document.getElementById(displayhere);

var objchild=document.getElementById('dynamicchild');

objchild.innerHTML='';

obj.innerHTML='';


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
		maxHeight:520,
		maxWidth:250,
        items      : [
		 {xtype:'fieldset',
		   title:'Search & Filters',
		   //collapsible:true,
		   //expanded:true,
		   id:'searchfiltersd',
		   items:[
		
	
			 {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
			labelWidth:50,
			id: 'isearch_name',
			value:'',
            fieldLabel: 'Account',
            allowBlank: false,
            minLength: 1,
			listeners: {'render': function(cmp) { 
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
		 
	if(ke==13){
	var myname = Ext.getCmp('isearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findSummaryByNameRecord(myname,lsearch_username,searchperiod_from,searchperiod_to,store);
	
	 }
	
      });            
    }}
        
		},{
            xtype: 'datefield',
			anchor:'100%',
			msgTarget : 'side',
			labelWidth:50,
            id: 'searchperiod_from', 
			value:'',
            fieldLabel: 'From ',
            allowBlank: false,
            minLength: 1,
			listeners: {'render': function(cmp) { 
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
		 
	if(ke==13){
	var myname = Ext.getCmp('isearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByNameRecord(myname,lsearch_username,searchperiod_from,searchperiod_to,store);
	
	 }
	
      });            
    }}
        
		},{
            xtype: 'datefield',
			labelWidth:50,
			anchor:'100%',
			msgTarget : 'side',
            id: 'searchperiod_to',
			value:'',
            fieldLabel: 'To ',
            allowBlank: false,
            minLength: 1,
			listeners: {'render': function(cmp) { 
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
		 
	if(ke==13){
	var myname = Ext.getCmp('isearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByNameRecord(myname,lsearch_username,searchperiod_from,searchperiod_to,store);
	
	 }
	
      });            
    }}
        
		},{
    xtype: 'combobox',
	id:'lsearch_username',
	forceSelection:true,
    fieldLabel: 'Entry By',
	labelWidth:50,
	labelAlign:'top',
	anchor:'100%',
	value:'ALL',
    store: searchentrydata,
    queryMode: 'local',
    displayField: 'person_fullname',
    valueField: 'person_id',
	listeners: {
  select: function(combo,  record,  index ) {
	var myname = Ext.getCmp('isearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByNameRecord(myname,lsearch_username,searchperiod_from,searchperiod_to,store);
}}

	}]}]
    });
//hide unencessary fields
   /////////////////////////GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG
   
var viewdiv=document.getElementById('detailinfo'),searchitem;
viewdiv.innerHTML='';
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
 var closebtn= Ext.get('close-btn');
	var  viewgrbtninsurance_insurancedebitnote = Ext.get('gridViewinsurance_insurancedebitnote');	
 
	Ext.define('Insurance_insurancedebitnote', {
    extend: 'Ext.data.Model',
	fields:[ 
	        {name:'accountscategory_name'},
			{name:'date_created'},
			{name:'cash_trans',type: 'float'},
			{name:'check_received',type: 'float'},
			{name:'check_paid',type: 'float'},
			{name:'cmonth'}, 
			{name:'total',type: 'float'}
			]


	});
	
	///
	
	
	////
	var store = Ext.create('Ext.data.Store', {
    model: 'Insurance_insurancedebitnote',
	//sorters: {property: 'cmonth', direction: 'ASC'},
	groupField: 'cmonth',
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?trsmry=cts',
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
  Ext.define('cmbinsurance_insurancedebitnote', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

/*var searchinsurance_insurancedebitnotedata = Ext.create('Ext.data.Store', {
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
*/
  ////////// 
  
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
		margins    : '0 0 0 3',
		listeners : {
    itemclick: function(dv, record, item, index, e) {
	 // var empname=record.get('housingtenant_name');
	 /* alert('hh');
	  
	{name:'insurancedebitnote_id'},{name:'insurancedebitnote_name'},
	{name:'policy_number'},{name:'underwriter_name'},
	{name:'person_name'},{name:'other_details'},{name:'currency_name'},{name:'pcf'},
	{name:'training_levy'},{name:'insured'},
	{name:'dbnotetransact_id'},
	{name:'stamp_duty'},{name:'wtax'},{name:'person_fullname'}*/
	
	//cinsuredpid  cinsured cunderwriter statementsumm 
	// texpire tpremium tpaymentby ttotalbf ttotalpaid cinsuredid cinsuredpid
	    Ext.getCmp('statementsumm').expand();
		Ext.getCmp('statemenopers').expand();
		Ext.getCmp('statemenopers').enable(); 
		
	    Ext.getCmp('currentpolicyid').setValue(record.get('policy_number'));
		Ext.getCmp('personreft').setValue(record.get('insurancedebitnote_name'));
		Ext.getCmp('cunderwriter').setValue(record.get('underwriter_name'));
		Ext.getCmp('cinsured').setValue(record.get('insured'));
		Ext.getCmp('cinsuredpid').setValue(record.get('person_id'));
		Ext.getCmp('insureddebitnoteid').setValue(record.get('insurancedebitnote_id'));
		Ext.getCmp('personreft').setValue(record.get('account_name'));
		//fill account
		fillInsuredStatement(record.get('account_name'),54);
		}}
	   ,

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
		new Ext.grid.RowNumberer(),		
		   
				 
				 {
				header     : 'Category' , 
				 
				  flex : 1 ,   
				 sortable : true ,
				 dataIndex : 'accountscategory_name'
				 },
				 
				 {
				header     : ' Month Year' , 
				width : 80 ,
				 sortable : true ,
				 dataIndex : 'cmonth'
				 },
				 
				 {
				header     : ' Entry Date ' , 
				  width : 80 , 
				  sortable : true ,
				  dataIndex : 'date_created'
				 },
				 
				 {
				header     : 'Cash' , 
				 width : 150 , 
				 
				 sortable : true ,
				 dataIndex : 'cash_trans',
				 field: {
				xtype: 'numberfield'
				},
				summaryType: 'sum',
				renderer: function(value, metaData, record, rowIdx, colIdx, store, view){
				var cvaluenew=value;
				return cvaluenew ;
				},
				summaryRenderer: function(value, summaryData, dataIndex) {
				return   value ;
				}
				 },{
				header     : 'Received By Checque' , 
				 width : 150 , 
				 
				 sortable : true ,
				 dataIndex : 'check_received',
				 summaryType: 'sum',
									renderer: function(v){return v.toFixed(2);},
									summaryRenderer: function(value, summaryData, dataIndex) {
									return value.toFixed(2) ;
									}
				 },
				 
				 {
				header     : 'Paid By Checque' , 
				 width : 150 , 
				 
				 sortable : true ,
				 dataIndex : 'check_paid',
				 summaryType: 'sum',
									renderer: function(v){return v.toFixed(2);},
									summaryRenderer: function(value, summaryData, dataIndex) {
									return value.toFixed(2) ;
									}
				 }/*,
				  
				  {
				header     : 'Total' , 
				 width : 150 , 
				 
				 sortable : true ,
				 dataIndex : 'total',
				 field: {
				xtype: 'numberfield'
				},
				 summaryType: 'sum',
				renderer: function(value, metaData, record, rowIdx, colIdx, store, view){
				var cvaluenew=value;
				return cvaluenew ;
				},
				summaryRenderer: function(value, summaryData, dataIndex) {
				return   value ;
				}
				 }*//*,
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 80,
                items: [
				  {
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
						var ridtr=rec.get('cashtrans_id');
						//confirmDelete();
						
						//deleteRecord('accounts_cashtrans',ridtr,store);
						deleteRecordOnconfirmation('accounts_cashtrans',ridtr,store);
						
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
var ctv='accounts_cashtrans';
var ccrecordid=rec.get('cashtrans_id');


if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
//editdiv
gridViewform_amrsconceptsFQM('detailinfo','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('insurancedebitnote_id')+'insurancedebitnote_id');
var ccrecordid=rec.get('cashtrans_id');
accounts_cashtransForm('detailinfo','updateload',ccrecordid);

}

                    }
                }]
            }*/
        ]
		,
		resizable:true,
        title: ' Insurance Insurancedebitnote',
       maxHeight: 600,
        width: 800,
		resizable:true,
        title: 'Transactions Summary',
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
		tbar:[/*{
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
                },*//*
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
                },*/]
	
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
        title: 'Daily Cash & Check Transactions',
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
showTransactionSummary();
";

?>