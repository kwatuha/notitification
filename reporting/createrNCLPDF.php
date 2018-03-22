<?php
require('pdf/fpdf.php');
$table_name='pim_employee';
include('../template/functions/menuLinks.php');
class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
//////////////////////////////////////////////////////

function Header()
{
$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
$this->setFont('Arial','B',10);
$year='/2011';
/*$this->setY(40);
$this->cell(0,4,$companyArr[0],0,1,'C');
$this->Ln(2);
*/
$this->setY(40);
$this->SetFont('Times','B',24);
//$this->SetTextColor(90,100,100);
$this->SetTextColor(0,51,102);

//$companyArr[0]
$this->cell(0,5,'Zulmac Insurance Brokers Limited',0,1,'C');
$this->SetFont('Times','B',10);



$mynewsess=$_SESSION[statementfromtbl];

$this->Ln(1);
$this->SetFont('Arial','B',8);
$date_printed=date('d-m-Y');
$this->Image('../template/reportimages/images/zul_logo.jpg',93,10,27,27);
$this->Cell(40,5,'P.O. Box  '.$companyArr[4].' - '.$companyArr[5].'  '.$companyArr[6],0,0,'L');
//$this->Cell(80);
$this->setX(150);
$this->Cell(40,5,'Tel: '.$companyArr[7].' Fax: '.$companyArr[8],0,1,'L');
$this->Cell(40,5,$companyArr[13],0,0,'L');

$this->setX(150);
$this->Cell(30,5,'Email: '.$companyArr[10],0,1,'L');

$this->Cell(40,5,$companyArr[14],0,0,'L');

$this->setX(150);
$this->Cell(40,5,$companyArr[16],0,1,'L');

$this->Cell(40,5,$companyArr[15],0,0,'L');
$this->setX(150);

$this->Cell(30,5,'Website: '.$companyArr[11],0,1,'L');

//$this->Cell(80);
//$this->Cell(20,5,' Mobile: '.$companyArr[9],0,0,'C');


$this->Cell(200,0,'','T');

//
/*    13            14                        15           16
'||'$building.'||'$location_description.'||'$street.'||'$email_address2;
*/
//company info
 /* $this->SetY(40);
$this->SetFont('Arial','',6);
$this->cell(0,4,ucwords($_SESSION[$mynewsess]),0,1,'C');
$this->Cell(80,5,$toname,0,1,'L');
$this->Cell(30,5,$toaddress,0,1,'L');
$this->Cell(80,5,$totown,0,1,'L');
$this->Cell(20,5,'Tel.: ' .$totel,0,1,'L');*/

  $this->Cell(200,0,'','T');
$this->SetFont('Arial','',12);
  $this->Ln(2);
  $this->SetFont('Courier','',8);
  $this->Ln(5);
}
//Page footer

//Page footer
function Footer()
{
$companyArrInfo=getCompanyInfo();
$companyArr=explode('||', $companyArrInfo[0]);
$mynewsess=$_SESSION[statementfromtbl];
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
  $this->Cell(100,6,' Page '.$this->PageNo().' of {nb}',0,1,'R');
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

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	$dz=count($data)+2;
	for($i=1;$i<100;$i++)
	{
		$w=$this->widths[$i];
		
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		//$this->SetFillColor(150,125,255);
		$this->SetFont('Courier','',6);
		//$this->SetFont('Arial','',6);
		
		$this->MultiCell($w,5,$data[$i],0,$a,false);
		//$this->Rect($x,$y,$w,$h);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//$this->Rect($x,$y,$w,$h);
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
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
function createReceiptHeaders(){
  $toname='Joseph Mwalimu Nyerere';
  $toaddress='P. O. Box 2012-30100';
  $totown='Eldoret';
  $totel='0723686454';
  $toemailaddress='mwalimu@yahoo.com';
  $invoiceDate='08/07/2012';
 
$clientinfointend=30;
$clientinfointendIn=34;
$indeta=10;
$indetails=15;
$invoiceNum='0000100010021';

$this->SetX($indeta);
$this->SetFont('Courier','B',12);
$this->cell(20,4,'Invoice',0,1,'L');
$this->SetFont('Courier','',8);
$this->SetX($indetails);
$this->cell(20,4,'Invoice #:',0,0,'L');
//$this->setX(40);
//$this->cell(20,4,$invoiceNum,0,1,'L');
$this->setX($clientinfointendIn);
$this->cell(20,4,$invoiceNum,0,1,'L');
$this->SetX($indetails);
$this->cell(20,4,'Date: ',0,0,'L');
$this->SetX($clientinfointendIn);
$this->cell(20,4,$invoiceDate,0,1,'L');
$this->SetX($indetails);
$this->cell(20,4,'Invoice To: ',0,1,'L');

$this->setX($clientinfointend);

$this->Cell(80,5,$toname,0,1,'L');
$this->setX($clientinfointend);

$this->Cell(30,5,$toaddress,0,1,'L');
$this->setX($clientinfointend);

$this->Cell(80,5,$totown,0,1,'L');
$this->setX($clientinfointend);

$this->Cell(20,5,'Tel.: ' .$totel,0,1,'L');
$this->setX($clientinfointend);

$this->Cell(80,5,'Email Address: '.$toemailaddress,0,1,'L');

       //Rect($x, $y, $w, $h, $style='')
 $coldesinvals=112;
 
  
  //Bottom
 
   
  //$this->Rect(10, 250, 250,20, $style='');
//$this->Rect(180, 50, 20,240, $style='');
    /*$this->Rect(200, 50, 20,240, $style='');*/
 
 //$this->SetY($coldesinvals);
//invoice
    $this->SetFillColor(150,125,255);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    //Header
  $w=array(5,20,10,80,15,20,20,20);
    for($i=0;$i<sizeof($header);$i++)
    $this->Cell($w[$i],6,$header[$i],1,0,'L',true);
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    $this->SetFont('Courier','',7);
	}////////
function CreateDynamicPDFLayout($headerfields,$headerWidth,$tablename)
{
    $this->SetFillColor(229,229,229);
    $this->SetTextColor(0,0,0);
    //$this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
	$this->SetFont('Courier','B',7);
    //$this->SetFont('','B');
    //Header
	$widthdetails=array(5,20,40,10,20,20,20,20,10);
	$headercaption=array('#','Ref','Description','Qty','Cost','Amount','Currency','Date','');
    for($i=0;$i<sizeof($headerfields);$i++){
	  if($i==0){
	  //$this->Cell($headerWidth[$i],6,'No.',1,0,'L',true);
			
	  }
			$this->Cell($widthdetails[$i],6,$headercaption[$i],1,0,'L',true);
			
			
	}
	$this->Ln();
    //Color and font restoration
    /*$this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    $this->SetFont('Courier','',6);*/
    //Data
    
}

/////////////////////////
}
?>
