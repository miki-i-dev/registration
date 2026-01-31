<?php
session_start();
session_destroy();

// Cookieも「過去の期限」にして削除する
setcookie('mail', '', time() - 3600);
setcookie('password', '', time() - 3600);
setcookie('login_keep', '', time() - 3600);

header("Location:login.php");
?>