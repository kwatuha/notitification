<?php
frestrictaccess();
function frestrictaccess(){
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isFAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isFAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
}
require_once('../Connections/cf4_HH.php');?><?php
require('pdf/fpdf.php');
$table_name='pim_employee';
include('../template/functions/menuLinks.php');
class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
//////////////////////////////////////////////////////
//end column headers
//Page footer
function Header()
{
$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
$this->setFont('Arial','B',10);
$year='/2011';
//Image($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
$this->Image('../template/reportimages/images/zul_logo.jpg',95,5,27,27);
$this->setY(33);
$this->cell(0,4,$companyArr[0],0,1,'C');
$this->Ln(2);
$mynewsess=$_SESSION[statementfromtbl];
$this->cell(0,4,ucwords($_SESSION[$mynewsess]),0,1,'C');
//$this->Ln(5);
$this->SetFont('Arial','',6);
$date_printed=date('d-m-Y');
//$this->setX(80);

$this->Cell(40,5,'Address: P.O. Box  '.$companyArr[4].' - '.$companyArr[5].'  '.$companyArr[6],0,0,'C');
//$this->Cell(80);
$this->Cell(40,5,' Tel: '.$companyArr[7].' Fax: '.$companyArr[8],0,0,'C');
//$this->Cell(80);
$this->Cell(23,5,' Mobile: '.$companyArr[9],0,0,'C');
$this->Cell(45,5,'Email: '.$companyArr[10],0,0,'C');
$this->Cell(45,5,'Website: '.$companyArr[11],0,1,'C');
$this->setX(0);
$this->Cell(300,0,'','T');
$this->SetFont('Arial','',12);
  $this->Ln(2);
  $this->SetFont('Courier','',8);
  $this->Ln(5);
}
function dbnotefooter(){
$this->SetY(-25);
    //Arial italic 8
	  $date_printed=date('d-m-Y');
     $this->SetFont('Courier','',8);
     $this->Cell(180,6,$companyArr[0],0,1,'C');
	 $this->SetY(-18);
	 $this->SetFont('Courier','I',6);
	 $preparedby=getPreparedBy('insurance_insurancedebitnote','insurancedebitnote_id',$_SESSION['insdebitnoteid']);
	 if($preparedby)
	 //$this->Cell(180,6,ucwords($_SESSION[$mynewsess]).'  Prepared by '.$preparedby.'  as at '.$date_printed,0,1,'C');
	 
     $this->Ln(2);
	 $approvedby=getApprovedBy('insurance_approvedbnote','insurancedebitnote_id',$_SESSION['insdebitnoteid'],'is_approved','approved');
	 //if($approvedby)
	 //$this->Cell(180,6,ucwords($_SESSION[$mynewsess]).'  Approved by '.$approvedby,0,1,'C');
   
	 
//$this->Cell(0,6,'Page '.$this->PageNo().' of {nb}',0,1,'C');
//Invoice Footer
}
function Footer()
{
if($_SESSION['insdebitnoteid']){
$this->dbnotefooter();
}
if(($_SESSION['rptacccategory']!=53)&&(!$_SESSION['insdebitnoteid'])){
$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
$mynewsess=$_SESSION[statementfromtbl];
$tbpages=$this->AliasNbPages('{nb}');
//echo $this->page;
    //Position at 1.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
	$date_printed=date('d-m-Y');
    $this->SetFont('Courier','',8);
    $this->Cell(180,6,$companyArr[0],0,1,'C');
	 $this->SetY(-18);
	 $this->SetFont('Courier','I',6);
	 $this->Cell(180,6,ucwords($_SESSION[$mynewsess]).'  printed by '.$_SESSION['my_username'].'  as at '.$date_printed,0,1,'C');
  //$this->Cell(100,6,$_SESSION[stmadmin_adminuser'].'  printed by '.$_SESSION['my_username'],0,1,'R');
 // $this->Cell(100,6,' Page '.$this->PageNo()." of".$this->AliasNbPages('{nb}')." ".,0,1,'R');
  $this->Cell(0,6,'Page '.$this->PageNo().' of {nb}',0,1,'C');
  //Invoice Footer
  if(!$_SESSION['yry']){
$cxheaderfields=explode(',',"Statement Summary,Total Due,Total Paid, Balance,Statement Date");
$lablevals=explode(',',"Rent Accrued,Total B/F,Late Charges,Total Deposits, Balance");

$this->CreateTables($lablevals,-55,125,40,1,'L');
$stsummary=$_SESSION['rptrptrent'].','.$_SESSION['rptrptbf'].','.'0.00,'.$_SESSION['rptrptpaid'].','.$_SESSION['rptrptbal'];
$values=explode(',',$stsummary);


$this->CreateTables($values,-55,165,40,1,'V');
$valueslbl="Rent Deposit|Water & Electricity";
//$valuesr=$_SESSION['rptdeposit'].','.$_SESSION['rptrptwater_elec'];
$valuesr=$_SESSION['rptdeposit']."|".$_SESSION['rptrptwater_elec'];
$valueslbl=explode('|',$valueslbl);
$values=explode('|',$valuesr);
$this->CreateTables($valueslbl,-55,45,50,1,'L');
$this->CreateTables($values,-55,95,70,1,'V');

}//end of check for required
  /////////////////////////
  }//end determination fof footer printing
}
function getTotalPages(){
$nb=$this->page;
$this->pages[$nb];	
}
function getheaders($table_name){
$this->cell(0,4,$_SESSION['stm'.$table_name],0,1,'L');
$this->Ln(1);
}	
///////////////////////////////////////////////////////
function SetWelcomeData(){
$this->Cell(120,3,'welcome home',0,1,'L');}
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data,$widthdetails,$headercoldetails,$islast,$showLines,$xLoc)
{
	//Calculate the height of the row
	$nb=0;
	if($xLoc>0)
	$this->setX($xLoc);
	for($i=0;$i<sizeof($widthdetails);$i++){
	  // echo $this->widths[$i].'<br>';
		$colwidth2=$widthdetails[$i];
		//echo $colwidth2.'<br>';
		$nb=max($nb,$this->NbLines($widthdetails[$i],trim($data[$i])));
		}
	$h=5*$nb;
	//$h=100;
	//Issue a page break first if needed
	$this->CheckPageBreak($h,$widthdetails);
	//Draw the cells of the row
	//$dz=count($data)+2;
	//$widthdetails=array(5,10,20,20,20,20,100);
	$it=sizeof($widthdetails);
	
	for($i=0;$i<=$it;$i++)
	{    
		$w=$widthdetails[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		
		$this->SetFont('Courier','',6);
	 $testn=explode('(',$data[$i]);
	  $shademe=false;
	 if($testn[1]){
	 $shademe=true;
	 }
	 $shademe=false;
	if(trim(strtoupper($headercoldetails[$i]))=="AMOUNT"){
	$a='R';
	 }
		$this->MultiCell($w,5,trim($data[$i]),0,$a,$shademe);
		if($showLines==true)
		$this->Rect($x,$y,$w,$h);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//$this->Rect($x,$y,$w,$h);
	//Go to the next line
	
	$this->Ln($h);
	
}

function createColumns($numcols,$curY,$psize){
$this->Rect(10,$curY,array_sum($numcols),$psize);
$myX=10;
foreach($numcols as $col){

$this->Rect($myX,$curY,$col,$psize);
$myX=$myX+$col;
}
}

function CheckPageBreak($h,$numcols)
{
	//If the height h would cause an overflow, add a new page immediately
	
	$psize=($this->PageBreakTrigger-36.997583333);
	$curY=$this->GetY();
	if($this->GetY()+$h>$psize){
	    //$this->Cell(array_sum($numcols),0,'','T');
		$this->AddPage($this->CurOrientation);
		
		
		
		if($_SESSION['stlev']=='Account Summary'){
					$disbursementsHeader="
					#^
					Name^
					Rent^
					Open. Bal^
					Frequency^
					Expiry Date^
					Rent Dep.^
					Elec/Water Dep.^
					Expenses^
					Balance
					"; 
					/*Tax^
					Line Total*/
					$disbursementsHeaderColns="
					AI|5,
					received_from|40,
					rent|14,
					formatedopbal|20,
					period_typef|18,
					expiry|20,
					deposit|18,
					electricity_water|25,
					expenses|18,
					acc_status|18
					
					";
					$headercaptions=explode('^',$disbursementsHeader);
					$finfo=explode(',',$disbursementsHeaderColns);
					$x=0;
					$widthdetails='';
					$headerfields='';
					foreach($finfo as $finfoitem){
					$d=explode('|',$finfoitem);
					$widthdetails[$x]=$d[1];
					$headerfields[$x]=$d[0];
					$x++;
					
					}
					$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);
		} 
		if($_SESSION['stlev']=='Income'){
					$disbursementsHeader="
					#^
					Month^
					Date^
					Received From^
					
					Amount^
					Comm.^
					Details^
					Payment Mode
					"; 
					/*Tax^
					Line Total*/
					$disbursementsHeaderColns="
					AI|5,
					cmonth|13,
					ddate|17,
					received_from|48,
				
					amount|15,
					commission|17,
					naration|60,
					payment_mode|20
					
					";
					$headercaptions=explode('^',$disbursementsHeader);
					$finfo=explode(',',$disbursementsHeaderColns);
					$x=0;
					$widthdetails='';
					$headerfields='';
					foreach($finfo as $finfoitem){
					$d=explode('|',$finfoitem);
					$widthdetails[$x]=$d[1];
					$headerfields[$x]=$d[0];
					$x++;
					
					}
					$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);
		} 
		if($_SESSION['stlev']=='Rent Remissions'){
				$disbursementsHeader="
				#^
				Month^
				Date^
				
				Amount^
				Details^
				Payment Mode
				
				"; 
				
				$disbursementsHeaderColns="
				AI|5,
				cmonth|15,
				ddate|17,
				
				amount|23,
				naration|100,
				payment_mode|34
				
				";
				$headercaptions=explode('^',$disbursementsHeader);
				$finfo=explode(',',$disbursementsHeaderColns);
				$x=0;
				$widthdetails='';
				$headerfields='';
				
				foreach($finfo as $finfoitem){
				$d=explode('|',$finfoitem);
				$widthdetails[$x]=$d[1];
				$headerfields[$x]=$d[0];
				$x++;
				
				}
				$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);
		} 
		if($_SESSION['stlev']=='Agent & Tenant Expenses'){
			$disbursementsHeader="
			#^
			Name^
			Expense Date^
			Amount^
			Expense Description
			"; 
			/*Tax^
			Line Total*/
			$disbursementsHeaderColns="
			AI|5,
			received_from|40,
			transaction_date|25,
			amount|25,
			naration|100
			";
			$headercaptions=explode('^',$disbursementsHeader);
			$finfo=explode(',',$disbursementsHeaderColns);
			$x=0;
			$widthdetails='';
			$headerfields='';
			foreach($finfo as $finfoitem){
			$d=explode('|',$finfoitem);
			$widthdetails[$x]=$d[1];
			$headerfields[$x]=$d[0];
			$x++;
			
			}
			$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);
		} 
		
		//$this->Cell(array_sum($numcols),0,'','T');
		$this->SetX(10);
		if($_SESSION['rptacccategory']!=53){
         $this->createColumns($numcols,98,140);
		}
		//echo $this->SetY();
		}
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}


