function getColourFromStatus(status) {
    const IDLE = 0, ACTIVE = 1, MAINTENANCE = 2;
    switch (status) {
        case IDLE: return "#212c58";
        case ACTIVE: return "#228b22";
        case MAINTENANCE: return "#dc143c";
        default: return "#faf8f6";  // Something is wrong.
    }
}

function getMessageFromStatus(status) {
    const IDLE = 0, ACTIVE = 1, MAINTENANCE = 2;
    switch (status) {
        case IDLE: return "IDLE";
        case ACTIVE: return "ACTIVE";
        case MAINTENANCE: return "MAINTENANCE";
        default: return "ERROR";  // Something is wrong.
    }
}

function setBannerColour(status) {
    const HEADER_CONTAINER = document.getElementById("header-container");
    HEADER_CONTAINER.style.backgroundColor = getColourFromStatus(status);
}

function setLoginBanner(name, location, status) {
    setBannerColour(status);
    const HEADER_MESSAGE = document.getElementById("header-message");
    const LOGIN_TITLE = document.getElementById("login-title");
    HEADER_MESSAGE.innerText = getMessageFromStatus(status);
    LOGIN_TITLE.innerText = `Login to ${name}`;
}
