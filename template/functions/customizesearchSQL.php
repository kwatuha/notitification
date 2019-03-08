<?php
$sqlsdss="SELECT
admin_person.person_id,
admin_person.first_name,
admin_person.middle_name,
admin_person.last_name,
patient_obs.obs_id,
patient_obs.obs_date,
DATEDIFF(date_format(patient_obs.obs_date,\"%Y%m%d\"),date_format(now(),\"%Y%m%d\")) days
FROM patient_obs
inner join admin_person on admin_person.person_id=patient_obs.person_id";

$updateStr="update  insurance_insurancedebitnote
inner join admin_person on admin_person.person_id = insurance_insurancedebitnote.person_id  
set insurance_insurancedebitnote.date_created =admin_person.date_created ";
$_SESSION['checkpaymentsummary']="

select 
'accounts_directtransferout' transtbl,
accounts_directtransferout.directtransferout_id refid, 
accounts_directtransferout.directtransferout_name ref,
a.bankaccount_name company_acc,
b.bankaccount_name client_acc,
accounts_directtransferout.date_transferred date_banked,
'' date_cleared ,
'' check_details , 
'' check_number ,
 '' check_date , 
accounts_directtransferout.amount , 
accounts_directtransferout.transaction_type , 
accounts_directtransferout.naration , 
accounts_directtransferout.created_by , 
accounts_directtransferout.date_created ,

accounts_directtransferout.voided ,
' Cash Transfered to Client A/C' source, 
accounts_directtransferout.uuid 

from accounts_directtransferout 
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_directtransferout.accaccount_id
inner join  bank_bankaccount a on a.bankaccount_id=accounts_directtransferout.company_account
inner join  bank_bankaccount b on b.bankaccount_id=accounts_directtransferout.client_account

where accounts_directtransferout.voided !=1 AND {directTransfer}

union

select 
'accounts_custcashdeposit' transtbl,
accounts_custcashdeposit.custcashdeposit_id refid,
accounts_custcashdeposit.custcashdeposit_name ref, 
'' company_acc,
' ' client_acc,
accounts_custcashdeposit.date_banked ,
'' date_cleared ,
'' check_details , 
'' check_number ,
 '' check_date ,
accounts_custcashdeposit.amount , 
accounts_custcashdeposit.transaction_type , 
accounts_custcashdeposit.naration , 
accounts_custcashdeposit.created_by , 
accounts_custcashdeposit.date_created , 
accounts_custcashdeposit.voided ,
' Cash Deposited in Client A/C' source, 
accounts_custcashdeposit.uuid 
 from accounts_custcashdeposit 
 inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_custcashdeposit.accaccount_id
 where accounts_custcashdeposit.voided=0 AND {cashDeposit}

union

select
'accounts_cashtrans' transtbl,
accounts_cashtrans.cashtrans_id refid,
 accounts_cashtrans.cashtrans_name  ref,
'' company_acc,
' ' client_acc,
'' date_banked ,
'' date_cleared ,
'' check_details , 
 ' '	check_number	,
 ' '	check_date	,
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type ,
accounts_cashtrans.naration ,
accounts_cashtrans.created_by , 
accounts_cashtrans.date_created , 
accounts_cashtrans.voided ,
'Cash Given' source,
accounts_cashtrans.uuid 


from accounts_cashtrans
where accounts_cashtrans.voided=0 AND {cashTrahs}

union

select 
'accounts_custcheckregister' transtbl,
accounts_custcheckregister.custcheckregister_id refid ,
 accounts_custcheckregister.custcheckregister_name ref , 
bank_bankaccount.bankaccount_name company_acc , 
' ' client_acc,
'' date_banked ,
'' date_cleared ,
accounts_custcheckregister.check_details , 
accounts_custcheckregister.check_number ,
 accounts_custcheckregister.check_date , 
accounts_custcheckregister.amount , 
accounts_custcheckregister.transaction_type ,
 accounts_custcheckregister.naration , 
accounts_custcheckregister.created_by , 
accounts_custcheckregister.date_created , 
 accounts_custcheckregister.voided ,
'Deposited in Client A/C' source, 
 accounts_custcheckregister.uuid
from accounts_custcheckregister 
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_custcheckregister.accaccount_id  
inner join bank_bankaccount on bank_bankaccount.bankaccount_id = accounts_custcheckregister.bankaccount_id

where accounts_custcheckregister.custcheckregister_id  Not in(select custcheckregister_id from accounts_custcheckdeposit  where voided=0)
and accounts_custcheckregister.voided=0 and {custCheckTrahs}

Union

select 
'accounts_custcheckdeposit' transtbl,
accounts_custcheckdeposit.custcheckdeposit_id  refid, 
accounts_custcheckdeposit.custcheckdeposit_name  ref, 
' ' company_acc , 
bank_bankaccount.bankaccount_name client_acc,
accounts_custcheckdeposit.date_banked  ,
accounts_custcheckdeposit.date_cleared ,
accounts_custcheckregister.check_details , 
accounts_custcheckregister.check_number ,
 accounts_custcheckregister.check_date , 
accounts_custcheckregister.amount , 
accounts_custcheckregister.transaction_type ,
 accounts_custcheckregister.naration ,
accounts_custcheckregister.created_by , 
accounts_custcheckregister.date_created , 
 accounts_custcheckregister.voided , 
'Collected Checks' source,
accounts_custcheckdeposit.date_created 
 from accounts_custcheckdeposit 
 inner join accounts_custcheckregister on accounts_custcheckregister.custcheckregister_id = accounts_custcheckdeposit.custcheckregister_id 
 inner join bank_bankaccount on bank_bankaccount.bankaccount_id = accounts_custcheckdeposit.bankaccount_id

where accounts_custcheckregister.custcheckregister_id   in(select custcheckregister_id from accounts_custcheckdeposit  where voided=0)
and accounts_custcheckdeposit.voided=0 and {custCheckDepostTrahs}
";

$_SESSION['cashCheckSummary']="
select cc.accountscategory_name,
sum(cc.check_received) check_received,
sum(cc.check_paid ) check_paid,
sum(cc.cash_trans ) cash_trans,
cc.created_by,
cc.date_created 
from
(select 
accounts_accountscategory.accountscategory_name,
sum(accounts_accountactivity.amount) check_received,
0 check_paid,
0 cash_trans,
accounts_accountactivity.created_by,
accounts_accountactivity.date_created


from accounts_accountactivity
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_accountactivity.accountscategory_id  
where accounts_accountactivity.accaccount_id 

in (select accaccount_id from accounts_checkregister where accounts_checkregister.voided=0 
and  accounts_checkregister.date_created=accounts_accountactivity.date_created  {andcheckdates}  {andcheckcreatedby} )


group by accounts_accountscategory.accountscategory_name,accounts_accountactivity.date_created

union 

select 
accounts_accountscategory.accountscategory_name,
0 check_received,
sum(accounts_accountactivity.amount) check_paid,
0 cash_trans,
accounts_accountactivity.created_by,
accounts_accountactivity.date_created

from accounts_accountactivity
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_accountactivity.accountscategory_id  
where accounts_accountactivity.accaccount_id
 in (select accaccount_id from accounts_custcheckregister where accounts_custcheckregister.voided=0
           and  accounts_custcheckregister.date_created=accounts_accountactivity.date_created {andcustheckdates}  {andcustcheckcreatedby} 

)
group by accounts_accountscategory.accountscategory_name,accounts_accountactivity.date_created


union
select 
accounts_accountscategory.accountscategory_name,
0 check_received,
0 check_paid,
sum(accounts_cashtrans.amount ) cash_trans,
accounts_cashtrans.created_by,
accounts_cashtrans.date_created date_created
 from accounts_cashtrans  
 inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_cashtrans.accaccount_id 
 inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_cashtrans.accountscategory_id  
 inner join payment_currency on payment_currency.currency_id = accounts_cashtrans.currency_id
 where accounts_cashtrans.voided=0 {andcashdates} {andcashcreatedby}
group by accounts_accountscategory.accountscategory_name,accounts_cashtrans.date_created
) cc
{andsearch}
group by cc.accountscategory_name,cc.date_created
order by  cc.accountscategory_name,cc.date_created desc

";
$_SESSION['managepatientrcds']="
select  
0 queue_id , 
'' queue_name , 
'' patient_age , 
'' hospital_number , 
'' visit_type , 
'' referring_facility , 
'' reporting_date , 
'' diagnosis_type , 
'' other_details ,

admin_person.person_id , 
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, 
 'Queue' action
 
 from admin_person 

where admin_person.person_id  in  (select admin_personpersontype.person_id from admin_personpersontype where admin_personpersontype.personttypecategory_id=7  )
AND admin_person.person_id  not in(select person_id from medicallab_queue where sys_track='Queued' )
AND admin_person.voided=0


Union

select medicallab_queue.queue_id , 
medicallab_queue.queue_name , 
medicallab_queue.patient_age , 
medicallab_queue.hospital_number , 
medicallab_queue.visit_type , 
medicallab_queue.referring_facility , 
medicallab_queue.reporting_date , 
medicallab_queue.diagnosis_type , 
medicallab_queue.other_details ,
admin_person.person_id , 
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname,  
medicallab_queue.sys_track  action

from medicallab_queue  inner join admin_person on admin_person.person_id = medicallab_queue.person_id
where medicallab_queue.sys_track not like 'Results Approved'";
$_SESSION['patientmissiedue']="
select admin_person.person_id , CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, admin_person.date_created, 'Send to Queue' source
 from admin_person 

where admin_person.person_id  in  (select admin_personpersontype.person_id from admin_personpersontype where admin_personpersontype.personttypecategory_id=7  )
AND admin_person.person_id  not in(select person_id from medicallab_queue where sys_track='Queued' )
AND admin_person.voided=0";


$_SESSION['combinedPatientData']="
select 
'medicallab_histology' source,
medicallab_histology.histology_id source_id,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, 
 medicallab_queue.person_id ,
 admin_person.gender,
 medicallab_queue.queue_id , 
medicallab_queue.queue_name , 
medicallab_queue.diagnosis_type,
medicallab_queue.hospital_number,
medicallab_queue.other_details,
medicallab_queue.patient_age,
medicallab_queue.referring_facility,
medicallab_histology.reporting_date , 
medicallab_histology.sample_collection_date , 
medicallab_histology.physician ,
 medicallab_histology.clinical_history , 
medicallab_histology.microscopy ,
'' biopsy_site,  
medicallab_histology.conclusion , 
'' diagnosis,
'' non_neoplastic_conditions,
'' squamous_cell_abnormalities,
'' within_normal, 
'' adequacy,
medicallab_histology.comments , 
medicallab_histology.created_by , 
medicallab_histology.date_created  
from medicallab_histology  
inner join medicallab_queue on medicallab_queue.queue_id = medicallab_histology.queue_id
inner join admin_person on medicallab_queue.person_id=admin_person.person_id
where medicallab_histology.voided=0 {approvalwhere}


UNION

select 
'medicallab_papsmear' source,
medicallab_papsmear.papsmear_id  source_id,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, 
 medicallab_queue.person_id ,
 admin_person.gender,
 medicallab_queue.queue_id , 
medicallab_queue.queue_name , 
medicallab_queue.diagnosis_type,
medicallab_queue.hospital_number,
medicallab_queue.other_details,
medicallab_queue.patient_age,
medicallab_queue.referring_facility,
medicallab_papsmear.reporting_date , 
medicallab_papsmear.sample_collection_date , 
medicallab_papsmear.physician ,
'' clinical_history , 
'' microscopy ,
'' biopsy_site, 
'' conclusion ,

medicallab_papsmear.diagnosis,
medicallab_papsmear.non_neoplastic_conditions,
medicallab_papsmear.squamous_cell_abnormalities,
medicallab_papsmear.within_normal, 
medicallab_papsmear.adequacy,
medicallab_papsmear.comments , 
medicallab_papsmear.created_by , 
medicallab_papsmear.date_created  
from medicallab_papsmear 
inner join medicallab_queue on medicallab_queue.queue_id = medicallab_papsmear.queue_id
inner join admin_person on medicallab_queue.person_id=admin_person.person_id
where medicallab_papsmear.voided=0  {approvalwhere}


UNION

select 
'medicallab_labresult' source,
medicallab_labresult.labresult_id  source_id,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, 
 medicallab_queue.person_id ,
 admin_person.gender,
 medicallab_queue.queue_id , 
medicallab_queue.queue_name , 
medicallab_queue.diagnosis_type,
medicallab_queue.hospital_number,
medicallab_queue.other_details,
medicallab_queue.patient_age,
medicallab_queue.referring_facility,
medicallab_labresult.reporting_date , 
medicallab_labresult.sample_collection_date , 
medicallab_labresult.physician ,
medicallab_labresult.clinical_history , 
medicallab_labresult.microscopy ,
medicallab_labresult.biopsy biopsy_site , 
'' conclusion ,
medicallab_labresult.diagnosis,
'' non_neoplastic_conditions,
'' squamous_cell_abnormalities,
'' within_normal, 
'' adequacy,
medicallab_labresult.comments , 
medicallab_labresult.created_by , 
medicallab_labresult.date_created  
from medicallab_labresult 
inner join medicallab_queue on medicallab_queue.queue_id = medicallab_labresult.queue_id
inner join admin_person on medicallab_queue.person_id=admin_person.person_id
where medicallab_labresult.voided=0  {approvalwhere}

";
$_SESSION["CompanySearchSQL"]="
						select 
bank_bankaccount.bankaccount_name , bank_bankaccount.bank , payment_currency.currency_name , bank_bankaccount.branch , bank_bankaccount.description
from bank_bankaccount  inner join payment_currency on payment_currency.currency_id = bank_bankaccount.currency_id

where bank_bankaccount.syowner='admin_company'
and bank_bankaccount.voided=0
						
						
						
						";
$_SESSION["PayrollStaticAll"]="
select hrpayroll_payperiodstatic.payperiodstatic_id ,
 hrpayroll_payperiod.payperiod_id ,
 hrpayroll_payperiod.payperiod_name , 
hrpayroll_payperiod.payperiod_code,
hrpayroll_payperiod.payperiod_date,
hrpayroll_payperiod.time_sheet_closure,
bank_bankaccount.bankaccount_name,
bank_bankaccount.branch,
bank_bankaccount.bank,
 admin_person.person_id ,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, admin_personpersontype.personpersontype_name,
admin_personttypecategory.personttypecategory_name,
hrpayroll_payperiodstatic.total_deduction ,
 hrpayroll_payperiodstatic.paye , 
hrpayroll_payperiodstatic.nssf ,
 hrpayroll_payperiodstatic.employer_nssf ,
 hrpayroll_payperiodstatic.basic_pay , 
hrpayroll_payperiodstatic.nhif , 
hrpayroll_payperiodstatic.gross_pay ,
 hrpayroll_payperiodstatic.net_pay , 
hrpayroll_payperiodstatic.loans_and_advances , 
hrpayroll_payperiodstatic.created_by , 
hrpayroll_payperiodstatic.date_created 
from hrpayroll_payperiodstatic  
inner join hrpayroll_payperiod on hrpayroll_payperiod.payperiod_id = hrpayroll_payperiodstatic.payperiod_id  
inner join admin_person on admin_person.person_id = hrpayroll_payperiodstatic.person_id
inner join admin_personpersontype on  admin_person.person_id = admin_personpersontype.person_id
inner join admin_personttypecategory on admin_personpersontype.personttypecategory_id=admin_personttypecategory.personttypecategory_id
left join bank_bankaccount on bank_bankaccount.syownerid= admin_person.person_id 
where  hrpayroll_payperiodstatic.voided=0
 ";
$_SESSION["PayrollStatic"]="
select hrpayroll_payperiodstatic.payperiodstatic_id ,
 hrpayroll_payperiod.payperiod_id ,
 hrpayroll_payperiod.payperiod_name , 
hrpayroll_payperiod.payperiod_code,
hrpayroll_payperiod.payperiod_date,
hrpayroll_payperiod.time_sheet_closure,
bank_bankaccount.bankaccount_name,
bank_bankaccount.branch,
bank_bankaccount.bank,
 admin_person.person_id ,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, admin_personpersontype.personpersontype_name,
admin_personttypecategory.personttypecategory_name,
hrpayroll_payperiodstatic.total_deduction ,
 hrpayroll_payperiodstatic.paye , 
hrpayroll_payperiodstatic.nssf ,
 hrpayroll_payperiodstatic.employer_nssf ,
 hrpayroll_payperiodstatic.basic_pay , 
hrpayroll_payperiodstatic.nhif , 
hrpayroll_payperiodstatic.gross_pay ,
 hrpayroll_payperiodstatic.net_pay , 
hrpayroll_payperiodstatic.loans_and_advances , 
hrpayroll_payperiodstatic.created_by , 
hrpayroll_payperiodstatic.date_created 
from hrpayroll_payperiodstatic  
inner join hrpayroll_payperiod on hrpayroll_payperiod.payperiod_id = hrpayroll_payperiodstatic.payperiod_id  
inner join admin_person on admin_person.person_id = hrpayroll_payperiodstatic.person_id
inner join admin_personpersontype on  admin_person.person_id = admin_personpersontype.person_id
inner join admin_personttypecategory on admin_personpersontype.personttypecategory_id=admin_personttypecategory.personttypecategory_id
left join bank_bankaccount on bank_bankaccount.syownerid= admin_person.person_id 
where  hrpayroll_payperiodstatic.voided=0
{andwhere} ";

$_SESSION["patientQueueInfo"]="
select 
'medicallab_histology' source,
medicallab_histology.histology_id ,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, 
 medicallab_queue.person_id ,
 admin_person.gender,
 medicallab_queue.queue_id , 
medicallab_queue.queue_name , 
medicallab_queue.diagnosis_type,
medicallab_queue.hospital_number,
medicallab_queue.other_details,
medicallab_queue.patient_age,
medicallab_queue.referring_facility,
medicallab_histology.reporting_date , 
medicallab_histology.sample_collection_date , 
medicallab_histology.physician ,
 medicallab_histology.clinical_history , 
medicallab_histology.microscopy , 
medicallab_histology.conclusion , 
medicallab_histology.comments , 
medicallab_histology.created_by , 
medicallab_histology.date_created  
from medicallab_histology  
inner join medicallab_queue on medicallab_queue.queue_id = medicallab_histology.queue_id
inner join admin_person on medicallab_queue.person_id=admin_person.person_id
where medicallab_histology.voided=0 {approvalwhere})
";

$_SESSION["debitNoteSQL"]="select  distinct insurance_insurancedebitnote.insurancedebitnote_id , 
accounts_accaccount.accaccount_name,
accounts_accaccount.accaccount_id,
 insurance_insurancedebitnote.insurancedebitnote_name , 
insurance_insurancedebitnote.policy_number , 
insurance_underwriter.underwriter_name , 
admin_person.person_id , 
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, 
insurance_insurancedebitnote.other_details, 
insurance_insurancedebitnote.created_by ,
 insurance_insurancedebitnote.date_created , 
insurance_insurancedebitnote.uuid  from insurance_insurancedebitnote 
 inner join insurance_underwriter on insurance_underwriter.underwriter_id = insurance_insurancedebitnote.underwriter_id 
 inner join admin_person on admin_person.person_id = insurance_insurancedebitnote.person_id  

inner join accounts_accaccount on accounts_accaccount.accaccount_name=insurance_insurancedebitnote.insurancedebitnote_name
{where}
";
$_SESSION["housinglandlordSearchSQL"]="
select housing_housinglandlord.housinglandlord_id , 
housing_housinglandlord.housinglandlord_name , 
admin_person.person_id ,CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ', admin_person. last_name ) person_fullname, 
admin_person.person_name , 
housing_housinglandlord.contract_day , 
admin_month.month_id , admin_month.month_name ,
 housing_housinglandlord.contract_year , 
 housing_housinglandlord.term_period , 
 housing_housinglandlord.term_months , 
 housing_housinglandlord.commission , 
 housing_housinglandlord.commission_alternative ,
  housing_housinglandlord.excess_amount , 
  housing_housinglandlord.payment_day , 
  housing_housinglandlord.property , 
  housing_housinglandlord.contract_dated , 
  housing_rentperiod.rentperiod_id , 
  housing_rentperiod.rentperiod_name , 
  housing_housinglandlord.created_by , 
  housing_housinglandlord.date_created
  from housing_housinglandlord  
  inner join admin_person on admin_person.person_id = housing_housinglandlord.person_id  inner join admin_month on admin_month.month_id = housing_housinglandlord.month_id  inner join housing_rentperiod on housing_rentperiod.rentperiod_id = housing_housinglandlord.rentperiod_id
  {where}
						
						
						";
$_SESSION['accounts_cashtrans_SearchSQL']="

select
c.cashtrans_id,
c.accaccount_id,
c.accaccount_name,
c.cashtrans_name,
c.voucher_number,
c.accountscategory_name,
c.currency_name,
c.amount,
c.transaction_type,
c.naration,
c.created_by,
c.date_created,
c.transaction_date,
c.ddate,
c.cmonth,
c.cday,
c.cyear,
p.person_fullname,
p.personttypecategory_name

from
(select distinct accounts_cashtrans.cashtrans_id , 
accounts_accaccount.accaccount_id ,
 accounts_accaccount.accaccount_name ,
 accounts_cashtrans.cashtrans_name , 
accounts_cashtrans.voucher_number , 
accounts_accountscategory.accountscategory_name ,
payment_currency.currency_name , 
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type , 
accounts_cashtrans.naration ,
 accounts_cashtrans.created_by , 
accounts_cashtrans.date_created ,
accounts_accountactivity.transaction_date,
date_format(accounts_accountactivity.transaction_date ,\"%d\/%b\/%Y\") ddate,
date_format(accounts_accountactivity.transaction_date ,\"%M\") cmonth,
date_format(accounts_accountactivity.transaction_date ,\"%d\") cday,
date_format(accounts_accountactivity.transaction_date ,\"%Y\") cyear,
 accounts_cashtrans.uuid
 from accounts_cashtrans 
 inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_cashtrans.accaccount_id 
 inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_cashtrans.accountscategory_id 
 inner join payment_currency on payment_currency.currency_id = accounts_cashtrans.currency_id
inner join accounts_accountactivity on accounts_accountactivity.accountactivity_name=accounts_cashtrans.cashtrans_name
where accounts_cashtrans.voided=0
) c ,

(select 
  accounts_accaccount.accaccount_id,
  admin_personpersontype.personpersontype_name ,
 admin_personttypecategory.personttypecategory_name , 
 CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ', admin_person. last_name ) person_fullname
  from admin_personpersontype  
  inner join admin_personttypecategory on admin_personttypecategory.personttypecategory_id = admin_personpersontype.personttypecategory_id  
  inner join admin_person on admin_person.person_id = admin_personpersontype.person_id
  inner join accounts_accaccount on accounts_accaccount.accaccount_name = admin_personpersontype.personpersontype_name
  where accounts_accaccount.voided=0  and admin_person.voided=0
  ) p
  
  where c.accaccount_id= p.accaccount_id  {and} ";
$_SESSION['dbnipf']="
select
'IPF' source,
insurance_policyfinance.policyfinance_name ,
insurance_dnpolicyfinance.bank , 
insurance_dnpolicyfinance.check_number ,
format(insurance_dnpolicyfinance.amount,2) amount , 
insurance_dnpolicyfinance.check_date

from insurance_dnpolicyfinance  
inner join insurance_policyfinance on insurance_policyfinance.policyfinance_id = insurance_dnpolicyfinance.policyfinance_id 
inner join insurance_insurancedebitnote on insurance_insurancedebitnote.insurancedebitnote_id = insurance_dnpolicyfinance.insurancedebitnote_id
{where}  
";


$_SESSION['dbncash']="
select  distinct
 'Cash' source,
'Personal' policyfinance_name ,
' ' bank , 
' ' branch, 
' ' check_number ,
 format(accounts_cashtrans.amount,2) amount , 
accounts_accountactivity.transaction_date check_date

from accounts_cashtrans


inner join accounts_accountactivity on accounts_cashtrans.accaccount_id=accounts_accountactivity.accaccount_id
{where}
And accounts_cashtrans.voided=0 And accounts_accountactivity.voided=0

";
$_SESSION['dbcheck']="select 
 'Check' source,
'Personal' policyfinance_name ,
accounts_checkregister.bank,
accounts_checkregister.branch,
accounts_checkregister.check_number,
 format(accounts_checkregister.amount,2) amount,
accounts_checkregister.check_date

from accounts_checkregister
{where}
And accounts_checkregister.voided=0";

$_SESSION['insdebitnoteitems']="
select
insurance_insurancedebitnoteitems.insurancedebitnoteitems_id ,accounts_accaccount.accaccount_id,accounts_accaccount.accaccount_name,
admin_personpersontype.personpersontype_name,
insurance_insuranceclass.insuranceclass_id ,
insurance_insuranceclass.insuranceclass_name,
Concat(insurance_insurancedebitnoteitems.insurancedebitnoteitems_id,insurance_insuranceclass.insuranceclass_name) classdescription, 
insurance_insurancedebitnote.insurancedebitnote_id , 
insurance_insurancedebitnote.insurancedebitnote_name ,
 insurance_policyscope.policyscope_id ,
 insurance_policyscope.policyscope_name ,
 insurance_insurancedebitnoteitems.period_from ,
insurance_insurancedebitnoteitems.period_to , 
insurance_insurancedebitnoteitems.description ,

insurance_insurancedebitnoteitems.commission ,
format( insurance_insurancedebitnoteitems.commission*insurance_insurancedebitnoteitems.basic_premium*0.01,2) comm_amt,
format(insurance_insurancedebitnoteitems.commission*insurance_insurancedebitnoteitems.basic_premium*0.01* insurance_insurancedebitnote.wtax*0.01,2) wtax_amt,
insurance_insurancedebitnoteitems.amount_insured,
 insurance_insurancedebitnote.policy_number , 
insurance_underwriter.underwriter_id , 
insurance_underwriter.underwriter_name ,
admin_personpersontype.personpersontype_name, 
admin_person.person_id , 
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname,
insurance_insurancedebitnote.other_details ,
 payment_currency.currency_id , 
 payment_currency.currency_name ,
insurance_insurancedebitnoteitems.basic_premium , 
 insurance_insurancedebitnote.pcf ,
 format(insurance_insurancedebitnoteitems.basic_premium * insurance_insurancedebitnote.pcf*0.01,2)  pcfamount,
 insurance_insurancedebitnote.training_levy ,
format( insurance_insurancedebitnoteitems.basic_premium * insurance_insurancedebitnote.training_levy*0.01,2) levyamount ,
 insurance_insurancedebitnote.stamp_duty ,
 insurance_insurancedebitnote.wtax,
 format( (insurance_insurancedebitnoteitems.basic_premium * insurance_insurancedebitnote.training_levy*0.01+
insurance_insurancedebitnoteitems.basic_premium * insurance_insurancedebitnote.pcf*0.01+
 insurance_insurancedebitnote.stamp_duty +
insurance_insurancedebitnoteitems.basic_premium),2) totalpremium,


format( (insurance_insurancedebitnoteitems.basic_premium * insurance_insurancedebitnote.wtax)*0.01,2) wtaxamount 

from insurance_insurancedebitnoteitems 
inner join insurance_insuranceclass on insurance_insuranceclass.insuranceclass_id = insurance_insurancedebitnoteitems.insuranceclass_id 
inner join insurance_insurancedebitnote on insurance_insurancedebitnote.insurancedebitnote_id = insurance_insurancedebitnoteitems.insurancedebitnote_id  
inner join insurance_policyscope on insurance_policyscope.policyscope_id = insurance_insurancedebitnoteitems.policyscope_id
 inner join insurance_underwriter on insurance_underwriter.underwriter_id = insurance_insurancedebitnote.underwriter_id 
 inner join admin_person on admin_person.person_id = insurance_insurancedebitnote.person_id 
 inner join payment_currency on payment_currency.currency_id = insurance_insurancedebitnote.currency_id
inner join admin_personpersontype on admin_personpersontype.person_id= admin_person.person_id 
inner join accounts_accaccount on accounts_accaccount.accaccount_name=admin_personpersontype.personpersontype_name
{where}
order by  insurance_insurancedebitnoteitems.insurancedebitnoteitems_id  desc limit 1
";

$_SESSION["periodpayslips"]="
select  distinct
hrpayroll_empnssf.empnssf_name nssf_number,
admin_dept.dept_name,

hrpayroll_empnhif.empnhif_name nhif_number, 
admin_personpersontype.personpersontype_id , 
admin_personpersontype.personpersontype_name  employee_number, 
admin_personttypecategory.personttypecategory_id , 
admin_personttypecategory.personttypecategory_name , 
admin_person.person_id ,
hrpayroll_payperiodmember.payperiod_id,
hrpayroll_payperiod.payperiod_name,
admin_person.dob,
admin_person.gender ,
admin_person.pin pin_number,

admin_person.idorpassport_number national_ID,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) employee_name,
admin_person.person_name , 
admin_personpersontype.created_by ,
 admin_personpersontype.date_created ,
 admin_personpersontype.changed_by , 
admin_personpersontype.date_changed , 
admin_personpersontype.voided , 
admin_personpersontype.voided_by , 
admin_personpersontype.date_voided , 
admin_personpersontype.uuid  

from admin_personpersontype  inner join admin_personttypecategory 
on admin_personttypecategory.personttypecategory_id = admin_personpersontype.personttypecategory_id 
inner join hrpayroll_payperiodmember on hrpayroll_payperiodmember.person_id=admin_personpersontype.person_id
left join hrpayroll_empnssf on hrpayroll_empnssf.person_id=  admin_personpersontype.person_id
left join hrpayroll_empnhif on hrpayroll_empnhif.person_id=  admin_personpersontype.person_id
left join admin_persondept on admin_persondept.person_id=admin_personpersontype.person_id
inner join  admin_dept on admin_dept.dept_id=admin_persondept.dept_id
inner join hrpayroll_payperiod on hrpayroll_payperiodmember.payperiod_id=hrpayroll_payperiod.payperiod_id
inner join admin_person on admin_person.person_id = admin_personpersontype.person_id
where admin_personttypecategory.personttypecategory_id=3 and admin_personpersontype.voided=0
And admin_person.status='Active'
						";
$_SESSION['payperiodsummary']="select 
hrpayroll_payperiod.payperiod_name ,hrpayroll_payperiod.payperiod_id,  hrpayroll_benefit.benefit_name ,hrpayroll_benefit.benefit_id,'hrpayroll_payperiodbenefits' source,sum( hrpayroll_payperiodbenefits.amount ) amount
 from hrpayroll_payperiodbenefits  

inner join hrpayroll_payperiod on hrpayroll_payperiod.payperiod_id = hrpayroll_payperiodbenefits.payperiod_id 
inner join hrpayroll_benefit on hrpayroll_benefit.benefit_id = hrpayroll_payperiodbenefits.benefit_id
inner join admin_person on admin_person.person_id = hrpayroll_payperiodbenefits.person_id  
group by hrpayroll_payperiod.payperiod_name ,  hrpayroll_benefit.benefit_name 

Union

select 
 hrpayroll_payperiod.payperiod_name ,hrpayroll_payperiod.payperiod_id, hrpayroll_deduction.deduction_name , hrpayroll_deduction.deduction_id ,'hrpayroll_payperioddeduction' source, sum(hrpayroll_payperioddeduction.amount) amount

 from hrpayroll_payperioddeduction  
inner join hrpayroll_payperiod on hrpayroll_payperiod.payperiod_id = hrpayroll_payperioddeduction.payperiod_id  
inner join admin_person on admin_person.person_id = hrpayroll_payperioddeduction.person_id  
inner join hrpayroll_deduction on hrpayroll_deduction.deduction_id = hrpayroll_payperioddeduction.deduction_id

group by  hrpayroll_payperiod.payperiod_name , hrpayroll_deduction.deduction_name 

";
$_SESSION['employeeSQLDetails']="
select 
hrpayroll_empnssf.empnssf_name nssf_number,
admin_dept.dept_name,
hrpayroll_empnhif.empnhif_name nhif_number, 
admin_personpersontype.personpersontype_id , 
admin_personpersontype.personpersontype_name  employee_number, 
admin_personttypecategory.personttypecategory_id , 
admin_personttypecategory.personttypecategory_name , 
admin_person.person_id ,
admin_person.dob,
admin_person.gender ,
admin_person.pin pin_number,
admin_person.idorpassport_number national_ID,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) employee_name,
admin_person.person_name , 
admin_personpersontype.created_by ,
 admin_personpersontype.date_created ,
 admin_personpersontype.changed_by , 
admin_personpersontype.date_changed , 
admin_personpersontype.voided , 
admin_personpersontype.voided_by , 
admin_personpersontype.date_voided , 
admin_personpersontype.uuid  
 from admin_personpersontype  inner join admin_personttypecategory 
on admin_personttypecategory.personttypecategory_id = admin_personpersontype.personttypecategory_id 
left join hrpayroll_empnssf on hrpayroll_empnssf.person_id=  admin_personpersontype.person_id
left join hrpayroll_empnhif on hrpayroll_empnhif.person_id=  admin_personpersontype.person_id
left join admin_persondept on admin_persondept.person_id=admin_personpersontype.person_id
left join  admin_dept on admin_dept.dept_id=admin_persondept.dept_id
inner join admin_person on admin_person.person_id = admin_personpersontype.person_id
where admin_personttypecategory.personttypecategory_id=3 and admin_personpersontype.voided=0
And admin_person.status='Active'
";
$_SESSION['employeeSQL']="select 
admin_personpersontype.personpersontype_id , 
admin_personpersontype.personpersontype_name , 
admin_personttypecategory.personttypecategory_id , 
admin_personttypecategory.personttypecategory_name , 
admin_person.person_id ,
CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname,
admin_person.person_name , 
admin_personpersontype.created_by ,
 admin_personpersontype.date_created ,
 admin_personpersontype.changed_by , 
admin_personpersontype.date_changed , 
admin_personpersontype.voided , 
admin_personpersontype.voided_by , 
admin_personpersontype.date_voided , 
admin_personpersontype.uuid  

from admin_personpersontype  inner join admin_personttypecategory 
on admin_personttypecategory.personttypecategory_id = admin_personpersontype.personttypecategory_id  
inner join admin_person on 
admin_person.person_id = admin_personpersontype.person_id
where admin_personttypecategory.personttypecategory_id=3 and admin_personpersontype.voided=0
And admin_person.status='Active'
";

$_SESSION["bank_bankaccount_SearchSQL"]="
						
						select bank_bankaccount.bankaccount_id , bank_bankaccount.syowner , 
bank_bankaccount.syownerid ,CONCAT( bank_bankaccount.bankaccount_name,' ',bank_bankaccount.bank) bankaccount_name, 
bank_bankaccount.branch , bank_bankaccount.description ,
bank_bankaccount.created_by , bank_bankaccount.date_created , bank_bankaccount.changed_by , bank_bankaccount.date_changed , 
bank_bankaccount.voided , bank_bankaccount.voided_by , bank_bankaccount.date_voided , bank_bankaccount.uuid  
from bank_bankaccount 
						
						";
						
						$_SESSION["bank_bankaccount_paysSearchSQL"]="
						
						select bank_bankaccount.bankaccount_id , 
bank_bankaccount.syowner , 
bank_bankaccount.syownerid ,
bank_bankaccount.bankaccount_name, 
bank_bankaccount.bank,
 bank_bankaccount.branch ,
 bank_bankaccount.currency_id,
 bank_bankaccount.description ,
bank_bankaccount.created_by , 
bank_bankaccount.date_created ,
 bank_bankaccount.changed_by , 
bank_bankaccount.date_changed , 
bank_bankaccount.voided , 
bank_bankaccount.voided_by , 
bank_bankaccount.date_voided ,
 bank_bankaccount.uuid  
from bank_bankaccount  
inner join payment_currency on payment_currency.currency_id=bank_bankaccount.currency_id
						
						";
						
						$_SESSION["housing_housinglandlord_SearchSQL"]="
						
						select housing_housinglandlord.housinglandlord_id , housing_housinglandlord.housinglandlord_name , admin_person.person_id ,CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ', admin_person. last_name ) person_fullname, admin_person.person_name , housing_housinglandlord.contract_day , admin_month.month_id , admin_month.month_name , housing_housinglandlord.contract_year , housing_housinglandlord.term_period , housing_housinglandlord.term_months , housing_housinglandlord.commission , housing_housinglandlord.commission_alternative , housing_housinglandlord.excess_amount , housing_housinglandlord.payment_day , housing_housinglandlord.property , housing_housinglandlord.contract_dated , housing_rentperiod.rentperiod_id , housing_rentperiod.rentperiod_name , housing_housinglandlord.created_by , housing_housinglandlord.date_created , housing_housinglandlord.changed_by , housing_housinglandlord.date_changed , housing_housinglandlord.voided , housing_housinglandlord.voided_by , housing_housinglandlord.date_voided , housing_housinglandlord.uuid  from housing_housinglandlord  inner join admin_person on admin_person.person_id = housing_housinglandlord.person_id  inner join admin_month on admin_month.month_id = housing_housinglandlord.month_id  inner join housing_rentperiod on housing_rentperiod.rentperiod_id = housing_housinglandlord.rentperiod_id
						
						
						";
$_SESSION["hosingTenantSql"]="
select
pt.housingtenant_id housingtenant_id,
CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name ) housinglandlord_name,
pt.tenant housingtenant_name,
pt.month_name,
pt.rentperiod_id ,
pt.month_id ,
pt.rent,
pt.electricity_water,
pt.rentperiod_name,
pt.deposit_description,
pt.tenancy_period,
pt.period_months,
pt.contract_dated,
pt.period_months,
pt.period_startdate,
pt.contract_dated,
pt.tenancy_period,
pt.deposit_description,
pt.property_description,
pt.contract_year,
pt.person_name,
pt.contract_day,
pt.housinglandlord_id,
pt.tpid person_id,
pt.tpid tenantpid,
pt.lpid landlordpid,

pt.created_by,pt.date_created,
pt.period_startdate,
current_date date_today,
period_diff(date_format(pt.period_startdate,\"%Y%m\"),date_format(now(),\"%Y%m\")) months,
DATEDIFF(date_format(pt.period_startdate,\"%Y%m%d\"),date_format(now(),\"%Y%m%d\")) days_passed
from 
(select 
CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name ) tenant, 
housing_housinglandlord.housinglandlord_id , 
housing_housingtenant.housingtenant_id ,
admin_month.month_name ,
housing_housingtenant.rent , 
housing_housinglandlord.person_id,
housing_rentperiod.rentperiod_id ,
admin_month.month_id ,
housing_housingtenant.person_id tpid ,
housing_housinglandlord.person_id lpid ,
housing_housingtenant.electricity_water , 
housing_rentperiod.rentperiod_name ,

housing_housingtenant.deposit_description , 
housing_housingtenant.tenancy_period , 
housing_housingtenant.period_startdate ,
housing_housingtenant.period_months ,
housing_housingtenant.contract_dated ,
housing_housingtenant.property_description,
housing_housingtenant.contract_year,
housing_housingtenant.housingtenant_name person_name, 
housing_housingtenant.contract_day,
housing_housingtenant.created_by,
housing_housingtenant.date_created

 
from housing_housingtenant 
inner join admin_person on admin_person.person_id = housing_housingtenant.person_id  
inner join housing_housinglandlord on housing_housinglandlord.housinglandlord_id = housing_housingtenant.housinglandlord_id 
inner join admin_month on admin_month.month_id = housing_housingtenant.month_id 
inner join housing_rentperiod on housing_rentperiod.rentperiod_id = housing_housingtenant.rentperiod_id
where housing_housingtenant.sys_track='Active'  AND housing_housingtenant.voided !=1
) pt, admin_person

{where}

						
						";
						$_SESSION["admin_personpersontype_SearchSQL"]="
						
						select admin_personpersontype.personpersontype_id , admin_personpersontype.personpersontype_name , admin_personttypecategory.personttypecategory_id , admin_personttypecategory.personttypecategory_name , admin_person.person_id , CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ', admin_person. last_name ) person_fullname,admin_person.person_name , admin_personpersontype.created_by , admin_personpersontype.date_created , admin_personpersontype.changed_by , admin_personpersontype.date_changed , admin_personpersontype.voided , admin_personpersontype.voided_by , admin_personpersontype.date_voided , admin_personpersontype.uuid  from admin_personpersontype  inner join admin_personttypecategory on admin_personttypecategory.personttypecategory_id = admin_personpersontype.personttypecategory_id  inner join admin_person on admin_person.person_id = admin_personpersontype.person_id
						
						";
						$_SESSION["com_sendemail_SearchSQL"]="
						
						select com_sendemail.sendemail_id , com_sendemail.syowner , com_sendemail.syownerid , com_sendemail.email_subject , com_sendemail.email_body , com_sendemail.attachments , com_sendemail.created_by , com_sendemail.date_created , com_sendemail.changed_by , com_sendemail.date_changed , com_sendemail.voided , com_sendemail.voided_by , com_sendemail.date_voided , com_sendemail.uuid  from com_sendemail
						
						";
						$_SESSION["admin_person_SearchSQL"]="
						
						select admin_person.person_id ,CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ', admin_person. last_name ) person_fullname, admin_person.person_name , admin_person.first_name , admin_person.middle_name , admin_person.last_name , admin_person.idorpassport_number , admin_person.dob , admin_person.pin , admin_person.gender , admin_person.status , admin_person.created_by , admin_person.date_created , admin_person.changed_by , admin_person.date_changed , admin_person.voided , admin_person.voided_by , admin_person.date_voided , admin_person.uuid , admin_person.sys_track  from admin_person
						
						";
						
						$_SESSION["accounts_accaccount_SearchSQL"]="
						
						select accounts_accaccount.accaccount_id , CONCAT( accounts_accaccount.accaccount_name ,' ',accounts_accaccount.accountname) accaccount_name, accounts_accaccount.syowner , accounts_accaccount.accountname , accounts_accaccount.syownerid , accounts_accaccount.opening_balance , accounts_accaccount.closing_balance , accounts_accaccount.credit_limit , accounts_accaccount.nature , accounts_accaccount.created_by , accounts_accaccount.date_created , accounts_accaccount.changed_by , accounts_accaccount.date_changed , accounts_accaccount.voided , accounts_accaccount.voided_by , accounts_accaccount.date_voided , accounts_accaccount.uuid  from accounts_accaccount
						
		
						";
						
						$_SESSION["insurance_insurancedebitnote_SearchSQL"]="
						
						select insurance_insurancedebitnote.insurancedebitnote_id , insurance_insurancedebitnote.insurancedebitnote_name , insurance_insurancedebitnote.policy_number , insurance_underwriter.underwriter_id , insurance_underwriter.underwriter_name , admin_person.person_id , 
						admin_person.person_name
,CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name ) person_fullname, insurance_insurancedebitnote.other_details , payment_currency.currency_id , payment_currency.currency_name , insurance_insurancedebitnote.pcf , insurance_insurancedebitnote.training_levy , insurance_insurancedebitnote.stamp_duty , insurance_insurancedebitnote.wtax , admin_person.created_by , admin_person.date_created , insurance_insurancedebitnote.changed_by , insurance_insurancedebitnote.date_changed , insurance_insurancedebitnote.voided , insurance_insurancedebitnote.voided_by , insurance_insurancedebitnote.date_voided , insurance_insurancedebitnote.uuid , insurance_insurancedebitnote.sys_track  from insurance_insurancedebitnote  
inner join insurance_underwriter on insurance_underwriter.underwriter_id = insurance_insurancedebitnote.underwriter_id  
inner join admin_person on admin_person.person_id = insurance_insurancedebitnote.person_id  
inner join payment_currency on payment_currency.currency_id = insurance_insurancedebitnote.currency_id
						
						";
						
						$_SESSION["loans_emploan_SearchSQL"]="
						select loans_emploan.emploan_id , admin_person.person_id , admin_person.person_name , loans_loanstatus.loanstatus_id , loans_loanstatus.loanstatus_name , loans_loan.loan_id , loans_loan.interest_rate, loans_loan.loan_name , loans_emploan.loan_amount , loans_emploan.repayment_period , loans_emploan.start_date , loans_emploan.end_date , loans_emploan.comment , loans_emploan.created_by , loans_emploan.date_created , loans_emploan.changed_by , loans_emploan.date_changed , loans_emploan.voided , loans_emploan.voided_by , loans_emploan.date_voided , loans_emploan.uuid  from loans_emploan  inner join admin_person on admin_person.person_id = loans_emploan.person_id  inner join loans_loanstatus on loans_loanstatus.loanstatus_id = loans_emploan.loanstatus_id  inner join loans_loan on loans_loan.loan_id = loans_emploan.loan_id
						
						";
						$_SESSION["medicallab_queue_SearchSQL"]="
						
						select medicallab_queue.queue_id , medicallab_queue.queue_name ,CONCAT(admin_person.first_name,' ',admin_person.middle_name,' ', admin_person. last_name ) person_fullname, admin_person.person_id , admin_person.person_name , medicallab_queue.patient_age , medicallab_queue.hospital_number , medicallab_queue.visit_type , medicallab_queue.referring_facility , medicallab_queue.reporting_date , medicallab_queue.diagnosis_type , medicallab_queue.other_details , medicallab_queue.created_by , medicallab_queue.date_created , medicallab_queue.changed_by , medicallab_queue.date_changed , medicallab_queue.voided , medicallab_queue.voided_by , medicallab_queue.date_voided , medicallab_queue.uuid , medicallab_queue.sys_track  from medicallab_queue  inner join admin_person on admin_person.person_id = medicallab_queue.person_id
						
						";
						$_SESSION["admin_workticket_SearchSQL"]="
						
						select admin_workticket.workticket_id , admin_workticket.workticket_name , admin_rolenotificationhist.rolenotificationhist_id , admin_rolenotificationhist.rolenotificationhist_name , admin_person.person_id , CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name ) person_name , admin_workticket.description , admin_workticket.created_by , admin_workticket.date_created , admin_workticket.changed_by , admin_workticket.date_changed , admin_workticket.voided , admin_workticket.voided_by , admin_workticket.date_voided , admin_workticket.uuid , admin_workticket.sys_track  from admin_workticket  inner join admin_rolenotificationhist on admin_rolenotificationhist.rolenotificationhist_id = admin_workticket.rolenotificationhist_id  inner join admin_person on admin_person.person_id = admin_workticket.person_id
						
						";

$_SESSION['reporting_SQL']="
select  
admin_table.table_id ,  
admin_table.table_name ,
admin_table.statement_caption,
' '  awaits, ' '  success, ' ' failure, ' ' undetermined

from  admin_table 

where admin_table.table_id not in (select table_id from admin_rolenotification)
union 

select  
admin_table.table_id ,  
admin_table.table_name ,
admin_table.statement_caption,
admin_rolenotification.awaits_activity , 
admin_rolenotification.success ,
 admin_rolenotification.failure , 
admin_rolenotification.undetermined 
from admin_rolenotification 
 inner join admin_role on admin_role.role_id = admin_rolenotification.role_id  
inner join admin_rolenotificationevent on admin_rolenotificationevent.rolenotificationevent_id = admin_rolenotification.rolenotificationevent_id
  inner join admin_table on admin_table.table_id = admin_rolenotification.table_id
";

$_SESSION["cashtransdetails"]="select 
concat(admin_person.first_name,'  ',
admin_person.middle_name,' ',
admin_person.last_name) received_from,
cp.accaccount_name ,
cp.syowner,
cp.syownerid,
cp.cashtrans_name,
cp.voucher_number,
cp.accountscategory_id,
cp.accountscategory_name,
cp.currency_id,
cp.currency_name,
cp.amount,
cp.transaction_type,
cp.naration

from
(select
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner,
accounts_accaccount.syownerid,
 accounts_cashtrans.cashtrans_name , 
accounts_cashtrans.voucher_number ,
 accounts_accountscategory.accountscategory_id , 
accounts_accountscategory.accountscategory_name , 
payment_currency.currency_id , 
payment_currency.currency_name , 
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type ,
 accounts_cashtrans.naration 

from accounts_cashtrans
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_cashtrans.accaccount_id  
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_cashtrans.accountscategory_id  
inner join payment_currency on payment_currency.currency_id = accounts_cashtrans.currency_id

where  accounts_accaccount.syowner='admin_person') cp
inner join admin_person on admin_person.person_id=cp.syownerid";

$_SESSION['banktrans']="select 
concat(admin_person.first_name,'  ',
admin_person.middle_name,' ',
admin_person.last_name) received_from,
bp.accaccount_name ,
bp.syowner,
bp.syownerid,
bp.banktrans_name,
bp.voucher_number,
bp.check_number,
bp.accountscategory_id,
bp.accountscategory_name,
bp.currency_id,
bp.currency_name,
bp.amount,
bp.transaction_type,
bp.naration

from
(select
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner,
accounts_accaccount.syownerid,
 accounts_banktrans.banktrans_name , 
accounts_banktrans.voucher_number ,

 accounts_accountscategory.accountscategory_id , 
accounts_accountscategory.accountscategory_name , 
payment_currency.currency_id , 
payment_currency.currency_name , 
accounts_banktrans.amount , 
accounts_banktrans.transaction_type ,
 accounts_banktrans.naration 

from accounts_banktrans
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_banktrans.accaccount_id  
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_banktrans.accountscategory_id  
inner join payment_currency on payment_currency.currency_id = accounts_banktrans.currency_id

where  accounts_accaccount.syowner='admin_person')  bp
inner join admin_person on admin_person.person_id=bp.syownerid";

$_SESSION['cashbankcolscaptions']="
#^
Received From^
A/C ^
Ref^
Voucher #^
Check #^
category^
amount^
Trans. Type^
Description^
Payment Mode^
"; 
$_SESSION['cashbankcolwidth']="
AI|5,
received_from|40,
accaccount_name |30,
banktrans_name|40,
voucher_number|20,
check_number|20,
accountscategory_name|40,
amount|30,
transaction_type|10,
naration|60,
payment_mode|20
";
$_SESSION['bankcashtrans']="select 
concat(admin_person.first_name,'  ',
admin_person.middle_name,' ',
admin_person.last_name) received_from,
bp.tranrefid refid,
bp.transtbl,
bp.accaccount_name ,
bp.syowner,
bp.syownerid,
bp.banktrans_name,
bp.voucher_number,
bp.check_number,
bp.accountscategory_id,
bp.accountscategory_name,
bp.currency_name,
bp.amount,
bp.transaction_type,
bp.naration,
bp.payment_mode,
accounts_accountactivity.transaction_date,
date_format(accounts_accountactivity.transaction_date ,\"%d\/%b\/%Y\") ddate,
date_format(accounts_accountactivity.transaction_date ,\"%M\") cmonth,
date_format(accounts_accountactivity.transaction_date ,\"%d\") cday,
date_format(accounts_accountactivity.transaction_date ,\"%Y\") cyear

from
(select
accounts_accaccount.accaccount_name,
accounts_accaccount.syowner,
accounts_accaccount.syownerid,
accounts_banktrans.banktrans_name, 
accounts_banktrans.banktrans_id tranrefid,
'accounts_banktrans' transtbl,
accounts_banktrans.voucher_number,
accounts_accountscategory.accountscategory_id , 
accounts_accountscategory.accountscategory_name, 
 ' '	bank	,
 ' '	branch	,
 ' '	check_details	,
 ' '	check_number	,
 ' '	check_date	,
 'Kenya Shillings'  currency_name,
accounts_banktrans.amount, 
accounts_banktrans.transaction_type,
accounts_banktrans.naration,
'Deposited Cash to Bank' payment_mode

from accounts_banktrans
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_banktrans.accaccount_id  
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_banktrans.accountscategory_id  

{where}


union 
select
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner,
accounts_accaccount.syownerid,
 accounts_cashtrans.cashtrans_name , 
accounts_cashtrans.cashtrans_id tranrefid,
'accounts_cashtrans' transtbl,
accounts_cashtrans.voucher_number  voucher_number,
accounts_accountscategory.accountscategory_id , 
accounts_accountscategory.accountscategory_name ,
  ' '	bank	,
 ' '	branch	,
 ' '	check_details	,
 ' '	check_number	,
 ' '	check_date	,
 
payment_currency.currency_name , 
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type ,
 accounts_cashtrans.naration ,
'Cash ' payment_mode

from accounts_cashtrans
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_cashtrans.accaccount_id  
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_cashtrans.accountscategory_id  
inner join payment_currency on payment_currency.currency_id = accounts_cashtrans.currency_id

{where}
) bp
inner join admin_person on admin_person.person_id=bp.syownerid
inner join accounts_accountactivity on accounts_accountactivity.accountactivity_name=bp.banktrans_name
";

$_SESSION['insurancetransacts']="
select insurance_dbnotetransact.dbnotetransact_id ,
 insurance_dbnotetransact.dbnotetransact_name , 
 insurance_dbnotetransact.receipt_number , 
insurance_dbnotetransact.created_by ,
insurance_dbnotetransact.date_created , 
insurance_dbnotetransact.date_changed,
dn.insurancedebitnote_name,
dn.underwriter_name,
dn.policy_number,
dn.person_id,
dn.insured,
dn.other_details,
dn.currency_name,
dn.wtax,
dn.training_levy,
dn.pcf,
dn.stamp_duty,
dn.created_by,
dn.date_created,
dn.status,
dn.insurancedebitnote_id,
admin_personpersontype.personpersontype_name account_name,
dn.changed_by

 from insurance_dbnotetransact,
(select 
 insurance_insurancedebitnote.insurancedebitnote_name ,
 insurance_underwriter.underwriter_name ,
insurance_insurancedebitnote.insurancedebitnote_id,
admin_person.person_id ,
 CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name )  insured , 
insurance_insurancedebitnote.policy_number,
 insurance_insurancedebitnote.other_details ,
payment_currency.currency_name ,
insurance_insurancedebitnote.wtax,
insurance_insurancedebitnote.training_levy,
insurance_insurancedebitnote.pcf,
insurance_insurancedebitnote.stamp_duty,
insurance_insurancedebitnote.created_by ,
insurance_insurancedebitnote.date_created ,
insurance_insurancedebitnote.sys_track status,
insurance_insurancedebitnote.changed_by
 from insurance_insurancedebitnote  inner join insurance_underwriter on insurance_underwriter.underwriter_id = insurance_insurancedebitnote.underwriter_id 

 inner join admin_person on admin_person.person_id = insurance_insurancedebitnote.person_id  
inner join payment_currency on payment_currency.currency_id = insurance_insurancedebitnote.currency_id

) dn


inner join admin_personpersontype on admin_personpersontype.person_id= dn.person_id 
where  dn.insurancedebitnote_id = insurance_dbnotetransact.insurancedebitnote_id
AND insurance_dbnotetransact.voided!=1
						";

$_SESSION['insurancegeneral']="
select insurance_dbnotetransact.dbnotetransact_id ,
dn.underwriter_name,
dn.policy_number,
dn.person_id,
dn.insured,
dn.other_details,
dn.currency_name,
dn.wtax,
dn.training_levy,
dn.pcf,
dn.stamp_duty,
dn.created_by,
dn.date_created,
dn.status,
dn.changed_by

 from insurance_dbnotetransact,
(select 
 insurance_insurancedebitnote.insurancedebitnote_name ,
 insurance_underwriter.underwriter_name ,
insurance_insurancedebitnote.insurancedebitnote_id,
admin_person.person_id ,
 CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name )  insured , 
insurance_insurancedebitnote.policy_number,
 insurance_insurancedebitnote.other_details ,
payment_currency.currency_name ,
insurance_insurancedebitnote.wtax,
insurance_insurancedebitnote.training_levy,
insurance_insurancedebitnote.pcf,
insurance_insurancedebitnote.stamp_duty,
insurance_insurancedebitnote.created_by ,
insurance_insurancedebitnote.date_created ,
insurance_insurancedebitnote.sys_track status,
insurance_insurancedebitnote.changed_by
 from insurance_insurancedebitnote  inner join insurance_underwriter on insurance_underwriter.underwriter_id = insurance_insurancedebitnote.underwriter_id 

 inner join admin_person on admin_person.person_id = insurance_insurancedebitnote.person_id  
inner join payment_currency on payment_currency.currency_id = insurance_insurancedebitnote.currency_id
) dn


where  dn.insurancedebitnote_id = insurance_dbnotetransact.insurancedebitnote_id
AND insurance_dbnotetransact.voided!=1

";
$_SESSION['paymentbyaccount']="SELECT
accounts_accountactivity.accountscategory_id,
accounts_accountactivity.accaccount_id,
accounts_accountactivity.currency_id,
sum(accounts_accountactivity.amount) amount,
accounts_accaccount.opening_balance,
accounts_accaccount.closing_balance,
accounts_accaccount.credit_limit,
accounts_accaccount.balance_type,
accounts_accountactivity.transaction_type


FROM
accounts_accountactivity

inner join accounts_accaccount on accounts_accaccount.accaccount_id=accounts_accountactivity.accaccount_id

{where}
group by 
accounts_accountactivity.accountscategory_id,
accounts_accountactivity.accaccount_id,
accounts_accountactivity.currency_id,
accounts_accaccount.opening_balance,
accounts_accaccount.closing_balance,
accounts_accaccount.credit_limit,
accounts_accaccount.balance_type,
accounts_accountactivity.transaction_type
order by 
accounts_accountactivity.accountscategory_id,
accounts_accountactivity.accaccount_id,
accounts_accountactivity.currency_id,
accounts_accaccount.opening_balance,
accounts_accaccount.closing_balance,
accounts_accaccount.credit_limit,
accounts_accaccount.balance_type,
accounts_accountactivity.transaction_type";

$_SESSION['funcref']="
//schedDate = Ext.Date.format(Ext.getCmp('schedDate').getValue(),'Y-m-d') + Ext.Date.format(Ext.getCmp('schedTime').getValue(),' H:i:s')
SELECT
accounts_accaccount.accaccount_id,
accounts_accaccount.accaccount_name,
housing_housingtenant.housingtenant_name,
housing_housingtenant.period_startdate,
  case housing_housingtenant.rentperiod_id 
 when '1' then 'monthly'
when '2' then 'Quarterly'
when '3' then 'Annually'

   end as rent_period,
IF(housing_housingtenant.rentperiod_id=1,5,6),

housing_rentperiod.rentperiod_name,
housing_housingtenant.rent
FROM

housing_housingtenant

inner join accounts_accaccount 
on housing_housingtenant.housingtenant_name=accounts_accaccount.accaccount_name

inner join housing_rentperiod on housing_rentperiod.rentperiod_id= housing_housingtenant.rentperiod_id
";
$_SESSION['calculateRent']="
SELECT 
ta.accaccount_id,
ta.received_from,
ta.accaccount_name,
ta.housingtenant_name,
ta.opening_balance,
ta.closing_balance,
ta.balance_type,
ta.period_startdate,
ta.months,
ta.days,
ta.deposit,
ta.electricity_water,
ta.Years,
ta.months,
ta.period_type,
ta.period_typef,
ta.expiry,
ta.rent,
ta.months,
CONCAT(ta.inOpen,ta.opening_balance,ta.enOpen) formatedopbal ,

ta.months+(mod(ta.months,ta.period_type) *-1) elapsed_period,
((ta.months+(mod(ta.months,ta.period_type) *-1))/ta.period_type) elapsed_intervals,
ta.rent*(ta.months+(mod(ta.months,ta.period_type) *-1) )/ta.period_type total_rent

FROM (
SELECT
CONCAT(admin_person.last_name,' ',admin_person.first_name,' ',admin_person.middle_name ) received_from,
accounts_accaccount.accaccount_id,
accounts_accaccount.accaccount_name,
accounts_accaccount.opening_balance,
accounts_accaccount.closing_balance,
accounts_accaccount.balance_type,
housing_housingtenant.housingtenant_name,
housing_housingtenant.period_startdate,
housing_housingtenant.deposit,
housing_housingtenant.person_id,
housing_housingtenant.period_months,
DATE_add(housing_housingtenant.period_startdate, INTERVAL housing_housingtenant.period_months  MONTH) expiry,
housing_housingtenant.electricity_water,
case housing_housingtenant.rentperiod_id 
when '1' then 1
when '2' then  12
when '3' then  3
when '4' then  6

   end as period_type,
case housing_housingtenant.rentperiod_id 
		when '1' then 'Monthly'
		when '2' then 'Annually'
		when '3' then 'Quarterly'
		when '4' then 'Bi Annual'

end as period_typef,

case accounts_accaccount.balance_type 
when 'P' then ''
when 'N' then  '('
end as inOpen,

case accounts_accaccount.balance_type 
when 'P' then ''
when 'N' then  ')'
end as enOpen,
period_diff(date_format(housing_housingtenant.period_startdate,\"%Y%m\"),date_format(now(),\"%Y%m\"))  months,
DATEDIFF(date_format(housing_housingtenant.period_startdate,\"%Y%m%d\"),date_format(now(),\"%Y%m%d\"))  days,
DATEDIFF(date_format(housing_housingtenant.period_startdate,\"Y\"),date_format(now(),\"Y\"))  Years,
housing_rentperiod.rentperiod_name,
housing_housingtenant.rent
FROM

housing_housingtenant

inner join accounts_accaccount 
on housing_housingtenant.housingtenant_name=accounts_accaccount.accaccount_name

inner join housing_rentperiod on housing_rentperiod.rentperiod_id= housing_housingtenant.rentperiod_id
inner join admin_person on admin_person.person_id=housing_housingtenant.person_id

{where}

) ta 

";
//Account payments
$_SESSION["generalaccpayments"]="
select 
bp.tranrefid refid ,
bp.transtbl,
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner ,
accounts_accaccount.syownerid ,
bp.voucher_number,
payment_currency.currency_name,
bp.currency_id,
bp.amount,
bp.transaction_type,
bp.naration,
bp.bankaccount_name,
bp.bank,
bp.branch,
bp.check_details,
bp.check_number,
bp.check_date,
bp.date_banked,
bp.date_cleared,
bp.trans_ref,
bp.payment_mode


from
(

SELECT
accounts_directtransferin.accaccount_id,
accounts_directtransferin.directtransferin_name,
accounts_directtransferin.`uuid` trans_ref,
accounts_directtransferin.directtransferin_id tranrefid,
'accounts_directtransferin' transtbl,
'' voucher_number,
bank_bankaccount.bankaccount_name,
'' bank,
'' branch,
'' check_details,
'' check_number,
'' check_date,
accounts_directtransferin.date_transferred date_banked,
'' date_cleared,
bank_bankaccount.currency_id,
accounts_directtransferin.amount,
accounts_directtransferin.transaction_type,
accounts_directtransferin.naration,
'Direct Transfer By Client' payment_mode
FROM
accounts_directtransferin

inner join bank_bankaccount on bank_bankaccount.bankaccount_id=accounts_directtransferin.client_account
{directTransferwhere}

Union 
SELECT
accounts_compcashdeposit.accaccount_id,
accounts_compcashdeposit.compcashdeposit_name,
accounts_compcashdeposit.`uuid` trans_ref,
accounts_compcashdeposit.compcashdeposit_id tranrefid,
'accounts_compcashdeposit' transtbl,
'' voucher_number,
'' bankaccount_name,
' ' bank,
' ' branch,
' ' check_details,
' ' check_number,
' ' check_date,
accounts_compcashdeposit.date_banked,
'' date_cleared,
bank_bankaccount.currency_id,
accounts_compcashdeposit.amount,
accounts_compcashdeposit.transaction_type,
accounts_compcashdeposit.naration,
'Banked By Client' payment_mode
FROM
accounts_compcashdeposit

inner join bank_bankaccount on bank_bankaccount.bankaccount_id=accounts_compcashdeposit.bankaccount_id
{bankwhere}

union

SELECT
accounts_checkregister.accaccount_id,
accounts_checkregister.checkregister_name,
accounts_checkregister.uuid trans_ref,
accounts_checkregister.checkregister_id tranrefid,
'accounts_checkregister' transtbl,
'' voucher_number,
'' bankaccount_name,
accounts_checkregister.bank,
accounts_checkregister.branch,
accounts_checkregister.check_details,
accounts_checkregister.check_number,
accounts_checkregister.check_date,
'' date_banked,
'' date_cleared,
accounts_checkregister.currency_id,
accounts_checkregister.amount,
accounts_checkregister.transaction_type,
accounts_checkregister.naration,
'Received By Check' payment_mode
FROM
accounts_checkregister
{checkwhere}

union 
select
accounts_cashtrans.accaccount_id  ,
 accounts_cashtrans.cashtrans_name ,
 accounts_cashtrans.uuid trans_ref, 
accounts_cashtrans.cashtrans_id tranrefid,
'accounts_cashtrans' transtbl,
accounts_cashtrans.voucher_number  voucher_number,
' '     bankaccount_name,
 ' '	bank	,
 ' '	branch	,
 ' '	check_details	,
 ''	check_number	,
 ''	check_date	,
 '' date_banked,
' ' date_cleared,
accounts_cashtrans.currency_id , 
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type ,
 accounts_cashtrans.naration ,
'Cash ' payment_mode

from accounts_cashtrans
{cashwhere} 

 

) bp

inner join accounts_accaccount on accounts_accaccount.accaccount_id =bp.accaccount_id
inner join payment_currency on payment_currency.currency_id =bp.currency_id



";

/*$_SESSION["paymentbylandlord"]="
select 

bp.tranrefid refid,
bp.transtbl,
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner ,
accounts_accaccount.syownerid ,
bp.banktrans_name,
bp.voucher_number,
payment_currency.currency_name,
bp.currency_id,
bp.amount,
bp.transaction_type,
bp.naration,
bp.bankaccount_name,
bp.bank,
bp.branch,
bp.check_details,
bp.check_number,
bp.check_date,
bp.date_cleared,
bp.trans_ref,
bp.payment_mode


from
(select
accounts_banktrans.accaccount_id,
accounts_banktrans.banktrans_name,
accounts_banktrans.uuid trans_ref,
accounts_banktrans.banktrans_id tranrefid,
'accounts_banktrans' transtbl,
accounts_banktrans.voucher_number,
bank_bankaccount.bankaccount_name,
bank_bankaccount.bank	,
bank_bankaccount.	branch	,
 ' '	check_details	,
 ' '	check_number	,
 ' '	check_date	,
' '  date_cleared,
bank_bankaccount.currency_id,
accounts_banktrans.amount, 
accounts_banktrans.transaction_type,
accounts_banktrans.naration,
'Deposited Cash to Bank' payment_mode

from accounts_banktrans
inner join bank_bankaccount on bank_bankaccount.bankaccount_id = accounts_banktrans.bankaccount_id  
union 
select
accounts_cashtrans.accaccount_id  ,
 accounts_cashtrans.cashtrans_name ,
 accounts_cashtrans.uuid trans_ref, 
accounts_cashtrans.cashtrans_id tranrefid,
'accounts_cashtrans' transtbl,
accounts_cashtrans.voucher_number  voucher_number,
' '     bankaccount_name,
 ' '	bank	,
 ' '	branch	,
 ' '	check_details	,
 ' '	check_number	,
 ' '	check_date	,
' ' date_cleared,
accounts_cashtrans.currency_id , 
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type ,
 accounts_cashtrans.naration ,
'Cash ' payment_mode

from accounts_cashtrans

union
select 
accounts_checkregister.accaccount_id , 
accounts_checkdeposit.checkdeposit_name , 
accounts_checkdeposit.uuid trans_ref, 
accounts_checkdeposit.checkdeposit_id  tranrefid,
'accounts_checkdeposit' transtbl,
' ' voucher_number,
bank_bankaccount.bankaccount_name,
accounts_checkregister.bank,
accounts_checkregister.branch,
accounts_checkregister.check_details,
accounts_checkregister.check_number,
accounts_checkregister.check_date , 
accounts_checkdeposit.date_cleared ,
 bank_bankaccount.currency_id,
accounts_checkregister.amount,
accounts_checkregister.transaction_type,
accounts_checkregister.naration,  
'Bank Check ' payment_mode



 from accounts_checkdeposit  inner join accounts_checkregister on accounts_checkregister.checkregister_id = accounts_checkdeposit.checkregister_id  
inner join bank_bankaccount on bank_bankaccount.bankaccount_id = accounts_checkdeposit.bankaccount_id
inner join accounts_accountactivity on accounts_accountactivity.accountactivity_name=bp.banktrans_name
where accounts_checkdeposit.voided =0

) bp

inner join accounts_accaccount on accounts_accaccount.accaccount_id =bp.accaccount_id
inner join payment_currency on payment_currency.currency_id =bp.currency_id

{where}

";*/

$_SESSION['calculateRent']="

SELECT 
acc_trans.totalpaid, 
acc_trans.expenses, 
format(acc_trans.expenses,2) format_expenses, 
ta.accaccount_id,
 
abs(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))))) total_rent,
format(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) )))),2) total_rentformated,



 case ta.balance_type 

	when 'P' 
	then if((format(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))+ta.deposit+ta.electricity_water-ta.opening_balance)-acc_trans.totalpaid-acc_trans.expenses),2))>0,concat('(',
	
	format(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))+ta.deposit+ta.electricity_water-ta.opening_balance)-acc_trans.totalpaid-acc_trans.expenses),2)
	
	,')'),
	format(abs(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))+ta.deposit+ta.electricity_water-ta.opening_balance)-acc_trans.totalpaid-acc_trans.expenses)),2))
	
	when 'N' 
	then if((format(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))+ta.deposit+ta.electricity_water+ta.opening_balance)-acc_trans.totalpaid-acc_trans.expenses),2))>0,concat('(',
	
	format(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))+ta.deposit+ta.electricity_water+ta.opening_balance)-acc_trans.totalpaid-acc_trans.expenses),2)
	
	,')'),
	format(abs(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))+ta.deposit+ta.electricity_water+ta.opening_balance)-acc_trans.totalpaid-acc_trans.expenses)),2))
	
	
   ELSE 
