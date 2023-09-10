let messageInputForm = <HTMLInputElement>document.getElementById("input-message");

messageInputForm.addEventListener('input', (event) => {
    let inputMessageValue = (event.target as HTMLInputElement).value;
    let sendButton = document.getElementById("btn-message-send");
    const inputCheck = /\s+/g
    inputMessageValue = inputMessageValue.replace(inputCheck, '')
    if (inputMessageValue == '') {
        sendButton?.setAttribute("disabled", "");
    } else {
        sendButton?.removeAttribute("disabled");
    }
});