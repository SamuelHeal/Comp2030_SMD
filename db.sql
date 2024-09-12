SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Group_18_SMD;
CREATE DATABASE Group_18_SMD;

USE Group_18_SMD;

CREATE TABLE User(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    dob varchar(100) NOT NULL,
    position varchar(100) NOT NULL,
    phonenumber varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    employmentdate varchar(100) NOT NULL,
    pin varchar(100) NOT NULL,
) AUTO_INCREMENT = 1;

INSERT INTO User(firstname, lastname, dob, position, phonenumber, email, employmentdate, pin) VALUES('Sam', 'Heal', '06/08/1999', 'Factory Manager', '04111111111', 'heal0163@flinders.edu.au', '12/09/2024', '0000');

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON Group_18_SMD.User TO dbadmin@localhost;

