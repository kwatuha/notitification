

function validateNotificationSuccessCaption(){
	var hiddenCompletionstatus=document.getElementById('hiddenCompletionstatus').value;
	
	hiddenCompletionstatus=hiddenCompletionstatus.trim();
	hiddenCompletionstatus=hiddenCompletionstatus.toUpperCase();
	var visiblecompletionstatus=document.getElementById('admin_alertactivitystatus_after_action').value;
	
	visiblecompletionstatus=visiblecompletionstatus.trim();
	visiblecompletionstatus=visiblecompletionstatus.toUpperCase();
	
	if(visiblecompletionstatus==hiddenCompletionstatus){
	 alert('The success action caption in use');
	}else{
		
		saveadmin_alertactivityDetailsInfo('admin_alertactivity','NOID','Save','0 ','updateclient','Admin');
	}
	 
	 
	}
function checkTaskCompletionStatus(actiontype){

	//control$currentTbl$fieldname
	//caption
var alerid=document.getElementById('admin_alertactivityalert_id_fkhidden').value;
var actionid=alerid;
var captiondiv=document.getElementById('captionadmin_alertactivitymark_task_completion');
var controldiv=document.getElementById('controladmin_alertactivitymark_task_completion');	
var hiddenCompletionstatus=document.getElementById('hiddenCompletionstatus');
var markcompletionalert_success=document.getElementById('markcompletionalert_success');
	
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		var myresponse=xmlHttp.responseText;
		
		var actualresponse=myresponse.split('|');
		if(actualresponse[0]=='Task Completion is set'){
			markcompletionalert_success.disabled='true';
			myfillControl('hiddenCompletionstatus',actualresponse[1]);
			}else{
			markcompletionalert_success.disabled='false';
			}
				
				
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/notificationSuccess.php?actionid="+actionid+'&actiontype='+actiontype,true);
xmlHttp.send(null);
}

function getTaskCompletionStatus(){
	var alerid=document.getElementById('admin_alertactivityalert_id_fkhidden').value;
	if(alerid==''){
		alert('Please select task!');
	}
var markcompletion=document.getElementById('markcompletionalert_success');
var markcompletionval='';
if(markcompletion.checked==true){
markcompletionval='complete';
var actiontype='taskcomplete';
var actionid=alerid;
}
	
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		if(markcompletionval=='complete'){
			myfillControl('admin_alertactivitymark_task_completion',xmlHttp.responseText);
			myfillControl('admin_alertactivitystatus_after_action',xmlHttp.responseText);
			
			}
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/notificationSuccess.php?actionid="+actionid+'&actiontype='+actiontype,true);
xmlHttp.send(null);
}
function actionNotificationSubActivity(tablename, rid, gnid, actionid,actiontype,statuscaption,currentactivity,success_action){
	alert(success_action+'wwwssssssssssssssssssssssssssssssssssssss');
	var comment='';
	alert(actiontype);
	if(actiontype=='saveIND'){
     comment =document.getElementById('notificationactivitycomment').value;
	}
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		
		if(xmlHttp.responseText!='No Data'){
		document.getElementById('filldata').innerHTML=xmlHttp.responseText;
		$( "#dialog-form" ).dialog( "open" );
		}
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/notificationSuccess.php?t="+tablename+'&rid='+ rid+'&gnid='+gnid+'&actionid='+ actionid+'&actiontype='+actiontype+'&statuscaption='+statuscaption+'&comment='+ comment+'&currentactivity='+currentactivity+'&success_action='+success_action,true);
xmlHttp.send(null);
}

function processNotificationActivity(tablename, rid, gnid, actionid,actiontype){

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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		
		if(xmlHttp.responseText!='No Data'){
		document.getElementById('filldata').innerHTML=xmlHttp.responseText;
		$( "#dialog-form" ).dialog( "open" );
		}
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/notificationSuccess.php?t="+tablename+'&rid='+ rid+'&gnid='+gnid+'&actionid='+ actionid+'&actiontype='+actiontype,true);
xmlHttp.send(null);
}
function fillActivitySuccessActionControl(tablename,id,successctrlcaptn){
 var successcontrol=document.getElementById('captionadmin_alertactivityalert_success');
 successcontrol.innerHTML=successctrlcaptn;


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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		myfillControl('hdsadmin_alertactivityalert_success',xmlHttp.responseText);
		var sucessRevisedVal=id+'|'+tablename;
		myfillControl('admin_alertactivityalert_success',sucessRevisedVal);
	}
	
	
} 
xmlHttp.open("GET","http://localhost/formgen/home/notificationSuccess.php?t="+tablename+'&tv='+id,true);
xmlHttp.send(null);
}
function fillActivitySuccessAction(){
 //var successcontrol=document.getElementById('admin_alertactivityalert_success').value;
 $( "#dialog-form" ).dialog( "open" );
 //document.getElementById('filldata').innerHTML=successcontrol;
var alerid=document.getElementById('admin_alertactivityalert_id_fkhidden').value;
	if(alerid==''){
		alert('Please select task!');
	}
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('filldata').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/notificationActivityStatus.php?altert_id="+alerid,true);
xmlHttp.send(null);
}

function checkSname(){
	var sname=document.getElementById('pim_employeeemployee_name');
	var re= /^[A-Za-z\s]+$/;
	
	if (re.test(sname.value)) {
		savepim_employeeDetailsInfo('pim_employee','NOID','Save','0 ','updateclient');
  }
 
  else {
  //alert("INVALID SSN");
  alert("INVALID Student Name! Hint: James Kamau or JAMES KAMAU");
 
 }
	
	
	}
function checkSsn(){
	var fmat = /^(SC||COM)[/]?[0-9]{4}[/]?[0-9]{4}$/;
	
	
    var ssn=document.getElementById('pim_employeeemployee_number');
	
 if (fmat.test(ssn.value)) {
  checkSname();
 }
 
  else {
  //alert("INVALID SSN");
  alert("INVALID Student Number! Hint: SC/1050/2010 or COM/0008/2010");
 
 }
 
 
}


 function IsNumeric(colmname)
