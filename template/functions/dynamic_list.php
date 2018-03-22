
<?php
//dynamic table
///working list table function
function displayallrecs($datatablelisted,$linkTID,$editpageTo,$viewpageTo,$searchSQLidentifier,
$searchfieldDetails){
$currentPage = $_SERVER["PHP_SELF"];
$image1="<img src=\"../template/images/comment.gif\" alt=\"\" />";
$image2="<img src=\"../template/images/timeicon.gif\" alt=\"\" />";
$maxRows_RecordsetSearch = 10;
$pageNum_RecordsetSearch = 0;
if (isset($_GET['pageNum_RecordsetSearch'])) {
  $pageNum_RecordsetSearch = $_GET['pageNum_RecordsetSearch'];
}


if (isset($_POST["seach$datatablelisted"])){

if (isset($_POST["$searchfieldDetails"])){
  $searchfieldDetailsModifier = strtoupper($_POST["$searchfieldDetails"]);
  $searchfieldDetailsModifier='WHERE ucase('.$searchfieldDetails .") Like '%$searchfieldDetailsModifier%'";
}
}


$startRow_RecordsetSearch = $pageNum_RecordsetSearch * $maxRows_RecordsetSearch;
$query_RecordsetSearch = $_SESSION["$searchSQLidentifier"]." $searchfieldDetailsModifier";

$query_limit_RecordsetSearch = sprintf("%s LIMIT %d, %d", $query_RecordsetSearch, $startRow_RecordsetSearch, $maxRows_RecordsetSearch);

$RecordsetSearch = mysql_query($query_limit_RecordsetSearch) or die(mysql_error());
$row_RecordsetSearch = mysql_fetch_array($RecordsetSearch);

if (isset($_GET['totalRows_RecordsetSearch'])) {
  $totalRows_RecordsetSearch = $_GET['totalRows_RecordsetSearch'];
} else {
  $all_RecordsetSearch = mysql_query($query_RecordsetSearch);
  $totalRows_RecordsetSearch = mysql_num_rows($all_RecordsetSearch);
}
$totalPages_RecordsetSearch = ceil($totalRows_RecordsetSearch/$maxRows_RecordsetSearch)-1;

$queryString_RecordsetSearch = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordsetSearch") == false && 
        stristr($param, "totalRows_RecordsetSearch") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordsetSearch = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordsetSearch = sprintf("&totalRows_RecordsetSearch=%d%s", $totalRows_RecordsetSearch, $queryString_RecordsetSearch);
?>
<form action="" method="post">
  <div align="left">
<table width="400" border="0">
  <tr>
  
    <td><table border="0" width="400" align="left">
	
      <tr>
        <th colspan="4"><p class="date"> Search <?php echo $_SESSION["$datatablelisted"];?> details</p></th>
		 <tr>
        <td >&nbsp;</td>
      
            <td >
              <?php  echo  $_SESSION["$datatablelisted$searchfieldDetails"];
			  echo " <input size=\"32\"  type=\"text\" name=\"$searchfieldDetails\" />";?>
             <td > 
              
            <?php  echo " <input type=\"submit\" name=\"seach$datatablelisted\" value=\"Find\"/>" ;
			?></td>
          </tr>
		  <tr align="left"> <td colspan="4"> <p align="left" class="date"><?php echo $_SESSION["$datatablelisted"];?></p></td></tr>
		  <tr > <th colspan="2" align="left"> <?php echo $_SESSION["$datatablelisted"];?></th>
		  <th align="left">View</th>
		  <th align="left">Edit</th></tr>
		  </tr>
      <?php do { ?>
          
          <tr>
       
		
        <td colspan="2"><?php 
		
		if(isset($row_RecordsetSearch["$field2"])){
		$field2ext=' - '.$row_RecordsetSearch["$field2"];
		} echo $image1.$row_RecordsetSearch[0].$row_RecordsetSearch[1].$row_RecordsetSearch[2]; ?></td>
        
		
<?php 

//Links
/*print"<td>".$image2;
print"<a href=".$viewpageTo.".php?q=".base64_encode($row_RecordsetSearch["$linkTID"])."\">View</a> ";*/
print " </td>";
print"<td>".$image2."<a href=".$viewpageTo.".php?q=";print base64_encode($row_RecordsetSearch["$linkTID"]).">View</a></td>";

print"<td>".$image2."<a href=".$editpageTo.".php?q=";print base64_encode($row_RecordsetSearch["$linkTID"]).">Edit</a></td>";			
			
echo "</tr>";?>
      </tr>
     
      </tr>
      <?php } while ($row_RecordsetSearch = mysql_fetch_assoc($RecordsetSearch)); ?>
    </table></td></div></td>
  </tr>
  <tr>
    <td height="74">
	
	<p class="date">&nbsp;</p>
	<table border="0" width="20%" align="right">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch > 0) { // Show if not first page
	 ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, 0, $queryString_RecordsetSearch); ?>"><img src="../template/images/First.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_RecordsetSearch > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, max(0, $pageNum_RecordsetSearch - 1), $queryString_RecordsetSearch); ?>"><img src="../template/images/Previous.gif" border=0></a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch < $totalPages_RecordsetSearch) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, min($totalPages_RecordsetSearch, $pageNum_RecordsetSearch + 1), $queryString_RecordsetSearch); ?>"><img src="../template/images/Next.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_RecordsetSearch < $totalPages_RecordsetSearch) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordsetSearch=%d%s", $currentPage, $totalPages_RecordsetSearch, $queryString_RecordsetSearch); ?>"><img src="../template/images/Last.gif" border=0></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table></td>
  </tr>
</table>
<p> Records <?php echo ($startRow_RecordsetSearch + 1) ?> to <?php echo min($startRow_RecordsetSearch + $maxRows_RecordsetSearch, $totalRows_RecordsetSearch) ?> of <?php echo $totalRows_RecordsetSearch ?></p>
</form>

<?php
mysql_free_result($RecordsetSearch);
}
?>