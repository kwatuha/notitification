<?php

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function header(){
 $this->SetFont('Times','B',10);
$this->cell(90,5,'Laserview Info Systems Limited',0,0,'L');
$this->cell(100,5,'Payment List By Employee',0,1,'R');
//$this->SetFont('Times','B',12);
//$this->cell(125,5,'PAYROLL CODE ANALYSIS BY EMPLOYEE',0,1,'L');
// $this->SetFont('Times','B',10);
// $this->Ln(4);
$this->cell(90,5,'Period: August 2010',0,0,'L');
$this->cell(100,5,'Date Printed: 1st NOV 2011',0,1,'R');
$this->cell(90,5,'Employee Range: 005 to 90, Currency:',0,0,'L');
 $this->cell(100,5,'Time Printed: 00:12',0,1,'R');           
$this->Ln(2);
 $this->cell(0,5,'Page '.$this->PageNo(),0,1,'R');
 
 $this->cell(25,6,'Code','TB',0,'L');
$this->cell(60,6,'Name','TB',0,'L');
$this->cell(30,6,'Department','TB',0,'L');
$this->cell(30,6,'Pay Mode','TB',0,'L');
$this->cell(45,6,'Net Pay','TB',1,'R');
              
}
function LoadData()
{
    //Logo
 $this->SetFont('Times','B',8);
 $this->cell(90,5,'COMPANY BANK STD MOI',0,1,'L'); 
 
  
/*
$this->cell(10,6,'No','TB',0,'L');
$this->cell(45,6,'Name','TB',0,'L');
$this->cell(20,6,'Basic Pay','TB',0,'L');
$this->cell(20,6,'Benefits','TB',0,'L');
$this->cell(20,6,'Hse Benefit','TB',0,'L');
$this->cell(25,6,'Fringe Ben Emp','TB',0,'L');
$this->cell(30,6,'Taxable Pay','TB',0,'L');
$this->cell(30,6,'Net Pay','TB',0,'L');
$this->cell(15,6,'Relief','TB',0,'L');
$this->cell(30,6,'P.A.Y.E','TB',0,'L');
$this->cell(10,6,'NSSF','TB',0,'L');
$this->cell(20,6,'Car','TB',1,'L');
 //$this->Ln(4);
//*****************************************
  $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    
    $fill=false;
    */
     $this->SetFont('Arial','B',8);
    for($i=0;$i<10;$i++)
  {   
      $this->cell(25,6,'099877',0,0,'L');
$this->cell(60,6,'Owuonda Stephen Ouma',0,0,'L');
$this->cell(30,6,'Housing',0,0,'L');
$this->cell(30,6,'Cash',0,0,'L');
$this->cell(45,6,'120000',0,1,'R');
    }
    //$this->cell(0,0.5,'','T',1,'L');
    $this->cell(60,5,'Bank Number of Records',0,0,'L');
    $this->cell(100,5,'3',0,0,'L');
    $this->cell(30,5,'0.000000','TB',1,'R');
    //$this->cell(0,0.5,'','T',1,'L');
    //$this->cell(0,0.5,'','T',1,'L');
    $this->cell(60,5,'Total Number of Records',0,0,'L');
    $this->cell(100,5,'3',0,0,'L');
   /*
//*****************************************
$this->Ln(10);
//$this->setX(135);
$this->cell(0,0.5,'','T',1,'L');
//$this->setX(135);
$this->cell(0,0.5,'','T',1,'L');
 $this->SetFont('Times','B',10);
$this->cell(55,6,'Company Total:','B',0,'L');
//$this->cell(60,6,'3','',0,'L');
 $this->cell(20,6,'100000','B',0,'L');
      $this->cell(20,6,'20000','B',0,'L');
      $this->cell(20,6,'10000','B',0,'L');
      $this->cell(25,6,'8000','B',0,'L');
      $this->cell(30,6,'150000','B',0,'L');
      $this->cell(30,6,'160000','B',0,'L');
      $this->cell(15,6,'20000','B',0,'L');
      $this->cell(30,6,'60000','B',0,'L');
      $this->cell(10,6,'3000','B',0,'L');
      $this->cell(22,6,'10000','B',1,'L');
      $this->Ln(8);
//$this->Line(100,50,200,50);
//
//$this->Image('images/word.jpg',10,45,190,23);
//Arial bold 15
 $this->SetFont('Times','B',8); 
$this->setX(40);
      $this->cell(20,6,'PREPARED BY:',0,0,'L');
      $this->cell(40,6,'','B',0,'L');
      $this->cell(15,6,'DATE:',0,0,'L');
      $this->cell(30,6,'','B',0,'L');
      $this->cell(20,6,'APPROVED BY:','',0,'L');
      $this->cell(40,6,'','B',0,'L');
      $this->cell(15,6,'DATE:',0,0,'L');
      $this->cell(30,6,'','B',0,'L');
  */
}
//Page footer
function Footer()
{
  /*  //Position at 1.5 cm from bottom
    $this->SetY(-25);
    //Arial italic 8
    $this->SetFont('Courier','',10);
    //Page number
    $this->Cell(190,6,'Moi University',0,1,'C');
	 $this->SetY(-18);
	 $this->SetFont('Courier','I',8);
  $this->Cell(190,6,'Page '.$this->PageNo().' of {nb}',0,1,'C');
  */
}
 


}
$pdf=new PDF('P');

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$pdf->LoadData();
$pdf->SetFont('Arial','',8);

$pdf->Output();


?>