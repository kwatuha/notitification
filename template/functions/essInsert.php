<?php 
//initialize leave_request
$employee_id=$_SESSION['my_username_id'];
if (isset($_POST["submit_leave_request"])) {

Insert_leave_request_Stmt  ();

}

function Insert_leave_request_Stmt  (){

if (isset($_POST["submit_leave_request"])) {


			// Defining Variables for leave_request Insert SQL Statement 
			
				$request_id=$_POST['request_id'];
				
				
				$approval_status='Pending Approval';
				
				
				$status=$_POST['requeststus'];
				
				
			
			$employee_id=$_SESSION['my_username_id'];
			
			
			  $leave_id=$_POST['leave_idhidden'];
						
				$requested_duration=$_POST['requested_duration'];
				
				
				$request_comment=$_POST['request_comment'];
				
				
				$date_requested=$_POST['date_requested'];
				
				
				$leave_started='';
				
				
				$approval_date='';
				
				
				$approved_by='';
				
				
				$approved_duration='';
				
				
				$approval_comment="";
				
				
				$return_date="";
				
				
				$return_comment="";
				
				if($_POST["leave_idhidden"]==''){
				$leave_id=$_SESSION["rowFndleave_id"];
				}else
				{$_SESSION["rowFndleave_id"]=$leave_id;}
				

$insertSQLleave_request = "INSERT INTO leave_request VALUES ( 
' ','$approval_status','$status','$employee_id','$leave_id','$requested_duration','$request_comment','$date_requested','$leave_started','$approval_date','$approved_by','$approved_duration','$approval_comment','$return_date','$return_comment')";
			
			// END of Insert SQL Statement for leave_request
			
$_SESSION["rowFndrequest_name"]= $request_name;
$Result1 = mysql_query($insertSQLleave_request) or die(mysql_error());

$qry="select max(request_id) as 'LastPrimaryId' from  leave_request";
$rows = mysql_query($qry) or die(mysql_error());

while ($resultId=mysql_fetch_array($rows))
{
$_SESSION["rowFndrequest_id"]= $resultId['LastPrimaryId'];
}

} //End If<br>
} //End function insert


//END  of the Insert process for leave_request

//********** Starting  Insert Statements  Tablepim_dept***********************


//initialize pim_dept


if (isset($_POST["submit_attendance_attendance"])) {

Insert_attendance_attendance_Stmt  ();

}

function Insert_attendance_attendance_Stmt  (){

if (isset($_POST["submit_attendance_attendance"])) {


			// Defining Variables for attendance_attendance Insert SQL Statement 
			
				$attendance_id=$_POST['attendance_id'];
				
				
			
			$employee_id=$_SESSION['my_username_id'];
			
			
				$time_in=$_POST['time_in'];
				
				
				$time_out=$_POST['time_out'];
				
				
				$comment=$_POST['comment'];
				
				
				$effective_date=$_POST['effective_date'];
				
				

$insertSQLattendance_attendance = "INSERT INTO attendance_attendance VALUES ( 
' ','$employee_id','$time_in','$time_out','$comment','$effective_date')";
			
			// END of Insert SQL Statement for attendance_attendance
			
$_SESSION["rowFndattendance_name"]= $attendance_name;
$Result1 = mysql_query($insertSQLattendance_attendance) or die(mysql_error());

$qry="select max(attendance_id) as 'LastPrimaryId' from  attendance_attendance";
$rows = mysql_query($qry) or die(mysql_error());

while ($resultId=mysql_fetch_array($rows))
{
$_SESSION["rowFndattendance_id"]= $resultId['LastPrimaryId'];
}

} //End If<br>
} //End function insert


//END  of the Insert process for attendance_attendance

?>