//////////////////////////
function CreateDynamicPDFLayout($headerfields,$headerWidth,$tablename)
{
    $this->SetFillColor(229,229,229);
    $this->SetTextColor(0,0,0);
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->SetFont('Courier','B',7);
    //$this->SetFont('','B');
    //Header
    for($i=0;$i<sizeof($headerfields);$i++){
	  if($i==0){
	  //$this->Cell($headerWidth[$i],6,'No.',1,0,'L',true);
			
	  }
			$this->Cell($headerWidth[$i],6,$_SESSION[$tablename.$headerfields[$i]],1,0,'L',true);
			
			
	}
	$this->Ln();
   
    
}

/////////////////////////
function CreateQueryTableHeaders($headercaptions,$headerWidth)
{
    $this->Ln(5);
	$headerLoc=$this->GetY();
	
	$this->SetFillColor(229,229,229);
    $this->SetTextColor(0,0,0);
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->SetFont('Courier','B',7);
    //$this->SetFont('','B');
    //Header
	$this->SetY(98);
    for($i=0;$i<sizeof($headercaptions);$i++){
	  $this->Cell(trim($headerWidth[$i]),6,trim($headercaptions[$i]),1,0,'L',true);
	}
	$this->Ln();
	
	return $headerLoc;
 }
 
 function CreateQueryCustomHeaders($headercaptions,$headerWidth,$showlines,$xloc,$ydis)
{
    
	
	$headerLoc=$this->GetY();
	
	$this->SetY($headerLoc+$ydis);
	$this->SetFillColor(229,229,229);
    $this->SetTextColor(0,0,0);
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->SetFont('Courier','B',7);
    //$this->SetFont('','B');
    //Header
	if($xloc>0){
	$this->SetX($xloc);
	}
    for($i=0;$i<sizeof($headercaptions);$i++){
	if($showlines==1){
	$this->Cell(trim($headerWidth[$i]),6,trim($headercaptions[$i]),1,0,'L',false);
	}
	else{
	  $this->Cell(trim($headerWidth[$i]),6,trim($headercaptions[$i]),1,0,'L',false);
	  }
	}
	$this->Ln();
	return $headerLoc;
 }
 
  function createDBMotorPolicyDBNote($motor,$cover){
    $addressloc=$this->GetY();
    $toname=$_SESSION['rptrptname'];
    $toaddress=$_SESSION['rptpostaladdress'];
    $totel=$_SESSION['rptphone'];
    $toemailaddress=$_SESSION['rptemailaddress'];
	$invoiceDate='08/07/2012';
	$clientinfointend=10;
	$clientinfointendIn=34;
	$indeta=30;
	$indetails=15;
	$invoiceNum='0000100010021';
	$clientinfointend=10;
	$dw=50;
	$bd=0;
	$this->setX($clientinfointend);
	//$this->Rect($clientinfointend,$addressloc,$dw,20);
	
	$todaydate=date('d-M-Y');
	//$this->setY($addressloc+3);
	
	$this->SetFont('Times','B',20);
	
	$response=$this->getDbDate($_SESSION['insdebitnoteid']);
	$INSdata=fillPrimaryData('insurance_insurancedebitnote',$_SESSION['insdebitnoteid']);
	$this->setX(80);
	//$this->Cell($dw,5,'Debit Note',$bd,1,'L');
	$this->SetFont('Courier','B',8);
	$my=$this->getY();
	//$this->setXY(146,$my-10);
	
	////
	$this->Ln(2);
	$this->setX(20);
	$this->Cell($dw,5,'UNDERWRITER  ',0,0,'L');
	
	$this->setX(90);
	$this->Cell($dw,5,'TYPE OF COVER ',0,0,'L');
	
	
	$this->setX(120);
	$this->Cell($dw,5,'POLICY NO.',0,0,'L');
	
	$this->setX(170);
	$this->Cell($dw,5,'PREMIUM RATE',0,1,'L');
	
	
	
	// NOW FILL VALUES
	$this->setX(20);
	$this->SetFont('Courier','',8);
	$this->Cell($dw,5,$INSdata['underwriter_name'],0,0,'L');
	
	$this->setX(90);
	$this->Cell($dw,5,$cover['policyscope_name'],0,0,'L');
	
	
	$this->setX(120);
	$this->Cell($dw,5,$INSdata['policy_number'],0,0,'L');
	
	$this->setX(170);
	$this->Cell($dw,5,$cover['basic_premium'],0,1,'L');
	$this->setX(0);
	$this->Cell(300,1,'','T');
    $this->setX(10);
	$this->Ln(2);
	$this->SetFont('Courier','B',8);
	$this->Cell(0,5,'PERIOD OF INSURANCE',0,1,'C');
	
	$this->SetFont('Courier','B',8);
	$this->setX(60);
	$this->Cell(0,5,'FROM',0,0,'L');
	$this->SetFont('Courier','',8);
	$this->setX(70);
	$this->Cell(0,5,$cover['period_from'],0,0,'L');
	$this->SetFont('Courier','B',8);
	$this->setX(125);
	$this->Cell(0,5,'TO',0,0,'L');
	$this->SetFont('Courier','',8);
	$this->setX(130);
	$this->Cell(0,5,$cover['period_to'],0,1,'L');
	$this->setX(0);
	$this->Cell(300,1,'','T');
	$this->Ln(2);
	
	
	//Insurance policy
	$this->setX(2);
	$this->SetFont('Courier','B',8);
	$this->Cell($dw,5,'REGISTRATION MARK ',0,0,'L');
	
	$this->setX(40);
	$this->Cell($dw,5,'MAKE & BODY TYPE ',0,0,'L');
	
	
	$this->setX(80);
	$this->Cell($dw,5,'TONS',0,0,'L');
	
	$this->setX(90);
	$this->Cell($dw,5,'YEAR OF MANUFACTURE',0,0,'L');
	
	$this->setX(125);
	$this->Cell($dw,5,'CARRYING CAPACITY',0,0,'L');
	$this->setX(160);
	$this->Cell($dw,5,'VALUE',0,0,'L');
	
	$this->setX(180);
	$this->Cell($dw,5,'PREMIUMS',0,1,'L');
	
	
	
	// NOW FILL VALUES
	$this->SetFont('Courier','',8);
	$this->setX(2);
	$this->Cell($dw,5,$motor['registration_number'],0,0,'L');
	
	$this->setX(40);
	$this->Cell($dw,5,$motor['make'],0,0,'L');
	
	
	$this->setX(80);
	$this->Cell($dw,5,$motor['tons'],0,0,'L');
	
	$this->setX(90);
	$this->Cell($dw,5,$motor['year_manufactured'],0,0,'L');
	
	$this->setX(125);
	$this->Cell($dw,5,$motor['carrying_capacity'],0,0,'L');
	$this->setX(160);
	$this->Cell($dw,5,$cover['amount_insured'],0,1,'L');
	$this->setX(0);
	$this->Cell(300,1,'','T');
	
	// NOW FILL PREMIUM BREAK DOWN
	$this->SetFont('Courier','B',7);
	$locXVal=150;
	$locXValue=180;
	$this->setX($locXVal);
	$this->Cell($dw,5,'BASIC ',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['basic_premium'],0,1,'L');
	$this->setX($locXVal);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'STAMP DUTY ',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['stamp_duty'],0,1,'L');
	$this->setX($locXVal);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'T LEVY-0.2%',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['levyamount'],0,1,'L');
	$this->setX($locXVal);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'PCF LEVY-0.25%',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['pcfamount'],0,1,'L');
	
	$this->setX($locXVal);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'PLL W',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['wtaxamount'],0,1,'L');
	
	$this->setX($locXVal);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'R/C 10%',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['levyamount'],0,1,'L');
	
	$this->setX($locXVal);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'OTHERS',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['other_details'],0,1,'L');
	
	$this->setX($locXVal);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'TOTAL',0,0,'L');
	$this->setX($locXValue);
	$this->SetFont('Courier','',7);
	$this->Cell($dw,5,$cover['totalpremium'],0,1,'L');
	$this->Ln(2);
	
	$this->setX(0);
	$this->Cell(300,1,'','T');
	
	$this->Ln(2);
	$this->setX(10);
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'Endorsements & Other Clauses',0,0,'L');
	
	$this->Ln(50);
	$this->setX(0);
	$this->Cell(300,1,'','T');
	
	
	$this->Ln(2);
	$this->setX(50);
	//($searchID,$primaryTable,$resultKey,$table1,$tableKey)
	$userDetails=getApprovalPersonByTbl($_SESSION['insdebitnoteid'],'insurance_insurancedebitnote','Prepared By', 'insurance_approvedbnote','Approved By');
	$this->SetFont('Courier','B',7);
	$this->Cell($dw,5,'Prepared By '.$userDetails['Prepared By'],0,0,'L');
	$this->setX(140);
	$this->Cell($dw,5,'Approved By '.$userDetails['Approved By'],0,1,'L');
	$this->setX(50);
	$this->Cell($dw,5,'Date '.$userDetails['pdate'],0,0,'L');
	$this->setX(140);
	$this->Cell($dw,5,'Date '.$userDetails['sdate'],0,1,'L');
  
 }
 function CreateAddressHeader(){
    $addressloc=$this->GetY();
    $toname=$_SESSION['rptrptname'];
    $toaddress=$_SESSION['rptpostaladdress'];
    $totel=$_SESSION['rptphone'];
    $toemailaddress=$_SESSION['rptemailaddress'];
	$invoiceDate='08/07/2012';
	$clientinfointend=10;
	$clientinfointendIn=34;
	$indeta=30;
	$indetails=15;
	$invoiceNum='0000100010021';
	$clientinfointend=10;
	$dw=50;
	$bd=0;
	$this->setX($clientinfointend);
	//$this->Rect($clientinfointend,$addressloc,$dw,20);
	
	$todaydate=date('d-M-Y');
	//$this->setY($addressloc+3);
	
	$this->SetFont('Times','B',20);
	if($_SESSION['insdebitnoteid']){
	$response=$this->getDbDate($_SESSION['insdebitnoteid']);
	$INSdata=fillPrimaryData('insurance_insurancedebitnote',$_SESSION['insdebitnoteid']);
	$this->setX(80);
	$this->Cell($dw,5,'Debit Note',$bd,1,'L');
	$this->SetFont('Courier','B',8);
	$my=$this->getY();
	$this->setXY(146,$my-10);
	$this->Cell(60,5,$INSdata['underwriter_name'],1,1,'L');
	$this->setXY(146,$my-4);
	$this->Cell(30,5,'From: '.$response['startdate'],1,1,'L');
	$this->setXY(177,$my-4);
	$this->Cell(29,5,'To: '.$response['enddate'],1,1,'L');
	$this->setXY(146,$my+2);
	$this->Cell(60,5,$todaydate,1,1,'L');
	$this->Ln(2);
  }else{
			$this->SetFont('Courier','B',8);
			$this->Cell($dw,5,$toname,$bd,1,'L');
			$this->SetFont('Courier','',8);
			$this->setX($clientinfointend);
			$this->Cell($dw,5,$toaddress,$bd,1,'L');
			$this->setX($clientinfointend);
			$this->Cell($dw,5,$totel,$bd,1,'L');
			$this->setX($clientinfointend);
			$this->Cell($dw,5,$toemailaddress,$bd,1,'L');
			$this->Ln(2);
			
			$this->setXY(80,$addressloc+7);
	$this->Cell($dw,5,'Statement',$bd,1,'L');
	}
	return $addressloc;
 }
 
 function CreateInvoiceAddress($header,$data,$headerfields,$headerWidth){
  $addressloc=$this->GetY();
   $toname=$_SESSION['rptrptname'];
  $toaddress=$_SESSION['rptpostaladdress'];
  $totel=$_SESSION['rptphone'];
   $toemailaddress=$_SESSION['rptemailaddress'];
	$invoiceDate='08/07/2012';
	$clientinfointend=10;
	$clientinfointendIn=34;
	$indeta=30;
	$indetails=15;
	$invoiceNum='0000100010021';
	$clientinfointend=10;
	$dw=50;
	$bd=0;
	$this->setX($clientinfointend);
	//$this->Rect($clientinfointend,$addressloc,$dw,20);
	$this->SetFont('Courier','B',8);
	$this->Cell($dw,5,$toname,$bd,1,'L');
	$this->SetFont('Courier','',8);
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toaddress,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$totel,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toemailaddress,$bd,1,'L');
	$this->Ln(2);
	
	$this->setXY(80,$addressloc+7);
	
	//$this->setY($addressloc+3);
	$this->SetFont('Times','B',18);
	$this->Cell($dw,5,'Statement',$bd,1,'L');
	return $addressloc;
 }
 
 function CreateDocumentSummary($sumLoc){
  $toname=$_SESSION['rptrptname'];//'Joseph Mwalimu Nyerere';
  $toaddress='P. O. Box 2012-30100';
  $totown='Eldoret';
  $totel='0723686454';
	$toemailaddress='mwalimu@yahoo.com';
	$invoiceDate='08/07/2012';
	$clientinfointend=10;
	$clientinfointendIn=34;
	$indeta=10;
	$indetails=15;
	$invoiceNum='0000100010021';
	$sumLoc=-55;
	$this->setY($sumLoc);
	$clientinfointend=135;
	$dw=70;
	$bd=1;
	$this->setX($clientinfointend);
	$this->SetFont('Courier','B',8);
	$this->Cell($dw,5,$toname,$bd,1,'L');
	$this->SetFont('Courier','',8);
	$this->setX($clientinfointend);
	$this->Cell($dw,5,$toaddress,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,'Tel.: ' .$totel,$bd,1,'L');
	$this->setX($clientinfointend);
	$this->Cell($dw,5,'Email Address: '.$toemailaddress,$bd,1,'L');
	$this->Ln(2);
 }
 
 
 function CreateTables($lablevals,$loc,$xintent,$labelwidth,$bd,$ptype){
  	$this->Ln(2);
	if($ptype=='L'){
	$this->SetFont('Courier','B',8);
	}
	if($ptype=='V'){
	$this->SetFont('Courier','',8);
	}
	$labelPos=$this->GetY();
	$clientinfointend=$xintent;
	$dw=$labelwidth;
	$this->setXY($xintent,$loc);
	foreach($lablevals as $cl){
	$this->setX($clientinfointend);
	$this->SetFont('Courier','B',8);
	$this->Cell($dw,5,trim($cl),$bd,1,'L');
	}
	
	$this->Ln(2);
	return $labelPos;
 }
 function getDbDate($dbnoteid){
$sql="select 
 min(insurance_insurancedebitnoteitems.period_from) startdate,
max( insurance_insurancedebitnoteitems.period_to) enddate from  insurance_insurancedebitnoteitems
where insurance_insurancedebitnoteitems.insurancedebitnote_id=$dbnoteid and insurance_insurancedebitnoteitems.voided=0
";
$response='';

$rowscnt = mysql_query($sql) ;///or die($sql);
		if($rowscnt){
					while ($resultIdcnt=mysql_fetch_array($rowscnt)){
					$response['startdate']= $resultIdcnt['startdate'];
					$response['enddate']= $resultIdcnt['enddate'];
					
					}
		}
return $response;
}
function createDisbursement(){
$this->SetFont('Courier','B',10);
$_SESSION['stlev']='Rent Remissions';
$this->Cell(10,5,'Rent Remissions',0,1,'L');
$this->SetFont('Courier','',8);
$disbursementsHeader="
#^
Month^
Date^

Amount^
Details^
Payment Mode

"; 

$disbursementsHeaderColns="
AI|5,
cmonth|15,
ddate|17,

amount|23,
naration|100,
payment_mode|34

";
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);