// check for valid numeric strings   
{
var strString=document.getElementById(colmname).value;	
var strValidChars = "0123456789.-";
var strChar;
var blnResult = true;
if (strString.length == 0) return false;

// test strString consists of valid characters listed above
for (i = 0; i < strString.length && blnResult == true; i++)
{
strChar = strString.charAt(i);
if (strValidChars.indexOf(strChar) == -1)
{
//blnResult = false;
alert('Only Numerics Allowed!');
}
}
return blnResult;
}
////////////////////////////////////////////////////////////////////

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var z,i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];

    if (obj.style) { obj=obj.style; z=(v=='show')?3:(v=='hide')?2:2; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; obj.zIndex=z; }
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function displayLayer(panelNo) {

	hasChanges = (panelNo != 1 && document.frmEmp.personalFlag.value == '1');
	hasChanges |= (panelNo != 2 && document.frmEmp.jobFlag.value == '1');
	hasChanges |= (panelNo != 4 && document.frmEmp.contactFlag.value == '1');
	hasChanges |= (panelNo != 18 && document.frmEmp.taxFlag.value == '1');
	hasChanges |= (panelNo != 20 && document.frmEmp.customFlag.value == '1');
	hasChanges |= (panelNo != 21 && document.frmEmp.photoFlag.value == '1')
  	if(hasChanges) {

  		if(confirm("Please save the changes before you move onto another pane!")) {
  			editEmpMain();
  			if( !updateEmpMain() ){
                return;
            }
  		} else {
  			document.frmEmp.personalFlag.value=0;
  			document.frmEmp.jobFlag.value=0;
  			document.frmEmp.contactFlag.value=0;
  			document.frmEmp.taxFlag.value=0;
  			document.frmEmp.customFlag.value=0;
  		}
  	}

	switch(panelNo) {
          	case 1 : showPane('personal');break;
          	case 2 : showPane('job');break;
          	case 3 : showPane('dependents');break;
          	case 4 : showPane('contacts'); break;
          	case 5 : showPane('emgcontacts'); break;
          	case 6 : showPane('attachments'); break;
          	case 7 : break;
          	case 8 : break;
          	case 9 : showPane('education'); break;
          	case 10 : showPane('immigration'); break;
          	case 11 : showPane('languages'); break;
          	case 12 : showPane('licenses'); break;
          	case 13 : showPane('memberships'); break;
          	case 14 : showPane('payments'); break;
          	case 15 : showPane('report-to'); break;
          	case 16 : showPane('skills'); break;
          	case 17 : showPane('work-experiance'); break;
          	case 18 : showPane('tax'); break;
          	case 19 : showPane('direct-debit'); break;
          	case 20 : showPane('custom'); break;
          	case 21 : showPane('photo'); break;
	}

	document.frmEmp.pane.value = panelNo;
}

function showPane(paneId) {
	var allPanes = new Array('personal','job','dependents','contacts','emgcontacts','attachments','education','immigration','languages','licenses',
				'memberships','payments','report-to','skills','work-experiance', 'tax', 'direct-debit','custom', 'photo');
	var numPanes = allPanes.length;
	for (i=0; i< numPanes; i++) {
	    pane = allPanes[i];
	    if (pane != paneId) {
	    	var paneDiv = $(pane);
	    	if (paneDiv!= null && paneDiv.className.indexOf('currentpanel') > -1) {
	    		paneDiv.className = paneDiv.className.replace(/\scurrentpanel\b/,'');
	    	}

	    	// style link
	    	var link = $(pane + 'Link');
	    	if (link && (link.className.indexOf('current') > -1)) {
	    	    link.className = '';
	    	}
	    }
	}

	var currentPanel = $(paneId);
	if (currentPanel != null && currentPanel.className.indexOf('currentpanel') == -1) {
		currentPanel.className += ' currentpanel';
	}
	var currentLink = $(paneId + 'Link');
	if (currentLink && (currentLink.className.indexOf('current') == -1)) {
	    currentLink.className = 'current';
	}

}

function setUpdate(opt) {

		switch(eval(opt)) {
          	case 0 : document.frmEmp.main.value=1; break;
          	case 1 : document.frmEmp.personalFlag.value=1; break;
          	case 2 : document.frmEmp.jobFlag.value=1; break;
            case 4 : document.frmEmp.contactFlag.value=1; break;
            case 18: document.frmEmp.taxFlag.value=1; break;
            case 20: document.frmEmp.customFlag.value=1; break;
		}
		document.frmEmp.pane.value = opt;
}


function showPhotoHandler() {
	displayLayer(21);
}

function resetAdd(panel, add) {
	document.frmEmp.action = document.frmEmp.action;
	document.frmEmp.pane.value = panel;
	document.frmEmp.txtShowAddPane.value = add;
	document.frmEmp.submit();
}

function showAddPane(paneName) {
	YAHOO.SmartHRM.container.wait.show();

	addPane = document.getElementById('addPane'+paneName);
	editPane = document.getElementById('editPane'+paneName);
	parentPane = document.getElementById('parentPane'+paneName);

	if (addPane && addPane.style) {
		addPane.style.display = tableDisplayStyle;
	} else {

		resetAdd(document.frmEmp.pane.value, paneName);
		return;
	}

	if (editPane && parentPane) {
		parentPane.removeChild(editPane);
	}

	YAHOO.SmartHRM.container.wait.hide();
}

function showHideSubMenu(link) {

    var uldisplay;
	var newClass;

	if (link.className == 'expanded') {

		// Need to hide
	    uldisplay = 'none';
	    newClass = 'collapsed';

	} else {

		// Need to show
	    uldisplay = 'block';
	    newClass = 'expanded';
	}

    var parent = link.parentNode;
    uls = parent.getElementsByTagName('ul');
	for(var i=0; i<uls.length; i++) {
	    ul = uls[i].style.display = uldisplay;
	}

	link.className = newClass;
}

tableDisplayStyle = "table";
//--><!]]>

