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
		        xtype: 'fieldset',
				collapsible:true,
				id:'mypic',
				title:'Photo',
				width:160,
				html:'<div id=\"currentImage\" ></div>'
				
				
				},
	
			 {
            xtype: 'textfield',
			msgTarget : 'side',
			anchor:'100%',
			labelWidth:80,
			id: 'tsearch_name',
			value:'',
            fieldLabel: 'Tenant',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            labelWidth:80,
			id: 'lsearch_name',
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
            id: 'searchperiod_from',
			value:'',
            fieldLabel: 'From ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            id: 'searchperiod_to',
			value:'',
            fieldLabel: 'To ',
            allowBlank: false,
            minLength: 1
        
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
	fields:[
			{name:'nssf_number'}
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
    model: 'Housing_housingtenant',
	sorters: {property: 'dept_name', direction: 'ASC'},
	groupField: 'dept_name',
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?txvivr=ivr'+searchitem+'&dyt=',
		
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
            text: 'Department',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'dept_name',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Employees)' : '(1 Employee)');
            }
           },
		{
				header     : 'Employee Name ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'employee_name'
				 },
				 
				 {
				header     : 'Employee Number ' , 
				 width : 50 , 
				 sortable : true ,
				 dataIndex : 'employee_number'
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
				  hidden:true,
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
				        deleteRecord('housing_housingtenant',ridtr,store);
						
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
    itemclick: function(dv, record, item, index, e) {
	  var empname=record.get('housingtenant_name');
	  
		Ext.getCmp('statementsumm').expand();
		Ext.getCmp('statemenopers').expand();
		Ext.getCmp('statemenopers').enable();
		Ext.getCmp('ctenanat').setValue(empname);
		Ext.getCmp('clandlord').setValue(record.get('housinglandlord_name'));
		Ext.getCmp('payablerent').setValue(record.get('rent'));
		
		//////////////////////test
		
	var photohtm= '<div id=\"currentImage\" >'
+'<div id=\"cngphotodiv\"></div>'
    +'<center>'
        +'<a href=\"#\" onClick=\"'
		+'showPhotoMenu(\'admin_person\',14,\'285409\',23);\">'
		 +' <img visibility=\"visible\" alt=\"Employee Photo\" '
		 +' src=\"../template/images/default_employee_image.gif\" id=\"empPic\"'
		 +' style=\"width:100%;\" border=\"0\"'
		 +'height=\"150\" width=\"150\">'
       +' </a><span class=\"smallHelpText\"><strong>'
	   +'  </strong></span>'
    +'</center>'
+'</div>';
	alert('clicked');
	
	setPhotoDetails();
		///////////////////////////////
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
		tbar:[{
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
                },/*
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
 }]
	
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
        title: 'Payroll Manager',
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