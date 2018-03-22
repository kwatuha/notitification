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


function createSMSDelReport(fullname,personcode,iowner,pid,dbnoteid){

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
        items      : [{xtype:'fieldset',
		   title:'Search & Filters',
		   collapsible:true,
		    collapsed:true,
		   id:'searchfilters',
		   items:[
		    {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
			labelWidth:50,
			id: 'tsearch_name',
			value:'',
            fieldLabel: 'Tenant',
            allowBlank: false,
            minLength: 1,
			listeners: {'render': function(cmp) { 
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
		 
	if(ke==13){
	var tsearch_name = Ext.getCmp('tsearch_name').getValue();
	var lsearch_name = Ext.getCmp('lsearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByTenantLandlordRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
	 }
	
      });            
    }}
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            labelWidth:50,
			id: 'lsearch_name',
			anchor:'100%',
			value:'',
            fieldLabel: 'Landlord',
            allowBlank: false,
            minLength: 1,
			listeners: {'render': function(cmp) { 
      cmp.getEl().on('keyup', function( event, el ) {
     	 var ke= event.getKey();
		 
	if(ke==13){
	var tsearch_name = Ext.getCmp('tsearch_name').getValue();
	var lsearch_name = Ext.getCmp('lsearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByTenantLandlordRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
	 }
	
      });            
    }}
        
		},
		   {
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
	var tsearch_name = Ext.getCmp('tsearch_name').getValue();
	var lsearch_name = Ext.getCmp('lsearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByTenantLandlordRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
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
	var tsearch_name = Ext.getCmp('tsearch_name').getValue();
	var lsearch_name = Ext.getCmp('lsearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByTenantLandlordRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
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
	var tsearch_name = Ext.getCmp('tsearch_name').getValue();
	var lsearch_name = Ext.getCmp('lsearch_name').getValue();
	var searchperiod_from = Ext.getCmp('searchperiod_from').getValue();
	var searchperiod_to = Ext.getCmp('searchperiod_to').getValue();
	var lsearch_username = Ext.getCmp('lsearch_username').getValue();
	
   findByTenantLandlordRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
}}

	}]},{xtype:'fieldset',
		   title:'Checks Summary',
		   collapsed:true,
		   collapsible:true,
		   id:'statementotherdetails',
		   items:[{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'bounchedchecks',
			id: 'bounchedchecks',
			readOnly:true,
            fieldLabel: 'Bounched'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'unbankedchecks',
			id: 'unbankedchecks',
			readOnly:true,
            fieldLabel: 'Unbanked' 
        
		}]},{xtype:'fieldset',
		   title:'Operations',
		   collapsible:true,
		   collapsed:true,
		   disabled:true,
		   id:'statemenopers',
		   default:'button',
		   items:[
		   {
                    text:'Accounts',
                    xtype:'button',
					margin: '0 5 5 0',
					handler:function(){
					showTenantAccts()}
                },
		  {
            text: 'New Contract',
			margin: '0 5 5 0',
			xtype:'button',
			handler:function(){
			var ref=Ext.getCmp('personreft').getValue(); 
			//changePayment(ref);
			scriptDesignerGen();
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        },{
            text: 'Invoice',
			xtype:'button',
			margin: '0 5 5 0',
			handler:function(){
			 
				}
			
        },{
            text: 'SMS',
			iconCls:'myemail',
			xtype:'button',
			margin: '0 5 5 0',
			handler:function(){
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        },{
            text: 'Email',
			iconCls:'myemail',
			xtype:'button',
			margin: '0 5 5 0',
			handler:function(){
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        }]}]
		,buttons: [{
            text: 'Find',
			handler:function(){
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        },{
            text: 'Excel',
			handler:function(){
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        },{
            text: 'PDF',
			handler:function(){
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        }]
    });

   
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

Ext.define('cmbhousing_housingtenant', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchhousing_housingtenantdata = Ext.create('Ext.data.Store', {
    model: 'cmbhousing_housingtenant',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=housing_housingtenant&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchhousing_housingtenantdata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnhousing_housingtenant = Ext.get('gridViewhousing_housingtenant');	

	Ext.define('Housing_housingtenant', {
    extend: 'Ext.data.Model',
	fields:[{name:'source'},{name:'ref'},{name:'phone_number'},{name:'message'},{name:'other_details'},{name:'date_created'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housingtenant',
	sorters: {property: 'housinglandlord_name', direction: 'ASC'},
	groupField: 'source',
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?deliveryRPT=rpt',
		
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
    var grid = Ext.create('Ext.grid.Panel', {
		margins    : '0 0 0 3',				  
        store: store,
		
        stateful: true,
		
		multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
		features: [{
            id: 'group',
            ftype: 'groupingsummary',
            groupHeaderTpl: '{name}',
            hideGroupedHeader: true,
            enableGroupingMenu: false
        }],
		columns:[
		new Ext.grid.RowNumberer(),
		     {
            text: 'Group',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'source',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Messages)' : '(1 Message)');
            }
           },
				 {
				header     : 'Phone Number ' , 
				 width : 160 , 
				 sortable : true ,
				 dataIndex : 'phone_number'
				 },
				 {
				header     : 'ref' , 
				 width : 160 , 
				 sortable : true ,
				 dataIndex : 'Ref. Details'
				 },
				 {
				header     : 'Other details' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'message'
				 },
				 {
				header     : ' Date ' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'date_created'
				 },
				 			 
				 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 80,
                items: [
				  {
                    icon   : '../shared/icons/fam/report-paper.png',
                    tooltip: 'Contract ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('smsgroupmember_id');
						
                    }
                },{
                    icon   : '../shared/icons/fam/feedback.png',
                    tooltip: 'Notify ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                    }
                },{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
						var tblnow="housing_housingtenant";				 
						var rec = store.getAt(rowIndex);
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
                        var ctv='housing_housingtenant';
                        var ccrecordid=rec.get('housingtenant_id');
                        Ext.getCmp('idestatemgtwin').close();                       

                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 750,
		resizable:true,
		collapsible:true,
		autoScroll:true,
        title: 'SMS Status Reports',
       region:'center',
	   listeners : {
	   itemdblclick:function(dv, record, item, index, e){
	   showTenantAccts();
	   },
    itemclick: function(dv, record, item, index, e) {
	
		}}
	   ,
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
		tbar:[/**/]
	
    });
	
	///grid selection
	
	grid.getSelectionModel().on({
        selectionchange: function(sm, selections) {
            if (selections.length) {
                buyAction.enable();
                sellAction.enable();
				 
            } else {
                buyAction.disable();
                sellAction.disable();
				
            }
        }
    });
	///end of grid selection	
		
    var displayPanel = Ext.create('Ext.Panel', {
        width    : 1000,
        height   : 600,
		autoScroll:true,
        layout   : 'border',
        renderTo : 'panel',
        bodyPadding: '5',
        items    : [
           	grid,
			formPanel3
        ]
        
    });



var win = Ext.create('Ext.window.Window', {
        title: 'Group Membership',
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
