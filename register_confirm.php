<?php
    mb_internal_encoding("utf8");

    $temp_pic_name = $_FILES['picture']['tmp_name'];

    $original_pic_name = $_FILES['picture']['name'];
    $path_file_name = './image/'.$original_pic_name;

    move_uploaded_file ($temp_pic_name,'./image/'.$original_pic_name); 
?>

<!DOCTYPE html>
<html lang = "ja">
    <head>
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="register_confirm.css">
    </head>

    <body>

        <header>
           <img src="4eachblog_logo.jpg">
        </header>

      <main>
        <div class="confirm">
        <div class="confirm_contents">
            <h2>会員登録 確認</h2>
            <p>こちらの内容で登録しても宜しいでしょうか</p>
        </div>
       
       <div class="display_confirm">
             <p>氏名：<?php echo $_POST['name']?></p>
             <p>メールアドレス：<?php echo $_POST['mail']?></p>
             <p>パスワード：<?php echo $_POST['password']?></p>
             <p>プロフィール写真：<?php echo $original_pic_name; ?></p>
             <p>コメント(250文字まで)：<?php echo $_POST['comments']?></p>
        </div>

        <div class="form">
        <form action="register_insert.php" method="post" >
            <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name"> 
            <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail"> 
            <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password"> 
            <input type="hidden" value="<?php echo $original_pic_name; ?>" name="path_filename"> 
            <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments"> 

                    
            <div class="button_container">
            <div class="back">
            <input type="button" class="back_button"  value="戻って修正する" onclick="history.back()">
            </div>

            <div class="toroku">
            <input type="submit" class="submit_button"  value="登録する">
            </div>
        </div>
        </form>
        </div>



     </div>
    </main>
    </body>

    <footer>
        ©️ 2018 InterNous.inc. All rights reserved
    </footer>

</html>