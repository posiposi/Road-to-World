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
9. 自転車の検索機能


## アピールポイント
アピールポイントは下記が主となります。

①
レンタル日時が多数ユーザで重ならないように、動的バリデーションを設定するのに苦労しました。
予約状況カレンダーの引数設定についてもfor文をどのように使うかで苦戦しましたがなんとか実装できました。
コントローラ・bladeファイル・モデルでのメソッド作成など、様々な事項をクリアする必要がありましたが、
なんとか機能としてリリースが出来たと思います。(UI・UXは要改善ではありますが…)

②
タスクスケジュールについても自動で未決済予約と完了した予約を削除する機能を実装しています。
上記の機能を実現するためにArtisanコマンドを自分で作成する必要がありましたので、自分で調べながら解決する良い経験になりました。
また本番環境でのcron設定についても学習しながら実装を行えました。
今後はHerokuだけでなく別環境でのデプロイについても学習を進めようと考えています。

③
S3を用いての写真登録機能とStripeで実際に支払いも可能にしております。
自転車はもちろん、個人のアバター写真の登録にも対応しています。
Stripeでの支払いも本番環境においてもテストモードで動作確認が出来ています。
(本格運用まではテストモードにしておきます。ご容赦下さい。)

④
簡易的ではありますが検索機能とチャット機能を実装しています。
あくまでも簡単な検索や会話しかできませんが、一応の機能として導入できたのは良かったかと思います。


## 修正・改善ポイント
現段階で把握しているポイントは下記です。

①検索機能の高度化
検索機能があくまでも簡単な設定になっているためより洗練されたものにしたいです。
特に料金が範囲指定できないため、あまり使いやすいとも思えません。
まずは上記から修正していこうかと考えています。

②コメントページの非同期化
検索機能と同様にこちらについてもより使いやすいものにできればと考えています。
コメント毎にリクエスト・レスポンスが発生しているため、リアルタイムでの会話とは言い難いです。
そのためJavaScriptでの非同期化を目指そうかと思います。

③デザインの洗練
これは開発者自身のセンスもあるとは思いますが、今のデザインは有り体に言ってダサいです。
なんとかもう少しユーザが分かりやすいデザインを導入できればと思うのですが…
知人らに使ってもらって、貰った意見をなるべく反映するようにはしていますので、
少しずつでも良いものにできればと思います。


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


## バージョンリリース
v2.0.0 検索機能を追加しました。2022/1/16
v2.0.1 ファビコンが表示されない不具合を修正しました。 2022/1/20
v3.0.0 Stripeセキュリティ保守のためPHP8.1.1およびLaravel8.80.0を導入しました。
v3.1.0 個人の自転車予約表をMy Pageに追加しました。
v3.1.2 一部エラーメッセージが英語表記になっていた不具合を修正しました。
v3.1.3 ユーザーが自分自身の自転車を借りることが出来てしまう不具合を修正しました。
v4.0.0 メインページのレイアウトを変更しました。


## 開発環境

* OS：macOS BigSur 11.6
* ブラウザ：Google Chrome 95.0.4638.69
* 開発環境の変遷は下記の通りです。
* 最初期から2021/12月末まで：cloud9による開発
* 2021/1/1〜1/20：MAMPでの開発 Mysql 5.7.34(MAMP) Apache 2.4.46(MAMP) PHP 7.3.31-2 Laravel 6.20.34 
* 2021/1/20〜1/24：Dockerでの開発 Mysql 5.7 PHP 7.3.29 Laravel 6.20.34 nginx
* 2021/1/24〜現在：Laravel SailによるDocker環境構築
