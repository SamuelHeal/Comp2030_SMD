function setTimestamp() {
    // Gets the current timestamp from the input
    const timestamp = document.getElementById('datetime-inp').value;
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    // adds the timestamp to the address bar
    window.location.href = `?timestamp=${timestamp}&machineID=${QUERY_PARAMETERS.get("machineID")}`;
}

document.addEventListener('DOMContentLoaded', () => {
    const datetimeInput = document.getElementById('datetime-inp');
    const datetimeWrapper = document.getElementById('datetime-inp-wrapper');
    datetimeWrapper.addEventListener('click', () => {
    datetimeInput.showPicker();
    });
});

// Gets the current timestamp from the input
const timestamp = document.getElementById('datetime-inp').value;
// Convert to a Date object to access the methods
let timestampDate = new Date(timestamp);
// Stops setting time to the future (> current time)
if(timestampDate.getTime() + (30* 60 * 1000) <= Date.now()) {
    // Adds (or subtracts) 30 minutes (in milliseconds) to the timestamp
    let newTime = new Date(timestampDate.setTime(timestampDate.getTime() + (30* 60 * 1000))); 
    // Reformats the time back into the required format
    const newFormattedTime = newTime.getFullYear() + "-" + (newTime.getMonth() + 1).toString().padStart(2, 0) + "-" + newTime.getDate().toString().padStart(2, 0) + "T" + 
    newTime.getHours().toString().padStart(2, 0) + ":" + newTime.getMinutes().toString().padStart(2, 0);
    //Updates the input with the new time
    document.getElementById('datetime-inp').value = newFormattedTime;
    // adds the new timestamp to the address bar
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    window.location.href = `?timestamp=${newFormattedTime}&machineID=${QUERY_PARAMETERS.get("machineID")}` 
};