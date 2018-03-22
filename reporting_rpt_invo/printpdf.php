<?php 
require('fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,5,'Here we come',0,1,'L');
$pdf->Output();

?>