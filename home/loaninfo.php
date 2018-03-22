<?php
$loanid=trim($_GET['loanid']);
$period=trim($_GET['period']);
$loanamount=trim($_GET['loanamount']);
require_once('../Connections/cf4_HH.php');

$sqldates="SELECT * from loans_loan where loan_id=$loanid";
$addControll='';
$qrydates=mysql_query($sqldates);
 $numrws=mysql_num_rows($qrydates);
    if($numrws){
		$rws=mysql_fetch_array($qrydates);
        $interest_rate=$rws['interest_rate'];
		if((is_numeric($loanamount))&&(is_numeric($period))&&(is_numeric($loanid))){
				$addControll='Interest<span   id="interestrate">&nbsp;&nbsp;:&nbsp;'.$interest_rate.'</span><br />
		';
		
		$totalduedue=(($interest_rate/100)+1)*$loanamount;
		$addControll.='Total Due<span   id="totaldue">&nbsp;&nbsp;:&nbsp;'.number_format($totalduedue,2).'</span><br />
		';
		$monthlinstallment=$totalduedue/$period;
		$addControll.='Installment<span   id="monthlyrepayment">&nbsp;&nbsp;:&nbsp;'.number_format($monthlinstallment,2).'</span><br />
		';
		
		 if($addControll){
		 print '<p class="date">Loan Summary</p>';
 print $addControll;

}
		}else{
		echo 'Incorrect Information for rate/period/loan type!';
		}
	}
?>