<?php
    include('menuLinks.php');
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Language" content="English" />
	<meta name="Distribution" content="Global" />
	<meta name="Author" content="Intellibiz Africa team (info@intellibizafrica.com)" />
	<meta name="Robots" content="index,follow" />
	<meta name="Description" content="PHIMIS" />
	<meta name="Keywords" content="Property Management,Insurance Systems, Intelligent Solutions" />
	<link rel="stylesheet" type="text/css" href="images/style.css" />
	<link rel="stylesheet" href="images/dtpicker.css" type="text/css" />
	
<script language="JavaScript" src="js/dtpicker.js"></script>
<!-- TemplateBeginEditable name="doctitle" -->
<title>Call Logs</title>
<!-- TemplateEndEditable -->
<style type="text/css">
<!--
.style2 {
	color: #003300;
	font-weight: bold;
}
.style3 {color: #3C6491}
-->
    </style>
    <link href="template/themes/Smart/css/style.css" rel="stylesheet" type="text/css" />
    <!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
</head>
<body>
	<div id="header">
		<div id="logo">
			<p class="slogan"></p>
			<div style="float: left;">
				<h1><a href="#">VAM</a></h1>
			</div>
	  </div>
		<div id="hmenu"><!-- TemplateBeginEditable name="TopMenuRegion" --><?php echo $topmenuDetails['mainTop'];?><!-- TemplateEndEditable --></div>
	</div>
		
	<div class="content">
		<div id="articles">
			<div id="left_pannel">
				<table width="100%" border="0">
  <tr>
    <td><!-- TemplateBeginEditable name="dataRegion" -->Ixxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx<!-- TemplateEndEditable -->
      <p>hhhh</p></td>
  </tr>
</table>			
			</div>
			
			<div id="right_pannel">
				<div id="rightmenu"><!-- TemplateBeginEditable name="RightMenu_details" --><?php echo($rightmenu['mainPaged']); ?><!-- TemplateEndEditable -->
					<div id="searchform">
						<form method="post" class="search" action="">
					  </form>
					</div>
			  </div>
				
				<div class="rightarticle">
				  <table width="100%" border="0">
				  <tr>
                      <td  colspan=4  >You are logged in as <u><strong><?php //echo($_SESSION['my_username'])?></strong></u></td>
					</tr>
				<tr>
                      <td  colspan=4  ><div align="right" class="style9"><a href="logs/logout.php">Log Out</a></div></td>
					</tr>	
				  <tr>
                      <td  colspan=4 background="images/seoad.jpg" class="style3 style6" ><strong>Call Logs </strong></td>
					</tr>
                    <tr>
					  <td  ><span class="style3">Caller</span></td>
                      <td  ><span class="style3">Message</span></td>
					  <td  ></td>
                      <td  ></td>
				    </tr>
					  <tr>
                      <td  colspan=4><hr></td>
                      </tr>
					<?php
					
  /*$sql="SELECT logid, caller, left(description, 40) as descr FROM msglog where recipient=$_SESSION[userid] AND readStatus=0 limit 5";
	       $result = mysql_query($sql,$db_conn);
						
			while($row = mysql_fetch_array($result))
			{
             
			  echo"<tr>";
              echo"<td>$row[caller]</td>";
              echo"<td>$row[descr]</td>";
			  echo"<td><a href=\"vmsglogs.php?logid=$id\">Read</a></td>";
              echo"<td><a href=\"replycall.php?logid=$id&userid=$userid\">Reply</a></td>";
              echo"</tr>";
			 
			 } */
            ?>  
			     <tr>
                 <td  colspan=4><hr></td>
                 </tr>
				 </table>
				</div>					
				
				<div class="rightarticle">
					<table width="100%" border="0">
					<tr>
                      <td  colspan=4 background="images/seoad.jpg" class="style3 style6" ><strong>Reminders.</strong></td>
					</tr>
                    <tr>
                      <td  ><span class="style3">Posted by </span></td>
                      <td  ><span class="style3">Message</span></td>
					  <td  ></td>
                      <td  ></td>
					  </tr>
					  
					<?php
					
  /*$sql="SELECT logid, caller, left(description, 40) as descr FROM msglog where recipient=$_SESSION[userid] AND readStatus=0 limit 5";
	       $result = mysql_query($sql,$db_conn);
						
			while($row = mysql_fetch_array($result))
			{
             
			  echo"<tr>";
              echo"<td>$row[caller]</td>";
              echo"<td>$row[descr]</td>";
			  echo"<td><a href=>Hide</a></td>";
              echo"<td><a href=>Reply</a></td>";
              echo"</tr>";
			 
			 } 
           */ ?>  
			     <tr>
                 <td  colspan=4><hr></td>
                 </tr>
				 </table>
				</div>
			
				<div >
					
				</div>
			</div>
		</div>
		<div id="links">
		 <?php
		/*$sqlquote="select Max(quoteid) as max1 from quote";
		$resultqt=mysql_query($sqlquote, $db_conn);
		$rowqt=mysql_fetch_array($resultqt);
		$max=$rowqt['max1'];
		$val=rand(1,$max);
		
		#actual fecth of the quote
		
		$sqlq="select * from quote where quoteid=$val";
		$resultq=mysql_query($sqlq, $db_conn);
		$rowq=mysql_fetch_array($resultq);
		*/ 
		?>
		  <p><b>Daily Reflection : </b><?php // echo"$rowq[description] - $rowq[reference]"; ?></p>

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
		&copy; Copyright 2010, <a href="#" title="Kaizen solutions">Intellibiz Africa Solutions Ltd</a><img src="images/separator.gif" alt="" />Design: Intellibiz Africa Team, <a href="http://www.intellibizafrica.com/">Intellibiz Africa team</a></p>
	</div>
</body>	
</html>