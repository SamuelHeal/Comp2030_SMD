SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Group_18_SMD;
CREATE DATABASE Group_18_SMD;

USE Group_18_SMD;

CREATE TABLE Users(
    id int NOT NULL AUTO_INCREMENT,
    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    dob varchar(100) NOT NULL,
    position varchar(100) NOT NULL,
    phonenumber varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    employmentdate varchar(100) NOT NULL,
    pin varchar(100) NOT NULL,
    PRIMARY KEY (id)
) AUTO_INCREMENT = 1;

CREATE TABLE Jobs(
    id int NOT NULL AUTO_INCREMENT,
    OperatorID int,
    FOREIGN KEY (OperatorID) REFERENCES Users(id),
    PRIMARY KEY (id)
);

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON Group_18_SMD.Users TO dbadmin@localhost;

