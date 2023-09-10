import axios from "axios";

const splitPathName: Array<string> = location.pathname.split('/');
const bikeId: number = Number(splitPathName[2]);
const loginUserId: number = Number(splitPathName[3]);
const anotherUserId: number = Number(splitPathName[4]);

const getMessageList = () => {
  axios.get('/messages/' + loginUserId + '/' + anotherUserId + '/' + bikeId + '/get')
    .then((result) => {
      const resultObj = result.data;
      let usersMessage = [...resultObj.loginUserComments, ...resultObj.anotherUserComments];
      let sortedUsersMessage = usersMessage.sort((x, y) => {
        return (x.created_at < y.created_at) ? -1 : 1;
      });
      for (let index = 0; index < sortedUsersMessage.length; index++) {
        const date: string = sortedUsersMessage[index].created_at;
        const message: string = sortedUsersMessage[index].body;
        const userName: string = sortedUsersMessage[index].nickname;
        initMessageList(userName, date, message);
      }
    })
    .catch((error) => {
      console.log(error);
    });
};

const initMessageList = (userName: string, date: string, message: string) => {
  console.log(date);
  let listBlock = document.querySelector('#list-block');
  let list: HTMLLIElement = document.createElement('li');
  list.innerText = userName + ' ' + date + ' ' + message;
  listBlock?.appendChild(list);
}

document.addEventListener('DOMContentLoaded', getMessageList);