//echo $_SESSION['disbursementlqry'];
$multidataColumns=LoadQueryData($_SESSION['disbursementlqry'],$headerfields);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
					   $myrow[$k]=$multidataColumns[$i][$k];
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		//$this->Row($myrow,$widthdetails,$headercoldetails,$islast,0);
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,$showLines,$xLoc);
 }
 ///////////////////////////////// $_SESSION['bankcashtransbylandlord']
 }
 function createHeaderInfo($disbursementsHeader,$disbursementsHeaderColns,$showlines,$xloc,$ydis){
 $headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,$ydis);
 }
 function createDbNoteTotals($dbid){
 $displayvalues=getDBNoteSummary($dbid);
 $this->SetFont('Times','B',9);
$amount_insured=$displayvalues['amount_insured'];
$basic_premium=$displayvalues['basic_prem'];
$pcfamount=$displayvalues['pcfamount'];
$levyamount=$displayvalues['levyamount'];
$stamp_duty=$displayvalues['stampduty'];
$total=$displayvalues['totalpremium'];
$disbursementsHeader="
					$amount_insured^
					$basic_premium^
					$pcfamount^
					$levyamount^
					$stamp_duty^
					$total
				
					"; 
$disbursementsHeaderColns="
amount_insured|20,
basic_premium|15,
pcfamount|13,
levyamount|22,
stamp_duty|18,
totalpremium|18
";


 
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,true,100,0);

 }
 function createPaymentModality($dbid){
 $this->Ln(2);
 //$this->SetFont('Times','B',9);
$this->setX(10);

 $this->SetFont('Times','B',9);
$this->Cell(20,5,'Installments','',0,'L');
$this->Ln(3);
	
	////Installments
	$disbursementsHeader="
					1st Installment^
					2nd Installment^
					3rd Installment^
					4th Installment
					";
					$blankHeader="
					 ^
					 ^
					 ^
					
					";  
$disbursementsHeaderColns="
1st|55,
2nd|55,
3rd|42,
4th|43
";

$this->createHeaderInfo($disbursementsHeader,$disbursementsHeaderColns,true,0,2);
$this->createHeaderInfo($blankHeader,$disbursementsHeaderColns,true,0,0);


$this->SetFont('Times','B',9);
$this->setX(10);
$this->Ln(1);
$this->Cell(20,5,'Payment Modality','',0,'L');
$this->Ln(3);             
	
	
	//End of Installments
	
	
			
$disbursementsHeader="
					IPF^
					Cheques^
					Cash
					"; 
$disbursementsHeaderColns="
ipf|90,
checques|65,
cash|42
";


 
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,true,0,2);

 }
 
 
 function createIPFrows($dbid){
 //$_SESSION['dbcheck'] $_SESSION['dbncash']
 
 $financiar='Coooerpaticie Bank';
 $my=$this->getY();
// $this->Cell(55,5,''.$ficnanciar,1,1,'L');
$disbursementsHeader="
					#^
					Financier^
					Bank^
					Check^
					Check Date^
					Amount"; 
$disbursementsHeaderColns="
AI|5,
policyfinance_name|20,
bank|15,
check_number|13,
check_date|17,
amount|20
";

 //bank check_number amount check_date
 
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
//$dbid=21;
 $acWhere=" where insurance_dnpolicyfinance.voided=0 AND insurance_dnpolicyfinance.insurancedebitnote_id=$dbid ";
$sqlipf=str_replace("{where}",$acWhere,$_SESSION["dbnipf"]);
$multidataColumns=LoadQueryData($sqlipf,$headerfields);

$numofrows=sizeof($multidataColumns);

$headerde=sizeof($headerfields);
//determine  if IPF is used
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,true,0,0);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

} 

