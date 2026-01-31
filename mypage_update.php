<?php
mb_internal_encoding("utf8");
session_start();

//DB接続
try{
$pdo = new PDO("mysql:dbname=lesson01;host=localhost;port=8888","root","root");
} catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており、一時的にアクセスできません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/mypage.php'>マイページへ</a>");
}


//preparedステートメントでSQLをセット //bindValueでパラメータをセット
$stmt = $pdo -> prepare("UPDATE login_mypage SET name = ?, mail = ?, password = ?, comments = ? WHERE id = ?");
$stmt -> bindValue(1,$_POST['name']);
$stmt -> bindValue(2,$_POST['mail']);
$stmt -> bindValue(3,$_POST['password']);
$stmt -> bindValue(4,$_POST['comments']);
$stmt -> bindValue(5,$_SESSION['id']);

//executeでクエリを実行
$stmt -> execute();

$stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");
$stmt -> bindValue(1,$_POST['mail']);
$stmt -> bindValue(2,$_POST['password']);

$stmt -> execute();

//DB切断
$pdo = NULL;

//fetch、while文でデータを取得し、sessionに代入
while($row = $stmt -> fetch()){
    $_SESSION['id']=$row['id'];
    $_SESSION['name']=$row['name'];
    $_SESSION['mail']=$row['mail'];
    $_SESSION['password']=$row['password'];
    $_SESSION['comments']=$row['comments'];
}

//mypage.phpへリダイレクト
header('Location:mypage.php');

?>