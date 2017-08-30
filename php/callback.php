<?php
  // http://qiita.com/sofpyon/items/982fe3a9ccebd8702867

  session_start();

  require_once 'common.php';
  require_once 'twitteroauth/autoload.php';

  use Abraham\TwitterOAuth\TwitterOAuth;

  // login.phpでセットしたセッション
  $request_token = [];
  $request_token['oauth_token'] = $_SESSION['oauth_token'];
  $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

  // Twitterから返されたOAuthトークンとあらかじめlogin.phpで入れておいたセッション上のものと一致するか確認
  if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    exit( 'Error!' );
  }

  // OAuthトークンを用いてTwitterOAuthをインスタンス化
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

  // アプリではaccess_token(配列)を用いてTwitter上のアカウントを操作していく
  // この変数内にOAuthトークンとトークンシークレットが配列となって格納されている
  $_SESSION['access_token'] = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

  // セッションIDをジェネレート
  session_regenerate_id();

  // マイページへリダイレクト
  header( 'location: ' . $page . '/php/mypage.php' );
 ?>
