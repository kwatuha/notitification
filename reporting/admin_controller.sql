/*
Navicat MySQL Data Transfer

Source Server         : devConn
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : ampathdb

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2011-11-01 19:04:15
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin_controller`
-- ----------------------------
DROP TABLE IF EXISTS `admin_controller`;
CREATE TABLE `admin_controller` (
  `controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` varchar(50) DEFAULT NULL,
  `groupfolder` varchar(50) DEFAULT NULL,
  `displaygroup` varchar(50) DEFAULT NULL,
  `displaysubgroup` varchar(50) DEFAULT NULL,
  `showgroup` varchar(50) DEFAULT NULL,
  `showgroupposition` int(11) DEFAULT NULL,
  `defaultgrouptable` varchar(50) DEFAULT NULL,
  `tablecaption` varchar(50) DEFAULT NULL,
  `fieldname` varchar(100) DEFAULT NULL,
  `fieldcaption` varchar(100) DEFAULT NULL,
  `detailsvisiblepdf` varchar(100) DEFAULT NULL,
  `pdfvisible` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `colnwidth` int(11) DEFAULT NULL,
  PRIMARY KEY (`controller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1640 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin_controller
-- ----------------------------
INSERT INTO `admin_controller` VALUES ('1414', 'admin_autofill', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Autofill ', 'autofill_id', 'Autofill Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1415', 'admin_autofill', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Autofill ', 'tablename', 'Tablename ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1416', 'admin_autofill', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Autofill ', 'tablefield', 'Tablefield ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1417', 'admin_autofill', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Autofill ', 'prefix', 'Prefix ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1418', 'admin_autofill', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Autofill ', 'digit_number', 'Digit Number ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1419', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Controller ', 'controller_id', 'Controller Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1420', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Controller ', 'tablename', 'Tablename ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1421', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Controller ', 'groupfolder', 'Groupfolder ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1422', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Controller ', 'displaygroup', 'Displaygroup ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1423', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Controller ', 'displaysubgroup', 'Displaysubgroup ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1424', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Controller ', 'showgroup', 'Showgroup ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1425', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin Controller ', 'showgroupposition', 'Showgroupposition ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1426', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '7', 'admin_autofill', 'Admin Controller ', 'defaultgrouptable', 'Defaultgrouptable ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1427', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '8', 'admin_autofill', 'Admin Controller ', 'tablecaption', 'Tablecaption ', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1428', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '9', 'admin_autofill', 'Admin Controller ', 'fieldname', 'Fieldname ', 'Show', 'Show', '9', '20');
INSERT INTO `admin_controller` VALUES ('1429', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '10', 'admin_autofill', 'Admin Controller ', 'fieldcaption', 'Fieldcaption ', 'Show', 'Show', '10', '20');
INSERT INTO `admin_controller` VALUES ('1430', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '11', 'admin_autofill', 'Admin Controller ', 'detailsvisiblepdf', 'Detailsvisiblepdf ', 'Show', 'Show', '11', '20');
INSERT INTO `admin_controller` VALUES ('1431', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '12', 'admin_autofill', 'Admin Controller ', 'pdfvisible', 'Pdfvisible ', 'Show', 'Show', '12', '20');
INSERT INTO `admin_controller` VALUES ('1432', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '13', 'admin_autofill', 'Admin Controller ', 'position', 'Position ', 'Show', 'Show', '13', '20');
INSERT INTO `admin_controller` VALUES ('1433', 'admin_controller', 'admin', 'Admin', 'Admin', 'Show', '14', 'admin_autofill', 'Admin Controller ', 'colnwidth', 'Colnwidth ', 'Show', 'Show', '14', '20');
INSERT INTO `admin_controller` VALUES ('1434', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Emprole ', 'emprole_id', 'Emprole Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1435', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Emprole ', 'role_name', 'Role Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1436', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Emprole ', 'employee_name', 'Employee Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1437', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Emprole ', 'user_status', 'User Status ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1438', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Emprole ', 'dept_name', 'Dept Id ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1439', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Emprole ', 'previlege', 'Previlege ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1440', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin Emprole ', 'resource', 'Resource ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1441', 'admin_emprole', 'admin', 'Admin', 'Admin', 'Show', '7', 'admin_autofill', 'Admin Emprole ', 'effective_date', 'Effective Date ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1442', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Old ', 'controller_id', 'Controller Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1443', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Old ', 'tablename', 'Tablename ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1444', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Old ', 'groupfolder', 'Groupfolder ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1445', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Old ', 'displaygroup', 'Displaygroup ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1446', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Old ', 'displaysubgroup', 'Displaysubgroup ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1447', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Old ', 'showgroup', 'Showgroup ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1448', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin Old ', 'showgroupposition', 'Showgroupposition ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1449', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '7', 'admin_autofill', 'Admin Old ', 'defaultgrouptable', 'Defaultgrouptable ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1450', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '8', 'admin_autofill', 'Admin Old ', 'tablecaption', 'Tablecaption ', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1451', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '9', 'admin_autofill', 'Admin Old ', 'fieldname', 'Fieldname ', 'Show', 'Show', '9', '20');
INSERT INTO `admin_controller` VALUES ('1452', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '10', 'admin_autofill', 'Admin Old ', 'fieldcaption', 'Fieldcaption ', 'Show', 'Show', '10', '20');
INSERT INTO `admin_controller` VALUES ('1453', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '11', 'admin_autofill', 'Admin Old ', 'detailsvisiblepdf', 'Detailsvisiblepdf ', 'Show', 'Show', '11', '20');
INSERT INTO `admin_controller` VALUES ('1454', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '12', 'admin_autofill', 'Admin Old ', 'pdfvisible', 'Pdfvisible ', 'Show', 'Show', '12', '20');
INSERT INTO `admin_controller` VALUES ('1455', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '13', 'admin_autofill', 'Admin Old ', 'position', 'Position ', 'Show', 'Show', '13', '20');
INSERT INTO `admin_controller` VALUES ('1456', 'admin_old', 'admin', 'Admin', 'Admin', 'Show', '14', 'admin_autofill', 'Admin Old ', 'colnwidth', 'Colnwidth ', 'Show', 'Show', '14', '20');
INSERT INTO `admin_controller` VALUES ('1457', 'admin_role', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Role ', 'role_id', 'Role Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1458', 'admin_role', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Role ', 'role_name', 'Role Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1459', 'admin_role', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Role ', 'user_status', 'User Status ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1460', 'admin_role', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Role ', 'dept_name', 'Dept Id ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1461', 'admin_role', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Role ', 'previlege', 'Previlege ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1462', 'admin_role', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Role ', 'resource', 'Resource ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1463', 'admin_role', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin Role ', 'effective_date', 'Effective Date ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1464', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Statement ', 'statement_id', 'Statement Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1465', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Statement ', 'tablename', 'Tablename ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1466', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Statement ', 'statement_caption', 'Statement Caption ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1467', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Statement ', 'statement_link', 'Statement Link ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1468', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Statement ', 'show_identifier', 'Show Identifier ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1469', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Statement ', 'first_only', 'First Only ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1470', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin Statement ', 'pdfvisible', 'Pdfvisible ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1471', 'admin_statement', 'admin', 'Admin', 'Admin', 'Show', '7', 'admin_autofill', 'Admin Statement ', 'position', 'Position ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1472', 'admin_status', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Status ', 'statustypestatus_id', 'Statustypestatus Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1473', 'admin_status', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Status ', 'statustype_name', 'Statustype Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1474', 'admin_status', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Status ', 'statustypestatus_name', 'Statustypestatus Name ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1475', 'admin_status', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Status ', 'caption', 'Caption ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1476', 'admin_status', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Status ', 'position', 'Position ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1477', 'admin_statustype', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Statustype ', 'statustype_id', 'Statustype Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1478', 'admin_statustype', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Statustype ', 'statustype_name', 'Statustype Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1479', 'admin_statustype', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Statustype ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1480', 'admin_supervisor', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Supervisor ', 'supervisor_id', 'Supervisor Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1481', 'admin_supervisor', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Supervisor ', 'company_name', 'Company Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1482', 'admin_supervisor', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Supervisor ', 'dept_name', 'Dept Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1483', 'admin_supervisor', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Supervisor ', 'employee_name', 'Employee Id ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1484', 'admin_supervisor', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Supervisor ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1485', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin User ', 'id', 'Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1486', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin User ', 'employee_name', 'Employee Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1487', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin User ', 'user_name', 'User Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1488', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin User ', 'user_password', 'User Password ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1489', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin User ', 'Name', 'Name ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1490', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin User ', 'user_priviledge', 'User Priviledge ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1491', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin User ', 'security_question', 'Security Question ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1492', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '7', 'admin_autofill', 'Admin User ', 'security_q_answer', 'Security Q Answer ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1493', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '8', 'admin_autofill', 'Admin User ', 'user_active_status', 'User Active Status ', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1494', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '9', 'admin_autofill', 'Admin User ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '9', '20');
INSERT INTO `admin_controller` VALUES ('1495', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Useremp ', 'useremp_id', 'Useremp Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1496', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Useremp ', 'usergroup_name', 'Usergroup Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1497', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Useremp ', 'user_name', 'User Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1498', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Useremp ', 'tablename', 'Tablename ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1499', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Useremp ', 'previlege', 'Previlege ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1500', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Useremp ', 'start_date', 'Start Date ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1501', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin Useremp ', 'end_date', 'End Date ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1502', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '7', 'admin_autofill', 'Admin Useremp ', 'savedby', 'Savedby ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1503', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '8', 'admin_autofill', 'Admin Useremp ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1504', 'admin_usergroup', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Usergroup ', 'usergroup_id', 'Usergroup Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1505', 'admin_usergroup', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Usergroup ', 'usergroup_name', 'Usergroup Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1506', 'admin_usergroup', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Usergroup ', 'userg_description', 'Userg Description ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1507', 'admin_usergrouprole', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Usergrouprole ', 'usergrouprole_id', 'Usergrouprole Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1508', 'admin_usergrouprole', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Usergrouprole ', 'usergroup_name', 'Usergroup Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1509', 'admin_usergrouprole', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Usergrouprole ', 'tablename', 'Tablename ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1510', 'admin_usergrouprole', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Usergrouprole ', 'previge', 'Previge ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1511', 'admin_usergrouprole', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Usergrouprole ', 'start_date', 'Start Date ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1512', 'admin_usergrouprole', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Usergrouprole ', 'end_date', 'End Date ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1513', 'admin_usergrouprole', 'admin', 'Admin', 'Admin', 'Show', '6', 'admin_autofill', 'Admin Usergrouprole ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1514', 'attendance_attendance', 'attendance', 'Attendance', 'Attendance', 'Show', '0', 'attendance_attendance', 'Attendance Attendance ', 'attendance_id', 'Attendance Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1515', 'attendance_attendance', 'attendance', 'Attendance', 'Attendance', 'Show', '1', 'attendance_attendance', 'Attendance Attendance ', 'employee_name', 'Employee Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1516', 'attendance_attendance', 'attendance', 'Attendance', 'Attendance', 'Show', '2', 'attendance_attendance', 'Attendance Attendance ', 'time_in', 'Time In ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1517', 'attendance_attendance', 'attendance', 'Attendance', 'Attendance', 'Show', '3', 'attendance_attendance', 'Attendance Attendance ', 'time_out', 'Time Out ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1518', 'attendance_attendance', 'attendance', 'Attendance', 'Attendance', 'Show', '4', 'attendance_attendance', 'Attendance Attendance ', 'effective_date', 'Effective Date ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1519', 'attendance_event', 'attendance', 'Attendance', 'Attendance', 'Show', '0', 'attendance_attendance', 'Attendance Event ', 'event_id', 'Event Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1520', 'attendance_event', 'attendance', 'Attendance', 'Attendance', 'Show', '1', 'attendance_attendance', 'Attendance Event ', 'event_name', 'Event Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1521', 'attendance_event', 'attendance', 'Attendance', 'Attendance', 'Show', '2', 'attendance_attendance', 'Attendance Event ', 'event_date', 'Event Date ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1522', 'attendance_event', 'attendance', 'Attendance', 'Attendance', 'Show', '3', 'attendance_attendance', 'Attendance Event ', 'in_out', 'In Out ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1523', 'attendance_event', 'attendance', 'Attendance', 'Attendance', 'Show', '4', 'attendance_attendance', 'Attendance Event ', 'effective_date', 'Effective Date ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1524', 'attendance_holiday', 'attendance', 'Attendance', 'Attendance', 'Show', '0', 'attendance_attendance', 'Attendance Holiday ', 'holiday_id', 'Holiday Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1525', 'attendance_holiday', 'attendance', 'Attendance', 'Attendance', 'Show', '1', 'attendance_attendance', 'Attendance Holiday ', 'holiday_name', 'Holiday Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1526', 'attendance_holiday', 'attendance', 'Attendance', 'Attendance', 'Show', '2', 'attendance_attendance', 'Attendance Holiday ', 'effective_date', 'Effective Date ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1527', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '0', 'comp_assign', 'Comp Assign ', 'assign_id', 'Assign Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1528', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '1', 'comp_assign', 'Comp Assign ', 'employee_name', 'Employee Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1529', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '2', 'comp_assign', 'Comp Assign ', 'assign_name', 'Assign Name ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1530', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '3', 'comp_assign', 'Comp Assign ', 'computer_model', 'Computer Model ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1531', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '4', 'comp_assign', 'Comp Assign ', 'date_manufactured', 'Date Manufactured ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1532', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '5', 'comp_assign', 'Comp Assign ', 'date_assigned', 'Date Assigned ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1533', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '6', 'comp_assign', 'Comp Assign ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1534', 'comp_comp', 'comp', 'Comp', 'Comp', 'Show', '0', 'comp_assign', 'Comp Comp ', 'comp_id', 'Comp Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1535', 'comp_comp', 'comp', 'Comp', 'Comp', 'Show', '1', 'comp_assign', 'Comp Comp ', 'comp_name', 'Comp Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1536', 'comp_comp', 'comp', 'Comp', 'Comp', 'Show', '2', 'comp_assign', 'Comp Comp ', 'Model', 'Model ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1537', 'comp_comp', 'comp', 'Comp', 'Comp', 'Show', '3', 'comp_assign', 'Comp Comp ', 'Manufacturer', 'Manufacturer ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1538', 'comp_comp', 'comp', 'Comp', 'Comp', 'Show', '4', 'comp_assign', 'Comp Comp ', 'date_manufactured', 'Date Manufactured ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1539', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '0', 'comp_assign', 'Comp Details ', 'details_id', 'Details Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1540', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '1', 'comp_assign', 'Comp Details ', 'details_name', 'Details Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1541', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '2', 'comp_assign', 'Comp Details ', 'fname', 'Fname ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1542', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '3', 'comp_assign', 'Comp Details ', 'lname', 'Lname ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1543', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '4', 'comp_assign', 'Comp Details ', 'mname', 'Mname ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1544', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '5', 'comp_assign', 'Comp Details ', 'dob', 'Dob ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1545', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '6', 'comp_assign', 'Comp Details ', 'pno', 'Pno ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1546', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '7', 'comp_assign', 'Comp Details ', 'photo', 'Photo ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1547', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '8', 'comp_assign', 'Comp Details ', 'licenseno', 'Licenseno ', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1548', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '9', 'comp_assign', 'Comp Details ', 'status', 'Status ', 'Show', 'Show', '9', '20');
INSERT INTO `admin_controller` VALUES ('1549', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '10', 'comp_assign', 'Comp Details ', 'qrimage', 'Qrimage ', 'Show', 'Show', '10', '20');
INSERT INTO `admin_controller` VALUES ('1550', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '11', 'comp_assign', 'Comp Details ', 'address', 'Address ', 'Show', 'Show', '11', '20');
INSERT INTO `admin_controller` VALUES ('1551', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '12', 'comp_assign', 'Comp Details ', 'email', 'Email ', 'Show', 'Show', '12', '20');
INSERT INTO `admin_controller` VALUES ('1552', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '13', 'comp_assign', 'Comp Details ', 'telephone', 'Telephone ', 'Show', 'Show', '13', '20');
INSERT INTO `admin_controller` VALUES ('1553', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '14', 'comp_assign', 'Comp Details ', 'savedby', 'Savedby ', 'Show', 'Show', '14', '20');
INSERT INTO `admin_controller` VALUES ('1554', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '15', 'comp_assign', 'Comp Details ', 'transdate', 'Transdate ', 'Show', 'Show', '15', '20');
INSERT INTO `admin_controller` VALUES ('1555', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '16', 'comp_assign', 'Comp Details ', 'sex', 'Sex ', 'Show', 'Show', '16', '20');
INSERT INTO `admin_controller` VALUES ('1556', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '17', 'comp_assign', 'Comp Details ', 'doi', 'Doi ', 'Show', 'Show', '17', '20');
INSERT INTO `admin_controller` VALUES ('1557', 'comp_details', 'comp', 'Comp', 'Comp', 'Show', '18', 'comp_assign', 'Comp Details ', 'poi', 'Poi ', 'Show', 'Show', '18', '20');
INSERT INTO `admin_controller` VALUES ('1558', 'comp_plog', 'comp', 'Comp', 'Comp', 'Show', '0', 'comp_assign', 'Comp Plog ', 'plog_id', 'Plog Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1559', 'comp_plog', 'comp', 'Comp', 'Comp', 'Show', '1', 'comp_assign', 'Comp Plog ', 'assign_name', 'Assign Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1560', 'comp_plog', 'comp', 'Comp', 'Comp', 'Show', '2', 'comp_assign', 'Comp Plog ', 'employee_name', 'Employee Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1561', 'comp_plog', 'comp', 'Comp', 'Comp', 'Show', '3', 'comp_assign', 'Comp Plog ', 'time_in', 'Time In ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1562', 'comp_plog', 'comp', 'Comp', 'Comp', 'Show', '4', 'comp_assign', 'Comp Plog ', 'time_out', 'Time Out ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1563', 'comp_plog', 'comp', 'Comp', 'Comp', 'Show', '5', 'comp_assign', 'Comp Plog ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1564', 'leave_leave', 'leave', 'Leave', 'Leave', 'Show', '0', 'leave_leave', 'Leave Leave ', 'leave_id', 'Leave Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1565', 'leave_leave', 'leave', 'Leave', 'Leave', 'Show', '1', 'leave_leave', 'Leave Leave ', 'leave_name', 'Leave Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1566', 'leave_leave', 'leave', 'Leave', 'Leave', 'Show', '2', 'leave_leave', 'Leave Leave ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1567', 'leave_quota', 'leave', 'Leave', 'Leave', 'Show', '0', 'leave_leave', 'Leave Quota ', 'lquota_id', 'Lquota Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1568', 'leave_quota', 'leave', 'Leave', 'Leave', 'Show', '1', 'leave_leave', 'Leave Quota ', 'employee_name', 'Employee Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1569', 'leave_quota', 'leave', 'Leave', 'Leave', 'Show', '2', 'leave_leave', 'Leave Quota ', 'leave_name', 'Leave Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1570', 'leave_quota', 'leave', 'Leave', 'Leave', 'Show', '3', 'leave_leave', 'Leave Quota ', 'leave_period', 'Leave Period ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1571', 'leave_quota', 'leave', 'Leave', 'Leave', 'Show', '4', 'leave_leave', 'Leave Quota ', 'entitlement', 'Entitlement ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1572', 'leave_quota', 'leave', 'Leave', 'Leave', 'Show', '5', 'leave_leave', 'Leave Quota ', 'effective_date', 'Effective Date ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1573', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '0', 'leave_leave', '', 'request_id', 'Request Id ', 'Do Not Show', 'Do Not Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1574', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '1', 'leave_leave', '', 'approval_status', 'Approval Status ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1575', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '2', 'leave_leave', '', 'status', 'Request Type ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1576', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '3', 'leave_leave', '', 'employee_name', 'Employee Name', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1577', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '4', 'leave_leave', '', 'leave_name', 'Leave Type', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1578', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '5', 'leave_leave', '', 'date_requested', 'Date Requested ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1579', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '6', 'leave_leave', '', 'requested_duration', 'Leave Duration ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1580', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '7', 'leave_leave', '', 'approved_duration', 'Approved Duration ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1581', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '8', 'leave_leave', '', 'approval_date', 'Date  Approved', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1582', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '9', 'leave_leave', '', 'leave_started', 'Started Leave On', 'Show', 'Show', '9', '20');
INSERT INTO `admin_controller` VALUES ('1583', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '10', 'leave_leave', '', 'leave_ended', 'Returned from Leave', 'Show', 'Show', '10', '20');
INSERT INTO `admin_controller` VALUES ('1584', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '11', 'leave_leave', '', 'approved_by', 'Approved By ', 'Show', 'Show', '11', '20');
INSERT INTO `admin_controller` VALUES ('1585', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '12', 'leave_leave', '', 'comments', 'Comments ', 'Show', 'Show', '12', '20');
INSERT INTO `admin_controller` VALUES ('1586', 'pim_dept', 'pim', 'Pim', 'Pim', 'Show', '0', 'pim_dept', 'Pim Dept ', 'dept_id', 'Dept Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1587', 'pim_dept', 'pim', 'Pim', 'Pim', 'Show', '1', 'pim_dept', 'Pim Dept ', 'location_name', 'Location Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1588', 'pim_dept', 'pim', 'Pim', 'Pim', 'Show', '2', 'pim_dept', 'Pim Dept ', 'dept_name', 'Dept Name ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1589', 'pim_dept', 'pim', 'Pim', 'Pim', 'Show', '3', 'pim_dept', 'Pim Dept ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1590', 'pim_empdept', 'pim', 'Pim', 'Pim', 'Show', '0', 'pim_dept', 'Pim Empdept ', 'empdept_id', 'Empdept Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1591', 'pim_empdept', 'pim', 'Pim', 'Pim', 'Show', '1', 'pim_dept', 'Pim Empdept ', 'employee_name', 'Employee Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1592', 'pim_empdept', 'pim', 'Pim', 'Pim', 'Show', '2', 'pim_dept', 'Pim Empdept ', 'dept_name', 'Dept Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1593', 'pim_empdept', 'pim', 'Pim', 'Pim', 'Show', '3', 'pim_dept', 'Pim Empdept ', 'date_joined', 'Date Joined ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1594', 'pim_empdept', 'pim', 'Pim', 'Pim', 'Show', '4', 'pim_dept', 'Pim Empdept ', 'effective_date', 'Effective Date ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1595', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '0', 'pim_dept', '', 'employee_id', 'Employee Id ', 'Do Not Show', 'Do Not Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1596', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '1', 'pim_dept', '', 'employee_name', 'Employee Name ', 'Show', 'Show', '1', '30');
INSERT INTO `admin_controller` VALUES ('1597', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '2', 'pim_dept', '', 'DOB', 'DOB ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1598', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '3', 'pim_dept', '', 'national_ID', 'National ID ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1599', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '4', 'pim_dept', '', 'gender', 'Gender ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1600', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '5', 'pim_dept', '', 'address', 'Address ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1601', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '6', 'pim_dept', '', 'phone_number', 'Phone Number ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1602', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '7', 'pim_dept', '', 'town', 'Town ', 'Show', 'Show', '7', '20');
INSERT INTO `admin_controller` VALUES ('1603', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '8', 'pim_dept', '', 'email_address', 'Email Address ', 'Show', 'Show', '8', '40');
INSERT INTO `admin_controller` VALUES ('1604', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '9', 'pim_dept', '', 'postal_code', 'Postal Code ', 'Show', 'Show', '9', '20');
INSERT INTO `admin_controller` VALUES ('1605', 'pim_employee', 'pim', 'Pim', 'Pim', 'Show', '10', 'pim_dept', '', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '10', '20');
INSERT INTO `admin_controller` VALUES ('1606', 'pim_hoddept', 'pim', 'Pim', 'Pim', 'Show', '0', 'pim_dept', 'Pim Hoddept ', 'hoddept_id', 'Hoddept Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1607', 'pim_hoddept', 'pim', 'Pim', 'Pim', 'Show', '1', 'pim_dept', 'Pim Hoddept ', 'dept_name', 'Dept Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1608', 'pim_hoddept', 'pim', 'Pim', 'Pim', 'Show', '2', 'pim_dept', 'Pim Hoddept ', 'supervisor_name', 'Supervisor Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1609', 'pim_hoddept', 'pim', 'Pim', 'Pim', 'Show', '3', 'pim_dept', 'Pim Hoddept ', 'start_date', 'Start Date ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1610', 'pim_hoddept', 'pim', 'Pim', 'Pim', 'Show', '4', 'pim_dept', 'Pim Hoddept ', 'end_date', 'End Date ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1611', 'pim_hoddept', 'pim', 'Pim', 'Pim', 'Show', '5', 'pim_dept', 'Pim Hoddept ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1612', 'pim_location', 'pim', 'Pim', 'Pim', 'Show', '0', 'pim_dept', 'Pim Location ', 'location_id', 'Location Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1613', 'pim_location', 'pim', 'Pim', 'Pim', 'Show', '1', 'pim_dept', 'Pim Location ', 'location_name', 'Location Name ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1614', 'pim_location', 'pim', 'Pim', 'Pim', 'Show', '2', 'pim_dept', 'Pim Location ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1615', 'pim_supervisor', 'pim', 'Pim', 'Pim', 'Show', '0', 'pim_dept', 'Pim Supervisor ', 'supervisor_id', 'Supervisor Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1616', 'pim_supervisor', 'pim', 'Pim', 'Pim', 'Show', '1', 'pim_dept', 'Pim Supervisor ', 'employee_name', 'Employee Id ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1617', 'pim_supervisor', 'pim', 'Pim', 'Pim', 'Show', '2', 'pim_dept', 'Pim Supervisor ', 'dept_name', 'Dept Id ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1618', 'pim_supervisor', 'pim', 'Pim', 'Pim', 'Show', '3', 'pim_dept', 'Pim Supervisor ', 'effective_dt', 'Effective Dt ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1619', 'admin_user', 'admin', 'Admin', 'Admin', 'Show', '8', 'admin_autofill', 'Admin User ', 'usergroup_name', 'Usergroup Id ', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1620', 'admin_tablerole', 'admin', 'Admin', 'Admin', 'Show', '0', 'admin_autofill', 'Admin Tablerole ', 'tablerole_id', 'Tablerole Id ', 'Show', 'Show', '0', '20');
INSERT INTO `admin_controller` VALUES ('1621', 'admin_tablerole', 'admin', 'Admin', 'Admin', 'Show', '1', 'admin_autofill', 'Admin Tablerole ', 'tablename', 'Tablename ', 'Show', 'Show', '1', '20');
INSERT INTO `admin_controller` VALUES ('1622', 'admin_tablerole', 'admin', 'Admin', 'Admin', 'Show', '2', 'admin_autofill', 'Admin Tablerole ', 'tablefield', 'Tablefield ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1623', 'admin_tablerole', 'admin', 'Admin', 'Admin', 'Show', '3', 'admin_autofill', 'Admin Tablerole ', 'ess_caption', 'Ess Caption ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1624', 'admin_tablerole', 'admin', 'Admin', 'Admin', 'Show', '4', 'admin_autofill', 'Admin Tablerole ', 'ess_view', 'Ess View ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1625', 'admin_tablerole', 'admin', 'Admin', 'Admin', 'Show', '5', 'admin_autofill', 'Admin Tablerole ', 'ess_position', 'Ess Position ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1626', 'admin_useremp', 'admin', 'Admin', 'Admin', 'Show', '8', 'admin_autofill', 'Admin Useremp ', 'comment', 'Comment ', 'Show', 'Show', '8', '20');
INSERT INTO `admin_controller` VALUES ('1627', 'attendance_attendance', 'attendance', 'Attendance', 'Attendance', 'Show', '4', 'attendance_attendance', 'Attendance Attendance ', 'comment', 'Comment ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1628', 'attendance_event', 'attendance', 'Attendance', 'Attendance', 'Show', '3', 'attendance_attendance', 'Attendance Event ', 'venue', 'Venue ', 'Show', 'Show', '3', '20');
INSERT INTO `admin_controller` VALUES ('1629', 'attendance_event', 'attendance', 'Attendance', 'Attendance', 'Show', '4', 'attendance_attendance', 'Attendance Event ', 'comment', 'Comment ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1630', 'attendance_holiday', 'attendance', 'Attendance', 'Attendance', 'Show', '2', 'attendance_attendance', 'Attendance Holiday ', 'comment', 'Comment ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1631', 'comp_assign', 'comp', 'Comp', 'Comp', 'Show', '6', 'comp_assign', 'Comp Assign ', 'comment', 'Comment ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1632', 'comp_comp', 'comp', 'Comp', 'Comp', 'Show', '4', 'comp_assign', 'Comp Comp ', 'comment', 'Comment ', 'Show', 'Show', '4', '20');
INSERT INTO `admin_controller` VALUES ('1633', 'comp_plog', 'comp', 'Comp', 'Comp', 'Show', '5', 'comp_assign', 'Comp Plog ', 'comment', 'Comment ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1634', 'leave_leave', 'leave', 'Leave', 'Leave', 'Show', '2', 'leave_leave', 'Leave Leave ', 'comment', 'Comment ', 'Show', 'Show', '2', '20');
INSERT INTO `admin_controller` VALUES ('1635', 'leave_quota', 'leave', 'Leave', 'Leave', 'Show', '5', 'leave_leave', 'Leave Quota ', 'comment', 'Comment ', 'Show', 'Show', '5', '20');
INSERT INTO `admin_controller` VALUES ('1636', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '6', 'leave_leave', '', 'request_comment', 'Request Comment ', 'Show', 'Show', '6', '20');
INSERT INTO `admin_controller` VALUES ('1637', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '12', 'leave_leave', '', 'approval_comment', 'Approval Comment ', 'Show', 'Show', '12', '20');
INSERT INTO `admin_controller` VALUES ('1638', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '13', 'leave_leave', '', 'return_date', 'Return Date ', 'Show', 'Show', '13', '20');
INSERT INTO `admin_controller` VALUES ('1639', 'leave_request', 'leave', 'Leave', 'Leave', 'Show', '14', 'leave_leave', '', 'return_comment', 'Return Comment ', 'Show', 'Show', '14', '20');
