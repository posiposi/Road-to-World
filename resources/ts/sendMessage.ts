import axios from "axios";

const btnSendMessage = <HTMLButtonElement>
	document.querySelector("#btn-message-send");

const inputMessage = <HTMLInputElement>
	document.querySelector('#input-message');

const getMessageList = () => {
	axios.get('/messages/get')
		.then((result) => {
			const resultObj = result.data;
			console.log(resultObj);
			for (let index = 0; index < resultObj.length; index++) {
				const message = resultObj[index];
				initMessageList(message.body);
			}
		})
		.catch((error) => {
			console.log('error!');
			console.log(error.data);
		});
};

const initMessageList = (message: string) => {
	let listBlock = document.querySelector('#list-block');
	let list: HTMLLIElement = document.createElement('li');
	list.innerText = message;
	listBlock?.appendChild(list);
}

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

document.addEventListener('DOMContentLoaded', getMessageList);
document.addEventListener('DOMContentLoaded', listenMessageChannel);
