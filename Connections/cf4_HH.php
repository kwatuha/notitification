<?php
$GLOBALS['hostname_cf4_HH'] = "localhost";
$GLOBALS['username_cf4_HH'] = "sadmins";
$GLOBALS['password_cf4_HH'] = "Admin2010@#";
$GLOBALS['database_cf4_HH'] = "impactdb";
 $GLOBALS['emrpath'] = "E:\Project\SMS\UGUNJA\IRDOv1_MBITA_KP_be.mdb" ;
$_SESSION['voideindb']=$GLOBALS['hostname_cf4_HH'];
$cf4_HH = mysql_pconnect($GLOBALS['hostname_cf4_HH'], $GLOBALS['username_cf4_HH'], $GLOBALS['password_cf4_HH']) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($GLOBALS['database_cf4_HH']);
?>