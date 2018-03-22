function individualNotification( ){
	
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

Ext.define('cmbAdmin_person', {
    extend: 'Ext.data.Model',
	fields:['person_id','person_name']
	});

var admin_persondata = Ext.create('Ext.data.Store', {
    model: 'cmbAdmin_person',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_person',
        reader: {
            type: 'json'
        }
    }
});

admin_persondata.load();



Ext.onReady(function() {
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

Ext.define('cmbadmin_rolenotificationhist', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchadmin_rolenotificationhistdata = Ext.create('Ext.data.Store', {
    model: 'cmbadmin_rolenotificationhist',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_rolenotificationhist&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchadmin_rolenotificationhistdata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_rolenotificationhist = Ext.get('gridViewadmin_rolenotificationhist');	

	Ext.define('Admin_rolenotificationhist', {
    extend: 'Ext.data.Model',
	fields:[{name:'rolenotificationhist_id'},{name:'rolenotificationhist_name'},{name:'rolenotificationevent_name'},{name:'notification_details'},{name:'actioned_by'},{name:'action'},{name:'primary_tablelist'},{name:'recordid'},{name:'status'},{name:'comment'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_rolenotificationhist',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=admin_rolenotificationhist&fdn='+searchitem+'&dyt=',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
  
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
            dock: 'bottom',
            ui: 'footer',
            layout: {
                pack: 'center'
            },
            items: [{
    xtype: 'combobox',
	name:'person_id',
	id:'person_id',
	forceSelection:true,
    fieldLabel: 'Assign to',
	labelWidth:80,
	width:300,
    store: admin_persondata,
	margin: '0 5 0 0',
    queryMode: 'remote',
    displayField: 'person_name',
    valueField: 'person_id',
	listeners: { select: function(combo, record, index ) { 
	
	//createFillLandlordDetails(secelVallid,tenantid);
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
		new Ext.grid.RowNumberer(),{
				header     : ' Rolenotificationhist Name ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'rolenotificationhist_name'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Rolenotificationevent Id ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'rolenotificationevent_name'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Notification Details ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'notification_details',
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
				 },
				 {
				header     : ' Actioned By ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'actioned_by'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Action ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'action'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Primary Tablelist ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'primary_tablelist'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Recordid ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'recordid'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Status ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'status'/*,
				 filterable: true*/
				 },
				 {
				header     : ' Comment ' , 
				 width : 80 , 
				 
				 sortable : true ,
				 dataIndex : 'comment'/*,
				 filterable: true*/
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
						var tblnow="admin_rolenotificationhist";
						
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
var ctv='admin_rolenotificationhist';
var ccrecordid=rec.get('rolenotificationhist_id');


if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
gridViewform_amrsconceptsFQM('editdiv','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('rolenotificationhist_id')+'rolenotificationhist_id');
var ccrecordid=rec.get('rolenotificationhist_id');
admin_rolenotificationhistForm('editdiv','updateload',ccrecordid);

}

                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 800,
		resizable:true,
        title: ' Admin Rolenotificationhist',
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
                    tooltip:' admin rolenotificationhist',
                    iconCls:'add',
					handler:function(){
						createForm("Save","NOID","admin_rolenotificationhist","f")
					}
                }, '-', {
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReport('YWRtaW5fcm9sZW5vdGlmaWNhdGlvbmhpc3Q=');
					}
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenInvoice('YWRtaW5fcm9sZW5vdGlmaWNhdGlvbmhpc3Q=');
					}
                },/*
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReceipt('YWRtaW5fcm9sZW5vdGlmaWNhdGlvbmhpc3Q=');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenStatement('YWRtaW5fcm9sZW5vdGlmaWNhdGlvbmhpc3Q=');
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
	name:'grdsearchadmin_rolenotificationhist',
	id:'grdsearchadmin_rolenotificationhist',
	forceSelection:true,
    fieldLabel: false,
    store: searchadmin_rolenotificationhistdata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchadmin_rolenotificationhist').getValue();
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
	var selVal = Ext.getCmp('grdsearchadmin_rolenotificationhist').getValue();
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
				var rec = grid.getSelectionModel().getSelection()[0];
					if (rec) {
						//alert('asdfasdas dfdfdf'+rec.get('rolenotificationhist_name'));
					} 
			     

/*var s = grid.getSelectionModel().getSelection();
// And then you can iterate over the selected items, e.g.: 
selected = [];
Ext.each(s, function (item) {
              var rec = s[0];
             if (rec) {
						alert('asdfasdas dfdfdf'+rec.get('rolenotificationhist_name'));
					} 
				
});
*/
var s = grid.getSelectionModel().getSelection();
// And then you can iterate over the selected items, e.g.: 
selected = [];
Ext.each(s, function (item) {
  //alert(item.data.rolenotificationhist_name);
});

			
			
            } else {
                buyAction.disable();
                sellAction.disable();
				
            }
        }
    });
	///end of grid selection	
		//
				
	

});//end of testing ext load	
}