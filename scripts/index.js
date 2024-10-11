const MESSAGE = "To return to this page, type \"http://localhost/www/comp2030_smd/index.php\" into the address bar. This page allows you to view different workstations. Enter 0 for in office context, otherwise, enter a number between 1 and 10 to view a workstation on the factory floor.";

function getMachineId() {
    let input;
    do {
        input = prompt(MESSAGE);
    } while (!isValidMachineId(input));
    setMachineId(input);
  } 

function isValidMachineId(character) {
    return character >= '0' && character <= '9';
}

function setMachineId(machineID) {
    if (machineID == 0 ) {
        window.location = `pages/login-desktop.php?machineID=${machineID}`;
    } else {
        window.location = `pages/login.php?machineID=${machineID}`;
    }
}

getMachineId();
