<?php
  // http://qiita.com/sofpyon/items/982fe3a9ccebd8702867

  session_start();

  require_once "common.php";
  require_once "twitteroauth/autoload.php";

  use Abraham\TwitterOAuth\TwitterOAuth;

  //セッションに入れておいた配列
  $access_token = $_SESSION['access_token'];

  // OAuthトークンとシークレットも含めてTwitterOAuthをインスタンス化
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

  // ユーザー情報を取得(GET)
  $user = $connection->get("account/verify_credentials");

  //取得したユーザー情報を構造化された情報へ変換(ダンプ)し, 表示
  //var_dump( $user );

  // ユーザーのタイムラインを10件取得
  $timeline = $connection->get("statuses/home_timeline", array("count"=>10));

  //var_dump( $timeline );

  /*** 情報をHTML形式で表示 */
  header("Content-type: text/html; charset=utf-8");

  // ユーザー情報を表示
  echo "<h2>あなたの名前: ". $user->name ."</h2>";
  echo "<h3>あなたのユーザーID: ". $user->screen_name ."</h3>";
  echo "<p><h3>最終ツイート: " . $user->status->text . "</h3><br>". date("Y年n月j日l H:i:s", strtotime($user->status->created_at)) . "</p>";
  echo "<ul>";
  foreach ($timeline as $key => $value) {
    echo "<li><b><u>" . $value->user->name ."[@" . $value->user->screen_name ."]</u></b>: <br>" . $value->text . "</li>";
  };
  echo "</ul>";
  echo "<a href='logout.php'>ログアウト</a>";
 ?>
