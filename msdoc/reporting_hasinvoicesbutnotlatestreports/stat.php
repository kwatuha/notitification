<?php

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function LoadData()
{
    //Logo
  
$this->SetFont('Times','B',12);
$this->cell(150,5,'Laserview Info Systems Limited',0,0,'L');
$this->cell(125,5,'Statutory Deductions: P.A.Y.E. By Employee',0,1,'R');
$this->cell(150,5,'Period: August 2010',0,0,'L');
$this->cell(125,5,'Date Printed: 31st OCT 2011',0,1,'R');
$this->cell(150,5,'Currency: Ksh',0,0,'L');
$this->cell(125,5,'Time Printed: 10:40',0,1,'R');
$this->cell(150,5,'Company P.I.N. No.: 433455',0,0,'L');
$this->cell(125,5,'Page '.$this->PageNo(),0,1,'R');
$this->Ln(4);
$this->cell(35,6,'Code','TB',0,'L');
$this->cell(60,6,'Name','TB',0,'L');
$this->cell(30,6,'P.I.N','TB',0,'L');
$this->cell(40,6,'Taxable Pay','TB',0,'L');
$this->cell(30,6,'Tax Charged','TB',0,'L');
$this->cell(30,6,'Relief','TB',0,'L');
$this->cell(50,6,'P.A.Y.E','TB',1,'L');

//*****************************************
  $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    
    $fill=false;
    for($i=0;$i<20;$i++)
  {
        $this->cell(35,6,'0988773','',0,'L');
        $this->cell(60,6,'Owuonda Stephen','',0,'L');
        $this->cell(30,6,'098822','',0,'L');
        $this->cell(40,6,'100000.00','',0,'L');
        $this->cell(30,6,'100000.00','',0,'L');
        $this->cell(30,6,'1162.00','',0,'L');
        $this->cell(50,6,'4000.00','',1,'L');
        //$this->Ln();
        $fill=!$fill;
    }
  
//*****************************************
$this->Ln(10);
$this->setX(135);
$this->cell(150,1,'','T',1,'L');
$this->setX(135);
$this->cell(150,1,'','T',1,'L');

$this->cell(95,6,'Total Number of employees:','',0,'L');
//$this->cell(60,6,'3','',0,'L');
$this->cell(30,6,'20','',0,'L');
$this->cell(40,6,'0.000','B',0,'L');
$this->cell(30,6,'0.000','B',0,'L');
$this->cell(30,6,'0.000','B',0,'L');
$this->cell(50,6,'0.000','B',1,'L');
//$this->Line(100,50,200,50);
//
//$this->Image('images/word.jpg',10,45,190,23);
//Arial bold 15


    $this->Ln(5);
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