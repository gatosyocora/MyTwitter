<?php
/****************************************************************************
        GETメソッドのリクエスト
****************************************************************************/

  // OAuthライブラリの読み込み
  require "twitteroauth/autoload.php";
  use Abraham\TwitterOAuth\TwitterOAuth;

  // @gatosyocora
  $api_key = "PuOy72akuCC8hpRGWSj0u14Nm"; // APIキー
  $api_secret = "iSh4HwAC6TRkCM90YOvQQMWb0DG2BK4XzuLhFSYtH1ZxwLGnK1"; // APIシークレット
  $access_token = "886632174400659456-CtWSWoHuBkYaW00HfTmROTKIhRICPTE"; // アクセストークン
  $access_token_secret = "OAaOHYW5g7prJFGtENLGJZD7oAJRcDOXfhmstxTTuU160"; // アクセストークンシークレット

  // 接続
  $connection = new TwitterOAuth($api_key, $api_secret, $access_token, $access_token_secret);

  // ツイート
  $res = $connection->post("statuses/update", array("status" => "hello"));

  //レスポンス確認
  var_dump($res);

 ?>
