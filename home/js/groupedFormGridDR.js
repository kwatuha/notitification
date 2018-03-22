function createSMSDelReport(){
// createSMSDelReport('Kwatuha Alfayo','IN20012','admin_person',51,2);/
    var displayhere='detailinfo';
var personcode='Save';
var iowner='NOID';
var fullname;
var iowner ; var pid=51; var dbnoteid=1;
var viewdiv=document.getElementById('detailinfo');
viewdiv.innerHTML='';
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

Ext.define('cmbsms_smsgroup', {
    extend: 'Ext.data.Model',
	fields:['fieldname','fieldcaption']
	});

var searchsms_smsgroupdata = Ext.create('Ext.data.Store', {
    model: 'cmbsms_smsgroup',
    proxy: {
        type: 'ajax',
        url : 'cmb.php?tbp=sms_smsgroup&find=thistable',
        reader: {
            type: 'json'
        }
    }
});
searchsms_smsgroupdata.load();

var closebtn= Ext.get('close-btn');
	var  viewgrbtnsms_smsgroup = Ext.get('gridViewsms_smsgroup');

Ext.define('Housing_housingtenant', {
    extend: 'Ext.data.Model',
	fields:[{name:'source'},{name:'ref'},{name:'phone_number'},{name:'message'},{name:'other_details'},{name:'date_created'},{name:'status'},
    {name:'submittime'},{name:'senttime'},{name:'deliverytime'}
    ]
	});//
	var store = Ext.create('Ext.data.Store', {
    model: 'Housing_housingtenant',
	sorters: {property: 'housinglandlord_name', direction: 'ASC'},
	groupField: 'source',
	
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?deliveryRPT=rpt',
		
        reader: {
            type: 'json',
            totalProperty: 'totalCount',
            root: 'data'
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

        }
    });

	

    var buyAction = Ext.create('Ext.Action', {
        iconCls: 'user-girl',
        text: 'Edit',
        disabled: true,
        handler: function(widget, event) {
            var rec = grid.getSelectionModel().getSelection()[0];
            if (rec) {
               // alert('asdfasdas dfdfdf');
            } else {
               // alert('Please select a company from the grid');
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
		 margins    : '200 0 0 30',
        multiSelect: true,
		iconCls: 'icon-grid',
        stateId: 'stateGrid',
		animCollapse:false,
        constrainHeader:true,
        layout: 'fit',
		columnLines: true,
		bbar:{height: 20},
         dockedItems: [{
                xtype: 'pagingtoolbar',
                store: store,
                dock: 'bottom',
                displayInfo: true
            }],
		/*features: [filters],*/

        features: [{
            id: 'group',
            ftype: 'groupingsummary',
            groupHeaderTpl: '{name}',
            hideGroupedHeader: true,
            enableGroupingMenu: false
        }],//feaaaa
		columns:[
		new Ext.grid.RowNumberer({ width: 50, sortable: true }),
		     {
            text: 'Group',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'source',
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Messages)' : '(1 Message)');
            }
           }, 
				 {
				header     : 'Other Details' , 
				 width : 120 , 
				 sortable : true ,
				 dataIndex : 'other_details'
				 },
                 {
				header     : 'Ref. Details' , 
				 width : 160 , 
				 sortable : true ,
				 dataIndex : 'ref'
				 },
				 {
				header     : 'Phone Number ' , 
				 width : 110 , 
				 sortable : true ,
				 dataIndex : 'phone_number'
				 },
				
				 {
				header     : 'Message' , 
				 width : 320 , 
				 sortable : true ,
				 dataIndex : 'message'
				 },
				 {
				header     : 'Submit Time' , 
				 width : 120 , 
				 sortable : true ,
				 dataIndex : 'submittime',
				 },
				 {
				header     : 'Sent Time' , 
				 width : 120 , 
				 sortable : true ,
				 dataIndex : 'senttime'
				 },
				 {
				header     : 'Delivery Time' , 
				 width : 120 , 
				 sortable : true ,
				 dataIndex : 'deliverytime'
				 },
                 {
				header     : 'Status' , 
				 width : 60 , 
				 sortable : true ,
				 dataIndex : 'status'
				 },
				 {
				header     : ' Date ' , 
				 width : 100 , 
				 sortable : true ,
				 dataIndex : 'date_created'
				 }
        ]

		,
		maxHeight: 600,
        width: 1400,//working width:::
		resizable:true,
        title: 'SMS Delivery Status Reporting',
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
		tbar:['-','-','-','-',
				{ text:'Search',
 tooltip:'Find',
 iconCls:'find',
  margins    : '10 0 0 0',
  handler: function(grid, rowIndex, colIndex) {
 }

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
	var selVal = '';
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



});//end of testing ext load
}

