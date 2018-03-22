<?php

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function header(){
 $this->SetFont('Times','B',10);
$this->cell(150,5,'Laserview Info Systems Limited',0,1,'L');
$this->SetFont('Times','B',12);
$this->cell(125,5,'PAYROLL CODE ANALYSIS BY EMPLOYEE',0,1,'L');
 $this->SetFont('Times','B',10);
 $this->Ln(4);
$this->cell(150,5,'August 2010',0,1,'L');
$this->cell(125,5,'Date Printed: 31st OCT 2011, Page '.$this->PageNo(),0,1,'L');

$this->Ln(4);
  
}
function LoadData()
{
    //Logo
 $this->SetFont('Times','B',8); 

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
    for($i=0;$i<10;$i++)
  {   
      $this->cell(10,6,'5335',0,0,'L');
      $this->cell(45,6,'Alfayo Kwatuha Mulimani',0,0,'L');
      $this->cell(20,6,'100000',0,0,'L');
      $this->cell(20,6,'20000',0,0,'L');
      $this->cell(20,6,'10000',0,0,'L');
      $this->cell(25,6,'8000',0,0,'L');
      $this->cell(30,6,'150000',0,0,'L');
      $this->cell(30,6,'160000',0,0,'L');
      $this->cell(15,6,'20000',0,0,'L');
      $this->cell(30,6,'60000',0,0,'L');
      $this->cell(10,6,'3000',0,0,'L');
      $this->cell(20,6,'10000',0,1,'L');
    }
  
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
$pdf=new PDF('L');

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$pdf->LoadData();
$pdf->SetFont('Arial','',8);

$pdf->Output();


?>