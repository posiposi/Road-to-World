import axios from "axios";

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

document.addEventListener('DOMContentLoaded', getMessageList);
