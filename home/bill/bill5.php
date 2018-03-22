<?php

require('fpdf.php');
class PDF extends FPDF
{
//Page header
function header(){
$this->SetFont('Times','B',18);
$this->SetTextColor(90,100,100);
$this->cell(0,5,'NZOIA WATER SERVICES COMPANY LTD',0,1,'C');
$this->SetFont('Times','',10);
$this->setX(249);
$this->cell(30,4,'Head Office: P.O Box 1010-50205',0,1,'R');
 $this->setX(247);
$this->cell(10,4,'Webuye',0,1,'L');
$this->setXY(15,16);
$this->cell(24,4,"If Undelivered",0,1,'L');
$this->setXY(15,20);
$this->cell(24,4,'Please return to:',0,1,'L');
$this->setXY(39,21);
$this->MultiCell(40,4,"The Commercial Manager\nNzoia Water Services Company Limited,\nP.o Box 1010, (50205)\nWebuye, Kenya\nTel: 020-2-6-536",0,'L',0);

}
function LoadData()
{
    //Logo
for($i=0;$i<40;$i++){

 

//$this->setX(80); 
/*
$this->setXY(228,38);
$this->cell(28,3,'INVOICE:',0,0,'L');
$this->cell(18,3,'T5655443R5',0,1,'L');
$this->setXY(228,42);
$this->cell(28,3,'DATE OF ISSUE:',0,0,'L');
$this->cell(18,3,'17th January,2012',0,1,'L');
$this->setY(48);
$this->cell(62,4,'THIS WATER BILL is due on or before:',0,0,'L');
$this->SetFont('Times','B',10);
$this->cell(30,4,'30th Jan,2012',0,1,'L');
$this->Ln(1);
$this->SetFont('Times','',8);
$this->SetFillColor(100,200,130);
$this->SetFont('Times','B',10);
$this->cell(0,5,'WATER BILL',1,1,'C',1);
$this->Ln(1);
$this->SetFont('Times','',10);
$this->Rect(10,58,277,20);
$this->Line(150,58,150,78);
//$this->setX(85);
$this->MultiCell(80,4,"To:\nAlfayo Kwatuha Mulimani\nP.O Box 234-40301\nELDORET\n",0,'L',0);
$this->setXY(198,58);
$this->SetFont('Times','',10);
$this->cell(30,5,"BILLING PERIOD:",0,0,'L');
$this->cell(20,5,'15th January,2012',0,1,'L');
$this->setX(198);
$this->cell(30,5,'CONNECTION No:',0,0,'L');
$this->cell(25,5,'09846746T7YT5',0,1,'L');
$this->setX(198);
$this->cell(30,5,'METER No:',0,0,'L');
$this->cell(30,5,'09846746T7YT5',0,0,'L');
$this->cell(10,5,'Cust:',0,0,'L');
$this->cell(30,5,'Cust',0,1,'L');
$this->setX(198);
$this->cell(30,5,'CATEGORY:',0,0,'L');
$this->cell(30,5,'Domestic',0,0,'L');
$this->cell(10,5,'SIZE:',0,0,'L');
$this->cell(30,5,'SIZE',0,1,'L');
//$this->setX(85);
$this->Ln(2);
$this->SetFont('Times','B',8);
$this->SetFillColor(100,200,130); 
$this->cell(45,4,'PREVIOUS READING',1,0,'C',1);
$this->cell(50,4,'PREVIOUS READING DATE',1,0,'C',1);

$this->cell(45,4,'CURRENT READING',1,0,'C',1);
$this->cell(50,4,'CURRENT READING DATE',1,0,'C',1);

$this->cell(43,4,'CONSUMPTION(M3)',1,0,'C',1);
$this->cell(44,4,'ESTIMATE(M3)',1,1,'C',1);
$this->SetFont('Times','B',10);
$this->cell(45,4,'259',1,0,'C');
$this->cell(50,4,'12/12/2011',1,0,'C');

$this->cell(45,4,'280',1,0,'C');
$this->cell(50,4,'12/01/2012',1,0,'C');

$this->cell(43,4,'21',1,0,'C');
$this->cell(44,4,'0',1,1,'C');
 $this->SetFont('Times','B',7);
$this->cell(190,4,'ACCOUNTS DETAILS:',1,0,'C',1);
$this->cell(87,4,'AMOUNT IN KSH',1,1,'R',1);
$this->SetFont('Times','',8);
$this->cell(190,4,"                                                                 BALANCE B/F FROM LAST BILL",1,0,'C');
$this->SetFont('Times','',10);
$this->cell(87,4,number_format(5000,2),1,1,'R');
$this->SetFont('Times','',8);
$this->cell(190,4,'                                                                                  PAYMENTS CREDITED SINCE LAST BILL',1,0,'C');
$this->SetFont('Times','',10);
$this->cell(87,4,number_format(2000,2),1,1,'R');
$this->SetFont('Times','B',10);
$this->cell(190,4,'                                                    ACCOUNT BALANCE B/F',1,0,'C');
$this->cell(87,4,number_format(3000,2),1,1,'R');
$this->SetFont('Times','',10);


for($i=0;$i<5;$i++){
if($i==0){
$this->cell(190,4,'Meter Rent','RLT',0,'R');
$this->cell(87,4,number_format(2000,2),'RLT',1,'R');
}
else if($i==4){
$this->cell(190,4,'ADJUSTMENTS','RLB',0,'R');
$this->cell(87,4,number_format(2000,2),'RLB',1,'R');
}
else{
$this->cell(190,4,'Meter Rent','RL',0,'R');
$this->cell(87,4,number_format(2000,2),'RL',1,'R');
}


}
$this->SetFont('Times','B',10);
$this->cell(190,4,'TOTAL CHARGES','RLB',0,'R');
$this->cell(87,4,number_format(2500,2),'RLB',1,'R');
$this->cell(190,4,'TOTAL DUE','RLB',0,'R');
$this->cell(87,4,number_format(3500,2),'RLB',1,'R');
$this->SetFont('Times','BI',10);
$this->cell(60,4,'Message to Consumer',0,1,'L');
$this->MultiCell(0,3,"\n\n\n",1,'L',0);
$this->Ln(4);
$this->cell(0,3,'','T',1,'L');
$this->SetFont('Times','B',10);
$this->cell(0,5,'Complete this portion, cut off along the line above and attach to the payment deposit slip when payment is made or use cheque payments',0,1,'L');
$this->cell(177,5,'',1,0,'R');
$this->cell(50,5,'Invoice No:',1,0,'R');
$this->cell(50,5,'',1,1,'L');

$this->cell(177,5,'',1,0,'R');
$this->cell(50,5,'Total Due:',1,0,'R');
$this->cell(50,5,'',1,1,'L');

$this->cell(177,5,'',1,0,'R');
$this->cell(50,5,'Amount Paid:',1,0,'R');
$this->cell(50,5,'',1,1,'L');

$this->cell(177,5,'',1,0,'R');
$this->cell(50,5,'',1,0,'R');
$this->cell(50,5,'',1,1,'L');
$this->Image('cut.gif',274,146,6,6);
$this->cell(88,5,'  Your Fixed Deposit:',0,0,'L');
$this->cell(89,5,'Receipt Number:',0,0,'L');
$this->cell(50,5,' Receipt Date:',0,0,'L');
$this->cell(50,5,'',0,1,'L');
$this->setFont('Times','B',12);
$this->cell(0,3,'NZOIA CLUSTER',0,1,'C');
$this->setFont('Times','',10);
$this->cell(69,3,'Kitale',0,0,'L');
$this->cell(69,3,'Bungoma',0,0,'C');
$this->cell(69,3,'Webuye',0,0,'C');
$this->cell(70,3,'Kimilili',0,1,'R');
*/
$this->Ln(400);
}
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
//$pdf->SetFont('Arial','',12);
$pdf->LoadData();
//$pdf->SetFont('Arial','',8);

$pdf->Output();


?>