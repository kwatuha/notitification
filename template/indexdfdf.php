<?php
 
   include('db_connections/aardb_conn.php'); 

  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Language" content="English" />
	<meta name="Distribution" content="Global" />
	<meta name="Author" content="Luka Cvrk (luka@solucija.com)" />
	<meta name="Robots" content="index,follow" />
	<meta name="Description" content="Internet Jobs" />
	<meta name="Keywords" content="internet, jobs, business, online, marketing" />
	<link rel="stylesheet" type="text/css" href="images/style.css" />
	<title>Home - VAM</title>
	
    <style type="text/css">
<!--
.style3 {color: #996666; font-weight: bold; }
-->
    </style>
    
	
    <link href="themes/Smart/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="header">
		<div id="logo">
			<p class="slogan"></p>
			<div style="float: left;">
				<h1><a href="#">VAM</a></h1>
			</div>
	  </div>
		<div id="hmenu">
			<a href="index.php">Home</a><a href="agency/agency.php">Agency</a><a href="agency/agency.php">Marketing</a><a href="valuation/valuation.php">Valuation</a><a href="agency/msglogs.php">Alert logs</a>		</div>
	</div>
		
	<div class="content">
		<div id="articles">
			<div id="left_pannel">
				<h2><a href="#">Events Calendar. </a></h2>
				<?php
				
	  	  
			?>
      
<p class="date"><img src="images/comment.gif" alt="" /> <a href="
<?php 

?>">Year</a>
<img src="images/comment.gif" alt="" /> <a href="
<?php 

?>">Month</a> 
<img src="images/timeicon.gif" alt="" /> &nbsp;<?php echo date("F  Y ");?></p>
				
					
				<h2><a href="#">News.</a></h2>
				<?php
				
	  	 	
				?>
				<p class="date"> <img src="images/timeicon.gif" alt="" /> <?php echo date("F  Y ");?></p>
				
				
							
			</div>
			
			<div id="right_pannel">
				<div id="rightmenu">
					<div id="searchform">
						<form method="post" class="search" action="logs/checklogin.php">
							<p><table width="100%" height="100%" border="0">
            <tr>
            <td width="39%" height="37"><div align="left">User ID:</div></td>
            <td width="61%" class="formInputText"><input id="email" name="email" class="text" maxlength="64" value=""  type="text"></td>
          </tr>
          <tr>
            <td height="34">
              <div align="left">Password:</div></td>
            <td class="formInputText"><input id="password" name="password" class="text" maxlength="16"  type="password"></td>
          </tr>
          <tr>
            <td></td>
            <td><table width="100%" border="0">
                <tr>
                  <td><input type="submit"  class="button" name="Signin"  value="Sign in"/></td>
                </tr>
            </table></td>
          </tr>
        </table></p>
  						</form>
					</div>
				</div>
				
				<div class="rightarticle">
					<p></p>
				</div>					
				
				<div class="rightarticle">
					<p>
						
					</p>
				</div>
			
				
			</div>
		</div>
		<div id="links">
		<?php
		
		 
		?>
		<p><b>Quote of the day: </b><?php  ?></p>
	</div>
	</div>

	<div id="additional">
		<p></p>
	</div>
		
	<div id="whiteline"></div>

	<div id="footer">
		<p style="float: left;"><a href="#">Home</a><img src="images/separator.gif" alt="" /><a href="#">Agency</a>
		<br />
		<a href="http://jigsaw.w3.org/css-validator/check/referer">Marketing</a> and <a href="http://validator.w3.org/check?uri=referer">Valuation</a><img src="images/separator.gif" alt="" /><a href="#">Email</a></p>
		<p style="float: right; text-align: right;"><a href="#">Contact Us</a><br />
		&copy; Copyright 2010, <a href="#" title="Kaizen solutions">Kaizen Solutions Ltd</a><img src="images/separator.gif" alt="" />Design: Kaizen Team, <a href="http://www.nabuso.com/">nabuso team</a></p>
	</div>
</body>	
</html>