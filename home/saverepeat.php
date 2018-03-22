<?php
$i=3;
$arr='';
do 
{
$i=+2;
$arr[$i]=$_POST['item_name'.$i];

echo $_POST['item_name'.$i];
}
while($_POST['item_name'.$i]!='');




?>