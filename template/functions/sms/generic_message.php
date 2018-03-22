<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//intellib_
$ts="o1233";
// Gmail username
// $hostname_c4g = "localhost";
// $username_c4g = "Kitale";
// $password_c4g = "Admin2010@#";
// $database_c4g = "ktldb2017";
//  $_SESSION['voideindb']=$database_c4g ;
// $c4g = mysql_pconnect($hostname_c4g, $username_c4g, $password_c4g) or trigger_error(mysql_error(),E_USER_ERROR); 
// mysql_select_db($database_c4g, $c4g);


getMessageConfig();
function getMessageConfig($messageTypeId,$message){
   $tz= inputColumns;
   if($messageType){
        $data=fillPrimaryData('sms_smsmsgcust',$messageTypeId);
        $messageTmp= $data['message'];
        echo  $tz[0];

   }



// if($messageType){
//                     $smsArrayDetails=fillPrimaryData('sms_smsmsgcust',$messageType);
//     				    $mesage=$smsArrayDetails['message'];
//           				$mesage=str_replace('{connectionID}',$connection_number,$mesage);
//           				$message=str_replace('{amount}',$amount,$mesage);
//           				$message=str_replace('{disconnectionDate}',$billdate,$message);
// 					   	$message=str_replace('{Prev_Reading}',$prevReading,$message);
//           				$message=str_replace('{Curr_Reading}',$currReading,$message);
//           				$message=str_replace('{Consumption}',$consumption,$message);
//                         $message=str_replace('{bill_date}',$billdate,$message);
//         }
// 		return $message;


 return $message;
}

function customizeMessage($message,$dataRow){
            

            foreach (inputColumns as $key => $value){

                if($value){
                  $message=str_replace('{'.$value.'}',$dataRow[$key],$message);
                }              

            }
return $message;
}

function colDefinition($dataRow){
    $colDefs=array();
    $colCnt=0;
    foreach($dataRow as $column){
        if($column){
            $colDefs[$colCnt]=$column;
          }
      $colCnt++;
    }
    define('inputColumns', $colDefs); 

}

function insertMsg($table,$message,$phoneNumber){
    $message=mysql_real_escape_string($message);
    $phoneNumber=mysql_real_escape_string($phoneNumber);
    $created_by= $_SESSION['my_useridloggened'];
    $date_created=date('Y-m-d');
    $uuid=gen_uuid();

    $insertSQl= "Insert into $table (phone_number,message,date_created,created_by,voided,sys_track,uuid) values
                        ('$phoneNumber','$message','$date_created','$created_by','$voided','$sys_track','$uuid')";

	$Result1 = mysql_query($insertSQl) or die($insertSQl);

}




?>
