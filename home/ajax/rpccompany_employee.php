<?php  include('../Connections/cf4_HH.php');
 if(isset($_POST['queryString'])) {
   			$queryString = trim($_POST["queryString"]); 
   				if(strlen($queryString) >0) {
   					 $query = "SELECT  employee_name , employee_id FROM  company_employee WHERE    employee_name LIKE '$queryString%' order by  employee_name LIMIT 10 ";
					echo  $query;
   					 $result = mysql_query($query) or die("There is an error in database please contact support@intellibizafrica.com");
     					while($row = mysql_fetch_array($result)){
						
     						echo "<li onClick=\"fill_employee_id('$row[employee_name]'); fill_hiddenemployee_name('$row[employee_id]')\"> $row[employee_id]  $row[employee_name] </li>";                                       
      						}
   }
   }
   echo "WWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW";
   ?>