if(acc_trans.topay>0,

concat('(',format((abs(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) )))))+ta.deposit+ta.electricity_water)-acc_trans.topay,2),')'),

concat('(',format((abs(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) )))))+ta.deposit+ta.electricity_water),2),')')

)




 end as acc_status,
 
case 

when ((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))-acc_trans.totalpaid)<0 )=true then concat('(',format(abs((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))-acc_trans.totalpaid)),2),')')

when ((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))-acc_trans.totalpaid)>=0)=true then 

format(((((ta.rent*((abs((((ta.months+ mod(abs(ta.months),ta.period_type)))/ta.period_type) ))+1 ) ))+ta.deposit+ta.electricity_water+ta.opening_balance)-acc_trans.totalpaid),2)
end as revisedTotal,
ta.received_from,
 ta.accaccount_name, 
ta.housingtenant_name, 
ta.opening_balance, 
ta.closing_balance, 
ta.balance_type, 
ta.period_startdate,
ta.months, 
ta.days, ta.deposit, 
ta.electricity_water, 
ta.Years, ta.months,
 ta.period_type, 
ta.period_typef, 
ta.expiry, 
ta.rent, 
ta.months, 
CONCAT(ta.inOpen,
ta.opening_balance,
ta.enOpen) formatedopbal , 
ta.months+(mod(ta.months,ta.period_type) *-1) elapsed_period,
 ((ta.months+(mod(ta.months,ta.period_type) *-1))/ta.period_type) elapsed_intervals

