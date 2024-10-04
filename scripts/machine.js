function changeButtons() {
    QUERY_STRING = window.location.toString();
    const BACK_BUTTON = document.getElementById("machine-button-back");
    const EDIT_BUTTON = document.getElementById("machine-button-edit");
    BACK_BUTTON.innerText = "Cancel";
    BACK_BUTTON.href = QUERY_STRING.replace("&active=1&edit=1", "");
    BACK_BUTTON.onclick = ()=> {return confirm("Are you sure you want to cancel changes?")};
    EDIT_BUTTON.innerText = "✓";
    EDIT_BUTTON.classList.add("green-hover");
    EDIT_BUTTON.addEventListener("click", (event)=> {
        event.preventDefault();  // This prevents the anchor tag from redirecting
        document.getElementById("machine-container").submit();
    })
}

function makeNameLocationOperatorEditable() {
    const MACHINE_INPUT_NAME = document.getElementById("machine-input-name");
    const MACHINE_INPUT_LOCATION = document.getElementById("machine-input-location");
    const MACHINE_SELECT_OPERATOR = document.getElementById("machine-select-operator");
    MACHINE_INPUT_NAME.disabled = false;
    MACHINE_INPUT_NAME.classList.add("clickable");
    MACHINE_INPUT_LOCATION.disabled = false;
    MACHINE_INPUT_LOCATION.classList.add("clickable");
    MACHINE_SELECT_OPERATOR.disabled = false;
    MACHINE_SELECT_OPERATOR.classList.add("clickable");
}

function makeStatusEditable() {
    const MACHINE_SELECT_STATUS = document.getElementById("machine-select-status");
    MACHINE_SELECT_STATUS.disabled = false;
    MACHINE_SELECT_STATUS.classList.add("clickable");
}