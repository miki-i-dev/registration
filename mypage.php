<?php
mb_internal_encoding("utf8");
session_start();

//もしログインページから来たならDBチェック
if(!empty($_POST['mail']) && !empty($_POST['password'])){
//try catch文。DBに接続できなければエラーメッセージを表示
try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;port=8888","root","root");
} catch (PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスできません。<br>しばらくしてから再度ログインをしてください。</p>    
    <a href='http://localhost:8888/registration/mypage.php'>ログイン画面へ</a>"
    );
}

//プリペアードステートメント
$stmt = $pdo -> prepare("SELECT * FROM login_mypage WHERE mail = ? AND password = ?");

//bindValueメソッドでパラメータセット
$stmt -> bindValue(1,$_POST['mail']);
$stmt -> bindValue(2,$_POST['password']);

//executeでクエリ実行
$stmt -> execute();
$pdo = NULL;

//ログインに成功したかどうか
$login_success = false;

//fetch while文でデータを取得し、sessionに代入
while ($row = $stmt->fetch()) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];

    //データが1件でもあれば成功
    $login_success = true;
}

if(!$login_success){
    $_SESSION['login_error_msg'] = "メールアドレスまたはパスワードが間違っています。";
    header("Location: login.php");
    exit;
}

// ログインページの「ログイン状態を保持する」にチェックが入ってるかどうか
if(!empty($_POST['login_keep'])){
        // チェックがあるなら1週間保存
        setcookie('mail', $_POST['mail'], time() + 60 * 60 * 24 * 7);
        setcookie('password', $_POST['password'], time() + 60 * 60 * 24 * 7);
        setcookie('login_keep', $_POST['login_keep'], time() + 60 * 60 * 24 * 7);
 } else {
        // チェックがないならCookieを削除（期限切れにして無効にする）
        setcookie('mail', '', time() -3600);
        setcookie('password', '', time() -3600);
        setcookie('login_keep', '', time() -3600);
    }
}

//sessionの中にidがなければログイン画面に戻す
if(empty($_SESSION['id'])){
    header("Location: login.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang = "ja">
        <head>
            <title>マイページ</title>
            <link rel="stylesheet" type="text/css" href="mypage.css">
        </head>

        <body>

            <header>
            <img src="4eachblog_logo.jpg">
            <div class="log_out"><a href="log_out.php">ログアウト</a></div> 
            </header>

        <main>
            <div class="mypage">
            <div class="mypage_contents">
                <h2>会員情報</h2>
                <p>こんにちは!　<span><?php echo $_SESSION['name'] ?></span>　さん</p>
            </div>
        
        <div class="display_contents">
                <div class="display_info">
                    <p>氏名：<?php echo $_SESSION['name']?></p>
                    <p>メールアドレス：<?php echo $_SESSION['mail']?></p>
                    <p>パスワード：<?php echo $_SESSION['password']?></p>
                </div>

                <div class="prf_image">
                <img src="./image/<?php echo $_SESSION['picture']; ?>">
                </div>
        </div>


            <div class="comments">
                <p><?php echo $_SESSION['comments']?></p>
            </div>
            
            <form action="mypage_hensyu.php" method="post" class="form_center">
                <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">

                            
                 <div class="editer">
                 <input type="submit" class="edit_button" value="編集する">  
                 </div>
                </form>
            </div>
        </main>
        </body>

    <footer>
        ©️ 2018 InterNous.inc. All rights reserved
    </footer>

</html>