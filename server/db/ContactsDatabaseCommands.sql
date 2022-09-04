-- to connect to MySQL: mysql -u root -p
-- Password: abc123W(k

-- Creating the main database (we can rename it something else)
CREATE DATABASE COP4331GR16;

-- to Use the Database
USE COP4331GR16;

-- Users Table
CREATE TABLE `COP4331GR16`.`Users`
(
  `userID`                       INT NOT NULL AUTO_INCREMENT ,
  `DateCreated`                  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `DateLastLoggedIn`             DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `FirstName` VARCHAR(50)        NOT NULL DEFAULT '' ,
  `LastName` VARCHAR(50)         NOT NULL DEFAULT '' ,
  `Login` VARCHAR(50)            NOT NULL DEFAULT '' ,
  `Password` VARCHAR(50)         NOT NULL DEFAULT '' ,
  PRIMARY KEY (`userID`)
) ENGINE = InnoDB;

-- Contacts Table
CREATE TABLE `COP4331GR16`.`Contacts`
(
    `userID`       INT NOT NULL,
    `contactID`    INT NOT NULL AUTO_INCREMENT,
    `FirstName`    VARCHAR(50) NOT NULL DEFAULT '',
    `LastName`     VARCHAR(50) NOT NULL DEFAULT '',
    `Email`        VARCHAR(50) NOT NULL DEFAULT '',
    `Phone`        VARCHAR(12) NOT NULL DEFAULT '000-000-0000' ,
    `Address`      VARCHAR(50) NOT NULL DEFAULT '',
    `Status`       VARCHAR(50) NOT NULL DEFAULT '',
    `DateCreated`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`contactID`),
    FOREIGN KEY (`userID`) REFERENCES Users(`userID`)
) ENGINE = InnoDB;

-- Create Insert user, Insert contact, Delete contact, search contact --
-- Insert Users
insert into Users (FirstName, LastName, Login, Password) VALUES ('Sofia', 'Beyerlein', 'sofBey123', 'Password1');
insert into Users (FirstName, LastName, Login, Password) VALUES ('Derek', 'Dyer', 'ddyer0214', 'verySecurePassword');


-- Insert Contacts
insert into Contacts (userId, FirstName, LastName, Email, Phone, Address, Status)
              VALUES ('1', 'Harry', 'Potter', 'harrypotter@gmail.wiz', '999-123-4567', '7 Magical Ave, London', 'Friend');
insert into Contacts (userId, FirstName, LastName, Email, Phone, Address, Status)
              VALUES ('1', 'Thomas', 'Riddle', 'triddle@gmail.wiz', '666-123-4567', '79 Evil Ave, London', 'Enemy');
insert into Contacts (userId, FirstName, LastName, Email, Phone, Address, Status)
              VALUES ('1', 'Margot', 'Robbie', 'margotrobbie@barbie.com', '332-445-6759', '42 Sherman Wallaby Way', 'Friend');


insert into Contacts (userId, FirstName, LastName, Email, Phone, Address, Status)
              VALUES ('2', 'Real', 'Person', 'anemail@gmail.com', '123-456-7890', 'Mars', 'Human');
insert into Contacts (userId, FirstName, LastName, Email, Phone, Address, Status)
              VALUES ('2', 'Bruce', 'Wayne', 'Bruce_wayne@waynetech.com', '148-782-3789', 'Wayne Manor, Gotham', 'Not Batman');

-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

/*
insert into Users (FirstName,LastName,Login,Password) VALUES ('Rick','Leinecker','RickL','COP4331');
insert into Users (FirstName,LastName,Login,Password) VALUES ('Sam','Hill','SamH','Test');
insert into Users (FirstName,LastName,Login,Password) VALUES ('Rick','Leinecker','RickL','5832a71366768098cceb7095efb774f2');
insert into Users (FirstName,LastName,Login,Password) VALUES ('Sam','Hill','SamH','0cbc6611f5540bd0809a388dc95a615b');

insert into Colors (Name,UserID) VALUES ('Blue',1);

CREATE TABLE `COP4331`.`Colors` ( `ID` INT NOT NULL AUTO_INCREMENT , `Name` VARCHAR(50) NOT NULL DEFAULT '' , `UserID` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`ID`)) ENGINE = InnoDB;



USE COP4331;

Select *
from INFORMATION_SCHEMA.TABLES;
IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES
           WHERE TABLE_NAME = 'Users')
BEGIN
  PRINT 'Yes'
END

/*
