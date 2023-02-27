<?php
mb_internal_encoding("utf8");

//仮保存されたファイル名で画像ファイルを取得(サーバへ仮アップロードされたディレクトリとファイル名)
$temp_pic_name = $_FILES['picture']['tmp_name'];

//元のファイル名で画像ファイルを取得。事前に画像を格納する「image」という名前のフォルダを作成しておく必要あり
$original_pic_name =$_FILES['picture']['name'];
$path_filename = './image/'.$original_pic_name;

//仮保存のファイル名を、imageフォルダに、元のファイル名で移動させる
move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <title>マイページ登録</title>
        <link rel ="stylesheet" type="text/css" href="register_confirm.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>
            
        <div class="register">
            <h2>会員登録 確認</h2>
            <p class="text1">こちらの内容で宜しいでしょうか？</p><br>

            <p class="text2">名前：<?php echo $_POST['name']; ?></p><br>
            <p class="text2">メール：<?php echo $_POST['mail']; ?></p><br>
            <p class="text2">パスワード：<?php echo $_POST['password']; ?></p><br>
            <p class="text2">プロフィール写真：<?php echo $_FILES['picture']["name"]; ?></p><br>
            <p class="text2">コメント：<?php echo $_POST['comments']; ?></p><br>

            <div class="button">
                <form class="back" action="register.php">
                <input type="submit" class="button1" value="戻って修正する">
                </form>

                <form action="register_insert.php" method="post" enctype="multipart/form-data">
                    <input type="submit" class="button2" value="登録する">
                    <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                    <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                    <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                    <input type="hidden" value="<?php echo $path_filename; ?>" name="picture">
                    <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                </form>
            </div>
        </div>

        <footer>
            © 2018 InterNouse.inc. All rights reserved
        </footer>

    </body>
</html>