<?php

require('fpdf.php');
require('../bdates.php');
include('../db_connections/aardb_conn.php'); 
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
function LoadData()
{
            $selacc="SELECT DISTINCT autoid FROM property WHERE isactive=1 ORDER BY autoid ASC";
            $qryacc=mysql_query($selacc);
            if($qryacc){
                $accountsarr=array();
                while($rws=mysql_fetch_array($qryacc)){
                $autoid=$rws['autoid'];
                $accountsarr[]=$autoid;
                }
            
            }
            else{
            $this->Ln(40);
            $this->cell(24,4,'There was an error accessing Customer Accounts',0,1,'C');
            }
  $invoiceno=13564533;
  
   function display($data){
  $data=stripslashes($data);
  return $data;
 }
   
foreach( $accountsarr as $acc){
$invoiceno++;
$sqldets="SELECT property.autoid,block, plot, serial,size,connectionno,street,estate,custname,address,idno,property.accountno from (property inner join meter on property.accountno=meter.accountno) inner join basicinfo  on property.custid=basicinfo.idno WHERE property.autoid=$acc";  
$qrydets=mysql_query($sqldets);
if($qrydets){
 $detsrws=mysql_fetch_array($qrydets);
 $block=$detsrws['block'];
 $plot=$detsrws['plot'];
 $serial=$detsrws['serial'];
 $size=$detsrws['size'];
 $connectionno=$detsrws['connectionno'];
 $street=$detsrws['street'];
 $estate=$detsrws['estate'];
 $custname=$detsrws['custname'];
 
 //#######################
 $street=display($street);
 $estate=display($estate);
 $custname=display($custname);
 //############################
 $address=$detsrws['address'];
 $xplodaddr=explode(" ",$address);
 $lstpos=sizeof($xplodaddr)-1;
 $lstelem=strtoupper($xplodaddr[$lstpos]) ;
 array_pop($xplodaddr);
 $finaddr=implode(" ", $xplodaddr);
 //##########################
 $idno=$detsrws['idno'];
 $accountno=$detsrws['accountno'];
 $connid=$block."/".$plot."/".$connectionno;
 
 

 
 //################################# working with dates ###################
 $thedates=getdates();
 $xploddates=explode("|",$thedates);
 $prevd=$xploddates[0];
 $cd=$xploddates[1];
 $now=date("d F, Y");
 $prevdd=strtotime($prevd);
 $prevdd=date("d - M,Y",$prevdd);
 $cdd=strtotime($cd);
 $cdd=date("d - M,Y",$cdd);
 
 $cddd="15-".date("m-Y");
 //$cddd=strtotime($cddd);
// $cddd=date("d F,Y");
 //########################### end of working with dates #####################
 
 //############################### fetch current and preevious readings ############
 $prvreading=getprevreading($accountno,$prevd);
 $creading=getprevreading($accountno,$cd);
 $consumption=getConsumption($accountno);
 $charges=val($consumption);
 // end of fetch readings#############################################################
}
else{
 $this->Ln(40);
 $this->cell(24,4,'There was an error accessing accounts details',0,1,'C');
 
}    
//
//$this->setXY(228,38);
$this->cell(28,3,'INVOICE:',0,0,'L');
$this->cell(18,3,$invoiceno,0,1,'L');
$this->setXY(228,42);
$this->cell(28,3,'DATE OF ISSUE:',0,0,'L');
$this->cell(18,3,$now,0,1,'L');
$this->setY(48);
//$this->cell(62,4,$connid,0,0,'L');
$this->cell(62,4,'THIS WATER BILL is due on or before:',0,0,'L');
$this->SetFont('Times','B',10);
$this->cell(30,4,'30th '.date("F").' ,2012',0,1,'L');
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
$this->MultiCell(80,4,"To:\n$custname\n$finaddr\n$lstelem\n",0,'L',0);
$this->setXY(198,58);
$this->SetFont('Times','',10);
$this->cell(30,5,"BILLING PERIOD:",0,0,'L');
$this->cell(20,5,$cdd,0,1,'L');
$this->setX(198);
$this->cell(30,5,'CONNECTION No:',0,0,'L');
$this->cell(25,5,$connid,0,1,'L');
$this->setX(198);
$this->cell(30,5,'METER No:',0,0,'L');
$this->cell(30,5,$serial,0,0,'L');
$this->cell(10,5,'',0,0,'L');
$this->cell(30,5,'',0,1,'L');
$this->setX(198);
$this->cell(30,5,'CATEGORY:',0,0,'L');
$this->cell(30,5,'Domestic',0,0,'L');
$this->cell(10,5,'SIZE:',0,0,'L');
$this->cell(30,5,$size." mm",0,1,'L');
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
$this->cell(45,4,$prvreading,1,0,'C');
$this->cell(50,4,$prevdd,1,0,'C');

$this->cell(45,4,$creading,1,0,'C');
$this->cell(50,4,$cdd,1,0,'C');

$this->cell(43,4,$consumption,1,0,'C');
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
$this->cell(87,4,number_format($charges,2),'RLB',1,'R');
$this->cell(190,4,'TOTAL DUE','RLB',0,'R');
$this->cell(87,4,number_format($charges,2),'RLB',1,'R');
$this->SetFont('Times','BI',10);
$this->cell(60,4,'Message to Consumer',0,1,'L');
$this->MultiCell(0,3,"\n\n\n",1,'L',0);
$this->Ln(4);
$this->cell(0,3,'','T',1,'L');
$this->SetFont('Times','B',10);
$this->cell(0,5,'Complete this portion, cut off along the line above and attach to the payment deposit slip when payment is made or use cheque payments',0,1,'L');
$this->cell(177,5,'',1,0,'R');
$this->cell(50,5,'Invoice No:',1,0,'R');
$this->cell(50,5,$invoiceno,1,1,'L');

$this->cell(177,5,'',1,0,'R');
$this->cell(50,5,'Total Due:',1,0,'R');
$this->cell(50,5,number_format($charges,2),1,1,'L');

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

$this->Ln(4000);
    	
    } //end of foreach

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