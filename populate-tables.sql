/* Insert Statements */

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


INSERT INTO Job VALUES(
    2,
    "There's a problem with the 3D printer. Please see what the problem is and fix it.",
    1000,
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


INSERT INTO Part VALUES(
    1001,
    1000,
    "PLA Filament [F1001]",
    "Part for the 3D printer."
);
