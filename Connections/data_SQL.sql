select t2.MARPs_No,t2.QA3_RegDate,t4.Appointment_Date
,DateAdd('d', -7, t4.Appointment_Date) as first_rmr
,DateAdd('d', -3, t4.Appointment_Date) as second_rmr
,DateAdd('d', -1, t4.Appointment_Date) as third_rmr

 from
(select  t1.MARPs_No,t1.Q2_Phone, MAX(t1.QA3_RegDate) as QA3_RegDate
from 
(SELECT Distinct tblKPFSWScreeningA.UniversalNo, tblKPFSWScreeningA.MARPs_No, 30 as Q4_Age, tblKPFSWFollowUp.Q4_KPType, tblKPFSWFollowUp.Q2_Phone, tblKPFSWFollowUp.QA3_RegDate, 
tblKPFSWFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPFSWScreeningA INNER JOIN tblKPFSWFollowUp ON tblKPFSWScreeningA.MARPs_No = tblKPFSWFollowUp.MARPs_No
where tblKPFSWFollowUp.QA3_RegDate<tblKPFSWFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPMSMScreeningA.UniversalNo, tblKPMSMScreeningA.MARPs_No, 30 as Q4_Age, tblKPMSMFollowUp.Q4_KPType, tblKPMSMFollowUp.Q2_Phone, tblKPMSMFollowUp.QA3_RegDate,
tblKPMSMFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPMSMScreeningA INNER JOIN tblKPMSMFollowUp ON tblKPMSMScreeningA.MARPs_No = tblKPMSMFollowUp.MARPs_No
where tblKPMSMFollowUp.QA3_RegDate<tblKPMSMFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPIWDScreening.UniversalNo, tblKPIWDScreening.MARPs_No, 30 as Q4_Age, tblKPIWDFollowUp.Q4_KPType, tblKPIWDFollowUp.Q2_Phone, tblKPIWDFollowUp.QA3_RegDate, 
tblKPIWDFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPIWDScreening INNER JOIN tblKPIWDFollowUp ON tblKPIWDScreening.MARPs_No = tblKPIWDFollowUp.MARPs_No
where tblKPIWDFollowUp.QA3_RegDate<tblKPIWDFollowUp.Q26g_Appointment_Date 
) as t1
group by  t1.MARPs_No,t1.Q2_Phone) as t2

inner join 
(select  t3.MARPs_No,t3.Q2_Phone, MAX(t3.Appointment_Date) as Appointment_Date
from 
(SELECT Distinct tblKPFSWScreeningA.UniversalNo, tblKPFSWScreeningA.MARPs_No, 30 as Q4_Age, tblKPFSWFollowUp.Q4_KPType, tblKPFSWFollowUp.Q2_Phone, tblKPFSWFollowUp.QA3_RegDate, 
tblKPFSWFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPFSWScreeningA INNER JOIN tblKPFSWFollowUp ON tblKPFSWScreeningA.MARPs_No = tblKPFSWFollowUp.MARPs_No
where tblKPFSWFollowUp.QA3_RegDate<tblKPFSWFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPMSMScreeningA.UniversalNo, tblKPMSMScreeningA.MARPs_No, 30 as Q4_Age, tblKPMSMFollowUp.Q4_KPType, tblKPMSMFollowUp.Q2_Phone, tblKPMSMFollowUp.QA3_RegDate,
tblKPMSMFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPMSMScreeningA INNER JOIN tblKPMSMFollowUp ON tblKPMSMScreeningA.MARPs_No = tblKPMSMFollowUp.MARPs_No
where tblKPMSMFollowUp.QA3_RegDate<tblKPMSMFollowUp.Q26g_Appointment_Date 

union
SELECT Distinct tblKPIWDScreening.UniversalNo, tblKPIWDScreening.MARPs_No, 30 as Q4_Age, tblKPIWDFollowUp.Q4_KPType, tblKPIWDFollowUp.Q2_Phone, tblKPIWDFollowUp.QA3_RegDate, 
tblKPIWDFollowUp.Q26g_Appointment_Date as Appointment_Date
FROM tblKPIWDScreening INNER JOIN tblKPIWDFollowUp ON tblKPIWDScreening.MARPs_No = tblKPIWDFollowUp.MARPs_No
where tblKPIWDFollowUp.QA3_RegDate<tblKPIWDFollowUp.Q26g_Appointment_Date 
) as t3
group by  t3.MARPs_No,t3.Q2_Phone) as t4
on t2.MARPs_No=t4.MARPs_No