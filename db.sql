SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Group_18_SMD;
CREATE DATABASE Group_18_SMD;

USE Group_18_SMD;

/* Table Declarations */
CREATE TABLE Machine(
    machineID INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(4) NOT NULL,
    status INTEGER NOT NULL,
    PRIMARY KEY (machineID)
) AUTO_INCREMENT = 1;

CREATE TABLE Person(
    personID INTEGER NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    DOB VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    employmentDate VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    PIN INTEGER NOT NULL,
    PRIMARY KEY (personID)
);

CREATE TABLE Job(
    jobID INTEGER NOT NULL AUTO_INCREMENT,
    description VARCHAR(1000),
    machineID INTEGER NOT NULL,
    OperatorID INTEGER NOT NULL,
    priority INTEGER NOT NULL,
    timeUpdated date NOT NULL,
    PRIMARY KEY (jobID),
    FOREIGN KEY (machineID) REFERENCES Machine(machineID),
    FOREIGN KEY (OperatorID) REFERENCES Person(personID)
) AUTO_INCREMENT = 1;

CREATE TABLE Message(
    messageID INTEGER NOT NULL AUTO_INCREMENT,
    timestamp date NOT NULL,
    authorID INTEGER NOT NULL,
    recipientID INTEGER NOT NULL,
    jobID INTEGER NOT NULL,
    subject VARCHAR(100) NOT NULL,
    body VARCHAR(1000) NOT NULL,
    PRIMARY KEY (messageID),
    FOREIGN KEY (authorID) REFERENCES Person(personID),
    FOREIGN KEY (recipientID) REFERENCES Person(personID),
    FOREIGN KEY (jobID) REFERENCES Job(jobID)
) AUTO_INCREMENT = 1;

CREATE TABLE Note(
    noteID INTEGER NOT NULL AUTO_INCREMENT,
    jobID INTEGER NOT NULL,
    category VARCHAR(100) NOT NULL,
    issue VARCHAR(1000) NOT NULL,
    partName VARCHAR(100) NOT NULL,
    managerID INTEGER NOT NULL,
    priority INTEGER NOT NULL,
    details VARCHAR(1000),
    PRIMARY KEY (noteID),
    FOREIGN KEY (jobID) REFERENCES Job(jobID),
    FOREIGN KEY (managerID) REFERENCES Person(personID)
);

CREATE TABLE Log(
    machineID INTEGER NOT NULL AUTO_INCREMENT,
    timestamp DATETIME NOT NULL,
    operationalStatus VARCHAR(20) NOT NULL,
    maintenanceLog VARCHAR(100),
    errorCode VARCHAR(5),
    productionCount INTEGER NOT NULL,
    humidity FLOAT,
    powerConsumption FLOAT,
    pressure FLOAT,
    speed FLOAT,
    temperature FLOAT,
    vibration FLOAT,
    PRIMARY KEY (machineID, timestamp),
    FOREIGN KEY (machineID) REFERENCES Machine(machineID)
);

CREATE TABLE Part(
    partID INTEGER NOT NULL AUTO_INCREMENT,
    machineID INTEGER NOT NULL,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(1000),
    PRIMARY KEY (partID),
    FOREIGN KEY (machineID) REFERENCES Machine(machineID)
) AUTO_INCREMENT = 1;

/* Create User Statement */
DROP USER IF EXISTS dbadmin@localhost;
CREATE USER dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group_18_SMD.Machine TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group_18_SMD.Person TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group_18_SMD.Job TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group_18_SMD.Message TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group_18_SMD.Note TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group_18_SMD.Log TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group_18_SMD.Part TO dbadmin@localhost;

/* Insert Statements */
INSERT INTO Machine VALUES(
    999,
    "3D Printer",
    "B0",
    2
);

INSERT INTO Person VALUES(
    1,
    "Frank",
    "Colson",
    "10/08/1978 00:00",
    "frank.colson@bigpond.com.au",
    "01/02/2010",
    "0489780234",
    "Manager",
    4545
);

INSERT INTO Person VALUES(
    2,
    "Robert",
    "McKenna",
    "14/12/1990 00:00",
    "robmckenna@messaging.com.au",
    "01/08/2019",
    "0412546802",
    "Production Operator",
    9900
);

INSERT INTO Job VALUES(
    2,
    "There's a problem with the 3D printer. Please see what the problem is and fix it.",
    999,
    2,
    4,
    NOW()
);

INSERT INTO Message VALUES(
    5,
    NOW(),
    2,
    1,
    2,
    "Building Maintenance",
    "The tap nearest the door in the gent's bathroom doesn't work"
);

INSERT INTO Note VALUES(
    9,
    2,
    "Issue with Parts/Materials",
    "Parts Running Low",
    "PLA Filament [F1001]",
    1,
    3,
    "Lorem ipsum dolor"
);

INSERT INTO Log VALUES(
    999,
    "2024/04/01 00:00:00",
    "active",
    NULL,
    NULL,
    96,
    36.76,
    330.36,
    3.16,
    3.35,
    71.18,
    0.24
);

INSERT INTO Part VALUES(
    1001,
    999,
    "PLA Filament [F1001]",
    "Part for the 3D printer."
);
