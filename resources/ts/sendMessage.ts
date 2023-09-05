import axios from "axios";

const splitPathName: Array<string> = location.pathname.split('/');
const bikeId: number = Number(splitPathName[2]);
const loginUserId: number = Number(splitPathName[3]);
const anotherUserId: number = Number(splitPathName[4]);

const btnSendMessage = <HTMLButtonElement>
	document.querySelector("#btn-message-send");

const inputMessage = <HTMLInputElement>
	document.querySelector('#input-message');

const addMessageList = (addMessage: string): void => {
	const listBlock = document.querySelector('#list-block');
	let list: HTMLLIElement = document.createElement('li');
	const DateTimeObject: Date = new Date();
	const sendDateTime: string = DateTimeObject.toLocaleString('ja-JP', { month: "2-digit", day: "2-digit", hour: "numeric", minute: "numeric" });
	list.innerText = sendDateTime + ' ' + addMessage;
	listBlock?.appendChild(list);
}

const sendMessage = (): void => {
	axios.post('/message/' + loginUserId + '/' + anotherUserId + '/' + bikeId + '/post', { message: inputMessage.value })
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
			addMessageList(response.message.body);
		}
	);
}

btnSendMessage.addEventListener("click", sendMessage);
document.addEventListener('DOMContentLoaded', listenMessageChannel);
