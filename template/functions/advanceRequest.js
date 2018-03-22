function createTabbedRevised(pid){
alert(pid);
var obj=document.getElementById('detailinfo');
obj.innerHTML='';
   loadtype='Save';
   //**************************************************************************************
  


  //*************************************************************************************
   
   admin_contactdata='kwasdasd';
 
   

//place on pip
var adform=Ext.widget('form',{
width: 600,
height:400,
minWidth: 300,
bodyPadding:10,
minHeight: 200,
items:[{
            xtype: 'datefield',
			name: 'date_requested',
			margin: '0 5 5 0',
            fieldLabel: 'Date Requested ',
            allowBlank: false,
            minLength: 1
        
		},{xtype: 'fieldcontainer',
                fieldLabel:'Amount',
				combineErrors: true,
				msgTarget : 'side',
                layout: 'hbox',
				items:[{
            xtype: 'numberfield',
		   name: 'amount_Requested',
            fieldLabel:false,
			margin: '0 5 0 0',
            allowBlank: false,
            minLength: 1
        
		},{
            xtype: 'numberfield',
			margin: '0 5 0 0',
            name: 'proposed_repayment_period',
            fieldLabel: 'Repayment',
            allowBlank: false,
            minLength: 1
        
		}]},{
            xtype: 'hidden',
			 name: 'status',
            fieldLabel: 'Status ',
            value:'Requested',
			
            minLength: 1
        
		},
		{
            html:'<Reasons>'},
			{
			xtype: 'htmleditor',
			name: 'requester_comments',
			anchor: '100% -30',
            fieldLabel: false,
            allowBlank: false,
            minLength: 1
        
		}]


});
var win = Ext.create('Ext.window.Window', {
        title: 'Select Tenant Landlord',
        width: 600,
        height:400,
        minWidth: 300,
		bodyPadding:10,
        minHeight: 200,
        layout: 'fit',
		id:'frmadvancepayment',
        plain: true,
        items: [adform]
				 
      
});
 
 win.show();
 }
