<?php
   
    include('../db_connections/aardb_conn.php');
	include('../functions/functions.php');
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Language" content="English" />
	<meta name="Distribution" content="Global" />
	<meta name="Author" content="nabuso team (info@nabuso.com)" />
	<meta name="Robots" content="index,follow" />
	<meta name="Description" content="Vam" />
	<meta name="Keywords" content="pmas, vam, kaizen, nabuso" />
	<link rel="stylesheet" type="text/css" href="../images/style.css" />
	<link rel="stylesheet" href="../images/dtpicker.css" type="text/css" />
<script language="JavaScript" src="../js/dtpicker.js"></script>
	<title>Agency-Tender</title>
    <style type="text/css">
<!--
.style2 {
	color: #003300;
	font-weight: bold;
}
.style3 {color: #3C6491}
-->
    </style>
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
			<a href="../index.php">Home</a><a href="agency.php">Agency</a><a href="agency.php">Marketing</a><a href="../valuation/valuation.php">Valuation</a><a href="msglogs.php">Alert Logs </a>		</div>
	</div>
		
	<div class="content">
		<div id="articles">
			<div id="left">
				<table width="100%" border="0">
  <tr>
    <td><form  action="processsignup.php" method="post" enctype="multipart/form-data">
 				
				  <div align="left" class="style26">
				  <div align="left">
				  <div align="left">
				  <div align="left">
				  <table width="100%" border="0">
  	<tr>
    <td colspan="2"><strong>Sign Up Form</strong></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td width="24%">Username  : </td>
    <td width="76%"><label>
      <input name="username" type="text" id="username" />
    </label></td>
  </tr>
  <tr>
    <td>Real Names    : </td>
    <td><label>
      <input name="realnames" type="text" id="realnames" />
    </label></td>
  </tr>
  <tr>
    <td>Password  : </td>
    <td><input name="password" type="text" id="password"></td>
  </tr>
    <tr>
    <td>Confirm Password: </td>
    <td><label>
      <input name="confpassword" type="text" id="confpassword" />
    </label></td>
    </tr>
	<tr>
    <td>Email Address: </td>
    <td><label>
      <input name="email1" type="text" id="email1" />
    </label></td>
    </tr>
  <tr>
    <td>Confirm Email: </td>
    <td><label>
      <input name="email2" type="text" id="email2" />
    </label></td>
  </tr>
  
   <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
	</table>
<p align="right">
<input tabindex="19" name="add" id="add"  value="Sign Up" title="" border="0" type="submit">
 <input tabindex="20" name="acancel" id="acancel"  value="Cancel" title="" border="0" type="reset">
			  </p>
</form></td>
  </tr>
</table>			
			</div>
			
			<div id="right">
				<div id="rightmenu">
		<a href="agency.php">Events </a><a href="tender.php">Tendering </a>	<a href="agency.php">News </a><a href="income.php">Revenue </a><a href="enquiry.php">Enquries </a><a href="view.php">Viewings </a><a href="sale.php">For Sale </a><a href="tolet.php">To Let </a><a href="<?php 
$ptyp=base64_encode('1');
echo"vacant.php?type=$ptyp";
?>">Vacant Units</a><a href="<?php 
$ptyp=base64_encode('1');
echo"expiry.php?type=$ptyp";
?>">Lease Expiry</a>
					<div id="searchform">
						<form method="post" class="search" action="">
					  </form>
					</div>
			  </div>
				
				<div class="rightarticle">
				  
				</div>					
				
				<div class="rightarticle">
					
				<div >
					
				</div>
			</div>
		</div>
		<div id="links">
		 <?php
		$sqlquote="select Max(quoteid) as max1 from quote";
		$resultqt=mysql_query($sqlquote, $db_conn);
		$rowqt=mysql_fetch_array($resultqt);
		$max=$rowqt['max1'];
		$val=rand(1,$max);
		
		#actual fecth of the quote
		
		$sqlq="select * from quote where quoteid=$val";
		$resultq=mysql_query($sqlq, $db_conn);
		$rowq=mysql_fetch_array($resultq);
		 
		?>
		  <p><b>Quote of the day: </b><?php echo"$rowq[description] - $rowq[reference]"; ?></p>

	</div>
	</div>

	<div id="additional">
		<p></p>
	</div>
		
	<div id="whiteline"></div>

	<div id="footer">
		<p style="float: left;"><a href="#">Home</a><img src="../images/separator.gif" alt="" /><a href="#">Agency</a>
		<br />
		<a href="http://jigsaw.w3.org/css-validator/check/referer">Marketing</a> and <a href="http://validator.w3.org/check?uri=referer">Valuation</a><img src="../images/separator.gif" alt="" /><a href="#">Email</a></p>
		<p style="float: right; text-align: right;"><a href="#">Contact Us</a><br />
		&copy; Copyright 2010, <a href="#" title="Kaizen solutions">Kaizen Solutions Ltd</a><img src="../images/separator.gif" alt="" />Design: Kaizen Team, <a href="http://www.nabuso.com/">nabuso team</a></p>
	</div>
</body>	
</html>