//$descr=getInsDBNoteItems($dbid,$numofrows);
//foreach($descr as $dsc)
//echo $dsc;

$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
							if(trim($headerfields[$k])=='classdescription'){
							//echo $headerfields[$k].'<br />';
							$rdata=trim($multidataColumns[$i][$k]);
							$myrow[$k]=$descr[$rdata];
							}
							else{
					   $myrow[$k]=$multidataColumns[$i][$k];
					          }
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,true,0);
 }
 $totalAmt=sumIPF($dbid);//number_format(6900009,2);
			 if($numofrows>0){
			 $this->setX(28+35);
			 $this->SetFont('courier','B',7);
			 $this->Cell(17,5,'Total:',1,0,'R');
			 
			 $this->Cell(20,5,$totalAmt,1,1,'R');
			}
 return $my;
 }
 
 function createNBCash($dbid,$yloc){
 
 $this->setXY(120+10+35,$yloc);
 //$_SESSION['dbcheck'] $_SESSION['dbncash']
 //'Financier:'.$financiar
 //$this->Cell(42,5,$des,1,1,'L');
$disbursementsHeader="
					#^
					Date Paid^
					Amount"; 
$disbursementsHeaderColns="
AI|5,
check_date|17,
amount|20
";
//bank check_number amount check_date
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,true,120+10+35,0);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

} 
$multidataColumns='';
//echo $_SESSION['dbcheck'];




