<?php
$server='localhost';
$database='testdb';
$user='root';
$pwd='';

$connect=mysql_connect($server,$user,$pwd) or die('Cannot connect to the server! Troubleshoot and try again');
$db_handle=mysql_select_db($database,$connect) or die('Cannot select database! Troubleshoot and try again');

 ?>