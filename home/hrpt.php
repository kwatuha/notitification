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
		   title:'Statement Summary',
		   
		   collapsible:true,
		    collapsed:true,
		   id:'statementsumm',
		   items:[
		   {
            xtype: 'textfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            name: 'ctenanat',
			id: 'ctenanat',
			readOnly:true,
            fieldLabel: 'Name'
        
		},
		   {
            xtype: 'textfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            name: 'clandlord',
			id: 'clandlord',
			readOnly:true,
            fieldLabel: 'Landlord'
        
		},
		   {
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            name: 'payablerent',
			id: 'payablerent',
			readOnly:true,
            fieldLabel: 'Current Rent'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'electricity_water',
			id: 'telectricity_water',
			readOnly:true,
            fieldLabel: 'Water & Elec.'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'deposit',
			id: 'tdeposit',
			readOnly:true,
            fieldLabel: 'Deposit'
        
		},
		   
  {
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            name: 'ttotalrent',
			id: 'ttotalrent',
			readOnly:true,
            fieldLabel: 'Total Rent'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            name: 'ttotalbf', 
			id: 'ttotalbf',
			readOnly:true,
            fieldLabel: 'Open. Bal'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            name: 'ttotalpenalty', 
			id: 'ttotalpenalty',
			readOnly:true,
            fieldLabel: 'Late Charges'
        
		},{
            xtype: 'numberfield',
			labelWidth:80,
			anchor:'100%',
			margin: '0 5 5 0',
			msgTarget : 'side',
            name: 'ttotalpaid',
			id: 'ttotalpaid',
			readOnly:true,
            fieldLabel: 'Total Paid'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			labelWidth:80,
			//cls:'markNegativeNumbers',
			anchor:'100%',
			msgTarget : 'side',
            name: 'tbalance',
			id: 'tbalance',
			readOnly:true,
            fieldLabel: 'Balance'
       },{
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'chousingtenantid',
			id: 'chousingtenantid',
			readOnly:true,
            fieldLabel: 'Tenant ID'
        
		},{
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'chousingtenantpid',
			id: 'chousingtenantpid',
			readOnly:true,
            fieldLabel: 'Tenant PID'
        
		},{
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'personreft',
			id: 'personreft',
			readOnly:true,
            fieldLabel: 'Person Ref' 
        
		},{
            xtype: 'textfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'taccountid',
			id: 'taccountid',
			readOnly:true,
            fieldLabel: 'Account ID' 
        
		},{
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'contractdatet',
			id: 'contractdatet',
			readOnly:true,
            fieldLabel: 'Entry Date'
        
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
            name: 'recalledchecks',
			id: 'recalledchecks',
			readOnly:true,
            fieldLabel: 'Recalled'
        
		},{
            xtype: 'datefield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'postdatedchecks',
			id: 'postdatedchecks',
			readOnly:true,
            fieldLabel: 'Post dated time'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'unclearedchecks',
			id: 'unclearedchecks',
			readOnly:true,
            fieldLabel: 'Uncleared'
        
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
            text: 'Statement',
			margin: '0 5 5 0',
			xtype:'button',
			handler:function(){
			
			var tid=Ext.getCmp('chousingtenantid').getValue();
		    var tname=Ext.getCmp('ctenanat').getValue();
		    var tpid=Ext.getCmp('chousingtenantpid').getValue();
			var ref=Ext.getCmp('personreft').getValue(); 
			
			var start=Ext.getCmp('searchperiod_from').getValue();
		    var end=Ext.getCmp('searchperiod_to').getValue();
			var contractdate=Ext.getCmp('contractdatet').getValue();
			 
			var ttotalbf=Ext.getCmp('ttotalbf').getValue();
		    var ttotalrent=Ext.getCmp('ttotalrent').getValue();
		    var ttotalpaid=Ext.getCmp('ttotalpaid').getValue();
			var tbalance=Ext.getCmp('tbalance').getValue(); 
			
			var water_elec=Ext.getCmp('telectricity_water').getValue();
			var deposit=Ext.getCmp('tdeposit').getValue(); 
			var accountid=Ext.getCmp('taccountid').getValue(); 
			 
			 
			 
				tenantStatement(tid,tpid,tname,ref,start,end,contractdate,ttotalbf,ttotalrent,ttotalpaid,tbalance,accountid,water_elec,deposit,54,'est');
				}
			
        },/*{
            text: 'Accounts',
			margin: '0 5 5 0',
			xtype:'button',
			handler:function(){
			var ref=Ext.getCmp('personreft').getValue(); 
			//changePayment(ref);
			scriptDesignerGen();
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        },*/{
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
			 //showereceipt.php
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        },/*{
            text: 'Receipt',
			xtype:'button',
			margin: '0 5 5 0',
			handler:function(){
			 
			 //////////////////////////////////
			 
			 var tid=Ext.getCmp('chousingtenantid').getValue();
		    var tname=Ext.getCmp('ctenanat').getValue();
		    var tpid=Ext.getCmp('chousingtenantpid').getValue();
			var ref=Ext.getCmp('personreft').getValue(); 
			
			var start=Ext.getCmp('searchperiod_from').getValue();
		    var end=Ext.getCmp('searchperiod_to').getValue();
			var contractdate=Ext.getCmp('contractdatet').getValue();
			 
			var ttotalbf=Ext.getCmp('ttotalbf').getValue();
		    var ttotalrent=Ext.getCmp('ttotalrent').getValue();
		    var ttotalpaid=Ext.getCmp('ttotalpaid').getValue();
			var tbalance=Ext.getCmp('tbalance').getValue(); 
			
			var water_elec=Ext.getCmp('telectricity_water').getValue();
			var deposit=Ext.getCmp('tdeposit').getValue(); 
			var accountid=Ext.getCmp('taccountid').getValue(); 
			openReceiptRpt(tid,tpid,tname,ref,start,end,contractdate,ttotalbf,ttotalrent,ttotalpaid,tbalance,accountid,water_elec,deposit,54);
			 //////////////////////////////////////
				//Ext.getCmp('idestatemgtwin').close();
				}
			
        },*/{
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
	fields:[{name:'housingtenant_id'},{name:'housingtenant_name'},{name:'person_name'},{name:'housinglandlord_name'},{name:'contract_day'},{name:'month_name'},{name:'contract_year'},{name:'property_description'},{name:'rent'},{name:'electricity_water'},{name:'rentperiod_name'},{name:'deposit_description'},{name:'tenancy_period'},{name:'period_starts'},{name:'period_startdate'},{name:'period_months'},{name:'contract_dated'},{name:'person_fullname'},{name:'lpid'},{name:'tenantpid'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housingtenant',
	sorters: {property: 'housinglandlord_name', direction: 'ASC'},
	groupField: 'housinglandlord_name',
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?htdtls=1',
		
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
            text: 'Task',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'insurancedebitnote_name',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Tenants)' : '(1 Tenant)');
            }
           },
		{
				header     : ' Housingtenant Name ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'housingtenant_name'
				 },
				 {
				header     : ' Person Id ' , 
				 width : 160 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'person_name'
				 },
				 {
				header     : 'Landlord ' , 
				 width : 160 , 
				 sortable : true ,
				 dataIndex : 'housinglandlord_name'
				 },
				 {
				header     : ' Contract Day ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'contract_day'
				 },
				 {
				header     : ' Month Id ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'month_name'
				 },
				 {
				header     : ' Contract Year ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'contract_year'
				 },
				 {
				header     : ' Property Description ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'property_description'
				 },
				 {
				header     : ' Rent ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'rent'
				 },
				 {
				header     : ' Electricity Water ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'electricity_water'
				 },
				 {
				header     : ' Rentperiod Id ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'rentperiod_name'
				 },
				 {
				header     : ' Deposit Description ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'deposit_description'
				 },
				 {
				header     : ' Tenancy Period ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'tenancy_period'
				 },
				 {
				header     : ' Period Starts ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'period_starts'
				 },
				 {
				header     : ' Period Startdate ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'period_startdate'
				 },
				 {
				header     : ' Period Months ' , 
				 width : 80 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'period_months'
				 },
				 {
				header     : ' Contract Dated ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'contract_dated'
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
                        var ccrecordid=rec.get('housingtenant_id');
						var tcrtb=\"housing_housingtenant\";
						if(tcrtb==\"housing_housinglandlord\")
						OpenlandlordContract(ccrecordid);
						
						if(tcrtb==\"housing_housingtenant\"){
						var mtid=rec.get('tenantpid');
						OpenTenantContract(ccrecordid,mtid);
						}
						
						
							if(tcrtb==\"medicallab_histology\")
						OpenMyhistology(ccrecordid);
							if(tcrtb==\"medicallab_labresult\")
						OpenCytology(ccrecordid);
						//alert(ccrecordid+\":There was an error\");
						//createFormTabs('loadtype',ccrecordid,'housing_housingtenant');
                    }
                },{
                    icon   : '../shared/icons/fam/feedback.png',
                    tooltip: 'Notify ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('housingtenant_id');
						var mtid=rec.get('tenantpid');
						
						OpenTenantNotification(ccrecordid,mtid);
						
						
						
						//alert(ccrecordid+\":There was an error\");
						//createFormTabs('loadtype',ccrecordid,'housing_housingtenant');
                    }
                },{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
						var tblnow=\"housing_housingtenant\";
						
                        
						var rec = store.getAt(rowIndex);
				        var ridtr=rec.get('housingtenant_id');
				        
						deleteRecordOnconfirmation('housing_housingtenant',ridtr,store);
						 onMouseOver=\"showMenuDesign();\"
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
var ctv='housing_housingtenant';
var ccrecordid=rec.get('housingtenant_id');
Ext.getCmp('idestatemgtwin').close();
housing_housingtenantForm('detailinfo','updateload',ccrecordid);

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
        title: 'Tenant Contracts',
       region:'center',
	   listeners : {
	   itemdblclick:function(dv, record, item, index, e){
	   showTenantAccts();
	   },
    itemclick: function(dv, record, item, index, e) {
	  var empname=record.get('housingtenant_name');
	  
		Ext.getCmp('statementsumm').expand();
		Ext.getCmp('statemenopers').expand();
		Ext.getCmp('statemenopers').enable();
		Ext.getCmp('ctenanat').setValue(empname);
		Ext.getCmp('clandlord').setValue(record.get('housinglandlord_name'));
		Ext.getCmp('payablerent').setValue(record.get('rent'));
		
		Ext.getCmp('ttotalrent').setValue(record.get('rentd'));
		Ext.getCmp('ttotalbf').setValue(record.get('rentd'));
		Ext.getCmp('ttotalpenalty').setValue(record.get('rentdd'));
		Ext.getCmp('tbalance').setValue(record.get('rentd'));
		Ext.getCmp('chousingtenantid').setValue(record.get('housingtenant_id'));
		Ext.getCmp('chousingtenantpid').setValue(record.get('tenantpid'));
		Ext.getCmp('ttotalpaid').setValue(record.get('rentd'));
		Ext.getCmp('personreft').setValue(record.get('person_name'));
		Ext.getCmp('contractdatet').setValue(record.get('period_startdate'));
		var acc=record.get('person_name');
		fillTenantStatement(acc,54);
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
		tbar:[/*{
                    text:'Add Record',
                    tooltip:' Add Tenant',
                    iconCls:'add',
					handler:function(){
						Ext.getCmp('idestatemgtwin').close();
						registerperson();
					}
                }, '-',{
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReport('aG91c2luZ19ob3VzaW5ndGVuYW50');
					}
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenInvoice('aG91c2luZ19ob3VzaW5ndGVuYW50');
					}
                },*//*
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReceipt('aG91c2luZ19ob3VzaW5ndGVuYW50');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenStatement('aG91c2luZ19ob3VzaW5ndGVuYW50');
					}
                },'-',{
                    text:'Delete',
                    tooltip:'Delete record',
                    iconCls:'remove'
                },*//*'-',
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
	name:'grdsearchhousing_housingtenant',
	id:'grdsearchhousing_housingtenant',
	forceSelection:true,
    fieldLabel: false,
    store: searchhousing_housingtenantdata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchhousing_housingtenant').getValue();
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
	var selVal = Ext.getCmp('grdsearchhousing_housingtenant').getValue();
    var searchitem=el.value;
	store.proxy.extraParams = { searhfield:selVal,searhvalue:searchitem};
	 store.load();
	 }
	
      });            
    }}
 }*/]
	
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
        title: 'Estate Management',
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