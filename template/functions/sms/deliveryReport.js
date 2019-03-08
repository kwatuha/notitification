function smsDeliveryReport(){
    var viewdiv=document.getElementById('detailinfo');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnsms_msgdelivery = Ext.get('gridViewsms_msgdelivery');	

	Ext.define('Sms_msgdelivery', {
    extend: 'Ext.data.Model',
	fields:['msgdelivery_id','messageid','externalid','senderid','mobileno','message','submittime','senttime','deliverytime','status','undeliveredreason','details']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Sms_msgdelivery',
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=sms_msgdelivery',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        //collapsible: true,
        multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		//headerPosition :'left',
		bbar:{height: 20},
		columns:[
		new Ext.grid.RowNumberer(),{
		text     : ' # ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'msgdelivery_id'
		 },
		 {
		text     : ' Message ID ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'messageid'
		 },
		 {
		text     : ' External ID ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'externalid'
		 },
		 {
		text     : ' Sender ID ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'senderid'
		 },
		 {
		text     : ' Mobilen No. ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'mobileno'
		 },
		 {
		text     : ' Message ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'message'
		 },
		 {
		text     : ' Submit Time ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'submittime'
		 },
		 {
		text     : ' Sent Time ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'senttime'
		 },
		 {
		text     : ' Delivery Time ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'deliverytime'
		 },
		 {
		text     : ' Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'status'
		 },
		 {
		text     : ' Reason ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'undeliveredreason'
		 },
		 {
		text     : ' Details ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'details'
		 },
		 {
                menuDisabled: true,
                sortable: false,
                xtype: 'actioncolumn',
                width: 50,
                items: [{
                    icon   : '../shared/icons/fam/delete.gif',
                    tooltip: 'Sell stock',
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);
                        alert('Sell ' + rec.get('alert_name'));
                    }
                }, {
                    getClass: function(v, meta, rec) { 
                        if (rec.get('alert_name') < 0) {
                            this.items[1].tooltip = 'Hold stock';
                            return 'alert-col';
                        } else {
                            this.items[1].tooltip = 'Buy stock';
                            return 'buy-col';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = store.getAt(rowIndex);

sms_msgdeliveryForm('detailinfo','updateload',rec.get('msgdelivery_id'));
                    }
                }]
            }
        ]
		
		,
		maxHeight: 600,
        width: 600,
		resizable:true,
        title: ' Sms Msgdelivery',
        renderTo: 'detailinfo',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
		},
		tbar:[{
                    text:'Add Record',
                    tooltip:'Add a new row',
                    iconCls:'add',
					handler:function(){
						 
					}
                }, '-', {
                    text:'Options',                  
                    iconCls:'option'
                }]
		
    });
	
	/*var win = Ext.create('Ext.Window', {
		extend: 'Ext.ux.desktop.Module',				  
        title: 'Grid Filters Example',
		collapsable:true,
		autoScroll :true,
        layout: 'fit',
		items: grid
    }).show();*/
	
}//end of gridViewsms_msgdelivery function
