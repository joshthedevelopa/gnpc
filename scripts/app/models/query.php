<?php

CREATE DATABASE IF NOT EXISTS servicetomato DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE servicetomato;
CREATE TABLE IF NOT EXISTS `locations`
(
  `lid` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `region` VARCHAR(30),
  `town`   VARCHAR(50)
);


INSERT INTO locations(`region`, `town`)   VALUES ('Ashanti', 'Atonsu'), ('Greater Accra', 'Nima'), ('Central', 'Abura'), ('Ashanti', 'Oduom');
CREATE TABLE IF NOT EXISTS `users`
(
  `uid` INT UNSIGNED AUTO_INCREMENT,
  `dob` DATE NOT NULL,
  `gender` CHAR(1) NOT NULL,
  `lid` INT UNSIGNED,
  `pwd` VARCHAR(255) NOT NULL,
  `contact` VARCHAR(20) NOT NULL UNIQUE,
  `fname` VARCHAR(20) NOT NULL,
  `lname` VARCHAR(20) NOT NULL,
  `status` TINYINT NOT NULL,
   INDEX(`status`),
   PRIMARY KEY (`uid`),
   FOREIGN KEY(`lid`) REFERENCES locations(`lid`)
);

CREATE TABLE IF NOT EXISTS `categories`
(
  `cid` TINYINT UNSIGNED AUTO_INCREMENT,
  `category` VARCHAR(50),
  `type` VARCHAR(50),
   PRIMARY KEY (`cid`)
);

CREATE TABLE IF NOT EXISTS `businesses`
(
  `bid` INT UNSIGNED AUTO_INCREMENT,
  `uid` INT UNSIGNED NOT NULL,
  `bName` VARCHAR(255) NOT NULL,
  `workType` VARCHAR(20) NULL,
  `payType` VARCHAR(20) NULL,
  `workStarts` TIME NULL,
  `workEnds` TIME NULL,
  `clients` TINYINT NULL,--should not be exact. eg above 10--
  `info` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NULL,
  `website` VARCHAR(100) NULL,
  FULLTEXT(`bName`,`info`),
  PRIMARY KEY (`bid`),
  FOREIGN KEY(`uid`) REFERENCES `users`(`uid`)
);

CREATE TABLE IF NOT EXISTS `teams` 
(
  `tid` INT UNSIGNED AUTO_INCREMENT,
  `cid` TINYINT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `info` VARCHAR(255)  NOT NULL,
  `minFee` INT NOT NULL,
  `maxFee` INT NOT NULL,
  `payMethod` CHAR(1) NOT NULL,
  `rating` DECIMAL(2,1) NOT NULL,
  FULLTEXT(`title`,`info`),
  FOREIGN KEY(`cid`) REFERENCES `categories`(`cid`),
  PRIMARY KEY (`tid`)
);

CREATE TABLE IF NOT EXISTS `t_members` 
(
  `mid` INT UNSIGNED AUTO_INCREMENT,
  `tid`INT UNSIGNED NOT NULL,
  `uid`INT UNSIGNED NOT NULL,
  `admin` BOOLEAN,
  PRIMARY KEY(`mid`),
  FOREIGN KEY(`tid`) REFERENCES teams(tid),
  FOREIGN KEY(`uid`) REFERENCES users(uid)
);

CREATE TABLE IF NOT EXISTS `services` 
(
  `sid` INT UNSIGNED AUTO_INCREMENT,
  `bid`INT UNSIGNED NOT NULL,
  `cid` TINYINT UNSIGNED NOT NULL,
  `profession` VARCHAR(50) NOT NULL,--explain profession. it buffles me--
  `info` VARCHAR(255) NOT NULL,
  `fee`  MEDIUMINT UNSIGNED NOT NULL,
  `negotiable` BOOLEAN NOT NULL,
  `status` TINYINT(2) NOT NULL,
   PRIMARY KEY (`sid`),
   INDEX(`fee`),
   INDEX(`status`),
   FULLTEXT(`profession`,`info`),
   FOREIGN KEY(`bid`) REFERENCES businesses(bid),
   FOREIGN KEY(`cid`) REFERENCES `categories`(`cid`)
);

