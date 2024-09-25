function newSubjectOption(subject) {
    const OPTION = document.createElement("option");
    OPTION.value = subject;
    return OPTION;
}

// This sets and disables the select inputs.
function formatMessageAsReply(id, name, subject) {
    const MESSAGE_RECIPIENT = document.getElementById("new-message-recipient");
    const MESSAGE_SUBJECT = document.getElementById("new-message-subject");
    const RECIPIENT_SELECT = document.getElementById("new-message-button-recipient");
    const SUBJECT_SELECT = document.getElementById("new-message-button-subject");
    RECIPIENT_SELECT.style.display = "none";
    SUBJECT_SELECT.style.display = "none";
    SUBJECT_SELECT.appendChild(newSubjectOption(subject));
    MESSAGE_RECIPIENT.innerText = name;
    MESSAGE_SUBJECT.innerText = subject;
    RECIPIENT_SELECT.value = id;
    SUBJECT_SELECT.value = subject;
}

function setRecipientHeadingOnChange() {
    const RECIPIENT_HEADING = document.getElementById("new-message-recipient");
    const RECIPIENT_SELECT = document.getElementById("new-message-button-recipient");
    RECIPIENT_SELECT.addEventListener("change", ()=> {
        if (RECIPIENT_SELECT.value) {
            RECIPIENT_HEADING.innerText = `To ${RECIPIENT_SELECT[RECIPIENT_SELECT.selectedIndex].innerText}`;
        }
        else {
            RECIPIENT_HEADING.innerText = "New Message";
        }
    });
}

function setSubjectOnChange() {
    const SUBJECT_HEADING = document.getElementById("new-message-subject");
    const SUBJECT_SELECT = document.getElementById("new-message-button-subject");
    SUBJECT_SELECT.addEventListener("change", ()=> {
        if (SUBJECT_SELECT.value) {
            SUBJECT_HEADING.innerText = SUBJECT_SELECT.value;
        }
        else {
            SUBJECT_HEADING.innerText = "Subject";
        }
    });
}

setRecipientHeadingOnChange();
setSubjectOnChange();
