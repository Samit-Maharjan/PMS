SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET TIME_ZONE = "+00:00";

CREATE TABLE IF NOT EXISTS `admin` ( 
`admin_id` tinyint(5) NOT NULL AUTO_INCREMENT,
`username` varchar(20) NOT NULL,
`password` varchar(10) NOT NULL,
PRIMARY KEY(`admin_id`)
)ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 2;

CREATE TABLE IF NOT EXISTS `doctor` (
 `phy_id` tinyint(5) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(10) NOT NULL,
 `last_name` varchar(10) NOT NULL,
 `speciality` varchar(20) NOT NULL,
 PRIMARY KEY (`phy_id`)
)ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 2;

CREATE TABLE IF NOT EXISTS `patient` (
 `patient_id` tinyint(5) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(10) NOT NULL,
 `last_name` varchar(10) NOT NULL,
 `gender` varchar(1) NOT NULL,
 `address` varchar(20) NOT NULL,
 `phone_no` int(10) NOT NULL,
 `doctor_id` tinyint(5) NOT NULL,
 PRIMARY KEY (`patient_id`),
 KEY `doctors`(`doctor_id`)
)ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 2;

CREATE TABLE IF NOT EXISTS `drug` (
 `drug_id` tinyint(5) NOT NULL AUTO_INCREMENT,
 `drug_name` varchar(20) NOT NULL,
 `manufacturer` varchar(20) NOT NULL,
 `expiry_age` tinyint(5) NOT NULL,
 PRIMARY KEY (`drug_id`)
)ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 2;

CREATE TABLE IF NOT EXISTS `pharmacy1` (
 `phar_id` tinyint(5) NOT NULL AUTO_INCREMENT,
 `phar_name` varchar(20) NOT NULL,
 `phone_no` int(10) NOT NULL,
 `address` varchar(20) NOT NULL,
 PRIMARY KEY (`phar_id`)
)ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 2;

CREATE TABLE IF NOT EXISTS `employee` (
 `emp_id` tinyint(5) NOT NULL AUTO_INCREMENT,
 `efirst_name` varchar(20) NOT NULL,
 `elast_name` varchar(20) NOT NULL,
 `ephone_no` int(10) NOT NULL,
 `pharm_id` tinyint(5) NOT NULL,
 PRIMARY KEY (`emp_id`),
 KEY `pharm` (`pharm_id`)	
)ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 2;

CREATE TABLE IF NOT EXISTS `presc` (
	`patient_pre_id` tinyint(5) NOT NULL,
	`drug_pre_id` tinyint(5) NOT NULL,
	`doctor_pre_id` tinyint(5) NOT NULL, 
	`date` date NOT NULL,
	`quantity` int(10) NOT NULL,
	KEY `patientpre` (`patient_pre_id`),
	KEY `drugpre` (`drug_pre_id`),
	KEY `doctorpre` (`doctor_pre_id`)
)ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 2;

INSERT INTO `admin` VALUES(1,'admin','root');
INSERT INTO `doctor` VALUES(1,'Aa','Bb','Surgeon');
INSERT INTO `patient` VALUES(1,'aA','bB','M','Texas',1234567890,1);
INSERT INTO `employee` VALUES(1,'Employee','one',1234567890,1);
INSERT INTO `drug` VALUES(1,'Penicilin','ABC',10);
INSERT INTO `pharmacy1` VALUES(1,'XYZ',1234569420,'Antartica');
INSERT INTO `presc` VALUES(1,1,1,curdate(),10);

ALTER TABLE `patient`
 ADD CONSTRAINT `doctors` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`phy_id`)
 ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `employee` 
 ADD CONSTRAINT `harm` FOREIGN KEY (`pharm_id`) REFERENCES `pharmacy1` (`phar_id`)
 ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `presc`
 ADD CONSTRAINT `patientpre` FOREIGN KEY (`patient_pre_id`) REFERENCES `patient` (`patient_id`)
 ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `drugpre` FOREIGN KEY (`drug_pre_id`) REFERENCES `drug` (`drug_id`)
 ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `doctorpre` FOREIGN KEY (`doctor_pre_id`) REFERENCES 	`doctor` (`phy_id`)
 ON DELETE CASCADE ON UPDATE CASCADE;