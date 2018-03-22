 Ext.QuickTips.init(); 
 var closebtn= Ext.get('close-btn');
 var buttonaltert = Ext.get('buttongalertgrid'); 
 var myalertData; 
 var tablename='admin_alert'; 
 Ext.define('AdminAlert', 
 { extend: 'Ext.data.Model', 
 fields:['alert_id','alert_name','is_active','alert_description','success_status','alert_date]
  }); 
 var store = Ext.create('Ext.data.Store',
  { model: 'AdminAlert', 
  proxy: { type: 'ajax', 
  url : '../home/buidgrid.php', 
  reader: { type: 'json' } } });
   store.load();
  var grid = Ext.create('Ext.grid.Panel', 
  { store: store, 
  stateful: true, 
  collapsible: true,
   multiSelect: true, 
   stateId: 'stateGrid', 
   columns:[{ text : ' Alert # ' ,
    width : 80 , sortable : true , 
	dataIndex : 'alert_id' }, 
	{ text : ' Alert Name ' ,
	 flex: 1 , sortable : true , 
	 dataIndex : 'alert_name' },
	 { 
	 text : ' Is Active ', 
	 width : 80, 
	 sortable : true , 
	 dataIndex : 'is_active' }, 
	 { text : ' Alert Description ' ,
	  width : 80 ,
	   sortable : true , 
	   dataIndex : 'alert_description' 
	   }, 
	   { text : ' Success Status ' , 
	   width : 80 , sortable : true ,
	    dataIndex : 'success_status' 
		}, 
		{ text : ' Alert Date ' , 
		width : 80 , sortable : true , 
		dataIndex : 'alert_date' 
		},
		{ menuDisabled: true, 
		sortable: false, 
		xtype: 'actioncolumn', 
		width: 50, 
		items: [{ icon : '../../sview/shared/icons/fam/grid.png', 
		tooltip: 'Sell stock',
		 handler: function(grid, 
		 rowIndex, colIndex)
	{ var rec = store.getAt(rowIndex);
	 alert('Sell ' + rec.get('alert_name')); 
	 } }, 
	 { getClass: function(v, meta, rec) { if (rec.get('alert_name') < 0) { this.items[1].tooltip = 'Hold stock'; 
	 return 'alert-col'; } else { this.items[1].tooltip = 'Buy stock'; return 'buy-col'; } }, 
	 handler: function(grid, rowIndex, colIndex) { var rec = store.getAt(rowIndex); 
	 alert((rec.get('alert_id') < 0 ? 'Hold ' : 'Buy ') + rec.get('alert_name'));
	  } }] } ],
   tbar:[{
                    text:'Add Something',
                    tooltip:'Add a new row',
                    iconCls:'add'
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                }],
	  height: 350, 
	  width: 600, 
	  title: 'Kwautha alfayo', renderTo: 'alertdata', viewConfig: { stripeRows: true, enableTextSelection: true } }); 