$accountNum=$_SESSION['confdbnoteaccount'];//453;
$acWhere="where accounts_cashtrans.accaccount_id=$accountNum";
$dbncashSQl=str_replace("{where}",$acWhere,$_SESSION["dbncash"]);
$multidataColumns=LoadQueryData($dbncashSQl,$headerfields);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$descr=getInsDBNoteItems($dbid,$numofrows);
foreach($descr as $dsc)
//echo $dsc;

$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
					  //echo $headerfields[$k];
							if(trim($headerfields[$k])=='classdescription'){
							//echo $headerfields[$k].'<br />';
							$rdata=trim($multidataColumns[$i][$k]);
							$myrow[$k]=$descr[$rdata];
							}
							else{
					   $myrow[$k]=$multidataColumns[$i][$k];
					          }
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,true,120+10+35);
 }
 $totalAmt=sumCashByAccount($accountNum);//number_format(6900009,2);
 $this->setX(28+55+42+10+35);
 $this->SetFont('courier','B',7);
 $this->Cell(17,5,'Total:',1,0,'R');
 
 $this->Cell(20,5,$totalAmt,1,1,'R');
 
 return $my;
 }
 
 function createNBCheck($dbid,$yloc){
 $this->setXY(135,$yloc);
$disbursementsHeader="
					#^
					Bank^
					Check #^
					Check Date^
					Amount"; 
$disbursementsHeaderColns="
AI|5,
bank|15,
check_number|13,
check_date|17,
amount|15
";
//bank check_number amount check_date
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,true,100,0);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

} 
$multidataColumns='';
//echo $_SESSION['dbcheck'];
$accountNum=$_SESSION['confdbnoteaccount'];//453;
$acWhere="where accounts_checkregister.accaccount_id=$accountNum";