FROM ( SELECT concat(admin_person.first_name,'  ',
admin_person.middle_name,' ',
admin_person.last_name) received_from, accounts_accaccount.accaccount_id, accounts_accaccount.accaccount_name, accounts_accaccount.opening_balance, accounts_accaccount.closing_balance, accounts_accaccount.balance_type, housing_housingtenant.housingtenant_name, housing_housingtenant.period_startdate, housing_housingtenant.deposit, housing_housingtenant.person_id, housing_housingtenant.period_months,
date_format( DATE_add(housing_housingtenant.period_startdate, INTERVAL housing_housingtenant.period_months MONTH),\"%d\/%b\/%Y\") expiry, housing_housingtenant.electricity_water, case housing_housingtenant.rentperiod_id when '1' then 1 when '2' then 12 when '3' then 3 when '4' then 6 end as period_type, case housing_housingtenant.rentperiod_id when '1' then 'Monthly' when '2' 
then 'Annually' when '3' then 'Quarterly' when '4' then 'Bi Annual' end as period_typef, case accounts_accaccount.balance_type when 'P' then '' when 'N' then '(' end as inOpen, case accounts_accaccount.balance_type when 'P' then '' when 'N' then ')' end as enOpen, period_diff(date_format(housing_housingtenant.period_startdate,\"%Y%m\"),date_format(now(),\"%Y%m\")) months, DATEDIFF(date_format(housing_housingtenant.period_startdate,\"%Y%m%d\"),date_format(now(),\"%Y%m%d\")) days, DATEDIFF(date_format(housing_housingtenant.period_startdate,\"Y\"),date_format(now(),\"Y\")) Years, housing_rentperiod.rentperiod_name, housing_housingtenant.rent 

FROM housing_housingtenant inner join accounts_accaccount on housing_housingtenant.housingtenant_name=accounts_accaccount.accaccount_name inner join housing_rentperiod on housing_rentperiod.rentperiod_id= housing_housingtenant.rentperiod_id inner join admin_person on admin_person.person_id=housing_housingtenant.person_id





 {where} ) ta

left join 

(select 

paid_expenses.accaccount_id,
paid_expenses.currency_id,
sum(paid_expenses.totalpaid) totalpaid,
sum(paid_expenses.expenses) expenses,
(sum(paid_expenses.totalpaid)+sum(paid_expenses.expenses)) topay,
paid_expenses.accountscategory_id

from 
(SELECT
accounts_accountactivity.accaccount_id,
accounts_accountactivity.currency_id,
sum(accounts_accountactivity.amount) totalpaid,0 expenses,
accounts_accountactivity.accountscategory_id
FROM
accounts_accountactivity
where accounts_accountactivity.voided=0
group by 
accounts_accountactivity.accaccount_id,
accounts_accountactivity.currency_id,
accounts_accountactivity.accountscategory_id

union

SELECT
accounts_accountactivity.accaccount_id,
accounts_accountactivity.currency_id,
0 totalpaid,
sum(accounts_accountactivity.amount) expenses,
accounts_accountactivity.accountscategory_id
FROM
accounts_accountactivity
where accounts_accountactivity.voided=0
and accounts_accountactivity.accountscategory_id=56
group by 
accounts_accountactivity.accaccount_id,
accounts_accountactivity.currency_id,
accounts_accountactivity.accountscategory_id
) paid_expenses

group by

paid_expenses.accaccount_id,
paid_expenses.currency_id

order by
paid_expenses.accaccount_id,
paid_expenses.currency_id
) acc_trans

 on acc_trans.accaccount_id= ta.accaccount_id

";

$_SESSION['landlordpropertyexpenses']="
select
concat(admin_person.first_name,' ',admin_person.middle_name,' ',admin_person.last_name) received_from,
accounts_accountactivity.currency_id,
date_format(accounts_accountactivity.transaction_date,'%d\/%b\/%Y') transaction_date,
accounts_accountactivity.accaccount_id,
accounts_accountactivity.amount,
accounts_accountactivity.naration
FROM
accounts_accountactivity

inner join accounts_accaccount
on accounts_accaccount.accaccount_id=accounts_accountactivity.accaccount_id
inner join admin_person on accounts_accaccount.syownerid=admin_person.person_id
where accounts_accountactivity.accountscategory_id=56 AND accounts_accountactivity.voided=0
{where}
union 

SELECT
'Zulmac Agencies Limited'  received_from,
accounts_accountactivity.currency_id,
date_format(accounts_accountactivity.transaction_date,'%d\/%b\/%Y') transaction_date,
accounts_accountactivity.accaccount_id,
accounts_accountactivity.amount,
accounts_accountactivity.naration
FROM
accounts_accountactivity

where accountscategory_id=52 AND accounts_accountactivity.voided=0
{whereaccount}
";

$_SESSION["accounts_directtransferout_SearchSQL"]="
select accounts_directtransferout.directtransferout_id , 
accounts_directtransferout.directtransferout_name , 
accounts_accaccount.accaccount_id , 
accounts_accaccount.accaccount_name , 

accounts_directtransferout.amount , 
a.bankaccount_name company_account,b.bankaccount_name client_account,
accounts_directtransferout.date_transferred , 
accounts_directtransferout.transaction_type , 
accounts_directtransferout.naration , 
accounts_directtransferout.created_by , 
accounts_directtransferout.date_created 

from accounts_directtransferout 
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_directtransferout.accaccount_id
inner join  bank_bankaccount a on a.bankaccount_id=accounts_directtransferout.company_account
inner join  bank_bankaccount b on b.bankaccount_id=accounts_directtransferout.client_account

where accounts_directtransferout.voided !=1
";

$_SESSION["accounts_directtransferin_SearchSQL"]="
select 
accounts_directtransferin.directtransferin_id , 
accounts_directtransferin.directtransferin_name ,
accounts_accaccount.accaccount_id ,
accounts_accaccount.accaccount_name ,
a.bankaccount_name company_account,b.bankaccount_name client_account, 
accounts_directtransferin.amount , accounts_directtransferin.date_transferred , 
accounts_directtransferin.transaction_type , accounts_directtransferin.naration ,
 accounts_directtransferin.created_by , accounts_directtransferin.date_created 

from accounts_directtransferin  
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_directtransferin.accaccount_id
inner join  bank_bankaccount a on a.bankaccount_id=accounts_directtransferin.company_account
inner join  bank_bankaccount b on b.bankaccount_id=accounts_directtransferin.client_account

where accounts_directtransferin.voided !=1
";
						
$_SESSION["removesmstbls"]="
drop table sms_autoresponse ;
drop table sms_indsms ;
drop table sms_messagereived ;
drop table sms_messagesend ;
drop table sms_processedsms ;
drop table sms_processedsmsoaf ;
drop table sms_receivedrqts ;
drop table sms_receptresp ;
drop table sms_schedule ;
drop table sms_sendsmstogrp ;
drop table sms_smscaptions ;
drop table sms_smsgroup ;
drop table sms_smsgroupmember ;
drop table sms_smshandle ;
drop table sms_smshandleoaf ;
drop table sms_smsinvalid ;
drop table sms_smsinvalid ;
drop table sms_smsinvalidoaf ;
drop table sms_smsmsgcust ;
drop table sms_smsresponsefreq ;
drop table sms_systemlock ;
drop table sms_systemmode;
drop table sms_smsinvalidoaf;
drop table sms_smsmsgcust;
drop table sms_smsresponsefreq;
drop table sms_systemlock;
drop table sms_systemmode;
";

//remove messages from safaricom
$_SESSION["sms_messagereceived_SearchSQL"]="
						
SELECT sms_messagereceived.messagereceived_id, 
sms_messagereceived.message_from, 
sms_messagereceived.message_message, 
sms_messagereceived.created_by, 
sms_messagereceived.date_created, 
sms_messagereceived.changed_by, 
sms_messagereceived.date_changed, 
sms_messagereceived.voided, 
sms_messagereceived.voided_by, 
sms_messagereceived.date_voided, 
sms_messagereceived.uuid, sms_messagereceived.sys_track
FROM sms_messagereceived
WHERE 
trim( ucase( sms_messagereceived.message_from ) ) <> 'SAFARICOM'
AND sms_messagereceived.message_from <> ''
AND sms_messagereceived.message_from <> '450'
AND sms_messagereceived.message_message <> ''
order by sms_messagereceived.messagereceived_id desc ";

				
					
$_SESSION["sms_smsinvalid_SearchSQL"]="						
						select sms_smsinvalid.smsinvalid_id , sms_smsinvalid.connection_number , sms_smsinvalid.amount , sms_smsinvalid.phone_number , sms_smsinvalid.pay_before ,
                         sms_smsinvalid.created_by , sms_smsinvalid.date_created from sms_smsinvalid where sms_smsinvalid.connection_number<>'' order by sms_smsinvalid.connection_number, date_created
						
						";

$_SESSION["deliveryRPT"]="
select deliveryID,phone_number,message,source, ref,submittime,senttime,deliverytime,date_created, other_details,status from 
(select msgdelivery_id deliveryID,mobileno phone_number,sms_msgdelivery.message,msgsource_name source,  sendsmstogrp_name ref,submittime,senttime,deliverytime,sms_sendsmstogrp.date_created date_created,sms_smsgroup.smsgroup_name other_details,sms_msgdelivery.status from sms_msgdelivery
inner join sms_sendsmstogrp on sms_sendsmstogrp.sendsmstogrp_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 ) 
inner join sms_msgsource on sms_msgsource.msgsource_id=substring(sms_msgdelivery.sys_track ,4,1)
inner join sms_smsgroup on sms_smsgroup.smsgroup_id=sms_sendsmstogrp.smsgroup_id 

where message_source like '3002'

UNION

select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, smsremotesource_name ref,submittime,senttime,deliverytime,sms_smsremotesource.date_created date_created,datasourcetemp_name other_details ,sms_msgdelivery.status from sms_msgdelivery
inner join sms_smsremotesource on sms_smsremotesource.smsremotesource_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)
inner join sms_datasourcetemp on sms_datasourcetemp.datasourcetemp_id=sms_smsremotesource.datasourcetemp_id 

where message_source like '3003' 

UNION
select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, schedule_name ref,submittime,senttime,deliverytime,sms_schedule.date_created date_created,smsmsgcust_name other_details,sms_msgdelivery.status  from sms_msgdelivery
inner join sms_schedule on sms_schedule.schedule_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)
inner join sms_smsmsgcust on sms_smsmsgcust.smsmsgcust_id=sms_schedule.smsmsgcust_id

where message_source like '3004'

UNION
select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, schedulegeneralsms_name ref,submittime,senttime,deliverytime,sms_schedulegeneralsms.date_created date_created,' ' other_details,sms_msgdelivery.status  from sms_msgdelivery
inner join sms_schedulegeneralsms on sms_schedulegeneralsms.schedulegeneralsms_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)

