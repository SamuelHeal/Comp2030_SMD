function goBackOnClick() {
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    const BACK_BUTTON = document.getElementById("message-button-back");
    BACK_BUTTON.addEventListener("click", ()=> {
        window.location = `messages.php?machineID=${QUERY_PARAMETERS.get("machineID")}`;
    });
}

goBackOnClick();