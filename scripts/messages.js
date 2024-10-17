function hideDeleteAllMarkAllIfNoMessages() {
    const DELETE_ALL_BUTTON = document.getElementById("messages-delete-all");
    const MARK_ALL_READ_BUTTON = document.getElementById("messages-mark-all-read");
    const NO_MESSAGES = document.getElementById("messages-none");
    if (NO_MESSAGES) {
        DELETE_ALL_BUTTON.style.display = "none";
        MARK_ALL_READ_BUTTON.style.display = "none";
    }
}

hideDeleteAllMarkAllIfNoMessages();
