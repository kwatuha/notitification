<?php
include('../db_connections/aardb_conn.php');
if(!isset($_POST['add'])){
header('location:signup.php');
}
else{
$errors='';
if(empty($_POST['username'])){
$errors=$errors." Missing username!<br/>";
}

if(empty($_POST['realnames'])){
$errors=$errors." Real names required!<br/>";
}
if(empty($_POST['password'])){
$errors=$errors." Password required!<br/>";
}

if(empty($_POST['confpassword'])){
$errors=$errors." Confirm your password!<br/>";
}

if(empty($_POST['email1'])){
$errors=$errors." Email Address required!<br/>";
}
if(empty($_POST['email2'])){
$errors=$errors." Confirm your Email Address!<br/>";
}
if(!ctype_alnum($_POST['username'])){
$errors=$errors." Username should contain alphanumeric chars only!<br/>";
}
if(strlen($_POST['username'])<5){
$errors=$errors." Username must be of 5 and above characters!<br/>";
}

$username=mysql_real_escape_string($_POST['username']);
$realnames=mysql_real_escape_string($_POST['realnames']);
$password=mysql_real_escape_string($_POST['password']);
$confpassword=mysql_real_escape_string($_POST['confpassword']);
$email1=mysql_real_escape_string($_POST['email1']);
$email2=mysql_real_escape_string($_POST['email2']);
$statement="SELECT * FROM events";

//$statement="SELECT username FROM users_tbl WHERE username=$username";
$query=mysql_query($statement) or die("ERROR: ".mysql_error());
$results=mysql_fetch_array($query);
$num_rec=mysql_num_rows($results);
if($num_rec>0){
$errors=$errors." Username already in use! Choose a different one<br/>";
}
if($password!=$confpassword){
$errors=$errors." The two Passwords don't match!!<br/>";
}
if($email1!=$email2){
$errors=$errors." The two Emails don't match!!<br/>";
}

if(empty($errors)){

}
else{
echo "<font face='Verdana' size='2' color=red>$errors</font><br><input type='button' value='Retry' onClick='history.go(-1)'>";

}
}


 ?>