# 自転車レンタルシェアサービス Road to World

PHP/Laravelで作成した自転車(主にロードバイクがターゲット)のレンタルシェアサービスです。

ユーザは自身の自転車を登録することで貸し出し、レンタル希望者は登録された自転車を希望の時間で借りることができます。

## 使い方

ここではRoad to Worldの基本的な使用方法を説明します。

1. 初めて使用する方は上部ナビゲーションバーからユーザ登録を選択、ユーザ登録を行ってください。
![スクリーンショット 2021-11-06 16 45 29](https://user-images.githubusercontent.com/88781098/140688243-109b2bc9-81ad-462e-9b04-9ec8f37abe83.png)
2. ユーザ登録が完了したらユーザページをクリック、早速自転車を登録してみましょう。
![スクリーンショット 2021-11-06 16 46 13](https://user-images.githubusercontent.com/88781098/140688343-4b1ef96f-a1e9-46cd-8b72-9c8ea5939a7c.png)
3. 自転車を登録したら貸出中バイク一覧で登録ができているか確認してください。
![スクリーンショット 2021-11-06 16 46 36](https://user-images.githubusercontent.com/88781098/140688408-893e2565-2cf4-405f-8060-6dd004baa554.png)
4. 自転車を借りたい時は貸出中バイク一覧の中から、借りたい自転車をピックアップして時間指定して予約をクリック。
5. 借りる前に気になる点があったら、コメントルーム一覧を選択して自分の名前をレンタル希望者欄からクリック。
6. コメントを投稿して貸出者とやり取りをしましょう。


## 環境

動作確認できている環境は下記です。

* OS：macOS BigSur 11.6
* ブラウザ：Google Chrome 95.0.4638.69
* 開発環境：PHP 7.3.31-2　Laravel 6.20.34

## 注意事項

製作者の力量不足で確認ポップアップが基本的に出てきません。
そのため決済等がワンクリックで行われてしまいます。ご注意ください。


## 文責

* 作成者 Daichi Sugiyama