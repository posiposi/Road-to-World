import axios from "axios";

const splitPathName: Array<string> = location.pathname.split('/');
const bikeId: number = Number(splitPathName[2]);
const loginUserId: number = Number(splitPathName[3]);
const anotherUserId: number = Number(splitPathName[4]);

const getMessageList = () => {
  axios.get('/messages/' + loginUserId + '/' + anotherUserId + '/' + bikeId + '/get')
    .then((result) => {
      const resultObj = result.data;
      console.log(resultObj);
      // TODO getで取得してくるのがコメントリストクラスでないためフロント側で描画されない
      initMessageList(resultObj[0].body);
      // ループ不要か検討すること
      // for (let index = 0; index < resultObj.length; index++) {
      //   // const message = resultObj[index];
      //   const message = resultObj;
      //   console.log(message);
      //   initMessageList(message.body);
      // }
    })
    .catch((error) => {
      console.log('error!');
      console.log(error);
    });
};

const initMessageList = (message: string) => {
  let listBlock = document.querySelector('#list-block');
  let list: HTMLLIElement = document.createElement('li');
  list.innerText = message;
  listBlock?.appendChild(list);
}

document.addEventListener('DOMContentLoaded', getMessageList);
