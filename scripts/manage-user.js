function generatePin() {
    let pin = Math.floor(1000 + Math.random() * 9000).toString(); // Generate random 4-digit pin
    isUniquePin(pin, function(unique) {
        if (unique) {
            document.getElementById('pin').value = pin; // Fill the pin input field with the generated PIN
        } else generatePin(); // Call recursively to generate another pin if not unique
    });

}

function isUniquePin(pin, callback) {
    let xmlReq = new XMLHttpRequest();
    xmlReq.open('POST', '../scripts/check-unique-pin.php', true); // Async request
    xmlReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // URL-encoded form
    xmlReq.onreadystatechange = function() {
        if (xmlReq.readyState === 4 && xmlReq.status === 200) { // Request is complete and ready + status OK
            callback(xmlReq.responseText === 'true'); // true if response is true
        }
    };

    xmlReq.send('pin=' + encodeURIComponent(pin));
}

function showPinFields() {
    document.getElementById('pin-input').style.display = 'block';
    document.getElementById('generate-button-input').style.display = 'block';
    document.getElementById('reset-button-input').style.display = 'none';
    document.getElementById('pin').required = true;
}

function confirmArchive(personID, firstName, lastName) {
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    const confirmation = confirm(`Are you sure you want to archive user ${firstName} ${lastName}? This will revoke all access to the system.`);
    if (confirmation) {
        window.location.href = `../system/archive-user.php?machineID=${QUERY_PARAMETERS.get("machineID")}&personID=${personID}`;
    }
}

function confirmRestore(name) {
    return confirm(`Are you sure you want to restore user ${name}?`);
}

function makeUsersClickable() {
    document.querySelectorAll('.user-container').forEach(function(user) {
        user.addEventListener('click', function() {
            const personID = this.dataset.personid;
            const machineID = this.dataset.machineid;
            window.location.href = `update-user.php?personID=${personID}&machineID=${machineID}&active=1`;
        });
    });

    // Prevent redirect if clicking on archive button
    document.querySelectorAll('.archive-button').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
}


document.addEventListener('DOMContentLoaded', function() {
    const pinInput = document.getElementById('pin');
    if (pinInput) {
        pinInput.addEventListener('blur', function() {
            let pin = this.value;
            isUniquePin(pin, function(unique) {
                if (!unique) {
                    alert('PIN already in use. Please choose a different PIN.');
                    pinInput.value = ''; // Clear the pin input field
                }
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('phonenumber');
    if (phoneInput) {
        phoneInput.addEventListener('blur', function() {
            let phoneNumber = this.value;
            if (!isValidPhoneNumber(phoneNumber)) {
                alert('Please enter a valid phone number.');
                phoneInput.value = ''; // Clear the phonenumner input field
            }
        });
    }
});

function isValidPhoneNumber(phoneNumber) {
    // Mobile numbers starting with 04 + 8 digits
    if (/^04\d{8}$/.test(phoneNumber)) return true;

    // International numbers starting with +61 (AUS) + 9 digits
    if (/^\+61\d{9}$/.test(phoneNumber)) return true;

    return false;
}