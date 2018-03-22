<?php
if (!isset($_SESSION)) {
  session_start();
  $_SESSION['my_username']='';
}
require_once('Connections/cf4_HH.php');
$username=trim($_POST['username']);
$password=trim($_POST['password']);
$sql=" SELECT * FROM admin_adminuser WHERE username='$username' AND password='$password'"."  AND status='Active' 
AND voided!=1 ";
//echo $sql;
$LoginRS = mysql_query($sql) or die('Could Not Execute Query');
  $results=mysql_fetch_array($LoginRS);
  $loginFoundUser = mysql_num_rows($LoginRS);
  if($loginFoundUser>0){
  			echo "MainPage();";
  }
  else{
  			echo "showloginerror('Incorrect username or password!','Invalid Credentials!')";
			
  }
  if($loginFoundUser){
  $_SESSION['my_usergroup_id']=$results['usergroup_id'];
  $_SESSION['my_useridloggened']=$results['person_id'];
   $_SESSION['my_username']=$username;
    $_SESSION['MM_Username']='12222';
	 $_SESSION['MM_UserGroup']='2';
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
				
				$_SESSION['uuid'.$tablename.$fieldname]= $count_admincls['uuid'];
				
				$_SESSION['fwd'.$tablename.$fieldname]=$count_admincls['colnwidth'];
				if($fieldname=='syownerid'){
				$_SESSION['syownerid'.$tablename]=$tablename;
				$_SESSION['syowneridfield'.$tablename]='syownerid';
				}
				
				
				
				$primarykeyidentifier=trim($count_admincls['primarykeyidentifier']);
				$_SESSION['tablegroup'.$tablename]=$count_admincls['displaygroup'];
				$_SESSION['fieldtype'.$tablename.$fieldname]=$count_admincls['dataformat'].'|'.$count_admincls['dispaytype'];
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
				$_SESSION['flex'.$table_name]=$count_tbc['flexcolumn'];
				$_SESSION['gridwidth'.$table_name]=$count_tbc['gridwidth'];
				$_SESSION['gridhieght'.$table_name]=$count_tbc['gridhieght'];
				$_SESSION['height'.$table_name]=$count_tbc['formheight'];
				
				
				
			   }
			}
			
			//sms module 
			 $sqltblcaptions="Select sms_tablelist,caption from sms_smscaptions";   
					$results_tablecaps=mysql_query($sqltblcaptions);
					$cnt_colscap=mysql_num_rows($results_tablecaps); 
					if($cnt_colscap>0){
						while($count_tbc=mysql_fetch_array($results_tablecaps)){
						  $table_name=$count_tbc['sms_tablelist'];
						  $caption=trim($count_tbc['caption']);
						  $_SESSION[$table_name]=$caption;
					      }
						 $_SESSION[$table_name]=$caption;
			       }
				   
				   //Auto fille 
				   
				$sqldefineAutofill="select fieldname,primary_tablelist,caption from admin_autofill where inf='INF' ";
				$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die(mysql_error());
				$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
				
			      if($cnt_autorows){
			       while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $tablenameat=$table_autofillrows['primary_tablelist'];
					 $tablefield=trim($table_autofillrows['fieldname']);
					 $captionr=trim($table_autofillrows['caption']);
					 $_SESSION[$tablenameat.$tablefield]=$captionr;
					 $_SESSION['isautofill'.$tablenameat.$tablefield]='yes';
					 }
			 
			      }
				   //Customize fields 
				$sqldefineAutofill="select designer_fieldcustomization.fieldcustomization_id , designer_fieldcustomization.field_tablelist , designer_fieldcustomization.current_fieldname , admin_displaytype.displaytype_id , admin_displaytype.displaytype_name , designer_fieldcustomization.caption , designer_fieldcustomization.is_visible , designer_fieldcustomization.num_cols , designer_fieldcustomization.options , designer_fieldcustomization.created_by , designer_fieldcustomization.date_created , designer_fieldcustomization.changed_by , designer_fieldcustomization.date_changed , designer_fieldcustomization.voided , designer_fieldcustomization.voided_by , designer_fieldcustomization.date_voided , designer_fieldcustomization.uuid  from designer_fieldcustomization  inner join admin_displaytype on admin_displaytype.displaytype_id = designer_fieldcustomization.displaytype_id";
				//"select field_tablelist,current_fieldname,displaytype_id from designer_fieldcustomization ";
				$Rcd_autofill_results = mysql_query($sqldefineAutofill) or die(mysql_error());
				$cnt_autorows=mysql_num_rows($Rcd_autofill_results);
				
			      if($cnt_autorows){
			       while($table_autofillrows=mysql_fetch_array($Rcd_autofill_results)){
					 $tablenameat=$table_autofillrows['field_tablelist'];
					 $tablefield=trim($table_autofillrows['current_fieldname']);
					 $captionr=trim($table_autofillrows['caption']);
					 $options=trim($table_autofillrows['options']);
					 $datatype=trim($table_autofillrows['displaytype_name']);
					 $visible=trim($table_autofillrows['is_visible']);
					$num_cols=trim($table_autofillrows['num_cols']);
					 
					 $_SESSION['custcp'.$tablenameat.$tablefield]=$captionr;
					 $_SESSION['iscust'.$tablenameat.$tablefield]='yes';
					 $_SESSION['ctype'.$tablenameat.$tablefield]=$datatype;
					 $_SESSION['coptions'.$tablenameat.$tablefield]=$options;
					 $_SESSION['cvisible'.$tablenameat.$tablefield]=$visible;
					 $_SESSION['num_cols'.$tablenameat.$tablefield]=$num_cols;
					
					 
					 }
			 
			      }
			//exceptions
			 $sqltblcaptions="Select sytable_tablelist,invisible from designer_sytable";   
					$results_tablecaps=mysql_query($sqltblcaptions);
					$cnt_colscap=mysql_num_rows($results_tablecaps); 
					if($cnt_colscap>0){
						while($count_tbc=mysql_fetch_array($results_tablecaps)){
						  $table_name=$count_tbc['sytable_tablelist'];
						  $invisible=trim(strtoupper($count_tbc['invisible']));
						  if($invisible=='Y')
						  $_SESSION["syintt".$table_name]="Hide";
						 }
			}
			
			//Hide primary
			 $sqltblcaptions="Select sview_id from designer_fasttbldesign where primary_tablelist='admin_generaview'";   
					$results_tablecaps=mysql_query($sqltblcaptions);
					$cnt_colscap=mysql_num_rows($results_tablecaps); 
					if($cnt_colscap>0){
						while($count_tbc=mysql_fetch_array($results_tablecaps)){
						  $sview_id=$count_tbc['sview_id'];
						  $_SESSION["hideprimaryphotosection".$sview_id]="Hide";
						 }
			       }
				   
			//Hide pictures whenever we have admin_person as primary
			 $sqltblcaptions="Select distinct sview_id from designer_fasttbldesign where primary_tablelist='admin_person'";   
					$results_tablecaps=mysql_query($sqltblcaptions);
					$cnt_colscap=mysql_num_rows($results_tablecaps); 
					if($cnt_colscap>0){
						while($count_tbc=mysql_fetch_array($results_tablecaps)){
						  $sview_id=$count_tbc['sview_id'];
						  $_SESSION["showprimaryphoto".$sview_id]="Show";
						 }
			       }
			//Hide photo only
			//Hide primary
			 $sqltblcaptions="Select sview_id from designer_viewphoto where show_photo='Show'";   
					$results_tablecaps=mysql_query($sqltblcaptions);
					$cnt_colscap=mysql_num_rows($results_tablecaps); 
					if($cnt_colscap>0){
						while($count_tbc=mysql_fetch_array($results_tablecaps)){
						  $sview_id=$count_tbc['sview_id'];
						  $_SESSION["showprimaryphoto".$sview_id]="Show";
						 }
			       }
				   
				   //Hide primaryTrack notifications
			 /*$sqltblcaptions=$_SESSION["admin_rolenotification_SearchSQL"]."  where admin_rolenotification.voided Not Like 1 ";
		
			 //"Select primary_tablelist from admin_rolenotification where voided Not Like 1";   
					$results_tablecaps=mysql_query($sqltblcaptions);
					$cnt_colscap=mysql_num_rows($results_tablecaps); 
					if($cnt_colscap>0){
						while($count_tbc=mysql_fetch_array($results_tablecaps)){
						  $sview_id=$count_tbc['table_name'];
						  $_SESSION["hasnotification".$sview_id]="Show";
						 }
			       }*/
		    
?>
