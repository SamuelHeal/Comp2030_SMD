function listenForSelectStartClick() {
    const SELECT_START_WRAPPER = document.getElementById("reports-button-select-start-wrapper");
    const SELECT_START = document.getElementById("reports-button-select-start");
    SELECT_START_WRAPPER.addEventListener("click", (event)=> {
    SELECT_START.showPicker();
    });
}

function listenForSelectEndClick() {
    const SELECT_END_WRAPPER = document.getElementById("reports-button-select-end-wrapper");
    const SELECT_END = document.getElementById("reports-button-select-end");
    SELECT_END_WRAPPER.addEventListener("click", (event)=> {
    SELECT_END.showPicker();
    });
}

listenForSelectEndClick();
listenForSelectStartClick();