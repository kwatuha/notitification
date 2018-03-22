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
            fieldLabel: 'Insured',
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
	
   findByInsuredUnderwriterRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
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
			labelAlign:'top',
            fieldLabel: 'Underwriter',
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
	
   findByInsuredUnderwriterRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
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
	
   findByInsuredUnderwriterRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
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
	
   findByInsuredUnderwriterRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
	
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
	
   findByInsuredUnderwriterRecord(tsearch_name,lsearch_name,lsearch_username,searchperiod_from,searchperiod_to,store);
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
         
			id: 'cinsured',
			readOnly:true,
            fieldLabel: 'Name'
        
		},
		   {
            xtype: 'textfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
			id: 'cunderwriter',
			readOnly:true,
            fieldLabel: 'Underwriter'
        
		},
		   {
            xtype: 'textfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            id: 'currentpolicyid',
			readOnly:true,
            fieldLabel: 'Policy Number' 
        
		},{
            xtype: 'textfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            
			id: 'texpire',
			readOnly:true,
            fieldLabel: 'Expire'
        
		},{
            xtype: 'numberfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            
			id: 'tpremium',
			readOnly:true,
            fieldLabel: 'Premium' 
        
		},
		   
  {
            xtype: 'numberfield',
			margin: '0 5 5 0',
			msgTarget : 'side',
			labelWidth:80,
			anchor:'100%',
            
			id: 'tpaymentby',
			readOnly:true,
            fieldLabel: 'Payment Mode'
        
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
            
			id: 'cinsuredid',
			readOnly:true,
            fieldLabel: 'Insured ID'
        
		},{
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            
			id: 'cinsuredpid',
			readOnly:true,
            fieldLabel: 'Insured PID'
        
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
            
			id: 'insuredaccountid',
			readOnly:true,
            fieldLabel: 'Account ID' 
        
		},{
            xtype: 'textfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            
			id: 'insureddebitnoteid',
			readOnly:true,
			hidden:true,
            fieldLabel: 'DB Note' 
        
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
					showInsuredAccts()
					}
                },
		   {
            text: 'Statement',
			margin: '0 5 5 0',
			xtype:'button',
			handler:function(){
	//cinsuredpid  cinsured cunderwriter statementsumm 
	// texpire tpremium tpaymentby ttotalbf ttotalpaid cinsuredid cinsuredpid
	
			var tid=Ext.getCmp('cinsuredid').getValue();
		    var tname=Ext.getCmp('cinsured').getValue();
		    var tpid=Ext.getCmp('cinsuredpid').getValue();
			var ref=Ext.getCmp('personreft').getValue(); 
			
			var insureddebitnoteid=Ext.getCmp('insureddebitnoteid').getValue(); 
			/*var start=Ext.getCmp('searchperiod_from').getValue();
		    var end=Ext.getCmp('searchperiod_to').getValue();
			
			var ttotalbf=Ext.getCmp('ttotalbf').getValue();
		    var ttotalpaid=Ext.getCmp('ttotalpaid').getValue();
			var tbalance=Ext.getCmp('tbalance').getValue(); */
			
			var accountid=Ext.getCmp('insuredaccountid').getValue(); 
			 
			 
			 
				insuredStatement(tid,tpid,tname,ref,insureddebitnoteid,accountid,57);
				}
			
        },{
            text: 'Debit Note',
			margin: '0 5 5 0',
			xtype:'button',
			handler:function(){
	//cinsuredpid  cinsured cunderwriter statementsumm 
	// texpire tpremium tpaymentby ttotalbf ttotalpaid cinsuredid cinsuredpid
	
			var tid=Ext.getCmp('cinsuredid').getValue();
		    var tname=Ext.getCmp('cinsured').getValue();
		    var tpid=Ext.getCmp('cinsuredpid').getValue();
			var ref=Ext.getCmp('personreft').getValue(); 
			
			var insureddebitnoteid=Ext.getCmp('insureddebitnoteid').getValue(); 
			/*var start=Ext.getCmp('searchperiod_from').getValue();
		    var end=Ext.getCmp('searchperiod_to').getValue();
			
			var ttotalbf=Ext.getCmp('ttotalbf').getValue();
		    var ttotalpaid=Ext.getCmp('ttotalpaid').getValue();
			var tbalance=Ext.getCmp('tbalance').getValue(); */
			
			var accountid=Ext.getCmp('insuredaccountid').getValue(); 
			 
			 
			 
				insuredStatement(tid,tpid,tname,ref,insureddebitnoteid,accountid,57);
				}
			
        },{
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
			 
			 var tid=Ext.getCmp('cinsuredid').getValue();
		    var tname=Ext. getCmp('cinsured').getValue();
		    var tpid=Ext.getCmp('cinsuredpid').getValue();
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
			var accountid=Ext.getCmp('insuredaccountid').getValue(); 
			openReceiptRpt(tid,tpid,tname,ref,start,end,contractdate,ttotalbf,ttotalrent,ttotalpaid,tbalance,accountid,water_elec,deposit,57,'IN');
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
	{name:'insurancedebitnote_id'},
	{name:'insurancedebitnote_name'},
	{name:'policy_number'},
	{name:'underwriter_name'},
	{name:'accaccount_name'},
	{name:'other_details'},
	{name:'date_created'},
	{name:'created_by'},
	{name:'person_fullname'},
	{name:'accaccount_id'},
	{name:'person_id'}]


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
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
		margins    : '0 0 0 3',
		listeners : {
		itemdblclick:function(dv, record, item, index, e){
		showInsuredAccts();
		},
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
		Ext.getCmp('cinsured').setValue(record.get('person_fullname'));
		Ext.getCmp('cinsuredpid').setValue(record.get('person_id'));
		Ext.getCmp('insureddebitnoteid').setValue(record.get('insurancedebitnote_id'));
		Ext.getCmp('personreft').setValue(record.get('accaccount_name'));
		Ext.getCmp('insuredaccountid').setValue(record.get('accaccount_id'));
		
		//fill account
		fillInsuredStatement(record.get('account_name'),57);
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
		new Ext.grid.RowNumberer(),{
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
        },{
				header     : 'Insured ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'person_fullname'
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
				 
				 sortable : true ,
				 dataIndex : 'date_created'
				 },
				 {
				header     : ' Entry By ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'created_by'
				 },
				 
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
						var ridtr=rec.get('insurancedebitnote_id');
						//confirmDelete();
						
						//deleteRecord('insurance_dbnotetransact',ridtr,store);
						deleteRecordOnconfirmation('insurance_insurancedebitnote',ridtr,store);
						
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
 }*/]
	
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