CREATE TABLE IF NOT EXISTS `workdays` 
(
  `wid` INT UNSIGNED AUTO_INCREMENT,
  `sid`INT UNSIGNED NOT NULL,
  `day` TINYINT NOT NULL,
  PRIMARY KEY(`wid`),
  FOREIGN KEY(`sid`) REFERENCES services(sid)
);

CREATE TABLE IF NOT EXISTS `hot_shots` 
(
  `hid` INT UNSIGNED AUTO_INCREMENT,
  `sid`INT UNSIGNED NOT NULL,
  `expDate` DATE NOT NULL,
  INDEX(`expDate`),
  PRIMARY KEY (`hid`),
  FOREIGN KEY(`sid`) REFERENCES services(sid)
);

CREATE TABLE IF NOT EXISTS `b_contacts`(
  `cid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `bid`INT UNSIGNED NOT NULL,
  `contact` VARCHAR(20) NOT NULL,
  FOREIGN KEY(`bid`) REFERENCES businesses(bid)
);

CREATE TABLE IF NOT EXISTS `stories` 
(
  `sid` INT UNSIGNED AUTO_INCREMENT,
  `category` TINYINT,
  `uid`INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `chapters` TINYINT,
  `imgCount` TINYINT,
  FULLTEXT(`title`),
  PRIMARY KEY(`sid`),
  FOREIGN KEY(`uid`) REFERENCES users(uid),
  FOREIGN KEY(`category`) REFERENCES `categories`(`cid`)
);

CREATE TABLE IF NOT EXISTS `prefered_services` 
(
  `pid` INT UNSIGNED AUTO_INCREMENT,
  `cid` TINYINT UNSIGNED NOT NULL,
  `uid`INT UNSIGNED NOT NULL,
  PRIMARY KEY(`pid`),
  FOREIGN KEY(`uid`) REFERENCES users(uid),
  FOREIGN KEY(`cid`) REFERENCES `categories`(`cid`)
);



CREATE TABLE IF NOT EXISTS `story_ratings` 
(
  `rid` INT UNSIGNED AUTO_INCREMENT,
  `uid`INT UNSIGNED NOT NULL,
  `sid`INT UNSIGNED NOT NULL,
  `rate` TINYINT NOT NULL,
  PRIMARY KEY (`rid`),
  FOREIGN KEY(`sid`) REFERENCES stories(sid)
);

CREATE TABLE IF NOT EXISTS `flags` 
(
  `fid` INT UNSIGNED AUTO_INCREMENT,
  `flagger`INT UNSIGNED NOT NULL,
  `flagged`INT UNSIGNED NOT NULL,
  `info` VARCHAR(255) NULL,
  `flagDate` DATE NOT NULL,
  PRIMARY KEY(`fid`),
  FOREIGN KEY(`flagger`) REFERENCES users(uid),
  FOREIGN KEY(`flagged`) REFERENCES users(uid)
);

CREATE TABLE IF NOT EXISTS `jobs`
(
  `jid` INT UNSIGNED AUTO_INCREMENT,
  `uid`INT UNSIGNED NOT NULL,
  `cid` TINYINT UNSIGNED NOT NULL,
  `jobName` VARCHAR(255) NOT NULL,
  `info` VARCHAR(255) NOT NULL,
  `fee` INT NULL,
  `duration` TINYINT,
  `negotiable` BOOLEAN NOT NULL,
  `postedOn` DATE NOT NULL,
  `workType` TINYINT,
  FULLTEXT(`info`,`jobName`),
  INDEX(`fee`),
  PRIMARY KEY (`jid`),
  FOREIGN KEY(`uid`) REFERENCES users(uid),
  FOREIGN KEY(`cid`) REFERENCES `categories`(`cid`)
);

CREATE TABLE notifications 
(
  sender INT,
  receiver INT,
  type INTq
);

// CREATE TABLE IF NOT EXISTS `tomatoes` 
// (
//   `tid` INT UNSIGNED AUTO_INCREMENT,
//   `uid`INT UNSIGNED NOT NULL,
//   `sid`INT UNSIGNED NOT NULL,
//   PRIMARY KEY(`tid`),
//   FOREIGN KEY(`uid`) REFERENCES users(uid),
//   FOREIGN KEY(`sid`) REFERENCES services(sid)
// );






