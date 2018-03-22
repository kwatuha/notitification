<?php
// tasks/backupTasks.php

//vendor/bin/crunz schedule:run
use Crunz\Schedule;

$schedule = new Schedule();

$schedule->run( function() {
               
               $hostname_c4g = "localhost";
                $username_c4g = "Kitale";
                $password_c4g = "Admin2010@#";
                $database_c4g = "ktldb2017";
                $_SESSION['voideindb']=$database_c4g ;
                $c4g = mysql_pconnect($hostname_c4g, $username_c4g, $password_c4g) or trigger_error(mysql_error(),E_USER_ERROR); 
                mysql_select_db($database_c4g, $c4g);
                $message= " Message created at  " . date("Y-m-d:hh:mm:ss") ;
                insertMsg('sms_msgqueue',$message,'070121122112');


        } )
        ->description( 'Test task running every minute' )
        ->everyFiveMinutes();

return $schedule;

?>

<?php
// $date = date_create();
// echo date_format($date, 'U = Y-m-d H:i:s') . "\n";

// date_timestamp_set($date, 1171502725);
// echo date_format($date, 'U = Y-m-d H:i:s') . "\n";


function insertMsg($table,$message,$phoneNumber){
    $message=mysql_real_escape_string($message);
    $phoneNumber=mysql_real_escape_string($phoneNumber);
    $created_by= 14;//$_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
    $uuid=112;//gen_uuid();
    $sys_track='1223';
    $voided="0";
    $insertSQl= "Insert into $table (phone_number,message,date_created,created_by,voided,sys_track,uuid) values
                        ('$phoneNumber','$message','$date_created','$created_by','$voided','$sys_track','$uuid')";

	$Result1 = mysql_query($insertSQl) or die($insertSQl);

}


?>