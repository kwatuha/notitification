@echo OFF
"c:\xampp\php\php.exe" C:\xampp\htdocs\impact\Connections\remote_statistics.php %*

<?php
$WshShell = new COM("WScript.Shell");
$oExec = $WshShell->Run("cmd /C C:\xampp\htdocs\Test\FollowTrackerV2\followers.bat", 0);
 // 0 invisible / 1 visible