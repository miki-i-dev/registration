<?php
mb_internal_encoding("utf8");
session_start();

//mypage.phpからの導線以外は、login.phpにリダイレクト
if (empty($_POST['from_mypage'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang = "ja">
    <head>
        <title>マイページ編集</title>
        <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
    </head>

    <body>
        <header>
           <img src="4eachblog_logo.jpg">
           <div class="logout"><a href="login.php">ログアウト</a></div> 
        </header>

        <main>
            <div class="mypage">
            <div class="mypage_contents">
                <h2>会員情報</h2>
                <p>こんにちは!　<span><?php echo $_SESSION['name'] ?></span>　さん</p>
            </div>

        <form action ="mypage_update.php" method ="post">
        <div class="display_contents">
                    <div class="edit_form">
                        <p>氏名：<input type ="text" class="formbox" size="30" name="name" value="<?php echo $_SESSION['name']?>"></p>
                        <p>メール：<input type ="text" class="formbox" size="30" name="mail" value="<?php echo $_SESSION['mail']?>"></p>
                        <p>パスワード：<input type ="text" class="formbox" size="30" name="password" value="<?php echo $_SESSION['password']?>"></p>
                    </div>

                <div class="prf_image">
                    <img src="./image/<?php echo $_SESSION['picture']; ?>">
                </div>
            </div>

            <div class="comments">
                <p>コメント(250文字以内)：<br>
                    <textarea name ="comments" class="formbox" rows="10" cols="70" maxlength="250"><?php echo $_SESSION['comments']?></textarea></p>
            </div>

                            
            <div class="edit">
                <input type="submit" class="edit_button" value="この内容に変更する">
            </div>
        </form>
       </div>
      </main>
    </body>

    <footer>
        ©️ 2018 InterNous.inc. All rights reserved
    </footer>

</html>