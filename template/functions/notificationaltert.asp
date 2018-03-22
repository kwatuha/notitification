function gridViewadmin_groupnotificationhist( searchitem){
var viewdiv=document.getElementById('detailinfo');
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

Ext.define('cmbadmin_groupnotificationhist', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchadmin_groupnotificationhistdata = Ext.create('Ext.data.Store', {
    model: 'cmbadmin_groupnotificationhist',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=admin_groupnotificationhist&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchadmin_groupnotificationhistdata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_groupnotificationhist = Ext.get('gridViewadmin_groupnotificationhist');	

	Ext.define('Admin_groupnotificationhist', {
    extend: 'Ext.data.Model',
	fields:[{name:'groupnotificationhist_id'},{name:'notificationalert_name'},{name:'actioned_by'},{name:'action'},{name:'primary_tablelist'},{name:'recordid'},{name:'status'},{name:'comment'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_groupnotificationhist',
	
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=admin_groupnotificationhist&fdn='+searchitem+'&dyt=',
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
						  
        store: store,
		/*bbar:[items:[{
		xtype:'button',
		text:'Close'
		}],*/
        stateful: true,
		closable:true,
		
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
				header     : ' Notificationalert Id ' , 
				 flex : 1 , 
				 
				 sortable : true ,
				 dataIndex : 'notificationalert_name'/*,
				 filterable: true*/
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
						var tblnow="admin_groupnotificationhist";
						
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
var ctv='admin_groupnotificationhist';
var ccrecordid=rec.get('groupnotificationhist_id');


if(ctv=='form_amrsconcepts'){
//alert(ccrecordid);
gridViewform_amrsconceptsFQM('editdiv','updateload',1);
//form_amrsconceptsForm('editdiv','updateload',ccrecordid));
}else{

//alert(rec.get('groupnotificationhist_id')+'groupnotificationhist_id');
var ccrecordid=rec.get('groupnotificationhist_id');
admin_groupnotificationhistForm('editdiv','updateload',ccrecordid);

}

                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 800,
		resizable:true,
        title: ' Admin Groupnotificationhist',
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
                    tooltip:' admin groupnotificationhist',
                    iconCls:'add',
					handler:function(){
						createForm("Save","NOID","admin_groupnotificationhist","f")
					}
                }, '-', {
                    text:'PDF',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReport('YWRtaW5fZ3JvdXBub3RpZmljYXRpb25oaXN0');
					}
                },'-', {
                    text:'Invoice',
                    tooltip:'Create options',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenInvoice('YWRtaW5fZ3JvdXBub3RpZmljYXRpb25oaXN0');
					}
                },/*
				'-', {
                    text:'Receipt',
                    tooltip:'Print Receipt',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenReceipt('YWRtaW5fZ3JvdXBub3RpZmljYXRpb25oaXN0');
					}
                },
				'-', {
                    text:'Statement',
                    tooltip:'Print Statement',
                    iconCls:'option',
					handler:function(buttonObj, eventObj){
					
					OpenStatement('YWRtaW5fZ3JvdXBub3RpZmljYXRpb25oaXN0');
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
	name:'grdsearchadmin_groupnotificationhist',
	id:'grdsearchadmin_groupnotificationhist',
	forceSelection:true,
    fieldLabel: false,
    store: searchadmin_groupnotificationhistdata,
    queryMode: 'local',
    displayField: 'fieldcaption',
    valueField: 'fieldname',
	listeners: {
  select: function(combo,  record,  index ) {
    var selVal = Ext.getCmp('grdsearchadmin_groupnotificationhist').getValue();
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
	var selVal = Ext.getCmp('grdsearchadmin_groupnotificationhist').getValue();
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
		
	

	
}
gridViewadmin_groupnotificationhist();