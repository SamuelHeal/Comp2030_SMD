SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Group_18_SMD;
CREATE DATABASE Group_18_SMD;

USE Group_18_SMD;

CREATE TABLE Users(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    dob varchar(100) NOT NULL,
    position varchar(100) NOT NULL,
    phonenumber varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    employmentdate varchar(100) NOT NULL,
    pin varchar(100) NOT NULL,
    PRIMARY KEY (id),
) AUTO_INCREMENT = 1;

CREATE TABLE Jobs(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    OperatorID int,
    FOREIGN KEY (OperatorID) REFERENCES User(id),
    PRIMARY KEY (id)
)

INSERT INTO Users(firstname, lastname, dob, position, phonenumber, email, employmentdate, pin) VALUES('Sam', 'Heal', '06/08/1999', 'Factory Manager', '04111111111', 'heal0163@flinders.edu.au', '12/09/2024', '0000');

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON Group_18_SMD.Users TO dbadmin@localhost;

