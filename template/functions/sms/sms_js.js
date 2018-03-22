
function sendEmailBills(){
  Ext.Ajax.request({
  loadMask: true,
    url: 'sendbillemail.php?statusAction=sendit',
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  }
    });

}
function checkURL(url) {

    var urls = "http://localhost:5000/" ;
    var isAccessible = false;

    $.ajax({
        url: url,
        type: "get",
        cache: false,
        dataType: 'jsonp',
        crossDomain : true,
        asynchronous : false,
        jsonpCallback: 'deadCode',
        complete : function(xhr, responseText, thrownError) {
            if(xhr.status == "200") {
                isAccessible = true;
				
				alert('Accessible');
                //alert("Request complete, isAccessible==> " + isAccessible); // this alert does not come when port is blocked
            }
        }
    });
    return isAccessible;

}
function deadCode() {
    alert("Inside Deadcode"); // this does not execute in any cases
}

function checkInternetConnection(){
alert('staterd');
  if (navigator.onLine(connected)) {
       alert('There is connectivity');
  }
  else {
     alert('There is no connectivity');
  }
 }

function SendBatchSMSs(type){
Ext.Ajax.request({
  loadMask: true,
    url: 'sendSMS.php?statusAction=sendit&type='+type,
  params: {id: "1",type:type},
  success: function(resp) {
  eval(resp.responseText);
  }
    });
}
///
 function checkCreditBal(execCount){
//alert('sers');
Ext.Ajax.request({
  loadMask: true,
    url: 'checkcredit.php?statusAction='+execCount,
  params: {id: "1"},
  success: function(resp) {
  eval(resp.responseText);
  
  }
    });
}

function getSMSSystemStatus(){
Ext.Ajax.request({
  loadMask: true,
    url: 'updateSMSStatus.php?st=st',
  params: {id: "1"},
  success: function(resp) {
 
  createSMSMode(resp.responseText);
  }
    });
}


function createSMSMode(Sysstatus){
isceckedon=false;
isceckedoff=false;
if(Sysstatus=='ON'){
isceckedon=true;
}
if(Sysstatus=='OFF'){
isceckedoff=true;
}

var obj=document.getElementById('detailinfo');
obj.innerHTML='';
Ext.create('Ext.form.Panel', {
 title: 'SMS System Status',
 margin: '10 5 5 5',
        columnWidth: 0.6,
		frame: true,
 width: 550,
 bodyPadding: 10,

 shadow :true,
 bodyBorder: true,
 renderTo:'detailinfo',
 items:[
 {
 xtype: 'radiogroup',
 collapsible:true,
 bodyBorder: true,
 fieldLabel: 'System Status',
 columns: 2,
 vertical: true,
 items: [{ boxLabel: 'Turn On',
			  iconCls:'user-girl', id:'OnLine', name: 'current_mode', checked:isceckedon,  inputValue: 'ON',
			handler:function(){
			changeSMSSystemStatus('ON');
			}
			 					
		},{ boxLabel: 'Turn Off',
			  iconCls:'user-girl', id:'offline', name: 'current_mode', checked:isceckedoff,  inputValue: 'OFF',
			handler:function(){
			changeSMSSystemStatus('OFF');
			}
			 					
		}]}] 
 });
}

function changeSMSSystemStatus(statuss){
Ext.Ajax.request({
  loadMask: true,
    url: 'updateSMSStatus.php?cst='+statuss,
  params: {id: "1"},
  success: function(resp) {
  //eval(resp.responseText);
  }
    });
}
