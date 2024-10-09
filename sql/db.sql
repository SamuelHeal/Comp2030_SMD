SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS Group18_SMD;
CREATE DATABASE Group18_SMD;

USE Group18_SMD;

/* Table Declarations */
CREATE TABLE Machine(
    machineID INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(4) NOT NULL,
    status INTEGER NOT NULL,
    assignedOperator INTEGER DEFAULT NULL,
    isArchived BOOLEAN DEFAULT 0 NOT NULL,
    PRIMARY KEY (machineID)
);

CREATE TABLE Person(
    personID INTEGER NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    DOB DATE NOT NULL,
    email VARCHAR(100) NOT NULL,
    employmentDate DATE NOT NULL,
    phoneNumber VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    PIN VARCHAR(255) NOT NULL,
    isArchived BOOLEAN DEFAULT FALSE,
    archivedAt DATETIME DEFAULT NULL,
    lastActiveTime DATETIME DEFAULT NULL,
    lastActiveMachineID INTEGER DEFAULT NULL,
    FOREIGN KEY(lastActiveMachineID) REFERENCES Machine(machineID),
    PRIMARY KEY (personID)
);

ALTER TABLE Machine ADD CONSTRAINT FK_Machine_Person FOREIGN KEY (assignedOperator) REFERENCES Person(personID);

CREATE TABLE Job(
    jobID INTEGER NOT NULL AUTO_INCREMENT,
    description VARCHAR(1000),
    machineID INTEGER NOT NULL,
    operatorID INTEGER NOT NULL,
    priority INTEGER NOT NULL,
    status VARCHAR(100) NOT NULL DEFAULT "Awaiting Confirmation",
    timeUpdated DATETIME NOT NULL,
    completed INTEGER NOT NULL DEFAULT 0,
    PRIMARY KEY (jobID),
    FOREIGN KEY (machineID) REFERENCES Machine(machineID),
    FOREIGN KEY (operatorID) REFERENCES Person(personID)
);

CREATE TABLE Log(
    timestamp DATETIME NOT NULL,
    machineID INTEGER NOT NULL,
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
    PRIMARY KEY (timestamp, machineID),
    FOREIGN KEY (machineID) REFERENCES Machine(machineID)
);

CREATE TABLE Message(
    messageID INTEGER NOT NULL AUTO_INCREMENT,
    timestamp DATETIME NOT NULL,
    authorID INTEGER NOT NULL,
    recipientID INTEGER NOT NULL,
    isRead BOOLEAN NOT NULL,
    subject VARCHAR(100) NOT NULL,
    body VARCHAR(1000) NOT NULL,
    PRIMARY KEY (messageID),
    FOREIGN KEY (authorID) REFERENCES Person(personID),
    FOREIGN KEY (recipientID) REFERENCES Person(personID)
);

CREATE TABLE Note(
    noteID INTEGER NOT NULL AUTO_INCREMENT,
    jobID INTEGER NOT NULL,
    category VARCHAR(100) NOT NULL,
    priority INTEGER NOT NULL,
    timeCreated DATETIME NOT NULL,
    personID INTEGER NOT NULL,
    description VARCHAR(1000),
    PRIMARY KEY (noteID),
    FOREIGN KEY (personID) REFERENCES Person(personID),
    FOREIGN KEY (jobID) REFERENCES Job(jobID)
);


/* Create User Statement */
DROP USER IF EXISTS dbadmin@localhost;
CREATE USER dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group18_SMD.Machine TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group18_SMD.Person TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group18_SMD.Job TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group18_SMD.Log TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group18_SMD.Message TO dbadmin@localhost;
GRANT ALL PRIVILEGES ON Group18_SMD.Note TO dbadmin@localhost;
