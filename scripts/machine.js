function disableEditing() {
    const MACHINE_FORM = document.getElementById("machine-form");
    [...MACHINE_FORM.elements].forEach((element)=> {
        element.disabled = true;
        element.className = "machine-input";
    });
    const SUBMIT_BUTTON = document.getElementById("machine-button-submit");
    SUBMIT_BUTTON.style.display = "none";
}

function disableEditingOperator() {
    const NAME_INPUT = document.getElementById("machine-input-name");
    const LOCATION_INPUT = document.getElementById("machine-input-location");
    const OPERATOR_SELECT = document.getElementById("machine-select-operator");
    NAME_INPUT.disabled = true;
    LOCATION_INPUT.disabled = true;
    OPERATOR_SELECT.disabled = true;
    NAME_INPUT.className = "machine-input";
    LOCATION_INPUT.className = "machine-input";
    OPERATOR_SELECT.className = "machine-input";
}

function submitForm() {
    const MACHINE_FORM = document.getElementById("machine-form");
    const NAME_INPUT = document.getElementById("machine-input-name");
    const LOCATION_INPUT = document.getElementById("machine-input-location");
    if (NAME_INPUT.value === "" || LOCATION_INPUT.value === "") {
        alert("Please enter a value for name and location.");
    } else {
        MACHINE_FORM.submit();
    }
}
