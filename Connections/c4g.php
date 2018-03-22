<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//intellib_
$hostname_c4g = "localhost";
$username_c4g = "Kitale";
$password_c4g = "Admin2010@#";
$database_c4g = "ktldb2017";
 $_SESSION['voideindb']=$database_c4g ;
$c4g = mysql_pconnect($hostname_c4g, $username_c4g, $password_c4g) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_c4g, $c4g);
?>
