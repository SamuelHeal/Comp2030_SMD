const LOGIN_FIELD = document.getElementById("login-field");

function listenForClear() {
    const CLEAR_BUTTON = document.getElementById("keypad-clear");
    CLEAR_BUTTON.addEventListener("click", (event)=> {
        event.preventDefault();
        LOGIN_FIELD.value = "";
    });
}

function listenForNumberPress() {
    for (let i = 0; i < 10; i++) {
        const KEYPAD_BUTTON = document.getElementById(`keypad-${i}`);
        KEYPAD_BUTTON.addEventListener("click", (event)=> {
            event.preventDefault();
            LOGIN_FIELD.value += i;
        });
    }   
}

function listenForEnterPress() {
    const SUBMIT_BUTTON = document.getElementById("keypad-submit");
    document.addEventListener("keypress", (event)=> {
        if (event.key === "Enter") {
            SUBMIT_BUTTON.click();
        }
    });
}

listenForClear();
listenForNumberPress();
// listenForEnterPress();
