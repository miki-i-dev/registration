<?php
session_start();
//ログイン状態かどうか
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>

<!DOCTYPE html>
<html lang ="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>

    <body>
        <header>
           <img src="4eachblog_logo.jpg">
           <div class="resister"><a href="register.php">新規会員登録</a></div> 
        </header>

        <main>
            <form action="mypage.php" method="post" enctype="multipart/form-data">
                <div class="form_contents">
                 <?php
                    if(isset($_SESSION['login_error_msg'])){
                        echo '<p style="color: red; font-weight: bold; font-size: 14px; text-align: center;">'.$_SESSION['login_error_msg'].'</p>';
                        //リロードした時に消えるように、メッセージ表示後はsessionから削除しておく
                        unset($_SESSION['login_error_msg']);
                    }
                 ?>
                    <div class="mail">
                        メールアドレス<br>
                        <input type ="text" class="formbox" size="40" value = "<?php echo isset($_COOKIE['mail']) ? $_COOKIE['mail']:'';?>" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]\.[a-z]{2,3}$" required>
                    </div>

                    <div class="password">
                        パスワード<br>
                        <input type ="password" class="formbox" size="40" value = "<?php echo isset($_COOKIE['password']) ? $_COOKIE['password']:'';?>" name="password" required>
                    </div>

                    <div class="login_check">
                        <input type ="checkbox"  name="login_keep" value="login_keep"
                        <?php if(isset($_COOKIE['login_keep'])){ echo "checked='checked'";} ?>>                        
                    <label for="check_login">ログイン状態を保持する</label>
                    </div>
                    
                    <div class="login_button">
                        <input type="submit" class="submit_button" size="35" value="ログイン">
                    </div>
                </div>
         </main>
    </body>

    <footer>
        ©️ 2018 InterNous.inc. All rights reserved
    </footer>
</html>  