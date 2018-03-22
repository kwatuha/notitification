<?php

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function LoadData()
{
    //Logo
 

//$this->setX(80); 
$this->SetFont('Times','B',14);
$this->SetTextColor(90,100,100);
$this->cell(0,5,'NZOIA WATER SERVICES COMPANY LTD',0,1,'C');
$this->SetFont('Times','',8);
//$this->setX(80);
$this->cell(0,3,'Head Office: P.O Box 1010-50205',0,1,'R');
 $this->setX(174);
$this->cell(10,3,'Webuye',0,1,'L');
$this->setXY(15,16);
$this->cell(18,2,"If Undelivered",0,1,'L');
$this->setXY(15,18);
$this->cell(18,3,'Please return to:',0,1,'L');
$this->setXY(34,18);
$this->MultiCell(40,3,"The Commercial Manager\nNzoia Water Services Company Limited,\nP.o Box 1010, (50205)\nWebuye, Kenya\nTel: 020-2-6-536",0,'L',0);
$this->setXY(130,30);
$this->cell(24,3,'INVOICE:',0,0,'L');
$this->cell(18,3,'T5655443R5',0,1,'L');
$this->setXY(130,34);
$this->cell(24,3,'DATE OF ISSUE:',0,0,'L');
$this->cell(18,3,'17th Jan,2012',0,1,'L');
$this->cell(48,3,'THIS WATER BILL is due on or before:',0,0,'L');
$this->SetFont('Times','B',8);
$this->cell(30,3,'30th Jan,2012',0,1,'L');
$this->Ln(1);
$this->SetFont('Times','',8);
$this->SetFillColor(100,200,130);
$this->SetFont('Times','B',8);
$this->cell(0,4,'WATER BILL',1,1,'C',1);
$this->Ln(1);
$this->SetFont('Times','',8);
$this->Rect(10,45,190,17);
$this->Line(105,45,105,62);
//$this->setX(85);
$this->MultiCell(80,3,"To:\nAlfayo Kwatuha Mulimani\nP.O Box 234-40301\nELDORET\n",0,'L',0);
$this->setXY(110,45);
$this->SetFont('Times','',7);
$this->cell(25,4,"BILLING PERIOD:",0,0,'L');
$this->cell(20,4,'15th January,2012',0,1,'L');
$this->setX(110);
$this->cell(25,4,'CONNECTION No:',0,0,'L');
$this->cell(25,4,'09846746T7YT5',0,1,'L');
$this->setX(110);
$this->cell(25,4,'METER No:',0,0,'L');
$this->cell(30,4,'09846746T7YT5',0,0,'L');
$this->cell(7,4,'Cust:',0,0,'L');
$this->cell(30,4,'Cust',0,1,'L');
$this->setX(110);
$this->cell(25,4,'CATEGORY:',0,0,'L');
$this->cell(30,4,'Domestic',0,0,'L');
$this->cell(7,4,'SIZE:',0,0,'L');
$this->cell(30,4,'SIZE',0,1,'L');
//$this->setX(85);
$this->Ln(2);
$this->SetFont('Times','B',7);
$this->SetFillColor(100,200,130); 
$this->cell(30,4,'PREVIOUS READING',1,0,'C',1);
$this->cell(35,4,'PREVIOUS READING DATE',1,0,'C',1);

$this->cell(30,4,'CURRENT READING',1,0,'C',1);
$this->cell(35,4,'CURRENT READING DATE',1,0,'C',1);

$this->cell(30,4,'CONSUMPTION(M3)',1,0,'C',1);
$this->cell(30,4,'ESTIMATE(M3)',1,1,'C',1);
$this->SetFont('Times','',8);
$this->cell(30,4,'259',1,0,'C');
$this->cell(35,4,'12/12/2011',1,0,'C');

$this->cell(30,4,'280',1,0,'C');
$this->cell(35,4,'12/01/2012',1,0,'C');

$this->cell(30,4,'21',1,0,'C');
$this->cell(30,4,'0',1,1,'C');
 $this->SetFont('Times','B',7);
$this->cell(130,4,'ACCOUNTS DETAILS:',1,0,'C',1);
$this->cell(60,4,'AMOUNT IN KSH',1,1,'R',1);
$this->SetFont('Times','',8);
$this->cell(130,4,"                                                                 BALANCE B/F FROM LAST BILL",1,0,'C');
$this->cell(60,4,number_format(5000,2),1,1,'R');

$this->cell(130,4,'                                                                                  PAYMENTS CREDITED SINCE LAST BILL',1,0,'C');
$this->cell(60,4,number_format(2000,2),1,1,'R');

$this->cell(130,4,'                                                    ACCOUNT BALANCE B/F',1,0,'C');
$this->cell(60,4,number_format(3000,2),1,1,'R');



for($i=0;$i<5;$i++){
if($i==0){
$this->cell(130,4,'Meter Rent','RLT',0,'R');
$this->cell(60,4,number_format(2000,2),'RLT',1,'R');
}
else if($i==4){
$this->cell(130,4,'ADJUSTMENTS','RLB',0,'R');
$this->cell(60,4,number_format(2000,2),'RLB',1,'R');
}
else{
$this->cell(130,4,'Meter Rent','RL',0,'R');
$this->cell(60,4,number_format(2000,2),'RL',1,'R');
}


}
$this->SetFont('Times','B',8);
$this->cell(130,4,'TOTAL CHARGES','RLB',0,'R');
$this->cell(60,4,number_format(2500,2),'RLB',1,'R');
$this->cell(130,4,'TOTAL DUE','RLB',0,'R');
$this->cell(60,4,number_format(3500,2),'RLB',1,'R');
$this->SetFont('Times','BI',6);
$this->cell(60,3,'Message to Consumer',0,1,'L');
$this->MultiCell(0,3,"\n\n\n",1,'L',0);


}
//Page footer
function Footer()
{

   //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Courier','B',6);
    //Page number
    
    $this->cell(0,4,'Nzoia Water Services Company Limited',0,0,'C');
	 
 
}
 


}
$pdf=new PDF('L','mm','A4');

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->LoadData();
$pdf->SetFont('Arial','',8);

$pdf->Output();


?>