//////////////Auto Suggest Secctrion
function lookup_admin_role(role_id) {
    if(role_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_role.php", {queryString: ""+role_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_role   lookup




function fill_role_id(thisValue) {
	
    $('#role_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenrole_id(thisValue) {
	
    $('#role_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_admin_status(statustypestatus_id) {
    if(statustypestatus_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_status.php", {queryString: ""+statustypestatus_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_status   lookup




function fill_statustypestatus_id(thisValue) {
	
    $('#statustypestatus_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenstatustypestatus_id(thisValue) {
	
    $('#statustypestatus_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_admin_statustype(statustype_id) {
    if(statustype_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_statustype.php", {queryString: ""+statustype_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_statustype   lookup




function fill_statustype_id(thisValue) {
	
    $('#statustype_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenstatustype_id(thisValue) {
	
    $('#statustype_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_admin_user(id_id) {
    if(id_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_user.php", {queryString: ""+id_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_user   lookup




function fill_id(thisValue) {
	
    $('#id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenid(thisValue) {
	
    $('#idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_admin_usergroup(usergroup_id) {
    if(usergroup_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../admin/rpcadmin_usergroup.php", {queryString: ""+usergroup_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // admin_usergroup   lookup




function fill_usergroup_id(thisValue) {
	
    $('#usergroup_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenusergroup_id(thisValue) {
	
    $('#usergroup_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_attendance_event(event_id) {
    if(event_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../attendance/rpcattendance_event.php", {queryString: ""+event_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // attendance_event   lookup




function fill_event_id(thisValue) {
	
    $('#event_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenevent_id(thisValue) {
	
    $('#event_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_attendance_holiday(holiday_id) {
    if(holiday_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../attendance/rpcattendance_holiday.php", {queryString: ""+holiday_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // attendance_holiday   lookup




function fill_holiday_id(thisValue) {
	
    $('#holiday_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenholiday_id(thisValue) {
	
    $('#holiday_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_comp_assign(assign_id) {
    if(assign_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../comp/rpccomp_assign.php", {queryString: ""+assign_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // comp_assign   lookup




function fill_assign_id(thisValue) {
	
    $('#assign_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenassign_id(thisValue) {
	
    $('#assign_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_comp_comp(comp_id) {
    if(comp_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../comp/rpccomp_comp.php", {queryString: ""+comp_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // comp_comp   lookup




function fill_comp_id(thisValue) {
	
    $('#comp_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddencomp_id(thisValue) {
	
    $('#comp_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_comp_details(details_id) {
    if(details_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../comp/rpccomp_details.php", {queryString: ""+details_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // comp_details   lookup




function fill_details_id(thisValue) {
	
    $('#details_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddendetails_id(thisValue) {
	
    $('#details_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_leave_leave(leave_id) {
    if(leave_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../leave/rpcleave_leave.php", {queryString: ""+leave_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // leave_leave   lookup




function fill_leave_id(thisValue) {
	
    $('#leave_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenleave_id(thisValue) {
	
    $('#leave_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_pim_dept(dept_id) {
    if(dept_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../pim/rpcpim_dept.php", {queryString: ""+dept_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // pim_dept   lookup




function fill_dept_id(thisValue) {
	
    $('#dept_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddendept_id(thisValue) {
	
    $('#dept_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_pim_employee(employee_id) {
    if(employee_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../pim/rpcpim_employee.php", {queryString: ""+employee_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // pim_employee   lookup




function fill_employee_id(thisValue) {
	
    $('#employee_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenemployee_id(thisValue) {
	
    $('#employee_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_pim_location(location_id) {
    if(location_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../pim/rpcpim_location.php", {queryString: ""+location_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // pim_location   lookup




function fill_location_id(thisValue) {
	
    $('#location_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenlocation_id(thisValue) {
	
    $('#location_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}


function lookup_transport_vehicle(vehicle_id) {
    if(vehicle_id.length == 0) {
        
		
		$('#suggestions').hide();
    } else {
        $.post("../transport/rpctransport_vehicle.php", {queryString: ""+vehicle_id+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // transport_vehicle   lookup




function fill_vehicle_id(thisValue) {
	
    $('#vehicle_id').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_hiddenvehicle_id(thisValue) {
	
    $('#vehicle_idhidden').val(thisValue);
	
	
   $('#suggestions').hide();
}
///end of auto suggest

//Other Key interface functions
function Ajax(){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('ReloadThis').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
xmlHttp.open("GET","http://localhost:8080/ampath/control.php?t=k",true);
xmlHttp.send(null);
}

window.onload=function(){
	setTimeout('Ajax()',2000);
}
function hideList(diveid){
var activelist= document.getElementById(diveid)
activelist.style.visibility="hidden";

}

function showList(diveid){
var activelist= document.getElementById(diveid)
activelist.style.visibility="visible";

}

//Add columns dynamically

function addNewColumns(){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('ReloadThis').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost:8080/ampath/addcolumns.php",true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}

function loadOtherDetails(activetablename){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById(activetablename).innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost/formgen/home/"+activetablename+".php",true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}


function loadActiveMenuDetails(activemenutab){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('activemenu').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost/formgen/menu/menutab.php?q="+activemenutab,true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}

function loadActiveTableAddDetails(activemtable,fld){

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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('tablecontentdetails').innerHTML=xmlHttp.responseText;
		//setTimeout('Ajax()',2000);
	}
}
//x=document.getElementById('hiddenEmployeeIDQrylt');
qrlid=2;
xmlHttp.open("GET","http://localhost/formgen/"+fld+"/"+activemtable,true);
xmlHttp.send(null);
}

window.onload=function(){
	//setTimeout('Ajax()',2000);
}


function loadDefaultTableAddDetails(activemtable,fld){

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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById(fld).innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost/formgen/"+fld+"/"+activemtable+'.php',true);
xmlHttp.send(null);
}

window.onload=function(){
	
}


function loadInfo(activetable,fld){

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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
	
		document.getElementById(fld).innerHTML=xmlHttp.responseText;
	}
}

xmlHttp.open("GET","http://localhost/formgen/"+fld+"/"+activetable+'.php',true);
xmlHttp.send(null);
}

window.onload=function(){
	
}

function loadTableInfo(activetable,recordid,actionitem,loadfolder){

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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
	
		document.getElementById(loadfolder).innerHTML=xmlHttp.responseText;
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/bodytab.php?q="+recordid+"&t="+activetable+"&act="+actionitem,true);
xmlHttp.send(null);
}


window.onload=function(){
	
}


function WorkedsaveDetailsTableInfo(){ var xmlHttp;
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
xmlHttp.onreadystatechange=function(){
if(xmlHttp.readyState==4){
var employee_id=document.getElementById('employee_id');
var employee_name=document.getElementById('employee_name');
var DOB=document.getElementById('DOB');
var national_ID=document.getElementById('national_ID');
var gender=document.getElementById('gender');
var address=document.getElementById('address');
var phone_number=document.getElementById('phone_number');
var town=document.getElementById('town');
var email_address=document.getElementById('email_address').value;
var postal_code=document.getElementById('postal_code').value;
var effective_dt=document.getElementById('effective_dt').value;
fdata=document.getElementById('postdata');
document.getElementById('saveEvent').innerHTML=xmlHttp.responseText;
}
}
xmlHttp.open("GET","http://localhost/formgen/home/bodysave.php?t="+'pim_employee'+'&q='+'1'+'employee_id='+employee_id.value+'&employee_name='+employee_name.value+'&DOB='+DOB.value+'&national_ID='+national_ID.value+'&gender='+gender.value+'&address='+address.value+'&phone_number='+phone_number.value+'&town='+town.value+'&email_address='+email_address.value+'&postal_code='+postal_code.value+'&effective_dt='+effective_dt.value,true);
xmlHttp.send(null);
}
window.onload=function(){
}



	

/*function savepim_employeeDetailsInfo(currentTable,recordID,msg){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	var employee_id=document.getElementById('employee_id');
	var employee_name=document.getElementById('employee_name');
	var DOB=document.getElementById('DOB');var national_ID=document.getElementById('national_ID');
	var gender=document.getElementById('gender');var address=document.getElementById('address');
	var phone_number=document.getElementById('phone_number');
	var town=document.getElementById('town');
	var email_address=document.getElementById('email_address');
	var postal_code=document.getElementById('postal_code');
	var effective_dt=document.getElementById('effective_dt');
fdata=document.getElementById('postdata');
	
		document.getElementById('saveEvent').innerHTML=xmlHttp.responseText;
		
	}
}



xmlHttp.open("GET","http://localhost/formgen/home/bodysave.php?t="+currentTable+'&q='+recordID+'employee_id='+employee_id.value+'&employee_name='+employee_name.value+'&DOB='+DOB.value+'&national_ID='+national_ID.value+'&gender='+gender.value+'&address='+address.value+'&phone_number='+phone_number.value+'&town='+town.value+'&email_address='+email_address.value+'&postal_code='+postal_code.value+'&effective_dt='+effective_dt.value,true);
xmlHttp.send(null);
}

window.onload=function(){
	
}
*/
//end of other functions interface

//View display functions
function loadDetailsForEdit(activetable,fld,rid){
//alert(activetable+fld+rid);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
	
		document.getElementById('tablecontentdetails').innerHTML=xmlHttp.responseText;
	}
}

xmlHttp.open("GET","http://localhost/formgen/"+fld+"/"+activetable+'.php?q='+rid,true);
xmlHttp.send(null);
}

window.onload=function(){
	
}

/*function loadTableInfo(activetable,recordid,actionitem,loadfolder){


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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
	
		document.getElementById(loadfolder).innerHTML=xmlHttp.responseText;
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/bodytab.php?q="+recordid+"&t="+activetable+"&act="+actionitem,true);
xmlHttp.send(null);
}*/


window.onload=function(){
	
}
//end of view display
//Vital functions
function hidesuggestionbox(currentfieldid){
var xid=document.getElementById(currentfieldid);
xid.style.visibility="hidden";
xid.innerHTML='';
}


function hidesuggestionboxv(fieldval,lookupfieldid,suggestions){
var xid=document.getElementById(suggestions);
xid.style.visibility="hidden";
xid.innerHTML='';
}


function myfillfunction(fillid,fillidwith,hidethisdiv) {
	var suggestionsds=document.getElementById(hidethisdiv);
	$('#'+fillid).val(fillidwith);
	suggestionsds.style.visibility="hidden";
	suggestionsds.innerHTML='';
}


function hidesuggestionboxv(fieldval,lookupfieldid,suggestions){
var xid=document.getElementById(suggestions);
xid.style.visibility="hidden";
xid.innerHTML='';
}

///

function displaysearchDitails(activetable,searchid,hidethisdiv,limitfield,currentactivetable){
	var parenttableid;
	if(currentactivetable!='NL'){
	
	var parenttableid=document.getElementById(currentactivetable+limitfield+'_fkhidden').value;
	
	
	}
var searchidObj=document.getElementById(searchid);
var suggestionsds=document.getElementById(hidethisdiv);
suggestionsds.style.visibility="visible";


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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(hidethisdiv).innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/dynamicsearch.php?t="+activetable+'&fillid='+searchid+'&searchid='+searchidObj.value+'&hidethisdiv='+hidethisdiv+'&currentactivetable='+currentactivetable+'&parenttableid='+parenttableid+'&limitfield='+limitfield,true); 
xmlHttp.send(null);
}

function hidesuggestion(){
var suggestionboxObj= document.getElementById('suggestions');
suggestionboxObj.style.visibility="hidden";
suggestionboxObj.innerHTML='';
}

function showsuggestion(){
var suggestionboxObj= document.getElementById('suggestions');
suggestionboxObj.style.visibility="visible";

}



function valueChangecleaEditSessions(ActiveSession){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById('editsession').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/clearEditSessions.php?ActiveSession="+ActiveSession,true); 
xmlHttp.send(null);
}
//Display options
//Display sub groups
function displaySubSections(displayDiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/displayMenu.php?displayDiv="+displayDiv,true);
xmlHttp.send(null);
}

/*//Display sub groups rights
function displayRightsOptions(displayDiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/rightsDisplaySub.php?displayDiv="+displayDiv,true);
xmlHttp.send(null);
}

//Display sub groups
function displaySubGroupsInfo(activegrp,displayDiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/viewSubgrps.php?displayDiv="+displayDiv+'&sectiongroup='+activegrp,true);
xmlHttp.send(null);
}


//tables

//Display sub groups tables
function displaySubGroupsTables(activegrp,displayDiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/viewTables.php?displayDiv="+displayDiv+'&sectiongroup='+activegrp,true);
xmlHttp.send(null);
}

///table fields
//Display sub groups tables
function displaySubGroupsTablesFields(activegrp,displayDiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/viewTablesFields.php?displayDiv="+displayDiv+'&sectiongroup='+activegrp,true);
xmlHttp.send(null);
}

function hideVisibleDiv(divtag){
var suggestionboxObj= document.getElementById(divtag);
//suggestionboxObj.style.visibility="hidden";
var cur='<a href="#"  onclick="displaySubGroupsInfo("access'+divtag+'")">View</a>';
suggestionboxObj.innerHTML=cur;
}*/
//Display sub groups rights
function displayRightsOptions(displayDiv,stage,userid){
	usrgrpvalue='novaluePrimary';
	if(stage=='subsequent'){
	var usrgrp=document.getElementById('usergroup_id');
	usrgrpvalue=usrgrp.value;
	}
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
	

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	   
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/rightsDisplaySub.php?displayDiv="+displayDiv+'&usrgrp='+usrgrpvalue+'&userid='+userid,true);
xmlHttp.send(null);
}

//Display sub groups
function displaySubGroupsInfo(activegrp,displayDiv){
	var usrgrps=document.getElementById('usergroup_id');
	myfillControl('sectionid','subgroups');
	myfillControl('currentgroup',activegrp);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/viewSubgrps.php?displayDiv="+displayDiv+'&sectiongroup='+activegrp+'&usrgrp='+usrgrps.value,true);
xmlHttp.send(null);
}


//tables

//Display sub groups tables  
function displaySubGroupsTables(activegrp,displayDiv){
	var usrgrp=document.getElementById('usergroup_id');
	myfillControl('sectionid','tablesections');
	  
myfillControl('currentgroup',activegrp);
	
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/viewTables.php?displayDiv="+displayDiv+'&sectiongroup='+activegrp+'&usrgrp='+usrgrp.value,true);
xmlHttp.send(null);
}

///table fields
//Display sub groups tables
function displaySubGroupsTablesFields(activegrp,displayDiv){
var usrgrp=document.getElementById('usergroup_id');
myfillControl('sectionid','tablefields');
myfillControl('currentgroup',activegrp);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/viewTablesFields.php?displayDiv="+displayDiv+'&sectiongroup='+activegrp+'&usrgrp='+usrgrp.value,true);
xmlHttp.send(null);
}

function hideVisibleDiv(divtag){
var suggestionboxObj= document.getElementById(divtag);
suggestionboxObj.innerHTML='';
}

//Display sub groups tables
function saveRightsAssignment(activegrp,tableKey,displayDiv,actiontype){
	//alert(activegrp + tableKey +displayDiv+ actiontype);
	//al)ert(activegrp);
var usergroup=document.getElementById('usergroup_id');
var currentgroup=document.getElementById('currentgroup').value;
var strUser=usergroup.value;
//alert('rUNNING MY SELF'+usergroup.value);

//var strUser = usergroup.options[usergroup.selectedIndex].value;
v=activegrp+'1';
e=activegrp+'2';
d=activegrp+'3';

var view=document.getElementById(v);
viewvalue="v";
if(view.checked==true){
	viewvalue='1';
	}
var edit=document.getElementById(e);
editvalue="e";
if(edit.checked==true){
	editvalue='2';
	}
var deleter=document.getElementById(d);
deletervalue="d";
if(deleter.checked==true){
	deletervalue='3';
	}

//alert(viewvalue+deletervalue+editvalue);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById('actionstatusupateinfo').innerHTML=xmlHttp.responseText;
		
	}
}
//'&'+activegrp+'1='+viewvalue+'&'+activegrp+'2='+editvalue+'&'+activegrp+'3='+deletervalue+'&currentgroup='+currentgroup+'&usergroupPed='+'Welcome'
//alert(deletervalue+viewvalue+editvalue);
xmlHttp.open("GET","http://localhost/formgen/home/saveRights.php?usergroupPed="+strUser+'&displayDiv='+displayDiv+'&sectiongroup='+activegrp+'&tableKey='+tableKey+'&actiontype='+actiontype+'&deleteaction='+deletervalue+'&viewaction='+viewvalue+'&editaction='+editvalue,true);
xmlHttp.send(null);
}


//save attachments
function saveFileAttachment(filename,temporryLoc,folder,attachfor,displayDiv){
//alert(filename+" "+folder+" "+attachfor+" "+displayDiv);
//alert document.getElementById(filename).value;
var filenameVar=document.getElementById(filename);
var attachfor=document.getElementById(attachfor);
//alert("file"+filenameVar.value+filename+"value"+temporryLoc+attachfor.value);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/saveAttachments.php?displayDiv="+displayDiv+'&filename='+filenameVar.value+'&folder='+folder+'&filenameCtl='+filename+'&attachfor='+attachfor.value,true);
xmlHttp.send(null);
}

//phot process
function savePhotoHandler(){
	
	var photoObjp=document.getElementById('filebrouwseup');
	photoObjp.style.visibility="visible";
	//alert ('wed'+photonameDiv);
	
	}
	
//displayFieldConf('".$table_name."','".$table_field."','"."fielddisplay".$table_name."')	
function displayFieldConf(displaygroup,activetable,effectOnTable,tablefield,displayDiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/showFieldDisplayConf.php?t="+activetable+'&tablefield='+tablefield+'&effectOnTable='+effectOnTable+'&displaygroup='+displaygroup,true);
xmlHttp.send(null);
}

//defineSpecificDisplayFeature('".$table_name."','".$table_field."','autofill')
function defineSpecificDisplayFeature(displaygroup,activetable,effectOnTable,tablefield,action){
	
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById('INFoptions').innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/showFieldDisplaySpec.php?t="+activetable+'&tablefield='+tablefield+'&action='+action+'&effectOnTable='+effectOnTable+'&displaygroup='+displaygroup,true);
xmlHttp.send(null);
}

//displayTableFieldsOptions
//displayTableFieldsOptions("'.$table_name.'","'.'Displaytfieldshere")
function displayTableFieldsOptions(activetable,effectOnTable,action,dispaydiv){
	alert(activetable+'kwajhjhjhjhaflya'+effectOnTable);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById('displaytfieldsactual').innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/showTablefieldINF.php?t="+activetable+'&action='+action+'&effectOnTable='+effectOnTable,true);
xmlHttp.send(null);
}

function saveINFoptions(activetable,effectOnTable,tablefield,actionitem,dispaydiv){
	var combTableField=activetable+tablefield;
	alert(activetable+effectOnTable+tablefield+actionitem+dispaydiv);
	var fieldoptionsObj=document.getElementById(combTableField+'fieldoptions');
	var prefixObj=document.getElementById(combTableField+'prefix');
	var suffixObj=document.getElementById(combTableField+'suffix');
	var digitnumberObj=document.getElementById(combTableField+'digitnumber');

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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(dispaydiv).innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/saveTablefieldINF.php?t="+activetable +'&tablefield='+tablefield+'&fieldoptions='+fieldoptionsObj.value+'&prefix='+prefixObj.value+'&suffix='+suffixObj.value+'&actionitem='+actionitem+'&digitnumber='+digitnumberObj.value+'&effectOnTable='+effectOnTable,true);
xmlHttp.send(null);
}
function saveINFCustom(activetable,fieldname,recordid,actionitem,dispaydiv){
    var stored_value=document.getElementById(activetable+'AddVal');
	var display_caption=document.getElementById(activetable+'AddCap');
	var displaytype=document.getElementById(activetable+'AddDisp');
	//alert(displaytype.value);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(dispaydiv).innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveCustomData.php?t="+activetable +'&stored_value='+stored_value.value+'&display_caption='+display_caption.value+'&displaytype='+displaytype.value+'&actionitem='+actionitem+'&recordid='+recordid+'&fieldname='+fieldname,true);
xmlHttp.send(null);
}
function DisplayGroupINF(activetable,fieldname,dispaydiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(dispaydiv).innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/showGroupINF.php?t="+activetable+'&fieldname='+fieldname,true);
xmlHttp.send(null);
}
function NotificationTypes(activetable,fieldname,action){
	var fieldnameObj=document.getElementById(activetable+fieldname);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById('shownotificationtype').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/showNotificationType.php?t="+activetable+'&fieldname='+fieldname+'&fieldVal='+fieldnameObj.value+'&action='+action,true);
xmlHttp.send(null);
}

function checkAllCheckBoxes(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAllCheckboxes(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}


//save options
function SaveNotificationTypes(activetable,fieldname,action){
var fieldObj=document.getElementById(fieldname);
var	notify1	=document.getElementById(activetable+1);
var	notify2	=document.getElementById(activetable+2);
var	notify3	=document.getElementById(activetable+3);
/*var	notify4	=document.getElementById(activetable+4);
var	notify5	=document.getElementById(activetable+5);
var	notify6	=document.getElementById(activetable+6);
var	notify7	=document.getElementById(activetable+7);
var	notify8	=document.getElementById(activetable+8);
var	notify9	=document.getElementById(activetable+9);
var	notify10=document.getElementById(activetable+10);
var	notify11=document.getElementById(activetable+11);
var	notify12=document.getElementById(activetable+12);*/
if(notify1.checked==true){notifysave1=notify1.value;}else{notifysave1='NotCheckedToSave';}
if(notify2.checked==true){notifysave2=notify2.value;}else{notifysave2='NotCheckedToSave';}
if(notify3.checked==true){notifysave3=notify3.value;}else{notifysave3='NotCheckedToSave';}
/*if(notify4.cheecked==true){notifysave4=notify4.value;}else{notifysave4='NotCheckedToSave';}
if(notify5.cheecked==true){notifysave5=notify5.value;}else{notifysave5='NotCheckedToSave';}
if(notify6.cheecked==true){notifysave6=notify6.value;}else{notifysave6='NotCheckedToSave';}
if(notify7.cheecked==true){notifysave7=notify7.value;}else{notifysave7='NotCheckedToSave';}
if(notify8.cheecked==true){notifysave8=notify8.value;}else{notifysave8='NotCheckedToSave';}
if(notify9.cheecked==true){notifysave9=notify9.value;}else{notifysave9='NotCheckedToSave';}
if(notify10.cheecked==true){notifysave10=notify10.value;}else{notifysave10='NotCheckedToSave';}
if(notify11.cheecked==true){notifysave11=notify11.value;}else{notifysave11='NotCheckedToSave';}
if(notify12.cheecked==true){notifysave12=notify12.value;}else{notifysave12='NotCheckedToSave';}*/
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById('savesectionoptions').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveNotificationType.php?t="+activetable+'&fieldname='+fieldObj.value
+'&notification1='+notifysave1+'&notification2='+notifysave2+'&notification3='+notifysave3+'&action='+action,true);
xmlHttp.send(null);
/*+'&notification4='+notifysave4
+'&notification5='+notifysave5
+'&notification6='+notifysave6
+'&notification7='+notifysave7
+'&notification8='+notifysave8
+'&notification9='+notifysave9
+'&notification10='+notifysave10
+'&notification11='+notifysave11
+'&notification12='+notifysave12*/

}
/*function saveGroupNotifications(){
	numofradios = document.frm_bodyaccount_id_fkhidden.account_accountaccount_id_fkhidden.length;
	      for (y =0 ;y<numofradios;y++){
if (document.frm_bodyaccount_id_fkhidden.account_accountaccount_id_fkhidden[y].checked==true) {
			  account_idvalue= document.frm_bodyaccount_id_fkhidden.account_accountaccount_id_fkhidden[y].value;
			}       
		  }
		}
//save options*/
function SaveNotificationTypesByGroup(activetable,fieldname,action){
var fieldObj=document.getElementById(fieldname);
var statusObj=document.getElementById('admin_groupnotificationstatus');
var commentsObj=document.getElementById('admin_groupnotificationcomments');
var usergroupObj=document.getElementById('admin_groupnotificationusergroup_id_fkhidden');
  /*alert (usergroupObj.value);
  alert (statusObj.value);
  alert (commentsObj.value);*/
var	notify1	=document.getElementById(activetable+1);
var	notify2	=document.getElementById(activetable+2);
var	notify3	=document.getElementById(activetable+3);
if(notify1.checked==true){notifysave1=notify1.value;}else{notifysave1='NotCheckedToSave';}
if(notify2.checked==true){notifysave2=notify2.value;}else{notifysave2='NotCheckedToSave';}
if(notify3.checked==true){notifysave3=notify3.value;}else{notifysave3='NotCheckedToSave';}
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById('savesectionoptions').innerHTML=xmlHttp.responseText;
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveNotificationType.php?t="+activetable+'&fieldname='+fieldObj.value
+'&notification1='+notifysave1+'&notification2='+notifysave2+'&notification3='+notifysave3+'&action='+action+'&sstatus='+statusObj.value+'&usergroup='+usergroupObj.value+'&comments='
+commentsObj.value,true);
xmlHttp.send(null);
}
/*function saveControlLocation(activetable,fieldname,action,controlname){
var y = document.getElementById('xval');
var x = document.getElementById('yval');
alert (x.innerHTML+'  '+y.innerHTML+controlname);
var fieldnameObj=document.getElementById(activetable+fieldname);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById('shownotificationtype').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveControlPosition.php?t="+activetable+'&fieldname='+fieldname+'&fieldVal='+fieldnameObj.value+'&action='+action,true);
xmlHttp.send(null);
}*/
function showinfGroups(groupcontrol,subgroupcontroller,dispaydiv,action){
   var groupcontrolObj=document.getElementById(groupcontrol);
   var subgroupcontrollerObj=document.getElementById(subgroupcontroller);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(dispaydiv).innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/showGroupINF.php?groupcontrol="+groupcontrolObj.value+'&subgroupcontroller='+subgroupcontrollerObj.value+'&action='+action,true);
xmlHttp.send(null);
}
function saveControlScreenLoc(groupcontrol,subgroupcontroller,tablename, fieldname,fieldtype,fwidth,flength,dispaydiv,action){
	var x = document.getElementById('xval');
    var y = document.getElementById('yval');
	
    var fwidthObj=document.getElementById(fwidth);
   var flengthObj=document.getElementById(flength);
   var groupcontrolObj=document.getElementById(groupcontrol);
   var subgroupcontrollerObj=document.getElementById(subgroupcontroller);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(dispaydiv).innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveDynamicDesignINF.php?groupcontrol="+groupcontrolObj.value+'&subgroupcontroller='+subgroupcontrollerObj.value+'&action='+action+'&tablename='+tablename+'&fieldname='+fieldname+'&fieldtype='+fieldtype+'&fwidth='+fwidthObj.value+'&flength='+flengthObj.value+'&yposition='+y.innerHTML+'&xposition='+x.innerHTML,true);
xmlHttp.send(null);
}

function showInterface(action){
//groupcontrol,subgroupcontroller,tablename, fieldname,fieldtype,fwidth,flength,dispaydiv,
  /*var x = document.getElementById('xval');
   var y = document.getElementById('yval');
   var fwidthObj=document.getElementById(fwidth);
   var flengthObj=document.getElementById(flength);
   var groupcontrolObj=document.getElementById(groupcontrol);
   var subgroupcontrollerObj=document.getElementById(subgroupcontroller);*/
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	

	
		document.getElementById(dispaydiv).innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/saveDynamicDesignINF.php?groupcontrol="+groupcontrolObj.value+'&subgroupcontroller='+subgroupcontrollerObj.value+'&action='+action+'&tablename='+tablename+'&fieldname='+fieldname+'&fieldtype='+fieldtype+'&fwidth='+fwidthObj.value+'&flength='+flengthObj.value+'&yposition='+y.innerHTML+'&xposition='+x.innerHTML,true);
xmlHttp.send(null);
}

///show active accounts
function displayActiveAccounts(displayDiv,action){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById(displayDiv).innerHTML=xmlHttp.responseText;
		
	}
}


xmlHttp.open("GET","http://localhost/formgen/home/displayActiveAccounts.php?displayDiv="+displayDiv+'&action='+action,true);
xmlHttp.send(null);
}

//Save accounts
//save options*/
function SaveAccountReading(accountNumber, displaydiv,action){
var	notify1	=document.getElementById(accountNumber+1);
var	notify2	=document.getElementById(accountNumber+2);
var	notify3	=document.getElementById(accountNumber+3);
var notifysave1=notify1.value;
var notifysave2=notify2.value;
if(notify3.checked==true){notifysave3=notify3.value;}else{notifysave3='Consumption';}
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById(displaydiv).innerHTML=xmlHttp.responseText;
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/displayActiveAccounts.php?action="+action+
+'&notification1='+notifysave1+'&notification2='+notifysave2+'&notification3='+notifysave3+'&accountNumber='+accountNumber,true);
xmlHttp.send(null);
}
function myfillControl(fillid,fillidwith) {
	$('#'+fillid).val(fillidwith);
	
}

function usergroupChange(contrl) {
	var userid=contrl;
	var section=document.getElementById('sectionid').value;
	var currentgroup=document.getElementById('currentgroup').value;
	if(section=='MaingGroups'){
	displayRightsOptions('maingroupinfo','subsequent',userid);
	}
	if(section=='subgroups'){
	displaySubGroupsInfo(currentgroup,'subsectionsdetails');
	}
	if(section=='tablesections'){
	displaySubGroupsTables(currentgroup,'subsectionsdetails');
	}
	if(section=='tablefields'){
	displaySubGroupsTablesFields(currentgroup,'subsectionsdetails');
	}
	   
}

//create top menu and bottom tabs
function viewDetails(currenttable){
var currentscreenVar= currenttable;
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById('filldata').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/menu/mainmenutabs.php?currentscreen="+currentscreenVar,true);
xmlHttp.send(null);
}
function fillthisdiv(){
	currentscreenvar= document.getElementById('currentscreen').value;
	document.getElementById('filldata').innerHTML=currentscreenvar;
}
function showHidConfDIV(divtag,action){
//var suggestionboxObj= document.getElementById(divtag);
if(action=='show'){
	/*suggestionboxObj.style.visibility="visible";
	var indvar='<a href="#" id="viewThis">View</a>&nbsp; &nbsp;
<a href="#" id="ViewTheOptions">Options</a>';
suggestionboxObj.innerHTML=indvar;*/
$('#'+divtag).show();
	}
	if(action=='hide'){
	/*suggestionboxObj.style.visibility="hidden";
	suggestionboxObj.innerHTML='';*/
	$('#'+divtag).hide();
	}
}
//notofications
function saveNotificationDetailsStatus(){
	//saveNotificationDetailsStatus('display','filldata');
    /*var alertidNGS=docucment.getElementById('alertNotificatioID').value;
	var NotificationID=docucment.getElementById('currentNotificatioID').value;*/
	alertidNGS='';
	NotificationID='';
	actionNGS='';
	commentsNGS='';
	currentscreenVar='';
	/*var actionNGS=docucment.getElementById('NGSaction').value;
	var commentsNGS=docucment.getElementById('NGScomments').value;
var currentscreenVar= document.getElementById('currentscreen').value;*/
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById('filldata').innerHTML=xmlHttp.responseText;
		
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/notifyuser.php?action="+actionNGS+'&alertid='+alertidNGS+'&comments='+commentsNGS+'&groupnotificationhistId='+ NotificationID,true);
xmlHttp.send(null);
}
//Customse those settings                                                                                                        
                     
                                                                 
function refreshdiv(){                                           
var xmlHttp= getHttpObj();                                                                                                                             
fetch_unix_timestamp = function()                                
{                                                                
return parseInt(new Date().getTime().toString().substring(0, 10))
}                                                                                                                                
var timestamp = fetch_unix_timestamp();                          
var nocacheurl = url+"?t="+timestamp;                            
xmlHttp.onreadystatechange=function(){                           
if(xmlHttp.readyState==4){                                       
document.getElementById(divid).innerHTML=xmlHttp.responseText;   
//refreshlgs();
setTimeout('refreshdiv()',seconds*1000);                         
}                                                                
}                                                                
xmlHttp.open("GET",nocacheurl,true);                             
xmlHttp.send(null);                                              
} 
var seconds;                                                     
window.onload = function startrefresh(){                         
setTimeout('refreshdiv()',seconds*1000);                         
}       

/////////////////////////////
var seconds = 5;                                                 
var divid = "viewNotifications";                                           
var url = "shownotifications.php";  
function getHttpObj(){
	
	//var xmlHttp;                                                     
			try{                                                             
			return new XMLHttpRequest();    
			}                                                                
			catch (e){                                                       
			try{                                                             
			return new ActiveXObject("Msxml2.XMLHTTP"); 
			}                                                                
			catch (e){                                                       
			try{                                                             
			return new ActiveXObject("Microsoft.XMLHTTP");                  
			}                                                                
			catch (e){                                                       
			alert("Your browser does not support AJAX.");                    
			return null;                                                    
			}                                                                
			}                                                                
			} 
	
	}       
//////
function displayNotifionIntroMsg(){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	//$('#flashnotificationMSG').addClass("showFlashMSG");
	//document.getElementById('flashnotificationMSG').innerHTML=xmlHttp.responseText;
	setTimeout('displayNotifionIntroMsg()',20000);
		
	}
	if (xmlHttp.status == 200) {
					var response=xmlHttp.responseText;	
						if(response!="New Messages Not Available"){
						 
						
						$('#flashnotificationMSG').fadeIn('slow',hideDivBaseTime());
						$('#flashnotificationMSG').addClass("showFlashMSG");
						$('#flashnotificationMSG').removeClass('hideFlashMSG');
						document.getElementById('flashnotificationMSG').innerHTML=xmlHttp.responseText;
						 
						
						}
						else{
						$('#flashnotificationMSG').addClass("hideFlashMSG");
						}
}
}
xmlHttp.open("GET","http://localhost/formgen/home/flashMSG.php",true);
xmlHttp.send(null);
}//////////////////////////////////////

//end of 
///Customer
function hideDivBaseTime(){
	setTimeout("$('#flashnotificationMSG').addClass('hideFlashMSG')",20000);
}
function getCustomerdetails(){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById('Billing').innerHTML=xmlHttp.responseText;
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/newcust.php",true);
xmlHttp.send(null);
}
function getCustomerMeterReadingdetails(){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById('Billing').innerHTML=xmlHttp.responseText;
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/readings.php",true);
xmlHttp.send(null);
}
//sending emails
function sendEmailNotifications(emailfrom,namefrom,mailto,emailsubject,emailbody,displaydiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById(displaydiv).innerHTML=xmlHttp.responseText;
	}
}
xmlHttp.open("GET","http://localhost/formgen/home/sendEmail.php?emailfrom="+emailfrom
			 +'&mailto='+
			 mailto
			 +'&namefrom='
			 +namefrom
			 +'&emailsubject='
			 +emailsubject
			 +'&emailbody='
			 +emailbody,true);
xmlHttp.send(null);
}
//Show reports
function displayPDFReports(){
	var emp= document.getElementById('controllIDOssss').value;
	alert(emp);
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById('updatestatus').innerHTML=xmlHttp.responseText;
	}
}

xmlHttp.open("GET","http://localhost/formgen/reporting/revisedpayslip.php?t="+emp,true);
xmlHttp.send(null);
}

//##########################################################################################################
function disp(elem){
alert("My ID is "+elem);	
	
}
//##########################################################################################################
//Show reports
function displayAvailableReports(displaydiv){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById(displaydiv).innerHTML=xmlHttp.responseText;
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/reporting.php?",true);
xmlHttp.send(null);
}
//Display options
function displayConfigOptions(currenttable){
sortColumn='position';
displayDiv='filldata';
currentTable=currenttable;
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	
fdata=document.getElementById('postdata');
	
		document.getElementById('filldata').innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/options.php?t="+currentTable+'&displayDiv='+displayDiv+'&sortColumn='+sortColumn,true);
xmlHttp.send(null);
}
function resetForm(formname){
document.formname.reset();
}

function fillSpanfnc(fillidwith,spanid,spanaction) {
	if(spanaction=='fill'){
	var currentvalue=document.getElementById(spanid).value;
	$('#'+spanid).val(fillidwith+' '+currentvalue);
	}
	
	if(spanaction=='clear'){
	
	$('#'+spanid).val('');
	}
}
function runSaveFunctions(savecontrolid) {
	var currentvalue=document.getElementById(savecontrolid).value;
	var arrayResults=currentvalue.split('|');
	saveRightsAssignment(arrayResults[0],arrayResults[1],arrayResults[2],arrayResults[3]);
	
}

////////////////Loans
function calculateLoanInfo(){
	
	var loanid =document.getElementById('loans_emploanloan_id_fkhidden').value;
	var loanamount =document.getElementById('loans_emploanloan_amount').value;
	var period =document.getElementById('loans_emploanrepayment_period').value;
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
			document.getElementById('loaninfo').innerHTML=xmlHttp.responseText;
		
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/loaninfo.php?loanid="+loanid+'&period='+period +'&loanamount='+loanamount,true);
xmlHttp.send(null);
}
function clearUpdateClient(activetable){
	      
			var dialoghtml=document.getElementById('updateclient'+activetable);
			dialoghtml.innerHTML='';
			
			$('#updateclient'+activetable).addClass("ERR");
			
			}
function resetform(){
	
	document.getElementById('datafilledform').reset();
}
function displayPhotoUpload(){
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

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
	document.getElementById('HR').innerHTML=xmlHttp.responseText;
	}
}

xmlHttp.open("GET","http://localhost/formgen/home/photopage.php",true);
xmlHttp.send(null);
}