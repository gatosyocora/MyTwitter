<?php
/****************************************************************************
        GETメソッドのリクエスト
****************************************************************************/

  // OAuthライブラリの読み込み
  require_once "twitteroauth/autoload.php";
  require_once "common.php";
  use Abraham\TwitterOAuth\TwitterOAuth;

  session_start();

  // @gatosyocora
  $access_token = [];
  $access_token = $_SESSION['access_token'];

  // 接続
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

  $tweettext = $_POST["tweetdata"];
  if (count($tweettext) > 0) {
    // ツイート
    $res = $connection->post("statuses/update", array("status" => $tweettext));
    //レスポンス確認
    echo str_replace("'", "’", json_encode($res));
  } else {
    echo "ツイートデータの受け取りに失敗しました";
  }


 ?>
