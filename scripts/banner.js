const IDLE = 0, ACTIVE = 1, MAINTENANCE = 2;

function getColourFromStatus(status) {
    switch (status) {
        case IDLE: return "#7b68ee";
        case ACTIVE: return "#228b22";
        case MAINTENANCE: return "#dc143c";
        default: return "#faf8f6";  // Something is wrong.
    }
}

function getMessageFromStatus(status) {
    switch (status) {
        case IDLE: return "IDLE";
        case ACTIVE: return "ACTIVE";
        case MAINTENANCE: return "MAINTENANCE";
        default: return "ERROR";  // Something is wrong.
    }
}

function setBannerColour(status) {
    const HEADER_CONTAINER = document.getElementById("header-container");
    const USERNAME = document.getElementById("username");
    if (status == 'desktop') {
        USERNAME.style.color = '#212c58';
    } else {    
        HEADER_CONTAINER.style.backgroundColor = getColourFromStatus(status);
    }
}

function setBannerMessage(status) {
    const HEADER_MESSAGE = document.getElementById("header-message");
    HEADER_MESSAGE.innerText = getMessageFromStatus(status);
}
