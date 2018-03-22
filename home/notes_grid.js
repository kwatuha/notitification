        var conn = new Ext.data.Connection({  
              url: "/myurl.do",  
              method: "POST",  
              timeout:180000,  
              baseParams:{  
                  cust: "555",  
                  state: "TN",  
                  start: 0  
              }  
          });  
		  
	var myDataStore = new Ext.data.Store({  
        proxy: new Ext.data.HttpProxy(conn),  
        reader: new Ext.data.JsonReader({  
            root: 'myDataArray',  
            totalProperty: 'totalCount',  
            fields: [  
                {  
                    name: 'field1'  
                },  
                {  
                    name: 'field2'  
                }  
            ]  
        })  
    });  
	
	///////////////////////////////////
	
	/**
* Simple ajax request with callback and json to object deserialization
*/
 
simpleAjax = function () {
 
var received = function (response) {
x = Ext.decode( response.responseText );
//console.log(x);
console.log(this);
}
 
Ext.Ajax.request({
url: '/files/ux/RemoteComponent/implementation4/grid_generated.php',
success: received,
failure: function () { console.log('failure');},
headers: {
'my-header': 'foo'
},
params: { foo: 'bar' }
});
 
} // eo function
//////////////////////////////////



//////////////////////
Ext.Ajax.request({
  loadMask: true,
  url: 'myfile.php',
  params: {id: "1"},
  success: function(resp) {
    // resp is the XmlHttpRequest object
    var options = Ext.decode(resp.responseText).options;

    Ext.each(options, function(op) {
      alert(op.message);
    }
  }
});

//////////////////
Or you could do it in a more Ext-ish way using Store:

var messages = new Ext.data.JsonStore({
  url: 'myfile.php',
  root: 'options',
  fields: [
    {name: 'text', mapping: 'message'}
  ],
  listeners: {
    load: messagesLoaded
  }
});
messages.load({params: {id: "1"}});

// and when loaded, you can take advantage of
// all the possibilities provided by Store
function messagesLoaded(messages) {
  messages.each(function(msg){
    alert(msg.get("text"));
  });
}
////////////////////////////////Similar
**************************************************
Ext.define('User', {
    extend: 'Ext.data.Model',
    fields: ['id', 'name', 'email']
});

var store = Ext.create('Ext.data.Store', {
    model: 'User',
    proxy: {
        type: 'ajax',
        url : 'users.json',
        reader: {
            type: 'json'
        }
    }
});

/////////////////////////

[
    {
        "id": 1,
        "name": "Ed Spencer",
        "email": "ed@sencha.com"
    },
    {
        "id": 2,
        "name": "Abe Elias",
        "email": "abe@sencha.com"
    }
]
//////////////////////