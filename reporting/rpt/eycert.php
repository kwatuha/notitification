<?php

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function LoadData()
{
    //Logo
 

 
$this->SetFont('Times','B',12);
$this->cell(0,7,'KENYA REVENUE AUTHORITY INCOME TAX DEPARTMENT',0,1,'L');
$this->SetFont('Times','',12);
$this->cell(0,7,'SUPPORTING LIST TO END OF YEAR CERTIFICATE FOR 2010',0,1,'L');
$this->SetFont('Times','',12);
$this->cell(0,7,'EMPLOYER\'S CERTIFICATE - FORM P10',0,1,'L');
$this->Ln(4);


$this->cell(40,6,'Employer\'s Name','',0,'L');

$this->cell(60,6,'Laserview Info Systems Limited','',1,'L');
$this->cell(40,6,'Employer\'s Pin','',0,'L');
$this->cell(30,6,'433455','',1,'L');  
$this->Ln(2);
$this->SetFont('Times','B',14);
$this->cell(100,6,'COMPANY SUMMARY','',1,'R'); 
$this->Ln(8);
$this->setX(30);
$this->cell(40,6,'Month','LTB',0,'L');
$this->cell(60,6,'P.A.Y.E Tax Deducted()','TRB',1,'L'); 
$this->Ln(20); 
$this->setX(90);
$this->cell(40,0.5,'','T',1,'L');
$this->setX(90);
$this->cell(40,0.5,'','T',1,'L');
$this->cell(40,6,'TOTAL','',0,'L');
//$this->SetFont('Times','BU',14);
$this->cell(80,6,'6565656','',1,'R');
$this->setX(90);
$this->cell(40,0.5,'','T',1,'L');
$this->setX(90);
$this->cell(40,0.5,'','T',1,'L');
//*****************************************

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