import axios from "axios";

const btnSendMessage = <HTMLButtonElement>
	document.querySelector("#btn-message-send");

const inputMessage = <HTMLInputElement>
	document.querySelector('#input-message');

const addMessageList = (addMessage: string): void => {
	let listBlock = document.querySelector('#list-block');
	let list: HTMLLIElement = document.createElement('li');
	list.innerText = addMessage;
	listBlock?.appendChild(list);
}

const sendMessage = (): void => {
	axios.post('/message', { message: inputMessage.value })
		.then((result) => {
			addMessageList(inputMessage.value);
			console.log("success!");
		})
		.catch((error) => {
			console.log("error!");
		});
};

const listenMessageChannel = () => {
	window.Echo.channel('message-added-channel').listen(
		'MessageAdded',
		(response) => {
			console.log(response.message.body);
			addMessageList(response.message.body);
		}
	);
}

btnSendMessage.addEventListener("click", sendMessage);
document.addEventListener('DOMContentLoaded', listenMessageChannel);
