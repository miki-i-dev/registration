<?php
mb_internal_encoding("utf8");

//DB
$pdo = new PDO("mysql:dbname=lesson01;host=localhost;port=8888","root","root");
//プリペアードステートメント
$stmt = $pdo -> prepare("insert into login_mypage(name,mail,password,picture,comments) values (?,?,?,?,?)");

//bindValue
$stmt -> bindValue(1,$_POST['name']);
$stmt -> bindValue(2,$_POST['mail']);
$stmt -> bindValue(3,$_POST['password']);
$stmt -> bindValue(4,$_POST['path_filename']);
$stmt -> bindValue(5,$_POST['comments']);

//クエリ実行
try { 
    $stmt -> execute();
    $pdo = NULL;
    // リダイレクト。完了画面へ自動で飛ばす命令
    header("Location: after_register.html");

} catch (PDOException $e) {
    //（例：同じメールアドレスを登録した際のエラー）データーベース接続を閉じる
    $pdo = NULL;

    header("Location: after_exception.html");
    exit();
}
?>