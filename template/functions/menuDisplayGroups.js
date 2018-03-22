
function savemenudisplyOptionsaccount_account(){
var account_account1=document.getElementById('account_account1');
account_account1value="Hide";
if(account_account1.checked==true){
	account_account1value="Show";
	}
var account_account2=document.getElementById('account_account2');
var account_account3=document.getElementById('account_account3');
var account_account4=document.getElementById('account_account4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_account'+'&account_account1='+account_account1value
+'&account_account2='+account_account2.value
+'&account_account3='+account_account3.value
+'&account_account4='+account_account4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_accountclosure(){
var account_accountclosure1=document.getElementById('account_accountclosure1');
account_accountclosure1value="Hide";
if(account_accountclosure1.checked==true){
	account_accountclosure1value="Show";
	}
var account_accountclosure2=document.getElementById('account_accountclosure2');
var account_accountclosure3=document.getElementById('account_accountclosure3');
var account_accountclosure4=document.getElementById('account_accountclosure4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_accountclosure'+'&account_accountclosure1='+account_accountclosure1value
+'&account_accountclosure2='+account_accountclosure2.value
+'&account_accountclosure3='+account_accountclosure3.value
+'&account_accountclosure4='+account_accountclosure4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_accounttermination(){
var account_accounttermination1=document.getElementById('account_accounttermination1');
account_accounttermination1value="Hide";
if(account_accounttermination1.checked==true){
	account_accounttermination1value="Show";
	}
var account_accounttermination2=document.getElementById('account_accounttermination2');
var account_accounttermination3=document.getElementById('account_accounttermination3');
var account_accounttermination4=document.getElementById('account_accounttermination4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_accounttermination'+'&account_accounttermination1='+account_accounttermination1value
+'&account_accounttermination2='+account_accounttermination2.value
+'&account_accounttermination3='+account_accounttermination3.value
+'&account_accounttermination4='+account_accounttermination4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_accreation(){
var account_accreation1=document.getElementById('account_accreation1');
account_accreation1value="Hide";
if(account_accreation1.checked==true){
	account_accreation1value="Show";
	}
var account_accreation2=document.getElementById('account_accreation2');
var account_accreation3=document.getElementById('account_accreation3');
var account_accreation4=document.getElementById('account_accreation4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_accreation'+'&account_accreation1='+account_accreation1value
+'&account_accreation2='+account_accreation2.value
+'&account_accreation3='+account_accreation3.value
+'&account_accreation4='+account_accreation4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_acsetting(){
var account_acsetting1=document.getElementById('account_acsetting1');
account_acsetting1value="Hide";
if(account_acsetting1.checked==true){
	account_acsetting1value="Show";
	}
var account_acsetting2=document.getElementById('account_acsetting2');
var account_acsetting3=document.getElementById('account_acsetting3');
var account_acsetting4=document.getElementById('account_acsetting4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_acsetting'+'&account_acsetting1='+account_acsetting1value
+'&account_acsetting2='+account_acsetting2.value
+'&account_acsetting3='+account_acsetting3.value
+'&account_acsetting4='+account_acsetting4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_consumer(){
var account_consumer1=document.getElementById('account_consumer1');
account_consumer1value="Hide";
if(account_consumer1.checked==true){
	account_consumer1value="Show";
	}
var account_consumer2=document.getElementById('account_consumer2');
var account_consumer3=document.getElementById('account_consumer3');
var account_consumer4=document.getElementById('account_consumer4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_consumer'+'&account_consumer1='+account_consumer1value
+'&account_consumer2='+account_consumer2.value
+'&account_consumer3='+account_consumer3.value
+'&account_consumer4='+account_consumer4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_creditdebitrequest(){
var account_creditdebitrequest1=document.getElementById('account_creditdebitrequest1');
account_creditdebitrequest1value="Hide";
if(account_creditdebitrequest1.checked==true){
	account_creditdebitrequest1value="Show";
	}
var account_creditdebitrequest2=document.getElementById('account_creditdebitrequest2');
var account_creditdebitrequest3=document.getElementById('account_creditdebitrequest3');
var account_creditdebitrequest4=document.getElementById('account_creditdebitrequest4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_creditdebitrequest'+'&account_creditdebitrequest1='+account_creditdebitrequest1value
+'&account_creditdebitrequest2='+account_creditdebitrequest2.value
+'&account_creditdebitrequest3='+account_creditdebitrequest3.value
+'&account_creditdebitrequest4='+account_creditdebitrequest4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_customerdeactivate(){
var account_customerdeactivate1=document.getElementById('account_customerdeactivate1');
account_customerdeactivate1value="Hide";
if(account_customerdeactivate1.checked==true){
	account_customerdeactivate1value="Show";
	}
var account_customerdeactivate2=document.getElementById('account_customerdeactivate2');
var account_customerdeactivate3=document.getElementById('account_customerdeactivate3');
var account_customerdeactivate4=document.getElementById('account_customerdeactivate4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_customerdeactivate'+'&account_customerdeactivate1='+account_customerdeactivate1value
+'&account_customerdeactivate2='+account_customerdeactivate2.value
+'&account_customerdeactivate3='+account_customerdeactivate3.value
+'&account_customerdeactivate4='+account_customerdeactivate4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_groupmaster(){
var account_groupmaster1=document.getElementById('account_groupmaster1');
account_groupmaster1value="Hide";
if(account_groupmaster1.checked==true){
	account_groupmaster1value="Show";
	}
var account_groupmaster2=document.getElementById('account_groupmaster2');
var account_groupmaster3=document.getElementById('account_groupmaster3');
var account_groupmaster4=document.getElementById('account_groupmaster4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_groupmaster'+'&account_groupmaster1='+account_groupmaster1value
+'&account_groupmaster2='+account_groupmaster2.value
+'&account_groupmaster3='+account_groupmaster3.value
+'&account_groupmaster4='+account_groupmaster4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_invoice(){
var account_invoice1=document.getElementById('account_invoice1');
account_invoice1value="Hide";
if(account_invoice1.checked==true){
	account_invoice1value="Show";
	}
var account_invoice2=document.getElementById('account_invoice2');
var account_invoice3=document.getElementById('account_invoice3');
var account_invoice4=document.getElementById('account_invoice4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_invoice'+'&account_invoice1='+account_invoice1value
+'&account_invoice2='+account_invoice2.value
+'&account_invoice3='+account_invoice3.value
+'&account_invoice4='+account_invoice4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_invoiceitems(){
var account_invoiceitems1=document.getElementById('account_invoiceitems1');
account_invoiceitems1value="Hide";
if(account_invoiceitems1.checked==true){
	account_invoiceitems1value="Show";
	}
var account_invoiceitems2=document.getElementById('account_invoiceitems2');
var account_invoiceitems3=document.getElementById('account_invoiceitems3');
var account_invoiceitems4=document.getElementById('account_invoiceitems4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_invoiceitems'+'&account_invoiceitems1='+account_invoiceitems1value
+'&account_invoiceitems2='+account_invoiceitems2.value
+'&account_invoiceitems3='+account_invoiceitems3.value
+'&account_invoiceitems4='+account_invoiceitems4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsaccount_transactionlog(){
var account_transactionlog1=document.getElementById('account_transactionlog1');
account_transactionlog1value="Hide";
if(account_transactionlog1.checked==true){
	account_transactionlog1value="Show";
	}
var account_transactionlog2=document.getElementById('account_transactionlog2');
var account_transactionlog3=document.getElementById('account_transactionlog3');
var account_transactionlog4=document.getElementById('account_transactionlog4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'account_transactionlog'+'&account_transactionlog1='+account_transactionlog1value
+'&account_transactionlog2='+account_transactionlog2.value
+'&account_transactionlog3='+account_transactionlog3.value
+'&account_transactionlog4='+account_transactionlog4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_adminuser(){
var admin_adminuser1=document.getElementById('admin_adminuser1');
admin_adminuser1value="Hide";
if(admin_adminuser1.checked==true){
	admin_adminuser1value="Show";
	}
var admin_adminuser2=document.getElementById('admin_adminuser2');
var admin_adminuser3=document.getElementById('admin_adminuser3');
var admin_adminuser4=document.getElementById('admin_adminuser4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_adminuser'+'&admin_adminuser1='+admin_adminuser1value
+'&admin_adminuser2='+admin_adminuser2.value
+'&admin_adminuser3='+admin_adminuser3.value
+'&admin_adminuser4='+admin_adminuser4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_aggrigate(){
var admin_aggrigate1=document.getElementById('admin_aggrigate1');
admin_aggrigate1value="Hide";
if(admin_aggrigate1.checked==true){
	admin_aggrigate1value="Show";
	}
var admin_aggrigate2=document.getElementById('admin_aggrigate2');
var admin_aggrigate3=document.getElementById('admin_aggrigate3');
var admin_aggrigate4=document.getElementById('admin_aggrigate4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_aggrigate'+'&admin_aggrigate1='+admin_aggrigate1value
+'&admin_aggrigate2='+admin_aggrigate2.value
+'&admin_aggrigate3='+admin_aggrigate3.value
+'&admin_aggrigate4='+admin_aggrigate4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_alert(){
var admin_alert1=document.getElementById('admin_alert1');
admin_alert1value="Hide";
if(admin_alert1.checked==true){
	admin_alert1value="Show";
	}
var admin_alert2=document.getElementById('admin_alert2');
var admin_alert3=document.getElementById('admin_alert3');
var admin_alert4=document.getElementById('admin_alert4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_alert'+'&admin_alert1='+admin_alert1value
+'&admin_alert2='+admin_alert2.value
+'&admin_alert3='+admin_alert3.value
+'&admin_alert4='+admin_alert4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_autofill(){
var admin_autofill1=document.getElementById('admin_autofill1');
admin_autofill1value="Hide";
if(admin_autofill1.checked==true){
	admin_autofill1value="Show";
	}
var admin_autofill2=document.getElementById('admin_autofill2');
var admin_autofill3=document.getElementById('admin_autofill3');
var admin_autofill4=document.getElementById('admin_autofill4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_autofill'+'&admin_autofill1='+admin_autofill1value
+'&admin_autofill2='+admin_autofill2.value
+'&admin_autofill3='+admin_autofill3.value
+'&admin_autofill4='+admin_autofill4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_benefitdescr(){
var admin_benefitdescr1=document.getElementById('admin_benefitdescr1');
admin_benefitdescr1value="Hide";
if(admin_benefitdescr1.checked==true){
	admin_benefitdescr1value="Show";
	}
var admin_benefitdescr2=document.getElementById('admin_benefitdescr2');
var admin_benefitdescr3=document.getElementById('admin_benefitdescr3');
var admin_benefitdescr4=document.getElementById('admin_benefitdescr4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_benefitdescr'+'&admin_benefitdescr1='+admin_benefitdescr1value
+'&admin_benefitdescr2='+admin_benefitdescr2.value
+'&admin_benefitdescr3='+admin_benefitdescr3.value
+'&admin_benefitdescr4='+admin_benefitdescr4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_cmpbenefits(){
var admin_cmpbenefits1=document.getElementById('admin_cmpbenefits1');
admin_cmpbenefits1value="Hide";
if(admin_cmpbenefits1.checked==true){
	admin_cmpbenefits1value="Show";
	}
var admin_cmpbenefits2=document.getElementById('admin_cmpbenefits2');
var admin_cmpbenefits3=document.getElementById('admin_cmpbenefits3');
var admin_cmpbenefits4=document.getElementById('admin_cmpbenefits4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_cmpbenefits'+'&admin_cmpbenefits1='+admin_cmpbenefits1value
+'&admin_cmpbenefits2='+admin_cmpbenefits2.value
+'&admin_cmpbenefits3='+admin_cmpbenefits3.value
+'&admin_cmpbenefits4='+admin_cmpbenefits4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_company(){
var admin_company1=document.getElementById('admin_company1');
admin_company1value="Hide";
if(admin_company1.checked==true){
	admin_company1value="Show";
	}
var admin_company2=document.getElementById('admin_company2');
var admin_company3=document.getElementById('admin_company3');
var admin_company4=document.getElementById('admin_company4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_company'+'&admin_company1='+admin_company1value
+'&admin_company2='+admin_company2.value
+'&admin_company3='+admin_company3.value
+'&admin_company4='+admin_company4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_compstructtree(){
var admin_compstructtree1=document.getElementById('admin_compstructtree1');
admin_compstructtree1value="Hide";
if(admin_compstructtree1.checked==true){
	admin_compstructtree1value="Show";
	}
var admin_compstructtree2=document.getElementById('admin_compstructtree2');
var admin_compstructtree3=document.getElementById('admin_compstructtree3');
var admin_compstructtree4=document.getElementById('admin_compstructtree4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_compstructtree'+'&admin_compstructtree1='+admin_compstructtree1value
+'&admin_compstructtree2='+admin_compstructtree2.value
+'&admin_compstructtree3='+admin_compstructtree3.value
+'&admin_compstructtree4='+admin_compstructtree4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_controller(){
var admin_controller1=document.getElementById('admin_controller1');
admin_controller1value="Hide";
if(admin_controller1.checked==true){
	admin_controller1value="Show";
	}
var admin_controller2=document.getElementById('admin_controller2');
var admin_controller3=document.getElementById('admin_controller3');
var admin_controller4=document.getElementById('admin_controller4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_controller'+'&admin_controller1='+admin_controller1value
+'&admin_controller2='+admin_controller2.value
+'&admin_controller3='+admin_controller3.value
+'&admin_controller4='+admin_controller4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_custom(){
var admin_custom1=document.getElementById('admin_custom1');
admin_custom1value="Hide";
if(admin_custom1.checked==true){
	admin_custom1value="Show";
	}
var admin_custom2=document.getElementById('admin_custom2');
var admin_custom3=document.getElementById('admin_custom3');
var admin_custom4=document.getElementById('admin_custom4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_custom'+'&admin_custom1='+admin_custom1value
+'&admin_custom2='+admin_custom2.value
+'&admin_custom3='+admin_custom3.value
+'&admin_custom4='+admin_custom4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_customer(){
var admin_customer1=document.getElementById('admin_customer1');
admin_customer1value="Hide";
if(admin_customer1.checked==true){
	admin_customer1value="Show";
	}
var admin_customer2=document.getElementById('admin_customer2');
var admin_customer3=document.getElementById('admin_customer3');
var admin_customer4=document.getElementById('admin_customer4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_customer'+'&admin_customer1='+admin_customer1value
+'&admin_customer2='+admin_customer2.value
+'&admin_customer3='+admin_customer3.value
+'&admin_customer4='+admin_customer4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_customimport(){
var admin_customimport1=document.getElementById('admin_customimport1');
admin_customimport1value="Hide";
if(admin_customimport1.checked==true){
	admin_customimport1value="Show";
	}
var admin_customimport2=document.getElementById('admin_customimport2');
var admin_customimport3=document.getElementById('admin_customimport3');
var admin_customimport4=document.getElementById('admin_customimport4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_customimport'+'&admin_customimport1='+admin_customimport1value
+'&admin_customimport2='+admin_customimport2.value
+'&admin_customimport3='+admin_customimport3.value
+'&admin_customimport4='+admin_customimport4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_dept(){
var admin_dept1=document.getElementById('admin_dept1');
admin_dept1value="Hide";
if(admin_dept1.checked==true){
	admin_dept1value="Show";
	}
var admin_dept2=document.getElementById('admin_dept2');
var admin_dept3=document.getElementById('admin_dept3');
var admin_dept4=document.getElementById('admin_dept4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_dept'+'&admin_dept1='+admin_dept1value
+'&admin_dept2='+admin_dept2.value
+'&admin_dept3='+admin_dept3.value
+'&admin_dept4='+admin_dept4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_docs(){
var admin_docs1=document.getElementById('admin_docs1');
admin_docs1value="Hide";
if(admin_docs1.checked==true){
	admin_docs1value="Show";
	}
var admin_docs2=document.getElementById('admin_docs2');
var admin_docs3=document.getElementById('admin_docs3');
var admin_docs4=document.getElementById('admin_docs4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_docs'+'&admin_docs1='+admin_docs1value
+'&admin_docs2='+admin_docs2.value
+'&admin_docs3='+admin_docs3.value
+'&admin_docs4='+admin_docs4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_empdepartment(){
var admin_empdepartment1=document.getElementById('admin_empdepartment1');
admin_empdepartment1value="Hide";
if(admin_empdepartment1.checked==true){
	admin_empdepartment1value="Show";
	}
var admin_empdepartment2=document.getElementById('admin_empdepartment2');
var admin_empdepartment3=document.getElementById('admin_empdepartment3');
var admin_empdepartment4=document.getElementById('admin_empdepartment4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_empdepartment'+'&admin_empdepartment1='+admin_empdepartment1value
+'&admin_empdepartment2='+admin_empdepartment2.value
+'&admin_empdepartment3='+admin_empdepartment3.value
+'&admin_empdepartment4='+admin_empdepartment4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_emppayment(){
var admin_emppayment1=document.getElementById('admin_emppayment1');
admin_emppayment1value="Hide";
if(admin_emppayment1.checked==true){
	admin_emppayment1value="Show";
	}
var admin_emppayment2=document.getElementById('admin_emppayment2');
var admin_emppayment3=document.getElementById('admin_emppayment3');
var admin_emppayment4=document.getElementById('admin_emppayment4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_emppayment'+'&admin_emppayment1='+admin_emppayment1value
+'&admin_emppayment2='+admin_emppayment2.value
+'&admin_emppayment3='+admin_emppayment3.value
+'&admin_emppayment4='+admin_emppayment4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_emppropertyissued(){
var admin_emppropertyissued1=document.getElementById('admin_emppropertyissued1');
admin_emppropertyissued1value="Hide";
if(admin_emppropertyissued1.checked==true){
	admin_emppropertyissued1value="Show";
	}
var admin_emppropertyissued2=document.getElementById('admin_emppropertyissued2');
var admin_emppropertyissued3=document.getElementById('admin_emppropertyissued3');
var admin_emppropertyissued4=document.getElementById('admin_emppropertyissued4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_emppropertyissued'+'&admin_emppropertyissued1='+admin_emppropertyissued1value
+'&admin_emppropertyissued2='+admin_emppropertyissued2.value
+'&admin_emppropertyissued3='+admin_emppropertyissued3.value
+'&admin_emppropertyissued4='+admin_emppropertyissued4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_empreport(){
var admin_empreport1=document.getElementById('admin_empreport1');
admin_empreport1value="Hide";
if(admin_empreport1.checked==true){
	admin_empreport1value="Show";
	}
var admin_empreport2=document.getElementById('admin_empreport2');
var admin_empreport3=document.getElementById('admin_empreport3');
var admin_empreport4=document.getElementById('admin_empreport4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_empreport'+'&admin_empreport1='+admin_empreport1value
+'&admin_empreport2='+admin_empreport2.value
+'&admin_empreport3='+admin_empreport3.value
+'&admin_empreport4='+admin_empreport4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_groupnotification(){
var admin_groupnotification1=document.getElementById('admin_groupnotification1');
admin_groupnotification1value="Hide";
if(admin_groupnotification1.checked==true){
	admin_groupnotification1value="Show";
	}
var admin_groupnotification2=document.getElementById('admin_groupnotification2');
var admin_groupnotification3=document.getElementById('admin_groupnotification3');
var admin_groupnotification4=document.getElementById('admin_groupnotification4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_groupnotification'+'&admin_groupnotification1='+admin_groupnotification1value
+'&admin_groupnotification2='+admin_groupnotification2.value
+'&admin_groupnotification3='+admin_groupnotification3.value
+'&admin_groupnotification4='+admin_groupnotification4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_groupnotificationhist(){
var admin_groupnotificationhist1=document.getElementById('admin_groupnotificationhist1');
admin_groupnotificationhist1value="Hide";
if(admin_groupnotificationhist1.checked==true){
	admin_groupnotificationhist1value="Show";
	}
var admin_groupnotificationhist2=document.getElementById('admin_groupnotificationhist2');
var admin_groupnotificationhist3=document.getElementById('admin_groupnotificationhist3');
var admin_groupnotificationhist4=document.getElementById('admin_groupnotificationhist4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_groupnotificationhist'+'&admin_groupnotificationhist1='+admin_groupnotificationhist1value
+'&admin_groupnotificationhist2='+admin_groupnotificationhist2.value
+'&admin_groupnotificationhist3='+admin_groupnotificationhist3.value
+'&admin_groupnotificationhist4='+admin_groupnotificationhist4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_ntg(){
var admin_ntg1=document.getElementById('admin_ntg1');
admin_ntg1value="Hide";
if(admin_ntg1.checked==true){
	admin_ntg1value="Show";
	}
var admin_ntg2=document.getElementById('admin_ntg2');
var admin_ntg3=document.getElementById('admin_ntg3');
var admin_ntg4=document.getElementById('admin_ntg4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_ntg'+'&admin_ntg1='+admin_ntg1value
+'&admin_ntg2='+admin_ntg2.value
+'&admin_ntg3='+admin_ntg3.value
+'&admin_ntg4='+admin_ntg4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_orgdepartment(){
var admin_orgdepartment1=document.getElementById('admin_orgdepartment1');
admin_orgdepartment1value="Hide";
if(admin_orgdepartment1.checked==true){
	admin_orgdepartment1value="Show";
	}
var admin_orgdepartment2=document.getElementById('admin_orgdepartment2');
var admin_orgdepartment3=document.getElementById('admin_orgdepartment3');
var admin_orgdepartment4=document.getElementById('admin_orgdepartment4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_orgdepartment'+'&admin_orgdepartment1='+admin_orgdepartment1value
+'&admin_orgdepartment2='+admin_orgdepartment2.value
+'&admin_orgdepartment3='+admin_orgdepartment3.value
+'&admin_orgdepartment4='+admin_orgdepartment4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_orgpaygradedecr(){
var admin_orgpaygradedecr1=document.getElementById('admin_orgpaygradedecr1');
admin_orgpaygradedecr1value="Hide";
if(admin_orgpaygradedecr1.checked==true){
	admin_orgpaygradedecr1value="Show";
	}
var admin_orgpaygradedecr2=document.getElementById('admin_orgpaygradedecr2');
var admin_orgpaygradedecr3=document.getElementById('admin_orgpaygradedecr3');
var admin_orgpaygradedecr4=document.getElementById('admin_orgpaygradedecr4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_orgpaygradedecr'+'&admin_orgpaygradedecr1='+admin_orgpaygradedecr1value
+'&admin_orgpaygradedecr2='+admin_orgpaygradedecr2.value
+'&admin_orgpaygradedecr3='+admin_orgpaygradedecr3.value
+'&admin_orgpaygradedecr4='+admin_orgpaygradedecr4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_passwordreset(){
var admin_passwordreset1=document.getElementById('admin_passwordreset1');
admin_passwordreset1value="Hide";
if(admin_passwordreset1.checked==true){
	admin_passwordreset1value="Show";
	}
var admin_passwordreset2=document.getElementById('admin_passwordreset2');
var admin_passwordreset3=document.getElementById('admin_passwordreset3');
var admin_passwordreset4=document.getElementById('admin_passwordreset4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_passwordreset'+'&admin_passwordreset1='+admin_passwordreset1value
+'&admin_passwordreset2='+admin_passwordreset2.value
+'&admin_passwordreset3='+admin_passwordreset3.value
+'&admin_passwordreset4='+admin_passwordreset4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_passwordresethist(){
var admin_passwordresethist1=document.getElementById('admin_passwordresethist1');
admin_passwordresethist1value="Hide";
if(admin_passwordresethist1.checked==true){
	admin_passwordresethist1value="Show";
	}
var admin_passwordresethist2=document.getElementById('admin_passwordresethist2');
var admin_passwordresethist3=document.getElementById('admin_passwordresethist3');
var admin_passwordresethist4=document.getElementById('admin_passwordresethist4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_passwordresethist'+'&admin_passwordresethist1='+admin_passwordresethist1value
+'&admin_passwordresethist2='+admin_passwordresethist2.value
+'&admin_passwordresethist3='+admin_passwordresethist3.value
+'&admin_passwordresethist4='+admin_passwordresethist4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_person(){
var admin_person1=document.getElementById('admin_person1');
admin_person1value="Hide";
if(admin_person1.checked==true){
	admin_person1value="Show";
	}
var admin_person2=document.getElementById('admin_person2');
var admin_person3=document.getElementById('admin_person3');
var admin_person4=document.getElementById('admin_person4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_person'+'&admin_person1='+admin_person1value
+'&admin_person2='+admin_person2.value
+'&admin_person3='+admin_person3.value
+'&admin_person4='+admin_person4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_rights(){
var admin_rights1=document.getElementById('admin_rights1');
admin_rights1value="Hide";
if(admin_rights1.checked==true){
	admin_rights1value="Show";
	}
var admin_rights2=document.getElementById('admin_rights2');
var admin_rights3=document.getElementById('admin_rights3');
var admin_rights4=document.getElementById('admin_rights4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_rights'+'&admin_rights1='+admin_rights1value
+'&admin_rights2='+admin_rights2.value
+'&admin_rights3='+admin_rights3.value
+'&admin_rights4='+admin_rights4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_role(){
var admin_role1=document.getElementById('admin_role1');
admin_role1value="Hide";
if(admin_role1.checked==true){
	admin_role1value="Show";
	}
var admin_role2=document.getElementById('admin_role2');
var admin_role3=document.getElementById('admin_role3');
var admin_role4=document.getElementById('admin_role4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_role'+'&admin_role1='+admin_role1value
+'&admin_role2='+admin_role2.value
+'&admin_role3='+admin_role3.value
+'&admin_role4='+admin_role4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_schart(){
var admin_schart1=document.getElementById('admin_schart1');
admin_schart1value="Hide";
if(admin_schart1.checked==true){
	admin_schart1value="Show";
	}
var admin_schart2=document.getElementById('admin_schart2');
var admin_schart3=document.getElementById('admin_schart3');
var admin_schart4=document.getElementById('admin_schart4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_schart'+'&admin_schart1='+admin_schart1value
+'&admin_schart2='+admin_schart2.value
+'&admin_schart3='+admin_schart3.value
+'&admin_schart4='+admin_schart4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_scnotification(){
var admin_scnotification1=document.getElementById('admin_scnotification1');
admin_scnotification1value="Hide";
if(admin_scnotification1.checked==true){
	admin_scnotification1value="Show";
	}
var admin_scnotification2=document.getElementById('admin_scnotification2');
var admin_scnotification3=document.getElementById('admin_scnotification3');
var admin_scnotification4=document.getElementById('admin_scnotification4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_scnotification'+'&admin_scnotification1='+admin_scnotification1value
+'&admin_scnotification2='+admin_scnotification2.value
+'&admin_scnotification3='+admin_scnotification3.value
+'&admin_scnotification4='+admin_scnotification4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_statement(){
var admin_statement1=document.getElementById('admin_statement1');
admin_statement1value="Hide";
if(admin_statement1.checked==true){
	admin_statement1value="Show";
	}
var admin_statement2=document.getElementById('admin_statement2');
var admin_statement3=document.getElementById('admin_statement3');
var admin_statement4=document.getElementById('admin_statement4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_statement'+'&admin_statement1='+admin_statement1value
+'&admin_statement2='+admin_statement2.value
+'&admin_statement3='+admin_statement3.value
+'&admin_statement4='+admin_statement4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_status(){
var admin_status1=document.getElementById('admin_status1');
admin_status1value="Hide";
if(admin_status1.checked==true){
	admin_status1value="Show";
	}
var admin_status2=document.getElementById('admin_status2');
var admin_status3=document.getElementById('admin_status3');
var admin_status4=document.getElementById('admin_status4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_status'+'&admin_status1='+admin_status1value
+'&admin_status2='+admin_status2.value
+'&admin_status3='+admin_status3.value
+'&admin_status4='+admin_status4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_statustype(){
var admin_statustype1=document.getElementById('admin_statustype1');
admin_statustype1value="Hide";
if(admin_statustype1.checked==true){
	admin_statustype1value="Show";
	}
var admin_statustype2=document.getElementById('admin_statustype2');
var admin_statustype3=document.getElementById('admin_statustype3');
var admin_statustype4=document.getElementById('admin_statustype4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_statustype'+'&admin_statustype1='+admin_statustype1value
+'&admin_statustype2='+admin_statustype2.value
+'&admin_statustype3='+admin_statustype3.value
+'&admin_statustype4='+admin_statustype4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_supervisor(){
var admin_supervisor1=document.getElementById('admin_supervisor1');
admin_supervisor1value="Hide";
if(admin_supervisor1.checked==true){
	admin_supervisor1value="Show";
	}
var admin_supervisor2=document.getElementById('admin_supervisor2');
var admin_supervisor3=document.getElementById('admin_supervisor3');
var admin_supervisor4=document.getElementById('admin_supervisor4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_supervisor'+'&admin_supervisor1='+admin_supervisor1value
+'&admin_supervisor2='+admin_supervisor2.value
+'&admin_supervisor3='+admin_supervisor3.value
+'&admin_supervisor4='+admin_supervisor4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_table(){
var admin_table1=document.getElementById('admin_table1');
admin_table1value="Hide";
if(admin_table1.checked==true){
	admin_table1value="Show";
	}
var admin_table2=document.getElementById('admin_table2');
var admin_table3=document.getElementById('admin_table3');
var admin_table4=document.getElementById('admin_table4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_table'+'&admin_table1='+admin_table1value
+'&admin_table2='+admin_table2.value
+'&admin_table3='+admin_table3.value
+'&admin_table4='+admin_table4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_tablerole(){
var admin_tablerole1=document.getElementById('admin_tablerole1');
admin_tablerole1value="Hide";
if(admin_tablerole1.checked==true){
	admin_tablerole1value="Show";
	}
var admin_tablerole2=document.getElementById('admin_tablerole2');
var admin_tablerole3=document.getElementById('admin_tablerole3');
var admin_tablerole4=document.getElementById('admin_tablerole4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_tablerole'+'&admin_tablerole1='+admin_tablerole1value
+'&admin_tablerole2='+admin_tablerole2.value
+'&admin_tablerole3='+admin_tablerole3.value
+'&admin_tablerole4='+admin_tablerole4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_user(){
var admin_user1=document.getElementById('admin_user1');
admin_user1value="Hide";
if(admin_user1.checked==true){
	admin_user1value="Show";
	}
var admin_user2=document.getElementById('admin_user2');
var admin_user3=document.getElementById('admin_user3');
var admin_user4=document.getElementById('admin_user4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_user'+'&admin_user1='+admin_user1value
+'&admin_user2='+admin_user2.value
+'&admin_user3='+admin_user3.value
+'&admin_user4='+admin_user4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_useremp(){
var admin_useremp1=document.getElementById('admin_useremp1');
admin_useremp1value="Hide";
if(admin_useremp1.checked==true){
	admin_useremp1value="Show";
	}
var admin_useremp2=document.getElementById('admin_useremp2');
var admin_useremp3=document.getElementById('admin_useremp3');
var admin_useremp4=document.getElementById('admin_useremp4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_useremp'+'&admin_useremp1='+admin_useremp1value
+'&admin_useremp2='+admin_useremp2.value
+'&admin_useremp3='+admin_useremp3.value
+'&admin_useremp4='+admin_useremp4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_usergroup(){
var admin_usergroup1=document.getElementById('admin_usergroup1');
admin_usergroup1value="Hide";
if(admin_usergroup1.checked==true){
	admin_usergroup1value="Show";
	}
var admin_usergroup2=document.getElementById('admin_usergroup2');
var admin_usergroup3=document.getElementById('admin_usergroup3');
var admin_usergroup4=document.getElementById('admin_usergroup4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_usergroup'+'&admin_usergroup1='+admin_usergroup1value
+'&admin_usergroup2='+admin_usergroup2.value
+'&admin_usergroup3='+admin_usergroup3.value
+'&admin_usergroup4='+admin_usergroup4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsadmin_usergrouprole(){
var admin_usergrouprole1=document.getElementById('admin_usergrouprole1');
admin_usergrouprole1value="Hide";
if(admin_usergrouprole1.checked==true){
	admin_usergrouprole1value="Show";
	}
var admin_usergrouprole2=document.getElementById('admin_usergrouprole2');
var admin_usergrouprole3=document.getElementById('admin_usergrouprole3');
var admin_usergrouprole4=document.getElementById('admin_usergrouprole4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'admin_usergrouprole'+'&admin_usergrouprole1='+admin_usergrouprole1value
+'&admin_usergrouprole2='+admin_usergrouprole2.value
+'&admin_usergrouprole3='+admin_usergrouprole3.value
+'&admin_usergrouprole4='+admin_usergrouprole4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsbank_insuranceaccount(){
var bank_insuranceaccount1=document.getElementById('bank_insuranceaccount1');
bank_insuranceaccount1value="Hide";
if(bank_insuranceaccount1.checked==true){
	bank_insuranceaccount1value="Show";
	}
var bank_insuranceaccount2=document.getElementById('bank_insuranceaccount2');
var bank_insuranceaccount3=document.getElementById('bank_insuranceaccount3');
var bank_insuranceaccount4=document.getElementById('bank_insuranceaccount4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'bank_insuranceaccount'+'&bank_insuranceaccount1='+bank_insuranceaccount1value
+'&bank_insuranceaccount2='+bank_insuranceaccount2.value
+'&bank_insuranceaccount3='+bank_insuranceaccount3.value
+'&bank_insuranceaccount4='+bank_insuranceaccount4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionscommission_companyinscommission(){
var commission_companyinscommission1=document.getElementById('commission_companyinscommission1');
commission_companyinscommission1value="Hide";
if(commission_companyinscommission1.checked==true){
	commission_companyinscommission1value="Show";
	}
var commission_companyinscommission2=document.getElementById('commission_companyinscommission2');
var commission_companyinscommission3=document.getElementById('commission_companyinscommission3');
var commission_companyinscommission4=document.getElementById('commission_companyinscommission4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'commission_companyinscommission'+'&commission_companyinscommission1='+commission_companyinscommission1value
+'&commission_companyinscommission2='+commission_companyinscommission2.value
+'&commission_companyinscommission3='+commission_companyinscommission3.value
+'&commission_companyinscommission4='+commission_companyinscommission4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionscommission_insuranceagentcommission(){
var commission_insuranceagentcommission1=document.getElementById('commission_insuranceagentcommission1');
commission_insuranceagentcommission1value="Hide";
if(commission_insuranceagentcommission1.checked==true){
	commission_insuranceagentcommission1value="Show";
	}
var commission_insuranceagentcommission2=document.getElementById('commission_insuranceagentcommission2');
var commission_insuranceagentcommission3=document.getElementById('commission_insuranceagentcommission3');
var commission_insuranceagentcommission4=document.getElementById('commission_insuranceagentcommission4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'commission_insuranceagentcommission'+'&commission_insuranceagentcommission1='+commission_insuranceagentcommission1value
+'&commission_insuranceagentcommission2='+commission_insuranceagentcommission2.value
+'&commission_insuranceagentcommission3='+commission_insuranceagentcommission3.value
+'&commission_insuranceagentcommission4='+commission_insuranceagentcommission4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionscompany_agent(){
var company_agent1=document.getElementById('company_agent1');
company_agent1value="Hide";
if(company_agent1.checked==true){
	company_agent1value="Show";
	}
var company_agent2=document.getElementById('company_agent2');
var company_agent3=document.getElementById('company_agent3');
var company_agent4=document.getElementById('company_agent4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'company_agent'+'&company_agent1='+company_agent1value
+'&company_agent2='+company_agent2.value
+'&company_agent3='+company_agent3.value
+'&company_agent4='+company_agent4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionscompany_employee(){
var company_employee1=document.getElementById('company_employee1');
company_employee1value="Hide";
if(company_employee1.checked==true){
	company_employee1value="Show";
	}
var company_employee2=document.getElementById('company_employee2');
var company_employee3=document.getElementById('company_employee3');
var company_employee4=document.getElementById('company_employee4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'company_employee'+'&company_employee1='+company_employee1value
+'&company_employee2='+company_employee2.value
+'&company_employee3='+company_employee3.value
+'&company_employee4='+company_employee4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsdesigner_charttype(){
var designer_charttype1=document.getElementById('designer_charttype1');
designer_charttype1value="Hide";
if(designer_charttype1.checked==true){
	designer_charttype1value="Show";
	}
var designer_charttype2=document.getElementById('designer_charttype2');
var designer_charttype3=document.getElementById('designer_charttype3');
var designer_charttype4=document.getElementById('designer_charttype4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'designer_charttype'+'&designer_charttype1='+designer_charttype1value
+'&designer_charttype2='+designer_charttype2.value
+'&designer_charttype3='+designer_charttype3.value
+'&designer_charttype4='+designer_charttype4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsdesigner_sform(){
var designer_sform1=document.getElementById('designer_sform1');
designer_sform1value="Hide";
if(designer_sform1.checked==true){
	designer_sform1value="Show";
	}
var designer_sform2=document.getElementById('designer_sform2');
var designer_sform3=document.getElementById('designer_sform3');
var designer_sform4=document.getElementById('designer_sform4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'designer_sform'+'&designer_sform1='+designer_sform1value
+'&designer_sform2='+designer_sform2.value
+'&designer_sform3='+designer_sform3.value
+'&designer_sform4='+designer_sform4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsdesigner_sview(){
var designer_sview1=document.getElementById('designer_sview1');
designer_sview1value="Hide";
if(designer_sview1.checked==true){
	designer_sview1value="Show";
	}
var designer_sview2=document.getElementById('designer_sview2');
var designer_sview3=document.getElementById('designer_sview3');
var designer_sview4=document.getElementById('designer_sview4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'designer_sview'+'&designer_sview1='+designer_sview1value
+'&designer_sview2='+designer_sview2.value
+'&designer_sview3='+designer_sview3.value
+'&designer_sview4='+designer_sview4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsdesigner_tabmngr(){
var designer_tabmngr1=document.getElementById('designer_tabmngr1');
designer_tabmngr1value="Hide";
if(designer_tabmngr1.checked==true){
	designer_tabmngr1value="Show";
	}
var designer_tabmngr2=document.getElementById('designer_tabmngr2');
var designer_tabmngr3=document.getElementById('designer_tabmngr3');
var designer_tabmngr4=document.getElementById('designer_tabmngr4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'designer_tabmngr'+'&designer_tabmngr1='+designer_tabmngr1value
+'&designer_tabmngr2='+designer_tabmngr2.value
+'&designer_tabmngr3='+designer_tabmngr3.value
+'&designer_tabmngr4='+designer_tabmngr4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsdesigner_viewicon(){
var designer_viewicon1=document.getElementById('designer_viewicon1');
designer_viewicon1value="Hide";
if(designer_viewicon1.checked==true){
	designer_viewicon1value="Show";
	}
var designer_viewicon2=document.getElementById('designer_viewicon2');
var designer_viewicon3=document.getElementById('designer_viewicon3');
var designer_viewicon4=document.getElementById('designer_viewicon4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'designer_viewicon'+'&designer_viewicon1='+designer_viewicon1value
+'&designer_viewicon2='+designer_viewicon2.value
+'&designer_viewicon3='+designer_viewicon3.value
+'&designer_viewicon4='+designer_viewicon4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsdesigner_viewmode(){
var designer_viewmode1=document.getElementById('designer_viewmode1');
designer_viewmode1value="Hide";
if(designer_viewmode1.checked==true){
	designer_viewmode1value="Show";
	}
var designer_viewmode2=document.getElementById('designer_viewmode2');
var designer_viewmode3=document.getElementById('designer_viewmode3');
var designer_viewmode4=document.getElementById('designer_viewmode4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'designer_viewmode'+'&designer_viewmode1='+designer_viewmode1value
+'&designer_viewmode2='+designer_viewmode2.value
+'&designer_viewmode3='+designer_viewmode3.value
+'&designer_viewmode4='+designer_viewmode4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsevents_event(){
var events_event1=document.getElementById('events_event1');
events_event1value="Hide";
if(events_event1.checked==true){
	events_event1value="Show";
	}
var events_event2=document.getElementById('events_event2');
var events_event3=document.getElementById('events_event3');
var events_event4=document.getElementById('events_event4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'events_event'+'&events_event1='+events_event1value
+'&events_event2='+events_event2.value
+'&events_event3='+events_event3.value
+'&events_event4='+events_event4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsevents_reminder(){
var events_reminder1=document.getElementById('events_reminder1');
events_reminder1value="Hide";
if(events_reminder1.checked==true){
	events_reminder1value="Show";
	}
var events_reminder2=document.getElementById('events_reminder2');
var events_reminder3=document.getElementById('events_reminder3');
var events_reminder4=document.getElementById('events_reminder4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'events_reminder'+'&events_reminder1='+events_reminder1value
+'&events_reminder2='+events_reminder2.value
+'&events_reminder3='+events_reminder3.value
+'&events_reminder4='+events_reminder4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_arrearspayment(){
var housing_arrearspayment1=document.getElementById('housing_arrearspayment1');
housing_arrearspayment1value="Hide";
if(housing_arrearspayment1.checked==true){
	housing_arrearspayment1value="Show";
	}
var housing_arrearspayment2=document.getElementById('housing_arrearspayment2');
var housing_arrearspayment3=document.getElementById('housing_arrearspayment3');
var housing_arrearspayment4=document.getElementById('housing_arrearspayment4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_arrearspayment'+'&housing_arrearspayment1='+housing_arrearspayment1value
+'&housing_arrearspayment2='+housing_arrearspayment2.value
+'&housing_arrearspayment3='+housing_arrearspayment3.value
+'&housing_arrearspayment4='+housing_arrearspayment4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_housepayment(){
var housing_housepayment1=document.getElementById('housing_housepayment1');
housing_housepayment1value="Hide";
if(housing_housepayment1.checked==true){
	housing_housepayment1value="Show";
	}
var housing_housepayment2=document.getElementById('housing_housepayment2');
var housing_housepayment3=document.getElementById('housing_housepayment3');
var housing_housepayment4=document.getElementById('housing_housepayment4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_housepayment'+'&housing_housepayment1='+housing_housepayment1value
+'&housing_housepayment2='+housing_housepayment2.value
+'&housing_housepayment3='+housing_housepayment3.value
+'&housing_housepayment4='+housing_housepayment4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_landlord(){
var housing_landlord1=document.getElementById('housing_landlord1');
housing_landlord1value="Hide";
if(housing_landlord1.checked==true){
	housing_landlord1value="Show";
	}
var housing_landlord2=document.getElementById('housing_landlord2');
var housing_landlord3=document.getElementById('housing_landlord3');
var housing_landlord4=document.getElementById('housing_landlord4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_landlord'+'&housing_landlord1='+housing_landlord1value
+'&housing_landlord2='+housing_landlord2.value
+'&housing_landlord3='+housing_landlord3.value
+'&housing_landlord4='+housing_landlord4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_lease(){
var housing_lease1=document.getElementById('housing_lease1');
housing_lease1value="Hide";
if(housing_lease1.checked==true){
	housing_lease1value="Show";
	}
var housing_lease2=document.getElementById('housing_lease2');
var housing_lease3=document.getElementById('housing_lease3');
var housing_lease4=document.getElementById('housing_lease4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_lease'+'&housing_lease1='+housing_lease1value
+'&housing_lease2='+housing_lease2.value
+'&housing_lease3='+housing_lease3.value
+'&housing_lease4='+housing_lease4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_login(){
var housing_login1=document.getElementById('housing_login1');
housing_login1value="Hide";
if(housing_login1.checked==true){
	housing_login1value="Show";
	}
var housing_login2=document.getElementById('housing_login2');
var housing_login3=document.getElementById('housing_login3');
var housing_login4=document.getElementById('housing_login4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_login'+'&housing_login1='+housing_login1value
+'&housing_login2='+housing_login2.value
+'&housing_login3='+housing_login3.value
+'&housing_login4='+housing_login4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_nextofkin(){
var housing_nextofkin1=document.getElementById('housing_nextofkin1');
housing_nextofkin1value="Hide";
if(housing_nextofkin1.checked==true){
	housing_nextofkin1value="Show";
	}
var housing_nextofkin2=document.getElementById('housing_nextofkin2');
var housing_nextofkin3=document.getElementById('housing_nextofkin3');
var housing_nextofkin4=document.getElementById('housing_nextofkin4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_nextofkin'+'&housing_nextofkin1='+housing_nextofkin1value
+'&housing_nextofkin2='+housing_nextofkin2.value
+'&housing_nextofkin3='+housing_nextofkin3.value
+'&housing_nextofkin4='+housing_nextofkin4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_property(){
var housing_property1=document.getElementById('housing_property1');
housing_property1value="Hide";
if(housing_property1.checked==true){
	housing_property1value="Show";
	}
var housing_property2=document.getElementById('housing_property2');
var housing_property3=document.getElementById('housing_property3');
var housing_property4=document.getElementById('housing_property4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_property'+'&housing_property1='+housing_property1value
+'&housing_property2='+housing_property2.value
+'&housing_property3='+housing_property3.value
+'&housing_property4='+housing_property4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_tenant(){
var housing_tenant1=document.getElementById('housing_tenant1');
housing_tenant1value="Hide";
if(housing_tenant1.checked==true){
	housing_tenant1value="Show";
	}
var housing_tenant2=document.getElementById('housing_tenant2');
var housing_tenant3=document.getElementById('housing_tenant3');
var housing_tenant4=document.getElementById('housing_tenant4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_tenant'+'&housing_tenant1='+housing_tenant1value
+'&housing_tenant2='+housing_tenant2.value
+'&housing_tenant3='+housing_tenant3.value
+'&housing_tenant4='+housing_tenant4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionshousing_unit(){
var housing_unit1=document.getElementById('housing_unit1');
housing_unit1value="Hide";
if(housing_unit1.checked==true){
	housing_unit1value="Show";
	}
var housing_unit2=document.getElementById('housing_unit2');
var housing_unit3=document.getElementById('housing_unit3');
var housing_unit4=document.getElementById('housing_unit4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'housing_unit'+'&housing_unit1='+housing_unit1value
+'&housing_unit2='+housing_unit2.value
+'&housing_unit3='+housing_unit3.value
+'&housing_unit4='+housing_unit4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_client(){
var insurance_client1=document.getElementById('insurance_client1');
insurance_client1value="Hide";
if(insurance_client1.checked==true){
	insurance_client1value="Show";
	}
var insurance_client2=document.getElementById('insurance_client2');
var insurance_client3=document.getElementById('insurance_client3');
var insurance_client4=document.getElementById('insurance_client4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_client'+'&insurance_client1='+insurance_client1value
+'&insurance_client2='+insurance_client2.value
+'&insurance_client3='+insurance_client3.value
+'&insurance_client4='+insurance_client4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_insurer(){
var insurance_insurer1=document.getElementById('insurance_insurer1');
insurance_insurer1value="Hide";
if(insurance_insurer1.checked==true){
	insurance_insurer1value="Show";
	}
var insurance_insurer2=document.getElementById('insurance_insurer2');
var insurance_insurer3=document.getElementById('insurance_insurer3');
var insurance_insurer4=document.getElementById('insurance_insurer4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_insurer'+'&insurance_insurer1='+insurance_insurer1value
+'&insurance_insurer2='+insurance_insurer2.value
+'&insurance_insurer3='+insurance_insurer3.value
+'&insurance_insurer4='+insurance_insurer4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_insurerpayment(){
var insurance_insurerpayment1=document.getElementById('insurance_insurerpayment1');
insurance_insurerpayment1value="Hide";
if(insurance_insurerpayment1.checked==true){
	insurance_insurerpayment1value="Show";
	}
var insurance_insurerpayment2=document.getElementById('insurance_insurerpayment2');
var insurance_insurerpayment3=document.getElementById('insurance_insurerpayment3');
var insurance_insurerpayment4=document.getElementById('insurance_insurerpayment4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_insurerpayment'+'&insurance_insurerpayment1='+insurance_insurerpayment1value
+'&insurance_insurerpayment2='+insurance_insurerpayment2.value
+'&insurance_insurerpayment3='+insurance_insurerpayment3.value
+'&insurance_insurerpayment4='+insurance_insurerpayment4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_payment(){
var insurance_payment1=document.getElementById('insurance_payment1');
insurance_payment1value="Hide";
if(insurance_payment1.checked==true){
	insurance_payment1value="Show";
	}
var insurance_payment2=document.getElementById('insurance_payment2');
var insurance_payment3=document.getElementById('insurance_payment3');
var insurance_payment4=document.getElementById('insurance_payment4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_payment'+'&insurance_payment1='+insurance_payment1value
+'&insurance_payment2='+insurance_payment2.value
+'&insurance_payment3='+insurance_payment3.value
+'&insurance_payment4='+insurance_payment4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_policy(){
var insurance_policy1=document.getElementById('insurance_policy1');
insurance_policy1value="Hide";
if(insurance_policy1.checked==true){
	insurance_policy1value="Show";
	}
var insurance_policy2=document.getElementById('insurance_policy2');
var insurance_policy3=document.getElementById('insurance_policy3');
var insurance_policy4=document.getElementById('insurance_policy4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_policy'+'&insurance_policy1='+insurance_policy1value
+'&insurance_policy2='+insurance_policy2.value
+'&insurance_policy3='+insurance_policy3.value
+'&insurance_policy4='+insurance_policy4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_policyclaims(){
var insurance_policyclaims1=document.getElementById('insurance_policyclaims1');
insurance_policyclaims1value="Hide";
if(insurance_policyclaims1.checked==true){
	insurance_policyclaims1value="Show";
	}
var insurance_policyclaims2=document.getElementById('insurance_policyclaims2');
var insurance_policyclaims3=document.getElementById('insurance_policyclaims3');
var insurance_policyclaims4=document.getElementById('insurance_policyclaims4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_policyclaims'+'&insurance_policyclaims1='+insurance_policyclaims1value
+'&insurance_policyclaims2='+insurance_policyclaims2.value
+'&insurance_policyclaims3='+insurance_policyclaims3.value
+'&insurance_policyclaims4='+insurance_policyclaims4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_policycompensation(){
var insurance_policycompensation1=document.getElementById('insurance_policycompensation1');
insurance_policycompensation1value="Hide";
if(insurance_policycompensation1.checked==true){
	insurance_policycompensation1value="Show";
	}
var insurance_policycompensation2=document.getElementById('insurance_policycompensation2');
var insurance_policycompensation3=document.getElementById('insurance_policycompensation3');
var insurance_policycompensation4=document.getElementById('insurance_policycompensation4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_policycompensation'+'&insurance_policycompensation1='+insurance_policycompensation1value
+'&insurance_policycompensation2='+insurance_policycompensation2.value
+'&insurance_policycompensation3='+insurance_policycompensation3.value
+'&insurance_policycompensation4='+insurance_policycompensation4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_policytype(){
var insurance_policytype1=document.getElementById('insurance_policytype1');
insurance_policytype1value="Hide";
if(insurance_policytype1.checked==true){
	insurance_policytype1value="Show";
	}
var insurance_policytype2=document.getElementById('insurance_policytype2');
var insurance_policytype3=document.getElementById('insurance_policytype3');
var insurance_policytype4=document.getElementById('insurance_policytype4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_policytype'+'&insurance_policytype1='+insurance_policytype1value
+'&insurance_policytype2='+insurance_policytype2.value
+'&insurance_policytype3='+insurance_policytype3.value
+'&insurance_policytype4='+insurance_policytype4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_product(){
var insurance_product1=document.getElementById('insurance_product1');
insurance_product1value="Hide";
if(insurance_product1.checked==true){
	insurance_product1value="Show";
	}
var insurance_product2=document.getElementById('insurance_product2');
var insurance_product3=document.getElementById('insurance_product3');
var insurance_product4=document.getElementById('insurance_product4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_product'+'&insurance_product1='+insurance_product1value
+'&insurance_product2='+insurance_product2.value
+'&insurance_product3='+insurance_product3.value
+'&insurance_product4='+insurance_product4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_receipts(){
var insurance_receipts1=document.getElementById('insurance_receipts1');
insurance_receipts1value="Hide";
if(insurance_receipts1.checked==true){
	insurance_receipts1value="Show";
	}
var insurance_receipts2=document.getElementById('insurance_receipts2');
var insurance_receipts3=document.getElementById('insurance_receipts3');
var insurance_receipts4=document.getElementById('insurance_receipts4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_receipts'+'&insurance_receipts1='+insurance_receipts1value
+'&insurance_receipts2='+insurance_receipts2.value
+'&insurance_receipts3='+insurance_receipts3.value
+'&insurance_receipts4='+insurance_receipts4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_renewal(){
var insurance_renewal1=document.getElementById('insurance_renewal1');
insurance_renewal1value="Hide";
if(insurance_renewal1.checked==true){
	insurance_renewal1value="Show";
	}
var insurance_renewal2=document.getElementById('insurance_renewal2');
var insurance_renewal3=document.getElementById('insurance_renewal3');
var insurance_renewal4=document.getElementById('insurance_renewal4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_renewal'+'&insurance_renewal1='+insurance_renewal1value
+'&insurance_renewal2='+insurance_renewal2.value
+'&insurance_renewal3='+insurance_renewal3.value
+'&insurance_renewal4='+insurance_renewal4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_risk(){
var insurance_risk1=document.getElementById('insurance_risk1');
insurance_risk1value="Hide";
if(insurance_risk1.checked==true){
	insurance_risk1value="Show";
	}
var insurance_risk2=document.getElementById('insurance_risk2');
var insurance_risk3=document.getElementById('insurance_risk3');
var insurance_risk4=document.getElementById('insurance_risk4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_risk'+'&insurance_risk1='+insurance_risk1value
+'&insurance_risk2='+insurance_risk2.value
+'&insurance_risk3='+insurance_risk3.value
+'&insurance_risk4='+insurance_risk4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionsinsurance_riskmortorvehice(){
var insurance_riskmortorvehice1=document.getElementById('insurance_riskmortorvehice1');
insurance_riskmortorvehice1value="Hide";
if(insurance_riskmortorvehice1.checked==true){
	insurance_riskmortorvehice1value="Show";
	}
var insurance_riskmortorvehice2=document.getElementById('insurance_riskmortorvehice2');
var insurance_riskmortorvehice3=document.getElementById('insurance_riskmortorvehice3');
var insurance_riskmortorvehice4=document.getElementById('insurance_riskmortorvehice4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'insurance_riskmortorvehice'+'&insurance_riskmortorvehice1='+insurance_riskmortorvehice1value
+'&insurance_riskmortorvehice2='+insurance_riskmortorvehice2.value
+'&insurance_riskmortorvehice3='+insurance_riskmortorvehice3.value
+'&insurance_riskmortorvehice4='+insurance_riskmortorvehice4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionspayment_bank(){
var payment_bank1=document.getElementById('payment_bank1');
payment_bank1value="Hide";
if(payment_bank1.checked==true){
	payment_bank1value="Show";
	}
var payment_bank2=document.getElementById('payment_bank2');
var payment_bank3=document.getElementById('payment_bank3');
var payment_bank4=document.getElementById('payment_bank4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'payment_bank'+'&payment_bank1='+payment_bank1value
+'&payment_bank2='+payment_bank2.value
+'&payment_bank3='+payment_bank3.value
+'&payment_bank4='+payment_bank4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionspayment_bnkbranch(){
var payment_bnkbranch1=document.getElementById('payment_bnkbranch1');
payment_bnkbranch1value="Hide";
if(payment_bnkbranch1.checked==true){
	payment_bnkbranch1value="Show";
	}
var payment_bnkbranch2=document.getElementById('payment_bnkbranch2');
var payment_bnkbranch3=document.getElementById('payment_bnkbranch3');
var payment_bnkbranch4=document.getElementById('payment_bnkbranch4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'payment_bnkbranch'+'&payment_bnkbranch1='+payment_bnkbranch1value
+'&payment_bnkbranch2='+payment_bnkbranch2.value
+'&payment_bnkbranch3='+payment_bnkbranch3.value
+'&payment_bnkbranch4='+payment_bnkbranch4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionspayment_branch(){
var payment_branch1=document.getElementById('payment_branch1');
payment_branch1value="Hide";
if(payment_branch1.checked==true){
	payment_branch1value="Show";
	}
var payment_branch2=document.getElementById('payment_branch2');
var payment_branch3=document.getElementById('payment_branch3');
var payment_branch4=document.getElementById('payment_branch4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'payment_branch'+'&payment_branch1='+payment_branch1value
+'&payment_branch2='+payment_branch2.value
+'&payment_branch3='+payment_branch3.value
+'&payment_branch4='+payment_branch4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionspayment_costcenter(){
var payment_costcenter1=document.getElementById('payment_costcenter1');
payment_costcenter1value="Hide";
if(payment_costcenter1.checked==true){
	payment_costcenter1value="Show";
	}
var payment_costcenter2=document.getElementById('payment_costcenter2');
var payment_costcenter3=document.getElementById('payment_costcenter3');
var payment_costcenter4=document.getElementById('payment_costcenter4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'payment_costcenter'+'&payment_costcenter1='+payment_costcenter1value
+'&payment_costcenter2='+payment_costcenter2.value
+'&payment_costcenter3='+payment_costcenter3.value
+'&payment_costcenter4='+payment_costcenter4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionspayment_currency(){
var payment_currency1=document.getElementById('payment_currency1');
payment_currency1value="Hide";
if(payment_currency1.checked==true){
	payment_currency1value="Show";
	}
var payment_currency2=document.getElementById('payment_currency2');
var payment_currency3=document.getElementById('payment_currency3');
var payment_currency4=document.getElementById('payment_currency4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'payment_currency'+'&payment_currency1='+payment_currency1value
+'&payment_currency2='+payment_currency2.value
+'&payment_currency3='+payment_currency3.value
+'&payment_currency4='+payment_currency4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionssms_indsms(){
var sms_indsms1=document.getElementById('sms_indsms1');
sms_indsms1value="Hide";
if(sms_indsms1.checked==true){
	sms_indsms1value="Show";
	}
var sms_indsms2=document.getElementById('sms_indsms2');
var sms_indsms3=document.getElementById('sms_indsms3');
var sms_indsms4=document.getElementById('sms_indsms4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'sms_indsms'+'&sms_indsms1='+sms_indsms1value
+'&sms_indsms2='+sms_indsms2.value
+'&sms_indsms3='+sms_indsms3.value
+'&sms_indsms4='+sms_indsms4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionssms_messagereived(){
var sms_messagereived1=document.getElementById('sms_messagereived1');
sms_messagereived1value="Hide";
if(sms_messagereived1.checked==true){
	sms_messagereived1value="Show";
	}
var sms_messagereived2=document.getElementById('sms_messagereived2');
var sms_messagereived3=document.getElementById('sms_messagereived3');
var sms_messagereived4=document.getElementById('sms_messagereived4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'sms_messagereived'+'&sms_messagereived1='+sms_messagereived1value
+'&sms_messagereived2='+sms_messagereived2.value
+'&sms_messagereived3='+sms_messagereived3.value
+'&sms_messagereived4='+sms_messagereived4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionssms_messagesend(){
var sms_messagesend1=document.getElementById('sms_messagesend1');
sms_messagesend1value="Hide";
if(sms_messagesend1.checked==true){
	sms_messagesend1value="Show";
	}
var sms_messagesend2=document.getElementById('sms_messagesend2');
var sms_messagesend3=document.getElementById('sms_messagesend3');
var sms_messagesend4=document.getElementById('sms_messagesend4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'sms_messagesend'+'&sms_messagesend1='+sms_messagesend1value
+'&sms_messagesend2='+sms_messagesend2.value
+'&sms_messagesend3='+sms_messagesend3.value
+'&sms_messagesend4='+sms_messagesend4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionssms_processedsms(){
var sms_processedsms1=document.getElementById('sms_processedsms1');
sms_processedsms1value="Hide";
if(sms_processedsms1.checked==true){
	sms_processedsms1value="Show";
	}
var sms_processedsms2=document.getElementById('sms_processedsms2');
var sms_processedsms3=document.getElementById('sms_processedsms3');
var sms_processedsms4=document.getElementById('sms_processedsms4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'sms_processedsms'+'&sms_processedsms1='+sms_processedsms1value
+'&sms_processedsms2='+sms_processedsms2.value
+'&sms_processedsms3='+sms_processedsms3.value
+'&sms_processedsms4='+sms_processedsms4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionssms_smshandle(){
var sms_smshandle1=document.getElementById('sms_smshandle1');
sms_smshandle1value="Hide";
if(sms_smshandle1.checked==true){
	sms_smshandle1value="Show";
	}
var sms_smshandle2=document.getElementById('sms_smshandle2');
var sms_smshandle3=document.getElementById('sms_smshandle3');
var sms_smshandle4=document.getElementById('sms_smshandle4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'sms_smshandle'+'&sms_smshandle1='+sms_smshandle1value
+'&sms_smshandle2='+sms_smshandle2.value
+'&sms_smshandle3='+sms_smshandle3.value
+'&sms_smshandle4='+sms_smshandle4.value
,true);
xmlHttp.send(null);
}
function savemenudisplyOptionssms_smsinvalid(){
var sms_smsinvalid1=document.getElementById('sms_smsinvalid1');
sms_smsinvalid1value="Hide";
if(sms_smsinvalid1.checked==true){
	sms_smsinvalid1value="Show";
	}
var sms_smsinvalid2=document.getElementById('sms_smsinvalid2');
var sms_smsinvalid3=document.getElementById('sms_smsinvalid3');
var sms_smsinvalid4=document.getElementById('sms_smsinvalid4');
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}
xmlHttp.onreadystatechange=function(){  if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveMenuOptions.php?displaydiv=updatestatus"+'&t='+'sms_smsinvalid'+'&sms_smsinvalid1='+sms_smsinvalid1value
+'&sms_smsinvalid2='+sms_smsinvalid2.value
+'&sms_smsinvalid3='+sms_smsinvalid3.value
+'&sms_smsinvalid4='+sms_smsinvalid4.value
,true);
xmlHttp.send(null);
}