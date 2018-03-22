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
if($_SESSION['rptsyssource']=='est'){

$this->cell(0,5,'Zulmac Agencies Limited',0,1,'C');

}else{
$this->cell(0,5,'Zulmac Insurance Brokers Limited',0,1,'C');
}
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


  $this->Cell(200,0,'','T');
$this->SetFont('Arial','',12);
  $this->Ln(2);
  $this->SetFont('Courier','',8);
  $this->Ln(5);
 $this->CreateAddressHeader();
 
  if($_SESSION['insdebitnoteid']){
   
  }
  else{
  
 $lablevals=explode(',',"Ref,From,To,Date");
 
 if(!$_SESSION['yry']){
					 $this->CreateTables($lablevals,75,145,15,1,'L');
					 
					 if($_SESSION['rptrptstart']){
							$starts=$_SESSION['rptrptstart'];
							}else{
							$starts=$_SESSION['rptrptcontractdate'];
							}
					
					if($_SESSION['rptrptend']){
					$ends=$_SESSION['rptrptend'];
					}else{
					$ends=date('Y-m-d');//
					}
					$datetoday=date('d-m-Y');
					$valsref=$_SESSION['rptrptref'].','.$starts. ','.$ends.','.$datetoday;
					$lablevals=explode(',',$valsref);
					$this->CreateTables($lablevals,75,160,45,1,'V');
 }
 
  }
 
 
 
 /////
		
/////////////////////////////////////////////
//Now create table headers
$_SESSION['cashbankcolscaptions']="
#^
Received From^
A/C ^
Check/Voucher #^
amount^
Trans. Type^
Description^
Payment Mode
"; 
$_SESSION['cashbankcolwidth']="
AI|5,
received_from|40,
accaccount_name |25,
check_number|25,
amount|20,
transaction_type|10,
naration|50,
payment_mode|20
";

$headercaptions=explode('^',$_SESSION['cashbankcolscaptions']);
$finfo=explode(',',$_SESSION['cashbankcolwidth']);
$x=0;
$widthdetails='';
$headerfields='';

foreach($finfo as $finfoitem){
$d=explode('|',$finfoitem);
$widthdetails[$x]=$d[1];
$headerfields[$x]=$d[0];
$x++;

}

if($_SESSION['yry']){
//do not print headers
}else{
		if(($_SESSION['rptacccategory']!=53)&&($_SESSION['rptacccategory']!=57)){
		$this->CreateQueryTableHeaders($headercaptions,$widthdetails);
		}

}


}

