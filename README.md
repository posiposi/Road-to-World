# 自転車レンタルシェアサービス Road to World

PHP/Laravelで作成した自転車(主にロードバイクがターゲット)のレンタルシェアサービスです。

ユーザは自身の自転車を登録することで貸し出し、レンタル希望者は登録された自転車を希望の時間で借りることができます。

料金も貸出し側が自由に設定することができます。


## 設計
CacooにてワイヤーフレームやER図を公開しております。
下記リンクより確認いただけますと幸いです。

<https://cacoo.com/diagrams/GKfYc1Sy57rMTs8h/BA56D>

## 実装した主な機能
1. Amazon S3を使用しての画像登録および表示機能
2. Laravel CashierによるStripeでの決済機能
3. 貸出し側、レンタル側のやり取りのためのコメント機能
4. ログイン機能
5. 自転車の登録・登録情報変更機能
6. ユーザの登録・登録情報変更機能
7. レンタルしたい日時の30分単位での指定予約機能
8. 未決済の予約を自動削除するコマンド、タスクスケジュールの設定


## アピールポイント
まだまだ改善途上ではありますが、レンタルのための最低限の機能は実装できました。

実装面では特にレンタル日時が多数ユーザで重ならないように、動的バリデーションを設定するのに苦労しました。

予約状況カレンダーの引数設定についてもfor文をどのように使うかで苦戦しましたが、なんとか実装できました。

下記にバリデーション該当部分のソースコードリンクを貼っておきますので、実際に見て頂けると幸いです。

また、タスクスケジュールについても自動で未決済予約を削除する機能を実装しています。

コマンドを自分で作成する必要がありましたので、自分で調べながら解決する良い経験になりました。

なお、決済機能については本格的な運用を開始するまで、しばらくの間テスト状態としておきます。ご了承ください。

<https://github.com/posiposi/Road-to-World/blob/main/app/Http/Controllers/ReservationController.php#L32-L36>


## 修正予定ポイント
現段階で改善を予定している点、実装機能は下記です。

1. 未決済者の決済ページへのリンク
2. 本予約と仮予約の表示分離
3. 各種ページの充実

他にも細かい修正点はあるとは思いますが、現段階ではまず上記から改善を行っていく予定です。


## 使い方

ここではRoad to Worldの基本的な使用方法を説明します。
(開発中画像のため、定期的に更新を予定しております。)

1. 初めて使用する方は上部ナビゲーションバーからユーザ登録を選択、ユーザ登録を行ってください。
![スクリーンショット 2021-11-06 16 45 29](https://user-images.githubusercontent.com/88781098/140688243-109b2bc9-81ad-462e-9b04-9ec8f37abe83.png)

2. ユーザ登録が完了したらユーザページをクリック、早速自転車を登録してみましょう。
![スクリーンショット 2021-11-06 16 46 13](https://user-images.githubusercontent.com/88781098/140688343-4b1ef96f-a1e9-46cd-8b72-9c8ea5939a7c.png)

3. 自転車を借りたい時は貸出中バイク一覧の中から、借りたい自転車をピックアップして時間指定して予約をクリック。
![スクリーンショット 2021-11-06 16 46 36](https://user-images.githubusercontent.com/88781098/140688408-893e2565-2cf4-405f-8060-6dd004baa554.png)

4. 予約ボタンをクリックすると仮予約となります。1時間以内に決済を行って予約を確定してください。
![スクリーンショット 2021-11-13 14 58 37](https://user-images.githubusercontent.com/88781098/141607796-2c215680-2fab-4f32-bf70-56df6d89604e.png)

5. 借りる前に気になる点があったら、コメントルーム一覧を選択して自分の名前をレンタル希望者欄からクリック。
![スクリーンショット 2021-11-13 14 57 02](https://user-images.githubusercontent.com/88781098/141607733-ac4adeca-af90-4d5c-8964-fa96a7f4b69c.png)

6. コメントを投稿して貸出者とやり取りをしましょう。
![スクリーンショット 2021-11-13 14 57 35](https://user-images.githubusercontent.com/88781098/141607745-aebf1cfc-03e5-467a-a9a8-5805c72c63ba.png)


## 開発環境

* OS：macOS BigSur 11.6
* ブラウザ：Google Chrome 95.0.4638.69
* 開発環境：MAMPでの開発　Mysql 5.7.34(MAMP) Apache 2.4.46(MAMP) PHP 7.3.31-2　Laravel 6.20.34 
