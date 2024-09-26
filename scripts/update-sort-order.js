function updateSort() {
    const sortColumn = document.getElementById('sort').value;
    const sortDirection = document.getElementById('direction').classList.contains('up') ? 'asc' : 'desc';
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    window.location.href = `?sort=${sortColumn}&direction=${sortDirection}&machineID=${QUERY_PARAMETERS.get("machineID")}`;
}

function toggleDirection() {
    const directionButton = document.getElementById('direction');
    if (directionButton.classList.contains('up')) {
        directionButton.classList.remove('up');
        directionButton.classList.add('down');
    } else {
        directionButton.classList.remove('down');
        directionButton.classList.add('up');
    }
    updateSort();
}