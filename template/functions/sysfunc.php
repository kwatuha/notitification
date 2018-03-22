<?php 
buildlangfileRSVInsertsPlus('zulm');
function buildlangfileRSVInsertsPlus($dbinuse){													
    $sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
//print "<input type=\"text\" name=\"num_found_contacts\" value=\"$cntreg\">";                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
	echo '//********** Starting  Insert Statements  Table'.$table_name.'***********************<p><br>';  
	
echo'//initialize '."$table_name <p>";
print 'if (isset($_POST["submit_'.$table_name.'"])) {'."<p>";
echo 'Insert_'. $table_name.'_Stmt  ();';
print'}'."<p>";

print 'function Insert_'. $table_name.'_Stmt  (){'."<p>";	
print 'if (isset($_POST["submit_'.$table_name.'"])) {'."<p>";

///////////////////Build post functionalities
	
	$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			echo "<p>". '// Defining Variables for '.$table_name.' Insert SQL Statement '."<p>";
			while($count_cls=mysql_fetch_array($results_tbc)){
			
			//echo '$'."_POST['".$count_cls['Field']."'];
			echo '$'.$count_cls['Field']."=".'$'."_POST['".$count_cls['Field']."'];"."<br>";
			}
			
	///////////////////	End of post
print'$insertSQL'."$table_name".' = "INSERT INTO '. $table_name  .' VALUES ( '."<p>'";

//end of initialize
			$sqltbcols="Show columns from $table_name";   
			$results_tbc=mysql_query($sqltbcols);
	        $cnt_cols=mysql_num_rows($results_tbc); 
			$numbprocessed='';
			while($count_cls=mysql_fetch_array($results_tbc)){
			
			echo '$'.$count_cls['Field'];
			
			$numbprocessedComp=$numbprocessed+1;
			
			if ($numbprocessedComp==$cnt_cols){
			
			echo"')\";<br>";
			echo '// END of Insert SQL Statement for '.$table_name."<p>";
			}else
			{echo"','";
			}
			$numbprocessed++;
			
			  $table_col_Namef=$count_cls['Field'];
			  $table_col_Type=$count_cls['Type']; 
			  $table_col_Null=$count_cls['Null'];
	

			} 
	
		

echo "<p>";		

echo '$Result1 = mysql_query($insertSQL'.$table_name.') or die(mysql_error());';

echo'} //End If'."<br>";

echo'} //End function insert';

echo "<p>".'//END  of the Insert process for '.$table_name ."<p><br>";
 
} //end while
} //end if
} //end func select tables 

//end of all interts

////////////////////////Actuals

///End of actuals
?>
<?php
buildPrimaryKeyRef();
function buildPrimaryKeyRef(){ 
$sql_available_tables="show tables"; 
    $results=mysql_query( $sql_available_tables);
	$cntreg=mysql_num_rows($results);  

if ($cntreg>0){ 
                        
            while($count=mysql_fetch_array($results)){                                   
			$table_name=$count[0]; 
			$table_nameNamed=explode('_',$table_name);
			$tableportion=$table_nameNamed[0];
			
			$sqltbcols1="Show columns from $table_name";   
			                   $results_tbc1=mysql_query($sqltbcols1);
	                           $cnt_cols1=mysql_num_rows($results_tbc1);							                          $count_colmn=mysql_fetch_array($results_tbc1);                               
							   //if($Seach=''){    
			                 $table_name_link_field_id=$count_colmn[0];
			
} //end while
} //end if
} //end func select tables  


}
function displayDynamicSQL($table_name){ 
$array_prec=explode('_',$table_name);
$tableformArray=$array_prec[0].'_links';

foreach ($tableformArray as $linkitem){
$tableFromId=$linkitem;
$foldnamelinks=explode('_',$tableFromId);
$foldnamelinkTo=$foldnamelinks[0];
echo "<a href=\"../insurance/$linkitem.php\">".$_SESSION["$linkitem"].'</a>';$item++;
}
return $DynamicSQL;
}

?>