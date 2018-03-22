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
			id: 'isearch_name',
			value:'',
            fieldLabel: 'Employee Name',
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
            fieldLabel: 'A/C'
        
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
            fieldLabel: 'Collected Rent'
        
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
            fieldLabel: 'Deposits'
        
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
            fieldLabel: 'Expenditure'
        
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
            fieldLabel: 'Recoveries'
        
		},{
            xtype: 'numberfield',
			labelWidth:80,
			anchor:'100%',
			margin: '0 5 5 0',
			msgTarget : 'side',
            name: 'ttotalpaid',
			id: 'ttotalpaid',
			readOnly:true,
            fieldLabel: 'Total Commission'
        
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
            fieldLabel: 'Available Balance'
       },{
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'chousingtenantid',
			id: 'chousingtenantid',
			readOnly:true,
            fieldLabel: 'Last Paid'
        
		},{
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            name: 'myaccountpid',
			id: 'myaccountpid',
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
            name: 'myaccountid',
			id: 'myaccountid',
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
            xtype: 'hiddenfield',
			margin: '0 5 5 0',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
           
			id: 'housinglandlordid',
			readOnly:true,
            fieldLabel: 'Landlord ID'
        
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
					showEmployeePersonAccts();
					//showGeneralAccts()
					
					}
                },
		   {
            text: 'Statement s',
			margin: '0 5 5 0',
			xtype:'button',
			handler:function(){
			
			var tid=Ext.getCmp('chousingtenantid').getValue();
		    var tname=Ext.getCmp('ctenanat').getValue();
		    var tpid=Ext.getCmp('myaccountpid').getValue();
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
			var accountid=Ext.getCmp('myaccountid').getValue(); 
			 var housinglandlordid=Ext.getCmp('housinglandlordid').getValue();
			 
			 //landlordStatement(tid,tpid,tname,ref,start,end,acccategory)
				landlordStatement(tid,tpid,tname,ref,start,end,53,'est',housinglandlordid,accountid);
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
			 
			 var tid=Ext.getCmp('chousingtenantid').getValue();
		    var tname=Ext.getCmp('ctenanat').getValue();
		    var tpid=Ext.getCmp('myaccountpid').getValue();
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
			var accountid=Ext.getCmp('myaccountid').getValue(); 
			openReceiptRpt(tid,tpid,tname,ref,start,end,contractdate,ttotalbf,ttotalrent,ttotalpaid,tbalance,accountid,water_elec,deposit,53);
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
	fields:[{name:'nssf_number'}
			,{name:'dept_name'}
			,{name:'nhif_number'}
			,{name:'employee_number'}
			,{name:'person_id'}
			,{name:'dob'}
			,{name:'gender'}
			,{name:'pin_number'}
			,{name:'national_ID'}
			,{name:'employee_name'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housinglandlord',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?temprcds=1',
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
	
	
	  var empname=record.get('employee_name');
	  
		Ext.getCmp('statementsumm').expand();
		Ext.getCmp('statemenopers').expand();
		Ext.getCmp('statemenopers').enable();
		Ext.getCmp('ctenanat').setValue(empname);
		Ext.getCmp('clandlord').setValue(record.get('housinglandlord_name'));
		Ext.getCmp('payablerent').setValue(record.get('rent'));
		
		Ext.getCmp('housinglandlordid').setValue(record.get('housinglandlord_id'));
		Ext.getCmp('ttotalrent').setValue(record.get('rentd'));
		Ext.getCmp('ttotalbf').setValue(record.get('rentd'));
		Ext.getCmp('ttotalpenalty').setValue(record.get('rentdd'));
		Ext.getCmp('tbalance').setValue(record.get('rentd'));
		Ext.getCmp('chousingtenantid').setValue(record.get('housingtenant_id'));
		Ext.getCmp('myaccountpid').setValue(record.get('person_id'));
		Ext.getCmp('ttotalpaid').setValue(record.get('rentd'));
		Ext.getCmp('personreft').setValue(record.get('employee_number'));
		Ext.getCmp('contractdatet').setValue(record.get('period_startdate'));
		var acc=record.get('employee_number');
		fillLandlordStatement(acc,53,record.get('person_id'));
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
		new Ext.grid.RowNumberer(),{
				header     : 'Employee Number' , 
				 width : 80 , 
				sortable : true ,
				 dataIndex : 'employee_number'
				 },
				 {
				header     : 'Employee Name ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'employee_name'
				 },
				 {
				header     : 'Dept ' , 
				 width : 60 , 
				 sortable : true ,
				 dataIndex : 'dept_name'
				 },
				 {
				header     : 'NSSF Number ' , 
				 width : 60 , 
				 sortable : true ,
				 dataIndex : 'nssf_number'
				 },
				 {
				header     : 'NHIF Number ' , 
				 width : 60 , 
				 sortable : true ,
				 dataIndex : 'nhif_number'
				 },
				 {
				header     : 'KRA Pin ' , 
				 width : 60 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'pin_number'
				 },
				 {
				header     : 'ID/Passport #' , 
				 width : 60 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'national_ID'
				 },
				 {
				header     : ' DOB ' , 
				 width : 60 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'dob'
				 },
				 {
				header     : 'Gender' , 
				 width : 60 , 
				  hidden:true,
				 sortable : true ,
				 dataIndex : 'gender'
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
                        var ccrecordid=rec.get('housinglandlord_id');
						var tcrtb=\"housing_housinglandlord\";
						if(tcrtb==\"housing_housinglandlord\")
						OpenlandlordContract(ccrecordid);
						
						if(tcrtb==\"housing_housingtenant\")
						OpenTenantContract(ccrecordid);
						
							if(tcrtb==\"medicallab_histology\")
						OpenMyhistology(ccrecordid);
							if(tcrtb==\"medicallab_labresult\")
						OpenCytology(ccrecordid);
						//alert(ccrecordid+\":There was an error\");
						//createFormTabs('loadtype',ccrecordid,'housing_housinglandlord');
                    }
                },{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
				        var ridtr=rec.get('housinglandlord_id');
				        deleteRecordOnconfirmation('housing_housinglandlord',ridtr,store);
                        
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
var ctv='housing_housinglandlord';
var ccrecordid=rec.get('housinglandlord_id');


if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
//editdiv
gridViewform_amrsconceptsFQM('detailinfo','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('housinglandlord_id')+'housinglandlord_id');
var ccrecordid=rec.get('housinglandlord_id');
Ext.getCmp('lidestatemgtwin').close();
housing_housinglandlordForm('detailinfo','updateload',ccrecordid);

}

                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 800,
		resizable:true,
        title: 'Personal Records',
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
                    tooltip:' Add Landlord',
                    iconCls:'add',
					handler:function(){
						Ext.getCmp('lidestatemgtwin').close();
						registerperson();
					}
                }, '-', {
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option'
                },
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option'
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option'
					
                },'-', {
                    text:'Statement',
                    tooltip:'Print Receipt',
                    iconCls:'option'
                },'-',{
                    text:'Delete',
                    tooltip:'Delete record',
                    iconCls:'remove'
                },'-',
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
	name:'grdsearchhousing_housinglandlord',
	id:'grdsearchhousing_housinglandlord',
	forceSelection:true,
    fieldLabel: false,
    store: searchhousing_housinglandlorddata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchhousing_housinglandlord').getValue();
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
	var selVal = Ext.getCmp('grdsearchhousing_housinglandlord').getValue();
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
				itemAction22.enable(); 
            } else {
                buyAction.disable();
                sellAction.disable();
				itemAction22.disable();
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
        title: 'Manage Employee Records',
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