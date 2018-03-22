<?php

require('fpdf.php');
require('../bdates.php');
include('../db_connections/aardb_conn.php'); 
class PDF extends FPDF
{
//Page header
function header(){

  $zone=3;
  $walk=3;


$this->SetFont('Times','B',14);
$this->SetTextColor(90,100,100);
$this->cell(0,5,'NZOIA WATER SERVICES COMPANY LTD',0,1,'C');
$this->SetFont('Times','B',10);

if($walk!=0){
$this->cell(0,5,'Variance for Zone:'.$zone.', Walk:'.$walk,0,1,'C');
}
else{
$this->cell(0,5,'Variance for Zone:'.$zone,0,1,'C');
}

$this->Ln(3);

  $this->SetFont('Courier','B',9);
  $this->cell(25,5,'Account',0,0,'L');
  $this->cell(25,5,'Connid',0,0,'C');
  
  $this->cell(40,5,'Consumer',0,0,'L');
  $this->cell(20,5,'Meter No.',0,0,'L');
  $this->cell(25,5,'Previous Rd',0,0,'L');
  $this->cell(25,5,'Current Rd',0,0,'L');
  $this->cell(30,5,'Consumption',0,1,'C');
  $this->setLineWidth(0.7);
  $this->cell(0,4,'','T',1,'C');

} 

//Page footer
function Footer()
{

   //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Courier','B',6);
    //Page number
    $this->Cell(0,6,'Page '.$this->PageNo().' of {nb}',0,1,'R');
    $this->cell(0,4,'Nzoia Water Services Company Limited',0,0,'C');
    
	 
 
}
function LoadData()
{

            $zone=3;
            $walk=3;
            if($walk!=0){
              $selacc="SELECT DISTINCT autoid FROM property WHERE zone=$zone AND walk=$walk AND isactive=1 ORDER BY block,plot,connectionno";
            }
            else{
              $selacc="SELECT DISTINCT autoid FROM property WHERE zone=$zone  AND isactive=1 ORDER BY walk,block,plot,connectionno";
            
            }
            
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
 $tracker=0;  
foreach( $accountsarr as $acc){
$tracker++;
$invoiceno++;
$sqldets="SELECT property.autoid,block, plot,zone,walk, serial,size,connectionno,street,estate,custname,address,idno,property.accountno from (property inner join meter on property.accountno=meter.accountno) inner join basicinfo  on property.custid=basicinfo.idno WHERE property.autoid=$acc";  
$qrydets=mysql_query($sqldets);
if($qrydets){
 $detsrws=mysql_fetch_array($qrydets);
 $block=$detsrws['block'];
 $plot=$detsrws['plot'];
 $serial=$detsrws['serial'];
 $zone=$detsrws['zone'];
 $connectionno=$detsrws['connectionno'];
 $walk=$detsrws['walk'];
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
  //$this->Ln(8); 
  $determinant=$tracker%2;
  if($determinant==1){
    $rw=1;
  }
  else{
    $rw=0;
  }
  $this->SetFillColor(204,255,255);
    
  $this->SetFont('Times','',8);
  
  
  $this->cell(25,4,$accountno,0,0,'L',$rw);
  $this->cell(25,4,$connid,0,0,'C',$rw);
 
  $this->cell(40,4,$custname,0,0,'L',$rw);
  $this->cell(20,4,$serial,0,0,'L',$rw);
  $this->cell(25,4,$prvreading,0,0,'C',$rw);
  $this->cell(25,4,$creading,0,0,'C',$rw);
  $this->cell(30,4,$consumption,0,1,'C',$rw);
    	
    } //end of foreach

}

 


}
$pdf=new PDF('P','mm','A4');

$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetFont('Arial','',12);
$pdf->LoadData();
//$pdf->SetFont('Arial','',8);

$pdf->Output();


?>