$dbcheckSQl=str_replace("{where}",$acWhere,$_SESSION["dbcheck"]);
$multidataColumns=LoadQueryData($dbcheckSQl,$headerfields);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$descr=getInsDBNoteItems($dbid,$numofrows);
foreach($descr as $dsc)
//echo $dsc;

$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
							if(trim($headerfields[$k])=='classdescription'){
							//echo $headerfields[$k].'<br />';
							$rdata=trim($multidataColumns[$i][$k]);
							$myrow[$k]=$descr[$rdata];
							}
							else{
					   $myrow[$k]=$multidataColumns[$i][$k];
					          }
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,true,100);
 }

 $totalAmt=sumChecksByAccount($accountNum);//number_format(6900009,2);
		 if($numofrows>0){
		 $this->setX(28+55+25+20);
		 $this->SetFont('courier','B',7);
		 $this->Cell(17,5,'Total:',1,0,'R');
		 
		 $this->Cell(20,5,$totalAmt,1,1,'R');
		 }
 return $my;
 }
 
 function createDNAddress($dbid){
 
 //$underwriter,$policyNumber,$insured,$ac,$tel,$email,$policy,$pin
$nbitems=getDBNoteItems($dbid);
$motor='';
$primaryselector=$dbid;
foreach($nbitems as $U){
$arrDB=explode('|', $U);
$class=$arrDB[0];
$description=$arrDB[1];
if(strtoupper($class)=='MOTOR')
$motor=$description;
if(strtoupper($class)=='DOMESTIC PACKAGE')
$domestic=$description;
if(strtoupper($class)=='FIRE')
$fire=$description;
if(strtoupper($class)=='BURGLARY')
$burglary=$description;
if(strtoupper($class)=='POLITICAL RISK')
$political=$description;
if(strtoupper($class)=='MARINE')
$marine=$description;
if(strtoupper($class)=='OTHERS')
$others=$description;

}

$fielddata=fillPrimaryData('insurance_insurancedebitnote',$primaryselector);
$pid=$fielddata['person_id'];

$policyNumber=$fielddata['policy_number'];
$personname=$fielddata['person_fullname'];
 
$idpassportArr=fillPrimaryData('admin_person',$pid);
$idpassport=$idpassportArr['idorpassport_number'];
$pin=$idpassportArr['pin'];
$prefferedContacts=getPrefferedContact('admin_person',$pid);
$postal_address=$prefferedContacts['postal_address'];
$email_address=$prefferedContacts['email_address'];
$mobile_number=$prefferedContacts['mobile_number'];
$telephone=$prefferedContacts['telephone'];
if($mobile_number||$telephone){
$tel='';
	if($mobile_number){
	$tel=$mobile_number;
	}
		    if($telephone){
				if($tel){
				$tel=$tel.'/'.$telephone;
				}else{
				$tel=$telephone;
				}
			}
}

$da='';

$acno=$_SESSION['rptrptref'];
$policynum=$policyNumber;
$fillarr=createTableGridSummaries('insurance_insurancedebitnote','insurancedebitnote_name');
$dbrfname=$fillarr['filval'];
$risks=$fielddata['risk_covered_naration'];
$pcf=$fielddata['pcf']/100;
$sdtl=$fielddata['sdtl']/100;
$period_from=$fielddata['period_from'];
$period_to=$fielddata['period_to'];
$date_created=$fielddata['date_created'];
$amount_insured=$fielddata['amount_insured'];
$pcf=number_format($amount_insured*$pcf,2);
$stdl=number_format($amount_insured*$sdtl,2);
$totalpremium=number_format(($amount_insured+$stdl+$pcf),2);
$policy_value=number_format($fielddata['policy_value'],2);
$risks=$fielddata['risk_covered_naration'];
$amount_insured=number_format($amount_insured,2);
$y=$this->getY();
$this->setY($y);
$x=10;
$w=196;
$h=16;
//$this->Rect($x,$y,$w,$h);
//$policyNumber $personname $email_address $tel $idpassport $postal_address

$this->SetFont('Courier','',8);
$y=$this->getY()+1;
$this->setY($y);
$this->SetFont('Courier','B',8);
//$this->Cell(19,5,'INSURED NAME ','',0,'L');
$this->SetFont('Courier','',8);
//$this->setX(35);
$this->Cell(195,5,trim($personname),'',0,'L');
$this->setX(170);
$this->Cell(180,5,"".$date_created,'',1,'L');
$this->SetFont('Courier','',8);

/// address
$y=62;
$x=10;
$this->createCustomizedAddressLoc($postal_address,$tel,$email_address,$y,$x);

//other details
/*$this->Cell(195,5,'A/C NO.:','',0,'L');
$this->SetFont('Courier','B',8);
$this->setX(35);
$this->Cell(195,5,$acno,'',1,'L');

$this->SetFont('Courier','',8);
$this->Cell(30,5,'NATIONAL ID:','',0,'L');
$this->SetFont('Courier','B',8);
$this->setX(35);
$this->Cell(20,5,$idpassport,'',0,'L');
$this->SetFont('Courier','',8);
$this->setX(70);
$this->Cell(8,5,'PIN:','',0,'L');
$this->SetFont('Courier','B',8);
$this->Cell(20,5,$pin,'',0,'L');
$this->SetFont('Courier','',8);
$yln=$this->getY();
$this->setXY(70,$yln-5);
$this->Cell(21,5,'POLICY  NO.:','',0,'L');
$this->SetFont('Courier','B',8);
$this->Cell(60,5,$policyNumber,'',1,'L');
$this->SetFont('Courier','',8);*/
//$this->SetFont('Courier','',8);
$y=88;
$x=137;
//$this->createCustomizedAddressLoc($postal_address,$tel,$email_address,$y,$x);

}
function createCustomizedAddressLoc($postal_address,$tel,$email_address,$y,$x){
$this->setXY($x,$y);
$this->setX($x);
$this->SetFont('Courier','B',7);
//$this->Cell(250,5,'P.O.BOX ','',0,'L');

$this->SetFont('Courier','',7);

//$this->setX($x+12);
$this->Cell(195,5,$postal_address,'',1,'L');
$this->SetFont('Courier','B',7);

$this->setX($x);
//$this->Cell(195,5,'EMAIL ','',0,'L');

$this->SetFont('Courier','',7);
//$this->setX($x+12);
$this->Cell(195,5,$email_address,'',1,'L');


$this->SetFont('Courier','B',7);
//$this->Cell(195,5,'TEL NO. ','',0,'L');
$this->SetFont('Courier','',7);
//$this->setX($x+12);
$this->Cell(195,5,$tel,'',1,'L');



}
function createDBClass($dbid){
$acWhere=" WHERE insurance_insurancedebitnote.insurancedebitnote_id=$dbid ";

$sqlDBnote=str_replace("{where}",$acWhere,$_SESSION['insdebitnoteitems']);
$this->SetFont('Times','B',10);
$_SESSION['stlev']='Insurance Class';
$this->Ln(2);
$this->Cell(10,5,'Insurance Class',0,1,'L');
$this->SetFont('Courier','',8);
$disbursementsHeader="
#^
Class^
Description^
Sum Insured^
Premium^
PCF^
Training Levy^
Stamp Duty^
Total

"; 

$disbursementsHeaderColns="
AI|5,
insuranceclass_name|30,
classdescription|55,
amount_insured|20,
basic_premium|15,
pcfamount|13,
levyamount|22,
stamp_duty|18,
totalpremium|18
";


 
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,true,0,0);

