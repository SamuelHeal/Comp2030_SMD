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
    DOB DATETIME NOT NULL,
    email VARCHAR(100) NOT NULL,
    employmentDate DATETIME NOT NULL,
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
    timeUpdated DATETIME NOT NULL,
    PRIMARY KEY (jobID),
    FOREIGN KEY (machineID) REFERENCES Machine(machineID),
    FOREIGN KEY (OperatorID) REFERENCES Person(personID)
) AUTO_INCREMENT = 1;

CREATE TABLE Message(
    messageID INTEGER NOT NULL AUTO_INCREMENT,
    timestamp DATETIME NOT NULL,
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
    machineID INTEGER NOT NULL,
    machineName VARCHAR(100),
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
