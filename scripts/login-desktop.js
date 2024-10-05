function clearPin() {
    buttons = querySelector('.pin-input-field');
    buttons.value=''
}

function moveToNext(input, nextInput) {
    if (input.value.length == 1) {
        document.getElementById(nextInput).focus();
    }
}
