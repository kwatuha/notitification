<table width="100%" border="0">
					<tr>
                      <td  colspan=4 background="../template/images/seoad.jpg" class="style3 style6" ><strong>SMS Messages  .</strong></td>
					</tr>
                    <tr>
                      <td  ><span class="style3">Unread</span></td>
                      <td  ><span class="style3">Failed</span></td>
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