<?php

echo "function verifyPayroll(){
var displayhere='dynamicchild',loadtype='Save',rid='NOID', searchitem='NO';
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

   
Ext.onReady(function() {
Ext.QuickTips.init();
Ext.define('cmbsysgroups', {
    extend: 'Ext.data.Model',
	fields:['group_name','group_caption']
	});

var admin_grpdata = Ext.create('Ext.data.Store', {
    model: 'cmbsysgroups',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tgr=ggrp',
        reader: {
            type: 'json'
        }
    }
});

admin_grpdata.load();
Ext.define('cmbhrpayroll_payperiod', {
    extend: 'Ext.data.Model',
	fields:['payperiod_id','payperiod_name']
	});

var hrpayroll_payperioddata = Ext.create('Ext.data.Store', {
    model: 'cmbhrpayroll_payperiod',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=hrpayroll_payperiod',
        reader: {
            type: 'json'
        }
    }
});
hrpayroll_payperioddata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_table = Ext.get('gridViewadmin_table');	

	Ext.define('Admin_table', {
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
    model: 'Admin_table',
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

     var selModel = Ext.create('Ext.selection.CheckboxModel', {
        listeners: {
            selectionchange: function(sm, selections) {
                //grid.down('#removeButton').setDisabled(selections.length == 0);
            }
        }
    });
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
   var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
        clicksToMoveEditor: 1,
        autoCancel: false
    });
   //////////////////
    var grid = Ext.create('Ext.grid.Panel', {
		store: store,
		columnLines: true,
	
        selModel: selModel,

        // inline buttons
        
        //frame: true,
        stateful: true,
		//closable:true,
		plugins: [rowEditing],
        multiSelect: true,
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
		columns:[
		new Ext.grid.RowNumberer(),
		     
		  
				 {
				header     : 'Employee Name' , 
				 width: 180 , 
				 sortable : true ,
				 dataIndex : 'employee_name'
				 },
				 {
				header     : 'Employee #' , 
				 width : 80 , 
				 
				     
				 sortable : true ,
				 dataIndex : 'employee_number'
				 },
				  {
				header     : 'Nssf #' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'nssf_number'
				 },
				 {
				header     : 'NHIF #' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'nhif_number'
				 },
				 {
				header     : 'KRA Pin' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'pin_number'
				 },{
				header     : 'Department' , 
				 width : 100 , 
				 
				 sortable : true ,
				 dataIndex : 'dept_name'
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
						var tblnow=\"admin_table\";
						
                        alert('Sell mumnil tblnow =' + tblnow+ rec.get('alert_name'));
						
						
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
var ctv='admin_table';
var ccrecordid=rec.get('table_id');


if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
gridViewform_amrsconceptsFQM('editdiv','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('table_id')+'table_id');
var ccrecordid=rec.get('table_id');
admin_tableForm('editdiv','updateload',ccrecordid);

}

                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 1000,
		height:500,
		//resizable:true,
        title: false,
        renderTo: 'detailinfo',
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
                    tooltip:' admin table',
                    iconCls:'add',
					handler:function(){
						createForm(\"Save\",\"NOID\",\"admin_table\",\"f\")
					}
                }, '-', {
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReport('YWRtaW5fdGFibGU=');
					}
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenInvoice('YWRtaW5fdGFibGU=');
					}
                },'-',
				{ text:'Search', 
 tooltip:'Find', 
 iconCls:'find',
  handler: function(grid, rowIndex, colIndex) { 
testme();
 }

 }
 ,
/* 
 {
    xtype: 'combobox',
	name:'grdsearchadmin_table',
	id:'grdsearchadmin_table',
	forceSelection:true,
    fieldLabel: false,
    store: searchadmin_tabledata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchadmin_table').getValue();
	var selValtx = Ext.getCmp('searchfield').getValue();
  alert(selValtx+selVal);
}}

	},*/
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
	var selVal = Ext.getCmp('grdsearchadmin_table').getValue();
    //var searchitem=el.value;
	//store.proxy.extraParams = { searhfield:selVal,searhvalue:searchitem};
	// store.load();
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
		
var win = Ext.create('Ext.window.Window', {
        title: 'Payroll Period Register',
        width: 1200,
		
		bodyPadding:10,
        //layout: 'fit',
		iconCls: 'icon-grid',
		autoScroll:true,
		maximizable :true,
		collapsible :true,
        maximized:true,
		id:'frmselectlandlord',
        plain: true,
		layout:'column',
       items: [{
        title: 'Select employees for pay period',
        columnWidth: .8,
		items: grid
		},
		/*{
        title: 'Filters',
        columnWidth: .2,
		items:[{html:'<H1>Hellpo</H1>'}]
		}*/],
		
		dockedItems: [{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'header',
            layout: {
                pack: 'center'
            },
            items: [{
    xtype: 'combobox',
	name:'payperiod_id',
	id:'groupinfo',
	forceSelection:true,
    fieldLabel: 'Select payperiod',
	labelWidth:80,
	width:300,
    store: hrpayroll_payperioddata,
	margin: '0 5 0 0',
    queryMode: 'remote',
    displayField: 'payperiod_name',
    valueField: 'payperiod_id',
	listeners: { select: function(combo, record, index ) { 
	var secelVallid = Ext.getCmp('groupinfo').getValue();
	
	}}
	},{
                minWidth: 80,
				
                text: 'Save',
				handler:function(){
					var s = grid.getSelectionModel().getSelection();
							var selected='';
							var orther='';
							Ext.each(s, function (item) {
							 selected+=item.data.person_id+',';
							 
							 
							});
							var secelVallid = Ext.getCmp('groupinfo').getValue();
							alert(secelVallid+'  '+selected);
							if(secelVallid>0){
								
								   Ext.Ajax.request({
								   url: 'bodysave.php',
								   params:{payriodid:secelVallid,payperiodids:selected},
								   success: function(action){
										
									},
									failure: function(action){
									// you could put an error message here
									}
								   });
							
							}else{
								//alert(secelVallid+'Ksssss');
							}
	
				}
            },{
                minWidth: 80,
                text: 'Cancel'
            }]
        }]
    
    });

    win.show();	

});//end of testing ext load	
}

verifyPayroll()";

?>