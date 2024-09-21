const LOGIN_FIELD = document.getElementById("login-field");

function listenForClear() {
    const CLEAR_BUTTON = document.getElementById("keypad-clear");
    CLEAR_BUTTON.addEventListener("click", (event)=> {
        event.preventDefault();
        LOGIN_FIELD.value = "";
    });
}

function listenForNumberClick() {
    for (let i = 0; i < 10; i++) {
        const KEYPAD_BUTTON = document.getElementById(`keypad-${i}`);
        KEYPAD_BUTTON.addEventListener("click", (event)=> {
            event.preventDefault();
            LOGIN_FIELD.value += i;
        });
    }   
}

function setLoginTitle(name) {
    const LOGIN_TITLE = document.getElementById("login-title");
    LOGIN_TITLE.innerText = `Login to ${name}`;
}

function warnIfBadPin() {
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    if (QUERY_PARAMETERS.has("bad_pin")) {
        const LOGIN_FIELD = document.getElementById("login-field");
        LOGIN_FIELD.classList.add("bad-pin");
        LOGIN_FIELD.setAttribute("placeholder", "Invalid PIN");
    }
}

listenForClear();
listenForNumberClick();
warnIfBadPin();
