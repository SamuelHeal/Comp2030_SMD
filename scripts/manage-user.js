function generatePin() {
    let pin = Math.floor(1000 + Math.random() * 9000).toString(); // Genertae random 4-digit pin
    
    document.getElementById('pin').value = pin; // Fill the pin input with the generated PIN
}

function showPinFields() {
    document.getElementById('pin-input').style.display = 'block';
    document.getElementById('generate-button-input').style.display = 'block';
    document.getElementById('reset-button-input').style.display = 'none';
}

function confirmArchive(personID, firstName, lastName, machineID) {
    const confirmation = confirm(`Are you sure you want to archive user ${firstName} ${lastName}? This will revoke all access to the system. This cannot be undone.`);
    if (confirmation) {
        window.location.href = `../system/archive-user.php?machineID=${machineID}&personID=${personID}`;
    }
}

function makeUsersClickable() {
    document.querySelectorAll('.user-container').forEach(function(user) {
        user.addEventListener('click', function() {
            const personID = this.dataset.personid;
            const machineID = this.dataset.machineid;
            window.location.href = `update-user.php?personID=${personID}&machineID=${machineID}`;
        });
    });

    // Prevent redirect if clicking on archive button
    document.querySelectorAll('.archive-button').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
}

