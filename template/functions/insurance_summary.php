////////////////////////total amount from Underwriter
select
insurance_insurancedebitnote.insurancedebitnote_id ,sum(receipt_amount) confirmed,0 totalpremium,0 totalIPF,0 paidtozulmac, 0 bounced_checks, 0 totalchecks, 0 returnedchecks
from insurance_dbnotetransact  
inner join insurance_insurancedebitnote on insurance_insurancedebitnote.insurancedebitnote_id = insurance_dbnotetransact.insurancedebitnote_id
group by  insurance_insurancedebitnote.insurancedebitnote_id
order by  insurance_insurancedebitnote.insurancedebitnote_id

/////////////////////////////////Total Paid to Zulmac
select
cbtrans.accaccount_name aaccount_number, 0 confirmed,0 totalpremium,0 totalIPF,sum(cbtrans.amount) paidtozulmac, 0 bounced_checks, 0 totalchecks, 0 returnedchecks
from
(select 
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
bp.naration,
bp.payment_mode

from
(select
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner,
accounts_accaccount.syownerid,
 accounts_banktrans.banktrans_name , 
accounts_banktrans.voucher_number ,
accounts_banktrans.check_number ,
 accounts_accountscategory.accountscategory_id , 
accounts_accountscategory.accountscategory_name , 
payment_currency.currency_id , 
payment_currency.currency_name , 
accounts_banktrans.amount , 
accounts_banktrans.transaction_type ,
 accounts_banktrans.naration ,
'Bank ' payment_mode

from accounts_banktrans
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_banktrans.accaccount_id  
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_banktrans.accountscategory_id  
inner join payment_currency on payment_currency.currency_id = accounts_banktrans.currency_id

where  accounts_accaccount.syowner='admin_person'


union 
select
accounts_accaccount.accaccount_name ,
accounts_accaccount.syowner,
accounts_accaccount.syownerid,
 accounts_cashtrans.cashtrans_name , 
accounts_cashtrans.vouchernumber  voucher_number,
 ' ' check_number ,
 accounts_accountscategory.accountscategory_id , 
accounts_accountscategory.accountscategory_name , 
payment_currency.currency_id , 
payment_currency.currency_name , 
accounts_cashtrans.amount , 
accounts_cashtrans.transaction_type ,
 accounts_cashtrans.naration ,
'Cash ' payment_mode

from accounts_cashtrans
inner join accounts_accaccount on accounts_accaccount.accaccount_id = accounts_cashtrans.accaccount_id  
inner join accounts_accountscategory on accounts_accountscategory.accountscategory_id = accounts_cashtrans.accountscategory_id  
inner join payment_currency on payment_currency.currency_id = accounts_cashtrans.currency_id

where  accounts_accaccount.syowner='admin_person'
) bp
inner join admin_person on admin_person.person_id=bp.syownerid
) cbtrans

group by cbtrans.accaccount_name
order by cbtrans.accaccount_name
//////////////////////////////////////////////////////////////////