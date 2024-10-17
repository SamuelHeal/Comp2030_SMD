function hideArchiveAllIfNoMachines() {
    const ARCHIVE_ALL_BUTTON = document.getElementById("machines-button-archive-all");
    const NO_MACHINES = document.getElementById("machines-none");
    if (NO_MACHINES) {
        ARCHIVE_ALL_BUTTON.style.display = "none";
    }
}

hideArchiveAllIfNoMachines();
