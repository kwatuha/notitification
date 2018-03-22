<?php
// *** Validate request to login to this site.
//$_SESSION['my_username']='';
if (!isset($_SESSION)) {
  session_start();
  $_SESSION['my_username']='';
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
require_once('Connections/cf4_HH.php');
include('template/functions/menuLinks.php');
if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess ="home/home.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true;
 $LoginRS__query=sprintf("SELECT * FROM admin_adminuser WHERE username='%s' AND password='%s'"."  AND status='Active'",
 
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
	
//echo $LoginRS__query;
  $LoginRS = mysql_query($LoginRS__query) or die(mysql_error());
  $results=mysql_fetch_array($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
  $_SESSION['my_usergroup_id']=$results['usergroup_id'];
  $_SESSION['my_useridloggened']=$results['employee_id'];
 // $_SESSION['username']=$results['username'];
  
  ///usergroup
  $getEmpgrpSQL="select usergroup_id, usergroup_name from admin_usergroup where usergroup_id=".$_SESSION['my_usergroup_id'];

$qryresults= mysql_query($getEmpgrpSQL) or die(mysql_error());
$resultsempgrp=mysql_fetch_array($qryresults);
$ctngroup = mysql_num_rows($qryresults);
 if($ctngroup>=1){

    $_SESSION['currentusergroup']=$resultsempgrp['usergroup_name'];
	
	if(strtoupper(trim($_SESSION['currentusergroup']))=='ESS'){
	$MM_redirectLoginSuccess = "home/home.php?r=".base64_encode('ESS');
	$_SESSION['isESS']='ESS';
	$_SESSION['isESSMenu']=getEssMenuOptions();
	}
    
 }

 
  //get group details
	$groupid=$results['usergroup_id'];
	
	//echo $_SESSION['my_usergroup_id'].'pppppppppppppppppppppppppppppppppppppppppppppppppppp';

  ///usergroup
     $loginStrGroup = "";
    //declare two session variables and assign them
	$_SESSION['my_username']= $results['username'];
    //end of group
	$_SESSION['my_usergroup_id']= $results['usergroup_id'];
	$_SESSION['my_username_id']= $results['employee_id'];
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	
header("Location: " . $MM_redirectLoginSuccess );

    
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
  
}

$sqladmin="Select * from admin_controller";   
			$results_adminctrls=mysql_query($sqladmin);
	        $cnt_cols=mysql_num_rows($results_adminctrls);
			$farray=array();
			$tarray=array(); 
			$prIDData=array();
			$countids=0;
			if($cnt_cols>0){
			while($count_admincls=mysql_fetch_array($results_adminctrls)){
			    $tablename=$count_admincls['tablename'];
				$tablecaption=$count_admincls['tablecaption'];
				$fieldname=$count_admincls['fieldname'];
				$fieldcaption=$count_admincls['fieldcaption'];
				$detailsvisiblepdf=$count_admincls['detailsvisiblepdf'];
				$pdfvisible=$count_admincls['pdfvisible'];
				$position=$count_admincls['position'];
				$tablenameprkarr=explode('_',$tablename);
				$tablenameprkey=$tablenameprkarr[1].'_id';
				$primarykeyidentifier=trim($count_admincls['primarykeyidentifier']);
				$_SESSION['tablegroup'.$tablename]=$count_admincls['displaygroup'];
				$tbarr=explode('_',$tablename);
				$fdd=explode('_',$fieldname);
				$crtId=$count_admincls['fieldname'];
				if($fdd[1]=='name'){
				//echo " $tbarr[1]".'_name'."  =  $fieldname   <br>";
				$kj=$tbarr[1].'_name';
				$farray[]=$fieldname."|".$kj;
				
				
				}
				
				if($primarykeyidentifier=='PRI'){
			//$idarray[]='alfayo';
			$countids++;
				$prIDData[$countids]=$crtId.'|'.$tablenameprkey.'_id';
					//echo 'existing==='.$count_admincls[fieldname].'/replace=='.$tablenameprkey.$countids.'<br>';
				//'$primarykeyidentifier','$isautoincrement'
				$_SESSION[$fieldname]=$tablename;
				
				if($tbarr[1]!=$fdd[0]){
				/*echo "exceptionsssssss           ssssssssssssssssssss                 sssssssssssssssssssssss                                   <br>";
				echo " $tablename  =  $fieldname   <br>";*/
				}
				}
				
				
				
			 if($tablename!=$tablenameprocessed){
			
			 // $_SESSION[$tablename]=$tablecaption;
			 }
			 $tablenameprocessed=$tablename;
			  $_SESSION[$tablename.$fieldname]=$fieldcaption;
			 
        }
		}
		$strrring="what is tge ";
$t='';
		foreach($farray as $t){
		$fhandle='dbscript.sql';
		$fileo=fopen($fhandle,'w+');
		$arr_parts=explode('|',$t);
		$pf=$arr_parts[0];
		$ps=$arr_parts[1];
		//echo $pf.'  '.$ps.'<br>';
		//$ite=strpos($strrring,$ps);
		//echo $ite;
		$finalstr=str_replace($pf,$ps,$strrring);
		$idarray=str_replace($pf,$ps,$strrring);
		$strrring=$finalstr;
		//fwrite($fileo,$finalstr);
		$strrringReved=$strrring;
		}
		/*$strrringReved;
		
		echo sizeof($prIDData);
		$i='';
		foreach($prIDData as $ig){
		echo $ig;
		$fhandle='dbscript.sql';
		$fileo=fopen($fhandle,'w+');
		$arr_parts2=explode('|',$ig);
		$pidf=$arr_parts2[0];
		$pids=$arr_parts2[1];
		//echo $pf.'  '.$ps.'<br>';
		//$ite=strpos($strrring,$ps);
		//echo $ite;
		$finalstr=str_replace($pidf,$pids,$strrringReved);
	    $strrring=$finalstr;
		fwrite($fileo,$strrringReved);
		}
		*/
		
		//echo $finalstr;
		
		
	$_SESSION['myexcptions']=$exceptions;
             $sqltblcaptions="Select * from admin_table";   
			$results_tablecaps=mysql_query($sqltblcaptions);
	        $cnt_colscap=mysql_num_rows($results_tablecaps); 
			if($cnt_colscap>0){
			   while($count_tbc=mysql_fetch_array($results_tablecaps)){
			 
			   $table_name=$count_tbc['table_name'];
			   $table_nameA=explode('_',$table_name);
			   $table_caption=$count_tbc['table_caption'];
			   $statement_caption=$count_tbc['statement_caption'];
			    $_SESSION[$table_name]=$table_caption;
				$_SESSION['stm'.$table_name]=$statement_caption;
				$_SESSION['flex'.$table_name]=$rows['flexcolumn'];
				$_SESSION['gridwidth'.$table_name]=$rows['gridwidth'];
				$_SESSION['gridhieght'.$table_name]=$rows['gridhieght'];
				
				
				
			   }
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Language" content="English" />
	<meta name="Distribution" content="Global" />
	<meta name="Author" content="Intellibiz Africa team (info@intellibizafrica.com)" />
	<meta name="Robots" content="index,follow" />
	<meta name="Description" content="PHIMIS" />
	<meta name="Keywords" content="Property Management,Insurance Systems, Intelligent Solutions" />
	<link rel="stylesheet" type="text/css" href="template/images/style.css" />
	<link rel="stylesheet" href="template/images/dtpicker.css" type="text/css" />
	<link rel="stylesheet" href="template/images/CollapsiblePanel.css" type="text/css" />

<title>Mobile Form Creator</title>


  
<link href="template/themes/Smart/css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../template/images/style.css" />
<link rel="stylesheet" href="../template/themes/Smart/css/customCSSfortables.css"/>
<link rel="stylesheet" href="../template/images/dtpicker.css" type="text/css" />
<link href="../template/themes/Smart/css/style.css" rel="stylesheet" type="text/css">

<script language="JavaScript" src="../template/js/calendarDateInput.js"></script>
<script language="JavaScript" src="../template/functions/currentinsertjs.js"></script>
<script language="JavaScript" src="../template/functions/currentOptions.js"></script>
<script language="JavaScript" src="../template/js/dtpicker.js"></script>



<script type="text/javascript" src="scripts/archive.js"></script>

<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/fonts/fonts.css">
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/container/assets/container.css">
<link type="text/css" rel="stylesheet" href="../template/themes/Smart/css/yui/button/assets/button.css">
</head>
<body>
	<div id="header">
		<div id="logo">
			<p class="slogan"></p>
			<div style="float: left;">
				<h1><a href="#">FormGen</a></h1>
			</div>
	  </div>
		<div id="hmenu"><?php //echo $topmenuDetails['loginmainTop'];?></div>
	</div>
		
	<div class="content">
		<div id="articles">
			<div id="left_pannel">
				<table width="100%" border="0">
  <tr>
    <td><td><div align="right">
      <p class="date">&nbsp;</p>
      <p align="left" class="formLabel86"><?php echo $submenuIn['loginSub'];?></p>
      <div id="right_pannel"><div id="loginform"><form name="loginFrm" method="post" class="search" <?php echo $loginFormAction; ?>action=""><table width="100%" height="100%" border="0">
            
            <tr>
            <td valign="bottom" width="39%" height="37" colspan="2"><div class="formLabel">
              <div align="right"><?php echo "<img src=\"images/mylogo.jpg\" alt=\"\" />"; ?></div>
            </div></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
			<td align="center">
			<table lef border="0.5" bordercolor="#CC3399">
			<tr><td>
			<table lef border="0">
			<tr><td>User ID:</td>
            <td ><input id="username" name="username" class="formInputText" maxlength="64" value=""  type="text"></td></tr>
          <tr>
            <td valign="bottom" height="34"><div class="formLabel">Password:</div></td>
            <td><input id="password" name="password" class="formInputText" maxlength="16"  type="password"></td>
          </tr>
		  
          <tr>
            <td align="center" colspan="2"><input type="submit"  class="savebutton" name="Signin"  value="Sign in"/></td>
                </tr></table></td></tr>
				
            </table>
			
			</td></tr>
				
            </table>
          </tr>
        </table>
							</p>
				  </form>
				</div>
			  </div> </p>
    </div></td></td>
  </tr>
</table>			
			</div>
			
			


				</div>
			
				<div >
					
				</div>
			</div>
		</div>
		
		
	
</body>	
</html>
<?php 
function getEssMenuOptions(){
            $essSQL="select distinct tablename,tablecaption from admin_tablerole where usergroup_id=1  ";
            $results_ess=mysql_query($essSQL);
	        $cnt_colsess=mysql_num_rows($results_ess);
			
			if($cnt_colsess>0){
			$uls= '<ul>';
					while($table_essArr=mysql_fetch_array($results_ess)){
					  $essMenuOptions=$table_essArr["tablename"];
					  $essMenuOptionsArr=explode('_',$essMenuOptions); 
					$allinks.='<li>'.'<a href="../'.$essMenuOptionsArr[0].'/'.$essMenuOptions.'.php">'
					.$table_essArr['tablecaption'].'</a></li>';
				
					  }
					  $ule= '</ul>';
            }


$essMenuOptionsPages=$uls.$allinks.$ule;
return  $essMenuOptionsPages;
WriteGridColums();
}?>