<?php
						$_SESSION["admin_activitystatus_SearchSQL"]="
						
						select admin_activitystatus.activitystatus_id , admin_activitystatus.activitystatus_name , admin_activitystatus.activitystatus_status , admin_activitystatus.created_by , admin_activitystatus.date_created , admin_activitystatus.changed_by , admin_activitystatus.date_changed , admin_activitystatus.voided , admin_activitystatus.voided_by , admin_activitystatus.date_voided , admin_activitystatus.uuid , admin_activitystatus.sys_track  from admin_activitystatus
						
						";
						$_SESSION["admin_adminuser_SearchSQL"]="
						
						select admin_adminuser.adminuser_id , admin_person.person_id , admin_person.person_name , admin_adminuser.username , admin_adminuser.password , admin_adminuser.status , admin_adminuser.created_by , admin_adminuser.date_created , admin_adminuser.changed_by , admin_adminuser.date_changed , admin_adminuser.voided , admin_adminuser.voided_by , admin_adminuser.date_voided , admin_adminuser.uuid , admin_adminuser.sys_track  from admin_adminuser  inner join admin_person on admin_person.person_id = admin_adminuser.person_id
						
						";
						$_SESSION["admin_aggrigate_SearchSQL"]="
						
						select admin_aggrigate.aggrigate_id , admin_aggrigate.aggrigate_name , admin_aggrigate.aggrigate_description , admin_aggrigate.created_by , admin_aggrigate.date_created , admin_aggrigate.changed_by , admin_aggrigate.date_changed , admin_aggrigate.voided , admin_aggrigate.voided_by , admin_aggrigate.date_voided , admin_aggrigate.uuid , admin_aggrigate.sys_track  from admin_aggrigate
						
						";
						$_SESSION["admin_alert_SearchSQL"]="
						
						select admin_alert.alert_id , admin_alert.alert_name , admin_alert.is_active , admin_alert.alert_description , admin_alert.alert_date , admin_alert.created_by , admin_alert.date_created , admin_alert.changed_by , admin_alert.date_changed , admin_alert.voided , admin_alert.voided_by , admin_alert.date_voided , admin_alert.uuid , admin_alert.sys_track  from admin_alert
						
						";
						$_SESSION["admin_autofill_SearchSQL"]="
						
						select admin_autofill.autofill_id , admin_autofill.autofill_name , admin_autofill.primary_tablelist , admin_autofill.is_visible , admin_autofill.regex , admin_autofill.editable , admin_autofill.min_len , admin_autofill.max_len , admin_autofill.caption , admin_autofill.fieldname , admin_autofill.prefix , admin_autofill.surfix , admin_autofill.digit_number , admin_autofill.fill_combination , admin_autofill.inf , admin_autofill.created_by , admin_autofill.date_created , admin_autofill.changed_by , admin_autofill.date_changed , admin_autofill.voided , admin_autofill.voided_by , admin_autofill.date_voided , admin_autofill.uuid , admin_autofill.sys_track  from admin_autofill
						
						";
						$_SESSION["admin_company_SearchSQL"]="
						
						select admin_company.company_id , admin_company.company_name , admin_company.pin_number , admin_company.vat_number , admin_company.incorp_date , admin_company.building , admin_company.location_description , admin_company.street , admin_company.mobile , admin_company.tel , admin_company.fax , admin_company.postal_address , admin_company.postal_code , admin_company.town , admin_company.email_address2 , admin_company.email_address , admin_company.website , admin_company.comment , admin_company.created_by , admin_company.date_created , admin_company.changed_by , admin_company.date_changed , admin_company.voided , admin_company.voided_by , admin_company.date_voided , admin_company.uuid , admin_company.sys_track  from admin_company
						
						";
						$_SESSION["admin_companycontact_SearchSQL"]="
						
						select admin_companycontact.companycontact_id , admin_company.company_id , admin_company.company_name , admin_person.person_id , admin_person.person_name , admin_companycontact.preferred , admin_companycontact.status , admin_companycontact.created_by , admin_companycontact.date_created , admin_companycontact.changed_by , admin_companycontact.date_changed , admin_companycontact.voided , admin_companycontact.voided_by , admin_companycontact.date_voided , admin_companycontact.uuid , admin_companycontact.sys_track  from admin_companycontact  inner join admin_company on admin_company.company_id = admin_companycontact.company_id  inner join admin_person on admin_person.person_id = admin_companycontact.person_id
						
						";
						$_SESSION["admin_companydept_SearchSQL"]="
						
						select admin_companydept.companydept_id , admin_company.company_id , admin_company.company_name , admin_dept.dept_id , admin_dept.dept_name , .location_id , .location_name , admin_companydept.description , admin_companydept.Status , admin_companydept.created_by , admin_companydept.date_created , admin_companydept.changed_by , admin_companydept.date_changed , admin_companydept.voided , admin_companydept.voided_by , admin_companydept.date_voided , admin_companydept.uuid , admin_companydept.sys_track  from admin_companydept  inner join admin_company on admin_company.company_id = admin_companydept.company_id  inner join admin_dept on admin_dept.dept_id = admin_companydept.dept_id  inner join  on .location_id = admin_companydept.location_id
						
						";
						$_SESSION["admin_companydeptrlnphp_SearchSQL"]="
						
						select admin_companydeptrlnphp.companydeptrlnphp_id , admin_companydeptrlnphp.parent , admin_dept.dept_id , admin_dept.dept_name , admin_companydeptrlnphp.description , admin_companydeptrlnphp.Status , admin_companydeptrlnphp.created_by , admin_companydeptrlnphp.date_created , admin_companydeptrlnphp.changed_by , admin_companydeptrlnphp.date_changed , admin_companydeptrlnphp.voided , admin_companydeptrlnphp.voided_by , admin_companydeptrlnphp.date_voided , admin_companydeptrlnphp.uuid , admin_companydeptrlnphp.sys_track  from admin_companydeptrlnphp  inner join admin_dept on admin_dept.dept_id = admin_companydeptrlnphp.dept_id
						
						";
						$_SESSION["admin_compstructtree_SearchSQL"]="
						
						select admin_compstructtree.compstructtree_id , admin_company.company_id , admin_company.company_name , admin_dept.dept_id , admin_dept.dept_name , .location_id , .location_name , admin_compstructtree.compstructtree_name , admin_compstructtree.description , admin_compstructtree.created_by , admin_compstructtree.date_created , admin_compstructtree.changed_by , admin_compstructtree.date_changed , admin_compstructtree.voided , admin_compstructtree.voided_by , admin_compstructtree.date_voided , admin_compstructtree.uuid , admin_compstructtree.sys_track  from admin_compstructtree  inner join admin_company on admin_company.company_id = admin_compstructtree.company_id  inner join admin_dept on admin_dept.dept_id = admin_compstructtree.dept_id  inner join  on .location_id = admin_compstructtree.location_id
						
						";
						$_SESSION["admin_contact_SearchSQL"]="
						
						select admin_contact.contact_id , admin_contact.contact_name , admin_contact.postal_address , admin_contact.location_description , admin_contact.street , admin_contact.mobile , admin_contact.tel , admin_contact.fax , admin_contact.email_address2 , admin_contact.postal_code , admin_contact.town , admin_contact.building , admin_contact.email_address , admin_contact.website , admin_contact.comment , admin_contact.created_by , admin_contact.date_created , admin_contact.changed_by , admin_contact.date_changed , admin_contact.voided , admin_contact.voided_by , admin_contact.date_voided , admin_contact.uuid , admin_contact.sys_track  from admin_contact
						
						";
						$_SESSION["admin_contactdetails_SearchSQL"]="
						
						select admin_contactdetails.contactdetails_id , admin_contactdetails.syowner , admin_contactdetails.syownerid , admin_contactdetails.email_address , admin_contactdetails.mobile_number , admin_contactdetails.postal_address , admin_contactdetails.physical_address , admin_contactdetails.fax , admin_contactdetails.telephone , admin_contactdetails.preferred , admin_contactdetails.created_by , admin_contactdetails.date_created , admin_contactdetails.changed_by , admin_contactdetails.date_changed , admin_contactdetails.voided , admin_contactdetails.voided_by , admin_contactdetails.date_voided , admin_contactdetails.uuid , admin_contactdetails.sys_track  from admin_contactdetails
						
						";
						$_SESSION["admin_controller_SearchSQL"]="
						
						select admin_controller.controller_id , admin_controller.tablename , admin_controller.groupfolder , admin_controller.displaygroup , admin_controller.displaysubgroup , admin_controller.infsubgroup , admin_controller.showgroup , admin_controller.infgroup , admin_controller.showgroupposition , admin_controller.defaultgrouptable , admin_controller.tablecaption , admin_controller.fieldname , admin_controller.gridwidth , admin_controller.fieldcaption , admin_controller.detailsvisiblepdf , admin_controller.pdfvisible , admin_controller.position , admin_controller.menuposition , admin_controller.colnwidth , admin_controller.dataformat , admin_controller.dispaytype , admin_controller.required , admin_controller.caption_position , admin_controller.control_position , admin_controller.infwidth , admin_controller.infhieght , admin_controller.infpos , admin_controller.infshow , admin_controller.displaysize , admin_controller.primarykeyidentifier , admin_controller.isautoincrement , admin_controller.accessrights , admin_controller.created_by , admin_controller.date_created , admin_controller.changed_by , admin_controller.date_changed , admin_controller.voided , admin_controller.voided_by , admin_controller.date_voided , admin_controller.uuid , admin_controller.sys_track  from admin_controller
						
						";
						$_SESSION["admin_custom_SearchSQL"]="
						
						select admin_custom.custom_id , admin_custom.tablename , admin_custom.fieldname , admin_custom.stored_value , admin_custom.display_caption , admin_custom.displaytype , admin_custom.created_by , admin_custom.date_created , admin_custom.changed_by , admin_custom.date_changed , admin_custom.voided , admin_custom.voided_by , admin_custom.date_voided , admin_custom.uuid , admin_custom.sys_track  from admin_custom
						
						";
						$_SESSION["admin_dept_SearchSQL"]="
						
						select admin_dept.dept_id , admin_dept.dept_name , .location_id , .location_name , admin_dept.description , admin_dept.effective_dt , admin_dept.created_by , admin_dept.date_created , admin_dept.changed_by , admin_dept.date_changed , admin_dept.voided , admin_dept.voided_by , admin_dept.date_voided , admin_dept.uuid , admin_dept.sys_track  from admin_dept  inner join  on .location_id = admin_dept.location_id
						
						";
						$_SESSION["admin_displaytype_SearchSQL"]="
						
						select admin_displaytype.displaytype_id , admin_displaytype.displaytype_name , admin_displaytype.created_by , admin_displaytype.date_created , admin_displaytype.changed_by , admin_displaytype.date_changed , admin_displaytype.voided , admin_displaytype.voided_by , admin_displaytype.date_voided , admin_displaytype.uuid , admin_displaytype.sys_track  from admin_displaytype
						
						";
						$_SESSION["admin_docs_SearchSQL"]="
						
						select admin_docs.docs_id , admin_docs.docs_name , admin_docs.doc_owner , admin_docs.created_by , admin_docs.date_created , admin_docs.changed_by , admin_docs.date_changed , admin_docs.voided , admin_docs.voided_by , admin_docs.date_voided , admin_docs.uuid , admin_docs.sys_track  from admin_docs
						
						";
						$_SESSION["admin_generaview_SearchSQL"]="
						
						select admin_generaview.generaview_id , designer_sview.sview_id , designer_sview.sview_name , admin_role.role_id , admin_role.role_name , designer_tblgroup.tblgroup_id , designer_tblgroup.tblgroup_name , admin_generaview.menu_caption , admin_generaview.status , admin_generaview.created_by , admin_generaview.date_created , admin_generaview.changed_by , admin_generaview.date_changed , admin_generaview.voided , admin_generaview.voided_by , admin_generaview.date_voided , admin_generaview.uuid , admin_generaview.sys_track  from admin_generaview  inner join designer_sview on designer_sview.sview_id = admin_generaview.sview_id  inner join admin_role on admin_role.role_id = admin_generaview.role_id  inner join designer_tblgroup on designer_tblgroup.tblgroup_id = admin_generaview.tblgroup_id
						
						";
						$_SESSION["admin_groupcategory_SearchSQL"]="
						
						select admin_groupcategory.groupcategory_id , admin_groupcategory.groupcategory_name , admin_groupcategory.description , admin_groupcategory.created_by , admin_groupcategory.date_created , admin_groupcategory.changed_by , admin_groupcategory.date_changed , admin_groupcategory.voided , admin_groupcategory.voided_by , admin_groupcategory.date_voided , admin_groupcategory.uuid , admin_groupcategory.sys_track  from admin_groupcategory
						
						";
						$_SESSION["admin_minmax_SearchSQL"]="
						
						select admin_minmax.minmax_id , admin_minmax.tablename , admin_minmax.fieldname , admin_minmax.minvalue , admin_minmax.maxvalue , admin_minmax.currentvalue , admin_minmax.notificationCreteria , admin_minmax.created_by , admin_minmax.date_created , admin_minmax.changed_by , admin_minmax.date_changed , admin_minmax.voided , admin_minmax.voided_by , admin_minmax.date_voided , admin_minmax.uuid , admin_minmax.sys_track  from admin_minmax
						
						";
						$_SESSION["admin_month_SearchSQL"]="
						
						select admin_month.month_id , admin_month.month_name , admin_month.created_by , admin_month.date_created , admin_month.changed_by , admin_month.date_changed , admin_month.voided , admin_month.voided_by , admin_month.date_voided , admin_month.uuid , admin_month.sys_track  from admin_month
						
						";
						$_SESSION["admin_pcategoryattribute_SearchSQL"]="
						
						select admin_pcategoryattribute.pcategoryattribute_id , admin_pcategoryattribute.pcategoryattribute_name , admin_pcategoryattribute.description , admin_pcategoryattribute.created_by , admin_pcategoryattribute.date_created , admin_pcategoryattribute.changed_by , admin_pcategoryattribute.date_changed , admin_pcategoryattribute.voided , admin_pcategoryattribute.voided_by , admin_pcategoryattribute.date_voided , admin_pcategoryattribute.uuid , admin_pcategoryattribute.sys_track  from admin_pcategoryattribute
						
						";
						$_SESSION["admin_person_SearchSQL"]="
						
						select admin_person.person_id , admin_person.person_name , admin_person.first_name , admin_person.middle_name , admin_person.last_name , admin_person.idorpassport_number , admin_person.dob , admin_person.pin , admin_person.gender , admin_person.status , admin_person.created_by , admin_person.date_created , admin_person.changed_by , admin_person.date_changed , admin_person.voided , admin_person.voided_by , admin_person.date_voided , admin_person.uuid , admin_person.sys_track  from admin_person
						
						";
						$_SESSION["admin_personattribute_SearchSQL"]="
						
						select admin_personattribute.persontypeattribute_id , admin_pcategoryattribute.pcategoryattribute_id , admin_pcategoryattribute.pcategoryattribute_name , admin_personattribute.attribute_value , admin_person.person_id , admin_person.person_name , admin_personattribute.created_by , admin_personattribute.date_created , admin_personattribute.changed_by , admin_personattribute.date_changed , admin_personattribute.voided , admin_personattribute.voided_by , admin_personattribute.date_voided , admin_personattribute.uuid , admin_personattribute.sys_track  from admin_personattribute  inner join admin_pcategoryattribute on admin_pcategoryattribute.pcategoryattribute_id = admin_personattribute.pcategoryattribute_id  inner join admin_person on admin_person.person_id = admin_personattribute.person_id
						
						";
						$_SESSION["admin_personcategoryattribute_SearchSQL"]="
						
						select admin_personcategoryattribute.personcategoryattribute_id , admin_pcategoryattribute.pcategoryattribute_id , admin_pcategoryattribute.pcategoryattribute_name , admin_personttypecategory.personttypecategory_id , admin_personttypecategory.personttypecategory_name , admin_personcategoryattribute.created_by , admin_personcategoryattribute.date_created , admin_personcategoryattribute.changed_by , admin_personcategoryattribute.date_changed , admin_personcategoryattribute.voided , admin_personcategoryattribute.voided_by , admin_personcategoryattribute.date_voided , admin_personcategoryattribute.uuid , admin_personcategoryattribute.sys_track  from admin_personcategoryattribute  inner join admin_pcategoryattribute on admin_pcategoryattribute.pcategoryattribute_id = admin_personcategoryattribute.pcategoryattribute_id  inner join admin_personttypecategory on admin_personttypecategory.personttypecategory_id = admin_personcategoryattribute.personttypecategory_id
						
						";
						$_SESSION["admin_persondept_SearchSQL"]="
						
						select admin_persondept.persondept_id , admin_dept.dept_id , admin_dept.dept_name , admin_person.person_id , admin_person.person_name , admin_persondept.start_dt , admin_persondept.end_dt , admin_persondept.is_active , admin_persondept.comments , admin_persondept.created_by , admin_persondept.date_created , admin_persondept.changed_by , admin_persondept.date_changed , admin_persondept.voided , admin_persondept.voided_by , admin_persondept.date_voided , admin_persondept.uuid , admin_persondept.sys_track  from admin_persondept  inner join admin_dept on admin_dept.dept_id = admin_persondept.dept_id  inner join admin_person on admin_person.person_id = admin_persondept.person_id
						
						";
						$_SESSION["admin_persongroup_SearchSQL"]="
						
						select admin_persongroup.persongroup_id , admin_persongroup.persongroup_name , admin_persongroup.description , admin_persongroup.created_by , admin_persongroup.date_created , admin_persongroup.changed_by , admin_persongroup.date_changed , admin_persongroup.voided , admin_persongroup.voided_by , admin_persongroup.date_voided , admin_persongroup.uuid , admin_persongroup.sys_track  from admin_persongroup
						
						";
						$_SESSION["admin_persongroupcategory_SearchSQL"]="
						
						select admin_persongroupcategory.persongroupcategory_id , admin_persongroupcategory.persongroupcategory_name , admin_groupcategory.groupcategory_id , admin_groupcategory.groupcategory_name , admin_persongroup.persongroup_id , admin_persongroup.persongroup_name , admin_persongroupcategory.description , admin_persongroupcategory.created_by , admin_persongroupcategory.date_created , admin_persongroupcategory.changed_by , admin_persongroupcategory.date_changed , admin_persongroupcategory.voided , admin_persongroupcategory.voided_by , admin_persongroupcategory.date_voided , admin_persongroupcategory.uuid , admin_persongroupcategory.sys_track  from admin_persongroupcategory  inner join admin_groupcategory on admin_groupcategory.groupcategory_id = admin_persongroupcategory.groupcategory_id  inner join admin_persongroup on admin_persongroup.persongroup_id = admin_persongroupcategory.persongroup_id
						
						";
						$_SESSION["admin_personpersontype_SearchSQL"]="
						
						select admin_personpersontype.personpersontype_id , admin_personpersontype.personpersontype_name , admin_personttypecategory.personttypecategory_id , admin_personttypecategory.personttypecategory_name , admin_person.person_id , admin_person.person_name , admin_personpersontype.created_by , admin_personpersontype.date_created , admin_personpersontype.changed_by , admin_personpersontype.date_changed , admin_personpersontype.voided , admin_personpersontype.voided_by , admin_personpersontype.date_voided , admin_personpersontype.uuid , admin_personpersontype.sys_track  from admin_personpersontype  inner join admin_personttypecategory on admin_personttypecategory.personttypecategory_id = admin_personpersontype.personttypecategory_id  inner join admin_person on admin_person.person_id = admin_personpersontype.person_id
						
						";
						$_SESSION["admin_personttypecategory_SearchSQL"]="
						
						select admin_personttypecategory.personttypecategory_id , admin_personttypecategory.personttypecategory_name , admin_personttypecategory.status , admin_personttypecategory.created_by , admin_personttypecategory.date_created , admin_personttypecategory.changed_by , admin_personttypecategory.date_changed , admin_personttypecategory.voided , admin_personttypecategory.voided_by , admin_personttypecategory.date_voided , admin_personttypecategory.uuid , admin_personttypecategory.sys_track  from admin_personttypecategory
						
						";
						$_SESSION["admin_photo_SearchSQL"]="
						
						select admin_photo.photo_id , admin_photo.photo_name , admin_photo.source_tablelist , admin_photo.source_ref , admin_photo.prefered , admin_photo.created_by , admin_photo.date_created , admin_photo.changed_by , admin_photo.date_changed , admin_photo.voided , admin_photo.voided_by , admin_photo.date_voided , admin_photo.uuid , admin_photo.sys_track  from admin_photo
						
						";
						$_SESSION["admin_plevel_SearchSQL"]="
						
						select admin_plevel.plevel_id , .paygradedecr_id , .paygradedecr_name , admin_plevel.plevel_name , admin_plevel.paygrade_salary , admin_plevel.per_day_pay , admin_plevel.created_by , admin_plevel.date_created , admin_plevel.changed_by , admin_plevel.date_changed , admin_plevel.voided , admin_plevel.voided_by , admin_plevel.date_voided , admin_plevel.uuid , admin_plevel.sys_track  from admin_plevel  inner join  on .paygradedecr_id = admin_plevel.paygradedecr_id
						
						";
						$_SESSION["admin_privilege_SearchSQL"]="
						
						select admin_privilege.privilege_id , admin_privilege.privilege_name , .statestetus_id , .statestetus_name , admin_privilege.section , admin_privilege.refid , admin_privilege.created_by , admin_privilege.date_created , admin_privilege.changed_by , admin_privilege.date_changed , admin_privilege.voided , admin_privilege.voided_by , admin_privilege.date_voided , admin_privilege.uuid , admin_privilege.sys_track  from admin_privilege  inner join  on .statestetus_id = admin_privilege.statestetus_id
						
						";
						$_SESSION["admin_rangetype_SearchSQL"]="
						
						select admin_rangetype.rangetype_id , admin_rangetype.rangetype_name , admin_rangetype.type_description , admin_rangetype.created_by , admin_rangetype.date_created , admin_rangetype.changed_by , admin_rangetype.date_changed , admin_rangetype.voided , admin_rangetype.voided_by , admin_rangetype.date_voided , admin_rangetype.uuid , admin_rangetype.sys_track  from admin_rangetype
						
						";
						$_SESSION["admin_role_SearchSQL"]="
						
						select admin_role.role_id , admin_role.role_name , admin_role.description , admin_role.created_by , admin_role.date_created , admin_role.changed_by , admin_role.date_changed , admin_role.voided , admin_role.voided_by , admin_role.date_voided , admin_role.uuid , admin_role.sys_track  from admin_role
						
						";
						$_SESSION["admin_rolenotification_SearchSQL"]="
						
						select admin_rolenotification.rolenotification_id , admin_role.role_id , admin_role.role_name , admin_rolenotificationevent.rolenotificationevent_id , admin_rolenotificationevent.rolenotificationevent_name , admin_table.table_id , admin_table.table_name , admin_rolenotification.notificationtype , admin_rolenotification.notification_order , admin_rolenotification.awaits_activity , admin_rolenotification.success , admin_rolenotification.failure , admin_rolenotification.undetermined , admin_rolenotification.comments , admin_rolenotification.created_by , admin_rolenotification.date_created , admin_rolenotification.changed_by , admin_rolenotification.date_changed , admin_rolenotification.voided , admin_rolenotification.voided_by , admin_rolenotification.date_voided , admin_rolenotification.uuid , admin_rolenotification.sys_track  from admin_rolenotification  inner join admin_role on admin_role.role_id = admin_rolenotification.role_id  inner join admin_rolenotificationevent on admin_rolenotificationevent.rolenotificationevent_id = admin_rolenotification.rolenotificationevent_id  inner join admin_table on admin_table.table_id = admin_rolenotification.table_id
						
						";
						$_SESSION["admin_rolenotificationevent_SearchSQL"]="
						
						select admin_rolenotificationevent.rolenotificationevent_id , admin_rolenotificationevent.rolenotificationevent_name , admin_rolenotificationevent.description , admin_rolenotificationevent.created_by , admin_rolenotificationevent.date_created , admin_rolenotificationevent.changed_by , admin_rolenotificationevent.date_changed , admin_rolenotificationevent.voided , admin_rolenotificationevent.voided_by , admin_rolenotificationevent.date_voided , admin_rolenotificationevent.uuid , admin_rolenotificationevent.sys_track  from admin_rolenotificationevent
						
						";
						$_SESSION["admin_rolenotificationhist_SearchSQL"]="
						
						select admin_rolenotificationhist.rolenotificationhist_id , admin_rolenotificationhist.rolenotificationhist_name , admin_rolenotificationevent.rolenotificationevent_id , admin_rolenotificationevent.rolenotificationevent_name , admin_rolenotificationhist.notification_details , admin_rolenotificationhist.actioned_by , admin_rolenotificationhist.action , admin_rolenotificationhist.primary_tablelist , admin_table.table_id , admin_table.table_name , admin_rolenotificationhist.recordid , admin_rolenotificationhist.status , admin_rolenotificationhist.comment , admin_rolenotificationhist.created_by , admin_rolenotificationhist.date_created , admin_rolenotificationhist.changed_by , admin_rolenotificationhist.date_changed , admin_rolenotificationhist.voided , admin_rolenotificationhist.voided_by , admin_rolenotificationhist.date_voided , admin_rolenotificationhist.uuid , admin_rolenotificationhist.sys_track  from admin_rolenotificationhist  inner join admin_rolenotificationevent on admin_rolenotificationevent.rolenotificationevent_id = admin_rolenotificationhist.rolenotificationevent_id  inner join admin_table on admin_table.table_id = admin_rolenotificationhist.table_id
						
						";
						$_SESSION["admin_roleperson_SearchSQL"]="
						
						select admin_roleperson.roleperson_id , admin_person.person_id , admin_person.person_name , admin_role.role_id , admin_role.role_name , admin_roleperson.created_by , admin_roleperson.date_created , admin_roleperson.changed_by , admin_roleperson.date_changed , admin_roleperson.voided , admin_roleperson.voided_by , admin_roleperson.date_voided , admin_roleperson.uuid , admin_roleperson.sys_track  from admin_roleperson  inner join admin_person on admin_person.person_id = admin_roleperson.person_id  inner join admin_role on admin_role.role_id = admin_roleperson.role_id
						
						";
						$_SESSION["admin_roleprivilege_SearchSQL"]="
						
						select admin_roleprivilege.roleprivilege_id , admin_role.role_id , admin_role.role_name , admin_roleprivilege.privilegeid , admin_roleprivilege.activity , admin_roleprivilege.created_by , admin_roleprivilege.date_created , admin_roleprivilege.changed_by , admin_roleprivilege.date_changed , admin_roleprivilege.voided , admin_roleprivilege.voided_by , admin_roleprivilege.date_voided , admin_roleprivilege.uuid , admin_roleprivilege.sys_track  from admin_roleprivilege  inner join admin_role on admin_role.role_id = admin_roleprivilege.role_id
						
						";
						$_SESSION["admin_rolerole_SearchSQL"]="
						
						select admin_rolerole.rolerole_id , admin_role.role_id , admin_role.role_name , admin_rolerole.parent_role , admin_rolerole.created_by , admin_rolerole.date_created , admin_rolerole.changed_by , admin_rolerole.date_changed , admin_rolerole.voided , admin_rolerole.voided_by , admin_rolerole.date_voided , admin_rolerole.uuid , admin_rolerole.sys_track  from admin_rolerole  inner join admin_role on admin_role.role_id = admin_rolerole.role_id
						
						";
						$_SESSION["admin_schart_SearchSQL"]="
						
						select admin_schart.schart_id , designer_charttype.charttype_id , designer_charttype.charttype_name , admin_schart.schart_name , admin_schart.chart_position , admin_schart.tablelist , admin_schart.fieldlist_xaxis , admin_schart.xaxiscaption , admin_schart.fieldlist_yaxis , designer_aggrigate.aggrigate_id , designer_aggrigate.aggrigate_name , admin_rangetype.rangetype_id , admin_rangetype.rangetype_name , admin_schart.range_begin , admin_schart.yaxiscaption , admin_schart.range_end , admin_viewmode.viewmode_id , admin_viewmode.viewmode_name , admin_schart.created_by , admin_schart.date_created , admin_schart.changed_by , admin_schart.date_changed , admin_schart.voided , admin_schart.voided_by , admin_schart.date_voided , admin_schart.uuid , admin_schart.sys_track  from admin_schart  inner join designer_charttype on designer_charttype.charttype_id = admin_schart.charttype_id  inner join designer_aggrigate on designer_aggrigate.aggrigate_id = admin_schart.aggrigate_id  inner join admin_rangetype on admin_rangetype.rangetype_id = admin_schart.rangetype_id  inner join admin_viewmode on admin_viewmode.viewmode_id = admin_schart.viewmode_id
						
						";
						$_SESSION["admin_statement_SearchSQL"]="
						
						select admin_statement.statement_id , admin_statement.tablename , admin_statement.statement_caption , admin_statement.statement_link , admin_statement.show_identifier , admin_statement.first_only , admin_statement.pdfvisible , admin_statement.position , admin_statement.created_by , admin_statement.date_created , admin_statement.changed_by , admin_statement.date_changed , admin_statement.voided , admin_statement.voided_by , admin_statement.date_voided , admin_statement.uuid , admin_statement.sys_track  from admin_statement
						
						";
						$_SESSION["admin_statestatus_SearchSQL"]="
						
						select admin_statestatus.statestatus_id , admin_statestatus.statestatus_name , admin_statestatus.created_by , admin_statestatus.date_created , admin_statestatus.changed_by , admin_statestatus.date_changed , admin_statestatus.voided , admin_statestatus.voided_by , admin_statestatus.date_voided , admin_statestatus.uuid , admin_statestatus.sys_track  from admin_statestatus
						
						";
						$_SESSION["admin_statestatustbl_SearchSQL"]="
						
						select admin_statestatustbl.statestatustbl_id , .statestatus_id , .statestatus_name , admin_statestatustbl.table_list , admin_statestatustbl.field_list , admin_statestatustbl.status , admin_statestatustbl.created_by , admin_statestatustbl.date_created , admin_statestatustbl.changed_by , admin_statestatustbl.date_changed , admin_statestatustbl.voided , admin_statestatustbl.voided_by , admin_statestatustbl.date_voided , admin_statestatustbl.uuid , admin_statestatustbl.sys_track  from admin_statestatustbl  inner join  on .statestatus_id = admin_statestatustbl.statestatus_id
						
						";
						$_SESSION["admin_status_SearchSQL"]="
						
						select admin_status.statustypestatus_id , .statustype_id , .statustype_name , admin_status.status_name , admin_status.caption , admin_status.position , admin_status.created_by , admin_status.date_created , admin_status.changed_by , admin_status.date_changed , admin_status.voided , admin_status.voided_by , admin_status.date_voided , admin_status.uuid , admin_status.sys_track  from admin_status  inner join  on .statustype_id = admin_status.statustype_id
						
						";
						$_SESSION["admin_systemvariable_SearchSQL"]="
						
						select admin_systemvariable.systemvariable_id , admin_systemvariable.systemvariable_name , admin_systemvariable.created_by , admin_systemvariable.date_created , admin_systemvariable.changed_by , admin_systemvariable.date_changed , admin_systemvariable.voided , admin_systemvariable.voided_by , admin_systemvariable.date_voided , admin_systemvariable.uuid , admin_systemvariable.sys_track  from admin_systemvariable
						
						";
						$_SESSION["admin_table_SearchSQL"]="
						
						select admin_table.table_id , admin_table.table_name , admin_table.table_caption , admin_table.statement_caption , admin_table.flexcolumn , admin_table.gridwidth , admin_table.gridhieght , admin_table.formheight , admin_table.orderpos , admin_table.created_by , admin_table.date_created , admin_table.changed_by , admin_table.date_changed , admin_table.voided , admin_table.voided_by , admin_table.date_voided , admin_table.uuid , admin_table.sys_track  from admin_table
						
						";
						$_SESSION["admin_timeperiodtype_SearchSQL"]="
						
						select admin_timeperiodtype.timeperiodtype_id , admin_timeperiodtype.timeperiodtype_name , admin_timeperiodtype.created_by , admin_timeperiodtype.date_created , admin_timeperiodtype.changed_by , admin_timeperiodtype.date_changed , admin_timeperiodtype.voided , admin_timeperiodtype.voided_by , admin_timeperiodtype.date_voided , admin_timeperiodtype.uuid , admin_timeperiodtype.sys_track  from admin_timeperiodtype
						
						";
						$_SESSION["admin_user_SearchSQL"]="
						
						select admin_user.id , .employee_id , .employee_name , admin_user.userid , admin_user.user_password , admin_user.UserName , admin_user.user_priviledge , admin_user.security_question , admin_user.security_q_answer , .usergroup_id , .usergroup_name , admin_user.user_active_status , admin_user.created_by , admin_user.date_created , admin_user.changed_by , admin_user.date_changed , admin_user.voided , admin_user.voided_by , admin_user.date_voided , admin_user.uuid , admin_user.sys_track  from admin_user  inner join  on .employee_id = admin_user.employee_id  inner join  on .usergroup_id = admin_user.usergroup_id
						
						";
						$_SESSION["admin_usergrouprole_SearchSQL"]="
						
						select admin_usergrouprole.usergrouprole_id , .usergroup_id , .usergroup_name , admin_usergrouprole.tablename , admin_usergrouprole.previge , admin_usergrouprole.start_date , admin_usergrouprole.end_date , admin_usergrouprole.created_by , admin_usergrouprole.date_created , admin_usergrouprole.changed_by , admin_usergrouprole.date_changed , admin_usergrouprole.voided , admin_usergrouprole.voided_by , admin_usergrouprole.date_voided , admin_usergrouprole.uuid , admin_usergrouprole.sys_track  from admin_usergrouprole  inner join  on .usergroup_id = admin_usergrouprole.usergroup_id
						
						";
						$_SESSION["admin_version_SearchSQL"]="
						
						select admin_version.version_id , admin_version.version_name , admin_version.entered_date , admin_version.modified_date , admin_version.description , admin_version.created_by , admin_version.date_created , admin_version.changed_by , admin_version.date_changed , admin_version.voided , admin_version.voided_by , admin_version.date_voided , admin_version.uuid , admin_version.sys_track  from admin_version
						
						";
						$_SESSION["admin_viewicon_SearchSQL"]="
						
						select admin_viewicon.viewicon_id , admin_viewicon.viewicon_name , admin_viewicon.created_by , admin_viewicon.date_created , admin_viewicon.changed_by , admin_viewicon.date_changed , admin_viewicon.voided , admin_viewicon.voided_by , admin_viewicon.date_voided , admin_viewicon.uuid , admin_viewicon.sys_track  from admin_viewicon
						
						";
						$_SESSION["admin_viewmode_SearchSQL"]="
						
						select admin_viewmode.viewmode_id , admin_viewmode.viewmode_name , admin_viewmode.viewmode_status , admin_viewmode.created_by , admin_viewmode.date_created , admin_viewmode.changed_by , admin_viewmode.date_changed , admin_viewmode.voided , admin_viewmode.voided_by , admin_viewmode.date_voided , admin_viewmode.uuid , admin_viewmode.sys_track  from admin_viewmode
						
						";
						$_SESSION["com_batchemail_SearchSQL"]="
						
						select com_batchemail.batchemail_id , com_batchemail.batchemail_name , admin_persongroup.persongroup_id , admin_persongroup.persongroup_name , com_batchemail.subject , com_batchemail.body , com_batchemail.transaction_date , com_batchemail.created_by , com_batchemail.date_created , com_batchemail.changed_by , com_batchemail.date_changed , com_batchemail.voided , com_batchemail.voided_by , com_batchemail.date_voided , com_batchemail.uuid , com_batchemail.sys_track  from com_batchemail  inner join admin_persongroup on admin_persongroup.persongroup_id = com_batchemail.persongroup_id
						
						";
						$_SESSION["com_emailsettings_SearchSQL"]="
						
						select com_emailsettings.emailsettings_id , com_emailsettings.email_address , com_emailsettings.password , com_emailsettings.port , com_emailsettings.host , com_emailsettings.send_from , com_emailsettings.SMT_secure , com_emailsettings.SMPT_authentication , com_emailsettings.preferred , com_emailsettings.comment , com_emailsettings.created_by , com_emailsettings.date_created , com_emailsettings.changed_by , com_emailsettings.date_changed , com_emailsettings.voided , com_emailsettings.voided_by , com_emailsettings.date_voided , com_emailsettings.uuid , com_emailsettings.sys_track  from com_emailsettings
						
						";
						$_SESSION["com_sendemail_SearchSQL"]="
						
						select com_sendemail.sendemail_id , com_sendemail.syowner , com_sendemail.syownerid , com_sendemail.email_subject , com_sendemail.email_body , com_sendemail.attachments , com_sendemail.created_by , com_sendemail.date_created , com_sendemail.changed_by , com_sendemail.date_changed , com_sendemail.voided , com_sendemail.voided_by , com_sendemail.date_voided , com_sendemail.uuid , com_sendemail.sys_track  from com_sendemail
						
						";
						$_SESSION["designer_aggrigate_SearchSQL"]="
						
						select designer_aggrigate.aggrigate_id , designer_aggrigate.aggrigate_name , designer_aggrigate.aggrigate_description , designer_aggrigate.created_by , designer_aggrigate.date_created , designer_aggrigate.changed_by , designer_aggrigate.date_changed , designer_aggrigate.voided , designer_aggrigate.voided_by , designer_aggrigate.date_voided , designer_aggrigate.uuid , designer_aggrigate.sys_track  from designer_aggrigate
						
						";
						$_SESSION["designer_aggrigatetype_SearchSQL"]="
						
						select designer_aggrigatetype.aggrigatetype_id , designer_aggrigatetype.aggrigatetype_name , designer_aggrigatetype.created_by , designer_aggrigatetype.date_created , designer_aggrigatetype.changed_by , designer_aggrigatetype.date_changed , designer_aggrigatetype.voided , designer_aggrigatetype.voided_by , designer_aggrigatetype.date_voided , designer_aggrigatetype.uuid , designer_aggrigatetype.sys_track  from designer_aggrigatetype
						
						";
						$_SESSION["designer_categorizeother_SearchSQL"]="
						
						select designer_categorizeother.categorizeother_id , designer_categorizeother.categorizeother_name , designer_othercategory.othercategory_id , designer_othercategory.othercategory_name , designer_categorizeother.created_by , designer_categorizeother.date_created , designer_categorizeother.changed_by , designer_categorizeother.date_changed , designer_categorizeother.voided , designer_categorizeother.voided_by , designer_categorizeother.date_voided , designer_categorizeother.uuid , designer_categorizeother.sys_track  from designer_categorizeother  inner join designer_othercategory on designer_othercategory.othercategory_id = designer_categorizeother.othercategory_id
						
						";
						$_SESSION["designer_charttype_SearchSQL"]="
						
						select designer_charttype.charttype_id , designer_charttype.charttype_name , designer_charttype.charttype_description , designer_charttype.created_by , designer_charttype.date_created , designer_charttype.changed_by , designer_charttype.date_changed , designer_charttype.voided , designer_charttype.voided_by , designer_charttype.date_voided , designer_charttype.uuid , designer_charttype.sys_track  from designer_charttype
						
						";
						$_SESSION["designer_combocustomization_SearchSQL"]="
						
						select designer_combocustomization.combocustomization_id , designer_combocustomization.combo_tablelist , designer_combocustomization.fieldvalue , designer_combocustomization.othervalues , designer_combocustomization.created_by , designer_combocustomization.date_created , designer_combocustomization.changed_by , designer_combocustomization.date_changed , designer_combocustomization.voided , designer_combocustomization.voided_by , designer_combocustomization.date_voided , designer_combocustomization.uuid , designer_combocustomization.sys_track  from designer_combocustomization
						
						";
						$_SESSION["designer_crdbdeterminant_SearchSQL"]="
						
						select designer_crdbdeterminant.crdbdeterminant_id , designer_crdbdeterminant.credit_tablelist , designer_crdbdeterminant.debit_tablelist , designer_crdbdeterminant.created_by , designer_crdbdeterminant.date_created , designer_crdbdeterminant.changed_by , designer_crdbdeterminant.date_changed , designer_crdbdeterminant.voided , designer_crdbdeterminant.voided_by , designer_crdbdeterminant.date_voided , designer_crdbdeterminant.uuid , designer_crdbdeterminant.sys_track  from designer_crdbdeterminant
						
						";
						$_SESSION["designer_custfunc_SearchSQL"]="
						
						select designer_custfunc.custfunc_id , designer_custfunc.custfunc_name , designer_custfunc.func_tablelist , designer_custfunc.created_by , designer_custfunc.date_created , designer_custfunc.changed_by , designer_custfunc.date_changed , designer_custfunc.voided , designer_custfunc.voided_by , designer_custfunc.date_voided , designer_custfunc.uuid , designer_custfunc.sys_track  from designer_custfunc
						
						";
						$_SESSION["designer_datatype_SearchSQL"]="
						
						select designer_datatype.datatype_id , designer_datatype.datatype_name , designer_datatype.created_by , designer_datatype.date_created , designer_datatype.changed_by , designer_datatype.date_changed , designer_datatype.voided , designer_datatype.voided_by , designer_datatype.date_voided , designer_datatype.uuid , designer_datatype.sys_track  from designer_datatype
						
						";
						$_SESSION["designer_fasttbldesign_SearchSQL"]="
						
						select designer_fasttbldesign.fasttbldesign_id , designer_sview.sview_id , designer_sview.sview_name , designer_fasttbldesign.primary_tablelist , designer_fasttbldesign.secondary_tablelist , designer_fasttbldesign.tabcaption , designer_fasttbldesign.tab_index , designer_fasttbldesign.created_by , designer_fasttbldesign.date_created , designer_fasttbldesign.changed_by , designer_fasttbldesign.date_changed , designer_fasttbldesign.voided , designer_fasttbldesign.voided_by , designer_fasttbldesign.date_voided , designer_fasttbldesign.uuid , designer_fasttbldesign.sys_track  from designer_fasttbldesign  inner join designer_sview on designer_sview.sview_id = designer_fasttbldesign.sview_id
						
						";
						$_SESSION["designer_fieldcustomization_SearchSQL"]="
						
						select designer_fieldcustomization.fieldcustomization_id , designer_fieldcustomization.field_tablelist , designer_fieldcustomization.current_fieldname , structure_displaytype.displaytype_id , structure_displaytype.displaytype_name , designer_fieldcustomization.caption , designer_fieldcustomization.is_visible , designer_fieldcustomization.num_cols , designer_fieldcustomization.options , designer_fieldcustomization.created_by , designer_fieldcustomization.date_created , designer_fieldcustomization.changed_by , designer_fieldcustomization.date_changed , designer_fieldcustomization.voided , designer_fieldcustomization.voided_by , designer_fieldcustomization.date_voided , designer_fieldcustomization.uuid , designer_fieldcustomization.sys_track  from designer_fieldcustomization  inner join structure_displaytype on structure_displaytype.displaytype_id = designer_fieldcustomization.displaytype_id
						
						";
						$_SESSION["designer_flexcolumn_SearchSQL"]="
						
						select designer_flexcolumn.flexcolum_id , designer_flexcolumn.primary_tablelist , designer_flexcolumn.options_tablelist , designer_flexcolumn.orderby , designer_flexcolumn.default_section , designer_flexcolumn.created_by , designer_flexcolumn.date_created , designer_flexcolumn.changed_by , designer_flexcolumn.date_changed , designer_flexcolumn.voided , designer_flexcolumn.voided_by , designer_flexcolumn.date_voided , designer_flexcolumn.uuid , designer_flexcolumn.sys_track  from designer_flexcolumn
						
						";
						$_SESSION["designer_gender_SearchSQL"]="
						
						select designer_gender.gender_id , designer_gender.gender_name , designer_gender.created_by , designer_gender.date_created , designer_gender.changed_by , designer_gender.date_changed , designer_gender.voided , designer_gender.voided_by , designer_gender.date_voided , designer_gender.uuid , designer_gender.sys_track  from designer_gender
						
						";
						$_SESSION["designer_grouptbls_SearchSQL"]="
						
						select designer_grouptbls.grouptbls_id , designer_tblgroup.tblgroup_id , designer_tblgroup.tblgroup_name , designer_grouptbls.tblgroup_tablelist , designer_grouptbls.orderpos , designer_grouptbls.table_caption , designer_grouptbls.menu , designer_grouptbls.statement , designer_grouptbls.created_by , designer_grouptbls.date_created , designer_grouptbls.changed_by , designer_grouptbls.date_changed , designer_grouptbls.voided , designer_grouptbls.voided_by , designer_grouptbls.date_voided , designer_grouptbls.uuid , designer_grouptbls.sys_track  from designer_grouptbls  inner join designer_tblgroup on designer_tblgroup.tblgroup_id = designer_grouptbls.tblgroup_id
						
						";
						$_SESSION["designer_othercategory_SearchSQL"]="
						
						select designer_othercategory.othercategory_id , designer_othercategory.othercategory_name , designer_othercategory.created_by , designer_othercategory.date_created , designer_othercategory.changed_by , designer_othercategory.date_changed , designer_othercategory.voided , designer_othercategory.voided_by , designer_othercategory.date_voided , designer_othercategory.uuid , designer_othercategory.sys_track  from designer_othercategory
						
						";
						$_SESSION["designer_othermenu_SearchSQL"]="
						
						select designer_othermenu.othermenu_id , designer_othercategory.othercategory_id , designer_othercategory.othercategory_name , admin_role.role_id , admin_role.role_name , designer_tblgroup.tblgroup_id , designer_tblgroup.tblgroup_name , designer_othermenu.menu_caption , designer_othermenu.status , designer_othermenu.created_by , designer_othermenu.date_created , designer_othermenu.changed_by , designer_othermenu.date_changed , designer_othermenu.voided , designer_othermenu.voided_by , designer_othermenu.date_voided , designer_othermenu.uuid , designer_othermenu.sys_track  from designer_othermenu  inner join designer_othercategory on designer_othercategory.othercategory_id = designer_othermenu.othercategory_id  inner join admin_role on admin_role.role_id = designer_othermenu.role_id  inner join designer_tblgroup on designer_tblgroup.tblgroup_id = designer_othermenu.tblgroup_id
						
						";
						$_SESSION["designer_preaggrigate_SearchSQL"]="
						
						select designer_preaggrigate.preaggrigate_id , designer_preaggrigate.preaggrigate_name , designer_preaggrigate.created_by , designer_preaggrigate.date_created , designer_preaggrigate.changed_by , designer_preaggrigate.date_changed , designer_preaggrigate.voided , designer_preaggrigate.voided_by , designer_preaggrigate.date_voided , designer_preaggrigate.uuid , designer_preaggrigate.sys_track  from designer_preaggrigate
						
						";
						$_SESSION["designer_queryfield_SearchSQL"]="
						
						select designer_queryfield.queryfield_id , reports_reportview.reportview_id , reports_reportview.reportview_name , designer_queryfield.report_caption , designer_queryfield.section_caption , designer_queryfield.column_width , designer_queryfield.query , designer_queryfield.created_by , designer_queryfield.date_created , designer_queryfield.changed_by , designer_queryfield.date_changed , designer_queryfield.voided , designer_queryfield.voided_by , designer_queryfield.date_voided , designer_queryfield.uuid , designer_queryfield.sys_track  from designer_queryfield  inner join reports_reportview on reports_reportview.reportview_id = designer_queryfield.reportview_id
						
						";
						$_SESSION["designer_relationship_SearchSQL"]="
						
						select designer_relationship.relationship_id , designer_relationship.relationship_name , designer_relationship.description , designer_relationship.created_by , designer_relationship.date_created , designer_relationship.changed_by , designer_relationship.date_changed , designer_relationship.voided , designer_relationship.voided_by , designer_relationship.date_voided , designer_relationship.uuid , designer_relationship.sys_track  from designer_relationship
						
						";
						$_SESSION["designer_relationshipstatus_SearchSQL"]="
						
						select designer_relationshipstatus.relationshipstatus_id , designer_relationshipstatus.relationshipstatus_name , designer_relationshipstatus.description , designer_relationshipstatus.created_by , designer_relationshipstatus.date_created , designer_relationshipstatus.changed_by , designer_relationshipstatus.date_changed , designer_relationshipstatus.voided , designer_relationshipstatus.voided_by , designer_relationshipstatus.date_voided , designer_relationshipstatus.uuid , designer_relationshipstatus.sys_track  from designer_relationshipstatus
						
						";
						$_SESSION["designer_resultdisplay_SearchSQL"]="
						
						select designer_resultdisplay.resultdisplay_id , designer_resultdisplay.resultdisplay_name , designer_resultdisplay.description , designer_resultdisplay.created_by , designer_resultdisplay.date_created , designer_resultdisplay.changed_by , designer_resultdisplay.date_changed , designer_resultdisplay.voided , designer_resultdisplay.voided_by , designer_resultdisplay.date_voided , designer_resultdisplay.uuid , designer_resultdisplay.sys_track  from designer_resultdisplay
						
						";
						$_SESSION["designer_sectparent_SearchSQL"]="
						
						select designer_sectparent.sectparent_id , designer_sectparent.sectparent_tablelist , designer_sectparent.child_tablelist , designer_sectparent.created_by , designer_sectparent.date_created , designer_sectparent.changed_by , designer_sectparent.date_changed , designer_sectparent.voided , designer_sectparent.voided_by , designer_sectparent.date_voided , designer_sectparent.uuid , designer_sectparent.sys_track  from designer_sectparent
						
						";
						$_SESSION["designer_sform_SearchSQL"]="
						
						select designer_sform.sform_id , designer_sform.sform_name , designer_sform.active , designer_sform.description , designer_sform.created_by , designer_sform.date_created , designer_sform.changed_by , designer_sform.date_changed , designer_sform.voided , designer_sform.voided_by , designer_sform.date_voided , designer_sform.uuid , designer_sform.sys_track  from designer_sform
						
						";
						$_SESSION["designer_sview_SearchSQL"]="
						
						select designer_sview.sview_id , designer_sview.sview_name , designer_sview.context_menu , designer_sview.main_caption , designer_sview.created_by , designer_sview.date_created , designer_sview.changed_by , designer_sview.date_changed , designer_sview.voided , designer_sview.voided_by , designer_sview.date_voided , designer_sview.uuid , designer_sview.sys_track  from designer_sview
						
						";
						$_SESSION["designer_sysaction_SearchSQL"]="
						
						select designer_sysaction.sysaction_id , designer_sysaction.sysaction_name , designer_sysaction.description , designer_sysaction.created_by , designer_sysaction.date_created , designer_sysaction.changed_by , designer_sysaction.date_changed , designer_sysaction.voided , designer_sysaction.voided_by , designer_sysaction.date_voided , designer_sysaction.uuid , designer_sysaction.sys_track  from designer_sysaction
						
						";
						$_SESSION["designer_sysmodules_SearchSQL"]="
						
						select designer_sysmodules.sysmodules_id , designer_sysmodules.sysmodules_name , designer_sysmodules.created_by , designer_sysmodules.date_created , designer_sysmodules.changed_by , designer_sysmodules.date_changed , designer_sysmodules.voided , designer_sysmodules.voided_by , designer_sysmodules.date_voided , designer_sysmodules.uuid , designer_sysmodules.sys_track  from designer_sysmodules
						
						";
						$_SESSION["designer_systemclass_SearchSQL"]="
						
						select designer_systemclass.systemclass_id , designer_systemclass.systemclass_name , designer_systemclass.created_by , designer_systemclass.date_created , designer_systemclass.changed_by , designer_systemclass.date_changed , designer_systemclass.voided , designer_systemclass.voided_by , designer_systemclass.date_voided , designer_systemclass.uuid , designer_systemclass.sys_track  from designer_systemclass
						
						";
						$_SESSION["designer_sytable_SearchSQL"]="
						
						select designer_sytable.sytable_id , designer_sytable.sytable_tablelist , designer_sytable.invisible , designer_sytable.created_by , designer_sytable.date_created , designer_sytable.changed_by , designer_sytable.date_changed , designer_sytable.voided , designer_sytable.voided_by , designer_sytable.date_voided , designer_sytable.uuid , designer_sytable.sys_track  from designer_sytable
						
						";
						$_SESSION["designer_tableaction_SearchSQL"]="
						
						select designer_tableaction.tableaction_id , designer_tableaction.primary_tablelist , designer_sysaction.sysaction_id , designer_sysaction.sysaction_name , designer_resultdisplay.resultdisplay_id , designer_resultdisplay.resultdisplay_name , designer_tableaction.activity_stage , designer_tableaction.created_by , designer_tableaction.date_created , designer_tableaction.changed_by , designer_tableaction.date_changed , designer_tableaction.voided , designer_tableaction.voided_by , designer_tableaction.date_voided , designer_tableaction.uuid , designer_tableaction.sys_track  from designer_tableaction  inner join designer_sysaction on designer_sysaction.sysaction_id = designer_tableaction.sysaction_id  inner join designer_resultdisplay on designer_resultdisplay.resultdisplay_id = designer_tableaction.resultdisplay_id
						
						";
						$_SESSION["designer_tabmngr_SearchSQL"]="
						
						select designer_tabmngr.tabmngr_id , designer_sform.sform_id , designer_sform.sform_name , designer_sview.sview_id , designer_sview.sview_name , designer_tabmngr.displaycolumns , designer_tabmngr.collapsible , designer_tabmngr.hideLabel , designer_tabmngr.collapsed , designer_tabmngr.is_primary , designer_tabmngr.tablelist_secondary , designer_tabmngr.secondary_position , designer_tabmngr.display_caption , admin_viewmode.viewmode_id , admin_viewmode.viewmode_name , admin_viewicon.viewicon_id , admin_viewicon.viewicon_name , designer_tabmngr.fieldlist_visible , designer_tabmngr.created_by , designer_tabmngr.date_created , designer_tabmngr.changed_by , designer_tabmngr.date_changed , designer_tabmngr.voided , designer_tabmngr.voided_by , designer_tabmngr.date_voided , designer_tabmngr.uuid , designer_tabmngr.sys_track  from designer_tabmngr  inner join designer_sform on designer_sform.sform_id = designer_tabmngr.sform_id  inner join designer_sview on designer_sview.sview_id = designer_tabmngr.sview_id  inner join admin_viewmode on admin_viewmode.viewmode_id = designer_tabmngr.viewmode_id  inner join admin_viewicon on admin_viewicon.viewicon_id = designer_tabmngr.viewicon_id
						
						";
						$_SESSION["designer_tbgrplsubgrp_SearchSQL"]="
						
						select designer_tbgrplsubgrp.tbgrplsubgrp_id , .tblsubgrp_id , .tblsubgrp_name , designer_tblgroup.tblgroup_id , designer_tblgroup.tblgroup_name , designer_tbgrplsubgrp.position , designer_tbgrplsubgrp.caption , designer_tbgrplsubgrp.created_by , designer_tbgrplsubgrp.date_created , designer_tbgrplsubgrp.changed_by , designer_tbgrplsubgrp.date_changed , designer_tbgrplsubgrp.voided , designer_tbgrplsubgrp.voided_by , designer_tbgrplsubgrp.date_voided , designer_tbgrplsubgrp.uuid , designer_tbgrplsubgrp.sys_track  from designer_tbgrplsubgrp  inner join  on .tblsubgrp_id = designer_tbgrplsubgrp.tblsubgrp_id  inner join designer_tblgroup on designer_tblgroup.tblgroup_id = designer_tbgrplsubgrp.tblgroup_id
						
						";
						$_SESSION["designer_tblgroup_SearchSQL"]="
						
						select designer_tblgroup.tblgroup_id , designer_tblgroup.tblgroup_name , designer_tblgroup.caption , designer_tblgroup.created_by , designer_tblgroup.date_created , designer_tblgroup.changed_by , designer_tblgroup.date_changed , designer_tblgroup.voided , designer_tblgroup.voided_by , designer_tblgroup.date_voided , designer_tblgroup.uuid , designer_tblgroup.sys_track  from designer_tblgroup
						
						";
						$_SESSION["designer_tblrelation_SearchSQL"]="
						
						select designer_tblrelation.tblrelation_id , admin_person.person_id , admin_person.person_name , designer_tblrelation.personrelated_to , designer_relationship.relationship_id , designer_relationship.relationship_name , designer_relationshipstatus.relationshipstatus_id , designer_relationshipstatus.relationshipstatus_name , designer_tblrelation.created_by , designer_tblrelation.date_created , designer_tblrelation.changed_by , designer_tblrelation.date_changed , designer_tblrelation.voided , designer_tblrelation.voided_by , designer_tblrelation.date_voided , designer_tblrelation.uuid , designer_tblrelation.sys_track  from designer_tblrelation  inner join admin_person on admin_person.person_id = designer_tblrelation.person_id  inner join designer_relationship on designer_relationship.relationship_id = designer_tblrelation.relationship_id  inner join designer_relationshipstatus on designer_relationshipstatus.relationshipstatus_id = designer_tblrelation.relationshipstatus_id
						
						";
						$_SESSION["designer_tblsubgrp_SearchSQL"]="
						
						select designer_tblsubgrp.tblsubgrp_id , designer_tblsubgrp.tblsubgrp_name , designer_tblsubgrp.created_by , designer_tblsubgrp.date_created , designer_tblsubgrp.changed_by , designer_tblsubgrp.date_changed , designer_tblsubgrp.voided , designer_tblsubgrp.voided_by , designer_tblsubgrp.date_voided , designer_tblsubgrp.uuid , designer_tblsubgrp.sys_track  from designer_tblsubgrp
						
						";
						$_SESSION["designer_tblsummary_SearchSQL"]="
						
						select designer_tblsummary.tblsummary_id , designer_tblsummary.aggrigate_tablelist , designer_tblsummary.aggrigate_field , designer_tblsummary.aggrigate_caption , designer_aggrigatetype.aggrigatetype_id , designer_aggrigatetype.aggrigatetype_name , designer_preaggrigate.preaggrigate_id , designer_preaggrigate.preaggrigate_name , designer_tblsummary.is_visible , designer_tblsummary.created_by , designer_tblsummary.date_created , designer_tblsummary.changed_by , designer_tblsummary.date_changed , designer_tblsummary.voided , designer_tblsummary.voided_by , designer_tblsummary.date_voided , designer_tblsummary.uuid , designer_tblsummary.sys_track  from designer_tblsummary  inner join designer_aggrigatetype on designer_aggrigatetype.aggrigatetype_id = designer_tblsummary.aggrigatetype_id  inner join designer_preaggrigate on designer_preaggrigate.preaggrigate_id = designer_tblsummary.preaggrigate_id
						
						";
						$_SESSION["designer_viewicon_SearchSQL"]="
						
						select designer_viewicon.viewicon_id , designer_viewicon.viewicon_name , designer_viewicon.viewicon_image , designer_viewicon.created_by , designer_viewicon.date_created , designer_viewicon.changed_by , designer_viewicon.date_changed , designer_viewicon.voided , designer_viewicon.voided_by , designer_viewicon.date_voided , designer_viewicon.uuid , designer_viewicon.sys_track  from designer_viewicon
						
						";
						$_SESSION["designer_viewmode_SearchSQL"]="
						
						select designer_viewmode.viewmode_id , designer_viewmode.viewmode_name , designer_viewmode.viewmode_status , designer_viewmode.created_by , designer_viewmode.date_created , designer_viewmode.changed_by , designer_viewmode.date_changed , designer_viewmode.voided , designer_viewmode.voided_by , designer_viewmode.date_voided , designer_viewmode.uuid , designer_viewmode.sys_track  from designer_viewmode
						
						";
						$_SESSION["designer_viewphoto_SearchSQL"]="
						
						select designer_viewphoto.viewphoto_id , designer_sview.sview_id , designer_sview.sview_name , designer_viewphoto.show_photo , designer_viewphoto.created_by , designer_viewphoto.date_created , designer_viewphoto.changed_by , designer_viewphoto.date_changed , designer_viewphoto.voided , designer_viewphoto.voided_by , designer_viewphoto.date_voided , designer_viewphoto.uuid , designer_viewphoto.sys_track  from designer_viewphoto  inner join designer_sview on designer_sview.sview_id = designer_viewphoto.sview_id
						
						";
						$_SESSION["payment_bank_SearchSQL"]="
						
						select payment_bank.bank_id , payment_bank.bank_name , payment_bank.code , payment_bank.created_by , payment_bank.date_created , payment_bank.changed_by , payment_bank.date_changed , payment_bank.voided , payment_bank.voided_by , payment_bank.date_voided , payment_bank.uuid , payment_bank.sys_track  from payment_bank
						
						";
						$_SESSION["payment_costcenter_SearchSQL"]="
						
						select payment_costcenter.costcenter_id , payment_costcenter.costcenter_name , payment_costcenter.cost_center_value , payment_costcenter.use_cost_center_value , .employee_id , .employee_name , payment_costcenter.comments , payment_costcenter.created_by , payment_costcenter.date_created , payment_costcenter.changed_by , payment_costcenter.date_changed , payment_costcenter.voided , payment_costcenter.voided_by , payment_costcenter.date_voided , payment_costcenter.uuid , payment_costcenter.sys_track  from payment_costcenter  inner join  on .employee_id = payment_costcenter.employee_id
						
						";
						$_SESSION["payment_costcenterallocation_SearchSQL"]="
						
						select payment_costcenterallocation.costcenterallocation_id , payment_costcenter.costcenter_id , payment_costcenter.costcenter_name , payment_costcenterallocation.amount , payment_costcenterallocation.date_allocated , payment_costcenterallocation.comment , payment_costcenterallocation.created_by , payment_costcenterallocation.date_created , payment_costcenterallocation.changed_by , payment_costcenterallocation.date_changed , payment_costcenterallocation.voided , payment_costcenterallocation.voided_by , payment_costcenterallocation.date_voided , payment_costcenterallocation.uuid , payment_costcenterallocation.sys_track  from payment_costcenterallocation  inner join payment_costcenter on payment_costcenter.costcenter_id = payment_costcenterallocation.costcenter_id
						
						";
						$_SESSION["payment_currency_SearchSQL"]="
						
						select payment_currency.currency_id , payment_currency.currency_code , payment_currency.currency_name , payment_currency.exchange_rate , payment_currency.created_by , payment_currency.date_created , payment_currency.changed_by , payment_currency.date_changed , payment_currency.voided , payment_currency.voided_by , payment_currency.date_voided , payment_currency.uuid , payment_currency.sys_track  from payment_currency
						
						";
						$_SESSION["sms_autoresponse_SearchSQL"]="
						
						select sms_autoresponse.autoresponse_id , sms_autoresponse.message_from , sms_autoresponse.request_type , sms_autoresponse.message_message , sms_autoresponse.created_by , sms_autoresponse.date_created , sms_autoresponse.changed_by , sms_autoresponse.date_changed , sms_autoresponse.voided , sms_autoresponse.voided_by , sms_autoresponse.date_voided , sms_autoresponse.uuid , sms_autoresponse.sys_track  from sms_autoresponse
						
						";
						$_SESSION["sms_billhandle_SearchSQL"]="
						
						select sms_billhandle.billhandle_id , sms_billhandle.connection_number , sms_billhandle.amount , sms_billhandle.phone_number , sms_billhandle.pay_before , sms_smsmsgcust.smsmsgcust_id , sms_smsmsgcust.smsmsgcust_name , sms_billhandle.prev_reading , sms_billhandle.curr_reading , sms_billhandle.consumption , sms_billhandle.proposed_message , sms_billhandle.created_by , sms_billhandle.date_created , sms_billhandle.changed_by , sms_billhandle.date_changed , sms_billhandle.voided , sms_billhandle.voided_by , sms_billhandle.date_voided , sms_billhandle.uuid , sms_billhandle.sys_track  from sms_billhandle  inner join sms_smsmsgcust on sms_smsmsgcust.smsmsgcust_id = sms_billhandle.smsmsgcust_id
						
						";
						$_SESSION["sms_billmonth_SearchSQL"]="
						
						select sms_billmonth.billmonth_id , sms_billmonth.billmonth_name , sms_billmonth.bill_month , sms_billmonth.created_by , sms_billmonth.date_created , sms_billmonth.changed_by , sms_billmonth.date_changed , sms_billmonth.voided , sms_billmonth.voided_by , sms_billmonth.date_voided , sms_billmonth.uuid , sms_billmonth.sys_track  from sms_billmonth
						
						";
						$_SESSION["sms_billyear_SearchSQL"]="
						
						select sms_billyear.billyear_id , sms_billyear.billyear_name , sms_billyear.created_by , sms_billyear.date_created , sms_billyear.changed_by , sms_billyear.date_changed , sms_billyear.voided , sms_billyear.voided_by , sms_billyear.date_voided , sms_billyear.uuid , sms_billyear.sys_track  from sms_billyear
						
						";
						$_SESSION["sms_creditbalance_SearchSQL"]="
						
						select sms_creditbalance.creditbalance_id , sms_creditbalance.balance , sms_creditbalance.created_by , sms_creditbalance.date_created , sms_creditbalance.changed_by , sms_creditbalance.date_changed , sms_creditbalance.voided , sms_creditbalance.voided_by , sms_creditbalance.date_voided , sms_creditbalance.uuid , sms_creditbalance.sys_track  from sms_creditbalance
						
						";
						$_SESSION["sms_datasourcetemp_SearchSQL"]="
						
						select sms_datasourcetemp.datasourcetemp_id , sms_datasourcetemp.datasourcetemp_name , sms_smsmsgcust.smsmsgcust_id , sms_smsmsgcust.smsmsgcust_name , sms_datasourcetemp.query , sms_datasourcetemp.parameters , sms_datasourcetemp.created_by , sms_datasourcetemp.date_created , sms_datasourcetemp.changed_by , sms_datasourcetemp.date_changed , sms_datasourcetemp.voided , sms_datasourcetemp.voided_by , sms_datasourcetemp.date_voided , sms_datasourcetemp.uuid , sms_datasourcetemp.sys_track  from sms_datasourcetemp  inner join sms_smsmsgcust on sms_smsmsgcust.smsmsgcust_id = sms_datasourcetemp.smsmsgcust_id
						
						";
						$_SESSION["sms_disconnschedule_SearchSQL"]="
						
						select sms_disconnschedule.disconnschedule_id , sms_disconnschedule.disconnschedule_name , sms_smsmsgcust.smsmsgcust_id , sms_smsmsgcust.smsmsgcust_name , sms_disconnschedule.schedule_description , sms_disconnschedule.bill_date , sms_disconnschedule.due_after , sms_disconnschedule.file_brouwse , sms_disconnschedule.created_by , sms_disconnschedule.date_created , sms_disconnschedule.changed_by , sms_disconnschedule.date_changed , sms_disconnschedule.voided , sms_disconnschedule.voided_by , sms_disconnschedule.date_voided , sms_disconnschedule.uuid , sms_disconnschedule.sys_track  from sms_disconnschedule  inner join sms_smsmsgcust on sms_smsmsgcust.smsmsgcust_id = sms_disconnschedule.smsmsgcust_id
						
						";
						$_SESSION["sms_emailhandle_SearchSQL"]="
						
						select sms_emailhandle.emailhandle_id , sms_emailhandle.connection_number , sms_emailhandle.zone , sms_emailhandle.email_address , sms_billmonth.billmonth_id , sms_billmonth.billmonth_name , sms_billyear.billyear_id , sms_billyear.billyear_name , sms_emailhandle.created_by , sms_emailhandle.date_created , sms_emailhandle.changed_by , sms_emailhandle.date_changed , sms_emailhandle.voided , sms_emailhandle.voided_by , sms_emailhandle.date_voided , sms_emailhandle.uuid , sms_emailhandle.sys_track  from sms_emailhandle  inner join sms_billmonth on sms_billmonth.billmonth_id = sms_emailhandle.billmonth_id  inner join sms_billyear on sms_billyear.billyear_id = sms_emailhandle.billyear_id
						
						";
						$_SESSION["sms_emailschedule_SearchSQL"]="
						
						select sms_emailschedule.emailschedule_id , sms_emailschedule.emailschedule_name , sms_emailschedule.schedule_description , sms_emailschedule.connection_number , sms_emailschedule.zone , sms_billmonth.billmonth_id , sms_billmonth.billmonth_name , sms_billyear.billyear_id , sms_billyear.billyear_name , sms_emailschedule.created_by , sms_emailschedule.date_created , sms_emailschedule.changed_by , sms_emailschedule.date_changed , sms_emailschedule.voided , sms_emailschedule.voided_by , sms_emailschedule.date_voided , sms_emailschedule.uuid , sms_emailschedule.sys_track  from sms_emailschedule  inner join sms_billmonth on sms_billmonth.billmonth_id = sms_emailschedule.billmonth_id  inner join sms_billyear on sms_billyear.billyear_id = sms_emailschedule.billyear_id
						
						";
						$_SESSION["sms_generalsmshandle_SearchSQL"]="
						
						select sms_generalsmshandle.generalsmshandle_id , sms_generalsmshandle.recepient , sms_generalsmshandle.phone_number , sms_generalsmshandle.message , sms_generalsmshandle.created_by , sms_generalsmshandle.date_created , sms_generalsmshandle.changed_by , sms_generalsmshandle.date_changed , sms_generalsmshandle.voided , sms_generalsmshandle.voided_by , sms_generalsmshandle.date_voided , sms_generalsmshandle.uuid , sms_generalsmshandle.sys_track  from sms_generalsmshandle
						
						";
						$_SESSION["sms_groupqueue_SearchSQL"]="
						
						select sms_groupqueue.groupqueue_id , sms_smsgroup.smsgroup_id , sms_smsgroup.smsgroup_name , sms_groupqueue.phone_number , sms_groupqueue.recepient , sms_groupqueue.message , sms_groupqueue.created_by , sms_groupqueue.date_created , sms_groupqueue.changed_by , sms_groupqueue.date_changed , sms_groupqueue.voided , sms_groupqueue.voided_by , sms_groupqueue.date_voided , sms_groupqueue.uuid , sms_groupqueue.sys_track  from sms_groupqueue  inner join sms_smsgroup on sms_smsgroup.smsgroup_id = sms_groupqueue.smsgroup_id
						
						";
						$_SESSION["sms_indsms_SearchSQL"]="
						
						select sms_indsms.indsms_id , sms_indsms.reciepient , sms_indsms.message , sms_indsms.created_by , sms_indsms.date_created , sms_indsms.changed_by , sms_indsms.date_changed , sms_indsms.voided , sms_indsms.voided_by , sms_indsms.date_voided , sms_indsms.uuid , sms_indsms.sys_track  from sms_indsms
						
						";
						$_SESSION["sms_invalidemailaddress_SearchSQL"]="
						
						select sms_invalidemailaddress.invalidemailaddress_id , sms_invalidemailaddress.connection_number , sms_invalidemailaddress.zone , sms_invalidemailaddress.email_address , sms_billmonth.billmonth_id , sms_billmonth.billmonth_name , sms_billyear.billyear_id , sms_billyear.billyear_name , sms_invalidemailaddress.created_by , sms_invalidemailaddress.date_created , sms_invalidemailaddress.changed_by , sms_invalidemailaddress.date_changed , sms_invalidemailaddress.voided , sms_invalidemailaddress.voided_by , sms_invalidemailaddress.date_voided , sms_invalidemailaddress.uuid , sms_invalidemailaddress.sys_track  from sms_invalidemailaddress  inner join sms_billmonth on sms_billmonth.billmonth_id = sms_invalidemailaddress.billmonth_id  inner join sms_billyear on sms_billyear.billyear_id = sms_invalidemailaddress.billyear_id
						
						";
						$_SESSION["sms_invalidgeneraladdress_SearchSQL"]="
						
						select sms_invalidgeneraladdress.invalidgeneraladdress_id , sms_invalidgeneraladdress.recepient , sms_invalidgeneraladdress.phone_number , sms_invalidgeneraladdress.message , sms_invalidgeneraladdress.created_by , sms_invalidgeneraladdress.date_created , sms_invalidgeneraladdress.changed_by , sms_invalidgeneraladdress.date_changed , sms_invalidgeneraladdress.voided , sms_invalidgeneraladdress.voided_by , sms_invalidgeneraladdress.date_voided , sms_invalidgeneraladdress.uuid , sms_invalidgeneraladdress.sys_track  from sms_invalidgeneraladdress
						
						";
						$_SESSION["sms_invalidphonenumber_SearchSQL"]="
						
						select sms_invalidphonenumber.invalidphonenumber_id , sms_invalidphonenumber.recepient , sms_invalidphonenumber.phone_number , sms_invalidphonenumber.created_by , sms_invalidphonenumber.date_created , sms_invalidphonenumber.changed_by , sms_invalidphonenumber.date_changed , sms_invalidphonenumber.voided , sms_invalidphonenumber.voided_by , sms_invalidphonenumber.date_voided , sms_invalidphonenumber.uuid , sms_invalidphonenumber.sys_track  from sms_invalidphonenumber
						
						";
						$_SESSION["sms_messagereceived_SearchSQL"]="
						
						select sms_messagereceived.messagereceived_id , sms_messagereceived.message_from , sms_messagereceived.message_message , sms_messagereceived.created_by , sms_messagereceived.date_created , sms_messagereceived.changed_by , sms_messagereceived.date_changed , sms_messagereceived.voided , sms_messagereceived.voided_by , sms_messagereceived.date_voided , sms_messagereceived.uuid , sms_messagereceived.sys_track  from sms_messagereceived
						
						";
						$_SESSION["sms_messagesend_SearchSQL"]="
						
						select sms_messagesend.messagesend_id , sms_messagesend.messagesend_name , sms_messagesend.reciepient , sms_messagesend.message , sms_messagesend.status , sms_messagesend.created_by , sms_messagesend.date_created , sms_messagesend.changed_by , sms_messagesend.date_changed , sms_messagesend.voided , sms_messagesend.voided_by , sms_messagesend.date_voided , sms_messagesend.uuid , sms_messagesend.sys_track  from sms_messagesend
						
						";
						$_SESSION["sms_monthfilter_SearchSQL"]="
						
						select sms_monthfilter.monthfilter_id , sms_monthfilter.monthfilter_name , sms_monthfilter.created_by , sms_monthfilter.date_created , sms_monthfilter.changed_by , sms_monthfilter.date_changed , sms_monthfilter.voided , sms_monthfilter.voided_by , sms_monthfilter.date_voided , sms_monthfilter.uuid , sms_monthfilter.sys_track  from sms_monthfilter
						
						";
						$_SESSION["sms_msgcenter_SearchSQL"]="
						
						select sms_msgcenter.msgcenter_id , sms_msgcenter.msgcenter_name , sms_msgcenter.description , sms_msgcenter.created_by , sms_msgcenter.date_created , sms_msgcenter.changed_by , sms_msgcenter.date_changed , sms_msgcenter.voided , sms_msgcenter.voided_by , sms_msgcenter.date_voided , sms_msgcenter.uuid , sms_msgcenter.sys_track  from sms_msgcenter
						
						";
						$_SESSION["sms_msgcenterdefault_SearchSQL"]="
						
						select sms_msgcenterdefault.msgcenterdefault_id , sms_msgcenterdefault.center , sms_msgcenterdefault.created_by , sms_msgcenterdefault.date_created , sms_msgcenterdefault.changed_by , sms_msgcenterdefault.date_changed , sms_msgcenterdefault.voided , sms_msgcenterdefault.voided_by , sms_msgcenterdefault.date_voided , sms_msgcenterdefault.uuid , sms_msgcenterdefault.sys_track  from sms_msgcenterdefault
						
						";
						$_SESSION["sms_msgdelivery_SearchSQL"]="
						
						select sms_msgdelivery.msgdelivery_id , sms_msgdelivery.messageid , sms_msgdelivery.externalid , sms_msgdelivery.senderid , sms_msgdelivery.mobileno , sms_msgdelivery.message , sms_msgdelivery.submittime , sms_msgdelivery.senttime , sms_msgdelivery.deliverytime , sms_msgdelivery.status , sms_msgdelivery.undeliveredreason , sms_msgdelivery.details , sms_msgdelivery.created_by , sms_msgdelivery.date_created , sms_msgdelivery.changed_by , sms_msgdelivery.date_changed , sms_msgdelivery.voided , sms_msgdelivery.voided_by , sms_msgdelivery.date_voided , sms_msgdelivery.uuid , sms_msgdelivery.sys_track  from sms_msgdelivery
						
						";
						$_SESSION["sms_msginvalid_SearchSQL"]="
						
						select sms_msginvalid.msginvalid_id , sms_msginvalid.phone_number , sms_msginvalid.message , sms_msginvalid.created_by , sms_msginvalid.date_created , sms_msginvalid.changed_by , sms_msginvalid.date_changed , sms_msginvalid.voided , sms_msginvalid.voided_by , sms_msginvalid.date_voided , sms_msginvalid.uuid , sms_msginvalid.sys_track  from sms_msginvalid
						
						";
						$_SESSION["sms_msgqueue_SearchSQL"]="
						
						select sms_msgqueue.msgqueue_id , sms_msgqueue.phone_number , sms_msgqueue.message , sms_msgqueue.created_by , sms_msgqueue.date_created , sms_msgqueue.changed_by , sms_msgqueue.date_changed , sms_msgqueue.voided , sms_msgqueue.voided_by , sms_msgqueue.date_voided , sms_msgqueue.uuid , sms_msgqueue.sys_track  from sms_msgqueue
						
						";
						$_SESSION["sms_msgsent_SearchSQL"]="
						
						select sms_msgsent.msgsent_id , sms_msgsent.phone_number , sms_msgsent.message , sms_msgsent.created_by , sms_msgsent.date_created , sms_msgsent.changed_by , sms_msgsent.date_changed , sms_msgsent.voided , sms_msgsent.voided_by , sms_msgsent.date_voided , sms_msgsent.uuid , sms_msgsent.sys_track  from sms_msgsent
						
						";
						$_SESSION["sms_msgsource_SearchSQL"]="
						
						select sms_msgsource.msgsource_id , sms_msgsource.msgsource_name , sms_msgsource.message_source , sms_msgsource.created_by , sms_msgsource.date_created , sms_msgsource.changed_by , sms_msgsource.date_changed , sms_msgsource.voided , sms_msgsource.voided_by , sms_msgsource.date_voided , sms_msgsource.uuid , sms_msgsource.sys_track  from sms_msgsource
						
						";
						$_SESSION["sms_processed2014_SearchSQL"]="
						
						select sms_processed2014.processedSMS_id , sms_processed2014.phone_number , sms_processed2014.connection_number , sms_processed2014.message , sms_processed2014.created_by , sms_processed2014.date_created , sms_processed2014.changed_by , sms_processed2014.date_changed , sms_processed2014.voided , sms_processed2014.voided_by , sms_processed2014.date_voided , sms_processed2014.uuid , sms_processed2014.sys_track  from sms_processed2014
						
						";
						$_SESSION["sms_processedemail_SearchSQL"]="
						
						select sms_processedemail.processedemail_id , sms_processedemail.email_address , sms_processedemail.connection_number , sms_billmonth.billmonth_id , sms_billmonth.billmonth_name , sms_billyear.billyear_id , sms_billyear.billyear_name , sms_processedemail.zone , sms_processedemail.created_by , sms_processedemail.date_created , sms_processedemail.changed_by , sms_processedemail.date_changed , sms_processedemail.voided , sms_processedemail.voided_by , sms_processedemail.date_voided , sms_processedemail.uuid , sms_processedemail.sys_track  from sms_processedemail  inner join sms_billmonth on sms_billmonth.billmonth_id = sms_processedemail.billmonth_id  inner join sms_billyear on sms_billyear.billyear_id = sms_processedemail.billyear_id
						
						";
						$_SESSION["sms_processedfailedemail_SearchSQL"]="
						
						select sms_processedfailedemail.processedfailedemail_id , sms_processedfailedemail.email_address , sms_processedfailedemail.connection_number , sms_billyear.billyear_id , sms_billyear.billyear_name , sms_billmonth.billmonth_id , sms_billmonth.billmonth_name , sms_processedfailedemail.zone , sms_processedfailedemail.reason_failed , sms_processedfailedemail.created_by , sms_processedfailedemail.date_created , sms_processedfailedemail.changed_by , sms_processedfailedemail.date_changed , sms_processedfailedemail.voided , sms_processedfailedemail.voided_by , sms_processedfailedemail.date_voided , sms_processedfailedemail.uuid , sms_processedfailedemail.sys_track  from sms_processedfailedemail  inner join sms_billyear on sms_billyear.billyear_id = sms_processedfailedemail.billyear_id  inner join sms_billmonth on sms_billmonth.billmonth_id = sms_processedfailedemail.billmonth_id
						
						";
						$_SESSION["sms_processedgeneralsms_SearchSQL"]="
						
						select sms_processedgeneralsms.processedgeneralsms_id , sms_processedgeneralsms.phone_number , sms_processedgeneralsms.recepient , sms_processedgeneralsms.message , sms_processedgeneralsms.created_by , sms_processedgeneralsms.date_created , sms_processedgeneralsms.changed_by , sms_processedgeneralsms.date_changed , sms_processedgeneralsms.voided , sms_processedgeneralsms.voided_by , sms_processedgeneralsms.date_voided , sms_processedgeneralsms.uuid , sms_processedgeneralsms.sys_track  from sms_processedgeneralsms
						
						";
						$_SESSION["sms_processedsms_SearchSQL"]="
						
						select sms_processedsms.processedSMS_id , sms_processedsms.phone_number , sms_processedsms.connection_number , sms_processedsms.message , sms_processedsms.created_by , sms_processedsms.date_created , sms_processedsms.changed_by , sms_processedsms.date_changed , sms_processedsms.voided , sms_processedsms.voided_by , sms_processedsms.date_voided , sms_processedsms.uuid , sms_processedsms.sys_track  from sms_processedsms
						
						";
						$_SESSION["sms_receivedrqts_SearchSQL"]="
						
						select sms_receivedrqts.receivedrqts_id , sms_receivedrqts.message_from , sms_receivedrqts.request_type , sms_receivedrqts.message_message , sms_receivedrqts.created_by , sms_receivedrqts.date_created , sms_receivedrqts.changed_by , sms_receivedrqts.date_changed , sms_receivedrqts.voided , sms_receivedrqts.voided_by , sms_receivedrqts.date_voided , sms_receivedrqts.uuid , sms_receivedrqts.sys_track  from sms_receivedrqts
						
						";
						$_SESSION["sms_recurrenttaskschedule_SearchSQL"]="
						
						select sms_recurrenttaskschedule.recurrenttaskschedule_id , sms_recurrenttaskschedule.recurrenttaskschedule_name , .taskperiod_id , .taskperiod_name , sms_recurrenttaskschedule.config , sms_recurrenttaskschedule.created_by , sms_recurrenttaskschedule.date_created , sms_recurrenttaskschedule.changed_by , sms_recurrenttaskschedule.date_changed , sms_recurrenttaskschedule.voided , sms_recurrenttaskschedule.voided_by , sms_recurrenttaskschedule.date_voided , sms_recurrenttaskschedule.uuid , sms_recurrenttaskschedule.sys_track  from sms_recurrenttaskschedule  inner join  on .taskperiod_id = sms_recurrenttaskschedule.taskperiod_id
						
						";
						$_SESSION["sms_ref_SearchSQL"]="
						
						select sms_ref.ref_id , sms_ref.source , sms_ref.number_sent , sms_ref.date_sent , sms_ref.created_by , sms_ref.date_created , sms_ref.changed_by , sms_ref.date_changed , sms_ref.voided , sms_ref.voided_by , sms_ref.date_voided , sms_ref.uuid , sms_ref.sys_track  from sms_ref
						
						";
						$_SESSION["sms_schedule_SearchSQL"]="
						
						select sms_schedule.schedule_id , sms_schedule.schedule_name , sms_smsmsgcust.smsmsgcust_id , sms_smsmsgcust.smsmsgcust_name , sms_schedule.schedule_description , sms_schedule.bill_date , sms_schedule.due_after , sms_schedule.file_brouwse , sms_schedule.created_by , sms_schedule.date_created , sms_schedule.changed_by , sms_schedule.date_changed , sms_schedule.voided , sms_schedule.voided_by , sms_schedule.date_voided , sms_schedule.uuid , sms_schedule.sys_track  from sms_schedule  inner join sms_smsmsgcust on sms_smsmsgcust.smsmsgcust_id = sms_schedule.smsmsgcust_id
						
						";
						$_SESSION["sms_schedulegeneralsms_SearchSQL"]="
						
						select sms_schedulegeneralsms.schedulegeneralsms_id , sms_schedulegeneralsms.schedulegeneralsms_name , sms_schedulegeneralsms.message , sms_schedulegeneralsms.file_brouwse , sms_schedulegeneralsms.created_by , sms_schedulegeneralsms.date_created , sms_schedulegeneralsms.changed_by , sms_schedulegeneralsms.date_changed , sms_schedulegeneralsms.voided , sms_schedulegeneralsms.voided_by , sms_schedulegeneralsms.date_voided , sms_schedulegeneralsms.uuid , sms_schedulegeneralsms.sys_track  from sms_schedulegeneralsms
						
						";
						$_SESSION["sms_school_SearchSQL"]="
						
						select sms_school.school_id , sms_school.school_name , sms_school.code , sms_school.date_registered , sms_school.admission , sms_school.admission desc , sms_school.created_by , sms_school.date_created , sms_school.changed_by , sms_school.date_changed , sms_school.voided , sms_school.voided_by , sms_school.date_voided , sms_school.uuid , sms_school.sys_track  from sms_school
						
						";
						$_SESSION["sms_sendsmstogrp_SearchSQL"]="
						
						select sms_sendsmstogrp.sendsmstogrp_id , sms_smsgroup.smsgroup_id , sms_smsgroup.smsgroup_name , sms_sendsmstogrp.sms_message , sms_sendsmstogrp.comment , sms_sendsmstogrp.created_by , sms_sendsmstogrp.date_created , sms_sendsmstogrp.changed_by , sms_sendsmstogrp.date_changed , sms_sendsmstogrp.voided , sms_sendsmstogrp.voided_by , sms_sendsmstogrp.date_voided , sms_sendsmstogrp.uuid , sms_sendsmstogrp.sys_track  from sms_sendsmstogrp  inner join sms_smsgroup on sms_smsgroup.smsgroup_id = sms_sendsmstogrp.smsgroup_id
						
						";
						$_SESSION["sms_sentgroupsms_SearchSQL"]="
						
						select sms_sentgroupsms.sentgroupsms_id , sms_smsgroup.smsgroup_id , sms_smsgroup.smsgroup_name , sms_sentgroupsms.phone_number , sms_sentgroupsms.recepient , sms_sentgroupsms.message , sms_sentgroupsms.created_by , sms_sentgroupsms.date_created , sms_sentgroupsms.changed_by , sms_sentgroupsms.date_changed , sms_sentgroupsms.voided , sms_sentgroupsms.voided_by , sms_sentgroupsms.date_voided , sms_sentgroupsms.uuid , sms_sentgroupsms.sys_track  from sms_sentgroupsms  inner join sms_smsgroup on sms_smsgroup.smsgroup_id = sms_sentgroupsms.smsgroup_id
						
						";
						$_SESSION["sms_smscaptions_SearchSQL"]="
						
						select sms_smscaptions.smscaptions_id , sms_smscaptions.sms_tablelist , sms_smscaptions.caption , sms_smscaptions.created_by , sms_smscaptions.date_created , sms_smscaptions.changed_by , sms_smscaptions.date_changed , sms_smscaptions.voided , sms_smscaptions.voided_by , sms_smscaptions.date_voided , sms_smscaptions.uuid , sms_smscaptions.sys_track  from sms_smscaptions
						
						";
						$_SESSION["sms_smsgroup_SearchSQL"]="
						
						select sms_smsgroup.smsgroup_id , sms_smsgroup.smsgroup_name , sms_smsgroup.description , sms_smsgroup.created_by , sms_smsgroup.date_created , sms_smsgroup.changed_by , sms_smsgroup.date_changed , sms_smsgroup.voided , sms_smsgroup.voided_by , sms_smsgroup.date_voided , sms_smsgroup.uuid , sms_smsgroup.sys_track  from sms_smsgroup
						
						";
						$_SESSION["sms_smsgroupmember_SearchSQL"]="
						
						select sms_smsgroupmember.smsgroupmember_id , sms_smsgroup.smsgroup_id , sms_smsgroup.smsgroup_name , sms_smsgroupmember.syowner , sms_smsgroupmember.syownerid , sms_smsgroupmember.created_by , sms_smsgroupmember.date_created , sms_smsgroupmember.changed_by , sms_smsgroupmember.date_changed , sms_smsgroupmember.voided , sms_smsgroupmember.voided_by , sms_smsgroupmember.date_voided , sms_smsgroupmember.uuid , sms_smsgroupmember.sys_track  from sms_smsgroupmember  inner join sms_smsgroup on sms_smsgroup.smsgroup_id = sms_smsgroupmember.smsgroup_id
						
						";
						$_SESSION["sms_smsgrouptemp_SearchSQL"]="
						
						select sms_smsgrouptemp.smsgrouptemp_id , sms_smsgroup.smsgroup_id , sms_smsgroup.smsgroup_name , sms_smsmsgcust.smsmsgcust_id , sms_smsmsgcust.smsmsgcust_name , sms_smsgrouptemp.description , sms_smsgrouptemp.created_by , sms_smsgrouptemp.date_created , sms_smsgrouptemp.changed_by , sms_smsgrouptemp.date_changed , sms_smsgrouptemp.voided , sms_smsgrouptemp.voided_by , sms_smsgrouptemp.date_voided , sms_smsgrouptemp.uuid , sms_smsgrouptemp.sys_track  from sms_smsgrouptemp  inner join sms_smsgroup on sms_smsgroup.smsgroup_id = sms_smsgrouptemp.smsgroup_id  inner join sms_smsmsgcust on sms_smsmsgcust.smsmsgcust_id = sms_smsgrouptemp.smsmsgcust_id
						
						";
						$_SESSION["sms_smsinvalid_SearchSQL"]="
						
						select sms_smsinvalid.smsinvalid_id , sms_smsinvalid.connection_number , sms_smsinvalid.amount , sms_smsinvalid.phone_number , sms_smsinvalid.pay_before , sms_smsinvalid.prev_reading , sms_smsinvalid.curr_reading , sms_smsinvalid.consumption , sms_smsinvalid.created_by , sms_smsinvalid.date_created , sms_smsinvalid.changed_by , sms_smsinvalid.date_changed , sms_smsinvalid.voided , sms_smsinvalid.voided_by , sms_smsinvalid.date_voided , sms_smsinvalid.uuid , sms_smsinvalid.sys_track  from sms_smsinvalid
						
						";
						$_SESSION["sms_smsmsgcust_SearchSQL"]="
						
						select sms_smsmsgcust.smsmsgcust_id , sms_smsmsgcust.smsmsgcust_name , sms_smsmsgcust.message , sms_smsmsgcust.status , sms_smsmsgcust.created_by , sms_smsmsgcust.date_created , sms_smsmsgcust.changed_by , sms_smsmsgcust.date_changed , sms_smsmsgcust.voided , sms_smsmsgcust.voided_by , sms_smsmsgcust.date_voided , sms_smsmsgcust.uuid , sms_smsmsgcust.sys_track  from sms_smsmsgcust
						
						";
						$_SESSION["sms_smsremotesource_SearchSQL"]="
						
						select sms_smsremotesource.smsremotesource_id , sms_smsremotesource.smsremotesource_name , .datasourcetemp_id , .datasourcetemp_name , sms_smsremotesource.parameters , sms_smsremotesource.created_by , sms_smsremotesource.date_created , sms_smsremotesource.changed_by , sms_smsremotesource.date_changed , sms_smsremotesource.voided , sms_smsremotesource.voided_by , sms_smsremotesource.date_voided , sms_smsremotesource.uuid , sms_smsremotesource.sys_track  from sms_smsremotesource  inner join  on .datasourcetemp_id = sms_smsremotesource.datasourcetemp_id
						
						";
						$_SESSION["sms_systemlock_SearchSQL"]="
						
						select sms_systemlock.systemlock_id , .status_id , .status_name , sms_systemlock.created_by , sms_systemlock.date_created , sms_systemlock.changed_by , sms_systemlock.date_changed , sms_systemlock.voided , sms_systemlock.voided_by , sms_systemlock.date_voided , sms_systemlock.uuid , sms_systemlock.sys_track  from sms_systemlock  inner join  on .status_id = sms_systemlock.status_id
						
						";
						$_SESSION["sms_systemmode_SearchSQL"]="
						
						select sms_systemmode.systemmode_id , sms_systemmode.current_mode , sms_systemmode.created_by , sms_systemmode.date_created , sms_systemmode.changed_by , sms_systemmode.date_changed , sms_systemmode.voided , sms_systemmode.voided_by , sms_systemmode.date_voided , sms_systemmode.uuid , sms_systemmode.sys_track  from sms_systemmode
						
						";
						$_SESSION["sms_taskperiod_SearchSQL"]="
						
						select sms_taskperiod.taskperiod_id , sms_taskperiod.taskperiod_name , sms_taskperiod.created_by , sms_taskperiod.date_created , sms_taskperiod.changed_by , sms_taskperiod.date_changed , sms_taskperiod.voided , sms_taskperiod.voided_by , sms_taskperiod.date_voided , sms_taskperiod.uuid , sms_taskperiod.sys_track  from sms_taskperiod
						
						";
						$_SESSION["sms_taskschedule_SearchSQL"]="
						
						select sms_taskschedule.taskschedule_id , sms_taskschedule.taskschedule_name , sms_taskschedule.task_run_at , .taskstatus_id , .taskstatus_name , sms_taskschedule.created_by , sms_taskschedule.date_created , sms_taskschedule.changed_by , sms_taskschedule.date_changed , sms_taskschedule.voided , sms_taskschedule.voided_by , sms_taskschedule.date_voided , sms_taskschedule.uuid , sms_taskschedule.sys_track  from sms_taskschedule  inner join  on .taskstatus_id = sms_taskschedule.taskstatus_id
						
						";
						$_SESSION["sms_taskstatus_SearchSQL"]="
						
						select sms_taskstatus.taskstatus_id , sms_taskstatus.taskstatus_name , sms_taskstatus.created_by , sms_taskstatus.date_created , sms_taskstatus.changed_by , sms_taskstatus.date_changed , sms_taskstatus.voided , sms_taskstatus.voided_by , sms_taskstatus.date_voided , sms_taskstatus.uuid , sms_taskstatus.sys_track  from sms_taskstatus
						
						";
						$_SESSION["sms_uploadtogroup_SearchSQL"]="
						
						select sms_uploadtogroup.uploadtogroup_id , sms_smsgroup.smsgroup_id , sms_smsgroup.smsgroup_name , sms_uploadtogroup.description , sms_uploadtogroup.file_brouwse , sms_uploadtogroup.created_by , sms_uploadtogroup.date_created , sms_uploadtogroup.changed_by , sms_uploadtogroup.date_changed , sms_uploadtogroup.voided , sms_uploadtogroup.voided_by , sms_uploadtogroup.date_voided , sms_uploadtogroup.uuid , sms_uploadtogroup.sys_track  from sms_uploadtogroup  inner join sms_smsgroup on sms_smsgroup.smsgroup_id = sms_uploadtogroup.smsgroup_id
						
						";
						$_SESSION["sms_yearfilter_SearchSQL"]="
						
						select sms_yearfilter.yearfilter_id , sms_yearfilter.yearfilter_name , sms_yearfilter.created_by , sms_yearfilter.date_created , sms_yearfilter.changed_by , sms_yearfilter.date_changed , sms_yearfilter.voided , sms_yearfilter.voided_by , sms_yearfilter.date_voided , sms_yearfilter.uuid , sms_yearfilter.sys_track  from sms_yearfilter
						
						";?>