where message_source like '3005'

UNION
select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, ' ' ref,submittime,senttime,deliverytime,sms_indsms.date_created date_created,'One SMS' other_details ,sms_msgdelivery.status from sms_msgdelivery
inner join sms_indsms on sms_indsms.indsms_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)

where message_source like '3001'

) t {rptwhere} order by source,other_details,ref,deliveryID desc

 "	;

$_SESSION["deliveryRPT_count"]="select count(*) from 
(select msgdelivery_id deliveryID,mobileno phone_number,sms_msgdelivery.message,msgsource_name source,  sendsmstogrp_name ref,submittime,senttime,deliverytime,sms_sendsmstogrp.date_created date_created,sms_smsgroup.smsgroup_name other_details,sms_msgdelivery.status from sms_msgdelivery
inner join sms_sendsmstogrp on sms_sendsmstogrp.sendsmstogrp_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 ) 
inner join sms_msgsource on sms_msgsource.msgsource_id=substring(sms_msgdelivery.sys_track ,4,1)
inner join sms_smsgroup on sms_smsgroup.smsgroup_id=sms_sendsmstogrp.smsgroup_id 

where message_source like '3002'

UNION
select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, smsremotesource_name ref,submittime,senttime,deliverytime,sms_smsremotesource.date_created date_created,datasourcetemp_name other_details,sms_msgdelivery.status  from sms_msgdelivery
inner join sms_smsremotesource on sms_smsremotesource.smsremotesource_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)
inner join sms_datasourcetemp on sms_datasourcetemp.datasourcetemp_id=sms_smsremotesource.datasourcetemp_id 

