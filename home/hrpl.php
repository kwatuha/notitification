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


function landloradAgrrementRepts(fullname,personcode,iowner,pid,dbnoteid){

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
			id: 'ltsearch_name',
			value:'',
            fieldLabel: 'Tenant',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'textfield',
			msgTarget : 'side',
            labelWidth:80,
			id: 'llsearch_name',
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
            id: 'lsearchperiod_from',
			value:'',
            fieldLabel: 'From ',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'datefield',
			labelWidth:80,
			anchor:'100%',
			msgTarget : 'side',
            id: 'lsearchperiod_to',
			value:'',
            fieldLabel: 'To ',
            allowBlank: false,
            minLength: 1
        
		}]
		,buttons: [{
            text: 'Find',
			handler:function(){
				//Ext.getCmp('lidestatemgtwin').close();
				}
			
        },{
            text: 'Excel',
			handler:function(){
				//Ext.getCmp('lidestatemgtwin').close();
				}
			
        },{
            text: 'PDF',
			handler:function(){
				//Ext.getCmp('lidestatemgtwin').close();
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
	fields:[{name:'housingtenant_id'},{name:'housingtenant_name'},{name:'person_name'},{name:'housinglandlord_name'},{name:'contract_day'},{name:'month_name'},{name:'contract_year'},{name:'property_description'},{name:'rent'},{name:'electricity_water'},{name:'rentperiod_name'},{name:'deposit_description'},{name:'tenancy_period'},{name:'period_starts'},{name:'period_startdate'},{name:'period_months'},{name:'contract_dated'},{name:'person_fullname'},{name:'lpid'},{name:'tpid'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housingtenant',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=housing_housingtenant&fdn='+searchitem+'&dyt=',
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
	fields:[{name:'housinglandlord_id'},{name:'housinglandlord_name'},{name:'person_name'},{name:'contract_day'},{name:'month_name'},{name:'contract_year'},{name:'term_period'},{name:'term_months'},{name:'commission'},{name:'commission_alternative'},{name:'excess_amount'},{name:'payment_day'},{name:'property'},{name:'contract_dated'},{name:'rentperiod_name'},{name:'person_fullname'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housinglandlord',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=housing_housinglandlord&fdn='+searchitem+'&dyt=',
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
		/*bbar:[items:[{
		xtype:'button',
		text:'Close'
		}],*/
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
				header     : 'Ref' , 
				 width : 80 , 
				sortable : true ,
				 dataIndex : 'housinglandlord_name'
				 },
				 {
				header     : 'Landlord Name' , 
				 flex : 1 , 
				sortable : true ,
				 dataIndex : 'person_fullname'
				 },
				 
				 {
				header     : ' Contract Day ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'contract_day'
				 },
				 {
				header     : ' Month ' , 
				 width : 80 , 
				
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
				header     : ' Term Period ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'term_period'
				 },
				 {
				header     : ' Term Months ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'term_months'
				 },
				 {
				header     : ' Comm.' , 
				 width : 80 , 
				sortable : true ,
				 dataIndex : 'commission'
				 },
				 {
				header     : ' Commission Alternative ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'commission_alternative'
				 },
				 {
				header     : ' Excess Amount ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'excess_amount'
				 },
				 {
				header     : ' Payment Day ' , 
				 width : 80 , 
				hidden:true,
				 sortable : true ,
				 dataIndex : 'payment_day'
				 },
				 {
				header     : ' Property ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'property'
				 },
				 {
				header     : ' Contract Dated ' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'contract_dated'
				 },
				 {
				header     : 'Period' , 
				 width : 80 , 
				 hidden:true,
				 sortable : true ,
				 dataIndex : 'rentperiod_name'
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
                    icon   : '../shared/icons/fam/cog.gif',
                    tooltip: 'action ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        var ccrecordid=rec.get('housinglandlord_id');
						//alert(ccrecordid+\":There was an error\");
						//createFormTabs('loadtype',ccrecordid,'housing_housinglandlord');
                    }
                },{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Delete ',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
				        var ridtr=rec.get('housinglandlord_id');
				        deleteRecord('housing_housinglandlord',ridtr);
                        
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
        title: 'Landlord Contracts',
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
					handler:function(buttonObj, eventObj){
					
					OpenReport('aG91c2luZ19ob3VzaW5nbGFuZGxvcmQ=');
					}
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenInvoice('aG91c2luZ19ob3VzaW5nbGFuZGxvcmQ=');
					} 
                },
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReceipt('aG91c2luZ19ob3VzaW5nbGFuZGxvcmQ=');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenStatement('aG91c2luZ19ob3VzaW5nbGFuZGxvcmQ=');
					}
                },'-', {
                    text:'Statement',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					insReceipts();
					}
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
 }]
	
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
        title: 'Estate Management',
        width: 1000,
		bodyPadding:10,
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'lidestatemgtwin',
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
				Ext.getCmp('lidestatemgtwin').close();
				}
            }]
        }],*/
        buttonAlign:'center',
        buttons: [{
            text: 'Close',
			handler:function(){
				Ext.getCmp('lidestatemgtwin').close();
				}
			
        }]
    });

    win.show();

});
}
landloradAgrrementRepts('Kwatuha Alfayo','IN20012','admin_person',51,2);
";

?>