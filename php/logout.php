<?php
  session_start();

  require_once 'common.php';

  header("Content-type: text/html; charset=utf-8");

  // セッション変数を解除
  if (isset($_SESSION['access_token'])) {
    unset($_SESSION['access_token']);
  }
  if (isset($_SESSION['oauth_token'])) {
    unset($_SESSION['oauth_token']);
  }
  if (isset($_SESSION['oauth_token_secret'])) {
    unset($_SESSION['oauth_token_secret']);
  }

  // セッションを破棄
  session_destroy();

  echo "<p>ログアウトしました</p>";
  echo "<a href='" . $page . "'>トップページへ</a>";
 ?>
