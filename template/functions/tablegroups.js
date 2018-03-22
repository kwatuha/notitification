function gridCreateReportGroups(){
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
Ext.define('cmbadmin_table', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchadmin_tabledata = Ext.create('Ext.data.Store', {
    model: 'cmbadmin_table',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_table&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchadmin_tabledata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_table = Ext.get('gridViewadmin_table');	

	Ext.define('Admin_table', {
    extend: 'Ext.data.Model',
	fields:[{name:'table_id'},{name:'table_name'},{name:'statement_caption'},{name:'awaits'},{name:'success'},{name:'failure'},{name:'undetermined'}]
	}); 
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_table',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=admin_table&fdn='+searchitem+'&rptsrd=ui' ,
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
                grid.down('#removeButton').setDisabled(selections.length == 0);
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
        dockedItems: [{
            xtype: 'toolbar',
            dock: 'top',
            ui: 'header',
            layout: {
                pack: 'center'
            },
            items: [{
    xtype: 'combobox',
	name:'person_id',
	id:'groupinfo',
	forceSelection:true,
    fieldLabel: 'Assign to',
	labelWidth:80,
	width:300,
    store: admin_grpdata,
	margin: '0 5 0 0',
    queryMode: 'remote',
    displayField: 'group_caption',
    valueField: 'group_name',
	listeners: { select: function(combo, record, index ) { 
	var secelVallid = Ext.getCmp('groupinfo').getValue();
	store.proxy.extraParams = { findgroup:secelVallid};
	store.load();
	}}
	},{
                minWidth: 80,
				
                text: 'Save',
				handler:function(){
					var s = grid.getSelectionModel().getSelection();
							var selected='';
							var orther='';
							Ext.each(s, function (item) {
							 selected+=item.data.rolenotificationhist_id+',';
							 
							 orther+=item.data.notification_details+',';
							});
							var secelVallid = Ext.getCmp('person_id').getValue();
							
							if(secelVallid>0){
							//alert(secelVallid);	
								   Ext.Ajax.request({
								   url: 'ntp.php',
								   params:{theKeys:secelVallid,theKeys2:selected,orther:orther},
								   success: function(action){
										grid.store.reload();
									},
									failure: function(action){
									// you could put an error message here
									}
								   });
							
							}else{
								alert(secelVallid+'Ksssss');
							}
	
				}
            },{
                minWidth: 80,
                text: 'Cancel'
            }]
        }, {
            xtype: 'toolbar',
            items: [{
                text:'Add Something',
                tooltip:'Add a new row',
                iconCls:'add'
            }, '-', {
                text:'Options',
                tooltip:'Set options',
                iconCls:'option'
            },'-',{
                itemId: 'removeButton',
                text:'Remove Something',
                tooltip:'Remove the selected item',
                iconCls:'remove',
                disabled: true
            }]
        }],
        frame: true,
        stateful: true,
		closable:true,
		plugins: [rowEditing],
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
				header     : 'Report ' , 
				 flex : 1 , 
				 sortable : true ,
				 dataIndex : 'statement_caption'
				 },
				 {
				header     : 'Stage' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'awaits'/*,
				 filterable: true*/
				 },
				  {
				header     : 'Passed Stage' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'success'
				 },
				 {
				header     : 'Failed Stage' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'failure'
				 },
				 {
				header     : 'Undetermined' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'undetermined'
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
						var tblnow="admin_table";
						
                        alert('Sell mumnil tblnow =' + tblnow+ rec.get('alert_name'));
						
						
						 onMouseOver="showMenuDesign();"
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
//alert("wassssssssssssssssssssss");
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
        width: 800,
		resizable:true,
        title: ' Admin Table',
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
						createForm("Save","NOID","admin_table","f")
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
                },/*
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReceipt('YWRtaW5fdGFibGU=');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenStatement('YWRtaW5fdGFibGU=');
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
		
	

});//end of testing ext load	
}