where message_source like '3003' 

UNION
select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, schedule_name ref,submittime,senttime,deliverytime,sms_schedule.date_created date_created,smsmsgcust_name other_details,sms_msgdelivery.status  from sms_msgdelivery
inner join sms_schedule on sms_schedule.schedule_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)
inner join sms_smsmsgcust on sms_smsmsgcust.smsmsgcust_id=sms_schedule.smsmsgcust_id

where message_source like '3004'

UNION
select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, schedulegeneralsms_name ref,submittime,senttime,deliverytime,sms_schedulegeneralsms.date_created date_created,' ' other_details,sms_msgdelivery.status  from sms_msgdelivery
inner join sms_schedulegeneralsms on sms_schedulegeneralsms.schedulegeneralsms_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)

where message_source like '3005'

UNION 
select msgdelivery_id deliveryID, mobileno phone_number,sms_msgdelivery.message,msgsource_name source, ' ' ref,submittime,senttime,deliverytime,sms_indsms.date_created date_created,'One SMS' other_details,sms_msgdelivery.status  from sms_msgdelivery
inner join sms_indsms on sms_indsms.indsms_id=substring(sms_msgdelivery.sys_track ,position('_' IN sms_msgdelivery.sys_track)+1 )
inner join sms_msgsource on sms_msgsource.msgsource_id=substring( sms_msgdelivery.sys_track ,4,1)
where message_source like '3001'
) t {rptwhere} 
";	

