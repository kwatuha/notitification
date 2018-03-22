function gridViewFormGroup( searchitem){
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

	Ext.define('Sms_smsgroup', {
    extend: 'Ext.data.Model',
	fields:[{name:'smsgroupmember_id'},{name:'member_description'},{name:'phone_number'},{name:'smsgroup_name'},{name:'other_details'},{name:'date_created'}]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Sms_smsgroup',
    pageSize: 20,
	sorters: {property: 'smsgroup_name', direction: 'ASC'},
	groupField: 'smsgroup_name',
    proxy: {
        type: 'ajax',
        url : 'buidgrid.php?t=sms_smsgroupmember&fdn='+searchitem+'&dyt=',
        reader: {
            type: 'json',
            totalProperty: 'totalCount',
            root: 'data'
        }
    }
});
  store.load({pageSize:50});

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
		new Ext.grid.RowNumberer({ width: 70, sortable: true }),
        
        
        {
            text: 'Group',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'smsgroup_name',
            closed:true,
            hideable: false,
            summaryType: 'count',
            summaryRenderer: function(value, summaryData, dataIndex) {
                return ((value === 0 || value > 1) ? '(' + value + ' Members)' : '(1 Member)');
            }
           },
        
        
        {
				header     : 'Phone Number ' , 
				 width : 160 , 
				 sortable : true ,
				 dataIndex : 'phone_number'
				 },
				 {
				header     : 'Description' , 
				 width : 160 , 
				 sortable : true ,
				 dataIndex : 'member_description'
				 },
				 {
				header     : 'Other details' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'other_details'
				 },
				 {
				header     : ' Date ' , 
				 width : 80 , 
				 sortable : true ,
				 dataIndex : 'date_created'
				 }
        ]

		,
		maxHeight: 600,
        width: 1400,//working width:::
		resizable:true,
        title: 'Group Membership',
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
  handler: function(grid, rowIndex, colIndex) {
//testme();
 }

 }
 ,
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
	// var selVal = Ext.getCmp('grdsearchsms_smsgroup').getValue();
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

