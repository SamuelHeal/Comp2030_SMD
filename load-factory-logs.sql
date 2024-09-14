-- Increase max allowed size to 64M to import the csv file
SET GLOBAL max_allowed_packet = 67108864;

-- Load all machines into Machine table (neccesary because of foreign key in Log table)

INSERT INTO Machine
VALUES(
    1000,
    "3D Printer",
    "B0",
    2
);
-- Auto increment means id is no longer required to be specified
INSERT INTO Machine (name, location, status)
VALUES 
(
    "CNC Machine",
    "A0",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "Automated Guided Vehicle (AGV)",
    "A1",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "Industrial Robot",
    "D0",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "Smart Conveyor System",
    "B1",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "IoT Sensor Hub",
    "C0",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "Predictive Maintenance System",
    "C1",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "Automated Assembly Line",
    "A2",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "Quality Control Scanner",
    "B2",
    2
);

INSERT INTO Machine (name, location, status)
VALUES 
(
    "Energy Management System",
    "C2",
    2
);

-- Create tempory table to load the factroy logs into
CREATE TEMPORARY TABLE TempLog (
    timestamp DATETIME,
    machine_name VARCHAR(100),
    temperature FLOAT,
    pressure FLOAT,
    vibration FLOAT,
    humidity FLOAT,
    power_consumption FLOAT,
    operational_status VARCHAR(20),
    error_code VARCHAR(5),
    production_count INT,
    maintenance_log TEXT,
    speed FLOAT
);


LOAD DATA INFILE 'factory_logs/factory_logs.csv'
INTO TABLE TempLog
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS -- Because first row is column names
(@timestamp, machine_name, temperature, pressure, vibration, humidity, power_consumption, operational_status, @error_code, production_count, @maintenance_log, @speed)
SET timestamp = STR_TO_DATE(@timestamp, '%d/%m/%Y %H:%i'), -- Reformats timestamp into correct datetime format
    error_code = NULLIF(TRIM(@error_code), ''), -- Set missing values to NULL (otherwise would be an empty string)
    maintenance_log = NULLIF(TRIM(@manitenance_log), ''), -- Set missing values to NULL (otherwise would be an empty string)
    speed = NULLIF(TRIM(@speed), 0); -- Set missing values to NULL (otherwise would be 0)

-- Insert templog into log, but using the machineID from the corresponding machine name in Machine table
INSERT INTO Log (timestamp, machineID, temperature, pressure, vibration, humidity, power_consumption, operational_status, error_code, production_count, maintenance_log, speed)
SELECT t.timestamp, m.machineID, t.temperature, t.pressure, t.vibration, t.humidity, t.power_consumption, t.operational_status, t.error_code, t.production_count, t.maintenance_log, t.speed
FROM TempLog t
JOIN Machine m ON t.machine_name = m.name;

-- Drop the temporary table
DROP TEMPORARY TABLE TempLog;
