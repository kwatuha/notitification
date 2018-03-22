<?php

//open
print"<div id=\"firstpane\" class=\"menu_list\"> <!--Code for menu starts here-->";
		
		
		//for each new group
		print"<p class=\"menu_head\">".$HeaderTag."</p>"."<div class=\"menu_body\">"
		print"<div id=\"".$activemenu."\"></div></div>";
		//end of each group
		
		
		//last close
  print"</div>  <!--Code for menu ends here-->";
  
?>
<p>
	<p>
	<div id="firstpane" class="menu_list"> <!--Code for menu starts here-->
		<p class="menu_head">Header-1</p>
		     <div class="menu_body">
		     <div id="activemenu"></div>
		      </div>
		<p class="menu_head">Header-2</p>
		<div class="menu_body">
			<a href="#">Link-1</a>
         <a href="#">Link-2</a>
         <a href="#">Link-3</a>	
		</div>
		<p class="menu_head">Header-3</p>
		<div class="menu_body">
          <a href="#">Link-1</a>
         <a href="#">Link-2</a>
         <a href="#">Link-3</a>			
       </div>
	   
	   

<?php //open
if($processedtable==''){
print"<div id=\"firstpane\" class=\"menu_list\"> <!--Code for menu starts here-->";
}else{
if($processedtable!=$row_Rcd_menu["displaygroup"]){

		//for each new group displaygroup
		print"<p class=\"menu_head\">".$row_Rcd_menu["displaygroup"]."</p>"."<div class=\"menu_body\">";
		print"<div id=\"".$activemenu."\"></div></div>";
		//end of each group
} else{
	echo("<a href=\"#"."\" onclick=\"loadActiveTableAddDetails('".$active_tbl_php."','".$fld."')\""." >");
	echo($row_Rcd_menu["tablecaption"]);
	echo("</a>");

}
}
		
		
		
  ?>