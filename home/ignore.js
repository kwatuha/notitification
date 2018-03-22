// JavaScript Document
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
   
   
   
	
	function deleted(t) {	
   	var strURL="billing.php?t="+t;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;						
					document.getElementById('students').innerHTML=response;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
function reject(e) {	
   	
   	if(e==11){
        getAccDetails();
     }
     else if(e==22){
     
        saveReadings();
     }
     else if(e==33){
        savemeterinfo();
     }
     else if(e==44){
        savedepositinfo();     
     }
     else if(e==55){
        fetchacreadings();     
     }
      else if(e==88){
        editreading();     
     }
	}

function fetchacreadings(){
 var accno=document.getElementById('accno').value;
  
  var strURL="billing.php?accno="+accno+"&t=7";
var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;
          
          /////////////////
          if(response=="Invalid Account No."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Could not fetch details for the account"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="The Account No. doesnt exist in the database."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="There was an error accessing the set dates."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Billing dates have not been set. Please set and continue"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Could not build a list of connections!"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else{
            document.getElementById('msglabel').innerHTML="";
            document.getElementById('students').innerHTML=response;
            
          }						
										
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}	

}	



function getAccDetails() {
	 
  var accno=document.getElementById('accno').value;
  
  var strURL="billing.php?accno="+accno+"&t=2";
var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;
          
          /////////////////
          if(response=="Invalid Account No."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Could not fetch details for the account"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="The Account No. doesnt exist in the database."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="There was an error accessing the set dates."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Billing dates have not been set. Please set and continue"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
         else if(response=="Could not build a list of connections!"){ 
            document.getElementById('msglabel').innerHTML=response;
          } 
          else{
            document.getElementById('msglabel').innerHTML="";
            document.getElementById('students').innerHTML=response;
            
          }						
										
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
function saveReadings() {


  var bdate=document.getElementById('bdate').value; 
  var preading=document.getElementById('preading').value;
  var pdate=document.getElementById('pdate').value;
  var curdate=document.getElementById('curdate').value;
  
  var curreading=document.getElementById('curreading').value;
  var accnumber=document.getElementById('accnumber').value;
  
  var recid=document.getElementById('recid').value;

     var strURL="try.php?bdate="+bdate+"&d="+11+"&curdate="+curdate+"&curreading="+curreading+"&accnumber="+accnumber+"&preading="+preading+"&pdate="+pdate+"&recid="+recid;

 var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;
          
          //######################33
          if(response=="Check the current reading date."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Current reading date is pointing to the future"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Wrong billing date"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Check the current reading"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="The Record has no identification number!"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else{
          
            callnext(response);
            
          }
          //$$$$$$$$$$$$$$$$$$$$$$$$						
											
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}	
    
    	
	}
	
	function editreading() {


  var bdate=document.getElementById('bdate').value; 
  var preading=document.getElementById('preading').value;
  var pdate=document.getElementById('pdate').value;
  var curdate=document.getElementById('curdate').value;
  
  var curreading=document.getElementById('curreading').value;
  var accnumber=document.getElementById('accnumber').value;
  
  var recid=document.getElementById('recid').value;

     var strURL="editreading.php?bdate="+bdate+"&d="+11+"&curdate="+curdate+"&curreading="+curreading+"&accnumber="+accnumber+"&preading="+preading+"&pdate="+pdate+"&recid="+recid;

 var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;
          
          //######################33
          if(response=="Check the current reading date."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Only numericals are accepted for current reading"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Check the current reading"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="The record could not be updated! Contact adm"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="The reading has been updated successfully"){
          
            deleted(3);
            
          }
          //$$$$$$$$$$$$$$$$$$$$$$$$						
											
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}	
    
    	
	}
	
function  callnext(response) {
 
  var strURL="nxtform.php?res="+response;
var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;
          
          if(response=="Invalid Account No."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Could not fetch details for the account"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="The Account No. doesnt exist in the database."){ 
            document.getElementById('msglabel').innerHTML=response;
            deleted(1);
          }
          else if(response=="There was an error in accessing the set dates."){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="No date has been set. Please set and continue"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else{
          
            document.getElementById('students').innerHTML=response;
            
          }
          				
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
function savedepositinfo() {
  var receipt=document.getElementById('receipt').value;
  
  var amount=document.getElementById('amount').value;
  
  var tdate=document.getElementById('tdate').value;
  
  var connid=document.getElementById('connid').value;
  
  var acnno=document.getElementById('acnno').value;
  
  var displ=document.getElementById('displ').value;
  
  var strURL="newconnection.php?receipt="+receipt+"&d="+44+"&amount="+amount+"&tdate="+tdate+"&connid="+connid+"&acnno="+acnno+"&displ="+displ ;
var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;						
					document.getElementById('msglabel').innerHTML=response;
          newconnection(1,0);						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

  function hidden() {
  
  
 alert("It is me bwana");
		
	
	}
	