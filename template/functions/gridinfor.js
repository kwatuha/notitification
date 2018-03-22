function showgriddetails() {
Ext.QuickTips.init();
var closebtn= Ext.get('close-btn');
	var  buttonaltert = Ext.get('buttongalertgrid');	
var myalertData;
var tablename='admin_alert';
	Ext.define('AdminAlert', {
    extend: 'Ext.data.Model',
    fields:['alert_id','alert_name','is_active','alert_description','success_status','alert_date']
});
var store = Ext.create('Ext.data.Store', {
    model: 'AdminAlert',
    proxy: {
        type: 'ajax',
        url : 'http://localhost/formgen/home/buidgrid.php',
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
        stateId: 'stateGrid',//stblInfo
		columns:stblInfo ,
		height: 350,
        width: 600,
        title: 'Alert Datetails Data',
        renderTo: 'alertdata',
        viewConfig: {
            stripeRows: true,
            enableTextSelection: true
        }
    });
	 } 