INSERT INTO Message (timestamp, authorID, recipientID, isRead, subject, body) VALUES (
    "24-07-20 15:30",
    3,  -- Brian Moser
    1,  -- Frank Colson
    0, 
    "Maintenance",
    "Someone needs to get the pothole in the parking lot filled in. "
);

INSERT INTO Message (timestamp, authorID, recipientID, isRead, subject, body) VALUES (
    "24-07-21 17:00",
    1,  -- Frank Colson
    3,  -- Brian Moser
    0, 
    "Re: Maintenance",
    "Hi Brian, I'll get someone in to do that next week. "
);

INSERT INTO Message (timestamp, authorID, recipientID, isRead, subject, body) VALUES (
    "24-07-26 11:25",
    1,  -- Frank Colson
    3,  -- Timothy Newman
    0, 
    "Job",
    "Hi Timmy, I've got a favour to ask. Rob won't be here next Monday, so I'm going to roster you in to cover his work on the 3D printer."
);

INSERT INTO Message (timestamp, authorID, recipientID, isRead, subject, body) VALUES (
    "24-07-28 09:05",
    4,  -- Timothy Newman
    1,  -- Frank Colson
    0, 
    "Re: Job",
    "No problem boss"
);

INSERT INTO Message (timestamp, authorID, recipientID, isRead, subject, body) VALUES (
    "24-07-29 09:05",
    5,  -- Jack Dennis
    1,  -- Frank Colson
    0, 
    "Notice",
    "There are a multitude of activities that different roles must be able to perform using the SMD, along with a couple activities that are shared between 
    multiple roles. Each activity must be designed in respect to its temporal, cooperative, complexity and content requirements; while being designed to 
    mitigate any safety issues that may arise whilst completing the activity. The SMD must provide access to certain functions to users with the correct 
    authorisation, while denying entry to those without. Ensuring that each activity functions correctly and provides each user with the most streamlined and 
    effective experience is pertinent to its success. Allowing a little ambiguity in the tasks required to complete each activity is acceptable for activities 
    completed by Factory Managers and Auditors, provided it is not safety critical, as it can be assumed that they have a decent level of technological skill. 
    However, Factory Manager activities should be designed to be completed as simply as possible given that they will be working on a loud and busy factory 
    floor; likely being distracted by a number of responsibilities at any given time. There should be no ambiguity in the activities completed by Production 
    Operators, as it must be assumed that their computer skills may not be as strong. For the most part, activities should be designed with a minimalistic 
    style to reduce distractions, however, it is important that all Production Operator activities are shown boldly and clearly (not hidden in anyway), as to 
    make the software as easy to use as possible for them.
    "  -- Group 18 PACT activities summary
);
