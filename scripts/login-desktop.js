function clearPin() {
    const PIN_INPUTS = document.getElementsByClassName("pin-input-field");
    [...PIN_INPUTS].forEach((input) => {
        input.value = "";
    });
}

function moveToNext(input, nextInput) {
    if (input.value.length == 1) {
        if (nextInput != 4) {
            document.getElementById(`${nextInput + 1}`).focus();
        } else {
            document.getElementById(`${nextInput}`).blur();
        }
    } else if (input.value.length == 0) {
        document.getElementById(`${nextInput - 1}`).focus();
    }
}

addEventListener("keypress", (event) => {
    if (event.key == 'Enter') {
        event.preventDefault();
        document.getElementById("login-btn").click();
    }
});
