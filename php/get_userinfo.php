<?php
  session_start();

  require_once "common.php";
  require_once "twitteroauth/autoload.php";

  use Abraham\TwitterOAuth\TwitterOAuth;

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

  // ユーザー情報を取得(GET)
  $user = $connection->get("account/verify_credentials");

  //$data = new stdClass();
  //$data->myUserId =  $user->screen_name;
  //$data->myUsername =  $user->name;
  $data = (object) array("userName"=>$user->name, "userId"=>$user->screen_name, "iconURL"=>$user->profile_image_url);
  echo json_encode($data);
 ?>
