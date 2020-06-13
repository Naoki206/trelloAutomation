# Trelloラベリング機能の自動化
新型コロナウイルスの影響でリモート化した大学の講義の管理をTrelloで行っていたのだが、どうしても自動化した方がいいと思う部分があったので、自動化した。

## 前までの僕のリモート講義管理方法
 
① `大学` という名前のボードを作成。

②`月` ~ `金` という名前のリストを作る。

③その内部で、それぞれの曜日にある授業の講義名のカードを作り、

④受けないといけない講義動画が配信されているのが確認されたら、該当カードに赤色のラベルを貼る。

⑤講義を受け、提出物を提出した後、赤ラベルを消す

という管理方法をとっていた。

<img width="1152" alt="スクリーンショット 2020-05-28 18.47.34.png" src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/382190/f1c78c16-eaa5-d2cb-02fd-9faa6134db75.png">


### どこを自動化するか
上記 ④ の、受けないといけない講義動画が配信されているのが確認されたら、該当カードに赤色のラベルを貼る。
という部分は、動画が配信される時間は決まっていたので、該当時間に自動で赤ラベルを貼ってくれるようにできそうだなと思った。

## 実装の流れ

①Trello Developer APIのキーとトークンを取得する

②Trello developer公式ドキュメントを参考に実装

③ ② で作成したファイルを該当時間に実行されるようcrontabを設定

### ①Trello Developer APIのキーとトークンを取得する
1. まず、ブラウザ上でtrelloをログイン状態にする。

2. ↓のURLに飛ぶと、一番上にKeyが表示される。
https://trello.com/app-key
また、Keyのちょうど下にTokenが取得できるurlリンクがあるのでそこをクリックすると、tokenが発行される。
これらのkeyとtokenをメモ。

![スクリーンショット 2020-05-28 19.17.02.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/382190/41e16cf0-f891-3938-a004-ffc2da02c9e6.png)



### ②Trello developer公式ドキュメントを参考に実装
[Trello developer公式ドキュメント](https://developer.atlassian.com/cloud/trello/rest/)に色々載ってるのでこれを参考に実装していく。

#### ファイル構成
ファイル構成はこんな感じにした。

```
.
├── exec.php //実行するファイル
├── trelloAutomationController.php //処理全般
└── trelloInfoConstant.php //固定情報を置いておくファイル

```

固定情報は以下のコメントコードの通りに記載する

```ruby:trelloInfoConstant.php
<?php
class TrelloInfoConstant
{
    public $baseUrl   = 'https://api.trello.com/1';
    #①で取得したkey,token
    public $key       = '';
    public $token     = '';
    #適用させるボード名の指定
    public $boardName = '大学'; #(例)
}
```

### ③ ② で作成したファイルを該当時間に実行されるようcrontabを設定
毎週授業がある曜日の朝9時に特定ファイルが実行されるように設定。

1.crontabを開く

```
$crontab -e
```

以下のように設定する。

```
0 9 * * 1 php /path/to/trelloAutomation/exec.php 月 red
0 9 * * 3 php /path/to/trelloAutomation/exec.php 水 red
0 9 * * 4 php /path/to/trelloAutomation/exec.php 木 red
0 9 * * 5 php /path/to/trelloAutomation/exec.php 金 red
```

cronの設定方法に関しての詳細はここでは省略させてもらいますが、
簡単に説明すると、

```
0 9 * * 1 php /path/to/trelloAutomation/exec.php 月 red
```

上記の一行は、
`0 9 * * 1` この時刻に、 `php /path/to/mondayExec.php` これを実行するという意味合いがあります。
そして、コマンド引数に曜日、ラベルの色を指定します。


`0 9 * * 1`　は　`分 時 日 月 曜`　の順番にならんでおり、　
-> 曜日は `1 2 3 4 5 6 7 0` の順で `月 火 水 木 金 土 日 日` となっています。

つまり上記の一文の場合、毎週9時に、/path/to/mondayExec.php 月 red を実行するということです。

くわしくは[このへん](https://qiita.com/katsukii/items/d5f90a6e4592d1414f99)に載っているのでもっと詳しく知りたい方は見てみてください。

一応これで毎週手動で行っていたラベル付けを自動化することができました。
