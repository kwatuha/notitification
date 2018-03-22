<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript">
function lookup(inputString) {
alert('Working');
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("rpccompany_employee.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup

function fill_employee_id(thisValue) {
	
    $('#inputString').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="jquery-1.2.1.pack.js" type="text/javascript"></script>
<script src="check.js" type="text/javascript"></script>
<link href="format.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<div>


       <div>

      Enter your string search
<input size="30" id="inputString" onkeyup="lookup(this.value);" type="text" />

    </div>      <div class="suggestionsBox" id="suggestions" style="display: none;">

      

      <div class="suggestionList" id="autoSuggestionsList">

</div>

    </div>

</div>
</body>
</html>
