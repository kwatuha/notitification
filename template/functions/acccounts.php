
<?php

function insertCashTransaction(){
$cashtrans_name=$_POST['accountactivity_name'];
$accountscategory_id=$_POST['accountscategory_id'];
$currency_id=$_POST['currency_id'];
$debit=$_POST['debit'];
$credit=$_POST['credit'];
$credit=$_POST['amount'];

$countraccountscategory_id=$_POST['countraccountscategory_id'];
$posttype=$_POST['accountactivity_name'];
$naration=$_POST['naration'];
$accaccount_id=$_POST['accaccount_id'];
$created_by="'".$_SESSION['my_useridloggened']."'";
$date_created=date('Y-m-d');

$insertStr="INSERT INTO accounts_cashtrans(accaccount_id,cashtrans_name,accountscategory_id,currency_id,debit,credit,naration,transaction_date,created_by,date_created,uuid) VALUES ('$accaccount_id','$cashtrans_name','$accountscategory_id','$currency_id','$debit','$credit','$naration','$transaction_date','$created_by','$date_created','$uuid')'"
return $insertStr;
}


?>