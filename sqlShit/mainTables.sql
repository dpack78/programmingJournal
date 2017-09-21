CREATE TABLE `entry`(
	`entryID` int(11) NOT NULL AUTO_INCREMENT,
	`date` datetime, 
	`pageName` varchar(256) DEFAULT NULL,
	`currentLineNumber` varchar(256) DEFAULT NULL,
	`brainDump` text DEFAULT NULL,
	`accomplished` text DEFAULT NULL,
	`tomorrowsGoals` text DEFAULT NULL,
	PRIMARY KEY (`entryID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `goal`(
	`goalID` int(11) NOT NULL AUTO_INCREMENT,
	`goalName` varchar(64) NOT NULL,
	`questionName` varchar(64) NOT NULL,
	`a_name` varchar(64) NOT NULL,
	`b_name` varchar(64) NOT NULL,
	`f_name` varchar(64) NOT NULL,
	`isActive` tinyint(1) DEFAULT 1,
	PRIMARY KEY (`goalID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `goal` (goalName,questionName,a_name,b_name,f_name) VALUES 
('How the day went','Rate Today:','I am proud of today','Average','Not Good'),
('Accomplished Yesterdays Goals',"Rate your accomplishment of yesterday's goals:",'Got em done man!',"Didn't get them done...","Didn't set goals yesterday"),
('Work on time','I showed up to work today when I planned yesterday','Yes','No',"Didn't make a plan yesterday...");

CREATE TABLE `entry_goal_link`(
	`entry_goal_linkID` int(11) NOT NULL AUTO_INCREMENT,
	`entryID` int(11) NOT NULL,
	`goalID` int(11) NOT NULL,
	`goal_responseID` int(11) NOT NULL,
	PRIMARY KEY (`entry_goal_linkID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `goal_response` (
	`goal_responseID` int(11) NOT NULL AUTO_INCREMENT,
	`goal_responseName` varchar(16) NOT NULL,
	PRIMARY KEY (`goal_responseID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO goal_response (goal_responseName) VALUES ("A"),("B"),("F");

