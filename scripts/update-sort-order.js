function updateSort() {
    const sortColumn = document.getElementById('sort').value;
    const sortDirection = document.getElementById('direction').classList.contains('asc') ? 'asc' : 'desc';
    const showOption = document.getElementById('show').value;
    const QUERY_STRING = window.location.search;
    const QUERY_PARAMETERS = new URLSearchParams(QUERY_STRING);
    window.location.href = `?sort=${sortColumn}&direction=${sortDirection}&show=${showOption}&machineID=${QUERY_PARAMETERS.get("machineID")}`;
}

function toggleDirection() {
    const directionButton = document.getElementById('direction');
    if (directionButton.classList.contains('asc')) {
        directionButton.classList.remove('asc');
        directionButton.classList.add('desc');
        directionButton.textContent = 'Descending';
    } else {
        directionButton.classList.remove('desc');
        directionButton.classList.add('asc');
        directionButton.textContent = 'Ascending';
    }
    updateSort();
}
