const WARNING = "IMPORTANT: TO RETURN TO THIS PAGE, ENTER\n\n    http://localhost/www/comp2030_smd/index.php\n\nINTO THE ADDRESS BAR.";
const MESSAGE = "Welcome to a demonstration of the Smart Manafacturing Dashboard (SMD)! This page allows you to select from multiple machines that show the SMD working in different contexts. Please enter a number between 1 and 10. \n";

function getMachineId() {
    alert(WARNING);
    let input;
    do {
        input = prompt(MESSAGE);
    } while (!isValidMachineId(input));
    setMachineId(input);
  } 

function isValidMachineId(character) {
    return character >= '1' && character <= '9';
}

function setMachineId(machineID) {
    window.location = `pages\\login.php?machineID=${machineID}`;
}

getMachineId();
