<?php

  require_once "common.php";
  require_once "twitteroauth/autoload.php";

  use Abraham\TwitterOAuth\TwitterOAuth;

  //セッションに入れておいた配列

  session_start();

  //セッションに入れておいた配列
  $access_token = [];
  if (isset($_SESSION['access_token'])) {
    $access_token = $_SESSION['access_token'];
  } else {
    header('Location: '. $page . '/php/login.php');
    exit;
  }

  // OAuthトークンとシークレットも含めてTwitterOAuthをインスタンス化
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

  // 取得する投稿のユーザーID
  $user = "mAsKRAG"//$_GET['userid'];
  // 取得する投稿数
  $num = $_GET['num'];

  // ユーザーのタイムラインを$num件取得
  $tl = $connection->get("statuses/user_timeline", array("screen_name"=>$user,"count"=>$num));

  // 各要素をjson形式に変換
  $timeline = [];
  foreach($tl as $value) {
    array_push($timeline, str_replace("'", "’", json_encode($value)));
  }

  echo json_encode($timeline);
 ?>
