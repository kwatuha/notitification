<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cf4_HH = "localhost";
$username_cf4_HH = "Kitale";
$password_cf4_HH = "2010@#";
$database_cf4_HH = "impact_ksm";
$_SESSION['voideindb']=$database_cf4_HH;
$cf4_HH = mysql_pconnect($hostname_cf4_HH, $username_cf4_HH, $password_cf4_HH) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_cf4_HH);
?>