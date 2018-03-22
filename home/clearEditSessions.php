<?php
$sessionName=trim($_GET['ActiveSession']);
clearEditSessisions($sessionName);
function clearEditSessisions($sessionName){
$_SESSION[$sessionName]='';
}
?>