$_SESSION["smsrefSearchSQL"]="
						
select  sms_msgcenter.msgcenter_name , sms_ref.message_type , sms_ref.date_sent,count(remote_ref)  as sent_sms  from sms_ref  inner join sms_msgcenter on sms_msgcenter.msgcenter_id = sms_ref.msgcenter_id
group by  sms_msgcenter.msgcenter_name , sms_ref.message_type , sms_ref.date_sent
						";
$_SESSION['countSMSRefStats']="select count(*) totalCounter from (select sms_msgcenter.msgcenter_name ,
 sms_ref.message_type , sms_ref.date_sent,sum(sms_ref.message_size) as sent_sms from sms_ref 
 inner join sms_msgcenter on sms_msgcenter.msgcenter_id = sms_ref.msgcenter_id 
 group by sms_msgcenter.msgcenter_name , sms_ref.message_type , sms_ref.date_sent ) t";

 $_SESSION["sms_msgqueue_SearchSQL"]="						
 select sms_msgqueue.msgqueue_id , sms_msgqueue.phone_number , sms_msgqueue.message , sms_msgqueue.created_by ,
  sms_msgqueue.date_created , sms_msgqueue.changed_by , sms_msgqueue.date_changed , sms_msgqueue.voided , sms_msgqueue.voided_by ,
   sms_msgqueue.date_voided , sms_msgqueue.uuid , sms_msgqueue.sys_track , 
   sms_msgqueue.sys_track as message_type  from sms_msgqueue
 
 ";

 $_SESSION["sms_msgsent_SearchSQL"]="
						
						select sms_msgsent.msgsent_id , sms_msgsent.phone_number , sms_msgsent.message , sms_msgsent.created_by 
						, sms_msgsent.date_created , sms_msgsent.changed_by , sms_msgsent.date_changed , sms_msgsent.voided ,
						 sms_msgsent.voided_by , sms_msgsent.date_voided , sms_msgsent.uuid , sms_msgsent.sys_track ,
						 sms_msgsent.sys_track as message_type  from sms_msgsent
						
						";
?>