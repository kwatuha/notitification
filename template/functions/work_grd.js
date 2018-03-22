//My users

function gridViewadmin_adminuser(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_adminuser = Ext.get('gridViewadmin_adminuser');	

	Ext.define('Admin_adminuser', {
    extend: 'Ext.data.Model',
	fields:['adminuser_id','employee_name','usergroup_name','username','password','status','effectivedate']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_adminuser',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_adminuser',
        reader: {
            type: 'json'
        }
    }
});
	/*win.show();
    return win;*/
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
		
		columns:[
				 new Ext.grid.RowNumberer(),
				 {
				 
		text     : ' Adminuser Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'adminuser_id'
		 },
		 {
		text     : ' Employee Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'employee_name'
		 },
		 {
		text     : ' User group ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'usergroup_name'
		 },
		 {
		text     : ' Username ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'username'
		 },
		 {
		text     : ' Password ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'password'
		 },
		 {
		text     : ' Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'status'
		 },
		 {
		text     : ' Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effectivedate'
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
//alert((rec.get('alert_id') < 0 ? 'Hold ' : 'Buy ') + rec.get('alert_name'));
loadTableInfo('admin_adminuser',rec.get('adminuser_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'My Users',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        },
		tbar:[{
                    text:'Add Record',
                    tooltip:'Add a new row',
                    iconCls:'add',
					handler:function(){
						alert('something');
					}
                }, '-', {
                    text:'Options',
                    tooltip:'Blah blah blah blaht',
                    iconCls:'option'
                },'-',{
                    text:'Remove Something',
                    tooltip:'Remove the selected item',
                    iconCls:'remove'
                }]
    });
	 var win = Ext.create('Ext.Window', {
		extend: 'Ext.ux.desktop.Module',				  
        title: 'Grid Filters Example',
		collapsable:true,
		autoScroll :true,
        height: 400,
        width: 800,
        layout: 'fit',
		items: grid
    }).show();
	
}//end of gridViewadmin_adminuser function
