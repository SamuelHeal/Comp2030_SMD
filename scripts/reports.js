const SELECT_END = document.getElementById("reports-button-input-end");
const SELECT_START = document.getElementById("reports-button-input-start");
const SELECT_MACHINE = document.getElementById("reports-button-select-machine");
let table_expanded = false;

function displayFormInputs() {
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    if (QUERY_PARAMETERS.has("start")) {
        SELECT_END.value = QUERY_PARAMETERS.get("end");
        SELECT_START.value = QUERY_PARAMETERS.get("start");
        SELECT_MACHINE.value = QUERY_PARAMETERS.get("machine");
    }
}

function expandTableOnClick() {
    const REPORTS_TABLE_WRAPPER = document.getElementById("reports-table-wrapper");
    REPORTS_TABLE_WRAPPER.addEventListener("click", ()=> {
        if (table_expanded) {
            REPORTS_TABLE_WRAPPER.classList.remove("reports-table-expanded");
            REPORTS_TABLE_WRAPPER.title = "Click to expand";
        }
        else {
            REPORTS_TABLE_WRAPPER.classList.add("reports-table-expanded");
            REPORTS_TABLE_WRAPPER.title = "";
        }
        table_expanded = !table_expanded;
    });
}

function loadEndOnStartChange() {
    SELECT_START.addEventListener("change", ()=> {
        SELECT_END.value = SELECT_START.value;
    });
}

function showEndPickerOnClick() {
    const SELECT_END_WRAPPER = document.getElementById("reports-button-input-end-wrapper");
    SELECT_END_WRAPPER.addEventListener("click", ()=> {
        SELECT_END.showPicker();
    });
}

function showStartPickerOnClick() {
    const SELECT_START_WRAPPER = document.getElementById("reports-button-input-start-wrapper");
    SELECT_START_WRAPPER.addEventListener("click", ()=> {
        SELECT_START.showPicker();
    });
}

displayFormInputs();
expandTableOnClick();
loadEndOnStartChange();
showEndPickerOnClick();
showStartPickerOnClick();
