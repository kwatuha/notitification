

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


// admin alert

function gridViewadmin_alert(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_alert = Ext.get('gridViewadmin_alert');	

	Ext.define('Admin_alert', {
    extend: 'Ext.data.Model',
	fields:['alert_id','alert_name','is_active','alert_description','success_status','alert_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_alert',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_alert',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Alert Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alert_id'
		 },
		 {
		text     : ' Alert Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'alert_name'
		 },
		 {
		text     : ' Is Active ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'is_active'
		 },
		 {
		text     : ' Alert Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alert_description'
		 },
		 {
		text     : ' Success Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'success_status'
		 },
		 {
		text     : ' Alert Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alert_date'
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
loadTableInfo('admin_alert',rec.get('alert_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Alert',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_alert function


// admin autofill

function gridViewadmin_autofill(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_autofill = Ext.get('gridViewadmin_autofill');	

	Ext.define('Admin_autofill', {
    extend: 'Ext.data.Model',
	fields:['autofill_id','tablename','tablefield','prefix','sufix','digit_number']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_autofill',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_autofill',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Autofill Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'autofill_id'
		 },
		 {
		text     : ' Tablename ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Tablefield ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'tablefield'
		 },
		 {
		text     : ' Prefix ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'prefix'
		 },
		 {
		text     : ' Sufix ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'sufix'
		 },
		 {
		text     : ' Digit Number ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'digit_number'
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
loadTableInfo('admin_autofill',rec.get('autofill_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Autofill',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_autofill function


//Registered Company

function gridViewadmin_company(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_company = Ext.get('gridViewadmin_company');	

	Ext.define('Admin_company', {
    extend: 'Ext.data.Model',
	fields:['company_id','company_name','pin_num','vat_num','institution_reg','incorp_dt','postal_address','postal_code','town','telephone','fax','mobile','email_address','website','effective_dt']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_company',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_company',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Company Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'company_id'
		 },
		 {
		text     : ' Company Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'company_name'
		 },
		 {
		text     : ' Pin Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'pin_num'
		 },
		 {
		text     : ' Vat Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'vat_num'
		 },
		 {
		text     : ' Institution Reg ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'institution_reg'
		 },
		 {
		text     : ' Incorp Dt ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'incorp_dt'
		 },
		 {
		text     : ' Postal Address ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'postal_address'
		 },
		 {
		text     : ' Postal Code ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'postal_code'
		 },
		 {
		text     : ' Town ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'town'
		 },
		 {
		text     : ' Telephone ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'telephone'
		 },
		 {
		text     : ' Fax ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'fax'
		 },
		 {
		text     : ' Mobile ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'mobile'
		 },
		 {
		text     : ' Email Address ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'email_address'
		 },
		 {
		text     : ' Website ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'website'
		 },
		 {
		text     : ' Effective Dt ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_dt'
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
loadTableInfo('admin_company',rec.get('company_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Registered Company',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_company function


//admin controller

function gridViewadmin_controller(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_controller = Ext.get('gridViewadmin_controller');	

	Ext.define('Admin_controller', {
    extend: 'Ext.data.Model',
	fields:['controller_id','tablename','showgroup','fieldcaption','position','colnwidth','dispaytype','infshow','displaysize']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_controller',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_controller',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'controller_id'
		 },
		 {
		text     : ' Tablename ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Showgroup ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'showgroup'
		 },
		 {
		text     : ' Fieldcaption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'fieldcaption'
		 },
		 {
		text     : ' Position ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'position'
		 },
		 {
		text     : ' Colnwidth ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'colnwidth'
		 },
		 {
		text     : ' Dispaytype ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'dispaytype'
		 },
		 {
		text     : ' Infshow ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'infshow'
		 },
		 {
		text     : ' Displaysize ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'displaysize'
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
loadTableInfo('admin_controller',rec.get('controller_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Admin Controller',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_controller function


//Group Notifications

function gridViewadmin_groupnotification(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_groupnotification = Ext.get('gridViewadmin_groupnotification');	

	Ext.define('Admin_groupnotification', {
    extend: 'Ext.data.Model',
	fields:['groupnotification_id','usergroup_name','alert_name','tablename','status','comments','effective_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_groupnotification',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_groupnotification',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'groupnotification_id'
		 },
		 {
		text     : ' Notify group ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'usergroup_name'
		 },
		 {
		text     : ' Alert Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alert_name'
		 },
		 {
		text     : ' Section ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'status'
		 },
		 {
		text     : ' Comment ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'comments'
		 },
		 {
		text     : ' Date created ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_date'
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
loadTableInfo('admin_groupnotification',rec.get('groupnotification_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Group Notifications',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_groupnotification function


//Notification history

function gridViewadmin_groupnotificationhist(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_groupnotificationhist = Ext.get('gridViewadmin_groupnotificationhist');	

	Ext.define('Admin_groupnotificationhist', {
    extend: 'Ext.data.Model',
	fields:['groupnotificationhist_id','alert_name','actioned_by','action','tablename','recordid','status','comment','flashed','effective_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_groupnotificationhist',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_groupnotificationhist',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Groupnotificationhist Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'groupnotificationhist_id'
		 },
		 {
		text     : ' Alert Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'alert_name'
		 },
		 {
		text     : ' Actioned By ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'actioned_by'
		 },
		 {
		text     : ' Action ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'action'
		 },
		 {
		text     : ' Tablename ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Recordid ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'recordid'
		 },
		 {
		text     : ' Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'status'
		 },
		 {
		text     : ' Comment ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'comment'
		 },
		 {
		text     : ' Flashed ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'flashed'
		 },
		 {
		text     : ' Effective Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_date'
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
loadTableInfo('admin_groupnotificationhist',rec.get('groupnotificationhist_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Notification History',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_groupnotificationhist function


// admin ntg

function gridViewadmin_ntg(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_ntg = Ext.get('gridViewadmin_ntg');	

	Ext.define('Admin_ntg', {
    extend: 'Ext.data.Model',
	fields:['ntg_id','tablename','alert_name','is_active','date_created']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_ntg',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_ntg',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Ntg Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'ntg_id'
		 },
		 {
		text     : ' Tablename ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Alert Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alert_name'
		 },
		 {
		text     : ' Is Active ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'is_active'
		 },
		 {
		text     : ' Date Created ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'date_created'
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
loadTableInfo('admin_ntg',rec.get('ntg_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Ntg',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_ntg function


// admin rights

function gridViewadmin_rights(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_rights = Ext.get('gridViewadmin_rights');	

	Ext.define('Admin_rights', {
    extend: 'Ext.data.Model',
	fields:['rights_id','usergroup_name','controller_name','view','edit','del','effective_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_rights',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_rights',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Rights Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'rights_id'
		 },
		 {
		text     : ' Usergroup Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'usergroup_name'
		 },
		 {
		text     : ' Controller Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'controller_name'
		 },
		 {
		text     : ' View ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'view'
		 },
		 {
		text     : ' Edit ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'edit'
		 },
		 {
		text     : ' Del ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'del'
		 },
		 {
		text     : ' Effective Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_date'
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
loadTableInfo('admin_rights',rec.get('rights_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Rights',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_rights function


// admin role

function gridViewadmin_role(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_role = Ext.get('gridViewadmin_role');	

	Ext.define('Admin_role', {
    extend: 'Ext.data.Model',
	fields:['role_id','role_name','user_status','dept_name','previlege','resource','effective_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_role',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_role',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Role Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'role_id'
		 },
		 {
		text     : ' Role Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'role_name'
		 },
		 {
		text     : ' User Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'user_status'
		 },
		 {
		text     : ' Dept Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'dept_name'
		 },
		 {
		text     : ' Previlege ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'previlege'
		 },
		 {
		text     : ' Resource ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'resource'
		 },
		 {
		text     : ' Effective Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_date'
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
loadTableInfo('admin_role',rec.get('role_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Role',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_role function


// admin table

function gridViewadmin_table(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_table = Ext.get('gridViewadmin_table');	

	Ext.define('Admin_table', {
    extend: 'Ext.data.Model',
	fields:['table_id','table_name','table_caption','statement_caption']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_table',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_table',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Table Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'table_id'
		 },
		 {
		text     : ' Table Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'table_name'
		 },
		 {
		text     : ' Table Caption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'table_caption'
		 },
		 {
		text     : ' Statement Caption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'statement_caption'
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
loadTableInfo('admin_table',rec.get('table_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Table',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_table function


// admin trail

function gridViewadmin_trail(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_trail = Ext.get('gridViewadmin_trail');	

	Ext.define('Admin_trail', {
    extend: 'Ext.data.Model',
	fields:['trail_id','employee_name','user_name','table_trail','table_action','table_value','activity','transaction_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_trail',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_trail',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Trail Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'trail_id'
		 },
		 {
		text     : ' Employee Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'employee_name'
		 },
		 {
		text     : ' User Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'user_name'
		 },
		 {
		text     : ' Table Trail ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'table_trail'
		 },
		 {
		text     : ' Table Action ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'table_action'
		 },
		 {
		text     : ' Table Value ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'table_value'
		 },
		 {
		text     : ' Activity ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'activity'
		 },
		 {
		text     : ' Transaction Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'transaction_date'
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
loadTableInfo('admin_trail',rec.get('trail_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Trail',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_trail function


// admin user

function gridViewadmin_user(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_user = Ext.get('gridViewadmin_user');	

	Ext.define('Admin_user', {
    extend: 'Ext.data.Model',
	fields:['id','employee_name','userid','user_password','UserName','user_priviledge','security_question','security_q_answer','usergroup_name','user_active_status','effective_dt']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_user',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_user',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'id'
		 },
		 {
		text     : ' Employee Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'employee_name'
		 },
		 {
		text     : ' Userid ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'userid'
		 },
		 {
		text     : ' User Password ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'user_password'
		 },
		 {
		text     : ' UserName ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'UserName'
		 },
		 {
		text     : ' User Priviledge ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'user_priviledge'
		 },
		 {
		text     : ' Security Question ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'security_question'
		 },
		 {
		text     : ' Security Q Answer ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'security_q_answer'
		 },
		 {
		text     : ' Usergroup Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'usergroup_name'
		 },
		 {
		text     : ' User Active Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'user_active_status'
		 },
		 {
		text     : ' Effective Dt ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_dt'
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
loadTableInfo('admin_user',rec.get('user_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin User',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_user function


// admin useremp

function gridViewadmin_useremp(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_useremp = Ext.get('gridViewadmin_useremp');	

	Ext.define('Admin_useremp', {
    extend: 'Ext.data.Model',
	fields:['useremp_id','usergroup_name','user_name','tablename','previlege','start_date','end_date','savedby','comment','effective_dt']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_useremp',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_useremp',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Useremp Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'useremp_id'
		 },
		 {
		text     : ' Usergroup Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'usergroup_name'
		 },
		 {
		text     : ' User Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'user_name'
		 },
		 {
		text     : ' Tablename ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Previlege ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'previlege'
		 },
		 {
		text     : ' Start Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'start_date'
		 },
		 {
		text     : ' End Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'end_date'
		 },
		 {
		text     : ' Savedby ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'savedby'
		 },
		 {
		text     : ' Comment ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'comment'
		 },
		 {
		text     : ' Effective Dt ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_dt'
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
loadTableInfo('admin_useremp',rec.get('useremp_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Useremp',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_useremp function


// admin usergroup

function gridViewadmin_usergroup(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_usergroup = Ext.get('gridViewadmin_usergroup');	

	Ext.define('Admin_usergroup', {
    extend: 'Ext.data.Model',
	fields:['usergroup_id','usergroup_name','userg_description']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_usergroup',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_usergroup',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Usergroup Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'usergroup_id'
		 },
		 {
		text     : ' Usergroup Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'usergroup_name'
		 },
		 {
		text     : ' Userg Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'userg_description'
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
loadTableInfo('admin_usergroup',rec.get('usergroup_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Usergroup',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_usergroup function


// admin usergrouprole

function gridViewadmin_usergrouprole(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_usergrouprole = Ext.get('gridViewadmin_usergrouprole');	

	Ext.define('Admin_usergrouprole', {
    extend: 'Ext.data.Model',
	fields:['usergrouprole_id','usergroup_name','tablename','previge','start_date','end_date','effective_dt']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_usergrouprole',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_usergrouprole',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Usergrouprole Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'usergrouprole_id'
		 },
		 {
		text     : ' Usergroup Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'usergroup_name'
		 },
		 {
		text     : ' Tablename ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Previge ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'previge'
		 },
		 {
		text     : ' Start Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'start_date'
		 },
		 {
		text     : ' End Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'end_date'
		 },
		 {
		text     : ' Effective Dt ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_dt'
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
loadTableInfo('admin_usergrouprole',rec.get('usergrouprole_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Usergrouprole',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_usergrouprole function


//form change

function gridViewform_change(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnform_change = Ext.get('gridViewform_change');	

	Ext.define('Form_change', {
    extend: 'Ext.data.Model',
	fields:['change_id','form_name','change_description','status','changedby','change_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Form_change',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=form_change',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'change_id'
		 },
		 {
		text     : ' Form ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'form_name'
		 },
		 {
		text     : ' Change Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'change_description'
		 },
		 {
		text     : ' Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'status'
		 },
		 {
		text     : ' Changed by ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'changedby'
		 },
		 {
		text     : ' Change Date ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'change_date'
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
loadTableInfo('form_change',rec.get('change_id'),'Update','Form');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Form Change',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewform_change function


//Forms

function gridViewform_createform(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnform_createform = Ext.get('gridViewform_createform');	

	Ext.define('Form_createform', {
    extend: 'Ext.data.Model',
	fields:['createform_id','createform_name','form_name','formquestion_name','formquestionanswer_name','group_name','subgroup_name','snp_status']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Form_createform',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=form_createform',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'createform_id'
		 },
		 {
		text     : ' Form Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'createform_name'
		 },
		 {
		text     : ' Form  Type ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'form_name'
		 },
		 {
		text     : ' Question ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formquestion_name'
		 },
		 {
		text     : ' Options ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formquestionanswer_name'
		 },
		 {
		text     : ' Category ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'group_name'
		 },
		 {
		text     : ' Sub Category ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'subgroup_name'
		 },
		 {
		text     : ' Snp Status ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'snp_status'
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
loadTableInfo('form_createform',rec.get('createform_id'),'Update','Form');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Forms',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewform_createform function


//form formitem

function gridViewform_formitem(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnform_formitem = Ext.get('gridViewform_formitem');	

	Ext.define('Form_formitem', {
    extend: 'Ext.data.Model',
	fields:['formitem_id','form_name','formquestion_name','formquestionanswer_name','constraint_name','enforce_creteria']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Form_formitem',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=form_formitem',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Formitem Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formitem_id'
		 },
		 {
		text     : ' Form Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'form_name'
		 },
		 {
		text     : ' Formquestion Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formquestion_name'
		 },
		 {
		text     : ' Formquestionanswer Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formquestionanswer_name'
		 },
		 {
		text     : ' Constraint Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'constraint_name'
		 },
		 {
		text     : ' Enforce Creteria ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'enforce_creteria'
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
loadTableInfo('form_formitem',rec.get('formitem_id'),'Update','Form');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Form Formitem',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewform_formitem function


//List question

function gridViewform_formquestion(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnform_formquestion = Ext.get('gridViewform_formquestion');	

	Ext.define('Form_formquestion', {
    extend: 'Ext.data.Model',
	fields:['formquestion_id','formquestion_name','question_concept_id','question_concept_name','question_concept_display']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Form_formquestion',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=form_formquestion',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Formquestion Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formquestion_id'
		 },
		 {
		text     : ' Formquestion Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'formquestion_name'
		 },
		 {
		text     : ' Question Concept Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'question_concept_id'
		 },
		 {
		text     : ' Question Concept Name ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'question_concept_name'
		 },
		 {
		text     : ' Question Concept Display ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'question_concept_display'
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
loadTableInfo('form_formquestion',rec.get('formquestion_id'),'Update','Form');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'List Question',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewform_formquestion function


//Question answer

function gridViewform_formquestionanswer(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnform_formquestionanswer = Ext.get('gridViewform_formquestionanswer');	

	Ext.define('Form_formquestionanswer', {
    extend: 'Ext.data.Model',
	fields:['formquestionanswer_id','formquestion_name','formquestionanswer_name','conceptID','conceptName','displayconceptcaption']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Form_formquestionanswer',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=form_formquestionanswer',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Formquestionanswer Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formquestionanswer_id'
		 },
		 {
		text     : ' Formquestion Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'formquestion_name'
		 },
		 {
		text     : ' Formquestionanswer Name ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formquestionanswer_name'
		 },
		 {
		text     : ' ConceptID ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'conceptID'
		 },
		 {
		text     : ' ConceptName ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'conceptName'
		 },
		 {
		text     : ' Displayconceptcaption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'displayconceptcaption'
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
loadTableInfo('form_formquestionanswer',rec.get('formquestionanswer_id'),'Update','Form');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Question Answer',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewform_formquestionanswer function


//Form

function gridViewmobile_form(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnmobile_form = Ext.get('gridViewmobile_form');	

	Ext.define('Mobile_form', {
    extend: 'Ext.data.Model',
	fields:['form_id','form_name','form_version','program_name','date_created']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Mobile_form',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=mobile_form',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'form_id'
		 },
		 {
		text     : ' Form Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'form_name'
		 },
		 {
		text     : ' Form Version ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'form_version'
		 },
		 {
		text     : ' Program ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'program_name'
		 },
		 {
		text     : ' Date Created ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'date_created'
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
loadTableInfo('mobile_form',rec.get('form_id'),'Update','Structure');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Form',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewmobile_form function


// pim employee

function gridViewpim_employee(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnpim_employee = Ext.get('gridViewpim_employee');	

	Ext.define('Pim_employee', {
    extend: 'Ext.data.Model',
	fields:['employee_id','employee_number','employee_name','photo','DOB','national_ID','gender','address','phone_number','town','pin_number','nssf_number','nhif_number','email_address','postal_code','effective_dt']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Pim_employee',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=pim_employee',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Employee Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'employee_id'
		 },
		 {
		text     : ' Employee Number ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'employee_number'
		 },
		 {
		text     : ' Employee Name ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'employee_name'
		 },
		 {
		text     : ' Photo ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'photo'
		 },
		 {
		text     : ' DOB ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'DOB'
		 },
		 {
		text     : ' National ID ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'national_ID'
		 },
		 {
		text     : ' Gender ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'gender'
		 },
		 {
		text     : ' Address ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'address'
		 },
		 {
		text     : ' Phone Number ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'phone_number'
		 },
		 {
		text     : ' Town ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'town'
		 },
		 {
		text     : ' Pin Number ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'pin_number'
		 },
		 {
		text     : ' Nssf Number ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'nssf_number'
		 },
		 {
		text     : ' Nhif Number ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'nhif_number'
		 },
		 {
		text     : ' Email Address ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'email_address'
		 },
		 {
		text     : ' Postal Code ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'postal_code'
		 },
		 {
		text     : ' Effective Dt ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_dt'
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
loadTableInfo('pim_employee',rec.get('employee_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Pim Employee',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewpim_employee function


// structure constraint

function gridViewstructure_constraint(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnstructure_constraint = Ext.get('gridViewstructure_constraint');	

	Ext.define('Structure_constraint', {
    extend: 'Ext.data.Model',
	fields:['constraint_id','constraint_name','constraint_condition','constraint_description']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Structure_constraint',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=structure_constraint',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Constraint Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'constraint_id'
		 },
		 {
		text     : ' Constraint Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'constraint_name'
		 },
		 {
		text     : ' Constraint Condition ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'constraint_condition'
		 },
		 {
		text     : ' Constraint Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'constraint_description'
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
loadTableInfo('structure_constraint',rec.get('constraint_id'),'Update','Structure');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Structure Constraint',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewstructure_constraint function


// structure datatype

function gridViewstructure_datatype(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnstructure_datatype = Ext.get('gridViewstructure_datatype');	

	Ext.define('Structure_datatype', {
    extend: 'Ext.data.Model',
	fields:['datatype_id','datatype_name','datatype_code','datatype_description']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Structure_datatype',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=structure_datatype',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Datatype Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'datatype_id'
		 },
		 {
		text     : ' Datatype Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'datatype_name'
		 },
		 {
		text     : ' Datatype Code ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'datatype_code'
		 },
		 {
		text     : ' Datatype Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'datatype_description'
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
loadTableInfo('structure_datatype',rec.get('datatype_id'),'Update','Structure');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Structure Datatype',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewstructure_datatype function


// structure formconstraint

function gridViewstructure_formconstraint(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnstructure_formconstraint = Ext.get('gridViewstructure_formconstraint');	

	Ext.define('Structure_formconstraint', {
    extend: 'Ext.data.Model',
	fields:['formconstraint_id','form_name','formitem_name','constraint_name','formconstraint_name','formconstraint_condition','formconstraint_success','formconstraint_failure','formconstraint_description']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Structure_formconstraint',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=structure_formconstraint',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Formconstraint Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formconstraint_id'
		 },
		 {
		text     : ' Form Id ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'form_name'
		 },
		 {
		text     : ' Formitem Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formitem_name'
		 },
		 {
		text     : ' Constraint Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'constraint_name'
		 },
		 {
		text     : ' Formconstraint Name ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formconstraint_name'
		 },
		 {
		text     : ' Formconstraint Condition ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formconstraint_condition'
		 },
		 {
		text     : ' Formconstraint Success ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formconstraint_success'
		 },
		 {
		text     : ' Formconstraint Failure ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formconstraint_failure'
		 },
		 {
		text     : ' Formconstraint Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'formconstraint_description'
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
loadTableInfo('structure_formconstraint',rec.get('formconstraint_id'),'Update','Structure');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Structure Formconstraint',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewstructure_formconstraint function


// structure group

function gridViewstructure_group(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnstructure_group = Ext.get('gridViewstructure_group');	

	Ext.define('Structure_group', {
    extend: 'Ext.data.Model',
	fields:['group_id','group_name','group_description','date_created']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Structure_group',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=structure_group',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Group Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'group_id'
		 },
		 {
		text     : ' Group Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'group_name'
		 },
		 {
		text     : ' Group Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'group_description'
		 },
		 {
		text     : ' Date Created ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'date_created'
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
loadTableInfo('structure_group',rec.get('group_id'),'Update','Structure');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Structure Group',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewstructure_group function


// structure subgroup

function gridViewstructure_subgroup(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnstructure_subgroup = Ext.get('gridViewstructure_subgroup');	

	Ext.define('Structure_subgroup', {
    extend: 'Ext.data.Model',
	fields:['subgroup_id','subgroup_name','subgroup_description']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Structure_subgroup',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=structure_subgroup',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Subgroup Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'subgroup_id'
		 },
		 {
		text     : ' Subgroup Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'subgroup_name'
		 },
		 {
		text     : ' Subgroup Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'subgroup_description'
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
loadTableInfo('structure_subgroup',rec.get('subgroup_id'),'Update','Structure');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Structure Subgroup',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });

	
}//end of gridViewstructure_subgroup function


//Registered programs

function gridViewmobile_program(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnmobile_program = Ext.get('gridViewmobile_program');	

	Ext.define('Mobile_program', {
    extend: 'Ext.data.Model',
	fields:['program_id','program_name','program_description']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Mobile_program',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=mobile_program',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Program Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'program_id'
		 },
		 {
		text     : ' Program Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'program_name'
		 },
		 {
		text     : ' Program Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'program_description'
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
loadTableInfo('mobile_program',rec.get('program_id'),'Update','Form');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Registered Programs',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewmobile_program function


//Form Items

function gridViewform_item(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnform_item = Ext.get('gridViewform_item');	

	Ext.define('Form_item', {
    extend: 'Ext.data.Model',
	fields:['item_id','item_name','item_description','date_purchased']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Form_item',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=form_item',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'item_id'
		 },
		 {
		text     : ' Item Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'item_name'
		 },
		 {
		text     : ' Item Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'item_description'
		 },
		 {
		text     : ' Date Purchased ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'date_purchased'
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
loadTableInfo('form_item',rec.get('item_id'),'Update','Form');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Form Items',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewform_item function


//Notification Activities

function gridViewadmin_alertactivity(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_alertactivity = Ext.get('gridViewadmin_alertactivity');	

	Ext.define('Admin_alertactivity', {
    extend: 'Ext.data.Model',
	fields:['alertactivity_id','alert_name','activitystatus_name','alert_success','alert_success_caption','is_active_status','status_after_action','mark_task_completion']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_alertactivity',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_alertactivity',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alertactivity_id'
		 },
		 {
		text     : ' Task ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'alert_name'
		 },
		 {
		text     : ' Activity ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'activitystatus_name'
		 },
		 {
		text     : ' Success Action ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alert_success'
		 },
		 {
		text     : ' Activity  Caption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'alert_success_caption'
		 },
		 {
		text     : ' Is Active ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'is_active_status'
		 },
		 {
		text     : ' Status to ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'status_after_action'
		 },
		 {
		text     : ' Mark Task Completion ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'mark_task_completion'
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
loadTableInfo('admin_alertactivity',rec.get('alertactivity_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Notification Activities',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_alertactivity function


// admin activitystatus admin adminuser admin alert admin alertactivity admin autofill admin company a

function gridViewadmin_customer(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_customer = Ext.get('gridViewadmin_customer');	

	Ext.define('Admin_customer', {
    extend: 'Ext.data.Model',
	fields:[]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_customer',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_customer',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
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
loadTableInfo('admin_customer',rec.get(''),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: ' Admin Activitystatus Admin Adminuser Admin Alert Admin Alertactivity Admin Autofill Admin Company A',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_customer function


//Change Log

function gridViewadmin_log(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_log = Ext.get('gridViewadmin_log');	

	Ext.define('Admin_log', {
    extend: 'Ext.data.Model',
	fields:['log_id','controllerid','rid','entry','entry_type','useid','effective_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_log',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_log',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'log_id'
		 },
		 {
		text     : ' Section ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'controllerid'
		 },
		 {
		text     : ' Record Changed ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'rid'
		 },
		 {
		text     : ' Current Value ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'entry'
		 },
		 {
		text     : ' Change Type ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'entry_type'
		 },
		 {
		text     : ' Changed By ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'useid'
		 },
		 {
		text     : ' Date Changed ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_date'
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
loadTableInfo('admin_log',rec.get('log_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Change Log',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_log function


//Notification Activity status

function gridViewadmin_activitystatus(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_activitystatus = Ext.get('gridViewadmin_activitystatus');	

	Ext.define('Admin_activitystatus', {
    extend: 'Ext.data.Model',
	fields:['activitystatus_id','activitystatus_name','activitystatus_status','effective_date']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_activitystatus',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_activitystatus',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Num ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'activitystatus_id'
		 },
		 {
		text     : ' Notification status ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'activitystatus_name'
		 },
		 {
		text     : ' Is Active ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'activitystatus_status'
		 },
		 {
		text     : ' Date Created ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'effective_date'
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
loadTableInfo('admin_activitystatus',rec.get('activitystatus_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Notification Activity Status',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_activitystatus function


//Custom Data Fields

function gridViewadmin_custom(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_custom = Ext.get('gridViewadmin_custom');	

	Ext.define('Admin_custom', {
    extend: 'Ext.data.Model',
	fields:['custom_id','tablename','fieldname','stored_value','display_caption','displaytype']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_custom',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_custom',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Custom Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'custom_id'
		 },
		 {
		text     : ' Tablename ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'tablename'
		 },
		 {
		text     : ' Fieldname ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'fieldname'
		 },
		 {
		text     : ' Stored Value ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'stored_value'
		 },
		 {
		text     : ' Display Caption ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'display_caption'
		 },
		 {
		text     : ' Displaytype ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'displaytype'
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
loadTableInfo('admin_custom',rec.get('custom_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Custom Data Fields',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_custom function


//Registration Report

function gridViewadmin_student(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_student = Ext.get('gridViewadmin_student');	

	Ext.define('Admin_student', {
    extend: 'Ext.data.Model',
	fields:['student_id','student_name','student_address','date_of_birth','description']
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_student',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_student',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
		text     : ' Student Id ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'student_id'
		 },
		 {
		text     : ' Student Name ' , 
		 flex : 1 , 
		 sortable : true , 
		 dataIndex : 'student_name'
		 },
		 {
		text     : ' Student Address ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'student_address'
		 },
		 {
		text     : ' Date Of Birth ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'date_of_birth'
		 },
		 {
		text     : ' Description ' , 
		 width : 80 , 
		 sortable : true , 
		 dataIndex : 'description'
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
loadTableInfo('admin_student',rec.get('student_id'),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Registration Report',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_student function


//country report

function gridViewadmin_country(){
var viewdiv=document.getElementById('alertdata');
viewdiv.innerHTML='';
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  viewgrbtnadmin_country = Ext.get('gridViewadmin_country');	

	Ext.define('Admin_country', {
    extend: 'Ext.data.Model',
	fields:[]
	});
	var store = Ext.create('Ext.data.Store', {
    model: 'Admin_country',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php?t=admin_country',
        reader: {
            type: 'json'
        }
    }
});
  store.load();
    var grid = Ext.create('Ext.grid.Panel', {
						  
        store: store,
        stateful: true,
        collapsible: true,
        multiSelect: true,
        stateId: 'stateGrid',
		columns:[{
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
loadTableInfo('admin_country',rec.get(''),'Update','Admin');
                    }
                }]
            }
        ]
		
		,
		height: 350,
        width: 800,
        title: 'Country Report',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	
}//end of gridViewadmin_country function
