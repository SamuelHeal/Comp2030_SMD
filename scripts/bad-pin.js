function warnIfBadPin() {
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    if (QUERY_PARAMETERS.has("bad_pin")) {
        const LOGIN_FIELD = document.getElementById("login-field");
        LOGIN_FIELD.classList.add("bad-pin");
        LOGIN_FIELD.setAttribute("placeholder", "Invalid PIN");
    }
}

warnIfBadPin();