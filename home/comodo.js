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
   
   
   
	
	function newconnection(e,f) {	
   	var strURL="newconnection.php?d="+e+"&f="+f;
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
	
function rejectp(e) {	
   	
   	if(e==11){
        savepropertyinfo();
     }
     else if(e==22){
        savebasicinfo();
     }
     else if(e==33){
        savemeterinfo();
     }
     else if(e==44){
        savedepositinfo();     
     }
	}
	
function savebasicinfo() {
	 
  var custname=document.getElementById('custname').value;
  
  var gender=document.getElementById('gender').value;
  
  var address=document.getElementById('address').value;
  
  var phone=document.getElementById('phone').value;
  
  var pidd=document.getElementById('pid').value;
  
  var displ=document.getElementById('displ').value;
  
  var email=document.getElementById('email').value;
  
  var custid=document.getElementById('custid').value;
  
  var idno=document.getElementById('idno').value;
  
  var pin=document.getElementById('pin').value;
  
  var custclass=document.getElementById('custclass').value;
  var strURL="newconnection.php?custname="+custname+"&gender="+gender+"&pidd="+pidd+"&displ="+displ+"&d="+22+"&address="+address+"&phone="+phone+"&email="+email+"&custid="+custid+"&idno="+idno+"&pin="+pin+"&custclass="+custclass ;
var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          				var response=req.responseText;
						//#####################################################################
				if(response=="Name field is blank. Please fill it and continue"){
                   document.getElementById('msglabel').innerHTML=response;
                 }
                 else if(response=="You have not selected Gender"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                 else if(response=="Address field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Phone field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Email field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Please select Identification type(ID,PASSPORT,CI)"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Enter Identification Number and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Pin field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Please select customer classification and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="The record could not be saved."){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else{
					document.getElementById('msglabel').innerHTML="";
                   newconnection(3,response);
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
	
function savepropertyinfo() {
  var block=document.getElementById('block').value;
  
  var plot=document.getElementById('plot').value;
  
  var connection=document.getElementById('connection').value;
  var accountno=document.getElementById('accountno').value;
  var zone=document.getElementById('zone').value;
  var walk=document.getElementById('walk').value;
  var street=document.getElementById('street').value;
  
  var estate=document.getElementById('estate').value;
  
  var sanitation=document.getElementById('sanitation').value;
  var strURL="newconnection.php?block="+block+"&d="+11+"&plot="+plot+"&connection="+connection+"&accountno="+accountno+"&zone="+zone+"&walk="+walk+"&street="+street+"&estate="+estate+"&sanitation="+sanitation ;
var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;
          
              if(response=="Block field is blank. Please fill it and continue"){
                   document.getElementById('msglabel').innerHTML=response;
				   
                 }
                 else if(response=="Only Numericals are accepted for the 'Block' field!"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                 else if(response=="plot field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Only Numericals are accepted for the 'Plot' field!"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="connection field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Only Numericals are accepted for the 'Connection' field!"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Account no field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Only Numericals are accepted for the 'Account' field!"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Zone Missing"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="Walk Missing"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="street field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="estate field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="sanitation field is blank. Please fill it and continue"){
                    document.getElementById('msglabel').innerHTML=response;
                  }
                  else if(response=="The record could not be saved."){
                                  
                        document.getElementById('msglabel').innerHTML=response;
              }
              else{
				  document.getElementById('msglabel').innerHTML="";
                   newconnection(2,response);
              }
          						
					//						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
function savemeterinfo() {
  var make=document.getElementById('make').value;
  
  var serial=document.getElementById('serial').value;
  
  var size=document.getElementById('size').value;
  
  var acnno=document.getElementById('acnno').value;
  
  var displ=document.getElementById('displ').value;
  var strURL="newconnection.php?make="+make+"&d="+33+"&serial="+serial+"&size="+size+"&acnno="+acnno+"&displ="+displ ;
var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {
          var response=req.responseText;						
					if(response=="Select Meter Make please"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Enter Meter Serial Number"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="Select Meter Size"){ 
            document.getElementById('msglabel').innerHTML=response;
          }
          else if(response=="There was an error saving Meter Details!"){ 
            
          }
          else{
			document.getElementById('msglabel').innerHTML="";
            newconnection(4,response);
            
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
					
					if(response=="Receipt Number field is blank. Please fill it and continue"){ 
							document.getElementById('msglabel').innerHTML=response;
						  }
						  else if(response=="Amount field is blank. Please fill it and continue"){ 
							document.getElementById('msglabel').innerHTML=response;
						  }
						  else if(response=="Wrong digits for Amount!"){ 
							document.getElementById('msglabel').innerHTML=response;
						  }
						  else if(response=="Transaction Date field is blank. Please fill it and continue"){ 
							document.getElementById('msglabel').innerHTML=response;
						  }
						  else if(response=="Connection ID field is blank. Please fill it and continue"){ 
							document.getElementById('msglabel').innerHTML=response;
						  }
						  else if(response=="Wrong format for Connid!"){ 
							document.getElementById('msglabel').innerHTML=response;
						  }
						  else{
							  document.getElementById('msglabel').innerHTML="";
							newconnection(1,0);
							
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

  function hidden() {
  var pid=document.getElementById('pid').value;
  
 alert("It is "+pid);
		
	
	}
	