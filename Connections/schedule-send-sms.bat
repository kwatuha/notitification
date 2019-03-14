@echo OFF
setlocal EnableDelayedExpansion
set i=1
set "x=%~dp0"
set "x!i!=%x:htdocs=" & set /A i+=1 & set "x!i!=%"
set x>null
"%x1%php\php.exe" %x1%htdocs\impact\Connections\sendbatch.php %*
