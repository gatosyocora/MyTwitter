<?php
  // http://qiita.com/sofpyon/items/982fe3a9ccebd8702867

  session_start();

  require_once 'common.php';
  require_once 'twitteroauth/autoload.php';

  use Abraham\TwitterOAuth\TwitterOAuth;

  // TwitterOAuthをインスタンス化
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

  // コールバックURLをセット
  $request_token = $connection->oauth("oauth/request_token", array('oauth_callback' => OAUTH_CALLBACK));

  // callback.phpで使うため, セッションに入れる
  $_SESSION['oauth_token'] = $request_token['oauth_token'];
  $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

  // Twitter.com上の認証画面URLを取得
  $url = $connection->url('oauth/authenticate', array('oauth_token' => $request_token['oauth_token']));

  // Twitter.comの認証画面へリダイレクト
  header( 'location: ' . $url );
 ?>
