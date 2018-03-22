<script language="javascript">
function lookup(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("rpc.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup


function lookup_advance(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("rpc_requests.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup advance

function lookup_advance_approval(inputString) {
    if(inputString.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("rpc_advance_approval.php", {queryString: ""+inputString+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup

function fill_emp_num(thisValue) {
	
    $('#emp_num').val(thisValue);
	
	
   $('#suggestions').hide();
}

function fill_advance_num(thisValue) {
	
    $('#advance_num').val(thisValue);
	
	
   $('#suggestions').hide();
}

/*function amount_paid     (thisValue){  $('#amount_paid     ').val(thisValue); $('#suggestions').hide();}*/
function fill_amount_approved (thisValue){ 
 $('#amount_approved').val(thisValue); 
 $('#suggestions').hide();
 }
function fill_amount_requested(thisValue){
  $('#amount_requested').val(thisValue);
   $('#suggestions').hide();
   }
function fill_requested_period(thisValue){
  $('#requested_period').val(thisValue);
   $('#suggestions').hide();
   }
function fill_approved_period (thisValue){ 
 $('#approved_period').val(thisValue);
  $('#suggestions').hide();
  }
                                                                                                        

function fill(thisValue) {
	
    $('#inputString').val(thisValue);
	
	
   $('#suggestions').hide();
}

</script>

//Run
<?php
include('../Connections/connection.php');
 if(isset($_POST['queryString'])) {
   			$queryString = trim($_POST["queryString"]); 
   				if(strlen($queryString) >0) {
   					 $query = "SELECT emp_number, employee_id , emp_lastname , emp_firstname  , emp_middle_name FROM hs_hr_employee WHERE  emp_lastname LIKE '$queryString%' order by  emp_lastname LIMIT 10 ";
					
   					 $result = mysql_query($query) or die("There is an error in database please contact support@intellibizafrica.com");
     					while($row = mysql_fetch_array($result)){
						
     						echo "<li onClick=\"fill('$row[employee_id]  $row[emp_lastname] $row[emp_middle_name] $row[emp_firstname]'); fill_emp_num('$row[emp_number]');\"> 	 $row[employee_id] $row[emp_lastname] $row[emp_middle_name] $row[emp_firstname]</li>";                                       
      						}
   }
   }
?>
///end rpc
<?php print_ajax_search_box();?>

<?PHP 
					print_ajax_emp_search();
					
					?>
<input type="hidden" id="emp_num" name="emp_num" value="" size="32" />
<?php
function print_ajax_emp_search(){
print"<input size=\"30\" id=\"inputString\" name=\"emp_number\" onkeyup=\"lookup(this.value);\" type=\"text\" />";
}	
 
function print_ajax_emp_search_print(){
print"<div class=\"suggestionsBox\" id=\"suggestions\" style=\"display: none;\">
 <div class=\"suggestionList\" id=\"autoSuggestionsList\">
 </div>";
 
 }
 ?>                   