//echo $_SESSION['disbursementlqry']; 
//$_SESSION['dbcheck'] $_SESSION['dbncash'] $_SESSION['dbnipf']
$multidataColumns=LoadQueryData($sqlDBnote,$headerfields);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$descr=getInsDBNoteItems($dbid,$numofrows);
foreach($descr as $dsc)
//echo $dsc;

$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
							if(trim($headerfields[$k])=='classdescription'){
							//echo $headerfields[$k].'<br />';
							$rdata=trim($multidataColumns[$i][$k]);
							$myrow[$k]=$descr[$rdata];
							}
							else{
					   $myrow[$k]=$multidataColumns[$i][$k];
					          }
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,true,0);
 }
 ///////////////////////////////// $_SESSION['bankcashtransbylandlord']
 }
function createExpenses(){
$_SESSION['stlev']='Agent & Tenant Expenses';
$this->SetFont('Courier','B',10);
$this->Cell(195,7,'Agent & Tenant Expenses','T',1,'L');
$this->SetFont('Courier','',8);
$disbursementsHeader="
#^
Name^
Expense Date^
Amount^
Expense Description
"; 
/*Tax^
Line Total*/
$disbursementsHeaderColns="
AI|5,
received_from|40,
transaction_date|25,
amount|25,
naration|100
";
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';
foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
//echo $_SESSION['clandlordexpenses'];
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);


