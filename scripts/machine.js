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