$multidataColumns=LoadQueryData($_SESSION['clandlordexpenses'],$headerfields);
$numofrows=sizeof($multidataColumns);

$headerde=sizeof($headerfields);
$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
					   $myrow[$k]=$multidataColumns[$i][$k];
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		//$this->Row($myrow,$widthdetails,$headercoldetails,$islast,0);
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,$showLines,$xLoc);
 }
 }
 function drawLineBreak($widthdetails){
 $linewidth=array_sum($widthdetails);
 $this->Cell(10,$linewidth,'','T',1,'L');
 }
function createRentCollections(){
$this->SetFont('Courier','B',10);
$_SESSION['stlev']='Income';
$this->Cell(195,7,'Income','T',1,'L');
$this->SetFont('Courier','',8);
$disbursementsHeader="
#^
Month^
Date^
Received From^
Amount^
Comm.^
Details^
Payment Mode
"; 
/*Tax^
Line Total*/
$disbursementsHeaderColns="
AI|5,
cmonth|13,
ddate|17,
received_from|48,
amount|15,
commission|17,
naration|60,
payment_mode|20

";
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';
foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);

//echo $_SESSION['disbursementlqry'];//.$_SESSION['clandlordexpenses'].$_SESSION['bankcashtransbylandlord'];
$multidataColumns=LoadQueryData($_SESSION['bankcashtransbylandlord'],$headerfields);
$numofrows=sizeof($multidataColumns);

$headerde=sizeof($headerfields);
$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
					   $myrow[$k]=$multidataColumns[$i][$k];
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		//$this->Row($myrow,$widthdetails,$headercoldetails,$islast,0);
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,$showLines,$xLoc);
 }
 ///////////////////////////////// 
 }



function createSummaryByTenant(){
//echo $this->getY();

$this->SetFont('Courier','B',10);
$_SESSION['stlev']='Account Summary';
$this->Cell(195,7,'Account Summary','T',1,'L');
$this->SetFont('Courier','',8);
$disbursementsHeader="
#^
Name^
Rent^
Open. Bal^
Frequency^
Expiry Date^
Rent Dep.^
Elec/Water Dep.^
Expenses^
Balance
"; 
/*Tax^
Line Total*/
$disbursementsHeaderColns="
AI|5,
received_from|40,
rent|14,
formatedopbal|20,
period_typef|18,
expiry|20,
deposit|18,
electricity_water|25,
expenses|18,
acc_status|18

";
$headercaptions=explode('^',$disbursementsHeader);
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';
foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}
$showlines=1;
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,1,5,2);
$multidataColumns=LoadQueryData($_SESSION['landlordtenantsmmryqry'],$headerfields);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
					   $myrow[$k]=$multidataColumns[$i][$k];
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		//$this->Row($myrow,$widthdetails,$headercoldetails,$islast,0);
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,$showLines,$xLoc);
 }
 ///////////////////////////////// 
 }
 
 function createDynamicRpt($pkey){
 $gridproperty=createDynamicReportGridbySQL($pkey);
$gridmodel=$gridproperty['model'];
$gridcols=$gridproperty['gridcols'];
$selcols=$gridproperty['selcols'];
$sql=$gridproperty['query_code'];
$pdf_column=$gridproperty['pdf_column'];

///*******************************************************
$disbursementsHeaderColns=$pdf_column;

$headercaptions=getReportDynamicHeaders($disbursementsHeaderColns);//explode('^',$disbursementsHeader);

//foreach($headercaptions  as $r) echo $r.'<br /><br />';
$finfo=explode(',',$disbursementsHeaderColns);
$x=0;
$widthdetails='';
$headerfields='';
foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);

$checkpdf=explode('^',$d[0]);

$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
if($checkpdf[1])
$headerfields[$x]=$checkpdf[1];
$x++;

}
$showLines=1;
//$xloc=10;

//echo sizeof($widthdetails).'  '.sizeof($headercaptions);
//foreach($widthdetails  as $r) echo $r.'<br /><br />';
$this->CreateQueryCustomHeaders($headercaptions,$widthdetails,$showlines,$xloc,2);
$multidataColumns=LoadQueryData($_SESSION[$sql],$headerfields);
$numofrows=sizeof($multidataColumns);
$headerde=sizeof($headerfields);
$myrow='';
$ic=0;
$islast='';
//for($kv=0;$kv<1;$kv++){
        $ic++;
		$cheklastRow=0;
		for($i=0;$i<$numofrows;$i++){
		            $cheklastRow++;
					  for($k=0;$k<=$headerde;$k++){
					   $myrow[$k]=$multidataColumns[$i][$k];
					   }
						
						
						
	if(($ic==1)&&($cheklastRow==$numofrows)){
		$islast=1;
		}else{
		$islast=0;
		}
		$headercoldetails=$headerfields;
		//$this->Row($myrow,$widthdetails,$headercoldetails,$islast,0);
		$showLines=1;
		$this->Row($myrow,$widthdetails,$headercoldetails,$islast,$showLines,$xLoc);
 }

//********************************************************
 }
 
 
 
}
?>
